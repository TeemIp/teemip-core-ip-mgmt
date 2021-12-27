<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'Teemip-Network-Mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// Class: DNSObject
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:DNSObject' => 'DNS Objekt',
	'Class:DNSObject+' => '',
	'Class:DNSObject/Attribute:org_id' => 'Organisation',
	'Class:DNSObject/Attribute:org_id+' => '',
	'Class:DNSObject/Attribute:org_name' => 'Organisationsname',
	'Class:DNSObject/Attribute:org_name+' => '',
	'Class:DNSObject/Attribute:name' => 'Name des DNS Objekts',
	'Class:DNSObject/Attribute:name+' => '',
	'Class:DNSObject/Attribute:comment' => 'Beschreibung',
	'Class:DNSObject/Attribute:comment+' => '',
));

//
// Class: Domain
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:Domain' => 'Domain',
	'Class:Domain+' => 'DNS Domain',
	'Class:Domain:baseinfo' => 'Allgemeine Informationen',
	'Class:Domain:admininfo' => 'Administrative Informationen',
	'Class:Domain:DelegatedToChild' => '<delegation_highlight>Delegated to organization : </delegation_highlight>%1$s',
	'Class:Domain:DelegatedFromParent' => '<delegation_highlight>Delegated from organization : </delegation_highlight>%1$s',
	'Class:Domain/Attribute:name' => 'Name',
	'Class:Domain/Attribute:name+' => '',
	'Class:Domain/Attribute:parent_org_id' => 'Delegiert von',
	'Class:Domain/Attribute:parent_org_id+' => 'Organisation, von der der Subnetzblock delegiert wurde',
	'Class:Domain/Attribute:parent_org_name' => 'Name der delegierenden Organisation',
	'Class:Domain/Attribute:parent_org_name+' => 'Name der Organisation, von der der Subnetzblock delegiert wurde',
	'Class:Domain/Attribute:parent_id' => 'Parent',
	'Class:Domain/Attribute:parent_id+' => '',
	'Class:Domain/Attribute:parent_name' => 'Parent Name',
	'Class:Domain/Attribute:parent_name+' => '',
	'Class:Domain/Attribute:requestor_id' => 'Anforderung durch',
	'Class:Domain/Attribute:requestor_id+' => '',
	'Class:Domain/Attribute:requestor_name' => 'Name des Anfordernden',
	'Class:Domain/Attribute:requestor_name+' => '',
	'Class:Domain/Attribute:release_date' => 'Freigabe Datum',
	'Class:Domain/Attribute:release_date+' => 'Datum, an dem die Domain wieder freigegeben wurde und nicht mehr benutzt wurde.',
	'Class:Domain/Attribute:registrar_id' => 'Internet Registrar',
	'Class:Domain/Attribute:registrar_id+' => 'Registrar, Organisation, die die Allokierung von Domain Namen überwacht.',
	'Class:Domain/Attribute:registrar_name' => 'Internet Registrar Name',
	'Class:Domain/Attribute:registrar_name+' => '',
	'Class:Domain/Attribute:validity_start' => 'Startdatum',
	'Class:Domain/Attribute:validity_start+' => 'Datum, ab dem die Domain gültig ist.',
	'Class:Domain/Attribute:validity_end' => 'Enddatum',
	'Class:Domain/Attribute:validity_end+' => 'Datum, nach dem die Domain nicht mehr gültig ist.',
	'Class:Domain/Attribute:renewal' => 'Verlängerung (Renewal)',
	'Class:Domain/Attribute:renewal+' => 'Verlängerungsmethode',
	'Class:Domain/Attribute:renewal/Value:na' => 'Nicht zutreffend',
	'Class:Domain/Attribute:renewal/Value:manual' => 'Manuell',
	'Class:Domain/Attribute:renewal/Value:automatic' => 'Automatisch',
));

//
// Class extensions for Domain
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:Domain/Tab:hosts' => 'Hosts',
	'Class:Domain/Tab:hosts+' => 'Hosts, die zur Domain gehören',
	'Class:Domain/Tab:hosts/List0' => 'Hosts, die zur Domain oder Child Domains gehören',
	'Class:Domain/Tab:hosts/SelectList0' => 'Zeigen Hosts, die zur Domain oder zu den child Domains gehören',
	'Class:Domain/Tab:hosts/List1' => 'Hosts, die nur zur Domain direkt gehören',
	'Class:Domain/Tab:hosts/SelectList1' => 'Zeigen Hosts, die nur zur Domain direkt gehören',
	'Class:Domain/Tab:hosts/List2' => 'Hosts, die zu den child Domains gehören',
	'Class:Domain/Tab:hosts/SelectList2' => 'Zeigen Hosts, die zu den child Domains gehören',
	'Class:Domain/Tab:hosts/SelectList' => 'Anzeige ändern',
	'Class:Domain/Tab:child_domain' => 'Child Domains',
	'Class:Domain/Tab:child_domain+' => 'Child Domains, die direkt angehängt sind.',
	'Class:Domain/Tab:zones_list' => 'Verwandten Zonen',
	'Class:Domain/Tab:zones_list+' => 'Zonen, die der Domain zugeordnet sind',
));

//
// Class: WANLink
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:WANLink' => 'WAN Link',
	'Class:WANLink+' => 'Wide Area Network Link',
	'Class:WANLink:baseinfo' => 'Allgemeine Informationen',
	'Class:WANLink:networkinfo' => 'Netzwerk Informationen',
	'Class:WANLink:admininfo' => 'Administrative Informationen',
	'Class:WANLink:locationinfo' => 'Standorte',
	'Class:WANLink:dateinfo' => 'Datum Informationen',
	'Class:WANLink/Attribute:type_id' => 'Typ',
	'Class:WANLink/Attribute:type_id+' => '',
	'Class:WANLink/Attribute:type_name' => 'Typ Name',
	'Class:WANLink/Attribute:type_name+' => '',
	'Class:WANLink/Attribute:rate' => 'Datenrate',
	'Class:WANLink/Attribute:rate+' => '',
	'Class:WANLink/Attribute:burst_rate' => 'Max. Geschwindigkeit',
	'Class:WANLink/Attribute:burst_rate+' => '',
	'Class:WANLink/Attribute:underlying_rate' => 'Geschwindigkeit',
	'Class:WANLink/Attribute:underlying_rate+' => '',
	'Class:WANLink/Attribute:status' => 'Status',
	'Class:WANLink/Attribute:status+' => '',
	'Class:WANLink/Attribute:status/Value:implementation' => 'Implementatierung',
	'Class:WANLink/Attribute:status/Value:implementation+' => '',
	'Class:WANLink/Attribute:status/Value:production' => 'Produktion',
	'Class:WANLink/Attribute:status/Value:production+' => '',
	'Class:WANLink/Attribute:status/Value:obsolete' => 'Veraltet (obsolet)',
	'Class:WANLink/Attribute:status/Value:obsolete+' => '',
	'Class:WANLink/Attribute:status/Value:stock' => 'Lager',
	'Class:WANLink/Attribute:status/Value:stock+' => '',
	'Class:WANLink/Attribute:location_id1' => 'Standort #1',
	'Class:WANLink/Attribute:location_id1+' => 'Standort des einen Ende des Links',
	'Class:WANLink/Attribute:location_name1' => 'Name des Standorts #1',
	'Class:WANLink/Attribute:location_name1+' => '',
	'Class:WANLink/Attribute:location_id2' => 'Standort #2',
	'Class:WANLink/Attribute:location_id2+' => 'Standort des anderen Ende des Links',
	'Class:WANLink/Attribute:location_name2' => 'Name des Standorts #2',
	'Class:WANLink/Attribute:location_name2+' => '',
	'Class:WANLink/Attribute:carrier_id' => 'Anbieter',
	'Class:WANLink/Attribute:carrier_id+' => '',
	'Class:WANLink/Attribute:carrier_name' => 'Anbieter Name',
	'Class:WANLink/Attribute:carrier_name+' => '',
	'Class:WANLink/Attribute:carrier_reference' => 'Anbieter Referenz',
	'Class:WANLink/Attribute:carrier_reference+' => '',
	'Class:WANLink/Attribute:internal_reference' => 'Intern Referenz',
	'Class:WANLink/Attribute:internal_reference+' => '',
	'Class:WANLink/Attribute:networkinterface_id1' => 'Netzwerk Interface #1',
	'Class:WANLink/Attribute:networkinterface_id1+' => 'Netzwerk Interface am Standort #1',
	'Class:WANLink/Attribute:networkinterface_name1' => 'Name des Netzwerk Interfaces #1',
	'Class:WANLink/Attribute:networkinterface_name1+' => '',
	'Class:WANLink/Attribute:networkinterface_id2' => 'Netzwerk Interface #2',
	'Class:WANLink/Attribute:networkinterface_id2+' => 'Netzwerk Interface am Standort #2',
	'Class:WANLink/Attribute:networkinterface_name2' => 'Name des Netzwerk Interfaces #2',
	'Class:WANLink/Attribute:networkinterface_name2+' => '',
	'Class:WANLink/Attribute:purchase_date' => 'Kaufdatum',
	'Class:WANLink/Attribute:purchase_date+' => '',
	'Class:WANLink/Attribute:renewal_date' => 'Verlängerungsdatum (Renewal)',
	'Class:WANLink/Attribute:renewal_date+' => '',
	'Class:WANLink/Attribute:decommissioning_date' => 'Veralterungdatum (Obsolet)',
	'Class:WANLink/Attribute:decommissioning_date+' => '',
));

//
// Class: WANType
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:WANType' => 'WAN Link Typ',
	'Class:WANType+' => '',
	'Class:WANType/Attribute:description' => 'Beschreibung',
	'Class:WANType/Attribute:description+' => '',
));

//
// Class: ASNumber
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:ASNumber' => 'AS Nummer',
	'Class:ASNumber+' => 'Autonomous System Number',
	'Class:ASNumber:baseinfo' => 'Allgemeine Informationen',
	'Class:ASNumber:admininfo' => 'Administrative Informationen',
	'Class:ASNumber/Attribute:number' => 'Nummer',
	'Class:ASNumber/Attribute:number+' => '',
	'Class:ASNumber/Attribute:registrar_id' => 'Registrar',
	'Class:ASNumber/Attribute:registrar_id+' => '',
	'Class:ASNumber/Attribute:registrar_name' => 'Registrar Name',
	'Class:ASNumber/Attribute:registrar_name+' => '',
	'Class:ASNumber/Attribute:whois' => 'Whois',
	'Class:ASNumber/Attribute:whois+' => 'URL zur Whois Information des Registrars',
	'Class:ASNumber/Attribute:move2production' => 'Registrierungsdatum',
	'Class:ASNumber/Attribute:move2production+' => 'Datum, an dem AS registriert wurde.',
	'Class:ASNumber/Attribute:validity_end' => 'Enddatum',
	'Class:ASNumber/Attribute:validity_end+' => 'Datum, nach dem AS nicht mehr gültig ist.',
	'Class:ASNumber/Attribute:renewal_date' => 'Verlängerungsdatum',
	'Class:ASNumber/Attribute:renewal_date+' => 'Datum, an dem AS verlängert wurde',
));

//
// Class: VRF
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:VRF' => 'VRF',
	'Class:VRF+' => 'Virtual Routing and Forwarding',
	'Class:VRF:baseinfo' => 'Allgemeine Informationen',
	'Class:VRF/Attribute:route_dist' => 'Route Distinguisher',
	'Class:VRF/Attribute:route_dist+' => '',
	'Class:VRF/Attribute:route_trgt' => 'Route Target',
	'Class:VRF/Attribute:route_trgt+' => '',
	'Class:VRF/Attribute:subnets_list' => 'Subnetze',
	'Class:VRF/Attribute:subnets_list+' => '',
	'Class:VRF/Attribute:physicalinterfaces_list' => 'Netzwerkinterfaces',
	'Class:VRF/Attribute:physicalinterfaces_list+' => '',
	'Class:VRF/Attribute:networkdevicevirtualinterfaces_list' => 'Network device virtual interfaces',
	'Class:VRF/Attribute:networkdevicevirtualinterfaces_list+' => 'List of all network device virtual interfaces attached to the VRF',
	'Class:VRF/Tab:ipaddresses_list' => 'IPs-Interfaces',
	'Class:VRF/Tab:ipaddresses_list+' => 'Liste aller IP-Adressen aller an das CI angeschlossenen Schnittstellen',
));

//
// Class: lnkPhysicalInterfaceToVRF
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkPhysicalInterfaceToVRF' => 'Link PhysicalInterface / VRF',
	'Class:lnkPhysicalInterfaceToVRF+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id' => 'Physisches Interface',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name' => 'Physisches Interface Name',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id' => 'Gerät',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name' => 'Gerät-Name',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:name' => 'Name',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:name+' => '',
));

//
// NetworkDevice
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:NetworkDevice/Attribute:physicalinterface_list' => 'Physical network interfaces',
	'Class:NetworkDevice/Attribute:physicalinterface_list+' => 'List of all physical network interfaces attached to the network device',
	'Class:NetworkDevice/Attribute:networkdevicevirtualinterfaces_list' => 'Virtual network interfaces',
	'Class:NetworkDevice/Attribute:networkdevicevirtualinterfaces_list+' => 'List of all virtual network interfaces attached to the network device',
	'Class:NetworkDevice/Tab:ipaddresses_list' => 'Interfaces\' IPs',
	'Class:NetworkDevice/Tab:ipaddresses_list+' => 'List of all IP addresses hosted by all physical and virtual interfaces attached to the network device',
));

//
// NetworkDeviceVirtualInterface
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:NetworkDeviceVirtualInterface' => 'Network Device Virtual Interface',
	'Class:NetworkDeviceVirtualInterface+' => 'Virtual interface attached to a network device',
	'Class:NetworkDeviceVirtualInterface/Attribute:status' => 'Status',
	'Class:NetworkDeviceVirtualInterface/Attribute:status+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:active' => 'Active',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:active+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:inactive' => 'Inactive',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:inactive+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:networkdevice_id' => 'Network device',
	'Class:NetworkDeviceVirtualInterface/Attribute:networkdevice_id+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:vlans_list' => 'VLANs',
	'Class:NetworkDeviceVirtualInterface/Attribute:vlans_list+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:NetworkDeviceVirtualInterface/Attribute:vrfs_list+' => '',
));

//
// Class: lnkNetworkDeviceVirtualInterfaceToVLAN
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN' => 'Link Network Device Virtual Interface / VLAN',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_id' => 'Network device virtual interface',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_name' => 'Network device virtual interface name',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_id' => 'Network device',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_name' => 'Network device name',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_tag' => 'Tag',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_tag+' => '',
));

//
// Class: lnkNetworkDeviceVirtualInterfaceToVRF
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF' => 'Link Network Device Virtual Interface / VRF',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_id' => 'Network device virtual interface',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_name' => 'Network device virtual interface name',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_id' => 'Network device',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_name' => 'Network device name',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:vrf_name' => 'Name',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:vrf_name+' => '',
));

//
// VLAN
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:VLAN/Attribute:physicalinterface_list+' => 'List of all physical network interfaces attached to the VLAN',
	'Class:VLAN/Attribute:networkdevicevirtualinterfaces_list' => 'Network device virtual interfaces',
	'Class:VLAN/Attribute:networkdevicevirtualinterfaces_list+' => 'List of all network device virtual interfaces attached to the VLAN',
));

//
// Application Menu
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Menu:ConfigManagement:Network' => 'Netzwerk',
	'Menu:ConfigManagement:Network+' => '',

//
// Management of Domains
//
	// Creation Management	
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'Domain Name existiert bereits!',

	// Update Management
	'UI:IPManagement:Action:ChangeOrg:Domain:HasParentInOtherOrg' => 'Die Organisation kann nicht geändert werden: Die übergeordnete Domäne gehört nicht zur neuen Organisation!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasChildren' => 'Die Organisation kann nicht ändern: Die Domain hat Subdomains!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasHosts' => 'Die Organisation kann nicht geändert werden: Hosts aus der ursprünglichen Organisation verwenden die Domäne !',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasZones' => 'Die Organisation kann nicht geändert werden: Zonen zeigen auf diesen Bereich !',

	// Display list of domains
	'UI:IPManagement:Action:DisplayList:Domain' => 'Listenansicht',
	'UI:IPManagement:Action:DisplayList:Domain+' => '',
	'UI:IPManagement:Action:DisplayList:Domain:PageTitle_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayList:Domain:Title_Class' => 'DNS Domains',

	// Display tree of domains
	'UI:IPManagement:Action:DisplayTree:Domain' => 'Baumansicht',
	'UI:IPManagement:Action:DisplayTree:Domain+' => '',
	'UI:IPManagement:Action:DisplayTree:Domain:PageTitle_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayTree:Domain:Title_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayTree:Domain:OrgName' => 'Organisation %1$s',

	// Delegate action on domains
	'UI:IPManagement:Action:Delegate:Domain' => 'Delegieren',
	'UI:IPManagement:Action:Delegate:Domain:PageTitle_Object_Class' => '%1$s - Delegieren',
	'UI:IPManagement:Action:Delegate:Domain:Title_Class_Object' => '%1$s %2$s an Organisation delegieren',
	'UI:IPManagement:Action:Delegate:Domain:ChildDomain' => 'Organisation, an die die Domain delegiert werden soll:',
	'UI:IPManagement:Action:Delegate:Domain:NoChildOrg' => 'Die Organisation des Domains hat keine Children!',
	'UI:IPManagement:Action:Delegate:Domain:NoOtherOrg' => 'Keine andere Organisation!',
	'UI:IPManagement:Action:Delegate:Domain:IsDelegated' => 'Diese Domain wurde bereits delegiert!',
	'UI:IPManagement:Action:Delegate:Domain:CannotBeDelegated' => 'Die Domain kann nicht delegiert werden: %1$s',
	'UI:IPManagement:Action:Delegate:Domain:NoChangeOfOrganization' => 'Die Organisation, an die die Domain delegiert werden soll, darf nicht mit der Domain identisch sein!',
	'UI:IPManagement:Action:Delegate:Domain:HasHosts' => 'Die Domain hat Hosts!',
	'UI:IPManagement:Action:Delegate:Domain:HasSubDomains' => 'Die Domain hat Children Domänen!',
	'UI:IPManagement:Action:Delegate:Domain:HasZones' => 'Zonen beziehen sich auf die Domain!',
	'UI:IPManagement:Action:Delegate:Domain:Done' => '%1$s %2$s wurde delegiert.',

	// Undelegate action on domains
	'UI:IPManagement:Action:Undelegate:Domain' => 'Delegierung aufheben',
	'UI:IPManagement:Action:Undelegate:Domain:PageTitle_Object_Class' => '%1$s - Delegierung aufheben',
	'UI:IPManagement:Action:Undelegate:Domain:CannotBeUndelegated' => 'Delegierung kann nicht aufgehoben werden: %1$s',
	'UI:IPManagement:Action:Undelegate:Domain:IsNotDelegated' => 'Delegierung ist nicht aufgehoben',
	'UI:IPManagement:Action:Undelegate:Domain:HasHosts' => 'Die Domain hat Hosts!',
	'UI:IPManagement:Action:Undelegate:Domain:HasSubDomains' => 'Die Domain hat Children Domänen!',
	'UI:IPManagement:Action:Undelegate:Domain:HasZones' => 'Zonen beziehen sich auf die Domain!',
	'UI:IPManagement:Action:Undelegate:Domain:Done' => '%1$s %2$s Delegierung entfernt.',

	// Look for domain when exploding FQDN
	'UI:IPManagement:Action:ExplodeFQDN:Domain:Error:CannotFindDomain' => 'Kann registrierte Domain im FQDN nicht finden!',
));
	