<?php
/*
 * @copyright   Copyright (C) 2010-2025 TeemIp
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
     * Register events for the class
     *
     * @return void
     */
    protected function RegisterEventListeners()
    {
        parent::RegisterEventListeners();

        $this->RegisterCRUDListener("EVENT_DB_SET_ATTRIBUTES_FLAGS", 'OnIPUsageSetAttributeFlagsRequestedByFramework', 40, 'teemip-framework');
    }

	/**
	 * @inheritdoc
	 */
	function DoCheckToWrite()
	{
		// Run standard iTop checks first
		parent::DoCheckToWrite();

		// Only one NETWORK_IP_CODE, GATEWAY_IP_CODE and BROADCAST_IP_CODE can exist within an organization
		$sName = $this->Get('name');
		if (($sName == NETWORK_IP_CODE) || ($sName == GATEWAY_IP_CODE) || ($sName == BROADCAST_IP_CODE)) {
			if ($this->IsNew()) {
				$sOQL = 'SELECT IPUsage AS u WHERE u.name = :name AND u.org_id = :org_id';
			} else {
				$sOQL = 'SELECT IPUsage AS u WHERE u.name = :name AND u.org_id = :org_id AND u.id != :id';
			}
			$oIPUsageSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('name' => $sName, 'org_id' => $this->Get('org_id'), 'id' => $this->GetKey()));
			if ($oIPUsageSet->CountExceeds(0)) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPUsage:AlreadyExists');
			}
		}
	}

    /**
     * Handle Set Attributes Flags event
     *
     * @param $oEventData
     * @return void
     */
    public function OnIPUsageSetAttributeFlagsRequestedByFramework($oEventData): void
    {
        $sName = $this->Get('name');
        if (($sName == NETWORK_IP_CODE) || ($sName == GATEWAY_IP_CODE) || ($sName == BROADCAST_IP_CODE)) {
            $this->AddAttributeFlags('name', OPT_ATT_READONLY);
        }
    }

}
