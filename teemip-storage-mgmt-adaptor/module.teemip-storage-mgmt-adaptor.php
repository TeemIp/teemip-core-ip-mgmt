<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

SetupWebPage::AddModule(
	__FILE__,
	'teemip-storage-mgmt-adaptor/3.2.0',
	array(
		// Identification
		//
		'label' => 'TeemIp adaptor for iTop Storage Mgmt',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'itop-storage-mgmt/3.1.0',
			'teemip-ip-mgmt/3.2.0',
			'teemip-config-mgmt-adaptor/3.2.0',
		),
		'mandatory' => false,
		'visible' => true, // To prevent auto-install but shall not be listed in the install wizard
		'auto_select' => 'SetupInfo::ModuleIsSelected("itop-storage-mgmt") && SetupInfo::ModuleIsSelected("teemip-ip-mgmt") && SetupInfo::ModuleIsSelected("teemip-config-mgmt-adaptor")',

		// Components
		//
		'datamodel' => array(),
		'data.struct' => array(),
		'data.sample' => array(),

		// Documentation
		//
		'doc.manual_setup' => '',
		'doc.more_information' => '',

		// Default settings
		//
		'settings' => array(),
	)
);
