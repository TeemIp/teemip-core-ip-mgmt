<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Hook;

use CMDBObject;
use CMDBObjectSet;
use DateTime;
use DBObjectSearch;
use Exception;
use IPConfig;
use iScheduledProcess;
use MetaModel;

class HandleIPWaterMarks implements iScheduledProcess {
	const MODULE_CODE = 'teemip-ip-mgmt';
	const FUNCTION_CODE = 'handle_ip_watermarks';
	const FUNCTION_SETTING_ENABLED = 'enabled';
	const FUNCTION_SETTING_DEBUG = 'debug';
	const FUNCTION_SETTING_PERIODICITY = 'periodicity';
	const FUNCTION_SETTING_TARGET_CLASSES = 'target_classes';

	const DEFAULT_FUNCTION_SETTING_ENABLED = true;
	const DEFAULT_FUNCTION_SETTING_DEBUG = false;
	const DEFAULT_FUNCTION_SETTING_PERIODICITY = 86400;
	const DEFAULT_FUNCTION_SETTING_TARGET_CLASSES = array('IPv4Subnet', 'IPv4Range');

	protected $aDefaultSettings = array();
	protected $bDebug;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->aDefaultSettings = array(
			static::FUNCTION_SETTING_ENABLED => static::DEFAULT_FUNCTION_SETTING_ENABLED,
			static::FUNCTION_SETTING_DEBUG => static::DEFAULT_FUNCTION_SETTING_DEBUG,
			static::FUNCTION_SETTING_PERIODICITY => static::DEFAULT_FUNCTION_SETTING_PERIODICITY,
			static::FUNCTION_SETTING_TARGET_CLASSES => static::DEFAULT_FUNCTION_SETTING_TARGET_CLASSES,
		);
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $this->aDefaultSettings);
		$this->bDebug = (bool)$aFunctionSettings[static::FUNCTION_SETTING_DEBUG];
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
			$aFunctionSettings[static::FUNCTION_SETTING_TARGET_CLASSES]
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
		$oRet->modify('+'.$sPeriodicity.' seconds');

		return $oRet;
	}

	/**
	 * @inheritdoc
	 */
	public function Process($iUnixTimeLimit)
	{
		// Get module parameters and don't run the process if the module is disabled
		list ($bEnabled, $iPeriodicity, $aTargetClasses) = $this->GetSetting();
		if (!$bEnabled) {
			return 'Process being disabled for the time being, execution has not run.';
		}

		$aReport = array(
			'reached_watermark' => 0,
		);

		CMDBObject::SetTrackInfo('Automatic - Background task to handle IP watermarks in subnets and ranges');
		CMDBObject::SetTrackOrigin('custom-extension');

		// Process each object of each target class
		foreach ($aTargetClasses as $sTargetClass) {
			if ((time() < $iUnixTimeLimit) && (in_array($sTargetClass, array('IPv4Subnet', 'IPv4Range', 'IPv6Range')))) {
				$oTargetObjectSet = new CMDBObjectSet((DBObjectSearch::FromOQL('SELECT '.$sTargetClass)));
				while ((time() < $iUnixTimeLimit) && ($oTargetObject = $oTargetObjectSet->Fetch())) {
					// Catching exceptions so the process don't get stucked on this object
					try {
						$iOrgId = $oTargetObject->Get('org_id');
						if (in_array($sTargetClass, array('IPv4Subnet'))) {
							// Skip subnets which are too small
							if ($oTargetObject->GetSize() <= 4) {
								continue;
							}
							$iLowWaterMark = IPConfig::GetFromGlobalIPConfig('subnet_low_watermark', $iOrgId);
							$iHighWaterMark = IPConfig::GetFromGlobalIPConfig('subnet_high_watermark', $iOrgId);
							$iOccupancy = $oTargetObject->GetOccupancy('IPv4Address');
						} else {
							$iLowWaterMark = IPConfig::GetFromGlobalIPConfig('iprange_low_watermark', $iOrgId);
							$iHighWaterMark = IPConfig::GetFromGlobalIPConfig('iprange_high_watermark', $iOrgId);
							$iOccupancy = $oTargetObject->GetOccupancy();
						}
						$sAlarm = $oTargetObject->Get('alarm_water_mark');
						if ($iOccupancy >= $iHighWaterMark) {
							// If no HWM alarm sent yet, generate event: objet = $oTargetObject, reason = HWM crossed
							if ($sAlarm != 'high_sent') {
								$oTargetObject->Set('alarm_water_mark', 'high_sent');
								$oTargetObject->DBUpdate();
								$sOQL = "SELECT IPTriggerOnWaterMark AS t WHERE t.target_class = :target_class AND t.event = 'cross_high' AND t.org_id = :org_id";
								$oTriggerSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('target_class' => $sTargetClass, 'org_id' => $iOrgId));
								while ($oTrigger = $oTriggerSet->Fetch()) {
									$oTrigger->DoActivate($oTargetObject->ToArgs('this'));
								}
								$aReport['reached_watermark']++;
							}
						} elseif ($iOccupancy >= $iLowWaterMark) {
							// If no LWM alarm sent yet, generate event: objet = $oTargetObject, reason = LWM crossed
							if ($sAlarm != 'no_alarm') {
								$oTargetObject->Set('alarm_water_mark', 'low_sent');
								$oTargetObject->DBUpdate();
								$sOQL = "SELECT IPTriggerOnWaterMark AS t WHERE t.target_class = :target_class AND t.event = 'cross_low' AND t.org_id = :org_id";
								$oTriggerSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('target_class' => $sTargetClass, 'org_id' => $iOrgId));
								while ($oTrigger = $oTriggerSet->Fetch()) {
									$oTrigger->DoActivate($oTargetObject->ToArgs('this'));
								}
								$aReport['reached_watermark']++;
							}
						}
					} // Trigger was NOT applied because of an exception, which is NOT normal
					catch (Exception $e) {
						$aReport['not_triggered'][] = $oTargetObject->Get('friendlyname');
						$this->Trace('|  |- [KO] /!\\ '.$sTargetClass.' #'.$oTargetObject->GetKey().' exception raised! Error message: '.$e->getMessage());
					}
				}
			} else {
				$this->Trace('Target class '.$sTargetClass.' is not elligible for watermarks. Skipping...');
			}
		}

		// Info to help understand why not all objects have been processed during this batch.
		if (time() >= $iUnixTimeLimit) {
			$this->Trace('Stopped because time limit exceeded!');
		}

		// Report
		$sReport = ($aReport['reached_watermark'] === 0) ? "\nNo watermarks have been crossed.\n" : "\n".$aReport['reached_watermark']." watermarks have been crossed.\n";

		return $sReport;
	}

	/**
	 * Prints a $sMessage in the CRON output.
	 *
	 * @param string $sMessage
	 */
	protected function Trace($sMessage) {
		if ($this->bDebug) {
			echo $sMessage."\n";
		}
	}
}
