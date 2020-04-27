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

define('MAX_NB_OF_IPS_TO_DISPLAY', 4096);

define('MAX_IPV4_VALUE', 4294967295);
define('IPV4_BLOCK_MIN_SIZE', 1);
define('IPV4_SUBNET_MAX_SIZE', 65536);
define('IPV4_SUBNET_MAX_PREFIX', 16);

define('ALL_ORGS', 65536);

define('ACTION_NONE', 0);
define('ACTION_SHRINK', 1);
define('ACTION_SPLIT', 2);
define('ACTION_EXPAND', 3);
define('ACTION_PARENT_BLOCK_IS_DELETED', 4);
define('ACTION_BLOCK_IS_DELETED', 5);

define('GLOBAL_CONFIG_DEFAULT_NAME', 'IP Settings');
define('DEFAULT_BLOCK_LOW_WATER_MARK', 60);
define('DEFAULT_BLOCK_HIGH_WATER_MARK', 80);
define('DEFAULT_SUBNET_LOW_WATER_MARK', 60);
define('DEFAULT_SUBNET_HIGH_WATER_MARK', 80);
define('DEFAULT_IPRANGE_LOW_WATER_MARK', 60);
define('DEFAULT_IPRANGE_HIGH_WATER_MARK', 80);

define('DEFAULT_MAX_FREE_SPACE_OFFERS', 10);
define('DEFAULT_MAX_FREE_IP_OFFERS', 10);
define('DEFAULT_MAX_FREE_IP_OFFERS_WITH_PING', 5);
define('DEFAULT_SUBNET_CREATE_MAX_OFFER', 10);

define('RED', "#cc3300");
define('YELLOW', "#ffff00");
define('GREEN', "#33ff00");

define('TIME_TO_WAIT_FOR_PING_LONG', 3);
define('TIME_TO_WAIT_FOR_PING_SHORT', 1);
define('NUMBER_OF_PINGS', 1);
define('FAIL_KEY_FOR_PING', '100%');

define('NETWORK_IP_CODE', 'Network IP');
define('NETWORK_IP_DESC', 'Subnet IP');
define('GATEWAY_IP_CODE', 'Gateway');
define('GATEWAY_IP_DESC', 'Gateway IP');
define('BROADCAST_IP_CODE', 'Broadcast');
define('BROADCAST_IP_DESC', 'Broadcast IP');

/*********************************************
 * Class for handling IPv4 and IPv6 addresses  
 */

abstract class ormIP
{
	abstract public function IsBiggerOrEqual(ormIP $oIp);
	
	abstract public function IsBiggerStrict(ormIP $oIp);

	abstract public function IsSmallerOrEqual(ormIP $oIp);

	abstract public function IsSmallerStrict(ormIP $oIp);

	abstract public function IsEqual(ormIP $oIp);

	abstract public function BitwiseAnd(ormIP $oIp);

	abstract public function BitwiseOr(ormIP $oIp);
	
	abstract public function BitwiseNot();
	
	abstract public function LeftShift();

	abstract public function IP2dec();

	abstract public function Add(ormIP $oIp);

	abstract public function GetNextIp();

	abstract public function GetPreviousIp();

	abstract public function GetSizeInterval(ormIP $oIp);
}

/**********************
 * Host Name Attribute
 */

class AttributeHostName extends AttributeString
{
	public function GetValidationPattern()
	{
		// By default, pattern matches RFC 1123 plus '_'
		// Factorize old regex and protect against backtracking
		//   Old regex: ^(\d|[a-z]|[A-Z]|_)(\d|[a-z]|[A-Z]|-|_)*$
		//   Right regex with atomic grouping: ^(? >\w[\w-]*)$ (no space between ? and >)
		//   Working regex:
		return('^(?=(\w[\w-]*))\1$');
	}
}

/************************
 * Domain Name Attribute
 */

class AttributeDomainName extends AttributeString
{
	public function GetValidationPattern()
	{
		// By default, pattern matches RFC 1123 plus '_'
		// Factorize old regex and protect against backtracking
		//   Old regex ^(\d|[a-z]|[A-Z]|-|_)+((\.(\d|[a-z]|[A-Z]|-|_)+)*)\.?$
		//   Right regex with atomic grouping: ^(? >\w[\w-]*(\.\w[\w-]*)*\.?)$ (no space between ? and >)
		//   Working regex: ^(?=(\w[\w-]*(\.\w[\w-]*)*\.?))\1$

		$sPattern = '^(?=(\w[\w-]*(\.\w[\w-]*)*\.?))\1$';
		$sAdditionalPattern = $this->GetOptional('validation_pattern', '');
		if (($sAdditionalPattern != '') && !(@preg_match($sAdditionalPattern, null) === false))
		{
			// $sAdditionalPattern exists and is valid. Include it in validation pattern
			$sPattern = '^'.$sAdditionalPattern.'$|'.$sPattern;
		}
		return $sPattern;
	}
}

/************************
 * Alias List Attribute
 */

class AttributeAliasList extends AttributeText
{
	public function GetValidationPattern()
	{
		// By default, pattern matches a domain name per line
		//   Right regex with atomic grouping: ^(? >(\w[\w-]*(\.\w[\w-]*)*\.?)+(((\R|\n)\w[\w-]*(\.\w[\w-]*)*\.?))*))$ (no space between ? and >)
		//   \R works for PHP preg_match while \n works for javascript
		//   Working regex:
		return('^(?=((\w[\w-]*(\.\w[\w-]*)*\.?)+(((\R|\n)(\w[\w-]*(\.\w[\w-]*)*\.?))*)))\1$');
	}	
}

/************************
 * MAC Address Attribute
 */

class AttributeMacAddress extends AttributeString
{
	public function MakeRealValue($proposedValue, $oHostObj)
	{
		// Translate input value in canonical format used for storage
		// Input value = hyphens (12-34-56-78-90-ab), dots (1234.5678.90ab) or colons (12:34:56:78:90:ab)
		// Canonical Format = colons
		if ($proposedValue != '')
		{
			if ($proposedValue[2] == '-')
			{
				return(strtr($proposedValue, '-', ':'));
			}
			if ($proposedValue[4] == '.')
			{
				$proposedValue = str_replace('.', '', $proposedValue);
				$sOutputMac = '';
				$j = 0;
				for ($i = 0; $i < 12; $i++)
				{
					$sOutputMac .= $proposedValue[$i];
					if (($i > 0) && (is_int(($i - 1)/2)) && ($j < 5))
					{
						$j++;
						$sOutputMac .= ':';
					}
				}
				return($sOutputMac);
			}
		}
		return ($proposedValue);
	}
	
	protected function GetMacAtFormat($sMac, $oHostObject)
	{
		// Return $sMac at format set by global parameters
		if (($sMac != '') && ($oHostObject != null))
		{
			/** @var \IPInterface $oHostObject */
			$sMacAddressOutputFormat = $oHostObject->GetAttributeParams($this->GetCode());
			switch($sMacAddressOutputFormat)
			{
				case 'hyphens':
					// Return hyphens format
					return(strtr($sMac, ':', '-'));
				
				case 'dots':
					// Return dots format
					$aMac = str_replace(':', '', $sMac);
					$sOutputMac = '';
					$j = 0;
					for ($i = 0; $i < 12; $i++)
					{
						$sOutputMac .= $aMac[$i];
						if (($i == 3) || ($i == 7))
						{
							$j++;
							$sOutputMac .= '.';
						}
					}
					return($sOutputMac);
				
				case 'colons':
				default:
				break;
			}
		}
		// Return default = registered = colons format
		return($sMac);
	}
	
	public function GetAsCSV($sValue, $sSeparator = ',', $sTextQualifier = '"', $oHostObject = null, $bLocalize = true, $bConvertToPlainText = false)
	{
		$sFrom = array("\r\n", $sTextQualifier);
		$sTo = array("\n", $sTextQualifier.$sTextQualifier);
		$sEscaped = str_replace($sFrom, $sTo, (string)$this->GetMacAtFormat($sValue, $oHostObject));
		return $sTextQualifier.$sEscaped.$sTextQualifier;
	}

	public function GetAsHTML($sValue, $oHostObject = null, $bLocalize = true)
	{
		return Str::pure2html((string)$this->GetMacAtFormat($sValue, $oHostObject));
	}

	public function GetAsXML($sValue, $oHostObject = null, $bLocalize = true)
	{
		// XML being used by programs, we return canonical value of MAC 
		return Str::pure2xml((string)$sValue);
	}

	public function GetEditValue($sAttCode, $oHostObject = null)
	{
		return (string)$this->GetMacAtFormat($sAttCode, $oHostObject);
	}
	
	public function GetValidationPattern()
	{
		// By default, all 3 official pattern (colons, hyphens, dots) are accepted as input
		return('^((\d|([a-f]|[A-F])){2}-){5}(\d|([a-f]|[A-F])){2}$|^((\d|([a-f]|[A-F])){4}.){2}(\d|([a-f]|[A-F])){4}$|^((\d|([a-f]|[A-F])){2}:){5}(\d|([a-f]|[A-F])){2}$');
	}
}

/**************************
 * IP Percentage Attribute
 */

class AttributeIPPercentage extends AttributeInteger
{
	public function GetAsHTML($sValue, $oHostObject = null, $bLocalize = true)
	{
		// Display attribute as bar graph. Value & colors are provided by object holding attribute. 
		$iWidth = 5; // Total width of the percentage bar graph, in em...
		if ($oHostObject != null)
		{
			/** @var \IPObject $oHostObject */
			$aParams = $oHostObject->GetAttributeParams($this->GetCode());
			$sValue = $aParams ['value'];
			$sColor = $aParams ['color'];
		}
		else
		{
			$sValue = 0;
			$sColor = GREEN;
		}
		$iValue = (int)$sValue;
		$iPercentWidth = ($iWidth * $iValue) / 100;
		return "<div style=\"width:{$iWidth}em;-moz-border-radius: 3px;-webkit-border-radius: 3px;border-radius: 3px;display:inline-block;border: 1px #ccc solid;\"><div style=\"width:{$iPercentWidth}em; display:inline-block;background-color:$sColor;\">&nbsp;</div></div>&nbsp;$sValue %";
	}

	public function GetAsCSV($sValue, $sSeparator = ',', $sTextQualifier = '"', $oHostObject = null, $bLocalize = true, $bConvertToPlainText = false)
	{
		if ($oHostObject != null)
		{
			/** @var \IPObject $oHostObject */
			$aParams = $oHostObject->GetAttributeParams($this->GetCode());
			$sValue = $aParams ['value'];
		}
		else
		{
			$sValue = 0;
		}
		//$sEscaped = (string)mylong2ip($sValue);
		$sEscaped = (string)$sValue;
		return $sTextQualifier.$sEscaped.$sTextQualifier;
	}
}

/**************************
 * Functions to handle IPs
 */

/**
 * @param $sIp
 *
 * @return int
 */
function myip2long($sIp)
{
	//return(($sIp == '255.255.255.255') ? MAX_IPV4_VALUE : ip2long($sIp)); // Doesn't work for IPs > 128.0.0.0
	//return(($sIp == '255.255.255.255') ? MAX_IPV4_VALUE : sprintf("%u", ip2long($sIp))); // OK so far...
	return (ip2long($sIp));
}

/**
 * @param $iIp
 *
 * @return string
 */
function mylong2ip($iIp)
{
	return(long2ip($iIp));
}

/******************************
 * Triggers related to IP classes
 *  . IPTriggerOnWaterMark 
 */

class IPTriggerOnWaterMark extends Trigger
{
	public static function Init()
	{
		$aParams = array
		(
			"category" => "bizmodel",
			"key_type" => "autoincrement",
			"name_attcode" => "description",
			"state_attcode" => "",
			"reconc_keys" => array(),
			"db_table" => "priv_trigger_onwatermark",
			"db_key_field" => "id",
			"db_finalclass_field" => "",
			"display_template" => "",
			"icon" => utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/images/ipbell.png',
		);
		MetaModel::Init_Params($aParams);
		MetaModel::Init_InheritAttributes();
		
		MetaModel::Init_AddAttribute(new AttributeExternalKey("org_id", array("targetclass"=>"Organization", "jointype"=>null, "allowed_values"=>null, "sql"=>"org_id", "is_null_allowed"=>false, "on_target_delete"=>DEL_MANUAL, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeExternalField("org_name", array("allowed_values"=>null, "extkey_attcode"=>'org_id', "target_attcode"=>'name')));
		MetaModel::Init_AddAttribute(new AttributeEnum("target_class", array("allowed_values"=>new ValueSetEnum('IPv4Subnet,IPv4Range,IPv6Subnet,IPv6Range'), "sql"=>"target_class", "default_value"=>"IPv4Subnet", "is_null_allowed"=>false, "depends_on"=>array())));
		MetaModel::Init_AddAttribute(new AttributeEnum("event", array("allowed_values"=>new ValueSetEnum('cross_high,cross_low'), "sql"=>"event", "default_value"=>"cross_high", "is_null_allowed"=>true, "depends_on"=>array())));
		
		// Display lists
		MetaModel::Init_SetZListItems('details', array('org_id', 'description', 'target_class', 'event', 'action_list')); // Attributes to be displayed for the complete details
		MetaModel::Init_SetZListItems('list', array('finalclass', 'target_class', 'description', 'event', 'org_id')); // Attributes to be displayed for a list
	}

	/**
	 * @param \DBObject $oObject
	 *
	 * @return bool
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function IsInScope(DBObject $oObject)
	{
		$sTargetClass = $this->Get('target_class');
		return  ($oObject instanceof $sTargetClass);
	}
}

/**
 * Class ReleaseIPsFromObsoleteCIs
 */
class ReleaseIPsFromObsoleteCIs implements iScheduledProcess
{
	const MODULE_CODE = 'teemip-ip-mgmt';
	const FUNCTION_CODE = 'ip_release_on_ci_status';
	const FUNCTION_SETTING_ENABLED = 'enabled';
	const FUNCTION_SETTING_DEBUG = 'debug';
	const FUNCTION_SETTING_PERIODICITY = 'periodicity';
	const FUNCTION_SETTING_STATUS_LIST = 'status_list';

	const DEFAULT_FUNCTION_SETTING_ENABLED = true;
	const DEFAULT_FUNCTION_SETTING_DEBUG = false;
	const DEFAULT_FUNCTION_SETTING_PERIODICITY = 3600;
	const DEFAULT_FUNCTION_SETTING_STATUS_LIST = array('obsolete');

	protected $aDefaultSettings = array();
	protected $bDebug;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->aDefaultSettings = array(static::FUNCTION_SETTING_ENABLED => static::DEFAULT_FUNCTION_SETTING_ENABLED,
			static::FUNCTION_SETTING_DEBUG => static::DEFAULT_FUNCTION_SETTING_DEBUG,
			static::FUNCTION_SETTING_PERIODICITY => static::DEFAULT_FUNCTION_SETTING_PERIODICITY,
			static::FUNCTION_SETTING_STATUS_LIST => static::DEFAULT_FUNCTION_SETTING_STATUS_LIST);
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $this->aDefaultSettings);
		$this->bDebug = (bool) $aFunctionSettings[static::FUNCTION_SETTING_DEBUG];
	}

	/**
	 * Gives the exact time at which the process must be run next time
	 *
	 * @return \DateTime
	 * @throws \Exception
	 */
	public function GetNextOccurrence()
	{
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $this->aDefaultSettings);
		$bEnabled = (bool) $aFunctionSettings[static::FUNCTION_SETTING_ENABLED];
		if (!$bEnabled)
		{
			$oRet = new DateTime();
			$oRet->modify('+86400 seconds');
		}
		else
		{
			$sPeriodicity = $aFunctionSettings[static::FUNCTION_SETTING_PERIODICITY];
			$oRet = new DateTime();
			$oRet->modify('+'.$sPeriodicity.' seconds');
		}
		return $oRet;
	}

	/**
	 * @inheritdoc
	 */
	public function Process($iUnixTimeLimit)
	{
		$aReport = array(
			'cichecked' => 0,
			'interfacechecked' => 0,
			'ipreleased' => 0,
			'lnkinterfaceipreleased' => 0,
		);

		CMDBObject::SetTrackInfo('Automatic - Background task to release IPs from obsolete CIs');
		CMDBObject::SetTrackOrigin('custom-extension');

		// Get list of organizations for which IPs are released when CIs are obsoleted
		$oOrgToCleanSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o JOIN IPConfig AS ic ON ic.org_id = o.id WHERE ic.ip_release_on_ci_obsolete = 'yes'"));
		if ($oOrgToCleanSet->Count() == 0)
		{
			$this->Trace('No organization has activated this feature. Exiting...');
			return '';
		}
		// Build list for OQL query
		$sOrgToCleanList = "";
		$i = 0;
		while($oOrg = $oOrgToCleanSet->Fetch())
		{
			if ($i++ == 0)
			{
				$sOrgToCleanList = "(".$oOrg->GetKey();
			}
			else
			{
				$sOrgToCleanList .= ", ".$oOrg->GetKey();
			}
		}
		$sOrgToCleanList .= ")";

		// 1st step: get list of status that trigger the release action
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $this->aDefaultSettings);
		$aStatusList = $aFunctionSettings[static::FUNCTION_SETTING_STATUS_LIST];
		$sStatusList = "";
		$i = 0;
		foreach($aStatusList as $sStatus)
		{
			if ($i++ == 0)
			{
				$sStatusList = "('$sStatus'";
			}
			else
			{
				$sStatusList .= ", '$sStatus'";
			}
		}
		$sStatusList .= ")";

		// 2nd step: check IPs allocated to obsolete CIs
		$aClassesWithIPs = IPAddress::GetListOfClassesWIthIP('leaf');
		if (empty($aClassesWithIPs))
		{
			$this->Trace('No CI has external keys toward IP Adddresses');
		}
		else
		{
			// Build list of final classes with external keys toward IP addresses
			$sClassesList = "";
			$i = 0;
			foreach ($aClassesWithIPs as $sClass => $sKey)
			{
				if ($i++ == 0)
				{
					$sClassesList = "('$sClass'";
				}
				else
				{
					$sClassesList .= ", '$sClass'";
				}
			}
			$sClassesList .= ")";

			// Retrieve concerned CIs
			$sOQL = "SELECT PhysicalDevice WHERE status IN $sStatusList AND finalclass IN $sClassesList AND org_id IN $sOrgToCleanList 
			         UNION 
			         SELECT VirtualDevice WHERE status IN $sStatusList AND finalclass IN $sClassesList AND org_id IN $sOrgToCleanList";
			$oCISet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL));
			while ((time() < $iUnixTimeLimit) && $oCI = $oCISet->Fetch())
			{
				try
				{
					$aReport['cichecked']++;

					// Release IPs attached to the CI
					$sClass = get_class($oCI);
					$aIPAttributes = array_merge($aClassesWithIPs[$sClass]['IPAddress'], $aClassesWithIPs[$sClass]['IPv4Address'], $aClassesWithIPs[$sClass]['IPv6Address']);
					foreach ($aIPAttributes AS $key => $sIPAttribute)
					{
						$iIPAddress = $oCI->Get($sIPAttribute);
						if ($iIPAddress > 0)
						{
							// Remove IP from CI
							$oCI->Set($sIPAttribute, '');
							$oCI->DBUpdate();

							// Release IP
							$oIPAddress = MetaModel::GetObject('IPAddress', $iIPAddress, false /* MustBeFound */);
							if (!is_null($oIPAddress))
							{
								$oIPAddress->Set('status', 'released');
								$oIPAddress->Set('release_date', time());
								$oIPAddress->DBUpdate();

								$aReport['ipreleased']++;
							}
						}
					}
				}
				catch(Exception $e)
				{
					$this->Trace('Skipping CI check as there was an exception! ('.$e->getMessage().')');
				}
			}
		}

		// 3rd step: check IPs allocated to interfaces attached to CIs
		if(class_exists('LogicalInterface'))
		{
			$sOQL = "SELECT PhysicalInterface AS p JOIN ConnectableCI AS c ON p.connectableci_id = c.id WHERE c.status IN $sStatusList AND c.org_id IN $sOrgToCleanList 
			         UNION 
			         SELECT LogicalInterface AS l JOIN VirtualMachine AS v ON l.virtualmachine_id = v.id WHERE v.status IN $sStatusList AND v.org_id IN $sOrgToCleanList";
		}
		else
		{
			$sOQL = "SELECT PhysicalInterface AS p JOIN ConnectableCI AS c ON p.connectableci_id = c.id WHERE c.status IN $sStatusList AND c.org_id IN $sOrgToCleanList";
		}
		$oInterfaceSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL));
		while ((time() < $iUnixTimeLimit) && $oInterface = $oInterfaceSet->Fetch())
		{
			try
			{
				$aReport['interfacechecked']++;

				$iIpInterfaceId = $oInterface->GetKey();
				$oIpInterfaceLnkList = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT lnkIPInterfaceToIPAddress AS l WHERE l.ipinterface_id = :ipinterface_id"), array(), array('ipinterface_id' => $iIpInterfaceId));
				while ($oIpInterfaceLnk = $oIpInterfaceLnkList->fetch())
				{
					// Release IPs attached to the interface
					$iIPAddress = $oIpInterfaceLnk->Get('ipaddress_id');
					if ($iIPAddress > 0)
					{
						// Release IP
						$oIPAddress = MetaModel::GetObject('IPAddress', $iIPAddress, false /* MustBeFound */);
						if (!is_null($oIPAddress))
						{
							$oIPAddress->Set('status', 'released');
							$oIPAddress->Set('release_date', time());
							$oIPAddress->DBUpdate();

							$aReport['ipreleased']++;
						}
					}

					// Delete link
					$oIpInterfaceLnk->DBDelete();
					$aReport['lnkinterfaceipreleased']++;
				}
			}
			catch(Exception $e)
			{
				$this->Trace('Skipping Interface check as there was an exception! ('.$e->getMessage().')');
			}
		}

		// Info to help understand why not all objects have been processed during this batch.
		if (time() >= $iUnixTimeLimit)
		{
			$this->Trace('Stopped because time limit exceeded!');
		}

		// Report
		$sReport = ($aReport['cichecked'] === 0) ? "\nNo CI to process\n" : "\n".$aReport['cichecked']." CIs have been checked.\n";
		$sReport .= ($aReport['interfacechecked'] === 0) ? "No Interface to process\n" : $aReport['interfacechecked']." Interfaces have been checked.\n";
		$sReport .= $aReport['ipreleased']." IPs have been released.\n";
		$sReport .= $aReport['lnkinterfaceipreleased']." link IP Address / Interface have been released.";
		return $sReport;
	}

	/**
	 * Prints a $sMessage in the CRON output.
	 *
	 * @param string $sMessage
	 */
	protected function Trace($sMessage)
	{
		if ($this->bDebug)
		{
			echo $sMessage."\n";
		}
	}
}

/**
 * Class AllocateIPsToProductionCIs
 */
class AllocateIPsToProductionCIs implements iScheduledProcess
{
	const MODULE_CODE = 'teemip-ip-mgmt';
	const FUNCTION_CODE = 'ip_allocate_on_ci_status';
	const FUNCTION_SETTING_ENABLED = 'enabled';
	const FUNCTION_SETTING_DEBUG = 'debug';
	const FUNCTION_SETTING_PERIODICITY = 'periodicity';
	const FUNCTION_SETTING_STATUS_LIST = 'status_list';

	const DEFAULT_FUNCTION_SETTING_ENABLED = true;
	const DEFAULT_FUNCTION_SETTING_DEBUG = false;
	const DEFAULT_FUNCTION_SETTING_PERIODICITY = 3600;
	const DEFAULT_FUNCTION_SETTING_STATUS_LIST = array('implementation', 'production');

	protected $aDefaultSettings = array();
	protected $bDebug;

	/**
	 * Constructor.
	 */
	public function __construct()
	{
		$this->aDefaultSettings = array(static::FUNCTION_SETTING_ENABLED => static::DEFAULT_FUNCTION_SETTING_ENABLED,
			static::FUNCTION_SETTING_DEBUG => static::DEFAULT_FUNCTION_SETTING_DEBUG,
			static::FUNCTION_SETTING_PERIODICITY => static::DEFAULT_FUNCTION_SETTING_PERIODICITY,
			static::FUNCTION_SETTING_STATUS_LIST => static::DEFAULT_FUNCTION_SETTING_STATUS_LIST);
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $this->aDefaultSettings);
		$this->bDebug = (bool) $aFunctionSettings[static::FUNCTION_SETTING_DEBUG];
	}

	/**
	 * Gives the exact time at which the process must be run next time
	 *
	 * @return \DateTime
	 * @throws \Exception
	 */
	public function GetNextOccurrence()
	{
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $this->aDefaultSettings);
		$bEnabled = (bool) $aFunctionSettings[static::FUNCTION_SETTING_ENABLED];
		if (!$bEnabled)
		{
			$oRet = new DateTime();
			$oRet->modify('+86400 seconds');
		}
		else
		{
			$sPeriodicity = $aFunctionSettings[static::FUNCTION_SETTING_PERIODICITY];
			$oRet = new DateTime();
			$oRet->modify('+'.$sPeriodicity.' seconds');
		}
		return $oRet;
	}

	/**
	 * @inheritdoc
	 */
	public function Process($iUnixTimeLimit)
	{
		$aReport = array(
			'ipchecked' => 0,
		);

		CMDBObject::SetTrackInfo('Automatic - Background task to allcoate IPs to production CIs');
		CMDBObject::SetTrackOrigin('custom-extension');

		// Get list of organizations for which IPs are allocated when attached to production CIs
		$oOrgToCleanSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o JOIN IPConfig AS ic ON ic.org_id = o.id WHERE ic.ip_allocate_on_ci_production = 'yes'"));
		if ($oOrgToCleanSet->Count() == 0)
		{
			$this->Trace('No organization has activated this feature. Exiting...');
			return '';
		}
		// Build list for OQL query
		$sOrgToCleanList = "";
		$i = 0;
		while($oOrg = $oOrgToCleanSet->Fetch())
		{
			if ($i++ == 0)
			{
				$sOrgToCleanList = "(".$oOrg->GetKey();
			}
			else
			{
				$sOrgToCleanList .= ", ".$oOrg->GetKey();
			}
		}
		$sOrgToCleanList .= ")";

		// 1st step: get list of status that trigger the release action
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $this->aDefaultSettings);
		$aStatusList = $aFunctionSettings[static::FUNCTION_SETTING_STATUS_LIST];
		$sStatusList = "";
		$i = 0;
		foreach($aStatusList as $sStatus)
		{
			if ($i++ == 0)
			{
				$sStatusList = "('$sStatus'";
			}
			else
			{
				$sStatusList .= ", '$sStatus'";
			}
		}
		$sStatusList .= ")";

		// 2nd step: check IPs attached to production CIs with non allocated status
		$aClassesWithIPs = IPAddress::GetListOfClassesWIthIP('leaf');
		if (empty($aClassesWithIPs))
		{
			$this->Trace('No CI has external keys toward IP Adddresses');
		}
		else
		{
			// Retrieve and correct IPs attached to production CIs and that have wrong status
			foreach($aClassesWithIPs as $sClass => $sKey)
			{
				$aIPAttributes = array_merge($aClassesWithIPs[$sClass]['IPAddress'],
					$aClassesWithIPs[$sClass]['IPv4Address'], $aClassesWithIPs[$sClass]['IPv6Address']);
				$sOQL = "";
				$i = 0;
				foreach($aIPAttributes as $sAttribute)
				{
					$sOQLi = "SELECT IPAddress AS ip JOIN $sClass AS ci ON ci.$sAttribute = ip.id WHERE ip.status != 'allocated' AND ci.status IN $sStatusList AND ci.org_id IN $sOrgToCleanList";
					if ($i++ == 0)
					{
						$sOQL = $sOQLi;
					}
					else
					{
						$sOQL .= " UNION ".$sOQLi;
					}
				}

				// Correct IP status
				$oIPAddressSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL));
				while ((time() < $iUnixTimeLimit) && $oIPAddress = $oIPAddressSet->Fetch())
				{
					try
					{
						$aReport['ipchecked']++;

						$oIPAddress->Set('status', 'allocated');
						$oIPAddress->Set('allocation_date', time());
						$oIPAddress->DBUpdate();
					} catch (Exception $e)
					{
						$this->Trace('Skipping IP check as there was an exception! ('.$e->getMessage().')');
					}
				}
			}
		}

		// 3rd step: check IPs attached to interfaces with non allocated status
		if(class_exists('LogicalInterface'))
		{
			$sOQL = "SELECT IPAddress AS ip JOIN lnkIPInterfaceToIPAddress AS lnk ON lnk.ipaddress_id = ip.id JOIN PhysicalInterface AS p ON lnk.ipinterface_id = p.id JOIN ConnectableCI AS c ON p.connectableci_id = c.id WHERE c.status IN $sStatusList AND c.org_id IN $sOrgToCleanList AND ip.status != 'allocated' 
		             UNION 
		             SELECT IPAddress AS ip JOIN lnkIPInterfaceToIPAddress AS lnk ON lnk.ipaddress_id = ip.id JOIN LogicalInterface AS l ON lnk.ipinterface_id = l.id JOIN VirtualMachine AS v ON l.virtualmachine_id = v.id WHERE v.status IN $sStatusList AND v.org_id IN $sOrgToCleanList AND ip.status != 'allocated'";
		}
		else
		{
			$sOQL = "SELECT IPAddress AS ip JOIN lnkIPInterfaceToIPAddress AS lnk ON lnk.ipaddress_id = ip.id JOIN PhysicalInterface AS p ON lnk.ipinterface_id = p.id JOIN ConnectableCI AS c ON p.connectableci_id = c.id WHERE c.status IN $sStatusList AND c.org_id IN $sOrgToCleanList AND ip.status != 'allocated'";
		}

		// Correct IP status
		$oIPAddressSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL));
		while ((time() < $iUnixTimeLimit) && $oIPAddress = $oIPAddressSet->Fetch())
		{
			try
			{
				$aReport['ipchecked']++;

				$oIPAddress->Set('status', 'allocated');
				$oIPAddress->Set('allocation_date', time());
				$oIPAddress->DBUpdate();
			}
			catch(Exception $e)
			{
				$this->Trace('Skipping IP check as there was an exception! ('.$e->getMessage().')');
			}
		}

		// Info to help understand why not all objects have been processed during this batch.
		if (time() >= $iUnixTimeLimit)
		{
			$this->Trace('Stopped because time limit exceeded!');
		}

		// Report
		$sReport = ($aReport['ipchecked'] === 0) ? "\nNo IP have been corrected\n" : "\n".$aReport['ipchecked']." IPs have been corrected.\n";
		return $sReport;
	}

	/**
	 * Prints a $sMessage in the CRON output.
	 *
	 * @param string $sMessage
	 */
	protected function Trace($sMessage)
	{
		if ($this->bDebug)
		{
			echo $sMessage."\n";
		}
	}
}

/***********************************
 * Plugin to extend the Popup Menus
 */

class IPMgmtExtraMenus implements iPopupMenuExtension
{
	/**
	 * @param int $iMenuId
	 * @param mixed $param
	 *
	 * @return array|object[]
	 * @throws \CoreException
	 * @throws \Exception
	 */
	public static function EnumItems($iMenuId, $param)
	{
		$aResult = array();
		switch($iMenuId)
		{
			case iPopupMenuExtension::MENU_OBJLIST_ACTIONS:	// $param is a DBObjectSet
				$oSet = $param;
				if (!$oSet->CountExceeds(1))
				{
					// Menu for single objects only
					$sClass = $oSet->GetClass();

					// Additional actions for IPBlocks
					if (($sClass == 'IPv4Block') || ($sClass == 'IPv6Block'))
					{
						/** @var \IPBlock $oObj */
						$oObj = $oSet->Fetch();
						$operation = utils::ReadParam('operation', '');

						// Unique org is selected as we have a single object
						$id = $oObj->GetKey();
						$iBlockSize = $oObj->GetSize();

						$oAppContext = new ApplicationContext();
						$aParams = $oAppContext->GetAsHash();
						$aParams['class'] = $sClass;
						$aParams['id'] = $id;
						$aParams['filter'] = $param->GetFilter()->serialize();
						switch ($operation)
						{
							case 'displaytree':
								if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
								{
									$aResult[] = new SeparatorPopupMenuItem();

									if ($oObj->IsDelegated())
									{
										$aParams['operation'] = 'undelegate';
										$sMenu = 'UI:IPManagement:Action:Undelegate:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
											utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									}
									else
									{
										$aParams['operation'] = 'delegate';
										$sMenu = 'UI:IPManagement:Action:Delegate:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
											utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									}

									$aResult[] = new SeparatorPopupMenuItem();
									if ($iBlockSize > 1)
									{
										$aResult[] = new SeparatorPopupMenuItem();
										$aParams['operation'] = 'shrinkblock';
										$sMenu = 'UI:IPManagement:Action:Shrink:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
											utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php',
												$aParams));

										$aParams['operation'] = 'splitblock';
										$sMenu = 'UI:IPManagement:Action:Split:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
											utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php',
												$aParams));
									}
									$aParams['operation'] = 'expandblock';
									$sMenu = 'UI:IPManagement:Action:Expand:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
										utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									$aResult[] = new SeparatorPopupMenuItem();

									$aParams['operation'] = 'listspace';
									$sMenu = 'UI:IPManagement:Action:ListSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
										utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

									if ($iBlockSize > 1)
									{
										$aParams['operation'] = 'findspace';
										$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
											utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php',
												$aParams));
									}
								}
								else
								{
									$aResult[] = new SeparatorPopupMenuItem();
									$aParams['operation'] = 'listspace';
									$sMenu = 'UI:IPManagement:Action:ListSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
										utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
								break;

							case 'displaylist':
							default:
								if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
								{
									$aResult[] = new SeparatorPopupMenuItem();

									if ($oObj->IsDelegated())
									{
										$aParams['operation'] = 'undelegate';
										$sMenu = 'UI:IPManagement:Action:Undelegate:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
											utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									}
									else
									{
										$aParams['operation'] = 'delegate';
										$sMenu = 'UI:IPManagement:Action:Delegate:'.$sClass;
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
											utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									}

									$aResult[] = new SeparatorPopupMenuItem();
									$aParams['operation'] = 'shrinkblock';
									$sMenu = 'UI:IPManagement:Action:Shrink:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
										utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

									$aParams['operation'] = 'splitblock';
									$sMenu = 'UI:IPManagement:Action:Split:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
										utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

									$aParams['operation'] = 'expandblock';
									$sMenu = 'UI:IPManagement:Action:Expand:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
										utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									$aResult[] = new SeparatorPopupMenuItem();

									$aParams['operation'] = 'listspace';
									$sMenu = 'UI:IPManagement:Action:ListSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
										utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

									$aParams['operation'] = 'findspace';
									$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
										utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
								else
								{
									$aResult[] = new SeparatorPopupMenuItem();
									$aParams['operation'] = 'listspace';
									$sMenu = 'UI:IPManagement:Action:ListSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu),
										utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
								break;
						}
					}
					// Additional actions for IPSubnets
					elseif (($sClass == 'IPv4Subnet') || ($sClass == 'IPv6Subnet'))
					{
						/** @var \IPSubnet $oObj */
						$oObj = $oSet->Fetch();

						// Unique org is selected as we have a single object
						$id = $oObj->GetKey();

						$oAppContext = new ApplicationContext();
						$aParams = $oAppContext->GetAsHash();
						$aParams['class'] = $sClass;
						$aParams['id'] = $id;
						$aParams['filter'] = $param->GetFilter()->serialize();
						// Additional actions for IPv4Subnets
						if ($sClass == 'IPv4Subnet')
						{
							if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
							{
								$aResult[] = new SeparatorPopupMenuItem();
								$aParams['operation'] = 'shrinksubnet';
								$sMenu = 'UI:IPManagement:Action:Shrink:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

								$aParams['operation'] = 'splitsubnet';
								$sMenu = 'UI:IPManagement:Action:Split:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

								$aParams['operation'] = 'expandsubnet';
								$sMenu = 'UI:IPManagement:Action:Expand:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								$aResult[] = new SeparatorPopupMenuItem();

								$aParams['operation'] = 'listips';
								$sMenu = 'UI:IPManagement:Action:ListIps:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								$aParams['operation'] = 'findspace';
								$sMenu = 'UI:IPManagement:Action:FindSpace:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

								$aParams['operation'] = 'csvexportips';
								$sMenu = 'UI:IPManagement:Action:CsvExportIps:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
							else
							{
								$aResult[] = new SeparatorPopupMenuItem();

								$aParams['operation'] = 'listips';
								$sMenu = 'UI:IPManagement:Action:ListIps:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

								$aParams['operation'] = 'csvexportips';
								$sMenu = 'UI:IPManagement:Action:CsvExportIps:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
						}
						// Additional actions for IPv6Subnets
						elseif ($sClass == 'IPv6Subnet')
						{
							$operation = utils::ReadParam('operation', '');

							// Unique org is selected as we have a single object
							$id = $oObj->GetKey();
							$sBitMask = $oObj->Get('mask');

							if ($sBitMask == '128')
							{
								break;
							}
							$oAppContext = new ApplicationContext();
							$aParams = $oAppContext->GetAsHash();
							$aParams['class'] = $sClass;
							$aParams['id'] = $id;
							$aParams['filter'] = $param->GetFilter()->serialize();
							switch ($operation)
							{
								case 'displaytree':
								case 'displaylist':
								default:
									if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
									{
										$aResult[] = new SeparatorPopupMenuItem();

										$aParams['operation'] = 'listips';
										$sMenu = 'UI:IPManagement:Action:ListIps:IPv6Subnet';
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

										$aParams['operation'] = 'findspace';
										$sMenu = 'UI:IPManagement:Action:FindSpace:IPv6Subnet';
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

										$aParams['operation'] = 'csvexportips';
										$sMenu = 'UI:IPManagement:Action:CsvExportIps:IPv6Subnet';
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									}
									else
									{
										$aResult[] = new SeparatorPopupMenuItem();

										$aParams['operation'] = 'listips';
										$sMenu = 'UI:IPManagement:Action:ListIps:IPv6Subnet';
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));

										$aParams['operation'] = 'csvexportips';
										$sMenu = 'UI:IPManagement:Action:CsvExportIps:IPv6Subnet';
										$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									}
									break;
							}
						}
					}
					// Additional actions for IPAddress
					elseif (($sClass == 'IPv4Address') || ($sClass == 'IPv6Address'))
					{
						if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
						{
							/** @var \IPAddress $oObj */
							$oObj = $oSet->Fetch();

							// Unique org is selected as we have a single object
							$id = $oObj->GetKey();
							$sStatus = $oObj->Get('status');

							$oAppContext = new ApplicationContext();
							$aParams = $oAppContext->GetAsHash();
							$aParams['class'] = $sClass;
							$aParams['id'] = $id;
							$aParams['filter'] = $param->GetFilter()->serialize();

							switch ($sStatus)
							{
								case 'allocated':
									$aResult[] = new SeparatorPopupMenuItem();
									$aParams['operation'] = 'unallocateip';
									$sMenu = 'UI:IPManagement:Action:UnAllocateIP:IPAddress';
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									break;

								case 'reserved':
								case 'released':
								case 'unassigned':
									$aResult[] = new SeparatorPopupMenuItem();
									$aParams['operation'] = 'allocateip';
									$sMenu = 'UI:IPManagement:Action:AllocateIP:IPaddress';
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
									break;

								default:
									break;
							}
						}
					}
					// Additional actions for Domain
					elseif ($sClass == 'Domain')
					{
						if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
						{
							/** @var \Domain $oObj */
							$oObj = $oSet->Fetch();

							// Unique org is selected as we have a single object
							$id = $oObj->GetKey();

							$oAppContext = new ApplicationContext();
							$aParams = $oAppContext->GetAsHash();
							$aParams['class'] = $sClass;
							$aParams['id'] = $id;
							$aResult[] = new SeparatorPopupMenuItem();

							if ($oObj->IsDelegated())
							{
								$aParams['operation'] = 'undelegate';
								$sMenu = 'UI:IPManagement:Action:Undelegate:Domain';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
							else
							{
								$aParams['operation'] = 'delegate';
								$sMenu = 'UI:IPManagement:Action:Delegate:Domain';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
						}
					}
				}
			break;
			
			case iPopupMenuExtension::MENU_OBJLIST_TOOLKIT: // $param is a DBObjectSet
				$oSet = $param;
				$sClass = $oSet->GetClass();

				// Additional actions for IPBlocks
				if (($sClass == 'IPv4Block') || ($sClass == 'IPv6Block'))
				{
					$operation = utils::ReadParam('operation', '');

					$oAppContext = new ApplicationContext();
					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['filter'] = $param->GetFilter()->serialize();
					switch ($operation)
					{
						case 'displaytree':
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaylist';
							$sMenu = 'UI:IPManagement:Action:DisplayList:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
						break;
										
						case 'displaylist':
						default:
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaytree';
							$sMenu = 'UI:IPManagement:Action:DisplayTree:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
						break;
					}
				}
				// Additional actions for IPSubnets
				elseif (($sClass == 'IPv4Subnet') || ($sClass == 'IPv6Subnet'))
				{
					$operation = utils::ReadParam('operation', '');

					$oAppContext = new ApplicationContext();
					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['filter'] = $param->GetFilter()->serialize();
					switch ($operation)
					{
						case 'displaytree':
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaylist';
							$sMenu = 'UI:IPManagement:Action:DisplayList:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
						break;
						
						case 'docalculator':
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaylist';
							$sMenu = 'UI:IPManagement:Action:DisplayList:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							$aParams['operation'] = 'displaytree';
							$sMenu = 'UI:IPManagement:Action:DisplayTree:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
						break;
										
						case 'displaylist':
						default:
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaytree';
							$sMenu = 'UI:IPManagement:Action:DisplayTree:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
						break;
					}
					$aResult[] = new SeparatorPopupMenuItem();
					$aParams['operation'] = 'calculator';
					$sMenu = 'UI:IPManagement:Action:Calculator:'.$sClass;
					$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
				}
				// Additional actions for Domain
				elseif ($sClass == 'Domain')
				{
					$operation = utils::ReadParam('operation', '');

					$oAppContext = new ApplicationContext();
					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['filter'] = $param->GetFilter()->serialize();
					switch ($operation)
					{
						case 'displaytree':
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaylist';
							$sMenu = 'UI:IPManagement:Action:DisplayList:Domain';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
						break;
										
						case 'displaylist':
						default:
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'displaytree';
							$sMenu = 'UI:IPManagement:Action:DisplayTree:Domain';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
						break;
					}
				}
			break;
			
			case iPopupMenuExtension::MENU_OBJDETAILS_ACTIONS: // $param is a DBObject
				$oObj = $param;

				// Additional actions for IPBlocks
				if ($oObj instanceof IPBlock)
				{
					$oAppContext = new ApplicationContext();
					$sContext = $oAppContext->GetForLink();

					$id = $oObj->GetKey();
					$iBlockSize = $oObj->GetSize();
					$sClass = get_class($oObj);
					
					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['id'] = $id;
					if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
					{
						if (($sClass == 'IPv4Block') && ($iBlockSize == 1))
						{
							$aResult[] = new SeparatorPopupMenuItem();

							if ($oObj->IsDelegated())
							{
								$aParams['operation'] = 'undelegate';
								$sMenu = 'UI:IPManagement:Action:Undelegate:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
							else
							{
								$aParams['operation'] = 'delegate';
								$sMenu = 'UI:IPManagement:Action:Delegate:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
										
							$aResult[] = new SeparatorPopupMenuItem();								
							$aParams['operation'] = 'expandblock';
							$sMenu = 'UI:IPManagement:Action:Expand:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							$aResult[] = new SeparatorPopupMenuItem();
						}
						else
						{
							$aResult[] = new SeparatorPopupMenuItem();

							if ($oObj->IsDelegated())
							{
								$aParams['operation'] = 'undelegate';
								$sMenu = 'UI:IPManagement:Action:Undelegate:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
							else
							{
								$aParams['operation'] = 'delegate';
								$sMenu = 'UI:IPManagement:Action:Delegate:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
										
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'shrinkblock';
							$sMenu = 'UI:IPManagement:Action:Shrink:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							
							$aParams['operation'] = 'splitblock';
							$sMenu = 'UI:IPManagement:Action:Split:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							
							$aParams['operation'] = 'expandblock';
							$sMenu = 'UI:IPManagement:Action:Expand:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							$aResult[] = new SeparatorPopupMenuItem();
						}
					}
					$operation = utils::ReadParam('operation', '');
					switch ($operation)
					{
						case 'apply_new':
						case 'apply_modify':
						case 'details':
							$aParams['operation'] = 'listspace';
							$sMenu = 'UI:IPManagement:Action:ListSpace:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
							{
								if ($iBlockSize > 1)
								{
									$aParams['operation'] = 'findspace';
									$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
							}
						break;
						
						case 'listspace':
							if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
							{
								$aParams['operation'] = 'findspace';
								$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
							$aResult[] = new URLPopupMenuItem('UI:IPManagement:Action:Details:'.$sClass, Dict::S('UI:IPManagement:Action:Details:'.$sClass), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
						break;
						
						case 'dofindspace':
							$aParams['operation'] = 'listspace';
							$sMenu = 'UI:IPManagement:Action:ListSpace:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
							{
								$aParams['operation'] = 'findspace';
								$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
							$aResult[] = new URLPopupMenuItem('UI:IPManagement:Action:Details:'.$sClass, Dict::S('UI:IPManagement:Action:Details:'.$sClass), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
						break;
						
						default:
						break;
					}
				}
				// Additional actions for IPSubnets
				else if ($oObj instanceof IPSubnet)
				{
					$oAppContext = new ApplicationContext();
					$sContext = $oAppContext->GetForLink();
					
					$id = $oObj->GetKey();
					$sClass = get_class($oObj);

					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['id'] = $id;
					$bSingleIPSubnet = false;
					if ($oObj instanceof IPv4Subnet)
					{
						$sBitMask = $oObj->Get('mask');
						if ($sBitMask == '255.255.255.255')
						{
							$bSingleIPSubnet = true;
						}
						if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
						{
							$aResult[] = new SeparatorPopupMenuItem();
							if (!$bSingleIPSubnet)
							{
								$aParams['operation'] = 'shrinksubnet';
								$sMenu = 'UI:IPManagement:Action:Shrink:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
	
								$aParams['operation'] = 'splitsubnet';
								$sMenu = 'UI:IPManagement:Action:Split:IPv4Subnet';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							}
										
							$aParams['operation'] = 'expandsubnet';
							$sMenu = 'UI:IPManagement:Action:Expand:IPv4Subnet';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							$aResult[] = new SeparatorPopupMenuItem();
						}
					}
					elseif ($oObj instanceof IPv6Subnet)
					{
						$sBitMask = $oObj->Get('mask');
						if ($sBitMask == '128')
						{
							$bSingleIPSubnet = true;
						}
						elseif (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
						{
							$aResult[] = new SeparatorPopupMenuItem();
						}
					}
					else
					{
						return array();
					}
					
					if (!$bSingleIPSubnet)
					{
						$operation = utils::ReadParam('operation', '');
						switch ($operation)
						{
							case 'apply_new':
							case 'apply_modify':
							case 'details':
								$aParams['operation'] = 'listips';
								$sMenu = 'UI:IPManagement:Action:ListIps:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
								{
									$aParams['operation'] = 'findspace';
									$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
								$aParams['operation'] = 'csvexportips';
								$sMenu = 'UI:IPManagement:Action:CsvExportIps:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;
							
							case 'listips':
								if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
								{
									$aParams['operation'] = 'findspace';
									$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
								$aResult[] = new URLPopupMenuItem('UI:IPManagement:Action:Details:'.$sClass, Dict::S('UI:IPManagement:Action:Details:'.$sClass), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
								$aParams['operation'] = 'csvexportips';
								$sMenu = 'UI:IPManagement:Action:CsvExportIps:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;
							
							case 'dofindspace':
							case 'docalculator':
							case 'dolistips':
							case 'docsvexportips':
								$aParams['operation'] = 'listips';
								$sMenu = 'UI:IPManagement:Action:ListIps:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
								{
									$aParams['operation'] = 'findspace';
									$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
								$sMenu = 'UI:IPManagement:Action:Details:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
								$aParams['operation'] = 'csvexportips';
								$sMenu = 'UI:IPManagement:Action:CsvExportIps:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;
							
							case 'csvexportips':
								$aParams['operation'] = 'listips';
								$sMenu = 'UI:IPManagement:Action:ListIps:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
								{
									$aParams['operation'] = 'findspace';
									$sMenu = 'UI:IPManagement:Action:FindSpace:'.$sClass;
									$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								}
								$sMenu = 'UI:IPManagement:Action:Details:'.$sClass;
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
							break;
							
							default:
							break;
						}
					}
					$aResult[] = new SeparatorPopupMenuItem();
					$aParams['operation'] = 'calculator';
					$sMenu = 'UI:IPManagement:Action:Calculator:'.$sClass;
					$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
				}
				// Additional actions for IPRange
				else if ($oObj instanceof IPRange)
				{
					$oAppContext = new ApplicationContext();
					$sContext = $oAppContext->GetForLink();

					$id = $oObj->GetKey();
					$sClass = get_class($oObj);
						
					$aParams = $oAppContext->GetAsHash();
					$aParams['class'] = $sClass;
					$aParams['id'] = $id;
					$operation = utils::ReadParam('operation', '');
					switch ($operation)
					{
						case 'listips':
							$aResult[] = new SeparatorPopupMenuItem();
							$sMenu = 'UI:IPManagement:Action:Details:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
								
							$aParams['operation'] = 'csvexportips';
							$sMenu = 'UI:IPManagement:Action:CsvExportIps:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;
							
						case 'csvexportips':
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'listips';
							$sMenu = 'UI:IPManagement:Action:ListIps:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							
							$sMenu = 'UI:IPManagement:Action:Details:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
							break;
							
						case 'dolistips':
						case 'docsvexportips':
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'listips';
							$sMenu = 'UI:IPManagement:Action:ListIps:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							
							$sMenu = 'UI:IPManagement:Action:Details:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlAppRoot()."pages/UI.php?operation=details&class=$sClass&id=$id&$sContext");
							
							$aParams['operation'] = 'csvexportips';
							$sMenu = 'UI:IPManagement:Action:CsvExportIps:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;
							
						default:
							$aResult[] = new SeparatorPopupMenuItem();
							$aParams['operation'] = 'listips';
							$sMenu = 'UI:IPManagement:Action:ListIps:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							
							$aParams['operation'] = 'csvexportips';
							$sMenu = 'UI:IPManagement:Action:CsvExportIps:'.$sClass;
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
							break;
					}
				}
				// Additional actions for IPAddress
				else if ($oObj instanceof IPAddress)
				{
					$sClass = get_class($oObj);
					if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
					{
						$oAppContext = new ApplicationContext();
						$id = $oObj->GetKey();
						$sStatus = $oObj->Get('status');

						$aParams = $oAppContext->GetAsHash();
						$aParams['class'] = $sClass;
						$aParams['id'] = $id;
						switch ($sStatus)
						{
							case 'allocated':
								$aResult[] = new SeparatorPopupMenuItem();
								$aParams['operation'] = 'unallocateip';
								$sMenu = 'UI:IPManagement:Action:UnAllocateIP:IPAddress';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								break;

							case 'reserved':
							case 'released':
							case 'unassigned':
								$aResult[] = new SeparatorPopupMenuItem();
								$aParams['operation'] = 'allocateip';
								$sMenu = 'UI:IPManagement:Action:AllocateIP:IPAddress';
								$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
								break;

							default:
								break;
						}
					}
				}
				// Additional actions for Domain
				elseif ($oObj instanceof Domain)
				{
					$sClass = get_class($oObj);
					if (UserRights::IsActionAllowed($sClass, UR_ACTION_MODIFY) == UR_ALLOWED_YES)
					{
						$oAppContext = new ApplicationContext();
						$id = $oObj->GetKey();

						$aParams = $oAppContext->GetAsHash();
						$aParams['class'] = $sClass;
						$aParams['id'] = $id;
						$aResult[] = new SeparatorPopupMenuItem();

						if ($oObj->IsDelegated())
						{
							$aParams['operation'] = 'undelegate';
							$sMenu = 'UI:IPManagement:Action:Undelegate:Domain';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
						}
						else
						{
							$aParams['operation'] = 'delegate';
							$sMenu = 'UI:IPManagement:Action:Delegate:Domain';
							$aResult[] = new URLPopupMenuItem($sMenu, Dict::S($sMenu), utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php', $aParams));
						}
					}
				}
			break;
			
			case iPopupMenuExtension::MENU_DASHBOARD_ACTIONS:
				// $param is a Dashboard
				break;
			
			default:
				// Unknown type of menu, do nothing
				break;
		}
		return $aResult;
	}
}
