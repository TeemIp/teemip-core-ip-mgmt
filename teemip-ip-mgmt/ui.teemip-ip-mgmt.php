<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

use Combodo\iTop\Application\UI\Base\Component\Button\ButtonUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Form\FormUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Html\HtmlFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\InputUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\Select\SelectOptionUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\SelectUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Panel\PanelUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Title\TitleUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Toolbar\ToolbarUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\Column\Column;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\MultiColumn;
use TeemIp\TeemIp\Extension\Framework\Helper\DisplayMessage;
use TeemIp\TeemIp\Extension\Framework\Helper\DisplayTree;
use TeemIp\TeemIp\Extension\Framework\Helper\IPUtils;
use TeemIp\TeemIp\Extension\IPManagement\Controller\FindSpace;
use const ITOP_DESIGN_LATEST_VERSION;

/*******************************************************************
 *
 * Main user interface pages for IP Management extension starts here
 *
 * *****************************************************************/
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
require_once(APPROOT.'/application/startup.inc.php');
require_once(APPROOT.'/application/wizardhelper.class.inc.php');

try {
	$operation = utils::ReadParam('operation', '');
	$bPrintable = (utils::ReadParam('printable', 0) == '1');

	require_once(APPROOT.'/application/loginwebpage.class.inc.php');
	$sLoginMessage = LoginWebPage::DoLogin(); // Check user rights and prompt if needed
	$oAppContext = new ApplicationContext();

	$oP = new iTopWebPage(Dict::S('UI:WelcomeToITop'), $bPrintable);
	$oP->SetMessage($sLoginMessage);

	$oP->set_base(utils::GetAbsoluteUrlAppRoot().'pages/');
	// All the following actions use advanced forms that require more javascript to be loaded
	if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.2', '<')) {
		// Deprecated lib in iTop 3.2.0
		$oP->add_linked_script(utils::GetAbsoluteUrlAppRoot().'js/json.js');
        $oP->add_linked_script(utils::GetAbsoluteUrlAppRoot().'js/forms-json-utils.js');
        $oP->add_linked_script(utils::GetAbsoluteUrlAppRoot().'js/wizardhelper.js');
        $oP->add_linked_script(utils::GetAbsoluteUrlAppRoot().'js/wizard.utils.js');
        $oP->add_linked_script(utils::GetAbsoluteUrlAppRoot().'js/links/links_widget.js');
        $oP->add_linked_script(utils::GetAbsoluteUrlAppRoot().'js/extkeywidget.js');

        $oP->add_linked_script(utils::GetAbsoluteUrlModulesRoot()."teemip-ip-mgmt/asset/js/teemip-ip-mgmt.js");
	} else {
        $oP->LinkScriptFromAppRoot('js/forms-json-utils.js');
        $oP->LinkScriptFromAppRoot('js/wizardhelper.js');
        $oP->LinkScriptFromAppRoot('js/wizard.utils.js');
        $oP->LinkScriptFromAppRoot('js/links/links_widget.js');
        $oP->LinkScriptFromAppRoot('js/extkeywidget.js');

        $oP->LinkScriptFromModule('teemip-ip-mgmt/asset/js/teemip-ip-mgmt.js');
    }

	// Add teemip style sheeet
    if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.2', '<')) {
        $oP->add_linked_stylesheet(utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/asset/css/teemip-ip-mgmt.css');
    } else {
        $oP->LinkStylesheetFromModule('teemip-ip-mgmt/asset/css/teemip-ip-mgmt.css');
    }

	switch ($operation) {
		///////////////////////////////////////////////////////////////////////////////////////////

		case 'displaytree':     // Display hierarchical tree for domains, blocks or subnets
			$sClass = utils::ReadParam('class', '', false, 'class');
			// Check if right parameters have been given
			if (empty($sClass)) {
				throw new ApplicationException(Dict::Format('UI:Error:1ParametersMissing', 'class'));
			}
			if (!in_array($sClass, array('Domain', 'IPv4Block', 'IPv6Block', 'IPv4Subnet', 'IPv6Subnet'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			DisplayTree::Display($oP, $oAppContext, $sClass);
			break; // End case displaytree

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'displaylist':     // Display standard list of domains, blocks or subnets
			$sClass = utils::ReadParam('class', '', false, 'class');
			$sFilter = utils::ReadParam('filter', '', false, 'raw_data');
			if (empty($sClass) || empty($sFilter)) {
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'filter'));
			}
			$oFilter = DBSearch::unserialize($sFilter); // TO DO : check that the filter is valid
			$oFilter->UpdateContextFromUser();
			$sTableId = 'display_list';

			$sHeaderTitle = Dict::Format('UI:IPManagement:Action:DisplayList:'.$sClass.':PageTitle_Class');
			$sTitle = Dict::Format('UI:IPManagement:Action:DisplayTree:'.$sClass.':Title_Class', MetaModel::GetName($sClass));
			$oP->set_title($sHeaderTitle);

			$oBlockSearch = new DisplayBlock($oFilter, 'search', false /* Asynchronous */, array('open' => true, 'table_id' => $sTableId, 'baseClass' => $sClass));
			$oBlock = new DisplayBlock($oFilter, 'list', false);

			$oUIBlockSearch = $oBlockSearch->GetDisplay($oP, 'search_1', array());

			$oTitle = TitleUIBlockFactory::MakeForPage($sTitle);
			$oUIBlockSearch->AddSubBlock($oTitle);

			$oUIBlock = $oBlock->GetDisplay($oP, $sTableId);
			$oUIBlock->AddCSSClasses(['display_block', 'sf_results_area']);
			$oUIBlock->AddDataAttribute('target', 'search_results');
			$oUIBlockSearch->AddSubBlock($oUIBlock);

			$oP->AddUiBlock($oUIBlockSearch);
			break; // End case displaylist

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'listspace':    // List occupied and unoccupied space within a block
			$sClass = utils::ReadParam('class', '', false, 'class');
			$id = utils::ReadParam('id', '');
			// Check if right parameters have been given
			if (empty($sClass) || empty($id)) {
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (!in_array($sClass, array('IPv4Block', 'IPv6Block'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
			if (is_null($oObj)) {
				$oP->set_title(Dict::S('UI:ErrorPageTitle'));
				$oP->P(Dict::S('UI:ObjectDoesNotExist'));
			} else {
				// Dump space
				$oObj->DisplayAllSpace($oP);
			}
			break; // End case listspace

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'findspace':    // Find space within a block or a subnet
			$sClass = utils::ReadParam('class', '', false, 'class');
			if (!empty($sClass)) {
				if (!in_array($sClass, array('IPv4Block', 'IPv6Block', 'IPv4Subnet', 'IPv6Subnet'))) {
					throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
				}

				$id = utils::ReadParam('id', '');
				// Id may be null. In that case a temporary object is created.
				if (empty($id)) {
					$oObj = MetaModel::NewObject($sClass);
				} else {
					// Check if the object exists
					$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
					if (is_null($oObj)) {
						$oObj = MetaModel::NewObject($sClass);
					}
				}

				// Display find space form
				$oObj->DisplayOperationForm($oP, $oAppContext, $operation);
			} else {
				$aPostedParam = FindSpace::GetPostedParam($operation);
				FindSpace::DisplayOperationForm($oP, $oAppContext, $aPostedParam);
			}
			break; // End case findspace

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'dofindspace':    // Apply find space action
			$sClass = utils::ReadParam('class', '', false, 'class');
			if (!empty($sClass)) {
				$id = utils::ReadParam('id', '');
				$sTransactionId = utils::ReadPostedParam('transaction_id', '');
				$iSpaceSize = utils::ReadPostedParam('spacesize', '', 'raw_data');
				// Check if right parameters have been given
				if (empty($id) || (empty($iSpaceSize) && !is_numeric($iSpaceSize))) {
					throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'id', 'spacesize'));
				}
				if (!in_array($sClass, array('IPv4Block', 'IPv6Block', 'IPv4Subnet', 'IPv6Subnet'))) {
					throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
				}

				// Check if the object exists
				/** @var \IPv4Block|\IPv6Block|IPv4Subnet|\IPv6Subnet $oObj */
				$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
				if (is_null($oObj)) {
					$oP->set_title(Dict::S('UI:ErrorPageTitle'));
					$oP->P(Dict::S('UI:ObjectDoesNotExist'));
				} else {
					// Make sure we don't follow the same path twice in a row.
					$sClassLabel = MetaModel::GetName($sClass);
					$sObjectName = $oObj->GetName();
					if (!utils::IsTransactionValid($sTransactionId, false)) {
						TeemIpUI::LogInvalidTransaction($oP, $operation, $sTransactionId, $id, $sObjectName, $sClass, $sClassLabel);
					} else {
						$aPostedParam = $oObj->GetPostedParam($operation);

						// Make sure find action can be launched
						$sErrorString = $oObj->DoCheckToDisplayAvailableSpace($aPostedParam);
						if ($sErrorString != '') {
							// Found issues, explain and give the user another chance
							$sMessage = Dict::Format('UI:IPManagement:Action:DoFindSpace:'.$sClass.':'.$sErrorString);
							DisplayMessage::Warning($oP, $sMessage);

							$sNextOperation = $oObj->GetNextOperation($operation);
							$oObj->DisplayOperationForm($oP, $oAppContext, $sNextOperation, $aPostedParam);
						} else {
							// Dump space
							$oObj->DoDisplayAvailableSpace($oP, 0, $aPostedParam);
						}
					}
				}
			} else {
				$aPostedParam = FindSpace::GetPostedParam($operation);
				if (empty($aPostedParam['spacetype']) || empty($aPostedParam['org_id']) || empty($aPostedParam['spacesize'])) {
					throw new ApplicationException(Dict::Format('UI:Error:3ParametersMissing', 'spacetype', 'org_id', 'spacesize'));
				} else {
					// Make sure find action can be launched
					list ($sIssueDesc, $aPostedParam['block_id']) = FindSpace::DoCheckToDisplayAvailableSpace($aPostedParam);
					if ($sIssueDesc != '') {
						// Found issues, explain and give the user another chance
						DisplayMessage::Warning($oP, $sIssueDesc);

						FindSpace::DisplayOperationForm($oP, $oAppContext, $aPostedParam);
					} else {
						FindSpace::DoDisplayAvailableSpace($oP, $aPostedParam);
					}
				}
			}
			break; // End case dofindspace

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'listips':    // List IPs of a subnet or an IP range
			$sClass = utils::ReadParam('class', '', false, 'class');
			$id = utils::ReadParam('id', '');
			// Check if right parameters have been given
			if (empty($sClass) || empty($id)) {
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (!in_array($sClass, array('IPv4Subnet', 'IPv6Subnet', 'IPv4Range', 'IPv6Range'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			/** @var \IPv4Subnet|\IPv6Subnet|\IPv4Range|\IPv6Range $oObj */
			$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
			if (is_null($oObj)) {
				$oP->set_title(Dict::S('UI:ErrorPageTitle'));
				$oP->P(Dict::S('UI:ObjectDoesNotExist'));
			} else {
				// The object can be read - Process request now
				$iSize = $oObj->GetSize();
				if ($iSize >= MAX_NB_OF_IPS_TO_DISPLAY) {
					// Display subset of IPs only as size is too big to display all IPs once
					$oObj->DisplayOperationForm($oP, $oAppContext, $operation);
				} else {
					$aParam = array(
						'first_ip' => '',
						'last_ip' => '',
						'status_ip' => $oObj->GetDefaultValueAttribute('status'),
						'short_name' => '',
						'domain_id' => '',
						'usage_id' => '',
						'requestor_id' => '',
					);

					// Dump IP Tree
					$oObj->DoListIps($oP, $aParam);
				}
			}
			break; // End case Listips

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'dolistips':    // Apply list ips action
			$sClass = utils::ReadParam('class', '', false, 'class');
			$id = utils::ReadParam('id', '');
			$sTransactionId = utils::ReadPostedParam('transaction_id', '');

			// Check if right parameters have been given
			if (empty($sClass) || empty($id)) {
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (!in_array($sClass, array('IPv4Subnet', 'IPv6Subnet', 'IPv4Range', 'IPv6Range'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, true /* MustBeFound */);

			// Make sure we don't follow the same path twice in a row.
			$sClassLabel = MetaModel::GetName($sClass);
			if (!utils::IsTransactionValid($sTransactionId, false)) {
				$oP->set_title(Dict::Format('UI:ModificationPageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
				$oP->p("<strong>".Dict::S('UI:Error:ObjectAlreadyUpdated')."</strong>\n");
			} else {
				$aPostedParam = $oObj->GetPostedParam($operation);

				// Make sure range can be listed
				$sErrorString = $oObj->DoCheckToListIps($aPostedParam);
				if ($sErrorString != '') {
					// Found issues, explain and give the user another chance
					$sMessage = Dict::Format('UI:IPManagement:Action:DoListIps:'.$sClass.':CannotBeListed', $sErrorString);
					DisplayMessage::Warning($oP, $sMessage);

					$sNextOperation = $oObj->GetNextOperation($operation);
					$oObj->DisplayOperationForm($oP, $oAppContext, $sNextOperation, $aPostedParam);
				} else {
					// Dump IP tree
					$oObj->DoListIps($oP, $aPostedParam);
				}
			}
			break; // End case dolistips

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'shrinkblock':     // Shrink a block
		case 'shrinksubnet':    // Shrink a subnet
		case 'splitblock':      // Split a block
		case 'splitsubnet':     // Split a subnet
		case 'expandblock':     // Expand a block
		case 'expandsubnet':    // Expand a subnet
			$sClass = utils::ReadParam('class', '', false, 'class');
			$id = utils::ReadParam('id', '');
			// Check if right parameters have been given
			if (empty($sClass) || empty($id)) {
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (!in_array($sClass, array('IPv4Block', 'IPv6Block', 'IPv4Subnet'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
			if (is_null($oObj)) {
				$oP->set_title(Dict::S('UI:ErrorPageTitle'));
				$oP->P(Dict::S('UI:ObjectDoesNotExist'));
			} else {
				// The object can be read - Check that user is allowed to modify it
				$oSet = CMDBObjectSet::FromObject($oObj);
				if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY, $oSet) == UR_ALLOWED_NO) {
					throw new SecurityException('User not allowed to modify this object', array('class' => $sClass, 'id' => $id));
				}

				// Process request now
				$oObj->DisplayOperationForm($oP, $oAppContext, $operation);
			}
			break; // End case shrink, split and expand

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'doshrinkblock':    // Apply shrink for a block
		case 'doshrinksubnet':    // Apply shrink for a subnet
			$sClass = utils::ReadPostedParam('class', '', 'class');
			$id = utils::ReadPostedParam('id', '');
			$sTransactionId = utils::ReadPostedParam('transaction_id', '');

			// Check if right parameters have been given
			if (empty($sClass) || empty($id)) {
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (!in_array($sClass, array('IPv4Block', 'IPv6Block', 'IPv4Subnet'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Object does exist. It has already been checked in action 'shrink' but check anyway.
			$oObj = MetaModel::GetObject($sClass, $id, true /* MustBeFound */);

			// Make sure we don't follow the same path twice in a row.
			$sClassLabel = MetaModel::GetName($sClass);
			if (!utils::IsTransactionValid($sTransactionId, false)) {
				$oP->set_title(Dict::Format('UI:ModificationPageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
				$oP->p("<strong>".Dict::S('UI:Error:ObjectAlreadyUpdated')."</strong>\n");
			} else {
				$aPostedParam = $oObj->GetPostedParam($operation);

				// Make sure object can be shrunk
				$sErrorString = $oObj->DoCheckToShrink($aPostedParam);
				if ($sErrorString != '') {
					// Found issues, explain and give the user another chance
					$sMessage = Dict::Format('UI:IPManagement:Action:Shrink:'.$sClass.':CannotBeShrunk', $sErrorString);
					DisplayMessage::Warning($oP, $sMessage);

					$sNextOperation = $oObj->GetNextOperation($operation);
					$oObj->DisplayOperationForm($oP, $oAppContext, $sNextOperation, $aPostedParam);
				} else {
					// Shrink object
					$oObj->DoShrink($aPostedParam);

					// Display result
					$oP->set_title(Dict::Format('UI:IPManagement:Action:Shrink:'.$sClass.':PageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
					$sMessage = ($sClass == 'IPv4Subnet')
						? Dict::Format('UI:IPManagement:Action:Shrink:'.$sClass.':Done', $sClassLabel, $oObj->GetName(), $aPostedParam['scale'])
						: Dict::Format('UI:IPManagement:Action:Shrink:'.$sClass.':Done', $sClassLabel, $oObj->GetName());
					DisplayMessage::Success($oP, $sMessage);
					IPUtils::DisplayDetails($oP, $oObj);

					// Close transaction
					utils::RemoveTransaction($sTransactionId);
				}
			}
			break; // End case doshrink

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'dosplitblock':    // Apply split for a block
		case 'dosplitsubnet':    // Apply split for a subnet
			$sClass = utils::ReadPostedParam('class', '', 'class');
			$id = utils::ReadPostedParam('id', '');
			$sTransactionId = utils::ReadPostedParam('transaction_id', '');

			// Check if right parameters have been given
			if (empty($sClass) || empty($id)) {
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (!in_array($sClass, array('IPv4Block', 'IPv6Block', 'IPv4Subnet'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Object does exist. It has already been checked in action 'split' but check anyway.
			$oObj = MetaModel::GetObject($sClass, $id, true /* MustBeFound */);

			// Make sure we don't follow the same path twice in a row.
			$sClassLabel = MetaModel::GetName($sClass);
			if (!utils::IsTransactionValid($sTransactionId, false)) {
				$oP->set_title(Dict::Format('UI:ModificationPageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
				$oP->p("<strong>".Dict::S('UI:Error:ObjectAlreadyUpdated')."</strong>\n");
			} else {
				$aPostedParam = $oObj->GetPostedParam($operation);

				// Make sure object can be split
				$sErrorString = $oObj->DoCheckToSplit($aPostedParam);
				if ($sErrorString != '') {
					// Found issues, explain and give the user another chance
					$sMessage = Dict::Format('UI:IPManagement:Action:Split:'.$sClass.':CannotBeSplit', $sErrorString);
					DisplayMessage::Warning($oP, $sMessage);

					$sNextOperation = $oObj->GetNextOperation($operation);
					$oObj->DisplayOperationForm($oP, $oAppContext, $sNextOperation, $aPostedParam);
				} else {
					// Split object
					$oSet = $oObj->DoSplit($aPostedParam);

					// Display result
					$oP->set_title(Dict::Format('UI:IPManagement:Action:Split:'.$sClass.':PageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
					$sMessage = ($sClass == 'IPv4Subnet')
						? Dict::Format('UI:IPManagement:Action:Split:'.$sClass.':Done', $sClassLabel, $oObj->GetName(), $aPostedParam['scale'])
						: Dict::Format('UI:IPManagement:Action:Split:'.$sClass.':Done', $sClassLabel, $oObj->GetName());
					DisplayMessage::Success($oP, $sMessage);
					$oBlock = new DisplayBlock($oSet->GetFilter(), 'list', false);
					$oBlock->Display($oP, 'split_result', array('display_limit' => false, 'menu' => false));

					// Close transaction
					utils::RemoveTransaction($sTransactionId);
				}
			}
			break; // End case dosplit

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'doexpandblock':    // Apply expand block command
		case 'doexpandsubnet':    // Apply expand a subnet
			$sClass = utils::ReadPostedParam('class', '', 'class');
			$id = utils::ReadPostedParam('id', '');
			$sTransactionId = utils::ReadPostedParam('transaction_id', '');

			// Check if right parameters have been given
			if (empty($sClass) || empty($id)) {
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (!in_array($sClass, array('IPv4Block', 'IPv6Block', 'IPv4Subnet'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Object does exist. It has already been checked in action 'expand' but check anyway.
			$oObj = MetaModel::GetObject($sClass, $id, true /* MustBeFound */);

			// Make sure we don't follow the same path twice in a row.
			$sClassLabel = MetaModel::GetName($sClass);
			if (!utils::IsTransactionValid($sTransactionId, false)) {
				$oP->set_title(Dict::Format('UI:ModificationPageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
				$oP->p("<strong>".Dict::S('UI:Error:ObjectAlreadyUpdated')."</strong>\n");
			} else {
				$aPostedParam = $oObj->GetPostedParam($operation);

				// Make sure object can be expanded
				$sErrorString = $oObj->DoCheckToExpand($aPostedParam);
				if ($sErrorString != '') {
					// Found issues, explain and give the user another chance
					$sMessage = Dict::Format('UI:IPManagement:Action:Expand:'.$sClass.':CannotBeExpanded', $sErrorString);
					DisplayMessage::Warning($oP, $sMessage);

					$sNextOperation = $oObj->GetNextOperation($operation);
					$oObj->DisplayOperationForm($oP, $oAppContext, $sNextOperation, $aPostedParam);
				} else {
					// Expand object
					$oObj->DoExpand($aPostedParam);

					// Display result
					$oP->set_title(Dict::Format('UI:IPManagement:Action:Expand:'.$sClass.':PageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
					$sMessage = ($sClass == 'IPv4Subnet')
						? Dict::Format('UI:IPManagement:Action:Expand:'.$sClass.':Done', $sClassLabel, $oObj->GetName(), $aPostedParam['scale'])
						: Dict::Format('UI:IPManagement:Action:Expand:'.$sClass.':Done', $sClassLabel, $oObj->GetName());
					DisplayMessage::Success($oP, $sMessage);
					IPUtils::DisplayDetails($oP, $oObj);

					// Close transaction
					utils::RemoveTransaction($sTransactionId);
				}
			}
			break; // End case doexpand

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'csvexportips':    // Export IPs of a subnet or a range in csv window
			$sClass = utils::ReadParam('class', '', false, 'class');
			$id = utils::ReadParam('id', '');
			// Check if right parameters have been given
			if (empty($sClass) || empty($id)) {
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (!in_array($sClass, array('IPv4Subnet', 'IPv6Subnet', 'IPv4Range', 'IPv6Range'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
			if (is_null($oObj)) {
				$oP->set_title(Dict::S('UI:ErrorPageTitle'));
				$oP->P(Dict::S('UI:ObjectDoesNotExist'));
			} else {
				// The object can be read - Process request now
				$iSize = $oObj->GetSize();
				if ($iSize >= MAX_NB_OF_IPS_TO_DISPLAY) {
					// Export subset of IPs only as size is too big to export all IPs once
					$oObj->DisplayOperationForm($oP, $oAppContext, $operation);
				} else {
					// Export all IPs once
					$oObj->DisplayIPsAsCSV($oP, array('first_ip' => '', 'last_ip' => ''));
				}
			}
			break; // End case csvexportips

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'docsvexportips':  // Apply csv export ips action
			$sClass = utils::ReadParam('class', '', false, 'class');
			$id = utils::ReadParam('id', '');

			// Check if right parameters have been given
			if (empty($sClass) || empty($id)) {
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (!in_array($sClass, array('IPv4Subnet', 'IPv6Subnet', 'IPv4Range', 'IPv6Range'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, true /* MustBeFound */);

			$sClassLabel = MetaModel::GetName($sClass);
			$aPostedParam = $oObj->GetPostedParam($operation);

			// Make sure range can be exported as csv
			$sErrorString = $oObj->DoCheckToCsvExportIps($aPostedParam);
			if ($sErrorString != '') {
				// Found issues, explain and give the user another chance
				$sMessage = Dict::Format('UI:IPManagement:Action:DoCsvExportIps:'.$sClass.':CannotBeListed', $sErrorString);
				DisplayMessage::Warning($oP, $sMessage);

				$sNextOperation = $oObj->GetNextOperation($operation);
				$oObj->DisplayOperationForm($oP, $oAppContext, $sNextOperation, $aPostedParam);
			} else {
				// Export all IPs once
				$oObj->DisplayIPsAsCSV($oP, $aPostedParam);
			}
			break; // End case docsvexportips

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'calculator':    // Provides IP related calculations
			$sClass = utils::ReadParam('class', '', false, 'class');
			if (!empty($sClass)) {
				if (!in_array($sClass, array('IPv4Subnet', 'IPv6Subnet'))) {
					throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
				}

				$id = utils::ReadParam('id', '');
				// Id may be null. In that case a temporary object is created.
				if (empty($id)) {
					$oObj = MetaModel::NewObject($sClass);
				} else {
					// Check if the object exists
					$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
					if (is_null($oObj)) {
						$oObj = MetaModel::NewObject($sClass);
					}
				}

				// Display calculator form
				$oObj->DisplayOperationForm($oP, $oAppContext, $operation);
			} else {
				$sClassLabel = MetaModel::GetName('IPSubnet');
				$sHeaderTitle = Dict::S('UI:IPManagement:Action:Calculator:IPSubnet');
				$oP->set_title($sHeaderTitle);
				$aPossibleClasses = array(
					'IPv4Subnet' => MetaModel::GetName('IPv4Subnet'),
					'IPv6Subnet' => MetaModel::GetName('IPv6Subnet'),
				);

				$sClassIconUrl = MetaModel::GetClassIcon('IPv4Subnet', false);
				$oP->SetBreadCrumbEntry($sHeaderTitle, $sHeaderTitle, '', '', 'fas fa-wrench', iTopWebPage::ENUM_BREADCRUMB_ENTRY_ICON_TYPE_CSS_CLASSES);
				$oPanel = PanelUIBlockFactory::MakeNeutral($sHeaderTitle)
					->SetIcon($sClassIconUrl);
				$oP->AddUiBlock($oPanel);

				$oClassForm = FormUIBlockFactory::MakeStandard();
				$oPanel->AddMainBlock($oClassForm);

				$oMultiColumn = new MultiColumn();
				$oClassForm->AddSubBlock($oMultiColumn)
					->AddHtml($oAppContext->GetForForm())
					->AddSubBlock(InputUIBlockFactory::MakeForHidden('operation', 'calculator'));

				// First column = labels
				$oColumn1 = new Column();
				$oMultiColumn->AddColumn($oColumn1);
				// Second column = selects
				$oColumn2 = new Column();
				$oMultiColumn->AddColumn($oColumn2);

				$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph(Dict::S('UI:IPManagement:Action:Calculator:IPSubnet:SelectSubnetType')));
				$oColumn1->AddSubBlock(HtmlFactory::MakeRaw('<br>'));
				$oSelect = SelectUIBlockFactory::MakeForSelect('class');
				$oColumn2->AddSubBlock($oSelect);
				foreach ($aPossibleClasses as $sClassName => $sClassLabel) {
					$oSelect->AddOption(SelectOptionUIBlockFactory::MakeForSelectOption($sClassName, $sClassLabel, false));
				}

				$oToolbar = ToolbarUIBlockFactory::MakeForAction();
				$oClassForm->AddSubBlock($oToolbar);
				$oToolbar->AddSubBlock(ButtonUIBlockFactory::MakeForPrimaryAction(Dict::S('UI:Button:Apply'), null, null, true));
			}
			break; // End case calculator

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'docalculator':    // Calculates subnet parameters
			$sClass = utils::ReadParam('class', '', false, 'class');
			$id = utils::ReadParam('id', '');

			// Check if right parameters have been given
			if (empty($sClass) || empty($id)) {
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (!in_array($sClass, array('IPv4Subnet', 'IPv6Subnet'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			if ($id > 0) {
				// Check if the object exists
				$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
				if (is_null($oObj)) {
					$oObj = MetaModel::NewObject($sClass);
					$id = $oObj->GetKey();
				}
			} else {
				$oObj = MetaModel::NewObject($sClass);
				$id = $oObj->GetKey();
			}

			// Display calculator output
			$sClassLabel = MetaModel::GetName($sClass);
			$aPostedParam = $oObj->GetPostedParam($operation);

			// Check calculator inputs
			$sErrorString = $oObj->DoCheckCalculatorInputs($aPostedParam);
			if ($sErrorString != '') {
				// Found issues, explain and give the user another chance
				$sMessage = Dict::Format('UI:IPManagement:Action:DoCalculator:'.$sClass.':CannotRun', $sErrorString);
				$oPanel = PanelUIBlockFactory::MakeForWarning('')
					->AddHtml($sMessage);
				$oP->AddUiBlock($oPanel);

				$sNextOperation = $oObj->GetNextOperation($operation);
				$oObj->DisplayOperationForm($oP, $oAppContext, $sNextOperation, $aPostedParam);
			} else {
				// Display result
				if ($id > 0) {
					$oObj->DisplayCalculatorOutput($oP, $aPostedParam);
				} else {
					$sHtml = $oObj->GetCalculatorOutput($oP, $aPostedParam);
					$sClassIconUrl = MetaModel::GetClassIcon($sClass, false);
					$sTitle = Dict::Format('UI:IPManagement:Action:DoCalculator:'.$sClass.':Title_Class_Object', $sClassLabel, '');

					$oP->set_title($sTitle);
					$oPanel = PanelUIBlockFactory::MakeForClass($sClass, $sTitle)->SetIcon($sClassIconUrl);
					$oP->AddUiBlock($oPanel);
					$oPanel->AddSubBlock(HtmlFactory::MakeParagraph(''))
						->AddHtml($sHtml);
				}
			}
			break; // End case docalculator

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'delegate':    // Delegates block to child organization
			$sClass = utils::ReadParam('class', '', false, 'class');
			$id = utils::ReadParam('id', '');
			// Check if right parameters have been given
			if (empty($sClass)) {
				throw new ApplicationException(Dict::Format('UI:Error:1ParametersMissing', 'class'));
			}
			if (!in_array($sClass, array('Domain', 'IPv4Block', 'IPv6Block'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
			if (is_null($oObj)) {
				$oP->set_title(Dict::S('UI:ErrorPageTitle'));
				$oP->P(Dict::S('UI:ObjectDoesNotExist'));
			} else {
				// The object can be read - Check now that user is allowed to modify it
				$oSet = CMDBObjectSet::FromObject($oObj);
				if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY, $oSet) == UR_ALLOWED_NO) {
					throw new SecurityException('User not allowed to modify this object', array('class' => $sClass, 'id' => $id));
				}

				// Process request now
				$sErrorString = $oObj->DoCheckToDelegate(array());
				if ($sErrorString != '') {
					// Found issues, explain and give the user another chance
					$sMessage = Dict::Format('UI:IPManagement:Action:Delegate:'.$sClass.':CannotBeDelegated', $sErrorString);
					DisplayMessage::Warning($oP, $sMessage);

					IPUtils::DisplayDetails($oP, $oObj);
				} else {
					$oObj->DisplayOperationForm($oP, $oAppContext, $operation);
				}
			}
			break; // End case delegate

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'dodelegate':    // Apply delegate a block
			$sClass = utils::ReadPostedParam('class', '', 'class');
			$id = utils::ReadPostedParam('id', '');
			$sTransactionId = utils::ReadPostedParam('transaction_id', '');

			// Check if right parameters have been given
			if (empty($sClass) || empty($id)) {
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (!in_array($sClass, array('Domain', 'IPv4Block', 'IPv6Block'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Object does exist. It has already been checked in action delegate but check anyway.
			$oObj = MetaModel::GetObject($sClass, $id, true /* MustBeFound */);

			// Make sure we don't follow the same path twice in a row.
			$sClassLabel = MetaModel::GetName($sClass);
			$sObjectName = $oObj->GetName();
			if (!utils::IsTransactionValid($sTransactionId, false)) {
				TeemIpUI::LogInvalidTransaction($oP, $operation, $sTransactionId, $id, $sObjectName, $sClass, $sClassLabel);
			} else {
				$aPostedParam = $oObj->GetPostedParam($operation);

				// Make sure object can be delegated
				$sErrorString = $oObj->DoCheckToDelegate($aPostedParam);
				if ($sErrorString != '') {
					// Found issues, explain and give the user another chance
					$sMessage = Dict::Format('UI:IPManagement:Action:Delegate:'.$sClass.':CannotBeDelegated', $sErrorString);
					DisplayMessage::Warning($oP, $sMessage);

					$sNextOperation = $oObj->GetNextOperation($operation);
					$oObj->DisplayOperationForm($oP, $oAppContext, $sNextOperation, $aPostedParam);
				} else {
					// Delegate block
					$oObj->DoDelegate($aPostedParam);

					// Display result
					$oP->set_title(Dict::Format('UI:IPManagement:Action:Delegate:'.$sClass.':PageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
					$sMessage = Dict::Format('UI:IPManagement:Action:Delegate:'.$sClass.':Done', $sClassLabel, $oObj->GetName());
					DisplayMessage::Success($oP, $sMessage);
					IPUtils::DisplayDetails($oP, $oObj);

					// Close transaction
					utils::RemoveTransaction($sTransactionId);
				}
			}
			break; // End case dodelegate

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'undelegate':    // Delegates block to child organization
			$sClass = utils::ReadParam('class', '', false, 'class');
			$id = utils::ReadParam('id', '');
			// Check if right parameters have been given
			if (empty($sClass)) {
				throw new ApplicationException(Dict::Format('UI:Error:1ParametersMissing', 'class'));
			}
			if (!in_array($sClass, array('Domain', 'IPv4Block', 'IPv6Block'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
			if (is_null($oObj)) {
				$oP->set_title(Dict::S('UI:ErrorPageTitle'));
				$oP->P(Dict::S('UI:ObjectDoesNotExist'));
			} else {
				// The object can be read - Check now that user is allowed to modify it
				$oSet = CMDBObjectSet::FromObject($oObj);
				if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY, $oSet) == UR_ALLOWED_NO) {
					throw new SecurityException('User not allowed to modify this object', array('class' => $sClass, 'id' => $id));
				}

				// Make sure object can be undelegated
				$sErrorString = $oObj->DoCheckToUndelegate();
				if ($sErrorString != '') {
					// Found issues, explain and give the user another chance
					$sMessage = Dict::Format('UI:IPManagement:Action:Undelegate:'.$sClass.':CannotBeUndelegated', $sErrorString);
					DisplayMessage::Warning($oP, $sMessage);

					IPUtils::DisplayDetails($oP, $oObj);
				} else {
					// Undelegate block
					$oObj->DoUndelegate();

					// Display result
					$sClassLabel = MetaModel::GetName($sClass);
					$oP->set_title(Dict::Format('UI:IPManagement:Action:Undelegate:'.$sClass.':PageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
					$sMessage = Dict::Format('UI:IPManagement:Action:Undelegate:'.$sClass.':Done', $sClassLabel, $oObj->GetName());
					DisplayMessage::Success($oP, $sMessage);
					IPUtils::DisplayDetails($oP, $oObj);
				}
			}
			break; // End case undelegate

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'allocateip':    // Allocate existing IP (not already allocated) to an existing CI
			$sClass = utils::ReadParam('class', '', false, 'class');
			$id = utils::ReadParam('id', '');
			// Check if right parameters have been given
			if (empty($sClass)) {
				throw new ApplicationException(Dict::Format('UI:Error:1ParametersMissing', 'class'));
			}
			if (!in_array($sClass, array('IPv4Address', 'IPv6Address'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
			if (is_null($oObj)) {
				$oP->set_title(Dict::S('UI:ErrorPageTitle'));
				$oP->P(Dict::S('UI:ObjectDoesNotExist'));
			} else {
				// The object can be read - Check now that user is allowed to modify it
				$oSet = CMDBObjectSet::FromObject($oObj);
				if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY, $oSet) == UR_ALLOWED_NO) {
					throw new SecurityException('User not allowed to modify this object', array('class' => $sClass, 'id' => $id));
				}

				// Process request now
				$oObj->DisplayOperationForm($oP, $oAppContext, $operation);
			}
			break; // End case allocateip

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'doallocateip':    // Apply allocate IP
			$sClass = utils::ReadPostedParam('class', '', 'class');
			$id = utils::ReadPostedParam('id', '');
			$sTransactionId = utils::ReadPostedParam('transaction_id', '');

			// Check if right parameters have been given
			if (empty($sClass) || empty($id)) {
				throw new ApplicationException(Dict::Format('UI:Error:2ParametersMissing', 'class', 'id'));
			}
			if (!in_array($sClass, array('IPv4Address', 'IPv6Address'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Object does exist. It has already been checked in action allocate but check anyway.
			$oObj = MetaModel::GetObject($sClass, $id, true /* MustBeFound */);

			// Make sure we don't follow the same path twice in a row.
			$sClassLabel = MetaModel::GetName($sClass);
			if (!utils::IsTransactionValid($sTransactionId, false)) {
				$oP->set_title(Dict::Format('UI:ModificationPageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
				$oP->p("<strong>".Dict::S('UI:Error:ObjectAlreadyUpdated')."</strong>\n");
			} else {
				$aPostedParam = $oObj->GetPostedParam($operation);

				// Make sure object can be delegated
				$sErrorString = $oObj->DoCheckToAllocate($aPostedParam);
				if ($sErrorString != '') {
					// Found issues, explain and give the user another chance
					$sMessage = Dict::Format('UI:IPManagement:Action:Allocate:IPAddress:CannotAllocateCI', $sErrorString);
					DisplayMessage::Warning($oP, $sMessage);

					$sNextOperation = $oObj->GetNextOperation($operation);
					$oObj->DisplayOperationForm($oP, $oAppContext, $sNextOperation, $aPostedParam);
				} else {
					// Allocate IP
					$oObj->DoAllocate($aPostedParam);

					// Display result
					$oP->set_title(Dict::Format('UI:IPManagement:Action:Allocate:'.$sClass.':PageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
					$sMessage = Dict::Format('UI:IPManagement:Action:Allocate:'.$sClass.':Done', $sClassLabel, $oObj->GetName());
					DisplayMessage::Success($oP, $sMessage);
					IPUtils::DisplayDetails($oP, $oObj);

					// Close transaction
					utils::RemoveTransaction($sTransactionId);
				}
			}
			break; // End case doallocateip

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'unallocateip':    // Unallocate existing allocated IP from a CI
			$sClass = utils::ReadParam('class', '', false, 'class');
			$id = utils::ReadParam('id', '');
			// Check if right parameters have been given
			if (empty($sClass)) {
				throw new ApplicationException(Dict::Format('UI:Error:1ParametersMissing', 'class'));
			}
			if (!in_array($sClass, array('IPv4Address', 'IPv6Address'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
			if (is_null($oObj)) {
				$oP->set_title(Dict::S('UI:ErrorPageTitle'));
				$oP->P(Dict::S('UI:ObjectDoesNotExist'));
			} else {
				// The object can be read - Check now that user is allowed to modify it
				$oSet = CMDBObjectSet::FromObject($oObj);
				if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY, $oSet) == UR_ALLOWED_NO) {
					throw new SecurityException('User not allowed to modify this object', array('class' => $sClass, 'id' => $id));
				}

				// Make sure object can be unallocated
				$sErrorString = $oObj->DoCheckToUnallocate();
				if ($sErrorString != '') {
					// Found issues: explain and display object again
					$sMessage = Dict::Format('UI:IPManagement:Action:Unallocate:IPAddress:CannotBeUnallocated', $sErrorString);
					DisplayMessage::Warning($oP, $sMessage);

					IPUtils::DisplayDetails($oP, $oObj);
				} else {
					// Unallocate IP
					$oObj->DoUnallocate();

					// Display result
					$sClassLabel = MetaModel::GetName($sClass);
					$oP->set_title(Dict::Format('UI:IPManagement:Action:Unallocate:'.$sClass.':PageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
					$sMessage = Dict::Format('UI:IPManagement:Action:Unallocate:'.$sClass.':Done', $sClassLabel, $oObj->GetName());
					DisplayMessage::Success($oP, $sMessage);
					IPUtils::DisplayDetails($oP, $oObj);
				}
			}
			break; // End case unallocateip

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'explodefqdn':    // Explode IPs' discovered FQDN into short name and domain name
			$sClass = utils::ReadParam('class', '', false, 'class');
			$id = utils::ReadParam('id', '');
			$sFqdnAttr = utils::ReadParam('fqdn_attribute', '');
			// Check if right parameters have been given
			if (empty($sClass) || empty($id) || empty($sFqdnAttr)) {
				throw new ApplicationException(Dict::Format('UI:Error:3ParametersMissing', 'class', 'id', 'fqdn_attribute'));
			}
			if (!in_array($sClass, array('IPv4Subnet', 'IPv6Subnet', 'IPv4Range', 'IPv6Range', 'IPv4Address', 'IPv6Address'))) {
				throw new ApplicationException(Dict::Format('UI:Error:WrongActionForClass', $operation, $sClass));
			}

			// Check if the object exists
			$oObj = MetaModel::GetObject($sClass, $id, false /* MustBeFound */);
			if (is_null($oObj)) {
				$oP->set_title(Dict::S('UI:ErrorPageTitle'));
				$oP->P(Dict::S('UI:ObjectDoesNotExist'));
			} else {
				// Check now that user is allowed to modify IP addresses
				if ((in_array($sClass, array('IPv4Subnet', 'IPv4Range', 'IPv4Address'))) && (!UserRights::IsActionAllowed('IPv4Address', UR_ACTION_MODIFY) == UR_ALLOWED_YES)) {
					throw new SecurityException('User not allowed to modify this object', array('class' => 'IPv4Address', 'id' => $id));
				} elseif ((in_array($sClass, array('IPv6Subnet', 'IPv6Range', 'IPv6Address'))) && (!UserRights::IsActionAllowed('IPv6Address', UR_ACTION_MODIFY) == UR_ALLOWED_YES)) {
					throw new SecurityException('User not allowed to modify this object', array('class' => 'IPv6Address', 'id' => $id));
				}

				// Make sure discovered address can be exploded
				$sErrorString = $oObj->DoCheckToExplodeFQDN($sFqdnAttr);
				if ($sErrorString != '') {
					// Found issues: explain and display object again
					$sMessage = Dict::Format('UI:IPManagement:Action:ExplodeFQDN:'.$sClass.':CannotBeExploded', $sErrorString);
					DisplayMessage::Warning($oP, $sMessage);

					IPUtils::DisplayDetails($oP, $oObj);
				} else {
					// Unallocate IP
					$oObj->DoExplodeFQDN($sFqdnAttr);

					// Display result
					$sClassLabel = MetaModel::GetName($sClass);
					$oP->set_title(Dict::Format('UI:IPManagement:Action:ExplodeFQDN:'.$sClass.':PageTitle_Object_Class', $oObj->GetName(), $sClassLabel));
					$sMessage = Dict::Format('UI:IPManagement:Action:ExplodeFQDN:'.$sClass.':Done', $sClassLabel, $oObj->GetName());
					DisplayMessage::Success($oP, $sMessage);
					IPUtils::DisplayDetails($oP, $oObj);
				}
			}
			break; // End case explodefqdn

		///////////////////////////////////////////////////////////////////////////////////////////

		case 'cancel':    // An action was cancelled
		default: // Menu node rendering (templates)
			ApplicationMenu::LoadAdditionalMenus();
			$oMenuNode = ApplicationMenu::GetMenuNode(ApplicationMenu::GetMenuIndexById(ApplicationMenu::GetActiveNodeId()));
			if (is_object($oMenuNode)) {
				$oMenuNode->RenderContent($oP, $oAppContext->GetAsHash());
				$oP->set_title($oMenuNode->GetLabel());
			}
			break;

	}
	$oP->output(); // Display the whole content now !
} catch (CoreException $e) {
	require_once(APPROOT.'/setup/setuppage.class.inc.php');
	$oP = new SetupPage(Dict::S('UI:PageTitle:FatalError'));
	if ($e instanceof SecurityException) {
		$oP->add("<h1>".Dict::S('UI:SystemIntrusion')."</h1>\n");
	} else {
		$oP->add("<h1>".Dict::S('UI:FatalErrorMessage')."</h1>\n");
	}
	$oP->error(Dict::Format('UI:Error_Details', $e->getHtmlDesc()));
	$oP->output();

	if (MetaModel::IsLogEnabledIssue()) {
		if (MetaModel::IsValidClass('EventIssue')) {
			try {
				$oLog = new EventIssue();

				$oLog->Set('message', $e->getMessage());
				$oLog->Set('userinfo', '');
				$oLog->Set('issue', $e->GetIssue());
				$oLog->Set('impact', 'Page could not be displayed');
				$oLog->Set('callstack', $e->getTrace());
				$oLog->Set('data', $e->getContextData());
				$oLog->DBInsertNoReload();
			} catch (Exception $e) {
				IssueLog::Error("Failed to log issue into the DB");
			}
		}

		IssueLog::Error($e->getMessage());
	}

	// For debugging only
	//throw $e;
} catch (Exception $e) {
	require_once(APPROOT.'/setup/setuppage.class.inc.php');
	$oP = new SetupPage(Dict::S('UI:PageTitle:FatalError'));
	$oP->add("<h1>".Dict::S('UI:FatalErrorMessage')."</h1>\n");
	$oP->error(Dict::Format('UI:Error_Details', $e->getMessage()));
	$oP->output();

	if (MetaModel::IsLogEnabledIssue()) {
		if (MetaModel::IsValidClass('EventIssue')) {
			try {
				$oLog = new EventIssue();

				$oLog->Set('message', $e->getMessage());
				$oLog->Set('userinfo', '');
				$oLog->Set('issue', 'PHP Exception');
				$oLog->Set('impact', 'Page could not be displayed');
				$oLog->Set('callstack', $e->getTrace());
				$oLog->Set('data', array());
				$oLog->DBInsertNoReload();
			} catch (Exception $e) {
				IssueLog::Error("Failed to log issue into the DB");
			}
		}

		IssueLog::Error($e->getMessage());
	}
}

class TeemIpUI
{
	/**
	 * @param \WebPage $oP
	 * @param $operation
	 * @param $sTransactionId
	 * @param $id
	 * @param $sObjectName
	 * @param $sClass
	 * @param $sClassLabel
	 *
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	public static function LogInvalidTransaction(WebPage $oP, $operation, $sTransactionId, $id, $sObjectName, $sClass, $sClassLabel)
	{
		$sUser = UserRights::GetUser();
		IssueLog::Error("UI.php '$operation' : invalid transaction_id ! data: user='$sUser', class='$sClass'");
		$oP->set_title(Dict::Format('UI:ModificationPageTitle_Object_Class', $sObjectName, $sClassLabel)); // Set title will take care of the encoding
		$oP->p("<strong>".Dict::S('UI:Error:ObjectAlreadyUpdated')."</strong>\n");
		//$sMessage = Dict::Format('UI:Error:ObjectAlreadyUpdated', MetaModel::GetName($sClass), $sObjectName);
		//$sSeverity = 'error';

		IssueLog::Trace('Object not updated (invalid transaction_id)', $sClass, array(
			'$operation' => $operation,
			'$id' => $id,
			'$sTransactionId' => $sTransactionId,
			'$sUser' => UserRights::GetUser(),
			'HTTP_REFERER' => @$_SERVER['HTTP_REFERER'],
			'REQUEST_URI' => @$_SERVER['REQUEST_URI'],
		));
	}
}
