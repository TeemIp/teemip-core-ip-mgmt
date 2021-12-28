<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Model;

use CMDBObjectSet;
use Combodo\iTop\Application\UI\Base\Component\Html\HtmlFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\Select\SelectOptionUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\SelectUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\MedallionIcon\MedallionIcon;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\Column\Column;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\MultiColumn;
use Combodo\iTop\Application\UI\Base\Layout\UIContentBlockUIBlockFactory;
use DBObjectSearch;
use Dict;
use DisplayBlock;
use DNSObject;
use Domain;
use IPAddress;
use IPConfig;
use IPObject;
use iTopWebPage;
use MetaModel;
use TeemIp\TeemIp\Extension\Framework\Helper\IPUtils;
use utils;
use WebPage;

class _IPAddress extends IPObject {
	/**
	 * Manage status of IP when attached to a device
	 *
	 * @param null $iIpId
	 * @param null $iPreviousIpId
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	public static function SetStatusOnAttachment($iIpId = null, $iPreviousIpId = null) {
		if ($iIpId != $iPreviousIpId) {
			if ($iIpId != null) {
				$oIP = MetaModel::GetObject('IPAddress', $iIpId, false /* MustBeFound */);
				if ($oIP != null) {
					if ($oIP->Get('status') != 'allocated') {
						$oIP->Set('status', 'allocated');
						$oIP->Set('allocation_date', time());
						$oIP->DBUpdate();
					}
				}
			}
			if ($iPreviousIpId != null) {
				$oIP = MetaModel::GetObject('IPAddress', $iPreviousIpId, false /* MustBeFound */);
				if ($oIP != null) {
					if ($oIP->Get('status') == 'allocated') {
						$oIP->Set('status', 'released');    // release_date is managed at IPObject level
						$oIP->DBUpdate();
					}
				}
			}
		}
	}

	/**
	 * Manage status of IP when detached from a device
	 *
	 * @param null $iIpId
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	public static function SetStatusOnDetachment($iIpId = null) {
		if ($iIpId != null) {
			$oIP = MetaModel::GetObject('IPAddress', $iIpId, false /* MustBeFound */);
			if ($oIP != null) {
				if ($oIP->Get('status') == 'allocated') {
					$oIP->Set('status', 'released');    // release_date is managed at IPObject level
					$oIP->DBUpdate();
				}
			}
		}
	}

	/**
	 * Manage shortname of IP when attached to a device
	 *
	 * @param null $iOrgId
	 * @param string $sShortName
	 * @param null $iIpId
	 * @param null $iPreviousIpId
	 *
	 * @noinspection PhpUnhandledExceptionInspection
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	public static function SetShortNameOnAttachment($iOrgId = null, $sShortName = '', $iIpId = null, $iPreviousIpId = null) {
		if ($iOrgId != null) {
			$sCopyCINameToShortName = IPConfig::GetFromGlobalIPConfig('ip_copy_ci_name_to_shortname', $iOrgId);
			if ($sCopyCINameToShortName == 'yes') {
				if (($iPreviousIpId != $iIpId) && ($iPreviousIpId != null)) {
					$oIP = MetaModel::GetObject('IPAddress', $iPreviousIpId, false /* MustBeFound */);
					if ($oIP != null) {
						$oIP->Set('short_name', '');
						$oIP->DBUpdate();
					}
				}
				if ($iIpId != null) {
					$oIP = MetaModel::GetObject('IPAddress', $iIpId, false /* MustBeFound */);
					if ($oIP != null) {
						$oAttDef = MetaModel::GetAttributeDef('IPAddress', 'short_name');
						if ($oAttDef->CheckFormat($sShortName)) {
							$oIP->Set('short_name', $sShortName);
							$oIP->DBUpdate();
						}
					}
				}
			}
		}
	}

	/**
	 * Manage shortname of IP when detached from a device
	 *
	 * @param null $iIpId
	 *
	 * @noinspection PhpUnhandledExceptionInspection
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	public static function SetShortNameOnDetachment($iIpId = null) {
		if ($iIpId != null) {
			$oIP = MetaModel::GetObject('IPAddress', $iIpId, false /* MustBeFound */);
			if ($oIP != null) {
				$iOrgId = $oIP->Get('org_id');
				$sCopyCINameToShortName = IPConfig::GetFromGlobalIPConfig('ip_copy_ci_name_to_shortname', $iOrgId);
				if ($sCopyCINameToShortName == 'yes') {
					$oIP->Set('short_name', '');
					$oIP->DBUpdate();
				}
			}
		}
	}

	/**
	 * Get the list of IPAttributes (external key toward an IP(v4-6)Address class
	 *
	 * @param $sClass
	 *
	 * @return array
	 * @throws \CoreException
	 */
	public static function GetListOfIPAttributes($sClass) {
		$aIpsOfClass = array();
		if (MetaModel::IsAbstract($sClass)) {
			return $aIpsOfClass;
		}
		$aExternalKeys = MetaModel::GetExternalKeys($sClass);
		$aIPAttributes = array();
		$aIPv4Attributes = array();
		$aIPv6Attributes = array();
		foreach ($aExternalKeys as $oExternalKey) {
			$sTargetClass = $oExternalKey->GetTargetClass();
			if ($sTargetClass == 'IPAddress') {
				$aIPAttributes[] = $oExternalKey->GetCode();
			} elseif ($sTargetClass == 'IPv4Address') {
				$aIPv4Attributes[] = $oExternalKey->GetCode();
			} elseif ($sTargetClass == 'IPv6Address') {
				$aIPv6Attributes[] = $oExternalKey->GetCode();
			}
		}
		if ((sizeof($aIPAttributes) != 0) || (sizeof($aIPv4Attributes) != 0) || (sizeof($aIPv6Attributes) != 0)) {
			$aIpsOfClass['IPAddress'] = $aIPAttributes;
			$aIpsOfClass['IPv4Address'] = $aIPv4Attributes;
			$aIpsOfClass['IPv6Address'] = $aIPv6Attributes;
		}

		return $aIpsOfClass;
	}

	/**
	 * Get the subnet mask of the subnet that the IP belongs to, if any.
	 *
	 * @return string
	 */
	public function GetSubnetMaskFromIp() {
		return "";
	}

	/**
	 * @return string
	 */
	public function GetSubnetGatewayFromIp() {
		return "";
	}

	/**
	 * @inheritdoc
	 */
	public function ComputeValues() {
		parent::ComputeValues();

		// Set FQDN
		if ($this->Get('short_name') != '') {
			$this->Set('fqdn', DNSObject::ComputeFqdn($this->Get('short_name'), $this->Get('domain_name')));
		} else {
			$sComputeFqdnWithEmptyShortname = IPConfig::GetFromGlobalIPConfig('compute_fqdn_with_empty_shortname', $this->Get('org_id'));
			if ($sComputeFqdnWithEmptyShortname == 'yes')
			{
				$this->Set('fqdn', $this->Get('domain_name'));
			}
			else
			{
				$this->Reset('fqdn');
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	public function DisplayBareRelations(WebPage $oP, $bEditMode = false) {
		// Execute parent function first
		parent::DisplayBareRelations($oP, $bEditMode);

		$iKey = $this->GetKey();

		if (!$bEditMode) {
			// Tab for CIs using the IP
			//   Retrieve CIs first
			//     -- FunctionalCIs with a 1:n relation to the IP
			$sClass = get_class($this);
			$aCIsToList = $this->GetListOfClassesWIthIP('leaf');
			$iNbAllCIs = 0;
			foreach ($aCIsToList as $sCI => $sKey) {
				$sOQL = "SELECT $sCI WHERE";
				$aIPAttributes = $aCIsToList[$sCI]['IPAddress'];
				for ($i = 0; $i < sizeof($aIPAttributes); $i++) {
					$sOQL = ($i == 0) ? $sOQL." ($aIPAttributes[$i] = $iKey)" : $sOQL." OR ($aIPAttributes[$i] = $iKey)";
				}
				$aIPvNAttributes = $aCIsToList[$sCI][$sClass];
				for ($j = 0; $j < sizeof($aIPvNAttributes); $j++) {
					if ($i != 0) {
						$sOQL = $sOQL." OR ";
						$i = 0;
					}
					$sOQL = ($j == 0) ? $sOQL." ($aIPvNAttributes[$j] = $iKey)" : $sOQL." OR ($aIPvNAttributes[$j] = $iKey)";
				}
				if (empty($aIPAttributes) && empty($aIPvNAttributes)) {
					unset($aCIsToList[$sCI]);
				} else {
					$oCISearch = DBObjectSearch::FromOQL($sOQL);
					$oCISet = new CMDBObjectSet($oCISearch);
					// Obsolete CIs must be visible from the IP
					$oCISet->SetShowObsoleteData(true);
					$iNbCIs = $oCISet->Count();
					$aCIsToList[$sCI]['nb_to_list'] = $iNbCIs;
					$aCIsToList[$sCI]['set'] = $oCISet;
					$iNbAllCIs += $iNbCIs;
				}
			}

			//    -- Functional CIs with a n:n relation to the IP
			if (class_exists('ClusterNetwork')) {
				$sOQL = 'SELECT ClusterNetwork AS cn JOIN lnkClusterNetworkToIPAddress AS l ON l.clusternetwork_id = cn.id WHERE l.ipaddress_id = :ip_id';
				$oClusterNetworkSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('ip_id' => $iKey));
				$iNbClusterNetwork = $oClusterNetworkSet->Count();
				if ($iNbClusterNetwork > 0) {
					$aCIsToList['ClusterNetwork']['nb_to_list'] = $iNbClusterNetwork;
					$aCIsToList['ClusterNetwork']['set'] = $oClusterNetworkSet;
					$iNbAllCIs += $iNbClusterNetwork;
				}
			}

			//    -- Interfaces with a n:n relation to the IP
			$oIPInterfaceToIPAddressSearch = DBObjectSearch::FromOQL("SELECT lnkIPInterfaceToIPAddress AS l WHERE l.ipaddress_id = $iKey");
			$oIPInterfaceToIPAddressSet = new CMDBObjectSet($oIPInterfaceToIPAddressSearch);
			// Obsolete CIs must be visible from the IP
			$oIPInterfaceToIPAddressSet->SetShowObsoleteData(true);
			$iNbIPInterfaces = $oIPInterfaceToIPAddressSet->Count();
			$iNbAllCIs += $iNbIPInterfaces;
			$oIPInterfaceSet = array();
			while ($oLnk = $oIPInterfaceToIPAddressSet->Fetch()) {
				$iIpIntKey = $oLnk->Get('ipinterface_id');
				$oIPInterfaceSet[] = MetaModel::GetObject('IPInterface', $iIpIntKey, false);
			}
			$oIPInterfaceSet = CMDBObjectSet::FromArray('IPInterface', $oIPInterfaceSet);
			$oIPInterfaceSet->SetShowObsoleteData(true);

			// Next, display CIs
			$sName = Dict::Format('Class:IPAddress/Tab:ci_list');
			$sTitle = Dict::Format('Class:IPAddress/Tab:ci_list+');
			if ($iNbAllCIs != 0) {
				$oP->SetCurrentTab($sName.' ('.$iNbAllCIs.')');
				$oP->p($sTitle);
				foreach ($aCIsToList as $sCI => $sKey) {
					if ($aCIsToList[$sCI]['nb_to_list'] != 0) {
						$sClass = $aCIsToList[$sCI]['set']->GetClass();
						if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.0', '<')) {
							$oP->p(MetaModel::GetClassIcon($sClass).'&nbsp;'.Dict::Format('Class:IPAddress/Tab:ci_list_class', MetaModel::GetName($sClass)));
						} else {
							$oClassIcon = new MedallionIcon(MetaModel::GetClassIcon($sClass, false));
							$oClassIcon->SetDescription(Dict::Format('Class:IPAddress/Tab:ci_list_class', MetaModel::GetName($sClass)))->AddCSSClass('ibo-block-list--medallion');
							$oP->AddUiBlock($oClassIcon);
						}
						// Use DisplayBlock::FromObjectSet and not new DisplayBlock to make sure obsolete CIs are displayd
						$oBlock = DisplayBlock::FromObjectSet($aCIsToList[$sCI]['set'], 'list', array('show_obsolete_data' => true));
						$oBlock->Display($oP, $sCI, array('menu' => false));
					}
				}

				if ($iNbIPInterfaces != 0) {
					$sClass = $oIPInterfaceSet->GetClass();
					if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.0', '<')) {
						$oP->p(MetaModel::GetClassIcon($sClass).'&nbsp;'.Dict::Format('Class:IPAddress/Tab:ci_list_class', MetaModel::GetName($sClass)));
					} else {
						$oClassIcon = new MedallionIcon(MetaModel::GetClassIcon($sClass, false));
						$oClassIcon->SetDescription(Dict::Format('Class:IPAddress/Tab:ci_list_class', MetaModel::GetName($sClass)))->AddCSSClass('ibo-block-list--medallion');
						$oP->AddUiBlock($oClassIcon);
					}
					// Use DisplayBlock::FromObjectSet and not new DisplayBlock to make sure obsolete interfaces are displayd
					$oBlock = DisplayBlock::FromObjectSet($oIPInterfaceSet, 'list', array('show_obsolete_data' => true));
					$oBlock->Display($oP, 'ii_id', array('menu' => false));
				}
			} else {
				$oSet = CMDBObjectSet::FromScratch('FunctionalCI');
				IPUtils::DisplayTabContent($oP, $sName, 'ci_list', 'FunctionalCI', $sTitle, '', $oSet);
			}


			// Tab for related IP Requests, if any
			if (MetaModel::IsValidClass('IPRequestAddress')) {
				$oIpRequestSearch = DBObjectSearch::FromOQL("SELECT IPRequestAddress AS r WHERE r.ip_id = $iKey");
				$oIpRequestSet = new CMDBObjectSet($oIpRequestSearch);
				$oIpRequestSet->SetShowObsoleteData(utils::ShowObsoleteData());

				$sName = Dict::Format('Class:IPAddress/Tab:requests');
				$sTitle = Dict::Format('Class:IPAddress/Tab:requests+');
				IPUtils::DisplayTabContent($oP, $sName, 'ip_requests', 'IPRequestAddress', $sTitle, '', $oIpRequestSet);
			}
		}
	}

	/**
	 * Get the list of classes referencing the IPAddress class
	 * Restrict list to non abstract classes inherited from 'FunctionalCI'
	 * For each class, we get an array of all attributes being an external key to an IPAddress object
	 *
	 * @param string $sMode
	 *
	 * @return array
	 * @throws \CoreException
	 */
	public static function GetListOfClassesWIthIP($sMode = 'leaf') {
		$aFunctionalCIChildClasses = MetaModel::EnumChildClasses('FunctionalCI', ENUM_CHILD_CLASSES_EXCLUDETOP);
		$aIPClasses = array();
		switch ($sMode) {
			case 'leaf':
				foreach ($aFunctionalCIChildClasses as $sClass) {
					$aIpsOfClass = IPAddress::GetListOfIPAttributes($sClass);
					if (!empty($aIpsOfClass)) {
						$aIPClasses[$sClass] = $aIpsOfClass;
					}
				}
				ksort($aIPClasses);
				break;

			case 'root':
			default:
				break;
		}

		return $aIPClasses;
	}

	/**
	 * @inheritdoc
	 */
	public function DoCheckToWrite() {
		// Run standard iTop checks first
		parent::DoCheckToWrite();

		// Make sure name doesn't already exist (matches)
		if (!$this->IsFqdnUnique()) {
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPAddress:IPNameCollision');
		}

		return;
	}

	/**
	 * Check if IP's FQDN is unique.
	 *
	 * @return bool
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function IsFqdnUnique() {
		$iOrgId = $this->Get('org_id');
		if ($this->IsNew()) {
			$iKey = -1;
		} else {
			$iKey = $this->GetKey();
		}
		$sFqdn = $this->Get('fqdn');

		// The check takes into account the global parameters that defines if duplicate FQDNs are authorized or not
		$sIpAllowDuplicateName = $this->Get('ip_allow_duplicate_name');
		if ($sIpAllowDuplicateName == 'default') {
			$sIpAllowDuplicateName = IPConfig::GetFromGlobalIPConfig('ip_allow_duplicate_name', $iOrgId);
		}
		// Check is not done on empty names
		if ($sFqdn != "") {
			if ($sIpAllowDuplicateName != 'ipdup_yes') {
				// Duplicates are allowed between different organizations
				// Duplicates don't count on released IPs
				$sOQL = "SELECT IPAddress AS i WHERE i.fqdn = :fqdn AND i.org_id = :org_id AND i.status != 'released' AND i.id != :key";
				$oIpSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('fqdn' => $sFqdn, 'org_id' => $iOrgId, 'key' => $iKey));
				// Match for creations is verbiden. Match for modifications as well unless the current name is kept
				$bDualStackMatchConsummed = false;
				while ($oIp = $oIpSet->Fetch()) {
					// In case of dual stack, the same name can be shared between an IPv4 and an IPv6
					if ($sIpAllowDuplicateName == 'ipdup_dualstack') {
						if ($bDualStackMatchConsummed == true) {
							return false;
						} else {
							if (get_class($this) != get_class($oIp)) {
								$bDualStackMatchConsummed = true;
							} else {
								return false;
							}
						}
					} else {
						return false;
					}
				}
			}
		}

		return true;
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
	public function DoCheckOperation($sOperation) {
		switch ($sOperation) {
			case 'allocateip':
				if ($this->Get('status') == 'allocated') {
					return ('IPAlreadyAllocated');
				}
				break;

			case 'unallocateip':
				if ($this->Get('status') != 'allocated') {
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
	 *
	 * @param $sOperation
	 *
	 * @return array
	 */
	public function GetPostedParam($sOperation) {
		$aParam = array();
		switch ($sOperation) {
			case 'doallocateip':
				$aParam['ciclass'] = utils::ReadPostedParam('attr_ciclass', '', 'raw_data');
				$aParam['ci_id'] = utils::ReadPostedParam('attr_ci_id', '', 'raw_data');
				$aParam['ipattribute'] = utils::ReadPostedParam('attr_ipattribute', '', 'raw_data');
				break;

			case 'dounallocateip':
			default:
				break;
		}

		return $aParam;
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
			case 'allocateip':
				return 'doallocateip';
			case 'doallocateip':
				return 'allocateip';
			default:
				return '';
		}
	}

	/**
	 * Check if IP can be allocated
	 *
	 * @param $aParam
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function DoCheckToAllocate($aParam) {
		$sClass = $aParam['ciclass'];
		$id = $aParam['ci_id'];
		$sIPAttribute = $aParam['ipattribute'];

		$oCI = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
		if (is_null($oCI)) {
			return (Dict::Format('UI:IPManagement:Action:Allocate:IPAddress:CIDoesNotExist'));
		}
		$iFlags = $oCI->GetFormAttributeFlags($sIPAttribute);
		if ($iFlags & OPT_ATT_READONLY) {
			// Attribute is read only
			return (Dict::Format('UI:IPManagement:Action:Allocate:IPAddress:AttributeIsReadOnly'));
		}
		if ($iFlags & OPT_ATT_SLAVE) {
			// Attribute is read only because of a synchro
			return (Dict::Format('UI:IPManagement:Action:Allocate:IPAddress:AttributeIsSynchronized'));
		}

		// Chek for potential duplicate names
		$iOrgId = $this->Get('org_id');
		$sCopyCiNameToShortname = IPConfig::GetFromGlobalIPConfig('ip_copy_ci_name_to_shortname', $iOrgId);
		if ($sCopyCiNameToShortname == 'yes') {
			$sName = $oCI->GetNameForIPAttribute($sIPAttribute);
			$sOldName = $this->Get('short_name');
			$this->Set('short_name', $sName);
			$bIsFqdnUnique = $this->IsFqdnUnique();
			$this->Set('short_name', $sOldName);
			if (!$bIsFqdnUnique) {
				// FQDN won't be unique
				return (Dict::Format('UI:IPManagement:Action:Allocate:IPAddress:FQDNIsConflicting'));
			}
		}

		return '';
	}

	/**
	 * Check if CI can be allocated
	 *
	 * @param $aParam
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function DoCheckToUnallocate() {
		// Make sure IP is allocated
		if ($this->Get('status') != 'allocated') {
			return (Dict::Format('UI:IPManagement:Action:UnAllocate:IPAddress:IPNotAllocated'));
		}

		// Check if IP is attached to at least one CI's attribute that is R/O or Slave because of a synchro
		$sCLass = get_class($this);
		$aCIsToList = $this->GetListOfClassesWIthIP('leaf');
		$iKey = $this->GetKey();
		foreach ($aCIsToList as $sCI => $sKey) {
			$aIPAttributes = array_merge($aCIsToList[$sCI]['IPAddress'], $aCIsToList[$sCI][$sCLass]);
			foreach ($aIPAttributes as $key => $sIPAttribute) {
				$oCISearch = DBObjectSearch::FromOQL("SELECT $sCI WHERE $sIPAttribute = $iKey");
				$oCISet = new CMDBObjectSet($oCISearch);
				while ($oCI = $oCISet->Fetch()) {
					$iFlags = $oCI->GetFormAttributeFlags($sIPAttribute);
					if ($iFlags & OPT_ATT_READONLY) {
						// Attribute is read only
						return (Dict::Format('UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsReadOnly'));
					}
					if ($iFlags & OPT_ATT_SLAVE) {
						// Attribute is read only because of a synchro
						return (Dict::Format('UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsSynchronized'));
					}
				}
			}
		}

		return '';
	}

	/**
	 * Allocate IP to CI
	 *
	 * @param $aParam
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \Exception
	 */
	public function DoAllocate($aParam) {
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
	}

	/**
	 * Unallocated CI
	 *
	 * @param $aParam
	 *
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \Exception
	 */
	public function DoUnallocate() {
		// Remove from CIs & interfaces
		$this->RemoveFromCIs();
		$this->RemoveFromInterfaces();

		// Update IP status
		$this->Set('status', 'unassigned');
		$this->DBUpdate();
	}

	/**
	 * Check if given FQDN can be expoded
	 *
	 * @$sFqdnAttr FQDN attribute that should be exploded
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function DoCheckToExplodeFQDN($sFqdnAttr) {
		$sClass = get_class($this);
		if (!in_array($sFqdnAttr, MetaModel::GetAttributesList($sClass))) {
			// $sFqdnAttr is not a valid attribute for the class
			return (Dict::Format('UI:IPManagement:Action:ExplodeFQDN:IPAddress:FQDNAttributeDoesNotExist', $sFqdnAttr));
		}
		$sFqdn = $this->Get($sFqdnAttr);
		if ($sFqdn == '') {
			// Don't count empty string as error
			return '';
		}
		list($sError, $iDomainId) = Domain::GetDomainFromFqdn($sFqdn, $this->Get('org_id'));
		if ($sError != '') {
			return $sError;
		}

		return '';
	}

	/**
	 * Explode FQDN
	 *
	 * @$sFqdnAttr FQDN attribute that should be exploded
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \Exception
	 */
	public function DoExplodeFQDN($sFqdnAttr) {
		$sFqdn = $this->Get($sFqdnAttr);
		list($sError, $iDomainId) = Domain::GetDomainFromFqdn($sFqdn, $this->Get('org_id'));
		if ($sError == '') {
			$oDomain = MetaModel::GetObject('Domain', $iDomainId);
			if ($oDomain != null) {
				$sDomainName = $oDomain->Get('name');
				$sHostname = substr_replace($sFqdn, '', -strlen('.'.$sDomainName));
				$this->Set('short_name', $sHostname);
				$this->Set('domain_id', $iDomainId);
				$this > $this->DBUpdate();
			}
		}
	}

	/**
	 * Remove IP from the CIs it is attached to
	 *
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function RemoveFromCIs() {
		$sCLass = get_class($this);
		$aCIsToList = $this->GetListOfClassesWIthIP('leaf');
		$iKey = $this->GetKey();
		foreach ($aCIsToList as $sCI => $sKey) {
			$aIPAttributes = array_merge($aCIsToList[$sCI]['IPAddress'], $aCIsToList[$sCI][$sCLass]);
			foreach ($aIPAttributes as $key => $sIPAttribute) {
				$oCISearch = DBObjectSearch::FromOQL("SELECT $sCI WHERE $sIPAttribute = $iKey");
				$oCISet = new CMDBObjectSet($oCISearch);
				while ($oCI = $oCISet->Fetch()) {
					$oCI->Set($sIPAttribute, '');
					$oCI->DBUpdate();
				}
			}
		}
	}

	/**
	 * Remove IP from the interfaces it is attached to
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
	public function RemoveFromInterfaces() {
		$iKey = $this->GetKey();
		$oLnkSearch = DBObjectSearch::FromOQL("SELECT lnkIPInterfaceToIPAddress WHERE ipaddress_id = $iKey");
		$oLnkSet = new CMDBObjectSet($oLnkSearch);
		while ($oLnk = $oLnkSet->Fetch()) {
			$oLnk->DBDelete();
		}
	}

	/**
	 * @inheritdoc
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '') {
		switch ($sAttCode) {
			case 'org_id':
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
		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}

	/**
	 * @inheritdoc
	 */
	public function GetInitialStateAttributeFlags($sAttCode, &$aReasons = array()) {
		switch ($sAttCode) {
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
	 * Prototype for DNS management
	 *
	 */
	public function DoCheckUpdateRRs() {
	}

	/**
	 * Prototype for DNS management
	 *
	 */
	public function UpdateRRs() {
	}

	/**
	 * Prototype for DNS management
	 *
	 */
	public function CleanRRs() {
	}

	/**
	 * @inheritdoc
	 */
	public function OnUpdate() {
		parent::OnUpdate();

		$sStatus = $this->Get('status');
		if ($sStatus == 'released') {
			$sOriginalStatus = $this->GetOriginal('status');
			if ($sStatus != $sOriginalStatus) {
				$sCopyCINameToShortName = IPConfig::GetFromGlobalIPConfig('ip_copy_ci_name_to_shortname', $this->Get('org_id'));
				if ($sCopyCINameToShortName == 'yes') {
					$this->Set('short_name', '');
				}
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	public function AfterUpdate() {
		parent::AfterUpdate();

		// Remove IP from CIs & interfaces when it is released
		$sStatus = $this->Get('status');
		if ($sStatus == 'released') {
			$aChanges = $this->ListPreviousValuesForUpdatedAttributes();
			if (array_key_exists('status', $aChanges)) {
				$this->RemoveFromCIs();
				$this->RemoveFromInterfaces();
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	protected function DisplayActionFieldsForOperation(iTopWebPage $oP, $sOperation, $iFormId, $aDefault) {
		$oP->add("<table>");
		$oP->add('<tr><td style="vertical-align:top">');

		$sClass = get_class($this);
		$iId = $this->GetKey();
		switch ($sOperation) {
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
				$bEmptyListOfCIs = true;
				foreach ($aCIClassesWithIp as $sCIClass => $sKey) {
					$oCISet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT FunctionalCI AS ci WHERE ci.org_id = :org_id AND ci.finalclass = :ciclass"),
						array(), array('org_id' => $iOrgId, 'ciclass' => $sCIClass));
					if ($oCISet->CountExceeds(0)) {
						$bEmptyListOfCIs = false;

						// Propose only CIs that are already instanciated
						$sClassName = MetaModel::GetName($sCIClass);
						if ($bIsDefaultSet) {
							$sHTMLValue .= "<option value=\"$sCIClass\">$sClassName</option>\n";
						} else {
							$bIsDefaultSet = true;
							$sFirstCIClassInList = $sCIClass;
							$sHTMLValue .= "<option selected='' value=\"$sCIClass\">$sClassName</option>\n";
						}
					}
				}
				$sHTMLValue .= "</select>";
				if (!$bEmptyListOfCIs) {
					// There are instantiated CIs with IP address attributes in the given organization

					$aDetails[] = array(
						'label' => '<span title="">'.$sLabelOfAction1.'</span>',
						'value' => $sHTMLValue,
					);

					// Functional CI
					$oCISet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT FunctionalCI AS ci WHERE ci.org_id = :org_id AND ci.finalclass = :ciclass"),
						array(), array('org_id' => $iOrgId, 'ciclass' => $sFirstCIClassInList));
					$oCISet->SetShowObsoleteData(utils::ShowObsoleteData());
					$oCISet->Rewind();

					$sCIInputId = 'field_'.$iFormId.'_ci_id';
					$sHTMLValue = "<div class=\"field_select_wrapper\">";
					$sHTMLValue .= "<div><span id=\"v_ci_id\">";
					$sHTMLValue .= "<select title=\"\" name=\"attr_ci_id\" id=\"$sCIInputId\" >";
					while ($oObj = $oCISet->Fetch()) {
						$key = $oObj->GetKey();
						$display_value = $oObj->GetName();

						$sHTMLValue .= "<option value=\"$key\">$display_value</option>";
					}
					$sHTMLValue .= "</select>";
					$sHTMLValue .= "</span></div></div>";
					$aDetails[] = array(
						'label' => '<span title="">'.$sLabelOfAction2.'</span>',
						'value' => $sHTMLValue,
					);

					// IPAddress attribute
					$sAttributeInputId = 'field_'.$iFormId.'_ipattribute';
					$sHTMLValue = "<div class=\"field_select_wrapper\">";
					$sHTMLValue .= "<div><span id=\"v_att_id\">";
					$sHTMLValue .= "<select name=\"attr_ipattribute\" id=\"$sAttributeInputId\" >";
					foreach ($aCIClassesWithIp[$sFirstCIClassInList]['IPAddress'] as $sKey => $sAttribute) {
						$oAttDef = MetaModel::GetAttributeDef($sFirstCIClassInList, $sAttribute);
						$sAttributeName = $oAttDef->GetLabel();
						$sHTMLValue .= "<option value=\"$sAttribute\">$sAttributeName</option>\n";
					}
					foreach ($aCIClassesWithIp[$sFirstCIClassInList][$sClass] as $sKey => $sAttribute) {
						$oAttDef = MetaModel::GetAttributeDef($sFirstCIClassInList, $sAttribute);
						$sAttributeName = $oAttDef->GetLabel();
						$sHTMLValue .= "<option value=\"$sAttribute\">$sAttributeName</option>\n";
					}
					$sHTMLValue .= "</select>";
					$sHTMLValue .= "</span></div></div>";
					$aDetails[] = array(
						'label' => '<span title="">'.$sLabelOfAction3.'</span>',
						'value' => $sHTMLValue,
					);

					$oP->Details($aDetails);
					$oP->add('</td></tr>');

					$oP->add_ready_script(
						<<<EOF
				    $('#$sClassInputId').bind('change', function() {			        
						var oParams = { 
							operation: 'get_cis_to_allocate',
							vid: '$sCIInputId',
							class: '$sClass',
							default: {'org_id': '$iOrgId', 'ciclass': $('#$sClassInputId').val()}
							}
						$('#v_ci_id').html( $('#v_ci_id').html() ).append('<img src="'+GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/asset/img/ipindicator-xs.gif" alt="" />');
						$.post(GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/ajax.teemip-ip-mgmt.php', oParams, function(data) { $('#v_ci_id').html(data); });
						});					
EOF
					);
					$sClassesWithIP = json_encode($aCIClassesWithIp);
					$oP->add_ready_script(
						<<<EOF
				    $('#$sClassInputId').bind('change', function() {			        
						var oParams = { 
							operation: 'get_attribute_to_allocate',
							vid: '$sAttributeInputId',
							class: '$sClass',
							default: {'ciclasseswithip': '$sClassesWithIP', 'ciclass': $('#$sClassInputId').val()}
							}
						$('#v_att_id').html( $('#v_att_id').html() ).append('<img src="'+GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/asset/img/ipindicator-xs.gif" alt="" />');
						$.post(GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/ajax.teemip-ip-mgmt.php', oParams, function(data) { $('#v_att_id').html(data); });
						});					
EOF
					);
				} else {
					$oP->p(Dict::S('UI:IPManagement:Action:Allocate:IPAddress:NoCI'));
					$oP->add('</td></tr>');
				}

				// Cancell button
				$oP->add("<tr><td><button type=\"button\" class=\"action\" onClick=\"BackToDetails('$sClass', $iId)\"><span>".Dict::S('UI:Button:Cancel')."</span></button>&nbsp;&nbsp;");

				// Apply button
				if (!$bEmptyListOfCIs) {
					$oP->add("&nbsp;&nbsp<button type=\"submit\" class=\"action\"><span>".Dict::S('UI:Button:Apply')."</span></button></td></tr>");
				}
				break;

			default:
				break;
		}

		$oP->add("</table>");
	}

	/**
	 * @inheritdoc
	 */
	protected function DisplayActionFieldsForOperationV3(iTopWebPage $oP, $oClassForm, $sOperation, $aDefault) {
		$oMultiColumn = new MultiColumn();
		$oP->AddUIBlock($oMultiColumn);

		// First column = labels or fields
		$oColumn1 = new Column();
		$oMultiColumn->AddColumn($oColumn1);

		switch ($sOperation) {
			case 'allocateip':
				// Second column = data
				$oColumn2 = new Column();
				$oMultiColumn->AddColumn($oColumn2);

				$sLabelOfAction1 = Dict::S('UI:IPManagement:Action:Allocate:IPAddress:Class');
				$sLabelOfAction2 = Dict::S('UI:IPManagement:Action:Allocate:IPAddress:CI');
				$sLabelOfAction3 = Dict::S('UI:IPManagement:Action:Allocate:IPAddress:IPAttribute');

				$iOrgId = $this->Get('org_id');
				$aCIClassesWithIp = IPAddress::GetListOfClassesWIthIP('leaf');

				// Target Class
				$iFormId = $oClassForm->GetId();
				$sClassInputId = 'field_'.$iFormId.'_ciclass';
				$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph($sLabelOfAction1));
				$oColumn1->AddSubBlock(HtmlFactory::MakeRaw('<br>'));
				$oSelect = SelectUIBlockFactory::MakeForSelect('attr_ciclass', $sClassInputId);
				$oColumn2->AddSubBlock($oSelect);
				$oColumn2->AddSubBlock(HtmlFactory::MakeRaw('<br><br>'));
				$bIsDefaultSet = false;
				$bEmptyListOfCIs = true;
				foreach ($aCIClassesWithIp as $sCIClass => $sKey) {
					$oCISet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT FunctionalCI AS ci WHERE ci.org_id = :org_id AND ci.finalclass = :ciclass"), array(), array('org_id' => $iOrgId, 'ciclass' => $sCIClass));
					if ($oCISet->CountExceeds(0)) {
						// There are instantiated CIs with IP address attributes in the given organization
						$bEmptyListOfCIs = false;

						// Propose only CIs that are already instanciated
						$sClassName = MetaModel::GetName($sCIClass);
						if ($bIsDefaultSet) {
							$oSelect->AddOption(SelectOptionUIBlockFactory::MakeForSelectOption($sCIClass, $sClassName, false));
						} else {
							$bIsDefaultSet = true;
							$sFirstCIClassInList = $sCIClass;
							$oSelect->AddOption(SelectOptionUIBlockFactory::MakeForSelectOption($sCIClass, $sClassName, true));
						}
					}
				}

				if (!$bEmptyListOfCIs) {
					$sClass = get_class($this);

					// Functional CI
					$sCIInputId = 'field_'.$iFormId.'_ci_id';
					$oCISet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT FunctionalCI AS ci WHERE ci.org_id = :org_id AND ci.finalclass = :ciclass"), array(), array('org_id' => $iOrgId, 'ciclass' => $sFirstCIClassInList));
					$oCISet->SetShowObsoleteData(utils::ShowObsoleteData());
					$oCISet->Rewind();

					$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph($sLabelOfAction2));
					$oColumn1->AddSubBlock(HtmlFactory::MakeRaw('<br>'));
					$oContentBlock = UIContentBlockUIBlockFactory::MakeStandard('v_ci_id', ['field_select_wrapper']);
					$oColumn2->AddSubBlock($oContentBlock);
					$oSelect = SelectUIBlockFactory::MakeForSelect('ci_id', $sCIInputId);
					$oContentBlock->AddSubBlock($oSelect);
					$oColumn2->AddSubBlock(HtmlFactory::MakeRaw('<br>'));

					while ($oObj = $oCISet->Fetch()) {
						$oSelect->AddOption(SelectOptionUIBlockFactory::MakeForSelectOption($oObj->GetKey(), $oObj->GetName(), false));
					}

					// IPAddress attribute
					$sAttributeInputId = 'field_'.$iFormId.'_ipattribute';
					$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph($sLabelOfAction3));
					$oContentBlock = UIContentBlockUIBlockFactory::MakeStandard('v_att_id', ['field_select_wrapper']);
					$oColumn2->AddSubBlock($oContentBlock);
					$oSelect = SelectUIBlockFactory::MakeForSelect('ipattribute');
					$oContentBlock->AddSubBlock($oSelect);

					foreach ($aCIClassesWithIp[$sFirstCIClassInList]['IPAddress'] as $sKey => $sAttribute) {
						$oAttDef = MetaModel::GetAttributeDef($sFirstCIClassInList, $sAttribute);
						$sAttributeName = $oAttDef->GetLabel();
						$oSelect->AddOption(SelectOptionUIBlockFactory::MakeForSelectOption($sAttribute, $sAttributeName, false));
					}
					foreach ($aCIClassesWithIp[$sFirstCIClassInList][$sClass] as $sKey => $sAttribute) {
						$oAttDef = MetaModel::GetAttributeDef($sFirstCIClassInList, $sAttribute);
						$sAttributeName = $oAttDef->GetLabel();
						$oSelect->AddOption(SelectOptionUIBlockFactory::MakeForSelectOption($sAttribute, $sAttributeName, false));
					}

					$oP->add_ready_script(<<<EOF
						$('#$sClassInputId').bind('change', function() {
							var oParams = {
								operation: 'get_cis_to_allocate',
								vid: '$sCIInputId',
								class: '$sClass',
								default: {'org_id': '$iOrgId', 'ciclass': $('#$sClassInputId').val()}
							}
							$('#v_ci_id').html( $('#v_ci_id').html() ).append('<img src="'+GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/asset/img/ipindicator-xs.gif" alt="" />');
							$.post(GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/ajax.teemip-ip-mgmt.php', oParams, function(data) { $('#v_ci_id').html(data); });
						});
EOF
					);
					$sClassesWithIP = json_encode($aCIClassesWithIp);
					$oP->add_ready_script(<<<EOF
						$('#$sClassInputId').bind('change', function() {
							var oParams = {
								operation: 'get_attribute_to_allocate',
								vid: '$sAttributeInputId',
								class: '$sClass',
								default: {'ciclasseswithip': '$sClassesWithIP', 'ciclass': $('#$sClassInputId').val()}
							}
							$('#v_att_id').html( $('#v_att_id').html() ).append('<img src="'+GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/asset/img/ipindicator-xs.gif" alt="" />');
							$.post(GetAbsoluteUrlModulesRoot()+'teemip-ip-mgmt/ajax.teemip-ip-mgmt.php', oParams, function(data) { $('#v_att_id').html(data); });
						});
EOF
					);
				} else {
					$oP->p(Dict::S('UI:IPManagement:Action:Allocate:IPAddress:NoCI'));
				}
				break;

			default:
				break;
		}
	}

}
