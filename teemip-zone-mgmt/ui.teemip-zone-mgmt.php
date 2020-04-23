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

/**
  * Set page titles.
  *
  * @throws \CoreException
  */
function SetPageTitles(WebPage $oP, $sUIPath, $oObj, $sClassLabel, $bIcon = true)
{
	/** @var \Zone $oObj */
	$oP->set_title(Dict::Format($sUIPath.'PageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
	$oP->add("<div class=\"page_header teemip_page_header\">\n");
	if ($bIcon)
	{
		$oP->add("<h1>".$oObj->GetIcon()."&nbsp;".Dict::Format($sUIPath.'Title_Class_Object', $sClassLabel, $oObj->GetName())."</h1>\n");
	}
	else
	{
		$oP->add("<h1>".Dict::Format($sUIPath.'Title_Class_Object', $sClassLabel, $oObj->GetName())."</h1>\n");
	}
	$oP->add("</div>\n");
}

/*****************************************************************
 * 
 * Main user interface pages for Zone Management module starts here
 *
 * ***************************************************************/
try
{
	if (!defined('__DIR__')) define('__DIR__', dirname(__FILE__));
	if (!defined('APPROOT')) require_once(__DIR__.'/../../approot.inc.php');
	require_once(APPROOT.'/application/application.inc.php');
	require_once(APPROOT.'/application/displayblock.class.inc.php');
	require_once(APPROOT.'/application/itopwebpage.class.inc.php');
	require_once(APPROOT.'/application/loginwebpage.class.inc.php');
	require_once(APPROOT.'/application/startup.inc.php');
	require_once(APPROOT.'/application/wizardhelper.class.inc.php');
	
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
	
	$operation = utils::ReadParam('operation', '');
	switch($operation)
	{
		///////////////////////////////////////////////////////////////////////////////////////////
		
		case 'datafiledisplay':	// Display zone in BIND format
			$sClass = utils::ReadParam('class', '');
			$id = utils::ReadParam('id', '');
			$sSortOrder = utils::ReadParam('sort_order', '');
			// Check if right parameters have been given
			if ( empty($sClass) || empty($id))
			{
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if ($sClass != 'Zone')
			{
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}
			
			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
			if (is_null($oObj))
			{
				$oP->set_title(Dict::S('UI:ErrorPageTitle'));
				$oP->P(Dict::S('UI:ObjectDoesNotExist'));
			}
			else
			{
				// The object can be read - Process request now
				$sClassLabel = MetaModel::GetName($sClass);

				// No search bar (2.5 standard)

				// Display action menu
				$oSingletonFilter = new DBObjectSearch($sClass);
				$oSingletonFilter->AddCondition('id', $oObj->GetKey(), '=');
				$oBlock = new MenuBlock($oSingletonFilter, 'details', false);
				$oBlock->Display($oP, -1);
					
				// Set titles
				SetPageTitles($oP, 'UI:ZoneManagement:Action:Zone:DataFileDisplay:', $oObj, $sClassLabel);

				if ($oObj->Get('mapping') == 'direct')
				{
					// Prepare context to switch display order and display button
					$sUrl = utils::GetAbsoluteUrlModulePage('teemip-zone-mgmt', 'ui.teemip-zone-mgmt.php', array());
					$oP->add("<form method=\"post\" action=\"".$sUrl."\">\n");
					$oP->add($oAppContext->GetForForm());
					$oP->add("<input type=\"hidden\" name=\"transaction_id\" value=\"".utils::GetNewTransactionId()."\">\n");
					$oP->add("<input type=\"hidden\" name=\"operation\" value=\"datafiledisplay\">\n");
					$oP->add("<input type=\"hidden\" name=\"class\" value=\"$sClass\">\n");
					$oP->add("<input type=\"hidden\" name=\"id\" value=\"$id\">\n");
					$sNewSortOrder = ($sSortOrder == 'sort_by_record') ? 'sort_by_char' : 'sort_by_record';
					$oP->add("<input type=\"hidden\" name=\"sort_order\" value=\"$sNewSortOrder\">\n");
					
					$sButtons = "<button type=\"submit\" class=\"action\"><span>".Dict::S('UI:ZoneManagement:Action:DataFileDisplay:'.$sNewSortOrder)."</span></button>";
					$oP->add('<br>'.$sButtons.'<br>');
					$oP->add("</form>\n");
				}
				
				// Display text area
				$oP->add("<div id=\"3\" class=\"display_block\">\n"); 
				$oP->add("<textarea>\n"); 
				$sHtml = $oObj->GetDataFile($sSortOrder);
				$oP->add($sHtml);
				$oP->add("</textarea>\n");
				$oP->add("</div>\n");
					
				// Adjust the size of the block
				$oP->add_ready_script(" $('#3>textarea').height($('#3').parent().height() - 220).width( $('#3').parent().width() - 30);");
			}
		break; // End case datafiledisplay
		
		///////////////////////////////////////////////////////////////////////////////////////////

		case 'updaterrs':	// Create or update Resource Records
			$sClass = utils::ReadParam('class', '');
			$id = utils::ReadParam('id', '');
			// Check if right parameters have been given
			if ( empty($sClass) || empty($id))
			{
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (($sClass != 'IPv4Address') && ($sClass != 'IPv6Address') && ($sClass != 'IPv4Subnet') && ($sClass != 'IPv6Subnet'))
			{
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
			if (is_null($oObj))
			{
				$oP->set_title(Dict::S('UI:ErrorPageTitle'));
				$oP->P(Dict::S('UI:ObjectDoesNotExist'));
			}
			else
			{
				$sParentClass = 'IP'.substr($sClass, 4);
				$sError = $oObj->DoCheckUpdateRRs();
				if ($sError != '')
				{
					// Report issue
					$sMessage = Dict::Format('UI:ZoneManagement:Action:'.$sParentClass.':UpdateRRs:HasNotRun', $sError);
					$sSeverity = 'error';

					$sCleanMessage = $oObj->CleanRRs();
					$sCleanSeverity = 'info';
				}
				else
				{
					$sError = $oObj->UpdateRRs();
					if ($sError != '')
					{
						// Report issue
						$sMessage = Dict::Format('UI:ZoneManagement:Action:'.$sParentClass.':UpdateRRs:HasErrors', $sError);
						$sSeverity = 'info';
					}
					else
					{
						$sMessage = Dict::Format('UI:ZoneManagement:Action:'.$sParentClass.':UpdateRRs:HasRun');
						$sSeverity = 'ok';
					}
					$sCleanMessage = '';
				}
				cmdbAbstractObject::SetSessionMessage($sClass, $id, 'updaterrs', $sMessage, $sSeverity, 0, true /* must not exist */);
				if ($sCleanMessage != '')
				{
					cmdbAbstractObject::SetSessionMessage($sClass, $id, 'cleanrrs', $sCleanMessage, $sCleanSeverity, 0,
						true /* must not exist */);
				}
				$oP->add_header('Location: '.utils::GetAbsoluteUrlAppRoot().'pages/UI.php?operation=details&class='.$sClass.'&id='.$id.'&'.$oAppContext->GetForLink());
				// Question: how to open the page directly to the right tab ?
			}
			break; // End case updaterrs

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'deleterrs':	// Create Resource Records
			$sClass = utils::ReadParam('class', '');
			$id = utils::ReadParam('id', '');
			// Check if right parameters have been given
			if ( empty($sClass) || empty($id))
			{
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (($sClass != 'IPv4Address') && ($sClass != 'IPv6Address') && ($sClass != 'IPv4Subnet') && ($sClass != 'IPv6Subnet'))
			{
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
			if (is_null($oObj))
			{
				$oP->set_title(Dict::S('UI:ErrorPageTitle'));
				$oP->P(Dict::S('UI:ObjectDoesNotExist'));
			}
			else
			{
				$sParentClass = 'IP'.substr($sClass, 4);
				$oObj->CleanRRs();
				$sMessage = Dict::Format('UI:ZoneManagement:Action:'.$sParentClass.':CleanRRs:HasRun');
				$sSeverity = 'ok';
				cmdbAbstractObject::SetSessionMessage($sClass, $id, 'updaterrs', $sMessage, $sSeverity, 0, true /* must not exist */);
				$oP->add_header('Location: '.utils::GetAbsoluteUrlAppRoot().'pages/UI.php?operation=details&class='.$sClass.'&id='.$id.'&'.$oAppContext->GetForLink());
			}
			break; // End case deleterrs

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
