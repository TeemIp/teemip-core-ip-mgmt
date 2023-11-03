<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */


use Combodo\iTop\Application\UI\Base\Component\Dashlet\DashletContainer;
use Combodo\iTop\Application\UI\Base\Component\Dashlet\DashletFactory;
use Combodo\iTop\Application\UI\Base\Layout\UIContentBlock;

class DashletBadgeFiltered extends Dashlet
{
	/**
	 * @inheritdoc
	 */
	public function __construct($oModelReflection, $sId)
	{
		parent::__construct($oModelReflection, $sId);
		$this->aProperties['title'] = 'Contacts';
		$this->aProperties['query'] = 'SELECT Contact';
		$this->aCSSClasses[] = 'ibo-dashlet--is-inline';
		$this->aCSSClasses[] = 'ibo-dashlet-badge';
	}

	public function GetDBSearch($aExtraParams = array())
	{
		$sQuery = $this->aProperties['query'];
		if (isset($aExtraParams['query_params'])) {
			$aQueryParams = $aExtraParams['query_params'];
		} else {
			$aQueryParams = array();
		}

		return DBObjectSearch::FromOQL($sQuery, $aQueryParams);
	}

	/**
	 * @inheritdoc
	 *
	 * @throws \Exception
	 */
	public function Render($oPage, $bEditMode = false, $aExtraParams = array())
	{
		$oFilter = $this->GetDBSearch($aExtraParams);
		$sClass = $oFilter->GetClass();
		$sHyperlink = utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=search&filter=".$sFilter = rawurlencode($oFilter->serialize());
		$sClassIconUrl = MetaModel::GetClassIcon($sClass, false);
		$oSet = new CMDBObjectSet($oFilter);
		$iCount = $oSet->Count();
		$sTitle = Dict::S($this->aProperties['title']);
		$oBlock = DashletFactory::MakeForDashletBadge($sClassIconUrl, $sHyperlink, $iCount, $sTitle, null, null, array());

		$sId = 'block_'.$this->sId.($bEditMode ? '_edit' : '');
		$oHtml = new UIContentBlock($sId);
		$oHtml->AddCSSClass("display_block");
		$oHtml->AddSubBlock($oBlock);

		$oDashletContainer = new DashletContainer($this->sId, ['dashlet-content']);
		$oDashletContainer->AddSubBlock($oHtml);

		return $oDashletContainer;
	}

	/**
	 * @inheritdoc
	 *
	 * @throws \Exception
	 */
	public function GetPropertiesFields(DesignerForm $oForm)
	{
		$oField = new DesignerTextField('title', Dict::S('UI:DashletObjectList:Prop-Title'), $this->aProperties['title']);

		$oForm->AddField($oField);

		$oField = new DesignerLongTextField('query', Dict::S('UI:DashletObjectList:Prop-Query'), $this->aProperties['query']);
		$oField->SetMandatory();
		$oField->AddCSSClass("ibo-query-oql");
		$oField->AddCSSClass("ibo-is-code");
		$oForm->AddField($oField);
	}

	/**
	 * @inheritdoc
	 */
	static public function GetInfo()
	{
		return array(
			'label' => Dict::S('UI:DashletBadgeFiltered:Label'),
			'icon' => 'env-'.utils::GetCurrentEnvironment().'/teemip-framework/asset/img/icons8-badge-filtered-48.png',
			'description' => Dict::S('UI:DashletBadgeFiltered:Description'),
		);
	}
}

