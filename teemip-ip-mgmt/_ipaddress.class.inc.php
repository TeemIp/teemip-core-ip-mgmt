<?php
// Copyright (C) 2014 TeemIp
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
 * @copyright   Copyright (C) 2014 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

class _IPAddress extends IPObject
{
	/**
	 * Get the subnet mask of the subnet that the IP belongs to, if any.
	 */
	public function GetSubnetMaskFromIp()
	{
		return "";
	}
	
	/**
	 * Get the gateway of the subnet that the IP belongs to, if any.
	 */
	public function GetSubnetGatewayFromIp()
	{
		return "";
	}

	/**
	 * Check if IP's FQDN is unique.
	 */
	public function IsFqdnUnique()
	{
		$sOrgId = $this->Get('org_id');
		if ($this->IsNew())
		{
			$iKey = -1;
		}
		else
		{
			$iKey = $this->GetKey();
		}
		$sFqdn = $this->Get('fqdn');
		
		// The check takes into account the global parameters that defines if duplicate FQDNs are authorized or not
		$sIpAllowDuplicateName = utils::ReadPostedParam('attr_ip_allow_duplicate_name', '');
		if (empty($sIpAllowDuplicateName))
		{
			$sIpAllowDuplicateName = IPConfig::GetFromGlobalIPConfig('ip_allow_duplicate_name', $sOrgId);
		}
		if ($sIpAllowDuplicateName == 'ipdup_no')
		{
			if ($sFqdn != "")
			{
				$oIpSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPAddress AS i WHERE i.fqdn = '$sFqdn' AND i.org_id = $sOrgId AND i.id != $iKey"));
				// Match for creations is verbiden. Match for modifications as well unless the current name is kept
				while ($oIp = $oIpSet->Fetch())
				{
					// Check status of IP before complaining - Released IPs don't count.
					if ($oIp->Get('status') != 'released')
					{
						return false;
					}
				}
			}
		}
		return true;
	}

	/*
	 * Compute attributes before writing object 
	 */     
	public function ComputeValues()
	{
		// Set FQDN
		$sShortName = $this->Get('short_name');
		if ($sShortName != "")
		{
			$sDomainName = $this->Get('domain_name');
			if ($sDomainName != "")
			{
				// Domain names are always fully qualified
				$this->Set('fqdn', $sShortName.'.'.$sDomainName);			
			}
			else
			{
				$this->Set('fqdn', $sShortName.'.');			
			}
		}
		else
		{
			$this->Set('fqdn', '');			
		}
	}

	/*
	 * Computes and display specific tabs
	 */
	/**
	 * @param \WebPage $oPage
	 * @param bool $bEditMode
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public function DisplayBareRelations(WebPage $oPage, $bEditMode = false)
	{
		// Execute parent function first 
		parent::DisplayBareRelations($oPage, $bEditMode);
			
		if ($bEditMode)
		{
			// Tab for Global Parameters
			$oPage->SetCurrentTab(Dict::Format('Class:IPAddress/Tab:globalparam'));
			$oPage->p(Dict::Format('UI:IPManagement:Action:Modify:GlobalConfig'));
			$oPage->add('<table style="vertical-align:top"><tr>');
			$oPage->add('<td style="vertical-align:top">');

			if ($this->IsNew())
			{
				$aParameter = array ('ip_allow_duplicate_name', 'ping_before_assign');
			}
			else
			{
				$aParameter = array ('ip_allow_duplicate_name');
			}
			$this->DisplayGlobalParametersInLocalModifyForm($oPage, $aParameter);

			$oPage->add('</td>');
			$oPage->add('</tr></table>');
		}
		else
		{
			$iKey = $this->GetKey();

			// Tab for CIs using the IP
			$sClass = get_class($this);
			$aCIsToList = $this->GetListOfClassesWIthIP('leaf');
			$iNbAllCIs = 0;
			foreach ($aCIsToList as $sCI => $sKey)
			{
				$sOQL = "SELECT $sCI WHERE";
				$aIPAttributes = $aCIsToList[$sCI]['IPAddress'];
				for ($i = 0; $i < sizeof($aIPAttributes); $i++)
				{
					$sOQL = ($i == 0) ? $sOQL." ($aIPAttributes[$i] = $iKey)" : $sOQL." OR ($aIPAttributes[$i] = $iKey)";
				}
				$aIPvNAttributes = $aCIsToList[$sCI][$sClass];
				for($j = 0; $j < sizeof($aIPvNAttributes); $j++)
				{
					if ($i != 0)
					{
						$sOQL = $sOQL." OR ";
						$i = 0;
					}
					$sOQL = ($j == 0) ? $sOQL." ($aIPvNAttributes[$j] = $iKey)" : $sOQL." OR ($aIPvNAttributes[$j] = $iKey)";
				}
				$oCISearch = DBObjectSearch::FromOQL($sOQL);
				$oCISet = new CMDBObjectSet($oCISearch);
				// Obsolete CIs must be visible from the IP
				$oCISet->SetShowObsoleteData(true);
				$iNbCIs = $oCISet->Count();
				$aCIsToList[$sCI]['nb_to_list'] = $iNbCIs;
				$aCIsToList[$sCI]['set'] = $oCISet;
				$iNbAllCIs += $iNbCIs;
			}

			$oIPInterfaceToIPAddressSearch = DBObjectSearch::FromOQL("SELECT lnkIPInterfaceToIPAddress AS l WHERE l.ipaddress_id = $iKey");
			$oIPInterfaceToIPAddressSet = new CMDBObjectSet($oIPInterfaceToIPAddressSearch);
			// Obsolete CIs must be visible from the IP
			$oIPInterfaceToIPAddressSet->SetShowObsoleteData(true);
			$iNbIPInterfaces = $oIPInterfaceToIPAddressSet->Count();
			$iNbAllCIs += $iNbIPInterfaces;
			$oIPInterfaceSet = array();
			while ($oLnk = $oIPInterfaceToIPAddressSet->fetch())
			{
				$iIpIntKey = $oLnk->Get('ipinterface_id');
				$oIPInterfaceSet[] = MetaModel::GetObject('IPInterface', $iIpIntKey, false);
			}
			$oIPInterfaceSet = CMDBObjectSet::FromArray('IPInterface', $oIPInterfaceSet);
			$oIPInterfaceSet->SetShowObsoleteData(true);

			if ($iNbAllCIs != 0)
			{
				$oPage->SetCurrentTab(Dict::S('Class:IPAddress/Tab:ci_list').' ('.$iNbAllCIs.')');
				$oPage->p(Dict::Format('Class:IPAddress/Tab:ci_list+'));
				foreach ($aCIsToList as $sCI => $sKey)
				{
					if  ($aCIsToList[$sCI]['nb_to_list'] != 0)
					{
						$sClass = $aCIsToList[$sCI]['set']->GetClass();
						$oPage->p(MetaModel::GetClassIcon($sClass).'&nbsp;'.Dict::Format('Class:IPAddress/Tab:ci_list_class', MetaModel::GetName($sClass)));
						// Use DisplayBlock::FromObjectSet and not new DisplayBlock to make sure obsolete CIs are displayd
						$oBlock = DisplayBlock::FromObjectSet($aCIsToList[$sCI]['set'], 'list', array('show_obsolete_data' => true));
						$oBlock->Display($oPage, $sCI, array('menu' => false));
					}
				}

				if ($iNbIPInterfaces != 0)
				{
					$sClass = $oIPInterfaceSet->GetClass();
					$oPage->p(MetaModel::GetClassIcon($sClass).'&nbsp;'.Dict::Format('Class:IPAddress/Tab:ci_list_class', MetaModel::GetName($sClass)));
					// Use DisplayBlock::FromObjectSet and not new DisplayBlock to make sure obsolete interfaces are displayd
					$oBlock = DisplayBlock::FromObjectSet($oIPInterfaceSet, 'list', array('show_obsolete_data' => true));
					$oBlock->Display($oPage, 'ii_id', array('menu' => false));
				}
			}
			else
			{
				$oPage->SetCurrentTab(Dict::S('Class:IPAddress/Tab:ci_list'));
				$oPage->p(MetaModel::GetClassIcon('FunctionalCI').'&nbsp;'.Dict::Format('Class:IPAddress/Tab:NoCi+'));
			}


			// Tab for related IP Requests, if any
			if  (MetaModel::IsValidClass('IPRequestAddress'))
			{
				$oIpRequestSearch = DBObjectSearch::FromOQL("SELECT IPRequestAddress AS r WHERE r.ip_id = $iKey");
				$oIpRequestSet = new CMDBObjectSet($oIpRequestSearch);
				$oIpRequestSet->SetShowObsoleteData(utils::ShowObsoleteData());
				$sCount = $oIpRequestSet->Count();
				if ($sCount != 0)
				{
					$oPage->SetCurrentTab(Dict::S('Class:IPAddress/Tab:requests').' ('.$sCount.')');
					$oPage->p(MetaModel::GetClassIcon('IPRequestAddress').'&nbsp;'.Dict::Format('Class:IPAddress/Tab:requests+'));
					$oBlock = new DisplayBlock($oIpRequestSearch, 'list');
					$oBlock->Display($oPage, 'ip_requests', array('menu' => false));
				}
				else
				{
					$oPage->SetCurrentTab(Dict::S('Class:IPAddress/Tab:requests'));
					$oPage->p(MetaModel::GetClassIcon('IPRequestAddress').'&nbsp;'.Dict::S('Class:IPAddress/Tab:norequests+'));
				}
			}
		}
  	}
  	
  	/**
	 * Check validity of new IP attributes before creation
	 */
	public function DoCheckToWrite()
	{
		// Run standard iTop checks first
		parent::DoCheckToWrite();
		
		// Make sure name doesn't already exist (matches)
		if (! $this->IsFqdnUnique())
		{
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPAddress:IPNameCollision');
		}
		return;
	}

	/**
	 * Check if operation is feasible on current object
	 */
	public function DoCheckOperation($sOperation)
	{
		switch ($sOperation)
		{
			case 'allocateip':
				if ($this->Get('status') == 'allocated')
				{
					return ('IPAlreadyAllocated');
				}
				break;

			case 'unallocateip':
				if ($this->Get('status') != 'allocated')
				{
					return ('IPNotAllocated');
				}
				break;

			default:
				return ('OperationNotAllowed');
		}
		return '';
	}

	/**
	 * Get parameters used for operation
	 */
	public function GetPostedParam($sOperation)
	{
		$aParam = array();
		switch ($sOperation)
		{
			case 'doallocateip':
				$aParam['ciclass'] = utils::ReadPostedParam('attr_ciclass', '', 'raw_data');
				$aParam['ci_id'] = utils::ReadPostedParam('attr_ci_id', '', 'raw_data');
				$aParam['ipattribute'] = utils::ReadPostedParam('attr_ipattribute', '', 'raw_data');
				break;

			case 'dounallocateip':
				break;

			default:
				break;
		}
		return $aParam;
	}

	/**
	 * Display attributes associated operation
	 */
	public function DisplayActionFieldsForOperation(WebPage $oPage, $sOperation, $iFormId, $aDefault)
	{
		$oPage->add("<table>");
		$oPage->add('<tr><td style="vertical-align:top">');

		$sClass = get_class($this);
		$iId = $this->GetKey();
		switch ($sOperation)
		{
			case 'allocateip':
				$iOrgId = $this->Get('org_id');

				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Allocate:IPAddress:Class');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:Allocate:IPAddress:CI');
				$sLabelOfAction3 = Dict::S('UI:IPManagement:Action:Allocate:IPAddress:IPAttribute');

				// Target Class
				$aCIClassesWithIp = IPAddress::GetListOfClassesWIthIP('leaf');
				$sClassInputId = 'field_'.$iFormId.'_ciclass';
				$sHTMLValue = "<select name=\"attr_ciclass\" id=\"$sClassInputId\" >";
				$bIsDefaultSet = false;
				foreach($aCIClassesWithIp as $sCIClass => $sKey)
				{
					$oCISet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT FunctionalCI AS ci WHERE ci.org_id = :org_id AND ci.finalclass = :ciclass"),
					array(), array('org_id' => $iOrgId, 'ciclass' => $sCIClass));
					if ($oCISet->CountExceeds(0))
					{
						// Propose only CIs that are already instanciated
						$sClassName = MetaModel::GetName($sCIClass);
						if ($bIsDefaultSet)
						{
							$sHTMLValue .= "<option value=\"$sCIClass\">$sClassName</option>\n";
						}
						else
						{
							$bIsDefaultSet = true;
							$sFirstCIClassInList = $sCIClass;
							$sHTMLValue .= "<option selected='' value=\"$sCIClass\">$sClassName</option>\n";
						}
					}
				}
				$sHTMLValue .= "</select>";
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction1.'</span>', 'value' => $sHTMLValue);

				// Functional CI
				$oCISet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT FunctionalCI AS ci WHERE ci.org_id = :org_id AND ci.finalclass = :ciclass"), array(), array('org_id' => $iOrgId, 'ciclass' => $sFirstCIClassInList));
				$oCISet->SetShowObsoleteData(utils::ShowObsoleteData());
				$oCISet->Rewind();

				$sCIInputId = 'field_'.$iFormId.'_ci_id';
				$sHTMLValue = "<div class=\"field_select_wrapper\">";
				$sHTMLValue .= "<div><span id=\"v_ci_id\">";
				$sHTMLValue .= "<select title=\"\" name=\"attr_ci_id\" id=\"$sCIInputId\" >";
				while ($oObj = $oCISet->Fetch())
				{
					$key = $oObj->GetKey();
					$display_value = $oObj->GetName();

					$sHTMLValue .= "<option value=\"$key\">$display_value</option>";
				}
				$sHTMLValue .= "</select>";
				$sHTMLValue .= "</span></div></div>";
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction2.'</span>', 'value' => $sHTMLValue);

				// IPAddress attribute
				$sAttributeInputId = 'field_'.$iFormId.'_ipattribute';
				$sHTMLValue = "<div class=\"field_select_wrapper\">";
				$sHTMLValue .= "<div><span id=\"v_att_id\">";
				$sHTMLValue .= "<select name=\"attr_ipattribute\" id=\"$sAttributeInputId\" >";
				foreach($aCIClassesWithIp[$sFirstCIClassInList]['IPAddress'] as $sKey => $sAttribute)
				{
					$oAttDef = MetaModel::GetAttributeDef($sFirstCIClassInList, $sAttribute);
					$sAttributeName = $oAttDef->GetLabel();
					$sHTMLValue .= "<option value=\"$sAttribute\">$sAttributeName</option>\n";
				}
				foreach($aCIClassesWithIp[$sFirstCIClassInList][$sClass] as $sKey => $sAttribute)
				{
					$oAttDef = MetaModel::GetAttributeDef($sFirstCIClassInList, $sAttribute);
					$sAttributeName = $oAttDef->GetLabel();
					$sHTMLValue .= "<option value=\"$sAttribute\">$sAttributeName</option>\n";
				}
				$sHTMLValue .= "</select>";
				$sHTMLValue .= "</span></div></div>";
				$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction3.'</span>', 'value' => $sHTMLValue);

				$oPage->Details($aDetails);
				$oPage->add('</td></tr>');

				$sHTMLValue = "<img src=\"'+GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/images/ipindicator-xs.gif\" />";
				$oPage->add_ready_script(
<<<EOF
			    $('#$sClassInputId').bind('change', function() {			        
					var oParams = { 
						operation: 'get_cis_to_allocate',
						vid: '$sCIInputId',
						class: '$sClass',
						default: {'org_id': '$iOrgId', 'ciclass': $('#$sClassInputId').val()}
						}
					$('#v_ci_id').html( $('#v_ci_id').html() ).append('$sHTMLValue');
					$.post(GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/ajax.teemip-ip-mgmt.php', oParams, function(data) { $('#v_ci_id').html(data); });
					});					
EOF
				);
				$sClassesWithIP = json_encode($aCIClassesWithIp);
				$oPage->add_ready_script(
<<<EOF
			    $('#$sClassInputId').bind('change', function() {			        
					var oParams = { 
						operation: 'get_attribute_to_allocate',
						vid: '$sAttributeInputId',
						class: '$sClass',
						default: {'ciclasseswithip': '$sClassesWithIP', 'ciclass': $('#$sClassInputId').val()}
						}
					$('#v_att_id').html( $('#v_att_id').html() ).append('$sHTMLValue');
					$.post(GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/ajax.teemip-ip-mgmt.php', oParams, function(data) { $('#v_att_id').html(data); });
					});					
EOF
				);
				break;

			default:
				break;
		}

		// Cancell button
		$oPage->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"BackToDetails('$sClass', $iId)\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;");

		// Apply button
		$oPage->add("&nbsp;&nbsp<button type=\"submit\" class=\"action\"><span>".Dict::S('UI:Button:Apply')."</span></button></td></tr>");

		$oPage->add("</table>");
	}

	/**
	 * Return next operation after current one
	 */
	public function GetNextOperation($sOperation)
	{
		switch ($sOperation)
		{
			case 'allocateip': return 'doallocateip';
			case 'doallocateip': return 'allocateip';

			default: return '';
		}
	}

	/**
	 * Check if IP can be allocated
	 */
	public function DoCheckToAllocate($aParam)
	{
		$sClass = $aParam['ciclass'];
		$id = $aParam['ci_id'];
		$sIPAttribute = $aParam['ipattribute'];

		$oCI = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
		if (is_null($oCI))
		{
			return (Dict::Format('UI:IPManagement:Action:Allocate:IPAddress:CIDoesNotExist'));
		}
		else
		{
			$iFlags = $oCI->GetFormAttributeFlags($sIPAttribute);
			if ($iFlags & OPT_ATT_SLAVE)
			{
				// Attribute is actually read only because of a synchro
				return (Dict::Format('UI:IPManagement:Action:Allocate:IPAddress:AttributeIsSynchronized'));
			}
		}
		return '';
	}

	/**
	 * Check if CI can be allocated
	 */
	public function DoCheckToUnallocate($aParam)
	{
		if ($this->Get('status') != 'allocated')
		{
			return (Dict::Format('UI:IPManagement:Action:UnAllocate:IPAddress:IPNotAllocated'));
		}
		return '';
	}

	/**
	 * Allocated CI
	 */
	public function DoAllocate($aParam)
	{
		$sClass = $aParam['ciclass'];
		$id = $aParam['ci_id'];
		$sIPAttribute = $aParam['ipattribute'];

		// Attach IP to CI
		$oCI = MetaModel::GetObject($sClass, $id, true /* MustBeFound */);
		$oCI->Set($sIPAttribute, $this->GetKey());
		$oCI->DBUpdate();

		// Update IP status
		$this->Set('status', 'allocated');
		$this->DBUpdate();

		// Display result as array
		$oSet = CMDBobjectSet::FromArray(get_class($this), array($this));
		return ($oSet);
	}

	/**
	 * Remove IP from the CIs it is attached to
	 */
	public function RemoveFromCIs()
	{
		$sCLass = get_class($this);
		$aCIsToList = $this->GetListOfClassesWIthIP('leaf');
		$iKey = $this->GetKey();
		foreach ($aCIsToList as $sCI => $sKey)
		{
			$aIPAttributes = array_merge($aCIsToList[$sCI]['IPAddress'], $aCIsToList[$sCI][$sCLass]);
			foreach ($aIPAttributes AS $key => $sIPAttribute)
			{
				$oCISearch = DBObjectSearch::FromOQL("SELECT $sCI WHERE $sIPAttribute = $iKey");
				$oCISet = new CMDBObjectSet($oCISearch);
				while ($oCI = $oCISet->Fetch())
				{
					$oCI->Set($sIPAttribute, '');
					$oCI->DBUpdate();
				}
			}
		}
	}

	/*
	 * Remove IP from the interfaces it is attached to
	 */
	public function RemoveFromInterfaces()
	{
		$iKey = $this->GetKey();
		$oLnkSearch = DBObjectSearch::FromOQL("SELECT lnkIPInterfaceToIPAddress WHERE ipaddress_id = $iKey");
		$oLnkSet = new CMDBObjectSet($oLnkSearch);
		while ($oLnk = $oLnkSet->Fetch())
		{
			$oLnk->DBDelete();
		}
	}

	/**
	 * Unallocated CI
	 */
	public function DoUnallocate($aParam)
	{
		// Remove from CIs & interfaces
		$this->RemoveFromCIs();
		$this->RemoveFromInterfaces();

		// Update IP status
		$this->Set('status', 'unassigned');
		$this->DBUpdate();

		// Display result as array
		$oSet = CMDBobjectSet::FromArray(get_class($this), array($this));
		return ($oSet);
	}

	/**
	 * Change flag of attributes that shouldn't be modified beside creation.
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		switch ($sAttCode)
		{
			case 'fqdn':
			case 'last_discovery_date':
			case 'responds_to_ping':
			case 'responds_to_iplookup':
			case 'fqdn_from_iplookup':
			case 'responds_to_scan':
				return OPT_ATT_READONLY;
				
			default:
				break;
		}
		if ((!$this->IsNew()) && ($sAttCode == 'org_id'))
		{
			return OPT_ATT_READONLY;
		}
		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}
	
	/**
	 * Change flag of attributes that shouldn't be modified at creation.
	 */
	public function GetInitialStateAttributeFlags($sAttCode, &$aReasons = array())
	{
		switch ($sAttCode)
		{
			case 'fqdn':
			case 'last_discovery_date':
			case 'responds_to_ping':
			case 'responds_to_iplookup':
			case 'fqdn_from_iplookup':
			case 'responds_to_scan':
				return OPT_ATT_READONLY;
				
			default:
				break;
		}
		return parent::GetInitialStateAttributeFlags($sAttCode, $aReasons);
	}
	
	/**
	 * Manage status of IP when attached to a device 
	 */					   
	public static function SetStatusOnAttachment ($iIpId = null, $iPreviousIpId = null)
	{
		if ($iIpId != $iPreviousIpId) 
		{
			if ($iIpId != null)
			{
				$oIP = MetaModel::GetObject('IPAddress', $iIpId, false /* MustBeFound */);
				if ($oIP != null)
				{
					if ($oIP->Get('status') != 'allocated')
					{
						$oIP->Set('status', 'allocated');	
						$oIP->DBUpdate();
					}
				}
			}
			if ($iPreviousIpId != null)
			{
				$oIP = MetaModel::GetObject('IPAddress', $iPreviousIpId, false /* MustBeFound */);
				if ($oIP != null)
				{
					if ($oIP->Get('status') == 'allocated')
					{
						$oIP->Set('status', 'unassigned');	
						$oIP->DBUpdate();
					}
				}
			}
		}
	}
	
	/**
	 * Manage status of IP when deattached from a device 
	 */
	public static function SetStatusOnDetachment ($iIpId = null)
	{
		if ($iIpId != null)
		{
			$oIP = MetaModel::GetObject('IPAddress', $iIpId, false /* MustBeFound */);
			if ($oIP != null)
			{
				if ($oIP->Get('status') == 'allocated')
				{
					$oIP->Set('status', 'unassigned');
					$oIP->DBUpdate();
				}
			}
		}
	}

	/**
	 * Manage shortname of IP when attached to a device
	 */
	public static function SetShortNameOnAttachment ($iOrgId = null, $sShortName = '', $iIpId = null, $iPreviousIpId = null)
	{
		if ($iOrgId != null)
		{
			$sCopyCINameToShortName = IPConfig::GetFromGlobalIPConfig('ip_copy_ci_name_to_shortname', $iOrgId);
			if ($sCopyCINameToShortName == 'yes')
			{
				if ($iPreviousIpId != null)
				{
					$oIP = MetaModel::GetObject('IPAddress', $iPreviousIpId, false /* MustBeFound */);
					if ($oIP != null)
					{
						$oIP->Set('short_name', '');
						$oIP->DBUpdate();
					}
				}
				if ($iIpId != null)
				{
					$oIP = MetaModel::GetObject('IPAddress', $iIpId, false /* MustBeFound */);
					if ($oIP != null)
					{
						$oAttDef = MetaModel::GetAttributeDef('IPAddress', 'short_name');
						if ($oAttDef->CheckFormat($sShortName))
						{
							$oIP->Set('short_name', $sShortName);
							$oIP->DBUpdate();
						}
					}
				}
			}
		}
	}

	/*
	 * Get the list of classes referencing the IPAddress class
	 * Restrict list to non abstract classes inherited from 'FunctionalCI'
	 * For each class, we get an array of all attributes being an external key to an IPAddress object
	 */
	public static function GetListOfClassesWIthIP($sMode = 'leaf')
	{
		$aFunctionalCIChildClasses = MetaModel::EnumChildClasses('FunctionalCI', ENUM_CHILD_CLASSES_EXCLUDETOP);
		$aIPClasses = array();
		switch ($sMode)
		{
			case 'root':
				break;

			case 'leaf':
				foreach ($aFunctionalCIChildClasses AS $sClass)
				{
					if (MetaModel::IsAbstract($sClass))
					{
						continue;
					}
					$aExternalKeys = MetaModel::GetExternalKeys($sClass);
					$aIPAttributes = array();
					$aIPv4Attributes = array();
					$aIPv6Attributes = array();
					foreach ($aExternalKeys AS $oExternalKey)
					{
						$sTargetClass = $oExternalKey->GetTargetClass();
						if ($sTargetClass == 'IPAddress')
						{
							$aIPAttributes[] = $oExternalKey->GetCode();
						}
						elseif ($sTargetClass == 'IPv4Address')
						{
							$aIPv4Attributes[] = $oExternalKey->GetCode();
						}
						elseif ($sTargetClass == 'IPv6Address')
						{
							$aIPv6Attributes[] = $oExternalKey->GetCode();
						}
					}
					if ((sizeof ($aIPAttributes) != 0) || (sizeof ($aIPv4Attributes) != 0) || (sizeof ($aIPv6Attributes) != 0))
					{
						$aIPClasses[$sClass]['IPAddress'] = $aIPAttributes;
						$aIPClasses[$sClass]['IPv4Address'] = $aIPv4Attributes;
						$aIPClasses[$sClass]['IPv6Address'] = $aIPv6Attributes;
					}
				}
				ksort($aIPClasses);
				break;

			default:
				break;
		}
		return $aIPClasses;
	}

	/*
	 * Prototypes for DNS management
	 */
	public function DoCheckUpdateRRs()
	{

	}

	public function UpdateRRs()
	{

	}

	public function CleanRRs()
	{

	}

	/*
	 * Perform actions after new object inserted in DB
	 */
	public function AfterInsert()
	{
		// Handle DNS records
		if (MetaModel::IsValidClass('Zone'))
		{
			$sIpUpdateDNSRecords = IPConfig::GetFromGlobalIPConfig('ip_update_dns_records', $this->Get('org_id'));
			if ($sIpUpdateDNSRecords == 'yes')
			{
				$sError = $this->DoCheckUpdateRRs();
				if ($sError != '')
				{
					$this->CleanRRs();
				}
				else
				{
					$this->UpdateRRs();
				}
			}
		}
	}

	/*
	 * Perform actions after object is updated in DB
	 */
	public function AfterUpdate()
	{
		parent::AfterUpdate();

		// Remove IP from CIs & interfaces when it is released
		$sStatus = $this->Get('status');
		if ($sStatus == 'released')
		{
			$aChanges = $this->ListChanges();
			// $aChanges will remain empty for iTop <= 2.6. So, do the change anyway until then.
			//if (array_key_exists('status', $aChanges))
			//{
				$this->RemoveFromCIs();
				$this->RemoveFromInterfaces();
			//}
		}

		if (MetaModel::IsValidClass('Zone'))
		{
			$sIpUpdateDNSRecords = IPConfig::GetFromGlobalIPConfig('ip_update_dns_records', $this->Get('org_id'));
			if ($sIpUpdateDNSRecords == 'yes')
			{
				$sError = $this->DoCheckUpdateRRs();
				if ($sError != '')
				{
					$this->CleanRRs();
				}
				else
				{
					$this->UpdateRRs();
				}
			}
		}
	}

	/*
	 * Perform actions after object is removed from DB
	 */
	public function AfterDelete()
	{
		parent::AfterDelete();

		// Handle DNS records
		if (MetaModel::IsValidClass('Zone'))
		{
			$sIpUpdateDNSRecords = IPConfig::GetFromGlobalIPConfig('ip_update_dns_records', $this->Get('org_id'));
			if ($sIpUpdateDNSRecords == 'yes')
			{
				$this->CleanRRs();
			}
		}
	}


}
