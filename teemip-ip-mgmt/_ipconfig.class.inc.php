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

class _IPConfig extends cmdbAbstractObject
{
	/**
	 * Check validity of new config attributes before creation
	 */
	function DoCheckToWrite()
	{
		// Run standard iTop checks first
		parent::DoCheckToWrite();
		
		// Only one IPConfig object can exist within an organization
		$iOrgId = $this->Get('org_id');
		$iKey = $this->GetKey();
		$oConfigSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPConfig AS conf WHERE conf.org_id = $iOrgId"));
		while ($oConfig = $oConfigSet->Fetch())
		{
			// If it's a modification (keys are the same), we can proceed, otherwise, we deny the creation 
			if ($oConfig->GetKey() != $iKey)
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPConfig:AlreadyExists');
				return;
			}
		}
		
		// Check validity of block_min_size
		$iBlock4MinSize = $this->Get('ipv4_block_min_size');
		if ($iBlock4MinSize < IPV4_BLOCK_MIN_SIZE)
		{
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:IPv4BlockMinSizeTooSmall', IPV4_BLOCK_MIN_SIZE);
		}
		if (MetaModel::IsValidClass('IPv6Block'))
		{
			$iBlock6MinPrefix = $this->Get('ipv6_block_min_prefix');
			if ($iBlock6MinPrefix > IPV6_BLOCK_MIN_PREFIX)
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:IPv6BlockMinSizeTooSmall', IPV6_BLOCK_MIN_PREFIX);
			}
		}
		
		// Check validity of subnets watermarks
		$iSubLW = $this->Get('subnet_low_watermark');
		$iSubHW = $this->Get('subnet_high_watermark');
		if (!((0 <= $iSubLW) && ($iSubLW <= 100)) || !((0 <= $iSubHW) && ($iSubHW <= 100)))
		{
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:WaterMarksPercent');
		}
		if ($iSubHW < $iSubLW)
		{
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:WaterMarksOrder');
		}
		
		// Check validity of IP ranges watermarks
		$iIpRLW = $this->Get('iprange_low_watermark');
		$iIpRHW = $this->Get('iprange_high_watermark');
		if (!((0 <= $iIpRLW) && ($iIpRLW <= 100)) || !((0 <= $iIpRHW) && ($iIpRHW <= 100)))
		{
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:WaterMarksPercent');
		}
		if ($iIpRHW < $iIpRLW)
		{
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:WaterMarksOrder');
		}
		
		// Check server has been set if ping required
		//if ($this->Get('ping_before_assign') == 'ping_yes')
		//{
		// 	if ($this->Get('ping_server_id') == '')
		// 	{
		//		$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:MissPingServer');
		//	}
		//} 
	}
	
	/**
	 * Change flag of attribute that shouldn't be modified beside creation.
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		if ((!$this->IsNew()) && (($sAttCode == 'org_id')))
		{
			return OPT_ATT_READONLY;
		}
		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}
	
	/**
	 * Retrieve global config for given organization
	 */
	
	public static function GetGlobalIPConfig($iOrgId)
	{
		// Create Global Config of $iOrgId if it doesn't exist
		// Save it only if $iOrgId != 0 and create basic IP usages at the same time
		$oIpConfig = MetaModel::GetObjectFromOQL("SELECT IPConfig AS conf WHERE conf.org_id = $iOrgId", null, false);
		if ($oIpConfig == null)
		{
			$oIpConfig = MetaModel::NewObject('IPConfig');
			if ($iOrgId != 0)
			{
				$oIpConfig->Set('org_id', $iOrgId);
				$oIpConfig->DBInsert();

				IPUsage::CreateBasicIpUsages($iOrgId);
			}
		}
		return ($oIpConfig);
	}
	
	public static function GetFromGlobalIPConfig($sParameter, $iOrgId)
	{
		// Reads $sParameter from Global Config
		if ($iOrgId != null)
		{
			$oIpConfig = IPConfig::GetGlobalIPConfig($iOrgId);
			return ($oIpConfig->Get($sParameter));
		}
		return null;
	}
	
	
}
