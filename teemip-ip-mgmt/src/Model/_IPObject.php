<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Model;

use cmdbAbstractObject;
use Combodo\iTop\Application\UI\Base\Component\Field\Field;
use Combodo\iTop\Application\UI\Base\Component\Form\FormUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Html\HtmlFactory;
use Combodo\iTop\Application\UI\Base\Component\Input\InputUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Component\Panel\PanelUIBlockFactory;
use Combodo\iTop\Application\UI\Base\Layout\Object\ObjectFactory;
use Combodo\iTop\Application\UI\Base\Layout\PageContent\PageContentFactory;
use DBObjectSearch;
use Dict;
use IPConfig;
use MenuBlock;
use MetaModel;
use utils;
use WebPage;

class _IPObject extends cmdbAbstractObject {
	/**
	 * Provides
	 * attributes'
	 * parameters
	 *
	 * @param $sAttCode
	 */
	public function GetAttributeParams($sAttCode) {
	}

	/**
	 * Returns
	 * default
	 * value
	 * of
	 * an
	 * attribute
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
	 * Displays
	 * choices
	 * related
	 * to
	 * operation.
	 *
	 * @param \WebPage $oP
	 * @param $oAppContext
	 * @param $sOperation
	 * @param array $aDefault
	 *
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	public function DisplayOperationForm(WebPage $oP, $oAppContext, $sOperation, $aDefault = array()) {
		$id = $this->GetKey();
		$sClass = get_class($this);
		$sClassLabel = MetaModel::GetName($sClass);
		$sUIPath = $this->MakeUIPath($sOperation);

		// Make sure action can be performed
		$CheckOperation = $this->DoCheckOperation($sOperation);
		if ($CheckOperation != '') {
			// Found issues: explain and display block again
			$sIssueDesc = Dict::Format($sUIPath.$CheckOperation);
			cmdbAbstractObject::SetSessionMessage($sClass, $id, $sOperation, $sIssueDesc, 'error', 0, true /* must not exist */);
			$this->DisplayDetails($oP);

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
			$oP->add("<form action=\"$sFormAction\" id=\"form_{$m_iFormId}\" enctype=\"multipart/form-data\" method=\"post\" onSubmit=\"return OnSubmit('form_{$m_iFormId}');\">\n");
			$oP->add_ready_script("$(window).unload(function() { OnUnload('$iTransactionId') } );\n");

			if (in_array($sOperation, array(
				'shrinkblock',
				'shrinksubnet',
				'splitblock',
				'splitsubnet',
				'expandblock',
				'expandsubnet',
			))) {
				// Display main tab
				$oP->AddTabContainer(OBJECT_PROPERTIES_TAB);
				$oP->SetCurrentTabContainer(OBJECT_PROPERTIES_TAB);

				// Display object attributes
				$this->DisplayMainAttributesForOperation($oP, $sOperation, $m_iFormId, $sPrefix, $aDefault);

				// Display tab for global parameters
				$this->DisplayGlobalAttributesForOperation($oP, $aDefault);

				$oP->SetCurrentTab('');
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
			$sClassIconUrl = MetaModel::GetClassIcon($sClass, false);
			$sTitle = Dict::Format($sUIPath.'Title_Class_Object', $sClassLabel, $this->GetName());

			$oP->set_title($sTitle);
			$oPanel = PanelUIBlockFactory::MakeForClass($sClass, $sTitle)->SetIcon($sClassIconUrl);
			$oP->AddUiBlock($oPanel);

			$oForm = FormUIBlockFactory::MakeStandard();
			$oPanel->AddMainBlock($oForm);

			$oForm->AddSubBlock(HtmlFactory::MakeParagraph(''))
				->AddHtml($oAppContext->GetForForm())
				->AddSubBlock(InputUIBlockFactory::MakeForHidden('operation', $sNextOperation))
				->AddSubBlock(InputUIBlockFactory::MakeForHidden('class', $sClass))
				->AddSubBlock(InputUIBlockFactory::MakeForHidden('id', $id));

			// Add transaction ID
			$iTransactionId = isset($aExtraParams['transaction_id']) ? $aExtraParams['transaction_id'] : utils::GetNewTransactionId();
			$oP->SetTransactionId($iTransactionId);
			$oForm->AddSubBlock(InputUIBlockFactory::MakeForHidden('transaction_id', $iTransactionId));

			// Display action fields and action buttons
			$this->DisplayActionFieldsForOperationV3($oP, $oForm, $sOperation, $aDefault);

			$oP->add_ready_script(
				<<<EOF
	$(window).on('unload',function() { return OnUnload('$iTransactionId', '$sClass', $id) } );
EOF
			);
		}
	}

	/**
	 * Create
	 * common
	 * string
	 * for
	 * UI
	 * displays
	 *
	 * @param $sOperation
	 *
	 * @return string
	 */
	protected function MakeUIPath($sOperation) {
		$sClass = get_class($this);
		switch ($sOperation) {
			case 'findspace':
				return ('UI:IPManagement:Action:FindSpace:'.$sClass.':');

			case 'dofindspace':
				return ('UI:IPManagement:Action:DoFindSpace:'.$sClass.':');

			case 'listips':
				return ('UI:IPManagement:Action:ListIps:'.$sClass.':');

			case 'dolistips':
				return ('UI:IPManagement:Action:DoListIps:'.$sClass.':');

			case 'shrinkblock':
			case 'shrinksubnet':
			case 'doshrinkblock':
			case 'doshrinksubnet':
				return ('UI:IPManagement:Action:Shrink:'.$sClass.':');

			case 'splitblock':
			case 'splitsubnet':
			case 'dosplitblock':
			case 'dosplitsubnet':
				return ('UI:IPManagement:Action:Split:'.$sClass.':');

			case 'expandblock':
			case 'expandsubnet':
			case 'doexpandblock':
			case 'doexpandsubnet':
				return ('UI:IPManagement:Action:Expand:'.$sClass.':');

			case 'csvexportips':
				return ('UI:IPManagement:Action:CsvExportIps:'.$sClass.':');

			case 'docsvexportips':
				return ('UI:IPManagement:Action:DoCsvExportIps:'.$sClass.':');

			case 'docalculator':
				return ('UI:IPManagement:Action:DoCalculator:'.$sClass.':');

			case 'calculator':
				return ('UI:IPManagement:Action:Calculator:'.$sClass.':');

			case 'delegate':
				return ('UI:IPManagement:Action:Delegate:'.$sClass.':');

			case 'allocateip':
				return ('UI:IPManagement:Action:Allocate:'.$sClass.':');

			default:
				return (':');
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

	/*
	 * Set page titles.
	 *
	 * @param \WebPage $oP
	 * @param $sUIPath
	 * @param bool $bIcon
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */

	public function SetPageTitles(WebPage $oP, $sUIPath, $bIcon = true) {
		$sClassLabel = MetaModel::GetName(get_class($this));
		$oP->set_title(Dict::Format($sUIPath.'PageTitle_Object_Class', $this->GetName(), $sClassLabel));
		$oP->add("<div class=\"page_header teemip_page_header\">\n");
		$sIcon = '';
		if ($bIcon) {
			$sIcon = $this->GetIcon()."&nbsp;";
		}
		$oP->add("<h1>".$sIcon.Dict::Format($sUIPath.'Title_Class_Object', $sClassLabel,
				'<span class="hilite">'.$this->GetName().'</span>')."</h1>\n");
		$oP->add("</div>\n");
	}

	protected function GetNewFormId($sPrefix) {
		self::$iGlobalFormId++;
		$this->m_iFormId = $sPrefix.self::$iGlobalFormId;

		return ($this->m_iFormId);
	}

	/**
	 * @param $oP
	 * @param $sOperation
	 * @param $m_iFormId
	 * @param $sPrefix
	 * @param $aDefault
	 */
	protected function DisplayMainAttributesForOperation(WebPage $oP, $sOperation, $m_iFormId, $sPrefix, $aDefault) {
	}

	/**
	 * @param $oP
	 * @param $aDefault
	 */
	protected function DisplayGlobalAttributesForOperation(WebPage $oP, $aDefault) {
	}

	/**
	 * @param $oP
	 * @param $sOperation
	 * @param $m_iFormId
	 * @param $aDefault
	 */
	protected function DisplayActionFieldsForOperation(WebPage $oP, $sOperation, $m_iFormId, $aDefault) {
	}

	/**
	 * @param $oClassForm
	 * @param $sOperation
	 * @param $aDefault
	 */
	protected function DisplayActionFieldsForOperationV3(WebPage $oP, $oClassForm, $sOperation, $aDefault) {
	}

	/**
	 * @param \WebPage $oP
	 *
	 * @throws \CoreException
	 */
	public function DisplayBareTab(WebPage $oP, $sTitle = '') {
		$sClass = get_class($this);
		if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.0', '<')) {
			// Display action menu
			$oSingletonFilter = new DBObjectSearch($sClass);
			$oSingletonFilter->AddCondition('id', $this->GetKey(), '=');
			$oBlock = new MenuBlock($oSingletonFilter, 'details', false);
			$oBlock->Display($oP, 'listspace');

			// Set titles
			$this->SetPageTitles($oP, $sTitle.$sClass.':');
		} else {
			// The object can be read - Process request now
			$sClassLabel = MetaModel::GetName($sClass);

			$oP->set_title(Dict::Format('UI:DetailsPageTitle', $this->GetRawName(), $sClassLabel)); // Set title will take care of the encoding
			$oP->SetContentLayout(PageContentFactory::MakeForObjectDetails($this, cmdbAbstractObject::ENUM_OBJECT_MODE_VIEW));
			$oObjectDetails = ObjectFactory::MakeDetails($this);

			// Note: DisplayBareHeader is called before adding $oObjectDetails to the page, so it can inject HTML before it through $oPage.
			/** @var \iTopWebPage $oPage */
			$aHeadersBlocks = $this->DisplayBareHeader($oP, false, cmdbAbstractObject::ENUM_OBJECT_MODE_VIEW);
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
	 * @param \WebPage $oP
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
	protected function GetClassFieldForForm(WebPage $oP, $sPrefix, $sClass, $sAttCode, $sLabel, $sDisplayValue, $iFlags) {
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
		$sHTMLValue = "".self::GetFormElementForField($oP, $sClass, $sAttCode, $oAttDef, $sValue, $sDisplayValue, $sInputId, '', $iFlags,
				$aArgs, true, $sInputType).'';

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
	 * Display
	 * global
	 * parameters
	 * associated
	 * to
	 * the
	 * object
	 *
	 * @param \WebPage $oP
	 * @param $aParameter
	 * @param array $aDefault
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \Exception
	 */
	protected function DisplayGlobalParametersInLocalModifyForm(WebPage $oP, $aParameter, $aDefault = array()) {
		// Get Global config object
		$oIpConfig = IPConfig::GetGlobalIPConfig($this->Get('org_id'));
		$aDetails = array();

		// Display Parameter with option to be changed for the transaction
		foreach ($aParameter as $sParam) {
			$sInputId = $sParam;
			$oAttDef = MetaModel::GetAttributeDef('IPConfig', $sParam);
			$sValue = (array_key_exists($sParam, $aDefault)) ? $aDefault[$sParam] : $oIpConfig->Get($sParam);
			$sDisplayValue = $oIpConfig->GetEditValue($sParam);
			$iFlags = $oIpConfig->GetAttributeFlags($sParam);
			$aArgs = array(
				'this' => $oIpConfig,
				'formPrefix' => '',
			);
			$sHTMLValue = "<span id=\"field_{$sInputId}\">".$oIpConfig->GetFormElementForField($oP, 'IPConfig', $sParam, $oAttDef, $sValue,
					$sDisplayValue, $sInputId, '', $iFlags, $aArgs).'</span>';
			$aDetails[] = array(
				'label' => '<span title="'.$oAttDef->GetDescription().'">'.$oAttDef->GetLabel().'</span>',
				'value' => $sHTMLValue,
			);
		}

		$oP->Details($aDetails);
	}

	/**
	 * Perform
	 * actions
	 * when
	 * new
	 * object
	 * inserted
	 * in
	 * DB
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	protected function OnInsert() {
		parent::OnInsert();

		if ($this->Get('status') == 'allocated') {
			$this->Set('allocation_date', time());
		}
	}

	/**
	 * Perform
	 * actions
	 * when
	 * new
	 * object
	 * updated
	 * in
	 * DB
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	protected function OnUpdate() {
		// Run standard checks first
		parent::OnUpdate();

		// Set allocation and released date as required
		$sStatus = $this->Get('status');
		$soriginalStatus = $this->GetOriginal('status');
		if (($sStatus == 'allocated') && ($soriginalStatus != 'allocated')) {
			$this->Set('allocation_date', time());
		} elseif (($sStatus == 'released') && ($soriginalStatus != 'released')) {
			$this->Set('release_date', time());
		}
	}
}
