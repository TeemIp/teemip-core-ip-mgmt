<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Framework\Model;

use cmdbAbstractObject;
use CMDBObjectSet;
use DBObjectSearch;
use Dict;
use IPConfig;
use IPUsage;
use MetaModel;
use UserRights;

class _IPConfig extends cmdbAbstractObject
{
	const MODULE_CODE = 'teemip-ip-mgmt';
	const FUNCTION_CODE = 'default_global_ip_settings';
	const FUNCTION_SETTING_CORE_PARAMETERS = 'core_parameters';
	const FUNCTION_SETTING_IP_REQUEST_PARAMETERS = 'ip_request_parameters';
	const FUNCTION_SETTING_ZONE_PARAMETERS = 'zone_parameters';
	const FUNCTION_SETTING_CABLE_PARAMETERS = 'cable_parameters';

	// Enable the default configuration in the configuration file
	const FUNCTION_SETTING_ENABLED = 'enabled';

	const DEFAULT_FUNCTION_SETTING_ENABLED = false;

	// Settings for subnet blocks
	const FUNCTION_IPV4_BLOCK_MIN_SIZE = 'ipv4_block_min_size';
	const FUNCTION_IPV6_BLOCK_MIN_PREFIX = 'ipv6_block_min_prefix';
	const FUNCTION_IPV4_BLOCK_CIDR_ALIGNED = 'ipv4_block_cidr_aligned';
	const FUNCTION_IPV6_BLOCK_CIDR_ALIGNED = 'ipv6_block_cidr_aligned';
	const FUNCTION_DELEGATE_TO_CHILDREN_ONLY = 'delegate_to_children_only';

	const DEFAULT_FUNCTION_IPV4_BLOCK_MIN_SIZE = 256;
	const DEFAULT_FUNCTION_IPV6_BLOCK_MIN_PREFIX = 64;
	const DEFAULT_FUNCTION_IPV4_BLOCK_CIDR_ALIGNED = 'bca_yes';
	const DEFAULT_FUNCTION_IPV6_BLOCK_CIDR_ALIGNED = 'bca_yes';
	const DEFAULT_FUNCTION_DELEGATE_TO_CHILDREN_ONLY = 'dtc_yes';

	// Settings for subnets
	const FUNCTION_RESERVE_SUBNET_IPS = 'reserve_subnet_IPs';
	const FUNCTION_IPV4_GATEWAY_IP_FORMAT = 'ipv4_gateway_ip_format';
	const FUNCTION_IPV6_GATEWAY_IP_FORMAT = 'ipv6_gateway_ip_format';
	const FUNCTION_SUBNET_SYMETRICAL_NAT = 'subnet_symetrical_nat';
	const FUNCTION_SUBNET_LOW_WATERMARK = 'subnet_low_watermark';
	const FUNCTION_SUBNET_HIGH_WATERMARK = 'subnet_high_watermark';

	const DEFAULT_FUNCTION_RESERVE_SUBNET_IPS = 'reserve_no';
	const DEFAULT_FUNCTION_IPV4_GATEWAY_IP_FORMAT = 'subnetip_plus_1';
	const DEFAULT_FUNCTION_IPV6_GATEWAY_IP_FORMAT = 'subnetip_plus_1';
	const DEFAULT_FUNCTION_SUBNET_SYMETRICAL_NAT = 'no';
	const DEFAULT_FUNCTION_SUBNET_LOW_WATERMARK = 60;
	const DEFAULT_FUNCTION_SUBNET_HIGH_WATERMARK = 80;

	// Settings for IP ranges
	const FUNCTION_IPRANGE_LOW_WATERMARK = 'iprange_low_watermark';
	const FUNCTION_IPRANGE_HIGH_WATERMARK = 'iprange_high_watermark';

	const DEFAULT_FUNCTION_IPRANGE_LOW_WATERMARK = 60;
	const DEFAULT_FUNCTION_IPRANGE_HIGH_WATERMARK = 80;

	// Settings for IP addresses
	const FUNCTION_IP_ALLOW_DUPLICATE_NAME = 'ip_allow_duplicate_name';
	const FUNCTION_PING_BEFORE_ASSIGN = 'ping_before_assign';
	const FUNCTION_IP_COPY_CI_NAME_TO_SHORTNAME = 'ip_copy_ci_name_to_shortname';
	const FUNCTION_COMPUTE_FQDN_WITH_EMPTY_SHORTNAME = 'compute_fqdn_with_empty_shortname';
	const FUNCTION_IP_SYMETRICAL_NAT = 'ip_symetrical_nat';
	const FUNCTION_IP_ALLOCATE_ON_CI_PRODUCTION = 'ip_allocate_on_ci_production';
	const FUNCTION_IP_RELEASE_ON_CI_OBSOLETE = 'ip_release_on_ci_obsolete';
	const FUNCTION_IP_UNASSIGN_ON_NO_CI = 'ip_unassign_on_no_ci';
	const FUNCTION_IP_RELEASE_ON_SUBNET_RELEASE = 'ip_release_on_subnet_release';

	const DEFAULT_FUNCTION_IP_ALLOW_DUPLICATE_NAME = 'ipdup_no';
	const DEFAULT_FUNCTION_PING_BEFORE_ASSIGN = 'ping_no';
	const DEFAULT_FUNCTION_IP_COPY_CI_NAME_TO_SHORTNAME = 'no';
	const DEFAULT_FUNCTION_COMPUTE_FQDN_WITH_EMPTY_SHORTNAME = 'no';
	const DEFAULT_FUNCTION_IP_SYMETRICAL_NAT = 'no';
	const DEFAULT_FUNCTION_IP_ALLOCATE_ON_CI_PRODUCTION = 'yes';
	const DEFAULT_FUNCTION_IP_RELEASE_ON_CI_OBSOLETE = 'no';
	const DEFAULT_FUNCTION_IP_UNASSIGN_ON_NO_CI = 'no';
	const DEFAULT_FUNCTION_IP_RELEASE_ON_SUBNET_RELEASE = 'yes';

	// Settings for Domains
	const FUNCTION_DELEGATE_DOMAIN_TO_CHILDREN_ONLY = 'delegate_domain_to_children_only';

	const DEFAULT_FUNCTION_DELEGATE_DOMAIN_TO_CHILDREN_ONLY = 'dtc_yes';

	// Other settings
	const FUNCTION_ATTACH_ALREADY_ALLOCATED_IPS = 'attach_already_allocated_ips';
	const FUNCTION_MAC_ADDRESS_FORMAT = 'mac_address_format';

	const DEFAULT_FUNCTION_ATTACH_ALREADY_ALLOCATED_IPS = 'no';
	const DEFAULT_FUNCTION_MAC_ADDRESS_FORMAT = 'colons';

	// Settings for IP Requests - if TeemIp IP Request Mgmt is installed
	const FUNCTION_REQUEST_CREATION_IPV4_OFFSET = 'request_creation_ipv4_offset';
	const FUNCTION_REQUEST_CREATION_IPV6_OFFSET = 'request_creation_ipv6_offset';

	const DEFAULT_FUNCTION_REQUEST_CREATION_IPV4_OFFSET = 0;
	const DEFAULT_FUNCTION_REQUEST_CREATION_IPV6_OFFSET = 0;

	// Default settings for Zone Mgmt - if TeemIp Zone mgmt is installed
	const FUNCTION_IP_UPDATE_DNS_RECORDS = 'ip_update_dns_records';
	const FUNCTION_REMOVE_RR_ON_IP_OBSOLETE = 'remove_rr_on_ip_obsolete';

	const DEFAULT_FUNCTION_IP_UPDATE_DNS_RECORDS = 'no';
	const DEFAULT_FUNCTION_REMOVE_RR_ON_IP_OBSOLETE = 'no';

	// Default settings for Cable Mgmt - if TeemIp Cable mgmt is installed
	const FUNCTION_ALLOW_BACKENDNETWORKCABLE_TO_CROSS_ORGS = 'allow_backendnetworkcable_to_cross_orgs';

	const DEFAULT_FUNCTION_ALLOW_BACKENDNETWORKCABLE_TO_CROSS_ORGS = 'no';

	/**
	 * @inheritdoc
	 */
	function DoCheckToWrite()
	{
		// Run standard iTop checks first
		parent::DoCheckToWrite();

		// Only one IPConfig object can exist within an organization
		$iOrgId = $this->Get('org_id');
		$iKey = $this->GetKey();
		$sOQL = 'SELECT IPConfig AS c WHERE c.org_id = :org_id';
		$oConfigSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('org_id' => $iOrgId));
		while ($oConfig = $oConfigSet->Fetch()) {
			// If it's a modification (keys are the same), we can proceed, otherwise, we deny the creation 
			if ($oConfig->GetKey() != $iKey) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPConfig:AlreadyExists');

				return;
			}
		}

		// Check validity of block_min_size
		$iBlock4MinSize = $this->Get('ipv4_block_min_size');
		if ($iBlock4MinSize < IPV4_BLOCK_MIN_SIZE) {
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:IPv4BlockMinSizeTooSmall', IPV4_BLOCK_MIN_SIZE);
		}
		if (MetaModel::IsValidClass('IPv6Block')) {
			$iBlock6MinPrefix = $this->Get('ipv6_block_min_prefix');
			if ($iBlock6MinPrefix > IPV6_BLOCK_MIN_PREFIX) {
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:IPv6BlockMinSizeTooSmall', IPV6_BLOCK_MIN_PREFIX);
			}
		}

		// Check validity of subnets watermarks
		$iSubLW = $this->Get('subnet_low_watermark');
		$iSubHW = $this->Get('subnet_high_watermark');
		if (!((0 <= $iSubLW) && ($iSubLW <= 100)) || !((0 <= $iSubHW) && ($iSubHW <= 100))) {
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:WaterMarksPercent');
		}
		if ($iSubHW < $iSubLW) {
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:WaterMarksOrder');
		}

		// Check validity of IP ranges watermarks
		$iIpRLW = $this->Get('iprange_low_watermark');
		$iIpRHW = $this->Get('iprange_high_watermark');
		if (!((0 <= $iIpRLW) && ($iIpRLW <= 100)) || !((0 <= $iIpRHW) && ($iIpRHW <= 100))) {
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:WaterMarksPercent');
		}
		if ($iIpRHW < $iIpRLW) {
			$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:WaterMarksOrder');
		}

		// Check server has been set if ping required
		//if ($this->Get('ping_before_assign') == 'ping_yes')
		//{
		// 	if ($this->Get('ping_server_id') == '')
		// 	{
		//		$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Modify:IPConfig:MissPingServer');
		//	}
		//} 
	}

	/**
	 * @inheritdoc
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		$sFlagsFromParent = parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);

		if ((!$this->IsNew()) && (($sAttCode == 'org_id'))) {
			return (OPT_ATT_READONLY | $sFlagsFromParent);
		}

		return $sFlagsFromParent;
	}

	/**
	 * @return array
	 */
	public static function GetDefaultParameters(): array
	{
		$aCoreIpParameters = [
			static::FUNCTION_IPV4_BLOCK_MIN_SIZE => static::DEFAULT_FUNCTION_IPV4_BLOCK_MIN_SIZE,
			static::FUNCTION_IPV6_BLOCK_MIN_PREFIX => static::DEFAULT_FUNCTION_IPV6_BLOCK_MIN_PREFIX,
			static::FUNCTION_IPV4_BLOCK_CIDR_ALIGNED => static::DEFAULT_FUNCTION_IPV4_BLOCK_CIDR_ALIGNED,
			static::FUNCTION_IPV6_BLOCK_CIDR_ALIGNED => static::DEFAULT_FUNCTION_IPV6_BLOCK_CIDR_ALIGNED,
			static::FUNCTION_DELEGATE_TO_CHILDREN_ONLY => static::DEFAULT_FUNCTION_DELEGATE_TO_CHILDREN_ONLY,
			static::FUNCTION_RESERVE_SUBNET_IPS => static::DEFAULT_FUNCTION_RESERVE_SUBNET_IPS,
			static::FUNCTION_IPV4_GATEWAY_IP_FORMAT => static::DEFAULT_FUNCTION_IPV4_GATEWAY_IP_FORMAT,
			static::FUNCTION_IPV6_GATEWAY_IP_FORMAT => static::DEFAULT_FUNCTION_IPV6_GATEWAY_IP_FORMAT,
			static::FUNCTION_SUBNET_SYMETRICAL_NAT => static::DEFAULT_FUNCTION_SUBNET_SYMETRICAL_NAT,
			static::FUNCTION_SUBNET_LOW_WATERMARK => static::DEFAULT_FUNCTION_SUBNET_LOW_WATERMARK,
			static::FUNCTION_SUBNET_HIGH_WATERMARK => static::DEFAULT_FUNCTION_SUBNET_HIGH_WATERMARK,
			static::FUNCTION_IPRANGE_LOW_WATERMARK => static::DEFAULT_FUNCTION_IPRANGE_LOW_WATERMARK,
			static::FUNCTION_IPRANGE_HIGH_WATERMARK => static::DEFAULT_FUNCTION_IPRANGE_HIGH_WATERMARK,
			static::FUNCTION_IP_ALLOW_DUPLICATE_NAME => static::DEFAULT_FUNCTION_IP_ALLOW_DUPLICATE_NAME,
			static::FUNCTION_PING_BEFORE_ASSIGN => static::DEFAULT_FUNCTION_PING_BEFORE_ASSIGN,
			static::FUNCTION_IP_COPY_CI_NAME_TO_SHORTNAME => static::DEFAULT_FUNCTION_IP_COPY_CI_NAME_TO_SHORTNAME,
			static::FUNCTION_COMPUTE_FQDN_WITH_EMPTY_SHORTNAME => static::DEFAULT_FUNCTION_COMPUTE_FQDN_WITH_EMPTY_SHORTNAME,
			static::FUNCTION_IP_SYMETRICAL_NAT => static::DEFAULT_FUNCTION_IP_SYMETRICAL_NAT,
			static::FUNCTION_IP_ALLOCATE_ON_CI_PRODUCTION => static::DEFAULT_FUNCTION_IP_ALLOCATE_ON_CI_PRODUCTION,
			static::FUNCTION_IP_RELEASE_ON_CI_OBSOLETE => static::DEFAULT_FUNCTION_IP_RELEASE_ON_CI_OBSOLETE,
			static::FUNCTION_IP_UNASSIGN_ON_NO_CI => static::DEFAULT_FUNCTION_IP_UNASSIGN_ON_NO_CI,
			static::FUNCTION_IP_RELEASE_ON_SUBNET_RELEASE => static::DEFAULT_FUNCTION_IP_RELEASE_ON_SUBNET_RELEASE,
			static::FUNCTION_DELEGATE_DOMAIN_TO_CHILDREN_ONLY => static::DEFAULT_FUNCTION_DELEGATE_DOMAIN_TO_CHILDREN_ONLY,
			static::FUNCTION_ATTACH_ALREADY_ALLOCATED_IPS => static::DEFAULT_FUNCTION_ATTACH_ALREADY_ALLOCATED_IPS,
			static::FUNCTION_MAC_ADDRESS_FORMAT => static::DEFAULT_FUNCTION_MAC_ADDRESS_FORMAT,
		];
		if (class_exists('IPRequest')) {
			$aIpRequestParameters = [
				static::FUNCTION_REQUEST_CREATION_IPV4_OFFSET => static::DEFAULT_FUNCTION_REQUEST_CREATION_IPV4_OFFSET,
				static::FUNCTION_REQUEST_CREATION_IPV6_OFFSET => static::DEFAULT_FUNCTION_REQUEST_CREATION_IPV6_OFFSET,
			];
		} else {
			$aIpRequestParameters = [];
		}
		if (class_exists('Zone')) {
			$aZoneParameters = [
				static::FUNCTION_IP_UPDATE_DNS_RECORDS => static::DEFAULT_FUNCTION_IP_UPDATE_DNS_RECORDS,
				static::FUNCTION_REMOVE_RR_ON_IP_OBSOLETE => static::DEFAULT_FUNCTION_REMOVE_RR_ON_IP_OBSOLETE,
			];
		} else {
			$aZoneParameters = [];
		}
		if (class_exists('BackEndNetworkCable')) {
			$aCableParameters = [
				static::FUNCTION_ALLOW_BACKENDNETWORKCABLE_TO_CROSS_ORGS => static::DEFAULT_FUNCTION_ALLOW_BACKENDNETWORKCABLE_TO_CROSS_ORGS,
			];
		} else {
			$aCableParameters = [];
		}
		$aDefaultSettings = [
			static::FUNCTION_SETTING_ENABLED => static::DEFAULT_FUNCTION_SETTING_ENABLED,
			static::FUNCTION_SETTING_CORE_PARAMETERS => $aCoreIpParameters,
			static::FUNCTION_SETTING_IP_REQUEST_PARAMETERS => $aIpRequestParameters,
			static::FUNCTION_SETTING_ZONE_PARAMETERS => $aZoneParameters,
			static::FUNCTION_SETTING_CABLE_PARAMETERS => $aCableParameters,
		];

		return $aDefaultSettings;
	}

	/**
	 * Retrieve global config for given organization
	 *
	 * @param $iOrgId
	 *
	 * @return \cmdbAbstractObject|\DBObject
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \CoreWarning
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public static function GetGlobalIPConfig($iOrgId): IPConfig
	{
		// Create Global Config of $iOrgId if it doesn't exist
		$sOQL = 'SELECT IPConfig AS c WHERE c.org_id = :org_id';
		$oIpConfig = MetaModel::GetObjectFromOQL($sOQL, array('org_id' => $iOrgId), false);
		if (($oIpConfig == null) && ($iOrgId != 0)) {
			// Get module parameters
			$aDefaultSettings = IPConfig::GetDefaultParameters();
			$aFunctionSettings = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, $aDefaultSettings);
			$bEnabled = (bool)$aFunctionSettings[static::FUNCTION_SETTING_ENABLED];

			// Create and initialize IPConfig object
			$oIpConfig = MetaModel::NewObject('IPConfig');
			$oIpConfig->Set('org_id', $iOrgId);
			if ($bEnabled) {
				// Set parameters according to what the configuration file contains
				// Set core parameters
				if (!array_key_exists(static::FUNCTION_SETTING_CORE_PARAMETERS, $aFunctionSettings)) {
					$aFunctionSettings[static::FUNCTION_SETTING_CORE_PARAMETERS] = $aDefaultSettings[static::FUNCTION_SETTING_CORE_PARAMETERS];
				}
				foreach ($aDefaultSettings[static::FUNCTION_SETTING_CORE_PARAMETERS] as $sParameter => $sValueParameter) {
					if (array_key_exists($sParameter, $aFunctionSettings[static::FUNCTION_SETTING_CORE_PARAMETERS])) {
						$oIpConfig->Set($sParameter, $aFunctionSettings[static::FUNCTION_SETTING_CORE_PARAMETERS][$sParameter]);
					}
				}

				// Set IP Request parameters
				if (!array_key_exists(static::FUNCTION_SETTING_IP_REQUEST_PARAMETERS, $aFunctionSettings)) {
					$aFunctionSettings[static::FUNCTION_SETTING_IP_REQUEST_PARAMETERS] = $aDefaultSettings[static::FUNCTION_SETTING_IP_REQUEST_PARAMETERS];
				}
				foreach ($aDefaultSettings[static::FUNCTION_SETTING_IP_REQUEST_PARAMETERS] as $sParameter => $sValueParameter) {
					if (array_key_exists($sParameter, $aFunctionSettings[static::FUNCTION_SETTING_IP_REQUEST_PARAMETERS])) {
						$oIpConfig->Set($sParameter, $aFunctionSettings[static::FUNCTION_SETTING_IP_REQUEST_PARAMETERS][$sParameter]);
					}
				}

				// Set Zone parameters
				if (!array_key_exists(static::FUNCTION_SETTING_ZONE_PARAMETERS, $aFunctionSettings)) {
					$aFunctionSettings[static::FUNCTION_SETTING_ZONE_PARAMETERS] = $aDefaultSettings[static::FUNCTION_SETTING_ZONE_PARAMETERS];
				}
				foreach ($aDefaultSettings[static::FUNCTION_SETTING_ZONE_PARAMETERS] as $sParameter => $sValueParameter) {
					if (array_key_exists($sParameter, $aFunctionSettings[static::FUNCTION_SETTING_ZONE_PARAMETERS])) {
						$oIpConfig->Set($sParameter, $aFunctionSettings[static::FUNCTION_SETTING_ZONE_PARAMETERS][$sParameter]);
					}
				}

				// Set Cable parameters
				if (!array_key_exists(static::FUNCTION_SETTING_CABLE_PARAMETERS, $aFunctionSettings)) {
					$aFunctionSettings[static::FUNCTION_SETTING_CABLE_PARAMETERS] = $aDefaultSettings[static::FUNCTION_SETTING_CABLE_PARAMETERS];
				}
				foreach ($aDefaultSettings[static::FUNCTION_SETTING_CABLE_PARAMETERS] as $sParameter => $sValueParameter) {
					if (array_key_exists($sParameter, $aFunctionSettings[static::FUNCTION_SETTING_CABLE_PARAMETERS])) {
						$oIpConfig->Set($sParameter, $aFunctionSettings[static::FUNCTION_SETTING_CABLE_PARAMETERS][$sParameter]);
					}
				}

			}

			// Register config if user has the rights for it
			if (UserRights::IsActionAllowed('IPConfig', UR_ACTION_MODIFY) == UR_ALLOWED_YES) {
				$oIpConfig->DBInsert();

				IPUsage::CreateBasicIpUsages($iOrgId);
			}
		}

		return ($oIpConfig);
	}

	/**
	 * Read parameter from config of given organization
	 *
	 * @param $sParameter
	 * @param $iOrgId
	 *
	 * @return float|int|mixed|\ormLinkSet|string|null
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public static function GetFromGlobalIPConfig($sParameter, $iOrgId)
	{
		// Reads $sParameter from Global Config
		if ($iOrgId != null) {
			$oIpConfig = IPConfig::GetGlobalIPConfig($iOrgId);

			return ($oIpConfig->Get($sParameter));
		}

		return null;
	}

}
