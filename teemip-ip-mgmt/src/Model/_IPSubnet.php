<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Model;

use IPConfig;
use IPObject;
use iTopWebPage;
use utils;
use WebPage;

class _IPSubnet extends IPObject
{
	/**
	 * Returns size of subnet
	 *
	 * @return int
	 */
	public function GetSize()
	{
		return 1;
	}

	/**
	 * Return % of occupancy of objects linked to $this
	 *
	 * @param $sObject
	 *
	 * @return int
	 */
	public function GetOccupancy($sObject)
	{
		return 0;
	}

	/**
	 * Return next operation after current one
	 *
	 * @param $sOperation
	 *
	 * @return string
	 */
	public function GetNextOperation($sOperation)
	{
		switch ($sOperation) {
			case 'findspace':
				return 'dofindspace';
			case 'dofindspace':
				return 'findspace';

			case 'listips':
				return 'dolistips';
			case 'dolistips':
				return 'listips';

			case 'shrinksubnet':
				return 'doshrinksubnet';
			case 'doshrinksubnet':
				return 'shrinksubnet';

			case 'splitsubnet':
				return 'dosplitsubnet';
			case 'dosplitsubnet':
				return 'splitsubnet';

			case 'expandsubnet':
				return 'doexpandsubnet';
			case 'doexpandsubnet':
				return 'expandsubnet';

			case 'csvexportips':
				return 'docsvexportips';
			case 'docsvexportips':
				return 'csvexportips';

			case 'calculator':
				return 'docalculator';
			case 'docalculator':
				return 'calculator';

			default:
				return '';
		}
	}

	/**
	 * Get parameters used for operation
	 *
	 * @param $sOperation
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function GetPostedParam($sOperation)
	{
		$aParam = array();
		switch ($sOperation) {
			case 'dofindspace':
				$aParam['spacesize'] = utils::ReadPostedParam('spacesize', '', 'raw_data');
				$aParam['maxoffer'] = utils::ReadPostedParam('maxoffer', 'DEFAULT_MAX_FREE_SPACE_OFFERS', 'raw_data');
				$aParam['status_subnet'] = '';
				$aParam['type'] = '';
				$aParam['location_id'] = '';
				$aParam['requestor_id'] = '';
				break;

			case 'dolistips':
				$aParam['first_ip'] = filter_var(utils::ReadPostedParam('attr_firstip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['last_ip'] = filter_var(utils::ReadPostedParam('attr_lastip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['status_ip'] = $this->GetDefaultValueAttribute('status');
				$aParam['short_name'] = '';
				$aParam['domain_id'] = '';
				$aParam['usage_id'] = '';
				$aParam['requestor_id'] = '';
				break;

			case 'doshrinksubnet':
			case 'dosplitsubnet':
			case 'doexpandsubnet':
				$aParam['scale'] = utils::ReadPostedParam('scale', '', 'raw_data');
				$aParam['requestor_id'] = utils::ReadPostedParam('attr_requestor_id', null);
				break;

			case 'docsvexportips':
				$aParam['first_ip'] = filter_var(utils::ReadPostedParam('attr_firstip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['last_ip'] = filter_var(utils::ReadPostedParam('attr_lastip', '', 'raw_data'), FILTER_VALIDATE_IP);
				break;

			case 'docalculator':
				$aParam['ip'] = filter_var(utils::ReadPostedParam('attr_ip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['mask'] = filter_var(utils::ReadPostedParam('attr_gatewayip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['cidr'] = filter_var(utils::ReadPostedParam('cidr', '', 'raw_data'), FILTER_VALIDATE_INT);
				break;

			default:
				break;
		}

		return $aParam;
	}

	/**
	 * Provides attributes' parameters
	 *
	 * @param $sAttCode
	 *
	 * @return array
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function GetAttributeParams($sAttCode)
	{
		$aParams = array();
		if (($sAttCode == 'ip_occupancy') || ($sAttCode == 'range_occupancy')) {
			if ($sAttCode == 'ip_occupancy') {
				$Occupancy = $this->GetOccupancy('IPAddress');
			} else {
				$Occupancy = $this->GetOccupancy('IPRange');
			}
			$sOrgId = $this->Get('org_id');
			if ($sOrgId != null) {
				$sLowWaterMark = IPConfig::GetFromGlobalIPConfig('subnet_low_watermark', $sOrgId);
				$sHighWaterMark = IPConfig::GetFromGlobalIPConfig('subnet_high_watermark', $sOrgId);
				if ($Occupancy >= $sHighWaterMark) {
					$sColor = RED;
				} else {
					if ($Occupancy >= $sLowWaterMark) {
						$sColor = YELLOW;
					} else {
						$sColor = GREEN;
					}
				}
				$aParams ['value'] = round($Occupancy, 0);
				$aParams ['color'] = $sColor;
			} else {
				$aParams ['value'] = 0;
				$aParams ['color'] = GREEN;
			}
		} else {
			$aParams ['value'] = 0;
			$aParams ['color'] = GREEN;
		}

		return ($aParams);
	}

	/**
	 * Count number of IPs in subnet, in given status
	 *
	 * @param $sStatus
	 *
	 * @return int
	 */
	public function IPCount($sStatus)
	{
		return 0;
	}

	/**
	 * Automatically get a free IP in the subnet
	 *
	 * @param $iCreationOffset
	 *
	 * @return string
	 */
	public function GetFreeIP($iCreationOffset)
	{
		return '';
	}

	/**
	 * @inheritdoc
	 */
	public function OnInsert()
	{
		parent::OnInsert();

		if (class_exists('IPDiscovery')) {
			if ($this->Get('ipdiscovery_ping_enabled') == 'no') {
				$this->Set('ping_enabled', 'no');
			}
			if ($this->Get('ipdiscovery_iplookup_enabled') == 'no') {
				$this->Set('iplookup_enabled', 'no');
			}
			if ($this->Get('ipdiscovery_scan_enabled') == 'no') {
				$this->Set('scan_enabled', 'no');
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	public function OnUpdate()
	{
		parent::OnUpdate();

		if (class_exists('IPDiscovery')) {
			if ($this->Get('ipdiscovery_ping_enabled') == 'no') {
				$this->Set('ping_enabled', 'no');
			}
			if ($this->Get('ipdiscovery_iplookup_enabled') == 'no') {
				$this->Set('iplookup_enabled', 'no');
			}
			if ($this->Get('ipdiscovery_scan_enabled') == 'no') {
				$this->Set('scan_enabled', 'no');
			}
		}
	}

	/**
	 * @inheritDoc
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		$sFlagsFromParent = parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);

		switch ($sAttCode) {
			case 'org_id':
			case 'last_discovery_date':
			case 'ping_duration':
			case 'ping_discovered':
			case 'iplookup_duration':
			case 'iplookup_discovered':
			case 'scan_duration':
			case 'scan_discovered':
			case 'reserve_subnet_ips':
				return (OPT_ATT_READONLY | $sFlagsFromParent);

			default:
				break;
		}

		return $sFlagsFromParent;
	}

	/**
	 * @inheritDoc
	 */
	public function GetInitialStateAttributeFlags($sAttCode, &$aReasons = array())
	{
		$sFlagsFromParent = parent::GetInitialStateAttributeFlags($sAttCode, $aReasons);

		switch ($sAttCode) {
			case 'last_discovery_date':
			case 'ping_duration':
			case 'ping_discovered':
			case 'iplookup_duration':
			case 'iplookup_discovered':
			case 'scan_duration':
			case 'scan_discovered':
				return (OPT_ATT_HIDDEN | $sFlagsFromParent);

			default:
				break;
		}

		return $sFlagsFromParent;
	}

	/**
	 * Display result of IPvi calculator
	 *
	 * @param \iTopWebPage $oP
	 * @param $aParam
	 *
	 * @throws \ApplicationException
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function DisplayCalculatorOutput(iTopWebPage $oP, $aParam)
	{
		$this->DisplayBareTab($oP, 'UI:IPManagement:Action:DoCalculator:');
		$oP->add($this->GetCalculatorOutput($oP, $aParam));
	}

	/**
	 * Get result of IPvi calculator
	 *
	 * @param \WebPage $oP
	 * @param $aParam
	 *
	 * @return string
	 */
	public function GetCalculatorOutput(WebPage $oP, $aParam)
	{
		return '';
	}

	/**
	 * Display all IPs in CSV format
	 *
	 * @param \iTopWebPage $oP
	 * @param $aParam
	 *
	 * @throws \ApplicationException
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function DisplayIPsAsCSV(iTopWebPage $oP, $aParam)
	{
		$this->DisplayBareTab($oP, 'UI:IPManagement:Action:CsvExportIps:');
		$sHtml = $this->GetIPsAsCSV($aParam);
		$oP->add(<<<HTML
			<div id="listipscsv" class="ibo-is-code">
			{$sHtml}
			</div>
HTML
		);
	}

	/**
	 * @param \iTopWebPage $oP
	 * @param $aParam
	 *
	 * @throws \ApplicationException
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function DoListIps(iTopWebPage $oP, $aParam)
	{
		$this->DisplayBareTab($oP, 'UI:IPManagement:Action:ListIps:');
		$oP->add($this->GetListIps($oP, $aParam));
	}

	/**
	 * Displays list of IP addresses within GUI
	 *
	 * @param \WebPage $oP
	 * @param $aParam
	 *
	 * @return string
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 *
	 */
	protected function GetListIps(WebPage $oP, $aParam)
	{
		return '';
	}

	/**
	 * Displays available space
	 *
	 * @param \iTopWebPage $oP
	 * @param $iChangeId
	 * @param $aParameter
	 *
	 * @throws \ApplicationException
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function DoDisplayAvailableSpace(iTopWebPage $oP, $iChangeId, $aParameter)
	{
		$sHtml = $this->GetAvailableSpace($oP, $iChangeId, $aParameter);
		$this->DisplayBareTab($oP, 'UI:IPManagement:Action:DoFindSpace:');
		$oP->add($sHtml);
	}

	/**
	 * Displays available space
	 *
	 * @param \WebPage $oP
	 * @param $iChangeId
	 * @param $aParam
	 *
	 * @return string
	 */
	protected function GetAvailableSpace(WebPage $oP, $iChangeId, $aParam)
	{
		return '';
	}

	/**
	 *  Get list of IPs for CSV display
	 *
	 * @param $aParam
	 *
	 * @return string
	 */
	protected function GetIPsAsCSV($aParam)
	{
		return '';
	}

	/**
	 * Check if given FQDN can be expoded
	 *
	 * @$sFqdnAttr FQDN attribute that should be exploded
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function DoCheckToExplodeFQDN($sFqdnAttr)
	{

		return '';
	}

	/**
	 * Explode FQDN
	 *
	 * @$sFqdnAttr FQDN attribute that should be exploded
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \Exception
	 */
	public function DoExplodeFQDN($sFqdnAttr)
	{
	}

	/**
	 * @inheritdoc
	 */
	public static function GetShortcutActions($sFinalClass)
	{
		// Prepend the shortcut actions with the navigation menu
		$aNavigationActions = ['previous_ipsubnet', 'next_ipsubnet'];
		$aConfiguredActions = parent::GetShortcutActions($sFinalClass);
		$aShortcutActions = array_merge($aNavigationActions, $aConfiguredActions);

		return $aShortcutActions;
	}

	/**
	 * Get the previous Subnet if it exists
	 *
	 * @param bool $bInBlock if lookup should be done in subnet's block only
	 *
	 * @return null
	 */
	public function GetPreviousSubnet($bInBlock)
	{
		return null;
	}

	/**
	 * Get the next Subnet if it exists
	 *
	 * @param $bInBlock true if lookup should be done in subnet's block only
	 *
	 * @return null
	 */
	public function GetNextSubnet($bInBlock)
	{
		return null;
	}

}
