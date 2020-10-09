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
																		   
class _IPv4Subnet extends IPSubnet
{
	/**
	 * Return standard icon or extra small one
	 */	 
	public function GetIcon($bImgTag = true, $bXsIcon = false)
	{
		if ($bXsIcon)
		{
			$sIcon = utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/images/ipsubnet-xs.png';
		}
		else
		{
			$sIcon = utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/images/ipsubnet.png';
		}
		return ("<img src=\"$sIcon\" style=\"vertical-align:middle;\"/>");
	}
	
	/**
	 * Returns size of subnet
	 */
	public function GetSize()
	{
		$iIp = myip2long($this->Get('ip'));
		$sMask = $this->Get('mask');
		
		return $this->MaskToSize($sMask);
	}
	
	/**
	 * Compute % of IP addresses and / or IP ranges in subnet
	 */	 
	public function GetOccupancy($sObject)
	{
		$iOrgId = $this->Get('org_id');

		switch ($sObject)
		{
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
				while ($oIpRange = $oIpRangeSet->Fetch())
				{
					$iSizeRanges += myip2long($oIpRange->Get('lastip')) - myip2long($oIpRange->Get('firstip')) + 1;
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
				while ($oIpRange = $oIpRangeSet->Fetch())
				{
					$sIpRangeFirstIp = $oIpRange->Get('firstip');
					$sIpRangeLastIp = $oIpRange->Get('lastip');
					$oIpRegisteredInRange = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sIpRangeFirstIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpRangeLastIp') AND i.org_id = $iOrgId"));
					$iIpInRanges += $oIpRegisteredInRange->Count();
					$iSizeRanges += myip2long($oIpRange->Get('lastip')) - myip2long($oIpRange->Get('firstip')) + 1;
				}
				return (($oIpRegisteredSet->Count() - $iIpInRanges) / $this->GetSize()) * 100;

			default:
				return 0;
		}
	}

	/**
	 * Automatically get a free IP in the subnet
	 */
	public function GetFreeIP($iCreationOffset)
	{
		$sFirstIp = $this->Get('ip');
		$iFirstIp = myip2long($sFirstIp) + 1;  // Skip subnet IP
		$sLastIp = $this->Get('broadcastip');
		$iLastIp = myip2long($sLastIp);
		if ($iFirstIp + $iCreationOffset >= $iLastIp)
		{
			return '';
		}

		// Get list of registered IPs
		$iKey = $this->GetKey();
		$oIPRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS ip WHERE ip.subnet_id = $iKey"));
		$aIPRegistered = $oIPRegisteredSet->GetColumnAsArray('ip', false);

		// Get list of ranges in Subnet
		$oIPRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = $iKey"));

		$iFirstIp += $iCreationOffset;
		for ($iAnIp = $iFirstIp; $iAnIp < $iLastIp; $iAnIp++)
		{
			$sAnIP = mylong2ip($iAnIp);
			if (!in_array($sAnIP, $aIPRegistered))
			{
				$oIPRangeSet->Rewind();
				$bIsInRange = false;
				while ($oIPRange = $oIPRangeSet->Fetch())
				{
					if ($oIPRange->DoCheckIpInRange($sAnIP))
					{
						$bIsInRange = true;
						$sAnIP = $oIPRange->Get('lastip');
						$iAnIP = myip2long($sAnIP);
						break;
					}
				}
				if (!$bIsInRange)
				{
					return $sAnIP;
				}
			}
		}

		return '';
	}

	/**
	 * Count number of IPs in subnet, in given status
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
				$sOQL = "SELECT IPv4Address AS ip WHERE ip.status = :status AND ip.subnet_id = :key";
				$oIpSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('status' => $sStatus, 'key' => $iKey));
				$iNbIps = $oIpSet->Count();
				return $iNbIps;

			default:
				return 0;
		}
	}

	/**
	 * Find space within the subnet to create range
	 */
	public function GetFreeSpace($iRangeSize, $iMaxOffer)
	{
		$iOrgId = $this->Get('org_id');
		$iKey = $this->GetKey();
		$aFreeSpace = array();
		
		// Get list of registered IPs & ranges in subnet
		$sFirstIp = $this->Get('ip');
		$iFirstIp = myip2long($sFirstIp);
		$sLastIp = $this->Get('broadcastip');
		$iLastIp = myip2long($sLastIp);
		$iSubnetSize = $this->GetSize();
		if ($iRangeSize >= $iSubnetSize)
		{
			// Required range size is to big, exit
			return $aFreeSpace;
		}
		else
		{
			$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sFirstIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sLastIp') AND i.org_id = $iOrgId"));
			$aRegisteredIPs = $oIpRegisteredSet->GetColumnAsArray('ip', false);
			$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = $iKey AND r.org_id = $iOrgId"));
			$aRangeIPs = $oIpRangeSet->GetColumnAsArray('firstip', false);
			
			$iAnIp = $iFirstIp + 1;
			$sAnIp = mylong2ip($iAnIp);
			$n = 0;
			do
			{
				// Find next free IP
				while (in_array($sAnIp, $aRegisteredIPs))
				{
					$iAnIp++;
					$sAnIp = mylong2ip($iAnIp);
				}
				if ($iAnIp < $iLastIp)
				{
					// If free IP belongs to an IP range, skip range
					$oIpRangeSet->Rewind();
					$bContinue = true;
					while ($bContinue && ($oIpRange = $oIpRangeSet->Fetch()))
					{
						if ((myip2long($oIpRange->Get('firstip')) <= $iAnIp) && ($iAnIp <= myip2long($oIpRange->Get('lastip'))))
						{
							$iAnIp = myip2long($oIpRange->Get('lastip')) + 1;
							$sAnIp = mylong2ip($iAnIp);
							$bContinue = false;
						}
					}
					if ($iAnIp < $iLastIp)
					{
						// Make sure we don't have any IP or range until last IP
						$iRangeFirstIp = $iAnIp;
						$i = 0; 
						$bContinue = true;
						while ($bContinue && (!in_array($sAnIp, $aRegisteredIPs)) && ($iAnIp < $iLastIp) && ($i < $iRangeSize))
						{
							if (in_array($sAnIp, $aRangeIPs))
							{
								$bContinue = false;
							}
							else
							{
								$iAnIp++;
								$sAnIp = mylong2ip($iAnIp);
								$i++;
							}
						}
						if ($i == $iRangeSize)
						{
							$aFreeSpace[$n] = array();
							$iRangeLastIp = $iAnIp - 1;
							$aFreeSpace[$n]['firstip'] = mylong2ip($iRangeFirstIp);
							$aFreeSpace[$n]['lastip'] = mylong2ip($iRangeLastIp);
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
	 */
	public function GetIPsAsCSV($aParam)
	{
		// Define first and last IPs to display
		$sFirstIp = $aParam['first_ip'];
		$sSubnetIp = $this->Get('ip');
		if ($sFirstIp == '')
		{
			$sFirstIp = $sSubnetIp;
		}
		$sLastIp = $aParam['last_ip'];
		$sBroadCastIp = $this->Get('broadcastip');
		if ($sLastIp == '')
		{
			$sLastIp = $sBroadCastIp;
		}

		// Get list of registered IPs in range
		$iOrgId = $this->Get('org_id');
		$iFirstIp = myip2long($sFirstIp);
		$iLastIp = myip2long($sLastIp);
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sFirstIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sLastIp')  AND i.org_id = $iOrgId"));
						
		// Get list of IP Ranges in subnet
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE INET_ATON('$sFirstIp') <= INET_ATON(r.firstip) AND INET_ATON(r.lastip) <= INET_ATON('$sLastIp') AND r.org_id = $iOrgId"));
		$iCountRange = $oIpRangeSet->Count();
						
		// List exported parameters
		$sHtml = '"Registered","Id"';
		$aParam = array('org_name', 'ip', 'status', 'fqdn', 'usage_name', 'comment', 'requestor_name', 'release_date');
		if (class_exists('IPDiscovery'))
		{
			$aParam = array_merge($aParam, array('responds_to_ping', 'responds_to_scan', 'responds_to_iplookup', 'fqdn_from_iplookup'));
		}
		foreach($aParam as $sAttCode)
		{
			$sHtml .= ',"'.MetaModel::GetLabel('IPv4Address', $sAttCode).'"';
		}
		$sHtml .= ',"IP Range"'."\n";
						
		// List all IPs of subnet now in IP order 
		$aIpRegistered = $oIpRegisteredSet->GetColumnAsArray('ip', false);
		$iAnIp = $iFirstIp;
		while ($iAnIp <= $iLastIp)
		{
			$sAnIp = mylong2ip($iAnIp);
			if (!in_array($sAnIp, $aIpRegistered))
			{
				$sHtml .= '"no","","","'.$sAnIp.'","free","","","","",""';
				if (class_exists('IPDiscovery'))
				{
					$sHtml .= ',"no","no","no",""';
				}
			}
			else
			{
				$oIpRegisteredSet->Rewind();
				$oIpRegistered = $oIpRegisteredSet->Fetch();  
				while ($sAnIp != $oIpRegistered->Get('ip'))
				{
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
				if (class_exists('IPDiscovery'))
				{
					$sHtml .= ',"'.$oIpRegistered->Get('responds_to_ping').'"';
					$sHtml .= ',"'.$oIpRegistered->Get('responds_to_scan').'"';
					$sHtml .= ',"'.$oIpRegistered->Get('responds_to_iplookup').'"';
					$sHtml .= ',"'.$oIpRegistered->Get('fqdn_from_iplookup').'"';
				}
			}
			// Check if IP belongs to a range or not
			if ($iCountRange != 0)
			{
				$oIpRangeSet->Rewind();
				$oIpRange = $oIpRangeSet->Fetch();
				$iFoundRange = false;
				while (($oIpRange != null) && ($iFoundRange == false))
				{
					if ((myip2long($oIpRange->Get('firstip')) <= $iAnIp) && ($iAnIp <= myip2long($oIpRange->Get('lastip'))))
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
					$sHtml .= ',"'.$oIpRange->Get('range').'"'."\n";
				}
				else
				{
					$sHtml .= ',""'."\n";
				}
			}
			else
			{
				$sHtml .= ',""'."\n";
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
		$iIp = myip2long($sIp);
		$iSubnetIp = myip2long($this->Get('ip'));
		$iBroadcastIp = myip2long($this->Get('broadcastip'));
		if (($iSubnetIp <= $iIp) && ($iIp <= $iBroadcastIp))
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Checks if the subnet is aligned to CIDR borders
	 */
	function DoCheckCIDRAligned()
	{
		$iIp = myip2long($this->Get('ip'));
		$iMask = myip2long($this->Get('mask'));
		
		// Check that FirstIp is CIDR aligned
		// Call to ip2long(long2ip()) is a workaround to handle integers that are above their max size
		if (($iIp & $iMask) != $iIp)
		{
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
		switch ($sOperation)
		{
			case 'findspace':
				if ($this->MaskToBit($sMask) > 28)
				{
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
				if ($this->MaskToBit($sMask) > 30)
				{
					// To small to be shrunk or split. Minimum size is /30
					return ('SizeTooSmall');
				}
			break;
				
			case 'expandsubnet':
				if ($this->MaskToBit($sMask) < 17)
				{
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
		switch ($sOperation)
		{
			case 'shrinksubnet':
			case 'splitsubnet':
				switch ($sMask)
				{
					// A /30 can only be shrunk or split by 2
					case '255.255.255.252': return 1;						
							
					// A /29 can be shrunk or split by 2 or 4
					case '255.255.255.248': return 2;
							
					// A /28 can be shrunk or split by 2, 4 or 8
					case '255.255.255.240': return 3;
							
					// All other subnets can be shrunk or split by 2, 4, 8 or 16
					default: return 4;
				}
					
			case 'expandsubnet':
			default:
				switch ($sMask)
				{
					// A /128 can only be expanded by 2
					case '255.255.128.0.': return 1;
							
					// A /192 can be expanded by 2 or 4
					case '255.255.192.0': return 2;
						
					// A /192 can be expanded by 2, 4 or 8
					case '255.255.224.0': return 3;
							
					// All other subnets can be expanded by 2, 4, 8 or 16
					default: return 4;
				}
		}
	}

	/**
	 * Check if space can be searched
 	 */
	function DoCheckToDisplayAvailableSpace($aParam)
	{
		$iRangeSize = $aParam['rangesize'];
		
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
			$oP->add(Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeTooBig')."<br><br>");
		}
		else
		{
			// Get list of free space in subnet
			$aFreeSpace = $this->GetFreeSpace($iRangeSize, $iMaxOffer);
			
			// Check user rights
			$UserHasRightsToCreate = (UserRights::IsActionAllowed('IPv4Range', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
	
			// Display Summary of parameters
			$oP->add("<ul>\n");
			$oP->add("<li>"."&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Summary', $iMaxOffer, $iRangeSize)."<ul>\n");
			
			// Display possible choices as list
			$iSizeFreeArray = sizeof ($aFreeSpace);
			if ($iSizeFreeArray != 0)
			{
				$i = 0;
				$iVIdCounter = 1;
				do
				{
					$sRangeFirstIp = $aFreeSpace[$i]['firstip'];
					$sRangeLastIp = $aFreeSpace[$i]['lastip'];
					$oP->add("<li>".$sRangeFirstIp." - ".$sRangeLastIp."\n");
					
					// If user has rights to create range
					// Display range with icon to create it
					if  ($UserHasRightsToCreate)
					{
						$iVId = $iVIdCounter++;
						$sHTMLValue = "<ul><li><div><span id=\"v_{$iVId}\">";
						$sHTMLValue .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/images/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
						$sHTMLValue .= "&nbsp;".Dict::Format('UI:IPManagement:Action:DoFindSpace:IPv4Subnet:CreateAsRange')."&nbsp;&nbsp;";
						$sHTMLValue .= "</span></div></li>\n";
						$oP->add($sHTMLValue);
						$oP->add_ready_script(
<<<EOF
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv4Range', $iChangeId, {'org_id': '$iOrgId', 'subnet_id': '$iId', 'firstip': '$sRangeFirstIp', 'lastip': '$sRangeLastIp'});
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
	 */
	function DoCheckToListIps($aParam)
	{
		$sIp = $this->Get('ip');
		$iIp = myip2long($sIp);
		$sBroadcastIp = $this->Get('broadcastip');
		$iBroadcastIp = myip2long($sBroadcastIp);

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '')
		{
			$iFirstIp = myip2long($sFirstIp);
			if (($iFirstIp < $iIp) || ($iBroadcastIp <= $iFirstIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIPOutOfSubnet'));
			}
		}
		
		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '')
		{
			$iLastIp = myip2long($sLastIp);
			if (($iLastIp <= $iIp) || ($iBroadcastIp < $iLastIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv4Subnet:LastIPOutOfSubnet'));
			}
		}
		
		if (($sFirstIp != '') && ($sLastIp != ''))
		{
			if ($iFirstIp > $iLastIp)
			{
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIpBiggerThanLastIp'));
			}
		}
		return '';
	}
	
	/**
	 * Displays list of IP addresses within GUI
	 */
	function DoListIps(WebPage $oP, $iChangeId, $aParam)
	{
		// Add related style sheeet
		$oP->add_linked_stylesheet(utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/teemip-ip-mgmt.css');
						
		// Define first and last IPs to display
		$sFirstIp = $aParam['first_ip'];
		$sSubnetIp = $this->Get('ip');
		if ($sFirstIp == '')
		{
			$sFirstIp = $sSubnetIp;
		}
		$bPrintDummyFirstLine = ($sFirstIp != $sSubnetIp) ? true : false;
		$sLastIp = $aParam['last_ip'];
		$sBroadCastIp = $this->Get('broadcastip');
		if ($sLastIp == '')
		{
			$sLastIp = $sBroadCastIp;
		}
		$bPrintDummyLastLine = ($sLastIp != $sBroadCastIp) ? true : false;
		
		// Get list of registered IPs & Ranges in subnet
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$sMask = $this->Get('mask');
		$iFirstIp = myip2long($sFirstIp);
		$iLastIp = myip2long($sLastIp);
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS ipv4 WHERE INET_ATON('$sFirstIp') <= INET_ATON(ipv4.ip) AND INET_ATON(ipv4.ip) <= INET_ATON('$sLastIp') AND ipv4.org_id = $iOrgId"));
		$aRegisteredIPs = $oIpRegisteredSet->GetColumnAsArray('ip', false);
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS rangev4 WHERE rangev4.subnet_id = $iId"));
		$aRangeIPs = $oIpRangeSet->GetColumnAsArray('firstip', false);
		$oIpRangeSet->Rewind();
			
		// Preset display of name and subnet attributes
		$sHtml = "&nbsp;".Dict::S('Class:IPv4Subnet/Attribute:mask/Value_cidr:'.$sMask)."	 - ".$this->GetLabel('type').': '.$this->GetAsHTML('type');

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
	
		// Display first IP
		$oP->add("<ul>\n");
		$oP->add("<li>".$this->GetIcon(true,true).$this->GetHyperlink().$sHtml."<ul>\n");
	
		// ... and dummy line if display doesn't start at first IP
		if ($bPrintDummyFirstLine)
		{
			$oP->add("<li>&nbsp;&nbsp;...&nbsp;//&nbsp;... </li>");
		}
		
		// Display other IPs as list
		while ($iAnIp <= $iLastIp)
		{
			$sAnIp = mylong2ip($iAnIp);
			if (in_array($sAnIp, $aRangeIPs))
			{ 
				// Found a range within list of IPs
				$oIpRangeSet->Rewind();
				$oIpRange = $oIpRangeSet->Fetch();
				while ($oIpRange->Get('firstip') != $sAnIp)
				{
					$oIpRange = $oIpRangeSet->Fetch();
				}
			    
				// Display name and range attributes
				$sIcon = $oIpRange->GetIcon(true, true);
				$oP->add("<li>".$sIcon.$oIpRange->GetHyperlink()."&nbsp;&nbsp;&nbsp;[".$oIpRange->Get('firstip')." - ".$oIpRange->Get('lastip')."]");
				$oP->add("&nbsp;&nbsp; - ".$oIpRange->GetLabel('usage_id').': '.$oIpRange->GetAsHTML('usage_id')."<ul>\n");
				$iLastRangeIp = myip2long($oIpRange->Get('lastip'));
			}
			if (in_array($sAnIp, $aRegisteredIPs))
			{
				// Found registered IP
				$oIpRegisteredSet->Rewind();
				$oIpRegistered = $oIpRegisteredSet->Fetch();
				while ($oIpRegistered->Get('ip') != $sAnIp)
				{
					$oIpRegistered = $oIpRegisteredSet->Fetch();
				}
				$sHTML = "<li><span class=\"ipv4_address\">&nbsp;".$oIpRegistered->GetHyperlink()."</span>";
				$sHTML .= "<span class=\"ip_status\">".$oIpRegistered->GetAsHTML('status')."</span>";
				$sHTML .= "<span class=\"ip_fqdn\" title=\"".$oIpRegistered->Get('fqdn')."\">".$oIpRegistered->Get('fqdn')."</span>";
				if (class_exists('IPDiscovery'))
				{
					$sHTML .= "<span class=\"ip_ping_img\">";
					if ($oIpRegistered->Get('responds_to_ping') == 'yes')
					{
						$sHTML .= "<img src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-discovery/images/ipmini-ping-xs.png\" style=\"vertical-align:middle\"/>";
					}
					$sHTML .= "</span><span class=\"ip_scan_img\">";
					if ($oIpRegistered->Get('responds_to_scan') == 'yes')
					{
						$sHTML .= "<img src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-discovery/images/ipmini-scan-xs.png\" style=\"vertical-align:middle\"/>";
					}
					$sHTML .= "</span><span class=\"ip_lookup_img\">";
					if ($oIpRegistered->Get('responds_to_iplookup') == 'yes')
					{
						$sHTML .= "<img src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-discovery/images/ipmini-lookup-xs.png\" style=\"vertical-align:middle\"/></span>";
						$sHTML .= "<span class=\"ip_fqdn_lookup\">".$oIpRegistered->GetAsHTML('fqdn_from_iplookup')."</span>";
					}
					$sHTML .= "</span>";
				}
				$sHTML .= "</li>";
				$oP->add($sHTML);
			}
			else
			{
				// If user has rights to create IPs
				// Display unregistered IP with icon to create it
				if  ($UserHasRightsToCreate)
				{
					$iVId = $iVIdCounter++;
					$sHTML = "<li><div><span id=\"v_{$iVId}\">";
					$sHTML .= "<img style=\"border:0;vertical-align:middle;cursor:pointer;\" src=\"".utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/images/ipmini-add-xs.png\" onClick=\"oIpWidget_{$iVId}.DisplayCreationForm();\"/>&nbsp;";
					$sHTML .= "&nbsp;".$sAnIp."&nbsp;&nbsp;";
					$sHTML .= "</span></div></li>";
					$oP->add($sHTML);	
					$oP->add_ready_script(
<<<EOF
					oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv4Address', $iChangeId, {'org_id': '$iOrgId', 'subnet_id': '$iId', 'ip': '$sAnIp', 'status': '$sStatusIp', 'short_name': '$sShortName', 'domain_id': '$iDomainId', 'usage_id': '$iUsageId', 'requestor_id': '$iRequestorId'});
EOF
					);
				}
				else
				{
					$oP->add("<li>".$sAnIp."</li>");
				}
			}
			if ($iAnIp == $iLastRangeIp)
			{
				$oP->add("</ul></li>\n");
			}
			$iAnIp++;
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
	 */
	function DoCheckToCsvExportIps($aParam)
	{
		$sIp = $this->Get('ip');
		$iIp = myip2long($sIp);
		$sBroadcastIp = $this->Get('broadcastip');
		$iBroadcastIp = myip2long($sBroadcastIp);

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '')
		{
			$iFirstIp = myip2long($sFirstIp);
			if (($iFirstIp < $iIp) || ($iBroadcastIp <= $iFirstIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIPOutOfSubnet'));
			}
		}
		
		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '')
		{
			$iLastIp = myip2long($sLastIp);
			if (($iLastIp <= $iIp) || ($iBroadcastIp < $iLastIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:LastIPOutOfSubnet'));
			}
		}
		
		if (($sFirstIp != '') && ($sLastIp != ''))
		{
			if ($iFirstIp > $iLastIp)
			{
				return (Dict::Format('UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIpBiggerThanLastIp'));
			}
		}
		return '';
	}

	/**
	 * Check if calculator inputs are meaningfull
	 */
	function DoCheckCalculatorInputs($aParam)
	{
		$sMask = $aParam['mask'];
		$iCidr = $aParam['cidr'];

		if (($sMask == '') && ($iCidr == ''))
		{
			return (Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:EnterMaskOrCIDR'));
		}

		if (($sMask != '') && ($this->MaskToSize($sMask) == -1))
		{
			return (Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongMask'));
		}
		
		if (($iCidr != '') && (($iCidr <= 0) || ($iCidr > 32)))
		{
			return (Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongCIDR'));
		}
		return '';
	}
	
	/**
	 * Check if subnet can be shrunk
	 */
	function DoCheckToShrink($aParam)
	{
		// Set working variables
		$iSubnetKey = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$sIpSubnetToShrink = $this->Get('ip');
		$iIpSubnetToShrink = myip2long($sIpSubnetToShrink);
		$sMaskSubnetToShrink = $this->Get('mask');
		$iMaskSubnetToShrink = myip2long($sMaskSubnetToShrink);
		$sIpBroadcastSubnetToShrink = $this->Get('broadcastip');
		$iShrink = $aParam['scale_id'];
			
		switch ($sMaskSubnetToShrink)
		{
			case '255.255.255.255':
			case '255.255.255.254':
				// To small to be shrunk. Minimum size is /30
				return (Dict::Format('UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmall'));
			break;
			
			case '255.255.255.252':
				// A /30 can only be shrunk by 2
				if ($iShrink > 2)
				{
					return (Dict::Format('UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy', $iShrink));
				}
			break;
	
			case '255.255.255.248':
				// A /29 can be shrunk by 2 or 4
				if ($iShrink > 4)
				{
					return (Dict::Format('UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy', $iShrink));
				}
			break;
			
			case '255.255.255.240':
				// A /28 can be shrunk by 2, 4 or 8
				if ($iShrink > 8)
				{
					return (Dict::Format('UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy', $iShrink));
				}
			break;
			
			default:
				// All other subnets can be shrunk by 2, 4, 8 or 16
			break;		
		}

		switch($iShrink)
		{
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
		$sMaskNewSubnet = mylong2ip($iMaskNewSubnet);
		$iIpBroadcastNewSubnet = $iIpSubnetToShrink + $this->MaskToSize($sMaskNewSubnet) - 1;
		$sIpBroadcastNewSubnet = mylong2ip($iIpBroadcastNewSubnet);
		
		// Check that no IP range within subnet sits across future border or becomes orphean
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = $iSubnetKey"));
		while ($oIpRange = $oIpRangeSet->Fetch())
		{
			$iIpRangeFirstIp = myip2long($oIpRange->Get('firstip'));
			$iIpRangeLastIp = myip2long($oIpRange->Get('lastip'));
			if (($iIpRangeFirstIp < $iIpBroadcastNewSubnet) && ($iIpRangeLastIp > $iIpBroadcastNewSubnet))
			{
				// IP range sits accross future border
				return (Dict::Format('UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeInTheMiddle', $oIpRange->Get('range'), $oIpRange->Get('firstip'), $oIpRange->Get('lastip')));
			}
			else
			if ($iIpBroadcastNewSubnet <= $iIpRangeFirstIp)
			{
				// IP range is becoming orphean
				return (Dict::Format('UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeDropped', $oIpRange->Get('range'), $oIpRange->Get('firstip'), $oIpRange->Get('lastip')));
			}
		}
				
		// Everything looks good
		return '';
	}
	
	/**
	 * Shrink the subnet
	 */
	function DoShrink($aParam)
	{
		// Set working variables
		$iSubnetKey = $this->GetKey();;
		$iOrgId = $this->Get('org_id');
		$sIpSubnetToShrink = $this->Get('ip');
		$iIpSubnetToShrink = myip2long($sIpSubnetToShrink);
		$sMaskSubnetToShrink = $this->Get('mask');
		$iMaskSubnetToShrink = myip2long($sMaskSubnetToShrink);
		$sIpBroadcastSubnetToShrink = $this->Get('broadcastip');
		$iShrink = $aParam['scale_id'];
		$sRequestor_id = $aParam['requestor_id'];	

		// Update initial subnet and register it.
		if (!is_null($sRequestor_id))
		{
			$this->Set('requestor_id', $sRequestor_id);
		}
		switch($iShrink)
		{
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
		$sMaskNewSubnet = mylong2ip($iMaskNewSubnet);
		$iIpBroadcastNewSubnet = $iIpSubnetToShrink + $this->MaskToSize($sMaskNewSubnet) - 1;
		$sIpBroadcastNewSubnet = mylong2ip($iIpBroadcastNewSubnet);
		$this->Set('mask', $sMaskNewSubnet);
		$this->Set('broadcastip', $sIpBroadcastNewSubnet);
		$this->Set('write_reason', 'shrink');
		$this->DBUpdate();
		
		// Delete old broadcast IP
		// Creation of missing broadcast IP is done by IPv4Subnet::AfterUpdate
		$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sIpBroadcastSubnetToShrink' AND i.org_id = $iOrgId", null, false);
		if (!is_null($oIp))
		{
			$oIp->DBDelete();	
		}
		
		// Get list of all IPs that dropped from subnet and make them point to '0' - orphean IPs.
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sIpBroadcastNewSubnet') < INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcastSubnetToShrink') AND i.org_id = $iOrgId"));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch())
		{
			$oIpRegistered->Set('subnet_id', 0);
			$oIpRegistered->DBUpdate();	
		}
		
		// Return set of subnets to be displayed
		$oSet = CMDBobjectSet::FromArray('IPv4Subnet', array($this));
		return ($oSet);
	}
	
	/**
	 * Check if subnet can be split
	 */
	function DoCheckToSplit($aParam)
	{
		// Set working variables
		$iOrgId = $this->Get('org_id');
		$iSubnetKey = $this->GetKey();
		$sIpSubnetToSplit = $this->Get('ip');
		$iIpSubnetToSplit = myip2long($sIpSubnetToSplit);
		$sMaskSubnetToSplit = $this->Get('mask');
		$iMaskSubnetToSplit = myip2long($sMaskSubnetToSplit);
		$iSplit = $aParam['scale_id'];
	
		switch ($sMaskSubnetToSplit)
		{
			case '255.255.255.255':
			case '255.255.255.254':
				// To small to be split. Minimum size is /30
				return (Dict::Format('UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmall'));
			break;
			
			case '255.255.255.252':
				// A /30 can only be split by 2
				if ($iSplit > 2)
				{
					return (Dict::Format('UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy', $iSplit));
				}
			break;
			
			case '255.255.255.248':
				// A /29 can be split by 2 or 4
				if ($iSplit > 4)
				{
					return (Dict::Format('UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy', $iSplit));
				}
			break;
			
			case '255.255.255.240':
				// A /28 can be split by 2, 4 or 8
				if ($iSplit > 8)
				{
					return (Dict::Format('UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy', $iSplit));
				}
			break;
			
			default:
				// All other subnets can be split by 2, 4, 8 or 16
			break;		
		}

		switch($iSplit)
		{
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
		$sMaskNewSubnet = mylong2ip($iMaskNewSubnet);
		$iSizeNewSubnet = $this->MaskToSize($sMaskNewSubnet);
		
		// Check that no IP range within subnet sits across future borders
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = $iSubnetKey"));
		while ($oIpRange = $oIpRangeSet->Fetch())
		{
			$iIpRangeFirstIp = myip2long($oIpRange->Get('firstip'));
			$iIpRangeLastIp = myip2long($oIpRange->Get('lastip'));
			$iIpNew = $iIpSubnetToSplit + $iSizeNewSubnet;
			// Find 1st subnet IP after 1st IP of range
			while ($iIpNew <= $iIpRangeFirstIp)
			{
				$iIpNew += $iSizeNewSubnet;
			}
			// If last IP of range not in new subnet boundary, cancel split operation
			if ($iIpNew <= $iIpRangeLastIp) 
			{
				return (Dict::Format('UI:IPManagement:Action:Split:IPv4Subnet:IPRangeInTheMiddle', $oIpRange->Get('range'), $oIpRange->Get('firstip'), $oIpRange->Get('lastip')));
			}
		}
				
		// Everything looks good
		return '';
	}
	
	/**
	 * Split the subnet
	 */
	function DoSplit($aParam)
	{
		// Set working variables
		$iOrgId = $this->Get('org_id');
		$iSubnetKey = $this->GetKey();
		$sIpSubnetToSplit = $this->Get('ip');
		$iIpSubnetToSplit = myip2long($sIpSubnetToSplit);
		$sMaskSubnetToSplit = $this->Get('mask');
		$iMaskSubnetToSplit = myip2long($sMaskSubnetToSplit);
		$iSplit = $aParam['scale_id'];
		$sRequestor_id = $aParam['requestor_id'];	

		switch($iSplit)
		{
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
		$sMaskNewSubnet = mylong2ip($iMaskNewSubnet);
		$iSizeNewSubnet = $this->MaskToSize($sMaskNewSubnet);		
	
		// Update initial subnet and register it.
		if (!is_null($sRequestor_id))
		{
			$this->Set('requestor_id', $sRequestor_id);
		}
		$this->Set('mask', $sMaskNewSubnet);
		$this->Set('broadcastip', mylong2ip($iIpSubnetToSplit + $iSizeNewSubnet - 1));
		$this->Set('write_reason', 'split');
		$this->DBUpdate();
		
		// Create ($iSplit - 1) new split subnet in continuity of 1st one
		// Copy all parameters from 1st subnet but IP and mask
		// IP = First IP + (0x0...010...0)*$i - 1 is last bit of new mask
		// Ex 10.1.192.0 = 10.1.0.0 + (0.0.192.0)
		$oNewObj = array();
		$oNewObj[0] = $this;
		$iIpNew = $iIpSubnetToSplit + $iSizeNewSubnet;
		$sBlockId = $this->Get('block_id');
		$sStatus = $this->Get('status');
		$sType = $this->Get('type');
		$sComment = $this->Get('comment');
		$sRequestor_id = $this->Get('requestor_id');
		for ($i = 1; $i < $iSplit; $i++)
		{
			$oNewObj[$i] = MetaModel::NewObject('IPv4Subnet');
			$oNewObj[$i]->Set('org_id', $iOrgId);
			$oNewObj[$i]->Set('ip', mylong2ip($iIpNew));	
			$oNewObj[$i]->Set('mask', $sMaskNewSubnet);
			$oNewObj[$i]->Set('broadcastip', mylong2ip($iIpNew + $iSizeNewSubnet - 1));
			$oNewObj[$i]->Set('block_id', $sBlockId);
			$oNewObj[$i]->Set('status', $sStatus);
			$oNewObj[$i]->Set('type', $sType);
			$oNewObj[$i]->Set('comment', $sComment);
			$oNewObj[$i]->Set('requestor_id', $sRequestor_id);
			$oNewObj[$i]->DBInsert();
			$iIpNew += $iSizeNewSubnet;
		}
		
		// Link subnets to same locations as original subnet
		// Get list of 'lnkIPSubnetToLocation' objects referencing original subnet (if any))
		// Create as many 'lnkIPSubnetToLocation' objects for each new subnet and set parameters.
		$oSubnetToLocationSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT lnkIPSubnetToLocation AS l WHERE l.ipsubnet_id = $iSubnetKey"));
		while ($oSubnetToLocation = $oSubnetToLocationSet->Fetch())
		{
			for ($i = 1; $i < $iSplit; $i++)
			{
				$oNewLocationLink = MetaModel::NewObject('lnkIPSubnetToLocation');
				$oNewLocationLink->Set('ipsubnet_id', $oNewObj[$i]->GetKey());
				$oNewLocationLink->Set('location_id', $oSubnetToLocation->Get('location_id'));
				$oNewLocationLink->DBInsert();
			}
		}
		
		// Update ranges (if any) with new subnet parameter
		$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = $iSubnetKey"));
		while ($oIpRange = $oIpRangeSet->Fetch())
		{
			$iIpRangeFirstIp = myip2long($oIpRange->Get('firstip'));
			$iIpRangeLastIp = myip2long($oIpRange->Get('lastip'));
			$iIpNew = $iIpSubnetToSplit;
			while ($iIpRangeLastIp >= ($iIpNew + $iSizeNewSubnet))
			{
				$iIpNew += $iSizeNewSubnet;
			}
			// Find subnet in array of newly created subnets
			$sIpNew = mylong2ip($iIpNew);
			for ($i = 0; (($i < $iSplit) && ($oNewObj[$i]->Get('ip') != $sIpNew)); $i++) {}
			$oIpRange->Set('subnet_id', $oNewObj[$i]->GetKey());
			$oIpRange->DBUpdate();
		}
		
		// Creation of missing broadcast and subnet IPs is done by IPv4Subnet::AfterInsert or IPv4Subnet::AfterUpdate
		
		// Set IPs in correct subnet
		for ($i = 1; $i < $iSplit; $i++)
		{
			$iSubnetKey	= $oNewObj[$i]->GetKey();
			$sIpSubnet = $oNewObj[$i]->Get('ip');
			$sIpBroadcastSubnet = $oNewObj[$i]->Get('broadcastip');
			$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sIpSubnet') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcastSubnet') AND i.org_id = $iOrgId"));
			while ($oIpRegistered = $oIpRegisteredSet->Fetch())
			{
				if ($oIpRegistered->Get('subnet_id') != $iSubnetKey)
				{
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
	 */
	function DoCheckToExpand($aParam)
	{
		// Set working variables
		$iOrgId = $this->Get('org_id');
		$sIpSubnetToExpand = $this->Get('ip');
		$iIpSubnetToExpand = myip2long($sIpSubnetToExpand);
		$sMaskSubnetToExpand = $this->Get('mask');
		$iMaskSubnetToExpand = myip2long($sMaskSubnetToExpand);
		$iExpand = $aParam['scale_id'];
		
		// Confirm that subnet can be expanded as requested (protection against forged urls)
		if (($iMaskSubnetToExpand & myip2long('0.127.255.255')) == 0)
		{
			// To big to be expanded. Maximum size is /17 (by choice - bigger doesn't make sense))
			return (Dict::Format('UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy', $iExpand));
		}
		switch ($sMaskSubnetToExpand)
		{
			case '255.255.128.0.':
				// A /128 can only be expanded by 2
				if ($iExpand > 2)
				{
					return (Dict::Format('UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy', $iExpand));
				}			
			break;
					
			case '255.255.192.0':
				// A /192 can be expanded by 2 or 4
				if ($iExpand > 4)
				{
					return (Dict::Format('UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy', $iExpand));
				}			
			break;
			
			case '255.255.224.0':
				// A /192 can be expanded by 2, 4 or 8
				if ($iExpand > 8)
				{
					return (Dict::Format('UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy', $iExpand));
				}			
			break;
					
			default:
				// All other subnets can be expanded by 2, 4, 8 or 16
			break; 
		}

		switch($iExpand)
		{
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
		$sMaskNewSubnet = mylong2ip($iMaskNewSubnet);
		$iIpNewSubnet = myip2long(long2ip(ip2long(long2ip($iIpSubnetToExpand)) & ip2long(long2ip($iMaskNewSubnet))));
		$sIpNewSubnet = mylong2ip($iIpNewSubnet);
		$iIpBroadcastNewSubnet = $iIpNewSubnet + $this->MaskToSize($sMaskNewSubnet) - 1;
		$sIpBroadcastNewSubnet = mylong2ip($iIpBroadcastNewSubnet);
		
		// Check that new subnet is fully contained within its block. If not, cancell the action
		$oBlock = MetaModel::GetObject('IPv4Block', $this->Get('block_id'), true /* MustBeFound */);
		$sBlockLastIp = $oBlock->Get('lastip');
		$iBlockLastIp = myip2long($sBlockLastIp);
		if (($iIpNewSubnet < myip2long($oBlock->Get('firstip'))) || ($iBlockLastIp < $iIpBroadcastNewSubnet))
		{
			return (Dict::Format('UI:IPManagement:Action:Expand:IPv4Subnet:NotInIPBlock'));
		}

				
		// Everything looks good
		return '';
	}
	
	/**
	 * Expand the subnet
	 */
	function DoExpand($aParam)
	{
		// Set working variables
		$iOrgId = $this->Get('org_id');
		$iNewSubnetKey = $this->GetKey();
		$sIpSubnetToExpand = $this->Get('ip');
		$iIpSubnetToExpand = myip2long($sIpSubnetToExpand);
		$sMaskSubnetToExpand = $this->Get('mask');
		$iMaskSubnetToExpand = myip2long($sMaskSubnetToExpand);
		$iExpand = $aParam['scale_id'];
		$sRequestor_id = $aParam['requestor_id'];	

		switch($iExpand)
		{
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
		$sMaskNewSubnet = mylong2ip($iMaskNewSubnet);
		$iIpNewSubnet = myip2long(long2ip(ip2long(long2ip($iIpSubnetToExpand)) & ip2long(long2ip($iMaskNewSubnet))));
		$sIpNewSubnet = mylong2ip($iIpNewSubnet);
		$iIpBroadcastNewSubnet = $iIpNewSubnet + $this->MaskToSize($sMaskNewSubnet) - 1;
		$sIpBroadcastNewSubnet = mylong2ip($iIpBroadcastNewSubnet);
		
		// List subnets currently in range of new subnet and delete them all but the one newly updated one
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE INET_ATON(s.ip) >= INET_ATON('$sIpNewSubnet') AND INET_ATON(s.ip) <= INET_ATON('$sIpBroadcastNewSubnet') AND s.org_id = $iOrgId"));
		$CreateNew = true;
		while ($oSubnet = $oSubnetSet->Fetch()) // While there is a subnet in the list
		{
			$iSubnetKey = $oSubnet->GetKey();
			
			// If current subnet and initial subnet are not the same
			if ($iSubnetKey != $iNewSubnetKey)
			{
				// Find all links to locations and delete them first
				$oSubnetToLocationSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT lnkIPSubnetToLocation AS l WHERE l.ipsubnet_id = $iSubnetKey"));
				while ($oSubnetToLocation = $oSubnetToLocationSet->Fetch())
				{
					$oSubnetToLocation->DBDelete();
				}
				
				// Find all IP Ranges attached to legacy subnet and attach them to new one
				$oSubnetRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = $iSubnetKey"));
				while ($oRange = $oSubnetRangeSet->fetch())
				{
					$oRange->Set('write_reason', 'expand');
					$oRange->Set('subnet_id', $iNewSubnetKey);
					$oRange->DBUpdate();
				}
			
				// Find all subnet request tickets attached to legacy subnet and remove reference to subnet
				if	(MetaModel::IsValidClass('IPRequestSubnet'))
				{
					$oSubnetRequestSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPRequestSubnet AS r WHERE r.subnet_id = $iSubnetKey"));
					while ($oSubnetRequest = $oSubnetRequestSet->fetch())
					{
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
		if (!is_null($sRequestor_id))
		{
			$this->Set('requestor_id', $sRequestor_id);
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
		while ($oIp = $oIpSubnetSet->Fetch())
		{
			if ($oIp->Get('ip') != $sIpNewSubnet)
			{
				$oIp->DBDelete();	
			}
		}
		
		// List Gateway IPs in new subnet. Delete them all but the new broadcast IP if any
		// Creation of broadcast IP is done by IPv4Subnet::AfterUpdate()
		$sIpGatewayIpNewSubnet = $this->Get('gatewayip');
		$sUsageGatewayIpId = IPUsage::GetIpUsageId($iOrgId, GATEWAY_IP_CODE);
		$oGatewayIPSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE i.usage_id = $sUsageGatewayIpId AND INET_ATON(i.ip) >= INET_ATON('$sIpNewSubnet') AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcastNewSubnet') AND i.org_id = $iOrgId"));
		while ($oIp = $oGatewayIPSet->Fetch())
		{
			if ($oIp->Get('ip') != $sIpGatewayIpNewSubnet)
			{
				$oIp->DBDelete();	
			}
		}
		
		// List Broadcast IPs in new subnet. Delete them all but the new broadcast IP if any
		// Creation of broadcast IP is done by IPv4Subnet::AfterUpdate()
		$sUsageBroadcastIpId = IPUsage::GetIpUsageId($iOrgId, BROADCAST_IP_CODE);
		$oBroadcastSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE i.usage_id = $sUsageBroadcastIpId AND INET_ATON(i.ip) >= INET_ATON('$sIpNewSubnet') AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcastNewSubnet') AND i.org_id = $iOrgId"));
		while ($oIp = $oBroadcastSet->Fetch())
		{
			if ($oIp->Get('ip') != $sIpBroadcastNewSubnet)
			{
				$oIp->DBDelete();	
			}
		}
		
		// Get list of all IPs within new subnet and make sure they all point to new subnet.
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sIpNewSubnet') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcastNewSubnet') AND i.org_id = $iOrgId"));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch())
		{
			if ($oIpRegistered->Get('subnet_id') != $iNewSubnetKey)
			{
				$oIpRegistered->Set('subnet_id', $iNewSubnetKey);
				$oIpRegistered->DBUpdate();	
			}
		}
		
		// Display result as array
		if ($sIpSubnetToExpand != $sIpNewSubnet)
		{
			// Otherwise wrong subnet IP is displayed in array...
			$oObj = MetaModel::GetObject('IPv4Subnet', $iNewSubnetKey, true /* MustBeFound */);
			$oSet = CMDBobjectSet::FromArray('IPv4Subnet', array($oObj));
		}
		else
		{
			$oSet = CMDBobjectSet::FromArray('IPv4Subnet', array($this));
		}
		return ($oSet);
	}
	
	/**
	 * Display attributes associated operation
	 */
	function DisplayMainAttributesForOperation(WebPage $oP, $sOperation, $iFormId, $sPrefix, $aDefault)
	{
		$sLabelOfAction = Dict::S($this->MakeUIPath($sOperation).'Summary');
		$oP->SetCurrentTab($sLabelOfAction);

		$oP->add('<table style="vertical-align:top"><tr>');
		$oP->add('<td style="vertical-align:top">');	
		$aDetails = array();
		
		// Subnet Range
		$sDisplayValue = $this->GetAsHTML('block_id');	
		$aDetails[] = array('label' => '<span title="'.MetaModel::GetDescription('IPv4Subnet', 'block_id').'">'.MetaModel::GetLabel('IPv4Subnet', 'block_id').'</span>', 'value' => $sDisplayValue);
		
		// Subnet IP
		$sDisplayValue = $this->GetAsHTML('ip');	
		$aDetails[] = array('label' => '<span title="'.MetaModel::GetDescription('IPv4Subnet', 'ip').'">'.MetaModel::GetLabel('IPv4Subnet', 'ip').'</span>', 'value' => $sDisplayValue);
		
		// Mask
		$sDisplayValue = $this->GetAsHTML('mask');	
		$aDetails[] = array('label' => '<span title="'.MetaModel::GetDescription('IPv4Subnet', 'mask').'">'.MetaModel::GetLabel('IPv4Subnet', 'mask').'</span>', 'value' => $sDisplayValue);
		
		// Requestor ID - Can be modified
		$sInputId = $iFormId.'_'.'requestor_id';
		$oAttDef = MetaModel::GetAttributeDef('IPObject', 'requestor_id');
		$sValue = (array_key_exists('requestor_id', $aDefault)) ? $aDefault['requestor_id'] : $this->Get('requestor_id');
		$iFlags = $this->GetAttributeFlags('requestor_id');
		$aArgs = array('this' => $this, 'formPrefix' => $sPrefix);
		$sHTML = "<span id=\"field_{$sInputId}\">".$this->GetFormElementForField($oP, 'IPObject', 'requestor_id', $oAttDef, $sValue, '', $sInputId, '', $iFlags, $aArgs).'</span>';
		$aFieldsMap['requestor_id'] = $sInputId;
		$aDetails[] = array('label' => '<span title="'.$oAttDef->GetDescription().'">'.$oAttDef->GetLabel().'</span>', 'value' => $sHTML);
		
		$oP->Details($aDetails);
		$oP->add('</td>');
		$oP->add('</tr></table>');
	}
	
	/**
	 * Display attributes associated operation
	 */
	function DisplayGlobalAttributesForOperation($oP, $aDefault)
	{
	}
	
	/**
	 * Display attributes associated operation
	 */
	protected function DisplayActionFieldsForOperation(WebPage $oP, $sOperation, $iFormId, $aDefault)
	{
		$oP->add("<table>");
		$oP->add('<tr><td style="vertical-align:top">');
		
		switch ($sOperation)
		{
			case 'findspace':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeOfRange');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:FindSpace:IPv4Subnet:MaxNumberOfOffers');
				
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
				$oP->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"BackToDetails('IPv4Subnet', $iObjId)\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;");
			break;
			
			case 'listips':
			case 'csvexportips':
				if ($sOperation == 'listips')
				{
					$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:ListIps:IPv4Subnet:FirstIP');
					$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:ListIps:IPv4Subnet:LastIP');
					
					// Sub title
					$oP->add("<b>".Dict::S('UI:IPManagement:Action:ListIps:IPv4Subnet:Subtitle_ListRange')."</b>\n");
				}
				else
				{
					$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:CsvExportIps:IPv4Subnet:FirstIP');
					$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:CsvExportIps:IPv4Subnet:LastIP');
					
					// Sub title
					$oP->add("<b>".Dict::S('UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Subtitle_ListRange')."</b>\n");
				}
				
				// New first IP
				$sAttCode = 'firstip';
				$sInputId = $iFormId.'_'.'firstip';
				$oAttDef = MetaModel::GetAttributeDef('IPv4Range', 'firstip');
				$sDefault = (array_key_exists('firstip', $aDefault)) ? $aDefault['firstip'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv4Range', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);
				
				// New last IP
				$sAttCode = 'lastip';
				$sInputId = $iFormId.'_'.'lastip';
				$oAttDef = MetaModel::GetAttributeDef('IPv4Range', 'lastip');
				$sDefault = (array_key_exists('lastip', $aDefault)) ? $aDefault['lastip'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv4Range', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
				
				$oP->Details($aDetails);
				$oP->add('</td></tr>');
				
				// Cancell button
				$iObjId = $this->GetKey();
				$oP->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"BackToDetails('IPv4Subnet', $iObjId)\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;");
			break;
			
			case 'shrinksubnet':
			case 'splitsubnet':
			case 'expandsubnet':
				if ($sOperation == 'shrinksubnet')
				{
					$sLabelOfAction = Dict::S('UI:IPManagement:Action:Shrink:IPv4Subnet:By');
				}
				else if ($sOperation == 'splitsubnet')
				{
					$sLabelOfAction = Dict::S('UI:IPManagement:Action:Split:IPv4Subnet:In');
				}
				else if ($sOperation == 'expandsubnet')
				{
					$sLabelOfAction = Dict::S('UI:IPManagement:Action:Expand:IPv4Subnet:By');
				}
				
				// Cancell button
				$iObjId = $this->GetKey();
				$oP->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"BackToDetails('IPv4Subnet', $iObjId)\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;</td>");
				
				// Name of action
				$oP->add("<td class=\"label\"><span title=\"\">".$sLabelOfAction."&nbsp;</span></td>");
				
				// Scale of action
				$sInputId = $iFormId.'_'.'scale_id';
				$sHTMLValue = "<td><select id=\"$sInputId\" name=\"scale_id\">\n";
				$jDefault = (array_key_exists('scale_id', $aDefault)) ? $aDefault['scale_id'] : 1;
				$j = 1;
				$iScaleMax = $this->GetScaleOfOperation($sOperation);
				for($i = 1; $i <= $iScaleMax; $i++)
				{
					$j = $j * 2;
					if ($j == $jDefault)
					{
						$sHTMLValue .= "<option selected='' value=\"$j\">$j</option>\n";
					}
					else
					{
						$sHTMLValue .= "<option value=\"$j\">$j</option>\n";
					}
				}
				$sHTMLValue .= "</select></td><td>";	
				$oP->add($sHTMLValue);
			break;
			
			case 'calculator':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Calculator:IPv4Subnet:IP');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:Calculator:IPv4Subnet:Mask');
				$sLabelOfAction3 = Dict::S('UI:IPManagement:Action:Calculator:IPv4Subnet:CIDR');

				// IP
				$sAttCode = 'ip';
				$sInputId = $iFormId.'_'.'ip';
				$oAttDef = MetaModel::GetAttributeDef('IPv4Subnet', 'ip');
				$sDefault = (array_key_exists('ip', $aDefault)) ? $aDefault['ip'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv4Subnet', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);
				
				// Mask
				$sAttCode = 'gatewayip';
				$sInputId = $iFormId.'_'.'mask';
				$oAttDef = MetaModel::GetAttributeDef('IPv4Subnet', 'gatewayip');
				$sDefault = (array_key_exists('mask', $aDefault)) ? $aDefault['mask'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv4Subnet', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
				
				// CIDR
				$sInputId = $iFormId.'_'.'cidr';
				$sHTMLValue = "<input type=\"number\" id=\"$sInputId\" name=\"cidr\">\n";
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction3.'</span>', 'value' => $sHTMLValue);
				
				
				$oP->Details($aDetails);
				$oP->add('</td></tr>');
				
				// Cancell button
				$iObjId = $this->GetKey();
				if ($iObjId > 0)
				{
					$oP->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"BackToDetails('IPv4Subnet', $iObjId)\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;");
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
	 * Displays result of IPv4 calculator
	 * @param \WebPage $oP
	 * @param $oAppContext
	 * @param $aParam
	 *
	 * @throws \Exception
	 */
	function DisplayCalculatorOutput(WebPage $oP, $oAppContext, $aParam)
	{
	    $sIp = $aParam['ip'];
	    $sMask = $aParam['mask'];
	    if ($sMask != '')
	    {
	    	$iCidr = $this->MaskToBit($sMask);
	    }
	    else
	    {
	    	$iCidr = $aParam['cidr'];
	    	$sMask = $this->BitToMask($iCidr);
		}
		$iIp = ip2long($sIp);
		$iMask = ip2long($sMask);

		$iSubnetIp = $iIp & $iMask;
		$sSubnetIp = mylong2ip($iSubnetIp);
		 
		$sWildCard = long2ip(~(ip2long($sMask)));
		
		$iBroadcastIp = $iSubnetIp + $this->MaskToSize($sMask) - 1;
		$sBroadcastIp = mylong2ip($iBroadcastIp);

		$iIpNumber = $this->MaskToSize($sMask);
		if ($iIpNumber > 2)
		{
			$iUsableHosts = $iIpNumber - 2;
		}
		else
		{
			$iUsableHosts = 0;
		}
		
		if ($sSubnetIp == '0.0.0.0')
		{
			$sPreviousSubnetIp = Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet:NA');
		}
		else
		{
			$iPreviousSubnetIp = ($iSubnetIp - 1)& $iMask;
			$sPreviousSubnetIp = mylong2ip($iPreviousSubnetIp);
		}
		
		if ($sBroadcastIp == '255.255.255.255')
		{
			$sNextSubnetIp = Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet:NA');
		}
		else
		{
			$iNextSubnetIp = $iSubnetIp + $this->MaskToSize($sMask);
			$sNextSubnetIp = mylong2ip($iNextSubnetIp);
		}

		$oP->add('<table style="vertical-align:top;"><tr><td>');
		$oP->add('<div id="tree">');
		// IP address
		$oP->add('&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:IP').":</td><td>$sIp</td></tr>");
		$oP->add('<tr><td height=10></td></tr>');
		
		// Subnet IP
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:SubnetIP').":</td><td><b>$sSubnetIp</b></td></tr>");
		
		// Subnet Mask
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:Mask').":</td><td>$sMask</td></tr>");
		
		// CIDR
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:CIDR').":</td><td>$iCidr</td></tr>");
		
		// Wildcard Mask
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:Wildcard').":</td><td>$sWildCard</td></tr>");
		$oP->add('<tr><td height=10></td></tr>');
		
		// Broadcast IP
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:BroadcastIP').":</td><td><b>$sBroadcastIp</b></td></tr>");
		
		// Number of IPs
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:IPNumber').":</td><td>$iIpNumber</td></tr>");
		
		// Number of usable hosts
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:UsableHosts').":</td><td>$iUsableHosts</td></tr>");
		$oP->add('<tr><td height=10></td></tr>');

		// Previous network
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet').":</td><td>$sPreviousSubnetIp</td></tr>");
		
		// Next network
		$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet').":</td><td>$sNextSubnetIp</td></tr>");
		$oP->add('<tr><td height=10></td></tr>');

		// As an option, create subnet or block with calculated parameters (previous, current or next one)
		$UserHasRightsToCreateBlocks = (UserRights::IsActionAllowed('IPv4Block', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
		$UserHasRightsToCreateSubnets = (UserRights::IsActionAllowed('IPv4Subnet', UR_ACTION_MODIFY) == UR_ALLOWED_YES) ? true : false;
		if (!$UserHasRightsToCreateBlocks && !$UserHasRightsToCreateSubnets)
		{
			return;
		}

		$oP->add('<tr><td>&nbsp;&nbsp;</td><td colspan="2">'.Dict::S('UI:IPManagement:Action:DoCalculator:IPSubnet:SelectCreation').'</td></tr>');
		if ($this->GetKey() > 0)
		{
			$iOrgId = $this->Get('org_id');
			$iBlockMinSize = IPConfig::GetFromGlobalIPConfig('ipv4_block_min_size', $iOrgId);
		}
		else
		{
			$iBlockMinSize = IPV4_BLOCK_MIN_SIZE;
		}
		$bOfferBlock = ($iIpNumber >= $iBlockMinSize) ? true : false;
		$bOfferSubnet = ($iCidr >= IPV4_SUBNET_MAX_PREFIX) ? true : false;

		$iVIdCounter = 1;
		$iId = $this->GetKey();
		$iOrgId = $this->Get('org_id');
		$aSubnetIps = array();
		if ($sSubnetIp != '0.0.0.0')
		{
			$aSubnetIps[$sPreviousSubnetIp ] = mylong2ip($iSubnetIp - 1);
		}
		$aSubnetIps[$sSubnetIp] = $sBroadcastIp;
		if ($sBroadcastIp != '255.255.255.255')
		{
			$aSubnetIps[$sNextSubnetIp] = mylong2ip(ip2long($sNextSubnetIp) + $this->MaskToSize($sMask) - 1);
		}
		foreach ($aSubnetIps as $sFirstIp => $sLastIp)
		{
			if ($sFirstIp == $sSubnetIp)
			{
				$oP->add('<tr><td></td><td>&nbsp;&nbsp;</td><td><b>'.$sFirstIp.' /'.$iCidr.'</b></td>');
			}
			else
			{
				$oP->add('<tr><td></td><td>&nbsp;&nbsp;</td><td>'.$sFirstIp.' /'.$iCidr.'</td>');
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
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv4Block', 0, {'org_id': '$iOrgId', 'parent_id': '$iId', 'firstip': "$sFirstIp", 'lastip': '$sLastIp'});
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
						oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv4Subnet', 0, {'org_id': '$iOrgId', 'parent_id': '$iId', 'ip': "$sFirstIp", 'mask': '$sMask'});
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
		$oP->add('</div>');     // ??
	}
	
	/**
	 * Displays the tabs related to IPv4Subnets
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
				
				$aParam = array ('reserve_subnet_IPs');
				$this->DisplayGlobalParametersInLocalModifyForm($oP, $aParam);
				
				$oP->add('</td>');
				$oP->add('</tr></table>');
			}
		}
		else
		{
			$iOrgId = $this->Get('org_id');
			$iKey = $this->GetKey();
			$sIp = $this->Get('ip');
			$sMask = $this->Get('mask');
			$sIpBroadcast = $this->Get('broadcastip');
			$iIp = myip2long($sIp);
			$iIpBroadcast = myip2long($sIpBroadcast);
			$iSubnetSize = $this->GetSize();
			
			$aExtraParams = array();
			$aExtraParams['menu'] = false;
			
			// Tab for Registered IPs
			$oIpRegisteredSearch = DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE INET_ATON('$sIp') <= INET_ATON(i.ip) AND INET_ATON(i.ip) <= INET_ATON('$sIpBroadcast') AND i.org_id = $iOrgId");
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
				$oP->p(MetaModel::GetClassIcon('IPv4Address').'&nbsp;'.Dict::Format('Class:IPSubnet/Tab:ipregistered+'));
				$oP->p($this->GetAsHTML('ip_occupancy').Dict::Format('Class:IPSubnet/Tab:ipregistered-count', $iReserved, $iAllocated, $iReleased, $iUnallocated, $iSubnetSize));
				$oBlock = new DisplayBlock($oIpRegisteredSearch, 'list');
				$oBlock->Display($oP, 'ip_addresses', $aExtraParams);
			}
			else
			{
				$oP->SetCurrentTab(Dict::S('Class:IPSubnet/Tab:ipregistered'));
				$oP->p(MetaModel::GetClassIcon('IPv4Address').'&nbsp;'.Dict::S('Class:IPSubnet/Tab:ipregistered+'));
				$oP->p(Dict::S('UI:NoObjectToDisplay'));
			}
			
			// Tab for IP Ranges
			$oIpRangeSearch = DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE r.subnet_id = '$iKey' AND r.org_id = $iOrgId");
			$oIpRangeSet = new CMDBObjectSet($oIpRangeSearch);
			$iIpRange = $oIpRangeSet->Count();
			if ($iIpRange > 0)
			{
				$iCountRange = 0;
				while ($oIpRange = $oIpRangeSet->Fetch())
				{
					$iCountRange += myip2long($oIpRange->Get('lastip')) - myip2long($oIpRange->Get('firstip')) + 1;
				}
				$oP->SetCurrentTab(Dict::Format('Class:IPSubnet/Tab:iprange').' ('.$iIpRange.')');
				$oP->p(MetaModel::GetClassIcon('IPv4Range').'&nbsp;'.Dict::Format('Class:IPSubnet/Tab:iprange+'));
				$oP->p($this->GetAsHTML('range_occupancy').Dict::Format('Class:IPSubnet/Tab:iprange-count-percent'));
				$oBlock = new DisplayBlock($oIpRangeSearch, 'list');
				$oBlock->Display($oP, 'ip_ranges', $aExtraParams);
			}
			else
			{
				$oP->SetCurrentTab(Dict::S('Class:IPSubnet/Tab:iprange'));
				$oP->p(MetaModel::GetClassIcon('IPv4Range').'&nbsp;'.Dict::S('Class:IPSubnet/Tab:iprange+'));
				$oP->p(Dict::S('UI:NoObjectToDisplay'));
			}

			// Tab for IP Requests
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
	
	/*
	 * Compute attributes before writing object 
	 */     
	public function ComputeValues()
	{
		$sIp = $this->Get('ip');
		$iIp = myip2long($sIp);
		$sMask = $this->Get('mask');
		
		// Set Broadcast IP
		$iIpBroadcast = $iIp + $this->GetSize() - 1;
		$sIpBroadcast = mylong2ip($iIpBroadcast);
		$this->Set('broadcastip', $sIpBroadcast);

		// Set Gateway IP
		if ($sMask != '255.255.255.255')
		{
			$iOrgId = $this->Get('org_id');
			$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv4_gateway_ip_format', $iOrgId);
			switch ($sGatewayIPFormat)
			{
				case 'subnetip_plus_1':
					$iGatewayIp = $iIp + 1;
					$sGatewayIp = mylong2ip($iGatewayIp);
				break;
				
				case 'broadcastip_minus_1':
					$iGatewayIp = $iIpBroadcast - 1;
					$sGatewayIp = mylong2ip($iGatewayIp);
				break;
				
				case 'free_setup':
				default:
					$sGatewayIp = $this->Get('gatewayip');
				break;
			}
		}
		else
		{
			$sGatewayIp = $sIp;
		}
		$this->Set('gatewayip', $sGatewayIp);

		// Set parent block if not set
		// Note: this may give incorrect result if only one block exists under the organization since, in such case, framework preset block_id to that unique block as block_id cannot be null
		if (($sIp != '') && ($sMask != ''))
		{
			// Look for all blocks containing the new subnet
			// Pick the smallest one
			$iOrgId = $this->Get('org_id');
			$oSRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Block AS b WHERE INET_ATON(b.firstip) <= INET_ATON('$sIp') AND INET_ATON('$sIpBroadcast') <= INET_ATON(b.lastip) AND b.org_id = $iOrgId"));
			$iMinSize = 0;
			$iBlockId = 0;
			while ($oSRange = $oSRangeSet->Fetch())
			{
				$iSRangeSize = $oSRange->GetSize();
				if (($iMinSize == 0) || ($iSRangeSize < $iMinSize))
				{
					$iMinSize = $iSRangeSize;
					$iBlockId = $oSRange->GetKey();
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
		$sIp = $this->Get('ip');
		$sMask = $this->Get('mask');
		$iIp = myip2long($sIp);
		$iMask = myip2long($sMask);	 
		$Size = $this->GetSize();
		$iIpBroadcast = $iIp + $Size - 1;
		$sIpBroadcast = mylong2ip($iIpBroadcast);
		$iBlockId = $this->Get('block_id');
		
		// Forbid change of subnet IP but for subnet expansion
		//		As we look for subnet by its key, we cannot have an org mismatch
		$oSubnet = MetaModel::GetObject('IPv4Subnet', $iKey, false /* MustBeFound */);
		if (!is_null($oSubnet))
		{
			if (($sIp != $oSubnet->Get('ip')) && ($this->Get('write_reason') != 'expand'))
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:IpCannotChange');
				return;
			}
		}
		
		// Forbid change of subnet mask unless required by programmatic functions
		//		As we look for subnet by its key, we cannot have an org mismatch
		$sWriteReason = $this->Get('write_reason');
		if (($sWriteReason != 'shrink') && ($sWriteReason != 'split') && ($sWriteReason != 'expand'))
		{
			$oSubnet = MetaModel::GetObject('IPv4Subnet', $iKey, false /* MustBeFound */);
			if (!is_null($oSubnet) && ($sMask != $oSubnet->Get('mask')))
			{
			 	$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:MaskCannotChange');
			 	return;
			}
		}
		
		// Check consitency between subnet IP and mask. IP must be aligned with block defined by mask.
		if (!$this->DoCheckCIDRAligned())
		{
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:IpIncorrect');
			return;
		}	 
		
		// Make sure subnet is fully contained in range
		$oBlock = MetaModel::GetObject('IPv4Block', $this->Get('block_id'), true /* MustBeFound */);
		$iBlockLastIp = myip2long($oBlock->Get('lastip'));
		if (($iIp < myip2long($oBlock->Get('firstip'))) || ($iBlockLastIp < $iIpBroadcast))
		{
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:NotInBlock');
			return;
		}
		
		// Make sure subnet doesn't collide with another subnet
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE s.block_id = $iBlockId AND s.org_id = $iOrgId"));
		while ($oSubnet = $oSubnetSet->Fetch())
		{
			// If it's a modification (keys are the same) further checks are not relevant
			if ($oSubnet->GetKey() != $iKey)
			{
				$iCurrentIp = myip2long($oSubnet->Get('ip'));
				$iCurrentIpBroadcast = myip2long($oSubnet->Get('broadcastip'));
				
				// Does the subnet already exist?
				if (($iCurrentIp == $iIp) && ($iCurrentIpBroadcast == $iIpBroadcast))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision0');
					return;
				}
				// Is the subnet IP part of an existing subnet?
				if (($iCurrentIp <= $iIp) && ($iIp <= $iCurrentIpBroadcast) && ($sWriteReason != 'expand'))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision1');
					return;
				}
				// Is the broadcast IPs part of an existing subnet?
				if (($iCurrentIp <= $iIpBroadcast) && ($iIpBroadcast <= $iCurrentIpBroadcast) && ($sWriteReason != 'expand'))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision2');
					return;
				}
				// Is new subnet including an existing one?
				if (($iIp < $iCurrentIp) && ($iCurrentIpBroadcast < $iIpBroadcast) && ($sWriteReason != 'expand'))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:Collision3');
					return;
				}
			}
		}
		
		// If allocation of Gateway Ip is free, make sure it is contained in subnet
		$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv4_gateway_ip_format', $iOrgId);
		if ($sGatewayIPFormat == 'free_setup')
		{
			$sGatewayIp = $this->Get('gatewayip');
			if ($sGatewayIp != '')
			{
				if (! $this->DoCheckIpInSubnet($sGatewayIp))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPSubnet:GatewayOutOfSubnet');
					return;
				}
			}
		}
		
		// Reset reason for action
		$this->Set('write_reason', 'none');
	}
	
	/**
	 * Perform specific tasks related to subnet creation:
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
		if ($sMask != '255.255.255.255')
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
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sSubnetIp' AND i.org_id = $iOrgId", null, false);
				if (is_null($oIp))
				{
					$oIp = MetaModel::NewObject('IPv4Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $sSubnetIp);
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

				if ($sMask != '255.255.255.254')
				{
					// Create or update gateway IP
					$sUsageGatewayIpId = IPUsage::GetIpUsageId($iOrgId, GATEWAY_IP_CODE);
					$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sGatewayIp' AND i.org_id = $iOrgId",
						null, false);
					if (is_null($oIp))
					{
						$oIp = MetaModel::NewObject('IPv4Address');
						$oIp->Set('subnet_id', $iId);
						$oIp->Set('ip', $sGatewayIp);
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
	
				// Create or update broadcast IP
				$sUsageBroadcastIpId = IPUsage::GetIpUsageId($iOrgId, BROADCAST_IP_CODE);
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sIpBroadcast' AND i.org_id = $iOrgId", null, false);
				if (is_null($oIp))
				{
					$oIp = MetaModel::NewObject('IPv4Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $sIpBroadcast);
					$oIp->Set('org_id', $iOrgId);
					$oIp->Set('status', 'reserved');
					$oIp->Set('usage_id', $sUsageBroadcastIpId);
					$oIp->DBInsert();
				}
				else
				{
					if (($oIp->Get('status') != 'reserved') || ($oIp->Get('usage_id') != $sUsageBroadcastIpId)) 
					{
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
					
		if ($sMask != '255.255.255.255')
		{
			$sReserveSubnetIPs = IPConfig::GetFromGlobalIPConfig('reserve_subnet_IPs', $iOrgId);
			if ($sReserveSubnetIPs == 'reserve_yes')
			{
				// Create or update subnet IP
				$sUsageNetworkIpId = IPUsage::GetIpUsageId($iOrgId, NETWORK_IP_CODE);
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sSubnetIp' AND i.org_id = $iOrgId", null, false);
				if (is_null($oIp))
				{
					$oIp = MetaModel::NewObject('IPv4Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $sSubnetIp);
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
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sGatewayIp' AND i.org_id = $iOrgId", null, false);
				if (is_null($oIp))
				{
					$oIp = MetaModel::NewObject('IPv4Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $sGatewayIp);
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
	
				// Create or update broadcast IP
				$sUsageBroadcastIpId = IPUsage::GetIpUsageId($iOrgId, BROADCAST_IP_CODE);
				$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sIpBroadcast' AND i.org_id = $iOrgId", null, false);
				if (is_null($oIp))
				{
					$oIp = MetaModel::NewObject('IPv4Address');
					$oIp->Set('subnet_id', $iId);
					$oIp->Set('ip', $sIpBroadcast);
					$oIp->Set('org_id', $iOrgId);
					$oIp->Set('status', 'reserved');
					$oIp->Set('usage_id', $sUsageBroadcastIpId);
					$oIp->DBInsert();
				}
				else
				{
					if (($oIp->Get('status') != 'reserved') || ($oIp->Get('usage_id') != $sUsageBroadcastIpId)) 
					{
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
				$sOQL = "SELECT IPv4Address WHERE subnet_id = :id AND status != 'released'";
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
	 */
	protected function DoCheckToDelete(&$oDeletionPlan)
	{
		$iOrgId = $this->Get('org_id');
		$sIp = $this->Get('ip');
		$sIpBroadcast = $this->Get('broadcastip');
		
		parent::DoCheckToDelete($oDeletionPlan);
		
		$sWriteReason = $this->Get('write_reason');
		if ($sWriteReason != 'expand')
		{
			// IPs parent is updated by DoExpand function
			// Add subnet and broadcast IP to deletion plan if they exist
			$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sIp' AND i.org_id = $iOrgId", null, false);
			if (!is_null($oIp))
			{
				$oDeletionPlan->AddToDelete($oIp, DEL_AUTO);
			}
			
			$oIp = MetaModel::GetObjectFromOQL("SELECT IPv4Address AS i WHERE i.ip = '$sIpBroadcast' AND i.org_id = $iOrgId", null, false);
			if (!is_null($oIp))
			{
				$oDeletionPlan->AddToDelete($oIp, DEL_AUTO);
			}
		}
	}
	
	/**
	 * Change flag of attributes that shouldn't be modified beside creation.
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		if ((!$this->IsNew()) && (($sAttCode == 'org_id') || ($sAttCode == 'block_id') || ($sAttCode == 'ip') || ($sAttCode == 'mask') || ($sAttCode == 'broadcastip') || ($sAttCode == 'ip_occupancy') || ($sAttCode == 'range_occupancy')))
		{
			return OPT_ATT_READONLY;
		}
		if ((!$this->IsNew()) && ($sAttCode == 'gatewayip'))
		{
			$iOrgId = $this->Get('org_id');
			$sGatewayIPFormat = IPConfig::GetFromGlobalIPConfig('ipv4_gateway_ip_format', $iOrgId);
			if ($sGatewayIPFormat != 'free_setup')
			{
				return OPT_ATT_READONLY;
			}
		}
		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}
	
	/**
	 * Functions to handle masks and sizes
	 */
	
	public static function MaskToSize($Mask)
	{
		// Provides size of subnet according to dotted string mask
		switch ($Mask)
		{
			case "0.0.0.0": return 4294967296;
			case "128.0.0.0": return 2147483648;
			case "192.0.0.0": return 1073741824;
			case "224.0.0.0": return 536870912;
			case "240.0.0.0": return 268435456;
			case "248.0.0.0": return 134217728;
			case "252.0.0.0": return 67108864;
			case "254.0.0.0": return 33554432;
			case "255.0.0.0": return 16777216;
			case "255.128.0.0": return 8388608;
			case "255.192.0.0": return 4194304;
			case "255.224.0.0": return 2097152;
			case "255.240.0.0": return 1048576;
			case "255.248.0.0": return 524288;
			case "255.252.0.0": return 262144;
			case "255.254.0.0": return 131072;
			case "255.255.0.0": return 65536;
			case "255.255.128.0": return 32768;
			case "255.255.192.0": return 16384;
			case "255.255.224.0": return 8192;
			case "255.255.240.0": return 4096;
			case "255.255.248.0": return 2048;
			case "255.255.252.0": return 1024;
			case "255.255.254.0": return 512;
			case "255.255.255.0": return 256;
			case "255.255.255.128": return 128;
			case "255.255.255.192": return 64;
			case "255.255.255.224": return 32;
			case "255.255.255.240": return 16;
			case "255.255.255.248": return 8;
			case "255.255.255.252": return 4;
			case "255.255.255.254": return 2;
			case "255.255.255.255": return 1;
			default: return -1;
		}
	}

	function BitToMask($iPrefix)
	{
		// Provides size of subnet according to dotted string mask
		switch ($iPrefix)
		{
			case 0: return "0.0.0.0";
			case 1: return "128.0.0.0";
			case 2: return "192.0.0.0";
			case 3: return "224.0.0.0";
			case 4: return "240.0.0.0";
			case 5: return "248.0.0.0";
			case 6: return "252.0.0.0";
			case 7: return "254.0.0.0";
			case 8: return "255.0.0.0";
			case 9: return "255.128.0.0";
			case 10: return "255.192.0.0";
			case 11: return "255.224.0.0";
			case 12: return "255.240.0.0";
			case 13: return "255.248.0.0";
			case 14: return "255.252.0.0";
			case 15: return "255.254.0.0";
			case 16: return "255.255.0.0";
			case 17: return "255.255.128.0";
			case 18: return "255.255.192.0";
			case 19: return "255.255.224.0";
			case 20: return "255.255.240.0";
			case 21: return "255.255.248.0";
			case 22: return "255.255.252.0";
			case 23: return "255.255.254.0";
			case 24: return "255.255.255.0";
			case 25: return "255.255.255.128";
			case 26: return "255.255.255.192";
			case 27: return "255.255.255.224";
			case 28: return "255.255.255.240";
			case 29: return "255.255.255.248";
			case 30: return "255.255.255.252";
			case 31: return "255.255.255.254";
			case 32: return "255.255.255.255";
			default: return "";
		}
	}
	
	function MaskToBit($Mask)
	{
		// Provides number of bits within a dotted string mask
		return $this->SizeToBit($this->MaskToSize($Mask));
	}
	
	public static function SizeToMask ($Size)
	{
		// Convert size of subnet into mask
/*		if (($Size & ($Size - 1)) == 0)
		{
			//return (~($Size - 1));
			return (sprintf("%u", ~($Size - 1)));
		}
		else
		{
			return null;
		}*/
		switch ($Size)
		{
			case 4294967296:    return "0.0.0.0";
			case 2147483648:    return "128.0.0.0";
			case 1073741824:    return "192.0.0.0";
			case 536870912:     return "224.0.0.0";
			case 268435456:     return "240.0.0.0";
			case 134217728:     return "248.0.0.0";
			case 67108864:      return "252.0.0.0";
			case 33554432:      return "254.0.0.0";
			case 16777216:      return "255.0.0.0";
			case 8388608:       return "255.128.0.0";
			case 4194304:       return "255.192.0.0";
			case 2097152:       return "255.224.0.0";
			case 1048576:       return "255.240.0.0";
			case 524288:        return "255.248.0.0";
			case 262144:        return "255.252.0.0";
			case 131072:        return "255.254.0.0";
			case 65536:         return "255.255.0.0";
			case 32768:         return "255.255.128.0";
			case 16384:         return "255.255.192.0";
			case 8192:          return "255.255.224.0";
			case 4096:          return "255.255.240.0";
			case 2048:          return "255.255.248.0";
			case 1024:          return "255.255.252.0";
			case 512:           return "255.255.254.0";
			case 256:           return "255.255.255.0";
			case 128:           return "255.255.255.128";
			case 64:            return "255.255.255.192";
			case 32:            return "255.255.255.224";
			case 16:            return "255.255.255.240";
			case 8:             return "255.255.255.248";
			case 4:             return "255.255.255.252";
			case 2:             return "255.255.255.254";
			case 1:             return "255.255.255.255";
			default:            return "";
		}
	}
	
	public static function SizeToBit($Size)
	{
		// Provides number of bits for a given subnet size
		switch ($Size)
		{
			case 4294967296:    return 0;
			case 2147483648:    return 1;
			case 1073741824:    return 2;
			case 536870912:     return 3;
			case 268435456:     return 4;
			case 134217728:     return 5;
			case 67108864:      return 6;
			case 33554432:      return 7;
			case 16777216:      return 8;
			case 8388608:       return 9;
			case 4194304:       return 10;
			case 2097152:       return 11;
			case 1048576:       return 12;
			case 524288:        return 13;
			case 262144:        return 14;
			case 131072:        return 15;
			case 65536:         return 16;
			case 32768:         return 17;
			case 16384:         return 18;
			case 8192:          return 19;
			case 4096:          return 20;
			case 2048:          return 21;
			case 1024:          return 22;
			case 512:           return 23;
			case 256:           return 24;
			case 128:           return 25;
			case 64:            return 26;
			case 32:            return 27;
			case 16:            return 28;
			case 8:             return 29;
			case 4:             return 30;
			case 2:             return 31;
			case 1:             return 32;
			default:            return -1;
		}
	}
}
