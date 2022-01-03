<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Webservices\Hook;

use CMDBSource;
use IPConfig;
use iRestServiceProvider;
use MetaModel;
use RestResult;
use RestResultWithObjects;
use RestUtils;
use TeemIp\TeemIp\Extension\Framework\Helper\IPUtils;
use TeemIp\TeemIp\Extension\Webservices\Controller\RestResultCountIps;
use TeemIp\TeemIp\Extension\Webservices\Controller\RestResultWithTextFile;
use UserRights;

/**
 * Implementation of TeemIp REST services
 *
 * @package     TeemIp
 */
class TeemIpServices implements iRestServiceProvider
{
	/**
	 * Enumerate services delivered by this class
	 *
	 * @param string $sVersion The version (e.g. 1.0) supported by the services
	 * @return array An array of hash 'verb' => verb, 'description' => description
	 */
	public function ListOperations($sVersion)
	{
		$aOps = array();
		$aOps[] = array(
			'verb' => 'teemip/get_webservices_version',
			'description' => 'Provide the WEB services version currently in use'
		);
		$aOps[] = array(
			'verb' => 'teemip/get_nb_of_registered_ips_in_subnet',
			'description' => 'Get the number of registered IPs in subnet(s)'
		);
		$aOps[] = array(
			'verb' => 'teemip/pick_ip_address_in_subnet',
			'description' => 'Automatically pick and register an IPv4 or IPv6 address in a given subnet'
		);
		$aOps[] = array(
			'verb' => 'teemip/pick_ip_address_in_range',
			'description' => 'Automatically pick and register an IPv4 or IPv6 address in a given IP range'
		);
		$aOps[] = array(
			'verb' => 'teemip/pick_subnet_in_block',
			'description' => 'Automatically pick and register an IPv4 or IPv6 subnet in a given IP block'
		);
		if (class_exists('Zone'))
		{
			$aOps[] = array(
				'verb' => 'teemip/get_zone_file',
				'description' => 'Generate and provide the text file that describes the specified DNS zones'
			);
		}
		return $aOps;
	}

	/**
	 * Enumerate services delivered by this class
	 *
	 * @param string $sVersion The version (e.g. 1.0) supported by the services
	 * @param string $sVerb
	 * @param object $aParams
	 *
	 * @return RestResult The standardized result structure (at least a message)
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \SimpleGraphException
	 * @throws \Exception
	 */
	public function ExecOperation($sVersion, $sVerb, $aParams)
	{
		switch ($sVerb)
		{
			case 'teemip/get_webservices_version':
				$oResult = new RestResult();
				$oResult->message = "TeemIp WEB Services version running is: 1.2";
				break;

			case 'teemip/get_nb_of_registered_ips_in_subnet':
				$oResult = new RestResultCountIps();
				$sClass = RestUtils::GetClass($aParams, 'class');
				$key = RestUtils::GetMandatoryParam($aParams, 'key');

				$oObjectSet = RestUtils::GetObjectSetFromKey($sClass, $key);
				$sTargetClass = $oObjectSet->GetFilter()->GetClass();

				if (UserRights::IsActionAllowed($sTargetClass, UR_ACTION_READ) != UR_ALLOWED_YES)
				{
					$oResult->code = RestResult::UNAUTHORIZED;
					$oResult->message = "The current user does not have enough permissions for reading data of class $sTargetClass";
				}
				elseif (($sTargetClass != 'IPSubnet') && ($sTargetClass != 'IPv4Subnet') && ($sTargetClass != 'IPv6Subnet'))
				{
					$oResult->code = RestResult::INTERNAL_ERROR;
					$oResult->message = "IP addresses cannot be counted within an object of class $sTargetClass";
				}
				else
				{
					$aNbOfIPs = array();
					while ($oIPSubnet = $oObjectSet->Fetch())
					{
						$iSubnetSize = $oIPSubnet->GetSize();
						$iNbAllocatedIPs = $oIPSubnet->IPCount('allocated');
						$iNbReleasedIPs = $oIPSubnet->IPCount('released');
						$iNbReservedIPs = $oIPSubnet->IPCount('reserved');
						$iNbUnassignedIPs = $oIPSubnet->IPCount('unassigned');
						$iNbRegisteredIPs = $iNbAllocatedIPs + $iNbReleasedIPs + $iNbReservedIPs + $iNbUnassignedIPs;

						$aNbOfIPs['allocated'] = $iNbAllocatedIPs;
						$aNbOfIPs['released'] = $iNbReleasedIPs;
						$aNbOfIPs['reserved'] = $iNbReservedIPs;
						$aNbOfIPs['unassigned'] = $iNbUnassignedIPs;
						$aNbOfIPs['total registered'] = $iNbRegisteredIPs;
						if ($iSubnetSize >= 2)
						{
							$aNbOfIPs['free ips'] = $iSubnetSize - $iNbRegisteredIPs - 2; // 2: subnet and broadcast IPs
						}
						else
						{
							$aNbOfIPs['free ips'] = 0;
						}

						$oResult->AddObject(0, 'computed', $oIPSubnet, $iSubnetSize, $aNbOfIPs);
					}
					$oResult->message = "Found: ".$oObjectSet->Count();
				}
				break;

			case 'teemip/pick_ip_address_in_subnet':
				$oResult = new RestResultWithObjects();
				$sClass = RestUtils::GetClass($aParams, 'class');
				$key = RestUtils::GetMandatoryParam($aParams, 'key');
				$aFields = (array)RestUtils::GetMandatoryParam($aParams, 'fields');

				// Note: the target class cannot be based on the result of FindObjectFromKey, because in case the user does not have read access, that function already fails with msg 'Nothing found'
				$sParentClass = RestUtils::GetObjectSetFromKey($sClass, $key)->GetFilter()->GetClass();
				if (($sParentClass != 'IPv4Subnet') && ($sParentClass != 'IPv6Subnet'))
				{
					$oResult->code = RestResult::INTERNAL_ERROR;
					$oResult->message = "IP addresses cannot be created within an object of class $sParentClass";
				}
				else
				{
					$sIPClass = ($sParentClass == 'IPv4Subnet') ? 'IPv4Address' : 'IPv6Address';
					if (UserRights::IsActionAllowed($sIPClass, UR_ACTION_MODIFY) != UR_ALLOWED_YES)
					{
						$oResult->code = RestResult::UNAUTHORIZED;
						$oResult->message = "The current user does not have enough permissions for creating data of class $sIPClass";
					}
					else
					{
						$oIPSubnet = RestUtils::FindObjectFromKey($sClass, $key);
						if ($oIPSubnet != null)
						{
							// Subnet exists
							// Pick first free IP address
							// If teemip-request-mgmt is installed, use creation offset
							// Register IP, if any
							$iOrgId = $oIPSubnet->Get('org_id');
							$oConfig = MetaModel::GetConfig();
							$sLatestInstallationDate = CMDBSource::QueryToScalar("SELECT max(installed) FROM ".$oConfig->Get('db_subname')."priv_module_install");
							$aInstalledTeemIPRequestMgmtModule = CMDBSource::QueryToArray("SELECT * FROM ".$oConfig->Get('db_subname')."priv_module_install WHERE installed = '".$sLatestInstallationDate."' AND name = 'teemip-request-mgmt'");
							if (empty($aInstalledTeemIPRequestMgmtModule))
							{
								$iCreationOffset = 0;
							}
							else
							{
								$sParameter = ($sParentClass == 'IPv4Subnet') ? 'request_creation_ipv4_offset' : 'request_creation_ipv6_offset';
								$iCreationOffset = IPConfig::GetFromGlobalIPConfig($sParameter, $iOrgId);
							}

							$sIP = $oIPSubnet->GetFreeIP($iCreationOffset);
							if ($sIP != '') {
								$aFields['org_id'] = $iOrgId;
								$aFields['ipconfig_id'] = IPConfig::GetGlobalIPConfig($iOrgId)->GetKey();        // Cannot be 0 here
								$aFields['ip'] = $sIP;
								$oIP = RestUtils::MakeObjectFromFields($sIPClass, $aFields);
								$oIP->DBInsert();

								$aShowFields = RestUtils::GetFieldList($sIPClass, $aParams, 'output_fields');
								$bExtendedOutput = (RestUtils::GetOptionalParam($aParams, 'output_fields', '*') == '*+');
								$oResult->AddObject(0, 'created', $oIP, $aShowFields, $bExtendedOutput);
							}
							else
							{
								$oResult->code = RestResult::INTERNAL_ERROR;
								$oResult->message = "There is no free IP in the subnet (above configured offset, if any)";
							}
						}
						else
						{
							$oResult->code = RestResult::INTERNAL_ERROR;
							$oResult->message = "The subnet does not exist";
						}
					}
				}
				break;

			case 'teemip/pick_ip_address_in_range':
				$oResult = new RestResultWithObjects();
				$sClass = RestUtils::GetClass($aParams, 'class');
				$key = RestUtils::GetMandatoryParam($aParams, 'key');
				$aFields = (array)RestUtils::GetMandatoryParam($aParams, 'fields');

				// Note: the target class cannot be based on the result of FindObjectFromKey, because in case the user does not have read access, that function already fails with msg 'Nothing found'
				$sParentClass = RestUtils::GetObjectSetFromKey($sClass, $key)->GetFilter()->GetClass();
				if (($sParentClass != 'IPv4Range') && ($sParentClass != 'IPv6Range'))
				{
					$oResult->code = RestResult::INTERNAL_ERROR;
					$oResult->message = "IP addresses cannot be created within an object of class $sParentClass";
				}
				else
				{
					$sIPClass = ($sParentClass == 'IPv4Range') ? 'IPv4Address' : 'IPv6Address';
					if (UserRights::IsActionAllowed($sIPClass, UR_ACTION_MODIFY) != UR_ALLOWED_YES)
					{
						$oResult->code = RestResult::UNAUTHORIZED;
						$oResult->message = "The current user does not have enough permissions for creating data of class $sIPClass";
					}
					else
					{
						$oIPRange = RestUtils::FindObjectFromKey($sParentClass, $key);
						if ($oIPRange != null)
						{
							// Range exists
							// Pick first free IP address
							// Register IP, if any
							$sIP = $oIPRange->GetFreeIP(0);
							if ($sIP != '') {
								$iOrgId = $oIPRange->Get('org_id');
								$aFields['org_id'] = $iOrgId;
								$aFields['ipconfig_id'] = IPConfig::GetGlobalIPConfig($iOrgId)->GetKey();        // Cannot be 0 here
								$aFields['ip'] = $sIP;
								$oIP = RestUtils::MakeObjectFromFields($sIPClass, $aFields);
								$oIP->DBInsert();

								$aShowFields = RestUtils::GetFieldList($sIPClass, $aParams, 'output_fields');
								$bExtendedOutput = (RestUtils::GetOptionalParam($aParams, 'output_fields', '*') == '*+');
								$oResult->AddObject(0, 'created', $oIP, $aShowFields, $bExtendedOutput);
							}
							else
							{
								$oResult->code = RestResult::INTERNAL_ERROR;
								$oResult->message = "There is no free IP in the IP range";
							}
						}
						else
						{
							$oResult->code = RestResult::INTERNAL_ERROR;
							$oResult->message = "The IP range does not exist";
						}
					}
				}
				break;

			case 'teemip/pick_subnet_in_block':
				$oResult = new RestResultWithObjects();
				$sClass = RestUtils::GetClass($aParams, 'class');
				$key = RestUtils::GetMandatoryParam($aParams, 'key');
				$aFields = (array)RestUtils::GetMandatoryParam($aParams, 'fields');

				// Note: the target class cannot be based on the result of FindObjectFromKey, because in case the user does not have read access, that function already fails with msg 'Nothing found'
				$sParentClass = RestUtils::GetObjectSetFromKey($sClass, $key)->GetFilter()->GetClass();
				if (($sParentClass != 'IPv4Block') && ($sParentClass != 'IPv6Block'))
				{
					$oResult->code = RestResult::INTERNAL_ERROR;
					$oResult->message = "Subnets cannot be created within an object of class $sParentClass";
				}
				else
				{
					$sSubnetClass = ($sParentClass == 'IPv4Block') ? 'IPv4Subnet' : 'IPv6Subnet';
					if (UserRights::IsActionAllowed($sSubnetClass, UR_ACTION_MODIFY) != UR_ALLOWED_YES)
					{
						$oResult->code = RestResult::UNAUTHORIZED;
						$oResult->message = "The current user does not have enough permissions for creating data of class $sSubnetClass";
					}
					else
					{
						$oIPBlock = RestUtils::FindObjectFromKey($sParentClass, $key);
						if ($oIPBlock != null)
						{
							// Block exists
							// Pick first free subnet
							// Register subnet, if any
							if ($sSubnetClass == 'IPv4Subnet') {
								$iSubnetSize = IPUtils::MaskToSize($aFields['mask']);
							}
							else
							{
								$iSubnetSize = $aFields['mask'];
							}
							$aFreeSpace = $oIPBlock->GetFreeSpace($iSubnetSize, 1, 0);
							if (sizeof($aFreeSpace) != 0) {
								$iOrgId = $oIPBlock->Get('org_id');
								$aFields['org_id'] = $iOrgId;
								$aFields['ipconfig_id'] = IPConfig::GetGlobalIPConfig($iOrgId)->GetKey();        // Cannot be 0 here
								$aFields['block_id'] = $key;
								if ($sSubnetClass == 'IPv4Subnet') {
									$aFields['ip'] = $aFreeSpace[0]['firstip'];
								} else {
									$aFields['ip'] = $aFreeSpace[0]['firstip']->ToString();
								}
								$oSubnet = RestUtils::MakeObjectFromFields($sSubnetClass, $aFields);
								$oSubnet->DBInsert();

								$aShowFields = RestUtils::GetFieldList($sSubnetClass, $aParams, 'output_fields');
								$bExtendedOutput = (RestUtils::GetOptionalParam($aParams, 'output_fields', '*') == '*+');
								$oResult->AddObject(0, 'created', $oSubnet, $aShowFields, $bExtendedOutput);
							}
							else
							{
								$oResult->code = RestResult::INTERNAL_ERROR;
								$oResult->message = "There is no space left for a new subnet in the IP block";
							}
						}
						else
						{
							$oResult->code = RestResult::INTERNAL_ERROR;
							$oResult->message = "The IP block does not exist";
						}
					}
				}
				break;

			case 'teemip/get_zone_file':
				$oResult = new RestResultWithTextFile();
				if (!class_exists('Zone'))
				{
					$oResult->code = RestResult::INTERNAL_ERROR;
					$oResult->message = "No TeemIp zone management extension has been installed !";
				}
				else
				{
					if (UserRights::IsActionAllowed('Zone', UR_ACTION_READ) != UR_ALLOWED_YES)
					{
						$oResult->code = RestResult::UNAUTHORIZED;
						$oResult->message = "The current user does not have enough permissions for reading data of class Zone";
					}
					else
					{
						$key = RestUtils::GetMandatoryParam($aParams, 'key');
						$oZoneSet = RestUtils::GetObjectSetFromKey('Zone', $key);
						while ($oZone = $oZoneSet->Fetch())
						{
							$sFormat = RestUtils::GetMandatoryParam($aParams, 'format');
							$sFormat = ($sFormat == 'sort_by_record') ? 'sort_by_record' : 'sort_by_char';
							$sText = $oZone->GetDataFile($sFormat);
							$oResult->AddObject(0, 'computed', $oZone, $sText);
						}
						$oResult->message = "Found: ".$oZoneSet->Count();
					}
				}
				break;

			default:
				$oResult = new RestResultWithObjects();
				// unknown operation: handled at a higher level
		}
		return $oResult;
	}
}

