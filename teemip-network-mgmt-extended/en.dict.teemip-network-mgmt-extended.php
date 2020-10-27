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

//////////////////////////////////////////////////////////////////////
// Classes in 'teemip-network-mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// Class: InterfaceConnector
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:InterfaceConnector' => 'Interface Connector',
	'Class:InterfaceConnector+' => 'Connector used on network interfaces',
	'Class:InterfaceConnector/Attribute:description' => 'Description',
	'Class:InterfaceConnector/Attribute:description+' => '',
	'Class:InterfaceConnector/Attribute:physicalinterfaces_list' => 'Physical Interfaces',
	'Class:InterfaceConnector/Attribute:physicalinterfaces_list+' => '',
));

//
// Class: Layer2Protocol
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:Layer2Protocol' => 'Layer 2 protocol',
	'Class:Layer2Protocol+' => 'Layer 2 protocol used on network interfaces',
	'Class:Layer2Protocol/Attribute:description' => 'Description',
	'Class:Layer2Protocol/Attribute:description+' => '',
	'Class:Layer2Protocol/Attribute:ipinterfaces_list' => 'Network Interfaces',
	'Class:Layer2Protocol/Attribute:ipinterfaces_list+' => '',
));

//
// Class: InterfaceSpeed
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:InterfaceSpeed' => 'Interface Speed',
	'Class:InterfaceSpeed+' => 'Speed set on network interfaces',
	'Class:InterfaceSpeed/Attribute:description' => 'Description',
	'Class:InterfaceSpeed/Attribute:description+' => '',
	'Class:InterfaceSpeed/Attribute:ipinterfaces_list' => 'Network Interfaces',
	'Class:InterfaceSpeed/Attribute:ipinterfaces_list+' => '',
));

//
// Class: IPInterface
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPInterface/Attribute:interfacespeed_id' => 'Speed',
	'Class:IPInterface/Attribute:interfacespeed_id+' => '',
	'Class:IPInterface/Attribute:layer2protocol_id' => 'Protocol',
	'Class:IPInterface/Attribute:layer2protocol_id+' => 'Layer 2 protocol',
));

//
// Class: AggregateLink
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:AggregateLink' => 'Aggregate Link',
	'Class:AggregateLink+' => 'Combine multiple network connections in parallel',
	'Class:AggregateLink/Attribute:macaddress' => 'MAC address',
	'Class:AggregateLink/Attribute:macaddress+' => '',
	'Class:AggregateLink/Attribute:layer2protocol_id' => 'Protocol',
	'Class:AggregateLink/Attribute:layer2protocol_id+' => 'Layer 2 protocol',
	'Class:AggregateLink/Attribute:status' => 'Status',
	'Class:AggregateLink/Attribute:status+' => '',
	'Class:AggregateLink/Attribute:status/Value:active' => 'Active',
	'Class:AggregateLink/Attribute:status/Value:active+' => '',
	'Class:AggregateLink/Attribute:status/Value:inactive' => 'Inactive',
	'Class:AggregateLink/Attribute:status/Value:inactive+' => '',
	'Class:AggregateLink/Attribute:description' => 'Description',
	'Class:AggregateLink/Attribute:description+' => '',
	'Class:AggregateLink/Attribute:physicalinterfaces_list' => 'Physical Interfaces',
	'Class:AggregateLink/Attribute:physicalinterfaces_list+' => '',
));

//
// Class: PhysicalInterface
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:PhysicalInterface/Attribute:interfaceconnector_id' => 'Connector',
	'Class:PhysicalInterface/Attribute:interfaceconnector_id+' => '',
	'Class:PhysicalInterface/Attribute:interfaceconnector_name' => 'Connector name',
	'Class:PhysicalInterface/Attribute:interfaceconnector_name+' => '',
	'Class:PhysicalInterface/Attribute:aggregatelink_id' => 'Aggregate link',
	'Class:PhysicalInterface/Attribute:aggregatelink_id+' => '',
	'Class:PhysicalInterface/Attribute:aggregatelink_name' => 'Aggregate link name',
	'Class:PhysicalInterface/Attribute:aggregatelink_name+' => '',
));

//
// Application Menu
//

Dict::Add('EN US', 'English', 'English', array(
	'Menu:NetworkMgmtExtended:Typology' => 'Network Typology Configuration',
));

