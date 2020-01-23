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

class _IPUsage extends Typology
{
	/**
	 * Check validity of new config attributes before creation
	 */
	function DoCheckToWrite()
	{
		// Run standard iTop checks first
		parent::DoCheckToWrite();
		
		// Only one NETWORK_IP_CODE, GATEWAY_IP_CODE and BROADCAST_IP_CODE can exist within an organization
		$sName = $this->Get('name');
		if (($sName == NETWORK_IP_CODE) || ($sName == GATEWAY_IP_CODE) || ($sName == BROADCAST_IP_CODE))
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
			$oIpUsageSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPUsage AS u WHERE u.name = '$sName' AND u.org_id = $sOrgId AND u.id != $iKey"));
			if ($oIpUsageSet->Count() != 0)
			{
				// It's NOT a modification (keys are not the same), we deny the creation
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPUsage:AlreadyExists');
				return;
			}
		}
	}
	
	/**
	 * Change flag of attribute that shouldn't be modified beside creation.
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		if ((!$this->IsNew()) && (($sAttCode == 'name')))
		{
			$sName = $this->Get('name');
			if (($sName == NETWORK_IP_CODE) || ($sName == GATEWAY_IP_CODE) || ($sName == BROADCAST_IP_CODE)) 
			{
				return OPT_ATT_READONLY;
			}
		}
		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}

}
