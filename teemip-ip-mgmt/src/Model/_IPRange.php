<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Model;

use Dict;
use IPConfig;
use IPObject;
use iTopWebPage;
use utils;
use WebPage;

class _IPRange extends IPObject {
	/**
	 * Returns size of range
	 *
	 * @return int
	 */
	public function GetSize() {
		return 1;
	}

	/**
	 * Check if operation is feasible on current object
	 *
	 * @param $sOperation
	 *
	 * @return string
	 */
	function DoCheckOperation($sOperation) {
		switch ($sOperation) {
			case 'listips':
			case 'csvexportips':
				return ('');

			default:
				return ('OperationNotAllowed');
		}
	}

	/**
	 * Return next operation after current one
	 *
	 * @param $sOperation
	 *
	 * @return string
	 */
	function GetNextOperation($sOperation) {
		switch ($sOperation) {
			case 'listips':
				return 'dolistips';
			case 'dolistips':
				return 'listips';

			case 'csvexportips':
				return 'docsvexportips';
			case 'docsvexportips':
				return 'csvexportips';

			default:
				return '';
		}
	}

	/**
	 * @inheritdoc
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '') {
		$sFlagsFromParent = parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
		$aReadOnlyAttributes = array('org_id', 'occupancy');

		if (in_array($sAttCode, $aReadOnlyAttributes)) {
			return (OPT_ATT_READONLY | $sFlagsFromParent);
		}

		return $sFlagsFromParent;
	}

	/**
	 * Get parameters used for operation
	 *
	 * @param $sOperation
	 *
	 * @return array
	 * @throws \Exception
	 */
	function GetPostedParam($sOperation) {
		$aParam = array();
		switch ($sOperation) {
			case 'dolistips':
				$aParam['first_ip'] = filter_var(utils::ReadPostedParam('attr_firstip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['last_ip'] = filter_var(utils::ReadPostedParam('attr_lastip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['status_ip'] = $this->GetDefaultValueAttribute('status');
				$aParam['short_name'] = '';
				$aParam['domain_id'] = '';
				$aParam['usage_id'] = '';
				$aParam['requestor_id'] = '';
				break;

			case 'docsvexportips':
				$aParam['first_ip'] = filter_var(utils::ReadPostedParam('attr_firstip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['last_ip'] = filter_var(utils::ReadPostedParam('attr_lastip', '', 'raw_data'), FILTER_VALIDATE_IP);
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
	public function GetAttributeParams($sAttCode) {
		$aParams = array();
		if ($sAttCode == 'occupancy') {
			$Occupancy = $this->GetOccupancy();
			$sOrgId = $this->Get('org_id');
			if ($sOrgId != null) {
				$sLowWaterMark = IPConfig::GetFromGlobalIPConfig('iprange_low_watermark', $sOrgId);
				$sHighWaterMark = IPConfig::GetFromGlobalIPConfig('iprange_high_watermark', $sOrgId);
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
	 * Automatically get a free IP in the range
	 *
	 * @param $iCreationOffset
	 *
	 * @return string
	 */
	public function GetFreeIP($iCreationOffset) {
		return '';
	}

	/**
	 * @inheritdoc
	 */
	public function DisplayBareRelations(WebPage $oPage, $bEditMode = false) {
		// Execute parent function first
		parent::DisplayBareRelations($oPage, $bEditMode);

		if ($this->Get('dhcp') == 'dhcp_no') {
			$oCIsSet = $this->Get('functionalcis_list');
			if ($oCIsSet->Count() == 0) {
				// Remove tab related to DHCP servers
				//  Two following lines to be reactivated once FindTab is corrected
				//      $sPattern = '/^'.Dict::S('Class:IPRange/Attribute:functionalcis_list').'/';
				//      $sTabName = $oPage->FindTab($sPattern);
				$sTabName = 'Class:'.get_class($this).'/Attribute:functionalcis_list';

                /** @var \iTopWebPage $oPage */
                $oPage->RemoveTab($sTabName);
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	public function DoCheckToWrite() {
		parent::DoCheckToWrite();

		// Make sure no server is set in servers_list if range is not a DHCP one
		if ($this->Get('dhcp') == 'dhcp_no') {
			$oServersSet = $this->Get('functionalcis_list');
			if ($oServersSet->Count() > 0) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Update:IPRange:NonDHCPRangeWithServers');
			}

		}
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
	public function DoListIps(iTopWebPage $oP, $aParam) {
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
	protected function GetListIps(WebPage $oP, $aParam) {
		return '';
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
	public function DisplayIPsAsCSV(iTopWebPage $oP, $aParam) {
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
	 *  Get list of IPs for CSV display
	 *
	 * @param $aParam
	 *
	 * @return string
	 */
	protected function GetIPsAsCSV($aParam) {
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
	public function DoCheckToExplodeFQDN($sFqdnAttr) {

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
	public function DoExplodeFQDN($sFqdnAttr) {
	}

	/**
	 * @inheritdoc
	 */
	public static function GetShortcutActions($sFinalClass)
	{
		// Prepend the shortcut actions with the navigation menu
		$aNavigationActions = ['previous_iprange', 'next_iprange'];
		$aConfiguredActions = parent::GetShortcutActions($sFinalClass);
		$aShortcutActions = array_merge($aNavigationActions, $aConfiguredActions);

		return $aShortcutActions;
	}

	/**
	 * Get the previous Range if it exists
	 *
	 * @param bool $bInSubnet if lookup should be done in subnet only
	 *
	 * @return null
	 */
	public function GetPreviousRange($bInSubnet)
	{
		return null;
	}

	/**
	 * Get the next Range if it exists
	 *
	 * @param $bInSubnet true if lookup should be done in subnet only
	 *
	 * @return null
	 */
	public function GetNextRange($bInSubnet)
	{
		return null;
	}

}