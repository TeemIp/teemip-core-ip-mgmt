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
	'Class:Layer2Protocol' => 'Layer 2 Protocol',
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
// Class: ClusterNetwork
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:ClusterNetwork' => 'Cluster Network',
	'Class:ClusterNetwork+' => 'Hardware component for network device',
	'Class:ClusterNetwork:baseinfo' => 'General Information',
	'Class:ClusterNetwork:moreinfo' => 'More information',
	'Class:ClusterNetwork:Date' => 'Dates',
	'Class:ClusterNetwork:otherinfo' => 'Other Information',
	'Class:ClusterNetwork/Attribute:type' => 'Type',
	'Class:ClusterNetwork/Attribute:type+' => '',
	'Class:ClusterNetwork/Attribute:type/Value:loadbalancing' => 'Load balancing',
	'Class:ClusterNetwork/Attribute:type/Value:loadbalancing+' => '',
	'Class:ClusterNetwork/Attribute:type/Value:highavailability' => 'High availability',
	'Class:ClusterNetwork/Attribute:type/Value:highavailability+' => '',
	'Class:ClusterNetwork/Attribute:type/Value:highperformance' => 'High performance',
	'Class:ClusterNetwork/Attribute:type/Value:highperformance+' => '',
	'Class:ClusterNetwork/Attribute:mode' => 'Mode',
	'Class:ClusterNetwork/Attribute:mode+' => '',
	'Class:ClusterNetwork/Attribute:mode/Value:active_standby' => 'Active / Standby',
	'Class:ClusterNetwork/Attribute:mode/Value:active_standby+' => '',
	'Class:ClusterNetwork/Attribute:mode/Value:active_passive' => 'Active / Passive',
	'Class:ClusterNetwork/Attribute:mode/Value:active_passive+' => '',
	'Class:ClusterNetwork/Attribute:mode/Value:active_active' => 'Active / Active',
    'Class:ClusterNetwork/Attribute:mode/Value:active_active+' => '',
	'Class:ClusterNetwork/Attribute:status' => 'Status',
	'Class:ClusterNetwork/Attribute:status+' => '',
	'Class:ClusterNetwork/Attribute:status/Value:production' => 'Production',
	'Class:ClusterNetwork/Attribute:status/Value:production+' => '',
	'Class:ClusterNetwork/Attribute:status/Value:implementation' => 'Implementation',
	'Class:ClusterNetwork/Attribute:status/Value:implementation+' => '',
	'Class:ClusterNetwork/Attribute:networkdevices_list' => 'Nodes',
	'Class:ClusterNetwork/Attribute:networkdevices_list+' => 'List of all network devices within the cluster',
	'Class:ClusterNetwork/Attribute:ips_list' => 'IP Addresses',
	'Class:ClusterNetwork/Attribute:ips_list+' => 'List of all IP addresses used by the cluster',
	'Class:ClusterNetwork/Attribute:connectablecis_list' => 'Devices',
	'Class:ClusterNetwork/Attribute:connectablecis_list+' => 'List of all the devices connected to this cluster network',
	'Class:ClusterNetwork/Attribute:redundancy' => 'High availability',
	'Class:ClusterNetwork/Attribute:redundancy/disabled' => 'The cluster is up if all the network devices are up',
	'Class:ClusterNetwork/Attribute:redundancy/count' => 'The cluster is up if at least %1$s network device(s) is(are) up',
	'Class:ClusterNetwork/Attribute:redundancy/percent' => 'The cluster is up if at least %1$s %% of the network devices are up',
));

//
// Class: lnkClusterNetworkToIPAddress
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkClusterNetworkToIPAddress' => 'Link Cluster Network / IP Address',
	'Class:lnkClusterNetworkToIPAddress+' => '',
	'Class:lnkClusterNetworkToIPAddress/Attribute:clusternetwork_id' => 'Cluster network',
	'Class:lnkClusterNetworkToIPAddress/Attribute:clusternetwork_id+' => '',
	'Class:lnkClusterNetworkToIPAddress/Attribute:clusternetwork_name' => 'Cluster network name',
	'Class:lnkClusterNetworkToIPAddress/Attribute:clusternetwork_name+' => '',
	'Class:lnkClusterNetworkToIPAddress/Attribute:ipaddress_id' => 'IP address',
	'Class:lnkClusterNetworkToIPAddress/Attribute:ipaddress_id+' => '',
	'Class:lnkClusterNetworkToIPAddress/Attribute:usage_id' => 'Usage',
	'Class:lnkClusterNetworkToIPAddress/Attribute:usage_id+' => '',
));

//
// Class: lnkClusterNetworkToConnectableCI
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkClusterNetworkToConnectableCI' => 'Link Cluster Network / Device',
	'Class:lnkClusterNetworkToConnectableCI+' => '',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:clusternetwork_id' => 'Cluster network',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:clusternetwork_id+' => '',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:clusternetwork_name' => 'Cluster network name',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:clusternetwork_name+' => '',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:connectableci_id' => 'Connected device',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:connectableci_id+' => '',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:connectableci_name' => 'Connected device name',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:connectableci_name+' => '',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:connection_type' => 'Connection type',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:connection_type+' => '',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:connection_type/Value:downlink' => 'Down link',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:connection_type/Value:downlink+' => '',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:connection_type/Value:uplink' => 'Up link',
	'Class:lnkClusterNetworkToConnectableCI/Attribute:connection_type/Value:uplink+' => '',
));

//
// Class: NetworkDeviceComponent
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:NetworkDeviceComponent' => 'Network Device Component',
	'Class:NetworkDeviceComponent+' => 'Hardware component for network device',
	'Class:NetworkDeviceComponent:baseinfo' => 'General Information',
	'Class:NetworkDeviceComponent:moreinfo' => 'More information',
	'Class:NetworkDeviceComponent:Date' => 'Dates',
	'Class:NetworkDeviceComponent:otherinfo' => 'Other Information',
	'Class:NetworkDeviceComponent/Attribute:networkdevice_id' => 'Network device',
	'Class:NetworkDeviceComponent/Attribute:networkdevice_id+' => 'Network device that hosts the component',
	'Class:NetworkDeviceComponent/Attribute:networkdevice_name' => 'Network device name',
	'Class:NetworkDeviceComponent/Attribute:networkdevice_name+' => '',
));

//
// Class: NetworkDevice
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:NetworkDevice/Attribute:clusternetwork_id' => 'Cluster network',
	'Class:NetworkDevice/Attribute:clusternetwork_id+' => 'Cluster that the network device belong to',
	'Class:NetworkDevice/Attribute:networkdevicecomponents_list' => 'Components',
	'Class:NetworkDevice/Attribute:networkdevicecomponents_list+' => 'List of all network device components attached to this device',
));

//
// Class: Model
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:Model/Attribute:type/Value:NetworkDeviceComponent' => 'Network Device Component',
	'Class:Model/Attribute:type/Value:NetworkDeviceComponent+' => '',
));

//
// Class: AggregateLink
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:AggregateLink' => 'Aggregate Link',
	'Class:AggregateLink+' => 'Combine multiple network connections in parallel',
	'Class:AggregateLink:baseinfo' => 'General Information',
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
	'Class:AggregateLink/Attribute:connectableci_id' => 'Device',
	'Class:AggregateLink/Attribute:connectableci_id+' => 'Device that hosts the aggregate link',
	'Class:AggregateLink/Attribute:connectableci_name' => 'Device name',
	'Class:AggregateLink/Attribute:connectableci_name+' => '',
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

