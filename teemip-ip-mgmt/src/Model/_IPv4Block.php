<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Model;

use ApplicationException;
use cmdbAbstractObject;
use CMDBObjectSet;
use Combodo\iTop\Application\UI\Base\Component\Button\ButtonUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Html\HtmlFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\InputUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\Select\SelectOptionUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\SelectUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Toolbar\ToolbarUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\Column\Column;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\MultiColumn;
use DBObjectSearch;
use Dict;
use DisplayBlock;
use IPBlock;
use IPConfig;
use IPv4Subnet;
use MetaModel;
use TeemIp\TeemIp\Extension\IPManagement\Controller\TeemIpUtils;
use UserRights;
use utils;
use WebPage;

class _IPv4Block extends IPBlock {
	/**
	 * Returns icon to be displayed
	 *
	 * @param bool $bImgTag
	 * @param bool $bXsIcon
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function GetIcon($bImgTag = true, $bXsIcon = false) {
		if ($bXsIcon) {
			$sIcon = utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/asset/img/ipblock-xs.png';

			return ("<img src=\"$sIcon\" alt=\"IP Block\" style=\"vertical-align:middle;\"/>");
		}

		return parent::GetIcon($bImgTag);
	}

	/**
	 * Returns index to be used within tree computations
	 *
	 * @return int
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function GetIndexForTree() {
		return TeemIpUtils::myip2long($this->Get('firstip'));
	}

	/**
	 * Returns size of block
	 *
	 * @return int
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function GetSize() {
		return (TeemIpUtils::myip2long($this->Get('lastip')) - TeemIpUtils::myip2long($this->Get('firstip')) + 1);
	}

	/**
	 * Returns minimum block size required
	 *
	 * @return bool|int|mixed|string|string[]|null
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	private function GetMinBlockSize() {
		$iBlockMinSize = utils::ReadPostedParam('attr_ipv4_block_min_size', '');
		if (empty($iBlockMinSize)) {
			$iOrgId = $this->Get('org_id');
			$iBlockMinSize = IPConfig::GetFromGlobalIPConfig('ipv4_block_min_size', $iOrgId);
		} else {
			// Default value may be overwritten but not under absolute minimum value.
			if ($iBlockMinSize < IPV4_BLOCK_MIN_SIZE) {
				$iBlockMinSize = IPV4_BLOCK_MIN_SIZE;
			}
		}

		return $iBlockMinSize;
	}

	/**
	 * Return % of occupancy of objects linked to $this
	 *
	 * @param $sObject
	 *
	 * @return float|int
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function GetOccupancy($sObject) {
		$iOrgId = $this->Get('org_id');
		$iKey = $this->GetKey();
		$iBlockSize = $this->GetSize();

		switch ($sObject) {
			case 'IPBlock':
			case 'IPv4Block':
				// Look for all child blocks
				$iChildBlockSize = 0;
				$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.parent_id = $iKey AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)"));
				while ($oSRange = $oSRangeSet->Fetch()) {
					$iChildBlockSize += $oSRange->GetSize();
				}

				return ($iChildBlockSize / $iBlockSize) * 100;

			case 'IPSubnet':
			case 'IPv4Subnet':
				// Look for all child subnets
				$iSubnetSize = 0;
				$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = $iKey AND s.org_id = $iOrgId"));
				while ($oSubnet = $oSubnetSet->Fetch()) {
					$iSubnetSize += $oSubnet->GetSize();
				}

				return ($iSubnetSize / $iBlockSize) * 100;

			default:
				return 0;
		}
	}

	/**
	 * Find space within the block to create child block or subnet
	 *
	 * @param $iSize
	 * @param $iMaxOffer
	 * @param $iOffsetIp
	 *
	 * @return array
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function GetFreeSpace($iSize, $iMaxOffer, $iOffsetIp) {
		$bitMask = IPv4Subnet::SizeToMask($iSize);
		$iOrgId = $this->Get('org_id');
		$iKey = ($this->GetKey() > 0) ? $this->GetKey() : 0;
		$aFreeSpace = array();

		// Get list of registered blocks and subnets in subnet range
		$sFirstIp = $this->Get('firstip');
		$iObjFirstIp = TeemIpUtils::myip2long($sFirstIp);
		$sLastIp = $this->Get('lastip');
		$iObjLastIp = TeemIpUtils::myip2long($sLastIp);
		if ($iKey == 0) {
			// Search at root space, outside any block - delegated or not
			$sOQL = "SELECT IPv4Block AS b WHERE b.org_id = :org_id AND b.parent_id = 0 UNION SELECT IPv4Block AS b WHERE b.parent_org_id = :org_id AND b.parent_id = 0";
		} else {
			$sOQL = "SELECT IPv4Block AS b WHERE b.parent_id = :id";
		}
		$oChildBlockSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('id' => $iKey, 'org_id' => $iOrgId));
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = $iKey AND s.org_id = $iOrgId"));

		$aList = array();
		$i = 0;
		while ($oChildBlock = $oChildBlockSet->Fetch()) {
			$iBlockFirstIp = TeemIpUtils::myip2long($oChildBlock->Get('firstip'));
			$aList[$i] = array();
			$aList[$i]['firstip'] = $iBlockFirstIp;
			$aList[$i]['lastip'] = TeemIpUtils::myip2long($oChildBlock->Get('lastip'));
			$i++;
		}
		while ($oSubnet = $oSubnetSet->Fetch()) {
			$iSubnetFirstIp = TeemIpUtils::myip2long($oSubnet->Get('ip'));
			$aList[$i] = array();
			$aList[$i]['firstip'] = $iSubnetFirstIp;
			$aList[$i]['lastip'] = TeemIpUtils::myip2long($oSubnet->Get('broadcastip'));
			$i++;
		}
		// Sort $aList by 'firstip' and create array of free ranges
		$aFreeList = array();
		if (!empty($aList)) {
			foreach ($aList as $key => $row) {
				$aFirstIp[$key] = $row['firstip'];
			}
			array_multisort($aFirstIp, SORT_ASC, $aList);

			$iSizeArray = $i;
			$iAnIp = $iObjFirstIp;
			$i = 0;
			$j = 0;
			while ($i < $iSizeArray) {
				while (($i < $iSizeArray) && ($iAnIp == $aList[$i]['firstip'])) {
					$iAnIp = $aList[$i]['lastip'] + 1;
					$i++;
				}
				if ($iAnIp < $iObjLastIp) {
					$aFreeList[$j] = array();
					$aFreeList[$j]['firstip'] = $iAnIp;
					if ($i < $iSizeArray) {
						$aFreeList[$j]['lastip'] = $aList[$i]['firstip'] - 1;
						$iAnIp = $aList[$i]['firstip'];
					} else {
						$aFreeList[$j]['lastip'] = $iObjLastIp;
					}
					$j++;
				}
			}
			$iSizeFreeArray = $j;
		} else {
			$iSizeFreeArray = 1;
			$aFreeList[0] = array();
			$aFreeList[0]['firstip'] = $iObjFirstIp;
			$aFreeList[0]['lastip'] = $iObjLastIp;
		}

		// Store possible choices in array
		if ($iSizeFreeArray != 0) {
			$j = 0;
			$n = 0;
			do {
				$iAnIp = $aFreeList[$j]['firstip'];
				// Align $iAnIp to mask
				if (($iAnIp & ip2long($bitMask)) != $iAnIp) {
					$iAnIp = ($iAnIp & ip2long($bitMask)) + $iSize;
					//$iAnIp = TeemIpUtils::myip2long(long2ip($iAnIp));
				}
				$iLastFreeIp = $aFreeList[$j]['lastip'];
				$iLastIp = $iAnIp + $iSize - 1;
				while (($iLastIp <= $iLastFreeIp) && ($n < $iMaxOffer)) {
					// Skip space if it not beyond offset
					if ($iOffsetIp <= $iAnIp) {
						$aFreeSpace[$n] = array();
						$aFreeSpace[$n]['firstip'] = TeemIpUtils::mylong2ip($iAnIp);
						$aFreeSpace[$n]['lastip'] = TeemIpUtils::mylong2ip($iLastIp);
						$aFreeSpace[$n]['mask'] = $bitMask;
						$n++;
					}
					$iAnIp = $iLastIp + 1;
					$iLastIp = $iAnIp + $iSize - 1;
				}
			} while ((++$j < $iSizeFreeArray) && ($n < $iMaxOffer));
		}

		// Return result
		return $aFreeSpace;
	}

	/**
	 * List occupied space wihtin block
	 *
	 * @return array
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function GetOccupiedSpace() {
		// Get list of registered blocks and subnets in subnet range
		$iKey = ($this->GetKey() > 0) ? $this->GetKey() : 0;
		$iOrgId = $this->Get('org_id');

		if ($iKey == 0) {
			// Search at root space, outside any block - delegated or not
			$sOQL = "SELECT IPv4Block AS b WHERE b.org_id = :org_id AND b.parent_id = 0 UNION SELECT IPv4Block AS b WHERE b.parent_org_id = :org_id AND b.parent_id = 0";
		} else {
			$sOQL = "SELECT IPv4Block AS b WHERE b.parent_id = :id";
		}
		$oChildBlockSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('id' => $iKey, 'org_id' => $iOrgId));
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = $iKey AND s.org_id = $iOrgId"));

		$aList = array();
		$i = 0;
		while ($oChildBlock = $oChildBlockSet->Fetch()) {
			$aList[$i] = array();
			$aList[$i]['type'] = 'IPv4Block';
			$aList[$i]['firstip'] = TeemIpUtils::myip2long($oChildBlock->Get('firstip'));
			$aList[$i]['lastip'] = TeemIpUtils::myip2long($oChildBlock->Get('lastip'));
			$aList[$i]['obj'] = $oChildBlock;
			$i++;
		}
		while ($oSubnet = $oSubnetSet->Fetch()) {
			$aList[$i] = array();
			$aList[$i]['type'] = 'IPv4Subnet';
			$aList[$i]['firstip'] = TeemIpUtils::myip2long($oSubnet->Get('ip'));
			$aList[$i]['lastip'] = TeemIpUtils::myip2long($oSubnet->Get('broadcastip'));
			$aList[$i]['obj'] = $oSubnet;
			$i++;
		}
		// Sort $aList by 'firstip'
		if (!empty($aList)) {
			foreach ($aList as $key => $row) {
				$aFirstIp[$key] = $row['firstip'];
			}
			array_multisort($aFirstIp, SORT_ASC, $aList);
		}

		return $aList;
	}

	/**
	 * Compute max possible 'CIDR aligned' space that can contain the block
	 *
	 * @return int
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function GetMinTheoriticalBlockPrefix() {
		//	1. Search space that can fit in block only
		$iBlockSize = $this->GetSize();
		$iMaxSize = IPv4Subnet::MaskToSize("192.0.0.0");
		while ($iBlockSize <= $iMaxSize) {
			$iMaxSize /= 2;
		}
		$bitMask = TeemIpUtils::myip2long(IPv4Subnet::SizeToMask($iMaxSize));
		//	2. Make sure block holds space of $iMaxSize CIDR aligned
		$iFirstIp = TeemIpUtils::myip2long($this->Get('firstip'));
		$iLastIp = TeemIpUtils::myip2long($this->Get('lastip'));
		if (($iFirstIp & $bitMask) != $iFirstIp) {
			if (($iLastIp - (($iFirstIp & $bitMask) + $bitMask + 1)) > $iMaxSize) {
				$iMaxSize /= 2;
				$bitMask = $bitMask >> 1;
			}
		}
		$i = IPv4Subnet::SizeToBit($iMaxSize);

		return $i;
	}

	/**
	 * Look for smaller block containing the IP in given organization
	 *
	 * @param $iOrgId
	 * @param $sIP
	 *
	 * @return int|null
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public static function GetSmallerBlockContainingIp($iOrgId, $sIp) {
		$oBlockSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE INET_ATON(b.firstip) <= INET_ATON('$sIp') AND INET_ATON('$sIp') <= INET_ATON(b.lastip) AND b.org_id = $iOrgId"));
		$iMinBlockId = 0;
		if ($oBlockSet->Count() > 0) {
			$oBlock = $oBlockSet->Fetch();
			$iMinBlockId = $oBlock->GetKey();
			$iMinBlockSize = $oBlock->GetSize();
			while ($oBlock = $oBlockSet->Fetch()) {
				$iBlockSize = $oBlock->GetSize();
				if ($iBlockSize < $iMinBlockSize) {
					$iMinBlockId = $oBlock->GetKey();
					$iMinBlockSize = $iBlockSize;
				}
			}
		}

		return $iMinBlockId;
	}

	/**
	 * Check if block is CIDR aligned
	 *
	 * @param int $iNewFirstIp
	 * @param int $iNewLastIp
	 *
	 * @return bool
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	private function DoCheckCIDRAligned($iNewFirstIp = 0, $iNewLastIp = 0) {
		$sBlockCidrAligned = utils::ReadPostedParam('attr_ipv4_block_cidr_aligned', '');
		if (empty($sBlockCidrAligned)) {
			$iOrgId = $this->Get('org_id');
			$sBlockCidrAligned = IPConfig::GetFromGlobalIPConfig('ipv4_block_cidr_aligned', $iOrgId);
		}
		if ($sBlockCidrAligned == 'bca_yes') {
			$iFirstIp = ($iNewFirstIp == 0) ? TeemIpUtils::myip2long($this->Get('firstip')) : $iNewFirstIp;
			$iLastIp = ($iNewLastIp == 0) ? TeemIpUtils::myip2long($this->Get('lastip')) : $iNewLastIp;
			// Compute size of new block and check if it corresponds to size of a CIDR block
			$Size = $iLastIp - $iFirstIp + 1;
			if (($Size & ($Size - 1)) != 0) {
				return false;
			}
			// Check that FirstIp is CIDR aligned
			// Call to ip2long(long2ip()) is a workaround to handle integers that are above their max size
			$iMask = IPv4Subnet::SizeToMask($Size);
			if (($iFirstIp & TeemIpUtils::myip2long($iMask)) != $iFirstIp) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Get parameters used for operations
	 *
	 * @param $sOperation
	 *
	 * @return array
	 */
	public function GetPostedParam($sOperation) {
		$aParam = array();
		switch ($sOperation) {
			case 'dofindspace':
				$aParam['spacesize'] = utils::ReadPostedParam('spacesize', '', 'raw_data');
				$aParam['maxoffer'] = utils::ReadPostedParam('maxoffer', '', 'raw_data');
				$aParam['status_subnet'] = utils::ReadPostedParam('attr_status_subnet', null);
				$aParam['type'] = utils::ReadPostedParam('attr_type', null);
				$aParam['location_id'] = utils::ReadPostedParam('attr_location_id', null);
				$aParam['requestor_id'] = utils::ReadPostedParam('attr_requestor_id', null);
				break;

			case 'doshrinkblock':
			case 'doexpandblock':
				$aParam['firstip'] = filter_var(utils::ReadPostedParam('attr_firstip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['lastip'] = filter_var(utils::ReadPostedParam('attr_lastip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['requestor_id'] = utils::ReadPostedParam('attr_requestor_id', null);
				$aParam['ipv4_block_min_size'] = utils::ReadPostedParam('attr_ipv4_block_min_size', IPV4_BLOCK_MIN_SIZE);
				$aParam['ipv4_block_cidr_aligned'] = utils::ReadPostedParam('attr_ipv4_block_cidr_aligned', 1);
				break;

			case 'dosplitblock':
				$aParam['ip'] = filter_var(utils::ReadPostedParam('attr_ip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['newname'] = utils::ReadPostedParam('newname', '', 'raw_data');
				$aParam['requestor_id'] = utils::ReadPostedParam('attr_requestor_id', null);
				$aParam['ipv4_block_min_size'] = utils::ReadPostedParam('attr_ipv4_block_min_size', IPV4_BLOCK_MIN_SIZE);
				$aParam['ipv4_block_cidr_aligned'] = utils::ReadPostedParam('attr_ipv4_block_cidr_aligned', 1);
				break;

			case 'dodelegate':
				$aParam['child_org_id'] = utils::ReadPostedParam('child_org_id', '', 'raw_data');
				break;

			default:
				break;
		}

		return $aParam;
	}

	/**
	 * Check if space can be searched
	 *
	 * @param $aParam
	 *
	 * @return string
	 */
	public function DoCheckToDisplayAvailableSpace($aParam) {
		return '';
	}

	/**
	 * Displays available space
	 *
	 * @param \WebPage $oP
	 * @param $iChangeId
	 * @param $aParameter
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 * @throws \Exception
	 */
	public function totoDoDisplayAvailableSpace(WebPage $oP, $iChangeId, $aParameter) {
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$sOrigin = $this->Get('origin');
		$sIpToStartFrom = array_key_exists('ip', $aParameter) ? $aParameter['ip'] : $this->Get('firstip');
		$iIpToStartFrom = TeemIpUtils::myip2long($sIpToStartFrom);
		$iSize = $aParameter['spacesize'];
		$bitMask = IPv4Subnet::SizeToMask($iSize);
		$iMaxOffer = $aParameter['maxoffer'];
		$sStatusSubnet = $aParameter['status_subnet'];
		$sType = $aParameter['type'];
		$iLocationId = $aParameter['location_id'];
		$iRequestorId = $aParameter['requestor_id'];
		$iBlockMinSize = IPConfig::GetFromGlobalIPConfig('ipv4_block_min_size', $iOrgId);
		$bOfferBlock = ($iSize >= $iBlockMinSize) ? true : false;
		if ($sOrigin == 'rir') {
			$bOfferSubnet = false;
			$sTargetOrigin = 'lir';
		} else {
			$bOfferSubnet = ($iSize <= IPV4_SUBNET_MAX_SIZE) ? true : false;
			$sTargetOrigin = 'other';
		}

		// Get list of free and occupied space in subnet range
		$aFreeSpace = $this->GetFreeSpace($iSize, $iMaxOffer, $iIpToStartFrom);
		$iSizeFreeArray = sizeof($aFreeSpace);
		if ($iSizeFreeArray == 0) {
			$sIssueDesc = Dict::Format('UI:IPManagement:Action:DoFindSpace:IPBlock:NoSpaceFound', $this->GetName());
			$sMessage = "<div class=\"header_message message_info teemip_message_status\">".$sIssueDesc."</div>";
			$oP->add($sMessage);

			$this->DisplayAllSpace($oP);
		} else {
			$aOccupiedSpace = $this->GetOccupiedSpace();

			// Check user rights
			$UserHasRightsToCreateBlocks = (UserRights::IsActionAllowed('IPv4Block', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
			$UserHasRightsToCreateSubnets = (UserRights::IsActionAllowed('IPv4Subnet', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;

			// Display Summary of parameters
			$sHtml = "<b>&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv4Block:Summary', $iMaxOffer, IPv4Subnet::SizeToBit($iSize))."</b>&nbsp;";
			$sHtml .= ($iId > 0) ? $this->GetHyperlink() : '';
			$sHtml .= "&nbsp;[".$this->GetAsHTML('firstip')." - ".$this->GetAsHTML('lastip')."]&nbsp;";
			$sHtml .= (array_key_exists('ip', $aParameter)) ? Dict::Format('IPManagement:Action:DoFindSpace:IPBlock:IPToStartFrom', $sIpToStartFrom) : '';
			$oP->add("<ul><li>".$sHtml."<ul>\n");

			// Display possible choices as list
			$i = 0;
			$j = 0;
			$iVIdCounter = 1;
			$iAnOccupiedIp = TeemIpUtils::myip2long(array_key_exists('ip', $aParameter) ? $aParameter['ip'] : $this->Get('firstip'));
			$iIpToStartFrom = TeemIpUtils::myip2long($sIpToStartFrom);
			$iSizeOccupiedArray = sizeof($aOccupiedSpace);
			do {
				$sAFreeIp = $aFreeSpace[$i]['firstip'];
				$iAFreeIp = TeemIpUtils::myip2long($sAFreeIp);
				$sLastFreeIp = $aFreeSpace[$i]['lastip'];
				$iLastFreeIp = TeemIpUtils::myip2long($sLastFreeIp);

				// Before displaying offer, display already occupied space sitting before that offer
				if ($iSizeOccupiedArray != 0) {
					while (($iAnOccupiedIp < $iAFreeIp) && ($j < $iSizeOccupiedArray)) {
						// Display un-occupied space if its size is smaller than the requested $iSize
						if ($iAnOccupiedIp < $aOccupiedSpace[$j]['firstip']) {
							$iLastOccupiedIp = $aOccupiedSpace[$j]['firstip'] - 1;
							// Display space only if within requested scope
							if ($iIpToStartFrom <= $iAnOccupiedIp) {
								$iNbIps = $iLastOccupiedIp - $iAnOccupiedIp + 1;
								if ($iNbIps < $iSize) {
									$iFormatNbIps = number_format($iNbIps, 0, ',', ' ');
									$oP->add("<li>".Dict::Format('UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpaceNoPercent', TeemIpUtils::mylong2ip($iAnOccupiedIp), TeemIpUtils::mylong2ip($iLastOccupiedIp), $iFormatNbIps)."</li>\n");
								}
							}
							$iAnOccupiedIp = $aOccupiedSpace[$j]['firstip'];
						} elseif ($iAnOccupiedIp == $aOccupiedSpace[$j]['firstip']) {
							// Display space only if within requested scope
							if ($iIpToStartFrom <= $iAnOccupiedIp) {
								// Display object attributes
								$sIcon = $aOccupiedSpace[$j]['obj']->GetIcon(true, true);
								$oP->add("<li>".$sIcon.$aOccupiedSpace[$j]['obj']->GetHyperlink());
								if ($aOccupiedSpace[$j]['type'] == 'IPv4Subnet') {
									$oP->add("&nbsp;".Dict::S('Class:IPv4Subnet/Attribute:mask/Value_cidr:'.$aOccupiedSpace[$j]['obj']->Get('mask')));
								} else {
									$oP->add("&nbsp;[".TeemIpUtils::mylong2ip($aOccupiedSpace[$j]['firstip'])." - ".TeemIpUtils::mylong2ip($aOccupiedSpace[$j]['lastip'])."]");

									// Display delegation information if required
									$iParentOrgId = $aOccupiedSpace[$j]['obj']->Get('parent_org_id');
									if ($iParentOrgId == $iOrgId) {
										// Block is delegated to child org
										$oP->add("&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:IPBlock:DelegatedToChild', $aOccupiedSpace[$j]['obj']->GetAsHTML('org_id')));
									} elseif ($iParentOrgId != 0) {
										// Block is delegated from parent org
										$oP->add("&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:IPBlock:DelegatedFromParent', $aOccupiedSpace[$j]['obj']->GetAsHTML('parent_org_id')));
									}
								}
								$oP->add("</li>\n");
							}
							$iAnOccupiedIp = $aOccupiedSpace[$j]['lastip'] + 1;
							$j++;
						} elseif ($iAnOccupiedIp > $aOccupiedSpace[$j]['firstip']) {
							$j++;
						}
					}
				}
				$iAnOccupiedIp = $iLastFreeIp + 1;

				// Display offer now
				$oP->add("<li>".$sAFreeIp." - ".$sLastFreeIp."\n"."<ul>");

				// If user has rights to create block, display block with icon to create it
				if ($bOfferBlock) {
					if ($UserHasRightsToCreateBlocks) {
						$iVId = $iVIdCounter++;
						$sHTMLValue = "<li><div><span id=\"v_{$iVId}\">";
						$sHTMLValue .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/asset/img/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
						$sHTMLValue .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsBlock')."&nbsp;&nbsp;";
						$sHTMLValue .= "</span></div></li>\n";
						$oP->add($sHTMLValue);
						if ($sOrigin == 'rir') {
							// Creation implies a delegation
							$sPayLoad = '{\'org_id\': \''.$iOrgId.'\', \'parent_org_id\': \''.$iOrgId.'\', \'parent_id\': \''.$iId.'\', \'origin\': \''.$sTargetOrigin.'\', \'firstip\': \''.$sAFreeIp.'\', \'lastip\': \''.$sLastFreeIp.'\'}';
						} else {
							//$sPayLoad = {'org_id': '$iOrgId', 'parent_id': '$iId', 'firstip': '$sAFreeIp', 'lastip': '$sLastFreeIp'}
							$sPayLoad = '{\'org_id\': \''.$iOrgId.'\', \'parent_id\': \''.$iId.'\', \'origin\': \''.$sTargetOrigin.'\', \'firstip\': \''.$sAFreeIp.'\', \'lastip\': \''.$sLastFreeIp.'\'}';
						}
						$oP->add_ready_script(
							<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv4Block', $iChangeId, $sPayLoad);
EOF
						);
					}
				}

				// If user has rights to create subnet, display subnet with icon to create it
				if ($bOfferSubnet) {
					if ($UserHasRightsToCreateSubnets) {
						$iVId = $iVIdCounter++;
						$sHTMLValue = "<li><div><span id=\"v_{$iVId}\">";
						$sHTMLValue .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/asset/img/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
						$sHTMLValue .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsSubnet')."&nbsp;&nbsp;";
						$sHTMLValue .= "</span></div></li>\n";
						$oP->add($sHTMLValue);
						$oP->add_ready_script(
							<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv4Subnet', $iChangeId, {'org_id': '$iOrgId', 'block_id': '$iId', 'ip': '$sAFreeIp', 'mask': '$bitMask', 'status': '$sStatusSubnet', 'type': '$sType', 'location_id': '$iLocationId', 'requestor_id': '$iRequestorId'});
EOF
						);
					}
				}

				$oP->add("</ul></li>\n");
			} while (++$i < $iSizeFreeArray);

			$oP->add("</ul></li></ul>\n");
		}
	}

	/**
	 * Get available space
	 *
	 * @param \WebPage $oP
	 * @param $iChangeId
	 * @param $aParameter
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 * @throws \Exception
	 */
	public function GetAvailableSpace(WebPage $oP, $iChangeId, $aParameter) {
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$sOrigin = $this->Get('origin');
		$sIpToStartFrom = array_key_exists('ip', $aParameter) ? $aParameter['ip'] : $this->Get('firstip');
		$iIpToStartFrom = TeemIpUtils::myip2long($sIpToStartFrom);
		$iSize = $aParameter['spacesize'];
		$bitMask = IPv4Subnet::SizeToMask($iSize);
		$iMaxOffer = $aParameter['maxoffer'];
		$sStatusSubnet = $aParameter['status_subnet'];
		$sType = $aParameter['type'];
		$iLocationId = $aParameter['location_id'];
		$iRequestorId = $aParameter['requestor_id'];
		$iBlockMinSize = IPConfig::GetFromGlobalIPConfig('ipv4_block_min_size', $iOrgId);
		$bOfferBlock = ($iSize >= $iBlockMinSize) ? true : false;
		if ($sOrigin == 'rir') {
			$bOfferSubnet = false;
			$sTargetOrigin = 'lir';
		} else {
			$bOfferSubnet = ($iSize <= IPV4_SUBNET_MAX_SIZE) ? true : false;
			$sTargetOrigin = 'other';
		}

		// Get list of free and occupied space in subnet range
		$aFreeSpace = $this->GetFreeSpace($iSize, $iMaxOffer, $iIpToStartFrom);
		$iSizeFreeArray = sizeof($aFreeSpace);
		if ($iSizeFreeArray == 0) {
			$sIssueDesc = Dict::Format('UI:IPManagement:Action:DoFindSpace:IPBlock:NoSpaceFound', $this->GetName());
			$sMessage = "<div class=\"header_message message_info teemip_message_status\">".$sIssueDesc."</div>";
			$oP->add($sMessage);

			$Html = $this->GetAllSpace($oP);
		} else {
			$aOccupiedSpace = $this->GetOccupiedSpace();

			// Check user rights
			$UserHasRightsToCreateBlocks = (UserRights::IsActionAllowed('IPv4Block', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
			$UserHasRightsToCreateSubnets = (UserRights::IsActionAllowed('IPv4Subnet', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;


			$sHtml = '';
			// Open table
			$sHtml .= '<table style="width:100%"><tr><td colspan="2">';
			$sHtml .= '<div style="vertical-align:top;" id="tree">';

			// Display Summary of parameters
			$sHtml .= "<ul><li>";
			$sHtml .= "<b>&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv4Block:Summary', $iMaxOffer, IPv4Subnet::SizeToBit($iSize))."</b>&nbsp;";
			$sHtml .= ($iId > 0) ? $this->GetHyperlink() : '';
			$sHtml .= "&nbsp;[".$this->GetAsHTML('firstip')." - ".$this->GetAsHTML('lastip')."]&nbsp;";
			$sHtml .= (array_key_exists('ip', $aParameter)) ? Dict::Format('IPManagement:Action:DoFindSpace:IPBlock:IPToStartFrom', $sIpToStartFrom) : '';
			$sHtml .= "<ul>\n";

			// Display possible choices as list
			$i = 0;
			$j = 0;
			$iVIdCounter = 1;
			$iAnOccupiedIp = TeemIpUtils::myip2long(array_key_exists('ip', $aParameter) ? $aParameter['ip'] : $this->Get('firstip'));
			$iIpToStartFrom = TeemIpUtils::myip2long($sIpToStartFrom);
			$iSizeOccupiedArray = sizeof($aOccupiedSpace);
			do {
				$sAFreeIp = $aFreeSpace[$i]['firstip'];
				$iAFreeIp = TeemIpUtils::myip2long($sAFreeIp);
				$sLastFreeIp = $aFreeSpace[$i]['lastip'];
				$iLastFreeIp = TeemIpUtils::myip2long($sLastFreeIp);

				// Before displaying offer, display already occupied space sitting before that offer
				if ($iSizeOccupiedArray != 0) {
					while (($iAnOccupiedIp < $iAFreeIp) && ($j < $iSizeOccupiedArray)) {
						// Display un-occupied space if its size is smaller than the requested $iSize
						if ($iAnOccupiedIp < $aOccupiedSpace[$j]['firstip']) {
							$iLastOccupiedIp = $aOccupiedSpace[$j]['firstip'] - 1;
							// Display space only if within requested scope
							if ($iIpToStartFrom <= $iAnOccupiedIp) {
								$iNbIps = $iLastOccupiedIp - $iAnOccupiedIp + 1;
								if ($iNbIps < $iSize) {
									$iFormatNbIps = number_format($iNbIps, 0, ',', ' ');
									$sHtml .= "<li>".Dict::Format('UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpaceNoPercent', TeemIpUtils::mylong2ip($iAnOccupiedIp), TeemIpUtils::mylong2ip($iLastOccupiedIp), $iFormatNbIps)."</li>\n";
								}
							}
							$iAnOccupiedIp = $aOccupiedSpace[$j]['firstip'];
						} elseif ($iAnOccupiedIp == $aOccupiedSpace[$j]['firstip']) {
							// Display space only if within requested scope
							if ($iIpToStartFrom <= $iAnOccupiedIp) {
								// Display object attributes
								$sIcon = $aOccupiedSpace[$j]['obj']->GetIcon(true, true);
								$sHtml .= "<li>".$sIcon.$aOccupiedSpace[$j]['obj']->GetHyperlink();
								if ($aOccupiedSpace[$j]['type'] == 'IPv4Subnet') {
									$sHtml .= "&nbsp;".Dict::S('Class:IPv4Subnet/Attribute:mask/Value_cidr:'.$aOccupiedSpace[$j]['obj']->Get('mask'));
								} else {
									$sHtml .= "&nbsp;[".TeemIpUtils::mylong2ip($aOccupiedSpace[$j]['firstip'])." - ".TeemIpUtils::mylong2ip($aOccupiedSpace[$j]['lastip'])."]";

									// Display delegation information if required
									$iParentOrgId = $aOccupiedSpace[$j]['obj']->Get('parent_org_id');
									if ($iParentOrgId == $iOrgId) {
										// Block is delegated to child org
										$sHtml .= "&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:IPBlock:DelegatedToChild', $aOccupiedSpace[$j]['obj']->GetAsHTML('org_id'));
									} elseif ($iParentOrgId != 0) {
										// Block is delegated from parent org
										$sHtml .= "&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:IPBlock:DelegatedFromParent', $aOccupiedSpace[$j]['obj']->GetAsHTML('parent_org_id'));
									}
								}
								$sHtml .= "</li>\n";
							}
							$iAnOccupiedIp = $aOccupiedSpace[$j]['lastip'] + 1;
							$j++;
						} elseif ($iAnOccupiedIp > $aOccupiedSpace[$j]['firstip']) {
							$j++;
						}
					}
				}
				$iAnOccupiedIp = $iLastFreeIp + 1;

				// Display offer now
				$sHtml .= "<li>".$sAFreeIp." - ".$sLastFreeIp."\n"."<ul>";

				// If user has rights to create block, display block with icon to create it
				if ($bOfferBlock) {
					if ($UserHasRightsToCreateBlocks) {
						$iVId = $iVIdCounter++;
						$sHTMLValue = "<li><div><span id=\"v_{$iVId}\">";
						$sHTMLValue .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/asset/img/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
						$sHTMLValue .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsBlock')."&nbsp;&nbsp;";
						$sHTMLValue .= "</span></div></li>\n";
						$sHtml .= $sHTMLValue;
						if ($sOrigin == 'rir') {
							// Creation implies a delegation
							$sPayLoad = '{\'org_id\': \''.$iOrgId.'\', \'parent_org_id\': \''.$iOrgId.'\', \'parent_id\': \''.$iId.'\', \'origin\': \''.$sTargetOrigin.'\', \'firstip\': \''.$sAFreeIp.'\', \'lastip\': \''.$sLastFreeIp.'\'}';
						} else {
							//$sPayLoad = {'org_id': '$iOrgId', 'parent_id': '$iId', 'firstip': '$sAFreeIp', 'lastip': '$sLastFreeIp'}
							$sPayLoad = '{\'org_id\': \''.$iOrgId.'\', \'parent_id\': \''.$iId.'\', \'origin\': \''.$sTargetOrigin.'\', \'firstip\': \''.$sAFreeIp.'\', \'lastip\': \''.$sLastFreeIp.'\'}';
						}
						$oP->add_ready_script(
							<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv4Block', $iChangeId, $sPayLoad);
EOF
						);
					}
				}

				// If user has rights to create subnet, display subnet with icon to create it
				if ($bOfferSubnet) {
					if ($UserHasRightsToCreateSubnets) {
						$iVId = $iVIdCounter++;
						$sHTMLValue = "<li><div><span id=\"v_{$iVId}\">";
						$sHTMLValue .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/asset/img/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
						$sHTMLValue .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsSubnet')."&nbsp;&nbsp;";
						$sHTMLValue .= "</span></div></li>\n";
						$sHtml .= $sHTMLValue;
						$oP->add_ready_script(
							<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv4Subnet', $iChangeId, {'org_id': '$iOrgId', 'block_id': '$iId', 'ip': '$sAFreeIp', 'mask': '$bitMask', 'status': '$sStatusSubnet', 'type': '$sType', 'location_id': '$iLocationId', 'requestor_id': '$iRequestorId'});
EOF
						);
					}
				}

				$sHtml .= "</ul></li>\n";
			} while (++$i < $iSizeFreeArray);

			$sHtml .= "</ul></li></ul>\n";

			// Close table
			$sHtml .= '</div>';
			$sHtml .= '</td></tr></table>';
			$oP->add_ready_script("\$('#tree ul').treeview();\n");
			$sHtml .= "<div id=\"dialog_content\"/>\n";
		}

		return $sHtml;
	}

	/**
	 * Check if block can be shrunk
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
	public function DoCheckToShrink($aParam) {
		// Set working variables
		$iBlockId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$iParentId = $this->Get('parent_id');
		$sFirstIpCurrentBlock = $this->Get('firstip');
		$iFirstIpCurrentBlock = TeemIpUtils::myip2long($sFirstIpCurrentBlock);
		$sLastIpCurrentBlock = $this->Get('lastip');
		$iLastIpCurrentBlock = TeemIpUtils::myip2long($sLastIpCurrentBlock);
		$sNewFirstIp = $aParam['firstip'];
		$iNewFirstIp = TeemIpUtils::myip2long($sNewFirstIp);
		$sNewLastIp = $aParam['lastip'];
		$iNewLastIp = TeemIpUtils::myip2long($sNewLastIp);

		// Make sure new first IPs is smaller than new last IP
		if ($iNewFirstIp >= $iNewLastIp) {
			return (Dict::Format('UI:IPManagement:Action:Shrink:IPBlock:Reverted'));
		}

		// Make sure new block is contained in old one
		if (($iNewFirstIp < $iFirstIpCurrentBlock) || ($iLastIpCurrentBlock < $iNewFirstIp) || ($iNewLastIp < $iFirstIpCurrentBlock) || ($iLastIpCurrentBlock < $iNewLastIp)) {
			return (Dict::Format('UI:IPManagement:Action:Shrink:IPBlock:IPOutOfBlock'));
		}

		// Make sure block is changing
		if (($iFirstIpCurrentBlock == $iNewFirstIp) && ($iLastIpCurrentBlock == $iNewLastIp)) {
			return (Dict::Format('UI:IPManagement:Action:Shrink:IPBlock:NoChange'));
		}

		// Check that new block has minimum size
		$iBlockMinSize = $this->GetMinBlockSize();
		if (($iNewLastIp - $iNewFirstIp + 1) < $iBlockMinSize) {
			return (Dict::Format('UI:IPManagement:Action:Shrink:IPv4Block:SmallerThanMinSize', $iBlockMinSize));
		}

		// Check that block is CIDR aligned
		if (!$this->DoCheckCIDRAligned($iNewFirstIp, $iNewLastIp)) {
			return (Dict::Format('UI:IPManagement:Action:Shrink:IPBlock:NotCIDRAligned'));
		}

		// Make sure that no child block sits accross border
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.parent_id = '$iBlockId' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)"));
		while ($oSRange = $oSRangeSet->Fetch()) {
			$iCurrentFirstIp = TeemIpUtils::myip2long($oSRange->Get('firstip'));
			$iCurrentLastIp = TeemIpUtils::myip2long($oSRange->Get('lastip'));
			if ((($iCurrentFirstIp < $iNewFirstIp) && ($iNewFirstIp <= $iCurrentLastIp)) || (($iCurrentFirstIp < $iNewLastIp) && ($iNewLastIp <= $iCurrentLastIp))) {
				return (Dict::Format('UI:IPManagement:Action:Shrink:IPBlock:BlockAccrossBorder'));
			}
		}

		// Make sure that no child subnet sits accross border
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = '$iBlockId' AND s.org_id = $iOrgId"));
		while ($oSubnet = $oSubnetSet->Fetch()) {
			$iCurrentFirstIp = TeemIpUtils::myip2long($oSubnet->Get('ip'));
			$iCurrentLastIp = TeemIpUtils::myip2long($oSubnet->Get('broadcastip'));
			if ((($iCurrentFirstIp < $iNewFirstIp) && ($iNewFirstIp <= $iCurrentLastIp)) || (($iCurrentFirstIp < $iNewLastIp) && ($iNewLastIp <= $iCurrentLastIp))) {
				return (Dict::Format('UI:IPManagement:Action:Shrink:IPBlock:SubnetAccrossBorder'));
			}

			if (($iParentId == 0) && (($iCurrentLastIp < $iNewFirstIp) || ($iNewLastIp < $iCurrentFirstIp))) {
				return (Dict::Format('UI:IPManagement:Action:Shrink:IPBlock:SubnetBecomesOrhpean'));
			}
		}

		// Everything looks good
		return '';
	}

	/**
	 * Shrink the block
	 *
	 * @param $aParam
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 * @throws \Exception
	 */
	public function DoShrink($aParam) {
		// Set working variables
		$iBlockId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$iParentId = $this->Get('parent_id');
		$sNewFirstIp = $aParam['firstip'];
		$iNewFirstIp = TeemIpUtils::myip2long($sNewFirstIp);
		$sNewLastIp = $aParam['lastip'];
		$iNewLastIp = TeemIpUtils::myip2long($sNewLastIp);
		$sRequestor_id = $aParam['requestor_id'];

		// Update initial block and register it.
		if (!is_null($sRequestor_id)) {
			$this->Set('requestor_id', $sRequestor_id);
		}
		$this->Set('firstip', $sNewFirstIp);
		$this->Set('lastip', $sNewLastIp);
		$this->DBUpdate();

		//	Attach dropped child blocks to parent block
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.parent_id = '$iBlockId' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)"));
		while ($oSRange = $oSRangeSet->Fetch()) {
			$iCurrentFirstIp = TeemIpUtils::myip2long($oSRange->Get('firstip'));
			$iCurrentLastIp = TeemIpUtils::myip2long($oSRange->Get('lastip'));
			if (($iCurrentLastIp < $iNewFirstIp) || ($iNewLastIp < $iCurrentFirstIp)) {
				$oSRange->Set('parent_id', $iParentId);
				$oSRange->DBUpdate();
			}
		}

		//	Attach child subnets to parent block
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = '$iBlockId' AND s.org_id = $iOrgId"));
		while ($oSubnet = $oSubnetSet->Fetch()) {
			$iCurrentFirstIp = TeemIpUtils::myip2long($oSubnet->Get('ip'));
			$iCurrentLastIp = TeemIpUtils::myip2long($oSubnet->Get('broadcastip'));
			if (($iCurrentLastIp < $iNewFirstIp) || ($iNewLastIp < $iCurrentFirstIp)) {
				$oSubnet->Set('block_id', $iParentId);
				$oSubnet->DBUpdate();
			}
		}
	}

	/**
	 * Check if block can be split
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
	public function DoCheckToSplit($aParam) {
		// Set working variables
		$iBlockId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$sFirstIpCurrentBlock = $this->Get('firstip');
		$iFirstIpCurrentBlock = TeemIpUtils::myip2long($sFirstIpCurrentBlock);
		$sLastIpCurrentBlock = $this->Get('lastip');
		$iLastIpCurrentBlock = TeemIpUtils::myip2long($sLastIpCurrentBlock);
		$sSplitIp = $aParam['ip'];
		$iSplitIp = TeemIpUtils::myip2long($sSplitIp);
		$sNewName = $aParam['newname'];

		// Make sure split Ip is in block
		if (($iSplitIp <= $iFirstIpCurrentBlock) || ($iLastIpCurrentBlock <= $iSplitIp)) {
			return (Dict::Format('UI:IPManagement:Action:Split:IPBlock:IPOutOfBlock'));
		}

		// Check that new blocks have minimum size
		$iBlockMinSize = $this->GetMinBlockSize();
		if ((($iSplitIp - $iFirstIpCurrentBlock) < $iBlockMinSize) || (($iLastIpCurrentBlock - $iSplitIp) < $iBlockMinSize)) {
			return (Dict::Format('UI:IPManagement:Action:Split:IPv4Block:SmallerThanMinSize', $iBlockMinSize));
		}

		// Check that block is CIDR aligned
		if (!$this->DoCheckCIDRAligned($iFirstIpCurrentBlock, $iSplitIp - 1) || !$this->DoCheckCIDRAligned($iSplitIp, $iLastIpCurrentBlock)) {
			return (Dict::Format('UI:IPManagement:Action:Split:IPBlock:NotCIDRAligned'));
		}

		// Make sure that no child block sits accross border
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.parent_id = '$iBlockId' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)"));
		while ($oSRange = $oSRangeSet->Fetch()) {
			$iCurrentFirstIp = TeemIpUtils::myip2long($oSRange->Get('firstip'));
			$iCurrentLastIp = TeemIpUtils::myip2long($oSRange->Get('lastip'));
			if (($iCurrentFirstIp < $iSplitIp) && ($iSplitIp <= $iCurrentLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:Split:IPBlock:BlockAccrossBorder'));
			}
		}

		// Make sure that no child subnet sits accross border
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = '$iBlockId' AND s.org_id = $iOrgId"));
		while ($oSubnet = $oSubnetSet->Fetch()) {
			$iCurrentFirstIp = TeemIpUtils::myip2long($oSubnet->Get('ip'));
			$iCurrentLastIp = TeemIpUtils::myip2long($oSubnet->Get('broadcastip'));
			if (($iCurrentFirstIp < $iSplitIp) && ($iSplitIp <= $iCurrentLastIp)) {
				return (Dict::Format('UI:IPManagement:Action:Split:IPBlock:SubnetAccrossBorder'));
			}
		}

		// Check new name doesn't already exist
		if ($sNewName == '') {
			return (Dict::Format('UI:IPManagement:Action:Split:IPBlock:EmptyNewName'));
		}
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.name = '$sNewName' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)"));
		while ($oSRange = $oSRangeSet->Fetch()) {
			// Skip check with self (DB copy) if necessary
			if ($oSRange->GetKey() != $iBlockId) {
				return (Dict::Format('UI:IPManagement:Action:Split:IPBlock:NameExist'));
			}
		}

		// Everything looks good
		return '';
	}

	/**
	 * Split the block
	 *
	 * @param $aParam
	 *
	 * @return \CMDBObjectSet|\DBObjectSet
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 * @throws \Exception
	 */
	public function DoSplit($aParam) {
		// Set working variables
		$iBlockId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$sLastIpCurrentBlock = $this->Get('lastip');
		$sSplitIp = $aParam['ip'];
		$iSplitIp = TeemIpUtils::myip2long($sSplitIp);
		$sNewName = $aParam['newname'];
		$sRequestor_id = $aParam['requestor_id'];

		// Update initial block and register it.
		if (!is_null($sRequestor_id)) {
			$this->Set('requestor_id', $sRequestor_id);
		}
		$this->Set('lastip', TeemIpUtils::mylong2ip($iSplitIp - 1));
		$this->Set('write_reason', 'split');
		$this->DBUpdate();

		//	Create new block
		$oNewBlock = MetaModel::NewObject('IPv4Block');
		$oNewBlock->Set('org_id', $iOrgId);
		$oNewBlock->Set('name', $sNewName);
		$oNewBlock->Set('parent_id', $this->Get('parent_id'));
		$oNewBlock->Set('firstip', $sSplitIp);
		$oNewBlock->Set('lastip', $sLastIpCurrentBlock);
		$oNewBlock->Set('type', $this->Get('type'));
		$oNewBlock->Set('comment', $this->Get('comment'));
		if (!is_null($sRequestor_id)) {
			$oNewBlock->Set('requestor_id', $sRequestor_id);
		}
		$oNewBlock->Set('write_reason', 'split');
		$oNewBlock->DBInsert();
		$iNewBlockKey = $oNewBlock->GetKey();

		// Link new block to same contacts as original block
		$oContactToIPObjectSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT lnkContactToIPObject AS lnk WHERE (lnk.ipobject_id) = $iBlockId"));
		while ($oContactToIPObject = $oContactToIPObjectSet->Fetch()) {
			$oNewContactLink = MetaModel::NewObject('lnkContactToIPObject');
			$oNewContactLink->Set('ipobject_id', $iNewBlockKey);
			$oNewContactLink->Set('contact_id', $oContactToIPObject->Get('contact_id'));
			$oNewContactLink->DBInsert();
		}

		// Link new block to same docs as original block
		$oDocToIPObjectSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT lnkDocToIPObject AS lnk WHERE (lnk.ipobject_id) = $iBlockId"));
		while ($oDocToIPObject = $oDocToIPObjectSet->Fetch()) {
			$oNewDocLink = MetaModel::NewObject('lnkDocToIPObject');
			$oNewDocLink->Set('ipobject_id', $iNewBlockKey);
			$oNewDocLink->Set('document_id', $oDocToIPObject->Get('document_id'));
			$oNewDocLink->DBInsert();
		}

		// Link new block to same locations as original block
		$oBlockToLocationSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT lnkIPBlockToLocation AS lnk WHERE (lnk.ipblock_id) = $iBlockId"));
		while ($oBlockToLocation = $oBlockToLocationSet->Fetch()) {
			$oNewLocationLink = MetaModel::NewObject('lnkIPBlockToLocation');
			$oNewLocationLink->Set('ipblock_id', $iNewBlockKey);
			$oNewLocationLink->Set('location_id', $oBlockToLocation->Get('location_id'));
			$oNewLocationLink->DBInsert();
		}

		//	Attach child blocks to that new block
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.parent_id = '$iBlockId' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)"));
		while ($oSRange = $oSRangeSet->Fetch()) {
			$iCurrentFirstIp = TeemIpUtils::myip2long($oSRange->Get('firstip'));
			if ($iSplitIp <= $iCurrentFirstIp) {
				$oSRange->Set('parent_id', $iNewBlockKey);
				$oSRange->Set('write_reason', 'split');
				$oSRange->DBUpdate();
			}
		}

		//	Attach child subnets to that new block
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = '$iBlockId' AND s.org_id = $iOrgId"));
		while ($oSubnet = $oSubnetSet->Fetch()) {
			$iCurrentFirstIp = TeemIpUtils::myip2long($oSubnet->Get('ip'));
			if ($iSplitIp <= $iCurrentFirstIp) {
				$oSubnet->Set('block_id', $iNewBlockKey);
				$oSubnet->DBUpdate();
			}
		}

		// Display result as array
		$oSet = CMDBobjectSet::FromArray('IPv4Block', array($this, $oNewBlock));

		return ($oSet);
	}

	/**
	 * Check if block can be expanded
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
	public function DoCheckToExpand($aParam) {
		// Set working variables
		$iBlockId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$iParentId = $this->Get('parent_id');
		$sFirstIpCurrentBlock = $this->Get('firstip');
		$iFirstIpCurrentBlock = TeemIpUtils::myip2long($sFirstIpCurrentBlock);
		$sLastIpCurrentBlock = $this->Get('lastip');
		$iLastIpCurrentBlock = TeemIpUtils::myip2long($sLastIpCurrentBlock);
		$sNewFirstIp = $aParam['firstip'];
		$iNewFirstIp = TeemIpUtils::myip2long($sNewFirstIp);
		$sNewLastIp = $aParam['lastip'];
		$iNewLastIp = TeemIpUtils::myip2long($sNewLastIp);

		// Make sure new first IPs is smaller than new last IP
		if ($iNewFirstIp >= $iNewLastIp) {
			return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:Reverted'));
		}

		// Make sure new block contains old one
		if (($iFirstIpCurrentBlock < $iNewFirstIp) || ($iNewLastIp < $iLastIpCurrentBlock)) {
			return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:IPOutOfBlock'));
		}

		// Make sure block is changing
		if (($iFirstIpCurrentBlock == $iNewFirstIp) && ($iLastIpCurrentBlock == $iNewLastIp)) {
			return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:NoChange'));
		}

		// Check that new block has minimum size
		$iBlockMinSize = $this->GetMinBlockSize();
		if (($iNewLastIp - $iNewFirstIp + 1) < $iBlockMinSize) {
			return (Dict::Format('UI:IPManagement:Action:Expand:IPv4Block:SmallerThanMinSize', $iBlockMinSize));
		}

		// Check that block is CIDR aligned
		if (!$this->DoCheckCIDRAligned($iNewFirstIp, $iNewLastIp)) {
			return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:NotCIDRAligned'));
		}

		// Make sure that new blocks is still contained in its parent, if any
		if ($iParentId != 0) {
			$oParent = MetaModel::GetObject('IPv4Block', $iParentId, false /* MustBeFound */);
			if (!is_null($oParent)) {
				$iParentFirstIp = TeemIpUtils::myip2long($oParent->Get('firstip'));
				$iParentLastIp = TeemIpUtils::myip2long($oParent->Get('lastip'));
				if (($iNewFirstIp < $iParentFirstIp) || ($iParentLastIp < $iNewLastIp) || (($iNewFirstIp == $iParentFirstIp) && ($iParentLastIp == $iNewLastIp))) {
					return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:BlockBiggerThanParent'));
				}
			}
		}

		// Make sure that new borders don't include existing delegated block
		$oDelegatedSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.parent_org_id != 0 AND b.org_id = $iOrgId"));
		while ($oDelegatedSRange = $oDelegatedSRangeSet->Fetch()) {
			$iDelegatedSRangeFirstIp = TeemIpUtils::myip2long($oDelegatedSRange->Get('firstip'));
			$iDelegatedSRangeLastIp = TeemIpUtils::myip2long($oDelegatedSRange->Get('lastip'));
			if ((($iNewFirstIp <= $iDelegatedSRangeFirstIp) && ($iDelegatedSRangeFirstIp <= $iNewLastIp)) || (($iNewFirstIp <= $iDelegatedSRangeLastIp) && ($iDelegatedSRangeLastIp <= $iNewLastIp))) {
				return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:DelegatedBlockAccrossBorder'));
			}
		}

		// Make sure that no brother block sits accross new borders
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.parent_id = '$iParentId' AND b.id != '$iBlockId' AND b.org_id = $iOrgId"));
		while ($oSRange = $oSRangeSet->Fetch()) {
			$iCurrentFirstIp = TeemIpUtils::myip2long($oSRange->Get('firstip'));
			$iCurrentLastIp = TeemIpUtils::myip2long($oSRange->Get('lastip'));
			if ((($iCurrentFirstIp < $iNewFirstIp) && ($iNewFirstIp <= $iCurrentLastIp)) || (($iCurrentFirstIp <= $iNewLastIp) && ($iNewLastIp < $iCurrentLastIp))) {
				return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:BlockAccrossBorder'));
			}
		}

		// Make sure that no subnet attached to the same parent block sits accros new borders
		if ($iParentId != 0) {
			$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = '$iParentId' AND s.org_id = $iOrgId"));
			while ($oSubnet = $oSubnetSet->Fetch()) {
				$iCurrentFirstIp = TeemIpUtils::myip2long($oSubnet->Get('ip'));
				$iCurrentLastIp = TeemIpUtils::myip2long($oSubnet->Get('broadcastip'));
				if ((($iCurrentFirstIp < $iNewFirstIp) && ($iNewFirstIp <= $iCurrentLastIp)) || (($iCurrentFirstIp <= $iNewLastIp) && ($iNewLastIp < $iCurrentLastIp))) {
					return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:SubnetAccrossBorder'));
				}
			}
		}

		// Everything looks good
		return '';
	}

	/**
	 * Expand block
	 *
	 * @param $aParam
	 *
	 * @return $this
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function DoExpand($aParam) {
		// Set working variables
		$iBlockId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$iParentId = $this->Get('parent_id');
		$sNewFirstIp = $aParam['firstip'];
		$iNewFirstIp = TeemIpUtils::myip2long($sNewFirstIp);
		$sNewLastIp = $aParam['lastip'];
		$iNewLastIp = TeemIpUtils::myip2long($sNewLastIp);
		$sRequestor_id = $aParam['requestor_id'];

		// Update initial block and register it.
		if (!is_null($sRequestor_id)) {
			$this->Set('requestor_id', $sRequestor_id);
		}
		$this->Set('firstip', $sNewFirstIp);
		$this->Set('lastip', $sNewLastIp);
		$this->Set('write_reason', 'expand');
		$this->DBUpdate();

		// Absorb brother blocks
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.parent_id = '$iParentId' AND b.id != '$iBlockId' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)"));
		while ($oSRange = $oSRangeSet->Fetch()) {
			$iCurrentFirstIp = TeemIpUtils::myip2long($oSRange->Get('firstip'));
			$iCurrentLastIp = TeemIpUtils::myip2long($oSRange->Get('lastip'));
			if (($iNewFirstIp <= $iCurrentFirstIp) && ($iCurrentLastIp <= $iNewLastIp)) {
				$oSRange->Set('parent_id', $iBlockId);
				$oSRange->DBUpdate();
			}
		}

		//	Attach child subnets to parent block
		if ($iParentId != 0) {
			$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = '$iParentId' AND s.org_id = $iOrgId"));
			$oSubnetSet->Rewind();
			while ($oSubnet = $oSubnetSet->Fetch()) {
				$iCurrentFirstIp = TeemIpUtils::myip2long($oSubnet->Get('ip'));
				$iCurrentLastIp = TeemIpUtils::myip2long($oSubnet->Get('broadcastip'));
				if (($iNewFirstIp <= $iCurrentFirstIp) && ($iCurrentLastIp <= $iNewLastIp)) {
					$oSubnet->Set('block_id', $iBlockId);
					$oSubnet->DBUpdate();
				}
			}
		}

		return $this;
	}

	/**
	 * Check if block can be delegated
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
	public function DoCheckToDelegate($aParam) {
		// Set working variables
		$iOrgId = $this->Get('org_id');
		$iBlockId = $this->GetKey();
		$sFirstIpBlockToDel = $this->Get('firstip');
		$iFirstIpBlockToDel = TeemIpUtils::myip2long($sFirstIpBlockToDel);
		$sLastIpBlockToDel = $this->Get('lastip');
		$iLastIpBlockToDel = TeemIpUtils::myip2long($sLastIpBlockToDel);
		$iChildOrgId = $aParam['child_org_id'];

		// If block should be delegated to children only and if it's already delegated,
		// 	Make sure redelegation is done at the same level of organization.
		// Not possible anymore as already delegated blocks are not redelegated
		//if (($sDelegateToChildrenOnly == 'dtc_yes') && ($this->Get('parent_org_id') != 0))
		//{
		//	$oBlockOrg = MetaModel::GetObject('Organization', $iOrgId, true /* MustBeFound */);
		//	$oChildBlockOrg = MetaModel::GetObject('Organization', $iChildOrgId, true /* MustBeFound */);
		//	if ($oBlockOrg->Get('parent_id') != $oChildBlockOrg->Get('parent_id'))
		//	{
		//		return (Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:WrongLevelOfOrganization'));
		//	}
		//}

		//  Make sure that new child organization is different from the current one
		if ($iChildOrgId == $iOrgId) {
			return (Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:NoChangeOfOrganization'));
		}

		// Make sure block has no children blocks and no children subnets
		$oChildrenBlockSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.parent_id = $iBlockId"));
		if ($oChildrenBlockSet->Count() != 0) {
			return (Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocks'));
		}
		$oChildrenSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = $iBlockId"));
		if ($oChildrenSubnetSet->Count() != 0) {
			return (Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnets'));
		}

		// Make sure block is not contained in a block that belongs to the organization that the block will be delegated to
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.org_id = $iChildOrgId"));
		while ($oSRange = $oSRangeSet->Fetch()) {
			$iCurrentFirstIp = TeemIpUtils::myip2long($oSRange->Get('firstip'));
			$iCurrentLastIp = TeemIpUtils::myip2long($oSRange->Get('lastip'));
			if ((($iCurrentFirstIp <= $iFirstIpBlockToDel) && ($iFirstIpBlockToDel <= $iCurrentLastIp)) || (($iCurrentFirstIp <= $iLastIpBlockToDel) && ($iLastIpBlockToDel <= $iCurrentLastIp))) {
				return (Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfTargetOrg'));
			}
		}

		// Everything looks good
		return '';
	}

	/**
	 * Check if block can be undelegated
	 *
	 * @param $aParam
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public function DoCheckToUndelegate($aParam) {
		// Set working variables
		$iBlockId = $this->GetKey();

		// Make sure block is already delegated
		if ($this->Get('parent_org_id') == 0) {
			return (Dict::Format('UI:IPManagement:Action:Undelegate:IPBlock:IsNotDelegated'));
		}

		// Make sure block has no children blocks and no children subnets
		$oChildrenBlockSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.parent_id = $iBlockId"));
		if ($oChildrenBlockSet->Count() != 0) {
			return (Dict::Format('UI:IPManagement:Action:Undelegate:IPBlock:HasChildBlocks'));
		}
		$oChildrenSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = $iBlockId"));
		if ($oChildrenSubnetSet->Count() != 0) {
			return (Dict::Format('UI:IPManagement:Action:Undelegate:IPBlock:HasChildSubnets'));
		}

		// Everything looks good
		return '';
	}

	/**
	 * Display block in the node of a hierarchical tree
	 *
	 * @param \WebPage $oP
	 * @param bool $bWithIcon
	 * @param $iTreeOrgId
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public function DisplayAsLeaf(WebPage $oP, $bWithIcon, $iTreeOrgId) {
		$sHtml = '';
		if ($bWithIcon) {
			$sHtml = $this->GetIcon(true, true)."&nbsp;&nbsp;";
		}
		$sHtml .= $this->GetHyperlink();
		$oP->add($sHtml);
		$oP->add("&nbsp;&nbsp;&nbsp;[".$this->Get('firstip')." - ".$this->Get('lastip')."]");
		$oP->add("&nbsp;&nbsp;&nbsp;".$this->GetAsHTML('type'));

		// Display delegation information if required
		$iOrgId = $this->Get('org_id');
		$iParentOrgId = $this->Get('parent_org_id');
		if ($iParentOrgId != 0) {
			if ($iTreeOrgId == $iOrgId) {
				// Block is delegated from parent org
				$oP->add("&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:IPBlock:DelegatedFromParent', $this->GetAsHTML('parent_org_id')));
			} else {
				// Block is delegated to child org
				$oP->add("&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:IPBlock:DelegatedToChild', $this->GetAsHTML('org_id')));
			}
		}
	}

	/**
	 * Display main block attributes
	 *
	 * @param \WebPage $oP
	 * @param $sOperation
	 * @param $iFormId
	 * @param $sPrefix
	 * @param $aDefault
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 * @throws \Exception
	 */
	public function DisplayMainAttributesForOperation(WebPage $oP, $sOperation, $iFormId, $sPrefix, $aDefault) {
		$sLabelOfAction = Dict::S($this->MakeUIPath($sOperation).'Summary');
		$oP->SetCurrentTab($sLabelOfAction);

		$oP->add('<table style="vertical-align:top"><tr>');
		$oP->add('<td style="vertical-align:top">');
		$aDetails = array();

		// Parent ID
		$sDisplayValue = $this->GetAsHTML('parent_id');
		$aDetails[] = array(
			'label' => '<span title="'.MetaModel::GetDescription('IPv4Block', 'parent_id').'">'.MetaModel::GetLabel('IPv4Block', 'parent_id').'</span>',
			'value' => $sDisplayValue,
		);

		// First IP
		$sDisplayValue = $this->GetAsHTML('firstip');
		$aDetails[] = array(
			'label' => '<span title="'.MetaModel::GetDescription('IPv4Block', 'firstip').'">'.MetaModel::GetLabel('IPv4Block', 'firstip').'</span>',
			'value' => $sDisplayValue,
		);

		// Last IP
		$sDisplayValue = $this->GetAsHTML('lastip');
		$aDetails[] = array(
			'label' => '<span title="'.MetaModel::GetDescription('IPv4Block', 'lastip').'">'.MetaModel::GetLabel('IPv4Block', 'lastip').'</span>',
			'value' => $sDisplayValue,
		);

		// Requestor ID - Can be modified
		$sInputId = $iFormId.'_'.'requestor_id';
		$oAttDef = MetaModel::GetAttributeDef('IPObject', 'requestor_id');
		$sValue = (array_key_exists('requestor_id', $aDefault)) ? $aDefault['requestor_id'] : $this->Get('requestor_id');
		$iFlags = $this->GetAttributeFlags('requestor_id');
		$aArgs = array('this' => $this, 'formPrefix' => $sPrefix);
		$sHTMLValue = "<span id=\"field_{$sInputId}\">".$this->GetFormElementForField($oP, 'IPObject', 'requestor_id', $oAttDef, $sValue, '', $sInputId, '', $iFlags, $aArgs).'</span>';
		$aDetails[] = array(
			'label' => '<span title="'.$oAttDef->GetDescription().'">'.$oAttDef->GetLabel().'</span>',
			'value' => $sHTMLValue,
		);

		$oP->Details($aDetails);
		$oP->add('</td>');
		$oP->add('</tr></table>');
	}

	/**
	 * Display global block parameters
	 *
	 * @param \WebPage $oP
	 * @param $aDefault
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	public function DisplayGlobalAttributesForOperation(WebPage $oP, $aDefault) {
		$sLabelOfAction = Dict::Format('Class:IPBlock/Tab:globalparam');
		$aParameter = array('ipv4_block_min_size', 'ipv4_block_cidr_aligned');

		$oP->SetCurrentTab($sLabelOfAction);
		$oP->p(Dict::Format('UI:IPManagement:Action:Modify:GlobalConfig'));
		$oP->add('<table style="vertical-align:top"><tr>');
		$oP->add('<td style="vertical-align:top">');

		$this->DisplayGlobalParametersInLocalModifyForm($oP, $aParameter, $aDefault);

		$oP->add('</td>');
		$oP->add('</tr></table>');
	}

	/**
	 * Display fields required for action
	 *
	 * @param \WebPage $oP
	 * @param $sOperation
	 * @param $iFormId
	 * @param $aDefault
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 * @throws \Exception
	 */
	public function DisplayActionFieldsForOperation(WebPage $oP, $sOperation, $iFormId, $aDefault) {
		$oP->add("<table>");
		$oP->add('<tr><td style="vertical-align:top">');

		$aDetails = array();
		switch ($sOperation) {
			case 'findspace':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:FindSpace:IPv4Block:SizeOfSpace');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:FindSpace:IPv4Block:MaxNumberOfOffers');

				// Size of space
				// Compute max possible 'CIDR aligned' space to look for,
				$i = $this->GetMinTheoriticalBlockPrefix();
				if ($i < 16) {
					$iDefaultMask = 16;
				} else {
					if ($i < 24) {
						$iDefaultMask = 24;
					} else {
						$iDefaultMask = 31;
					}
				}
				// Display list of choices now
				$sAttCode = 'spacesize';
				$sInputId = $iFormId.'_'.$sAttCode;
				$sHTMLValue = "<select id=\"$sInputId\" name=\"$sAttCode\">\n";
				$InputSize = IPv4Subnet::MaskToSize(IPv4Subnet::BitToMask($i)); // Corrects pb with some 64bits OS - Centos...
				while ($i <= 32) {
					if ($i == $iDefaultMask) {
						$sHTMLValue .= "<option selected='' value=\"$InputSize\">".IPv4Subnet::BitToMask($i)." /$i</option>\n";
					} else {
						$sHTMLValue .= "<option value=\"$InputSize\">".IPv4Subnet::BitToMask($i)." /$i</option>\n";
					}
					$InputSize /= 2;
					$i++;
				}
				$sHTMLValue .= "</select>";
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);

				// Max number of offers
				$sAttCode = 'maxoffer';
				$sInputId = $iFormId.'_'.$sAttCode;
				$jDefault = (array_key_exists($sAttCode, $aDefault)) ? $aDefault[$sAttCode] : DEFAULT_MAX_FREE_SPACE_OFFERS;
				$sHTMLValue = "<input id=\"$sInputId\" type=\"text\" value=\"$jDefault\" name=\"$sAttCode\" maxlength=\"2\" size=\"2\">\n";
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
				break;

			case 'shrinkblock':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Shrink:IPv4Block:NewFirstIP');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:Shrink:IPv4Block:NewLastIP');

				// New first IP
				$sAttCode = 'firstip';
				$sInputId = $iFormId.'_'.$sAttCode;
				$oAttDef = MetaModel::GetAttributeDef('IPv4Block', $sAttCode);
				$sDefault = (array_key_exists($sAttCode, $aDefault)) ? $aDefault[$sAttCode] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv4Block', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);

				// New last IP
				$sAttCode = 'lastip';
				$sInputId = $iFormId.'_'.$sAttCode;
				$oAttDef = MetaModel::GetAttributeDef('IPv4Block', $sAttCode);
				$sDefault = (array_key_exists($sAttCode, $aDefault)) ? $aDefault[$sAttCode] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv4Block', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
				break;

			case 'splitblock':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Split:IPv4Block:At');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:Split:IPv4Block:NameNewBlock');

				// Split IP
				$sAttCode = 'ip';
				$sInputId = $iFormId.'_'.$sAttCode;
				$oAttDef = MetaModel::GetAttributeDef('IPv4Address', $sAttCode);
				$sDefault = (array_key_exists($sAttCode, $aDefault)) ? $aDefault[$sAttCode] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv4Address', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);

				// Name of new block
				$sInputId = $iFormId.'_'.'newname';
				$sDefault = (array_key_exists('newname', $aDefault)) ? $aDefault['newname'] : '';
				$sHTMLValue = "<input id=\"$sInputId\" value=\"$sDefault\" name=\"newname\">";
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
				break;

			case 'expandblock':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Expand:IPv4Block:NewFirstIP');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:Expand:IPv4Block:NewLastIP');

				// New first IP
				$sAttCode = 'firstip';
				$sInputId = $iFormId.'_'.$sAttCode;
				$oAttDef = MetaModel::GetAttributeDef('IPv4Block', $sAttCode);
				$sDefault = (array_key_exists($sAttCode, $aDefault)) ? $aDefault[$sAttCode] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv4Block', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);

				// New last IP
				$sAttCode = 'lastip';
				$sInputId = $iFormId.'_'.$sAttCode;
				$oAttDef = MetaModel::GetAttributeDef('IPv4Block', $sAttCode);
				$sDefault = (array_key_exists($sAttCode, $aDefault)) ? $aDefault[$sAttCode] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv4Block', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
				break;

			case 'delegate':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Delegate:IPv4Block:ChildBlock');

				$iOrgId = $this->Get('org_id');
				$sDelegateToChildrenOnly = IPConfig::GetFromGlobalIPConfig('delegate_to_children_only', $iOrgId);
				if ($sDelegateToChildrenOnly == 'dtc_yes') {
					// Block can only be delegated to children (or grand children) organization
					// Get block's children (list should not be empty at this stage)
					// Block is not already delegated (checked previously)so it can be delegated to child organization
					$oChildOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS child JOIN Organization AS parent ON child.parent_id BELOW parent.id WHERE parent.id = $iOrgId AND child.id != $iOrgId"));
				} else {
					// Block can be delegated to any organization
					$oChildOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o WHERE o.id != $iOrgId"));
				}

				// Display list of choices now
				$sAttCode = 'child_org_id';
				$sInputId = $iFormId.'_'.$sAttCode;
				$sHTMLValue = "<select id=\"$sInputId\" name=\"$sAttCode\">\n";
				while ($oChildOrg = $oChildOrgSet->Fetch()) {
					$iChildOrgKey = $oChildOrg->GetKey();
					$sChildOrgName = $oChildOrg->GetName();
					if ($iChildOrgKey == $iOrgId) {
						$sHTMLValue .= "<option selected='' value=\"$iChildOrgKey\">".$sChildOrgName."</option>\n";
					} else {
						$sHTMLValue .= "<option value=\"$iChildOrgKey\">".$sChildOrgName."</option>\n";
					}
				}
				$sHTMLValue .= "</select>";
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);
				break;

			default:
				break;
		}

		$oP->Details($aDetails);
		$oP->add('</td></tr>');

		// Cancell button
		$iBlockId = $this->GetKey();
		$oP->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"BackToDetails('IPv4Block', $iBlockId)\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;");

		// Apply button
		$oP->add("&nbsp;&nbsp<button type=\"submit\" class=\"action\"><span>".Dict::S('UI:Button:Apply')."</span></button></td></tr>");

		$oP->add("</table>");
	}

	/**
	 * Display attributes and action buttons associated operation
	 *
	 * @param \WebPage $oP
	 * @param $oClassForm
	 * @param $sOperation
	 * @param $aDefault
	 *
	 * @throws \ArchivedObjectException
	 * @throws \ConfigException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 * @throws \ReflectionException
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	protected function DisplayActionFieldsForOperationV3(WebPage $oP, $oClassForm, $sOperation, $aDefault) {
		$oMultiColumn = new MultiColumn();
		$oClassForm->AddSubBlock($oMultiColumn);
		$oToolbar = ToolbarUIBlockFactory::MakeForAction();
		$oClassForm->AddSubBlock($oToolbar);

		// First column = labels
		$oColumn1 = new Column();
		$oMultiColumn->AddColumn($oColumn1);
		// Second column = data
		$oColumn2 = new Column();
		$oMultiColumn->AddColumn($oColumn2);
		switch ($sOperation) {
			case 'findspace':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:FindSpace:IPv4Block:SizeOfSpace');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:FindSpace:IPv4Block:MaxNumberOfOffers');

				// Size of space
				// Compute max possible 'CIDR aligned' space to look for,
				$iPrefix = $this->GetMinTheoriticalBlockPrefix();
				if ($iPrefix < 16) {
					$iDefaultMask = 16;
				} else {
					if ($iPrefix < 24) {
						$iDefaultMask = 24;
					} else {
						$iDefaultMask = 31;
					}
				}
				$InputSize = IPv4Subnet::MaskToSize(IPv4Subnet::BitToMask($iPrefix)); // Corrects pb with some 64bits OS - Centos...
				// Display list of choices now
				$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph($sLabelOfAction1));
				$oColumn1->AddSubBlock(HtmlFactory::MakeRaw('<br>'));
				$oSelect = SelectUIBlockFactory::MakeForSelect('spacesize');
				$oColumn2->AddSubBlock($oSelect);
				while ($iPrefix <= 32) {
					$bSelected = ($iPrefix == $iDefaultMask) ? true : false;
					$oSelect->AddOption(SelectOptionUIBlockFactory::MakeForSelectOption($InputSize, IPv4Subnet::BitToMask($iPrefix).'/'.$iPrefix, $bSelected));
					$InputSize /= 2;
					$iPrefix++;
				}
				$oColumn2->AddSubBlock(HtmlFactory::MakeRaw('<br><br>'));

				// Max number of offers
				$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph($sLabelOfAction2));
				$oColumn1->AddSubBlock(HtmlFactory::MakeRaw('<br>'));
				$oInput = InputUIBlockFactory::MakeStandard('integer', 'maxoffer', DEFAULT_MAX_FREE_SPACE_OFFERS);
				$oColumn2->AddSubBlock($oInput);
				break;

			case
			'shrinkblock':
				break;

			case 'splitblock':
				break;

			case 'expandblock':
				break;

			case 'delegate':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Delegate:IPv4Block:ChildBlock');

				// Look for the organizations where the block can be delegated to
				$iOrgId = $this->Get('org_id');
				$sDelegateToChildrenOnly = IPConfig::GetFromGlobalIPConfig('delegate_to_children_only', $iOrgId);
				if ($sDelegateToChildrenOnly == 'dtc_yes') {
					// Block can only be delegated to children (grand children...) organizations
					// Get block's children (list should not be empty at this stage)
					// Block is not already delegated (checked previously) so it can be delegated to child organization
					$sOQL = "SELECT Organization AS child JOIN Organization AS parent ON child.parent_id BELOW parent.id WHERE parent.id = :org_id AND child.id != :org_id";
				} else {
					// Block can be delegated to any organization
					$sOQL = "SELECT Organization AS o WHERE o.id != :org_id";
				}
				$oChildOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('org_id' => $iOrgId));

				// Display list of choices now
				$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph($sLabelOfAction1));
				$oColumn1->AddSubBlock(HtmlFactory::MakeRaw('<br>'));
				$oSelect = SelectUIBlockFactory::MakeForSelect('child_org_id');
				$oColumn2->AddSubBlock($oSelect);
				while ($oChildOrg = $oChildOrgSet->Fetch()) {
					$iChildOrgKey = $oChildOrg->GetKey();
					$sChildOrgName = $oChildOrg->GetName();
					$bSelected = ($iChildOrgKey == $iOrgId) ? true : false;
					$oSelect->AddOption(SelectOptionUIBlockFactory::MakeForSelectOption($iChildOrgKey, $sChildOrgName, $bSelected));
				}
				break;

			default:
				break;
		};

		// Cancel button
		$oToolbar->AddSubBlock(ButtonUIBlockFactory::MakeForCancel(Dict::S('UI:Button:Cancel'), 'cancel', 'cancel')->SetOnClickJsCode("BackToDetails('IPv4Block', '{$this->GetKey()}', '', '{null}');"));

		// Apply button
		$oToolbar->AddSubBlock(ButtonUIBlockFactory::MakeForPrimaryAction(Dict::S('UI:Button:Apply'), null, null, true));
	}

	/**
	 * Get all space (used and non used within block)
	 *
	 * @param \WebPage $oP
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	protected
	function GetAllSpace(WebPage $oP) {

		// Get list of registered blocks and subnets in subnet range
		$aOccupiedSpace = $this->GetOccupiedSpace();

		$iObjFirstIp = TeemIpUtils::myip2long($this->Get('firstip'));
		$iObjLastIp = TeemIpUtils::myip2long($this->Get('lastip'));
		$iBlockSize = $this->GetSize();

		$sHtml = '';
		// Open table
		$sHtml .= '<table style="width:100%"><tr><td colspan="2">';
		$sHtml .= '<div style="vertical-align:top;" id="tree">';

		// Display Block ref
		$sHtml .= "<ul>\n";
		$sHtml .= "<li>".$this->GetHyperlink()."&nbsp;[".$this->GetAsHTML('firstip')." - ".$this->GetAsHTML('lastip')."]<ul>\n";

		// Display sub ranges as list
		$iSizeArray = sizeof($aOccupiedSpace);
		$j = 0;
		$iAnOccupiedIp = $iObjFirstIp;
		while ($iAnOccupiedIp <= $iObjLastIp) {
			$sAnIp = TeemIpUtils::mylong2ip($iAnOccupiedIp);
			if ($j < $iSizeArray) {
				if ($iAnOccupiedIp < $aOccupiedSpace[$j]['firstip']) {
					// Display free space
					$iLastOccupiedIp = $aOccupiedSpace[$j]['firstip'] - 1;
					$iNbIps = $iLastOccupiedIp - $iAnOccupiedIp + 1;
					$iFormatNbIps = number_format($iNbIps, 0, ',', ' ');
					$sHtml .= "<li>".Dict::Format('UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpace', $sAnIp, TeemIpUtils::mylong2ip($iLastOccupiedIp), $iFormatNbIps, ($iNbIps / $iBlockSize) * 100);
					$iAnOccupiedIp = $aOccupiedSpace[$j]['firstip'];
				} else {
					if ($iAnOccupiedIp == $aOccupiedSpace[$j]['firstip']) {
						// Display object attributes
						$sIcon = $aOccupiedSpace[$j]['obj']->GetIcon(true, true);
						$sHtml .= "<li>".$sIcon.$aOccupiedSpace[$j]['obj']->GetHyperlink();
						if ($aOccupiedSpace[$j]['type'] == 'IPv4Subnet') {
							$sHtml .= "&nbsp;".Dict::S('Class:IPv4Subnet/Attribute:mask/Value_cidr:'.$aOccupiedSpace[$j]['obj']->Get('mask'));
						} else {
							$sHtml .= "&nbsp;[".TeemIpUtils::mylong2ip($aOccupiedSpace[$j]['firstip'])." - ".TeemIpUtils::mylong2ip($aOccupiedSpace[$j]['lastip'])."]";

							// Display delegation information if required
							$iParentOrgId = $aOccupiedSpace[$j]['obj']->Get('parent_org_id');
							if ($iParentOrgId != 0) {
								$sHtml .= "&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:IPBlock:DelegatedToChild', $aOccupiedSpace[$j]['obj']->GetAsHTML('org_id'));
							}
						}
						$iAnOccupiedIp = $aOccupiedSpace[$j]['lastip'] + 1;
						$j++;
					}
				}
			} else {
				$iNbIps = $iObjLastIp - $iAnOccupiedIp + 1;
				$iFormatNbIps = number_format($iNbIps, 0, ',', ' ');
				$sHtml .= "<li>".Dict::Format('UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpace', $sAnIp, TeemIpUtils::mylong2ip($iObjLastIp), $iFormatNbIps, ($iNbIps / $iBlockSize) * 100);
				$iAnOccupiedIp = $iObjLastIp + 1;
			}
			$sHtml .= "</li>\n";
		}
		$sHtml .= "</ul></li></ul>\n";

		// Close table
		$sHtml .= '</div>';
		$sHtml .= '</td></tr></table>';
		$oP->add_ready_script("\$('#tree ul').treeview();\n");

		return $sHtml;
	}

	/**
	 * Displays the tabs listing the child blocks and the subnets belonging to a block
	 *
	 * @param \WebPage $oP
	 * @param bool $bEditMode
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public
	function DisplayBareRelations(WebPage $oP, $bEditMode = false) {
		// Execute parent function first
		parent::DisplayBareRelations($oP, $bEditMode);

		if ($bEditMode) {
			if ($this->IsNew()) {
				// Tab for Global Parameters at creation time only
				$oP->SetCurrentTab(Dict::Format('Class:IPBlock/Tab:globalparam'));
				$oP->p(Dict::Format('UI:IPManagement:Action:Modify:GlobalConfig'));
				$oP->add('<table style="vertical-align:top"><tr>');
				$oP->add('<td style="vertical-align:top">');

				$aParameter = array('ipv4_block_min_size', 'ipv4_block_cidr_aligned');
				$this->DisplayGlobalParametersInLocalModifyForm($oP, $aParameter);

				$oP->add('</td>');
				$oP->add('</tr></table>');
			}
		} else {
			$iBlockId = $this->GetKey();
			$iOrgId = $this->Get('org_id');

			$aExtraParams = array();
			$aExtraParams['menu'] = false;

			// Tab for subnets
			$oSubnetSearch = DBObjectSearch::FromOQL("SELECT IPv4Subnet AS subnet WHERE subnet.block_id = $iBlockId AND subnet.org_id = $iOrgId");
			$oSubnetSet = new CMDBObjectSet($oSubnetSearch);
			$iSubnets = $oSubnetSet->Count();
			if ($iSubnets > 0) {
				$oP->SetCurrentTab(Dict::Format('Class:IPBlock/Tab:subnet').' ('.$iSubnets.')');
				$oP->p(MetaModel::GetClassIcon('IPv4Subnet').'&nbsp;'.Dict::Format('Class:IPBlock/Tab:subnet+'));
				$oP->p($this->GetAsHTML('subnet_occupancy').Dict::Format('Class:IPBlock/Tab:subnet-count-percent'));
				$oBlock = new DisplayBlock($oSubnetSearch, 'list');
				$oBlock->Display($oP, 'child_subnets', $aExtraParams);
			} else {
				$oP->SetCurrentTab(Dict::S('Class:IPBlock/Tab:subnet'));
				$oP->p(MetaModel::GetClassIcon('IPv4Subnet').'&nbsp;'.Dict::S('Class:IPBlock/Tab:subnet+'));
				$oP->p(Dict::S('UI:NoObjectToDisplay'));
			}
		}
	}

	/**
	 * Compute attributes before writing object
	 *
	 * @noinspection PhpUnhandledExceptionInspection
	 */
	public
	function ComputeValues() {
		if ($this->IsNew()) {
			// At creation, compute parent_id only in the case where no delegation is done.
			// Note that delegation is implicit when origin is LIR (origin of parent block is RIR)
			$iParentOrgId = $this->Get('parent_org_id');
			$sOrigin = $this->Get('origin');
			if (($iParentOrgId == 0) || ($sOrigin != 'lir')) {
				$iOrgId = $this->Get('org_id');
				$sFirstIp = $this->Get('firstip');
				$sLastIp = $this->Get('lastip');

				// Look for all blocks containing the new block
				// Pick the smallest one
				$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE INET_ATON(b.firstip) <= INET_ATON('$sFirstIp') AND INET_ATON('$sLastIp') <= INET_ATON(b.lastip) AND b.org_id = $iOrgId"));
				$iMinSize = 0;
				$iNewParentId = 0;
				while ($oSRange = $oSRangeSet->Fetch()) {
					$iSRangeSize = $oSRange->GetSize();
					if (($iMinSize == 0) || ($iSRangeSize < $iMinSize)) {
						$iMinSize = $iSRangeSize;
						$iNewParentId = $oSRange->GetKey();
					}
				}
				$this->Set('parent_id', $iNewParentId);
			}
		}
	}

	/**
	 * Check validity of new block attributes before creation
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public
	function DoCheckToWrite() {
		// Run standard iTop checks first
		parent::DoCheckToWrite();

		$iOrgId = $this->Get('org_id');
		if ($this->IsNew()) {
			$iKey = -1;
		} else {
			$iKey = $this->GetKey();
		}
		$sName = $this->Get('name');
		$iFirstIp = TeemIpUtils::myip2long($this->Get('firstip'));
		$iLastIp = TeemIpUtils::myip2long($this->Get('lastip'));

		// Check name doesn't already exist
		$sOQL = "SELECT IPv4Block AS b WHERE b.name = :name AND (b.org_id = :org_id OR b.parent_org_id = :org_id) AND b.id != :id";
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array(
			'name' => $sName,
			'id' => $iKey,
			'org_id' => $iOrgId,
		));
		if ($oSRangeSet->CountExceeds(0)) {
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:NameExist');

			return;
		}

		// All modifications related to first and last IPs are done through special actions (shrink, split, expand)
		// As a consequence:
		//	Code of shrink, split, expand functions must check coherency of these IPs
		//	DoCheckToWrite only checks their coherency at creation.

		// If check is performed because of split, skip checks
		//		if ($this->m_WriteReason == ACTION_SPLIT)
		if ($this->Get('write_reason') == 'split') {
			return;
		}

		// In case of modification, no specific check is done as changes do concern minor points and not first or last IP of block.
		if ($this->IsNew()) {
			// Check that 1st IP is smaller than last one
			if ($iFirstIp > $iLastIp) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:Reverted');

				return;
			}

			// Make sure size of block is bigger than absolute minimum size allowed (constant)
			// Default value may be overwritten but not under absolute minimum value.
			$iBlockMinSize = $this->GetMinBlockSize();
			$Size = $iLastIp - $iFirstIp + 1;
			if ($Size < $iBlockMinSize) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:SmallerThanMinSize', $iBlockMinSize, $this->Get('org_name'));

				return;
			}

			// If required by global parameters, check if block needs to be CIDR aligned and check last IP if needed.
			if (!$this->DoCheckCIDRAligned()) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:NotCIDRAligned');

				return;
			}

			// Make sure range is fully and strictly contained in parent range requested, if any
			//		If no parent is specified, then parent is entire IPv4 space by default and tested condition is true.
			$iParentId = $this->Get('parent_id');
			if ($iParentId != 0) {
				$oParent = MetaModel::GetObject('IPv4Block', $iParentId, false /* MustBeFound */);
				if (!is_null($oParent)) {
					$iParentFirstIp = TeemIpUtils::myip2long($oParent->Get('firstip'));
					$iParentLastIp = TeemIpUtils::myip2long($oParent->Get('lastip'));
					if (($iFirstIp < $iParentFirstIp) || ($iParentLastIp < $iLastIp) || (($iFirstIp == $iParentFirstIp) && ($iParentLastIp == $iLastIp))) {
						$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:NotInParent');

						return;
					}
				}
			}

			// Make sure range doesn't collide with another range attached to the same parent.
			//		If no parent is specified (null), then check is done with all such blocks with null parent specified.
			//		It is done on blocks belonging to the same parent otherwise
			$sOQL = "SELECT IPv4Block AS b WHERE b.parent_id = :parent_id AND (b.org_id = :org_id OR b.parent_org_id = :org_id) AND b.id != :id";
			$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array(
				'parent_id' => $iParentId,
				'id' => $iKey,
				'org_id' => $iOrgId,
			));
			if ($iParentId == 0) {
				$sOQL = "SELECT IPv4Block AS b WHERE b.parent_org_id != 0 AND b.org_id = :org_id AND b.id != :id";
				$oSRangeSet2 = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('id' => $iKey, 'org_id' => $iOrgId));
				$oSRangeSet->Append($oSRangeSet2);
			}
			while ($oSRange = $oSRangeSet->Fetch()) {
				$iCurrentFirstIp = TeemIpUtils::myip2long($oSRange->Get('firstip'));
				$iCurrentLastIp = TeemIpUtils::myip2long($oSRange->Get('lastip'));

				// Does the range already exist?
				if (($iCurrentFirstIp == $iFirstIp) && ($iCurrentLastIp == $iLastIp)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:Collision0');

					return;
				}
				// Is new first Ip part of an existing range?
				if (($iCurrentFirstIp < $iFirstIp) && ($iFirstIp <= $iCurrentLastIp)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:Collision1');

					return;
				}
				// Is new last Ip part of an existing range?
				if (($iCurrentFirstIp <= $iLastIp) && ($iLastIp < $iCurrentLastIp)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:Collision2');

					return;
				}
				// If new subnet range is including existing ones, the included ranges will automatically be attached
				//	 to the one newly created because of hierarchical structure of blocks (see AfterInsert).
			}

			// Make sure block doesn't contain any block delegated from another organization
			$sOQL = "SELECT IPv4Block AS b WHERE :firstip <= INET_ATON(b.firstip) AND INET_ATON(b.lastip) <= :lastip AND b.org_id = :org_id AND b.parent_org_id > 0";
			$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array(
				'firstip' => $iFirstIp,
				'lastip' => $iLastIp,
				'org_id' => $iOrgId,
			));
			if ($oSRangeSet->CountExceeds(0)) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:ConflictWithDelegatedBlockFromOtherOrg');

				return;
			}

			// If block is delegated straight away
			$iParentOrgId = $this->Get('parent_org_id');
			if ($iParentOrgId != 0) {
				// Make sure block has no parent in current organization - must be at the top of the tree
				$sOQL = "SELECT IPv4Block AS b WHERE INET_ATON(b.firstip) <= :firstip AND :lastip <= INET_ATON(b.lastip) AND b.org_id = :org_id";
				$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array(
					'firstip' => $iFirstIp,
					'lastip' => $iLastIp,
					'org_id' => $iOrgId,
				));
				if ($oSRangeSet->CountExceeds(0)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfTargetOrg');

					return;
				}

				// Make sure block has no children block that are delegated blocks
				// 	This is not possible are delegated blocks may only provide from parent organization and that blocks with children cannot be delegated

				// Make sure that there is no collision with brother blocks from parent organization
				$sOQL = "SELECT IPv4Block AS b WHERE b.parent_id = :parent_id AND b.org_id = :parent_org_id";
				$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array(
					'parent_id' => $iParentId,
					'parent_org_id' => $iParentOrgId,
				));
				while ($oSRange = $oSRangeSet->Fetch()) {
					$iCurrentFirstIp = TeemIpUtils::myip2long($oSRange->Get('firstip'));
					$iCurrentLastIp = TeemIpUtils::myip2long($oSRange->Get('lastip'));
					if ((($iCurrentFirstIp < $iFirstIp) && ($iFirstIp <= $iCurrentLastIp)) || (($iCurrentFirstIp <= $iLastIp) && ($iLastIp < $iCurrentLastIp))) {
						$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfParentOrg');

						return;
					}
				}

				// Make sure that block doesn't have any child block nor child subnet in parent organization
				$sOQL = "SELECT IPv4Block AS b WHERE :firstip <= INET_ATON(b.firstip) AND INET_ATON(b.lastip) <= :lastip AND b.org_id = :parent_org_id";
				$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array(
					'firstip' => $iFirstIp,
					'lastip' => $iLastIp,
					'parent_org_id' => $iParentOrgId,
				));
				if ($oSRangeSet->CountExceeds(0)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocksInParent');

					return;
				}
				$sOQL = "SELECT IPv4Subnet AS s WHERE :firstip <= INET_ATON(s.ip) AND INET_ATON(s.broadcastip) <= :lastip AND s.org_id = :parent_org_id";
				$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array(
					'firstip' => $iFirstIp,
					'lastip' => $iLastIp,
					'parent_org_id' => $iParentOrgId,
				));
				if ($oSRangeSet->CountExceeds(0)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnetsInParent');

					return;
				}
			}
		}
	}

	/**
	 * Perform specific tasks related to block creation
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public
	function AfterInsert() {
		parent::AfterInsert();

		$iOrgId = $this->Get('org_id');
		$iKey = $this->GetKey();
		$iParentOrgId = $this->Get('parent_org_id');
		$iParentId = $this->Get('parent_id');
		$sFirstIp = $this->Get('firstip');
		$sLastIp = $this->Get('lastip');

		// Look for all blocks attached to parent of block being created and contained within new block
		// Attach them to new block
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.parent_id = '$iParentId' AND INET_ATON('$sFirstIp') <= INET_ATON(b.firstip) AND INET_ATON(b.lastip) <= INET_ATON('$sLastIp') AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId) AND b.id != $iKey"));
		while ($oSRange = $oSRangeSet->Fetch()) {
			$oSRange->Set('parent_id', $iKey);
			$oSRange->DBUpdate();
		}

		// If block is delegated, look for blocks from $iOrgId at the top of the tree that are contained within new block
		// Attach them to new block
		if ($iParentOrgId != 0) {
			$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE b.parent_id = 0 AND INET_ATON('$sFirstIp') <= INET_ATON(b.firstip) AND INET_ATON(b.lastip) <= INET_ATON('$sLastIp') AND b.org_id = $iOrgId"));
			while ($oSRange = $oSRangeSet->Fetch()) {
				$oSRange->Set('parent_id', $iKey);
				$oSRange->DBUpdate();
			}
		}

		// If block is not at the top (all subnets are attached to a block),
		//	Look for all subnets attached to parent block contained within new block
		//	Attach them to new block
		if ($iParentId != 0) {
			$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = '$iParentId' AND INET_ATON('$sFirstIp') <= INET_ATON(s.ip) AND INET_ATON(s.broadcastip)<= INET_ATON('$sLastIp') AND s.org_id = $iOrgId"));
			while ($oSubnet = $oSubnetSet->Fetch()) {
				$oSubnet->Set('block_id', $iKey);
				$oSubnet->DBUpdate();
			}
		}

		// If block has a LIR as origin at creation, we create a subnet of the same size in the mean time.
		if (($this->Get('origin') == 'lir') && ($iParentOrgId != $iOrgId)) {
			$iSize = $this->GetSize();
			if ($iSize <= IPV4_SUBNET_MAX_SIZE) {
				$aValues = array(
					'org_id' => $iOrgId,
					'requestor_id' => $this->Get('requestor_id'),
					'block_id' => $iKey,
					'ip' => $sFirstIp,
					'mask' => IPv4Subnet::SizeToMask($iSize),
					'allocation_date' => time(),
				);
				$oSubnet = MetaModel::NewObject('IPv4Subnet', $aValues);
				$oSubnet->DBInsert();
			}
		}
	}

	/**
	 * Perform specific tasks related to block modification
	 *
	 * @throws \ApplicationException
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public
	function AfterUpdate() {
		if ($this->Get('write_reason') != 'split') {
			$iOrgId = $this->Get('org_id');
			$iKey = $this->GetKey();
			$iParentId = $this->Get('parent_id');
			$iFirstIp = ip2long($this->Get('firstip'));
			$iLastIp = TeemIpUtils::myip2long($this->Get('lastip'));

			// Look for all subnets attached to block that may have fallen out of block
			//	Attach them to parent block
			//	Note: previous check have made sure a parent block exists
			$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = $iKey AND s.org_id = $iOrgId"));
			while ($oSubnet = $oSubnetSet->Fetch()) {
				$iCurrentFirstIp = ip2long($oSubnet->Get('ip'));
				$iCurrentLastIp = TeemIpUtils::myip2long($oSubnet->Get('broadcastip'));
				if (($iCurrentLastIp < $iFirstIp) || ($iLastIp < $iCurrentFirstIp)) {
					if ($iParentId == 0) {
						throw new ApplicationException(Dict::Format('UI:IPManagement:Action:Modify:IPv4Block:ParentIdNull', $iKey));
					}
					$oSubnet->Set('block_id', $iParentId);
					$oSubnet->DBUpdate();
				}
			}
		}
		$this->Set('write_reason', 'none');

		parent::AfterUpdate();
	}

	/**
	 * Change default flag of attribute.
	 *
	 * @param string $sAttCode
	 * @param array $aReasons
	 * @param string $sTargetState
	 *
	 * @return int
	 * @throws \CoreException
	 */
	public
	function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '') {
		$aReadOnlyAttributes = array('firstip', 'lastip');
		if (in_array($sAttCode, $aReadOnlyAttributes)) {
			return OPT_ATT_READONLY;
		}

		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}

}
