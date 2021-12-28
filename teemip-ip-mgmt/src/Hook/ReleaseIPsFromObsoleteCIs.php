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

class ReleaseIPsFromObsoleteCIs implements iScheduledProcess
{
	const MODULE_CODE = 'teemip-ip-mgmt';
	const FUNCTION_CODE = 'ip_release_on_ci_status';
	const FUNCTION_SETTING_ENABLED = 'enabled';
	const FUNCTION_SETTING_DEBUG = 'debug';
	const FUNCTION_SETTING_PERIODICITY = 'periodicity';
	const FUNCTION_SETTING_STATUS_LIST = 'status_list';

	const DEFAULT_FUNCTION_SETTING_ENABLED = true;
	const DEFAULT_FUNCTION_SETTING_DEBUG = false;
	const DEFAULT_FUNCTION_SETTING_PERIODICITY = 3600;
	const DEFAULT_FUNCTION_SETTING_STATUS_LIST = array('obsolete');

	protected $aDefaultSettings = array();
	protected $bDebug;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->aDefaultSettings = array(
			static::FUNCTION_SETTING_ENABLED => static::DEFAULT_FUNCTION_SETTING_ENABLED,
			static::FUNCTION_SETTING_DEBUG => static::DEFAULT_FUNCTION_SETTING_DEBUG,
			static::FUNCTION_SETTING_PERIODICITY => static::DEFAULT_FUNCTION_SETTING_PERIODICITY,
			static::FUNCTION_SETTING_STATUS_LIST => static::DEFAULT_FUNCTION_SETTING_STATUS_LIST
		);
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
			'ipreleased' => 0,
		);

		CMDBObject::SetTrackInfo('Automatic - Background task to release IPs from obsolete CIs');
		CMDBObject::SetTrackOrigin('custom-extension');

		// Get list of organizations for which IPs are released when CIs are obsoleted
		$oOrgToCleanSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o JOIN IPConfig AS ic ON ic.org_id = o.id WHERE ic.ip_release_on_ci_obsolete = 'yes'"));
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

		// 1st step: get list of status that trigger the release action
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $this->aDefaultSettings);
		$aStatusList = $aFunctionSettings[static::FUNCTION_SETTING_STATUS_LIST];
		$sStatusList = "";
		$i = 0;
		foreach($aStatusList as $sStatus)
		{
			if ($i++ == 0)
			{
				$sStatusList = "('$sStatus'";
			}
			else
			{
				$sStatusList .= ", '$sStatus'";
			}
		}
		$sStatusList .= ")";

		// 2nd step: release IPs allocated to obsolete CIs
		$aClassesWithIPs = IPAddress::GetListOfClassesWIthIP('leaf');
		if (empty($aClassesWithIPs))
		{
			$this->Trace('No CI has external keys toward IP Addresses');
		}
		else
		{
			// Retrieve and release IPs attached to obsolete CIs
			foreach($aClassesWithIPs as $sClass => $sKey)
			{
				$aIPAttributes = array_merge($sKey['IPAddress'], $sKey['IPv4Address'], $sKey['IPv6Address']);
				$sOQL = "";
				$i = 0;
				foreach($aIPAttributes as $sAttribute)
				{
					$sOQLi = "SELECT IPAddress AS ip JOIN $sClass AS ci ON ci.$sAttribute = ip.id WHERE ci.status IN $sStatusList AND ci.org_id IN $sOrgToCleanList";
					if ($i++ == 0)
					{
						$sOQL = $sOQLi;
					}
					else
					{
						$sOQL .= " UNION ".$sOQLi;
					}
				}

				// Correct IP status
				// Note: IP will automatically be removed from CIs at that time
				$oIPAddressSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL));
				while ((time() < $iUnixTimeLimit) && $oIPAddress = $oIPAddressSet->Fetch())
				{
					try
					{
						$aReport['ipreleased']++;

						$oIPAddress->Set('status', 'released');
						$oIPAddress->DBUpdate();
					} catch (Exception $e)
					{
						$this->Trace('Skipping IP check as there was an exception! ('.$e->getMessage().')');
					}
				}
			}
		}

		// 3rd step: check IPs allocated to interfaces attached to CIs
		$sOQL = "SELECT IPAddress AS ip JOIN lnkIPInterfaceToIPAddress AS lnk ON lnk.ipaddress_id = ip.id JOIN PhysicalInterface AS p ON lnk.ipinterface_id = p.id JOIN ConnectableCI AS c ON p.connectableci_id = c.id WHERE c.status IN $sStatusList AND c.org_id IN $sOrgToCleanList";
		if(class_exists('LogicalInterface'))
		{
			$sOQL .= " UNION SELECT IPAddress AS ip JOIN lnkIPInterfaceToIPAddress AS lnk ON lnk.ipaddress_id = ip.id JOIN LogicalInterface AS l ON lnk.ipinterface_id = l.id JOIN VirtualMachine AS v ON l.virtualmachine_id = v.id WHERE v.status IN $sStatusList AND v.org_id IN $sOrgToCleanList";
		}

		// Correct IP status
		// Note: IP will automatically be removed from interfaces at that time
		$oIPAddressSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL));
		while ((time() < $iUnixTimeLimit) && $oIPAddress = $oIPAddressSet->Fetch())
		{
			try
			{
				$aReport['ipreleased']++;

				$oIPAddress->Set('status', 'released');
				$oIPAddress->DBUpdate();
			}
			catch(Exception $e)
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
		$sReport = ($aReport['ipreleased'] === 0) ? "\nNo IP have been released\n" : "\n".$aReport['ipreleased']." IPs have been released.\n";
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
