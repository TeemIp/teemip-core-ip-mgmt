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

/*******************
 * Global constants
 */
                 
define('IPV6_BLOCK_MIN_SIZE', 18446744073709551616);
define('IPV6_BLOCK_MIN_MASK', 'FFFF:FFFF:FFFF:FFFF:0000:0000:0000:0000');
define('IPV6_BLOCK_MAX_PREFIX', 1);
define('IPV6_BLOCK_MIN_PREFIX', 64);

define('IPV6_SUBNET_MAX_PREFIX', 64);
define('IPV6_SUBNET_MIN_PREFIX', 128);
define('IPV6_SUBNET_MASK', 'FFFF:FFFF:FFFF:FFFF:0000:0000:0000:0000');
define('IPV6_SUBNET_MAX_IPS_TO_LIST', 1024);

define('IPV6_MAX_BIT', 128);
define('IPV6_MAX_CHAR', 39);
define('IPV6_NIBBLE_NUMBER', 8);
define('IPV6_NIBBLE_MAX_CHAR', 4);
define('IPV6_NIBBLE_MAX_VALUE',65536); 
define('IPV6_MAX_NETWORKS', 65536);
define('IPV6_MAX_INTERFACES',18446744073709551616);

define('ALL_NODES_IP', '0000:0000:0000:0000:0000:0000:0000:0001');

/***************************************************************************
 * IPv6 Address Attribute - The actual value is stored in an ormIPv6 object 
 * IPv6 representations:
 * 	- Canonical - can: 00df:1234:0000:0000:0001:6a6b:e908:09a5 
 * 	- No leading zeros - nlz: df:1234:0:0:1:6a6b:e908:9a5
 * 	- Compressed - comp: df:1234::1:6a6b:e908:9a5   
 */

class AttributeIPv6Address extends AttributeString
{
	/**
	 * @param \DBObject|null $oHostObject
	 *
	 * @return mixed|\ormIPv6
	 */
	public function GetDefaultValue(DBObject $oHostObject = null)
	{
		return new ormIPv6;
	}

	/**
	 * @param $value
	 * @param null $oHostObj
	 *
	 * @return string
	 */
	public function GetEditValue($value, $oHostObj = null)
	{
		if (is_null($value) || ($value == ''))
		{
			return '::0';
		}
		else
		{
			/** @var \ormIPv6 $value */
			return $value->GetAsCompressed();
		}
	}

	/**
	 * 	Facilitate things: allow the user to Set the value from a string
	 *
	 * @param $proposedValue
	 * @param $oHostObj
	 *
	 * @return mixed|\ormIPv6|string
	 */
	public function MakeRealValue($proposedValue, $oHostObj)
	{
		if (!$proposedValue instanceof ormIPv6)
		{
			return new ormIPv6((string)$proposedValue);
		}
		return $proposedValue;
	}

	/**
	 * @param string $sPrefix
	 *
	 * @return array
	 */
	public function GetSQLExpressions($sPrefix = '')
	{
		if ($sPrefix == '')
		{
			$sPrefix = $this->GetCode();
		}
		$aColumns = array();
		// Note: to optimize things, the existence of the attribute is determined by the existence of one column with an empty suffix
		$aColumns[''] = $sPrefix.'_text';
		$aColumns['_text'] = $sPrefix.'_text';
		$aColumns['_high'] = $sPrefix.'_high';
		$aColumns['_low'] = $sPrefix.'_low';
		return $aColumns;
	}

	/**
	 * @param array $aCols
	 * @param string $sPrefix
	 *
	 * @return mixed|\ormIPv6
	 */
	public function FromSQLToValue($aCols, $sPrefix = '')
	{
		return new ormIPv6($aCols[$sPrefix]);
	}

	/**
	 * @param $value
	 *
	 * @return array
	 */
	public function GetSQLValues($value)
	{
		if ($value instanceOf ormIPv6)
		{
			$aValues = array();
			$aValues[$this->GetCode().'_text'] = $value->ToString();
			$aValues[$this->GetCode().'_high'] = new orm64bit($value->GetHighULong());
			$aValues[$this->GetCode().'_low'] = new orm64bit($value->GetLowULong());
		}
		else
		{
			$aValues = array();
			$aValues[$this->GetCode().'_text'] = '';
			$aValues[$this->GetCode().'_high'] = 0;
			$aValues[$this->GetCode().'_low'] = 0;
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
		$aColumns[$this->GetCode().'_text'] = 'CHAR(39)';
		$aColumns[$this->GetCode().'_high'] = 'BIGINT(20) UNSIGNED';
		$aColumns[$this->GetCode().'_low'] = 'BIGINT(20) UNSIGNED';
		return $aColumns;
	}

	/**
	 * @return array
	 */
	public function GetFilterDefinitions()
	{
		return array(
			$this->GetCode() => new FilterFromAttribute($this),
			$this->GetCode().'_text' => new FilterFromAttribute($this, '_text'),
			$this->GetCode().'_high' => new FilterFromAttribute($this, '_high'),
			$this->GetCode().'_low' => new FilterFromAttribute($this, '_low')
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
	 * @param string $value
	 * @param null $oHostObject
	 * @param bool $bLocalize
	 *
	 * @return string|string[]|null
	 */
	public function GetAsHTML($value, $oHostObject = null, $bLocalize = true)
	{
		if ($value instanceof ormIPv6)
		{
			$value = $value->GetAsCompressed();
		}
		return $value;
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
		if ($sValue instanceof ormIPv6)
		{
			$sValue = $sValue->ToString();
		}
		return $sValue;
	}

	/**
	 * @param string $value
	 * @param null $oHostObject
	 * @param bool $bLocalize
	 *
	 * @return mixed|string
	 */
	public function GetAsXML($value, $oHostObject = null, $bLocalize = true)
	{
		if ($value instanceof ormIPv6)
		{
			$value = $value->ToString();
		}
		return $value;
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
		if ($sValue instanceof ormIPv6)
		{
			$sValue = $sValue->ToString();
		}
		return $sValue;
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

		return "^($pattern1)$|^($pattern2)$|^($pattern3)$|^($pattern4)$|^($pattern5)$|^($pattern6)$|^($pattern7)$|^($pattern8)$|^($pattern9)$";
	}
}

/********************************************************************************
 * Class for handling IPv6 addresses and storing them in an AttributeIPv6Address 
 */

class ormIPv6 extends ormIP
{
	// String representation of the address, stored in canonical IPv6 format
	protected $sIPv6;
	// High order 64 bits of the address, stored as string in hexadecimal (without the 0x prefix)
	protected $sHigh;
	// Low order 64 bits of the address, stored as string in hexadecimal (without the 0x prefix)
	protected $sLow;
	// Array containing the 8 nibbles of the address in decimal format, in reverted order
	protected $aNibbles;

	/**
	 * ormIPv6 constructor.
	 *
	 * @param string $sIPv6
	 */
	public function __construct($sIPv6 = '0000:0000:0000:0000:0000:0000:0000:0000')
	{
		$this->sIPv6 = strtolower($this->Canonicalize($sIPv6));
		$this->ComputeHighPart();
		$this->ComputeLowPart();
		$this->ComputeNibbles();
	}

	/**
	 * Magic method called when casting to a string
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->ToString();
	}

	/**
	 * @return string
	 */
	public function ToString()
	{
		return $this->sIPv6;
	}

	/**
	 * @return mixed
	 */
	public function GetHighULong()
	{
		return $this->sHigh;
	}

	/**
	 * @return mixed
	 */
	public function GetLowULong()
	{
		return $this->sLow;
	}

	/**
	 * @return mixed
	 */
	public function GetNibbles()
	{
		return $this->aNibbles;
	}

	/**
	 * Computes the "High" part of the address from the canonicalized representation
	 */
	protected function ComputeHighPart()
	{
		// Just remove the colons and extract the 16 first characters
		$sHexa = str_replace(':', '', $this->sIPv6);
		$this->sHigh = strtolower(substr($sHexa, 0, 16));
	}

	/**
	 * Computes the "Low" part of the address from the canonicalized representation
	 */
	protected function ComputeLowPart()
	{
		// Just remove the colons and extract the 16 last characters
		$sHexa = str_replace(':', '', $this->sIPv6);
		$this->sLow = strtolower(substr($sHexa, 16, 16));
	}

	/**
	 * Chop IPv6 in 16 bits chunks - 8 nibbles of 4 char in reverted order
	 * Store in array with low order bits first
	 */
	protected function ComputeNibbles()
	{
		$aHexa = explode(':', $this->sIPv6);
		$aHexa = array_reverse($aHexa);
		$this->aNibbles = array();
		foreach ($aHexa as $sHexNumber)
		{
			$this->aNibbles[] = hexdec($sHexNumber);
		}
	}

	/**
	 * @return string
	 */
	public function GetAsCannonical()
	{
		return $this->sIPv6;
	}

	/**
	 * @return string
	 */
	public function GetAsNonLeadingZeros()
	{
		return $this->CanToNlz($this->sIPv6);
	}

	/**
	 * @return string|string[]|null
	 */
	public function GetAsCompressed()
	{
		return $this->CanToComp($this->sIPv6);
	}

	/**
	 * @param $sIPv6
	 *
	 * @return string|string[]
	 */
	protected function Canonicalize($sIPv6)
	{
		return $this->CompToCan($sIPv6);
	}

	/**
	 * Trim each of the 8 IPv6 fields of leading 0s
	 *
	 * @param $sIPv6
	 *
	 * @return string
	 */
	function CanToNlz($sIPv6)
	{
		$aIPv6 = explode(':', $sIPv6) ;
		$sNlzIp = '' ;
		$i = 1;
		foreach ($aIPv6 as $Field)
		{
			$Field = ltrim($Field, '0');
			if ($Field == '')
			{
				$sNlzIp .= '0';
			}
			else
			{
				$sNlzIp .= $Field;
			}
			if ($i++ < 8)
			{
				$sNlzIp .= ':';
			}
		}
		return $sNlzIp;
	}

	/**
	 * @param $sIPv6
	 *
	 * @return string|string[]|null
	 */
	function CanToComp($sIPv6)
	{
		$sIPv6 = $this->CanToNlz($sIPv6);
		$sIPv6 = $this->NlzToComp($sIPv6);
		return $sIPv6;
	}

	/**
	 * Add required 0s to each of the 8 IPv6 fields
	 * @param $sIPv6
	 *
	 * @return string
	 */
	function NlzToCan($sIPv6)
	{                                                  
		if (strlen($sIPv6) < IPV6_MAX_CHAR)
		{
			$aIPv6 = explode(':', $sIPv6) ;
			$sCanIp = '';
			$i = 1;
			foreach ($aIPv6 as $field)
			{
				$j = IPV6_NIBBLE_MAX_CHAR - strlen($field);
				if ($j > 0)
				{
					$field = str_repeat("0", $j).$field;
				}
				$sCanIp .= $field;
				if ($i++ < IPV6_NIBBLE_NUMBER)
				{
					$sCanIp .= ':';
				}
			}
			$sIPv6 = $sCanIp;
		}
		return $sIPv6;
	}

	/**
	 * @param $sIPv6
	 *
	 * @return string|string[]|null
	 */
	function NlzToComp($sIPv6)
	{
		// Check IP is not already compressed
		if (strpos($sIPv6, '::') !== false)
		{
			return $sIPv6;
		}
		
		$sWorkIp = ':'.$sIPv6.':';
		preg_match_all("/(:0)(:0)+/", $sWorkIp, $sZeros);
		if (count($sZeros[0]) > 0)
		{
			$sBestMatch = '';
			foreach ($sZeros[0] as $sZeros)
			{
				if (strlen($sZeros) > strlen($sBestMatch))
				{
					$sBestMatch = $sZeros;
				}
			}
			$sWorkIp = preg_replace('/'.$sBestMatch.'/', ':', $sWorkIp, 1);
		}
		$sIPv6 = preg_replace('/((^:)|(:$))/', '', $sWorkIp);
		$sIPv6 = preg_replace('/((^:)|(:$))/', '::', $sIPv6);
		if ($sIPv6 == '')
		{
			$sIPv6 = '::';
		}
	
		return $sIPv6;
	 }

	/**
	 * @param $sIPv6
	 *
	 * @return string|string[]
	 */
	function CompToCan($sIPv6)
	{
		$sIPv6 = $this->CompToNlz($sIPv6);
		$sIPv6 = $this->NlzToCan($sIPv6);
		return $sIPv6;
	}

	/**
	 * @param $sIPv6
	 *
	 * @return string|string[]
	 */
	function CompToNlz($sIPv6)
	{
		if (strpos($sIPv6, '::') !== false)
		{
			$sIPv6 = str_replace('::', str_repeat(':0', 8 - substr_count($sIPv6, ':')).':', $sIPv6);
		}
		if (strpos($sIPv6, ':') === 0)
		{
			$sIPv6 = '0'.$sIPv6;
		}
		return $sIPv6;
	}

	/**
	 * Convert a binary string IPv6 into a nlz format - to be debug !!
	 *
	 * @param $binIp
	 *
	 * @return string
	 */
	function BinToNlz($binIp)
	{
		$sIp = "";
		if (strlen($binIp) < 128)
		{
			$binIp = str_pad($binIp, 128, '0', STR_PAD_LEFT);
		}
		$binIp = str_split($binIp, "16");
		$i = 1;
		foreach ($binIp as $ifield)
		{
			$sField = base_convert($ifield, 2, 16);
			$sIp .= $sField;
			if ($i++ < 8)
			{
				$sIp .= ':';
			}
		}
		return $sIp;
	}

	/**
	 * Convert a compressed IPv6 into a binary string - to be debug !!
	 *
	 * @param $sIp
	 *
	 * @return string
	 */
	function CompToBin($sIp)
	{
		$binIp = '';
		$sIp = $this->CompToNlz($sIp);
		$sIp = explode(':', $sIp);
		foreach ($sIp as $sField)
		{
			$iField = base_convert($sField, 16, 2);
			$binIp .= str_pad($iField, 16, '0', STR_PAD_LEFT);
		}
		return $binIp;
	}

	/**
	 * @param \ormIP $oIp
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function IsBiggerOrEqual(ormIP $oIp)
	{
		if (get_class($this) != get_class($oIp))
		{
			throw new Exception('Cannot compare IPs of different sizes');
		}
		for ($i = (IPV6_NIBBLE_NUMBER - 1); $i >= 0; $i--)
		{
			if ($this->aNibbles[$i] > $oIp->GetNibbles()[$i])
			{
				return true;
			}
			else if ($this->aNibbles[$i] < $oIp->GetNibbles()[$i])
			{
				return false;
			}
		}
		return true;
	}

	/**
	 * @param \ormIP $oIp
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function IsBiggerStrict(ormIP $oIp)
	{
		if (get_class($this) != get_class($oIp))
		{
			throw new Exception('Cannot compare IPs of different sizes');
		} 
		for ($i = (IPV6_NIBBLE_NUMBER - 1); $i >= 0; $i--)
		{
			if ($this->aNibbles[$i] > $oIp->GetNibbles()[$i])
			{
				return true;
			}
			else if ($this->aNibbles[$i] < $oIp->GetNibbles()[$i])
			{
				return false;
			}
		}
		return false;
	}

	/**
	 * @param \ormIP $oIp
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function IsSmallerOrEqual(ormIP $oIp)
	{
		if (get_class($this) != get_class($oIp))
		{
			throw new Exception('Cannot compare IPs of different sizes');
		} 
		for ($i = (IPV6_NIBBLE_NUMBER - 1); $i >= 0; $i--)
		{
			if ($this->aNibbles[$i] < $oIp->GetNibbles()[$i])
			{
				return true;
			}
			else if ($this->aNibbles[$i] > $oIp->GetNibbles()[$i])
			{
				return false;
			}
		}
		return true;
	}

	/**
	 * @param \ormIP $oIp
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function IsSmallerStrict(ormIP $oIp)
	{
		if (get_class($this) != get_class($oIp))
		{
			throw new Exception('Cannot compare IPs of different sizes');
		} 
		for ($i = (IPV6_NIBBLE_NUMBER - 1); $i >= 0; $i--)
		{
			if ($this->aNibbles[$i] < $oIp->GetNibbles()[$i])
			{
				return true;
			}
			else if ($this->aNibbles[$i] > $oIp->GetNibbles()[$i])
			{
				return false;
			}
		}
		return false;
	}

	/**
	 * @param \ormIP $oIp
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function IsEqual(ormIP $oIp)
	{
		if (get_class($this) != get_class($oIp))
		{
			throw new Exception('Cannot compare IPs of different sizes');
		} 
		for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++)
		{
			if ($oIp->GetNibbles()[$i] != $this->aNibbles[$i])
			{
				return false;
			}
		}
		return true;
	}

	/**
	 * @param \ormIP $oIp
	 *
	 * @return \ormIPv6
	 * @throws \Exception
	 */
	public function BitwiseAnd(ormIP $oIp)
	{
		if (get_class($this) != get_class($oIp))
		{
			throw new Exception('Cannot apply bitwise operator to IPs of different sizes');
		}
		$aHexa = array(); 
		for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++)
		{
			$aHexa[$i] = dechex($this->aNibbles[$i] & $oIp->GetNibbles()[$i]);
		}
		$aHexa = array_reverse($aHexa);
		$sIPv6 = implode(":", $aHexa);
		return new ormIPv6($sIPv6);
	}

	/**
	 * @param \ormIP $oIp
	 *
	 * @return \ormIPv6
	 * @throws \Exception
	 */
	public function BitwiseOr(ormIP $oIp)
	{
		if (get_class($this) != get_class($oIp))
		{
			throw new Exception('Cannot apply bitwise operator to IPs of different sizes');
		}
		$aHexa = array(); 
		for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++)
		{
			$aHexa[$i] = dechex($this->aNibbles[$i] | $oIp->GetNibbles()[$i]);
		}
		$aHexa = array_reverse($aHexa);
		$sIPv6 = implode(":", $aHexa);
		return new ormIPv6($sIPv6);
	}

	/**
	 * @return \ormIPv6
	 */
	public function BitwiseNot()
	{
		$aHexa = array(); 
		for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++)
		{
			$sHexa = dechex(~$this->aNibbles[$i]);
			$aHexa[$i] = substr($sHexa, -4, 4);
		}
		$aHexa = array_reverse($aHexa);
		$sIPv6 = implode(":", $aHexa);
		return new ormIPv6($sIPv6);
	}

	/**
	 * @return \ormIPv6
	 */
	public function LeftShift()
	{
		$aNibbles = array();
		for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++)
		{
			$aNibbles[$i] = $this->aNibbles[$i] * 2;
		}
		for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++)
		{
			if ($aNibbles[$i] >= IPV6_NIBBLE_MAX_VALUE)
			{
				$aNibbles[$i] -= IPV6_NIBBLE_MAX_VALUE;
				if ($i < IPV6_NIBBLE_NUMBER - 1)
				{
					$aNibbles[$i + 1] += 1;
				}
			}
		}
		$aHexa = array(); 
		for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++)
		{
			$aHexa[$i] = dechex($aNibbles[$i]);
		}
		$aHexa = array_reverse($aHexa);
		$sIPv6 = implode(":", $aHexa);
		return new ormIPv6($sIPv6);
	}

	/**
	 * @return float|int
	 */
	public function IP2dec()
	{
		$iFirstHigh = hexdec($this->sHigh);
		$iFirstLow = hexdec($this->sLow);

		return ($iFirstHigh * IPV6_MAX_INTERFACES) + $iFirstLow  + 1;
	}

	/**
	 * @param \ormIP $oIp
	 *
	 * @return \ormIPv6
	 * @throws \Exception
	 */
	public function Add(ormIP $oIp)
	{
		if (get_class($this) != get_class($oIp))
		{
			throw new Exception('Cannot add 2 IPs of different classes');
		}
		$aAddNibbles = array();
		$iCarry = 0;
		for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++)
		{
			$aAddNibbles[$i] = $this->aNibbles[$i] + $oIp->GetNibbles()[$i] + $iCarry;
			if ($aAddNibbles[$i] >= IPV6_NIBBLE_MAX_VALUE)
			{
				$aAddNibbles[$i] -= IPV6_NIBBLE_MAX_VALUE;
				$iCarry = 1;
			}
			else
			{
				$iCarry = 0;
			}
			$aAddNibbles[$i] = dechex($aAddNibbles[$i]);
		}
		$aAddNibbles = array_reverse($aAddNibbles);
		$sIPv6 = implode(":", $aAddNibbles);

		return new ormIPv6($sIPv6);
	}

	/**
	 * @return \ormIPv6
	 */
	public function GetNextIp()
	{
		$aNextNibbles = $this->aNibbles;
		$aNextNibbles[0] += 1;
		$i = 0;
		$bCarryToPropagate = true;
		while ($bCarryToPropagate && ($i < IPV6_NIBBLE_NUMBER))
		{
			if ($aNextNibbles[$i] >= IPV6_NIBBLE_MAX_VALUE)
			{
				$aNextNibbles[$i] = 0;
				if (++$i < IPV6_NIBBLE_NUMBER)
				{
					$aNextNibbles[$i] += 1;
				}
			}
			else
			{
				$bCarryToPropagate = false;
			}
		}
		$aHexa = array(); 
		for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++)
		{
			$aHexa[$i] = dechex($aNextNibbles[$i]);
		}
		$aHexa = array_reverse($aHexa);
		$sIPv6 = implode(":", $aHexa);
		return new ormIPv6($sIPv6);
	}


	/**
	 * @return \ormIPv6
	 */
	public function GetPreviousIp()
	{
		$aPreviousNibbles = $this->aNibbles;
		$aPreviousNibbles[0] -= 1;
		$i = 0;
		$bCarryToPropagate = true;
		while ($bCarryToPropagate && ($i < IPV6_NIBBLE_NUMBER))
		{
			if ($aPreviousNibbles[$i] < 0)
			{
				$aPreviousNibbles[$i] = IPV6_NIBBLE_MAX_VALUE - 1;
				if (++$i < IPV6_NIBBLE_NUMBER)
				{
					$aPreviousNibbles[$i] -= 1;
				}
			}
			else
			{
				$bCarryToPropagate = false;
			}
		}
		$aHexa = array(); 
		for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++)
		{
			$aHexa[$i] = dechex($aPreviousNibbles[$i]);
		}
		$aHexa = array_reverse($aHexa);
		$sIPv6 = implode(":", $aHexa);
		return new ormIPv6($sIPv6);
	}

	/**
	 * @param \ormIP $oIp
	 *
	 * @return float|int
	 * @throws \Exception
	 */
	public function GetSizeInterval(ormIP $oIp)
	{
		if (get_class($this) != get_class($oIp))
		{
			throw new Exception('Cannot apply bitwise operator to IPs of different sizes');
		}
		if ($this->IsSmallerOrEqual($oIp))
		{
			$oIpHigh = $oIp;
			$oIpLow = $this;
		}
		else
		{
			$oIpHigh = $this;
			$oIpLow = $oIp;
		}
		$aHexa = array();
		$iCarry = 0; 
		for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++)
		{
			$aHexa[$i] = $oIpHigh->aNibbles[$i] - $oIpLow->aNibbles[$i] - $iCarry;
			if ($aHexa[$i] < 0)
			{
				$aHexa[$i] += IPV6_NIBBLE_MAX_VALUE + 1;
				$iCarry = 1; 
			}
			else
			{
				$iCarry = 0;
			}
			$aHexa[$i] = dechex($aHexa[$i]);
		}
		$aHexa = array_reverse($aHexa);
		$sIPv6 = implode(":", $aHexa);
		$oIPv6 = new ormIPv6($sIPv6);

		return hexdec($oIPv6->GetHighULong()) * IPV6_MAX_INTERFACES + hexdec($oIPv6->GetLowULong()) + 1;
	}
}

/**
 * This class is used *just* to fool CMDBSource::Quote so that is_string returns false
 * on the 64 bit value. The goal is to be able to generate an SQL query as the following:
 * INSERT INTO myTable (ip_address_text, ip_adress_high, ip_address_low) VALUES ('FFC0:0412:58EF:48DC:0804:5790:CA31:DE22', 0xFFC0041258EF48DC, 0x08045790CA31DE22)
 * instead of
 * INSERT INTO myTable (ip_address_text, ip_adress_high, ip_address_low) VALUES ('FFC0:0412:58EF:48DC:0804:5790:CA31:DE22', '0xFFC0041258EF48DC', '0x08045790CA31DE22')
 * 
 * Note: whenever you want to pass a literal 64-bit value to the ORM, encapsulate it into an orm64bit object to prevent
 * its transformation into a string
 *
 */
 
class orm64bit
{
	protected $sHexValue;
	
	/**
	 * Create an orm64bit object from a text string
	 * @param string $sHexValue The hexadecimal representation of the value, without the 0x prefix.
	 */
	public function __construct($sHexValue)
	{
		$this->sHexValue = $sHexValue;
	}
	
	/**
	 * Return the hexadecimal representation of the value
	 * (prefixed with 0x) suitable to be inserted in MySQL
	 */
	public function __toString()
	{
		return '0x'.$this->sHexValue;
	}
}
