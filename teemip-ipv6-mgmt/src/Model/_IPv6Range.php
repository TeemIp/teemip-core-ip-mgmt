<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPv6Management\Model;

use cmdbAbstractObject;
use CMDBObjectSet;
use Combodo\iTop\Application\UI\Base\Component\Field\FieldUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\Column\Column;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\MultiColumn;
use DBObjectSearch;
use Dict;
use IPRange;
use iTopWebPage;
use MetaModel;
use TeemIp\TeemIp\Extension\Framework\Helper\IPUtils;
use UserRights;
use utils;
use WebPage;

/**
 * Class _IPv6Range
 */
class _IPv6Range extends IPRange {
	/**
	 * Return standard icon or extra small one
	 *
	 * @param bool $bImgTag
	 * @param false $bXsIcon
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function GetMultiSizeIcon($bImgTag = true, $bXsIcon = false) {
		if ($bXsIcon) {
			$sIcon = utils::GetAbsoluteUrlModulesRoot().'teemip-ipv6-mgmt/asset/img/ipv6range-xs.png';

			return ("<img src=\"$sIcon\" style=\"vertical-align:middle;\" alt=\"\"/>");
		}

		return $this->GetIcon($bImgTag);
	}

	/**
	 * @inheritdoc
	 */
	public function GetSize() {
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');
		$iSize = $oFirstIp->GetSizeInterval($oLastIp);

		return $iSize;
	}

	/**
	 * Compute % of IP addresses registered in data base in IP range
	 *
	 * @return float|int
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public function GetOccupancy() {
		$iOrgId = $this->Get('org_id');
		$sFirstIp = $this->Get('firstip')->GetAsCannonical();
		$sLastIp = $this->Get('lastip')->GetAsCannonical();

		$iSize = $this->GetSize();
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id", array(
			'firstip' => $sFirstIp,
			'lastip' => $sLastIp,
			'org_id' => $iOrgId,
		)));

		return ($oIpRegisteredSet->Count() / $iSize) * 100;
	}

	/**
	 * Automatically get a free IP in the range
	 *
	 * @param $iCreationOffset
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \OQLException
	 */
	public function GetFreeIP($iCreationOffset) {
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');
		if ($iCreationOffset > $oFirstIp->GetSizeInterval($oLastIp)) {
			return '';
		}

		// Get list of registered IPs
		$iKey = $this->GetKey();
		$oIPRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS ip WHERE ip.range_id = :key"), array(), array('key' => $iKey));
		$aIPRegistered = $oIPRegisteredSet->GetColumnAsArray('ip', false);

		for ($i = 0; $i < $iCreationOffset; $i++) {
			$oFirstIp = $oFirstIp->GetNextIp();
		}
		$oAnIp = $oFirstIp;
		while ($oAnIp->IsSmallerStrict($oLastIp)) {
			if (!in_array($oAnIp, $aIPRegistered)) {
				return $oAnIp->GetAsCompressed();
			}
			$oAnIp = $oAnIp->GetNextIp();
		}

		return '';
	}

	/**
	 * List IP addresses in IP range in CSV format
	 *
	 * @param $aParam
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	protected function GetIPsAsCSV($aParam) {
		// Define first and last IPs to display
		$sFirstIp = $aParam['first_ip'];
		$oFirstIpRange = $this->Get('firstip');
		if ($sFirstIp == '') {
			$oFirstIp = $oFirstIpRange;
		} else {
			$oFirstIp = new ormIPv6($sFirstIp);
		}
		$sLastIp = $aParam['last_ip'];
		$oLastIpRange = $this->Get('lastip');
		if ($sLastIp == '') {
			$oLastIp = $oLastIpRange;
		} else {
			$oLastIp = new ormIPv6($sLastIp);
		}

		// Get list of registered IPs in range
		$iOrgId = $this->Get('org_id');
		$sFirstIp = $oFirstIp->GetAsCannonical();
		$sLastIp = $oLastIp->GetAsCannonical();
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id", array(
			'firstip' => $sFirstIp,
			'lastip' => $sLastIp,
			'org_id' => $iOrgId,
		)));

		// Set CRLF format according to version
		$sCrLf = (version_compare(ITOP_DESIGN_LATEST_VERSION, 3.0) < 0) ? "\n" : "<br>";

		// List exported parameters
		$sHtml = "Registered,Id";
		$aParam = array('org_name', 'ip', 'status', 'fqdn', 'usage_name', 'comment', 'requestor_name', 'release_date');
		foreach ($aParam as $sAttCode) {
			$sHtml .= ','.MetaModel::GetLabel('IPv6Address', $sAttCode);
		}
		$sHtml .= $sCrLf;

		// List all IPs of range now in IP order 
		$aIpRegistered = $oIpRegisteredSet->GetColumnAsArray('ip', false);
		$oAnIp = $oFirstIp;
		while ($oAnIp->IsSmallerOrEqual($oLastIp)) {
			if (!in_array($oAnIp, $aIpRegistered)) {
				$sHtml .= "no,,,".$oAnIp->GetAsCompressed().",free,,,,,,,";
			} else {
				$oIpRegisteredSet->Rewind();
				$oIpRegistered = $oIpRegisteredSet->Fetch();
				while (!$oAnIp->IsEqual($oIpRegistered->Get('ip'))) {
					$oIpRegistered = $oIpRegisteredSet->Fetch();
				}
				$sHtml .= "yes,".$oIpRegistered->GetKey().",";
				$sHtml .= $oIpRegistered->Get('org_id').",";
				$sHtml .= $oIpRegistered->Get('ip')->GetAsCompressed().",";
				$sHtml .= $oIpRegistered->Get('status').",";
				$sHtml .= $oIpRegistered->Get('fqdn').",";
				$sHtml .= $oIpRegistered->Get('usage_name').",";
				$sHtml .= $oIpRegistered->Get('comment').",";
				$sHtml .= $oIpRegistered->Get('requestor_name').",";
				$sHtml .= $oIpRegistered->Get('release_date');
			}
			$sHtml .= $sCrLf;
			$oAnIp = $oAnIp->GetNextIp();
		}

		return ($sHtml);
	}

	/**
	 * Check if IP is in range
	 *
	 * @param $oIp
	 *
	 * @return bool
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	function DoCheckIpInRange($oIp) {
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');
		if ($oFirstIp->IsSmallerOrEqual($oIp) && $oIp->IsSmallerOrEqual($oLastIp)) {
			return true;
		}

		return false;
	}

	/**
	 * Check if IPs can be listed
	 *
	 * @param $aParam
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	function DoCheckToListIps($aParam) {
		$oFirstIpRange = $this->Get('firstip');
		$oLastIpRange = $this->Get('lastip');

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '') {
			$oFirstIp = new ormIPv6($sFirstIp);
			if ($oFirstIp->IsSmallerStrict($oFirstIpRange) || $oLastIpRange->IsSmallerStrict($oFirstIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Range:FirstIPOutOfRange'));
			}
		}

		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '') {
			$oLastIp = new ormIPv6($sLastIp);
			if ($oLastIp->IsSmallerStrict($oFirstIpRange) || $oLastIpRange->IsSmallerStrict($oLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Range:LastIPOutOfRange'));
			}
		}

		if (($sFirstIp != '') && ($sLastIp != '')) {
			if ($oFirstIp->IsBiggerStrict($oLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Range:FirstIpBiggerThanLastIp'));
			}
		}

		return '';
	}

	/**
	 * @inheritdoc
	 */
	function GetListIps(WebPage $oP, $aParam) {
		// Define first and last IPs to display
		$sFirstIp = $aParam['first_ip'];
		$oFirstIpRange = $this->Get('firstip');
		if ($sFirstIp == '') {
			$oFirstIp = $oFirstIpRange;
		} else {
			$oFirstIp = new ormIPv6($sFirstIp);
		}
		$bPrintDummyFirstLine = $oFirstIp->IsEqual($oFirstIpRange) ? false : true;
		$sLastIp = $aParam['last_ip'];
		$oLastIpRange = $this->Get('lastip');
		if ($sLastIp == '') {
			$oLastIp = $oLastIpRange;
		} else {
			$oLastIp = new ormIPv6($sLastIp);
		}
		$bPrintDummyLastLine = $oLastIp->IsEqual($oLastIpRange) ? false : true;

		// Get list of registered IPs in range
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$sFirstIp = $oFirstIp->GetAsCannonical();
		$sLastIp = $oLastIp->GetAsCannonical();
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id", array(
			'firstip' => $sFirstIp,
			'lastip' => $sLastIp,
			'org_id' => $iOrgId,
		)));
		$aIpRegistered = $oIpRegisteredSet->GetColumnAsArray('ip', false);

		// Preset display of name and range attributes
		$sHtml = "&nbsp;[".$this->GetAsHTML('firstip')." - ".$this->GetAsHTML('lastip')."]";

		$iSubnetId = $this->Get('subnet_id');
		$sStatusIp = $aParam['status_ip'];
		$sShortName = $aParam['short_name'];
		$iDomainId = $aParam['domain_id'];
		$iUsageId = $aParam['usage_id'];
		$iRequestorId = $aParam['requestor_id'];

		$oAnIp = $oFirstIp;
		$iVIdCounter = 1;

		// Check user rights
		$UserHasRightsToCreate = (UserRights::IsActionAllowed('IPv6Address', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;

		// Open table
		$sHtml = '<table style="width:100%"><tr><td colspan="2">';
		$sHtml .= '<div style="vertical-align:top;" id="tree">';

		// Display first IP
		$sHtml .= "<ul>\n";
		$sHtml .= "<li>".$this->GetHyperlink()."&nbsp;[".$this->GetAsHTML('firstip')." - ".$this->GetAsHTML('lastip')."]<ul>";

		// ... and dummy line if display doesn't start at first IP
		if ($bPrintDummyFirstLine) {
			$sHtml .= "<li>&nbsp;&nbsp;...&nbsp;//&nbsp;... </li>";
		}

		// Display other IPs as list
		while ($oAnIp->IsSmallerOrEqual($oLastIp)) {
			if (in_array($oAnIp, $aIpRegistered)) {
				// Found registered IP
				$oIpRegisteredSet->Rewind();
				$oIpRegistered = $oIpRegisteredSet->Fetch();
				while (!$oAnIp->IsEqual($oIpRegistered->Get('ip'))) {
					$oIpRegistered = $oIpRegisteredSet->Fetch();
				}
				$sHtml .= "<li>".$oIpRegistered->GetHyperlink()."&nbsp;&nbsp; - ".$oIpRegistered->GetAsHTML('status')."&nbsp;&nbsp; - ".$oIpRegistered->Get('fqdn');
			} else {
				// If user has rights to create IPs
				// Display unregistered IP with icon to create it
				if ($UserHasRightsToCreate) {
					$iVId = $iVIdCounter++;
					$sHtml .= "<li><div><span id=\"v_{$iVId}\">";
					$sHtml .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/asset/img/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
					$sHtml .= "&nbsp;".$oAnIp->GetAsCompressed()."&nbsp;&nbsp;";
					$sHtml .= "</span></div>";
					$oP->add_ready_script(
						<<<EOF
					oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv6Address', '', 0, {'org_id': '$iOrgId', 'subnet_id': '$iSubnetId', 'range_id': '$iId', 'ip': '$oAnIp', 'status': '$sStatusIp', 'short_name': '$sShortName', 'domain_id': '$iDomainId', 'usage_id': '$iUsageId', 'requestor_id': '$iRequestorId'});
EOF
					);
				} else {
					$sHtml .= "<li>".$oAnIp->GetAsCompressed();
				}
			}
			$sHtml .= "</li>";
			$oAnIp = $oAnIp->GetNextIp();
		}

		// Add dummy line if display doesn't finish at broadcast IP
		if ($bPrintDummyLastLine) {
			$sHtml .= "<li>&nbsp;&nbsp;...&nbsp;//&nbsp;... </li>";
		}
		$sHtml .= "</ul></li></ul>";

		// Close table
		$sHtml .= '</div>';
		$sHtml .= '</td></tr></table>';
		if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.0', '<')) {
			$sHtml .= '</div>';         // ??
		}
		$oP->add_ready_script("\$('#tree ul').treeview();\n");
		$oP->add_dict_entry('UI:ValueMustBeSet');
		$oP->add_dict_entry('UI:ValueMustBeChanged');
		$oP->add_dict_entry('UI:ValueInvalidFormat');

		return $sHtml;
	}

	/**
	 * Check if IPs can be exported in CSV
	 *
	 * @param $aParam
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	function DoCheckToCsvExportIps($aParam) {
		$oFirstIpRange = $this->Get('firstip');
		$oLastIpRange = $this->Get('lastip');

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '') {
			$oFirstIp = new ormIPv6($sFirstIp);
			if ($oFirstIp->IsSmallerStrict($oFirstIpRange) || $oLastIpRange->IsSmallerStrict($oFirstIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Range:FirstIPOutOfRange'));
			}
		}

		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '') {
			$oLastIp = new ormIPv6($sLastIp);
			if ($oLastIp->IsSmallerStrict($oFirstIpRange) || $oLastIpRange->IsSmallerStrict($oLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Range:LastIPOutOfRange'));
			}
		}

		if (($sFirstIp != '') && ($sLastIp != '')) {
			if ($oFirstIp->IsBiggerStrict($oLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Range:FirstIpBiggerThanLastIp'));
			}
		}

		return '';
	}

	/**
	 * @inheritdoc
	 */
	protected function DisplayActionFieldsForOperation(iTopWebPage $oP, $sOperation, $iFormId, $aDefault) {
		$oP->add("<table>");
		$oP->add('<tr><td style="vertical-align:top">');

		switch ($sOperation) {
			case 'listips':
			case 'csvexportips':
				if ($sOperation == 'listips') {
					$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:ListIps:IPv6Range:FirstIP');
					$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:ListIps:IPv6Range:LastIP');

					// Sub title
					$oP->add("<b>".Dict::S('UI:IPManagement:Action:ListIps:IPv6Range:Subtitle_ListRange')."</b>\n");
				} else {
					$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:CsvExportIps:IPv6Range:FirstIP');
					$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:CsvExportIps:IPv6Range:LastIP');

					// Sub title
					$oP->add("<b>".Dict::S('UI:IPManagement:Action:CsvExportIps:IPv6Range:Subtitle_ListRange')."</b>\n");
				}

				// First IP
				$sAttCode = 'firstip';
				$sInputId = $iFormId.'_'.'firstip';
				$oAttDef = MetaModel::GetAttributeDef('IPv6Range', 'firstip');
				$sDefault = (array_key_exists('firstip', $aDefault)) ? $aDefault['firstip'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv6Range', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);

				// Last IP
				$sAttCode = 'lastip';
				$sInputId = $iFormId.'_'.'lastip';
				$oAttDef = MetaModel::GetAttributeDef('IPv6Range', 'lastip');
				$sDefault = (array_key_exists('lastip', $aDefault)) ? $aDefault['lastip'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv6Range', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);

				$oP->Details($aDetails);
				$oP->add('</td></tr>');

				// Cancel button
				$iObjId = $this->GetKey();
				$oP->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"BackToDetails('IPv6Range', $iObjId)\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;");
				break;

			default:
				break;
		};

		// Apply button
		$oP->add("&nbsp;&nbsp<button type=\"submit\" class=\"action\"><span>".Dict::S('UI:Button:Apply')."</span></button></td></tr>");

		$oP->add("</table>");
	}

	/**
	 * @inheritdoc
	 */
	protected function DisplayActionFieldsForOperationV3(iTopWebPage $oP, $oClassForm, $sOperation, $aDefault) {
		$oMultiColumn = new MultiColumn();
		$oP->AddUIBlock($oMultiColumn);

		// First column = labels or fields
		$oColumn1 = new Column();
		$oMultiColumn->AddColumn($oColumn1);
		switch ($sOperation) {
			case 'listips':
			case 'csvexportips':
				$sTextOperation = ($sOperation == 'listips') ? 'ListIps' : 'CsvExportIps';
				$sSubTitle = Dict::S('UI:IPManagement:Action:'.$sTextOperation.':IPv6Subnet:Subtitle_ListRange');
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:'.$sTextOperation.':IPv6Subnet:FirstIP');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:'.$sTextOperation.':IPv6Subnet:LastIP');

				// Subtitle
				$oColumn1->AddHtml($sSubTitle.'<br><br>');

				// First IP
				$sDefault = (array_key_exists('firstip', $aDefault)) ? $aDefault['firstip'] : '';
				$val = $this->GetClassFieldForForm($oP, '', 'IPv6Range', 'firstip', $sLabelOfAction1, $sDefault, OPT_ATT_MANDATORY);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));

				// Last IP
				$sDefault = (array_key_exists('lastip', $aDefault)) ? $aDefault['lastip'] : '';
				$val = $this->GetClassFieldForForm($oP, '', 'IPv6Range', 'lastip', $sLabelOfAction2, $sDefault, OPT_ATT_MANDATORY);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));
				break;

			default:
				break;
		};
	}

	/**
	 * @inheritdoc
	 */
	function DisplayBareRelations(WebPage $oP, $bEditMode = false) {
		// Execute parent function first 
		parent::DisplayBareRelations($oP, $bEditMode);

		if (!$this->IsNew()) {
			// Add related style sheet
			$oP->add_linked_stylesheet(utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/asset/css/teemip-ip-mgmt.css');

			$iOrgId = $this->Get('org_id');
			$sFirstIp = $this->Get('firstip')->GetAsCannonical();
			$sLastIp = $this->Get('lastip')->GetAsCannonical();

			$iSize = $this->GetSize();

			// Tab for Registered IPs
			$oIpRegisteredSearch = DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id", array(
				'firstip' => $sFirstIp,
				'lastip' => $sLastIp,
				'org_id' => $iOrgId,
			));
			$oIpRegisteredSet = new CMDBObjectSet($oIpRegisteredSearch);
			$iRegistered = $oIpRegisteredSet->Count();
			if ($iRegistered > 0) {
				$aStatusRegisteredIPs = $oIpRegisteredSet->GetColumnAsArray('status', false);
				$iReserved = 0;
				$iAllocated = 0;
				$iReleased = 0;
				$i = 0;
				while ($i < $iRegistered) {
					switch ($aStatusRegisteredIPs[$i++]) {
						case 'reserved':
							$iReserved++;
							break;

						case 'allocated':
							$iAllocated++;
							break;

						case 'released':
							$iReleased++;
							break;
					}

				}
				$iUnallocated = $iRegistered - $iAllocated - $iReleased - $iReserved;
				$sHtml = '<div class="teemip-space-occupation">'.$this->GetAsHTML('occupancy').Dict::Format('Class:IPRange/Tab:ipregistered-count', $iReserved, $iAllocated, $iReleased, $iUnallocated, $iSize).'</div>';
			} else {
				$sHtml = '';
			}
			$sName = Dict::S('Class:IPRange/Tab:ipregistered');
			$sTitle = Dict::S('Class:IPRange/Tab:ipregistered+');
			IPUtils::DisplayTabContent($oP, $sName, 'ip_addresses', 'IPv6Address', $sTitle, $sHtml, $oIpRegisteredSet);
		}
	}

	/**
	 * @inheritdoc
	 */
	function DoCheckToWrite() {
		// Run standard iTop checks first
		parent::DoCheckToWrite();

		$iOrgId = $this->Get('org_id');
		if ($this->IsNew()) {
			$iKey = -1;
		} else {
			$iKey = $this->GetKey();
		}
		$sRange = $this->Get('range');
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');
		$iSubnetId = $this->Get('subnet_id');

		// If check is done during subnet expand, skip checks
		if ($this->Get('write_reason') == 'expand') {
			// Reset reason for action
			$this->Set('write_reason', 'none');
		} else {
			// Check that 1st Ip is smaller than last one
			if ($oFirstIp->IsBiggerOrEqual($oLastIp)) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Reverted');

				return;
			}

			// Make sure range is fully contained in subnet
			$oSubnet = MetaModel::GetObject('IPv6Subnet', $this->Get('subnet_id'), true /* MustBeFound */);
			$oSubnetIp = $oSubnet->Get('ip');
			$oSubnetLastIp = $oSubnet->Get('lastip');
			if ($oFirstIp->IsSmallerStrict($oSubnetIp) || $oSubnetLastIp->IsSmallerStrict($oLastIp)) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:NotInSubnet');

				return;
			}

			// Make sure range doesn't collide with another range within subnet
			$oRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = '$iSubnetId' AND r.org_id = $iOrgId AND r.id != $iKey"));
			while ($oRange = $oRangeSet->Fetch()) {
				$oCurrentFirstIp = $oRange->Get('firstip');
				$oCurrentLastIp = $oRange->Get('lastip');

				// Check that name doesn't already exist in same subnet
				if ($oRange->Get('range') == $sRange) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:NameExist');

					return;
				}
				// Does the range already exist?
				if ($oCurrentFirstIp->IsEqual($oFirstIp) && $oCurrentLastIp->IsEqual($oLastIp)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Collision0');

					return;
				}
				// Is new first Ip part of an existing range?
				if ($oCurrentFirstIp->IsSmallerOrEqual($oFirstIp) && $oFirstIp->IsSmallerOrEqual($oCurrentLastIp)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Collision1');

					return;
				}
				// Is new last Ip part of an existing range?
				if ($oCurrentFirstIp->IsSmallerOrEqual($oLastIp) && $oLastIp->IsSmallerOrEqual($oCurrentLastIp)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Collision2');

					return;
				}
				// Is new range including an existing one?
				if ($oFirstIp->IsSmallerStrict($oCurrentFirstIp) && $oCurrentLastIp->IsSmallerStrict($oLastIp)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Collision3');

					return;
				}
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	protected function AfterInsert() {
		parent::AfterInsert();

		$iOrgId = $this->Get('org_id');
		$iId = $this->GetKey();
		$sFirstIp = $this->Get('firstip')->GetAsCannonical();
		$sLastIp = $this->Get('lastip')->GetAsCannonical();

		// Make sure all IPs belonging to range are attached to it

		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id", array(
			'firstip' => $sFirstIp,
			'lastip' => $sLastIp,
			'org_id' => $iOrgId,
		)));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch()) {
			if ($oIpRegistered->Get('range_id') != $iId) {
				$oIpRegistered->Set('range_id', $iId);
				$oIpRegistered->DBUpdate();
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	protected function AfterUpdate() {
		parent::AfterUpdate();

		$iOrgId = $this->Get('org_id');
		$iId = $this->GetKey();
		$sFirstIp = $this->Get('firstip')->GetAsCannonical();
		$sLastIp = $this->Get('lastip')->GetAsCannonical();

		// Make sure all IPs belonging to range are attached to it

		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id", array(
			'firstip' => $sFirstIp,
			'lastip' => $sLastIp,
			'org_id' => $iOrgId,
		)));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch()) {
			if ($oIpRegistered->Get('range_id') != $iId) {
				$oIpRegistered->Set('range_id', $iId);
				$oIpRegistered->DBUpdate();
			}
		}

		// Make sure all IPs ouside of range are NOT attached to it
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE i.range_id = :id AND (i.ip_text < :firstip OR :lastip < i.ip_text)", array(
			'id' => $iId,
			'firstip' => $sFirstIp,
			'lastip' => $sLastIp,
		)));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch()) {
			$oIpRegistered->Set('range_id', 0);
			$oIpRegistered->DBUpdate();
		}
	}

	/**
	 * @inheritdoc
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '') {
		if ((!$this->IsNew()) && ($sAttCode == 'subnet_id')) {
			return OPT_ATT_READONLY;
		}

		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}
}
