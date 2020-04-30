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
 * Class _IPv6Subnet
 */
class _IPv6Subnet extends IPSubnet
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
	public function GetIcon($bImgTag = true, $bXsIcon = false)
	{
		if ($bXsIcon)
		{
			$sIcon = utils::GetAbsoluteUrlModulesRoot().'teemip-ipv6-mgmt/images/ipv6subnet-xs.png';
		}
		else
		{
			$sIcon = utils::GetAbsoluteUrlModulesRoot().'teemip-ipv6-mgmt/images/ipv6subnet.png';
		}
		return ("<img src=\"$sIcon\" style=\"vertical-align:middle;\" alt=\"\"/>");
	}

	/**
	 * @return mixed
	 *
	 * @return mixed
	 */
	function GetName()
	{
		return $this->GetAsHtml('ip');
	}
	
	/**
	 * Returns size of subnet
	 *
	 * @return mixed
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

		switch ($sObject)
		{
			case 'IPRange':
			case 'IPv6Range':
				// Look for all child IP ranges
				$iSubnet = $this->GetKey();
				$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = :subnet_id AND r.org_id = :org_id"), array(), array('subnet_id' => $iSubnet, 'org_id' => $iOrgId));
				$iSizeRanges = 0;
				while ($oIpRange = $oIpRangeSet->Fetch())
				{
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
		if ($iCreationOffset > $oFirstIp->GetSizeInterval($oLastIp))
		{
			return '';
		}

		// Get list of registered IPs
		$iKey = $this->GetKey();
		$oIPRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS ip WHERE ip.subnet_id = :key"), array(), array('key' => $iKey));
		$aIPRegistered = $oIPRegisteredSet->GetColumnAsArray('ip', false);

		// Get list of ranges in Subnet
		$oIPRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = :key"), array(), array('key' => $iKey));

		for ($i = 0; $i < $iCreationOffset; $i++)
		{
			$oFirstIp = $oFirstIp->GetNextIp();
		}
		$oAnIp = $oFirstIp;
		while ($oAnIp->IsSmallerStrict($oLastIp))
		{
			if (!in_array($oAnIp, $aIPRegistered))
			{
				$oIPRangeSet->Rewind();
				$bIsInRange = false;
				while ($oIPRange = $oIPRangeSet->Fetch())
				{
					if ($oIPRange->DoCheckIpInRange($oAnIp))
					{
						$bIsInRange = true;
						break;
					}
				}
				if (!$bIsInRange)
				{
					return $oAnIp->ToString();
				}
			}
			$oAnIp = $oAnIp->GetNextIp();
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
		switch ($sStatus)
		{
			case 'allocated':
			case 'released':
			case 'reserved':
			case 'unassigned':
				$iKey = $this->GetKey();
				$oIpSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS ip WHERE ip.status = :status AND ip.subnet_id = :key"), array(), array('status' => $sStatus, 'key' => $iKey));
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
		if ($iRangeSize >= $iSubnetSize)
		{
			// Required range size is to big, exit
			return $aFreeSpace;
		}
		else
		{
			$oIpRegisteredSearch = DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id",  array('firstip' => $sFirstIp, 'lastip' => $sLastIp, 'org_id' => $iOrgId));
			$oIpRegisteredSet = new CMDBObjectSet($oIpRegisteredSearch);
			$aRegisteredIPs = $oIpRegisteredSet->GetColumnAsArray('ip', false);
			$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = :key"), array(), array('key' => $iKey));
			$aRangeIPs = $oIpRangeSet->GetColumnAsArray('firstip', false);
			
			$oAnIp = $this->Get('ip');
			$oLastIp = $this->Get('lastip');
			$oAnIp = $oAnIp->GetNextIp();
			$n = 0;
			do
			{
				// Find next free IP
				while (in_array($oAnIp, $aRegisteredIPs))
				{
					$oAnIp = $oAnIp->GetNextIp();
				}
				if ($oAnIp->IsSmallerStrict($oLastIp))
				{
					// If free IP belongs to an IP range, skip range
					$oIpRangeSet->Rewind();
					$bContinue = true;
					while ($bContinue && ($oIpRange = $oIpRangeSet->Fetch()))
					{
						$oIpRangeFirstIp = $oIpRange->Get('firstip');
						$oIpRangeLastIp = $oIpRange->Get('lastip');
						if ($oIpRangeFirstIp->IsSmallerOrEqual($oAnIp) && $oAnIp->IsSmallerOrEqual($oIpRangeLastIp))
						{
							$oAnIp = $oIpRangeLastIp->GetNextIp();
							$bContinue = false;
						}
					}
					if ($oAnIp->IsSmallerStrict($oLastIp))
					{
						// Make sure we don't have any IP or range until last IP
						$oRangeFirstIp = $oAnIp;
						$i = 0; 
						$bContinue = true;
						while ($bContinue && (!in_array($oAnIp, $aRegisteredIPs)) && $oAnIp->IsSmallerStrict($oLastIp) && ($i < $iRangeSize))
						{
							if (in_array($oAnIp, $aRangeIPs))
							{
								$bContinue = false;
							}
							else
							{
								$oAnIp = $oAnIp->GetNextIp();
								$i++;
							}
						}
						if ($i == $iRangeSize)
						{
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
	public function GetIPsAsCSV($aParam)
	{
		// Define first and last IPs to display
		$sFirstIp = $aParam['first_ip'];
		$oSubnetIp = $this->Get('ip');
		if ($sFirstIp == '')
		{
			$oFirstIp = $oSubnetIp;
		}
		else
		{
			$oFirstIp = new ormIPv6($sFirstIp);
		}
		$sLastIp = $aParam['last_ip'];
		$oBroadcastIp = $this->Get('lastip');
		if ($sLastIp == '')
		{
			$oLastIp = $oBroadcastIp;
		}
		else
		{
			$oLastIp = new ormIPv6($sLastIp);
		}		
		
		// Get list of registered IPs & Ranges in subnet
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$oIp = $oFirstIp; 
		$sIp = $oIp->GetAsCannonical();
		$sLastIp = $oLastIp->GetAsCannonical();
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :ip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id",  array('ip' => $sIp, 'lastip' => $sLastIp, 'org_id' => $iOrgId)));
		$aIpRegistered = $oIpRegisteredSet->GetColumnAsArray('ip', false);
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = :key"), array(), array('key' => $iId));
		$iCountRange = $oIpRangeSet->Count();
						
		// List exported parameters
		$sHtml = "Registered,Id";
		$aParam = array('org_name', 'ip', 'status', 'fqdn', 'usage_name', 'comment', 'requestor_name', 'release_date');
		foreach($aParam as $sAttCode)
		{
			$sHtml .= ','.MetaModel::GetLabel('IPv6Address', $sAttCode);
		}
		$sHtml .= ",IP Range\n";
						
		// List all IPs of subnet now in IP order 
		$oAnIp = $oIp->GetNextIp();
		while ($oAnIp->IsSmallerOrEqual($oLastIp))
		{
			if (!in_array($oAnIp, $aIpRegistered))
			{
				$sHtml .= "no,,,".$oAnIp->GetAsCompressed().",free,,,,,,,,";
			}
			else
			{
				$oIpRegisteredSet->Rewind();
				$oIpRegistered = $oIpRegisteredSet->Fetch();  
				while (!$oAnIp->IsEqual($oIpRegistered->Get('ip')))
				{
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
			if ($iCountRange != 0)
			{
				$oIpRangeSet->Rewind();
				$oIpRange = $oIpRangeSet->Fetch();
				$iFoundRange = false;
				while (($oIpRange != null) && ($iFoundRange == false))
				{
					if ($oIpRange->Get('firstip')->IsSmallerOrEqual($oAnIp) && $oAnIp->IsSmallerOrEqual($oIpRange->Get('lastip')))
					{
						$iFoundRange = true;
					}
					else
					{
						$oIpRange = $oIpRangeSet->Fetch();
					}
				}
				if ($iFoundRange)
				{
					$sHtml .= $oIpRange->Get('range')."\n";
				}
				else
				{
					$sHtml .= "\n";
				}
			}
			else
			{
				$sHtml .= "\n";
			}
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
	 */
	function DoCheckIpInSubnet($oIp)
	{
		$oSubnetIp = $this->Get('ip');
		$oLastIp = $this->Get('lastip');
		if ($oSubnetIp->IsSmallerOrEqual($oIp) && $oIp->IsSmallerOrEqual($oLastIp))
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Check if subnet is CIDR aligned
	 *
	 * @return bool
	 */
	function DoCheckCIDRAligned()
	{
		// Note that IPv6 subnets are /64 only
		
		$oIp = $this->Get('ip');
		$sBitMask = $this->Get('mask');
		$sMask = $this->BitToMask($sBitMask);
		$oMask = new ormIPv6($sMask);

		$oAndIP = $oIp->BitwiseAnd($oMask);
		if ($oIp->IsEqual($oAndIP))
		{
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
	 */
	function DoCheckOperation($sOperation)
	{
		switch ($sOperation)
		{
			case 'findspace':
				if ($this->Get('mask') > 124)
				{
					return ('SizeTooSmall');
				}
			break;
				
			case 'listips':
			case 'csvexportips':
			case 'calculator':
				return ('');
			break;
				
			case 'shrinksubnet':
			case 'splitsubnet':
			case 'expandsubnet':
			default:
				// Size of IPv6 subnets cannot change
				return ('OperationNotAllowed');
			break;
		}
		return ('');
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
		$iRangeSize = $aParam['rangesize'];
		
		// Get list of registered IPs & ranges in subnet
		$iSubnetSize = $this->GetSize();
		if ($iRangeSize >= $iSubnetSize)
		{
			// Required range size is to big, exit
			return ('RangeTooBig');
		}
		return '';
	}

	/**
	 * Displays available space
	 *
	 * @param \WebPage $oP
	 * @param $iChangeId
	 * @param $aParam
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	function DoDisplayAvailableSpace(WebPage $oP, $iChangeId, $aParam)
	{
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$iRangeSize = $aParam['rangesize'];
		$iMaxOffer = $aParam['maxoffer'];
		
		// Get list of registered IPs & ranges in subnet
		$iSubnetSize = $this->GetSize();
		if ($iRangeSize >= $iSubnetSize)
		{
			// Required range size is to big, exit
			// This should have been checked before
			$oP->add(Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv6Subnet:RangeTooBig')."<br><br>");
		}
		else
		{
			// Get list of free space in subnet
			$aFreeSpace = $this->GetFreeSpace($iRangeSize, $iMaxOffer);
			
			// Check user rights
			$UserHasRightsToCreate = (UserRights::IsActionAllowed('IPv6Range', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
	
			// Display Summary of parameters
			$oP->add("<ul>\n");
			$oP->add("<li>"."&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Summary', $iMaxOffer, $iRangeSize)."<ul>\n");
			
			// Display possible choices as list
			$iSizeFreeArray = sizeof ($aFreeSpace);
			if ($iSizeFreeArray != 0)
			{
				$i = 0;
				$iVIdCounter = 1;
				do
				{
					$oRangeFirstIp = $aFreeSpace[$i]['firstip'];
					$sRangeFirstIp = $oRangeFirstIp->GetAsCannonical();
					$oRangeLastIp = $aFreeSpace[$i]['lastip'];
					$sRangeLastIp = $oRangeLastIp->GetAsCannonical();
					$oP->add("<li>".$sRangeFirstIp." - ".$sRangeLastIp."\n");
					
					// If user has rights to create range
					// Display range with icon to create it
					if  ($UserHasRightsToCreate)
					{
						$iVId = $iVIdCounter++;
						$sHTMLValue = "<ul><li><div><span id=\"v_{$iVId}\">";
						$sHTMLValue .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/images/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
						$sHTMLValue .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv6Subnet:CreateAsRange')."&nbsp;&nbsp;";
						$sHTMLValue .= "</span></div></li>\n";
						$oP->add($sHTMLValue);
						$oP->add_ready_script(
<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv6Range', $iChangeId, {'org_id': '$iOrgId', 'subnet_id': '$iId', 'firstip': '$oRangeFirstIp', 'lastip': '$oRangeLastIp'});
EOF
						);
						$oP->add("</ul></li>\n");
					}
					else
					{
						$oP->add("</li>\n");
					} 
				}
			while (++$i < $iSizeFreeArray);
		}
		$oP->add("</ul></li></ul>\n");
		}
	} 

	/**
	 * Check if IPs can be listed
	 *
	 * @param $aParam
	 *
	 * @return string
	 * @throws \Exception
	 */
	function DoCheckToListIps($aParam)
	{
		$oIp = $this->Get('ip');
		$oBroadcastIp = $this->Get('lastip');

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '')
		{
			$oFirstIp = new ormIPv6($sFirstIp);
			if ($oFirstIp->IsSmallerStrict($oIp) || $oBroadcastIp->IsSmallerOrEqual($oFirstIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIPOutOfSubnet'));
			}
		}
		
		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '')
		{
			$oLastIp = new ormIPv6($sLastIp);
			if ($oLastIp->IsSmallerOrEqual($oIp) || $oBroadcastIp->IsSmallerStrict($oLastIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Subnet:LastIPOutOfSubnet'));
			}
		}
		
		if (($sFirstIp != '') && ($sLastIp != ''))
		{
			if ($oFirstIp->IsBiggerStrict($oLastIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIpBiggerThanLastIp'));
			}
		}
		return '';
	}
	
	/**
	 * Display list IP addresses within GUI
	 *
	 * @param \WebPage $oP
	 * @param $iChangeId
	 * @param $aParam
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	function DoListIps(WebPage $oP, $iChangeId, $aParam)
	{
		// Define first and last IPs to display
		$sFirstIp = $aParam['first_ip'];
		$oSubnetIp = $this->Get('ip');
		if ($sFirstIp == '')
		{
			$oFirstIp = $oSubnetIp;
		}
		else
		{
			$oFirstIp = new ormIPv6($sFirstIp);
		}
		$bPrintDummyFirstLine = $oFirstIp->IsEqual($oSubnetIp) ? false : true;
		$sLastIp = $aParam['last_ip'];
		$oBroadcastIp = $this->Get('lastip');
		if ($sLastIp == '')
		{
			$oLastIp = $oBroadcastIp;
		}
		else
		{
			$oLastIp = new ormIPv6($sLastIp);
		}		
		$bPrintDummyLastLine = $oLastIp->IsEqual($oBroadcastIp) ? false : true;
		
		// Get list of registered IPs & Ranges in subnet
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$oIp = $oFirstIp; 
		$sIp = $oIp->GetAsCannonical();
		$sLastIp = $oLastIp->GetAsCannonical();
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :ip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id",  array('ip' => $sIp, 'lastip' => $sLastIp, 'org_id' => $iOrgId)));
		$aIpRegistered = $oIpRegisteredSet->GetColumnAsArray('ip', false);
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = :key"), array(), array('key' => $iId));
		$aIpRange = $oIpRangeSet->GetColumnAsArray('firstip', false);
			
		// Preset display of name and subnet attributes
		$sHtml = "&nbsp;".Dict::S('Class:IPv6Subnet/Attribute:mask/Value_cidr:'.$this->Get('mask'))."	 - ".$this->GetLabel('type').': '.$this->GetAsHTML('type');

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
	
		// Display first IP
		$oP->add("<ul>\n");
		$oP->add("<li>".$this->GetIcon(true,true).$this->GetHyperlink().$sHtml."<ul>\n");
	
		// ... and dummy line if display doesn't start at first IP
		if ($bPrintDummyFirstLine)
		{
			$oP->add("<li>&nbsp;&nbsp;...&nbsp;//&nbsp;... </li>");
		}
		
		// Display other IPs as list
		while ($oAnIp->IsSmallerOrEqual($oLastIp))
		{
			if (in_array($oAnIp, $aIpRange))
			{ 
				// Found a range within list of IPs
				$oIpRangeSet->Rewind();
				$oIpRange = $oIpRangeSet->Fetch();
				while (!$oAnIp->IsEqual($oIpRange->Get('firstip')))
				{
					$oIpRange = $oIpRangeSet->Fetch();
				}
			    
				// Display name and range attributes
				$sIcon = $oIpRange->GetIcon(true, true);
				$oP->add("<li>".$sIcon.$oIpRange->GetHyperlink()."&nbsp;&nbsp;&nbsp;[".$oIpRange->Get('firstip')." - ".$oIpRange->Get('lastip')."]");
				$oP->add("&nbsp;&nbsp; - ".$oIpRange->GetLabel('usage_id').': '.$oIpRange->GetAsHTML('usage_id')."<ul>\n");
				$oIpRangeLastIp = $oIpRange->Get('lastip');
			}
			if (in_array($oAnIp, $aIpRegistered))
			{
				// Found registered IP
				$oIpRegisteredSet->Rewind();
				$oIpRegistered = $oIpRegisteredSet->Fetch();
				while (!$oAnIp->IsEqual($oIpRegistered->Get('ip')))
				{
					$oIpRegistered = $oIpRegisteredSet->Fetch();
				}
				$oP->add("<li>".$oIpRegistered->GetHyperlink()."&nbsp;&nbsp; - ".$oIpRegistered->GetAsHTML('status')."&nbsp;&nbsp; - ".$oIpRegistered->Get('fqdn'));
			}
			else
			{
				// If user has rights to create IPs
				// Display unregistered IP with icon to create it
				if  ($UserHasRightsToCreate)
				{
					$iVId = $iVIdCounter++;
					$sHTMLValue = "<li><div><span id=\"v_{$iVId}\">";
					$sHTMLValue .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/images/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
					$sHTMLValue .= "&nbsp;".$oAnIp->GetAsCompressed()."&nbsp;&nbsp;";
					$sHTMLValue .= "</span></div>";
					$oP->add($sHTMLValue);	
					$oP->add_ready_script(
<<<EOF
					oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv6Address', $iChangeId, {'org_id': '$iOrgId', 'subnet_id': '$iId', 'ip': '$oAnIp', 'status': '$sStatusIp', 'short_name': '$sShortName', 'domain_id': '$iDomainId', 'usage_id': '$iUsageId', 'requestor_id': '$iRequestorId'});
EOF
					);
				}
				else
				{
					$oP->add("<li>".$oAnIp->GetAsCompressed());
				}
			}
			if ($oAnIp->IsEqual($oIpRangeLastIp))
			{
				$oP->add("</ul></li>\n");
			}
			$oAnIp = $oAnIp->GetNextIp();
		}

		// Add dummy line if display doesn't finish at broadcast IP
		if ($bPrintDummyLastLine)
		{
			$oP->add("<li>&nbsp;&nbsp;...&nbsp;//&nbsp;... </li>");
		}
		$oP->add("</ul></li></ul>\n");
	}
	
	/**
	 * Check if IPs can be exported in CSV
	 *
	 * @param $aParam
	 *
	 * @return string
	 * @throws \Exception
	 */
	function DoCheckToCsvExportIps($aParam)
	{
		$oIp = $this->Get('ip');
		$oBroadcastIp = $this->Get('lastip');

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '')
		{
			$oFirstIp = new ormIPv6($sFirstIp);
			if ($oFirstIp->IsSmallerStrict($oIp) || $oBroadcastIp->IsSmallerOrEqual($oFirstIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIPOutOfSubnet'));
			}
		}
		
		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '')
		{
			$oLastIp = new ormIPv6($sLastIp);
			if ($oLastIp->IsSmallerOrEqual($oIp) || $oBroadcastIp->IsSmallerStrict($oLastIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:LastIPOutOfSubnet'));
			}
		}
		
		if (($sFirstIp != '') && ($sLastIp != ''))
		{
			if ($oFirstIp->IsBiggerStrict($oLastIp))
			{
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
	function DoCheckCalculatorInputs($aParam)
	{
		$iCidr = $aParam['cidr'];

		if ($iCidr == '')
		{
			return (Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:EnterPrefix'));
		}

		if (($iCidr <= 0) || ($iCidr > 128))
		{
			return (Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:WrongPrefix'));
		}
		return '';
	}
	
	/*
	 * Display main attributes for associated operation
	 *
	 * @param \WebPage $oP
	 * @param $iFormId
	 * @param $sPrefix
	 * @param $aDefault
	 */
	function DisplayMainAttributesForOperation(WebPage $oP, $iFormId, $sPrefix, $aDefault)
	{
	}
	
	/**
	 * Display global attributes for associated operation
	 *
	 * @param $oP
	 * @param $aDefault
	 */
	function DisplayGlobalAttributesForOperation($oP, $aDefault)
	{
	}
	
	/**
	 * Display action fields for associated operation
	 *
	 * @param \WebPage $oP
	 * @param $sOperation
	 * @param $iFormId
	 * @param $aDefault
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	function DisplayActionFieldsForOperation(WebPage $oP, $sOperation, $iFormId, $aDefault)
	{
		$oP->add("<table>");
		$oP->add('<tr><td style="vertical-align:top">');
		
		switch ($sOperation)
		{
			case 'findspace':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeOfRange');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:FindSpace:IPv6Subnet:MaxNumberOfOffers');
				
				// Size of range
				$sInputId = $iFormId.'_'.'rangesize';
				$sHTMLValue = "<input id=\"$sInputId\" type=\"text\" name=\"rangesize\" maxlength=\"4\" size=\"4\">\n";
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);
				
				// Max number of offers
				$sInputId = $iFormId.'_'.'maxoffer';
				$jDefault = (array_key_exists('maxoffer', $aDefault)) ? $aDefault['maxoffer'] : DEFAULT_MAX_FREE_SPACE_OFFERS;
				$sHTMLValue = "<input id=\"$sInputId\" type=\"text\" value=\"$jDefault\" name=\"maxoffer\" maxlength=\"2\" size=\"2\">\n";
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
				
				$oP->Details($aDetails);
				$oP->add('</td></tr>');
				
				// Cancell button
				$iObjId = $this->GetKey();
				$oP->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"BackToDetails('IPv6Subnet', $iObjId)\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;");
			break;
						
			case 'listips':
			case 'csvexportips':
				if ($sOperation == 'listips')
				{
					$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:ListIps:IPv6Subnet:FirstIP');
					$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:ListIps:IPv6Subnet:LastIP');
					
					// Sub title
					$oP->add("<b>".Dict::S('UI:IPManagement:Action:ListIps:IPv6Subnet:Subtitle_ListRange')."</b>\n");
				}
				else
				{
					$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:CsvExportIps:IPv6Subnet:FirstIP');
					$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:CsvExportIps:IPv6Subnet:LastIP');
					
					// Sub title
					$oP->add("<b>".Dict::S('UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Subtitle_ListRange')."</b>\n");
				}
				
				// Preset subnet bits of IP
				$oSubnetIp = $this->Get('ip');
				$sSubnetIp = $oSubnetIp->GetAsCompressed();
				
				// New first IP
				$sAttCode = 'firstip';
				$sInputId = $iFormId.'_'.'firstip';
				$oAttDef = MetaModel::GetAttributeDef('IPv6Range', 'firstip');
				$sDefault = (array_key_exists('firstip', $aDefault)) ? $aDefault['firstip'] : $sSubnetIp;
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv6Range', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);
				
				// New last IP
				$sAttCode = 'lastip';
				$sInputId = $iFormId.'_'.'lastip';
				$oAttDef = MetaModel::GetAttributeDef('IPv6Range', 'lastip');
				$sDefault = (array_key_exists('lastip', $aDefault)) ? $aDefault['lastip'] : $sSubnetIp;
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv6Range', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
				
				$oP->Details($aDetails);
				$oP->add('</td></tr>');
				
				// Cancell button
				$iObjId = $this->GetKey();
				$oP->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"BackToDetails('IPv6Subnet', $iObjId)\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;");
			break;
			
			case 'calculator':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Calculator:IPv6Subnet:IP');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:Calculator:IPv6Subnet:Prefix');

				// IP
				$sAttCode = 'ip';
				$sInputId = $iFormId.'_'.'ip';
				$oAttDef = MetaModel::GetAttributeDef('IPv6Subnet', 'ip');
				$sDefault = (array_key_exists('ip', $aDefault)) ? $aDefault['ip'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv6Subnet', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);
				
				// CIDR
				$sInputId = $iFormId.'_'.'cidr';
				$sHTMLValue = "<input type=\"number\" id=\"$sInputId\" name=\"cidr\">\n";
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
				
				
				$oP->Details($aDetails);
				$oP->add('</td></tr>');
				
				// Cancell button
				$iObjId = $this->GetKey();
				if ($iObjId > 0)
				{
					$oP->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"BackToDetails('IPv6Subnet', $iObjId)\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;");
				}
				else
				{
					$oP->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"window.history.back()\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;");
				}
			break;
			
			default:
			break;
		};
				
		// Apply button
		$oP->add("&nbsp;&nbsp<button type=\"submit\" class=\"action\"><span>".Dict::S('UI:Button:Apply')."</span></button></td></tr>");
		
		$oP->add("</table>");
	}

	/**
	 * Displays result of IPv6 calculator
	 *
	 * @param \WebPage $oP
	 * @param $oAppContext
	 * @param $aParam
	 *
	 * @throws \Exception
	 */
	function DisplayCalculatorOutput(WebPage $oP, $oAppContext, $aParam)
	{
	    $sIp = $aParam['ip'];
    	$iPrefix = $aParam['cidr'];
		
		$oIp = new ormIPv6($sIp);
		$sIpComp = $oIp->GetAsCompressed();
		$sIpCan = $oIp->GetAsCannonical();

		$oMask = new ormIPv6('FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF');
		for ($i = 1; $i <= (IPV6_MAX_BIT - $iPrefix); $i++)
		{
			$oMask = $oMask->LeftShift();
		}
		$sMask = $oMask->GetAsCompressed();
		
		$oSubnetIp = $oIp->BitwiseAnd($oMask);
		$sSubnetIp = $oSubnetIp->GetAsCompressed();
		
		$oNotMask = $oMask->BitwiseNot();
		$oLastIp = $oIp->BitwiseOr($oNotMask);
		$sLastIp = $oLastIp->GetAsCompressed();

		$iIpNumber = $oIp->GetSizeInterval($oLastIp);
		if ($iIpNumber > 2)
		{
			$iUsableHosts = $iIpNumber - 2;
		}
		else
		{
			$iUsableHosts = 0;
		}
		
		$oVeryFirstIp = new ormIPv6('::');
		if ($oSubnetIp->IsEqual($oVeryFirstIp))
		{
			$sPreviousSubnetIp = Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet:NA');
		}
		else
		{
			$oPreviousSubnetIp = $oSubnetIp->GetPreviousIp();
			$oPreviousSubnetIp = $oPreviousSubnetIp->BitwiseAnd($oMask);
			$sPreviousSubnetIp = $oPreviousSubnetIp->GetAsCompressed();
		}
		
		$oVeryLastIp = new ormIPv6('FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF');
		if ($oLastIp->IsEqual($oVeryLastIp))
		{
			$sNextSubnetIp = Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet:NA');
		}
		else
		{
			$oNextSubnetIp = $oLastIp->GetNextIp();
			$sNextSubnetIp = $oNextSubnetIp->GetAsCompressed();
		}
		
		$oP->add('<table style="vertical-align:top;"><tr><td>');
		$oP->add('<div id="tree">');
		// IP address - Compressed format
		$oP->add('&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:CompressedIP').":</td><td>$sIpComp</td></tr>");
		
		// IP address - Canonical format
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:CanonicalIP').":</td><td>$sIpCan</td></tr>");
		$oP->add('<tr><td height=10></td></tr>');
		
		// Network IP
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:NetworkIP').":</td><td><b>$sSubnetIp</b></td></tr>");
		
		// Prefix
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:Prefix').":</td><td>$iPrefix</td></tr>");
		
		// Prefix mask
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:PrefixMask').":</td><td>$sMask</td></tr>");
		$oP->add('<tr><td height=10></td></tr>');
		
		// Last IP
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:LastIP').":</td><td><b>$sLastIp</b></td></tr>");
		
		// Number of IPs
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:IPNumber').":</td><td>$iIpNumber</td></tr>");
		$oP->add('<tr><td height=10></td></tr>');
		
		// Previous network
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet').":</td><td>$sPreviousSubnetIp</td></tr>");
		
		// Next network
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet').":</td><td>$sNextSubnetIp</td></tr>");
		$oP->add('<tr><td height=10></td></tr>');

		// As an option, create subnet or block with calculated parameters (previous, current or next one)
		$UserHasRightsToCreateBlocks = (UserRights::IsActionAllowed('IPv6Block', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
		$UserHasRightsToCreateSubnets = (UserRights::IsActionAllowed('IPv6Subnet', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
		if (!$UserHasRightsToCreateBlocks && !$UserHasRightsToCreateSubnets)
		{
			return;
		}

		$oP->add('<tr><td>&nbsp;&nbsp;</td><td colspan="2">'.Dict::S('UI:IPManagement:Action:Calculator:IPSubnet:SelectCreation').':</td></tr>');
		if ($this->GetKey() > 0)
		{
			$iOrgId = $this->Get('org_id');
			$iBlockMinSize = IPConfig::GetFromGlobalIPConfig('ipv6_block_min_prefix', $iOrgId);
		}
		else
		{
			$iBlockMinSize = IPV6_BLOCK_MIN_PREFIX;
		}
		$bOfferBlock = ($iPrefix <= $iBlockMinSize) ? true : false;
		$bOfferSubnet = ($iPrefix >= IPV6_SUBNET_MAX_PREFIX) ? true : false;

		$iVIdCounter = 1;
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$aSubnetIps = array();
		if (!$oSubnetIp->IsEqual($oVeryFirstIp))
		{
			$aSubnetIps[$sPreviousSubnetIp ] = $oPreviousSubnetIp->BitwiseOr($oNotMask)->GetAsCompressed();
		}
		$aSubnetIps[$sSubnetIp] = $sLastIp;
		if (!$oLastIp->IsEqual($oVeryLastIp))
		{
			$aSubnetIps[$sNextSubnetIp] = $oNextSubnetIp->BitwiseOr($oNotMask)->GetAsCompressed();
		}
		foreach ($aSubnetIps as $sFirstSubnetIp => $sLastSubnetIp)
		{
			if ($sFirstSubnetIp == $sSubnetIp)
			{
				$oP->add('<tr><td></td><td>&nbsp;&nbsp;</td><td><b>'.$sFirstSubnetIp.' /'.$iPrefix.'</b></td>');
			}
			else
			{
				$oP->add('<tr><td></td><td>&nbsp;&nbsp;</td><td>'.$sFirstSubnetIp.' /'.$iPrefix.'</td>');
			}

			$sHTMLValue = '';
			if ($UserHasRightsToCreateBlocks)
			{
				if ($bOfferBlock)
				{
					$iVId = $iVIdCounter++;
					$sHTMLValue .= "<td><div><span id=\"v_{$iVId}\">";
					$sHTMLValue .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/images/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
					$sHTMLValue .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoCalculator:IPSubnet:CreateBlock')."&nbsp;&nbsp;";
					$sHTMLValue .= "</span></div></td></tr>";
					$oP->add($sHTMLValue);
					$oP->add_ready_script(
						<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv6Block', 0, {'org_id': '$iOrgId', 'parent_id': '$iId', 'firstip': "$sFirstSubnetIp", 'lastip': '$sLastSubnetIp'});
EOF
					);
				}
				else
				{
					$sHTMLValue .= '<td>'.Dict::S('UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateBlock:MaskIsToBig').'</td></tr>';
					$oP->add($sHTMLValue);
				}
				$sHTMLValue = "<tr><td></td><td></td><td></td>";
			}
			if ($UserHasRightsToCreateSubnets)
			{
				if ($bOfferSubnet)
				{
					$iVId = $iVIdCounter++;
					$sHTMLValue .= "<td><div><span id=\"v_{$iVId}\">";
					$sHTMLValue .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/images/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
					$sHTMLValue .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoCalculator:IPSubnet:CreateSubnet')."&nbsp;&nbsp;";
					$sHTMLValue .= "</span></div></td>";
					$oP->add($sHTMLValue);
					$oP->add_ready_script(
						<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv6Subnet', 0, {'org_id': '$iOrgId', 'parent_id': '$iId', 'ip': "$sFirstSubnetIp", 'mask': '$iPrefix'});
EOF
					);
				}
				else
				{
					$sHTMLValue .= "<td>".Dict::S('UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateSubnet:MaskIsToSmall')."</td></tr>";
					$oP->add($sHTMLValue);
				}
			}

		}
		$oP->add('</div></td></tr></table>');
		$oP->add('</div>');		 // ??
	}
	
	/**
	 * Displays the tabs related to IPv6Subnets
	 *
	 * @param \WebPage $oP
	 * @param bool $bEditMode
	 *
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	function DisplayBareRelations(WebPage $oP, $bEditMode = false)
	{
		// Execute parent function first 
		parent::DisplayBareRelations($oP, $bEditMode);

		if ($bEditMode)
		{
			if ($this->IsNew())
			{
				// Tab for Global Parameters at creation time only
				$oP->SetCurrentTab(Dict::Format('Class:IPSubnet/Tab:globalparam'));
				$oP->p(Dict::Format('UI:IPManagement:Action:Modify:GlobalConfig'));
				$oP->add('<table style="vertical-align:top"><tr>');
				$oP->add('<td style="vertical-align:top">');
				
				$aParameter = array ('reserve_subnet_IPs');
				$this->DisplayGlobalParametersInLocalModifyForm($oP, $aParameter);
				
				$oP->add('</td>');
				$oP->add('</tr></table>');
			}
		}
		else
		{
			$iOrgId = $this->Get('org_id');
			$iKey = $this->GetKey();
			$sIp = $this->Get('ip')->GetAsCannonical();
			$sLastIp = $this->Get('lastip')->GetAsCannonical();

			$aExtraParams = array();
			$aExtraParams['menu'] = false;
			
			// Tab for Registered IPs
			$oIpRegisteredSearch = DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :ip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id",  array('ip' => $sIp, 'lastip' => $sLastIp, 'org_id' => $iOrgId));
			$oIpRegisteredSet = new CMDBObjectSet($oIpRegisteredSearch);
			$iRegistered = $oIpRegisteredSet->Count();
			if ($iRegistered > 0)
			{
				$aStatusRegisteredIPs = $oIpRegisteredSet->GetColumnAsArray('status', false);
				$iReserved = 0;
				$iAllocated = 0;
				$iReleased = 0;
				$i = 0;
				while ($i < $iRegistered)
				{
					switch ($aStatusRegisteredIPs[$i++])
					{
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
				$oP->SetCurrentTab(Dict::Format('Class:IPSubnet/Tab:ipregistered').' ('.$iRegistered.')');
				$oP->p(MetaModel::GetClassIcon('IPv6Address').'&nbsp;'.Dict::Format('Class:IPSubnet/Tab:ipregistered+'));
				$oP->p(Dict::Format('Class:IPv6Subnet/Tab:ipregistered-count', $iReserved, $iAllocated, $iReleased, $iUnallocated));
				$oBlock = new DisplayBlock($oIpRegisteredSearch, 'list');
				$oBlock->Display($oP, 'ip_addresses', $aExtraParams);
			}
			else
			{
				$oP->SetCurrentTab(Dict::S('Class:IPSubnet/Tab:ipregistered'));
				$oP->p(MetaModel::GetClassIcon('IPv6Address').'&nbsp;'.Dict::S('Class:IPSubnet/Tab:ipregistered+'));
				$oP->p(Dict::S('UI:NoObjectToDisplay'));
			}

			// Tab for IP Ranges
			$oIpRangeSearch = DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = :key", array('key' => $iKey));
			$oIpRangeSet = new CMDBObjectSet($oIpRangeSearch);
			$iIpRange = $oIpRangeSet->Count();
			if ($iIpRange > 0)
			{
				$iCountRange = 0;
				while ($oIpRange = $oIpRangeSet->Fetch())
				{
					$iCountRange += $oIpRange->GetSize();
				}
				$oP->SetCurrentTab(Dict::Format('Class:IPSubnet/Tab:iprange').' ('.$iIpRange.')');
				$oP->p(MetaModel::GetClassIcon('IPv6Range').'&nbsp;'.Dict::Format('Class:IPSubnet/Tab:iprange+'));
				$oP->p($this->GetAsHTML('range_occupancy').Dict::Format('Class:IPSubnet/Tab:iprange-count-percent'));
				$oBlock = new DisplayBlock($oIpRangeSearch, 'list');
				$oBlock->Display($oP, 'ip_ranges', $aExtraParams);
			}
			else
			{
				$oP->SetCurrentTab(Dict::S('Class:IPSubnet/Tab:iprange'));
				$oP->p(MetaModel::GetClassIcon('IPv6Range').'&nbsp;'.Dict::S('Class:IPSubnet/Tab:iprange+'));
				$oP->p(Dict::S('UI:NoObjectToDisplay'));
			}

			// Tab for related subnet requests, if any, in non edit mode
			if	(MetaModel::IsValidClass('IPRequestSubnet'))
			{
				$oSubnetRequestSearch = DBObjectSearch::FromOQL("SELECT IPRequestSubnet AS r WHERE r.subnet_id = $iKey");
				$oSubnetRequestSet = new CMDBObjectSet($oSubnetRequestSearch);
				$sCount = $oSubnetRequestSet->Count();
				if ($sCount > 0)
				{
					$oP->SetCurrentTab(Dict::Format('Class:IPSubnet/Tab:requests').' ('.$sCount.')');
					$oP->p(MetaModel::GetClassIcon('IPRequestSubnet').'&nbsp;'.Dict::Format('Class:IPSubnet/Tab:requests+'));
					$oBlock = new DisplayBlock($oSubnetRequestSearch, 'list');
					$oBlock->Display($oP, 'subnet_requests', $aExtraParams);
				}
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
		if ($iOrgId > 0)
		{
			if ($sBitMask != '128')
			{
				$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv6_gateway_ip_format', $iOrgId);
				switch ($sGatewayIPFormat)
				{
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
			}
			else
			{
				$oGatewayIp = $oIp;
			}
		}
		else
		{
			$oFirstIpFromMask = new ormIPv6('::1');
			$oGatewayIp = $oIp->BitwiseOr($oFirstIpFromMask);
		}
		$this->Set('gatewayip', $oGatewayIp);


		// Set parent block if not set
		// Note: this may give incorrect result if only one block exists under the organization since, in such case, framework preset block_id to that unique block as block_id cannot be null
		if (($oIp != null) && ($oMask != null))
		{
			// Look for all blocks containing the new subnet
			// Pick the smallest one
			$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Block AS b WHERE b.org_id = :org_id"), array(), array('org_id' => $iOrgId));
			$iMinSize = 0;
			$iBlockId = 0;
			while ($oSRange = $oSRangeSet->Fetch())
			{
				$oCurrentFirstIp = $oSRange->Get('firstip');
				$oCurrentLastIp = $oSRange->Get('lastip');
				if ($oCurrentFirstIp->IsSmallerOrEqual($oIp) && $oLastIp->IsSmallerOrEqual($oCurrentLastIp))
				{
					$iSRangeSize = $oSRange->GetSize();
					if (($iMinSize == 0) || ($iSRangeSize < $iMinSize))
					{
						$iMinSize = $iSRangeSize;
						$iBlockId = $oSRange->GetKey();
					}
				}
			}
			if ($iBlockId != 0)
			{
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
		if ($this->IsNew())
		{
			$iKey = -1;
		}
		else
		{
			$iKey = $this->GetKey();
		}
		$oIp = $this->Get('ip');
		$sBitMask = $this->Get('mask');
		$oLastIp = $this->Get('lastip');
		$iBlockId = $this->Get('block_id');
		
		// Forbid change of subnet IP and subnet mask
		$oSubnet = MetaModel::GetObject('IPv6Subnet', $iKey, false /* MustBeFound */);
		if (!is_null($oSubnet))
		{
			if ($oIp != $oSubnet->Get('ip'))
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:IpCannotChange');
				return;
			}
			if ($sBitMask != $oSubnet->Get('mask'))
			{
			 	$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:MaskCannotChange');
			 	return;
			}
		}
		
		// Check consistency between subnet IP and mask. IP must be aligned with block defined by mask.
		if (!$this->DoCheckCIDRAligned())
		{
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:IpIncorrect');
			return;
		}	 
		
		// Make sure subnet is fully contained in block
		$oBlock = MetaModel::GetObject('IPv6Block', $iBlockId, true /* MustBeFound */);
		$oBlockFirstIp = $oBlock->Get('firstip');
		$oBlockLastIp = $oBlock->Get('lastip');
		if ($oIp->IsSmallerStrict($oBlockFirstIp) || $oBlockLastIp->IsSmallerStrict($oLastIp))
		{
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:NotInBlock');
			return;
		}
		
		// Make sure subnet doesn't collide with another subnet
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.block_id = :block_id AND s.org_id = :org_id AND s.id != :key"), array(), array('block_id' => $iBlockId, 'org_id' => $iOrgId, 'key' => $iKey));
		while ($oSubnet = $oSubnetSet->Fetch())
		{
			$oCurrentIp = $oSubnet->Get('ip');
			$oCurrentLastIp = $oSubnet->Get('lastip');
			
			// Does the subnet already exist?
			if ($oCurrentIp->IsEqual($oIp) && $oCurrentLastIp->IsEqual($oLastIp))
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision0');
				return;
			}
			// Is the subnet IP part of an existing subnet?
			if ($oCurrentIp->IsSmallerOrEqual($oIp) && $oIp->IsSmallerOrEqual($oCurrentLastIp))
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision1');
				return;
			}
			// Is the last IP part of an existing subnet?
			if ($oCurrentIp->IsSmallerOrEqual($oLastIp) && $oLastIp->IsSmallerOrEqual($oCurrentLastIp))
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision2');
				return;
			}
			// Is new subnet including an existing one?
			if ($oIp->IsSmallerStrict($oCurrentIp) && $oCurrentLastIp->IsSmallerStrict($oLastIp))
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision3');
				return;
			}
		}
		
		// If allocation of Gateway Ip is free, make sure it is contained in subnet
		$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv6_gateway_ip_format', $iOrgId);
		if ($sGatewayIPFormat == 'free_setup')
		{
			$oGatewayIp = $this->Get('gatewayip');
			if (! $this->DoCheckIpInSubnet($oGatewayIp))
			{
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
		if ($sBitMask != '128')
		{
			$sReserveSubnetIPs = utils::ReadPostedParam('attr_reserve_subnet_IPs', '');
			if (empty($sReserveSubnetIPs))
			{
				$sReserveSubnetIPs = IPConfig::GetFromGlobalIPConfig('reserve_subnet_IPs', $iOrgId);
			}
			if ($sReserveSubnetIPs == 'reserve_yes')
			{
				// Create or update subnet IP
				$sUsageNetworkIpId = IPUsage::GetIpUsageId($iOrgId, NETWORK_IP_CODE);
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv6Address AS i WHERE i.ip_text = :subnetip AND i.org_id = :org_id", array('subnetip' => $sSubnetIp, 'org_id' => $iOrgId), false);
				if (is_null($oIp))
				{
					$oIp = MetaModel::NewObject('IPv6Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $oSubnetIp);
					$oIp->Set('org_id', $iOrgId);
					$oIp->Set('status', 'reserved');
					$oIp->Set('usage_id', $sUsageNetworkIpId);
					$oIp->DBInsert();
				}
				else
				{
					if (($oIp->Get('status') != 'reserved') || ($oIp->Get('usage_id') != $sUsageNetworkIpId))
					{
						$oIp->Set('subnet_id', $iId);
						$oIp->Set('status', 'reserved');
						$oIp->Set('usage_id', $sUsageNetworkIpId);
						$oIp->DBUpdate();
					}
				}

				if ($sBitMask != '127')
				{
					// Create or update gateway IP
					$sUsageGatewayIpId = IPUsage::GetIpUsageId($iOrgId, GATEWAY_IP_CODE);
					$oIp = MetaModel::GetObjectFromOQL("SELECT IPv6Address AS i WHERE i.ip_text = :gatewayip AND i.org_id = :org_id", array('gatewayip' => $sGatewayIp, 'org_id' => $iOrgId), false);
					if (is_null($oIp))
					{
						$oIp = MetaModel::NewObject('IPv6Address');
						$oIp->Set('subnet_id', $iId);
						$oIp->Set('ip', $oGatewayIp);
						$oIp->Set('org_id', $iOrgId);
						$oIp->Set('status', 'reserved');
						$oIp->Set('usage_id', $sUsageGatewayIpId);
						$oIp->DBInsert();
					}
					else
					{
						if (($oIp->Get('status') != 'reserved') || ($oIp->Get('usage_id') != $sUsageGatewayIpId))
						{
							$oIp->Set('subnet_id', $iId);
							$oIp->Set('status', 'reserved');
							$oIp->Set('usage_id', $sUsageGatewayIpId);
							$oIp->DBUpdate();
						}
					}
				}
			}
		}
	
		// Make sure all IPs belonging to subnet are attached to it
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :ip <= i.ip_text AND i.ip_text <= :lastip AND i.org_id = :org_id",  array('ip' => $sSubnetIp, 'lastip' => $sLastIp, 'org_id' => $iOrgId)));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch())
		{
			if ($oIpRegistered->Get('subnet_id') != $iId)
			{
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
		$sGatewayIp = $oGatewayIp->GetAsCompressed();
		$sLastIp = $this->Get('lastip')->GetAsCompressed();
		$sReserveSubnetIPs = IPConfig::GetFromGlobalIPConfig('reserve_subnet_IPs', $iOrgId);
		
		if (($sReserveSubnetIPs == 'reserve_yes') && ($sBitMask != '128'))
		{
			// Create or update subnet IP
			$sUsageNetworkIpId = IPUsage::GetIpUsageId($iOrgId, NETWORK_IP_CODE);
			$oIp = MetaModel::GetObjectFromOQL("SELECT IPv6Address AS i WHERE i.ip = :subnetip AND i.org_id = :org_id", array('subnetip' => $sSubnetIp, 'org_id' => $iOrgId), null, false);
			if (is_null($oIp))
			{
				$oIp = MetaModel::NewObject('IPv6Address');
				$oIp->Set('subnet_id', $iId);
				$oIp->Set('ip', $oSubnetIp);
				$oIp->Set('org_id', $iOrgId);
				$oIp->Set('status', 'reserved');
				$oIp->Set('usage_id', $sUsageNetworkIpId);
				$oIp->DBInsert();
			}
			else
			{
				if (($oIp->Get('status') != 'reserved') || ($oIp->Get('usage_id') != $sUsageNetworkIpId))
				{
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('status', 'reserved');
					$oIp->Set('usage_id', $sUsageNetworkIpId);
					$oIp->DBUpdate();
				}
			}
			
			// Create or update gateway IP
			$sUsageGatewayIpId = IPUsage::GetIpUsageId($iOrgId, GATEWAY_IP_CODE);
			$oIp = MetaModel::GetObjectFromOQL("SELECT IPv6Address AS i WHERE i.ip = :gatewayip AND i.org_id = :org_id", array('gatewayip' => $sSubnetIp, 'org_id' => $iOrgId), false);
			if (is_null($oIp))
			{
				$oIp = MetaModel::NewObject('IPv6Address');
				$oIp->Set('subnet_id', $iId);
				$oIp->Set('ip', $oGatewayIp);
				$oIp->Set('org_id', $iOrgId);
				$oIp->Set('status', 'reserved');
				$oIp->Set('usage_id', $sUsageGatewayIpId);
				$oIp->DBInsert();
			}
			else
			{
				if (($oIp->Get('status') != 'reserved') || ($oIp->Get('usage_id') != $sUsageGatewayIpId)) 
				{
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('status', 'reserved');
					$oIp->Set('usage_id', $sUsageGatewayIpId);
					$oIp->DBUpdate();
				}
			}
		}
		
		// Make sure all IPs belonging to subnet are attached to it
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :ip <= i.ip AND i.ip <= :lastip AND i.org_id = :org_id",  array('ip' => $sSubnetIp, 'lastip' => $sLastIp, 'org_id' => $iOrgId)));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch())
		{
			if ($oIpRegistered->Get('subnet_id') != $iId)
			{
				$oIpRegistered->Set('subnet_id', $iId);
				$oIpRegistered->DBUpdate();	
			}
		}

		// Release all subnet's IPs when subnet is released
		if (($this->Get('status') == 'released') && ($this->GetOriginal('status') != 'released'))
		{
			$sIpRelease = IPConfig::GetFromGlobalIPConfig('ip_release_on_subnet_release',$iOrgId);
			if ($sIpRelease == 'yes')
			{
				$sOQL = "SELECT IPv6Address WHERE subnet_id = :id AND status != 'released'";
				$oIpAddressesSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('id' => $iId));
				while ($oIpAddress = $oIpAddressesSet->Fetch())
				{
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
		if ($sBitMask != '128')
		{
			$oIpAddress = MetaModel::GetObjectFromOQL("SELECT IPv6Address AS i WHERE i.ip = :ip AND i.org_id = :org_id", array('ip' => $sIp, 'org_id' => $iOrgId), false);
			if (!is_null($oIpAddress))
			{
				$oDeletionPlan->AddToDelete($oIpAddress, DEL_AUTO);
			}
			
			$oIpAddress = MetaModel::GetObjectFromOQL("SELECT IPv6Address AS i WHERE i.ip = :lastip AND i.org_id = :org_id", array('lastip' => $sLastIp, 'org_id' => $iOrgId), false);
			if (!is_null($oIpAddress))
			{
				$oDeletionPlan->AddToDelete($oIpAddress, DEL_AUTO);
			}
		}
	}
	
	/**
	 * Change flag of attributes that shouldn't be modified beside creation.
	 *
	 * @param $sAttCode
	 * @param array $aReasons
	 * @param string $sTargetState
	 *
	 * @return int
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		if ((!$this->IsNew()) && (($sAttCode == 'org_id') || ($sAttCode == 'block_id') || ($sAttCode == 'ip') || ($sAttCode == 'mask') || ($sAttCode == 'lastip') || ($sAttCode == 'ip_occupancy') || ($sAttCode == 'range_occupancy')))
		{
			return OPT_ATT_READONLY;
		}
		if ((!$this->IsNew()) && ($sAttCode == 'gatewayip'))
		{
			$iOrgId = $this->Get('org_id');
			$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv6_gateway_ip_format', $iOrgId);
			if ($sGatewayIPFormat != 'free_setup')
			{
				return OPT_ATT_READONLY;
			}
		}
		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}

	/**
	 * @param $iPrefix
	 *
	 * @return string
	 */
	public function BitToMask($iPrefix)
	{
		// Provides size of subnet according to dotted string mask
		switch ($iPrefix)
		{
			case '64':  return "FFFF:FFFF:FFFF:FFFF::";
			case '65':  return "FFFF:FFFF:FFFF:FFFF:8000::";
			case '66':  return "FFFF:FFFF:FFFF:FFFF:C000::";
			case '67':  return "FFFF:FFFF:FFFF:FFFF:E000::";
			case '71':  return "FFFF:FFFF:FFFF:FFFF:FE00::";
			case '72':  return "FFFF:FFFF:FFFF:FFFF:FF00::";
			case '73':  return "FFFF:FFFF:FFFF:FFFF:FF80::";
			case '74':  return "FFFF:FFFF:FFFF:FFFF:FFC0::"; 
			case '68':  return "FFFF:FFFF:FFFF:FFFF:F000::";
			case '69':  return "FFFF:FFFF:FFFF:FFFF:F800::";
			case '70':  return "FFFF:FFFF:FFFF:FFFF:FC00::";
			case '75':  return "FFFF:FFFF:FFFF:FFFF:FFE0::";
			case '76':  return "FFFF:FFFF:FFFF:FFFF:FFF0::";
			case '77':  return "FFFF:FFFF:FFFF:FFFF:FFF8::";
			case '78':  return "FFFF:FFFF:FFFF:FFFF:FFFC::";
			case '79':  return "FFFF:FFFF:FFFF:FFFF:FFFE::";
			case '80':  return "FFFF:FFFF:FFFF:FFFF:FFFF::";
			case '81':  return "FFFF:FFFF:FFFF:FFFF:FFFF:8000::";
			case '82':  return "FFFF:FFFF:FFFF:FFFF:FFFF:C000::";
			case '83':  return "FFFF:FFFF:FFFF:FFFF:FFFF:E000::";
			case '84':  return "FFFF:FFFF:FFFF:FFFF:FFFF:F000::";
			case '85':  return "FFFF:FFFF:FFFF:FFFF:FFFF:F800::";
			case '86':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FC00::";
			case '87':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FE00::";
			case '88':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FF00::";
			case '89':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FF80::";
			case '90':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FFC0::";
			case '91':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FFE0::";
			case '92':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FFF0::";
			case '93':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FFF8::";
			case '94':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFC::";
			case '95':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFE::";
			case '96':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF::";
			case '97':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:8000:0";
			case '98':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:C000:0";
			case '99':  return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:E000:0";
			case '100': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:F000:0";
			case '101': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:F800:0";
			case '102': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FC00:0";
			case '103': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FE00:0";
			case '104': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FF00:0";
			case '105': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FF80:0";
			case '106': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFC0:0";
			case '107': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFE0:0";
			case '108': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFF0:0";
			case '109': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFF8:0";
			case '110': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFC:0";
			case '111': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFE:0";
			case '112': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:0";
			case '113': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:8000";
			case '114': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:C000";
			case '115': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:E000";
			case '116': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:F000";
			case '117': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:F800";
			case '118': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FC00";
			case '119': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FE00";
			case '120': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FF00";
			case '121': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FF80";
			case '122': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFC0";
			case '123': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFE0";
			case '124': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFF0";
			case '125': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFF8";
			case '126': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFC";
			case '127': return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFE";
			case '128': 
			default:	return "FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF";
		}
	}
	
}
