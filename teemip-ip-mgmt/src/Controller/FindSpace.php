<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Controller;

use cmdbAbstractObject;
use CMDBObjectSet;
use Combodo\iTop\Application\UI\Base\Component\Button\ButtonUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Field\FieldUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Form\FormUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Html\HtmlFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\InputUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\Select\SelectOptionUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\SelectUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Panel\PanelUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Toolbar\ToolbarUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\Column\Column;
use Combodo\iTop\Application\UI\Base\Layout\MultiColumn\MultiColumn;
//use Combodo\iTop\Application\WebPage\WebPage;
use DBObjectSearch;
use Dict;
use IPv4Block;
use IPv6Block;
use iTopWebPage;
use MetaModel;
use TeemIp\TeemIp\Extension\Framework\Helper\DisplayMessage;
use TeemIp\TeemIp\Extension\Framework\Helper\IPUtils;
use UserRights;
use utils;
use WebPage;

class FindSpace {
	/**
	 * Get parameters related to find space operations
	 *
	 * @param $sOperation
	 *
	 * @return array
	 */
	static public function GetPostedParam($sOperation) {
		$aParam = array();
		switch ($sOperation) {
			/** @noinspection PhpMissingBreakStatementInspection */
			case 'dofindspace':
				$aParam['block_id'] = utils::ReadPostedParam('block_id', '', 'raw_data');
				$aParam['ip'] = utils::ReadPostedParam('attr_ip', '', 'raw_data');
				$aParam['spacesize'] = utils::ReadPostedParam('spacesize', '', 'raw_data');
				$aParam['maxoffer'] = utils::ReadPostedParam('maxoffer', '', 'raw_data');
				$aParam['status_subnet'] = '';
				$aParam['type'] = '';
				$aParam['location_id'] = 0;
				$aParam['requestor_id'] = 0;

			case 'findspace':
				$aParam['org_id'] = utils::ReadPostedParam('org_id', '', 'raw_data');
				$aParam['spacetype'] = utils::ReadPostedParam('spacetype', '', 'raw_data');
				break;

			default:
				break;
		}

		return $aParam;
	}

	/**
	 * Define parameters that will be used for lookup
	 *  1. Ask to select organization and space type
	 *
	 * @param \iTopWebPage $oP
	 * @param $oAppContext
	 * @param $aDefault
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	static public function DisplayOperationForm(iTopWebPage $oP, $oAppContext, $aDefault) {
		if (empty($aDefault['spacetype'])) {
			FindSpace::FindSpaceProcessStep1($oP, $oAppContext);
		} else {
			FindSpace::FindSpaceProcessStep2($oP, $oAppContext, $aDefault);
		}
	}

	/**
	 * First step of Find Space process: select organization and space type
	 *
	 * @param \iTopWebPage $oP
	 * @param $oAppContext
	 *
	 * @throws \CoreException
	 */
	static private function FindSpaceProcessStep1($oP, $oAppContext) {
		$sHeaderTitle = Dict::S('UI:IPManagement:Action:FindSpace');
		$oP->set_title($sHeaderTitle);

		$oContact = UserRights::GetContactObject();
		$iUserOrg = $oContact->Get('org_id');
		$oOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o"));
		$aPossibleSpaces = array(
			'ipv4space' => Dict::S('UI:IPManagement:Action:FindSpace:IPv4Space'),
			'ipv6space' => Dict::S('UI:IPManagement:Action:FindSpace:IPv6Space'),
		);

		$oP->SetBreadCrumbEntry($sHeaderTitle, $sHeaderTitle, '', '', 'fas fa-search', iTopWebPage::ENUM_BREADCRUMB_ENTRY_ICON_TYPE_CSS_CLASSES);
		$sClassIconUrl = MetaModel::GetClassIcon('IPv4Block', false);
		$oPanel = PanelUIBlockFactory::MakeNeutral($sHeaderTitle)
			->SetIcon($sClassIconUrl);
		$oP->AddUiBlock($oPanel);

		$oClassForm = FormUIBlockFactory::MakeStandard();
		$oPanel->AddMainBlock($oClassForm);

		$oMultiColumn = new MultiColumn();
		$oClassForm->AddSubBlock($oMultiColumn)
			->AddHtml($oAppContext->GetForForm())
			->AddSubBlock(InputUIBlockFactory::MakeForHidden('operation', 'findspace'));

		// First column = labels
		$oColumn1 = new Column();
		$oMultiColumn->AddColumn($oColumn1);
		// Second column = selects
		$oColumn2 = new Column();
		$oMultiColumn->AddColumn($oColumn2);

		//  Organization
		$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph(Dict::S('UI:IPManagement:Action:FindSpace:Organization')));
		$oColumn1->AddSubBlock(HtmlFactory::MakeRaw('<br>'));
		$oSelect = SelectUIBlockFactory::MakeForSelect('org_id');
		$oColumn2->AddSubBlock($oSelect);
		while ($oOrg = $oOrgSet->Fetch()) {
			$iOrgKey = $oOrg->GetKey();
			$sOrgName = $oOrg->GetName();
			$bSelected = ($iOrgKey == $iUserOrg) ? true : false;
			$oSelect->AddOption(SelectOptionUIBlockFactory::MakeForSelectOption($iOrgKey, $sOrgName, $bSelected));
		}
		$oColumn2->AddSubBlock(HtmlFactory::MakeRaw('<br><br>'));

		//  IP space type
		$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph(Dict::S('UI:IPManagement:Action:FindSpace:SpaceType')));
		$oColumn1->AddSubBlock(HtmlFactory::MakeRaw('<br>'));
		$oSelect = SelectUIBlockFactory::MakeForSelect('spacetype');
		$oColumn2->AddSubBlock($oSelect);
		foreach ($aPossibleSpaces as $sSpaceName => $sSpaceLabel) {
			$oSelect->AddOption(SelectOptionUIBlockFactory::MakeForSelectOption($sSpaceName, $sSpaceLabel, false));
		}

		$oToolbar = ToolbarUIBlockFactory::MakeForAction();
		$oClassForm->AddSubBlock($oToolbar);
		$oToolbar->AddSubBlock(ButtonUIBlockFactory::MakeForPrimaryAction(Dict::S('UI:Button:Apply'), null, null, true));
	}

	/**
	 * Second step of Find Space process: select IP, size and required number of proposal
	 *
	 * @param \iTopWebPage $oP
	 * @param $oAppContext
	 * @param $aDefault
	 *
	 * @throws \ArchivedObjectException
	 * @throws \ConfigException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 * @throws \ReflectionException
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	static private function FindSpaceProcessStep2($oP, $oAppContext, $aDefault) {
		$sSpaceType = $aDefault['spacetype'];
		$iOrgId = $aDefault['org_id'];
		$iBlockId = (array_key_exists('block_id', $aDefault)) ? $aDefault['block_id'] : 0;
		$sBlockClass = ($sSpaceType == 'ipv4space') ? 'IPv4Block' : 'IPv6Block';
		$sAddressClass = ($sSpaceType == 'ipv4space') ? 'IPv4Address' : 'IPv6Address';

		$sHeaderTitle = ($sSpaceType == 'ipv4space') ? Dict::S('UI:IPManagement:Action:FindIPv4Space') : Dict::S('UI:IPManagement:Action:FindIPv6Space');
		$oP->set_title($sHeaderTitle);

		// Has Block already been identified ?
		if ($iBlockId > 0) {
			$oBlock = MetaModel::GetObject($sBlockClass, $iBlockId);
		}
		// Get min block prefix
		$iPrefix = (($iBlockId == 0) || is_null($oBlock)) ? 1 : $oBlock->GetMinTheoriticalBlockPrefix();
		if ($sSpaceType == 'ipv4space') {
			if ($iPrefix < 16) {
				$iDefaultMask = 16;
			} else {
				if ($iPrefix < 24) {
					$iDefaultMask = 24;
				} else {
					$iDefaultMask = 31;
				}
			}
			$InputSize = IPUtils::MaskToSize(IPUtils::BitToMask($iPrefix)); // Corrects pb with some 64bits OS - Centos...
		}

		$sClassIconUrl = MetaModel::GetClassIcon('IPv4Block', false);
		$oPanel = PanelUIBlockFactory::MakeNeutral($sHeaderTitle)
			->SetIcon($sClassIconUrl);
		$oP->AddUiBlock($oPanel);

		$oClassForm = FormUIBlockFactory::MakeStandard();
		$oPanel->AddMainBlock($oClassForm);

		$oMultiColumn = new MultiColumn();
		$oClassForm->AddSubBlock($oMultiColumn)
			->AddHtml($oAppContext->GetForForm())
			->AddSubBlock(InputUIBlockFactory::MakeForHidden('org_id', $iOrgId))
			->AddSubBlock(InputUIBlockFactory::MakeForHidden('spacetype', $sSpaceType))
			->AddSubBlock(InputUIBlockFactory::MakeForHidden('operation', 'dofindspace'));

		// First column = labels
		$oColumn1 = new Column();
		$oMultiColumn->AddColumn($oColumn1);
		// Second column = data
		$oColumn2 = new Column();
		$oMultiColumn->AddColumn($oColumn2);

		// First IP
		$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph(Dict::S('UI:IPManagement:Action:FindSpace:FirstIP')));
		$oColumn1->AddSubBlock(HtmlFactory::MakeRaw('<br>'));
		$oAttDef = MetaModel::GetAttributeDef($sAddressClass, 'ip');
		if (($iBlockId == 0) || is_null($oBlock)) {
			$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, $sAddressClass, 'ip', $oAttDef, '', '', 'ip');
		} else {
			$sHTMLValue = '';
		}
		$val = array(
			'label' => '',
			'value' => $sHTMLValue,
			'input_id' => 'ip',
			'input_type' => '',
			'comments' => '',
			'infos' => '',
		);
		$oField = FieldUIBlockFactory::MakeFromParams($val);
		$oColumn2->AddSubBlock($oField);
		$oColumn2->AddSubBlock(HtmlFactory::MakeRaw('<br>'));

		// Size
		$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph(Dict::S('UI:IPManagement:Action:FindSpace:SpaceSize')));
		$oColumn1->AddSubBlock(HtmlFactory::MakeRaw('<br>'));
		$oSelect = SelectUIBlockFactory::MakeForSelect('spacesize');
		$oColumn2->AddSubBlock($oSelect);
		if ($sSpaceType == 'ipv4space') {
			while ($iPrefix <= 32) {
				$bSelected = ($iPrefix == $iDefaultMask) ? true : false;
				$oSelect->AddOption(SelectOptionUIBlockFactory::MakeForSelectOption($InputSize, IPUtils::BitToMask($iPrefix).'/'.$iPrefix, $bSelected));
				$InputSize /= 2;
				$iPrefix++;
			}
		} else {
			while ($iPrefix <= 128) {
				$bSelected = ($iPrefix == IPV6_SUBNET_MAX_PREFIX) ? true : false;
				$oSelect->AddOption(SelectOptionUIBlockFactory::MakeForSelectOption($iPrefix, '/'.$iPrefix, $bSelected));
				$iPrefix++;
			}
		}
		$oColumn2->AddSubBlock(HtmlFactory::MakeRaw('<br><br>'));

		// Max number of offers
		$oColumn1->AddSubBlock(HtmlFactory::MakeParagraph(Dict::S('UI:IPManagement:Action:FindSpace:MaxNumberOfOffers')));
		$oColumn1->AddSubBlock(HtmlFactory::MakeRaw('<br>'));
		$oInput = InputUIBlockFactory::MakeStandard('text', 'maxoffer', DEFAULT_MAX_FREE_SPACE_OFFERS);
		$oColumn2->AddSubBlock($oInput);

		$oToolbar = ToolbarUIBlockFactory::MakeForAction();
		$oClassForm->AddSubBlock($oToolbar);
		$oToolbar->AddSubBlock(ButtonUIBlockFactory::MakeForPrimaryAction(Dict::S('UI:Button:Apply'), null, null, true));
	}

	/**
	 * Check if space can be searched
	 *
	 * @param $aParameter
	 *
	 * @return array
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	static public function DoCheckToDisplayAvailableSpace($aParameter) {
		$sClass = ($aParameter['spacetype'] == 'ipv4space') ? 'IPv4Block' : 'IPv6Block';
		$iOrgId = $aParameter['org_id'];
		$sIp = $aParameter['ip'];

		$sIssueDesc = '';
		if ($sClass == 'IPv4Block') {
			$iMinBlockId = IPv4Block::GetSmallerBlockContainingIp($iOrgId, $sIp);
		} else {
			$iMinBlockId = IPv6Block::GetSmallerBlockContainingIp($iOrgId, $sIp);
		}
		if ($iMinBlockId != 0) {
			$oBlock = MetaModel::GetObject($sClass, $iMinBlockId);
			if ($sClass == 'IPv4Block') {
				$iBlockSize = $oBlock->GetSize();
				if ($aParameter['spacesize'] >= $iBlockSize) {
					// IP belongs to a block which size is smaller than the requested available space
					$sIssueDesc = Dict::Format('UI:IPManagement:Action:DoFindSpace:IPBlock:RequestedSpaceBiggerThanBlockSize', $oBlock->GetName());
				}
			} else {
				$iBlockPrefix = $oBlock->GetMinTheoriticalBlockPrefix();
				if ($aParameter['spacesize'] <= $iBlockPrefix) {
					// IP belongs to a block which size is smaller than the requested available space
					$sIssueDesc = Dict::Format('UI:IPManagement:Action:DoFindSpace:IPBlock:RequestedSpaceBiggerThanBlockSize', $oBlock->GetName());
				}
			}
		}

		return array($sIssueDesc, $iMinBlockId);
	}

	/**
	 * @param \iTopWebPage $oP
	 * @param $aParameter
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	static public function DoDisplayAvailableSpace(iTopWebPage $oP, $aParameter) {
		$sClass = ($aParameter['spacetype'] == 'ipv4space') ? 'IPv4Block' : 'IPv6Block';
		$iOrgId = $aParameter['org_id'];
		$sIp = $aParameter['ip'];

		if ($sClass == 'IPv4Block') {
			$iMinBlockId = IPv4Block::GetSmallerBlockContainingIp($iOrgId, $sIp);
		} else {
			$iMinBlockId = IPv6Block::GetSmallerBlockContainingIp($iOrgId, $sIp);
		}
		if ($iMinBlockId != 0) {
			$oBlock = MetaModel::GetObject($sClass, $iMinBlockId);
		} else {
			$oBlock = MetaModel::NewObject($sClass);
			$oBlock->Set('org_id', $iOrgId);
			$oBlock->Set('firstip', $sIp);
			$sLastIP = ($sClass == 'IPv4Block') ? '255.255.255.255' : 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF';
			$oBlock->Set('lastip', $sLastIP);
			$oBlock->Set('name', '['.$sIp.' - '.$sLastIP.']');
		}

		list ($sMessage, $sHtml) = $oBlock->GetAvailableSpace($oP, 0, $aParameter);
		if ($sMessage != '') {
			DisplayMessage::Info($oP, $sMessage);
		}
		$sClassIconUrl = MetaModel::GetClassIcon($sClass, false);
		$sClassLabel = MetaModel::GetName($sClass);
		$sClassName = $oBlock->Get('name');

		$sTitle = Dict::Format('UI:IPManagement:Action:DoFindSpace:'.$sClass.':Title_Class_Object', $sClassLabel, $sClassName);
		$oP->SetBreadCrumbEntry($sTitle, $sTitle, '', '', 'fas fa-search', iTopWebPage::ENUM_BREADCRUMB_ENTRY_ICON_TYPE_CSS_CLASSES);
		$oP->set_title($sTitle);

		$oPanel = PanelUIBlockFactory::MakeForClass($sClass, $sTitle)->SetIcon($sClassIconUrl);
		$oP->AddUiBlock($oPanel);
		$oPanel->AddSubBlock(HtmlFactory::MakeParagraph(''))
			->AddHtml($sHtml);
	}

}
