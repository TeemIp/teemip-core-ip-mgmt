<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
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
use TeemIp\TeemIp\Extension\Framework\Helper\IPUtils;

class AllocateIPsToProductionCIs implements iScheduledProcess
{
	const MODULE_CODE = 'teemip-ip-mgmt';
	const FUNCTION_CODE = 'ip_allocate_on_ci_status';
	const FUNCTION_SETTING_ENABLED = 'enabled';
	const FUNCTION_SETTING_DEBUG = 'debug';
	const FUNCTION_SETTING_PERIODICITY = 'periodicity';
	const FUNCTION_SETTING_STATUS_LIST = 'status_list';

	const DEFAULT_FUNCTION_SETTING_ENABLED = true;
	const DEFAULT_FUNCTION_SETTING_DEBUG = false;
	const DEFAULT_FUNCTION_SETTING_PERIODICITY = 3600;
	const DEFAULT_FUNCTION_SETTING_STATUS_LIST = array('implementation', 'production');

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
			static::FUNCTION_SETTING_STATUS_LIST => static::DEFAULT_FUNCTION_SETTING_STATUS_LIST);
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $this->aDefaultSettings);
		$this->bDebug = (bool) $aFunctionSettings[static::FUNCTION_SETTING_DEBUG];
	}

	/**
	 * Read module settings and return parameters required for the process to run
	 *
	 * @return array
	 */
	private function GetSetting(): array
	{
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $this->aDefaultSettings);
		return [
			(bool) $aFunctionSettings[static::FUNCTION_SETTING_ENABLED],
			$aFunctionSettings[static::FUNCTION_SETTING_PERIODICITY],
			$aFunctionSettings[static::FUNCTION_SETTING_STATUS_LIST]
			];
	}

	/**
	 * Gives the exact time at which the process must be run next time
	 *
	 * @return \DateTime
	 * @throws \Exception
	 */
	public function GetNextOccurrence()
	{
		// Get module parameters and postpone next occurrence if function is disabled
		list ($bEnabled, $sPeriodicity) = $this->GetSetting();
		$oRet = new DateTime();
		if (!$bEnabled) {
			$sPeriodicity = '86400';
		}
		$oRet->modify($sPeriodicity.' seconds');

		return $oRet;
	}

	/**
	 * @inheritdoc
	 */
	public function Process($iUnixTimeLimit)
	{
		// Get module parameters and don't run the process if the module is disabled
		list ($bEnabled, $iPeriodicity, $aStatusList) = $this->GetSetting();
		if (!$bEnabled) {
			return 'Process being disabled for the time being, execution has not run.';
		}

		$aReport = array(
			'ipchecked' => 0,
		);

		CMDBObject::SetTrackInfo('Automatic - Background task to allocate IPs to production CIs');
		CMDBObject::SetTrackOrigin('custom-extension');

		// Get list of organizations for which IPs are allocated when attached to production CIs
		$oOrgToCleanSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o JOIN IPConfig AS ic ON ic.org_id = o.id WHERE ic.ip_allocate_on_ci_production = 'yes'"));
		if ($oOrgToCleanSet->Count() == 0) {
			$this->Trace('No organization has activated this feature. Exiting...');

			return '';
		}
		// Build list for OQL query
		$sOrgToCleanList = "";
		$i = 0;
		while ($oOrg = $oOrgToCleanSet->Fetch()) {
			if ($i++ == 0) {
				$sOrgToCleanList = "(".$oOrg->GetKey();
			} else {
				$sOrgToCleanList .= ", ".$oOrg->GetKey();
			}
		}
		$sOrgToCleanList .= ")";

		// 1st step: get list of status that trigger the allocation action
		$sStatusList = "";
		$i = 0;
		foreach ($aStatusList as $sStatus) {
			if ($i++ == 0) {
				$sStatusList = "('$sStatus'";
			} else {
				$sStatusList .= ", '$sStatus'";
			}
		}
		$sStatusList .= ")";

		// 2nd step: check IPs attached to production CIs with non allocated status
		$aClassesWithIPs = IPUtils::GetListOfClassesWithIPs();
		if (empty($aClassesWithIPs)) {
			$this->Trace('No CI has external keys toward IP Addresses');
		} else {
			// Retrieve and correct IPs attached to production CIs and that have wrong status
			foreach ($aClassesWithIPs as $sClass => $sKey) {
				$aIPAttributes = array_merge($sKey['IPAddress'], $sKey['IPv4Address'], $sKey['IPv6Address']);
				$sOQL = "";
				$i = 0;
				foreach ($aIPAttributes as $sAttribute) {
					$sOQLi = "SELECT IPAddress AS ip JOIN $sClass AS ci ON ci.$sAttribute = ip.id WHERE ip.status != 'allocated' AND ci.status IN $sStatusList AND ci.org_id IN $sOrgToCleanList";
					if ($i++ == 0) {
						$sOQL = $sOQLi;
					} else {
						$sOQL .= " UNION ".$sOQLi;
					}
				}

				// Correct IP status
				$oIPAddressSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL));
				while ((time() < $iUnixTimeLimit) && $oIPAddress = $oIPAddressSet->Fetch()) {
					try {
						$aReport['ipchecked']++;

						$oIPAddress->Set('status', 'allocated');
						$oIPAddress->Set('allocation_date', time());
						$oIPAddress->DBUpdate();
					} catch (Exception $e) {
						$this->Trace('Skipping IP check as there was an exception! ('.$e->getMessage().')');
					}
				}
			}
		}

		// 3rd step: check IPs attached to interfaces with non allocated status
		$sOQL = "SELECT IPAddress AS ip JOIN lnkIPInterfaceToIPAddress AS lnk ON lnk.ipaddress_id = ip.id JOIN PhysicalInterface AS p ON lnk.ipinterface_id = p.id JOIN ConnectableCI AS c ON p.connectableci_id = c.id WHERE c.status IN $sStatusList AND c.org_id IN $sOrgToCleanList AND ip.status != 'allocated'";
		if (class_exists('NetworkDeviceVirtualInterface')) {
			$sOQL .= " UNION SELECT IPAddress AS ip JOIN lnkIPInterfaceToIPAddress AS lnk ON lnk.ipaddress_id = ip.id JOIN NetworkDeviceVirtualInterface AS vi ON lnk.ipinterface_id = vi.id JOIN NetworkDevice AS n ON vi.networkdevice_id = n.id WHERE n.status IN $sStatusList AND n.org_id IN $sOrgToCleanList AND ip.status != 'allocated'";
		}
		if (class_exists('LogicalInterface')) {
			$sOQL .= " UNION SELECT IPAddress AS ip JOIN lnkIPInterfaceToIPAddress AS lnk ON lnk.ipaddress_id = ip.id JOIN LogicalInterface AS l ON lnk.ipinterface_id = l.id JOIN VirtualMachine AS v ON l.virtualmachine_id = v.id WHERE v.status IN $sStatusList AND v.org_id IN $sOrgToCleanList AND ip.status != 'allocated'";
		}

		// Correct IP status
		$oIPAddressSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL));
		while ((time() < $iUnixTimeLimit) && $oIPAddress = $oIPAddressSet->Fetch()) {
			try {
				$aReport['ipchecked']++;

				$oIPAddress->Set('status', 'allocated');
				$oIPAddress->Set('allocation_date', time());
				$oIPAddress->DBUpdate();
			} catch (Exception $e) {
				$this->Trace('Skipping IP check as there was an exception! ('.$e->getMessage().')');
			}
		}

		// Info to help understand why not all objects have been processed during this batch.
		if (time() >= $iUnixTimeLimit) {
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
		if ($this->bDebug) {
			echo $sMessage."\n";
		}
	}
}
