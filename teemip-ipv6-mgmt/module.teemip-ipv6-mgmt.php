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

/** @noinspection PhpUnhandledExceptionInspection */
SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'teemip-ipv6-mgmt/2.6.1',
	array(
		// Identification
		//
		'label' => 'IPv6 Management',
		'category' => 'business',
		
		// Setup
		//
		'dependencies' => array(
			'teemip-ip-mgmt/2.6.1',
		),
		'mandatory' => false,
		'visible' => true,
		'installer' => 'IPv6ManagementInstaller',

		// Components
		//
		'datamodel' => array(
			'model.teemip-ipv6-mgmt.php',
			'main.teemip-ipv6-mgmt.php',
		),
		'data.struct' => array(
			//'data.struct.IPAudit.xml',
		),
		'data.sample' => array(
			'data.sample.IPv6Block.xml',
			'data.sample.lnkIPv6BlockToLocation.xml',
			'data.sample.IPv6Subnet.xml',
			'data.sample.lnkIPv6SubnetToLocation.xml',
			'data.sample.IPv6Range.xml',
			'data.sample.IPv6Address.xml',
		),
		
		// Documentation
		//
		'doc.manual_setup' => '',
		'doc.more_information' => '',
		
		// Default settings
		//
		'settings' => array(
		),
	)
);

if (!class_exists('IPv6ManagementInstaller'))
{
	// Module installation handler
	//
	class IPv6ManagementInstaller extends ModuleInstallerAPI
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
			// For migration above 2.6.0
			// Add column xx_comp for all IPv6Attribute where the compressed version of the Ip is stored now.
			SetupPage::log_info("Module teemip-ipv6-mgmt: for all IPv6Attribute, fill new _comp (compressed) column with compressed value of IP");

			// Get list of all non abstract classes under cmdbAbstractObject that have at least one IPv6Attribute and list these attributes
			$aCIChildClasses = MetaModel::GetClasses('bizmodel');
			$aIPv6Classes = array();
			foreach ($aCIChildClasses as $sClass)
			{
				if (MetaModel::IsAbstract($sClass))
				{
					continue;
				}

				$aAttCodes = MetaModel::GetAttributesList($sClass);
				$aIPv6Attributes = array();
				foreach ($aAttCodes as $sAttCode)
				{
					$oAttDef = MetaModel::GetAttributeDef($sClass,	$sAttCode);
					if ($oAttDef instanceof AttributeIPv6Address)
					{
						$aIPv6Attributes[] = $sAttCode;
					}
				}
				if (sizeof ($aIPv6Attributes) != 0)
				{
					$aIPv6Classes[$sClass] = $aIPv6Attributes;
				}
			}

			// For each of the classes with IPv6 attributes that have not been migrated yet, get the canonical value of the attribute, compress it and store it in the right column.
			foreach ($aIPv6Classes as $sClass => $aIPv6Attributes)
			{
				$bToBeMigrated = false;
				foreach ($aIPv6Attributes as $sAttCode)
				{
					// Check if the migration has been done for all attributes
					$sClassOrigin = MetaModel::GetAttributeOrigin($sClass, $sAttCode);
					$sTable = MetaModel::DBGetTable($sClassOrigin, $sAttCode);
					$sColumn = $sAttCode.'_comp';
					$sSQL = "SELECT COUNT(*) FROM $sTable WHERE ISNULL($sColumn)";
					$iCount = CMDBSource::QueryToScalar($sSQL);
					if ($iCount != 0)
					{
						$bToBeMigrated = true;
						break;
					}
				}

				if ($bToBeMigrated)
				{
					// Migrate all instances of $sClass
					$oSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT $sClass",  array()));
					$iCount = $oSet->Count();
					while ($oObject = $oSet->Fetch())
					{
						$iKey = $oObject->getKey();
						foreach ($aIPv6Attributes as $sAttCode)
						{
							$sValue = $oObject->Get($sAttCode)->ToString();
							$sClassOrigin = MetaModel::GetAttributeOrigin($sClass, $sAttCode);
							$sTable = MetaModel::DBGetTable($sClassOrigin, $sAttCode);
							$sColumn = $sAttCode.'_comp';
							$sSQL = "UPDATE $sTable SET $sColumn = '$sValue' WHERE id = $iKey;";
							CMDBSource::Query($sSQL);
						}
					}
					SetupPage::log_info("Module teemip-ipv6-mgmt: $iCount instances of class $sClass have had their IPv6 Attributes migrated");
				}
			}
			SetupPage::log_info("Module teemip-ipv6-mgmt: compression migration done");
		}
	}
}
