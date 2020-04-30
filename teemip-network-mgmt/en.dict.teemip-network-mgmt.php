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
// Classes in 'Teemip-Network-Mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// Class: DNSObject
//

Dict::Add('EN US', 'English', 'English', array(
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

Dict::Add('EN US', 'English', 'English', array(
	'Class:Domain' => 'Domain',
	'Class:Domain+' => 'DNS Domain',
	'Class:Domain:baseinfo' => 'General Information',
	'Class:Domain:admininfo' => 'Administrative Information',
	'Class:Domain:DelegatedToChild' => '<font color=#ff0000>Delegated to organization : </font>%1$s',
	'Class:Domain:DelegatedFromParent' => '<font color=#ff0000>Delegated from organization : </font>%1$s',
	'Class:Domain/Attribute:name' => 'Name',
	'Class:Domain/Attribute:name+' => '',
	'Class:Domain/Attribute:parent_org_id' => 'Delegated from',
	'Class:Domain/Attribute:parent_org_id+' => 'Organization where the Domain has been delegated from',
	'Class:Domain/Attribute:parent_org_name' => 'Delegating organization name',
	'Class:Domain/Attribute:parent_org_name+' => 'Name of the organization where the Domain has been delegated from',
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
	'Class:Domain/Attribute:registrar_id' => 'Internet Registrar',
	'Class:Domain/Attribute:registrar_id+' => 'Organization looking after the allocation of domain names.',
	'Class:Domain/Attribute:registrar_name' => 'Internet Registrar Name',
	'Class:Domain/Attribute:registrar_name+' => '',
	'Class:Domain/Attribute:validity_start' => 'Start date ',
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

Dict::Add('EN US', 'English', 'English', array(
	'Class:Domain/Tab:hosts' => 'Hosts',
	'Class:Domain/Tab:hosts+' => 'Hosts that belong to the domain',
	'Class:Domain/Tab:hosts/List0' => 'Hosts that belong to the domain and its children',
	'Class:Domain/Tab:hosts/SelectList0' => 'Display hosts that belong to the domain and its children',
	'Class:Domain/Tab:hosts/List1' => 'Hosts directly attached to the domain only',
	'Class:Domain/Tab:hosts/SelectList1' => 'Display hosts directly attached to the domain only',
	'Class:Domain/Tab:hosts/List2' => 'Hosts attached to child domains only',
	'Class:Domain/Tab:hosts/SelectList2' => 'Display hosts attached to child domains only',
	'Class:Domain/Tab:hosts/SelectList' => 'Change display',
	'Class:Domain/Tab:child_domain' => 'Child Domains',
	'Class:Domain/Tab:child_domain+' => 'Domains that are directly or indirectly attached',
	'Class:Domain/Tab:zones_list' => 'Related Zones',
	'Class:Domain/Tab:zones_list+' => 'Zones related to the current domain',
));

//
// Class: WANLink
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:WANLink' => 'WAN Link',
	'Class:WANLink+' => 'Wide Area Network Link',
	'Class:WANLink:baseinfo' => 'General Information',
	'Class:WANLink:networkinfo' => 'Network Information',
	'Class:WANLink:admininfo' => 'Administrative Information',
	'Class:WANLink:locationinfo' => 'Locations',
	'Class:WANLink:dateinfo' => 'Date Information',
	'Class:WANLink/Attribute:type_id' => 'Type',
	'Class:WANLink/Attribute:type_id+' => '',
	'Class:WANLink/Attribute:type_name' => 'Type Name',
	'Class:WANLink/Attribute:type_name+' => '',
	'Class:WANLink/Attribute:rate' => 'Rate',
	'Class:WANLink/Attribute:rate+' => '',
	'Class:WANLink/Attribute:burst_rate' => 'Burst Rate',
	'Class:WANLink/Attribute:burst_rate+' => '',
	'Class:WANLink/Attribute:underlying_rate' => 'Underlying Rate',
	'Class:WANLink/Attribute:underlying_rate+' => '',
	'Class:WANLink/Attribute:status' => 'Status',
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
	'Class:WANLink/Attribute:carrier_id' => 'Carrier',
	'Class:WANLink/Attribute:carrier_id+' => '',
	'Class:WANLink/Attribute:carrier_name' => 'Carrier Name',
	'Class:WANLink/Attribute:carrier_name+' => '',
	'Class:WANLink/Attribute:carrier_reference' => 'Carrier Reference',
	'Class:WANLink/Attribute:carrier_reference+' => '',
	'Class:WANLink/Attribute:internal_reference' => 'Internal Reference',
	'Class:WANLink/Attribute:internal_reference+' => '',
	'Class:WANLink/Attribute:networkinterface_id1' => 'Network interface #1',
	'Class:WANLink/Attribute:networkinterface_id1+' => 'Network interface at location #1',
	'Class:WANLink/Attribute:networkinterface_name1' => 'Name network interface #1',
	'Class:WANLink/Attribute:networkinterface_name1+' => '',
	'Class:WANLink/Attribute:networkinterface_id2' => 'Network interface #2',
	'Class:WANLink/Attribute:networkinterface_id2+' => 'Network interface at location #2',
	'Class:WANLink/Attribute:networkinterface_name2' => 'Name network interface #2',
	'Class:WANLink/Attribute:networkinterface_name2+' => '',
	'Class:WANLink/Attribute:purchase_date' => 'Order date',
	'Class:WANLink/Attribute:purchase_date+' => '',
	'Class:WANLink/Attribute:renewal_date' => 'Renewal date',
	'Class:WANLink/Attribute:renewal_date+' => '',
	'Class:WANLink/Attribute:decommissioning_date' => 'Decommissioning date',
	'Class:WANLink/Attribute:decommissioning_date+' => '',
));

//
// Class: WANType
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:WANType' => 'WAN Type',
	'Class:WANType+' => '',
	'Class:WANType/Attribute:description' => 'Description',
	'Class:WANType/Attribute:description+' => '',
));

//
// Class: ASNumber
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:ASNumber' => 'AS Number',
	'Class:ASNumber+' => 'Autonomous System Number',
	'Class:ASNumber:baseinfo' => 'General Information',
	'Class:ASNumber:admininfo' => 'Administrative Information',
	'Class:ASNumber/Attribute:number' => 'Number',
	'Class:ASNumber/Attribute:number+' => '',
	'Class:ASNumber/Attribute:registrar_id' => 'Registrar',
	'Class:ASNumber/Attribute:registrar_id+' => '',
	'Class:ASNumber/Attribute:registrar_name' => 'Registrar Name',
	'Class:ASNumber/Attribute:registrar_name+' => '',
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
// Class: VRF
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:VRF' => 'VRF',
	'Class:VRF+' => 'Virtual Routing and Forwarding',
	'Class:VRF:baseinfo' => 'General Information',
	'Class:VRF/Attribute:route_dist' => 'Route Distinguisher',
	'Class:VRF/Attribute:route_dist+' => '',
	'Class:VRF/Attribute:route_trgt' => 'Route Target',
	'Class:VRF/Attribute:route_trgt+' => '',
	'Class:VRF/Attribute:subnets_list' => 'Subnets',
	'Class:VRF/Attribute:subnets_list+' => '',
	'Class:VRF/Attribute:physicalinterfaces_list' => 'Physical network interfaces',
	'Class:VRF/Attribute:physicalinterfaces_list+' => '',
));

//
// Class extensions for VRF
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:VRF/Tab:ipaddresses_list' => 'Interfaces\' IPs',
	'Class:VRF/Tab:ipaddresses_list+' => 'List of all IP addresses hosted by all IP interfaces attached to the CI',
));

//
// Class: lnkPhysicalInterfaceToVRF
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkPhysicalInterfaceToVRF' => 'Link PhysicalInterface / VRF',
	'Class:lnkPhysicalInterfaceToVRF+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id' => 'Physical Interface',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name' => 'Physical Interface Name',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id' => 'Device',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name' => 'Device name',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:name' => 'Name',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:name+' => '',
));

//
// Application Menu
//

Dict::Add('EN US', 'English', 'English', array(
	'Menu:ConfigManagement:Network' => 'Network',
	'Menu:ConfigManagement:Network+' => '',

//
// Management of Domains
//
	// Creation Management	
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'Domain name already exists!',

	// Update Management
	'UI:IPManagement:Action:ChangeOrg:Domain:HasParentInOtherOrg' => 'Organization cannot change: parent domain doesn\'t belong to the new organization!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasChildren' => 'Organization cannot change: domain has children!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasHosts' => 'Organization cannot change: host of original organization are using the domain!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasZones' => 'Organization cannot change: zones are based on the domain!',

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

	// Delegate action on domains
	'UI:IPManagement:Action:Delegate:Domain' => 'Delegate',
	'UI:IPManagement:Action:Delegate:Domain:PageTitle_Object_Class' => '%1$s - Delegate',
	'UI:IPManagement:Action:Delegate:Domain:Title_Class_Object' => 'Delegate %1$s <span class="hilite">%2$s</span> to organization',
	'UI:IPManagement:Action:Delegate:Domain:ChildDomain' => 'Organization to delegate the Domain to:',
	'UI:IPManagement:Action:Delegate:Domain:NoChildOrg' => 'Domain\'s organization doesn\'t have any children and therefore, domain cannot be delegated!',
	'UI:IPManagement:Action:Delegate:Domain:NoOtherOrg' => 'There is no other organization than domain\'s organization!',
	'UI:IPManagement:Action:Delegate:Domain:IsDelegated' => 'The domain is already delegated!',
	'UI:IPManagement:Action:Delegate:Domain:CannotBeDelegated' => 'Domain cannot be delegated: %1$s',
	'UI:IPManagement:Action:Delegate:Domain:NoChangeOfOrganization' => 'Organization to delegate the domain to cannot be the same as the domain\s one!',
	'UI:IPManagement:Action:Delegate:Domain:HasHosts' => 'Domain has hosts!',
	'UI:IPManagement:Action:Delegate:Domain:HasSubDomains' => 'Domain has sub-domains!',
	'UI:IPManagement:Action:Delegate:Domain:HasZones' => 'Zones are referring to the domain!',
	'UI:IPManagement:Action:Delegate:Domain:Done' => '%1$s <span class="hilite">%2$s</span> has been delegated.',

	// Undelegate action on domains
	'UI:IPManagement:Action:Undelegate:Domain' => 'Un-delegate',
	'UI:IPManagement:Action:Undelegate:Domain:PageTitle_Object_Class' => '%1$s - Un-delegate',
	'UI:IPManagement:Action:Undelegate:Domain:CannotBeUndelegated' => 'Domain cannot be undelegated: %1$s',
	'UI:IPManagement:Action:Undelegate:Domain:IsNotDelegated' => 'Domain is not delegated',
	'UI:IPManagement:Action:Undelegate:Domain:HasHosts' => 'Domain has hosts!',
	'UI:IPManagement:Action:Undelegate:Domain:HasSubDomains' => 'Domain has sub-domains!',
	'UI:IPManagement:Action:Undelegate:Domain:HasZones' => 'Zones are referring to the domain!',
	'UI:IPManagement:Action:Undelegate:Domain:Done' => '%1$s <span class="hilite">%2$s</span> has been un-delegated.',

));
	
