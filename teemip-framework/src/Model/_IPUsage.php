<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Framework\Model;

use CMDBObjectSet;
use DBObjectSearch;
use Dict;
use Typology;

class _IPUsage extends Typology
{
	/**
	 * @inheritdoc
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
			if ($this->IsNew()) {
				$iKey = -1;
			} else {
				$iKey = $this->GetKey();
			}
			$sOQL = 'SELECT IPUsage AS u WHERE u.name = :name AND u.org_id = :org_id AND u.id != :key';
			$oIpUsageSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('name' => $sName, 'org_id' => $sOrgId, 'id' => $iKey));
			if ($oIpUsageSet->CountExceeds(0)) {
				// It's NOT a modification (keys are not the same), we deny the creation
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPUsage:AlreadyExists');
			}
		}
	}

	/**
	 * @inheritdoc
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
