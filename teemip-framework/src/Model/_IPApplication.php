<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
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
	 * @inheritdoc
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '') {
		$sFlagsFromParent = parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);

		if ($sAttCode == 'uuid') {
			return (OPT_ATT_READONLY | $sFlagsFromParent);
		}

		return $sFlagsFromParent;
	}

	/**
	 * @inheritdoc
	 */
	public function GetInitialStateAttributeFlags($sAttCode, &$aReasons = array()) {
		$sFlagsFromParent = parent::GetInitialStateAttributeFlags($sAttCode, $aReasons);

		if ($sAttCode == 'uuid') {
			return (OPT_ATT_READONLY | $sFlagsFromParent);
		}

		return $sFlagsFromParent;

	}

}
