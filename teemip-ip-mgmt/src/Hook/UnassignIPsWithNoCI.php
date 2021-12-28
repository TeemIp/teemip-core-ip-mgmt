<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Hook;

use CMDBObject;
use CMDBObjectSet;
use DateTime;
use DBObjectSearch;
use Exception;
use IPAddress;
use iScheduledProcess;
use MetaModel;

class UnassignIPsWithNoCI implements iScheduledProcess
{
	const MODULE_CODE = 'teemip-ip-mgmt';
	const FUNCTION_CODE = 'ip_unassign_on_no_ci';
	const FUNCTION_SETTING_ENABLED = 'enabled';
	const FUNCTION_SETTING_DEBUG = 'debug';
	const FUNCTION_SETTING_PERIODICITY = 'periodicity';
	const FUNCTION_SETTING_TARGET_STATUS = 'target_status';

	const DEFAULT_FUNCTION_SETTING_ENABLED = true;
	const DEFAULT_FUNCTION_SETTING_DEBUG = false;
	const DEFAULT_FUNCTION_SETTING_PERIODICITY = 3600;
	const DEFAULT_FUNCTION_SETTING_TARGET_STATUS = 'unassigned';

	protected $aDefaultSettings = array();
	protected $bDebug;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->aDefaultSettings = array(static::FUNCTION_SETTING_ENABLED => static::DEFAULT_FUNCTION_SETTING_ENABLED,
			static::FUNCTION_SETTING_DEBUG => static::DEFAULT_FUNCTION_SETTING_DEBUG,
			static::FUNCTION_SETTING_PERIODICITY => static::DEFAULT_FUNCTION_SETTING_PERIODICITY,
			static::FUNCTION_SETTING_TARGET_STATUS => static::DEFAULT_FUNCTION_SETTING_TARGET_STATUS);
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $this->aDefaultSettings);
		$this->bDebug = (bool) $aFunctionSettings[static::FUNCTION_SETTING_DEBUG];
	}

	/**
	 * Gives the exact time at which the process must be run next time
	 *
	 * @return \DateTime
	 * @throws \Exception
	 */
	public function GetNextOccurrence()
	{
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $this->aDefaultSettings);
		$bEnabled = (bool) $aFunctionSettings[static::FUNCTION_SETTING_ENABLED];
		if (!$bEnabled)
		{
			$oRet = new DateTime();
			$oRet->modify('+86400 seconds');
		}
		else
		{
			$sPeriodicity = $aFunctionSettings[static::FUNCTION_SETTING_PERIODICITY];
			$oRet = new DateTime();
			$oRet->modify('+'.$sPeriodicity.' seconds');
		}
		return $oRet;
	}

	/**
	 * @inheritdoc
	 */
	public function Process($iUnixTimeLimit)
	{
		$aReport = array(
			'ipchecked' => 0,
		);

		CMDBObject::SetTrackInfo('Automatic - Background task to unassign IPs with no CI');
		CMDBObject::SetTrackOrigin('custom-extension');

		// Get and check target state for IPs
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $this->aDefaultSettings);
		$sTargetStatus = $aFunctionSettings[static::FUNCTION_SETTING_TARGET_STATUS];
		if (!in_array($sTargetStatus, array('unassigned' ,'released')))
		{
			$this->Trace('Target status for IPs to be unassigned is incorrect. Exiting...');
			return '';
		}

		// Get list of organizations for which IPs are allocated when attached to production CIs
		$oOrgToCleanSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o JOIN IPConfig AS ic ON ic.org_id = o.id WHERE ic.ip_unassign_on_no_ci = 'yes'"));
		if ($oOrgToCleanSet->Count() == 0)
		{
			$this->Trace('No organization has activated this feature. Exiting...');
			return '';
		}
		// Build list for OQL query
		$sOrgToCleanList = "";
		$i = 0;
		while($oOrg = $oOrgToCleanSet->Fetch())
		{
			if ($i++ == 0)
			{
				$sOrgToCleanList = "(".$oOrg->GetKey();
			}
			else
			{
				$sOrgToCleanList .= ", ".$oOrg->GetKey();
			}
		}
		$sOrgToCleanList .= ")";

		// 1st step: create OQL that lists the IPs attached to a CI
		$aClassesWithIPs = IPAddress::GetListOfClassesWIthIP('leaf');
		$sOQLni = "";
		if (empty($aClassesWithIPs))
		{
			$this->Trace('No CI has external keys toward IP Addresses');
		}
		else
		{
			// Retrieve and correct IPs attached to production CIs and that have wrong status
			$j = 0;
			foreach($aClassesWithIPs as $sClass => $sKey)
			{
				$aIPAttributes = array_merge($sKey['IPAddress'],
					$sKey['IPv4Address'],
					$sKey['IPv6Address']);
				$sOQLj = "";
				$i = 0;
				foreach ($aIPAttributes as $sAttribute) {
					$sOQLi = "SELECT IPAddress AS ip JOIN $sClass AS ci ON ci.$sAttribute = ip.id WHERE ci.org_id IN $sOrgToCleanList";
					if ($i++ == 0) {
						$sOQLj = $sOQLi;
					} else
					{
						$sOQLj .= " UNION ".$sOQLi;
					}
				}

				if ($j++ == 0)
				{
					$sOQLni = $sOQLj;
				}
				else
				{
					$sOQLni .= " UNION ".$sOQLj;
				}
			}
		}

		// 2nd step: add to OQL the list of IPs attached to interfaces
		$sOQLk = "SELECT IPAddress AS ip JOIN lnkIPInterfaceToIPAddress AS lnk ON lnk.ipaddress_id = ip.id JOIN PhysicalInterface AS p ON lnk.ipinterface_id = p.id JOIN ConnectableCI AS c ON p.connectableci_id = c.id WHERE c.org_id IN $sOrgToCleanList";
		if(class_exists('LogicalInterface'))
		{
			$sOQLk .= " UNION SELECT IPAddress AS ip JOIN lnkIPInterfaceToIPAddress AS lnk ON lnk.ipaddress_id = ip.id JOIN LogicalInterface AS l ON lnk.ipinterface_id = l.id JOIN VirtualMachine AS v ON l.virtualmachine_id = v.id WHERE v.org_id IN $sOrgToCleanList";
		}
		if ($sOQLni == '')
		{
			$sOQLni = $sOQLk;
		}
		else
		{
			$sOQLni .= " UNION ".$sOQLk;
		}

		// 3rd stap: get allocated IPs not attached to any CI nor interface and set their status accordingly
		$sOQL = "SELECT IPAddress WHERE status = 'allocated' AND id NOT IN (".$sOQLni.")";
		$oIPAddressSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL));
		while ((time() < $iUnixTimeLimit) && $oIPAddress = $oIPAddressSet->Fetch())
		{
			try
			{
				$aReport['ipchecked']++;

				$oIPAddress->Set('status', $sTargetStatus);
				$oIPAddress->DBUpdate();
			} catch (Exception $e)
			{
				$this->Trace('Skipping IP check as there was an exception! ('.$e->getMessage().')');
			}
		}

		// Info to help understand why not all objects have been processed during this batch.
		if (time() >= $iUnixTimeLimit)
		{
			$this->Trace('Stopped because time limit exceeded!');
		}

		// Report
		$sReport = ($aReport['ipchecked'] === 0) ? "\nNo IP have been corrected\n" : "\n".$aReport['ipchecked']." IPs have been corrected.\n";
		return $sReport;
	}

	/**
	 * Prints a $sMessage in the CRON output.
	 *
	 * @param string $sMessage
	 */
	protected function Trace($sMessage)
	{
		if ($this->bDebug)
		{
			echo $sMessage."\n";
		}
	}
}
