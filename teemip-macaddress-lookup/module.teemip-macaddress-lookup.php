<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'teemip-macaddress-lookup/1.0.1',
	array(
		// Identification
		//
		'label' => 'MAC address lookup',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'teemip-ip-mgmt/2.6.1',
		),
		'mandatory' => false,
		'visible' => true,

		// Components
		//
		'datamodel' => array(
			'src/Hook/MacAddressLookupExtraMenus.php',
			'model.teemip-macaddress-lookup.php',
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
