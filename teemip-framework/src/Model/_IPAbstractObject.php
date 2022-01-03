<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Framework\Model;

use cmdbAbstractObject;
use CMDBObjectSet;
use Combodo\iTop\Application\UI\Base\Component\Button\ButtonUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Field\Field;
use Combodo\iTop\Application\UI\Base\Component\Field\FieldUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Form\FormUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\InputUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Toolbar\ToolbarUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Layout\Object\ObjectFactory;
use Combodo\iTop\Application\UI\Base\Layout\PageContent\PageContentFactory;
use Combodo\iTop\Application\UI\Base\Layout\UIContentBlock;
use DBObjectSearch;
use Dict;
use iTopWebPage;
use MenuBlock;
use MetaModel;
use TeemIp\TeemIp\Extension\Framework\Helper\IPUtils;
use utils;

class _IPAbstractObject extends cmdbAbstractObject {
	/**
	 * Provides attributes' parameters
	 *
	 * @param $sAttCode
	 *
	 * @return array
	 */
	public function GetAttributeParams($sAttCode) {
		return (array());
	}

	/**
	 * Returns default value of an attribute
	 *
	 * @param $sAttribute
	 *
	 * @return int|string
	 * @throws \Exception
	 */
	public function GetDefaultValueAttribute($sAttribute) {
		$sClass = get_class($this);
		$aAllowedValues = MetaModel::GetAllowedValues_att($sClass, $sAttribute);
		if (!empty($aAllowedValues)) {
			$aValues = array_keys($aAllowedValues);

			return $aValues[0];
		}

		return '';
	}

	/**
	 * Change default flag of attribute.
	 *
	 * @param string $sAttCode
	 * @param array $aReasons
	 * @param string $sTargetState
	 *
	 * @return int
	 * @throws \CoreException
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '') {
		$aReadOnlyAttributes = array('ipconfig_id');
		if (in_array($sAttCode, $aReadOnlyAttributes)) {
			return OPT_ATT_READONLY;
		}

		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}

	/*
	 * Displays choices related to operation.
	 *
	 * @param \iTopWebPage $oP
	 * @param $oAppContext
	 * @param $sOperation
	 * @param $aDefault
	 *
	 * @return void
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	public function DisplayOperationForm(iTopWebPage $oP, $oAppContext, $sOperation, $aDefault = array()) {
		$id = $this->GetKey();
		$sClass = get_class($this);
		$sClassLabel = MetaModel::GetName($sClass);
		$sUIPath = $this->MakeUIPath($sOperation);

		// Make sure action can be performed
		$CheckOperation = $this->DoCheckOperation($sOperation);
		if ($CheckOperation != '') {
			// Found issues: explain and display block again
			$sIssueDesc = Dict::Format($sUIPath.':'.$CheckOperation);
			cmdbAbstractObject::SetSessionMessage($sClass, $id, $sOperation, $sIssueDesc, 'error', 0, true /* must not exist */);
			IPUtils::DisplayDetails($oP, $this);

			return;
		}

		$sNextOperation = $this->GetNextOperation($sOperation);
		if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.0', '<')) {
			// Set page titles
			$this->SetPageTitles($oP, $sUIPath);

			// Set blue modification frame
			$oP->add("<div class=\"wizContainer\">\n");

			// Preparation to allow new values to be posted
			$aFieldsMap = array();
			$sPrefix = '';
			$m_iFormId = $this->GetNewFormId($sPrefix);
			$iTransactionId = utils::GetNewTransactionId();
			$oP->SetTransactionId($iTransactionId);
			$sFormAction = utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/ui.teemip-ip-mgmt.php";
			$oP->add("<form action=\"$sFormAction\" id=\"form_$m_iFormId\" enctype=\"multipart/form-data\" method=\"post\" onSubmit=\"return OnSubmit('form_$m_iFormId');\">\n");
			$oP->add_ready_script("$(window).unload(function() { OnUnload('$iTransactionId') } );\n");

			// Display object attributes as a reminder
			if (in_array($sOperation, array('shrinkblock', 'shrinksubnet', 'splitblock', 'splitsubnet', 'expandblock', 'expandsubnet'))) {
				// Display main tab
				$oP->AddTabContainer(OBJECT_PROPERTIES_TAB);
				$oP->SetCurrentTabContainer(OBJECT_PROPERTIES_TAB);

				// Display object attributes
				$this->DisplayMainAttributesForOperation($oP, $sOperation, $m_iFormId, $sPrefix, $aDefault);

				$oP->SetCurrentTab();
			}

			// Display action fields
			$this->DisplayActionFieldsForOperation($oP, $sOperation, $m_iFormId, $aDefault);

			// Load other parameters to post
			$oP->add($oAppContext->GetForForm());
			$oP->add("<input type=\"hidden\" name=\"operation\" value=\"$sNextOperation\">\n");
			$oP->add("<input type=\"hidden\" name=\"class\" value=\"$sClass\">\n");
			$oP->add("<input type=\"hidden\" name=\"transaction_id\" value=\"$iTransactionId\">\n");
			$oP->add("<input type=\"hidden\" name=\"id\" value=\"$id\">\n");

			$oP->add('</form>');
			$oP->add("</div>\n");

			$iFieldsCount = count($aFieldsMap);
			$sJsonFieldsMap = json_encode($aFieldsMap);
			$sState = $this->GetState();
			$oP->add_script(
				<<<EOF
				// Create the object once at the beginning of the page...
				var oWizardHelper$sPrefix = new WizardHelper('$sClass', '$sPrefix', '$sState');
				oWizardHelper$sPrefix.SetFieldsMap($sJsonFieldsMap);
				oWizardHelper$sPrefix.SetFieldsCount($iFieldsCount);
EOF
			);
		} else {
			// Prepare form
			$sUITitle = Dict::Format($sUIPath.':PageTitle_Object_Class', $this->GetName(), $sClassLabel);
			$oP->SetBreadCrumbEntry($sUITitle, $sUITitle, '', '', 'fas fa-wrench', iTopWebPage::ENUM_BREADCRUMB_ENTRY_ICON_TYPE_CSS_CLASSES);
			$oP->set_title($sUITitle);

			$iTransactionId = utils::GetNewTransactionId();
			$oP->SetTransactionId($iTransactionId);
			$this->GetNewFormId('');

			$oP->SetContentLayout(PageContentFactory::MakeForObjectDetails($this, cmdbAbstractObject::ENUM_DISPLAY_MODE_VIEW));
			$oContentBlock = new UIContentBlock();
			$oP->AddUiBlock($oContentBlock);

			$oForm = FormUIBlockFactory::MakeStandard();
			$oContentBlock->AddSubBlock($oForm);

			$oForm->AddHtml($oAppContext->GetForForm())
				->AddSubBlock(InputUIBlockFactory::MakeForHidden('operation', $sNextOperation))
				->AddSubBlock(InputUIBlockFactory::MakeForHidden('class', $sClass))
				->AddSubBlock(InputUIBlockFactory::MakeForHidden('id', $id))
				->AddSubBlock(InputUIBlockFactory::MakeForHidden('transaction_id', $iTransactionId));

			$oToolbarButtons = ToolbarUIBlockFactory::MakeStandard(null);
			$oCancelButton = ButtonUIBlockFactory::MakeForCancel(Dict::S('UI:Button:Cancel'), 'cancel', 'cancel')->SetOnClickJsCode("BackToDetails('$sClass', '$id', '', '{null}');");
			$oCancelButton->AddCSSClasses(['action', 'cancel']);
			$oToolbarButtons->AddSubBlock($oCancelButton);
			$oApplyButton = ButtonUIBlockFactory::MakeForPrimaryAction(Dict::S('UI:Button:Apply'), null, null, true);
			$oApplyButton->AddCSSClass('action');
			$oToolbarButtons->AddSubBlock($oApplyButton);

			$oObjectDetails = ObjectFactory::MakeDetails($this);
			$oToolbarButtons->AddCSSClass('ibo-toolbar-top');
			$oObjectDetails->AddToolbarBlock($oToolbarButtons);

			$oForm->AddSubBlock($oObjectDetails);

			// Note: DisplayBareHeader is called before adding $oObjectDetails to the page, so it can inject HTML before it through $oPage.
			$oP->AddTabContainer(OBJECT_PROPERTIES_TAB, '', $oObjectDetails);
			$oP->SetCurrentTabContainer(OBJECT_PROPERTIES_TAB);
			$oP->SetCurrentTab(Dict::S($sUIPath));

			// Display action fields and action buttons
			$this->DisplayActionFieldsForOperationV3($oP, $oObjectDetails, $sOperation, $aDefault);

			$oP->add_ready_script(
				<<<EOF
				$(window).on('unload',function() { return OnUnload('$iTransactionId', '$sClass', $id) } );
EOF
			);

		}
	}

	/**
	 * Create common string for UI displays
	 *
	 * @param $sOperation
	 *
	 * @return string
	 */
	protected function MakeUIPath($sOperation) {
		$sClass = get_class($this);
		switch ($sOperation) {
			case 'findspace':
				return ('UI:IPManagement:Action:FindSpace:'.$sClass);

			case 'dofindspace':
				return ('UI:IPManagement:Action:DoFindSpace:'.$sClass);

			case 'listips':
				return ('UI:IPManagement:Action:ListIps:'.$sClass);

			case 'dolistips':
				return ('UI:IPManagement:Action:DoListIps:'.$sClass);

			case 'shrinkblock':
			case 'shrinksubnet':
			case 'doshrinkblock':
			case 'doshrinksubnet':
				return ('UI:IPManagement:Action:Shrink:'.$sClass);

			case 'splitblock':
			case 'splitsubnet':
			case 'dosplitblock':
			case 'dosplitsubnet':
				return ('UI:IPManagement:Action:Split:'.$sClass);

			case 'expandblock':
			case 'expandsubnet':
			case 'doexpandblock':
			case 'doexpandsubnet':
				return ('UI:IPManagement:Action:Expand:'.$sClass);

			case 'csvexportips':
				return ('UI:IPManagement:Action:CsvExportIps:'.$sClass);

			case 'docsvexportips':
				return ('UI:IPManagement:Action:DoCsvExportIps:'.$sClass);

			case 'docalculator':
				return ('UI:IPManagement:Action:DoCalculator:'.$sClass);

			case 'calculator':
				return ('UI:IPManagement:Action:Calculator:'.$sClass);

			case 'delegate':
				return ('UI:IPManagement:Action:Delegate:'.$sClass);

			case 'allocateip':
				return ('UI:IPManagement:Action:Allocate:'.$sClass);

			default:
				return ('');
		}
	}

	/**
	 * @param $sOperation
	 *
	 * @return string
	 */
	protected function DoCheckOperation($sOperation) {
		return '';
	}

	/**
	 * @param $sOperation
	 *
	 * @return string
	 */
	public function GetNextOperation($sOperation) {
		return '';
	}

	/**
	 * Set page titles.
	 *
	 * @param \iTopWebPage $oP
	 * @param $sUIPath
	 * @param bool $bIcon
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	public function SetPageTitles(iTopWebPage $oP, $sUIPath, $bIcon = true) {
		$sClassLabel = MetaModel::GetName(get_class($this));
		$oP->set_title(Dict::Format($sUIPath.':PageTitle_Object_Class', $this->GetName(), $sClassLabel));
		$oP->add("<div class=\"page_header teemip_page_header\">\n");
		$sIcon = '';
		if ($bIcon) {
			$sIcon = $this->GetIcon()."&nbsp;";
		}
		$oP->add("<h1>".$sIcon.Dict::Format($sUIPath.':Title_Class_Object', $sClassLabel,
				'<span class="hilite">'.$this->GetName().'</span>')."</h1>\n");
		$oP->add("</div>\n");
	}

	/**
	 * @param $sPrefix
	 *
	 * @return string
	 */
	protected function GetNewFormId($sPrefix) {
		self::$iGlobalFormId++;
		$this->m_iFormId = $sPrefix.self::$iGlobalFormId;

		return ($this->m_iFormId);
	}

	/**
	 * Remind main block attributes to user when performing resizing actions
	 *
	 * @param \iTopWebPage $oP
	 * @param $sOperation
	 * @param $iFormId
	 * @param $sPrefix
	 * @param $aDefault
	 *
	 * @return void
	 */
	protected function DisplayMainAttributesForOperation(iTopWebPage $oP, $sOperation, $iFormId, $sPrefix, $aDefault) {
	}

	/**
	 * Remind main block attributes to user when performing resizing actions - V >= 3.0
	 *
	 * @param \iTopWebPage $oP
	 * @param $oColumn
	 *
	 * @return void
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	protected function DisplayMainAttributesForOperationV3(iTopWebPage $oP, $oColumn) {
		$sClass = get_class($this);

		// Requestor - Allow change
		$sAttCode = 'requestor_id';
		$sLabel = MetaModel::GetLabel($sClass, $sAttCode);
		$iOrgId = $this->Get('org_id');
		$iRequestorId = $this->Get('requestor_id');
		$oPersonSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Person AS p WHERE p.org_id = :org_id"), array(), array('org_id' => $iOrgId));
		$sInputId = $this->m_iFormId.'_'.$sAttCode;
		$sHTML = "<select id=\"$sInputId\" name=\"attr_$sAttCode\">\n";
		if ($iRequestorId == 0) {
			$sHTML .= "<option selected='' value=0></option>\n";
		} else {
			$sHTML .= "<option value=0></option>\n";
		}
		while ($oPerson = $oPersonSet->Fetch()) {
			$iPersonKey = $oPerson->GetKey();
			$sPersonName = $oPerson->GetName();
			if ($iPersonKey == $iRequestorId) {
				$sHTML .= "<option selected='' value=\"$iPersonKey\">".$sPersonName."</option>\n";
			} else {
				$sHTML .= "<option value=\"$iPersonKey\">".$sPersonName."</option>\n";
			}
		}
		$sHTML .= "</select>";
		$val = $this->GetSimpleFieldForForm('AttributeExternalKey', 'requestor_id', $sLabel, $sHTML);
		$oColumn->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));
	}

	/**
	 * Display attributes associated to an operation
	 *
	 * @param \iTopWebPage $oP
	 * @param $sOperation
	 * @param $iFormId
	 * @param $aDefault
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	protected function DisplayActionFieldsForOperation(iTopWebPage $oP, $sOperation, $iFormId, $aDefault) {
	}

	/**
	 * Display attributes associated to operation - V >= 3.0
	 *
	 * @param \iTopWebPage $oP
	 * @param $oClassForm
	 * @param $sOperation
	 * @param $aDefault
	 *
	 * @return void
	 */
	protected function DisplayActionFieldsForOperationV3(iTopWebPage $oP, $oClassForm, $sOperation, $aDefault) {
	}

	/**
	 * @param \iTopWebPage $oP
	 * @param string $sTitle
	 *
	 * @throws \ApplicationException
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function DisplayBareTab(iTopWebPage $oP, $sTitle = '') {
		$sClass = get_class($this);
		if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.0', '<')) {
			// Display action menu
			$oSingletonFilter = new DBObjectSearch($sClass);
			$oSingletonFilter->AddCondition('id', $this->GetKey(), '=');
			$oBlock = new MenuBlock($oSingletonFilter, 'details', false);
			$oBlock->Display($oP, 'baretab');

			// Set titles
			$this->SetPageTitles($oP, $sTitle.$sClass);
		} else {
			// The object can be read - Process request now
			$sClassLabel = MetaModel::GetName($sClass);

			$oP->set_title(Dict::Format('UI:DetailsPageTitle', $this->GetRawName(), $sClassLabel)); // Set title will take care of the encoding
			$oP->SetContentLayout(PageContentFactory::MakeForObjectDetails($this, cmdbAbstractObject::ENUM_DISPLAY_MODE_VIEW));
			$oObjectDetails = ObjectFactory::MakeDetails($this);

			$aHeadersBlocks = $this->DisplayBareHeader($oP, false);
			if (false === empty($aHeadersBlocks['subtitle'])) {
				$oObjectDetails->AddSubTitleBlocks($aHeadersBlocks['subtitle']);
			}
			if (false === empty($aHeadersBlocks['toolbar'])) {
				$oObjectDetails->AddToolbarBlocks($aHeadersBlocks['toolbar']);
			}

			$oP->AddUiBlock($oObjectDetails);
			$oP->AddTabContainer(OBJECT_PROPERTIES_TAB, '', $oObjectDetails);
			$oP->SetCurrentTabContainer(OBJECT_PROPERTIES_TAB);
			$oP->SetCurrentTab(Dict::Format($sTitle.$sClass, '', ''));
		}
	}

	/**
	 * Create form content for a field that is an attribute in a class of object
	 *
	 * @param \iTopWebPage $oP
	 * @param $sPrefix
	 * @param $sClass
	 * @param $sAttCode
	 * @param $sLabel
	 * @param $sDisplayValue
	 * @param $iFlags
	 *
	 * @return string[]
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
	protected function GetClassFieldForForm(iTopWebPage $oP, $sPrefix, $sClass, $sAttCode, $sLabel, $sDisplayValue, $iFlags) {
		$oAttDef = MetaModel::GetAttributeDef($sClass, $sAttCode);
		$sAttDefClass = get_class($oAttDef);
		$sAttLabel = ($sLabel == '') ? MetaModel::GetLabel($sClass, $sAttCode) : $sLabel;
		$sComments = '';
		$sInfos = '';
		$sInputId = $this->m_iFormId.'_'.$sAttCode;
		$sInputType = '';
		$sValue = $sDisplayValue;
		$aArgs = array(
			'this' => $this,
			'formPrefix' => $sPrefix,
		);
		$sHTMLValue = "".self::GetFormElementForField($oP, $sClass, $sAttCode, $oAttDef, $sValue, $sDisplayValue, $sInputId, '', $iFlags, $aArgs, true, $sInputType).'';

		// Attribute description
		$sDescription = $oAttDef->GetDescription();
		$sDescriptionForHTMLTag = utils::HtmlEntities($sDescription);
		$sDescriptionHTMLTag = (empty($sDescriptionForHTMLTag) || $sDescription === $oAttDef->GetLabel()) ? '' : 'class="ibo-has-description" data-tooltip-content="'.$sDescriptionForHTMLTag.'"';
		$val = array(
			'label' => '<span '.$sDescriptionHTMLTag.' >'.$sAttLabel.'</span>',
			'value' => $sHTMLValue,
			'input_id' => $sInputId,
			'input_type' => $sInputType,
			'comments' => $sComments,
			'infos' => $sInfos,
		);

		// Add extra data for markup generation
		// - Attribute code and AttributeDef. class
		$val['attcode'] = $sAttCode;
		$val['atttype'] = $sAttDefClass;
		$val['attlabel'] = $sAttLabel;
		$val['attflags'] = OPT_ATT_NORMAL;
		$val['layout'] = Field::ENUM_FIELD_LAYOUT_SMALL;
		$val['value_raw'] = '';

		return $val;
	}

	/**
	 * Create form content for a simple field i.e. a field that is NOT an attribute in a class of object
	 *
	 * @param $sAttDefClass
	 * @param $sAttCode
	 * @param $sLabel
	 * @param $sHTMLValue
	 *
	 * @return array
	 */
	protected function GetSimpleFieldForForm($sAttDefClass, $sAttCode, $sLabel, $sHTMLValue) {
		$sAttLabel = $sLabel;
		$sComments = '';
		$sInfos = '';
		$sInputId = $this->m_iFormId.'_'.$sAttCode;
		$sInputType = '';
		$sDescriptionHTMLTag = '';
		$val = array(
			'label' => '<span '.$sDescriptionHTMLTag.' >'.$sAttLabel.'</span>',
			'value' => $sHTMLValue,
			'input_id' => $sInputId,
			'input_type' => $sInputType,
			'comments' => $sComments,
			'infos' => $sInfos,
		);

		// Add extra data for markup generation
		// - Attribute code and AttributeDef. class
		$val['attcode'] = $sAttCode;
		$val['atttype'] = $sAttDefClass;
		$val['attlabel'] = $sAttLabel;
		$val['attflags'] = OPT_ATT_NORMAL;
		$val['layout'] = Field::ENUM_FIELD_LAYOUT_SMALL;
		$val['value_raw'] = '';

		return $val;
	}

	/**
	 * Create display content for a field that is an attribute in a class of object
	 *
	 * @param $sClass
	 * @param $sAttCode
	 * @param $sStateAttCode
	 *
	 * @return array|null
	 * @throws \Exception
	 */
	protected function GetClassFieldForDisplay($sClass, $sAttCode, $sStateAttCode) {
		$oAttDef = MetaModel::GetAttributeDef($sClass, $sAttCode);
		$sAttDefClass = get_class($oAttDef);
		$val = $this->GetFieldAsHtml($sClass, $sAttCode, $sStateAttCode);

		// Add extra data for markup generation
		// - Attribute code and AttributeDef. class
		$val['attcode'] = $sAttCode;
		$val['atttype'] = $sAttDefClass;
		$val['attlabel'] = MetaModel::GetLabel($sClass, $sAttCode);
		$val['attflags'] = OPT_ATT_READONLY;

		// - How the field should be rendered
		$val['layout'] = Field::ENUM_FIELD_LAYOUT_SMALL;

		return $val;
	}

}
