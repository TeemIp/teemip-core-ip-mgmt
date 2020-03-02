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

class _IPv6Range extends IPRange
{
	/**
	 * Returns icon to be displayed
	 */
	public function GetIcon($bImgTag = true, $bXsIcon = false)
	{ 
		if ($bXsIcon)
		{
			$sIcon = utils::GetAbsoluteUrlModulesRoot().'teemip-ipv6-mgmt/images/ipv6range-xs.png';
		}
		else
		{
			$sIcon = utils::GetAbsoluteUrlModulesRoot().'teemip-ipv6-mgmt/images/ipv6range.png';
		}
		return ("<img src=\"$sIcon\" style=\"vertical-align:middle;\"/>");
	}

	/**
	 * Returns size of range
	 */
	public function GetSize()
	{
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');	 
		$iSize = $oFirstIp->GetSizeInterval($oLastIp);
		return $iSize;
	}
	
	/**
	 * Compute % of IP addresses registered in data base in IP range
	 */
	public function GetOccupancy()
	{
		$sOrgId = $this->Get('org_id');
		$sFirstIp = $this->Get('firstip')->ToString();
		$sLastIp = $this->Get('lastip')->ToString();
		
		$iSize = $this->GetSize();
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip AND i.ip <= :lastip AND i.org_id = $sOrgId",  array('firstip' => $sFirstIp, 'lastip' => $sLastIp)));
		return ($oIpRegisteredSet->Count() / $iSize) * 100;
	}

	/**
	 * Automatically get a free IP in the range
	 */
	public function GetFreeIP($iCreationOffset)
	{
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');
		if ($iCreationOffset > $oFirstIp->GetSizeInterval($oLastIp))
		{
			return '';
		}

		// Get list of registered IPs
		$iKey = $this->GetKey();
		$oIPRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS ip WHERE ip.range_id = $iKey"));
		$aIPRegistered = $oIPRegisteredSet->GetColumnAsArray('ip', false);

		for ($i = 0; $i < $iCreationOffset; $i++)
		{
			$oFirstIp = $oFirstIp->GetNextIp();
		}
		$oAnIp = $oFirstIp;
		while ($oAnIp->IsSmallerStrict($oLastIp))
		{
			if (!in_array($oAnIp, $aIPRegistered))
			{
					return $oAnIp->ToString();
			}
			$oAnIp = $oAnIp->GetNextIp();
		}

		return '';
	}

	/**
	 * List IP addresses in IP range in CSV format
	 */
	public function GetIPsAsCSV($aParam)
	{
		// Define first and last IPs to display
		$sFirstIp = $aParam['first_ip'];
		$oFirstIpRange = $this->Get('firstip');
		if ($sFirstIp == '')
		{
			$oFirstIp = $oFirstIpRange;
		}
		else
		{
			$oFirstIp = new ormIPv6($sFirstIp);
		}
		$sLastIp = $aParam['last_ip'];
		$oLastIpRange = $this->Get('lastip');
		if ($sLastIp == '')
		{
			$oLastIp = $oLastIpRange;
		}
		else
		{
			$oLastIp = new ormIPv6($sLastIp);
		}		
		
		// Get list of registered IPs in range
		$sOrgId = $this->Get('org_id');
		$sFirstIp = $oFirstIp->ToString(); 
		$sLastIp = $oLastIp->ToString(); 
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip AND i.ip <= :lastip AND i.org_id = $sOrgId",  array('firstip' => $sFirstIp, 'lastip' => $sLastIp)));
						
		// List exported parameters
		$sHtml = "Registered,Id";
		$aParam = array('org_name', 'ip', 'status', 'fqdn', 'usage_name', 'comment', 'requestor_name', 'release_date');
		foreach($aParam as $sAttCode)
		{
				$sHtml .= ','.MetaModel::GetLabel('IPv6Address', $sAttCode);
		}
		$sHtml .= "\n";
						
		// List all IPs of range now in IP order 
		$aIpRegistered = $oIpRegisteredSet->GetColumnAsArray('ip', false);
		$oAnIp = $oFirstIp;
		while ($oAnIp->IsSmallerOrEqual($oLastIp))
		{
			if (!in_array($oAnIp, $aIpRegistered))
			{
				$sHtml .= "no,,,".$oAnIp->GetAsCompressed().",free,,,,,,,\n";
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
				$sHtml .= $oIpRegistered->Get('org_id').",";
				$sHtml .= $oIpRegistered->Get('ip')->GetAsCompressed().",";
				$sHtml .= $oIpRegistered->Get('status').",";
				$sHtml .= $oIpRegistered->Get('fqdn').",";
				$sHtml .= $oIpRegistered->Get('usage_name').",";
				$sHtml .= $oIpRegistered->Get('comment').",";
				$sHtml .= $oIpRegistered->Get('requestor_name').",";
				$sHtml .= $oIpRegistered->Get('release_date')."\n";
			}
			$oAnIp = $oAnIp->GetNextIp();
		}
		return ($sHtml);
	}
	
	/**
	 * Check if IP is in range
	 */
	function DoCheckIpInRange($oIp)
	{
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');
		if ($oFirstIp->IsSmallerOrEqual($oIp) && $oIp->IsSmallerOrEqual($oLastIp))
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Check if IPs can be listed
	 */
	function DoCheckToListIps($aParam)
	{
		$oFirstIpRange = $this->Get('firstip');
		$oLastIpRange = $this->Get('lastip');

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '')
		{
			$oFirstIp = new ormIPv6($sFirstIp);
			if ($oFirstIp->IsSmallerStrict($oFirstIpRange) || $oLastIpRange->IsSmallerStrict($oFirstIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Range:FirstIPOutOfRange'));
			}
		}
		
		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '')
		{
			$oLastIp = new ormIPv6($sLastIp);
			if ($oLastIp->IsSmallerStrict($oFirstIpRange) || $oLastIpRange->IsSmallerStrict($oLastIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Range:LastIPOutOfRange'));
			}
		}
		
		if (($sFirstIp != '') && ($sLastIp != ''))
		{
			if ($oFirstIp->IsBiggerStrict($oLastIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Range:FirstIpBiggerThanLastIp'));
			}
		}
		return '';
	}
	
	/**
	 * Display list of IPs addresses within GUI
	 */
	function DoListIps(WebPage $oP, $iChangeId, $aParam)
	{
		// Define first and last IPs to display
		$sFirstIp = $aParam['first_ip'];
		$oFirstIpRange = $this->Get('firstip');
		if ($sFirstIp == '')
		{
			$oFirstIp = $oFirstIpRange;
		}
		else
		{
			$oFirstIp = new ormIPv6($sFirstIp);
		}
		$bPrintDummyFirstLine = $oFirstIp->IsEqual($oFirstIpRange) ? false : true;
		$sLastIp = $aParam['last_ip'];
		$oLastIpRange = $this->Get('lastip');
		if ($sLastIp == '')
		{
			$oLastIp = $oLastIpRange;
		}
		else
		{
			$oLastIp = new ormIPv6($sLastIp);
		}		
		$bPrintDummyLastLine = $oLastIp->IsEqual($oLastIpRange) ? false : true;
		
		// Get list of registered IPs in range
		$iId = $this->GetKey();
		$sOrgId = $this->Get('org_id');
		$sFirstIp = $oFirstIp->ToString(); 
		$sLastIp = $oLastIp->ToString(); 
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip AND i.ip <= :lastip AND i.org_id = $sOrgId",  array('firstip' => $sFirstIp, 'lastip' => $sLastIp)));
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
	
		// Display first IP
		$oP->add("<ul>\n");
		$oP->add("<li>".$this->GetHyperlink().$sHtml."<ul>\n");
	
		// ... and dummy line if display doesn't start at first IP
		if ($bPrintDummyFirstLine)
		{
			$oP->add("<li>&nbsp;&nbsp;...&nbsp;//&nbsp;... </li>");
		}
		
		// Display other IPs as list
		while ($oAnIp->IsSmallerOrEqual($oLastIp))
		{
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
					oIpWidget_{$iVId} = new IpWidget($iVId, 'IPv6Address', $iChangeId, {'org_id': '$sOrgId', 'subnet_id': '$iSubnetId', 'range_id': '$iId', 'ip': '$oAnIp', 'status': '$sStatusIp', 'short_name': '$sShortName', 'domain_id': '$iDomainId', 'usage_id': '$iUsageId', 'requestor_id': '$iRequestorId'});
EOF
					);
				}
				else
				{
					$oP->add("<li>".$oAnIp->GetAsCompressed());
				}
			}        
			$oP->add("</li>\n");
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
	 */
	function DoCheckToCsvExportIps($aParam)
	{
		$oFirstIpRange = $this->Get('firstip');
		$oLastIpRange = $this->Get('lastip');

		$sFirstIp = $aParam['first_ip'];
		if ($sFirstIp != '')
		{
			$oFirstIp = new ormIPv6($sFirstIp);
			if ($oFirstIp->IsSmallerStrict($oFirstIpRange) || $oLastIpRange->IsSmallerStrict($oFirstIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Range:FirstIPOutOfRange'));
			}
		}
		
		$sLastIp = $aParam['last_ip'];
		if ($sLastIp != '')
		{
			$oLastIp = new ormIPv6($sLastIp);
			if ($oLastIp->IsSmallerStrict($oFirstIpRange) || $oLastIpRange->IsSmallerStrict($oLastIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Range:LastIPOutOfRange'));
			}
		}
		
		if (($sFirstIp != '') && ($sLastIp != ''))
		{
			if ($oFirstIp->IsBiggerStrict($oLastIp))
			{
				return (Dict::Format('UI:IPManagement:Action:DoListIps:IPv6Range:FirstIpBiggerThanLastIp'));
			}
		}
		return '';
	}
	
	/**
	 * Display attributes associated operation
	 */
	function DisplayActionFieldsForOperation(WebPage $oP, $sOperation, $iFormId, $aDefault)
	{
		$oP->add("<table>");
		$oP->add('<tr><td style="vertical-align:top">');
		
		switch ($sOperation)
		{
			case 'listips':
			case 'csvexportips':
				if ($sOperation == 'listips')
				{
					$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:ListIps:IPv6Range:FirstIP');
					$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:ListIps:IPv6Range:LastIP');
					
					// Sub title
					$oP->add("<b>".Dict::S('UI:IPManagement:Action:ListIps:IPv6Range:Subtitle_ListRange')."</b>\n");
				}
				else
				{
					$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:CsvExportIps:IPv6Range:FirstIP');
					$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:CsvExportIps:IPv6Range:LastIP');
					
					// Sub title
					$oP->add("<b>".Dict::S('UI:IPManagement:Action:CsvExportIps:IPv6Range:Subtitle_ListRange')."</b>\n");
				}
				
				// New first IP
				$sAttCode = 'firstip';
				$sInputId = $iFormId.'_'.'firstip';
				$oAttDef = MetaModel::GetAttributeDef('IPv6Range', 'firstip');
				$sDefault = (array_key_exists('firstip', $aDefault)) ? $aDefault['firstip'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv6Range', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', '', '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);
				
				// New last IP
				$sAttCode = 'lastip';
				$sInputId = $iFormId.'_'.'lastip';
				$oAttDef = MetaModel::GetAttributeDef('IPv6Range', 'lastip');
				$sDefault = (array_key_exists('lastip', $aDefault)) ? $aDefault['lastip'] : '';
				$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPv6Range', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', '', '');
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);
				
				$oP->Details($aDetails);
				$oP->add('</td></tr>');
				
				// Cancell button
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
	 * Displays the tabs related to IPv6Ranges
	 */
	function DisplayBareRelations(WebPage $oP, $bEditMode = false)
	{
		// Execute parent function first 
		parent::DisplayBareRelations($oP, $bEditMode);
		
		if (!$this->IsNew())
		{
			$sOrgId = $this->Get('org_id');
			$sFirstIp = $this->Get('firstip')->ToString();
			$sLastIp = $this->Get('lastip')->ToString();
			
			$iSize = $this->GetSize();
			
			$aExtraParams = array();
			$aExtraParams['menu'] = false;			
			
			// Tab for Registered IPs
			$oIpRegisteredSearch = DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip AND i.ip <= :lastip AND i.org_id = $sOrgId",  array('firstip' => $sFirstIp, 'lastip' => $sLastIp));
			$oIpRegisteredSet = new CMDBObjectSet($oIpRegisteredSearch);
			$iCountRegistered = $oIpRegisteredSet->Count();
			if ($iCountRegistered > 0)
			{
				$iCountAllocated = 0;
				while ($oIpRegistered = $oIpRegisteredSet->Fetch())
				{
					if ($oIpRegistered->Get('status') == 'allocated')
					{
						$iCountAllocated++;
					}
				}
				$iCountReserved = $iCountRegistered - $iCountAllocated;
				$oP->SetCurrentTab(Dict::Format('Class:IPRange/Tab:ipregistered').' ('.$iCountRegistered.')');
				$oP->p(MetaModel::GetClassIcon('IPv6Address').'&nbsp;'.Dict::Format('Class:IPRange/Tab:ipregistered+'));
				$oP->p($this->GetAsHTML('occupancy').Dict::Format('Class:IPRange/Tab:ipregistered-count', $iCountReserved, $iCountAllocated, $iSize));
				$oBlock = new DisplayBlock($oIpRegisteredSearch, 'list');
				$oBlock->Display($oP, 'ip_addresses', $aExtraParams);
			}
			else
			{
				$oP->SetCurrentTab(Dict::S('Class:IPRange/Tab:ipregistered'));
				$oP->p(MetaModel::GetClassIcon('IPv6Address').'&nbsp;'.Dict::S('Class:IPRange/Tab:ipregistered+'));
				$oP->p(Dict::S('UI:NoObjectToDisplay'));
			}
		}
	}
	
	/**
	 * Check validity of new IP attributes before creation
	 */
	function DoCheckToWrite()
	{
		// Run standard iTop checks first
		parent::DoCheckToWrite();
		
		$sOrgId = $this->Get('org_id');
		if ($this->IsNew())
		{
			$iKey = -1;
		}
		else
		{
			$iKey = $this->GetKey();
		}
		$sRange = $this->Get('range');
		$oFirstIp = $this->Get('firstip');
		$oLastIp = $this->Get('lastip');
		$iSubnetId = $this->Get('subnet_id');	 
		
		// If check is done during subnet expand, skip checks
		if ($this->Get('write_reason') == 'expand')
		{
			// Reset reason for action
			$this->Set('write_reason', 'none');
		}
		else
		{
			// Check that 1st Ip is smaller than last one
			if ($oFirstIp->IsBiggerOrEqual($oLastIp))
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Reverted');
				return;
			}
			
			// Make sure range is fully contained in subnet
			$oSubnet = MetaModel::GetObject('IPv6Subnet', $this->Get('subnet_id'), true /* MustBeFound */);
			$oSubnetIp = $oSubnet->Get('ip');
			$oSubnetLastIp = $oSubnet->Get('lastip');
			if ($oFirstIp->IsSmallerStrict($oSubnetIp) || $oSubnetLastIp->IsSmallerStrict($oLastIp))
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:NotInSubnet');
				return;
			}
			
			// Make sure range doesn't collide with another range within subnet
			$oRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.subnet_id = '$iSubnetId' AND r.org_id = $sOrgId AND r.id != $iKey"));
			while ($oRange = $oRangeSet->Fetch())
			{
				$oCurrentFirstIp = $oRange->Get('firstip');
				$oCurrentLastIp = $oRange->Get('lastip');
									
				// Check that name doesn't already exist in same subnet
				if ($oRange->Get('range') == $sRange)
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:NameExist');
					return;
				}
				// Does the range already exist?
				if ($oCurrentFirstIp->IsEqual($oFirstIp) && $oCurrentLastIp->IsEqual($oLastIp))
				{                                                     
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Collision0');
					return;
				}
				// Is new first Ip part of an existing range?
				if ($oCurrentFirstIp->IsSmallerOrEqual($oFirstIp) && $oFirstIp->IsSmallerOrEqual($oCurrentLastIp))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Collision1');
					return;
				}
				// Is new last Ip part of an existing range?
				if ($oCurrentFirstIp->IsSmallerOrEqual($oLastIp) && $oLastIp->IsSmallerOrEqual($oCurrentLastIp))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Collision2');
					return;
				}
				// Is new range including an existing one?
	 			if ($oFirstIp->IsSmallerStrict($oCurrentFirstIp) && $oCurrentLastIp->IsSmallerStrict($oLastIp))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPRange:Collision3');
					return;
				}
			}
		}
	}
	
	/**
	 * Perform specific tasks related to IPv6 range creation:
	 */	 
	protected function AfterInsert()
	{
		parent::AfterInsert();
		
		$iOrgId = $this->Get('org_id');
		$iId = $this->GetKey();
		$sFirstIp = $this->Get('firstip')->ToString();
		$sLastIp = $this->Get('lastip')->ToString();
						
		// Make sure all IPs belonging to range are attached to it
			
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip AND i.ip <= :lastip AND i.org_id = $iOrgId",  array('firstip' => $sFirstIp, 'lastip' => $sLastIp)));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch())
		{
			if ($oIpRegistered->Get('range_id') != $iId)
			{
				$oIpRegistered->Set('range_id', $iId);
				$oIpRegistered->DBUpdate();	
			}
		}
	}
	
	/**
	 * Perform specific tasks related to IPv6 range update:
	 */	 
	protected function AfterUpdate()
	{
		parent::AfterUpdate();
		
		$iOrgId = $this->Get('org_id');
		$iId = $this->GetKey();
		$sFirstIp = $this->Get('firstip')->ToString();
		$sLastIp = $this->Get('lastip')->ToString();
						
		// Make sure all IPs belonging to range are attached to it
			
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE :firstip <= i.ip AND i.ip <= :lastip AND i.org_id = $iOrgId",  array('firstip' => $sFirstIp, 'lastip' => $sLastIp)));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch())
		{
			if ($oIpRegistered->Get('range_id') != $iId)
			{
				$oIpRegistered->Set('range_id', $iId);
				$oIpRegistered->DBUpdate();	
			}
		}

		// Make sure all IPs ouside of range are NOT attached to it
		$oIpRegisteredSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE i.range_id = $iId AND (i.ip < :firstip OR :lastip < i.ip)",  array('firstip' => $sFirstIp, 'lastip' => $sLastIp)));
		while ($oIpRegistered = $oIpRegisteredSet->Fetch())
		{
			$oIpRegistered->Set('range_id', 0);
			$oIpRegistered->DBUpdate();
		}		
	}
	
	/**
	 * Change flag of attributes that shouldn't be modified beside creation.
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		if ((!$this->IsNew()) && ($sAttCode == 'subnet_id'))
		{
			return OPT_ATT_READONLY;
		}
		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}		
}
