<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

use TeemIp\TeemIp\Extension\Framework\Helper\IPUtils;

/*****************************************************************
 * Attribute that lists, like an enum, the functional ci classes:
 *   - that can be instanciated
 *   - that have an external key to an IPAddress or to an IPvnAddress (n = 4 or 6)
 */
class AttributeClassWithIP extends AttributeString
{
	public function GetAllowedValues($aArgs = array(), $sContains = '')
	{
		$oHostObj = null;
		$aValues = array();
		if (isset($aArgs['this'])) {
			$oHostObj = $aArgs['this'];
		} elseif (isset($aArgs['this->object()'])) {
			$oHostObj = $aArgs['this->object()'];
		}
		if ($oHostObj != null) {
			$iOrgId = $oHostObj->Get('org_id');

			$aCIClassesWithIp = IPUtils::GetListOfClassesWithIPs();
			foreach ($aCIClassesWithIp as $sCIClass => $sKey) {
				$oCISet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT FunctionalCI AS ci WHERE ci.org_id = :org_id AND ci.finalclass = :ciclass"), array(), array('org_id' => $iOrgId, 'ciclass' => $sCIClass));
				if ($oCISet->CountExceeds(0)) {
					$aValues[$sCIClass] = MetaModel::GetName($sCIClass);
				}
			}
		}

		return $aValues;
	}

	public function GetAsHTML($sValue, $oHostObject = null, $bLocalize = true)
	{
		if (empty($sValue)) {
			return '';
		}

		return MetaModel::GetName($sValue);
	}

	static public function GetFormFieldClass()
	{
		return '\\Combodo\\iTop\\Form\\Field\\SelectField';
	}

	public function MakeFormField(DBObject $oObject, $oFormField = null)
	{
		if ($oFormField === null) {
			// Later : We should check $this->Get('display_style') and create a Radio / Select / ... regarding its value
			$sFormFieldClass = static::GetFormFieldClass();
			$oFormField = new $sFormFieldClass($this->GetCode());
		}

		$oFormField->SetChoices($this->GetAllowedValues($oObject->ToArgsForQuery()));
		parent::MakeFormField($oObject, $oFormField);

		return $oFormField;
	}

}
