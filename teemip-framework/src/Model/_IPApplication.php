<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Framework\Model;

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
			$sId = strtoupper(md5(uniqid(rand(), true)));
			$sFinalId = substr($sId, 0, 4).'_'.substr($sId, 4, 4).'_'.substr($sId, 8, 4).'_'.substr($sId, 12, 4);

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

		$oPage->RemoveTab('Class:FunctionalCI/Tab:OpenedTickets');
	}

	/**
	 * @inheritdoc
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '') {
		if ($sAttCode == 'uuid') {
			return OPT_ATT_READONLY;
		}

		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}

	/**
	 * @inheritdoc
	 */
	public function GetInitialStateAttributeFlags($sAttCode, &$aReasons = array()) {
		if ($sAttCode == 'uuid') {
			return OPT_ATT_READONLY;
		}

		return parent::GetInitialStateAttributeFlags($sAttCode, $aReasons);

	}

}
