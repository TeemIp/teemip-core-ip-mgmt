<?php
// Copyright (C) 2020 TeemIp
//
//   This file is part of TeemIp.
//
//   TeemIp is free software; you can redistribute it and/or modify	
//   it under the terms of the GNU Affero General Public License as published by
//   the Free Software Foundation, either version 3 of the License, or
//   (at your option) any later version.
//
//   TeemIp is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU Affero General Public License for more details.
//
//   You should have received a copy of the GNU Affero General Public License
//   along with TeemIp. If not, see <http://www.gnu.org/licenses/>

/**
 * @copyright   Copyright (C) 2020 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

/**
 * Class _IPv6Block
 */
class _IPv6Block extends IPBlock
{
	/**
	 * Returns icon to ne displayed
	 *
	 * @param bool $bImgTag
	 * @param bool $bXsIcon
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function GetIcon($bImgTag = true, $bXsIcon = false)
	{ 
		if ($bXsIcon)
		{
			$sIcon = utils::GetAbsoluteUrlModulesRoot().'teemip-ipv6-mgmt/images/ipv6block-xs.png';
			return ("<img src=\"$sIcon\" style=\"vertical-align:middle;\" alt=\"\"/>");
		}
		return parent::GetIcon($bImgTag);
	}

	/**
	 * Returns name to be displayed within trees
	 *
	 * @return mixed
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function GetNameForTree()
	{
		return $this->Get('firstip')->GetAsCannonical();
	}
	
	/**
	 * Returns size of block
	 *
	 * @return int
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function GetSize()
	{
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');
		return $oFirstIp->GetSizeInterval($oLastIp);
	}
	
	/**
	 * Returns smaller block prefix, CIDR aligned, contained in block
	 *
	 * @return int
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function GetMinTheoriticalBlockPrefix()
	{
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');
		$oMask = new ormIPv6(IPV6_BLOCK_MIN_MASK);
		$iPrefix = IPV6_BLOCK_MIN_PREFIX;
		while ($iPrefix >= IPV6_BLOCK_MAX_PREFIX)
		{
			$oNotMask = $oMask->BitwiseNot();
			$oIp = $oFirstIp->Add($oNotMask); // This is similar to a BitWiseOr($oNotMask) with a propagation of carry
			if ($oIp->IsBiggerStrict($oLastIp))
			{
				$iPrefix++;
				return $iPrefix;
			}
			$oMask = $oMask->LeftShift();
			$iPrefix--;
		}
		return $iPrefix;
	}

	/**
	 * Returns minimum block prefix required
	 *
	 * @return bool|int|mixed|\ormLinkSet|string|string[]|null
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	function GetMinBlockPrefix()
	{
		$iBlockMinPrefix = utils::ReadPostedParam('attr_ipv6_block_min_prefix', '');
		if (empty($iBlockMinPrefix))
		{
			$iOrgId = $this->Get('org_id');
			$iBlockMinPrefix = IPConfig::GetFromGlobalIPConfig('ipv6_block_min_prefix', $iOrgId);
		}
		else
		{
			// Default value may be overwritten but not under absolute minimum value.
			// Warning: Prefix /53 prefix < /64 prefix
			if ($iBlockMinPrefix > IPV6_BLOCK_MIN_PREFIX)
			{
				$iBlockMinPrefix = IPV6_BLOCK_MIN_PREFIX;
			}
		}
		return $iBlockMinPrefix;
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
	public function GetOccupancy($sObject)
	{
		$iOrgId = $this->Get('org_id');
		$iKey = $this->GetKey();
		$iBlockSize = $this->GetSize();
		
		switch ($sObject)
		{
			case 'IPBlock':
			case 'IPv6Block':
				// Look for all child blocks
				$iChildBlockSize = 0;                                     
				$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = $iKey AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)"));
				while ($oSRange = $oSRangeSet->Fetch())
				{
					$iChildBlockSize += $oSRange->GetSize();
				}
				return ($iChildBlockSize / $iBlockSize)*100;
			
			case 'IPSubnet':
			case 'IPv6Subnet':
				// Look for all child subnets
				$iSubnetSize = 0;
				$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = '$iKey' AND s.org_id = $iOrgId"));
				while ($oSubnet = $oSubnetSet->Fetch())
				{
					$iSubnetSize += $oSubnet->GetSize();
				}
				return ($iSubnetSize / $iBlockSize)*100;
				
			default:
				return 0;
		}
	}	
	
	/**
	 * Find space within the block to create child block or subnet
	 *
	 * @param $iPrefix
	 * @param $iMaxOffer
	 *
	 * @return array
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function GetFreeSpace($iPrefix, $iMaxOffer)
	{
		$iOrgId = $this->Get('org_id');
		$iKey = ($this->GetKey() > 0) ? $this->GetKey() : 0;
		$aFreeSpace = array();
		
		// Get list of registered blocks and subnets in subnet range
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');
		if ($iKey == 0)
		{
			// Search at root space, outside any block - delegated or not
			$sOQL = "SELECT IPv6Block AS b WHERE b.org_id = :org_id AND b.parent_id = 0 UNION SELECT IPv6Block AS b WHERE b.parent_org_id = :org_id AND b.parent_id = 0";
		}
		else
		{
			$sOQL = "SELECT IPv6Block AS b WHERE b.org_id = :org_id AND b.parent_id = :id";
		}
		$oChildBlockSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('id' => $iKey, 'org_id' => $iOrgId));
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = $iKey AND s.org_id = $iOrgId"));
		
		$aList = array();
		$i = 0;
		while ($oChildBlock = $oChildBlockSet->Fetch())
		{
			$aList[$i] = array();
			$aList[$i]['firstip'] = $oChildBlock->Get('firstip')->GetAsCannonical();
			$aList[$i]['lastip'] = $oChildBlock->Get('lastip')->GetAsCannonical();
			$i++;
		}
		while ($oSubnet = $oSubnetSet->Fetch())
		{
			$aList[$i] = array();
			$aList[$i]['firstip'] = $oSubnet->Get('ip')->GetAsCannonical();
			$aList[$i]['lastip'] = $oSubnet->Get('lastip')->GetAsCannonical();
			$i++;
		}
		// Sort $aList by 'firstip' and create array of free ranges
		$aFreeList = array();
		if (!empty($aList))
		{
			foreach ($aList as $key => $row)
			{
				$aFirstIp[$key] = $row['firstip'];
			}
			array_multisort($aFirstIp, SORT_ASC, $aList);
			
			$iSizeArray = $i;
			$sAnIp = $oFirstIp->ToString();
			$oAnIp = new ormIPv6($sAnIp);
			$i = 0;
			$j = 0;
			while ($i < $iSizeArray)
			{
				while (($i < $iSizeArray) && ($sAnIp == $aList[$i]['firstip']))
				{
					$oAnIp = new ormIPv6($aList[$i]['lastip']);
					$oAnIp = $oAnIp->GetNextIp();
					$sAnIp = $oAnIp->GetAsCannonical();
					$i++; 
				}
				if ($oAnIp->IsSmallerStrict($oLastIp))
				{
					$aFreeList[$j] = array();
					$aFreeList[$j]['firstip'] = $sAnIp;
					if ($i < $iSizeArray)
					{
						$sAnIp = $aList[$i]['firstip'];
						$oAnIp = new ormIPv6($sAnIp);
						$oPreviousIp = $oAnIp->GetPreviousIp();
						$aFreeList[$j]['lastip'] = $oPreviousIp->GetAsCannonical();
					}
					else
					{
						$aFreeList[$j]['lastip'] = $oLastIp->GetAsCannonical();
					}
					$j++;
				}
			}
			$iSizeFreeArray = $j;
		}
		else
		{
			$iSizeFreeArray = 1;
			$aFreeList[0] = array();
			$aFreeList[0]['firstip'] = $oFirstIp->GetAsCannonical();
			$aFreeList[0]['lastip'] = $oLastIp->GetAsCannonical();
		}

		// Store possible choices in array
		if ($iSizeFreeArray != 0)
		{
			$j = 0;
			$n = 0;
			$bEndSpaceReached = false;
			$oMask = new ormIPv6('FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF');
			for ($i = 0; $i < (IPV6_MAX_BIT - $iPrefix); $i++)
			{
				$oMask = $oMask->LeftShift();
			}
			$oNotMask = $oMask->BitwiseNot();
			do
			{
				$sAnIp = $aFreeList[$j]['firstip'];
				$oAnIp = new ormIPv6($sAnIp);
				// Align $oAnIp to mask 
				$oIp = $oAnIp->BitWiseAnd($oMask);
				if (! $oIp->IsEqual($oAnIp))
				{
					$oAnIp = $oIp->Add($oNotMask);
					$oAnIp = $oAnIp->GetNextIp();
					if ($oAnIp->GetAsCompressed() == '::')
					{
						$bEndSpaceReached = true;
					}
				}
				$sLastFreeIp = $aFreeList[$j]['lastip'];
				$oLastFreeIp = new ormIPv6($sLastFreeIp);
				$oLastIp = $oAnIp->Add($oNotMask);
				while ((!$bEndSpaceReached) && $oLastIp->IsSmallerOrEqual($oLastFreeIp) && ($n < $iMaxOffer))
				{
					$aFreeSpace[$n] = array();
					$aFreeSpace[$n]['firstip'] = $oAnIp;
					$aFreeSpace[$n]['lastip'] = $oLastIp; 
					$aFreeSpace[$n]['mask'] = $oMask;
					$n++;
					$oAnIp = $oLastIp->GetNextIp();
					$oLastIp = $oAnIp->Add($oNotMask);
				}
			}
			while ((!$bEndSpaceReached) && (++$j < $iSizeFreeArray) && ($n < $iMaxOffer));
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
	public function GetOccupiedSpace()
	{
		// Get list of registered blocks and subnets in subnet range
		$iKey = ( $this->GetKey() > 0) ? $this->GetKey() : 0;
		$iOrgId = $this->Get('org_id');

		if ($iKey == 0)
		{
			// Search at root space, outside any block - delegated or not
			$sOQL = "SELECT IPv6Block AS b WHERE b.org_id = :org_id AND b.parent_id = 0 UNION SELECT IPv6Block AS b WHERE b.parent_org_id = :org_id AND b.parent_id = 0";
		}
		else
		{
			$sOQL = "SELECT IPv6Block AS b WHERE b.org_id = :org_id AND b.parent_id = :id";
		}
		$oChildBlockSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('id' => $iKey, 'org_id' => $iOrgId));
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = $iKey AND s.org_id = $iOrgId"));

		$aList = array();
		$i = 0;
		while ($oChildBlock = $oChildBlockSet->Fetch())
		{
			$aList[$i] = array();
			$aList[$i]['type'] = 'IPv6Block';
			$aList[$i]['sfirstip'] = $oChildBlock->Get('firstip')->GetAsCannonical();
			$aList[$i]['firstip'] = $oChildBlock->Get('firstip');
			$aList[$i]['lastip'] = $oChildBlock->Get('lastip');
			$aList[$i]['obj'] = $oChildBlock;
			$i++;
		}
		while ($oSubnet = $oSubnetSet->Fetch())
		{
			$aList[$i] = array();
			$aList[$i]['type'] = 'IPv6Subnet';
			$aList[$i]['sfirstip'] = $oSubnet->Get('ip')->GetAsCannonical();
			$aList[$i]['firstip'] = $oSubnet->Get('ip');
			$aList[$i]['lastip'] = $oSubnet->Get('lastip');
			$aList[$i]['obj'] = $oSubnet;
			$i++;
		}
		// Sort $aList by 'firstip'
		if (!empty($aList))
		{
			foreach ($aList as $key => $row)
			{
				$aFirstIp[$key]	= $row['firstip'];
			}
			array_multisort($aFirstIp, SORT_ASC, $aList);
		}

		return $aList;
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
	public static function GetSmallerBlockContainingIp($iOrgId, $sIp)
	{
		$oIp = new ormIPv6($sIp);
		$oBlockSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.org_id = :org_id"), array(), array('org_id' => $iOrgId));
		$iMinBlockId = 0;
		while ($oBlock = $oBlockSet->Fetch())
		{
			$oCurrentFirstIp = $oBlock->Get('firstip');
			$oCurrentLastIp = $oBlock->Get('lastip');
			if (($oCurrentFirstIp->IsSmallerStrict($oIp) && $oIp->IsSmallerOrEqual($oCurrentLastIp)) || ($oCurrentFirstIp->IsSmallerOrEqual($oIp) && $oIp->IsSmallerStrict($oCurrentLastIp)))
			{
				if ($iMinBlockId == 0)
				{
					$iMinBlockId = $oBlock->GetKey();
					$iMinBlockPrefix = $oBlock->GetMinTheoriticalBlockPrefix();
				}
				else
				{
					$iCurrentBlockPrefix = $oBlock->GetMinTheoriticalBlockPrefix();
				    if ($iMinBlockPrefix < $iCurrentBlockPrefix)
				    {
					    $iMinBlockId = $oBlock->GetKey();
					    $iMinBlockPrefix = $iCurrentBlockPrefix;
				    }
				}
			}
		}
		return $iMinBlockId;
	}

	/**
	 * Returns higher block prefix, CIDR aligned, contained in block
	 *
	 * @return bool
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function DoCheckMustBeCIDRAligned()
	{
		$sBlockCidrAligned = utils::ReadPostedParam('attr_ipv6_block_cidr_aligned', '');
		if (empty($sBlockCidrAligned))
		{
			$iOrgId = $this->Get('org_id');
			$sBlockCidrAligned = IPConfig::GetFromGlobalIPConfig('ipv6_block_cidr_aligned', $iOrgId);
		}
		if ($sBlockCidrAligned == 'bca_yes')
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Check if block is CIDR aligned
	 *
	 * @param null $oNewFirstIp
	 * @param null $oNewLastIp
	 *
	 * @return bool
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function DoCheckCIDRAligned($oNewFirstIp = null, $oNewLastIp = null)
	{
		$oFirstIp = ($oNewFirstIp == null) ? $this->Get('firstip') : $oNewFirstIp;
		$oLastIp = ($oNewLastIp == null) ? $this->Get('lastip') : $oNewLastIp;	 			
		$oMask128 = new ormIPv6('FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF');
		$oMask = $oMask128;

		// Check with all possible masks that LastIp & Mask == FirstIP
		for ($i = 1; $i <= IPV6_MAX_BIT; $i++)
		{
			$oAndIP = $oLastIp->BitwiseAnd($oMask);
			if ($oFirstIp->IsEqual($oAndIP))
			{
				// If one matches, check that block size refers to CIDR size 
				$oNotMask = $oMask->BitwiseNot();
				$oLastCidrIp = $oFirstIp->BitwiseOr($oNotMask);
				if ($oLastCidrIp->IsEqual($oLastIp))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			$oMask = $oMask->LeftShift();
		}
		return false;
	}

	/**
	 * Compare size of block with given interval
	 *
	 * @param null $oFirstIp
	 * @param null $oLastIp
	 *
	 * @return bool
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function DoCheckHasMinBlockSize($oFirstIp = null, $oLastIp = null)
	{
		if (($oFirstIp == null) || ($oLastIp == null))
		{
			return false;
		}
		$iBlockMinPrefix = $this->GetMinBlockPrefix();
		$oMask = new ormIPv6('FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF');
		for ($i = 1; $i <= (IPV6_MAX_BIT - $iBlockMinPrefix); $i++)
		{
			$oMask = $oMask->LeftShift();
		}
		$oMask = $oMask->BitwiseNot();
		$oIp = $oFirstIp->Add($oMask); // This is similar to a BitWiseOr($oMask) with a propagation of carry
		if ($oIp->IsSmallerOrEqual($oLastIp))
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Get parameters used for operation
	 *
	 * @param $sOperation
	 *
	 * @return array
	 */
	function GetPostedParam($sOperation)
	{
		$aParam = array();
		switch ($sOperation)
		{
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
				$aParam['ipv6_block_min_prefix'] = utils::ReadPostedParam('attr_ipv6_block_min_prefix', IPV6_BLOCK_MIN_PREFIX);
				$aParam['ipv6_block_cidr_aligned'] = utils::ReadPostedParam('attr_ipv6_block_cidr_aligned', 1);
			break;

			case 'dosplitblock':
				$aParam['ip'] = filter_var(utils::ReadPostedParam('attr_ip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['newname'] = utils::ReadPostedParam('newname', '', 'raw_data');
				$aParam['requestor_id'] = utils::ReadPostedParam('attr_requestor_id', null);
				$aParam['ipv6_block_min_prefix'] = utils::ReadPostedParam('attr_ipv6_block_min_prefix', IPV6_BLOCK_MIN_PREFIX);
				$aParam['ipv6_block_cidr_aligned'] = utils::ReadPostedParam('attr_ipv6_block_cidr_aligned', 1);
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
	function DoCheckToDisplayAvailableSpace($aParam)
	{
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
	 */
	function DoDisplayAvailableSpace(WebPage $oP, $iChangeId, $aParameter)
	{
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$sOrigin = $this->Get('origin');
		$oIpToStartFrom = array_key_exists('ip', $aParameter) ? new ormIPv6($aParameter['ip']) : $this->Get('firstip');
		$sIpToStartFrom = $oIpToStartFrom->GetAsCompressed();
		$iPrefix = $aParameter['spacesize'];
		$iMaxOffer = $aParameter['maxoffer'];
		$sStatusSubnet = $aParameter['status_subnet'];
		$sType = $aParameter['type'];
		$iLocationId = $aParameter['location_id'];
		$iRequestorId = $aParameter['requestor_id'];
		$iBlockMinPrefix = IPConfig::GetFromGlobalIPConfig('ipv6_block_min_prefix', $iOrgId);
		$bOfferBlock = ($iPrefix <= $iBlockMinPrefix) ? true : false;
		if ($sOrigin == 'rir')
		{
			$bOfferSubnet = false;
			$sTargetOrigin = 'lir';
		}
		else
		{
			$bOfferSubnet = ($iPrefix >= IPV6_SUBNET_MAX_PREFIX) ? true : false;
			$sTargetOrigin = 'other';
		}

		// Get list of free and occupied space in subnet range
		$aFreeSpace = $this->GetFreeSpace($iPrefix, $iMaxOffer);
		$iSizeFreeArray = sizeof ($aFreeSpace);
		if ($iSizeFreeArray == 0)
		{
			$sIssueDesc = Dict::Format('UI:IPManagement:Action:DoFindSpace:IPBlock:NoSpaceFound', $this->GetName());
			$sMessage = "<div class=\"header_message message_info teemip_message_status\">".$sIssueDesc."</div>";
			$oP->add($sMessage);

			$this->DisplayAllSpace($oP);
		}
		else
		{
			$aOccupiedSpace = $this->GetOccupiedSpace();

			// Check user rights
			$UserHasRightsToCreateBlocks = (UserRights::IsActionAllowed('IPv6Block', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
			$UserHasRightsToCreateSubnets = (UserRights::IsActionAllowed('IPv6Subnet', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
			
			// Display Summary of parameters
			$sHtml = "<b>&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv6Block:Summary', $iMaxOffer, $iPrefix)."</b>&nbsp;";
			$sHtml .= ($iId > 0) ? $this->GetHyperlink() : '';
			$sHtml .= "&nbsp;[".$this->GetAsHTML('firstip')." - ".$this->GetAsHTML('lastip')."]&nbsp;";
			$sHtml .= (array_key_exists('ip', $aParameter)) ? Dict::Format('IPManagement:Action:DoFindSpace:IPBlock:IPToStartFrom', $sIpToStartFrom) : '';
			$oP->add("<ul><li>".$sHtml."<ul>\n");
		
			// Display possible choices as list
			$i = 0;
			$j = 0;
			$iVIdCounter = 1;
			$oAnOccupiedIp = array_key_exists( 'ip', $aParameter) ? new ormIPv6($aParameter['ip']) : $this->Get('firstip');
			$iSizeOccupiedArray = sizeof($aOccupiedSpace);
			$sMask = IPv6Subnet::BitToMask($iPrefix);
			$iSize = (new ormIPv6($sMask))->IP2dec();
			do
			{
				$oAFreeIp = $aFreeSpace[$i]['firstip'];
				$oLastFreeIp = $aFreeSpace[$i]['lastip'];

				// Before displaying offer, display already occupied space sitting before that offer
				if ($iSizeOccupiedArray != 0)
				{
					while ($oAnOccupiedIp->IsSmallerStrict($oAFreeIp) && ($j < $iSizeOccupiedArray))
					{
						// Display un-occupied space if its size is smaller than the requested $iSize
						$oNextOccupiedFirstIp = $aOccupiedSpace[$j]['firstip'];
						if ($oAnOccupiedIp->IsSmallerStrict($oNextOccupiedFirstIp))
						{
							$oLastOccupiedIp = $oNextOccupiedFirstIp->GetPreviousIp();
							// Display space only if within requested scope
							if ($oIpToStartFrom->IsSmallerOrEqual($oAnOccupiedIp))
							{
								$iNbIps = $oAnOccupiedIp->GetSizeInterval($oLastOccupiedIp);
								if ($iNbIps < $iSize)
								{
									$oP->add("<li>".Dict::Format('UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpaceNoPercent', $oAnOccupiedIp->GetAsCompressed(), $oLastOccupiedIp->GetAsCompressed(), $iNbIps)."</li>\n");
								}
							}
							$oAnOccupiedIp = $oNextOccupiedFirstIp;
						}
						elseif ($oAnOccupiedIp->IsEqual($oNextOccupiedFirstIp))
						{
							// Display space only if within requested scope
							if ($oIpToStartFrom->IsSmallerOrEqual($oAnOccupiedIp))
							{
								// Display object attributes
								$sIcon = $aOccupiedSpace[$j]['obj']->GetIcon(true, true);
								$oP->add("<li>".$sIcon.$aOccupiedSpace[$j]['obj']->GetHyperlink());
								if ($aOccupiedSpace[$j]['type'] == 'IPv6Subnet')
								{
									$oP->add("&nbsp;".Dict::S('Class:IPv6Subnet/Attribute:mask/Value_cidr:'.$aOccupiedSpace[$j]['obj']->Get('mask')));
								}
								else
								{
									$oP->add("&nbsp;[".$aOccupiedSpace[$j]['firstip']->GetAsCompressed()." - ".$aOccupiedSpace[$j]['lastip']->GetAsCompressed()."]");

									// Display delegation information if required
									$iParentOrgId = $aOccupiedSpace[$j]['obj']->Get('parent_org_id');
									if ($iParentOrgId == $iOrgId)
									{
										// Block is delegated to child org
										$oP->add("&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:IPBlock:DelegatedToChild',$aOccupiedSpace[$j]['obj']->GetAsHTML('org_id')));
									}
									elseif ($iParentOrgId != 0)
									{
										// Block is delegated from parent org
										$oP->add("&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:IPBlock:DelegatedFromParent',$aOccupiedSpace[$j]['obj']->GetAsHTML('parent_org_id')));
									}
								}
								$oP->add("</li>\n");
							}
							$oAnOccupiedIp = $aOccupiedSpace[$j]['lastip']->GetNextIp();
							$j++;
						}
						elseif ($oAnOccupiedIp->IsBiggerStrict($oNextOccupiedFirstIp))
						{
							$j++;
						}
					}
				}
				$oAnOccupiedIp = $oLastFreeIp->GetNextIp();

				// Display offer now
				$sAFreeIp = $oAFreeIp->GetAsCompressed();
				$sLastFreeIp = $oLastFreeIp->getAsCompressed();
				$oP->add("<li>".$sAFreeIp." - ".$sLastFreeIp."\n"."<ul>");
				
				// If user has rights to create block
				// Display block with icon to create it
				if ($bOfferBlock)
				{
					if ($UserHasRightsToCreateBlocks)
					{
						$iVId = $iVIdCounter++;
						$sHTMLValue = "<li><div><span id=\"v_{$iVId}\">";
						$sHTMLValue .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/images/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
						$sHTMLValue .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsBlock')."&nbsp;&nbsp;";
						$sHTMLValue .= "</span></div></li>\n";
						$oP->add($sHTMLValue);
						if ($sOrigin == 'rir')
						{
							// Creation implies a delegation
							$sPayLoad = '{\'org_id\': \''.$iOrgId.'\', \'parent_org_id\': \''.$iOrgId.'\', \'parent_id\': \''.$iId.'\', \'origin\': \''.$sTargetOrigin.'\', \'firstip\': \''.$sAFreeIp.'\', \'lastip\': \''.$sLastFreeIp.'\'}';
						}
						else
						{
							//$sPayLoad = {'org_id': '$sOrgId', 'parent_id': '$iId', 'firstip': '$sAFreeIp', 'lastip': '$sLastFreeIp'}
							$sPayLoad = '{\'org_id\': \''.$iOrgId.'\', \'parent_id\': \''.$iId.'\', \'origin\': \''.$sTargetOrigin.'\', \'firstip\': \''.$sAFreeIp.'\', \'lastip\': \''.$sLastFreeIp.'\'}';
						}
						$oP->add_ready_script(
<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv6Block', $iChangeId, $sPayLoad);
EOF
						);
					}
				}
				
				// Create as a subnet
				if ($bOfferSubnet)
				{
					if ($UserHasRightsToCreateSubnets)
					{
						$iVId = $iVIdCounter++;
						$sHTMLValue = "<li><div><span id=\"v_{$iVId}\">";
						$sHTMLValue .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/images/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
						$sHTMLValue .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsSubnet')."&nbsp;&nbsp;";
						$sHTMLValue .= "</span></div></li>\n";
						$oP->add($sHTMLValue);
						$oP->add_ready_script(
<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv6Subnet', $iChangeId, {'org_id': '$iOrgId', 'block_id': '$iId', 'ip': '$sAFreeIp', 'mask': '$iPrefix', 'status': '$sStatusSubnet', 'type': '$sType', 'location_id': '$iLocationId', 'requestor_id': '$iRequestorId', 'gatewayip': '$sAFreeIp'});
EOF
						);
					}
				}
					
				$oP->add("</ul></li>\n"); 
			}
			while (++$i < $iSizeFreeArray);
			$oP->add("</ul></li></ul>\n");
		}
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
	function DoCheckToShrink($aParam)
	{
		// Set working variables
		$iBlockId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$iParentId = $this->Get('parent_id');
		$oFirstIpCurrentBlock = $this->Get('firstip');
		$oLastIpCurrentBlock = $this->Get('lastip');
		$oNewFirstIp = new ormIPv6($aParam['firstip']);
		$oNewLastIp =  new ormIPv6($aParam['lastip']);
										
		// Make sure new first IPs is smaller than new last IP
		if ($oNewFirstIp->IsBiggerOrEqual($oNewLastIp))
		{
			return (Dict::Format('UI:IPManagement:Action:Shrink:IPBlock:Reverted'));
		}

		// Make sure new block is contained in old one
		if ($oNewFirstIp->IsSmallerStrict($oFirstIpCurrentBlock) || $oLastIpCurrentBlock->IsSmallerStrict($oNewFirstIp) || $oNewLastIp->IsSmallerStrict($oFirstIpCurrentBlock) || $oLastIpCurrentBlock->IsSmallerStrict($oNewLastIp))
		{
			return (Dict::Format('UI:IPManagement:Action:Shrink:IPBlock:IPOutOfBlock'));
		}

		// Make sure block is changing
		if ($oFirstIpCurrentBlock->IsEqual($oNewFirstIp) && $oLastIpCurrentBlock->IsEqual($oNewLastIp))
		{
			return (Dict::Format('UI:IPManagement:Action:Shrink:IPBlock:NoChange'));
		}

		// Check that new block has minimum size
		if (! $this->DoCheckHasMinBlockSize($oNewFirstIp, $oNewLastIp))
		{
			return (Dict::Format('UI:IPManagement:Action:Shrink:IPv6Block:SmallerThanMinSize', $aParam['ipv6_block_min_prefix']));
		}

		// Check that block is CIDR aligned
		if ($this->DoCheckMustBeCIDRAligned())
		{
			if (!$this->DoCheckCIDRAligned($oNewFirstIp, $oNewLastIp))
			{
				return (Dict::Format('UI:IPManagement:Action:Shrink:IPBlock:NotCIDRAligned'));
			}
		}

		// Make sure that no child block sits accross border
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = '$iBlockId' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)"));
		while ($oSRange = $oSRangeSet->Fetch())
		{
			$oCurrentFirstIp = $oSRange->Get('firstip');
			$oCurrentLastIp = $oSRange->Get('lastip');
			if (($oCurrentFirstIp->IsSmallerStrict($oNewFirstIp) && $oNewFirstIp->IsSmallerOrEqual($oCurrentLastIp)) || ($oCurrentFirstIp->IsSmallerStrict($oNewLastIp) && $oNewLastIp->IsSmallerOrEqual($oCurrentLastIp)))
			{
				return (Dict::Format('UI:IPManagement:Action:Shrink:IPBlock:BlockAccrossBorder'));
			}
		}
							
		// Make sure that no child subnet sits accross border
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = '$iBlockId' AND s.org_id = $iOrgId"));
		while ($oSubnet = $oSubnetSet->Fetch())
		{
			$oCurrentFirstIp = $oSubnet->Get('ip');
			$oCurrentLastIp = $oSubnet->Get('lastip');
			if (($oCurrentFirstIp->IsSmallerStrict($oNewFirstIp) && $oNewFirstIp->IsSmallerOrEqual($oCurrentLastIp)) || ($oCurrentFirstIp->IsSmallerStrict($oNewLastIp) && $oNewLastIp->IsSmallerOrEqual($oCurrentLastIp)))
			{
				return (Dict::Format('UI:IPManagement:Action:Shrink:IPBlock:SubnetAccrossBorder'));
			}
			
			if (($iParentId == 0) && ($oCurrentLastIp->IsSmallerStrict($oNewFirstIp) || $oNewLastIp->IsSmallerStrict($oCurrentFirstIp)))
			{
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
	 * @return \CMDBObjectSet|\DBObjectSet
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	function DoShrink($aParam)
	{
		// Set working variables
		$iBlockId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$iParentId = $this->Get('parent_id');
		$oFirstIpCurrentBlock = $this->Get('firstip');
		$oLastIpCurrentBlock = $this->Get('lastip');
		$oNewFirstIp = new ormIPv6($aParam['firstip']);
		$oNewLastIp =  new ormIPv6($aParam['lastip']);
		$iRequestorId = $aParam['requestor_id'];
		
		// Update initial block and register it.
		if (!is_null($iRequestorId))
		{
			$this->Set('requestor_id', $iRequestorId);
		}
		$this->Set('firstip', $oNewFirstIp);
		$this->Set('lastip', $oNewLastIp);
		$this->DBUpdate();
					
		//	Attach dropped child blocks to parent block
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = '$iBlockId' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)"));
		while ($oSRange = $oSRangeSet->Fetch())
		{
			$oCurrentFirstIp = $oSRange->Get('firstip');
			$oCurrentLastIp = $oSRange->Get('lastip');
			if ($oCurrentLastIp->IsSmallerStrict($oNewFirstIp) || $oNewLastIp->IsSmallerStrict($oCurrentFirstIp))
			{
				$oSRange->Set('parent_id', $iParentId);
				$oSRange->DBUpdate();
			}
		}
							
		//	Attach child subnets to parent block
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = '$iBlockId' AND s.org_id = $iOrgId"));
		while ($oSubnet = $oSubnetSet->Fetch())
		{
			$oCurrentFirstIp = $oSubnet->Get('ip');
			$oCurrentLastIp = $oSubnet->Get('lastip');
			if ($oCurrentLastIp->IsSmallerStrict($oNewFirstIp) || $oNewLastIp->IsSmallerStrict($oCurrentFirstIp))
			{
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
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	function DoCheckToSplit($aParam)
	{
		// Set working variables
		$iBlockId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$iParentId = $this->Get('parent_id');
		$oFirstIpCurrentBlock = $this->Get('firstip');
		$oLastIpCurrentBlock = $this->Get('lastip');
		$oSplitIp = new ormIPv6($aParam['ip']);
		$sNewName = $aParam['newname'];
		$oPreviousSplitIp = $oSplitIp->GetPreviousIp();
				
		// Make sure split Ip is in block
		if ($oSplitIp->IsSmallerOrEqual($oFirstIpCurrentBlock) || $oLastIpCurrentBlock->IsSmallerOrEqual($oSplitIp))
		{
			return (Dict::Format('UI:IPManagement:Action:Split:IPBlock:IPOutOfBlock'));
		}

		// Check that new block has minimum size
		if (! ($this->DoCheckHasMinBlockSize($oFirstIpCurrentBlock, $oPreviousSplitIp) && $this->DoCheckHasMinBlockSize($oSplitIp, $oLastIpCurrentBlock)))
		{
			return (Dict::Format('UI:IPManagement:Action:Shrink:IPv6Block:SmallerThanMinSize', $aParam['ipv6_block_min_prefix']));
		}

		// Check that block is CIDR aligned
		if ($this->DoCheckMustBeCIDRAligned())
		{
			if (!$this->DoCheckCIDRAligned($oFirstIpCurrentBlock, $oPreviousSplitIp) || !$this->DoCheckCIDRAligned($oSplitIp, $oLastIpCurrentBlock))
			{
				return (Dict::Format('UI:IPManagement:Action:Split:IPBlock:NotCIDRAligned'));
			}
		} 

		// Make sure that no child block sits accross border
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = '$iBlockId' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)"));
		while ($oSRange = $oSRangeSet->Fetch())
		{
			$oCurrentFirstIp = $oSRange->Get('firstip');
			$oCurrentLastIp = $oSRange->Get('lastip');
			if ($oCurrentFirstIp->IsSmallerStrict($oSplitIp) && $oSplitIp->IsSmallerOrEqual($oCurrentLastIp))
			{
				return (Dict::Format('UI:IPManagement:Action:Split:IPBlock:BlockAccrossBorder'));
			}
		}
							
		// Make sure that no child subnet sits accross border
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = '$iBlockId' AND s.org_id = $iOrgId"));
		while ($oSubnet = $oSubnetSet->Fetch())
		{
			$oCurrentFirstIp = $oSubnet->Get('ip');
			$oCurrentLastIp = $oSubnet->Get('lastip');
			if ($oCurrentFirstIp->IsSmallerStrict($oSplitIp) && $oSplitIp->IsSmallerOrEqual($oCurrentLastIp))
			{
				return (Dict::Format('UI:IPManagement:Action:Split:IPBlock:SubnetAccrossBorder'));
			}
		}

		// Check new name doesn't already exist
		if ($sNewName == '')
		{
			return (Dict::Format('UI:IPManagement:Action:Split:IPBlock:EmptyNewName'));
		}
		$iKey = $this->GetKey();
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.name = '$sNewName' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId) AND b.id != $iKey"));
		if ($oSRangeSet->Count() != 0)
		{
			return (Dict::Format('UI:IPManagement:Action:Split:IPBlock:NameExist'));
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
	 */
	function DoSplit($aParam)
	{
		// Set working variables
		$iBlockId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$iParentId = $this->Get('parent_id');
		$oFirstIpCurrentBlock = $this->Get('firstip');
		$oLastIpCurrentBlock = $this->Get('lastip');
		$oSplitIp = new ormIPv6($aParam['ip']);
		$sNewName = $aParam['newname'];
		$oPreviousSplitIp = $oSplitIp->GetPreviousIp();
		$iRequestorId = $aParam['requestor_id'];
				
		// Update initial block and register it.
		if (!is_null($iRequestorId))
		{
			$this->Set('requestor_id', $iRequestorId);
		}
		$this->Set('lastip', $oPreviousSplitIp);
		$this->Set('write_reason', 'split');
		$this->DBUpdate();
					
		//	Create new block
		$oNewBlock = MetaModel::NewObject('IPv6Block');
		$oNewBlock->Set('org_id', $iOrgId);
		$oNewBlock->Set('name', $sNewName);
		$oNewBlock->Set('parent_id', $this->Get('parent_id'));
		$oNewBlock->Set('firstip', $oSplitIp);
		$oNewBlock->Set('lastip', $oLastIpCurrentBlock);
		$oNewBlock->Set('type', $this->Get('type'));
		$oNewBlock->Set('comment', $this->Get('comment'));
		if (!is_null($iRequestorId))
		{
			$oNewBlock->Set('requestor_id', $iRequestorId);
		}
		$oNewBlock->Set('write_reason', 'split');
		$oNewBlock->DBInsert();
		$iNewBlockKey = $oNewBlock->GetKey();
					
		// Link new block to same contacts as original block
		$oContactToIPObjectSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT lnkContactToIPObject AS lnk WHERE (lnk.ipobject_id) = $iBlockId"));
		while ($oContactToIPObject = $oContactToIPObjectSet->Fetch())
		{
			$oNewContactLink = MetaModel::NewObject('lnkContactToIPObject');
			$oNewContactLink->Set('ipobject_id', $iNewBlockKey);
			$oNewContactLink->Set('contact_id', $oContactToIPObject->Get('contact_id'));
			$oNewContactLink->DBInsert();
		}
						
		// Link new block to same docs as original block
		$oDocToIPObjectSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT lnkDocToIPObject AS lnk WHERE (lnk.ipobject_id) = $iBlockId"));
		while ($oDocToIPObject = $oDocToIPObjectSet->Fetch())
		{
			$oNewDocLink = MetaModel::NewObject('lnkDocToIPObject');
			$oNewDocLink->Set('ipobject_id', $iNewBlockKey);
			$oNewDocLink->Set('document_id', $oDocToIPObject->Get('document_id'));
			$oNewDocLink->DBInsert();
		}
		
		// Link new block to same locations as original block
		$oBlockToLocationSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT lnkIPBlockToLocation AS lnk WHERE (lnk.ipblock_id) = $iBlockId"));
		while ($oBlockToLocation = $oBlockToLocationSet->Fetch())
		{
			$oNewLocationLink = MetaModel::NewObject('lnkIPBlockToLocation');
			$oNewLocationLink->Set('ipblock_id', $iNewBlockKey);
			$oNewLocationLink->Set('location_id', $oBlockToLocation->Get('location_id'));
			$oNewLocationLink->DBInsert();
		}
					
		//	Attach child blocks to that new block
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = '$iBlockId' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)"));
		while ($oSRange = $oSRangeSet->Fetch())
		{
			$oCurrentFirstIp = $oSRange->Get('firstip');
			if ($oSplitIp->IsSmallerOrEqual($oCurrentFirstIp))
			{
				$oSRange->Set('parent_id', $iNewBlockKey);
				$oSRange->Set('write_reason', 'split');
				$oSRange->DBUpdate();
			}
		}
							
		//	Attach child subnets to that new block
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = '$iBlockId' AND s.org_id = $iOrgId"));
		while ($oSubnet = $oSubnetSet->Fetch())
		{
			$oCurrentFirstIp = $oSubnet->Get('ip');
			if ($oSplitIp->IsSmallerOrEqual($oCurrentFirstIp))
			{
				$oSubnet->Set('block_id', $iNewBlockKey);
				$oSubnet->DBUpdate();
			}
		}
					
		// Display result as array
		$oSet = CMDBobjectSet::FromArray('IPv6Block', array($this, $oNewBlock));
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
	function DoCheckToExpand($aParam)
	{
		// Set working variables
		$iBlockId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$iParentId = $this->Get('parent_id');
		$oFirstIpCurrentBlock = $this->Get('firstip');
		$oLastIpCurrentBlock = $this->Get('lastip');
		$oNewFirstIp = new ormIPv6($aParam['firstip']);
		$oNewLastIp =  new ormIPv6($aParam['lastip']);
				
		// Make sure new first IPs is smaller than new last IP
		if ($oNewFirstIp->IsBiggerOrEqual($oNewLastIp))
		{
			return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:Reverted'));
		}
		
		// Make sure new block contains old one
		if ($oFirstIpCurrentBlock->IsSmallerStrict($oNewFirstIp) || $oNewLastIp->IsSmallerStrict($oLastIpCurrentBlock))
		{
			return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:IPOutOfBlock'));
		}
		
		// Make sure block is changing
		if ($oFirstIpCurrentBlock->IsEqual($oNewFirstIp) && $oLastIpCurrentBlock->IsEqual($oNewLastIp))
		{
			return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:NoChange'));
		}

		// Check that new block has minimum size
		if (! $this->DoCheckHasMinBlockSize($oNewFirstIp, $oNewLastIp))
		{
			return (Dict::Format('UI:IPManagement:Action:Expand:IPv6Block:SmallerThanMinSize', $aParam['ipv6_block_min_prefix']));
		}

		// Check that block is CIDR aligned
		if ($this->DoCheckMustBeCIDRAligned())
		{
			if (!$this->DoCheckCIDRAligned($oNewFirstIp, $oNewLastIp))
			{
				return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:NotCIDRAligned'));
			}
		}

		// Make sure that new blocks is still contained in its parent, if any
		if ($iParentId != 0)
		{
			$oParent = MetaModel::GetObject('IPv6Block', $iParentId, false /* MustBeFound */);
			if (!is_null($oParent))
			{
				$oParentFirstIp = $oParent->Get('firstip');
				$oParentLastIp = $oParent->Get('lastip');
				if ($oNewFirstIp->IsSmallerStrict($oParentFirstIp) || $oParentLastIp->IsSmallerStrict($oNewLastIp) || ($oNewFirstIp->IsEqual($oParentFirstIp) && $oParentLastIp->IsEqual($oNewLastIp)))
				{
					return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:BlockBiggerThanParent'));
				}
			}
		}
						
		// Make sure that new borders don't include existing delegated block
		$oDelegatedSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_org_id != 0 AND b.org_id = $iOrgId"));
		while ($oDelegatedSRange = $oDelegatedSRangeSet->Fetch())
		{
			$oDelegatedSRangeFirstIp = $oDelegatedSRange->Get('firstip');
			$oDelegatedSRangeLastIp = $oDelegatedSRange->Get('lastip');
			if (($oNewFirstIp->IsSmallerOrEqual($oDelegatedSRangeFirstIp) && $oDelegatedSRangeFirstIp->IsSmallerOrEqual($oNewLastIp)) || ($oNewFirstIp->IsSmallerOrEqual($oDelegatedSRangeLastIp) && $oDelegatedSRangeLastIp->IsSmallerOrEqual($oNewLastIp)))
			{
				return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:DelegatedBlockAccrossBorder'));
			}
		}
						
		// Make sure that no brother block sits accross new borders
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = '$iParentId' AND b.id != '$iBlockId' AND b.org_id = $iOrgId"));
		while ($oSRange = $oSRangeSet->Fetch())
		{
			$oCurrentFirstIp = $oSRange->Get('firstip');
			$oCurrentLastIp = $oSRange->Get('lastip');
			if (($oCurrentFirstIp->IsSmallerStrict($oNewFirstIp) && $oNewFirstIp->IsSmallerOrEqual($oCurrentLastIp)) || ($oCurrentFirstIp->IsSmallerOrEqual($oNewLastIp) && $oNewLastIp->IsSmallerStrict($oCurrentLastIp)))
			{
				return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:BlockAccrossBorder'));
			}
		}

		// Make sure that no subnet attached to the same parent block sits accros new borders
		if ($iParentId != 0)
		{
			$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = '$iParentId' AND s.org_id = $iOrgId"));
			while ($oSubnet = $oSubnetSet->Fetch())
			{
				$oCurrentFirstIp = $oSubnet->Get('ip');
				$oCurrentLastIp = $oSubnet->Get('lastip');
				if (($oCurrentFirstIp->IsSmallerStrict($oNewFirstIp) && $oNewFirstIp->IsSmallerOrEqual($oCurrentLastIp)) || ($oCurrentFirstIp->IsSmallerOrEqual($oNewLastIp) && $oNewLastIp->IsSmallerStrict($oCurrentLastIp)))
				{
					return (Dict::Format('UI:IPManagement:Action:Expand:IPBlock:SubnetAccrossBorder'));
				}
			}
		}
		
		// Everything looks good
		return '';
	}
	
	/**
	 * Expand the block
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
	 */
	function DoExpand($aParam)
	{
		// Set working variables
		$iBlockId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$iParentId = $this->Get('parent_id');
		$oFirstIpCurrentBlock = $this->Get('firstip');
		$oLastIpCurrentBlock = $this->Get('lastip');
		$oNewFirstIp = new ormIPv6($aParam['firstip']);
		$oNewLastIp =  new ormIPv6($aParam['lastip']);
		$iRequestorId = $aParam['requestor_id'];
				
		// Update initial block and register it.
		if (!is_null($iRequestorId))
		{
			$this->Set('requestor_id', $iRequestorId);
		}
		$this->Set('firstip', $oNewFirstIp);
		$this->Set('lastip', $oNewLastIp);
		$this->Set('write_reason', 'expand');
		$this->DBUpdate();
					
		// Absorb brother blocks
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = '$iParentId' AND b.id != '$iBlockId' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)"));
		while ($oSRange = $oSRangeSet->Fetch())
		{
			$oCurrentFirstIp = $oSRange->Get('firstip');
			$oCurrentLastIp = $oSRange->Get('lastip');
			if ($oNewFirstIp->IsSmallerOrEqual($oCurrentFirstIp) && $oCurrentLastIp->IsSmallerOrEqual($oNewLastIp))
			{
				$oSRange->Set('parent_id', $iBlockId);      
				$oSRange->DBUpdate();
			}
		}
					
		//	Attach child subnets to parent block
		if ($iParentId != 0)
		{
			$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = '$iParentId' AND s.org_id = $iOrgId"));
			$oSubnetSet->Rewind();
			while ($oSubnet = $oSubnetSet->Fetch())
			{
				$oCurrentFirstIp = $oSubnet->Get('ip');
				$oCurrentLastIp = $oSubnet->Get('lastip');
				if ($oNewFirstIp->IsSmallerOrEqual($oCurrentFirstIp) && $oCurrentLastIp->IsSmallerOrEqual($oNewLastIp))
				{
					$oSubnet->Set('block_id', $iBlockId);
					$oSubnet->DBUpdate();
				}
			}
		}
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
	function DoCheckToDelegate($aParam)
	{
		// Set working variables
		$iOrgId = $this->Get('org_id');
		$iBlockId = $this->GetKey();
		$iParentId = $this->Get('parent_id');
		$oFirstIpBlockToDel = $this->Get('firstip');
		$oLastIpBlockToDel = $this->Get('lastip');
		$iChildOrgId = $aParam['child_org_id'];
		$sDelegateToChildrenOnly = IPConfig::GetFromGlobalIPConfig('delegate_to_children_only', $iOrgId);
		
		// If block should be delegated to children only and if it's already delegated, 
		// 	Make sure redelegation is done at the same level of organization.
		if (($sDelegateToChildrenOnly == 'dtc_yes') && ($this->Get('parent_org_id') != 0))
		{
			$oBlockOrg = MetaModel::GetObject('Organization', $iOrgId, true /* MustBeFound */);
			$oChildBlockOrg = MetaModel::GetObject('Organization', $iChildOrgId, true /* MustBeFound */);
			if ($oBlockOrg->Get('parent_id') != $oChildBlockOrg->Get('parent_id'))
			{
				return (Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:WrongLevelOfOrganization'));
			}
		}

		//  Make sure that new child organization is different from the current one
		if ($iChildOrgId == $iOrgId)
		{
			return (Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:NoChangeOfOrganization'));
		}
		
		// Make sure block has no children blocks and no children subnets
		$oChildrenBlockSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = $iBlockId"));
		if ($oChildrenBlockSet->Count() != 0)
		{
			return (Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocks'));
		}
		$oChildrenSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = $iBlockId"));
		if ($oChildrenSubnetSet->Count() != 0)
		{
			return (Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnets'));
		}		
		
		// Make sure block is not contained in a block that belongs to the organization that the block will be delegated to
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.org_id = $iChildOrgId"));
		while ($oSRange = $oSRangeSet->Fetch())
		{
			$oCurrentFirstIp = $oSRange->Get('firstip');
			$oCurrentLastIp = $oSRange->Get('lastip');
			if (($oCurrentFirstIp->IsSmallerOrEqual($oFirstIpBlockToDel) && $oFirstIpBlockToDel->IsSmallerOrEqual($oCurrentLastIp)) || ($oCurrentFirstIp->IsSmallerOrEqual($oLastIpBlockToDel) && $oLastIpBlockToDel->IsSmallerOrEqual($oCurrentLastIp)))
			{
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
	 * @throws \CoreException
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	function DoCheckToUndelegate($aParam)
	{
		// Set working variables
		$iBlockId = $this->GetKey();

		// Make sure block is already delegated
		if ($this->Get('parent_org_id') == 0)
		{
			return (Dict::Format('UI:IPManagement:Action:Undelegate:IPBlock:IsNotDelegated'));
		}

		// Make sure block has no children blocks and no children subnets
		$oChildrenBlockSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = $iBlockId"));
		if ($oChildrenBlockSet->Count() != 0)
		{
			return (Dict::Format('UI:IPManagement:Action:Undelegate:IPBlock:HasChildBlocks'));
		}
		$oChildrenSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = $iBlockId"));
		if ($oChildrenSubnetSet->Count() != 0)
		{
			return (Dict::Format('UI:IPManagement:Action:Undelegate:IPBlock:HasChildSubnets'));
		}

		// Everything looks good
		return '';
	}

	/**
	 * Display block and child subnets as tree leaf
	 *
	 * @param \WebPage $oP
	 * @param bool $bWithSubnet
	 * @param $sTreeOrgId
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
	function DisplayAsLeaf(WebPage $oP, $bWithSubnet, $sTreeOrgId)
	{
		if	($bWithSubnet)
		{                             
			$sHtml = $this->GetIcon(true, true)."&nbsp;&nbsp;".$this->GetName();
		}
		else
		{
			$sHtml = $this->GetHyperlink();
		}
		$oP->add($sHtml);
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');	 
		$oP->add("&nbsp;&nbsp;&nbsp;[".$oFirstIp->ToString()." - ".$oLastIp->ToString()."]");
		$oP->add("&nbsp;&nbsp;&nbsp;".$this->Get('type'));

		// Display delegation information if required
		$iOrgId = $this->Get('org_id');
		$iParentOrgId = $this->Get('parent_org_id');
		if ($iParentOrgId != 0)
		{
			if ($sTreeOrgId == $iOrgId)
			{
				// Block is delegated from parent org
				$oP->add("&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:IPBlock:DelegatedFromParent',$this->GetAsHTML('parent_org_id')));			 
			}
			else                                                 
			{
				// Block is delegated to child org
				$oP->add("&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:IPBlock:DelegatedToChild',$this->GetAsHTML('org_id')));			 
			}
		} 
		
		// Expand subnet list if required
		if ($bWithSubnet)
		{
			$iBlockId = $this->GetKey();
			$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = '$iBlockId'"));
			if ($oSubnetSet->Count() != 0)
			{
				$oP->add("<ul>\n");
				$aSubnets = array();
				while ($oSubnet = $oSubnetSet->Fetch())
				{
					$aSubnets[$oSubnet->Get('ip')->GetAsCannonical()] = $oSubnet;
				}
				ksort($aSubnets);
				foreach ($aSubnets as $key => $oSubnet)
				{
					$oP->add("<li>".$oSubnet->GetHyperlink());
					$oP->add("&nbsp;".Dict::S('Class:IPv6Subnet/Attribute:mask/Value_cidr:'.$oSubnet->Get('mask')));
					$oP->add("</li>\n");
				}
				$oP->add("</ul>\n");
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
	 * @throws \CoreException
	 */
	function DisplayMainAttributesForOperation(WebPage $oP, $sOperation, $iFormId, $sPrefix, $aDefault)
	{
		$sLabelOfAction = Dict::S($this->MakeUIPath($sOperation).'Summary');
		$oP->SetCurrentTab($sLabelOfAction);

		$oP->add('<table style="vertical-align:top"><tr>');
		$oP->add('<td style="vertical-align:top">');	
		$aDetails = array();
		
		// Parent ID
		$sDisplayValue = $this->GetAsHTML('parent_id');	
		$aDetails[] = array('label' => '<span title="'.MetaModel::GetDescription('IPv6Block', 'parent_id').'">'.MetaModel::GetLabel('IPv6Block', 'parent_id').'</span>', 'value' => $sDisplayValue); 					
		
		// First IP
		$sDisplayValue = $this->GetAsHTML('firstip');	
		$aDetails[] = array('label' => '<span title="'.MetaModel::GetDescription('IPv6Block', 'firstip').'">'.MetaModel::GetLabel('IPv6Block', 'firstip').'</span>', 'value' => $sDisplayValue);					
		
		// Last IP
		$sDisplayValue = $this->GetAsHTML('lastip');	
		$aDetails[] = array('label' => '<span title="'.MetaModel::GetDescription('IPv6Block', 'lastip').'">'.MetaModel::GetLabel('IPv6Block', 'lastip').'</span>', 'value' => $sDisplayValue);
		
		// Requestor ID - Can be modified
		$sInputId = $iFormId.'_'.'requestor_id';
		$oAttDef = MetaModel::GetAttributeDef('IPObject', 'requestor_id');
		$sValue = (array_key_exists('requestor_id', $aDefault)) ? $aDefault['requestor_id'] : $this->Get('requestor_id');
		$iFlags = $this->GetAttributeFlags('requestor_id');
		$aArgs = array('this' => $this, 'formPrefix' => $sPrefix);
		$sHTMLValue = "<span id=\"field_{$sInputId}\">".$this->GetFormElementForField($oP, 'IPObject', 'requestor_id', $oAttDef, $sValue, '', $sInputId, '', $iFlags, $aArgs).'</span>';
		$aFieldsMap['requestor_id'] = $sInputId;
		$aDetails[] = array('label' => '<span title="'.$oAttDef->GetDescription().'">'.$oAttDef->GetLabel().'</span>', 'value' => $sHTMLValue);
		
		$oP->Details($aDetails);
		$oP->add('</td>');
		$oP->add('</tr></table>');
	}
	
	/**
	 * Display attributes associated operation
	 *
	 * @param \WebPage $oP
	 * @param $aDefault
	 */
	function DisplayGlobalAttributesForOperation(WebPage $oP, $aDefault)
	{
		$sLabelOfAction = Dict::Format('Class:IPBlock/Tab:globalparam');
		$aParameter = array ('ipv6_block_min_prefix', 'ipv6_block_cidr_aligned');
		
		$oP->SetCurrentTab($sLabelOfAction);
		$oP->p(Dict::Format('UI:IPManagement:Action:Modify:GlobalConfig'));
		$oP->add('<table style="vertical-align:top"><tr>');
		$oP->add('<td style="vertical-align:top">');
		
		$this->DisplayGlobalParametersInLocalModifyForm($oP, $aParameter, $aDefault);
		
		$oP->add('</td>');
		$oP->add('</tr></table>');
	}
	
	/**
	 * Display attributes associated operation
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
	 */
	function DisplayActionFieldsForOperation(WebPage $oP, $sOperation, $iFormId, $aDefault)
	{
		$oP->add("<table>");
		$oP->add('<tr><td style="vertical-align:top">');

		$aDetails = array();
		switch ($sOperation)
		{
			case 'findspace':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:FindSpace:IPv6Block:SizeOfSpace');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:FindSpace:IPv6Block:MaxNumberOfOffers');
				
				// Size (in term of prefix) of space
				// Compute max possible 'CIDR aligned' space to look for, 
				$iBlockPrefix = $this->GetMinTheoriticalBlockPrefix();

				// Display list of choices
				$sAttCode = 'spacesize';
				$sInputId = $iFormId.'_'.'spacesize';
				$sHTMLValue = "<select id=\"$sInputId\" name=\"spacesize\">\n";
				$InputPrefix = IPV6_SUBNET_MIN_PREFIX;
				$sHTMLValue .= "<option selected='' value=\"$InputPrefix\"> /$InputPrefix</option>\n";
				while(--$InputPrefix >= $iBlockPrefix)
				{
					if ($InputPrefix == IPV6_SUBNET_MAX_PREFIX)
					{
						$sHTMLValue .= "<option selected='' value=\"$InputPrefix\"> /$InputPrefix</option>\n";
					}
					else
					{
						$sHTMLValue .= "<option value=\"$InputPrefix\"> /$InputPrefix</option>\n";
					}
				}
				$sHTMLValue .= "</select>";	
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);
				
				// Max number of offers
				$sInputId = $iFormId.'_'.'maxoffer';
				$jDefault = (array_key_exists('maxoffer', $aDefault)) ? $aDefault['maxoffer'] : DEFAULT_MAX_FREE_SPACE_OFFERS;
				$sHTMLValue = "<input id=\"$sInputId\" type=\"text\" value=\"$jDefault\" name=\"maxoffer\" maxlength=\"2\" size=\"2\">\n";
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
			break;
			
			case 'shrinkblock':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Shrink:IPv6Block:NewFirstIP');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:Shrink:IPv6Block:NewLastIP');

				// New first IP
				$sAttCode = 'firstip';
				$sInputId = $iFormId.'_'.'firstip';
				$oAttDef = MetaModel::GetAttributeDef('IPv6Block', 'firstip');
				$sDefault = (array_key_exists('firstip', $aDefault)) ? $aDefault['firstip'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv6Block', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);
				
				// New last IP
				$sAttCode = 'lastip';
				$sInputId = $iFormId.'_'.'lastip';
				$oAttDef = MetaModel::GetAttributeDef('IPv6Block', 'lastip');
				$sDefault = (array_key_exists('lastip', $aDefault)) ? $aDefault['lastip'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv6Block', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
			break;
			
			case 'splitblock':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Split:IPv6Block:At');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:Split:IPv6Block:NameNewBlock');

				// Split IP
				$sAttCode = 'ip';
				$sInputId = $iFormId.'_'.'ip';
				$oAttDef = MetaModel::GetAttributeDef('IPv6Address', 'ip');
				$sDefault = (array_key_exists('ip', $aDefault)) ? $aDefault['ip'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv6Address', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);
			
				// Name of new block
				$sInputId = $iFormId.'_'.'newname';
				$sDefault = (array_key_exists('newname', $aDefault)) ? $aDefault['newname'] : '';
				$sHTMLValue = "<input id=\"$sInputId\" value=\"$sDefault\" name=\"newname\">";
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
			break;
					
			case 'expandblock':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Expand:IPv6Block:NewFirstIP');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:Expand:IPv6Block:NewLastIP');

				// New first IP
				$sAttCode = 'firstip';
				$sInputId = $iFormId.'_'.'firstip';
				$oAttDef = MetaModel::GetAttributeDef('IPv6Block', 'firstip');
				$sDefault = (array_key_exists('firstip', $aDefault)) ? $aDefault['firstip'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv6Block', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);
				
				// New last IP
				$sAttCode = 'lastip';
				$sInputId = $iFormId.'_'.'lastip';
				$oAttDef = MetaModel::GetAttributeDef('IPv6Block', 'lastip');
				$sDefault = (array_key_exists('lastip', $aDefault)) ? $aDefault['lastip'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv6Block', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
			break;
			
			case 'delegate':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Delegate:IPv6Block:ChildBlock');
			
				$iOrgId = $this->Get('org_id');
				$sDelegateToChildrenOnly = IPConfig::GetFromGlobalIPConfig('delegate_to_children_only', $iOrgId);
				if ($sDelegateToChildrenOnly == 'dtc_yes')
				{
					// Block can only be delegated to children (or grand children) organization
					// Get block's children (list should not be empty at this stage)
					// Block is not already delegated (checked previously)so it can be delegated to child organization
					$oChildOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS child JOIN Organization AS parent ON child.parent_id BELOW parent.id WHERE parent.id = $iOrgId AND child.id != $iOrgId"));
				}
				else
				{
					// Block can be delegated to any organization
					$oChildOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o WHERE o.id != $iOrgId"));
				}

				// Display list of choices now
				$sAttCode = 'child_org_id';
				$sInputId = $iFormId.'_'.'child_org_id';
				$sHTMLValue = "<select id=\"$sInputId\" name=\"child_org_id\">\n";
				while ($oChildOrg = $oChildOrgSet->Fetch())
				{
					$iChildOrgKey = $oChildOrg->GetKey();
					$sChildOrgName = $oChildOrg->GetName();
					if ($iChildOrgKey == $iOrgId)
					{
						$sHTMLValue .= "<option selected='' value=\"$iChildOrgKey\">".$sChildOrgName."</option>\n";
					}
					else
					{
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
		$oP->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"BackToDetails('IPv6Block', $iBlockId)\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;");
				
		// Apply button
		$oP->add("&nbsp;&nbsp<button type=\"submit\" class=\"action\"><span>".Dict::S('UI:Button:Apply')."</span></button></td></tr>");
	
		$oP->add("</table>");
	}
	
	/**
	 * Displays all space (used and non used within block)
	 *
	 * @param \WebPage $oP
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	function DisplayAllSpace(WebPage $oP)
	{
		// Get list of registered blocks and subnets in subnet range
		$aOccupiedSpace = $this->GetOccupiedSpace();

		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');
		$iBlockSize = $this->GetSize();

		// Display Block ref
		$oP->add("<ul>\n");
		$oP->add("<li>".$this->GetHyperlink()."&nbsp;[".$this->GetAsHTML('firstip')." - ".$this->GetAsHTML('lastip')."]<ul>\n");
		
		// Display sub ranges as list
		$iSizeArray = sizeof($aOccupiedSpace);
		$j = 0;
		$oAnIp = $oFirstIp;
		while ($oAnIp->IsSmallerOrEqual($oLastIp))
		{
			if ($j < $iSizeArray)
			{
				if ($oAnIp->IsSmallerStrict($aOccupiedSpace[$j]['firstip']))
				{
					// Display free space
					$oALastIp = $aOccupiedSpace[$j]['firstip']->GetPreviousIp();
					$iNbIps = $oAnIp->GetSizeInterval($oALastIp);
					$oP->add("<li>".Dict::Format('UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpace',$oAnIp->GetAsCompressed(), $oALastIp->GetAsCompressed(), $iNbIps, ($iNbIps / $iBlockSize) * 100));
					$oAnIp = $aOccupiedSpace[$j]['firstip'];
				}
				elseif ($oAnIp->IsEqual($aOccupiedSpace[$j]['firstip']))
				{
					// Display object attributes
					$sIcon = $aOccupiedSpace[$j]['obj']->GetIcon(true, true);
					$oP->add("<li>".$sIcon.$aOccupiedSpace[$j]['obj']->GetHyperlink());
					if ($aOccupiedSpace[$j]['type'] == 'IPv6Subnet')
					{
						$oP->add("&nbsp;".Dict::S('Class:IPv6Subnet/Attribute:mask/Value_cidr:'.$aOccupiedSpace[$j]['obj']->Get('mask')));
					}
					else
					{
						$oP->add("&nbsp;[".$aOccupiedSpace[$j]['firstip']->GetAsCompressed()." - ".$aOccupiedSpace[$j]['lastip']->GetAsCompressed()."]");

						// Display delegation information if required
						$iParentOrgId = $aOccupiedSpace[$j]['obj']->Get('parent_org_id');
						$iChildOrgId = $aOccupiedSpace[$j]['obj']->Get('org_id');
						if ($iParentOrgId != 0)
						{
							$oP->add("&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:IPBlock:DelegatedToChild', $aOccupiedSpace[$j]['obj']->GetAsHTML('org_id')));
						} 
					}
					$oAnIp = $aOccupiedSpace[$j]['lastip']->GetNextIp();
					$j++;
				}
			}
			else
			{
				$iNbIps = $oAnIp->GetSizeInterval($oLastIp);
				$oP->add("<li>".Dict::Format('UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpace',$oAnIp->GetAsCompressed(), $oLastIp->GetAsCompressed(), $iNbIps, ($iNbIps / $iBlockSize) * 100));
				$oAnIp = $oLastIp->GetNextIp();
			}
			$oP->add("</li>\n");
		}
		$oP->add("</ul></li></ul>\n");
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
	public function DisplayBareRelations(WebPage $oP, $bEditMode = false)
	{
		// Execute parent function first 
		parent::DisplayBareRelations($oP, $bEditMode);

		if ($bEditMode)
		{
			if ($this->IsNew())
			{
				$oP->SetCurrentTab(Dict::Format('Class:IPBlock/Tab:globalparam'));
				$oP->p(Dict::Format('UI:IPManagement:Action:Modify:GlobalConfig'));
				$oP->add('<table style="vertical-align:top"><tr>');
				$oP->add('<td style="vertical-align:top">');

				$aParameter = array ('ipv6_block_min_prefix', 'ipv6_block_cidr_aligned');
				$this->DisplayGlobalParametersInLocalModifyForm($oP, $aParameter);
				
				$oP->add('</td>');
				$oP->add('</tr></table>');
			}
		}
		else
		{
			$iBlockId = $this->GetKey();
			$iOrgId = $this->Get('org_id');

			$aExtraParams = array();
			$aExtraParams['menu'] = false;
			
			// Tab for child blocks
			$oChildBlockSearch = DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = $iBlockId AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId)");
			$oChildBlockSet = new CMDBObjectSet($oChildBlockSearch);
			$iChildBlocks = $oChildBlockSet->Count();
			if ($iChildBlocks > 0)
			{
				$oP->SetCurrentTab(Dict::Format('Class:IPBlock/Tab:childblock').' ('.$iChildBlocks.')');
				$oP->p(MetaModel::GetClassIcon('IPv6Block').'&nbsp;'.Dict::Format('Class:IPBlock/Tab:childblock+'));
				$oP->p($this->GetAsHTML('children_occupancy').Dict::Format('Class:IPBlock/Tab:childblock-count-percent'));
				$oBlock = new DisplayBlock($oChildBlockSearch, 'list');
				$oBlock->Display($oP, 'child_blocks', $aExtraParams);
			}
			else
			{
				$oP->SetCurrentTab(Dict::S('Class:IPBlock/Tab:childblock'));
				$oP->p(MetaModel::GetClassIcon('IPv6Block').'&nbsp;'.Dict::S('Class:IPBlock/Tab:childblock+'));
				$oP->p(Dict::S('UI:NoObjectToDisplay'));
			}

			// Tab for subnets
			$oSubnetSearch = DBObjectSearch::FromOQL("SELECT IPv6Subnet AS subnet WHERE subnet.block_id = $iBlockId AND subnet.org_id = $iOrgId");
			$oSubnetSet = new CMDBObjectSet($oSubnetSearch);
			$iSubnets = $oSubnetSet->Count();
			if ($iSubnets > 0)
			{
				$oP->SetCurrentTab(Dict::Format('Class:IPBlock/Tab:subnet').' ('.$iSubnets.')');
				$oP->p(MetaModel::GetClassIcon('IPv6Subnet').'&nbsp;'.Dict::Format('Class:IPBlock/Tab:subnet+'));
				$oP->p($this->GetAsHTML('subnet_occupancy').Dict::Format('Class:IPBlock/Tab:subnet-count-percent'));
				$oBlock = new DisplayBlock($oSubnetSearch, 'list');
				$oBlock->Display($oP, 'child_subnets', $aExtraParams);
			}
			else
			{
				$oP->SetCurrentTab(Dict::S('Class:IPBlock/Tab:subnet'));
				$oP->p(MetaModel::GetClassIcon('IPv6Subnet').'&nbsp;'.Dict::S('Class:IPBlock/Tab:subnet+'));
				$oP->p(Dict::S('UI:NoObjectToDisplay'));
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
		if ($this->IsNew())
		{
			// Preset LastIP to save the typing of too many 'f'
			$oFirstIp = $this->Get('firstip');
			$oLastIp = $this->Get('lastip');
			$oZero = new ormIPv6('::');

			if (! $oFirstIp->IsEqual($oZero))
			{
				if ($oLastIp->IsEqual($oZero))
				{
					$oMask = new ormIPv6(IPV6_BLOCK_MIN_MASK);
					$oLastIp = $oFirstIp->BitwiseOr($oMask->BitwiseNot());
					$this->Set('lastip', $oLastIp);
				}
			}

			// At creation, compute parent_id only in the case where no delegation is done.
			// Note that delegation is implicit when origin is LIR (origin of parent block is RIR)
			$iParentOrgId = $this->Get('parent_org_id');
			$sOrigin = $this->Get('origin');
			if (($iParentOrgId == 0) || ($sOrigin != 'lir'))
			{
				$iOrgId = $this->Get('org_id');

				// Look for all blocks containing the new block
				// Pick the smallest one
				// Absorb brother blocks
				$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.org_id = $iOrgId"));
				$iMinSize = 0;
				$iNewParentId = 0;
				while ($oSRange = $oSRangeSet->Fetch())
				{
					$oCurrentFirstIp = $oSRange->Get('firstip');
					$oCurrentLastIp = $oSRange->Get('lastip');
					if ($oCurrentFirstIp->IsSmallerOrEqual($oFirstIp) && $oLastIp->IsSmallerOrEqual($oCurrentLastIp))
					{
						$iSRangeSize = $oSRange->GetSize();
						if (($iMinSize == 0) || ($iSRangeSize < $iMinSize))
						{
							$iMinSize = $iSRangeSize;
							$iNewParentId = $oSRange->GetKey();
						}
					}
				}
				$this->Set('parent_id', $iNewParentId);
			}
		}
	}

	/**
	 * Check
	 * validity
	 * of
	 * new
	 * block
	 * attributes
	 * before
	 * creation
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 * @throws \Exception
	 */
	public function DoCheckToWrite()
	{
		// Run standard iTop checks first
		parent::DoCheckToWrite();
	
		$iOrgId = $this->Get('org_id');
		if ($this->IsNew())
		{
			$iKey = -1;
		}
		else
		{
			$iKey = $this->GetKey();
		}
		$sName = $this->Get('name');
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');	 
		$sFirstIp = $oFirstIp->ToString();
		$sLastIp = $oLastIp->ToString();
		
		// Check IPs are IPv6
		if (!($oFirstIp instanceof ormIPv6) || !($oLastIp instanceof ormIPv6))
		{
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPv6Block:NotIPv6');
		}

		// Check name doesn't already exist
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.name = '$sName' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId) AND b.id != $iKey"));
		if ($oSRangeSet->Count() != 0)
		{
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:NameExist');
		}
		
		// All modifications related to first and last IPs are done through special actions (shrink, split, expand)
		// As a consequence:
		//	Code of shrink, split, expand functions must check coherency of these IPs
		//	DoCheckToWrite only checks their coherency at creation.
		
		// If check is performed because of split, skip checks
		if ($this->Get('write_reason') == 'split')
		{
			return;
		}
		    
		// In case of modification, no specific check is done as changes do concern minor points and not first or last IP of block.
		if ($this->IsNew())
		{
			// Check that 1st IP is smaller than last one
			if ($oFirstIp->IsBiggerOrEqual($oLastIp))
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:Reverted');
				return;
			}
			
			// Make sure size of block is bigger than absolute minimum size allowed (constant)
			// Default value may be overwritten but not under absolute minimum value.
			if (! $this->DoCheckHasMinBlockSize($oFirstIp, $oLastIp))
			{
				$iBlockMinPrefix = $this->GetMinBlockPrefix();
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:SmallerThanMinSize', $iBlockMinPrefix, $this->Get('org_name'));
				return;
			}
			
			// If required by global parameters, check if block needs to be CIDR aligned and check last IP if needed.
			if ($this->DoCheckMustBeCIDRAligned())
			{
				if (!$this->DoCheckCIDRAligned())
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:NotCIDRAligned');
					return;
				}
			} 
			
			// Make sure range is fully and strictly contained in parent range requested, if any
			//		If no parent is specified, then parent is entire IPv6 space by default and tested condition is true.
			$iParentId = $this->Get('parent_id');
			if ($iParentId != 0)
			{
				$oParent = MetaModel::GetObject('IPv6Block', $iParentId, false /* MustBeFound */);
				if (!is_null($oParent))
				{
					$oParentFirstIp = $oParent->Get('firstip');
					$oParentLastIp = $oParent->Get('lastip');
					if ($oFirstIp->IsSmallerStrict($oParentFirstIp) || $oParentLastIp->IsSmallerStrict($oLastIp) || ($oFirstIp->IsEqual($oParentFirstIp) && $oLastIp->IsEqual($oParentLastIp)))
					{
						$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:NotInParent');
						return;
					}
				}
			}
			
			// Make sure range doesn't collide with another range attached to the same parent.
			//		If no parent is specified (null), then check is done with all such blocks with null parent specified.
			//		It is done on blocks belonging to the same parent otherwise
			$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = '$iParentId' AND (b.org_id = $iOrgId OR b.parent_org_id = $iOrgId) AND b.id != $iKey"));
			if ($iParentId == 0)
			{
				$oSRangeSet2 = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_org_id != 0 AND b.org_id = $iOrgId AND b.id != '$iKey'"));
				$oSRangeSet->Append($oSRangeSet2);
			}
			while ($oSRange = $oSRangeSet->Fetch())
			{
				$oRangeFirstIp = $oSRange->Get('firstip');
				$oRangeLastIp = $oSRange->Get('lastip');
				
				// Does the range already exist?
				if ($oRangeFirstIp->IsEqual($oFirstIp) && $oRangeLastIp->IsEqual($oLastIp))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:Collision0');
					return;
				}
				// Is new first Ip part of an existing range?
				if ($oRangeFirstIp->IsSmallerStrict($oFirstIp) && $oFirstIp->IsSmallerOrEqual($oRangeLastIp))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:Collision1');
					return;
				}
				// Is new last Ip part of an existing range?
				if ($oRangeFirstIp->IsSmallerOrEqual($oLastIp) && $oLastIp->IsSmallerStrict($oRangeLastIp))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPBlock:Collision2');
					return;
				}
				// If new subnet range is including existing ones, the included ranges will automatically be attached
				//	 to the one newly created because of hierarchical structure of blocks (see AfterInsert).
			}
			
			// If block is delegated straight away
			$iParentOrgId = $this->Get('parent_org_id');
			if ($iParentOrgId != 0)
			{
				// Make sure block has no parent in current organization - must be at the top of the tree
				$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.org_id = $iOrgId"));
				while ($oSRange = $oSRangeSet->Fetch())
				{
					$oCurrentFirstIp = $oSRange->Get('firstip');
					$oCurrentLastIp = $oSRange->Get('lastip');
					if (($oCurrentFirstIp->IsSmallerOrEqual($oFirstIp) && $oFirstIp->IsSmallerOrEqual($oCurrentLastIp)) || ($oCurrentFirstIp->IsSmallerOrEqual($oLastIp) && $oLastIp->IsSmallerOrEqual($oCurrentLastIp)))
					{
						$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfTargetOrg');
						return;
					}
				}

				// Make sure block has no children block that are delegated blocks
				// 	This is not possible as delegated blocks may only be provided from parent organization and that blocks with children cannot be delegated
				
				// Make sure that there is no collision with brother blocks from parent organization
				$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = $iParentId AND b.org_id = $iParentOrgId"));
				while ($oSRange = $oSRangeSet->Fetch())
				{
					$oCurrentFirstIp = $oSRange->Get('firstip');
					$oCurrentLastIp = $oSRange->Get('lastip');
					if (($oCurrentFirstIp->IsSmallerStrict($oFirstIp) && $oFirstIp->IsSmallerOrEqual($oCurrentLastIp)) || ($oCurrentFirstIp->IsSmallerOrEqual($oLastIp) && $oLastIp->IsSmallerStrict($oCurrentLastIp)))
					{
						$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfParentOrg');
						return;
					}
				}
				
				// Make sure that block doesn't have any child block nor child subnet in parent organization
				$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE :firstip <= b.firstip AND b.lastip <= :lastip AND b.org_id = $iParentOrgId", array('firstip' => $sFirstIp, 'lastip' => $sLastIp)));
				if ($oSRangeSet->Count() != 0)
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocksInParent');
					return;
				}		
				$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE :firstip <= s.ip AND s.lastip <= :lastip AND s.org_id = $iParentOrgId", array('firstip' => $sFirstIp, 'lastip' => $sLastIp)));
				if ($oSubnetSet->Count() != 0)
				{
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
	public function AfterInsert()
	{
		parent::AfterInsert();
		
		$iOrgId = $this->Get('org_id');
		$iKey = $this->GetKey();
		$iParentOrgId = $this->Get('parent_org_id');
		$iParentId = $this->Get('parent_id');
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');
		$sFirstIp = $oFirstIp->ToString();
		$sLastIp = $oLastIp->ToString();
		
		// Look for all blocks attached to parent of block being created and contained within new block
		// Attach them to new block
		$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = '$iParentId' AND b.org_id = $iOrgId AND b.id != $iKey"));
		while ($oSRange = $oSRangeSet->Fetch())
		{
			$oRangeFirstIp = $oSRange->Get('firstip');
			$oRangeLastIp = $oSRange->Get('lastip');
			
			if ($oFirstIp->IsSmallerOrEqual($oRangeFirstIp) && $oRangeLastIp->IsSmallerOrEqual($oLastIp))
			{
				$oSRange->Set('parent_id', $iKey);
				$oSRange->DBUpdate();	
			}
		}
		
		// If block is delegated, look for blocks from $iOrgId at the top of the tree that are contained within new block
		// Attach them to new block
		if ($iParentOrgId != 0)
		{ 
			$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.parent_id = 0 AND :firstip <= b.firstip AND b.lastip <= :lastip AND b.org_id = $iOrgId", array('firstip' => $sFirstIp, 'lastip' => $sLastIp)));
			while ($oSRange = $oSRangeSet->Fetch())
			{
				$oSRange->Set('parent_id', $iKey);
				$oSRange->DBUpdate();	
			}
		}      

		// If block is not at the top (all subnets are attached to a block), 
		//	Look for all subnets attached to parent block contained within new block
		//	Attach them to new block
		if ($iParentId != 0)
		{
			$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = '$iParentId' AND s.org_id = $iOrgId"));
			while ($oSubnet = $oSubnetSet->Fetch())
			{
				$oSubnetFirstIp = $oSubnet->Get('ip');
				$oSubnetLastIp = $oSubnet->Get('lastip');
	
				if ($oFirstIp->IsSmallerOrEqual($oSubnetFirstIp) && $oSubnetLastIp->IsSmallerOrEqual($oLastIp))
				{
					$oSubnet->Set('block_id', $iKey);
					$oSubnet->DBUpdate();
				}
			}  
		}

		// If block has a LIR as origin at creation, we create a subnet of the same size in the mean time.
		if (($this->Get('origin') == 'lir') && ($iParentOrgId != $iOrgId))
		{
			$iPrefix = $this->GetMinTheoriticalBlockPrefix();
			if ($iPrefix >= IPV6_SUBNET_MAX_PREFIX)
			{
				$aValues = array(
					'org_id' => $iOrgId,
					'requestor_id' => $this->Get('requestor_id'),
					'block_id' => $iKey,
					'ip' => $oFirstIp,
					'mask' => $iPrefix,
					'allocation_date' => time(),
				);
				$oSubnet = MetaModel::NewObject('IPv6Subnet', $aValues);
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
	public function AfterUpdate()
	{
		if ($this->Get('write_reason') != 'split')
		{
			$iOrgId = $this->Get('org_id');
			$iKey = $this->GetKey();
			$iParentId = $this->Get('parent_id');
			$oFirstIp = $this->Get('firstip');
			$oLastIp = $this->Get('lastip');
						
			// Look for all subnets attached to block that may have fallen out of block
			//	Attach them to parent block 
			//	Note: previous check have made sure a parent block exists
			$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = '$iKey' AND s.org_id = $iOrgId"));
			while ($oSubnet = $oSubnetSet->Fetch())
			{
				$oSubnetFirstIp = $oSubnet->Get('ip');
				$oSubnetLastIp = $oSubnet->Get('lastip');

				if ($oSubnetLastIp->IsSmallerStrict($oFirstIp) || $oLastIp->IsSmallerStrict($oSubnetFirstIp))
				{
					if ($iParentId == 0)
					{
						throw new ApplicationException(Dict::Format('UI:IPManagement:Action:Modify:IPv6Block:ParentIdNull', $iKey));
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
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		$aReadOnlyAttributes = array('firstip', 'lastip');
		if (in_array($sAttCode, $aReadOnlyAttributes))
		{
			return OPT_ATT_READONLY;
		}
		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}

}
