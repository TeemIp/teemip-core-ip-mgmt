<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPv6Management\Model;

use AttributeIPv6Address;
use CMDBObjectSet;
use CMDBSource;
use ContextTag;
use DBObjectSearch;
use DBObjectSet;
use DBSearch;
use Dict;
use IPAddress;
use IPConfig;
use MetaModel;
use SetupLog;
use utils;

/**
 * Class _IPv6Address
 */
class _IPv6Address extends IPAddress
{
	/**
	 * Get the subnet mask of the subnet that the IP belongs to, if any.
	 *
	 * @return int|mixed|\ormLinkSet|string|null
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	function GetSubnetMaskFromIp()
	{
		$sIp = $this->Get('ip')->GetAsCannonical();
		$iOrgId = $this->Get('org_id');
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.ip_text <= :ip AND :ip <= s.lastip AND s.org_id = :org_id", array('ip' => $sIp, 'org_id' => $iOrgId)));
		if ($oSubnetSet->Count() != 0) {
			$oSubnet = $oSubnetSet->Fetch();

			return ($oSubnet->Get('mask'));
		}

		return "";
	}

	/**
	 * Get the gateway of the subnet that the IP belongs to, if any.
	 *
	 * @return int|mixed|\ormLinkSet|string|null
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	function GetSubnetGatewayFromIp()
	{
		$sIp = $this->Get('ip')->GetAsCannonical();
		$iOrgId = $this->Get('org_id');
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.ip_text <= :ip AND :ip <= s.lastip AND s.org_id = :org_id", array('ip' => $sIp, 'org_id' => $iOrgId)));
		if ($oSubnetSet->Count() != 0) {
			$oSubnet = $oSubnetSet->Fetch();
			$oGatewayIp = $oSubnet->Get('gatewayip');

			return ($oGatewayIp);
		}

		return "";
	}

	/**
	 * Check if IP pings
	 *
	 * @param $sIp
	 * @param $iTimeToWait
	 *
	 * @return array
	 */
	static function DoCheckIpPings($sIp, $iTimeToWait)
	{
		// Disable ping if IP is created from a synchro... which may be the result of a discovery operation.
		if (!ContextTag::Check('Synchro')) {
			$sSystemType = strtoupper(php_uname($mode = "s"));
			if (strpos($sSystemType,
					'WIN') === false) {
				// Unix type - what else?
				$sCommand = "ping -c ".NUMBER_OF_PINGS." -W ".$iTimeToWait." ".$sIp;
			} else {
				// Windows
				$sCommand = "ping -n ".NUMBER_OF_PINGS." -w ".($iTimeToWait * 1000)." ".$sIp;
			}
			exec($sCommand,
				$aOutput,
				$iRes);
			if ($iRes == 0) {
				//Command got an answer. Make sure it is a positive one.
				$sOutput = stripos(implode($aOutput),
					'ttl');
				if ($sOutput !== false) {
					// ttl string is in the answer => IP pings
					array_unshift($aOutput,
						$sCommand);

					return $aOutput;
				}
			}
		}

		return array();
	}

	/**
	 * @inheritdoc
	 */
	public function ComputeValues()
	{
		parent::ComputeValues();

		$iOrgId = $this->Get('org_id');
		$oIp = $this->Get('ip');
		$sIp = $oIp->GetAsCannonical();

		$iSubnetId = $this->Get('subnet_id');
		if ($iSubnetId == 0) {
			// No subnet parent set yet. Look for the only one that IP may belong to.
			// If none -> orphean IP
			$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.ip_text <= :ip AND :ip <= s.lastip_text AND s.org_id = :org_id", array('ip' => $sIp, 'org_id' => $iOrgId)));
			if ($oSubnetSet->Count() != 0) {
				$oSubnet = $oSubnetSet->Fetch();
				$this->Set('subnet_id', $oSubnet->GetKey());
			}
		} else {
			// Preset IP to subnet IP if it is not set yet.
			$oSubnet = MetaModel::GetObject('IPv6Subnet', $iSubnetId, true /* MustBeFound */);
			if (!$oSubnet->DoCheckIpInSubnet($oIp)) {
				$subnetMask = $oSubnet->BitToMask($oSubnet->Get('mask')); //new ormIPv6(IPV6_SUBNET_MASK);
				$oSubnetMask = new ormIPv6($subnetMask);
				$oNotSubnetMask = $oSubnetMask->BitWiseNot();
				$oIp = $oIp->BitWiseAnd($oNotSubnetMask);
				$oZero = new ormIPv6('::');
				if ($oIp->IsEqual($oZero)) {
					$oSubnetIp = $oSubnet->Get('ip');
					$this->Set('ip', $oSubnetIp);
				}
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	public function DoCheckToWrite()
	{
		parent::DoCheckToWrite();

		// For new IPs only: 
		if ($this->IsNew()) {
			$iOrgId = $this->Get('org_id');
			$oIp = $this->Get('ip');
			$sIp = $oIp->GetAsCannonical();

			// Make sure IP doesn't already exist for creation
			$oIpSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE i.ip_text = :ip AND i.org_id = :org_id", array('ip' => $sIp, 'org_id' => $iOrgId)));
			while ($oIpAdd = $oIpSet->Fetch()) {
				// It's a creation -> deny it
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPAddress:IPCollision');

				return;
			}

			// If Subnet is selected, make sure IP belongs to it
			$iSubnetId = $this->Get('subnet_id');
			if ($iSubnetId != 0) {
				$oSubnet = MetaModel::GetObject('IPv6Subnet', $iSubnetId, true /* MustBeFound */);
				if (!$oSubnet->DoCheckIpInSubnet($oIp)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPAddress:NotInSubnet');

					return;
				}
			}

			// If IP Range is selected, make sure IP belongs to range
			$iIpRangeId = $this->Get('range_id');
			if ($iIpRangeId != 0) {
				$oIpRange = MetaModel::GetObject('IPv6Range', $iIpRangeId, true /* MustBeFound */);
				if (!$oIpRange->DoCheckIpInRange($oIp)) {
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPAddress:NotInRange');

					return;
				}
			} else {
				// If not look for IP Range that IP may belong to
				$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.firstip_text <= :ip AND :ip <= r.lastip_text AND r.org_id = :org_id", array('ip' => $sIp, 'org_id' => $iOrgId)));
				if ($oIpRangeSet->Count() != 0) {
					$oIpRange = $oIpRangeSet->Fetch();
					$this->Set('range_id', $oIpRange->GetKey());
				}
			}

			// If required by global parameters, ping IP before assigning it
			$sPingBeforeAssign = utils::ReadPostedParam('attr_ping_before_assign', '');
			if (empty($sPingBeforeAssign)) {
				$sPingBeforeAssign = IPConfig::GetFromGlobalIPConfig('ping_before_assign', $iOrgId);
			}
			if ($sPingBeforeAssign == 'ping_yes') {
				$aOutput = $this->DoCheckIpPings($this->Get('ip')->ToString(), TIME_TO_WAIT_FOR_PING_LONG);
				if (!empty($aOutput)) {
					$sOutput = '<br>'.implode('<br>', $aOutput);
					$this->m_aCheckIssues[] = Dict::S('UI:IPManagement:Action:New:IPAddress:IPPings').$sOutput;

					return;
				}
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		$sFlagsFromParent = parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
		$aReadOnlyAttributes = array('ip', 'subnet_id', 'range_id');

		if (!$this->IsNew() && in_array($sAttCode, $aReadOnlyAttributes)) {
			return (OPT_ATT_READONLY | $sFlagsFromParent);
		}

		return $sFlagsFromParent;
	}

	/**
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \MySQLQueryHasNoResultException
	 * @throws \OQLException
	 */
	static public function IPv6CompressionMigration()
	{
		SetupLog::Info("Module teemip-ipv6-mgmt: for all IPv6Attribute, fill new _comp (compressed) column with compressed value of IP");

		// Get list of all non abstract classes under cmdbAbstractObject that have at least one IPv6Attribute and list these attributes
		$aCIChildClasses = MetaModel::GetClasses('bizmodel');
		$aIPv6Classes = array();
		foreach ($aCIChildClasses as $sClass) {
			if (MetaModel::IsAbstract($sClass)) {
				continue;
			}

			$aAttCodes = MetaModel::GetAttributesList($sClass);
			$aIPv6Attributes = array();
			foreach ($aAttCodes as $sAttCode) {
				$oAttDef = MetaModel::GetAttributeDef($sClass, $sAttCode);
				if ($oAttDef instanceof AttributeIPv6Address) {
					$aIPv6Attributes[] = $sAttCode;
				}
			}
			if (sizeof($aIPv6Attributes) != 0) {
				$aIPv6Classes[$sClass] = $aIPv6Attributes;
			}
		}

		// For each of the classes with IPv6 attributes that have not been migrated yet, get the canonical value of the attribute, compress it and store it in the right column.
		foreach ($aIPv6Classes as $sClass => $aIPv6Attributes) {
			$bToBeMigrated = false;
			foreach ($aIPv6Attributes as $sAttCode) {
				// Check if the migration has been done for all attributes
				$sClassOrigin = MetaModel::GetAttributeOrigin($sClass, $sAttCode);
				$sTable = MetaModel::DBGetTable($sClassOrigin, $sAttCode);
				$sColumn = $sAttCode.'_comp';
				$sSQL = "SELECT COUNT(*) FROM $sTable WHERE ISNULL($sColumn)";
				$iCount = CMDBSource::QueryToScalar($sSQL);
				if ($iCount != 0) {
					$bToBeMigrated = true;
					break;
				}
			}

			if ($bToBeMigrated) {
				// Migrate all instances of $sClass
				$oSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT $sClass", array()));
				while ($oObject = $oSet->Fetch()) {
					$iKey = $oObject->getKey();
					foreach ($aIPv6Attributes as $sAttCode) {
						$sValue = $oObject->Get($sAttCode)->ToString();
						$sClassOrigin = MetaModel::GetAttributeOrigin($sClass, $sAttCode);
						$sTable = MetaModel::DBGetTable($sClassOrigin, $sAttCode);
						$sColumn = $sAttCode.'_comp';
						$sSQL = "UPDATE $sTable SET $sColumn = '$sValue' WHERE id = $iKey;";
						CMDBSource::Query($sSQL);
					}
				}
				SetupLog::Info("Module teemip-ipv6-mgmt: all IPv6Attribute of class $sClass have been migrated");
			}
		}
		SetupLog::Info("Module teemip-ipv6-mgmt: compression migration done");
	}

	/**
	 * Get the previous IP if it exists
	 *
	 * @param bool $bInSubnet if lookup should be done in IP's subnet only
	 *
	 * @return null
	 */
	public function GetPreviousIp($bInSubnet)
	{
		$oIp = $this->Get('ip');
		$sIp = $oIp->GetAsCannonical();

		// Create OQL according to $bInSubnet
		$iSubnet = $this->Get('subnet_id');
		if ($bInSubnet) {
			if ($iSubnet > 0) {
				$sOQL = 'SELECT IPv6Address AS ip WHERE ip.subnet_id = :subnet_id AND ip.ip_text < :ip';
			} else {
				return null;
			}
		} else {
			$sOQL = 'SELECT IPv6Address AS ip WHERE ip.org_id = :org_id AND ip.ip_text < :ip';
		}
		// Set the ordering criteria ['ip'=> false] and set a limit (1)
		$oIpSet = new DBObjectSet(DBSearch::FromOQL($sOQL), ['ip' => false], ['org_id' => $this->Get('org_id'), 'subnet_id' => $iSubnet, 'ip' => $sIp], null, 1);
		$oIpSet->OptimizeColumnLoad(['IPv6Address' => ['id', 'ip']]);
		if ($oPreviousIp = $oIpSet->Fetch()) {
			return $oPreviousIp;
		}

		return null;
	}

	/**
	 * Get the next IP if it exists
	 *
	 * @param $bInSubnet true if lookup should be done in IP's subnet only
	 *
	 * @return null
	 */
	public function GetNextIp($bInSubnet)
	{
		$oIp = $this->Get('ip');
		$sIp = $oIp->GetAsCannonical();

		// Create OQL according to $bInSubnet
		$iSubnet = $this->Get('subnet_id');
		if ($bInSubnet) {
			if ($iSubnet > 0) {
				$sOQL = 'SELECT IPv6Address AS ip WHERE ip.subnet_id = :subnet_id AND ip.ip_text > :ip';
			} else {
				return null;
			}
		} else {
			$sOQL = 'SELECT IPv6Address AS ip WHERE ip.ip_text > :ip';
		}
		// Set the ordering criteria ['ip'=> false] and set a limit (1)
		$oIpSet = new DBObjectSet(DBSearch::FromOQL($sOQL), ['ip' => true], ['subnet_id' => $iSubnet, 'ip' => $sIp], null, 1);
		$oIpSet->OptimizeColumnLoad(['IPv6Address' => ['id', 'ip']]);
		if ($oNextIp = $oIpSet->Fetch()) {
			return $oNextIp;
		}

		return null;
	}
}
