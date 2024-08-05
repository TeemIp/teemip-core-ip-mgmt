<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Framework\Helper;

use cmdbAbstractObject;
use Combodo\iTop\Application\UI\Base\Component\Html\HtmlFactory;
//use Combodo\iTop\Application\WebPage\WebPage;
use DisplayBlock;
use iTopWebPage;
use MetaModel;
use SetupUtils;
use utils;
use WebPage;

class IPUtils
{
	const MODULE_CODE = 'teemip-ip-mgmt';

	const DEVELOPER_MODE_FUNCTION_CODE = 'developer_mode.enabled';
	const TEEMIP_CACHE_DIR = 'teemip';
	const LIST_CLASSES_WITH_IPS_FILE_NAME = 'ListOfClassesWithIPs.php';

	const IP_RELEASE_ON_CI_STATUS_FUNCTION_CODE = 'ip_release_on_ci_status';
	const IP_RELEASE_ON_CI_STATUS_FUNCTION_SETTING_STATUS_LIST = 'status_list';
	const IP_RELEASE_ON_CI_STATUS_DEFAULT_FUNCTION_SETTING_STATUS_LIST = array('obsolete');

	/**
	 * @param $sIp
	 *
	 * @return int
	 */
	public static function myip2long($sIp)
	{
		return (ip2long($sIp));
	}

	/**
	 * @param $iIp
	 *
	 * @return string
	 */
	public static function mylong2ip($iIp)
	{
		return (long2ip($iIp));
	}

	/**
	 * Provides size of subnet according to dotted string mask
	 *
	 * @param $Mask
	 *
	 * @return int
	 */
	public static function MaskToSize($Mask)
	{
		switch ($Mask) {
			case "0.0.0.0":
				return 4294967296;
			case "128.0.0.0":
				return 2147483648;
			case "192.0.0.0":
				return 1073741824;
			case "224.0.0.0":
				return 536870912;
			case "240.0.0.0":
				return 268435456;
			case "248.0.0.0":
				return 134217728;
			case "252.0.0.0":
				return 67108864;
			case "254.0.0.0":
				return 33554432;
			case "255.0.0.0":
				return 16777216;
			case "255.128.0.0":
				return 8388608;
			case "255.192.0.0":
				return 4194304;
			case "255.224.0.0":
				return 2097152;
			case "255.240.0.0":
				return 1048576;
			case "255.248.0.0":
				return 524288;
			case "255.252.0.0":
				return 262144;
			case "255.254.0.0":
				return 131072;
			case "255.255.0.0":
				return 65536;
			case "255.255.128.0":
				return 32768;
			case "255.255.192.0":
				return 16384;
			case "255.255.224.0":
				return 8192;
			case "255.255.240.0":
				return 4096;
			case "255.255.248.0":
				return 2048;
			case "255.255.252.0":
				return 1024;
			case "255.255.254.0":
				return 512;
			case "255.255.255.0":
				return 256;
			case "255.255.255.128":
				return 128;
			case "255.255.255.192":
				return 64;
			case "255.255.255.224":
				return 32;
			case "255.255.255.240":
				return 16;
			case "255.255.255.248":
				return 8;
			case "255.255.255.252":
				return 4;
			case "255.255.255.254":
				return 2;
			case "255.255.255.255":
				return 1;
			default:
				return -1;
		}
	}

	/**
	 * Provides size of subnet according to dotted string mask
	 *
	 * @param $iPrefix
	 *
	 * @return string
	 */
	public static function BitToMask($iPrefix)
	{
		// Provides size of subnet according to dotted string mask
		switch ($iPrefix) {
			case 0:
				return "0.0.0.0";
			case 1:
				return "128.0.0.0";
			case 2:
				return "192.0.0.0";
			case 3:
				return "224.0.0.0";
			case 4:
				return "240.0.0.0";
			case 5:
				return "248.0.0.0";
			case 6:
				return "252.0.0.0";
			case 7:
				return "254.0.0.0";
			case 8:
				return "255.0.0.0";
			case 9:
				return "255.128.0.0";
			case 10:
				return "255.192.0.0";
			case 11:
				return "255.224.0.0";
			case 12:
				return "255.240.0.0";
			case 13:
				return "255.248.0.0";
			case 14:
				return "255.252.0.0";
			case 15:
				return "255.254.0.0";
			case 16:
				return "255.255.0.0";
			case 17:
				return "255.255.128.0";
			case 18:
				return "255.255.192.0";
			case 19:
				return "255.255.224.0";
			case 20:
				return "255.255.240.0";
			case 21:
				return "255.255.248.0";
			case 22:
				return "255.255.252.0";
			case 23:
				return "255.255.254.0";
			case 24:
				return "255.255.255.0";
			case 25:
				return "255.255.255.128";
			case 26:
				return "255.255.255.192";
			case 27:
				return "255.255.255.224";
			case 28:
				return "255.255.255.240";
			case 29:
				return "255.255.255.248";
			case 30:
				return "255.255.255.252";
			case 31:
				return "255.255.255.254";
			case 32:
				return "255.255.255.255";
			default:
				return "";
		}
	}

	/**
	 * Provides number of bits within a dotted string mask
	 *
	 * @param $Mask
	 *
	 * @return int
	 */
	public static function MaskToBit($Mask)
	{
		// Provides number of bits within a dotted string mask
		return IPUtils::SizeToBit(IPUtils::MaskToSize($Mask));
	}

	/**
	 * Convert size of subnet into mask
	 *
	 * @param $Size
	 *
	 * @return string
	 */
	public static function SizeToMask($Size)
	{
		switch ($Size) {
			case 4294967296:
				return "0.0.0.0";
			case 2147483648:
				return "128.0.0.0";
			case 1073741824:
				return "192.0.0.0";
			case 536870912:
				return "224.0.0.0";
			case 268435456:
				return "240.0.0.0";
			case 134217728:
				return "248.0.0.0";
			case 67108864:
				return "252.0.0.0";
			case 33554432:
				return "254.0.0.0";
			case 16777216:
				return "255.0.0.0";
			case 8388608:
				return "255.128.0.0";
			case 4194304:
				return "255.192.0.0";
			case 2097152:
				return "255.224.0.0";
			case 1048576:
				return "255.240.0.0";
			case 524288:
				return "255.248.0.0";
			case 262144:
				return "255.252.0.0";
			case 131072:
				return "255.254.0.0";
			case 65536:
				return "255.255.0.0";
			case 32768:
				return "255.255.128.0";
			case 16384:
				return "255.255.192.0";
			case 8192:
				return "255.255.224.0";
			case 4096:
				return "255.255.240.0";
			case 2048:
				return "255.255.248.0";
			case 1024:
				return "255.255.252.0";
			case 512:
				return "255.255.254.0";
			case 256:
				return "255.255.255.0";
			case 128:
				return "255.255.255.128";
			case 64:
				return "255.255.255.192";
			case 32:
				return "255.255.255.224";
			case 16:
				return "255.255.255.240";
			case 8:
				return "255.255.255.248";
			case 4:
				return "255.255.255.252";
			case 2:
				return "255.255.255.254";
			case 1:
				return "255.255.255.255";
			default:
				return "";
		}
	}

	/**
	 * Provides number of bits for a given subnet size
	 *
	 * @param $Size
	 *
	 * @return int
	 */
	public static function SizeToBit($Size)
	{
		switch ($Size) {
			case 4294967296:
				return 0;
			case 2147483648:
				return 1;
			case 1073741824:
				return 2;
			case 536870912:
				return 3;
			case 268435456:
				return 4;
			case 134217728:
				return 5;
			case 67108864:
				return 6;
			case 33554432:
				return 7;
			case 16777216:
				return 8;
			case 8388608:
				return 9;
			case 4194304:
				return 10;
			case 2097152:
				return 11;
			case 1048576:
				return 12;
			case 524288:
				return 13;
			case 262144:
				return 14;
			case 131072:
				return 15;
			case 65536:
				return 16;
			case 32768:
				return 17;
			case 16384:
				return 18;
			case 8192:
				return 19;
			case 4096:
				return 20;
			case 2048:
				return 21;
			case 1024:
				return 22;
			case 512:
				return 23;
			case 256:
				return 24;
			case 128:
				return 25;
			case 64:
				return 26;
			case 32:
				return 27;
			case 16:
				return 28;
			case 8:
				return 29;
			case 4:
				return 30;
			case 2:
				return 31;
			case 1:
				return 32;
			default:
				return -1;
		}
	}

	/**
	 * Display the content of an object tab
	 *
	 * @param iTopWebPage $oP
	 * @param $sName
	 * @param $sCode
	 * @param $sClass
	 * @param $sTitle
	 * @param $sInfoPanel
	 * @param $oSet
	 *
	 * @throws \ApplicationException
	 * @throws \CoreException
	 */
	public static function DisplayTabContent(WebPage $oP, $sName, $sCode, $sClass, $sTitle, $sInfoPanel, $oSet, $bDisplayMenu = false)
	{
		$iCount = $oSet->Count();
		$sCount = ($iCount != 0) ? " ($iCount)" : "";
		$oP->SetCurrentTab($sCode, $sName.$sCount, $sTitle);
		$oHtml = HtmlFactory::MakeRaw($sInfoPanel);
		$oBlock = new DisplayBlock($oSet->GetFilter(), 'list', false);
		$oP->AddSubBlock($oHtml);
		$oBlock->Display($oP, 'blk-'.$sCode, array(
			'menu' => $bDisplayMenu,
			'panel_title' => MetaModel::GetName($sClass),
			'panel_title_tooltip' => $sTitle,
			'panel_icon' => MetaModel::GetClassIcon($sClass, false)
		));
	}

	/**
	 * @param \iTopWebPage $oP
	 * @param $oObj
	 *
	 * @return void
	 * @throws \CoreException
	 */
	public static function DisplayDetails(iTopWebPage $oP, $oObj)
	{
		$oObj->SetDisplayMode($oP->IsPrintableVersion() ? cmdbAbstractObject::ENUM_DISPLAY_MODE_PRINT : cmdbAbstractObject::ENUM_DISPLAY_MODE_VIEW);
		$oObj->DisplayDetails($oP);
	}

	/**
	 * Get the list of classes referencing the IPAddress class
	 * Restrict list to non-abstract classes inherited from 'FunctionalCI'
	 * For each class, we get an array of all attributes being an external key to an IPAddress object
	 *
	 * @param string $sMode
	 *
	 * @return array
	 * @throws \CoreException
	 */
	public static function GetListOfClassesWithIPs(): array
	{
		$aIPClasses = [];

		$biTopDevelopmentMode = utils::IsDevelopmentEnvironment();
		$bTeemIpDevelopmentMode = MetaModel::GetModuleSetting(static::MODULE_CODE, static::DEVELOPER_MODE_FUNCTION_CODE, false);
		if (!$biTopDevelopmentMode || ($bTeemIpDevelopmentMode === false)) {
			// Try to read from cache
			$sCacheFileName = utils::GetCachePath().static::TEEMIP_CACHE_DIR."/".static::LIST_CLASSES_WITH_IPS_FILE_NAME;
			if (is_file($sCacheFileName)) {
				$aIPClasses = include $sCacheFileName;
			}
		}

		if (empty($aIPClasses)) {
			$aFunctionalCIChildClasses = MetaModel::EnumChildClasses('FunctionalCI', ENUM_CHILD_CLASSES_EXCLUDETOP);
			foreach ($aFunctionalCIChildClasses as $sClass) {
				$aIPsOfClass = IPUtils::GetListOfIPAttributes($sClass);
				if (!empty($aIPsOfClass)) {
					$aIPClasses[$sClass] = $aIPsOfClass;
				}
			}
			ksort($aIPClasses);

			if (!$biTopDevelopmentMode || !$bTeemIpDevelopmentMode) {
				// Save to cache
				$sCacheContent = "<?php\n\nreturn ".var_export($aIPClasses, true).";";
				SetupUtils::builddir(dirname($sCacheFileName));
				file_put_contents($sCacheFileName, $sCacheContent);
			}
		}

		return $aIPClasses;
	}

	/**
	 * Get the list of IPAttributes (external keys toward an IP(v4-6)Address) for a given class
	 *
	 * @param $sClass
	 *
	 * @return array
	 * @throws \CoreException
	 */
	public static function GetListOfIPAttributes($sClass)
	{
		$aIpsOfClass = [];
		if (MetaModel::IsAbstract($sClass)) {
			return $aIpsOfClass;
		}
		$aExternalKeys = MetaModel::GetExternalKeys($sClass);
		$aIPAttributes = [];
		$aIPv4Attributes = [];
		$aIPv6Attributes = [];
		foreach ($aExternalKeys as $oExternalKey) {
			$sTargetClass = $oExternalKey->GetTargetClass();
			if ($sTargetClass == 'IPAddress') {
				$aIPAttributes[] = $oExternalKey->GetCode();
			} elseif ($sTargetClass == 'IPv4Address') {
				$aIPv4Attributes[] = $oExternalKey->GetCode();
			} elseif ($sTargetClass == 'IPv6Address') {
				$aIPv6Attributes[] = $oExternalKey->GetCode();
			}
		}
		if ((sizeof($aIPAttributes) != 0) || (sizeof($aIPv4Attributes) != 0) || (sizeof($aIPv6Attributes) != 0)) {
			$aIpsOfClass['IPAddress'] = $aIPAttributes;
			$aIpsOfClass['IPv4Address'] = $aIPv4Attributes;
			$aIpsOfClass['IPv6Address'] = $aIPv6Attributes;
		}

		return $aIpsOfClass;
	}

	/**
	 * Get list of status that define an obsolete CI
	 *
	 * @return array
	 */
	public static function GetStatusThatDefineObsoleteCIs(): array
	{
		$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::IP_RELEASE_ON_CI_STATUS_FUNCTION_CODE, static::IP_RELEASE_ON_CI_STATUS_DEFAULT_FUNCTION_SETTING_STATUS_LIST);
		$aStatusList = $aFunctionSettings[static::IP_RELEASE_ON_CI_STATUS_FUNCTION_SETTING_STATUS_LIST];

		return $aStatusList;
	}
}
