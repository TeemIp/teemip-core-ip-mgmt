<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

/** @noinspection PhpUnhandledExceptionInspection */
SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'teemip-newsroom-provider/1.1.1',
	array(
		// Identification
		//
		'label' => 'TeemIp Newsroom Provider',
		'category' => 'tools',

		// Setup
		//
		'dependencies' => array(
			'teemip-ip-mgmt/2.7.1',
		),
		'mandatory' => false,
		'visible' => false,
		'auto_select' => 'SetupInfo::ModuleIsSelected("teemip-ip-mgmt")',

		// Components
		//
		'datamodel' => array(
			'vendor/autoload.php',
			'src/Controller/TeemIpNewsroomProvider.php',
		),
		'webservice' => array(),
		'data.struct' => array(// add your 'structure' definition XML files here,
		),
		'data.sample' => array(// add your sample data XML files here,
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
