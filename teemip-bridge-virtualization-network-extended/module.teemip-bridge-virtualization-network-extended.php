<?php

// Copyright (C) 2020 TeemIp
//
//   This file is part of TeemIp.
//
//   TeemIp is free software; you can redistribute it and/or modify
//   it under the terms of the GNU Affero General Public License as published by
//   the Free Software Foundation, either version 3 of the License, or
//   (at your option) any later version.
//
//   TeemIp is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU Affero General Public License for more details.
//
//   You should have received a copy of the GNU Affero General Public License
//   along with TeemIp. If not, see <http://www.gnu.org/licenses/>

/**
 * @copyright   Copyright (C) 2020 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

SetupWebPage::AddModule(
	__FILE__, // Path to the current file, all other file names are relative to the directory containing this file
	'teemip-bridge-virtualization-network-extended/1.0.0',
	array(
		// Identification
		//
		'label' => 'Links between virtualization and network extended',
		'category' => 'business',

		// Setup
		//
		'dependencies' => array(
			'teemip-virtualization-mgmt-adaptor/2.7.0',
			'teemip-network-mgmt-extended/1.0.0',
		),
		'mandatory' => false,
		'visible' => false,
		'auto_select' => 'SetupInfo::ModuleIsSelected("teemip-virtualization-mgmt-adaptor") && SetupInfo::ModuleIsSelected("teemip-network-mgmt-extended")',

		// Components
		//
		'datamodel' => array(
		),
		'data.struct' => array(
			//'data.struct.itop-change-mgmt.xml',
		),
		'data.sample' => array(
			//'data.sample.itop-change-mgmt.xml',
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
