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

/*******************
 * Global constants
 */

define('SPACE_TO_SOA', 16);
define('SPACE_SOA_TO_COMMENT', 8);
define('SPACE_OWNER_TO_CLASS', 24);
define('SPACE_PTR_OWNER_TO_CLASS', 12);
define('SPACE_OWNER_TO_TTL', 16);
define('SPACE_PTR_OWNER_TO_TTL', 4);
define('SPACE_TTL_TO_CLASS', 7);
define('SPACE_TO_COMMENT', 96);

/***********************************
 * Plugin to extend the Popup Menus
 */

/**
 * Class ZoneMgmtExtraMenus
 */
class ZoneMgmtExtraMenus implements iPopupMenuExtension
{
	public static function EnumItems($iMenuId, $param)
	{
		$aResult = array();
		switch($iMenuId)
		{
			case iPopupMenuExtension::MENU_OBJLIST_ACTIONS:	// $param is a DBObjectSet
			case iPopupMenuExtension::MENU_OBJLIST_TOOLKIT: // $param is a DBObjectSet
				break;

			case iPopupMenuExtension::MENU_OBJDETAILS_ACTIONS: // $param is a DBObject
				$oObj = $param;

				// Additional actions for IPAddress and IPSubnet
				if (($oObj instanceof IPAddress) || ($oObj instanceof IPSubnet))
				{
					$aResult[] = new SeparatorPopupMenuItem();
					$oAppContext = new ApplicationContext();

					/** @var \IPObject $oObj */
					$id = $oObj->GetKey();
					$sClass = get_class($oObj);

					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['id'] = $id;

					$operation = utils::ReadParam('operation', '');
					switch ($operation)
					{
						case 'apply_new':
						case 'apply_modify':
						case 'details':
							$aParams['operation'] = 'updaterrs';
							$sMenu = 'UI:ZoneManagement:Action:IPObject:UpdateRR';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-zone-mgmt', 'ui.teemip-zone-mgmt.php', $aParams));
							$aParams['operation'] = 'deleterrs';
							$sMenu = 'UI:ZoneManagement:Action:IPObject:DeleteRR';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-zone-mgmt', 'ui.teemip-zone-mgmt.php', $aParams));
							break;

						default:
							break;
					}
				}
				// Additional actions for Zone
				elseif ($oObj instanceof Zone)
				{
					$aResult[] = new SeparatorPopupMenuItem();
					$oAppContext = new ApplicationContext();
					$sContext = $oAppContext->GetForLink();

					/** @var \Zone $oObj */
					$id = $oObj->GetKey();
					$sClass = get_class($oObj);

					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['id'] = $id;
					
					$operation = utils::ReadParam('operation', '');
					switch ($operation)
					{
						case 'apply_new':
						case 'apply_modify':
						case 'details':
							$aParams['operation'] = 'datafiledisplay';
							$aParams['sort_order'] = 'sort_by_record';
							$sMenu = 'UI:ZoneManagement:Action:Zone:DataFileDisplay';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-zone-mgmt', 'ui.teemip-zone-mgmt.php', $aParams));
						break;
						
						case 'datafiledisplay':
							$sMenu = 'UI:ZoneManagement:Action:Zone:Details';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
						break;
												
						default:
						break;
					}
				}
				break;

			case iPopupMenuExtension::MENU_DASHBOARD_ACTIONS: // $param is a Dashboard
				break;
			
			default: // Unknown type of menu, do nothing
				break;
		}
		return $aResult;
	}
}