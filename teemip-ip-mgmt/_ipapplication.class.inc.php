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

class _IPApplication extends FunctionalCI
{
	public function OnInsert()
	{
		parent::OnInsert();

		// Generate an ID until (very likely) it is unique amongst the existing UUID
		//
		$oSearchDup = DBObjectSearch::FromOQL_AllData("SELECT IPDiscovery WHERE uuid LIKE :sUUID");
		do
		{
			$sId = strtoupper(md5(uniqid(rand(), true)));
			$sFinalId = substr($sId, 0, 4).'_'.substr($sId, 4, 4).'_'.substr($sId, 8, 4).'_'.substr($sId, 12, 4);

			$oDupSet = new DBObjectSet($oSearchDup, array(), array('sUUID' => $sFinalId));
			$bFound = ($oDupSet->Count() > 0);
		}
		while ($bFound);
		$this->Set('uuid', $sFinalId);

	}

	public function DisplayBareRelations(WebPage $oPage, $bEditMode = false)
	{
		parent::DisplayBareRelations($oPage, $bEditMode);

		$oPage->RemoveTab('Class:FunctionalCI/Tab:OpenedTickets');
	}

	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		if ($sAttCode == 'uuid')
		{
			return OPT_ATT_READONLY;
		}
		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}

	public function GetInitialStateAttributeFlags($sAttCode, &$aReasons = array())
	{
		if ($sAttCode == 'uuid')
		{
			return OPT_ATT_READONLY;
		}
		return parent::GetInitialStateAttributeFlags($sAttCode, $aReasons);

	}

}
