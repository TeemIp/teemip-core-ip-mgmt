<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Hook;

use ApplicationContext;
use Dict;
use Domain;
use IPAddress;
use IPBlock;
use iPopupMenuExtension;
use IPRange;
use IPSubnet;
use IPv4Subnet;
use IPv6Subnet;
use MetaModel;
use SeparatorPopupMenuItem;
use URLButtonItem;
use URLPopupMenuItem;
use UserRights;
use utils;

class IPMgmtExtraMenus implements iPopupMenuExtension
{
	const MODULE_CODE = 'teemip-ip-mgmt';
	const BLOCK_NAV_FUNCTION_CODE = 'block_navigation';
	const BLOCK_NAV_FUNCTION_SETTING_ENABLED = 'enabled';
	const BLOCK_NAV_FUNCTION_SETTING_WITHIN_BLOCK_ONLY = 'within_block_only';
	const SUBNET_NAV_FUNCTION_CODE = 'subnet_navigation';
	const SUBNET_NAV_FUNCTION_SETTING_ENABLED = 'enabled';
	const SUBNET_NAV_FUNCTION_SETTING_WITHIN_BLOCK_ONLY = 'within_block_only';
	const RANGE_NAV_FUNCTION_CODE = 'range_navigation';
	const RANGE_NAV_FUNCTION_SETTING_ENABLED = 'enabled';
	const RANGE_NAV_FUNCTION_SETTING_WITHIN_SUBNET_ONLY = 'within_subnet_only';
	const IP_NAV_FUNCTION_CODE = 'ip_navigation';
	const IP_NAV_FUNCTION_SETTING_ENABLED = 'enabled';
	const IP_NAV_FUNCTION_SETTING_WITHIN_SUBNET_ONLY = 'within_subnet_only';

	const DEFAULT_BLOCK_NAV_FUNCTION_SETTING_ENABLED = true;
	const DEFAULT_BLOCK_NAV_FUNCTION_SETTING_WITHIN_BLOCK_ONLY = true;
	const DEFAULT_SUBNET_NAV_FUNCTION_SETTING_ENABLED = true;
	const DEFAULT_SUBNET_NAV_FUNCTION_SETTING_WITHIN_BLOCK_ONLY = true;
	const DEFAULT_RANGE_NAV_FUNCTION_SETTING_ENABLED = true;
	const DEFAULT_RANGE_NAV_FUNCTION_SETTING_WITHIN_SUBNET_ONLY = true;
	const DEFAULT_IP_NAV_FUNCTION_SETTING_ENABLED = true;
	const DEFAULT_IP_NAV_FUNCTION_SETTING_WITHIN_SUBNET_ONLY = true;

	/**
	 * @inheritdoc
	 */
	public static function EnumItems($iMenuId, $param)
	{
		$aResult = array();
		switch ($iMenuId) {
			case iPopupMenuExtension::MENU_OBJLIST_ACTIONS:    // $param is a DBObjectSet
				$oSet = $param;
				if (!$oSet->CountExceeds(1) && ($oSet->Count() > 0)) {
					// Menu for single objects only
					$sClass = $oSet->GetClass();

					if (($sClass == 'IPv4Block') || ($sClass == 'IPv6Block')) {
						// Additional actions for IPBlocks
						/** @var \IPBlock $oObj */
						$oObj = $oSet->Fetch();
						$operation = utils::ReadParam('operation', '');

						// Unique org is selected as we have a single object
						$id = $oObj->GetKey();
						$iBlockSize = $oObj->GetSize();

						$oAppContext = new ApplicationContext();
						$aParams = $oAppContext->GetAsHash();
						$aParams['class'] = $sClass;
						$aParams['id'] = $id;
						$aParams['filter'] = $param->GetFilter()->serialize();
						switch ($operation) {
							case 'displaytree':
								if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
									$aResult[] = new SeparatorPopupMenuItem();

									if ($oObj->IsDelegated()) {
										$aParams['operation'] = 'undelegate';
										$sMenu = 'UI:IPManagement:Action:Undelegate:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									} else {
										$aParams['operation'] = 'delegate';
										$sMenu = 'UI:IPManagement:Action:Delegate:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									}

									$aResult[] = new SeparatorPopupMenuItem();
									if ($iBlockSize > 1) {
										$aResult[] = new SeparatorPopupMenuItem();
										$aParams['operation'] = 'shrinkblock';
										$sMenu = 'UI:IPManagement:Action:Shrink:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

										$aParams['operation'] = 'splitblock';
										$sMenu = 'UI:IPManagement:Action:Split:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									}
									$aParams['operation'] = 'expandblock';
									$sMenu = 'UI:IPManagement:Action:Expand:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									$aResult[] = new SeparatorPopupMenuItem();

									$aParams['operation'] = 'listspace';
									$sMenu = 'UI:IPManagement:Action:ListSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

									if ($iBlockSize > 1) {
										$aParams['operation'] = 'findspace';
										$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									}
								} else {
									$aResult[] = new SeparatorPopupMenuItem();
									$aParams['operation'] = 'listspace';
									$sMenu = 'UI:IPManagement:Action:ListSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
								break;

							case 'displaylist':
							default:
								if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
									$aResult[] = new SeparatorPopupMenuItem();

									if ($oObj->IsDelegated()) {
										$aParams['operation'] = 'undelegate';
										$sMenu = 'UI:IPManagement:Action:Undelegate:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									} else {
										$aParams['operation'] = 'delegate';
										$sMenu = 'UI:IPManagement:Action:Delegate:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									}

									$aResult[] = new SeparatorPopupMenuItem();
									$aParams['operation'] = 'shrinkblock';
									$sMenu = 'UI:IPManagement:Action:Shrink:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

									$aParams['operation'] = 'splitblock';
									$sMenu = 'UI:IPManagement:Action:Split:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

									$aParams['operation'] = 'expandblock';
									$sMenu = 'UI:IPManagement:Action:Expand:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									$aResult[] = new SeparatorPopupMenuItem();

									$aParams['operation'] = 'listspace';
									$sMenu = 'UI:IPManagement:Action:ListSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

									$aParams['operation'] = 'findspace';
									$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								} else {
									$aResult[] = new SeparatorPopupMenuItem();
									$aParams['operation'] = 'listspace';
									$sMenu = 'UI:IPManagement:Action:ListSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
								break;
						}
					} elseif (($sClass == 'IPv4Subnet') || ($sClass == 'IPv6Subnet')) {
						// Additional actions for IPSubnets
						/** @var \IPSubnet $oObj */
						$oObj = $oSet->Fetch();

						// Unique org is selected as we have a single object
						$id = $oObj->GetKey();

						$oAppContext = new ApplicationContext();
						$aParams = $oAppContext->GetAsHash();
						$aParams['class'] = $sClass;
						$aParams['id'] = $id;
						$aParams['filter'] = $param->GetFilter()->serialize();
						if ($sClass == 'IPv4Subnet') {
							// Additional actions for IPv4Subnets
							if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
								$aResult[] = new SeparatorPopupMenuItem();
								$aParams['operation'] = 'shrinksubnet';
								$sMenu = 'UI:IPManagement:Action:Shrink:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

								$aParams['operation'] = 'splitsubnet';
								$sMenu = 'UI:IPManagement:Action:Split:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

								$aParams['operation'] = 'expandsubnet';
								$sMenu = 'UI:IPManagement:Action:Expand:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								$aResult[] = new SeparatorPopupMenuItem();

								$aParams['operation'] = 'listips';
								$sMenu = 'UI:IPManagement:Action:ListIps:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								$aParams['operation'] = 'findspace';
								$sMenu = 'UI:IPManagement:Action:FindSpace:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

								$aParams['operation'] = 'csvexportips';
								$sMenu = 'UI:IPManagement:Action:CsvExportIps:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							} else {
								$aResult[] = new SeparatorPopupMenuItem();

								$aParams['operation'] = 'listips';
								$sMenu = 'UI:IPManagement:Action:ListIps:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

								$aParams['operation'] = 'csvexportips';
								$sMenu = 'UI:IPManagement:Action:CsvExportIps:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
						} elseif ($sClass == 'IPv6Subnet') {
							// Additional actions for IPv6Subnets
							$operation = utils::ReadParam('operation', '');

							// Unique org is selected as we have a single object
							$id = $oObj->GetKey();
							$sBitMask = $oObj->Get('mask');

							if ($sBitMask == '128') {
								break;
							}
							$oAppContext = new ApplicationContext();
							$aParams = $oAppContext->GetAsHash();
							$aParams['class'] = $sClass;
							$aParams['id'] = $id;
							$aParams['filter'] = $param->GetFilter()->serialize();
							switch ($operation) {
								case 'displaytree':
								case 'displaylist':
								default:
									if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
										$aResult[] = new SeparatorPopupMenuItem();

										$aParams['operation'] = 'listips';
										$sMenu = 'UI:IPManagement:Action:ListIps:IPv6Subnet';
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

										$aParams['operation'] = 'findspace';
										$sMenu = 'UI:IPManagement:Action:FindSpace:IPv6Subnet';
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

										$aParams['operation'] = 'csvexportips';
										$sMenu = 'UI:IPManagement:Action:CsvExportIps:IPv6Subnet';
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									} else {
										$aResult[] = new SeparatorPopupMenuItem();

										$aParams['operation'] = 'listips';
										$sMenu = 'UI:IPManagement:Action:ListIps:IPv6Subnet';
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

										$aParams['operation'] = 'csvexportips';
										$sMenu = 'UI:IPManagement:Action:CsvExportIps:IPv6Subnet';
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									}
									break;
							}
						}
					} // Additional actions for IPAddress
					elseif (($sClass == 'IPv4Address') || ($sClass == 'IPv6Address')) {
						if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
							/** @var \IPAddress $oObj */
							$oObj = $oSet->Fetch();

							// Unique org is selected as we have a single object
							$id = $oObj->GetKey();
							$sStatus = $oObj->Get('status');

							$oAppContext = new ApplicationContext();
							$aParams = $oAppContext->GetAsHash();
							$aParams['class'] = $sClass;
							$aParams['id'] = $id;
							$aParams['filter'] = $param->GetFilter()->serialize();

							switch ($sStatus) {
								case 'allocated':
									$aResult[] = new SeparatorPopupMenuItem();
									$aParams['operation'] = 'unallocateip';
									$sMenu = 'UI:IPManagement:Action:UnAllocateIP:IPAddress';
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									break;

								case 'reserved':
								case 'released':
								case 'unassigned':
									$aResult[] = new SeparatorPopupMenuItem();
									$aParams['operation'] = 'allocateip';
									$sMenu = 'UI:IPManagement:Action:AllocateIP:IPaddress';
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									break;

								default:
									break;
							}
						}
					} // Additional actions for Domain
					elseif ($sClass == 'Domain') {
						if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
							/** @var \Domain $oObj */
							$oObj = $oSet->Fetch();

							// Unique org is selected as we have a single object
							$id = $oObj->GetKey();

							$oAppContext = new ApplicationContext();
							$aParams = $oAppContext->GetAsHash();
							$aParams['class'] = $sClass;
							$aParams['id'] = $id;
							$aResult[] = new SeparatorPopupMenuItem();

							if ($oObj->IsDelegated()) {
								$aParams['operation'] = 'undelegate';
								$sMenu = 'UI:IPManagement:Action:Undelegate:Domain';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							} else {
								$aParams['operation'] = 'delegate';
								$sMenu = 'UI:IPManagement:Action:Delegate:Domain';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
						}
					}
				}
				break;

			case iPopupMenuExtension::MENU_OBJLIST_TOOLKIT: // $param is a DBObjectSet
				$oSet = $param;
				$sClass = $oSet->GetClass();

				if (($sClass == 'IPv4Block') || ($sClass == 'IPv6Block')) {
					// Additional actions for IPBlocks
					$operation = utils::ReadParam('operation', '');

					$oAppContext = new ApplicationContext();
					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['filter'] = $param->GetFilter()->serialize();
					switch ($operation) {
						case 'displaytree':
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaylist';
							$sMenu = 'UI:IPManagement:Action:DisplayList:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;

						case 'displaylist':
						default:
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaytree';
							$sMenu = 'UI:IPManagement:Action:DisplayTree:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;
					}
				} elseif (($sClass == 'IPv4Subnet') || ($sClass == 'IPv6Subnet')) {
					// Additional actions for IPSubnets
					$operation = utils::ReadParam('operation', '');

					$oAppContext = new ApplicationContext();
					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['filter'] = $param->GetFilter()->serialize();
					switch ($operation) {
						case 'displaytree':
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaylist';
							$sMenu = 'UI:IPManagement:Action:DisplayList:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;

						case 'docalculator':
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaylist';
							$sMenu = 'UI:IPManagement:Action:DisplayList:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							$aParams['operation'] = 'displaytree';
							$sMenu = 'UI:IPManagement:Action:DisplayTree:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;

						case 'displaylist':
						default:
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaytree';
							$sMenu = 'UI:IPManagement:Action:DisplayTree:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;
					}
					$aResult[] = new SeparatorPopupMenuItem();
					$aParams['operation'] = 'calculator';
					$sMenu = 'UI:IPManagement:Action:Calculator:'.$sClass;
					$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
				} elseif ($sClass == 'Domain') {
					// Additional actions for Domain
					$operation = utils::ReadParam('operation', '');

					$oAppContext = new ApplicationContext();
					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['filter'] = $param->GetFilter()->serialize();
					switch ($operation) {
						case 'displaytree':
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaylist';
							$sMenu = 'UI:IPManagement:Action:DisplayList:Domain';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;

						case 'displaylist':
						default:
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaytree';
							$sMenu = 'UI:IPManagement:Action:DisplayTree:Domain';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;
					}
				}
				break;

			case iPopupMenuExtension::MENU_OBJDETAILS_ACTIONS: // $param is a DBObject
				$oObj = $param;

				if ($oObj instanceof IPBlock) {
					$sClass = get_class($oObj);

					// Display pointers to previous and next Subnets according to configuration parameters
					$aDefaultSettings = array(
						static::BLOCK_NAV_FUNCTION_SETTING_ENABLED => static::DEFAULT_BLOCK_NAV_FUNCTION_SETTING_ENABLED,
						static::BLOCK_NAV_FUNCTION_SETTING_WITHIN_BLOCK_ONLY => static::DEFAULT_BLOCK_NAV_FUNCTION_SETTING_WITHIN_BLOCK_ONLY,
					);
					$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::BLOCK_NAV_FUNCTION_CODE, $aDefaultSettings);
					$bEnabled = (bool) $aFunctionSettings[static::BLOCK_NAV_FUNCTION_SETTING_ENABLED];
					if ($bEnabled) {
						$bWithinBlockOnly = (bool) $aFunctionSettings[static::BLOCK_NAV_FUNCTION_SETTING_WITHIN_BLOCK_ONLY];
						$oPreviousIPBlock = $oObj->GetPreviousBlock($bWithinBlockOnly);
						if (!is_null($oPreviousIPBlock)) {
							$slabel = Dict::S('UI:IPManagement:Action:DisplayPrevious:IPBlock');
							$id = $oPreviousIPBlock->GetKey();
							$oItem = new URLButtonItem('previous_ipblock', $slabel, utils::GetAbsoluteUrlAppRoot().'pages/UI.php?operation=details&class='.$sClass.'&id='.$id, '_top');
							$oItem->SetIconClass('fas fa-caret-left');
							$oItem->SetTooltip($slabel);
							$aResult[] = $oItem;
						}
						$oNextIPBlock = $oObj->GetNextBlock($bWithinBlockOnly);
						if (!is_null($oNextIPBlock)) {
							$slabel = Dict::S('UI:IPManagement:Action:DisplayNext:IPBlock');
							$id = $oNextIPBlock->GetKey();
							$oItem = new URLButtonItem('next_ipblock', $slabel, utils::GetAbsoluteUrlAppRoot().'pages/UI.php?operation=details&class='.$sClass.'&id='.$id, '_top');
							$oItem->SetIconClass('fas fa-caret-right');
							$oItem->SetTooltip($slabel);
							$aResult[] = $oItem;
						}
					}

					// Additional actions for IPBlocks
					$oAppContext = new ApplicationContext();
					$id = $oObj->GetKey();
					$sContext = $oAppContext->GetForLink();

					$iBlockSize = $oObj->GetSize();

					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['id'] = $id;
					if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
						if (($sClass == 'IPv4Block') && ($iBlockSize == 1)) {
							$aResult[] = new SeparatorPopupMenuItem();

							if ($oObj->IsDelegated()) {
								$aParams['operation'] = 'undelegate';
								$sMenu = 'UI:IPManagement:Action:Undelegate:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							} else {
								$aParams['operation'] = 'delegate';
								$sMenu = 'UI:IPManagement:Action:Delegate:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}

							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'expandblock';
							$sMenu = 'UI:IPManagement:Action:Expand:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							$aResult[] = new SeparatorPopupMenuItem();
						} else {
							$aResult[] = new SeparatorPopupMenuItem();

							if ($oObj->IsDelegated()) {
								$aParams['operation'] = 'undelegate';
								$sMenu = 'UI:IPManagement:Action:Undelegate:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							} else {
								$aParams['operation'] = 'delegate';
								$sMenu = 'UI:IPManagement:Action:Delegate:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}

							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'shrinkblock';
							$sMenu = 'UI:IPManagement:Action:Shrink:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

							$aParams['operation'] = 'splitblock';
							$sMenu = 'UI:IPManagement:Action:Split:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

							$aParams['operation'] = 'expandblock';
							$sMenu = 'UI:IPManagement:Action:Expand:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							$aResult[] = new SeparatorPopupMenuItem();
						}
					}
					$operation = utils::ReadParam('operation', '');
					switch ($operation) {
						case 'apply_modify':
						case 'apply_new':
						case 'details':
						case 'delegate':
						case 'doexpandblock':
						case 'doshrinkblock':
						case 'release_lock_and_details':
						case 'undelegate':
							$aParams['operation'] = 'listspace';
							$sMenu = 'UI:IPManagement:Action:ListSpace:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
								if ($iBlockSize > 1) {
									$aParams['operation'] = 'findspace';
									$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
							}
							break;

						case 'listspace':
							if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
								$aParams['operation'] = 'findspace';
								$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
							$aResult[] = new URLPopupMenuItem('UI:IPManagement:Action:Details:'.$sClass, Dict::S('UI:IPManagement:Action:Details:'.$sClass), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
							break;

						case 'dofindspace':
							$aParams['operation'] = 'listspace';
							$sMenu = 'UI:IPManagement:Action:ListSpace:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
								$aParams['operation'] = 'findspace';
								$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
							$aResult[] = new URLPopupMenuItem('UI:IPManagement:Action:Details:'.$sClass, Dict::S('UI:IPManagement:Action:Details:'.$sClass), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
							break;

						default:
							break;
					}
				} elseif ($oObj instanceof IPSubnet) {
					$sClass = get_class($oObj);

					// Display pointers to previous and next Subnets according to configuration parameters
					$aDefaultSettings = array(
						static::SUBNET_NAV_FUNCTION_SETTING_ENABLED => static::DEFAULT_SUBNET_NAV_FUNCTION_SETTING_ENABLED,
						static::SUBNET_NAV_FUNCTION_SETTING_WITHIN_BLOCK_ONLY => static::DEFAULT_SUBNET_NAV_FUNCTION_SETTING_WITHIN_BLOCK_ONLY,
					);
					$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::SUBNET_NAV_FUNCTION_CODE, $aDefaultSettings);
					$bEnabled = (bool) $aFunctionSettings[static::SUBNET_NAV_FUNCTION_SETTING_ENABLED];
					if ($bEnabled) {
						$bWithinBlockOnly = (bool) $aFunctionSettings[static::SUBNET_NAV_FUNCTION_SETTING_WITHIN_BLOCK_ONLY];
						$oPreviousIPSubnet = $oObj->GetPreviousSubnet($bWithinBlockOnly);
						if (!is_null($oPreviousIPSubnet)) {
							$slabel = Dict::S('UI:IPManagement:Action:DisplayPrevious:IPSubnet');
							$id = $oPreviousIPSubnet->GetKey();
							$oItem = new URLButtonItem('previous_ipsubnet', $slabel, utils::GetAbsoluteUrlAppRoot().'pages/UI.php?operation=details&class='.$sClass.'&id='.$id, '_top');
							$oItem->SetIconClass('fas fa-caret-left');
							$oItem->SetTooltip($slabel);
							$aResult[] = $oItem;
						}
						$oNextIPSubnet = $oObj->GetNextSubnet($bWithinBlockOnly);
						if (!is_null($oNextIPSubnet)) {
							$slabel = Dict::S('UI:IPManagement:Action:DisplayNext:IPSubnet');
							$id = $oNextIPSubnet->GetKey();
							$oItem = new URLButtonItem('next_ipsubnet', $slabel, utils::GetAbsoluteUrlAppRoot().'pages/UI.php?operation=details&class='.$sClass.'&id='.$id, '_top');
							$oItem->SetIconClass('fas fa-caret-right');
							$oItem->SetTooltip($slabel);
							$aResult[] = $oItem;
						}
					}

					// Additional actions for IPSubnets
					$oAppContext = new ApplicationContext();
					$id = $oObj->GetKey();
					$sContext = $oAppContext->GetForLink();

					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['id'] = $id;
					$bSingleIPSubnet = false;
					if ($oObj instanceof IPv4Subnet) {
						$sBitMask = $oObj->Get('mask');
						if ($sBitMask == '255.255.255.255') {
							$bSingleIPSubnet = true;
						}
						if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
							$aResult[] = new SeparatorPopupMenuItem();
							if (!$bSingleIPSubnet) {
								$aParams['operation'] = 'shrinksubnet';
								$sMenu = 'UI:IPManagement:Action:Shrink:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

								$aParams['operation'] = 'splitsubnet';
								$sMenu = 'UI:IPManagement:Action:Split:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}

							$aParams['operation'] = 'expandsubnet';
							$sMenu = 'UI:IPManagement:Action:Expand:IPv4Subnet';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							$aResult[] = new SeparatorPopupMenuItem();
						}
					} elseif ($oObj instanceof IPv6Subnet) {
						$sBitMask = $oObj->Get('mask');
						if ($sBitMask == '128') {
							$bSingleIPSubnet = true;
						} elseif (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
							$aResult[] = new SeparatorPopupMenuItem();
						}
					} else {
						return array();
					}

					if (!$bSingleIPSubnet) {
						$operation = utils::ReadParam('operation', '');
						switch ($operation) {
							case 'apply_modify':
							case 'apply_new':
							case 'details':
							case 'doexpandsubnet':
							case 'doshrinksubnet':
								$aParams['operation'] = 'listips';
								$sMenu = 'UI:IPManagement:Action:ListIps:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
									$aParams['operation'] = 'findspace';
									$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
								$aParams['operation'] = 'csvexportips';
								$sMenu = 'UI:IPManagement:Action:CsvExportIps:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								break;

							case 'listips':
								if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
									$aParams['operation'] = 'findspace';
									$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
								$aResult[] = new URLPopupMenuItem('UI:IPManagement:Action:Details:'.$sClass, Dict::S('UI:IPManagement:Action:Details:'.$sClass), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
								$aParams['operation'] = 'csvexportips';
								$sMenu = 'UI:IPManagement:Action:CsvExportIps:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								break;

							case 'docalculator':
							case 'docsvexportips':
							case 'dofindspace':
							case 'dolistips':
								$aParams['operation'] = 'listips';
								$sMenu = 'UI:IPManagement:Action:ListIps:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
									$aParams['operation'] = 'findspace';
									$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
								$sMenu = 'UI:IPManagement:Action:Details:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
								$aParams['operation'] = 'csvexportips';
								$sMenu = 'UI:IPManagement:Action:CsvExportIps:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								break;

							case 'csvexportips':
								$aParams['operation'] = 'listips';
								$sMenu = 'UI:IPManagement:Action:ListIps:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
									$aParams['operation'] = 'findspace';
									$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
								$sMenu = 'UI:IPManagement:Action:Details:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
								break;

							default:
								break;
						}
					}
					$aResult[] = new SeparatorPopupMenuItem();
					$aParams['operation'] = 'calculator';
					$sMenu = 'UI:IPManagement:Action:Calculator:'.$sClass;
					$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
				} elseif ($oObj instanceof IPRange) {
					$sClass = get_class($oObj);

					// Display pointers to previous and next IPRange according to configuration parameters
					$aDefaultSettings = array(
						static::RANGE_NAV_FUNCTION_SETTING_ENABLED => static::DEFAULT_RANGE_NAV_FUNCTION_SETTING_ENABLED,
						static::RANGE_NAV_FUNCTION_SETTING_WITHIN_SUBNET_ONLY => static::DEFAULT_RANGE_NAV_FUNCTION_SETTING_WITHIN_SUBNET_ONLY,
					);
					$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::RANGE_NAV_FUNCTION_CODE, $aDefaultSettings);
					$bEnabled = (bool) $aFunctionSettings[static::RANGE_NAV_FUNCTION_SETTING_ENABLED];
					if ($bEnabled) {
						$bWithinSubnetOnly = (bool) $aFunctionSettings[static::RANGE_NAV_FUNCTION_SETTING_WITHIN_SUBNET_ONLY];
						$oPreviousIPRange = $oObj->GetPreviousRange($bWithinSubnetOnly);
						if (!is_null($oPreviousIPRange)) {
							$slabel = Dict::S('UI:IPManagement:Action:DisplayPrevious:IPRange');
							$id = $oPreviousIPRange->GetKey();
							$oItem = new URLButtonItem('previous_iprange', $slabel, utils::GetAbsoluteUrlAppRoot().'pages/UI.php?operation=details&class='.$sClass.'&id='.$id, '_top');
							$oItem->SetIconClass('fas fa-caret-left');
							$oItem->SetTooltip($slabel);
							$aResult[] = $oItem;
						}
						$oNextIPRange = $oObj->GetNextRange($bWithinSubnetOnly);
						if (!is_null($oNextIPRange)) {
							$slabel = Dict::S('UI:IPManagement:Action:DisplayNext:IPRange');
							$id = $oNextIPRange->GetKey();
							$oItem = new URLButtonItem('next_iprange', $slabel, utils::GetAbsoluteUrlAppRoot().'pages/UI.php?operation=details&class='.$sClass.'&id='.$id, '_top');
							$oItem->SetIconClass('fas fa-caret-right');
							$oItem->SetTooltip($slabel);
							$aResult[] = $oItem;
						}
					}

					// Additional actions for IPRange
					$oAppContext = new ApplicationContext();
					$id = $oObj->GetKey();
					$sContext = $oAppContext->GetForLink();

					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['id'] = $id;
					$operation = utils::ReadParam('operation', '');
					switch ($operation) {
						case 'listips':
							$aResult[] = new SeparatorPopupMenuItem();
							$sMenu = 'UI:IPManagement:Action:Details:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");

							$aParams['operation'] = 'csvexportips';
							$sMenu = 'UI:IPManagement:Action:CsvExportIps:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;

						case 'csvexportips':
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'listips';
							$sMenu = 'UI:IPManagement:Action:ListIps:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

							$sMenu = 'UI:IPManagement:Action:Details:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
							break;

						case 'docsvexportips':
						case 'dolistips':
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'listips';
							$sMenu = 'UI:IPManagement:Action:ListIps:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

							$sMenu = 'UI:IPManagement:Action:Details:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");

							$aParams['operation'] = 'csvexportips';
							$sMenu = 'UI:IPManagement:Action:CsvExportIps:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;

						default:
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'listips';
							$sMenu = 'UI:IPManagement:Action:ListIps:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

							$aParams['operation'] = 'csvexportips';
							$sMenu = 'UI:IPManagement:Action:CsvExportIps:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;
					}
				} elseif ($oObj instanceof IPAddress) {
					$sClass = get_class($oObj);

					// Display pointers to previous and next IPs according to configuration parameters
					$aDefaultSettings = array(
						static::IP_NAV_FUNCTION_SETTING_ENABLED => static::DEFAULT_IP_NAV_FUNCTION_SETTING_ENABLED,
						static::IP_NAV_FUNCTION_SETTING_WITHIN_SUBNET_ONLY => static::DEFAULT_IP_NAV_FUNCTION_SETTING_WITHIN_SUBNET_ONLY,
					);
					$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::IP_NAV_FUNCTION_CODE, $aDefaultSettings);
					$bEnabled = (bool) $aFunctionSettings[static::IP_NAV_FUNCTION_SETTING_ENABLED];
					if ($bEnabled) {
						$bWithinSubnetOnly = (bool) $aFunctionSettings[static::IP_NAV_FUNCTION_SETTING_WITHIN_SUBNET_ONLY];
						$oPreviousIPAddress = $oObj->GetPreviousIp($bWithinSubnetOnly);
						if (!is_null($oPreviousIPAddress)) {
							$slabel = Dict::S('UI:IPManagement:Action:DisplayPrevious:IPAddress');
							$id = $oPreviousIPAddress->GetKey();
							$oItem = new URLButtonItem('previous_ipaddress', $slabel, utils::GetAbsoluteUrlAppRoot().'pages/UI.php?operation=details&class='.$sClass.'&id='.$id, '_top');
							$oItem->SetIconClass('fas fa-caret-left');
							$oItem->SetTooltip($slabel);
							$aResult[] = $oItem;
						}
						$oNextIPAddress = $oObj->GetNextIp($bWithinSubnetOnly);
						if (!is_null($oNextIPAddress)) {
							$slabel = Dict::S('UI:IPManagement:Action:DisplayNext:IPAddress');
							$id = $oNextIPAddress->GetKey();
							$oItem = new URLButtonItem('next_ipaddress', $slabel, utils::GetAbsoluteUrlAppRoot().'pages/UI.php?operation=details&class='.$sClass.'&id='.$id, '_top');
							$oItem->SetIconClass('fas fa-caret-right');
							$oItem->SetTooltip($slabel);
							$aResult[] = $oItem;
						}
					}

					// Additional actions for IPAddress
					if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
						$oAppContext = new ApplicationContext();
						$id = $oObj->GetKey();
						$sStatus = $oObj->Get('status');

						$aParams = $oAppContext->GetAsHash();
						$aParams['class'] = $sClass;
						$aParams['id'] = $id;
						switch ($sStatus) {
							case 'allocated':
								$aResult[] = new SeparatorPopupMenuItem();
								$aParams['operation'] = 'unallocateip';
								$sMenu = 'UI:IPManagement:Action:UnAllocateIP:IPAddress';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								break;

							case 'released':
							case 'reserved':
							case 'unassigned':
								$aResult[] = new SeparatorPopupMenuItem();
								$aParams['operation'] = 'allocateip';
								$sMenu = 'UI:IPManagement:Action:AllocateIP:IPAddress';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								break;

							default:
								break;
						}
					}
				} elseif ($oObj instanceof Domain) {
					// Additional actions for Domain
					$sClass = get_class($oObj);
					if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
						$oAppContext = new ApplicationContext();
						$id = $oObj->GetKey();

						$aParams = $oAppContext->GetAsHash();
						$aParams['class'] = $sClass;
						$aParams['id'] = $id;
						$aResult[] = new SeparatorPopupMenuItem();

						if ($oObj->IsDelegated()) {
							$aParams['operation'] = 'undelegate';
							$sMenu = 'UI:IPManagement:Action:Undelegate:Domain';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
						} else {
							$aParams['operation'] = 'delegate';
							$sMenu = 'UI:IPManagement:Action:Delegate:Domain';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
						}
					}
				}
				break;

			case iPopupMenuExtension::MENU_DASHBOARD_ACTIONS: // $param is a Dashboard
				break;

			default:
				// Unknown type of menu, do nothing
				break;
		}

		return $aResult;
	}
}
