<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

use TeemIp\TeemIp\Extension\Framework\Helper\IPUtils;

/*******************************************************************
 * Attribute that lists, like an enum, the external key attributes:
 *   - of a given class inherited from FunctionalCI
 *   - that point to an IPAddress or to an IPvnAddress (n = 4 or 6)
 */
class AttributeIPFieldInClass extends AttributeString
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
			$sThisClass = get_class($oHostObj);
			switch ($sThisClass) {
				case 'IPRequestAddressCreateV6':
					$sClass = 'IPv6Address';
					break;

				case 'IPRequestAddressCreateV4':
				default:
					$sClass = 'IPv4Address';
					break;
			}
			$sCiClass = $oHostObj->Get('ciclass');
			if ($sCiClass != '') {
				$aCIClassesWithIp = IPUtils::GetListOfClassesWithIPs();
				foreach ($aCIClassesWithIp[$sCiClass]['IPAddress'] as $sKey => $sAttribute) {
					$oAttDef = MetaModel::GetAttributeDef($sCiClass, $sAttribute);
					$aValues[$oAttDef->GetCode()] = $oAttDef->GetLabel();
				}
				foreach ($aCIClassesWithIp[$sCiClass][$sClass] as $sKey => $sAttribute) {
					$oAttDef = MetaModel::GetAttributeDef($sCiClass, $sAttribute);
					$aValues[$oAttDef->GetCode()] = $oAttDef->GetLabel();
				}
			}
		}

		return $aValues;
	}

	public function GetAsHTML($sValue, $oHostObject = null, $bLocalize = true)
	{
		if (empty($sValue) || is_null($oHostObject)) {
			return '';
		}
		$sCiClass = $oHostObject->Get('ciclass');
		$oAttDef = MetaModel::GetAttributeDef($sCiClass, $sValue);

		return $oAttDef->GetLabel();
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
