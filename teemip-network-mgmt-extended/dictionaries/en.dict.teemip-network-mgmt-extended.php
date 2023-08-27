<?php
/*
 * @copyright   Copyright (C) 2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'teemip-network-mgmt-extended Module'
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
	'Class:InterfaceConnector/Attribute:physicalinterfaces_list' => 'Physical interfaces',
	'Class:InterfaceConnector/Attribute:physicalinterfaces_list+' => 'Physical interfaces with that connector',
));

//
// Class: Layer2Protocol
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:Layer2Protocol' => 'Layer 2 Protocol',
	'Class:Layer2Protocol+' => 'Layer 2 protocol used on network interfaces',
	'Class:Layer2Protocol/Attribute:description' => 'Description',
	'Class:Layer2Protocol/Attribute:description+' => '',
	'Class:Layer2Protocol/Attribute:ipinterfaces_list' => 'Network interfaces',
	'Class:Layer2Protocol/Attribute:ipinterfaces_list+' => 'Network interfaces using that protocol',
));

//
// Class: InterfaceSpeed
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:InterfaceSpeed' => 'Interface Speed',
	'Class:InterfaceSpeed+' => 'Speed set on network interfaces',
	'Class:InterfaceSpeed/Attribute:description' => 'Description',
	'Class:InterfaceSpeed/Attribute:description+' => '',
	'Class:InterfaceSpeed/Attribute:ipinterfaces_list' => 'Network interfaces',
	'Class:InterfaceSpeed/Attribute:ipinterfaces_list+' => 'Network interfaces at that speed',
));

//
// Class: IPInterface
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPInterface/Attribute:interfacespeed_id' => 'Speed',
	'Class:IPInterface/Attribute:interfacespeed_id+' => 'Maximum speed available on the interface',
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
	'Class:ClusterNetwork:moreinfo' => 'More Information',
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
	'Class:ClusterNetwork/Attribute:ips_list' => 'IP addresses',
	'Class:ClusterNetwork/Attribute:ips_list+' => 'List of all IP addresses used by the cluster',
	'Class:ClusterNetwork/Attribute:redundancy' => 'High availability',
	'Class:ClusterNetwork/Attribute:redundancy/disabled' => 'The cluster is up if all the network devices are up',
	'Class:ClusterNetwork/Attribute:redundancy/count' => 'The cluster is up if at least %1$s network device(s) is(are) up',
	'Class:ClusterNetwork/Attribute:redundancy/percent' => 'The cluster is up if at least %1$s %% of the network devices are up',
	'Class:ClusterNetwork/Tab:connectablecis_list' => 'Devices',
	'Class:ClusterNetwork/Tab:connectablecis_list+' => 'List of all the devices connected to this cluster network',
));

//
// Class: lnkClusterNetworkToIPAddress
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkClusterNetworkToIPAddress' => 'Link Cluster Network / IP Address',
	'Class:lnkClusterNetworkToIPAddress+' => '',
	'Class:lnkClusterNetworkToIPAddress/Name' => '%1$s / %2$s',
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
	'Class:NetworkDevice/Attribute:clusternetwork_role' => 'Cluster role',
	'Class:NetworkDevice/Attribute:clusternetwork_role+' => 'Role of the device in the cluster',
	'Class:NetworkDevice/Attribute:clusternetwork_role/Value:active' => 'Active',
	'Class:NetworkDevice/Attribute:clusternetwork_role/Value:active+' => '',
	'Class:NetworkDevice/Attribute:clusternetwork_role/Value:standby' => 'Standby',
	'Class:NetworkDevice/Attribute:clusternetwork_role/Value:standby+' => '',
	'Class:NetworkDevice/Attribute:networkdevicecomponents_list' => 'Components',
	'Class:NetworkDevice/Attribute:networkdevicecomponents_list+' => 'List of all network device components attached to this device',
	'Class:NetworkDevice/Attribute:aggregatelinks_list' => 'Aggregate links',
	'Class:NetworkDevice/Attribute:aggregatelinks_list+' => 'List of all aggregate links attached to this device',
    'Class:NetworkDevice/Attribute:snmpcredentials_id' => 'SNMP Credentials',
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
	'Class:AggregateLink/Attribute:peer_id' => 'Peer aggregate',
	'Class:AggregateLink/Attribute:peer_id+' => 'Aggregate link of the device at the other end of this link',
	'Class:AggregateLink/Attribute:physicalinterfaces_list' => 'Physical interfaces',
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
	'Class:PhysicalInterface/Attribute:aggregatelink_id+' => 'Aggregate link that the interface is part of',
	'Class:PhysicalInterface/Attribute:aggregatelink_name' => 'Aggregate link name',
	'Class:PhysicalInterface/Attribute:aggregatelink_name+' => '',
));

//
// Class: VLAN
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:VLAN:baseinfo' => 'General Information',
	'Class:VLAN/Attribute:vlan_tag' => 'Tag',
	'Class:VLAN/Attribute:vlan_tag+' => 'Integer value only',
	'Class:VLAN/Attribute:name' => 'Name',
	'Class:VLAN/Attribute:name+' => '',
	'Class:VLAN/Attribute:status' => 'Status',
	'Class:VLAN/Attribute:status+' => '',
	'Class:VLAN/Attribute:status/Value:used' => 'Used',
	'Class:VLAN/Attribute:status/Value:used+' => '',
	'Class:VLAN/Attribute:status/Value:unused' => 'Unused',
	'Class:VLAN/Attribute:status/Value:unused+' => '',
	'Class:VLAN/Attribute:status/Value:reserved' => 'Reserved',
	'Class:VLAN/Attribute:status/Value:reserved+' => '',
	'Class:VLAN/Attribute:type' => 'Type',
	'Class:VLAN/Attribute:type+' => '',
	'Class:VLAN/Attribute:type/Value:port_based' => 'Port based',
	'Class:VLAN/Attribute:type/Value:port_based+' => '',
	'Class:VLAN/Attribute:type/Value:mac_based' => 'MAC address based',
	'Class:VLAN/Attribute:type/Value:mac_based+' => '',
	'Class:VLAN/Attribute:type/Value:network_based' => 'Network based',
	'Class:VLAN/Attribute:type/Value:network_based+' => '',
	'Class:VLAN/Attribute:type/Value:protocol_based' => 'Protocol based',
	'Class:VLAN/Attribute:type/Value:protocol_based+' => '',
));

//
// Class: SnmpCredentials
//

Dict::Add('EN US', 'English', 'English', array(
    'Class:SnmpCredentials' => 'SNMP Credentials',
    'Class:SnmpCredentials/Attribute:auth_passphrase' => 'Authentication passphrase',
    'Class:SnmpCredentials/Attribute:auth_protocol' => 'Authentication protocol',
    'Class:SnmpCredentials/Attribute:auth_protocol/Value:md5' => 'MD5',
    'Class:SnmpCredentials/Attribute:auth_protocol/Value:sha' => 'SHA',
    'Class:SnmpCredentials/Attribute:community' => 'Community',
    'Class:SnmpCredentials/Attribute:context_name' => 'Context name',
    'Class:SnmpCredentials/Attribute:description' => 'Description',
    'Class:SnmpCredentials/Attribute:device_list' => 'Devices',
    'Class:SnmpCredentials/Attribute:device_list+' => 'Devices using these credentials.',
    'Class:SnmpCredentials/Attribute:name' => 'Name',
    'Class:SnmpCredentials/Attribute:org_id' => 'Organization',
    'Class:SnmpCredentials/Attribute:priv_passphrase' => 'Privacy passphrase',
    'Class:SnmpCredentials/Attribute:priv_protocol' => 'Privacy protocol',
    'Class:SnmpCredentials/Attribute:priv_protocol/Value:aes' => 'AES',
    'Class:SnmpCredentials/Attribute:priv_protocol/Value:des' => 'DES',
    'Class:SnmpCredentials/Attribute:security_level' => 'Security level',
    'Class:SnmpCredentials/Attribute:security_level/Value:authNoPriv' => 'AuthNoPriv',
    'Class:SnmpCredentials/Attribute:security_level/Value:authPriv' => 'AuthPriv',
    'Class:SnmpCredentials/Attribute:security_level/Value:noAuthNoPriv' => 'NoAuthNoPriv',
    'Class:SnmpCredentials/Attribute:security_name' => 'Security name',
    'SnmpCredentials:baseinfo' => 'General Information',
    'SnmpCredentials:v1-v2c' => 'SNMP V1 / V2c',
    'SnmpCredentials:v3' => 'SNMP V3',
));


//
// Application Menu
//

Dict::Add('EN US', 'English', 'English', array(
	'Menu:NetworkMgmtExtended:Typology' => 'Network typology configuration',
));

