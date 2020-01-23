<?php


SetupWebPage::AddModule(
	__FILE__,
	'teemip-endusers-devices-adaptor/2.6.0',
	array(
		// Identification
		//
		'label' => 'TeemIp adaptor for iTop End-user Devices Management',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'itop-endusers-devices/2.7.0',
			'teemip-ip-mgmt/2.6.0',
		),
		'mandatory' => false,
		'visible' => true, // To prevent auto-install but shall not be listed in the install wizard
 		'auto_select' => 'SetupInfo::ModuleIsSelected("teemip-ip-mgmt") && SetupInfo::ModuleIsSelected("itop-endusers-devices")',

		// Components
		//
		'datamodel' => array(
		),
		'data.struct' => array(
		),
		'data.sample' => array(
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
