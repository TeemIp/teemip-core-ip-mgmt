<?php
/**
 * @copyright   Copyright (C) 2020 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// TeemIP module definition file
//

/** @noinspection PhpUnhandledExceptionInspection */
SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'teemip-ipv6-mgmt/2.6.0',
	array(
		// Identification
		//
		'label' => 'IPv6 Management',
		'category' => 'business',
		
		// Setup
		//
		'dependencies' => array(
			'teemip-ip-mgmt/2.6.0',
		),
		'mandatory' => false,
		'visible' => true,
		
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
