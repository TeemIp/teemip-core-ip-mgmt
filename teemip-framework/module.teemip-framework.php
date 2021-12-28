<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'teemip-framework/3.0.0',
	array(
		// Identification
		//
		'label' => 'TeemIp Framework',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'itop-config-mgmt/2.7.0',
		),
		'mandatory' => true,
		'visible' => false,

		// Components
		//
		'datamodel' => array(
			'vendor/autoload.php',
			'src/Model/AttributeAliasList.php',
			'src/Model/AttributeDomainName.php',
			'src/Model/AttributeHostName.php',
			'src/Model/AttributeIPPercentage.php',
			'src/Model/AttributeMacAddress.php',
			'model.teemip-framework.php',
		),
		'webservice' => array(
			
		),
		'data.struct' => array(
			// add your 'structure' definition XML files here,
		),
		'data.sample' => array(
			// add your sample data XML files here,
		),
		
		// Documentation
		//
		'doc.manual_setup' => '', // hyperlink to manual setup documentation, if any
		'doc.more_information' => '', // hyperlink to more information, if any 

		// Default settings
		//
		'settings' => array(
			// Module specific settings go here, if any
		),
	)
);
