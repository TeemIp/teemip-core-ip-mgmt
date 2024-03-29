<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'teemip-network-mgmt/3.1.2-dev',
	array(
		// Identification
		//
		'label' => 'Network Management',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'teemip-framework/3.1.0',
		),
		'mandatory' => false,
		'visible' => true,

		// Components
		//
		'datamodel' => array(
			'vendor/autoload.php',
			'model.teemip-network-mgmt.php',
		),
		'data.struct' => array(//'data.struct.IPAudit.xml',
		),
		'data.sample' => array(
			'data/data.sample.Domain.xml',
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
