<?php
// Copyright (C) 2016 TeemIp
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
 * @copyright   Copyright (C) 2016 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'teemip-discovery Module'
//////////////////////////////////////////////////////////////////////
//

//
// Class: IPDiscovery
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPDiscovery' => 'IP Discovery Application',
	'Class:IPDiscovery+' => '',
	'Class:IPDiscovery/Name' => '%1$s',
	'Class:IPDiscovery/Attribute:last_discovery_date' => 'Last discovery date',
	'Class:IPDiscovery/Attribute:last_discovery_date+' => 'Date when the discovery run last',
	'Class:IPDiscovery/Attribute:duration' => 'Duration',
	'Class:IPDiscovery/Attribute:duration+' => 'Time it took for the last discovery to run',
	'Class:IPDiscovery/Attribute:ping_enabled' => 'Ping enabled',
	'Class:IPDiscovery/Attribute:ping_enabled+' => '',
	'Class:IPDiscovery/Attribute:ping_enabled/Value:yes' => 'Yes',
	'Class:IPDiscovery/Attribute:ping_enabled/Value:no' => 'No',
	'Class:IPDiscovery/Attribute:ping_timeout' => 'Ping timeout (s)',
	'Class:IPDiscovery/Attribute:ping_timeout+' => '',
	'Class:IPDiscovery/Attribute:iplookup_enabled' => 'IP lookup enabled',
	'Class:IPDiscovery/Attribute:iplookup_enabled/Value:yes' => 'Yes',
	'Class:IPDiscovery/Attribute:iplookup_enabled/Value:no' => 'No',
	'Class:IPDiscovery/Attribute:dns1' => 'DNS server #1',
	'Class:IPDiscovery/Attribute:dns1+' => '',
	'Class:IPDiscovery/Attribute:dns2' => 'DNS server #2',
	'Class:IPDiscovery/Attribute:dns2+' => '',
	'Class:IPDiscovery/Attribute:scan_enabled' => 'Scan enabled',
	'Class:IPDiscovery/Attribute:scan_enabled+' => '',
	'Class:IPDiscovery/Attribute:scan_enabled/Value:yes' => 'Yes',
	'Class:IPDiscovery/Attribute:scan_enabled/Value:no' => 'No',
	'Class:IPDiscovery/Attribute:port_number' => 'Port number',
	'Class:IPDiscovery/Attribute:port_number+' => '',
	'Class:IPDiscovery/Attribute:protocol' => 'Protocol',
	'Class:IPDiscovery/Attribute:protocol+' => '',
	'Class:IPDiscovery/Attribute:protocol/Value:udp' => 'UDP',
	'Class:IPDiscovery/Attribute:protocol/Value:tcp' => 'TCP',
	'Class:IPDiscovery/Attribute:protocol/Value:both' => 'Both',
	'Class:IPDiscovery/Attribute:scan_timeout' => 'Scan timeout (s)',
	'Class:IPDiscovery/Attribute:scan_timeout+' => '',
	'Class:IPDiscovery/Attribute:scan_cnx_refused_enabled' => 'Consider "connection refused" as valid',
	'Class:IPDiscovery/Attribute:scan_cnx_refused_enabled+' => '',
	'Class:IPDiscovery/Attribute:scan_cnx_refused_enabled/Value:yes' => 'Yes',
	'Class:IPDiscovery/Attribute:scan_cnx_refused_enabled/Value:no' => 'No',
	'Class:IPDiscovery/Attribute:ipv4subnets_list' => 'Managed IPv4 subnets',
	'Class:IPDiscovery/Attribute:ipv4subnets_list+' => '',
	'Class:IPDiscovery:baseinfo' => 'General Information',
	'Class:IPDiscovery:operation' => 'Operations',
	'Class:IPDiscovery:pinginfo' => 'Ping Function',
	'Class:IPDiscovery:iplookupinfo' => 'IP lookup Function',
	'Class:IPDiscovery:scaninfo' => 'Scan Function',
));

//
// Class: IPSubnet
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPSubnet/Attribute:ipdiscovery_id' => 'IP Discovery application',
	'Class:IPSubnet/Attribute:ipdiscovery_id+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_name' => 'IP Discovery Application',
	'Class:IPSubnet/Attribute:ipdiscovery_name+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_enabled' => 'Discovery activated',
	'Class:IPSubnet/Attribute:ipdiscovery_enabled+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_enabled/Value:yes' => 'Yes',
	'Class:IPSubnet/Attribute:ipdiscovery_enabled/Value:no' => 'No',
	'Class:IPSubnet/Attribute:last_discovery_date' => 'Last discovery date',
	'Class:IPSubnet/Attribute:last_discovery_date+' => 'Date when the subnet has been discovered last',
	'Class:IPSubnet/Attribute:ipdiscovery_ping_enabled' => 'IP discovery ping enabled',
	'Class:IPSubnet/Attribute:ipdiscovery_ping_enabled+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_iplookup_enabled' => 'IP discovery IP lookup enabled',
	'Class:IPSubnet/Attribute:ipdiscovery_iplookup_enabled+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_enabled' => 'IP discovery scan enabled',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_enabled+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_cnx_refused_enabled' => 'IP discovery considers scan "connection refused" as valid',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_cnx_refused_enabled+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_cnx_refused_enabled/Value:yes' => 'Yes',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_cnx_refused_enabled/Value:no' => 'No',
	'Class:IPSubnet/Attribute:ping_enabled' => 'Ping enabled for subnet',
	'Class:IPSubnet/Attribute:ping_enabled+' => '',
	'Class:IPSubnet/Attribute:ping_enabled/Value:yes' => 'Yes',
	'Class:IPSubnet/Attribute:ping_enabled/Value:no' => 'No',
	'Class:IPSubnet/Attribute:iplookup_enabled' => 'IP lookup enabled for subnet',
	'Class:IPSubnet/Attribute:iplookup_enabled+' => '',
	'Class:IPSubnet/Attribute:iplookup_enabled/Value:yes' => 'Yes',
	'Class:IPSubnet/Attribute:iplookup_enabled/Value:no' => 'No',
	'Class:IPSubnet/Attribute:scan_enabled' => 'Scan enabled for subnet',
	'Class:IPSubnet/Attribute:scan_enabled+' => '',
	'Class:IPSubnet/Attribute:scan_enabled/Value:yes' => 'Yes',
	'Class:IPSubnet/Attribute:scan_enabled/Value:no' => 'No',
	'Class:IPSubnet/Attribute:ping_duration' => 'Ping duration',
	'Class:IPSubnet/Attribute:ping_duration+' => 'Time it took for the last discovery to ping the subnet',
	'Class:IPSubnet/Attribute:iplookup_duration' => 'IP lookup duration',
	'Class:IPSubnet/Attribute:iplookup_duration+' => 'Time it took for the last discovery to IP lookup the subnet',
	'Class:IPSubnet/Attribute:scan_duration' => 'Scan duration',
	'Class:IPSubnet/Attribute:scan_duration+' => 'Time it took for the last discovery to scan the subnet',
	'Class:IPSubnet/Attribute:scan_cnx_refused_enabled' => 'Consider scan "connection refused" as valid',
	'Class:IPSubnet/Attribute:scan_cnx_refused_enabled+' => '',
	'Class:IPSubnet/Attribute:scan_cnx_refused_enabled/Value:yes' => 'Yes',
	'Class:IPSubnet/Attribute:scan_cnx_refused_enabled/Value:no' => 'No',
	'Class:IPSubnet:discoveryinfo' => 'Discovery Information',
));

//
// Class: IPAddress
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPAddress/Attribute:last_discovery_date' => 'Last discovery date',
	'Class:IPAddress/Attribute:last_discovery_date+' => 'Date when the IP has been discovered last',
	'Class:IPAddress/Attribute:responds_to_ping' => 'Responds to ping',
	'Class:IPAddress/Attribute:responds_to_ping+' => '',
	'Class:IPAddress/Attribute:responds_to_ping/Value:yes' => 'Yes',
	'Class:IPAddress/Attribute:responds_to_ping/Value:no' => 'No',
	'Class:IPAddress/Attribute:responds_to_ping/Value:na' => 'N/A',
	'Class:IPAddress/Attribute:responds_to_iplookup' => 'Responds to IP lookup',
	'Class:IPAddress/Attribute:responds_to_iplookup+' => '',
	'Class:IPAddress/Attribute:responds_to_iplookup/Value:yes' => 'Yes',
	'Class:IPAddress/Attribute:responds_to_iplookup/Value:no' => 'No',
	'Class:IPAddress/Attribute:responds_to_iplookup/Value:na' => 'N/A',
	'Class:IPAddress/Attribute:fqdn_from_iplookup' => 'FQDN from IP lookup',
	'Class:IPAddress/Attribute:fqdn_from_iplookup+' => '',
	'Class:IPAddress/Attribute:responds_to_scan' => 'Responds to scan',
	'Class:IPAddress/Attribute:responds_to_scan+' => '',
	'Class:IPAddress/Attribute:responds_to_scan/Value:yes' => 'Yes',
	'Class:IPAddress/Attribute:responds_to_scan/Value:no' => 'No',
	'Class:IPAddress/Attribute:responds_to_scan/Value:cnx_refused' => 'Connection refused',
	'Class:IPAddress/Attribute:responds_to_scan/Value:na' => 'N/A',
	'Class:IPAddress:discoveryinfo' => 'Discovery Information',
));

//
// Application Menu
//

Dict::Add('EN US', 'English', 'English', array(
	'Menu:IPDiscovery' => 'IP Discovery',
	'Menu:IPDiscoveryApplication' => 'IP Discovery Applications',
	'Menu:IPDiscoveryApplication+' => 'All IP Discovery Applications',
	'Menu:IPDiscovery:IPv4Statistics' => 'IPv4 Statistics',
	'Menu:IPDiscovery:IPv6Statistics' => 'IPv6 Statistics',
	'Menu:IPDiscovery:IPv4Status' => 'IPv4 Addresses by status',
	'Menu:IPDiscovery:IPv4Ping' => 'IPv4 Addresses that ping',
	'Menu:IPDiscovery:IPv4Scan' => 'IPv4 Addresses that answer to scan',
	'Menu:IPDiscovery:IPv4Lookup' => 'IPv4 Addresses with DNS entry',
	'Menu:IPDiscovery:IPv6Status' => 'IPv6 Addresses by status',
	'Menu:IPDiscovery:IPv6Ping' => 'IPv6 Addresses that ping',
	'Menu:IPDiscovery:IPv6Scan' => 'IPv6 Addresses that answer to scan',
	'Menu:IPDiscovery:IPv6Lookup' => 'IPv6 Address with DNS entry',
	'Menu:IPDiscovery:IPv4DiscoveredSubnets' => 'IPv4 subnets linked to an IP discovery application',
	'Menu:IPDiscovery:IPv6DiscoveredSubnets' => 'IPv6 subnets linked to an IP discovery application',
	
	'UI:IPDiscovery:Action:New:UUIDCollision' => 'UUIDs must be unique across TeemIp!',
	'UI:IPDiscovery:Action:New:ScanWithNoPort' => 'A port number must be specified when the Scan function is enabled!'
));
