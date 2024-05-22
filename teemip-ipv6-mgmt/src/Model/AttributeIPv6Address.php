<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

use TeemIp\TeemIp\Extension\IPv6Management\Model\ormIPv6;

/***************************************************************************
 * IPv6 Address Attribute - The actual value is stored in an ormIPv6 object
 * IPv6 representations:
 *    - Canonical - can: 00df:1234:0000:0000:0001:6a6b:e908:09a5
 *    - No leading zeros - nlz: df:1234:0:0:1:6a6b:e908:9a5
 *    - Compressed - comp: df:1234::1:6a6b:e908:9a5
 */
class AttributeIPv6Address extends AttributeString
{
	/**
	 * @param \DBObject|null $oHostObject
	 *
	 * @return mixed|\TeemIp\TeemIp\Extension\IPv6Management\Model\ormIPv6
	 */
	public function GetDefaultValue(DBObject $oHostObject = null)
	{
		return new ormIPv6;
	}

	/**
	 * @param $sValue
	 * @param null $oHostObj
	 *
	 * @return string
	 */
	public function GetEditValue($sValue, $oHostObj = null)
	{
		if (is_null($sValue) || ($sValue == '')) {
			return '::0';
		} else {
			/** @var \TeemIp\TeemIp\Extension\IPv6Management\Model\ormIPv6 $sValue */
			return $sValue->GetAsCompressed();
		}
	}

	/**
	 *    Facilitate things: allow the user to Set the value from a string
	 *
	 * @param $proposedValue
	 * @param $oHostObj
	 *
	 * @return mixed|\TeemIp\TeemIp\Extension\IPv6Management\Model\ormIPv6|string
	 */
	public function MakeRealValue($proposedValue, $oHostObj)
	{
		if (!$proposedValue instanceof ormIPv6) {
			return new ormIPv6((string) $proposedValue);
		}

		return $proposedValue;
	}

	/**
	 * Parses a search string coming from user input
	 *
	 * @param ormIPv6 $sSearchString
	 *
	 * @return string
	 */
	public function ParseSearchString($sSearchString)
	{
		return $sSearchString->GetAsCompressed();
	}

	/**
	 * @param ormIPv6 $val1
	 * @param ormIPv6 $val2
	 *
	 * @return bool
	 */
	public function Equals($val1, $val2)
	{
		if (!($val1 instanceof ormIPv6)) {
			$val1 = new ormIPv6($val1);
		}
		if (!($val2 instanceof ormIPv6)) {
			$val2 = new ormIPv6($val2);
		}

		return $val1->Equals($val2);
	}

	/**
	 * @param string $sPrefix
	 *
	 * @return array
	 */
	public function GetSQLExpressions($sPrefix = '')
	{
		if ($sPrefix == '') {
			$sPrefix = $this->GetCode();
		}
		$aColumns = array();
		// Note: to optimize things, the existence of the attribute is determined by the existence of one column with an empty suffix
		$aColumns[''] = $sPrefix.'_comp';
		$aColumns['_text'] = $sPrefix.'_text';
		$aColumns['_comp'] = $sPrefix.'_comp';

		return $aColumns;
	}

	/**
	 * @param array $aCols
	 * @param string $sPrefix
	 *
	 * @return mixed|\TeemIp\TeemIp\Extension\IPv6Management\Model\ormIPv6
	 */
	public function FromSQLToValue($aCols, $sPrefix = '')
	{
		// IPv6 is fully defined by its canonical expression
		return new ormIPv6($aCols[$sPrefix.'_text']);
	}

	/**
	 * @param $value
	 *
	 * @return array
	 */
	public function GetSQLValues($value)
	{
		if ($value instanceof ormIPv6) {
			$aValues = array();
			$aValues[$this->GetCode().'_text'] = $value->GetAsCannonical();
			$aValues[$this->GetCode().'_comp'] = $value->GetAsCompressed();
		} else {
			$aValues = array();
			$aValues[$this->GetCode().'_text'] = '';
			$aValues[$this->GetCode().'_comp'] = '';
		}

		return $aValues;
	}

	/**
	 * @param bool $bFullSpec
	 *
	 * @return array
	 */
	public function GetSQLColumns($bFullSpec = false)
	{
		$aColumns = array();
		$aColumns[$this->GetCode().'_text'] = 'CHAR(39)'.CMDBSource::GetSqlStringColumnDefinition();
		$aColumns[$this->GetCode().'_comp'] = 'CHAR(39)'.CMDBSource::GetSqlStringColumnDefinition();

		return $aColumns;
	}

	/**
	 * @return array
	 */
	public function GetFilterDefinitions()
	{
		return array(
			$this->GetCode() => $this->GetCode(),
			$this->GetCode().'_text' => $this->GetCode(),
			$this->GetCode().'_comp' => $this->GetCode(),
		);
	}

	/**
	 * @return array
	 */
	public function GetBasicFilterOperators()
	{
		return array();
	}

	/**
	 * @return string
	 */
	public function GetBasicFilterLooseOperator()
	{
		return '=';
	}

	/**
	 * @param $sOpCode
	 * @param $value
	 *
	 * @return string
	 */
	public function GetBasicFilterSQLExpr($sOpCode, $value)
	{
		return 'true';
	}

	/**
	 * @param $sClassAlias
	 *
	 * @return string[]
	 */
	public function GetOrderBySQLExpressions($sClassAlias)
	{
		// Note: This is the responsibility of this function to place backticks around column aliases
		return array('`'.$sClassAlias.$this->GetCode().'_text`');
	}

	/**
	 * @param string $sValue
	 * @param null $oHostObject
	 * @param bool $bLocalize
	 *
	 * @return string|string[]|null
	 */
	public function GetAsHTML($sValue, $oHostObject = null, $bLocalize = true)
	{
		if ($sValue instanceof ormIPv6) {
			$sValue = $sValue->GetAsCompressed();
		}

		return $sValue;
	}

	/**
	 * @param string $sValue
	 * @param string $sSeparator
	 * @param string $sTextQualifier
	 * @param null $oHostObject
	 * @param bool $bLocalize
	 * @param bool $bConvertToPlainText
	 *
	 * @return string
	 */
	public function GetAsCSV($sValue, $sSeparator = ',', $sTextQualifier = '"', $oHostObject = null, $bLocalize = true, $bConvertToPlainText = false)
	{
		if ($sValue instanceof ormIPv6) {
			$sValue = $sValue->GetAsCompressed();
		}

		return $sValue;
	}

	/**
	 * @param string $sValue
	 * @param null $oHostObject
	 * @param bool $bLocalize
	 *
	 * @return mixed|string
	 */
	public function GetAsXML($sValue, $oHostObject = null, $bLocalize = true)
	{
		if ($sValue instanceof ormIPv6) {
			$sValue = $sValue->GetAsCompressed();
		}

		return $sValue;
	}

	/**
	 * @param string $sValue
	 * @param null $oHostObject
	 * @param bool $bLocalize
	 *
	 * @return string
	 */
	public function GetAsHTMLForHistory($sValue, $oHostObject = null, $bLocalize = true)
	{
		if ($sValue instanceof ormIPv6) {
			$sValue = $sValue->GetAsCompressed();
		}

		return $sValue;
	}

	/**
	 * @return array
	 */
	public function GetImportColumns()
	{
		$aColumns = array();
		$aColumns[$this->GetCode()] = 'CHAR(39)'.CMDBSource::GetSqlStringColumnDefinition();

		return $aColumns;
	}

	/**
	 * @param $aCols
	 * @param $sPrefix
	 * @return mixed|null
	 */
	public function FromImportToValue($aCols, $sPrefix = '')
	{
		return $aCols[$sPrefix];
	}

	/**
	 * @return mixed|string
	 */
	public function GetValidationPattern()
	{
		$pattern1 = '([A-Fa-f0-9]{1,4}:){7}[A-Fa-f0-9]{1,4}';
		$pattern2 = '::([A-Fa-f0-9]{1,4}:){0,5}[A-Fa-f0-9]{1,4}';
		$pattern3 = '[A-Fa-f0-9]{1,4}::([A-Fa-f0-9]{1,4}:){0,5}[A-Fa-f0-9]{1,4}';
		$pattern4 = '([A-Fa-f0-9]{1,4}:){2}:([A-Fa-f0-9]{1,4}:){0,4}[A-Fa-f0-9]{1,4}';
		$pattern5 = '([A-Fa-f0-9]{1,4}:){3}:([A-Fa-f0-9]{1,4}:){0,3}[A-Fa-f0-9]{1,4}';
		$pattern6 = '([A-Fa-f0-9]{1,4}:){4}:([A-Fa-f0-9]{1,4}:){0,2}[A-Fa-f0-9]{1,4}';
		$pattern7 = '([A-Fa-f0-9]{1,4}:){5}:([A-Fa-f0-9]{1,4}:){0,1}[A-Fa-f0-9]{1,4}';
		$pattern8 = '([A-Fa-f0-9]{1,4}:){6}:[A-Fa-f0-9]{1,4}';
		$pattern9 = '([A-Fa-f0-9]{1,4}:){1,6}:';
		$pattern10 = '::';

		return "^($pattern1)$|^($pattern2)$|^($pattern3)$|^($pattern4)$|^($pattern5)$|^($pattern6)$|^($pattern7)$|^($pattern8)$|^($pattern9)$|^($pattern10)$";
	}
}
