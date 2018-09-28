<?php
SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'teemip-ip-discovery/0.2.0',
	array(
		// Identification
		//
		'label' => 'IP Discovery',
		'category' => 'business',
		
		// Setup
		//
		'dependencies' => array(
			'teemip-ip-mgmt/2.3.0',
		),
		'mandatory' => false,
		'visible' => true,
		
		// Components
		//
		'datamodel' => array(
			'model.teemip-ip-discovery.php',
		),
		'data.struct' => array(
			//'data.struct.IPAudit.xml',
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
