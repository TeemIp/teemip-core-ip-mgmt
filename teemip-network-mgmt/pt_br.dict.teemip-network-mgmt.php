<?php
// Copyright (C) 2014 TeemIp
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
 * @copyright   Copyright (C) 2014 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'Teemip-Network-Mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// Class: DNSObject
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:DNSObject' => 'DNS object',
	'Class:DNSObject+' => '',
	'Class:DNSObject/Attribute:org_id' => 'Organization',
	'Class:DNSObject/Attribute:org_id+' => '',
	'Class:DNSObject/Attribute:org_name' => 'Organization name',
	'Class:DNSObject/Attribute:org_name+' => '',
	'Class:DNSObject/Attribute:name' => 'DNS object name',
	'Class:DNSObject/Attribute:name+' => '',
	'Class:DNSObject/Attribute:comment' => 'Description',
	'Class:DNSObject/Attribute:comment+' => '',
));

//
// Class: Domain
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:Domain' => 'Domain',
	'Class:Domain+' => 'DNS Domain',
	'Class:Domain:baseinfo' => 'General Information',
	'Class:Domain:admininfo' => 'Administrative Information',
	'Class:Domain/Attribute:name' => 'Name',
	'Class:Domain/Attribute:name+' => '',
	'Class:Domain/Attribute:parent_id' => 'Parent',
	'Class:Domain/Attribute:parent_id+' => '',
	'Class:Domain/Attribute:parent_name' => 'Parent name',
	'Class:Domain/Attribute:parent_name+' => '',
	'Class:Domain/Attribute:requestor_id' => 'Requestor',
	'Class:Domain/Attribute:requestor_id+' => '',
	'Class:Domain/Attribute:requestor_name' => 'Requestor name',
	'Class:Domain/Attribute:requestor_name+' => '',
	'Class:Domain/Attribute:release_date' => 'Release date',
	'Class:Domain/Attribute:release_date+' => 'Date when domain has been released and has not been used anymore.',
	'Class:Domain/Attribute:registrar' => 'Internet Registrar',
	'Class:Domain/Attribute:registrar+' => 'Organization looking after the allocation of domain names.',
	'Class:Domain/Attribute:validity_start' => 'Sart date ',
	'Class:Domain/Attribute:validity_start+' => 'Date after which domain is valid.',
	'Class:Domain/Attribute:validity_end' => 'End date',
	'Class:Domain/Attribute:validity_end+' => 'Date after which domain is not valid anymore.',
	'Class:Domain/Attribute:renewal' => 'Renewal',
	'Class:Domain/Attribute:renewal+' => 'Renewal method',
	'Class:Domain/Attribute:renewal/Value:na' => 'Non Applicable',
	'Class:Domain/Attribute:renewal/Value:manual' => 'Manual',
	'Class:Domain/Attribute:renewal/Value:automatic' => 'Automatic',
));

//
// Class extensions for Domain
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:Domain/Tab:hosts' => 'Hosts (%1$s)',
	'Class:Domain/Tab:hosts+' => 'Hosts that belong to the domain',
	'Class:Domain/Tab:child_domain' => 'Child Domains (%1$s)',
	'Class:Domain/Tab:child_domain+' => 'Domains that are directly attached',
));

//
// Class: WANLink
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:WANLink' => 'WAN Link',
	'Class:WANLink+' => 'Wide Area Network Link',
	'Class:WANLink:baseinfo' => 'General Information',
	'Class:WANLink:carrierinfo' => 'Carrier Information',
	'Class:WANLink/Attribute:status' => 'Satus',
	'Class:WANLink/Attribute:status+' => '',
	'Class:WANLink/Attribute:status/Value:implementation' => 'Implementation',
	'Class:WANLink/Attribute:status/Value:implementation+' => '',
	'Class:WANLink/Attribute:status/Value:production' => 'Production',
	'Class:WANLink/Attribute:status/Value:production+' => '',
	'Class:WANLink/Attribute:status/Value:obsolete' => 'Obsolete',
	'Class:WANLink/Attribute:status/Value:obsolete+' => '',
	'Class:WANLink/Attribute:status/Value:stock' => 'Stock',
	'Class:WANLink/Attribute:status/Value:stock+' => '',
	'Class:WANLink/Attribute:location_id1' => 'Location #1',
	'Class:WANLink/Attribute:location_id1+' => 'Location at one end of the link',
	'Class:WANLink/Attribute:location_name1' => 'Name location #1',
	'Class:WANLink/Attribute:location_name1+' => '',
	'Class:WANLink/Attribute:location_id2' => 'Location #2',
	'Class:WANLink/Attribute:location_id2+' => 'Location at the other end of the link',
	'Class:WANLink/Attribute:location_name2' => 'Name location #2',
	'Class:WANLink/Attribute:location_name2+' => '',
	'Class:WANLink/Attribute:carrier' => 'Carrier',
	'Class:WANLink/Attribute:carrier+' => '',
	'Class:WANLink/Attribute:carrier_reference' => 'Carrier Reference',
	'Class:WANLink/Attribute:carrier_reference+' => '',
	'Class:WANLink/Attribute:networkinterface_id1' => 'Network interface #1',
	'Class:WANLink/Attribute:networkinterface_id1+' => 'Network interface at location #1',
	'Class:WANLink/Attribute:networkinterface_name1' => 'Name network interface #1',
	'Class:WANLink/Attribute:networkinterface_name1+' => '',
	'Class:WANLink/Attribute:networkinterface_id2' => 'Network interface #2',
	'Class:WANLink/Attribute:networkinterface_id2+' => 'Network interface at location #2',
	'Class:WANLink/Attribute:networkinterface_name2' => 'Name network interface #2',
	'Class:WANLink/Attribute:networkinterface_name2+' => '',
	'Class:WANLink/Attribute:purchase_date' => 'Purchase date',
	'Class:WANLink/Attribute:purchase_date+' => '',
	'Class:WANLink/Attribute:renewal_date' => 'Renewal date',
	'Class:WANLink/Attribute:renewal_date+' => '',
));

//
// Class: ASNumber
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:ASNumber' => 'AS Number',
	'Class:ASNumber+' => 'Autonomous System Number',
	'Class:ASNumber:baseinfo' => 'General Information',
	'Class:ASNumber:admininfo' => 'Administrative Information',
	'Class:ASNumber/Attribute:number' => 'Number',
	'Class:ASNumber/Attribute:number+' => '',
	'Class:ASNumber/Attribute:registrar' => 'Registrar',
	'Class:ASNumber/Attribute:registrar+' => '',
	'Class:ASNumber/Attribute:whois' => 'Whois',
	'Class:ASNumber/Attribute:whois+' => 'URL toward registrar whois information',
	'Class:ASNumber/Attribute:move2production' => 'Registration date ',
	'Class:ASNumber/Attribute:move2production+' => 'Date when AS has been registered.',
	'Class:ASNumber/Attribute:validity_end' => 'End date',
	'Class:ASNumber/Attribute:validity_end+' => 'Date after which AS is not valid anymore.',
	'Class:ASNumber/Attribute:renewal_date' => 'Renewal date',
	'Class:ASNumber/Attribute:renewal_date+' => 'Date when the AS has been renewed',
));

//
// Application Menu
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Menu:ConfigManagement:Network' => 'Network',
	'Menu:ConfigManagement:Network+' => '',

//
// Management of Domains
//
	// Creation Management	
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'Domain name already exists!',
		
	// Display list of domains
	'UI:IPManagement:Action:DisplayList:Domain' => 'Display List',
	'UI:IPManagement:Action:DisplayList:Domain+' => '',
	'UI:IPManagement:Action:DisplayList:Domain:PageTitle_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayList:Domain:Title_Class' => 'DNS Domains',
	
	// Display tree of domains
	'UI:IPManagement:Action:DisplayTree:Domain' => 'Display Tree',
	'UI:IPManagement:Action:DisplayTree:Domain+' => '',
	'UI:IPManagement:Action:DisplayTree:Domain:PageTitle_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayTree:Domain:Title_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayTree:Domain:OrgName' => 'Organization %1$s',
	
));
	