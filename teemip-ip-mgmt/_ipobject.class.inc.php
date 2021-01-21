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

class _IPObject extends cmdbAbstractObject
{
	/**
	 * Provides attributes' parameters
	 *
	 * @param $sAttCode
	 */
	public function GetAttributeParams($sAttCode)
	{
	}

	protected function GetNewFormId($sPrefix)
	{
		self::$iGlobalFormId++;
		$this->m_iFormId = $sPrefix.self::$iGlobalFormId;
		return ($this->m_iFormId);
	}

	/**
	 * Create common string for UI displays
	 *
	 * @param $sOperation
	 *
	 * @return string
	 */
	protected function MakeUIPath($sOperation)
	{
		$sClass = get_class($this);
		switch ($sOperation)
		{
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
	 * Returns default value of an attribute
	 *
	 * @param $sAttribute
	 *
	 * @return mixed|string
	 * @throws \Exception
	 */
	public function GetDefaultValueAttribute($sAttribute)
	{
		$sClass = get_class($this);
		$aAllowedValues = MetaModel::GetAllowedValues_att($sClass, $sAttribute);
		if (!empty($aAllowedValues))
		{
			$aValues  = array_keys($aAllowedValues);
			return $aValues[0];
		}
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
	public function SetPageTitles(WebPage $oP, $sUIPath, $bIcon = true)
	{
		$sClassLabel = MetaModel::GetName(get_class($this));
		$oP->set_title(Dict::Format($sUIPath.'PageTitle_Object_Class', $this->GetName(), $sClassLabel));
		$oP->add("<div class=\"page_header teemip_page_header\">\n");
		$sIcon = '';
		if ($bIcon)
		{
			$sIcon = $this->GetIcon()."&nbsp;";
		}
		$oP->add("<h1>".$sIcon.Dict::Format($sUIPath.'Title_Class_Object', $sClassLabel, $this->GetName())."</h1>\n");
		$oP->add("</div>\n");
	}

	/**
	 * Displays choices related to operation.
	 *
	 * @param \WebPage $oP
	 * @param $oAppContext
	 * @param $sOperation
	 * @param array $aDefault
	 *
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	public function DisplayOperationForm(WebPage $oP, $oAppContext, $sOperation, $aDefault = array())
	{
		$id = $this->GetKey();
		$sClass = get_class($this);
		$sUIPath = $this->MakeUIPath($sOperation);

		// Make sure action can be performed
		$CheckOperation = $this->DoCheckOperation($sOperation);
		if ($CheckOperation != '')
		{
			// Found issues: explain and display block again
			// No search bar (2.5 standard)

			$sIssueDesc = Dict::Format($sUIPath.$CheckOperation);
			cmdbAbstractObject::SetSessionMessage($sClass, $id, $sOperation, $sIssueDesc, 'error', 0, true /* must not exist */);
			$this->DisplayDetails($oP);
			return;
		}

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
		$sFormAction= utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/ui.teemip-ip-mgmt.php";
		$oP->add("<form action=\"$sFormAction\" id=\"form_{$m_iFormId}\" enctype=\"multipart/form-data\" method=\"post\" onSubmit=\"return OnSubmit('form_{$m_iFormId}');\">\n");
		$oP->add_ready_script("$(window).unload(function() { OnUnload('$iTransactionId') } );\n");

		if (in_array($sOperation, array('shrinkblock', 'shrinksubnet', 'splitblock', 'splitsubnet', 'expandblock', 'expandsubnet')))
			//if (!in_array($sOperation, array('findspace', 'listips', 'csvexportips', 'calculator', 'delegate', 'undelegate', 'allocateip', 'unallocateip')))
		{
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
		$sNextOperation = $this->GetNextOperation($sOperation);
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

	}

	/**
	 * @param $sOperation
	 */
	protected function DoCheckOperation($sOperation)
	{
	}

	/**
	 * @param $sOperation
	 */
	public function GetNextOperation($sOperation)
	{
	}

	/**
	 * @param $oP
	 * @param $sOperation
	 * @param $m_iFormId
	 * @param $sPrefix
	 * @param $aDefault
	 */
	protected function DisplayMainAttributesForOperation(WebPage $oP, $sOperation, $m_iFormId, $sPrefix, $aDefault)
	{
	}

	/**
	 * @param $oP
	 * @param $aDefault
	 */
	protected function DisplayGlobalAttributesForOperation(WebPage $oP, $aDefault)
	{
	}

	/**
	 * Display global parameters associated to the object
	 *
	 * @param \WebPage $oP
	 * @param $aParameter
	 * @param array $aDefault
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \Exception
	 */
	protected function DisplayGlobalParametersInLocalModifyForm(WebPage $oP, $aParameter, $aDefault = array())
	{
		// Get Global config object
		$oIpConfig = IPConfig::GetGlobalIPConfig($this->Get('org_id'));
		$aDetails = array();

		// Display Parameter with option to be changed for the transaction
		foreach ($aParameter as $sParam)
		{
			$sInputId = $sParam;
			$oAttDef = MetaModel::GetAttributeDef('IPConfig', $sParam);
			$sValue = (array_key_exists($sParam, $aDefault)) ? $aDefault[$sParam] : $oIpConfig->Get($sParam);
			$sDisplayValue = $oIpConfig->GetEditValue($sParam);
			$iFlags = $oIpConfig->GetAttributeFlags($sParam);
			$aArgs = array('this' => $oIpConfig, 'formPrefix' => '');
			$sHTMLValue = "<span id=\"field_{$sInputId}\">".$oIpConfig->GetFormElementForField($oP, 'IPConfig', $sParam, $oAttDef, $sValue, $sDisplayValue, $sInputId, '', $iFlags, $aArgs).'</span>';
			$aDetails[] = array('label' => '<span title="'.$oAttDef->GetDescription().'">'.$oAttDef->GetLabel().'</span>', 'value' => $sHTMLValue);
		}

		$oP->Details($aDetails);
	}

	/**
	 * @param $oP
	 * @param $sOperation
	 * @param $m_iFormId
	 * @param $aDefault
	 */
	protected function DisplayActionFieldsForOperation(WebPage $oP, $sOperation, $m_iFormId, $aDefault)
	{
	}

	/**
	 * Perform actions when new object inserted in DB 
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	protected function OnInsert()
	{
		parent::OnInsert();
		
		if ($this->Get('status') == 'allocated')
		{
			$this->Set('allocation_date', time());
		}
	}
	
	/**
	 * Perform actions when new object updated in DB
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	protected function OnUpdate()
	{
		// Run standard checks first
		parent::OnUpdate();

		// Set allocation and released date as required
		$sStatus = $this->Get('status');
		$soriginalStatus = $this->GetOriginal('status');
		if (($sStatus == 'allocated') && ($soriginalStatus != 'allocated'))
		{
			$this->Set('allocation_date', time());
		}
		elseif (($sStatus== 'released') && ($soriginalStatus != 'released'))
		{
			$this->Set('release_date', time());
		}
	}
	 
}
