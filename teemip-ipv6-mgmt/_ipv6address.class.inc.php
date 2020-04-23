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
 * @copyright   Copyright (C) 2020TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

/**
 * Class _IPv6Address
 */
class _IPv6Address extends IPAddress
{
	/**
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	function GetName()
	{
		return $this->GetAsHtml('ip');
	}
	
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
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.ip_text <= :ip AND :ip <= s.lastip AND s.org_id = :org_id",  array('ip' => $sIp, 'org_id' => $iOrgId)));
		if ($oSubnetSet->Count() != 0)
		{ 
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
		$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.ip_text <= :ip AND :ip <= s.lastip AND s.org_id = :org_id",  array('ip' => $sIp, 'org_id' => $iOrgId)));
		if ($oSubnetSet->Count() != 0)
		{ 
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
		$sSystemType = strtoupper(php_uname($mode = "s"));
		if (strpos($sSystemType, 'WIN') === false)
		{
			// Unix type - what else?
			$sCommand = "ping -c ".NUMBER_OF_PINGS." -W ".$iTimeToWait." ".$sIp;
		}
		else
		{
			// Windows
			$sCommand = "ping -n ".NUMBER_OF_PINGS." -w ".($iTimeToWait*1000)." ".$sIp;
		}
		exec($sCommand, $aOutput, $iRes);
		if ($iRes == 0)
		{
			//Command got an answer. Make sure it is a positive one.
			$sOutput = stripos(implode($aOutput), 'ttl');
			if ($sOutput !== false)
			{
				// ttl string is in the answer => IP pings
				array_unshift($aOutput, $sCommand);
				return $aOutput;
			}
		}
		return array();
	}
	
	/**
	 * Compute attributes before writing object 
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	public function ComputeValues()
	{
		parent::ComputeValues();

		$iOrgId = $this->Get('org_id');
		$oIp = $this->Get('ip');
		$sIp = $oIp->GetAsCannonical();

		$iSubnetId = $this->Get('subnet_id');
		if ($iSubnetId == 0)
		{
			// No subnet parent set yet. Look for the only one that IP may belong to.
			// If none -> orphean IP
			$oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Subnet AS s WHERE s.ip_text <= :ip AND :ip <= s.lastip_text AND s.org_id = :org_id",  array('ip' => $sIp, 'org_id' => $iOrgId)));
			if ($oSubnetSet->Count() != 0)
			{
				$oSubnet = $oSubnetSet->Fetch();
				$this->Set('subnet_id', $oSubnet->GetKey());
			}
		}
		else
		{
			// Preset IP to subnet IP if it is not set yet.
			$oSubnet = MetaModel::GetObject('IPv6Subnet', $iSubnetId, true /* MustBeFound */);
			if (!$oSubnet->DoCheckIpInSubnet($oIp))
			{
				$subnetMask = $oSubnet->BitToMask($oSubnet->Get('mask')); //new ormIPv6(IPV6_SUBNET_MASK);
				$oSubnetMask = new ormIPv6($subnetMask);
				$oNotSubnetMask = $oSubnetMask->BitWiseNot();
				$oIp = $oIp->BitWiseAnd($oNotSubnetMask);
				$oZero = new ormIPv6('::');
				if ($oIp->IsEqual($oZero))
				{
					$oSubnetIp = $oSubnet->Get('ip');
					$this->Set('ip', $oSubnetIp);
				}
			}
		}
	}

	/**
	 * Check validity of new IP attributes before creation
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public function DoCheckToWrite()
	{
		// Run standard iTop checks first
		$sParentCheck = parent::DoCheckToWrite();
		if ($sParentCheck != '')
		{
			$this->m_aCheckIssues[] = $sParentCheck;
			return;
		}
		
		// For new IPs only: 
		if ($this->IsNew())
		{
			$iOrgId = $this->Get('org_id');
			$oIp = $this->Get('ip');
			$sIp = $oIp->GetAsCannonical();
			
			// Make sure IP doesn't already exist for creation
			$oIpSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Address AS i WHERE i.ip_text = :ip AND i.org_id = :org_id",  array('ip' => $sIp, 'org_id' => $iOrgId)));
			while ($oIpAdd = $oIpSet->Fetch())
			{
				// It's a creation -> deny it
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPAddress:IPCollision');
				return;
			}

			// If Subnet is selected, make sure IP belongs to it
			$iSubnetId = $this->Get('subnet_id');
			if ($iSubnetId != 0)
			{
				$oSubnet = MetaModel::GetObject('IPv6Subnet', $iSubnetId, true /* MustBeFound */);
				if (!$oSubnet->DoCheckIpInSubnet($oIp))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPAddress:NotInSubnet');
					return;
				}
			}

			// If IP Range is selected, make sure IP belongs to range
			$iIpRangeId = $this->Get('range_id');
			if ($iIpRangeId != 0)
			{
				$oIpRange = MetaModel::GetObject('IPv6Range', $iIpRangeId, true /* MustBeFound */);
				if (!$oIpRange->DoCheckIpInRange($oIp))
				{
					$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPAddress:NotInRange');
					return;
				}
			}
			else
			{
				// If not look for IP Range that IP may belong to
				$oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv6Range AS r WHERE r.firstip_text <= :ip AND :ip <= r.lastip_text AND r.org_id = :org_id", array('ip' => $sIp, 'org_id' => $iOrgId)));
				if ($oIpRangeSet->Count() != 0)
				{
					$oIpRange = $oIpRangeSet->Fetch();
					$this->Set('range_id', $oIpRange->GetKey());
				}
			}

			// If required by global parameters, ping IP before assigning it
			$sPingBeforeAssign = utils::ReadPostedParam('attr_ping_before_assign', '');
			if (empty($sPingBeforeAssign))
			{
				$sPingBeforeAssign = IPConfig::GetFromGlobalIPConfig('ping_before_assign', $iOrgId);
			}
			if ($sPingBeforeAssign =='ping_yes')
			{
				$aOutput = $this->DoCheckIpPings($this->Get('ip')->ToString(), TIME_TO_WAIT_FOR_PING_LONG);
				if (!empty($aOutput))
				{
					$sOutput = '<br>'.implode('<br>', $aOutput);
					$this->m_aCheckIssues[] = Dict::S('UI:IPManagement:Action:New:IPAddress:IPPings').$sOutput;
					return;
				}
			}
		}
	}
	
	/**
	 * Change flag of attributes that shouldn't be modified beside creation.
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
		if ((!$this->IsNew()) && ($sAttCode == 'ip' || $sAttCode == 'subnet_id' || $sAttCode == 'range_id'))
		{
			return OPT_ATT_READONLY;
		}
		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}

	static public function IPv6CompressionMigration()
	{
		SetupPage::log_info("Module teemip-ipv6-mgmt: for all IPv6Attribute, fill new _comp (compressed) column with compressed value of IP");

		// Get list of all non abstract classes under cmdbAbstractObject that have at least one IPv6Attribute and list these attributes
		$aCIChildClasses = MetaModel::GetClasses('bizmodel');
		$aIPv6Classes = array();
		foreach ($aCIChildClasses as $sClass)
		{
			if (MetaModel::IsAbstract($sClass))
			{
				continue;
			}

			$aAttCodes = MetaModel::GetAttributesList($sClass);
			$aIPv6Attributes = array();
			foreach ($aAttCodes as $sAttCode)
			{
				$oAttDef = MetaModel::GetAttributeDef($sClass,	$sAttCode);
				if ($oAttDef instanceof AttributeIPv6Address)
				{
					$aIPv6Attributes[] = $sAttCode;
				}
			}
			if (sizeof ($aIPv6Attributes) != 0)
			{
				$aIPv6Classes[$sClass] = $aIPv6Attributes;
			}
		}

		// For each of the classes with IPv6 attributes that have not been migrated yet, get the canonical value of the attribute, compress it and store it in the right column.
		foreach ($aIPv6Classes as $sClass => $aIPv6Attributes)
		{
			$bToBeMigrated = false;
			foreach ($aIPv6Attributes as $sAttCode)
			{
				// Check if the migration has been done for all attributes
				$sClassOrigin = MetaModel::GetAttributeOrigin($sClass, $sAttCode);
				$sTable = MetaModel::DBGetTable($sClassOrigin, $sAttCode);
				$sColumn = $sAttCode.'_comp';
				$sSQL = "SELECT COUNT(*) FROM $sTable WHERE ISNULL($sColumn)";
				$iCount = CMDBSource::QueryToScalar($sSQL);
				if ($iCount != 0)
				{
					$bToBeMigrated = true;
					break;
				}
			}

			if ($bToBeMigrated)
			{
				// Migrate all instances of $sClass
				$oSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT $sClass",  array()));
				$iCount = $oSet->Count();
				while ($oObject = $oSet->Fetch())
				{
					$iKey = $oObject->getKey();
					foreach ($aIPv6Attributes as $sAttCode)
					{
						$sValue = $oObject->Get($sAttCode)->ToString();
						$sClassOrigin = MetaModel::GetAttributeOrigin($sClass, $sAttCode);
						$sTable = MetaModel::DBGetTable($sClassOrigin, $sAttCode);
						$sColumn = $sAttCode.'_comp';
						$sSQL = "UPDATE $sTable SET $sColumn = '$sValue' WHERE id = $iKey;";
						CMDBSource::Query($sSQL);
					}
				}
				SetupPage::log_info("Module teemip-ipv6-mgmt: all IPv6Attribute of class $sClass have been migrated");
			}
		}
		SetupPage::log_info("Module teemip-ipv6-mgmt: compression migration done");
	}
}
