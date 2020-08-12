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

class _Domain extends DNSObject
{
	/**
	 * Returns name to be displayed within trees
	 *
	 * @throws \CoreException
	 */
	public function GetNameForTree()
	{
		return $this->GetName();
	}

	/**
	 * Display domain as tree leaf
	 *
	 * @param \WebPage $oP
	 * @param bool $bWithSubnet
	 * @param $sTreeOrgId
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	public function DisplayAsLeaf(WebPage $oP, $bWithSubnet, $sTreeOrgId)
	{
		$oP->add($this->GetHyperlink());

		// Display delegation information if required
		$iOrgId = $this->Get('org_id');
		$iParentOrgId = $this->Get('parent_org_id');
		if ($iParentOrgId != 0)
		{
			if ($sTreeOrgId == $iOrgId)
			{
				// Domain is delegated from parent org
				$oP->add("&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:Domain:DelegatedFromParent',$this->GetAsHTML('parent_org_id')));
			}
			else
			{
				// Domain is delegated to child org
				$oP->add("&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:Domain:DelegatedToChild',$this->GetAsHTML('org_id')));
			}
		}

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
		
		$sOrgId = $this->Get('org_id');
		if (!$this->IsNew())
		{
			$sDomainName = $this->GetName();
			$iDomainKey = $this->GetKey();
			
			// Tab for hosts in the domain
			$iHostsFilter = intval(utils::ReadParam('host_filter', '0'));
			switch ($iHostsFilter)
			{
				case 1:
					// All hosts strictly under domain
					$sOQL = "SELECT IPAddress AS i WHERE i.domain_name = :domain_name AND i.org_id = :org_id";
					$sTitle = Dict::Format('Class:Domain/Tab:hosts/List1');
					break;

				case 2:
					// All hosts under child domains only
					$sOQL = "SELECT IPAddress AS i WHERE i.domain_name LIKE :domain_family AND i.domain_name != :domain_name AND i.org_id = :org_id";
					$sTitle = Dict::Format('Class:Domain/Tab:hosts/List2');
					break;

				case 0:
				default:
					// All hosts from domain and child domains
					$iHostsFilter = 0;
					$sOQL = "SELECT IPAddress AS i WHERE i.domain_name LIKE :domain_family AND i.org_id = :org_id";
					$sTitle = Dict::Format('Class:Domain/Tab:hosts/List0');
					break;
			}
			$oHostsSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('domain_name' => $sDomainName, 'domain_family' => '%'.$sDomainName, 'org_id' => $sOrgId));
			// Open tab first
			if ($oHostsSet->CountExceeds(0))
			{
				$oP->SetCurrentTab(Dict::Format('Class:Domain/Tab:hosts').' ('.$oHostsSet->Count().')');
				$oP->p(MetaModel::GetClassIcon('IPAddress').'&nbsp;'.$sTitle);
			}
			else
			{
				$oP->SetCurrentTab(Dict::S('Class:Domain/Tab:hosts'));
				$oP->p(MetaModel::GetClassIcon('IPAddress').'&nbsp;'.Dict::S('UI:NoObjectToDisplay'));
			}

			// Then, display form to select list of hosts if domain is not in edition
			if (!$bEditMode)
			{
				$oP->add('<div style="padding: 15px; background: #ddd;">');
				$oP->add("<form>");
				$oP->add("<table border=0>");

				$oP->add("<tr>");
				$sChecked = ($iHostsFilter == 0) ? 'checked' : '';
				if (!$sChecked)
				{
					$oP->add("<td>");
					$oP->add("<label><input type=\"radio\" $sChecked name=\"host_filter\" value=\"0\">".Dict::S('Class:Domain/Tab:hosts/SelectList0').'</label>');
					$oP->add("</td>");
				}
				$sChecked = ($iHostsFilter == 1) ? 'checked' : '';
				if (!$sChecked)
				{
					$oP->add("<td>");
					$oP->add("<label><input type=\"radio\" $sChecked name=\"host_filter\" value=\"1\">".Dict::S('Class:Domain/Tab:hosts/SelectList1').'</label>');
					$oP->add("</td>");
				}
				$sChecked = ($iHostsFilter == 2) ? 'checked' : '';
				if (!$sChecked)
				{
					$oP->add("<td>");
					$oP->add("<label><input type=\"radio\" $sChecked name=\"host_filter\" value=\"2\">".Dict::S('Class:Domain/Tab:hosts/SelectList2').'</label>');
					$oP->add("</td>\n");
				}
				$oP->add("</tr>\n");

				$oP->add("</table><br>\n");

				$oP->add("<input type=\"hidden\" name=\"class\" value=\"Domain\">\n");
				$oP->add("<input type=\"hidden\" name=\"id\" value=\"$iDomainKey\">\n");
				$oP->add("<input type=\"hidden\" name=\"operation\" value=\"details\">\n");
				$oP->add("<input type=\"hidden\" name=\"transaction_id\" value=\"".utils::GetNewTransactionId()."\">\n");
				$oAppContext = new ApplicationContext();
				$oP->add($oAppContext->GetForForm());
				$oP->add("<input type=\"submit\" value=\"".Dict::S('Class:Domain/Tab:hosts/SelectList')."\">\n");

				$oP->add("</form>\n");
				$oP->add('</div>');
			}

			// Display list of hosts if not empty
			if ($oHostsSet->CountExceeds(0))
			{
				$oBlock = new DisplayBlock($oHostsSet->GetFilter(), 'list', false);
				$oBlock->Display($oP, 'child_hosts', array('menu' => false));
			}

			// Tab for child domains
			$sOQL = "SELECT Domain AS dc JOIN Domain AS dp ON dc.parent_id BELOW dp.id WHERE dp.id = :domain_id AND dc.id != :domain_id";
			$oDomainsSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('domain_id' => $iDomainKey));
			if ($oDomainsSet->CountExceeds(0))
			{
				$oP->SetCurrentTab(Dict::Format('Class:Domain/Tab:child_domain').' ('.$oDomainsSet->Count().')');
				$oP->p(MetaModel::GetClassIcon('Domain').'&nbsp;'.Dict::Format('Class:Domain/Tab:child_domain+'));
				$oBlock = new DisplayBlock($oDomainsSet->GetFilter(), 'list', false);
				$oBlock->Display($oP, 'child_domains', array('menu' => false));
			}
			else
			{
				$oP->SetCurrentTab(Dict::S('Class:Domain/Tab:child_domain'));
				$oP->p(MetaModel::GetClassIcon('Domain').'&nbsp;'.Dict::S('UI:NoObjectToDisplay'));
			}

			// Tab for related zones
			if (class_exists('Zone'))
			{
				$sOQL = "SELECT Zone WHERE name LIKE CONCAT('%',:zone_name)";
				$oZonesSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_name' => $this->GetName()));
				$iZones = $oZonesSet->Count();
				if ($iZones > 0)
				{
					$oP->SetCurrentTab(Dict::S('Class:Domain/Tab:zones_list').' ('.$iZones.')');
					$oP->p(MetaModel::GetClassIcon('Zone').'&nbsp;'.Dict::S('Class:Domain/Tab:zones_list+'));
					$oBlock = new DisplayBlock($oZonesSet->GetFilter(), 'list', false);
					$oBlock->Display($oP, 'associated_zones', array('menu' => false));
				}
				else
				{
					$oP->SetCurrentTab(Dict::S('Class:Domain/Tab:zones_list'));
					$oP->p(MetaModel::GetClassIcon('Zone').'&nbsp;'.Dict::S('UI:NoObjectToDisplay'));
				}
			}
		}
	}
	
	/**
	 * Compute attributes before writing object
	 *
	 * @throws \CoreException
	 */
	public function ComputeValues()
	{
		parent::ComputeValues();

		$this->Set('name', static::ComputeFqdn($this->Get('name'), $this->Get('parent_name')));
	}
	
	/**
	 * Check validity of new IP attributes before creation
	 *
	 * @throws \CoreException
	 */
	public function DoCheckToWrite()
	{
		// Run standard iTop checks first
		parent::DoCheckToWrite();
		
		$sOrgId = $this->Get('org_id');
		$sOriginalOrgId = $this->GetOriginal('org_id');
		$iKey = $this->GetKey();
		$sDomain = $this->Get('name');

		// If organization is changing, make sure domain has no host, no child domain and no associated zone.
		if ($sOrgId != $sOriginalOrgId)
		{
			$sOQL = "SELECT Domain AS d WHERE d.parent_id = :key";
			$oChildDomainSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('key' => $iKey));
			if ($oChildDomainSet->CountExceeds(0))
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:ChangeOrg:Domain:HasChildren');
				return;
			}
			$sOQL = "SELECT IPAddress AS i WHERE i.domain_name LIKE :domain AND i.org_id = :org_id";
			$oHostSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('domain' => '%'.$sDomain, 'org_id' => $sOrgId));
			if ($oHostSet->CountExceeds(0))
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:ChangeOrg:Domain:HasHosts');
				return;
			}
			if (MetaModel::IsValidClass('Zone'))
			{
				$sOQL = "SELECT Zone WHERE name LIKE CONCAT('%',:zone_name)";
				$oZonesSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_name' => $sDomain));
				if ($oZonesSet->CountExceeds(0))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:ChangeOrg:Domain:HasZones');

					return;
				}
			}
		}

		// Make sure domain doesn't already exit
		$oDomainSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Domain AS d WHERE d.name = '$sDomain' AND d.org_id = $sOrgId"));
		while ($oDomain = $oDomainSet->Fetch())
		{
			// Check if it's a creation or a modification
			if ($iKey != $oDomain->GetKey())
			{
				// It's a creation
				//  If class View exist
				//	 If domain is not created in the same view, accept it.
				//   Deny it otherwise
				$bDenyCreation = true;
				if  (MetaModel::IsValidClass('View'))
				{
					if ($this->Get('view_id') != $oDomain->Get('view_id'))
					{
						$bDenyCreation = false;
					}                                     
				}
				if ($bDenyCreation)
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:Domain:NameCollision');
					return;
				}
			}
		}
		
	}

	/**
	 * Check if domain can be delegated
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
	function DoCheckToDelegate($aParam)
	{
		// Set working variables
		$iOrgId = $this->Get('org_id');
		$iDomainId = $this->GetKey();
		$iChildOrgId = $aParam['child_org_id'];
		$sDomain = $this->Get('name');

		//  Make sure that new child organization is different from the current one
		if ($iChildOrgId == $iOrgId)
		{
			return (Dict::Format('UI:IPManagement:Action:Delegate:Domain:NoChangeOfOrganization'));
		}

		// Make sure domain has no host
		$sOQL = "SELECT IPAddress AS i WHERE i.domain_name LIKE :domain AND i.org_id = :org_id";
		$oHostSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('domain' => '%'.$sDomain, 'org_id' => $iOrgId));
		if ($oHostSet->CountExceeds(0))
		{
			return (Dict::Format('UI:IPManagement:Action:Delegate:Domain:HasHosts'));
		}

		// Make sure domain has no sub domains
		$oSubDomainSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Domain AS d WHERE d.parent_id = $iDomainId"));
		if ($oSubDomainSet->CountExceeds(0))
		{
			return (Dict::Format('UI:IPManagement:Action:Delegate:Domain:HasSubDomains'));
		}

		// Make sure no zone exists for that domain
		if (MetaModel::IsValidClass('Zone'))
		{
			$sOQL = "SELECT Zone WHERE name LIKE CONCAT('%',:zone_name)";
			$oZonesSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_name' => $sDomain));
			if ($oZonesSet->CountExceeds(0))
			{
				return (Dict::Format('UI:IPManagement:Action:Delegate:Domain:HasZones'));
			}
		}

		// Everything looks good
		return '';
	}

	/**
	 * Check if Domain is delegated
	 *
	 * @throws \CoreException
	 */
	public function IsDelegated()
	{
		if ($this->Get('parent_org_id') != 0)
		{
			return true;
		}
		return false;
	}

	/**
	 * Delegate domain
	 *
	 * @param $aParam
	 *
	 * @return \CMDBObjectSet|\DBObjectSet
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \Exception
	 */
	public function DoDelegate($aParam)
	{
		$iOrgId = $this->Get('org_id');
		$iChildOrgId = $aParam['child_org_id'];

		$this->Set('parent_org_id', $iOrgId);
		$this->Set('org_id', $iChildOrgId);
		$this->DBUpdate();

		// Display result as array
		$oSet = CMDBobjectSet::FromArray('Domain', array($this));
		return ($oSet);
	}

	/**
	 * Check if domain can be undelegated
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
	public function DoCheckToUndelegate($aParam)
	{
		// Set working variables
		$iOrgId = $this->Get('org_id');
		$iDomainId = $this->GetKey();
		$sDomain = $this->Get('name');

		// Make sure domain is already delegated
		if ($this->Get('parent_org_id') == 0)
		{
			return (Dict::Format('UI:IPManagement:Action:Undelegate:Domain:IsNotDelegated'));
		}

		// Make sure domain has no host
		$sOQL = "SELECT IPAddress AS i WHERE i.domain_name LIKE :domain AND i.org_id = :org_id";
		$oHostSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('domain' => '%'.$sDomain, 'org_id' => $iOrgId));
		if ($oHostSet->CountExceeds(0))
		{
			return (Dict::Format('UI:IPManagement:Action:Undelegate:Domain:HasHosts'));
		}

		// Make sure domain has no sub domains
		$oSubDomainSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Domain AS d WHERE d.parent_id = $iDomainId"));
		if ($oSubDomainSet->CountExceeds(0))
		{
			return (Dict::Format('UI:IPManagement:Action:Undelegate:Domain:HasSubDomains'));
		}

		// Make sure no zone exists for that domain
		if (MetaModel::IsValidClass('Zone'))
		{
			$sOQL = "SELECT Zone WHERE name LIKE CONCAT('%',:zone_name)";
			$oZonesSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_name' => $sDomain));
			if ($oZonesSet->CountExceeds(0))
			{
				return (Dict::Format('UI:IPManagement:Action:Undelegate:Domain:HasZones'));
			}
		}

		// Everything looks good
		return '';
	}

	/**
	 * Undelegate domain
	 *
	 * @param $aParam
	 *
	 * @return \CMDBObjectSet|\DBObjectSet
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \Exception
	 */
	public function DoUndelegate($aParam)
	{
		$iParentOrgId = $this->Get('parent_org_id');

		$this->Set('parent_org_id', 0);
		$this->Set('org_id', $iParentOrgId);
		$this->DBUpdate();

		// Display result as array
		$oSet = CMDBobjectSet::FromArray('Domain', array($this));
		return ($oSet);
	}

	/**
	 * Change default flag of attribute.
	 *
	 * @param $sAttCode
	 * @param array $aReasons
	 *
	 * @return bool|int
	 * @throws \CoreException
	 */
	public function GetInitialStateAttributeFlags($sAttCode, &$aReasons = array())
	{
		$aHiddenAndReadOnlyAttributes = array('parent_org_id');
		if (in_array($sAttCode, $aHiddenAndReadOnlyAttributes))
		{
			return OPT_ATT_HIDDEN || OPT_ATT_READONLY;
		}
		return parent::GetInitialStateAttributeFlags($sAttCode, $aReasons);
	}

	/**
	 * @param string $sAttCode
	 * @param array $aReasons
	 * @param string $sTargetState
	 *
	 * @return int
	 * @throws \CoreException
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		$aReadOnlyAttributes = array('parent_org_id', 'parent_id');
		if (in_array($sAttCode, $aReadOnlyAttributes))
		{
			return OPT_ATT_READONLY;
		}
		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}

	/**
	 * Check if operation is feasible on current object
	 *
	 * @param $sOperation
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public function DoCheckOperation($sOperation)
	{
		switch($sOperation)
		{
			case 'delegate':
				// If domain is delegated, deny re-delegation
				// If delegation can be done to children orgs only,
				// 		Check if block's org has children
				// If not
				// 		Check if another organisation exists
				if ($this->Get('parent_org_id') != 0)
				{
					return ('IsDelegated');
				}
				else
				{
					$iOrgId = $this->Get('org_id');
					$sDelegateToChildrenOnly = IPConfig::GetFromGlobalIPConfig('delegate_domain_to_children_only', $iOrgId);
					if ($sDelegateToChildrenOnly == 'dtc_yes')
					{
						$oOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS child JOIN Organization AS parent ON child.parent_id BELOW parent.id WHERE parent.id = $iOrgId AND child.id != $iOrgId"));
						if (!$oOrgSet->CountExceeds(0))
						{
							return ('NoChildOrg');
						}
					}
					else
					{
						$oOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o WHERE o.id != $iOrgId"));
						if (!$oOrgSet->CountExceeds(0))
						{
							return ('NoOtherOrg');
						}
					}
				}
				break;

			case 'undelegate':
				break;

			default:
				return ('OperationNotAllowed');
		}
		return '';
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
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function DisplayActionFieldsForOperation(WebPage $oP, $sOperation, $iFormId, $aDefault)
	{
		$oP->add("<table>");
		$oP->add('<tr><td style="vertical-align:top">');

		$aDetails = array();
		switch ($sOperation)
		{
			case 'delegate':
				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Delegate:Domain:ChildDomain');

				$iOrgId = $this->Get('org_id');
				$sDelegateToChildrenOnly = IPConfig::GetFromGlobalIPConfig('delegate_domain_to_children_only', $iOrgId);
				if ($sDelegateToChildrenOnly == 'dtc_yes')
				{
					// Domain can only be delegated to children (or grand children) organization
					// Get block's children (list should not be empty at this stage)
					// Block is not already delegated (checked previously) so it can be delegated to child organization
					$oChildOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS child JOIN Organization AS parent ON child.parent_id BELOW parent.id WHERE parent.id = $iOrgId AND child.id != $iOrgId"));
				}
				else
				{
					// Block can be delegated to any organization
					$oChildOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o WHERE o.id != $iOrgId"));
				}

				// Display list of choices now
				$sAttCode = 'child_org_id';
				$sInputId = $iFormId.'_'.$sAttCode;
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
		$oP->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"BackToDetails('Domain', $iBlockId)\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;");

		// Apply button
		$oP->add("&nbsp;&nbsp<button type=\"submit\" class=\"action\"><span>".Dict::S('UI:Button:Apply')."</span></button></td></tr>");

		$oP->add("</table>");
	}

	/**
	 * Return next operation after current one
	 *
	 * @param $sOperation
	 *
	 * @return string
	 */
	public function GetNextOperation($sOperation)
	{
		switch ($sOperation)
		{
			case 'delegate': return 'dodelegate';
			case 'dodelegate': return 'delegate';

			default: return '';
		}
	}

	/**
	 * Get parameters used for operation
	 *
	 * @param $sOperation
	 *
	 * @return array
	 */
	public function GetPostedParam($sOperation)
	{
		$aParam = array();
		switch ($sOperation)
		{
			case 'dodelegate':
				$aParam['child_org_id'] = utils::ReadPostedParam('child_org_id', '', 'raw_data');
				break;

			default:
				break;
		}
		return $aParam;
	}

}
