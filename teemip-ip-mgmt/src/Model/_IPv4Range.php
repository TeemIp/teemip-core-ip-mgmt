<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Model;

use cmdbAbstractObject;
use CMDBObjectSet;
use Combodo\iTop\Application\UI\Base\Component\Field\FieldUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\Column\Column;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\MultiColumn;
use DBObjectSearch;
use DBObjectSet;
use DBSearch;
use Dict;
use IPRange;
use iTopWebPage;
use MetaModel;
use TeemIp\TeemIp\Extension\Framework\Helper\IPUtils;
use UserRights;
use utils;
use WebPage;

class _IPv4Range extends IPRange {
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
			$sIcon = utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/asset/img/icons8-slice-16.png';

			return ("<img src=\"$sIcon\" alt=\"\" style=\"vertical-align:middle;\"/>");
		}

		return $this->GetIcon($bImgTag);
	}

	/**
	 * @inheritdoc
	 */
	public function GetSize() {
		$sFirstIp = $this->Get('firstip');
		$sLastIp = $this->Get('lastip');
		$iSize = IPUtils::myip2long($sLastIp) - IPUtils::myip2long($sFirstIp) + 1;

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
		$sOrgId = $this->Get('org_id');
		$sFirstIp = $this->Get('firstip');
		$sLastIp = $this->Get('lastip');

		$iSize = IPUtils::myip2long($sLastIp) - IPUtils::myip2long($sFirstIp) + 1;
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sFirstIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sLastIp') AND i.org_id = $sOrgId"));

		return ($oIpRegisteredSet->Count() / $iSize) * 100;
	}

	/**
	 * @inheritdoc
	 */
	public function GetFreeIP($iCreationOffset) {
		$sFirstIp = $this->Get('firstip');
		$iFirstIp = IPUtils::myip2long($sFirstIp);
		$sLastIp = $this->Get('lastip');
		$iLastIp = IPUtils::myip2long($sLastIp);
		if ($iFirstIp + $iCreationOffset > $iLastIp) {
			return '';
		}

		// Get list of registered IPs
		$iKey = $this->GetKey();
		$oIPRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS ip WHERE ip.range_id = $iKey"));
		$aIPRegistered = $oIPRegisteredSet->GetColumnAsArray('ip', false);

		$iFirstIp += $iCreationOffset;
		for ($iAnIp = $iFirstIp; $iAnIp <= $iLastIp; $iAnIp++) {
			$sAnIP = IPUtils::mylong2ip($iAnIp);
			if (!in_array($sAnIP, $aIPRegistered)) {
				return $sAnIP;
			}
		}

		return '';
	}

	/**
	 * @inheritdoc
	 */
	protected function GetIPsAsCSV($aParam) {
		// Define first and last IPs to display
		$sFirstIp = $aParam['first_ip'];
		$sRangeFirstIp = $this->Get('firstip');
		if ($sFirstIp == '') {
			$sFirstIp = $sRangeFirstIp;
		}
		$sLastIp = $aParam['last_ip'];
		$sRangeLastIp = $this->Get('lastip');
		if ($sLastIp == '') {
			$sLastIp = $sRangeLastIp;
		}

		// Get list of registered IPs in range
		$sOrgId = $this->Get('org_id');
		$iFirstIp = IPUtils::myip2long($sFirstIp);
		$iLastIp = IPUtils::myip2long($sLastIp);
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sFirstIp') <= INET_ATON(i.ip)  AND INET_ATON(i.ip) <= INET_ATON('$sLastIp')  AND i.org_id = $sOrgId"));

		// Set CRLF format
		$sCrLf = "<br>";

		// List exported parameters
		$sHtml = '"Registered","Id"';
		$aParam = array('org_name', 'ip', 'status', 'fqdn', 'usage_name', 'comment', 'requestor_name', 'release_date');
		if (class_exists('IPDiscovery')) {
			$aParam = array_merge($aParam, array('responds_to_ping', 'responds_to_scan', 'responds_to_iplookup', 'fqdn_from_iplookup'));
		}
		foreach ($aParam as $sAttCode) {
			$sHtml .= ',"'.MetaModel::GetLabel('IPv4Address', $sAttCode).'"';
		}
		$sHtml .= $sCrLf;

		// List all IPs of range now in IP order
		$aIpRegistered = $oIpRegisteredSet->GetColumnAsArray('ip', false);
		$iAnIp = $iFirstIp;
		while ($iAnIp <= $iLastIp) {
			$sAnIp = IPUtils::mylong2ip($iAnIp);
			if (!in_array($sAnIp, $aIpRegistered)) {
				$sHtml .= '"no","","","'.$sAnIp.'","free","","","","",""';
				if (class_exists('IPDiscovery')) {
					$sHtml .= ',"no","no","no",""';
				}
			} else {
				$oIpRegisteredSet->Rewind();
				$oIpRegistered = $oIpRegisteredSet->Fetch();
				while ($sAnIp != $oIpRegistered->Get('ip')) {
					$oIpRegistered = $oIpRegisteredSet->Fetch();
				}
				$sHtml .= '"yes","'.$oIpRegistered->GetKey().'"';
				$sHtml .= ',"'.$oIpRegistered->Get('org_name').'"';
				$sHtml .= ',"'.$oIpRegistered->Get('ip').'"';
				$sHtml .= ',"'.$oIpRegistered->Get('status').'"';
				$sHtml .= ',"'.$oIpRegistered->Get('fqdn').'"';
				$sHtml .= ',"'.$oIpRegistered->Get('usage_name').'"';
				$sHtml .= ',"'.$oIpRegistered->Get('comment').'"';
				$sHtml .= ',"'.$oIpRegistered->Get('requestor_name').'"';
				$sHtml .= ',"'.$oIpRegistered->Get('release_date').'"';
				if (class_exists('IPDiscovery')) {
					$sHtml .= ',"'.$oIpRegistered->Get('responds_to_ping').'"';
					$sHtml .= ',"'.$oIpRegistered->Get('responds_to_scan').'"';
					$sHtml .= ',"'.$oIpRegistered->Get('responds_to_iplookup').'"';
					$sHtml .= ',"'.$oIpRegistered->Get('fqdn_from_iplookup').'"';
				}
			}
			$sHtml .= $sCrLf;
			$iAnIp++;
		}

		return ($sHtml);
	}

	/**
	 * Check if IP is in range
	 *
	 * @param $sIp
	 *
	 * @return bool
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	function DoCheckIpInRange($sIp) {
		$iIp = IPUtils::myip2long($sIp);
		$iFirstIp = IPUtils::myip2long($this->Get('firstip'));
		$iLastIp = IPUtils::myip2long($this->Get('lastip'));
		if (($iFirstIp <= $iIp) && ($iIp <= $iLastIp)) {
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
		$sRangeFirstIp = $this->Get('firstip');
		$iRangeFirstIp = IPUtils::myip2long($sRangeFirstIp);
		$sRangeLastIp = $this->Get('lastip');
		$iRangeLastIp = IPUtils::myip2long($sRangeLastIp);

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '') {
			$iFirstIp = IPUtils::myip2long($sFirstIp);
			if (($iFirstIp < $iRangeFirstIp) || ($iRangeLastIp < $iFirstIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv4Range:FirstIPOutOfRange'));
			}
		}

		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '') {
			$iLastIp = IPUtils::myip2long($sLastIp);
			if (($iLastIp < $iRangeFirstIp) || ($iRangeLastIp < $iLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv4Range:LastIPOutOfRange'));
			}
		}

		if (($sFirstIp != '') && ($sLastIp != '')) {
			if ($iFirstIp > $iLastIp) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv4Range:FirstIpBiggerThanLastIp'));
			}
		}

		return '';
	}

	/**
	 * @inheritdoc
	 */
	function GetListIps(WebPage $oP, $aParam) {
		// Add related style sheeet
        if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.2', '<')) {
            $oP->add_linked_stylesheet(utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/asset/css/teemip-ip-mgmt.css');
        } else {
            $oP->LinkStylesheetFromModule('teemip-ip-mgmt/asset/css/teemip-ip-mgmt.css');
        }

		// Define first and last IPs to display
		$sFirstIp = $aParam['first_ip'];
		$sRangeFirstIp = $this->Get('firstip');
		if ($sFirstIp == '') {
			$sFirstIp = $sRangeFirstIp;
		}
		$bPrintDummyFirstLine = ($sFirstIp != $sRangeFirstIp) ? true : false;
		$sLastIp = $aParam['last_ip'];
		$sRangeLastIp = $this->Get('lastip');
		if ($sLastIp == '') {
			$sLastIp = $sRangeLastIp;
		}
		$bPrintDummyLastLine = ($sLastIp != $sRangeLastIp) ? true : false;

		// Get list of registered IPs in range
		$iId = $this->GetKey();
		$sOrgId = $this->Get('org_id');
		$iFirstIp = IPUtils::myip2long($sFirstIp);
		$iLastIp = IPUtils::myip2long($sLastIp);
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS ipv4 WHERE INET_ATON('$sFirstIp') <= INET_ATON(ipv4.ip) AND INET_ATON(ipv4.ip) <= INET_ATON('$sLastIp') AND ipv4.org_id = $sOrgId"));
		$aRegisteredIPs = $oIpRegisteredSet->GetColumnAsArray('ip', false);

		// Preset display of name and range attributes
		$iSubnetId = $this->Get('subnet_id');
		$sStatusIp = $aParam['status_ip'];
		$sShortName = $aParam['short_name'];
		$iDomainId = $aParam['domain_id'];
		$iUsageId = $aParam['usage_id'];
		$iRequestorId = $aParam['requestor_id'];

		$iAnIp = $iFirstIp;
		$iVIdCounter = 1;

		// Check user rights
		$UserHasRightsToCreate = (UserRights::IsActionAllowed('IPv4Address', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;

		// Open table
		$sHtml = '<table style="width:100%"><tr><td colspan="2">';
		$sHtml .= '<div style="vertical-align:top;" id="tree">';

		// Display first IP
		$sHtml .= "<ul>";
		$sHtml .= "<li>".$this->GetMultiSizeIcon(true, true).$this->GetHyperlink()."&nbsp;&nbsp;&nbsp;[".$this->GetAsHTML('firstip')." - ".$this->GetAsHTML('lastip')."]&nbsp;&nbsp; - ".$this->GetLabel('usage_id').': '.$this->GetAsHTML('usage_id')."<ul>";

		// ... and dummy line if display doesn't start at first IP
		if ($bPrintDummyFirstLine) {
			$sHtml .= "<li>&nbsp;&nbsp;...&nbsp;//&nbsp;... </li>";
		}

		// Display other IPs as list
		while ($iAnIp <= $iLastIp) {
			$sAnIp = IPUtils::mylong2ip($iAnIp);
			if (in_array($sAnIp, $aRegisteredIPs)) {
				// Found registered IP
				$oIpRegisteredSet->Rewind();
				$oIpRegistered = $oIpRegisteredSet->Fetch();
				while ($oIpRegistered->Get('ip') != $sAnIp) {
					$oIpRegistered = $oIpRegisteredSet->Fetch();
				}
				$sHtml .= "<li><span class=\"ipv4_address\">&nbsp;".$oIpRegistered->GetHyperlink()."</span>";
				$sHtml .= "<span class=\"ip_status\">".$oIpRegistered->GetAsHTML('status')."</span>";
				$sHtml .= "<span class=\"ip_fqdn\" title=\"".$oIpRegistered->Get('fqdn')."\">".$oIpRegistered->Get('fqdn')."</span>";
				if (class_exists('IPDiscovery')) {
                    $sHtml .= "<span class=\"ip_ping\">";
                    if ($oIpRegistered->Get('responds_to_ping')=='yes') {
                        $sHtml .= "<span class=\"ibo-field-badge ibo-field-badge--label\">".Dict::S('UI:IPManagement:Action:ListIPs:IPAddress:Ping')."</span>";
                    }
                    $sHtml .= "</span><span class=\"ip_scan\">";
                    if ($oIpRegistered->Get('responds_to_scan')=='yes') {
                        $sHtml .= "<span class=\"ibo-field-badge ibo-field-badge--label\">".Dict::S('UI:IPManagement:Action:ListIPs:IPAddress:Scan')."</span>";
                    }
                    $sHtml .= "</span><span class=\"ip_lookup\">";
                    if ($oIpRegistered->Get('responds_to_iplookup')=='yes') {
                        $sHtml .= "<span class=\"ibo-field-badge ibo-field-badge--label\">".Dict::S('UI:IPManagement:Action:ListIPs:IPAddress:Nslookup')."</span>";
                        $sHtml .= "</span><span class=\"ip_fqdn_lookup\">".$oIpRegistered->GetAsHTML('fqdn_from_iplookup');
                    }
                    $sHtml .= "</span>";
                }
				$sHtml .= "</li>";
			} else {
				// If user has rights to create IPs
				// Display unregistered IP with icon to create it
				if ($UserHasRightsToCreate) {
					$iVId = $iVIdCounter++;
					$sHtml .= "<li><div><span id=\"v_$iVId\">";
					$sHtml .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/asset/img/ipmini-add-xs.png\" onClick=\"oIpWidget_$iVId.DisplayCreationForm();\"/>&nbsp;";
					$sHtml .= "&nbsp;".$sAnIp."&nbsp;&nbsp;";
					$sHtml .= "</span></div>";
					$oP->add_ready_script(
						<<<EOF
					oIpWidget_$iVId = new IpWidget($iVId, 'IPv4Address', '', 0, {'org_id': '$sOrgId', 'subnet_id': '$iSubnetId', 'range_id': '$iId', 'ip': '$sAnIp', 'status': '$sStatusIp', 'short_name': '$sShortName', 'domain_id': '$iDomainId', 'usage_id': '$iUsageId', 'requestor_id': '$iRequestorId'});
EOF
					);
				} else {
					$sHtml .= "<li>".$sAnIp;
				}
			}
			$sHtml .= "</li>";
			$iAnIp++;
		}

		// Add dummy line if display doesn't finish at broadcast IP
		if ($bPrintDummyLastLine) {
			$sHtml .= "<li>&nbsp;&nbsp;...&nbsp;//&nbsp;... </li>";
		}
		$sHtml .= "</ul></li></ul>";

		// Close table
		$sHtml .= '</div>';
		$sHtml .= '</td></tr></table>';
		$oP->add_ready_script("\$('#tree ul').treeview();\n");
		$oP->add_dict_entry('UI:ValueMustBeSet');
		$oP->add_dict_entry('UI:ValueMustBeChanged');
		$oP->add_dict_entry('UI:ValueInvalidFormat');

		return $sHtml;
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
	function DoCheckToCsvExportIps($aParam) {
		$sRangeFirstIp = $this->Get('firstip');
		$iRangeFirstIp = IPUtils::myip2long($sRangeFirstIp);
		$sRangeLastIp = $this->Get('lastip');
		$iRangeLastIp = IPUtils::myip2long($sRangeLastIp);

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '') {
			$iFirstIp = IPUtils::myip2long($sFirstIp);
			if (($iFirstIp < $iRangeFirstIp) || ($iRangeLastIp < $iFirstIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIPOutOfRange'));
			}
		}

		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '') {
			$iLastIp = IPUtils::myip2long($sLastIp);
			if (($iLastIp < $iRangeFirstIp) || ($iRangeLastIp < $iLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv4Range:LastIPOutOfRange'));
			}
		}

		if (($sFirstIp != '') && ($sLastIp != '')) {
			if ($iFirstIp > $iLastIp) {
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIpBiggerThanLastIp'));
			}
		}

		return '';
	}

	/**
	 * @inheritDoc
	 */
	public function DoCheckToExplodeFQDN($sFqdnAttr) {
		if (!in_array($sFqdnAttr, MetaModel::GetAttributesList('IPv4Address'))) {
			// $sFqdnAttr is not a valid attribute for the class
			return (Dict::Format('UI:IPManagement:Action:ExplodeFQDN:IPAddress:FQDNAttributeDoesNotExist', $sFqdnAttr));
		}

		return '';
	}

	/**
	 * @inheritDoc
	 */
	public function DoExplodeFQDN($sFqdnAttr) {
		$iKey = $this->GetKey();
		$oIPsSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address WHERE $sFqdnAttr != '' AND $sFqdnAttr != fqdn AND range_id = :key"), array(), array('key' => $iKey));
		while ($oIP = $oIPsSet->Fetch()) {
			$oIP->DoExplodeFQDN($sFqdnAttr);
		}
	}

	/**
	 * @inheritdoc
	 */
	protected function DisplayActionFieldsForOperationV3(iTopWebPage $oP, $oObjectDetails, $sOperation, $aDefault) {
		$oMultiColumn = new MultiColumn();
		$oP->AddUIBlock($oMultiColumn);

		// First column = labels or fields
		$oColumn1 = new Column();
		$oMultiColumn->AddColumn($oColumn1);
		switch ($sOperation) {
			case 'listips':
			case 'csvexportips':
				$sTextOperation = ($sOperation == 'listips') ? 'ListIps' : 'CsvExportIps';
				$sSubTitle = Dict::S('UI:IPManagement:Action:'.$sTextOperation.':IPv4Range:Subtitle_ListRange');
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:'.$sTextOperation.':IPv4Range:FirstIP');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:'.$sTextOperation.':IPv4Range:LastIP');

				// Subtitle
				$oColumn1->AddHtml($sSubTitle.'<br><br>');

				// First IP
				$val = $this->GetClassFieldForForm($oP, '', 'IPv4Range', 'firstip', $sLabelOfAction1, '', OPT_ATT_MANDATORY);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));

				// Last IP
				$val = $this->GetClassFieldForForm($oP, '', 'IPv4Range', 'lastip', $sLabelOfAction2, '', OPT_ATT_MANDATORY);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));
				break;

			default:
				break;
		}
	}

	/**
	 * @inheritdoc
	 */
	public function DisplayBareRelations(WebPage $oPage, $bEditMode = false) {
        // Execute parent function first
		parent::DisplayBareRelations($oPage, $bEditMode);

		if (!$this->IsNew()) {
			// Add related style sheet
            if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.2', '<')) {
                $oPage->add_linked_stylesheet(utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/asset/css/teemip-ip-mgmt.css');
            } else {
                $oPage->LinkStylesheetFromModule('teemip-ip-mgmt/asset/css/teemip-ip-mgmt.css');
            }

			$sOrgId = $this->Get('org_id');
			$sFirstIp = $this->Get('firstip');
			$sLastIp = $this->Get('lastip');
			$iFirstIp = IPUtils::myip2long($sFirstIp);
			$iLastIp = IPUtils::myip2long($sLastIp);

			$iSize = $iLastIp - $iFirstIp + 1;

			// Tab for Registered IPs
			$oIpRegisteredSearch = DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON(i.ip) >= INET_ATON('$sFirstIp') AND INET_ATON(i.ip) <= INET_ATON('$sLastIp')	AND i.org_id = $sOrgId");
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
			IPUtils::DisplayTabContent($oPage, $sName, 'ip_addresses', 'IPv4Address', $sTitle, $sHtml, $oIpRegisteredSet, false);
		}
	}

	/**
	 * @inheritdoc
	 */
	function DoCheckToWrite() {
		// Run standard iTop checks first
		parent::DoCheckToWrite();

		$sOrgId = $this->Get('org_id');
		if ($this->IsNew()) {
			$iKey = -1;
		} else {
			$iKey = $this->GetKey();
		}
		$sRange = $this->Get('range');
		$iFirstIp = IPUtils::myip2long($this->Get('firstip'));
		$iLastIp = IPUtils::myip2long($this->Get('lastip'));
		$iSubnetId = $this->Get('subnet_id');

		// If check is done during subnet expand, skip checks
		if ($this->Get('write_reason') == 'expand') {
			// Reset reason for action
			$this->Set('write_reason', 'none');
		} else {
			// Check that 1st Ip is smaller than last one
			if ($iFirstIp >= $iLastIp) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Reverted');

				return;
			}

			// Make sure range is fully contained in subnet
			$oSubnet = MetaModel::GetObject('IPv4Subnet', $this->Get('subnet_id'), true /* MustBeFound */);
			$iSubnetBroadcastIp = IPUtils::myip2long($oSubnet->Get('broadcastip'));
			if (($iFirstIp < IPUtils::myip2long($oSubnet->Get('ip'))) || ($iSubnetBroadcastIp < $iLastIp)) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:NotInSubnet');

				return;
			}

			// Make sure range doesn't collide with another range within subnet
			$oRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = '$iSubnetId' AND r.org_id = $sOrgId AND r.id != $iKey"));
			while ($oRange = $oRangeSet->Fetch()) {
				$iCurrentFirstIp = IPUtils::myip2long($oRange->Get('firstip'));
				$iCurrentLastIp = IPUtils::myip2long($oRange->Get('lastip'));

				// Check that name doesn't already exist in same subnet
				if ($oRange->Get('range') == $sRange) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:NameExist');

					return;
				}
				// Does the range already exist?
				if (($iCurrentFirstIp == $iFirstIp) && ($iCurrentLastIp == $iLastIp)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Collision0');

					return;
				}
				// Is new first Ip part of an existing range?
				if (($iCurrentFirstIp <= $iFirstIp) && ($iFirstIp <= $iCurrentLastIp)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Collision1');

					return;
				}
				// Is new last Ip part of an existing range?
				if (($iCurrentFirstIp <= $iLastIp) && ($iLastIp <= $iCurrentLastIp)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Collision2');

					return;
				}
				// Is new range including an existing one?
				if (($iFirstIp < $iCurrentFirstIp) && ($iCurrentLastIp < $iLastIp)) {
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
		$sFirstIp = $this->Get('firstip');
		$sLastIp = $this->Get('lastip');

		// Make sure all IPs belonging to range are attached to it
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sFirstIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sLastIp') AND i.org_id = $iOrgId"));
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
		$sFirstIp = $this->Get('firstip');
		$sLastIp = $this->Get('lastip');

		// Make sure all IPs belonging to range are attached to it
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sFirstIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sLastIp') AND i.org_id = $iOrgId"));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch()) {
			if ($oIpRegistered->Get('range_id') != $iId) {
				$oIpRegistered->Set('range_id', $iId);
				$oIpRegistered->DBUpdate();
			}
		}

		// Make sure all IPs ouside of range are NOT attached to it
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE i.range_id = $iId AND (INET_ATON(i.ip) < INET_ATON('$sFirstIp') OR INET_ATON('$sLastIp') < INET_ATON(i.ip))"));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch()) {
			$oIpRegistered->Set('range_id', 0);
			$oIpRegistered->DBUpdate();
		}
	}

	/**
	 * @inheritdoc
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '') {
		$sFlagsFromParent = parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
		$aReadOnlyAttributes = array('subnet_id');

		if (!$this->IsNew() && in_array($sAttCode, $aReadOnlyAttributes)) {
			return (OPT_ATT_READONLY | $sFlagsFromParent);
		}

		return $sFlagsFromParent;
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
		// Create OQL according to $bInSubnet
		$iSubnet = $this->Get('subnet_id');
		if ($bInSubnet) {
			if ($iSubnet > 0) {
				$sOQL = 'SELECT IPv4Range AS r WHERE r.subnet_id = :subnet_id AND INET_ATON(r.firstip) < INET_ATON(:ip)';
			} else {
				return null;
			}
		} else {
			$sOQL = 'SELECT IPv4Range AS r WHERE r.org_id = :org_id AND INET_ATON(r.firstip) < INET_ATON(:ip)';
		}
		// Set the ordering criteria ['firstip'=> false] and set a limit (1)
		$oRangeSet = new DBObjectSet(DBSearch::FromOQL($sOQL), ['firstip' => false], ['org_id' => $this->Get('org_id'), 'subnet_id' => $iSubnet, 'ip' => $this->Get('firstip')], null, 1);
		$oRangeSet->OptimizeColumnLoad(['IPv4Range' => ['id', 'firstip']]);
		if ($oPreviousRange = $oRangeSet->Fetch()) {
			return $oPreviousRange;
		}

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
		// Create OQL according to $bInBlock
		$iSubnet = $this->Get('subnet_id');
		if ($bInSubnet) {
			if ($iSubnet > 0) {
				$sOQL = 'SELECT IPv4Range AS r WHERE r.subnet_id = :subnet_id AND INET_ATON(r.firstip) > INET_ATON(:ip)';
			} else {
				return null;
			}
		} else {
			$sOQL = 'SELECT IPv4Range AS r WHERE r.org_id = :org_id AND INET_ATON(r.firstip) > INET_ATON(:ip)';
		}
		// Set the ordering criteria ['firstip'=> false] and set a limit (1)
		$oRangeSet = new DBObjectSet(DBSearch::FromOQL($sOQL), ['firstip' => true], ['org_id' => $this->Get('org_id'), 'subnet_id' => $iSubnet, 'ip' => $this->Get('firstip')], null, 1);
		$oRangeSet->OptimizeColumnLoad(['IPv4Range' => ['id', 'firsip']]);
		if ($oNextRange = $oRangeSet->Fetch()) {
			return $oNextRange;
		}

		return null;
	}

}
