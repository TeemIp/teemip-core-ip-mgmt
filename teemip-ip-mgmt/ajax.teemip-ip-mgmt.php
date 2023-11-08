<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

if (!defined('__DIR__')) {
	define('__DIR__', dirname(__FILE__));
}
if (!defined('APPROOT')) {
	if (file_exists(__DIR__.'/../../approot.inc.php')) {
		require_once(__DIR__.'/../../approot.inc.php');   // When in env-xxxx folder
	} else {
		require_once(__DIR__.'/../../../approot.inc.php');   // When in datamodels/x.x folder
	}
}
require_once(APPROOT.'/application/application.inc.php');

/************************************************
 *
 * Ajax interface for IP Mgmt module starts here
 *
 ************************************************/
try {
	require_once(APPROOT.'/application/startup.inc.php');
	require_once(APPROOT.'/application/user.preferences.class.inc.php');

	require_once(APPROOT.'/application/loginwebpage.class.inc.php');
	LoginWebPage::DoLogin(); // Check user rights and prompt if needed

	$sVersion = '3x';
	$oP = new AjaxPage("");
	ContextTag::AddContext(ContextTag::TAG_CONSOLE);

	$operation = utils::ReadParam('operation', '');
	$iVId = utils::ReadParam('vid', '');
	$sClass = utils::ReadParam('class', '');

	switch ($operation) {
		case 'get_ip_creation_form':
			$aDefault = utils::ReadParam('default', array(), false, 'raw_data');
			$oObj = MetaModel::NewObject($sClass);
			foreach ($aDefault as $sAttCode => $value) {
				if (MetaModel::isValidAttCode($sClass, $sAttCode)) {
					$oObj->Set($sAttCode, $value);
				}
			}
			if ($sVersion == '2x') {
				$oP->add('<div class="wizContainer" style="vertical-align:top;"><div id="dcr_'.$iVId.'">');
				$oP->add("<h1>".MetaModel::GetClassIcon($sClass)."&nbsp;".Dict::Format('UI:CreationTitle_Class', MetaModel::GetName($sClass))."</h1>\n");
			} else {
				$oP->SetContentType('text/html');
				$oP->add('<div id="wizContainer"  style="vertical-align:top;"><div id="dcr_'.$iVId.'">');
			}
			cmdbAbstractObject::DisplayCreationForm($oP, $sClass, $oObj, array(), array('noRelations' => true));
			$oP->add('</div></div>');
			$oP->add_ready_script("$('#dcr_{$iVId} form').removeAttr('onsubmit');");
			$oP->add_ready_script("$('#dcr_{$iVId} form').bind('submit', oIpWidget_{$iVId}.DoCreateIpObject);");
			$oP->add_ready_script("$('#dcr_{$iVId} form').bind('cancel', oIpWidget_{$iVId}.CloseCreateIpObject);");
			break;

		case 'do_create_ip_object':
			$oObj = MetaModel::NewObject($sClass);
			$aErrors = $oObj->UpdateObjectFromPostedForm('');
			if (count($aErrors) == 0) {
				if (($sClass == 'IPv4Block') || ($sClass == 'IPv6Block')) {
					// Work around to allow delegation or RIR blocks from IpWidget
					// This is necessary because parent_org_id is R/W attribute when origin == lir, what UpdateObjectFromPostedForm cannot see
					$sOrigin = utils::ReadPostedParam("attr_origin", null, 'raw_data');
					if ($sOrigin == 'lir') {
						$sParentOrgId = utils::ReadPostedParam("attr_parent_org_id", 0, 'raw_data');
						if ($sParentOrgId != 0) {
							$oObj->Set('parent_org_id', $sParentOrgId);
							$oObj->Set('parent_id', utils::ReadPostedParam("attr_parent_id", 0, 'raw_data'));
						}
					}
				}
				list($bRes, $aIssues) = $oObj->CheckToWrite();
				if ($bRes) {
					$oObj->DBInsert();
					switch ($sClass) {
						case 'IPv4Block':
							/** @var \IPv4Block $oObj */
							$sIcon = $oObj->GetMultiSizeIcon(true, true);
							$sResult = "&nbsp;".$sIcon."&nbsp;".$oObj->GetHyperlink()."&nbsp;[".$oObj->Get('firstip')." - ".$oObj->Get('lastip')."]";
							break;

						case 'IPv4Subnet':
							/** @var \IPv4Subnet $oObj */
							$sIcon = $oObj->GetMultiSizeIcon(true, true);
							$sResult = "&nbsp;".$sIcon."&nbsp;".$oObj->GetHyperlink()."&nbsp;".Dict::S('Class:IPv4Subnet/Attribute:mask/Value_cidr:'.$oObj->Get('mask'));
							// Update IP Change if appropriate
							$iChangeId = utils::ReadParam('changeid', '');
							if ($iChangeId != 0) {
								$oIpChange = MetaModel::GetObject('IPv4SubnetChangeCreate', $iChangeId, false /* MustBeFound */);
								if (!is_null($oIpChange)) {
									$oIpChange->Set('subnet_id', $oObj->GetKey());
									$oIpChange->DBUpdate();
									// Link location if any
									$aDefault = utils::ReadParam('default', array(), false, 'raw_data');
									$iLocationId = $aDefault['location_id'];
									$oLocation = MetaModel::GetObject('Location', $iLocationId, false /* MustBeFound */);
									if (!is_null($oLocation)) {
										$oNewLocationLink = MetaModel::NewObject('lnkIPSubnetToLocation');
										$oNewLocationLink->Set('subnet_id', $oObj->GetKey());
										$oNewLocationLink->Set('location_id', $iLocationId);
										$oNewLocationLink->DBInsert();
									}
								}
							}
							break;

						case 'IPv4Range':
							/** @var \IPv4Range $oObj */
							$sIcon = $oObj->GetMultiSizeIcon(true, true);
							$sResult = "&nbsp;".$sIcon."&nbsp;".$oObj->GetHyperlink()."&nbsp;&nbsp;&nbsp;[".$oObj->Get('firstip')." - ".$oObj->Get('lastip')."]";
							break;

						case 'IPv4Address':
							/** @var \IPv4Address $oObj */
							$sResult = "&nbsp;".$oObj->GetHyperlink()."&nbsp;&nbsp; - ".$oObj->GetAsHtml('status')."&nbsp;&nbsp; - ".$oObj->Get('short_name').".".$oObj->Get('domain_name');
							// Update IP Change if appropriate
							$iChangeId = utils::ReadParam('iChangeId', '');
							if ($iChangeId != null) {
								$oIpChange = MetaModel::GetObject('IPv4AddressChangeCreate', $iChangeId, false /* MustBeFound */);
								if (!is_null($oIpChange)) {
									$oIpChange->Set('ip_id', $oObj->GetKey());
									$oIpChange->DBUpdate();
								}
							}
							break;

						case 'IPv6Block':
							/** @var \IPv6Block $oObj */
							$sIcon = $oObj->GetMultiSizeIcon(true, true);
							$sResult = "&nbsp;".$sIcon."&nbsp;".$oObj->GetHyperlink()."&nbsp;[".$oObj->Get('firstip')->GetAsCompressed()." - ".$oObj->Get('lastip')->GetAsCompressed()."]";
							break;

						case 'IPv6Subnet':
							/** @var \IPv6Subnet $oObj */
							$sIcon = $oObj->GetMultiSizeIcon(true, true);
							$sResult = "&nbsp;".$sIcon."&nbsp;".$oObj->GetHyperlink()."&nbsp;".Dict::S('Class:IPv6Subnet/Attribute:mask/Value_cidr:'.$oObj->Get('mask'));
							// Update IP Change if appropriate
							$iChangeId = utils::ReadParam('changeid', '');
							if ($iChangeId != 0) {
								$oIpChange = MetaModel::GetObject('IPv6SubnetChangeCreate', $iChangeId, false /* MustBeFound */);
								if (!is_null($oIpChange)) {
									$oIpChange->Set('subnet_id', $oObj->GetKey());
									$oIpChange->DBUpdate();
									// Link location if any
									$aDefault = utils::ReadParam('default', array(), false, 'raw_data');
									$iLocationId = $aDefault['location_id'];
									$oLocation = MetaModel::GetObject('Location', $iLocationId, false /* MustBeFound */);
									if (!is_null($oLocation)) {
										$oNewLocationLink = MetaModel::NewObject('lnkIPSubnetToLocation');
										$oNewLocationLink->Set('subnet_id', $oObj->GetKey());
										$oNewLocationLink->Set('location_id', $iLocationId);
										$oNewLocationLink->DBInsert();
									}
								}
							}
							break;

						case 'IPv6Range':
							/** @var \IPv6Range $oObj */
							$sIcon = $oObj->GetMultiSizeIcon(true, true);
							$sResult = "&nbsp;".$sIcon."&nbsp;".$oObj->GetHyperlink()."&nbsp;&nbsp;&nbsp;[".$oObj->Get('firstip')->GetAsCompressed()." - ".$oObj->Get('lastip')->GetAsCompressed()."]";
							break;

						case 'IPv6Address':
							/** @var \IPv6Address $oObj */
							$sResult = "&nbsp;".$oObj->GetHyperlink()."&nbsp;&nbsp; - ".$oObj->GetAsHtml('status')."&nbsp;&nbsp; - ".$oObj->Get('short_name').".".$oObj->Get('domain_name');
							// Update IP Change if appropriate
							$iChangeId = utils::ReadParam('iChangeId', '');
							if ($iChangeId != null) {
								$oIpChange = MetaModel::GetObject('IPv6AddressChangeCreate', $iChangeId, false /* MustBeFound */);
								if (!is_null($oIpChange)) {
									$oIpChange->Set('ip_id', $oObj->GetKey());
									$oIpChange->DBUpdate();
								}
							}
							break;

						default:
							$sResult = "";
							break;
					}
				} else {
					$sResult = "&nbsp;".Dict::Format('UI:ObjectCouldNotBeWritten', implode(', ', $aIssues));
				}
			} else {
				$sResult = implode(' ', $aErrors);
			}
			$oP->add($sResult);
			break;

		case 'get_cis_to_allocate':
			$aDefault = utils::ReadParam('default', array(), false, 'raw_data');
			$iOrgId = $aDefault['org_id'];
			$sCiClass = $aDefault['ciclass'];

			$oCISet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT FunctionalCI AS ci WHERE ci.org_id = :org_id AND ci.finalclass = :ciclass"),
				array(), array('org_id' => $iOrgId, 'ciclass' => $sCiClass));
			$sFilter = addslashes($oCISet->GetFilter()->ToOQL());
			$oCISet->SetShowObsoleteData(utils::ShowObsoleteData());

			$sResult = "<select title=\"\" name=\"attr_ci_id\" id=\"$iVId\" >";
			$oCISet->Rewind();
			while ($oObj = $oCISet->Fetch()) {
				$key = $oObj->GetKey();
				$display_value = $oObj->GetName();

				$sResult .= "<option value=\"$key\">$display_value</option>";
			}
			$sResult .= "</select>";
			$oP->add($sResult);
			break;

		case 'get_attribute_to_allocate':
			$aDefault = utils::ReadParam('default', array(), false, 'raw_data');
			$aCIClassesWithIp = json_decode($aDefault['ciclasseswithip'], true);
			$sCiClass = $aDefault['ciclass'];

			$sResult = "<select name=\"attr_ipattribute\" id=\"$iVId\" >";
			foreach ($aCIClassesWithIp[$sCiClass]['IPAddress'] as $sKey => $sAttribute) {
				$oAttDef = MetaModel::GetAttributeDef($sCiClass, $sAttribute);
				$sAttributeName = $oAttDef->GetLabel();
				$sResult .= "<option value=\"$sAttribute\">$sAttributeName</option>\n";
			}
			foreach ($aCIClassesWithIp[$sCiClass][$sClass] as $sKey => $sAttribute) {
				$oAttDef = MetaModel::GetAttributeDef($sCiClass, $sAttribute);
				$sAttributeName = $oAttDef->GetLabel();
				$sResult .= "<option value=\"$sAttribute\">$sAttributeName</option>\n";
			}
			$sResult .= "</select>";
			$oP->add($sResult);
			break;

		case 'on_form_cancel':
		case 'cancel':
		default:
			break;
	}

	$oP->output();
} catch (Exception $e) {
	echo htmlentities($e->GetMessage(), ENT_QUOTES, 'utf-8');
	IssueLog::Error($e->getMessage()."\nDebug trace:\n".$e->getTraceAsString());
}
