<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

SetupWebPage::AddModule(
	__FILE__,
	'teemip-config-mgmt-adaptor/3.2.0',
	array(
		// Identification
		//
		'label' => 'TeemIp adaptor for iTop Config Mgmt',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'itop-config-mgmt/3.1.0',
			'teemip-ip-mgmt/3.2.0',
		),
		'mandatory' => false,
		'visible' => true, // To prevent auto-install but shall not be listed in the install wizard
		'auto_select' => 'SetupInfo::ModuleIsSelected("teemip-ip-mgmt") && SetupInfo::ModuleIsSelected("itop-config-mgmt")',

		// Components
		//
		'datamodel' => array(
			'model.teemip-config-mgmt-adaptor.php',
		),
		'data.struct' => array(),
		'data.sample' => array(
			'data/data.sample.NetworkDeviceType.xml',
			'data/data.sample.NetworkDevice.xml',
			'data/data.sample.Server.xml',
			'data/data.sample.PhysicalInterface.xml',
		),

		// Documentation
		//
		'doc.manual_setup' => '',
		'doc.more_information' => '',

		// Default settings
		//
		'settings' => array(),
	)
);
