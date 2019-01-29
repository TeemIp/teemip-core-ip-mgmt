<?php
SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'teemip-dhcp-mgmt/0.1.1',
	array(
		// Identification
		//
		'label' => 'DHCP Management',
		'category' => 'business',
		
		// Setup
		//
		'dependencies' => array(
			'teemip-ip-mgmt/2.1.0',
			'teemip-ipv6-mgmt/2.1.0',
		),
		'mandatory' => false,
		'visible' => true,
		
		// Components
		//
		'datamodel' => array(
			'model.teemip-dhcp-mgmt.php',
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
?>
