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

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'teemip-ip-mgmt/2.7.0',
	array(
		// Identification
		//
		'label' => 'IP Management',
		'category' => 'business',
		
		// Setup
		//
		'dependencies' => array(
			'itop-config-mgmt/2.7.0',
			'itop-tickets/2.7.0',
			'teemip-network-mgmt/2.7.0'
		),
		'mandatory' => false,
		'visible' => true,
		'installer' => 'IPManagementInstaller',

		// Components
		//
		'datamodel' => array(
			'model.teemip-ip-mgmt.php',
			'main.teemip-ip-mgmt.php'
		),
		'data.struct' => array(
			//'data.struct.IPAudit.xml',
		),
		'data.sample' => array(
			'data.sample.IPGlue.xml',
			'data.sample.IPv4Block.xml',
			'data.sample.lnkIPv4BlockToLocation.xml',
			'data.sample.IPv4Subnet.xml',
			'data.sample.lnkIPv4SubnetToLocation.xml',
			'data.sample.IPRangeUsage.xml',
			'data.sample.IPv4Range.xml',
			'data.sample.IPUsage.xml',
			'data.sample.IPv4Address.xml',
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
		),
	)
);

if (!class_exists('IPManagementInstaller'))
{
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
			// For migration from 2.5.0 or 2.5.1
			// Reset next_run_date attribute of ReleaseIPsFromObsoleteCIs background task to the 1st january so that process can be reactivate through the configuration file, if required.

			if (($sPreviousVersion == '2.5.0') || ($sPreviousVersion == '2.5.1'))
			{
				SetupPage::log_info("Module teemip-ip-mgmt: reset next_run_date of ReleaseIPsFromObsoleteCIs backgorund task");

				$sUpdate = "update priv_backgroundtask set next_run_date= '2020-01-01 00:00:00' where class_name = 'ReleaseIPsFromObsoleteCIs'";
				CMDBSource::Query($sUpdate);

				SetupPage::log_info("Module teemip-zone-mgmt: reset done");
			}
		}
	}
}
