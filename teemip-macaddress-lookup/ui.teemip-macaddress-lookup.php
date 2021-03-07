<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

define('MACADDRESS_LOOKUP_MODULE_CODE', 'teemip-macaddress-lookup');
define('MACADDRESS_LOOKUP_FUNCTION_SETTING_BASE_URL', 'url');
define('DEFAULT_MACADDRESS_LOOKUP_FUNCTION_SETTING_BASE_URL', 'https://api.maclookup.app/v2/macs/%1$s');

/**
 * @param \WebPage $oP
 * @param $oAppContext
 *
 * @throws \ArchivedObjectException
 * @throws \CoreException
 * @throws \DictExceptionMissingString
 */
function DisplayMacSelectionForm(WebPage $oP, $oAppContext)
{
	$sClassIcon = MetaModel::GetClassIcon('IPv4Address');
	$sHeaderTitle = Dict::S('UI:MACLookup:Action:Lookup:Title');
	$oP->set_title($sHeaderTitle);
	$oP->add(<<<HTML
		<!-- Display title -->
		<div class="page_header teemip_page_header">
			<h1>$sClassIcon $sHeaderTitle</h1>
		</div>
		<!-- Beginning of wizContainer -->
		<div class="wizContainer">
HTML
	);

	$sFormAction= utils::GetAbsoluteUrlModulesRoot()."/teemip-macaddress-lookup/ui.teemip-macaddress-lookup.php";
	$oP->add("<form action=\"$sFormAction\" id=\"form_for_macaddress_lookup\" enctype=\"multipart/form-data\" method=\"post\" onSubmit=\"return OnSubmit('form_for_macaddress_lookup');\">\n");
	$oP->add($oAppContext->GetForForm());
	$oP->add("<input type=\"hidden\" name=\"operation\" value=\"domaclookup\">\n");

	$oP->add("<table>");
	$oP->add('<tr><td style="vertical-align:top">');

	// MAC Address
	$iFormid = rand();
	$sAttCode = 'macaddress';
	$sInputId = $iFormid.'_'.$sAttCode;
	$oAttDef = MetaModel::GetAttributeDef('IPInterface', 'macaddress');
	$sDefault = '';
	$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, 'IPInterface', $sAttCode, $oAttDef, $sDefault, '', $sInputId, '', 0, '');
	$aDetails[] = array('label' => '<span title="">'.Dict::S('UI:MACLookup:Action:Lookup:SelectMACAddress').'</span>', 'value' => $sHTMLValue);

	// MAC Prefix
	$sAttCode = 'macprefix';
	$sInputId = $iFormid.'_'.$sAttCode;
	$sValidationSpan = "<span class=\"form_validation\" id=\"v_{$sInputId}\"></span>";
	$sPattern = addslashes('^(\d|([a-f]|[A-F])){6}$'); //'^([0-9]+)$';
	$sHTMLValue = "<div class=\"field_input_zone field_input_string\"><input title=\"\" type=\"text\" maxlength=\"17\" name=\"attr_macprefix\" value=\"".htmlentities('',ENT_QUOTES, 'UTF-8')."\" id=\"$sInputId\"/></div>{$sValidationSpan}";
	$sHTMLValue = "<div id=\"field_{$sInputId}\" class=\"field_value_container\"><div class=\"attribute-edit\" data-attcode=\"macprefix\">{$sHTMLValue}</div></div>";
	$aDetails[] = array('label' => '<span title="">'.Dict::S('UI:MACLookup:Action:Lookup:SelectMACPrefix').'</span>', 'value' => $sHTMLValue);

	$aEventsList[] = 'keyup';
	$aEventsList[] = 'change';
	$oP->add_ready_script("$('#$sInputId').bind('".implode(' ',$aEventsList)."', function(evt, sFormId) { return ValidateField('$sInputId', '$sPattern', false, sFormId, '', '') } );\n"); // Bind to a custom event: validate

	$oP->Details($aDetails);
	$oP->add('</td></tr>');

	// Apply button
	$oP->add("<tr><td><button type=\"submit\" class=\"action\"><span>".Dict::S('UI:Button:Apply')."</span></button></td></tr>");

	$oP->add("</table>");
	$oP->add('</form>');

	$oP->add(<<<HTML
		</div><!-- End of wizContainer -->
HTML
	);
}


/**
 * @param \WebPage $oP
 * @param $sMacAddress - MAC address to lookup
 * @param $sAttribute - Label of the attribute carrying the MAC address
 */
function DisplayMacLookupResult(WebPage $oP, $sMacAddress, $sAttribute)
{
	// Query info to "MAC Address Lookup" site
	$sBaseUrl = MetaModel::GetModuleSetting(MACADDRESS_LOOKUP_MODULE_CODE, MACADDRESS_LOOKUP_FUNCTION_SETTING_BASE_URL, DEFAULT_MACADDRESS_LOOKUP_FUNCTION_SETTING_BASE_URL);
	$sURL = sprintf($sBaseUrl, urlencode($sMacAddress));
	$aEmpty = array();
	$aCurlOptions = array(CURLOPT_POSTFIELDS => "");
	$aResults = null;
	try
	{
		$sResponse = utils::DoPostRequest($sURL, $aEmpty, null, $aEmpty,$aCurlOptions);
		$aResults = json_decode($sResponse, true);
	}
	catch (Exception $e)
	{
		$sResponse = $e->getMessage();
	}
	if ($aResults)
	{
		$oP->add('<table style="vertical-align:top;"><tr><td>');

		if ($aResults['success'])
		{
			if ($aResults['found'])
			{
				// Attribute, if any
				if ($sAttribute != '')
				{
					$oP->add('&nbsp;&nbsp;</td><td><b>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:Attribute').':&nbsp;'.$sAttribute.'</b></td></tr>');
					$oP->add('<tr><td height=10></td></tr>');
					$oP->add('<tr><td>');
				}

				// MAC Address
				if (strlen($sMacAddress) > 6)
				{
					$oP->add('&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:MACAddress').':</td><td><b>'.$sMacAddress.'</b></td></tr>');
					$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:MACPrefix').':</td><td>'.$aResults['macPrefix'].'</td></tr>');
				}
				else
				{
					$oP->add('&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:MACPrefix').':</td><td><b>'.$aResults['macPrefix'].'</b></td></tr>');
				}
				$oP->add('<tr><td height=10></td></tr>');

				// Block
				$oP->add('<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:BlockStart').':</td><td>'.$aResults['blockStart'].'</td></tr>');
				$oP->add('<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:BlockEnd').':</td><td>'.$aResults['blockEnd'].'</td></tr>');
				$oP->add('<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:BlockSize').':</td><td>'.$aResults['blockSize'].'</td></tr>');
				$oP->add('<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:BlockType').':</td><td>'.$aResults['blockType'].'</td></tr>');
				$oP->add('<tr><td height=10></td></tr>');

				// Address
				$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:Company').':</td><td>'.$aResults['company'].'</td></tr>');
				$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:Address').':</td><td>'.$aResults['address'].'</td></tr>');
				$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:Country').':</td><td>'.$aResults['country'].'</td></tr>');
				$oP->add('<tr><td height=10></td></tr>');

				// Other
				$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:Updated').':</td><td>'.$aResults['updated'].'</td></tr>');
				if ($aResults['isRand'])
				{
					$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:IsRand').':</td></tr>');
				}
				if ($aResults['isPrivate'])
				{
					$oP->add('<tr><td>&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:IsPrivate').':</td></tr>');
				}
			}
			else
			{
				// No MAC found
				$oP->add('&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:NoMACAddressFound').'</td><td><b>'.$sMacAddress.'</b></td></tr>');
			}
		}
		else
		{
			// No MAC found
			$oP->add('&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:ErrorLookup').':</td></tr>');
			$oP->add('<tr><td height=10></td></tr>');
			$oP->add('<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:Error').':</td><td>'.$aResults['error'].'</td></tr>');
			$oP->add('<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:ErrorCode').':</td><td>'.$aResults['errorCode'].'</td></tr>');
			$oP->add('<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>'.Dict::Format('UI:MACLookup:Action:DoLookup:Result:MoreInfo').':</td><td>'.$aResults['moreInfo'].'</td></tr>');

		}

		$oP->add('<tr><td height=10></td></tr>');
		$oP->add('</div></td></tr></table>');
		$oP->add('<br><br>');
	}
	else
	{
		$sIssueDesc = Dict::Format('UI:MacLookup:Action:DoLookup:HasError').$sResponse;
		$sMessage = "<div class=\"header_message message_error teemip_message_error\">".$sIssueDesc."</div>";
		$oP->add($sMessage);
	}
}

/************************************************************************
 *
 * Main user interface pages for MAC Address lookup extension starts here
 *
 * **********************************************************************/
if (!defined('__DIR__')) define('__DIR__', dirname(__FILE__));
if (!defined('APPROOT')) require_once(__DIR__.'/../../approot.inc.php');
require_once(APPROOT.'/application/application.inc.php');
require_once(APPROOT.'/application/displayblock.class.inc.php');
require_once(APPROOT.'/application/itopwebpage.class.inc.php');
require_once(APPROOT.'/application/startup.inc.php');
require_once(APPROOT.'/application/wizardhelper.class.inc.php');
try
{
	require_once(APPROOT.'/application/loginwebpage.class.inc.php');
	$sLoginMessage = LoginWebPage::DoLogin(); // Check user rights and prompt if needed
	$oAppContext = new ApplicationContext();

	// Start construction of page

	$oP = new iTopWebPage('');
	$oP->set_base(utils::GetAbsoluteUrlAppRoot().'pages/');

	// All the following actions use advanced forms that require more javascript to be loaded
	$oP->add_linked_script("../js/json.js");
	$oP->add_linked_script("../js/forms-json-utils.js");
	$oP->add_linked_script("../js/wizardhelper.js");
	$oP->add_linked_script("../js/wizard.utils.js");

	$oP->add_linked_script("../js/linkswidget.js");
	$oP->add_linked_script("../js/extkeywidget.js");

	// Add teemip style sheeet
	$oP->add_linked_stylesheet(utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/teemip-ip-mgmt.css');

	$operation = utils::ReadParam('operation', '');
	switch($operation)
	{
		///////////////////////////////////////////////////////////////////////////////////////////

		case 'maclookup':	// Display entry form
			DisplayMacSelectionForm($oP, $oAppContext);
			break; // End case maclookup

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'domaclookup':	// Get MAC Address identifiers
			$oObj = MetaModel::NewObject('IPv4Address');
			$id = $oObj->GetKey();

			// Check calculator inputs
			$sMacAddress = utils::ReadPostedParam('attr_macaddress', '', 'raw_data');
			$sMacPrefix = utils::ReadPostedParam('attr_macprefix', '', 'raw_data');
			if (($sMacAddress == '') && ($sMacPrefix == ''))
			{
				// Found issues, explain and give the user another chance
				$sIssueDesc = Dict::Format('UI:MacLookup:Action:DoLookup:CannotRun:EmptyMAC');
				$sMessage = "<div class=\"header_message message_error teemip_message_error\">".$sIssueDesc."</div>";
				$oP->add($sMessage);
				// Try again
				DisplayMacSelectionForm($oP, $oAppContext);
			}
			else
			{
				// Set titles
				$sClassIcon = MetaModel::GetClassIcon('IPv4Address');
				$sPageTitle = Dict::S('UI:MACLookup:Action:Lookup:Title');
				$sHeaderTitle = Dict::S('UI:MACLookup:Action:DoLookup:Result');
				$oP->set_title($sHeaderTitle);
				$oP->add(<<<HTML
					<!-- Display title -->
					<div class="page_header teemip_page_header">
						<h1>$sClassIcon $sHeaderTitle</h1>
					</div>
					<!-- Beginning of wizContainer -->
HTML
				);

				// Run lookup and display result
				if ($sMacAddress != '')
				{
					DisplayMacLookupResult($oP,$sMacAddress,'');
				}
				if ($sMacPrefix != '')
				{
					DisplayMacLookupResult($oP,$sMacPrefix,'');
				}
			}
			break; // End case domaclookup

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'maclookupfromci':	// Display entry form
			$sClass = utils::ReadParam('class', '', false, 'class');
			$id = utils::ReadParam('id', '');

			// Check if right parameters have been given
			if ( empty($sClass) || empty($id))
			{
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (!MetaModel::IsSameFamilyBranch($sClass, 'IPInterface') && !MetaModel::IsSameFamilyBranch($sClass, 'PhysicalDevice'))
			{
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
			if (is_null($oObj))
			{
				$oP->P(Dict::S('UI:ObjectDoesNotExist'));
			}
			else
			{
				// Display action menu
				$oSingletonFilter = new DBObjectSearch($sClass);
				$oSingletonFilter->AddCondition('id', $oObj->GetKey(), '=');
				$oBlock = new MenuBlock($oSingletonFilter, 'details', false);
				$oBlock->Display($oP, -1);

				// Set titles
				$sClassIcon = MetaModel::GetClassIcon($sClass);
				$sClassLabel = MetaModel::GetName($sClass);
				$sPageTitle = Dict::S('UI:MACLookup:Action:Lookup:Title');
				$sHeaderTitle = $oObj->GetIcon()."&nbsp;".Dict::Format('UI:MACLookup:Action:CI:Lookup:Title', $sClassLabel, $oObj->GetName());
				$oP->set_title($sPageTitle);
				$oP->add(<<<HTML
					<!-- Display title -->
					<div class="page_header teemip_page_header">
						<h1>$sHeaderTitle</h1>
					</div>
					<!-- Beginning of wizContainer -->
HTML
				);

				// Display lookup result(s)
				$bHasMacAddressAttribute = false;
				foreach(MetaModel::ListAttributeDefs($sClass) as $sAttCode => $oAttDef)
				{
					if ($oAttDef instanceof AttributeMacAddress)
					{
						$bHasMacAddressAttribute = true;
						$sMacAddress = $oObj->Get($sAttCode);
						if ($sMacAddress != '')
						{
							DisplayMacLookupResult($oP,$sMacAddress, MetaModel::GetLabel($sClass, $sAttCode));
						}
					}
				}
				if (!$bHasMacAddressAttribute)
				{
					$oP->P(Dict::S('UI:MACLookup:Action:LookupFromCI:NoMAC'));
				}
			}

			break; // End case maclookup

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'cancel':	// An action was cancelled
		case 'displaylist':
		default: // Menu node rendering (templates)
			ApplicationMenu::LoadAdditionalMenus();
			$oMenuNode = ApplicationMenu::GetMenuNode(ApplicationMenu::GetMenuIndexById(ApplicationMenu::GetActiveNodeId()));
			if (is_object($oMenuNode))
			{
				$oMenuNode->RenderContent($oP, $oAppContext->GetAsHash());
				$oP->set_title($oMenuNode->GetLabel());
			}
			break;

	}
	$oP->output(); // Display the whole content now !
}

catch(CoreException $e)
{
	require_once(APPROOT.'/setup/setuppage.class.inc.php');
	$oP = new SetupPage(Dict::S('UI:PageTitle:FatalError'));
	if ($e instanceof SecurityException)
	{
		$oP->add("<h1>".Dict::S('UI:SystemIntrusion')."</h1>\n");
	}
	else
	{
		$oP->add("<h1>".Dict::S('UI:FatalErrorMessage')."</h1>\n");
	}
	$oP->error(Dict::Format('UI:Error_Details', $e->getHtmlDesc()));
	$oP->output();

	if (MetaModel::IsLogEnabledIssue())
	{
		if (MetaModel::IsValidClass('EventIssue'))
		{
			try
			{
				$oLog = new EventIssue();

				$oLog->Set('message', $e->getMessage());
				$oLog->Set('userinfo', '');
				$oLog->Set('issue', $e->GetIssue());
				$oLog->Set('impact', 'Page could not be displayed');
				$oLog->Set('callstack', $e->getTrace());
				$oLog->Set('data', $e->getContextData());
				$oLog->DBInsertNoReload();
			}
			catch(Exception $e)
			{
				IssueLog::Error("Failed to log issue into the DB");
			}
		}

		IssueLog::Error($e->getMessage());
	}

	// For debugging only
	//throw $e;
}

catch(Exception $e)
{
	require_once(APPROOT.'/setup/setuppage.class.inc.php');
	$oP = new SetupPage(Dict::S('UI:PageTitle:FatalError'));
	$oP->add("<h1>".Dict::S('UI:FatalErrorMessage')."</h1>\n");
	$oP->error(Dict::Format('UI:Error_Details', $e->getMessage()));
	$oP->output();

	if (MetaModel::IsLogEnabledIssue())
	{
		if (MetaModel::IsValidClass('EventIssue'))
		{
			try
			{
				$oLog = new EventIssue();

				$oLog->Set('message', $e->getMessage());
				$oLog->Set('userinfo', '');
				$oLog->Set('issue', 'PHP Exception');
				$oLog->Set('impact', 'Page could not be displayed');
				$oLog->Set('callstack', $e->getTrace());
				$oLog->Set('data', array());
				$oLog->DBInsertNoReload();
			}
			catch(Exception $e)
			{
				IssueLog::Error("Failed to log issue into the DB");
			}
		}

		IssueLog::Error($e->getMessage());
	}
}
