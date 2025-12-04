<?php
/*
 * @copyright   Copyright (C) 2010-2025 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Framework\Model;

//use Combodo\iTop\Application\WebPage\WebPage;
use DBObjectSearch;
use DBObjectSet;
use FunctionalCI;
use WebPage;

class _IPApplication extends FunctionalCI {
    /**
     * Register events for the class
     *
     * @return void
     */
    protected function RegisterEventListeners()
    {
        parent::RegisterEventListeners();

        $this->RegisterCRUDListener("EVENT_DB_SET_INITIAL_ATTRIBUTES_FLAGS", 'OnIPApplicationSetInitialAttributesFlagsRequestedByFramework', 40, 'teemip-framework');
        $this->RegisterCRUDListener("EVENT_DB_SET_ATTRIBUTES_FLAGS", 'OnIPApplicationSetAttributesFlagsRequestedByFramework', 40, 'teemip-framework');
    }
	/**
	 * @inheritdoc
	 */
	public function OnInsert() {
		parent::OnInsert();

		// Generate an ID until (very likely) it is unique amongst the existing UUID
		//
		$oSearchDup = DBObjectSearch::FromOQL_AllData("SELECT IPDiscovery WHERE uuid LIKE :sUUID");
		do {
			$sId = strtoupper(bin2hex(random_bytes(8)));
			$sFinalId = vsprintf("%s-%s-%s-%s", str_split($sId,4));

			$oDupSet = new DBObjectSet($oSearchDup, array(), array('sUUID' => $sFinalId));
			$bFound = ($oDupSet->Count() > 0);
		} while ($bFound);
		$this->Set('uuid', $sFinalId);

	}

	/**
	 * @inheritdoc
	 */
	public function DisplayBareRelations(WebPage $oPage, $bEditMode = false) {
		parent::DisplayBareRelations($oPage, $bEditMode);

        /** @var \iTopWebPage $oPage */
        $oPage->RemoveTab('Class:FunctionalCI/Tab:OpenedTickets');
	}

    /**
     * Handle Set initial attributes flags
     *
     * @param $oEventData
     * @return void
     */
    public function OnIPApplicationSetInitialAttributesFlagsRequestedByFramework($oEventData): void
    {
        $this->AddInitialAttributeFlags('uuid', OPT_ATT_READONLY);
    }

    /**
     * Handle Set attributes flags
     *
     * @param $oEventData
     * @return void
     */
    public function OnIPApplicationSetAttributesFlagsRequestedByFramework($oEventData): void
    {
        $this->AddAttributeFlags('uuid', OPT_ATT_READONLY);
	}

}
