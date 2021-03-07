<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

class MacAddressLookupExtraMenus implements iPopupMenuExtension
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

				// Additional actions for classes that have at least an 'AttributeMacAddress' attribute
				$sClass = get_class($oObj);
				$bHasMacAddressAttribute = false;
				foreach(MetaModel::ListAttributeDefs($sClass) as $sAttCode => $oAttDef)
				{
					if ($oAttDef instanceof AttributeMacAddress)
					{
						$sMac = $oObj->Get($sAttCode);
						if ($sMac != '')
						{
							$bHasMacAddressAttribute = true;
							break;
						}
					}
				}
				if ($bHasMacAddressAttribute)
				{
					$oAppContext = new ApplicationContext();
					$sContext = $oAppContext->GetForLink();

					$id = $oObj->GetKey();
					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['id'] = $id;

					$operation = utils::ReadParam('operation','');
					switch ($operation)
					{
						case 'apply_new':
						case 'apply_modify':
						case 'details':
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'maclookupfromci';
							$sMenu = 'UI:MACLookup:Action:CI:Lookup';
							$aResult[] = new URLPopupMenuItem($sMenu,Dict::S($sMenu),utils::GetAbsoluteUrlModulePage('teemip-macaddress-lookup','ui.teemip-macaddress-lookup.php',$aParams));
							break;

						case 'maclookupfromci':
							$aResult[] = new SeparatorPopupMenuItem();
							$sMenu = 'UI:MACLookup:Action:CI:Details';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
							break;

						default:
							break;
					}
				}
				break;

			case iPopupMenuExtension::MENU_DASHBOARD_ACTIONS: // $param is a Dashboard
			default: // Unknown type of menu, do nothing
				break;
		}
		return $aResult;
	}
}