<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\NetworkManagement\Model;

use ApplicationContext;
use CMDBObjectSet;
use Combodo\iTop\Application\UI\Base\Component\Html\HtmlFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\Select\SelectOptionUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\SelectUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\Column\Column;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\MultiColumn;
//use Combodo\iTop\Application\WebPage\WebPage;
use DBObjectSearch;
use Dict;
use DNSObject;
use IPConfig;
use iTopWebPage;
use MetaModel;
use TeemIp\TeemIp\Extension\Framework\Helper\IPUtils;
use TeemIp\TeemIp\Extension\Framework\Helper\iTree;
use utils;
use WebPage;

class _Domain extends DNSObject implements iTree {
	/**
	 * Returns index to be used within tree computations
	 *
	 * @return string
	 * @throws \CoreException
	 */
	public function GetIndexForTree() {
		return $this->GetName();
	}

	/**
	 * Display domain as tree leaf
	 *
	 * @param bool $bWithIcon
	 * @param $iTreeOrgId
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	public function GetAsLeaf($bWithIcon, $iTreeOrgId) {
		$sHtml = '';
		$sHtml .= $this->GetHyperlink();

		// Display delegation information if required
		$iOrgId = $this->Get('org_id');
		$iParentOrgId = $this->Get('parent_org_id');
		if ($iParentOrgId != 0) {
			if ($iTreeOrgId == $iOrgId) {
				// Domain is delegated from parent org
				$sHtml .= "&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:Domain:DelegatedFromParent', $this->GetAsHTML('parent_org_id'));
			} else {
				// Domain is delegated to child org
				$sHtml .= "&nbsp;&nbsp;&nbsp; - ".Dict::Format('Class:Domain:DelegatedToChild', $this->GetAsHTML('org_id'));
			}
		}

		return $sHtml;
	}

	/**
	 * Provides longer domain name contained in FQDN
	 *
	 * @param $sFqdn
	 * @param $iOrgId
	 *
	 * @return array
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	static function GetDomainFromFqdn($sFqdn, $iOrgId) {
		$sError = '';
		if ((strlen($sFqdn) == 0) || ($iOrgId == 0)) {
			return array(Dict::Format('UI:IPManagement:Action:ExplodeFQDN:Domain:Error:CannotFindDomain'), 0, '');
		}
		$sOQL = "SELECT Domain WHERE org_id = :org_id AND name = :name";
		$oDomainSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('org_id' => $iOrgId, 'name' => $sFqdn));
		if ($oDomain = $oDomainSet->Fetch()) {
			$iDomainId = $oDomain->GetKey();
			$sDomainName = $oDomain->Get('name');
		} else {
			$i = strpos($sFqdn, '.');
			$sNextFqdn = substr($sFqdn, $i + 1);
			list($sError, $iDomainId, $sDomainName) = static::GetDomainFromFqdn($sNextFqdn, $iOrgId);
		}

		return array($sError, $iDomainId, $sDomainName);
	}

    /**
     * * @inheritdoc
     *
     */
	public function DisplayBareRelations(WebPage $oPage, $bEditMode = false) {
		// Execute parent function first 
		parent::DisplayBareRelations($oPage, $bEditMode);

		if (!$this->IsNew()) {
			$iOrgId = $this->Get('org_id');
			$sDomainName = $this->GetName();
			$iDomainKey = $this->GetKey();

			// Tab for hosts in the domain
			$iHostsFilter = intval(utils::ReadParam('host_filter', '0'));
			switch ($iHostsFilter) {
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
			$oHostsSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array(
				'domain_name' => $sDomainName,
				'domain_family' => '%'.$sDomainName,
				'org_id' => $iOrgId,
			));
			// Then, display form to select list of hosts if domain is not in edition
			$sHtml = '';
			if ($this->GetDisplayMode() == static::ENUM_DISPLAY_MODE_VIEW) {
				$sHtml = '<div style="padding: 15px; background: #f8f9fa;">';
				$sHtml .= "<form>";
				$sHtml .= "<table>";

				$sHtml .= "<tr>";
				$sChecked = ($iHostsFilter == 0) ? 'checked' : '';
				if (!$sChecked) {
					$sHtml .= "<td><label><input type=\"radio\" $sChecked name=\"host_filter\" value=\"0\">&nbsp;".Dict::S('Class:Domain/Tab:hosts/SelectList0')."&nbsp;&nbsp;</label></td>";
				}
				$sChecked = ($iHostsFilter == 1) ? 'checked' : '';
				if (!$sChecked) {
					$sHtml .= "<td><label><input type=\"radio\" $sChecked name=\"host_filter\" value=\"1\">&nbsp;".Dict::S('Class:Domain/Tab:hosts/SelectList1')."&nbsp;&nbsp;</label></td>";
				}
				$sChecked = ($iHostsFilter == 2) ? 'checked' : '';
				if (!$sChecked) {
					$sHtml .= "<td><label><input type=\"radio\" $sChecked name=\"host_filter\" value=\"2\">&nbsp;".Dict::S('Class:Domain/Tab:hosts/SelectList2')."&nbsp;&nbsp;</label></td>";
				}
				$sHtml .= "</tr>\n";

				$sHtml .= "</table><br>\n";

				$sHtml .= "<input type=\"hidden\" name=\"class\" value=\"Domain\">\n";
				$sHtml .= "<input type=\"hidden\" name=\"id\" value=\"$iDomainKey\">\n";
				$sHtml .= "<input type=\"hidden\" name=\"operation\" value=\"details\">\n";
				$sHtml .= "<input type=\"hidden\" name=\"transaction_id\" value=\"".utils::GetNewTransactionId()."\">\n";
				$oAppContext = new ApplicationContext();
				$sHtml .= $oAppContext->GetForForm();
				$sHtml .= "<input type=\"submit\" value=\"".Dict::S('Class:Domain/Tab:hosts/SelectList')."\">\n";

				$sHtml .= "</form>\n";
				$sHtml .= "</div><br>";
			}
			$sName = Dict::Format('Class:Domain/Tab:hosts');
			IPUtils::DisplayTabContent($oPage, $sName, 'child_hosts', 'IPAddress', $sTitle, $sHtml, $oHostsSet, false);

			// Tab for child domains
			$sOQL = "SELECT Domain AS dc JOIN Domain AS dp ON dc.parent_id BELOW dp.id WHERE dp.id = :domain_id AND dc.id != :domain_id";
			$oDomainsSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('domain_id' => $iDomainKey));

			$sName = Dict::Format('Class:Domain/Tab:child_domain');
			$sTitle = Dict::Format('Class:Domain/Tab:child_domain+');
			IPUtils::DisplayTabContent($oPage, $sName, 'child_domains', 'Domain', $sTitle, '', $oDomainsSet, false);

			// Tab for related zones
			if (class_exists('Zone')) {
				$sOQL = "SELECT Zone WHERE name LIKE CONCAT('%',:zone_name)";
				$oZonesSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_name' => $this->GetName()));

				$sName = Dict::Format('Class:Domain/Tab:zones_list');
				$sTitle = Dict::Format('Class:Domain/Tab:zones_list+');
				IPUtils::DisplayTabContent($oPage, $sName, 'associated_zones', 'Zone', $sTitle, '', $oZonesSet, false);
			}
		}
	}

	/**
	 * Compute attributes before writing object
	 *
	 * @throws \CoreException
	 */
	public function ComputeValues() {
		parent::ComputeValues();

		$this->Set('name', static::ComputeFqdn($this->Get('name'), $this->Get('parent_name')));
	}

	/**
	 * Check validity of new IP attributes before creation
	 *
	 * @throws \CoreException
	 */
	public function DoCheckToWrite() {
		// Run standard iTop checks first
		parent::DoCheckToWrite();

		$sOrgId = $this->Get('org_id');
		$sOriginalOrgId = $this->GetOriginal('org_id');
		$iKey = $this->GetKey();
		$sDomain = $this->Get('name');

		// If organization is changing, make sure domain has no host, no child domain and no associated zone.
		if (!is_null($sOriginalOrgId) && ($sOrgId != $sOriginalOrgId)) {
			$sOQL = "SELECT Domain AS d WHERE d.parent_id = :key";
			$oChildDomainSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('key' => $iKey));
			if ($oChildDomainSet->CountExceeds(0)) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:ChangeOrg:Domain:HasChildren');

				return;
			}
			$sOQL = "SELECT IPAddress AS i WHERE i.domain_name LIKE :domain AND i.org_id = :org_id";
			$oHostSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('domain' => '%'.$sDomain, 'org_id' => $sOrgId));
			if ($oHostSet->CountExceeds(0)) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:ChangeOrg:Domain:HasHosts');

				return;
			}
			if (MetaModel::IsValidClass('Zone')) {
				$sOQL = "SELECT Zone WHERE name LIKE CONCAT('%',:zone_name)";
				$oZonesSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_name' => $sDomain));
				if ($oZonesSet->CountExceeds(0)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:ChangeOrg:Domain:HasZones');

					return;
				}
			}
		}

		// Make sure domain doesn't already exit
		$oDomainSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Domain AS d WHERE d.name = '$sDomain' AND d.org_id = $sOrgId"));
		while ($oDomain = $oDomainSet->Fetch()) {
			// Check if it's a creation or a modification
			if ($iKey != $oDomain->GetKey()) {
				// It's a creation
				//  If class View exist
				//	 If domain is not created in the same view, accept it.
				//   Deny it otherwise
				$bDenyCreation = true;
				if (MetaModel::IsValidClass('View')) {
					if ($this->Get('view_id') != $oDomain->Get('view_id')) {
						$bDenyCreation = false;
					}
				}
				if ($bDenyCreation) {
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
	public function DoCheckToDelegate($aParam) {
		// Set working variables
		$iOrgId = $this->Get('org_id');
		$iDomainId = $this->GetKey();
		$iChildOrgId = $aParam['child_org_id'];
		$sDomain = $this->Get('name');

		//  Make sure that new child organization is different from the current one
		if ($iChildOrgId == $iOrgId) {
			return (Dict::Format('UI:IPManagement:Action:Delegate:Domain:NoChangeOfOrganization'));
		}

		// Make sure domain has no host
		$sOQL = "SELECT IPAddress AS i WHERE i.domain_name LIKE :domain AND i.org_id = :org_id";
		$oHostSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('domain' => '%'.$sDomain, 'org_id' => $iOrgId));
		if ($oHostSet->CountExceeds(0)) {
			return (Dict::Format('UI:IPManagement:Action:Delegate:Domain:HasHosts'));
		}

		// Make sure domain has no sub domains
		$oSubDomainSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Domain AS d WHERE d.parent_id = $iDomainId"));
		if ($oSubDomainSet->CountExceeds(0)) {
			return (Dict::Format('UI:IPManagement:Action:Delegate:Domain:HasSubDomains'));
		}

		// Make sure no zone exists for that domain
		if (MetaModel::IsValidClass('Zone')) {
			$sOQL = "SELECT Zone WHERE name LIKE CONCAT('%',:zone_name)";
			$oZonesSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_name' => $sDomain));
			if ($oZonesSet->CountExceeds(0)) {
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
	public function IsDelegated() {
		if ($this->Get('parent_org_id') != 0) {
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
	public function DoDelegate($aParam) {
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
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public function DoCheckToUndelegate() {
		// Set working variables
		$iOrgId = $this->Get('org_id');
		$iDomainId = $this->GetKey();
		$sDomain = $this->Get('name');

		// Make sure domain is already delegated
		if ($this->Get('parent_org_id') == 0) {
			return (Dict::Format('UI:IPManagement:Action:Undelegate:Domain:IsNotDelegated'));
		}

		// Make sure domain has no host
		$sOQL = "SELECT IPAddress AS i WHERE i.domain_name LIKE :domain AND i.org_id = :org_id";
		$oHostSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('domain' => '%'.$sDomain, 'org_id' => $iOrgId));
		if ($oHostSet->CountExceeds(0)) {
			return (Dict::Format('UI:IPManagement:Action:Undelegate:Domain:HasHosts'));
		}

		// Make sure domain has no sub domains
		$oSubDomainSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Domain AS d WHERE d.parent_id = $iDomainId"));
		if ($oSubDomainSet->CountExceeds(0)) {
			return (Dict::Format('UI:IPManagement:Action:Undelegate:Domain:HasSubDomains'));
		}

		// Make sure no zone exists for that domain
		if (MetaModel::IsValidClass('Zone')) {
			$sOQL = "SELECT Zone WHERE name LIKE CONCAT('%',:zone_name)";
			$oZonesSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_name' => $sDomain));
			if ($oZonesSet->CountExceeds(0)) {
				return (Dict::Format('UI:IPManagement:Action:Undelegate:Domain:HasZones'));
			}
		}

		// Everything looks good
		return '';
	}

	/**
	 * Undelegate domain
	 *
	 * @return \CMDBObjectSet|\DBObjectSet
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \Exception
	 */
	public function DoUndelegate() {
		$iParentOrgId = $this->Get('parent_org_id');

		$this->Set('parent_org_id', 0);
		$this->Set('org_id', $iParentOrgId);
		$this->DBUpdate();

		// Display result as array
		$oSet = CMDBobjectSet::FromArray('Domain', array($this));

		return ($oSet);
	}

	/**
	 * @inheritdoc
	 */
	public function GetInitialStateAttributeFlags($sAttCode, &$aReasons = array()) {
		$sFlagsFromParent = parent::GetInitialStateAttributeFlags($sAttCode, $aReasons);
		$aHiddenAndReadOnlyAttributes = array('parent_org_id');

		if (in_array($sAttCode, $aHiddenAndReadOnlyAttributes)) {
			return (OPT_ATT_HIDDEN | OPT_ATT_READONLY | $sFlagsFromParent);
		}

		return $sFlagsFromParent;
	}

	/**
	 * @inheritdoc
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '') {
		$sFlagsFromParent = parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
		$aReadOnlyAttributes = array('parent_org_id', 'parent_id');

		if (in_array($sAttCode, $aReadOnlyAttributes)) {
			return (OPT_ATT_READONLY | $sFlagsFromParent);
		}

		return $sFlagsFromParent;
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
	public function DoCheckOperation($sOperation) {
		switch ($sOperation) {
			case 'delegate':
				// If domain is delegated, deny re-delegation
				// If delegation can be done to children orgs only,
				// 		Check if block's org has children
				// If not
				// 		Check if another organisation exists
				if ($this->Get('parent_org_id') != 0) {
					return ('IsDelegated');
				} else {
					$iOrgId = $this->Get('org_id');
					$sDelegateToChildrenOnly = IPConfig::GetFromGlobalIPConfig('delegate_domain_to_children_only', $iOrgId);
					if ($sDelegateToChildrenOnly == 'dtc_yes') {
						$oOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS child JOIN Organization AS parent ON child.parent_id BELOW parent.id WHERE parent.id = $iOrgId AND child.id != $iOrgId"));
						if (!$oOrgSet->CountExceeds(0)) {
							return ('NoChildOrg');
						}
					} else {
						$oOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o WHERE o.id != $iOrgId"));
						if (!$oOrgSet->CountExceeds(0)) {
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
	 * @inheritdoc
	 */
	protected function DisplayActionFieldsForOperationV3(iTopWebPage $oP, $oObjectDetails, $sOperation, $aDefault) {
		$oMultiColumn = new MultiColumn();
		$oP->AddUIBlock($oMultiColumn);

		// First column = labels or fields
		$oColumn1 = new Column();
		$oMultiColumn->AddColumn($oColumn1);
		switch ($sOperation) {
			case 'delegate':
				// Second column = data
				$oColumn2 = new Column();
				$oMultiColumn->AddColumn($oColumn2);

				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Delegate:Domain:ChildDomain');

				// Look for the organizations where the block can be delegated to
				$iOrgId = $this->Get('org_id');
				$sDelegateToChildrenOnly = IPConfig::GetFromGlobalIPConfig('delegate_domain_to_children_only', $iOrgId);
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
		}
	}

	/**
	 * Return next operation after current one
	 *
	 * @param $sOperation
	 *
	 * @return string
	 */
	public function GetNextOperation($sOperation) {
		switch ($sOperation) {
			case 'delegate':
				return 'dodelegate';
			case 'dodelegate':
				return 'delegate';

			default:
				return '';
		}
	}

	/**
	 * Get parameters used for operation
	 *
	 * @param $sOperation
	 *
	 * @return array
	 */
	public function GetPostedParam($sOperation) {
		$aParam = array();
		switch ($sOperation) {
			case 'dodelegate':
				$aParam['child_org_id'] = utils::ReadPostedParam('child_org_id', '', 'raw_data');
				break;

			default:
				break;
		}

		return $aParam;
	}

}
