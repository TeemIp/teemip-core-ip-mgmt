<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPv6Management\Model;

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

/**
 * Class
 * _IPv6Subnet
 */
class _IPv6Subnet extends IPSubnet implements iTree
{
	/**
	 * Return standard icon or extra small one
	 *
	 * @param bool $bImgTag
	 * @param bool $bXsIcon
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function GetMultiSizeIcon($bImgTag = true, $bXsIcon = false)
	{
		if ($bXsIcon) {
			$sIcon = utils::GetAbsoluteUrlModulesRoot().'teemip-ipv6-mgmt/asset/img/icons8-subnetv6-16.png';

			return ("<img src=\"$sIcon\" style=\"vertical-align:middle;\" alt=\"\"/>");
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
		return $this->Get('ip')->GetAsCannonical();
	}

	/**
	 * Returns size of subnet
	 *
	 * @return mixed
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function GetSize()
	{
		$oSubnetIp = $this->Get('ip');
		$oLastIp = $this->Get('lastip');
		$iSize = $oSubnetIp->GetSizeInterval($oLastIp);

		return $iSize;
	}

	/**
	 * Compute % of IP addresses and / or IP ranges in subnet
	 *
	 * @param $sObject
	 *
	 * @return float|int
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function GetOccupancy($sObject)
	{
		$iOrgId = $this->Get('org_id');

		switch ($sObject) {
			case 'IPRange':
			case 'IPv6Range':
				// Look for all child IP ranges
				$iSubnet = $this->GetKey();
				$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = :subnet_id AND r.org_id = :org_id"), array(), array(
					'subnet_id' => $iSubnet,
					'org_id' => $iOrgId,
				));
				$iSizeRanges = 0;
				while ($oIpRange = $oIpRangeSet->Fetch()) {
					$iSizeRanges += $oIpRange->GetSize();
				}

				return ($iSizeRanges / $this->GetSize()) * 100;

			case 'IPAddress':
			case 'IPv6Address':
			case 'IPv6Address_out_IPv6Range':
			default:
				// Space occupancy in IPv6 Subnets doesn't make sense for individual IPv6 as subnet size is > 10E19 !!
				// Space occupancy is not computed for smaller subnet sizes either
				return 0;
		}
	}

	/**
	 * Automatically get a free IP in the subnet
	 *
	 * @param $iCreationOffset
	 *
	 * @return string
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function GetFreeIP($iCreationOffset)
	{
		$oFirstIp = $this->Get('ip');
		$oFirstIp = $oFirstIp->GetNextIp(); // Skip subnet IP
		$oLastIp = $this->Get('lastip');
		if ($iCreationOffset > $oFirstIp->GetSizeInterval($oLastIp)) {
			return '';
		}

		// Get list of registered IPs
		$iKey = $this->GetKey();
		$oIPRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS ip WHERE ip.subnet_id = :key"), array(), array('key' => $iKey));
		$aIPRegistered = $oIPRegisteredSet->GetColumnAsArray('ip', false);

		// Get list of ranges in Subnet
		$oIPRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = :key"), array(), array('key' => $iKey));

		for ($i = 0; $i < $iCreationOffset; $i++) {
			$oFirstIp = $oFirstIp->GetNextIp();
		}
		$oAnIp = $oFirstIp;
		while ($oAnIp->IsSmallerStrict($oLastIp)) {
			if (!in_array($oAnIp, $aIPRegistered)) {
				$oIPRangeSet->Rewind();
				$bIsInRange = false;
				while ($oIPRange = $oIPRangeSet->Fetch()) {
					if ($oIPRange->DoCheckIpInRange($oAnIp)) {
						$bIsInRange = true;
						break;
					}
				}
				if (!$bIsInRange) {
					return $oAnIp->ToString();
				}
			}
			$oAnIp = $oAnIp->GetNextIp();
		}

		return '';
	}

	/**
	 * Count number of IPs in the subnet with a given status
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
				$oIpSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS ip WHERE ip.status = :status AND ip.subnet_id = :key"), array(), array(
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
		$sFirstIp = $this->Get('ip')->GetAsCannonical();
		$sLastIp = $this->Get('lastip')->GetAsCannonical();
		$iSubnetSize = $this->GetSize();
		if ($iRangeSize >= $iSubnetSize) {
			// Required range size is to big, exit
			return $aFreeSpace;
		} else {
			$oIpRegisteredSearch = DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id", array(
				'firstip' => $sFirstIp,
				'lastip' => $sLastIp,
				'org_id' => $iOrgId,
			));
			$oIpRegisteredSet = new CMDBObjectSet($oIpRegisteredSearch);
			$aRegisteredIPs = $oIpRegisteredSet->GetColumnAsArray('ip', false);
			$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = :key"), array(), array('key' => $iKey));
			$aRangeIPs = $oIpRangeSet->GetColumnAsArray('firstip', false);

			$oAnIp = $this->Get('ip');
			$oLastIp = $this->Get('lastip');
			$oAnIp = $oAnIp->GetNextIp();
			$n = 0;
			do {
				// Find next free IP
				while (in_array($oAnIp, $aRegisteredIPs)) {
					$oAnIp = $oAnIp->GetNextIp();
				}
				if ($oAnIp->IsSmallerStrict($oLastIp)) {
					// If free IP belongs to an IP range, skip range
					$oIpRangeSet->Rewind();
					$bContinue = true;
					while ($bContinue && ($oIpRange = $oIpRangeSet->Fetch())) {
						$oIpRangeFirstIp = $oIpRange->Get('firstip');
						$oIpRangeLastIp = $oIpRange->Get('lastip');
						if ($oIpRangeFirstIp->IsSmallerOrEqual($oAnIp) && $oAnIp->IsSmallerOrEqual($oIpRangeLastIp)) {
							$oAnIp = $oIpRangeLastIp->GetNextIp();
							$bContinue = false;
						}
					}
					if ($oAnIp->IsSmallerStrict($oLastIp)) {
						// Make sure we don't have any IP or range until last IP
						$oRangeFirstIp = $oAnIp;
						$i = 0;
						$bContinue = true;
						while ($bContinue && (!in_array($oAnIp, $aRegisteredIPs)) && $oAnIp->IsSmallerStrict($oLastIp) && ($i < $iRangeSize)) {
							if (in_array($oAnIp, $aRangeIPs)) {
								$bContinue = false;
							} else {
								$oAnIp = $oAnIp->GetNextIp();
								$i++;
							}
						}
						if ($i == $iRangeSize) {
							$aFreeSpace[$n] = array();
							$oRangeLastIp = $oAnIp->GetPreviousIp();
							$aFreeSpace[$n]['firstip'] = $oRangeFirstIp;
							$aFreeSpace[$n]['lastip'] = $oRangeLastIp;
							$n++;
						}
					}
				}
			} while ($oAnIp->IsSmallerStrict($oLastIp) && ($n < $iMaxOffer));
		}

		// Return result
		return $aFreeSpace;
	}

	/**
	 * List IP addresses in the subnet in CSV format
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
		$oSubnetIp = $this->Get('ip');
		if ($sFirstIp == '') {
			$oFirstIp = $oSubnetIp;
		} else {
			$oFirstIp = new ormIPv6($sFirstIp);
		}
		$sLastIp = $aParam['last_ip'];
		$oBroadcastIp = $this->Get('lastip');
		if ($sLastIp == '') {
			$oLastIp = $oBroadcastIp;
		} else {
			$oLastIp = new ormIPv6($sLastIp);
		}

		// Get list of registered IPs & Ranges in subnet
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$oIp = $oFirstIp;
		$sIp = $oIp->GetAsCannonical();
		$sLastIp = $oLastIp->GetAsCannonical();
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :ip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id", array(
			'ip' => $sIp,
			'lastip' => $sLastIp,
			'org_id' => $iOrgId,
		)));
		$aIpRegistered = $oIpRegisteredSet->GetColumnAsArray('ip', false);
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = :key"), array(), array('key' => $iId));
		$iCountRange = $oIpRangeSet->Count();

		// Set CRLF format
		$sCrLf = "<br>";

		// List exported parameters
		$sHtml = "Registered,Id";
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
		foreach ($aParam as $sAttCode) {
			$sHtml .= ','.MetaModel::GetLabel('IPv6Address', $sAttCode);
		}
		$sHtml .= ",IP Range".$sCrLf;

		// List all IPs of subnet now in IP order 
		$oAnIp = $oIp->GetNextIp();
		while ($oAnIp->IsSmallerOrEqual($oLastIp)) {
			if (!in_array($oAnIp, $aIpRegistered)) {
				$sHtml .= "no,,,".$oAnIp->GetAsCompressed().",free,,,,,,,,";
			} else {
				$oIpRegisteredSet->Rewind();
				$oIpRegistered = $oIpRegisteredSet->Fetch();
				while (!$oAnIp->IsEqual($oIpRegistered->Get('ip'))) {
					$oIpRegistered = $oIpRegisteredSet->Fetch();
				}
				$sHtml .= "yes,".$oIpRegistered->GetKey().",";
				$sHtml .= $oIpRegistered->Get('org_name').",";
				$sHtml .= $oIpRegistered->Get('ip')->GetAsCompressed().",";
				$sHtml .= $oIpRegistered->Get('status').",";
				$sHtml .= $oIpRegistered->Get('fqdn').",";
				$sHtml .= $oIpRegistered->Get('usage_name').",";
				$sHtml .= $oIpRegistered->Get('comment').",";
				$sHtml .= $oIpRegistered->Get('requestor_name').",";
				$sHtml .= $oIpRegistered->Get('release_date').",";
			}
			// Check if IP belongs to a range or not
			if ($iCountRange != 0) {
				$oIpRangeSet->Rewind();
				$oIpRange = $oIpRangeSet->Fetch();
				$iFoundRange = false;
				while (($oIpRange != null) && ($iFoundRange == false)) {
					if ($oIpRange->Get('firstip')->IsSmallerOrEqual($oAnIp) && $oAnIp->IsSmallerOrEqual($oIpRange->Get('lastip'))) {
						$iFoundRange = true;
					} else {
						$oIpRange = $oIpRangeSet->Fetch();
					}
				}
				if ($iFoundRange) {
					$sHtml .= $oIpRange->Get('range');
				}
			}
			$sHtml .= $sCrLf;
			$oAnIp = $oAnIp->GetNextIp();
		}

		return ($sHtml);
	}

	/**
	 * Check if IP is in subnet
	 *
	 * @param $oIp
	 *
	 * @return bool
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function DoCheckIpInSubnet($oIp)
	{
		$oSubnetIp = $this->Get('ip');
		$oLastIp = $this->Get('lastip');
		if ($oSubnetIp->IsSmallerOrEqual($oIp) && $oIp->IsSmallerOrEqual($oLastIp)) {
			return true;
		}

		return false;
	}

	/**
	 * Check if subnet is CIDR aligned
	 *
	 * @return bool
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function DoCheckCIDRAligned()
	{
		// Note that IPv6 subnets are /64 only

		$oIp = $this->Get('ip');
		$sBitMask = $this->Get('mask');
		$sMask = $this->BitToMask($sBitMask);
		$oMask = new ormIPv6($sMask);

		$oAndIP = $oIp->BitwiseAnd($oMask);
		if ($oIp->IsEqual($oAndIP)) {
			return true;
		}

		return false;
	}

	/**
	 * Check if operation is feasible on current object
	 *
	 * @param $sOperation
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function DoCheckOperation($sOperation)
	{
		switch ($sOperation) {
			case 'findspace':
				if ($this->Get('mask') > 124) {
					return ('SizeTooSmall');
				}
				break;

			case 'listips':
			case 'csvexportips':
			case 'calculator':
				return ('');

			case 'shrinksubnet':
			case 'splitsubnet':
			case 'expandsubnet':
			default:
				// Size of IPv6 subnets cannot change
				return ('OperationNotAllowed');
		}

		return ('');
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

		// Get list of registered IPs & ranges in subnet
		$iSubnetSize = $this->GetSize();
		if ($iSpaceSize >= $iSubnetSize) {
			// Required range size is to big, exit
			return ('RangeTooBig');
		} elseif ($iSpaceSize == 0) {
			return ('RangeEmpty');
		}

		return '';
	}

	/**
	 * @inheritdoc
	 */
	public function GetAvailableSpace(WebPage $oP, $iChangeId, $aParam)
	{
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$iRangeSize = $aParam['spacesize'];
		$iMaxOffer = $aParam['maxoffer'];

		// Get list of free space in subnet
		$sIPv6RangeCreationTitle = utils::EscapeHtml(Dict::Format('UI:CreationTitle_Class', MetaModel::GetName('IPv6Range')));
		$aFreeSpace = $this->GetFreeSpace($iRangeSize, $iMaxOffer);

		// Check user rights
		$UserHasRightsToCreate = (UserRights::IsActionAllowed('IPv6Range', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;

		// Open table
		$sHtml = '<table style="width:100%"><tr><td colspan="2">';
		$sHtml .= '<div style="vertical-align:top;" id="tree">';

		// Display Summary of parameters
		$sHtml .= "<ul>";
		$sHtml .= "<li>"."&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Summary', $iMaxOffer, $iRangeSize)."<ul>";

		// Display possible choices as list
		$iSizeFreeArray = sizeof($aFreeSpace);
		if ($iSizeFreeArray != 0) {
			$i = 0;
			$iVIdCounter = 1;
			do {
				$oRangeFirstIp = $aFreeSpace[$i]['firstip'];
				$sRangeFirstIp = $oRangeFirstIp->GetAsCannonical();
				$oRangeLastIp = $aFreeSpace[$i]['lastip'];
				$sRangeLastIp = $oRangeLastIp->GetAsCannonical();
				$sHtml .= "<li>".$sRangeFirstIp." - ".$sRangeLastIp;

				// If user has rights to create range
				// Display range with icon to create it
				if ($UserHasRightsToCreate) {
					$iVId = $iVIdCounter++;
					$sHtml .= "<ul><li><div><span id=\"v_{$iVId}\">";
					$sHtml .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/asset/img/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
					$sHtml .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv6Subnet:CreateAsRange')."&nbsp;&nbsp;";
					$sHtml .= "</span></div></li>";
					$oP->add_ready_script(
						<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv6Range', '', $iChangeId, {'org_id': '$iOrgId', 'subnet_id': '$iId', 'firstip': '$oRangeFirstIp', 'lastip': '$oRangeLastIp'});
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
	 * @throws \Exception
	 */
	public function DoCheckToListIps($aParam)
	{
		$oIp = $this->Get('ip');
		$oBroadcastIp = $this->Get('lastip');

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '') {
			$oFirstIp = new ormIPv6($sFirstIp);
			if ($oFirstIp->IsSmallerStrict($oIp) || $oBroadcastIp->IsSmallerOrEqual($oFirstIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIPOutOfSubnet'));
			}
		}

		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '') {
			$oLastIp = new ormIPv6($sLastIp);
			if ($oLastIp->IsSmallerOrEqual($oIp) || $oBroadcastIp->IsSmallerStrict($oLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Subnet:LastIPOutOfSubnet'));
			}
		}

		if (($sFirstIp != '') && ($sLastIp != '')) {
			if ($oFirstIp->IsBiggerStrict($oLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIpBiggerThanLastIp'));
			}
		}

		return '';
	}

	/**
	 * @inheritdoc
	 */
	public function GetListIps(WebPage $oP, $aParam)
	{
		// Define first and last IPs to display
		$sFirstIp = $aParam['first_ip'];
		$oSubnetIp = $this->Get('ip');
		if ($sFirstIp == '') {
			$oFirstIp = $oSubnetIp;
		} else {
			$oFirstIp = new ormIPv6($sFirstIp);
		}
		$bPrintDummyFirstLine = $oFirstIp->IsEqual($oSubnetIp) ? false : true;
		$sLastIp = $aParam['last_ip'];
		$oBroadcastIp = $this->Get('lastip');
		if ($sLastIp == '') {
			$oLastIp = $oBroadcastIp;
		} else {
			$oLastIp = new ormIPv6($sLastIp);
		}
		$bPrintDummyLastLine = $oLastIp->IsEqual($oBroadcastIp) ? false : true;

		// Get list of registered IPs & Ranges in subnet
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$oIp = $oFirstIp;
		$sIp = $oIp->GetAsCannonical();
		$sLastIp = $oLastIp->GetAsCannonical();
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :ip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id", array(
			'ip' => $sIp,
			'lastip' => $sLastIp,
			'org_id' => $iOrgId,
		)));
		$aIpRegistered = $oIpRegisteredSet->GetColumnAsArray('ip', true);
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = :key"), array(), array('key' => $iId));
		$aIpRange = $oIpRangeSet->GetColumnAsArray('firstip', false);

		// Preset display of name and subnet attributes
		$sIPv6CreationTitle = utils::EscapeHtml(Dict::Format('UI:CreationTitle_Class', MetaModel::GetName('IPv6Address')));
		$sStatusIp = $aParam['status_ip'];
		$sShortName = $aParam['short_name'];
		$iDomainId = $aParam['domain_id'];
		$iUsageId = $aParam['usage_id'];
		$iRequestorId = $aParam['requestor_id'];

		$oAnIp = $oIp->GetNextIp();
		$oIpRangeLastIp = $oIp;
		$iVIdCounter = 1;

		// Check user rights
		$UserHasRightsToCreate = (UserRights::IsActionAllowed('IPv6Address', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;

		// Open table
		$sHtml = '<table style="width:100%"><tr><td colspan="2">';
		$sHtml .= '<div style="vertical-align:top;" id="tree">';

		// Display first IP
		$sHtml .= "<ul>";
		$sHtml .= "<li>".$this->GetMultiSizeIcon(true, true)."&nbsp;".$this->GetHyperlink()."&nbsp;".Dict::S('Class:IPv6Subnet/Attribute:mask/Value_cidr:'.$this->Get('mask'))."  - ".$this->GetLabel('type').': '.$this->GetAsHTML('type')."<ul>";

		// ... and dummy line if display doesn't start at first IP
		if ($bPrintDummyFirstLine) {
			$sHtml .= "<li>&nbsp;&nbsp;...&nbsp;//&nbsp;... </li>";
		}

		// Display other IPs as list
		while ($oAnIp->IsSmallerOrEqual($oLastIp)) {
			if (in_array($oAnIp, $aIpRange)) {
				// Found a range within list of IPs
				$oIpRangeSet->Rewind();
				$oIpRange = $oIpRangeSet->Fetch();
				while (!$oAnIp->IsEqual($oIpRange->Get('firstip'))) {
					$oIpRange = $oIpRangeSet->Fetch();
				}

				// Display name and range attributes
				$sIcon = $oIpRange->GetMultiSizeIcon(true, true);
				$sHtml .= "<li>".$sIcon."&nbsp;".$oIpRange->GetHyperlink()."&nbsp;&nbsp;&nbsp;[".$oIpRange->Get('firstip')." - ".$oIpRange->Get('lastip')."]";
				$sHtml .= "&nbsp;&nbsp; - ".$oIpRange->GetLabel('usage_id').': '.$oIpRange->GetAsHTML('usage_id')."<ul>";
				$oIpRangeLastIp = $oIpRange->Get('lastip');
			}
			$iAnIpKey = array_search($oAnIp, $aIpRegistered);
			if ($iAnIpKey !== false) {
				$oIpRegistered = MetaModel::GetObject('IPv6Address', $iAnIpKey);
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
					oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv6Address', '', 0, {'org_id': '$iOrgId', 'subnet_id': '$iId', 'ip': '$oAnIp', 'status': '$sStatusIp', 'short_name': '$sShortName', 'domain_id': '$iDomainId', 'usage_id': '$iUsageId', 'requestor_id': '$iRequestorId'});
EOF
					);
				} else {
					$sHtml .= "<li>".$oAnIp->GetAsCompressed();
				}
			}
			if ($oAnIp->IsEqual($oIpRangeLastIp)) {
				$sHtml .= "</ul></li>";
			}
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
	 * @throws \Exception
	 */
	public function DoCheckToCsvExportIps($aParam)
	{
		$oIp = $this->Get('ip');
		$oBroadcastIp = $this->Get('lastip');

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '') {
			$oFirstIp = new ormIPv6($sFirstIp);
			if ($oFirstIp->IsSmallerStrict($oIp) || $oBroadcastIp->IsSmallerOrEqual($oFirstIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIPOutOfSubnet'));
			}
		}

		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '') {
			$oLastIp = new ormIPv6($sLastIp);
			if ($oLastIp->IsSmallerOrEqual($oIp) || $oBroadcastIp->IsSmallerStrict($oLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:LastIPOutOfSubnet'));
			}
		}

		if (($sFirstIp != '') && ($sLastIp != '')) {
			if ($oFirstIp->IsBiggerStrict($oLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIpBiggerThanLastIp'));
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
	public function DoCheckCalculatorInputs($aParam)
	{
		$iCidr = $aParam['cidr'];

		if ($iCidr == '') {
			return (Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:EnterPrefix'));
		}

		if (($iCidr <= 0) || ($iCidr > 128)) {
			return (Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:WrongPrefix'));
		}

		return '';
	}

	/**
	 * @inheritDoc
	 */
	public function DoCheckToExplodeFQDN($sFqdnAttr)
	{
		if (!in_array($sFqdnAttr, MetaModel::GetAttributesList('IPv6Address'))) {
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
		$oIPsSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address WHERE $sFqdnAttr != '' AND $sFqdnAttr != fqdn AND subnet_id = :key"), array(), array('key' => $iKey));
		while ($oIP = $oIPsSet->Fetch()) {
			$oIP->DoExplodeFQDN($sFqdnAttr);
		}
	}

	/**
	 * Display subnet in the node of a hierarchical tree
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	public function GetAsLeaf($bWithIcon, $iTreeOrgId)
	{
		$sHtml = $this->GetHyperlink();
		$sHtml .= "&nbsp;".Dict::S('Class:IPv6Subnet/Attribute:mask/Value_cidr:'.$this->Get('mask'));

		return $sHtml;
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

				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeOfRange');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:FindSpace:IPv6Subnet:MaxNumberOfOffers');

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
				$sSubTitle = Dict::S('UI:IPManagement:Action:'.$sTextOperation.':IPv6Subnet:Subtitle_ListRange');
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:'.$sTextOperation.':IPv6Subnet:FirstIP');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:'.$sTextOperation.':IPv6Subnet:LastIP');

				// Preset subnet bits of IP
				$oSubnetIp = $this->Get('ip');
				$sSubnetIp = $oSubnetIp->GetAsCompressed();

				// Subtitle
				$oColumn1->AddHtml($sSubTitle.'<br><br>');

				// First IP
				$sDefault = (array_key_exists('firstip', $aDefault)) ? $aDefault['firstip'] : $sSubnetIp;
				$val = $this->GetClassFieldForForm($oP, '', 'IPv6Range', 'firstip', $sLabelOfAction1, $sDefault, OPT_ATT_MANDATORY);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));

				// Last IP
				$sDefault = (array_key_exists('lastip', $aDefault)) ? $aDefault['lastip'] : $sSubnetIp;
				$val = $this->GetClassFieldForForm($oP, '', 'IPv6Range', 'lastip', $sLabelOfAction2, $sDefault, OPT_ATT_MANDATORY);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));
				break;

			case 'calculator':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Calculator:IPv6Subnet:IP');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:Calculator:IPv6Subnet:Prefix');

				// IP
				$val = $this->GetClassFieldForForm($oP, '', 'IPv6Subnet', 'ip', $sLabelOfAction1, '', OPT_ATT_MANDATORY);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));

				// CIDR
				$sInputId = $this->m_iFormId.'_cidr';
				$sHTML = "<input type=\"number\" id=\"$sInputId\" name=\"cidr\">\n";
				$val = $this->GetSimpleFieldForForm('AttributeInteger', 'cidr', $sLabelOfAction2, $sHTML);
				$oColumn1->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));
				break;

			default:
				break;
		};
	}

	/**
	 * Get result of IPv6 calculator
	 *
	 * @param \WebPage $oP
	 * @param $oAppContext
	 * @param $aParam
	 *
	 * @throws \Exception
	 */
	public function GetCalculatorOutput(WebPage $oP, $aParam)
	{
		$sIp = $aParam['ip'];
		$iPrefix = $aParam['cidr'];

		$oIp = new ormIPv6($sIp);
		$sIpComp = $oIp->GetAsCompressed();
		$sIpCan = $oIp->GetAsCannonical();

		$oMask = new ormIPv6('FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF');
		for ($i = 1; $i <= (IPV6_MAX_BIT - $iPrefix); $i++) {
			$oMask = $oMask->LeftShift();
		}
		$sMask = $oMask->GetAsCompressed();

		$oSubnetIp = $oIp->BitwiseAnd($oMask);
		$sSubnetIp = $oSubnetIp->GetAsCompressed();

		$oNotMask = $oMask->BitwiseNot();
		$oLastIp = $oIp->BitwiseOr($oNotMask);
		$sLastIp = $oLastIp->GetAsCompressed();

		$iIpNumber = $oIp->GetSizeInterval($oLastIp);

		$oVeryFirstIp = new ormIPv6('::');
		if ($oSubnetIp->IsEqual($oVeryFirstIp)) {
			$sPreviousSubnetIp = Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet:NA');
		} else {
			$oPreviousSubnetIp = $oSubnetIp->GetPreviousIp();
			$oPreviousSubnetIp = $oPreviousSubnetIp->BitwiseAnd($oMask);
			$sPreviousSubnetIp = $oPreviousSubnetIp->GetAsCompressed();
		}

		$oVeryLastIp = new ormIPv6('FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF');
		if ($oLastIp->IsEqual($oVeryLastIp)) {
			$sNextSubnetIp = Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet:NA');
		} else {
			$oNextSubnetIp = $oLastIp->GetNextIp();
			$sNextSubnetIp = $oNextSubnetIp->GetAsCompressed();
		}

		$sHtml = '';
		$sHtml .= '<table style="vertical-align:top;"><tr><td>';
		$sHtml .= '<div id="tree">';
		// IP address - Compressed format
		$sHtml .= '&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:CompressedIP').":</td><td>$sIpComp</td></tr>";

		// IP address - Canonical format
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:CanonicalIP').":</td><td>$sIpCan</td></tr>";
		$sHtml .= '<tr><td height=10></td></tr>';

		// Network IP
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:NetworkIP').":</td><td><b>$sSubnetIp</b></td></tr>";

		// Prefix
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:Prefix').":</td><td>$iPrefix</td></tr>";

		// Prefix mask
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:PrefixMask').":</td><td>$sMask</td></tr>";
		$sHtml .= '<tr><td height=10></td></tr>';

		// Last IP
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:LastIP').":</td><td><b>$sLastIp</b></td></tr>";

		// Number of IPs
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:IPNumber').":</td><td>$iIpNumber</td></tr>";
		$sHtml .= '<tr><td height=10></td></tr>';

		// Previous network
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet').":</td><td>$sPreviousSubnetIp</td></tr>";

		// Next network
		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet').":</td><td>$sNextSubnetIp</td></tr>";
		$sHtml .= '<tr><td height=10></td></tr>';

		// As an option, create subnet or block with calculated parameters (previous, current or next one)
		$UserHasRightsToCreateBlocks = (UserRights::IsActionAllowed('IPv6Block', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
		$UserHasRightsToCreateSubnets = (UserRights::IsActionAllowed('IPv6Subnet', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
		if (!$UserHasRightsToCreateBlocks && !$UserHasRightsToCreateSubnets) {
			return $sHtml;
		}

		$sHtml .= '<tr><td>&nbsp;&nbsp;</td><td colspan="2">'.Dict::S('UI:IPManagement:Action:DoCalculator:IPSubnet:SelectCreation').':</td></tr>';
		if ($this->GetKey() > 0) {
			$iOrgId = $this->Get('org_id');
			$iBlockMinSize = IPConfig::GetFromGlobalIPConfig('ipv6_block_min_prefix', $iOrgId);
		} else {
			$iBlockMinSize = IPV6_BLOCK_MIN_PREFIX;
		}
		$bOfferBlock = ($iPrefix <= $iBlockMinSize) ? true : false;
		$bOfferSubnet = ($iPrefix >= IPV6_SUBNET_MAX_PREFIX) ? true : false;

		$iVIdCounter = 1;
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$aSubnetIps = array();
		if (!$oSubnetIp->IsEqual($oVeryFirstIp)) {
			$aSubnetIps[$sPreviousSubnetIp] = $oPreviousSubnetIp->BitwiseOr($oNotMask)->GetAsCompressed();
		}
		$aSubnetIps[$sSubnetIp] = $sLastIp;
		if (!$oLastIp->IsEqual($oVeryLastIp)) {
			$aSubnetIps[$sNextSubnetIp] = $oNextSubnetIp->BitwiseOr($oNotMask)->GetAsCompressed();
		}
		foreach ($aSubnetIps as $sFirstSubnetIp => $sLastSubnetIp) {
			if ($sFirstSubnetIp == $sSubnetIp) {
				$sHtml .= '<tr><td></td><td>&nbsp;&nbsp;</td><td><b>'.$sFirstSubnetIp.' /'.$iPrefix.'</b></td>';
			} else {
				$sHtml .= '<tr><td></td><td>&nbsp;&nbsp;</td><td>'.$sFirstSubnetIp.' /'.$iPrefix.'</td>';
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
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv6Block', '', 0, {'org_id': '$iOrgId', 'parent_id': '$iId', 'firstip': "$sFirstSubnetIp", 'lastip': '$sLastSubnetIp'});
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
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv6Subnet', '', 0, {'org_id': '$iOrgId', 'parent_id': '$iId', 'ip': "$sFirstSubnetIp", 'mask': '$iPrefix'});
EOF
					);
				} else {
					$sHTMLValue .= "<td>".Dict::S('UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateSubnet:MaskIsToSmall')."</td></tr>";
					$sHtml .= $sHTMLValue;
				}
			}

		}
		$sHtml .= '</div></td></tr></table>';
		$sHtml .= '</div>';         // ??

		return $sHtml;
	}

	/**
     * @inheritdoc
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
			$sIp = $this->Get('ip')->GetAsCannonical();
			$sLastIp = $this->Get('lastip')->GetAsCannonical();

			$aExtraParams = array();
			$aExtraParams['menu'] = false;

			// Tab for Registered IPs
			$oIpRegisteredSearch = DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :ip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id", array(
				'ip' => $sIp,
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
				$sHtml = '<div class="teemip-space-occupation">'.Dict::Format('Class:IPv6Subnet/Tab:ipregistered-count', $iReserved, $iAllocated, $iReleased, $iUnallocated).'</div>';
			} else {
				$sHtml = '';
			}
			$sName = Dict::S('Class:IPSubnet/Tab:ipregistered');
			$sTitle = Dict::S('Class:IPSubnet/Tab:ipregistered+');
			IPUtils::DisplayTabContent($oPage, $sName, 'ip_addresses', 'IPv6Address', $sTitle, $sHtml, $oIpRegisteredSet, false);

			// Tab for IP Ranges
			$oIpRangeSearch = DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = :key", array('key' => $iKey));
			$oIpRangeSet = new CMDBObjectSet($oIpRangeSearch);
			$iIpRange = $oIpRangeSet->Count();
			if ($iIpRange > 0) {
				$iCountRange = 0;
				while ($oIpRange = $oIpRangeSet->Fetch()) {
					$iCountRange += $oIpRange->GetSize();
				}
				$sHtml = '<div class="teemip-space-occupation">'.$this->GetAsHTML('range_occupancy').Dict::Format('Class:IPSubnet/Tab:iprange-count-percent').'</div>';
			} else {
				$sHtml = '';
			}
			$sName = Dict::S('Class:IPSubnet/Tab:iprange');
			$sTitle = Dict::S('Class:IPSubnet/Tab:iprange+');
			IPUtils::DisplayTabContent($oPage, $sName, 'ip_ranges', 'IPv6Range', $sTitle, $sHtml, $oIpRangeSet, false);

			// Tab for related subnet requests, if any, in non edit mode
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
	 * Compute attributes before writing object
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function ComputeValues()
	{
		parent::ComputeValues();

		$oIp = $this->Get('ip');
		$iOrgId = $this->Get('org_id');

		// Set Last IP
		$sBitMask = $this->Get('mask');
		$sMask = $this->BitToMask($sBitMask);
		$oMask = new ormIPv6($sMask);
		$oLastIpFromMask = $oMask->BitwiseNot();
		$oLastIp = $oIp->BitwiseOr($oLastIpFromMask);
		$this->Set('lastip', $oLastIp);

		// Set Gateway IP
		if ($iOrgId > 0) {
			if ($sBitMask != '128') {
				$sGatewayIPFormat = $this->Get('ipv6_gateway_ip_format');
				if ($sGatewayIPFormat == 'default') {
					$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv6_gateway_ip_format', $iOrgId);
				}
				switch ($sGatewayIPFormat) {
					case 'subnetip_plus_1':
						$oFirstIpFromMask = new ormIPv6('::1');
						$oGatewayIp = $oIp->BitwiseOr($oFirstIpFromMask);
						break;

					case 'lastip':
						$oGatewayIp = $oLastIp;
						break;

					case 'free_setup':
					default:
						$oGatewayIp = $this->Get('gatewayip');
						break;
				}
			} else {
				$oGatewayIp = $oIp;
			}
		} else {
			$oFirstIpFromMask = new ormIPv6('::1');
			$oGatewayIp = $oIp->BitwiseOr($oFirstIpFromMask);
		}
		$this->Set('gatewayip', $oGatewayIp);


		// Set parent block if not set
		// Note: this may give incorrect result if only one block exists under the organization since, in such case, framework preset block_id to that unique block as block_id cannot be null
		if (($oIp != null) && ($oMask != null)) {
			// Look for all blocks containing the new subnet
			// Pick the smallest one
			$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.org_id = :org_id"), array(), array('org_id' => $iOrgId));
			$iMinSize = 0;
			$iBlockId = 0;
			while ($oSRange = $oSRangeSet->Fetch()) {
				$oCurrentFirstIp = $oSRange->Get('firstip');
				$oCurrentLastIp = $oSRange->Get('lastip');
				if ($oCurrentFirstIp->IsSmallerOrEqual($oIp) && $oLastIp->IsSmallerOrEqual($oCurrentLastIp)) {
					$iSRangeSize = $oSRange->GetSize();
					if (($iMinSize == 0) || ($iSRangeSize < $iMinSize)) {
						$iMinSize = $iSRangeSize;
						$iBlockId = $oSRange->GetKey();
					}
				}
			}
			if ($iBlockId != 0) {
				$this->Set('block_id', $iBlockId);
			}
		}
	}

	/**
	 * Check validity of new subnet attributes before creation
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
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
		$oIp = $this->Get('ip');
		$sBitMask = $this->Get('mask');
		$oLastIp = $this->Get('lastip');
		$iBlockId = $this->Get('block_id');

		// Forbid change of subnet IP and subnet mask
		$oSubnet = MetaModel::GetObject('IPv6Subnet', $iKey, false /* MustBeFound */);
		if (!is_null($oSubnet)) {
			if ($oIp != $oSubnet->Get('ip')) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:IpCannotChange');

				return;
			}
			if ($sBitMask != $oSubnet->Get('mask')) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:MaskCannotChange');

				return;
			}
		}

		// Check consistency between subnet IP and mask. IP must be aligned with block defined by mask.
		if (!$this->DoCheckCIDRAligned()) {
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:IpIncorrect');

			return;
		}

		// Make sure subnet is fully contained in block
		$oBlock = MetaModel::GetObject('IPv6Block', $iBlockId, true /* MustBeFound */);
		$oBlockFirstIp = $oBlock->Get('firstip');
		$oBlockLastIp = $oBlock->Get('lastip');
		if ($oIp->IsSmallerStrict($oBlockFirstIp) || $oBlockLastIp->IsSmallerStrict($oLastIp)) {
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:NotInBlock');

			return;
		}

		// Make sure subnet doesn't collide with another subnet
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = :block_id AND s.org_id = :org_id AND s.id != :key"), array(), array(
			'block_id' => $iBlockId,
			'org_id' => $iOrgId,
			'key' => $iKey,
		));
		while ($oSubnet = $oSubnetSet->Fetch()) {
			$oCurrentIp = $oSubnet->Get('ip');
			$oCurrentLastIp = $oSubnet->Get('lastip');

			// Does the subnet already exist?
			if ($oCurrentIp->IsEqual($oIp) && $oCurrentLastIp->IsEqual($oLastIp)) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision0');

				return;
			}
			// Is the subnet IP part of an existing subnet?
			if ($oCurrentIp->IsSmallerOrEqual($oIp) && $oIp->IsSmallerOrEqual($oCurrentLastIp)) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision1');

				return;
			}
			// Is the last IP part of an existing subnet?
			if ($oCurrentIp->IsSmallerOrEqual($oLastIp) && $oLastIp->IsSmallerOrEqual($oCurrentLastIp)) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision2');

				return;
			}
			// Is new subnet including an existing one?
			if ($oIp->IsSmallerStrict($oCurrentIp) && $oCurrentLastIp->IsSmallerStrict($oLastIp)) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision3');

				return;
			}
		}

		// If allocation of Gateway Ip is free, make sure it is contained in subnet
		$sGatewayIPFormat = $this->Get('ipv6_gateway_ip_format');
		if ($sGatewayIPFormat == 'default') {
			$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv4_gateway_ip_format', $iOrgId);
		}
		if ($sGatewayIPFormat == 'free_setup') {
			$oGatewayIp = $this->Get('gatewayip');
			if (!$this->DoCheckIpInSubnet($oGatewayIp)) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:GatewayOutOfSubnet');

				return;
			}
		}
	}

	/**
	 * Perform specific tasks related to subnet creation:
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	protected function AfterInsert()
	{
		parent::AfterInsert();

		$iOrgId = $this->Get('org_id');
		$iId = $this->GetKey();
		$oSubnetIp = $this->Get('ip');
		$sSubnetIp = $oSubnetIp->GetAsCannonical();
		$sBitMask = $this->Get('mask');
		$oGatewayIp = $this->Get('gatewayip');
		$sGatewayIp = $oGatewayIp->GetAsCannonical();
		$sLastIp = $this->Get('lastip')->GetAsCannonical();

		// Check if subnet and broadcast IPs need to be created / updated or not
		if ($sBitMask != '128') {
			$sReserveSubnetIPs = $this->Get('reserve_subnet_ips');
			if ($sReserveSubnetIPs == 'default') {
				$sReserveSubnetIPs = IPConfig::GetFromGlobalIPConfig('reserve_subnet_IPs', $iOrgId);
			}
			if ($sReserveSubnetIPs == 'reserve_yes') {
				// Create or update subnet IP
				$sUsageNetworkIpId = IPUsage::GetIpUsageId($iOrgId, NETWORK_IP_CODE);
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv6Address AS i WHERE i.ip_text = :subnetip AND i.org_id = :org_id", array('subnetip' => $sSubnetIp, 'org_id' => $iOrgId), false);
				if (is_null($oIp)) {
					$oIp = MetaModel::NewObject('IPv6Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $oSubnetIp);
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

				if ($sBitMask != '127') {
					// Create or update gateway IP... if one has been chosen
					if ($sGatewayIp !=  '') {
						$sUsageGatewayIpId = IPUsage::GetIpUsageId($iOrgId, GATEWAY_IP_CODE);
						$oIp = MetaModel::GetObjectFromOQL("SELECT IPv6Address AS i WHERE i.ip_text = :gatewayip AND i.org_id = :org_id", array('gatewayip' => $sGatewayIp, 'org_id' => $iOrgId), false);
						if (is_null($oIp)) {
							$oIp = MetaModel::NewObject('IPv6Address');
							$oIp->Set('subnet_id', $iId);
							$oIp->Set('ip', $oGatewayIp);
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
			}
		}

		// Make sure all IPs belonging to subnet are attached to it
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :ip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id", array(
			'ip' => $sSubnetIp,
			'lastip' => $sLastIp,
			'org_id' => $iOrgId,
		)));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch()) {
			if ($oIpRegistered->Get('subnet_id') != $iId) {
				$oIpRegistered->Set('subnet_id', $iId);
				$oIpRegistered->DBUpdate();
			}
		}
	}

	/**
	 * Perform specific tasks related to subnet update:
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	protected function AfterUpdate()
	{
		parent::AfterUpdate();

		$iOrgId = $this->Get('org_id');
		$iId = $this->GetKey();
		$oSubnetIp = $this->Get('ip');
		$sSubnetIp = $oSubnetIp->GetAsCompressed();
		$sBitMask = $this->Get('mask');
		$oGatewayIp = $this->Get('gatewayip');
		$sLastIp = $this->Get('lastip')->GetAsCompressed();

		if ($sBitMask != '128') {
			$sReserveSubnetIPs = IPConfig::GetFromGlobalIPConfig('reserve_subnet_IPs', $iOrgId);
			if ((($sReserveSubnetIPs == 'reserve_yes') && ($this->Get('reserve_subnet_ips') == 'default')) || ($this->Get('reserve_subnet_ips') == 'reserve_yes')) {
				// Create or update subnet IP
				$sUsageNetworkIpId = IPUsage::GetIpUsageId($iOrgId, NETWORK_IP_CODE);
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv6Address AS i WHERE i.ip = :subnetip AND i.org_id = :org_id", array(
					'subnetip' => $sSubnetIp,
					'org_id' => $iOrgId,
				), false);
				if (is_null($oIp)) {
					$oIp = MetaModel::NewObject('IPv6Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $oSubnetIp);
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
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv6Address AS i WHERE i.ip = :gatewayip AND i.org_id = :org_id", array(
					'gatewayip' => $sSubnetIp,
					'org_id' => $iOrgId,
				), false);
				if (is_null($oIp)) {
					$oIp = MetaModel::NewObject('IPv6Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $oGatewayIp);
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

		// Make sure all IPs belonging to subnet are attached to it
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :ip <= i.ip AND i.ip <= :lastip AND i.org_id = :org_id", array(
			'ip' => $sSubnetIp,
			'lastip' => $sLastIp,
			'org_id' => $iOrgId,
		)));
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
				$sOQL = "SELECT IPv6Address WHERE subnet_id = :id AND status != 'released'";
				$oIpAddressesSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('id' => $iId));
				while ($oIpAddress = $oIpAddressesSet->Fetch()) {
					$oIpAddress->Set('status', 'released');
					$oIpAddress->DBUpdate();
				}
			}
		}
	}

	/**
	 * Check validity of deletion request
	 *
	 * @param $oDeletionPlan
	 *
	 * @throws \OQLException
	 */
	protected function DoCheckToDelete(&$oDeletionPlan)
	{
		$iOrgId = $this->Get('org_id');
		$sIp = $this->Get('ip')->GetAsCompressed();
		$sBitMask = $this->Get('mask');
		$sLastIp = $this->Get('lastip')->GetAsCompressed();

		parent::DoCheckToDelete($oDeletionPlan);

		// Add subnet and gateway IP to deletion plan if they exist
		if ($sBitMask != '128') {
			$oIpAddress = MetaModel::GetObjectFromOQL("SELECT IPv6Address AS i WHERE i.ip = :ip AND i.org_id = :org_id", array(
				'ip' => $sIp,
				'org_id' => $iOrgId,
			), false);
			if (!is_null($oIpAddress)) {
				$oDeletionPlan->AddToDelete($oIpAddress, DEL_AUTO);
			}

			$oIpAddress = MetaModel::GetObjectFromOQL("SELECT IPv6Address AS i WHERE i.ip = :lastip AND i.org_id = :org_id", array(
				'lastip' => $sLastIp,
				'org_id' => $iOrgId,
			), false);
			if (!is_null($oIpAddress)) {
				$oDeletionPlan->AddToDelete($oIpAddress, DEL_AUTO);
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
				$sGatewayIPFormat = $this->Get('ipv6_gateway_ip_format');
				if ($sGatewayIPFormat != '') {
					$iOrgId = $this->Get('org_id');
					if ($iOrgId != 0) {
						if ($sGatewayIPFormat == 'default') {
							$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv6_gateway_ip_format', $iOrgId);
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
	 * @inheritdoc
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		$sFlagsFromParent = parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);

		switch ($sAttCode) {
			case 'org_id':
			case 'block_id':
			case 'ip':
			case 'mask':
			case 'lastip':
			case 'ip_occupancy':
			case 'range_occupancy':
				return (OPT_ATT_READONLY | $sFlagsFromParent);

			case 'gatewayip':
				$sGatewayIPFormat = $this->Get('ipv6_gateway_ip_format');
				if ($sGatewayIPFormat == 'default') {
					$iOrgId = $this->Get('org_id');
					$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv6_gateway_ip_format', $iOrgId);
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
	 * @param $iPrefix
	 *
	 * @return string
	 */
	public static function BitToMask($iPrefix)
	{
		// Provides size of subnet according to dotted string mask
		switch ($iPrefix) {
			case '64':
				return "FFFF:FFFF:FFFF:FFFF::";
			case '65':
				return "FFFF:FFFF:FFFF:FFFF:8000::";
			case '66':
				return "FFFF:FFFF:FFFF:FFFF:C000::";
			case '67':
				return "FFFF:FFFF:FFFF:FFFF:E000::";
			case '71':
				return "FFFF:FFFF:FFFF:FFFF:FE00::";
			case '72':
				return "FFFF:FFFF:FFFF:FFFF:FF00::";
			case '73':
				return "FFFF:FFFF:FFFF:FFFF:FF80::";
			case '74':
				return "FFFF:FFFF:FFFF:FFFF:FFC0::";
			case '68':
				return "FFFF:FFFF:FFFF:FFFF:F000::";
			case '69':
				return "FFFF:FFFF:FFFF:FFFF:F800::";
			case '70':
				return "FFFF:FFFF:FFFF:FFFF:FC00::";
			case '75':
				return "FFFF:FFFF:FFFF:FFFF:FFE0::";
			case '76':
				return "FFFF:FFFF:FFFF:FFFF:FFF0::";
			case '77':
				return "FFFF:FFFF:FFFF:FFFF:FFF8::";
			case '78':
				return "FFFF:FFFF:FFFF:FFFF:FFFC::";
			case '79':
				return "FFFF:FFFF:FFFF:FFFF:FFFE::";
			case '80':
				return "FFFF:FFFF:FFFF:FFFF:FFFF::";
			case '81':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:8000::";
			case '82':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:C000::";
			case '83':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:E000::";
			case '84':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:F000::";
			case '85':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:F800::";
			case '86':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FC00::";
			case '87':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FE00::";
			case '88':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FF00::";
			case '89':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FF80::";
			case '90':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFC0::";
			case '91':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFE0::";
			case '92':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFF0::";
			case '93':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFF8::";
			case '94':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFC::";
			case '95':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFE::";
			case '96':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF::";
			case '97':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:8000:0";
			case '98':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:C000:0";
			case '99':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:E000:0";
			case '100':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:F000:0";
			case '101':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:F800:0";
			case '102':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FC00:0";
			case '103':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FE00:0";
			case '104':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FF00:0";
			case '105':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FF80:0";
			case '106':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFC0:0";
			case '107':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFE0:0";
			case '108':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFF0:0";
			case '109':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFF8:0";
			case '110':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFC:0";
			case '111':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFE:0";
			case '112':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:0";
			case '113':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:8000";
			case '114':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:C000";
			case '115':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:E000";
			case '116':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:F000";
			case '117':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:F800";
			case '118':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FC00";
			case '119':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FE00";
			case '120':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FF00";
			case '121':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FF80";
			case '122':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFC0";
			case '123':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFE0";
			case '124':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFF0";
			case '125':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFF8";
			case '126':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFC";
			case '127':
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFE";
			case '128':
			default:
				return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF";
		}
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
		$oIp = $this->Get('ip');
		$sIp = $oIp->GetAsCannonical();

		// Create OQL according to $bInBlock
		$iBlock = $this->Get('block_id');
		if ($bInBlock) {
			if ($iBlock > 0) {
				$sOQL = 'SELECT IPv6Subnet AS s WHERE s.block_id = :block_id AND s.ip_text < :ip';
			} else {
				return null;
			}
		} else {
			$sOQL = 'SELECT IPv6Subnet AS s WHERE s.org_id = :org_id AND s.ip_text < :ip';
		}
		// Set the ordering criteria ['ip'=> false] and set a limit (1)
		$oSubnetSet = new DBObjectSet(DBSearch::FromOQL($sOQL), ['ip' => false], ['org_id' => $this->Get('org_id'), 'block_id' => $iBlock, 'ip' => $sIp], null, 1);
		$oSubnetSet->OptimizeColumnLoad(['IPv6Subnet' => ['id', 'ip']]);
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
		$oIp = $this->Get('ip');
		$sIp = $oIp->GetAsCannonical();

		// Create OQL according to $bInBlock
		$iBlock = $this->Get('block_id');
		if ($bInBlock) {
			if ($iBlock > 0) {
				$sOQL = 'SELECT IPv6Subnet AS s WHERE s.block_id = :block_id AND s.ip_text > :ip';
			} else {
				return null;
			}
		} else {
			$sOQL = 'SELECT IPv6Subnet AS s WHERE s.org_id = :org_id AND s.ip_text > :ip';
		}
		// Set the ordering criteria ['ip'=> false] and set a limit (1)
		$oSubnetSet = new DBObjectSet(DBSearch::FromOQL($sOQL), ['ip' => true], ['org_id' => $this->Get('org_id'), 'block_id' => $iBlock, 'ip' => $sIp], null, 1);
		$oSubnetSet->OptimizeColumnLoad(['IPv6Subnet' => ['id', 'ip']]);
		if ($oNextSubnet = $oSubnetSet->Fetch()) {
			return $oNextSubnet;
		}

		return null;
	}

}
