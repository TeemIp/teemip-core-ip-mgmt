<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Model;

use cmdbAbstractObject;
use CMDBObjectSet;
use Combodo\iTop\Application\UI\Base\Component\Field\FieldUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Html\HtmlFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\InputUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\Column\Column;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\MultiColumn;
//use Combodo\iTop\Application\WebPage\WebPage;
use DBObjectSearch;
use DBObjectSet;
use DBSearch;
use Dict;
use IPConfig;
use IPSubnet;
use IPUsage;
use iTopWebPage;
use MetaModel;
use TeemIp\TeemIp\Extension\Framework\Helper\IPUtils;
use TeemIp\TeemIp\Extension\Framework\Helper\iTree;
use UserRights;
use utils;
use WebPage;

class _IPv4Subnet extends IPSubnet implements iTree
{
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
	public function GetMultiSizeIcon($bImgTag = true, $bXsIcon = false)
	{
		if ($bXsIcon) {
			$sIcon = utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/asset/img/icons8-subnet-16.png';

			return ("<img src=\"$sIcon\" alt=\"\" style=\"vertical-align:middle;\"/>");
		}

		return $this->GetIcon($bImgTag);
	}

	/**
	 * Returns index to be used within tree computations
	 *
	 * @return int
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function GetIndexForTree()
	{
		return IPUtils::myip2long($this->Get('ip'));
	}

	/**
	 * Returns size of subnet
	 *
	 * @return int
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function GetSize()
	{
		$sMask = $this->Get('mask');

		return IPUtils::MaskToSize($sMask);
	}

	/**
	 * Compute % of IP addresses and / or IP ranges in subnet
	 *
	 * @param $sObject
	 *
	 * @return float|int
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public function GetOccupancy($sObject)
	{
		$iOrgId = $this->Get('org_id');

		switch ($sObject) {
			case 'IPAddress':
			case 'IPv4Address':
				// Look for all IPs within subnets
				//	Note that these IPs can belong to an IP range
				$sIp = $this->Get('ip');
				$sIpBroadcast = $this->Get('broadcastip');
				$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcast') AND i.org_id = $iOrgId"));

				return ($oIpRegisteredSet->Count() / $this->GetSize()) * 100;

			case 'IPRange':
			case 'IPv4Range':
				// Look for all child IP ranges
				$sSubnet = $this->GetKey();
				$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = '$sSubnet' AND r.org_id = $iOrgId"));
				$iSizeRanges = 0;
				while ($oIpRange = $oIpRangeSet->Fetch()) {
					$iSizeRanges += IPUtils::myip2long($oIpRange->Get('lastip')) - IPUtils::myip2long($oIpRange->Get('firstip')) + 1;
				}

				return ($iSizeRanges / $this->GetSize()) * 100;

			case 'IPv4Address_out_IPv4Range':
				// Look for all IPs within subnets
				$sIp = $this->Get('ip');
				$sIpBroadcast = $this->Get('broadcastip');
				$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcast') AND i.org_id = $iOrgId"));
				// Look for all child IP ranges
				$sSubnet = $this->GetKey();
				$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = '$sSubnet' AND r.org_id = $iOrgId"));
				$iIpInRanges = 0;
				$iSizeRanges = 0;
				while ($oIpRange = $oIpRangeSet->Fetch()) {
					$sIpRangeFirstIp = $oIpRange->Get('firstip');
					$sIpRangeLastIp = $oIpRange->Get('lastip');
					$oIpRegisteredInRange = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sIpRangeFirstIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpRangeLastIp') AND i.org_id = $iOrgId"));
					$iIpInRanges += $oIpRegisteredInRange->Count();
					$iSizeRanges += IPUtils::myip2long($oIpRange->Get('lastip')) - IPUtils::myip2long($oIpRange->Get('firstip')) + 1;
				}

				return (($oIpRegisteredSet->Count() - $iIpInRanges) / $this->GetSize()) * 100;

			default:
				return 0;
		}
	}

	/**
	 * Automatically get a free IP in the subnet
	 *
	 * @param $iCreationOffset
	 *
	 * @return float|int|mixed|\ormLinkSet|string|null
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function GetFreeIP($iCreationOffset)
	{
		$sFirstIp = $this->Get('ip');
		$iFirstIp = IPUtils::myip2long($sFirstIp) + 1;  // Skip subnet IP
		$sLastIp = $this->Get('broadcastip');
		$iLastIp = IPUtils::myip2long($sLastIp);
		if ($iFirstIp + $iCreationOffset >= $iLastIp) {
			return '';
		}

		// Get list of registered IPs
		$iKey = $this->GetKey();
		$oIPRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS ip WHERE ip.subnet_id = $iKey"));
		$aIPRegistered = $oIPRegisteredSet->GetColumnAsArray('ip', false);

		// Get list of ranges in Subnet
		$oIPRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = $iKey"));

		$iFirstIp += $iCreationOffset;
		for ($iAnIp = $iFirstIp; $iAnIp < $iLastIp; $iAnIp++) {
			$sAnIp = IPUtils::mylong2ip($iAnIp);
			if (!in_array($sAnIp, $aIPRegistered)) {
				$oIPRangeSet->Rewind();
				$bIsInRange = false;
				while ($oIPRange = $oIPRangeSet->Fetch()) {
					if ($oIPRange->DoCheckIpInRange($sAnIp)) {
						$bIsInRange = true;
						$sAnIp = $oIPRange->Get('lastip');
						$iAnIp = IPUtils::myip2long($sAnIp);
						break;
					}
				}
				if (!$bIsInRange) {
					return $sAnIp;
				}
			}
		}

		return '';
	}

	/**
	 * Count number of IPs in subnet, in given status
	 *
	 * @param $sStatus
	 *
	 * @return int
	 * @throws \CoreException
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public function IPCount($sStatus)
	{
		switch ($sStatus) {
			case 'allocated':
			case 'released':
			case 'reserved':
			case 'unassigned':
				$iKey = $this->GetKey();
				$sOQL = "SELECT IPv4Address AS ip WHERE ip.status = :status AND ip.subnet_id = :key";
				$oIpSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array(
					'status' => $sStatus,
					'key' => $iKey,
				));
				$iNbIps = $oIpSet->Count();

				return $iNbIps;

			default:
				return 0;
		}
	}

	/**
	 * Find space within the subnet to create range
	 *
	 * @param $iRangeSize
	 * @param $iMaxOffer
	 *
	 * @return array
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function GetFreeSpace($iRangeSize, $iMaxOffer)
	{
		$iOrgId = $this->Get('org_id');
		$iKey = $this->GetKey();
		$aFreeSpace = array();

		// Get list of registered IPs & ranges in subnet
		$sFirstIp = $this->Get('ip');
		$iFirstIp = IPUtils::myip2long($sFirstIp);
		$sLastIp = $this->Get('broadcastip');
		$iLastIp = IPUtils::myip2long($sLastIp);
		$iSubnetSize = $this->GetSize();
		if ($iRangeSize >= $iSubnetSize) {
			// Required range size is to big, exit
			return $aFreeSpace;
		} else {
			$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sFirstIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sLastIp') AND i.org_id = $iOrgId"));
			$aRegisteredIPs = $oIpRegisteredSet->GetColumnAsArray('ip', false);
			$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = $iKey AND r.org_id = $iOrgId"));
			$aRangeIPs = $oIpRangeSet->GetColumnAsArray('firstip', false);

			$iAnIp = $iFirstIp + 1;
			$sAnIp = IPUtils::mylong2ip($iAnIp);
			$n = 0;
			do {
				// Find next free IP
				while (in_array($sAnIp, $aRegisteredIPs)) {
					$iAnIp++;
					$sAnIp = IPUtils::mylong2ip($iAnIp);
				}
				if ($iAnIp < $iLastIp) {
					// If free IP belongs to an IP range, skip range
					$oIpRangeSet->Rewind();
					$bContinue = true;
					while ($bContinue && ($oIpRange = $oIpRangeSet->Fetch())) {
						if ((IPUtils::myip2long($oIpRange->Get('firstip')) <= $iAnIp) && ($iAnIp <= IPUtils::myip2long($oIpRange->Get('lastip')))) {
							$iAnIp = IPUtils::myip2long($oIpRange->Get('lastip')) + 1;
							$sAnIp = IPUtils::mylong2ip($iAnIp);
							$bContinue = false;
						}
					}
					if ($iAnIp < $iLastIp) {
						// Make sure we don't have any IP or range until last IP
						$iRangeFirstIp = $iAnIp;
						$i = 0;
						$bContinue = true;
						while ($bContinue && (!in_array($sAnIp, $aRegisteredIPs)) && ($iAnIp < $iLastIp) && ($i < $iRangeSize)) {
							if (in_array($sAnIp, $aRangeIPs)) {
								$bContinue = false;
							} else {
								$iAnIp++;
								$sAnIp = IPUtils::mylong2ip($iAnIp);
								$i++;
							}
						}
						if ($i == $iRangeSize) {
							$aFreeSpace[$n] = array();
							$iRangeLastIp = $iAnIp - 1;
							$aFreeSpace[$n]['firstip'] = IPUtils::mylong2ip($iRangeFirstIp);
							$aFreeSpace[$n]['lastip'] = IPUtils::mylong2ip($iRangeLastIp);
							$n++;
						}
					}
				}
			} while (($iAnIp < $iLastIp) && ($n < $iMaxOffer));
		}

		// Return result
		return $aFreeSpace;
	}

	/**
	 * List IP addresses in subnet in CSV format
	 *
	 * @param $aParam
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	protected function GetIPsAsCSV($aParam)
	{
		// Define first and last IPs to display
		$sFirstIp = $aParam['first_ip'];
		$sSubnetIp = $this->Get('ip');
		if ($sFirstIp == '') {
			$sFirstIp = $sSubnetIp;
		}
		$sLastIp = $aParam['last_ip'];
		$sBroadCastIp = $this->Get('broadcastip');
		if ($sLastIp == '') {
			$sLastIp = $sBroadCastIp;
		}

		// Get list of registered IPs in range
		$iOrgId = $this->Get('org_id');
		$iFirstIp = IPUtils::myip2long($sFirstIp);
		$iLastIp = IPUtils::myip2long($sLastIp);
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sFirstIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sLastIp')  AND i.org_id = $iOrgId"));

		// Get list of IP Ranges in subnet
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE INET_ATON('$sFirstIp') <= INET_ATON(r.firstip) AND INET_ATON(r.lastip) <= INET_ATON('$sLastIp') AND r.org_id = $iOrgId"));
		$iCountRange = $oIpRangeSet->Count();

		// Set CRLF format
		$sCrLf = "<br>";

		// List exported parameters
		$sHtml = '"Registered","Id"';
		$aParam = array(
			'org_name',
			'ip',
			'status',
			'fqdn',
			'usage_name',
			'comment',
			'requestor_name',
			'release_date',
		);
		if (class_exists('IPDiscovery')) {
			$aParam = array_merge($aParam, array(
				'responds_to_ping',
				'responds_to_scan',
				'responds_to_iplookup',
				'fqdn_from_iplookup',
			));
		}
		foreach ($aParam as $sAttCode) {
			$sHtml .= ',"'.MetaModel::GetLabel('IPv4Address', $sAttCode).'"';
		}
		$sHtml .= ',"IP Range"'.$sCrLf;

		// List all IPs of subnet now in IP order 
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
			// Check if IP belongs to a range or not
			if ($iCountRange != 0) {
				$oIpRangeSet->Rewind();
				$oIpRange = $oIpRangeSet->Fetch();
				$iFoundRange = false;
				while (($oIpRange != null) && ($iFoundRange == false)) {
					if ((IPUtils::myip2long($oIpRange->Get('firstip')) <= $iAnIp) && ($iAnIp <= IPUtils::myip2long($oIpRange->Get('lastip')))) {
						$iFoundRange = true;
					} else {
						$oIpRange = $oIpRangeSet->Fetch();
					}
				}
				if ($iFoundRange) {
					$sHtml .= ',"'.$oIpRange->Get('range').'"'.$sCrLf;
				} else {
					$sHtml .= ',""'.$sCrLf;
				}
			} else {
				$sHtml .= ',""'.$sCrLf;
			}
			$iAnIp++;
		}

		return ($sHtml);
	}

	/**
	 * Check if IP is in subnet
	 */
	function DoCheckIpInSubnet($sIp)
	{
		$iIp = IPUtils::myip2long($sIp);
		$iSubnetIp = IPUtils::myip2long($this->Get('ip'));
		$iBroadcastIp = IPUtils::myip2long($this->Get('broadcastip'));
		if (($iSubnetIp <= $iIp) && ($iIp <= $iBroadcastIp)) {
			return true;
		}

		return false;
	}

	/**
	 * Checks if the subnet is aligned to CIDR borders
	 */
	function DoCheckCIDRAligned()
	{
		$iIp = IPUtils::myip2long($this->Get('ip'));
		$iMask = IPUtils::myip2long($this->Get('mask'));

		// Check that FirstIp is CIDR aligned
		// Call to ip2long(long2ip()) is a workaround to handle integers that are above their max size
		if (($iIp & $iMask) != $iIp) {
			return false;
		}

		return true;
	}

	/**
	 * Check if operation is feasible on current object
	 */
	function DoCheckOperation($sOperation)
	{
		$sMask = $this->Get('mask');
		switch ($sOperation) {
			case 'findspace':
				if (IPUtils::MaskToBit($sMask) > 28) {
					// No point to look for space in less than /28
					return ('SizeTooSmall');
				}
				break;

			case 'listips':
			case 'csvexportips':
			case 'calculator':
				return ('');

			case 'shrinksubnet':
			case 'splitsubnet':
				if (IPUtils::MaskToBit($sMask) > 30) {
					// To small to be shrunk or split. Minimum size is /30
					return ('SizeTooSmall');
				}
				break;

			case 'expandsubnet':
				if (IPUtils::MaskToBit($sMask) < 17) {
					// To big to be expanded. Maximum size is /17 (by choice - bigger doesn't make sense))
					return ('SizeTooBig');
				}
				break;

			default:
				return ('OperationNotAllowed');
		}

		return ('');
	}

	/**
	 * Define scale / limit of operation that can be applied to a subnet
	 */
	function GetScaleOfOperation($sOperation)
	{
		$sMask = $this->Get('mask');
		switch ($sOperation) {
			case 'shrinksubnet':
			case 'splitsubnet':
				switch ($sMask) {
					// A /30 can only be shrunk or split by 2
					case '255.255.255.252':
						return 1;

					// A /29 can be shrunk or split by 2 or 4
					case '255.255.255.248':
						return 2;

					// A /28 can be shrunk or split by 2, 4 or 8
					case '255.255.255.240':
						return 3;

					// All other subnets can be shrunk or split by 2, 4, 8 or 16
					default:
						return 4;
				}

			case 'expandsubnet':
			default:
				switch ($sMask) {
					// A /128 can only be expanded by 2
					case '255.255.128.0.':
						return 1;

					// A /192 can be expanded by 2 or 4
					case '255.255.192.0':
						return 2;

					// A /192 can be expanded by 2, 4 or 8
					case '255.255.224.0':
						return 3;

					// All other subnets can be expanded by 2, 4, 8 or 16
					default:
						return 4;
				}
		}
	}

	/**
	 * Check if space can be searched
	 *
	 * @param $aParam
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function DoCheckToDisplayAvailableSpace($aParam)
	{
		$iSpaceSize = $aParam['spacesize'];

		$iSubnetSize = $this->GetSize();
		if ($iSpaceSize >= $iSubnetSize) {
			return ('RangeTooBig');
		} elseif ($iSpaceSize == 0) {
			return ('RangeEmpty');
		}

		return '';
	}

	/**
	 * @inheritdoc
	 */
	protected function GetAvailableSpace(WebPage $oP, $iChangeId, $aParam)
	{
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$iRangeSize = $aParam['spacesize'];
		$iMaxOffer = $aParam['maxoffer'];

		// Get list of free space in subnet
		$sIPv4RangeCreationTitle = utils::EscapeHtml(Dict::Format('UI:CreationTitle_Class', MetaModel::GetName('IPv4Range')));
		$aFreeSpace = $this->GetFreeSpace($iRangeSize, $iMaxOffer);

		// Check user rights
		$UserHasRightsToCreate = (UserRights::IsActionAllowed('IPv4Range', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;

		// Open table
		$sHtml = '<table style="width:100%"><tr><td colspan="2">';
		$sHtml .= '<div style="vertical-align:top;" id="tree">';

		// Display Summary of parameters
		$sHtml .= "<ul>";
		$sHtml .= "<li>"."&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Summary', $iMaxOffer, $iRangeSize)."<ul>";

		// Display possible choices as list
		$iSizeFreeArray = sizeof($aFreeSpace);
		if ($iSizeFreeArray != 0) {
			$i = 0;
			$iVIdCounter = 1;
			do {
				$sRangeFirstIp = $aFreeSpace[$i]['firstip'];
				$sRangeLastIp = $aFreeSpace[$i]['lastip'];
				$sHtml .= "<li>".$sRangeFirstIp." - ".$sRangeLastIp;

				// If user has rights to create range
				// Display range with icon to create it
				if ($UserHasRightsToCreate) {
					$iVId = $iVIdCounter++;
					$sHtml .= "<ul><li><div><span id=\"v_{$iVId}\">";
					$sHtml .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/asset/img/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
					$sHtml .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv4Subnet:CreateAsRange')."&nbsp;&nbsp;";
					$sHtml .= "</span></div></li>";
					$oP->add_ready_script(
						<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv4Range', '', $iChangeId, {'org_id': '$iOrgId', 'subnet_id': '$iId', 'firstip': '$sRangeFirstIp', 'lastip': '$sRangeLastIp'});
EOF
					);
					$sHtml .= "</ul></li>";
				} else {
					$sHtml .= "</li>";
				}
			} while (++$i < $iSizeFreeArray);
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
	public function DoCheckToListIps($aParam)
	{
		$sIp = $this->Get('ip');
		$iIp = IPUtils::myip2long($sIp);
		$sBroadcastIp = $this->Get('broadcastip');
		$iBroadcastIp = IPUtils::myip2long($sBroadcastIp);

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '') {
			$iFirstIp = IPUtils::myip2long($sFirstIp);
			if (($iFirstIp < $iIp) || ($iBroadcastIp <= $iFirstIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIPOutOfSubnet'));
			}
		}

		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '') {
			$iLastIp = IPUtils::myip2long($sLastIp);
			if (($iLastIp <= $iIp) || ($iBroadcastIp < $iLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv4Subnet:LastIPOutOfSubnet'));
			}
		}

		if (($sFirstIp != '') && ($sLastIp != '')) {
			if ($iFirstIp > $iLastIp) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIpBiggerThanLastIp'));
			}
		}

		return '';
	}

	/**
	 * @inheritdoc
	 */
	protected function GetListIps(WebPage $oP, $aParam)
	{
		// Add related style sheeet
        if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.2', '<')) {
            $oP->add_linked_stylesheet(utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/asset/css/teemip-ip-mgmt.css');
        } else {
            $oP->LinkStylesheetFromModule('teemip-ip-mgmt/asset/css/teemip-ip-mgmt.css');
        }

		// Define first and last IPs to display
		$sFirstIp = $aParam['first_ip'];
		$sSubnetIp = $this->Get('ip');
		if ($sFirstIp == '') {
			$sFirstIp = $sSubnetIp;
		}
		$bPrintDummyFirstLine = ($sFirstIp != $sSubnetIp) ? true : false;
		$sLastIp = $aParam['last_ip'];
		$sBroadCastIp = $this->Get('broadcastip');
		if ($sLastIp == '') {
			$sLastIp = $sBroadCastIp;
		}
		$bPrintDummyLastLine = ($sLastIp != $sBroadCastIp) ? true : false;

		// Get list of registered IPs & Ranges in subnet
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$sMask = $this->Get('mask');
		$iFirstIp = IPUtils::myip2long($sFirstIp);
		$iLastIp = IPUtils::myip2long($sLastIp);
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS ipv4 WHERE INET_ATON('$sFirstIp') <= INET_ATON(ipv4.ip) AND INET_ATON(ipv4.ip) <= INET_ATON('$sLastIp') AND ipv4.org_id = $iOrgId"));
		$aRegisteredIPs = $oIpRegisteredSet->GetColumnAsArray('ip', true);
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS rangev4 WHERE rangev4.subnet_id = $iId"));
		$aRangeIPs = $oIpRangeSet->GetColumnAsArray('firstip', false);
		$oIpRangeSet->Rewind();

		// Preset display subnet attributes
		$sStatusIp = $aParam['status_ip'];
		$sShortName = $aParam['short_name'];
		$iDomainId = $aParam['domain_id'];
		$iUsageId = $aParam['usage_id'];
		$iRequestorId = $aParam['requestor_id'];

		$iAnIp = $iFirstIp + 1;
		$iLastRangeIp = $iFirstIp;
		$iVIdCounter = 1;

		// Check user rights
		$UserHasRightsToCreate = (UserRights::IsActionAllowed('IPv4Address', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;

		// Open table
		$sHtml = '<table style="width:100%"><tr><td colspan="2">';
		$sHtml .= '<div style="vertical-align:top;" id="tree">';

		// Display first IP
		$sHtml .= "<ul>";
		$sHtml .= "<li>".$this->GetMultiSizeIcon(true, true).$this->GetHyperlink()."&nbsp;".Dict::S('Class:IPv4Subnet/Attribute:mask/Value_cidr:'.$sMask)."	 - ".$this->GetLabel('type').': '.$this->GetAsHTML('type')."<ul>";

		// ... and dummy line if display doesn't start at first IP
		if ($bPrintDummyFirstLine) {
			$sHtml .= "<li>&nbsp;&nbsp;...&nbsp;//&nbsp;... </li>";
		}

		// Display other IPs as list
		while ($iAnIp <= $iLastIp) {
			$sAnIp = IPUtils::mylong2ip($iAnIp);
			if (in_array($sAnIp, $aRangeIPs)) {
				// Found a range within list of IPs
				$oIpRangeSet->Rewind();
				$oIpRange = $oIpRangeSet->Fetch();
				while ($oIpRange->Get('firstip') != $sAnIp) {
					$oIpRange = $oIpRangeSet->Fetch();
				}

				// Display name and range attributes
				$sIcon = $oIpRange->GetMultiSizeIcon(true, true);
				$sHtml .= "<li>".$sIcon.$oIpRange->GetHyperlink()."&nbsp;&nbsp;&nbsp;[".$oIpRange->Get('firstip')." - ".$oIpRange->Get('lastip')."]";
				$sHtml .= "&nbsp;&nbsp; - ".$oIpRange->GetLabel('usage_id').': '.$oIpRange->GetAsHTML('usage_id')."<ul>";
				$iLastRangeIp = IPUtils::myip2long($oIpRange->Get('lastip'));
			}
			$iAnIpKey = array_search($sAnIp, $aRegisteredIPs);
			if ($iAnIpKey !== false) {
				// Found registered IP
				$oIpRegistered = MetaModel::GetObject('IPv4Address', $iAnIpKey);
				$sHtml .= "<li><span class=\"ipv4_address\">&nbsp;".$oIpRegistered->GetHyperlink()."</span>";
				$sHtml .= "<span class=\"ip_status\">".$oIpRegistered->GetAsHTML('status')."</span>";
				$sHtml .= "<span class=\"ip_fqdn\" title=\"".$oIpRegistered->Get('fqdn')."\">".$oIpRegistered->Get('fqdn')."</span>";
				if (class_exists('IPDiscovery')) {
					$sHtml .= "<span class=\"ip_ping\">";
					if ($oIpRegistered->Get('responds_to_ping') == 'yes') {
						$sHtml .= "<span class=\"ibo-field-badge ibo-field-badge--label\">".Dict::S('UI:IPManagement:Action:ListIPs:IPAddress:Ping')."</span>";
					}
					$sHtml .= "</span><span class=\"ip_scan\">";
					if ($oIpRegistered->Get('responds_to_scan') == 'yes') {
						$sHtml .= "<span class=\"ibo-field-badge ibo-field-badge--label\">".Dict::S('UI:IPManagement:Action:ListIPs:IPAddress:Scan')."</span>";
					}
					$sHtml .= "</span><span class=\"ip_lookup\">";
					if ($oIpRegistered->Get('responds_to_iplookup') == 'yes') {
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
					$sHtml .= "<li><div><span id=\"v_{$iVId}\">";
					$sHtml .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/asset/img/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
					$sHtml .= "&nbsp;".$sAnIp."&nbsp;&nbsp;";
					$sHtml .= "</span></div></li>";
					$oP->add_ready_script(
						<<<EOF
					oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv4Address', '', 0, {'org_id': '$iOrgId', 'subnet_id': '$iId', 'ip': '$sAnIp', 'status': '$sStatusIp', 'short_name': '$sShortName', 'domain_id': '$iDomainId', 'usage_id': '$iUsageId', 'requestor_id': '$iRequestorId'});
EOF
					);
				} else {
					$sHtml .= "<li>".$sAnIp."</li>";
				}
			}
			if ($iAnIp == $iLastRangeIp) {
				$sHtml .= "</ul></li>";
			}
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
	 * Check if IPs can be exported in CSV
	 *
	 * @param $aParam
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function DoCheckToCsvExportIps($aParam)
	{
		$sIp = $this->Get('ip');
		$iIp = IPUtils::myip2long($sIp);
		$sBroadcastIp = $this->Get('broadcastip');
		$iBroadcastIp = IPUtils::myip2long($sBroadcastIp);

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '') {
			$iFirstIp = IPUtils::myip2long($sFirstIp);
			if (($iFirstIp < $iIp) || ($iBroadcastIp <= $iFirstIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIPOutOfSubnet'));
			}
		}

		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '') {
			$iLastIp = IPUtils::myip2long($sLastIp);
			if (($iLastIp <= $iIp) || ($iBroadcastIp < $iLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:LastIPOutOfSubnet'));
			}
		}

		if (($sFirstIp != '') && ($sLastIp != '')) {
			if ($iFirstIp > $iLastIp) {
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIpBiggerThanLastIp'));
			}
		}

		return '';
	}

	/**
	 * Check if calculator inputs are meaningfull
	 *
	 * @param $aParam
	 *
	 * @return string
	 */
	function DoCheckCalculatorInputs($aParam)
	{
		$sMask = $aParam['mask'];
		$iCidr = $aParam['cidr'];

		if (($sMask == '') && ($iCidr == '')) {
			return (Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:EnterMaskOrCIDR'));
		}

		if (($sMask != '') && (IPUtils::MaskToSize($sMask) == -1)) {
			return (Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongMask'));
		}

		if (($iCidr != '') && (($iCidr <= 0) || ($iCidr > 32))) {
			return (Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongCIDR'));
		}

		return '';
	}

	/**
	 * Check if subnet can be shrunk
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
	function DoCheckToShrink($aParam)
	{
		// Set working variables
		$iSubnetKey = $this->GetKey();
		$sIpSubnetToShrink = $this->Get('ip');
		$iIpSubnetToShrink = IPUtils::myip2long($sIpSubnetToShrink);
		$sMaskSubnetToShrink = $this->Get('mask');
		$iMaskSubnetToShrink = IPUtils::myip2long($sMaskSubnetToShrink);
		$iShrink = $aParam['scale'];

		switch ($sMaskSubnetToShrink) {
			case '255.255.255.255':
			case '255.255.255.254':
				// To small to be shrunk. Minimum size is /30
				return (Dict::Format('UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmall'));

			case '255.255.255.252':
				// A /30 can only be shrunk by 2
				if ($iShrink > 2) {
					return (Dict::Format('UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy', $iShrink));
				}
				break;

			case '255.255.255.248':
				// A /29 can be shrunk by 2 or 4
				if ($iShrink > 4) {
					return (Dict::Format('UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy', $iShrink));
				}
				break;

			case '255.255.255.240':
				// A /28 can be shrunk by 2, 4 or 8
				if ($iShrink > 8) {
					return (Dict::Format('UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy', $iShrink));
				}
				break;

			default:
				// All other subnets can be shrunk by 2, 4, 8 or 16
				break;
		}

		switch ($iShrink) {
			case 2:
			default:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToShrink)) >> 1; // Shrink by 2 = shift bits by 1 to the right
				$iMaskNewSubnet |= ip2long("128.0.0.0");                       // For 64 bit machines 
				break;

			case 4:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToShrink)) >> 2; // Shrink by 4 = shift bits by 2 to the right
				$iMaskNewSubnet |= ip2long("192.0.0.0");                       // For 64 bit machines 
				break;

			case 8:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToShrink)) >> 3; // Shrink by 8 = shift bits by 3 to the right
				$iMaskNewSubnet |= ip2long("224.0.0.0");                       // For 64 bit machines 
				break;

			case 16:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToShrink)) >> 4; // Shrink by 16 = shift bits by 4 to the right
				$iMaskNewSubnet |= ip2long("240.0.0.0");                       // For 64 bit machines 
				break;
		}
		$sMaskNewSubnet = IPUtils::mylong2ip($iMaskNewSubnet);
		$iIpBroadcastNewSubnet = $iIpSubnetToShrink + IPUtils::MaskToSize($sMaskNewSubnet) - 1;

		// Check that no IP range within subnet sits across future border or becomes orphean
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = $iSubnetKey"));
		while ($oIpRange = $oIpRangeSet->Fetch()) {
			$iIpRangeFirstIp = IPUtils::myip2long($oIpRange->Get('firstip'));
			$iIpRangeLastIp = IPUtils::myip2long($oIpRange->Get('lastip'));
			if (($iIpRangeFirstIp < $iIpBroadcastNewSubnet) && ($iIpRangeLastIp > $iIpBroadcastNewSubnet)) {
				// IP range sits accross future border
				return (Dict::Format('UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeInTheMiddle', $oIpRange->Get('range'), $oIpRange->Get('firstip'), $oIpRange->Get('lastip')));
			} else {
				if ($iIpBroadcastNewSubnet <= $iIpRangeFirstIp) {
					// IP range is becoming orphean
					return (Dict::Format('UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeDropped', $oIpRange->Get('range'), $oIpRange->Get('firstip'), $oIpRange->Get('lastip')));
				}
			}
		}

		// Everything looks good
		return '';
	}

	/**
	 * Shrink the subnet
	 *
	 * @param $aParam
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DeleteException
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	function DoShrink($aParam)
	{
		// Set working variables
		$iOrgId = $this->Get('org_id');
		$sIpSubnetToShrink = $this->Get('ip');
		$iIpSubnetToShrink = IPUtils::myip2long($sIpSubnetToShrink);
		$sMaskSubnetToShrink = $this->Get('mask');
		$iMaskSubnetToShrink = IPUtils::myip2long($sMaskSubnetToShrink);
		$sIpBroadcastSubnetToShrink = $this->Get('broadcastip');
		$iShrink = $aParam['scale'];
		$iRequestorId = $aParam['requestor_id'];

		// Update initial subnet and register it.
		if (!is_null($iRequestorId)) {
			$this->Set('requestor_id', $iRequestorId);
		}
		switch ($iShrink) {
			case 2:
			default:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToShrink)) >> 1; // Shrink by 2 = shift bits by 1 to the right
				$iMaskNewSubnet |= ip2long('128.0.0.0');                       // For 64 bit machines 
				break;

			case 4:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToShrink)) >> 2; // Shrink by 4 = shift bits by 2 to the right
				$iMaskNewSubnet |= ip2long('192.0.0.0');                       // For 64 bit machines 
				break;

			case 8:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToShrink)) >> 3; // Shrink by 8 = shift bits by 3 to the right
				$iMaskNewSubnet |= ip2long('224.0.0.0');                       // For 64 bit machines 
				break;

			case 16:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToShrink)) >> 4; // Shrink by 16 = shift bits by 4 to the right
				$iMaskNewSubnet |= ip2long('240.0.0.0');                       // For 64 bit machines 
				break;
		}
		$sMaskNewSubnet = IPUtils::mylong2ip($iMaskNewSubnet);
		$iIpBroadcastNewSubnet = $iIpSubnetToShrink + IPUtils::MaskToSize($sMaskNewSubnet) - 1;
		$sIpBroadcastNewSubnet = IPUtils::mylong2ip($iIpBroadcastNewSubnet);
		$this->Set('mask', $sMaskNewSubnet);
		$this->Set('broadcastip', $sIpBroadcastNewSubnet);
		$this->Set('write_reason', 'shrink');
		$this->DBUpdate();

		// Delete old broadcast IP
		// Creation of missing broadcast IP is done by IPUtils::AfterUpdate
		$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sIpBroadcastSubnetToShrink' AND i.org_id = $iOrgId", null, false);
		if (!is_null($oIp)) {
			$oIp->DBDelete();
		}

		// Get list of all IPs that dropped from subnet and make them point to '0' - orphean IPs.
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sIpBroadcastNewSubnet') < INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcastSubnetToShrink') AND i.org_id = $iOrgId"));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch()) {
			$oIpRegistered->Set('subnet_id', 0);
			$oIpRegistered->DBUpdate();
		}
	}

	/**
	 * Check if subnet can be split
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
	function DoCheckToSplit($aParam)
	{
		// Set working variables
		$iSubnetKey = $this->GetKey();
		$sIpSubnetToSplit = $this->Get('ip');
		$iIpSubnetToSplit = IPUtils::myip2long($sIpSubnetToSplit);
		$sMaskSubnetToSplit = $this->Get('mask');
		$iMaskSubnetToSplit = IPUtils::myip2long($sMaskSubnetToSplit);
		$iSplit = $aParam['scale'];

		switch ($sMaskSubnetToSplit) {
			case '255.255.255.255':
			case '255.255.255.254':
				// To small to be split. Minimum size is /30
				return (Dict::Format('UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmall'));

			case '255.255.255.252':
				// A /30 can only be split by 2
				if ($iSplit > 2) {
					return (Dict::Format('UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy', $iSplit));
				}
				break;

			case '255.255.255.248':
				// A /29 can be split by 2 or 4
				if ($iSplit > 4) {
					return (Dict::Format('UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy', $iSplit));
				}
				break;

			case '255.255.255.240':
				// A /28 can be split by 2, 4 or 8
				if ($iSplit > 8) {
					return (Dict::Format('UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy', $iSplit));
				}
				break;

			default:
				// All other subnets can be split by 2, 4, 8 or 16
				break;
		}

		switch ($iSplit) {
			case 2:
			default:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToSplit)) >> 1; // Split by 2 = shift bits by 1 to the right
				$iMaskNewSubnet |= ip2long("128.0.0.0");                       // For 64 bit machines 
				break;

			case 4:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToSplit)) >> 2; // Split by 4 = shift bits by 2 to the right
				$iMaskNewSubnet |= ip2long("192.0.0.0");                       // For 64 bit machines 
				break;

			case 8:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToSplit)) >> 3; // Split by 8 = shift bits by 3 to the right
				$iMaskNewSubnet |= ip2long("224.0.0.0");                       // For 64 bit machines 
				break;

			case 16:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToSplit)) >> 4; // Split by 16 = shift bits by 4 to the right
				$iMaskNewSubnet |= ip2long("240.0.0.0");                       // For 64 bit machines 
				break;
		}
		$sMaskNewSubnet = IPUtils::mylong2ip($iMaskNewSubnet);
		$iSizeNewSubnet = IPUtils::MaskToSize($sMaskNewSubnet);

		// Check that no IP range within subnet sits across future borders
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = $iSubnetKey"));
		while ($oIpRange = $oIpRangeSet->Fetch()) {
			$iIpRangeFirstIp = IPUtils::myip2long($oIpRange->Get('firstip'));
			$iIpRangeLastIp = IPUtils::myip2long($oIpRange->Get('lastip'));
			$iIpNew = $iIpSubnetToSplit + $iSizeNewSubnet;
			// Find 1st subnet IP after 1st IP of range
			while ($iIpNew <= $iIpRangeFirstIp) {
				$iIpNew += $iSizeNewSubnet;
			}
			// If last IP of range not in new subnet boundary, cancel split operation
			if ($iIpNew <= $iIpRangeLastIp) {
				return (Dict::Format('UI:IPManagement:Action:Split:IPv4Subnet:IPRangeInTheMiddle', $oIpRange->Get('range'), $oIpRange->Get('firstip'), $oIpRange->Get('lastip')));
			}
		}

		// Everything looks good
		return '';
	}

	/**
	 * Split the subnet
	 *
	 * @param $aParam
	 *
	 * @return \CMDBObjectSet|\DBObjectSet
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \CoreWarning
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	function DoSplit($aParam)
	{
		// Set working variables
		$iOrgId = $this->Get('org_id');
		$iSubnetKey = $this->GetKey();
		$sIpSubnetToSplit = $this->Get('ip');
		$iIpSubnetToSplit = IPUtils::myip2long($sIpSubnetToSplit);
		$sMaskSubnetToSplit = $this->Get('mask');
		$iMaskSubnetToSplit = IPUtils::myip2long($sMaskSubnetToSplit);
		$iSplit = $aParam['scale'];
		$iRequestorId = $aParam['requestor_id'];

		switch ($iSplit) {
			case 2:
			default:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToSplit)) >> 1; // Split by 2 = shift bits by 1 to the right
				$iMaskNewSubnet |= ip2long("128.0.0.0");                       // For 64 bit machines 
				break;

			case 4:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToSplit)) >> 2; // Split by 4 = shift bits by 2 to the right
				$iMaskNewSubnet |= ip2long("192.0.0.0");                       // For 64 bit machines 
				break;

			case 8:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToSplit)) >> 3; // Split by 8 = shift bits by 3 to the right
				$iMaskNewSubnet |= ip2long("224.0.0.0");                       // For 64 bit machines 
				break;

			case 16:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToSplit)) >> 4; // Split by 16 = shift bits by 4 to the right
				$iMaskNewSubnet |= ip2long("240.0.0.0");                       // For 64 bit machines 
				break;
		}
		$sMaskNewSubnet = IPUtils::mylong2ip($iMaskNewSubnet);
		$iSizeNewSubnet = IPUtils::MaskToSize($sMaskNewSubnet);

		// Update initial subnet and register it.
		if (!is_null($iRequestorId)) {
			$this->Set('requestor_id', $iRequestorId);
		}
		$this->Set('mask', $sMaskNewSubnet);
		$this->Set('broadcastip', IPUtils::mylong2ip($iIpSubnetToSplit + $iSizeNewSubnet - 1));
		$this->Set('write_reason', 'split');
		$this->DBUpdate();

		// Create ($iSplit - 1) new split subnet in continuity of 1st one
		// Copy all parameters from 1st subnet but IP and mask
		// IP = First IP + (0x0...010...0)*$i - 1 is last bit of new mask
		// Ex 10.1.192.0 = 10.1.0.0 + (0.0.192.0)
		$oNewObj = array();
		$oNewObj[0] = $this;
		$iIpNew = $iIpSubnetToSplit + $iSizeNewSubnet;
		$iBlockId = $this->Get('block_id');
		$sStatus = $this->Get('status');
		$sType = $this->Get('type');
		$sComment = $this->Get('comment');
		$iRequestorId = $this->Get('requestor_id');
		$sReserveSubnetIPs = $this->Get('reserve_subnet_ips');
		for ($i = 1; $i < $iSplit; $i++) {
			$oNewObj[$i] = MetaModel::NewObject('IPv4Subnet');
			$oNewObj[$i]->Set('org_id', $iOrgId);
			$oNewObj[$i]->Set('ipconfig_id', $this->Get('ipconfig_id'));
			$oNewObj[$i]->Set('ip', IPUtils::mylong2ip($iIpNew));
			$oNewObj[$i]->Set('mask', $sMaskNewSubnet);
			$oNewObj[$i]->Set('broadcastip', IPUtils::mylong2ip($iIpNew + $iSizeNewSubnet - 1));
			$oNewObj[$i]->Set('block_id', $iBlockId);
			$oNewObj[$i]->Set('status', $sStatus);
			$oNewObj[$i]->Set('type', $sType);
			$oNewObj[$i]->Set('comment', $sComment);
			$oNewObj[$i]->Set('requestor_id', $iRequestorId);
			$oNewObj[$i]->Set('reserve_subnet_ips', $sReserveSubnetIPs);
			$oNewObj[$i]->DBInsert();
			$iIpNew += $iSizeNewSubnet;
		}

		// Link subnets to same locations as original subnet
		// Get list of 'lnkIPSubnetToLocation' objects referencing original subnet (if any))
		// Create as many 'lnkIPSubnetToLocation' objects for each new subnet and set parameters.
		$oSubnetToLocationSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT lnkIPSubnetToLocation AS l WHERE l.ipsubnet_id = $iSubnetKey"));
		while ($oSubnetToLocation = $oSubnetToLocationSet->Fetch()) {
			for ($i = 1; $i < $iSplit; $i++) {
				$oNewLocationLink = MetaModel::NewObject('lnkIPSubnetToLocation');
				$oNewLocationLink->Set('ipsubnet_id', $oNewObj[$i]->GetKey());
				$oNewLocationLink->Set('location_id', $oSubnetToLocation->Get('location_id'));
				$oNewLocationLink->DBInsert();
			}
		}

		// Update ranges (if any) with new subnet parameter
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = $iSubnetKey"));
		while ($oIpRange = $oIpRangeSet->Fetch()) {
			$iIpRangeLastIp = IPUtils::myip2long($oIpRange->Get('lastip'));
			$iIpNew = $iIpSubnetToSplit;
			while ($iIpRangeLastIp >= ($iIpNew + $iSizeNewSubnet)) {
				$iIpNew += $iSizeNewSubnet;
			}
			// Find subnet in array of newly created subnets
			$sIpNew = IPUtils::mylong2ip($iIpNew);
			/** @noinspection PhpStatementHasEmptyBodyInspection */
			for ($i = 0; (($i < $iSplit) && ($oNewObj[$i]->Get('ip') != $sIpNew)); $i++) {
			}
			$oIpRange->Set('subnet_id', $oNewObj[$i]->GetKey());
			$oIpRange->DBUpdate();
		}

		// Creation of missing broadcast and subnet IPs is done by IPv4Subnet::AfterInsert or IPv4Subnet::AfterUpdate

		// Set IPs in correct subnet
		for ($i = 1; $i < $iSplit; $i++) {
			$iSubnetKey = $oNewObj[$i]->GetKey();
			$sIpSubnet = $oNewObj[$i]->Get('ip');
			$sIpBroadcastSubnet = $oNewObj[$i]->Get('broadcastip');
			$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sIpSubnet') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcastSubnet') AND i.org_id = $iOrgId"));
			while ($oIpRegistered = $oIpRegisteredSet->Fetch()) {
				if ($oIpRegistered->Get('subnet_id') != $iSubnetKey) {
					$oIpRegistered->Set('subnet_id', $iSubnetKey);
					$oIpRegistered->DBUpdate();
				}
			}
		}

		// Display result as array
		$oSet = CMDBobjectSet::FromArray('IPv4Subnet', $oNewObj);

		return ($oSet);
	}

	/**
	 * Check if subnet can be expanded
	 *
	 * @param $aParam
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	function DoCheckToExpand($aParam)
	{
		// Set working variables
		$sIpSubnetToExpand = $this->Get('ip');
		$iIpSubnetToExpand = IPUtils::myip2long($sIpSubnetToExpand);
		$sMaskSubnetToExpand = $this->Get('mask');
		$iMaskSubnetToExpand = IPUtils::myip2long($sMaskSubnetToExpand);
		$iExpand = $aParam['scale'];

		// Confirm that subnet can be expanded as requested (protection against forged urls)
		if (($iMaskSubnetToExpand & IPUtils::myip2long('0.127.255.255')) == 0) {
			// To big to be expanded. Maximum size is /17 (by choice - bigger doesn't make sense))
			return (Dict::Format('UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy', $iExpand));
		}
		switch ($sMaskSubnetToExpand) {
			case '255.255.128.0.':
				// A /128 can only be expanded by 2
				if ($iExpand > 2) {
					return (Dict::Format('UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy', $iExpand));
				}
				break;

			case '255.255.192.0':
				// A /192 can be expanded by 2 or 4
				if ($iExpand > 4) {
					return (Dict::Format('UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy', $iExpand));
				}
				break;

			case '255.255.224.0':
				// A /192 can be expanded by 2, 4 or 8
				if ($iExpand > 8) {
					return (Dict::Format('UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy', $iExpand));
				}
				break;

			default:
				// All other subnets can be expanded by 2, 4, 8 or 16
				break;
		}

		switch ($iExpand) {
			case 2:
			default:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToExpand)) << 1; // Expand by 2 = shift bits by 1 to the left
				break;

			case 4:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToExpand)) << 2; // Expand by 4 = shift bits by 2 to the left
				break;

			case 8:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToExpand)) << 3; // Expand by 8 = shift bits by 3 to the left
				break;

			case 16:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToExpand)) << 4; // Expand by 16 = shift bits by 4 to the left
				break;
		}
		$sMaskNewSubnet = IPUtils::mylong2ip($iMaskNewSubnet);
		$iIpNewSubnet = IPUtils::myip2long(long2ip(ip2long(long2ip($iIpSubnetToExpand)) & ip2long(long2ip($iMaskNewSubnet))));
		$iIpBroadcastNewSubnet = $iIpNewSubnet + IPUtils::MaskToSize($sMaskNewSubnet) - 1;

		// Check that new subnet is fully contained within its block. If not, cancell the action
		$oBlock = MetaModel::GetObject('IPv4Block', $this->Get('block_id'), true /* MustBeFound */);
		$sBlockLastIp = $oBlock->Get('lastip');
		$iBlockLastIp = IPUtils::myip2long($sBlockLastIp);
		if (($iIpNewSubnet < IPUtils::myip2long($oBlock->Get('firstip'))) || ($iBlockLastIp < $iIpBroadcastNewSubnet)) {
			return (Dict::Format('UI:IPManagement:Action:Expand:IPv4Subnet:NotInIPBlock'));
		}


		// Everything looks good
		return '';
	}

	/**
	 * Expand the subnet
	 *
	 * @param $aParam
	 *
	 * @return $this|\DBObject|null
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DeleteException
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	function DoExpand($aParam)
	{
		// Set working variables
		$iOrgId = $this->Get('org_id');
		$iNewSubnetKey = $this->GetKey();
		$sIpSubnetToExpand = $this->Get('ip');
		$iIpSubnetToExpand = IPUtils::myip2long($sIpSubnetToExpand);
		$sMaskSubnetToExpand = $this->Get('mask');
		$iMaskSubnetToExpand = IPUtils::myip2long($sMaskSubnetToExpand);
		$iExpand = $aParam['scale'];
		$iRequestorId = $aParam['requestor_id'];

		switch ($iExpand) {
			case 2:
			default:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToExpand)) << 1; // Expand by 2 = shift bits by 1 to the left
				break;

			case 4:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToExpand)) << 2; // Expand by 4 = shift bits by 2 to the left
				break;

			case 8:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToExpand)) << 3; // Expand by 8 = shift bits by 3 to the left
				break;

			case 16:
				$iMaskNewSubnet = ip2long(long2ip($iMaskSubnetToExpand)) << 4; // Expand by 16 = shift bits by 4 to the left
				break;
		}
		$sMaskNewSubnet = IPUtils::mylong2ip($iMaskNewSubnet);
		$iIpNewSubnet = IPUtils::myip2long(long2ip(ip2long(long2ip($iIpSubnetToExpand)) & ip2long(long2ip($iMaskNewSubnet))));
		$sIpNewSubnet = IPUtils::mylong2ip($iIpNewSubnet);
		$iIpBroadcastNewSubnet = $iIpNewSubnet + IPUtils::MaskToSize($sMaskNewSubnet) - 1;
		$sIpBroadcastNewSubnet = IPUtils::mylong2ip($iIpBroadcastNewSubnet);

		// List subnets currently in range of new subnet and delete them all but the one newly updated one
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE INET_ATON(s.ip) >= INET_ATON('$sIpNewSubnet') AND INET_ATON(s.ip) <= INET_ATON('$sIpBroadcastNewSubnet') AND s.org_id = $iOrgId"));
		while ($oSubnet = $oSubnetSet->Fetch()) // While there is a subnet in the list
		{
			$iSubnetKey = $oSubnet->GetKey();

			// If current subnet and initial subnet are not the same
			if ($iSubnetKey != $iNewSubnetKey) {
				// Find all links to locations and delete them first
				$oSubnetToLocationSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT lnkIPSubnetToLocation AS l WHERE l.ipsubnet_id = $iSubnetKey"));
				while ($oSubnetToLocation = $oSubnetToLocationSet->Fetch()) {
					$oSubnetToLocation->DBDelete();
				}

				// Find all IP Ranges attached to legacy subnet and attach them to new one
				$oSubnetRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = $iSubnetKey"));
				while ($oRange = $oSubnetRangeSet->fetch()) {
					$oRange->Set('write_reason', 'expand');
					$oRange->Set('subnet_id', $iNewSubnetKey);
					$oRange->DBUpdate();
				}

				// Find all subnet request tickets attached to legacy subnet and remove reference to subnet
				if (MetaModel::IsValidClass('IPRequestSubnet')) {
					$oSubnetRequestSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPRequestSubnet AS r WHERE r.subnet_id = $iSubnetKey"));
					while ($oSubnetRequest = $oSubnetRequestSet->fetch()) {
						$oSubnetRequest->Set('subnet_id', 0);
						$oSubnetRequest->DBUpdate();
					}
				}

				// Delete current subnet
				$oSubnet->Set('write_reason', 'expand');
				$oSubnet->DBDelete();
			}
		}

		// Update initial subnet and register it.
		// This action MUST be done after deletion of potential subnets included in order to avoid rejection of change by CheckToWrite !
		if (!is_null($iRequestorId)) {
			$this->Set('requestor_id', $iRequestorId);
		}
		$this->Set('ip', $sIpNewSubnet);
		$this->Set('mask', $sMaskNewSubnet);
		$this->Set('broadcastip', $sIpBroadcastNewSubnet);
		$this->Set('write_reason', 'expand');
		$this->DBUpdate();

		// List Subnet IPs in new subnet. Delete them all but the new subnet IP if any
		// Creation of subnet IP is done by IPv4Subnet::AfterUpdate()
		$sUsageNetworkIpId = IPUsage::GetIpUsageId($iOrgId, NETWORK_IP_CODE);
		$oIpSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE i.usage_id = $sUsageNetworkIpId AND INET_ATON(i.ip) >= INET_ATON('$sIpNewSubnet') AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcastNewSubnet') AND i.org_id = $iOrgId"));
		while ($oIp = $oIpSubnetSet->Fetch()) {
			if ($oIp->Get('ip') != $sIpNewSubnet) {
				$oIp->DBDelete();
			}
		}

		// List Gateway IPs in new subnet. Delete them all but the new broadcast IP if any
		// Creation of broadcast IP is done by IPv4Subnet::AfterUpdate()
		$sIpGatewayIpNewSubnet = $this->Get('gatewayip');
		$sUsageGatewayIpId = IPUsage::GetIpUsageId($iOrgId, GATEWAY_IP_CODE);
		$oGatewayIPSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE i.usage_id = $sUsageGatewayIpId AND INET_ATON(i.ip) >= INET_ATON('$sIpNewSubnet') AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcastNewSubnet') AND i.org_id = $iOrgId"));
		while ($oIp = $oGatewayIPSet->Fetch()) {
			if ($oIp->Get('ip') != $sIpGatewayIpNewSubnet) {
				$oIp->DBDelete();
			}
		}

		// List Broadcast IPs in new subnet. Delete them all but the new broadcast IP if any
		// Creation of broadcast IP is done by IPv4Subnet::AfterUpdate()
		$sUsageBroadcastIpId = IPUsage::GetIpUsageId($iOrgId, BROADCAST_IP_CODE);
		$oBroadcastSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE i.usage_id = $sUsageBroadcastIpId AND INET_ATON(i.ip) >= INET_ATON('$sIpNewSubnet') AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcastNewSubnet') AND i.org_id = $iOrgId"));
		while ($oIp = $oBroadcastSet->Fetch()) {
			if ($oIp->Get('ip') != $sIpBroadcastNewSubnet) {
				$oIp->DBDelete();
			}
		}

		// Get list of all IPs within new subnet and make sure they all point to new subnet.
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sIpNewSubnet') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcastNewSubnet') AND i.org_id = $iOrgId"));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch()) {
			if ($oIpRegistered->Get('subnet_id') != $iNewSubnetKey) {
				$oIpRegistered->Set('subnet_id', $iNewSubnetKey);
				$oIpRegistered->DBUpdate();
			}
		}

		// Return 'new' subnet
		if ($sIpSubnetToExpand != $sIpNewSubnet) {
			// Otherwise wrong subnet IP is displayed in array...
			$oObj = MetaModel::GetObject('IPv4Subnet', $iNewSubnetKey, true /* MustBeFound */);

			return $oObj;
		} else {
			return $this;
		}
	}

	/**
	 * @inheritDoc
	 */
	public function DoCheckToExplodeFQDN($sFqdnAttr)
	{
		if (!in_array($sFqdnAttr, MetaModel::GetAttributesList('IPv4Address'))) {
			// $sFqdnAttr is not a valid attribute for the class
			return (Dict::Format('UI:IPManagement:Action:ExplodeFQDN:IPAddress:FQDNAttributeDoesNotExist', $sFqdnAttr));
		}

		return '';
	}

	/**
	 * @inheritDoc
	 */
	public function DoExplodeFQDN($sFqdnAttr)
	{
		$iKey = $this->GetKey();
		$oIPsSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address WHERE $sFqdnAttr != '' AND $sFqdnAttr != fqdn AND subnet_id = :key"), array(), array('key' => $iKey));
		while ($oIP = $oIPsSet->Fetch()) {
			$oIP->DoExplodeFQDN($sFqdnAttr);
		}
	}

	/**
	 * Display subnet in the node of a hierarchical tree
	 *
	 * @param $bWithIcon
	 * @param $iTreeOrgId
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	public function GetAsLeaf($bWithIcon, $iTreeOrgId)
	{
		$sHtml = $this->GetHyperlink();
		$sHtml .= "&nbsp;".Dict::S('Class:IPv4Subnet/Attribute:mask/Value_cidr:'.$this->Get('mask'));

		return $sHtml;
	}

	/**
	 * @inheritDoc
	 */
	protected function DisplayMainAttributesForOperationV3(iTopWebPage $oP, $oColumn)
	{
		// Parent block
		$val = $this->GetClassFieldForDisplay('IPv4Subnet', 'block_id', '');
		$oColumn->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));

		// First IP
		$val = $this->GetClassFieldForDisplay('IPv4Subnet', 'ip', '');
		$oColumn->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));

		//  Last IP
		$val = $this->GetClassFieldForDisplay('IPv4Subnet', 'mask', '');
		$oColumn->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));

		parent::DisplayMainAttributesForOperationV3($oP, $oColumn);
	}

	/**
	 * @inheritdoc
	 */
	protected function DisplayActionFieldsForOperationV3(iTopWebPage $oP, $oObjectDetails, $sOperation, $aDefault)
	{
		$oMultiColumn = new MultiColumn();
		$oP->AddUIBlock($oMultiColumn);

		// First column = labels or fields
		$oColumn1 = new Column();
		$oMultiColumn->AddColumn($oColumn1);
		switch ($sOperation) {
			case 'findspace':
				// Second column = data
				$oColumn2 = new Column();
				$oMultiColumn->AddColumn($oColumn2);

				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeOfRange');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:FindSpace:IPv4Subnet:MaxNumberOfOffers');

				// Size of range
				$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph($sLabelOfAction1));
				$oColumn1->AddSubBlock(HtmlFactory::MakeRaw('<br>'));
				$oInput = InputUIBlockFactory::MakeStandard('integer', 'spacesize', '');
				$oColumn2->AddSubBlock($oInput);
				$oColumn2->AddSubBlock(HtmlFactory::MakeRaw('<br>'));

				// Max number of offers
				$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph($sLabelOfAction2));
				$oColumn1->AddSubBlock(HtmlFactory::MakeRaw('<br>'));
				$oInput = InputUIBlockFactory::MakeStandard('integer', 'maxoffer', DEFAULT_MAX_FREE_SPACE_OFFERS);
				$oColumn2->AddSubBlock($oInput);
				break;

			case 'listips':
			case 'csvexportips':
				$sTextOperation = ($sOperation == 'listips') ? 'ListIps' : 'CsvExportIps';
				$sSubTitle = Dict::S('UI:IPManagement:Action:'.$sTextOperation.':IPv4Subnet:Subtitle_ListRange');
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:'.$sTextOperation.':IPv4Subnet:FirstIP');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:'.$sTextOperation.':IPv4Subnet:LastIP');

				// Subtitle
				$oColumn1->AddHtml($sSubTitle.'<br><br>');

				// First IP
				$val = $this->GetClassFieldForForm($oP, '', 'IPv4Range', 'firstip', $sLabelOfAction1, '', OPT_ATT_MANDATORY);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));

				// Last IP
				$val = $this->GetClassFieldForForm($oP, '', 'IPv4Range', 'lastip', $sLabelOfAction2, '', OPT_ATT_MANDATORY);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));
				break;

			case 'shrinksubnet':
			case 'splitsubnet':
			case 'expandsubnet':
				// Remind main attributes to user first
				$this->DisplayMainAttributesForOperationV3($oP, $oColumn1);

				$oColumn2 = new Column();
				$oMultiColumn->AddColumn($oColumn2);

				if ($sOperation == 'shrinksubnet') {
					$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Shrink:IPv4Subnet:By');
				} elseif ($sOperation == 'splitsubnet') {
					$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Split:IPv4Subnet:In');
				} elseif ($sOperation == 'expandsubnet') {
					$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Expand:IPv4Subnet:By');
				}

				// Scale of action
				$sInputId = $this->m_iFormId.'_'.'scale';
				$sHTML = "<td><select id=\"$sInputId\" name=\"scale\">\n";
				$jDefault = (array_key_exists('scale', $aDefault)) ? $aDefault['scale'] : 1;
				$j = 1;
				$iScaleMax = $this->GetScaleOfOperation($sOperation);
				for ($i = 1; $i <= $iScaleMax; $i++) {
					$j = $j * 2;
					if ($j == $jDefault) {
						$sHTML .= "<option selected='' value=\"$j\">$j</option>\n";
					} else {
						$sHTML .= "<option value=\"$j\">$j</option>\n";
					}
				}
				$sHTML .= "</select></td><td>";
				$val = $this->GetSimpleFieldForForm('AttributeInteger', 'scale', $sLabelOfAction1, $sHTML);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));
				break;

			case 'calculator':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Calculator:IPv4Subnet:IP');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:Calculator:IPv4Subnet:Mask');
				$sLabelOfAction3 = Dict::S('UI:IPManagement:Action:Calculator:IPv4Subnet:CIDR');

				// IP
				$val = $this->GetClassFieldForForm($oP, '', 'IPv4Subnet', 'ip', $sLabelOfAction1, '', OPT_ATT_MANDATORY);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));

				// Mask
				$val = $this->GetClassFieldForForm($oP, '', 'IPv4Subnet', 'gatewayip', $sLabelOfAction2, '', OPT_ATT_NORMAL);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));

				// CIDR
				$sInputId = $this->m_iFormId.'_cidr';
				$sHTML = "<input type=\"number\" id=\"$sInputId\" name=\"cidr\">\n";
				$val = $this->GetSimpleFieldForForm('AttributeInteger', 'cidr', $sLabelOfAction3, $sHTML);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));
				break;

			default:
				break;
		};
	}

	/**
	 * Get result of IPv4calculator
	 *
	 * @param \WebPage $oP
	 * @param $aParam
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function GetCalculatorOutput(WebPage $oP, $aParam)
	{
		$sIp = $aParam['ip'];
		$sMask = $aParam['mask'];
		if ($sMask != '') {
			$iCidr = IPUtils::MaskToBit($sMask);
		} else {
			$iCidr = $aParam['cidr'];
			$sMask = IPUtils::BitToMask($iCidr);
		}
		$iIp = ip2long($sIp);
		$iMask = ip2long($sMask);

		$iSubnetIp = $iIp & $iMask;
		$sSubnetIp = IPUtils::mylong2ip($iSubnetIp);

		$sWildCard = long2ip(~(ip2long($sMask)));

		$iBroadcastIp = $iSubnetIp + IPUtils::MaskToSize($sMask) - 1;
		$sBroadcastIp = IPUtils::mylong2ip($iBroadcastIp);

		$iIpNumber = IPUtils::MaskToSize($sMask);
		if ($iIpNumber > 2) {
			$iUsableHosts = $iIpNumber - 2;
		} else {
			$iUsableHosts = 0;
		}

		if ($sSubnetIp == '0.0.0.0') {
			$sPreviousSubnetIp = Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet:NA');
		} else {
			$iPreviousSubnetIp = ($iSubnetIp - 1) & $iMask;
			$sPreviousSubnetIp = IPUtils::mylong2ip($iPreviousSubnetIp);
		}

		if ($sBroadcastIp == '255.255.255.255') {
			$sNextSubnetIp = Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet:NA');
		} else {
			$iNextSubnetIp = $iSubnetIp + IPUtils::MaskToSize($sMask);
			$sNextSubnetIp = IPUtils::mylong2ip($iNextSubnetIp);
		}

		$sHtml = '';
		$sHtml .= '<table style="vertical-align:top;"><tr><td>';
		$sHtml .= '<div id="tree">';
		// IP address
		$sHtml .= '&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:IP').":</td><td>$sIp</td></tr>";
		$sHtml .= '<tr><td height=10></td></tr>';

		// Subnet IP
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:SubnetIP').":</td><td><b>$sSubnetIp</b></td></tr>";

		// Subnet Mask
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:Mask').":</td><td>$sMask</td></tr>";

		// CIDR
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:CIDR').":</td><td>$iCidr</td></tr>";

		// Wildcard Mask
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:Wildcard').":</td><td>$sWildCard</td></tr>";
		$sHtml .= '<tr><td height=10></td></tr>';

		// Broadcast IP
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:BroadcastIP').":</td><td><b>$sBroadcastIp</b></td></tr>";

		// Number of IPs
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:IPNumber').":</td><td>$iIpNumber</td></tr>";

		// Number of usable hosts
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:UsableHosts').":</td><td>$iUsableHosts</td></tr>";
		$sHtml .= '<tr><td height=10></td></tr>';

		// Previous network
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet').":</td><td>$sPreviousSubnetIp</td></tr>";

		// Next network
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet').":</td><td>$sNextSubnetIp</td></tr>";
		$sHtml .= '<tr><td height=10></td></tr>';

		// As an option, create subnet or block with calculated parameters (previous, current or next one)
		$UserHasRightsToCreateBlocks = (UserRights::IsActionAllowed('IPv4Block', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
		$UserHasRightsToCreateSubnets = (UserRights::IsActionAllowed('IPv4Subnet', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
		if (!$UserHasRightsToCreateBlocks && !$UserHasRightsToCreateSubnets) {
			return $sHtml;
		}

		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td colspan="2">'.Dict::S('UI:IPManagement:Action:DoCalculator:IPSubnet:SelectCreation').'</td></tr>';
		if ($this->GetKey() > 0) {
			$iOrgId = $this->Get('org_id');
			$iBlockMinSize = IPConfig::GetFromGlobalIPConfig('ipv4_block_min_size', $iOrgId);
		} else {
			$iBlockMinSize = IPV4_BLOCK_MIN_SIZE;
		}
		$bOfferBlock = ($iIpNumber >= $iBlockMinSize) ? true : false;
		$bOfferSubnet = ($iCidr >= IPV4_SUBNET_MAX_PREFIX) ? true : false;

		$iVIdCounter = 1;
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$aSubnetIps = array();
		if ($sSubnetIp != '0.0.0.0') {
			$aSubnetIps[$sPreviousSubnetIp] = IPUtils::mylong2ip($iSubnetIp - 1);
		}
		$aSubnetIps[$sSubnetIp] = $sBroadcastIp;
		if ($sBroadcastIp != '255.255.255.255') {
			$aSubnetIps[$sNextSubnetIp] = IPUtils::mylong2ip(ip2long($sNextSubnetIp) + IPUtils::MaskToSize($sMask) - 1);
		}
		foreach ($aSubnetIps as $sFirstIp => $sLastIp) {
			if ($sFirstIp == $sSubnetIp) {
				$sHtml .= '<tr><td></td><td>&nbsp;&nbsp;</td><td><b>'.$sFirstIp.' /'.$iCidr.'</b></td>';
			} else {
				$sHtml .= '<tr><td></td><td>&nbsp;&nbsp;</td><td>'.$sFirstIp.' /'.$iCidr.'</td>';
			}

			$sHTMLValue = '';
			if ($UserHasRightsToCreateBlocks) {
				if ($bOfferBlock) {
					$iVId = $iVIdCounter++;
					$sHTMLValue .= "<td><div><span id=\"v_{$iVId}\">";
					$sHTMLValue .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/asset/img/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
					$sHTMLValue .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoCalculator:IPSubnet:CreateBlock')."&nbsp;&nbsp;";
					$sHTMLValue .= "</span></div></td></tr>";
					$sHtml .= $sHTMLValue;
					$oP->add_ready_script(
						<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv4Block', '', 0, {'org_id': '$iOrgId', 'parent_id': '$iId', 'firstip': "$sFirstIp", 'lastip': '$sLastIp'});
EOF
					);
				} else {
					$sHTMLValue .= '<td>'.Dict::S('UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateBlock:MaskIsToBig').'</td></tr>';
					$sHtml .= $sHTMLValue;
				}
				$sHTMLValue = "<tr><td></td><td></td><td></td>";
			}
			if ($UserHasRightsToCreateSubnets) {
				if ($bOfferSubnet) {
					$iVId = $iVIdCounter++;
					$sHTMLValue .= "<td><div><span id=\"v_{$iVId}\">";
					$sHTMLValue .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/asset/img/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
					$sHTMLValue .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoCalculator:IPSubnet:CreateSubnet')."&nbsp;&nbsp;";
					$sHTMLValue .= "</span></div></td>";
					$sHtml .= $sHTMLValue;
					$oP->add_ready_script(
						<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv4Subnet', '', 0, {'org_id': '$iOrgId', 'parent_id': '$iId', 'ip': "$sFirstIp", 'mask': '$sMask'});
EOF
					);
				} else {
					$sHTMLValue .= "<td>".Dict::S('UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateSubnet:MaskIsToSmall')."</td></tr>";
					$sHtml .= $sHTMLValue;
				}
			}

		}
		$sHtml .= '</div></td></tr></table>';

		$oP->add_ready_script("\$('#tree ul').treeview();\n");
		$oP->add_dict_entry('UI:ValueMustBeSet');
		$oP->add_dict_entry('UI:ValueMustBeChanged');
		$oP->add_dict_entry('UI:ValueInvalidFormat');

		return $sHtml;
	}

	/**
	 * @inheritDoc
	 */
	public function DisplayBareRelations(WebPage $oPage, $bEditMode = false)
	{
		// Execute parent function first 
		parent::DisplayBareRelations($oPage, $bEditMode);

        if ($this->GetDisplayMode() == static::ENUM_DISPLAY_MODE_VIEW) {
			// Add related style sheet
            if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.2', '<')) {
                $oPage->add_linked_stylesheet(utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/asset/css/teemip-ip-mgmt.css');
            } else {
                $oPage->LinkStylesheetFromModule('teemip-ip-mgmt/asset/css/teemip-ip-mgmt.css');
            }

			$iOrgId = $this->Get('org_id');
			$iKey = $this->GetKey();
			$sIp = $this->Get('ip');
			$sIpBroadcast = $this->Get('broadcastip');
			$iSubnetSize = $this->GetSize();

			// Tab for Registered IPs
			$oIpRegisteredSearch = DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcast') AND i.org_id = $iOrgId");
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
				$sHtml = '<div class="teemip-space-occupation">'.$this->GetAsHTML('ip_occupancy').Dict::Format('Class:IPSubnet/Tab:ipregistered-count', $iReserved, $iAllocated, $iReleased, $iUnallocated, $iSubnetSize).'</div>';
			} else {
				$sHtml = '';
			}
			$sName = Dict::S('Class:IPSubnet/Tab:ipregistered');
			$sTitle = Dict::S('Class:IPSubnet/Tab:ipregistered+');
			IPUtils::DisplayTabContent($oPage, $sName, 'ip_addresses', 'IPv4Address', $sTitle, $sHtml, $oIpRegisteredSet, false);

			// Tab for IP Ranges
			$oIpRangeSearch = DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = '$iKey' AND r.org_id = $iOrgId");
			$oIpRangeSet = new CMDBObjectSet($oIpRangeSearch);
			$iIpRange = $oIpRangeSet->Count();
			if ($iIpRange > 0) {
				$iCountRange = 0;
				while ($oIpRange = $oIpRangeSet->Fetch()) {
					$iCountRange += IPUtils::myip2long($oIpRange->Get('lastip')) - IPUtils::myip2long($oIpRange->Get('firstip')) + 1;
				}
				$sHtml = '<div class="teemip-space-occupation">'.$this->GetAsHTML('range_occupancy').Dict::Format('Class:IPSubnet/Tab:iprange-count-percent').'</div>';
			} else {
				$sHtml = '';
			}
			$sName = Dict::S('Class:IPSubnet/Tab:iprange');
			$sTitle = Dict::S('Class:IPSubnet/Tab:iprange+');
			IPUtils::DisplayTabContent($oPage, $sName, 'ip_ranges', 'IPv4Range', $sTitle, $sHtml, $oIpRangeSet, false);

			// Tab for IP Requests
			if (MetaModel::IsValidClass('IPRequestSubnet')) {
				$oSubnetRequestSearch = DBObjectSearch::FromOQL("SELECT IPRequestSubnet AS r WHERE r.subnet_id = $iKey");
				$oSubnetRequestSet = new CMDBObjectSet($oSubnetRequestSearch);
				$sName = Dict::S('Class:IPSubnet/Tab:requests');
				$sTitle = Dict::S('Class:IPSubnet/Tab:requests+');
				IPUtils::DisplayTabContent($oPage, $sName, 'subnet_requests', 'IPRequestSubnet', $sTitle, '', $oSubnetRequestSet, false);
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	public function ComputeValues()
	{
		parent::ComputeValues();

		$sIp = $this->Get('ip');
		$iIp = IPUtils::myip2long($sIp);
		$sMask = $this->Get('mask');
		$iOrgId = $this->Get('org_id');

		// Set Broadcast IP
		$iIpBroadcast = $iIp + $this->GetSize() - 1;
		$sIpBroadcast = IPUtils::mylong2ip($iIpBroadcast);
		$this->Set('broadcastip', $sIpBroadcast);

		// Set Gateway IP
		if ($sMask != '255.255.255.255') {
			$sGatewayIPFormat = $this->Get('ipv4_gateway_ip_format');
			if ($sGatewayIPFormat == 'default') {
				$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv4_gateway_ip_format', $iOrgId);
			}
			switch ($sGatewayIPFormat) {
				case 'subnetip_plus_1':
					$iGatewayIp = $iIp + 1;
					$sGatewayIp = IPUtils::mylong2ip($iGatewayIp);
					break;

				case 'broadcastip_minus_1':
					$iGatewayIp = $iIpBroadcast - 1;
					$sGatewayIp = IPUtils::mylong2ip($iGatewayIp);
					break;

				case 'free_setup':
				default:
					$sGatewayIp = $this->Get('gatewayip');
					break;
			}
		} else {
			$sGatewayIp = $sIp;
		}
		$this->Set('gatewayip', $sGatewayIp);

		// Set parent block if not set
		// Note: this may give incorrect result if only one block exists under the organization since, in such case, framework preset block_id to that unique block as block_id cannot be null
		if (($sIp != '') && ($sMask != '')) {
			// Look for all blocks containing the new subnet
			// Pick the smallest one
			$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE INET_ATON(b.firstip) <= INET_ATON('$sIp') AND INET_ATON('$sIpBroadcast') <= INET_ATON(b.lastip) AND b.org_id = $iOrgId"));
			$iMinSize = 0;
			$iBlockId = 0;
			while ($oSRange = $oSRangeSet->Fetch()) {
				$iSRangeSize = $oSRange->GetSize();
				if (($iMinSize == 0) || ($iSRangeSize < $iMinSize)) {
					$iMinSize = $iSRangeSize;
					$iBlockId = $oSRange->GetKey();
				}
			}
			if ($iBlockId != 0) {
				$this->Set('block_id', $iBlockId);
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	function DoCheckToWrite()
	{
		// Run standard iTop checks first
		parent::DoCheckToWrite();

		$iOrgId = $this->Get('org_id');
		if ($this->IsNew()) {
			$iKey = -1;
		} else {
			$iKey = $this->GetKey();
		}
		$sIp = $this->Get('ip');
		$sMask = $this->Get('mask');
		$iIp = IPUtils::myip2long($sIp);
		$Size = $this->GetSize();
		$iIpBroadcast = $iIp + $Size - 1;
		$iBlockId = $this->Get('block_id');

		// Forbid change of subnet IP but for subnet expansion
		//		As we look for subnet by its key, we cannot have an org mismatch
		$oSubnet = MetaModel::GetObject('IPv4Subnet', $iKey, false /* MustBeFound */);
		if (!is_null($oSubnet)) {
			if (($sIp != $oSubnet->Get('ip')) && ($this->Get('write_reason') != 'expand')) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:IpCannotChange');

				return;
			}
		}

		// Forbid change of subnet mask unless required by programmatic functions
		//		As we look for subnet by its key, we cannot have an org mismatch
		$sWriteReason = $this->Get('write_reason');
		if (($sWriteReason != 'shrink') && ($sWriteReason != 'split') && ($sWriteReason != 'expand')) {
			$oSubnet = MetaModel::GetObject('IPv4Subnet', $iKey, false /* MustBeFound */);
			if (!is_null($oSubnet) && ($sMask != $oSubnet->Get('mask'))) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:MaskCannotChange');

				return;
			}
		}

		// Check consitency between subnet IP and mask. IP must be aligned with block defined by mask.
		if (!$this->DoCheckCIDRAligned()) {
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:IpIncorrect');

			return;
		}

		// Make sure subnet is fully contained in range
		$oBlock = MetaModel::GetObject('IPv4Block', $this->Get('block_id'), true /* MustBeFound */);
		$iBlockLastIp = IPUtils::myip2long($oBlock->Get('lastip'));
		if (($iIp < IPUtils::myip2long($oBlock->Get('firstip'))) || ($iBlockLastIp < $iIpBroadcast)) {
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:NotInBlock');

			return;
		}

		// Make sure subnet doesn't collide with another subnet
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = $iBlockId AND s.org_id = $iOrgId"));
		while ($oSubnet = $oSubnetSet->Fetch()) {
			// If it's a modification (keys are the same) further checks are not relevant
			if ($oSubnet->GetKey() != $iKey) {
				$iCurrentIp = IPUtils::myip2long($oSubnet->Get('ip'));
				$iCurrentIpBroadcast = IPUtils::myip2long($oSubnet->Get('broadcastip'));

				// Does the subnet already exist?
				if (($iCurrentIp == $iIp) && ($iCurrentIpBroadcast == $iIpBroadcast)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision0');

					return;
				}
				// Is the subnet IP part of an existing subnet?
				if (($iCurrentIp <= $iIp) && ($iIp <= $iCurrentIpBroadcast) && ($sWriteReason != 'expand')) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision1');

					return;
				}
				// Is the broadcast IPs part of an existing subnet?
				if (($iCurrentIp <= $iIpBroadcast) && ($iIpBroadcast <= $iCurrentIpBroadcast) && ($sWriteReason != 'expand')) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision2');

					return;
				}
				// Is new subnet including an existing one?
				if (($iIp < $iCurrentIp) && ($iCurrentIpBroadcast < $iIpBroadcast) && ($sWriteReason != 'expand')) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision3');

					return;
				}
			}
		}

		// If allocation of Gateway Ip is free, make sure it is contained in subnet
		$sGatewayIPFormat = $this->Get('ipv4_gateway_ip_format');
		if ($sGatewayIPFormat == 'default') {
			$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv4_gateway_ip_format', $iOrgId);
		}
		if ($sGatewayIPFormat == 'free_setup') {
			$sGatewayIp = $this->Get('gatewayip');
			if ($sGatewayIp != '') {
				if (!$this->DoCheckIpInSubnet($sGatewayIp)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:GatewayOutOfSubnet');

					return;
				}
			}
		}

		// Reset reason for action
		$this->Set('write_reason', 'none');
	}

	/**
	 * @inheritdoc
	 */
	protected function AfterInsert()
	{
		parent::AfterInsert();

		$iOrgId = $this->Get('org_id');
		$iId = $this->GetKey();
		$sSubnetIp = $this->Get('ip');
		$sMask = $this->Get('mask');
		$sGatewayIp = $this->Get('gatewayip');
		$sIpBroadcast = $this->Get('broadcastip');

		// Check if subnet and broadcast IPs need to be created / updated or not
		if ($sMask != '255.255.255.255') {
			$sReserveSubnetIPs = $this->Get('reserve_subnet_ips');
			if ($sReserveSubnetIPs == 'default') {
				$sReserveSubnetIPs = IPConfig::GetFromGlobalIPConfig('reserve_subnet_IPs', $iOrgId);
			}
			if ($sReserveSubnetIPs == 'reserve_yes') {
				// Create or update subnet IP
				$sUsageNetworkIpId = IPUsage::GetIpUsageId($iOrgId, NETWORK_IP_CODE);
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = :subnetip AND i.org_id = :org_id", array('subnetip' => $sSubnetIp, 'org_id' => $iOrgId), false);
				if (is_null($oIp)) {
					$oIp = MetaModel::NewObject('IPv4Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $sSubnetIp);
					$oIp->Set('org_id', $iOrgId);
					$oIp->Set('ipconfig_id', $this->Get('ipconfig_id'));
					$oIp->Set('status', 'reserved');
					$oIp->Set('usage_id', $sUsageNetworkIpId);
					$oIp->DBInsert();
				} else {
					if (($oIp->Get('status') != 'reserved') || ($oIp->Get('usage_id') != $sUsageNetworkIpId)) {
						$oIp->Set('subnet_id', $iId);
						$oIp->Set('status', 'reserved');
						$oIp->Set('usage_id', $sUsageNetworkIpId);
						$oIp->DBUpdate();
					}
				}

				if ($sMask != '255.255.255.254') {
					// Create or update gateway IP... if one has been chosen
					if ($sGatewayIp !=  '') {
						$sUsageGatewayIpId = IPUsage::GetIpUsageId($iOrgId, GATEWAY_IP_CODE);
						$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = :gatewayip AND i.org_id = :org_id", array('gatewayip' => $sGatewayIp, 'org_id' => $iOrgId), false);
						if (is_null($oIp)) {
							$oIp = MetaModel::NewObject('IPv4Address');
							$oIp->Set('subnet_id', $iId);
							$oIp->Set('ip', $sGatewayIp);
							$oIp->Set('org_id', $iOrgId);
							$oIp->Set('ipconfig_id', $this->Get('ipconfig_id'));
							$oIp->Set('status', 'reserved');
							$oIp->Set('usage_id', $sUsageGatewayIpId);
							$oIp->DBInsert();
						} else {
							if (($oIp->Get('status') != 'reserved') || ($oIp->Get('usage_id') != $sUsageGatewayIpId)) {
								$oIp->Set('subnet_id', $iId);
								$oIp->Set('status', 'reserved');
								$oIp->Set('usage_id', $sUsageGatewayIpId);
								$oIp->DBUpdate();
							}
						}
					}
				}

				// Create or update broadcast IP
				$sUsageBroadcastIpId = IPUsage::GetIpUsageId($iOrgId, BROADCAST_IP_CODE);
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = :broadcastip AND i.org_id = :org_id", array('broadcastip' => $sIpBroadcast, 'org_id' => $iOrgId), false);
				if (is_null($oIp)) {
					$oIp = MetaModel::NewObject('IPv4Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $sIpBroadcast);
					$oIp->Set('org_id', $iOrgId);
					$oIp->Set('ipconfig_id', $this->Get('ipconfig_id'));
					$oIp->Set('status', 'reserved');
					$oIp->Set('usage_id', $sUsageBroadcastIpId);
					$oIp->DBInsert();
				} else {
					if (($oIp->Get('status') != 'reserved') || ($oIp->Get('usage_id') != $sUsageBroadcastIpId)) {
						$oIp->Set('subnet_id', $iId);
						$oIp->Set('status', 'reserved');
						$oIp->Set('usage_id', $sUsageBroadcastIpId);
						$oIp->DBUpdate();
					}
				}
			}
		}

		// Make sure all IPs belonging to subnet are attached to it
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sSubnetIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcast') AND i.org_id = $iOrgId"));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch()) {
			if ($oIpRegistered->Get('subnet_id') != $iId) {
				$oIpRegistered->Set('subnet_id', $iId);
				$oIpRegistered->DBUpdate();
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	protected function AfterUpdate()
	{
		parent::AfterUpdate();

		$iOrgId = $this->Get('org_id');
		$iId = $this->GetKey();
		$sSubnetIp = $this->Get('ip');
		$sMask = $this->Get('mask');
		$sGatewayIp = $this->Get('gatewayip');
		$sIpBroadcast = $this->Get('broadcastip');

		if ($sMask != '255.255.255.255') {
			$sReserveSubnetIPs = $this->Get('reserve_subnet_ips');
			if ($sReserveSubnetIPs == 'default') {
				$sReserveSubnetIPs = IPConfig::GetFromGlobalIPConfig('reserve_subnet_IPs', $iOrgId);
			}
			if ($sReserveSubnetIPs == 'reserve_yes') {
				// Create or update subnet IP
				$sUsageNetworkIpId = IPUsage::GetIpUsageId($iOrgId, NETWORK_IP_CODE);
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sSubnetIp' AND i.org_id = $iOrgId", null, false);
				if (is_null($oIp)) {
					$oIp = MetaModel::NewObject('IPv4Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $sSubnetIp);
					$oIp->Set('org_id', $iOrgId);
					$oIp->Set('ipconfig_id', $this->Get('ipconfig_id'));
					$oIp->Set('status', 'reserved');
					$oIp->Set('usage_id', $sUsageNetworkIpId);
					$oIp->DBInsert();
				} else {
					if (($oIp->Get('status') != 'reserved') || ($oIp->Get('usage_id') != $sUsageNetworkIpId)) {
						$oIp->Set('subnet_id', $iId);
						$oIp->Set('status', 'reserved');
						$oIp->Set('usage_id', $sUsageNetworkIpId);
						$oIp->DBUpdate();
					}
				}

				// Create or update gateway IP
				$sUsageGatewayIpId = IPUsage::GetIpUsageId($iOrgId, GATEWAY_IP_CODE);
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sGatewayIp' AND i.org_id = $iOrgId", null, false);
				if (is_null($oIp)) {
					$oIp = MetaModel::NewObject('IPv4Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $sGatewayIp);
					$oIp->Set('org_id', $iOrgId);
					$oIp->Set('ipconfig_id', $this->Get('ipconfig_id'));
					$oIp->Set('status', 'reserved');
					$oIp->Set('usage_id', $sUsageGatewayIpId);
					$oIp->DBInsert();
				} else {
					if (($oIp->Get('status') != 'reserved') || ($oIp->Get('usage_id') != $sUsageGatewayIpId)) {
						$oIp->Set('subnet_id', $iId);
						$oIp->Set('status', 'reserved');
						$oIp->Set('usage_id', $sUsageGatewayIpId);
						$oIp->DBUpdate();
					}
				}

				// Create or update broadcast IP
				$sUsageBroadcastIpId = IPUsage::GetIpUsageId($iOrgId, BROADCAST_IP_CODE);
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sIpBroadcast' AND i.org_id = $iOrgId", null, false);
				if (is_null($oIp)) {
					$oIp = MetaModel::NewObject('IPv4Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $sIpBroadcast);
					$oIp->Set('org_id', $iOrgId);
					$oIp->Set('ipconfig_id', $this->Get('ipconfig_id'));
					$oIp->Set('status', 'reserved');
					$oIp->Set('usage_id', $sUsageBroadcastIpId);
					$oIp->DBInsert();
				} else {
					if (($oIp->Get('status') != 'reserved') || ($oIp->Get('usage_id') != $sUsageBroadcastIpId)) {
						$oIp->Set('subnet_id', $iId);
						$oIp->Set('status', 'reserved');
						$oIp->Set('usage_id', $sUsageBroadcastIpId);
						$oIp->DBUpdate();
					}
				}
			}
		}

		// Make sure all IPs belonging to subnet are attached to it
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sSubnetIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcast') AND i.org_id = $iOrgId"));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch()) {
			if ($oIpRegistered->Get('subnet_id') != $iId) {
				$oIpRegistered->Set('subnet_id', $iId);
				$oIpRegistered->DBUpdate();
			}
		}

		// Release all subnet's IPs when subnet is released
		$aOldValues = $this->ListPreviousValuesForUpdatedAttributes();
		$sOriginalStatus = $this->GetOriginal('status');	// Workaround for GetOriginal bug
		if (array_key_exists('status', $aOldValues)) {
			$sOriginalStatus = $aOldValues['status'];
		}
		if (($this->Get('status') == 'released') && ($sOriginalStatus != 'released')) {
			$sIpRelease = IPConfig::GetFromGlobalIPConfig('ip_release_on_subnet_release', $iOrgId);
			if ($sIpRelease == 'yes') {
				$sOQL = "SELECT IPv4Address WHERE subnet_id = :id AND status != 'released'";
				$oIpAddressesSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('id' => $iId));
				while ($oIpAddress = $oIpAddressesSet->Fetch()) {
					$oIpAddress->Set('status', 'released');
					$oIpAddress->DBUpdate();
				}
			}
		}
	}

	/**
	 * @inheritDoc
	 */
	protected function DoCheckToDelete(&$oDeletionPlan)
	{
		$iOrgId = $this->Get('org_id');
		$sIp = $this->Get('ip');
		$sIpBroadcast = $this->Get('broadcastip');

		parent::DoCheckToDelete($oDeletionPlan);

		$sWriteReason = $this->Get('write_reason');
		if ($sWriteReason != 'expand') {
			// IPs parent is updated by DoExpand function
			// Add subnet and broadcast IP to deletion plan if they exist
			$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sIp' AND i.org_id = $iOrgId", null, false);
			if (!is_null($oIp)) {
				$oDeletionPlan->AddToDelete($oIp, DEL_AUTO);
			}

			$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sIpBroadcast' AND i.org_id = $iOrgId", null, false);
			if (!is_null($oIp)) {
				$oDeletionPlan->AddToDelete($oIp, DEL_AUTO);
			}
		}
	}

	/**
	 * @inheritDoc
	 */
	public function GetInitialStateAttributeFlags($sAttCode, &$aReasons = array())
	{
		$sFlagsFromParent = parent::GetInitialStateAttributeFlags($sAttCode, $aReasons);

		switch ($sAttCode) {
			case 'gatewayip':
				$sGatewayIPFormat = $this->Get('ipv4_gateway_ip_format');
				if ($sGatewayIPFormat != '') {
					$iOrgId = $this->Get('org_id');
					if ($iOrgId != 0) {
						if ($sGatewayIPFormat == 'default') {
							$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv4_gateway_ip_format', $iOrgId);
						}
						if ($sGatewayIPFormat != 'free_setup') {
							return (OPT_ATT_READONLY | $sFlagsFromParent);
						}
					}
				}

				return $sFlagsFromParent;

			default:
				break;
		}

		return $sFlagsFromParent;
	}

	/**
	 * @inheritDoc
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		$sFlagsFromParent = parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);

		switch ($sAttCode) {
			case 'block_id':
			case 'ip':
			case 'mask':
			case 'broadcastip':
			case 'ip_occupancy':
			case 'range_occupancy':
				return (OPT_ATT_READONLY | $sFlagsFromParent);

			case 'gatewayip':
				$sGatewayIPFormat = $this->Get('ipv4_gateway_ip_format');
				if ($sGatewayIPFormat == 'default') {
					$iOrgId = $this->Get('org_id');
					$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv4_gateway_ip_format', $iOrgId);
				}
				if ($sGatewayIPFormat != 'free_setup') {
					return (OPT_ATT_READONLY | $sFlagsFromParent);
				}
				break;

			default:
				break;
		}

		return $sFlagsFromParent;
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
		// Create OQL according to $bInBlock
		$iBlock = $this->Get('block_id');
		if ($bInBlock) {
			if ($iBlock > 0) {
				$sOQL = 'SELECT IPv4Subnet AS s WHERE s.block_id = :block_id AND INET_ATON(s.ip) < INET_ATON(:ip)';
			} else {
				return null;
			}
		} else {
			$sOQL = 'SELECT IPv4Subnet AS s WHERE s.org_id = :org_id AND INET_ATON(s.ip) < INET_ATON(:ip)';
		}
		// Set the ordering criteria ['ip'=> false] and set a limit (1)
		$oSubnetSet = new DBObjectSet(DBSearch::FromOQL($sOQL), ['ip' => false], ['org_id' => $this->Get('org_id'), 'block_id' => $iBlock, 'ip' => $this->Get('ip')], null, 1);
		$oSubnetSet->OptimizeColumnLoad(['IPv4Subnet' => ['id', 'ip']]);
		if ($oPreviousSubnet = $oSubnetSet->Fetch()) {
			return $oPreviousSubnet;
		}

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
		// Create OQL according to $bInBlock
		$iBlock = $this->Get('block_id');
		if ($bInBlock) {
			if ($iBlock > 0) {
				$sOQL = 'SELECT IPv4Subnet AS s WHERE s.block_id = :block_id AND INET_ATON(s.ip) > INET_ATON(:ip)';
			} else {
				return null;
			}
		} else {
			$sOQL = 'SELECT IPv4Subnet AS s WHERE s.org_id = :org_id AND INET_ATON(s.ip) > INET_ATON(:ip)';
		}
		// Set the ordering criteria ['ip'=> false] and set a limit (1)
		$oSubnetSet = new DBObjectSet(DBSearch::FromOQL($sOQL), ['ip' => true], ['org_id' => $this->Get('org_id'), 'block_id' => $iBlock, 'ip' => $this->Get('ip')], null, 1);
		$oSubnetSet->OptimizeColumnLoad(['IPv4Subnet' => ['id', 'ip']]);
		if ($oNextSubnet = $oSubnetSet->Fetch()) {
			return $oNextSubnet;
		}

		return null;
	}

}
