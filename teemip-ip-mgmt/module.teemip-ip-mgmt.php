<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'teemip-ip-mgmt/3.2.0',
	array(
		// Identification
		//
		'label' => 'IP Management',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'itop-tickets/3.1.0',
			'teemip-framework/3.2.0',
			'teemip-network-mgmt/3.2.0',
		),
		'mandatory' => false,
		'visible' => true,
		'installer' => 'IPManagementInstaller',

		// Components
		//
		'datamodel' => array(
			'vendor/autoload.php',
			'src/Hook/IPMgmtExtraMenus.php',
			'src/Hook/AllocateIPsToProductionCIs.php',
			'src/Hook/ReleaseIPsFromObsoleteCIs.php',
			'src/Hook/UnassignIPsWithNoCI.php',
			'src/Hook/HandleIPWaterMarks.php',
			'src/Model/IPTriggerOnWaterMark.php',
			'model.teemip-ip-mgmt.php',
		),
		'data.struct' => array(//'data.struct.IPAudit.xml',
		),
		'data.sample' => array(
			'data/data.sample.IPBlockType.xml',
			'data/data.sample.IPv4Block.xml',
			'data/data.sample.IPv4Subnet.xml',
			'data/data.sample.IPv4Range.xml',
			'data/data.sample.IPv4Address.xml',
			'data/data.sample.lnkIPv4BlockToLocation.xml',
			'data/data.sample.lnkIPv4SubnetToLocation.xml',
		),

		// Documentation
		//
		'doc.manual_setup' => '',
		'doc.more_information' => '',

		// Default settings
		//
		'settings' => array(
			'ip_release_on_ci_status' => array(
				'enabled' => false,
				'debug' => false,
				'periodicity' => 3600,
				'status_list' => array('obsolete'),
			),
			'ip_allocate_on_ci_status' => array(
				'enabled' => false,
				'debug' => false,
				'periodicity' => 3600,
				'status_list' => array('implementation', 'production'),
			),
			'ip_unassign_on_no_ci' => array(
				'enabled' => false,
				'debug' => false,
				'periodicity' => 3600,
				'target_status' => 'unassigned',
			),
			'handle_ip_watermarks' => array(
				'enabled' => false,
				'debug' => false,
				'periodicity' => 86400,
				'target_classes' => array('IPv4Subnet', 'IPv4Range'),
			),
		),
	)
);

if (!class_exists('IPManagementInstaller')) {
	// Module installation handler
	//
	class IPManagementInstaller extends ModuleInstallerAPI
	{
		public static function BeforeWritingConfig(Config $oConfiguration)
		{
			// If you want to override/force some configuration values, do it here
			return $oConfiguration;
		}

		/**
		 * Handler called before creating or upgrading the database schema
		 * @param $oConfiguration Config The new configuration of the application
		 * @param $sPreviousVersion string PRevious version number of the module (empty string in case of first install)
		 * @param $sCurrentVersion string Current version number of the module
		 */
		public static function BeforeDatabaseCreation(Config $oConfiguration, $sPreviousVersion, $sCurrentVersion)
		{
			// If you want to migrate data from one format to another, do it here
		}

		/**
		 * Handler called after the creation/update of the database schema
		 *
		 * @param $oConfiguration Config The new configuration of the application
		 * @param $sPreviousVersion string PRevious version number of the module (empty string in case of first install)
		 * @param $sCurrentVersion string Current version number of the module
		 *
		 * @throws \CoreException
		 * @throws \MySQLException
		 * @throws \MySQLHasGoneAwayException
		 */
		public static function AfterDatabaseCreation(Config $oConfiguration, $sPreviousVersion, $sCurrentVersion)
		{
			if ($sPreviousVersion === '') {
				return;
			}

			$sDBSubname = $oConfiguration->Get('db_subname');
			if (($sPreviousVersion == '2.5.0') || ($sPreviousVersion == '2.5.1')) {
				SetupLog::Info("Module teemip-ip-mgmt: reset next_run_date of ReleaseIPsFromObsoleteCIs backgorund task");

				$sUpdate = "UPDATE ".$sDBSubname."priv_backgroundtask SET next_run_date= '2020-01-01 00:00:00' WHERE class_name = 'ReleaseIPsFromObsoleteCIs'";
				CMDBSource::Query($sUpdate);

				SetupLog::Info("Module teemip-zone-mgmt: reset done");
			}
			if ($sPreviousVersion == '2.7.0') {
				SetupLog::Info("Module teemip-ip-mgmt: move IP Range DHCP servers from obsolete lnkServerToIPRange to new lnkFunctionalCIToIPRange");

				$sCopy = "INSERT INTO ".$sDBSubname."lnkfunctionalcitoiprange (functionalci_id, iprange_id, role) SELECT server_id, iprange_id, role FROM ".$sDBSubname."lnkiprangetoserver";
				CMDBSource::Query($sCopy);

				SetupLog::Info("Module teemip-ip-mgmt: migration done");
			}
			if ($sPreviousVersion[0] == '2') {
				SetupLog::Info("Module teemip-ip-mgmt: compute new IPObjects attributes linked with IPConfig parameters ");

				$sCopy = "UPDATE ".$sDBSubname."ipobject AS o JOIN ".$sDBSubname."ipconfig AS c ON c.org_id = o.org_id SET o.ipconfig_id = c.id";
				CMDBSource::Query($sCopy);

				SetupLog::Info("Module teemip-ip-mgmt: computation done");
			}
			if (($sPreviousVersion[0] == '2') || ($sPreviousVersion[0] == '3' && $sPreviousVersion[2] == '0')) {
				SetupLog::Info("Module teemip-ip-mgmt: update name of lnkIPInterfaceToIPAddress classes");

				$sCopy = "UPDATE ".$sDBSubname."lnkipinterfacetoipaddress AS l JOIN ".$sDBSubname."ipaddress AS ip ON ip.id = l.ipaddress_id JOIN ".$sDBSubname."ipaddressv4 AS ipv ON ipv.id = ip.id SET l.ipaddress_ip = ipv.ip WHERE ip.finalclass = 'IPv4Address'";
				CMDBSource::Query($sCopy);
				$sCopy = "UPDATE ".$sDBSubname."lnkipinterfacetoipaddress AS l JOIN ".$sDBSubname."ipaddress AS ip ON ip.id = l.ipaddress_id JOIN ".$sDBSubname."ipaddressv6 AS ipv ON ipv.id = ip.id SET l.ipaddress_ip = ipv.ip_comp WHERE ip.finalclass = 'IPv6Address'";
				CMDBSource::Query($sCopy);

				SetupLog::Info("Module teemip-ip-mgmt: update done");

			}
		}
	}
}
