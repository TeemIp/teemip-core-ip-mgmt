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

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPDiscovery' => 'IP-Entdeckung Anwendung',
	'Class:IPDiscovery+' => '',
	'Class:IPDiscovery/Name' => '%1$s',
	'Class:IPDiscovery/Attribute:ping_enabled' => 'Ping enabled',
	'Class:IPDiscovery/Attribute:ping_enabled+' => '',
	'Class:IPDiscovery/Attribute:ping_enabled/Value:yes' => 'Ja',
	'Class:IPDiscovery/Attribute:ping_enabled/Value:no' => 'Nein',
	'Class:IPDiscovery/Attribute:ping_timeout' => 'Ping Timeout-Zeit',
	'Class:IPDiscovery/Attribute:ping_timeout+' => '',
	'Class:IPDiscovery/Attribute:iplookup_enabled' => 'IP-Auflösung ermöglicht',
	'Class:IPDiscovery/Attribute:iplookup_enabled/Value:yes' => 'Ja',
	'Class:IPDiscovery/Attribute:iplookup_enabled/Value:no' => 'Nein',
	'Class:IPDiscovery/Attribute:dns1' => 'DNS-Server #1',
	'Class:IPDiscovery/Attribute:dns1+' => '',
	'Class:IPDiscovery/Attribute:dns2' => 'DNS-Server #2',
	'Class:IPDiscovery/Attribute:dns2+' => '',
	'Class:IPDiscovery/Attribute:scan_enabled' => 'Scan ermöglicht',
	'Class:IPDiscovery/Attribute:scan_enabled+' => '',
	'Class:IPDiscovery/Attribute:scan_enabled/Value:yes' => 'Ja',
	'Class:IPDiscovery/Attribute:scan_enabled/Value:no' => 'Nein',
	'Class:IPDiscovery/Attribute:port_number' => 'Portnummer',
	'Class:IPDiscovery/Attribute:port_number+' => '',
	'Class:IPDiscovery/Attribute:protocol' => 'Protokoll',
	'Class:IPDiscovery/Attribute:protocol+' => '',
	'Class:IPDiscovery/Attribute:protocol/Value:udp' => 'UDP',
	'Class:IPDiscovery/Attribute:protocol/Value:tcp' => 'TCP',
	'Class:IPDiscovery/Attribute:protocol/Value:both' => 'Beide',
	'Class:IPDiscovery/Attribute:scan_timeout' => 'Scan Timeout-Zeit',
	'Class:IPDiscovery/Attribute:scan_timeout+' => '',
	'Class:IPDiscovery/Attribute:ipv4subnets_list' => 'Verwaltete IPv4 Subnetz',
	'Class:IPDiscovery/Attribute:ipv4subnets_list+' => '',
	'Class:IPDiscovery:baseinfo' => 'Allgemeine Hinweise',
	'Class:IPDiscovery:pinginfo' => 'Ping-Funktion',
	'Class:IPDiscovery:iplookupinfo' => 'IP-Auflösung-Funktion',
	'Class:IPDiscovery:scaninfo' => 'Scan-Funktion',
));

//
// Class: IPSubnet
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPSubnet/Attribute:ipdiscovery_id' => 'IP-Entdeckung Anwendung',
	'Class:IPSubnet/Attribute:ipdiscovery_id+' => '',
	'Class:IPAddress/Attribute:ipdiscovery_name' => 'IP-Entdeckung Anwendung Name',
	'Class:IPAddress/Attribute:ipdiscovery_name+' => '',
	'Class:IPSubnet/Attribute:last_discovery_date' => 'Datum der letzten Entdeckung',
	'Class:IPSubnet/Attribute:last_discovery_date+' => 'Datum, an dem das Subnetz zuletzt entdeckt wurde',
	'Class:IPSubnet/Attribute:ipdiscovery_ping_enabled' => 'IP-Entdeckung Ping ermöglicht',
	'Class:IPSubnet/Attribute:ipdiscovery_ping_enabled+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_iplookup_enabled' => 'IP-Entdeckung IP-Auflösung ermöglicht',
	'Class:IPSubnet/Attribute:ipdiscovery_iplookup_enabled+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_enabled' => 'IP-Entdeckung Scan ermöglicht',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_enabled+' => '',
	'Class:IPSubnet/Attribute:ping_enabled' => 'Ping ermöglicht für der Subnetz',
	'Class:IPSubnet/Attribute:ping_enabled+' => '',
	'Class:IPSubnet/Attribute:ping_enabled/Value:yes' => 'Ja',
	'Class:IPSubnet/Attribute:ping_enabled/Value:no' => 'Nein',
	'Class:IPSubnet/Attribute:iplookup_enabled' => 'IP-Auflösung ermöglicht für der Subnetz',
	'Class:IPSubnet/Attribute:iplookup_enabled+' => '',
	'Class:IPSubnet/Attribute:iplookup_enabled/Value:yes' => 'Ja',
	'Class:IPSubnet/Attribute:iplookup_enabled/Value:no' => 'Nein',
	'Class:IPSubnet/Attribute:scan_enabled' => 'Scan ermöglicht für der Subnetz',
	'Class:IPSubnet/Attribute:scan_enabled+' => '',
	'Class:IPSubnet/Attribute:scan_enabled/Value:yes' => 'Ja',
	'Class:IPSubnet/Attribute:scan_enabled/Value:no' => 'Nein',
	'Class:IPSubnet/Attribute:ping_duration' => 'Dauer der IP-Ping',
	'Class:IPSubnet/Attribute:ping_duration+' => 'Zeit, die benötigt wurde, um alle IPs im Subnetz zu "pingen"',
	'Class:IPSubnet/Attribute:iplookup_duration' => 'Dauer der IP-Auflösung',
	'Class:IPSubnet/Attribute:iplookup_duration+' => 'Zeit, die benötigt wurde, um eine IP-Auflösung für alle IPs im Subnetz durchzuführen',
	'Class:IPSubnet/Attribute:scan_duration' => 'Dauer der IP-Scan',
	'Class:IPSubnet/Attribute:scan_duration+' => 'Zeit, die benötigt wurde, um alle IP-Adressen im Subnetz zu scan',
	'Class:IPSubnet:discoveryinfo' => 'Entdeckung informationen',
));

//
// Class: IPAddress
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPAddress/Attribute:last_discovery_date' => 'Datum der letzten Entdeckung',
	'Class:IPAddress/Attribute:last_discovery_date+' => 'Datum, an dem die Adresse zuletzt entdeckt wurde',
	'Class:IPAddress/Attribute:responds_to_ping' => 'Antwortet auf Ping',
	'Class:IPAddress/Attribute:responds_to_ping+' => '',
	'Class:IPAddress/Attribute:responds_to_ping/Value:yes' => 'Ja',
	'Class:IPAddress/Attribute:responds_to_ping/Value:no' => 'Nein',
	'Class:IPAddress/Attribute:responds_to_ping/Value:na' => 'N/A',
	'Class:IPAddress/Attribute:responds_to_iplookup' => 'Antwortet auf IP-Auflösung',
	'Class:IPAddress/Attribute:responds_to_iplookup+' => '',
	'Class:IPAddress/Attribute:responds_to_iplookup/Value:yes' => 'Ja',
	'Class:IPAddress/Attribute:responds_to_iplookup/Value:no' => 'Nein',
	'Class:IPAddress/Attribute:responds_to_iplookup/Value:na' => 'N/A',
	'Class:IPAddress/Attribute:fqdn_from_iplookup' => 'FQDN von IP-Auflösung',
	'Class:IPAddress/Attribute:fqdn_from_iplookup+' => '',
	'Class:IPAddress/Attribute:responds_to_scan' => 'Antwortet auf Scan',
	'Class:IPAddress/Attribute:responds_to_scan+' => '',
	'Class:IPAddress/Attribute:responds_to_scan/Value:yes' => 'Ja',
	'Class:IPAddress/Attribute:responds_to_scan/Value:no' => 'Nein',
	'Class:IPAddress/Attribute:responds_to_scan/Value:na' => 'N/A',
	'Class:IPAddress:discoveryinfo' => 'Entdeckung Informationen',
));

//
// Application Menu
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Menu:IPDiscovery' => 'IP-Entdeckung',
	'Menu:IPDiscoveryApplication' => 'IP-Entdeckung Anwendungen',
	'Menu:IPDiscoveryApplication+' => 'Alle IP-Entdeckung Anwendungen',
	'Menu:IPDiscovery:IPv4Statistics' => 'IPv4 Statistiken',
	'Menu:IPDiscovery:IPv6Statistics' => 'IPv6 Statistiken',
	'Menu:IPDiscovery:IPv4Status' => 'IPv4 Addressen bei Zustand',
	'Menu:IPDiscovery:IPv4Ping' => 'IPv4 Addressen mit ein Ping',
	'Menu:IPDiscovery:IPv4Scan' => 'IPv4 Addressen mit einer Antwort auf der Scan',
	'Menu:IPDiscovery:IPv4Lookup' => 'IPv4 Addressen mit DNS-Eintrag',
	'Menu:IPDiscovery:IPv6Status' => 'IPv6 Addressen bei Zustand',
	'Menu:IPDiscovery:IPv6Ping' => 'IPv6 Addressen mit ein Ping',
	'Menu:IPDiscovery:IPv6Scan' => 'IPv6 Addressen mit einer Antwort auf der Scan',
	'Menu:IPDiscovery:IPv6Lookup' => 'IPv6 Address mit DNS-Eintrag',
	'Menu:IPDiscovery:IPv4DiscoveredSubnets' => 'IPv4 Subnetz verknüpft an eine IP-Entdeckung Anwendung',
	'Menu:IPDiscovery:IPv6DiscoveredSubnets' => 'IPv6 Subnetz verknüpft an eine IP-Entdeckung Anwendung',

	'UI:IPDiscovery:Action:New:UUIDCollision' => 'UUIDs muss über TeemIp eindeutig sein!',
	'UI:IPDiscovery:Action:New:ScanWithNoPort' => 'Ein Portnummer musst angegeben sein wenn der Scan-Funktion ermöglicht ist!'
));
