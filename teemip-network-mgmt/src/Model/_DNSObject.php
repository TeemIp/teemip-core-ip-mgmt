<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\NetworkManagement\Model;

use cmdbAbstractObject;
use Dict;
use MetaModel;
use utils;
use WebPage;

class _DNSObject extends cmdbAbstractObject
{
	/**
	 * @param $sPrefix
	 *
	 * @return string
	 */
	public function GetNewFormId($sPrefix)
	{
		self::$iGlobalFormId++;
		$this->m_iFormId = $sPrefix.self::$iGlobalFormId;
		return ($this->m_iFormId);
	}

	/**
	 * Create common string for UI displays
	 *
	 *
	 * @param $sOperation
	 *
	 * @return string
	 */
	function MakeUIPath($sOperation)
	{
		$sClass = get_class($this);
		switch ($sOperation)
		{
			case 'delegate':
				return ('UI:IPManagement:Action:Delegate:'.$sClass);

			case 'allocateip':
				return ('UI:IPManagement:Action:Allocate:'.$sClass);
				
			default:
				return (':');
		}
	}

	/**
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
		$oP->set_title(Dict::Format($sUIPath.':PageTitle_Object_Class', $this->GetName(), $sClassLabel));
		$oP->add("<div class=\"page_header teemip_page_header\">\n");
		$sIcon = '';
		if ($bIcon) {
			$sIcon = $this->GetIcon()."&nbsp;";
		}
		$oP->add("<h1>".$sIcon.Dict::Format($sUIPath.':Title_Class_Object', $sClassLabel, $this->GetName())."</h1>\n");
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
		if ($CheckOperation != '') {
			// Found issues: explain and display block again
			// No search bar (2.5 standard)

			$sIssueDesc = Dict::Format($sUIPath.':'.$CheckOperation);
			cmdbAbstractObject::SetSessionMessage($sClass, $id, $sOperation, $sIssueDesc, 'error', 0, true /* must not exist */);
			$this->DisplayDetails($oP);

			return;
		}

		// Set page titles
		self::SetPageTitles($oP, $sUIPath, $this);

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
		return '';
	}

	/**
	 * @param $sOperation
	 */
	public function GetNextOperation($sOperation)
	{
		return '';
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

}
