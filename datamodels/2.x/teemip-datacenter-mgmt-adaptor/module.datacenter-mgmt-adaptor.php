<?php


SetupWebPage::AddModule(
	__FILE__,
	'teemip-datacenter-mgmt-adaptor/2.6.0',
	array(
		// Identification
		//
		'label' => 'TeemIp adaptor for iTop Datacenter Management',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'itop-datacenter-mgmt/2.7.0',
			'teemip-ip-mgmt/2.6.0',
		),
		'mandatory' => false,
		'visible' => true, // To prevent auto-install but shall not be listed in the install wizard
 		'auto_select' => 'SetupInfo::ModuleIsSelected("teemip-ip-mgmt") && SetupInfo::ModuleIsSelected("itop-datacenter-mgmt")',

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
