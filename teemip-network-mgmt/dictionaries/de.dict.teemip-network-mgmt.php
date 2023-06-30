<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
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
	'Class:DNSObject/Attribute:finalclass' => 'Typ',
	'Class:DNSObject/Attribute:finalclass+' => '',
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
	'Class:Domain:DelegatedToChild' => '<delegation_highlight>Delegiert an Organisation : </delegation_highlight>%1$s',
	'Class:Domain:DelegatedFromParent' => '<delegation_highlight>Delegiert von Organisation : </delegation_highlight>%1$s',
	'Class:Domain/Attribute:name' => 'Name',
	'Class:Domain/Attribute:name+' => '',
	'Class:Domain/Attribute:parent_org_id' => 'Delegiert von',
	'Class:Domain/Attribute:parent_org_id+' => 'Organisation, von der die Domain delegiert wurde',
	'Class:Domain/Attribute:parent_org_name' => 'Name der delegierenden Organisation',
	'Class:Domain/Attribute:parent_org_name+' => 'Name der Organisation, von der die Domain delegiert wurde',
	'Class:Domain/Attribute:parent_id' => 'übergeordnete Domain',
	'Class:Domain/Attribute:parent_id+' => '',
	'Class:Domain/Attribute:parent_name' => 'übergeordnete Domain Name',
	'Class:Domain/Attribute:parent_name+' => '',
	'Class:Domain/Attribute:requestor_id' => 'Anforderung durch',
	'Class:Domain/Attribute:requestor_id+' => '',
	'Class:Domain/Attribute:requestor_name' => 'Name des Anfordernden',
	'Class:Domain/Attribute:requestor_name+' => '',
	'Class:Domain/Attribute:release_date' => 'Freigabe Datum',
	'Class:Domain/Attribute:release_date+' => 'Datum, an dem die Domain wieder freigegeben wurde und nicht mehr benutzt wurde.',
	'Class:Domain/Attribute:registrar_id' => 'Internetregistrar',
	'Class:Domain/Attribute:registrar_id+' => 'Registrar, Organisation, die die Zuweisung der Domain überwacht.',
	'Class:Domain/Attribute:registrar_name' => 'Internetregistrar Name',
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
	'Class:Domain/Tab:hosts/SelectList0' => 'Zeigen Hosts, die zur Domain oder zu den untergeordneten Domains gehören',
	'Class:Domain/Tab:hosts/List1' => 'Hosts, die nur zur Domain direkt gehören',
	'Class:Domain/Tab:hosts/SelectList1' => 'Zeige Hosts, die nur zur Domain direkt gehören',
	'Class:Domain/Tab:hosts/List2' => 'Hosts, die zu den untergeordneten Domains gehören',
	'Class:Domain/Tab:hosts/SelectList2' => 'Zeige Hosts, die zu den untergeordneten Domains gehören',
	'Class:Domain/Tab:hosts/SelectList' => 'Anzeige ändern',
	'Class:Domain/Tab:child_domain' => 'untergeordnete Domains',
	'Class:Domain/Tab:child_domain+' => 'untergeordnete Domains, die direkt angehängt sind.',
	'Class:Domain/Tab:zones_list' => 'Verwandte Zonen',
	'Class:Domain/Tab:zones_list+' => 'Zonen, die der Domain zugeordnet sind',
));

//
// Class: WANLink
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:WANLink' => 'WAN Verbindung',
	'Class:WANLink+' => 'Wide Area Network Verbindung',
	'Class:WANLink:baseinfo' => 'Allgemeine Informationen',
	'Class:WANLink:networkinfo' => 'Netzwerk Informationen',
	'Class:WANLink:admininfo' => 'Administrative Informationen',
	'Class:WANLink:locationinfo' => 'Standortinformationen',
	'Class:WANLink:dateinfo' => 'Datumsinformationen',
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
	'Class:WANLink/Attribute:status/Value:implementation' => 'Implementierung',
	'Class:WANLink/Attribute:status/Value:implementation+' => '',
	'Class:WANLink/Attribute:status/Value:production' => 'Produktion',
	'Class:WANLink/Attribute:status/Value:production+' => '',
	'Class:WANLink/Attribute:status/Value:obsolete' => 'Veraltet (obsolet)',
	'Class:WANLink/Attribute:status/Value:obsolete+' => '',
	'Class:WANLink/Attribute:status/Value:stock' => 'Lager',
	'Class:WANLink/Attribute:status/Value:stock+' => '',
	'Class:WANLink/Attribute:location_id1' => 'Standort #1',
	'Class:WANLink/Attribute:location_id1+' => 'Standort des einen Ende der Verbindung',
	'Class:WANLink/Attribute:location_name1' => 'Name des Standorts #1',
	'Class:WANLink/Attribute:location_name1+' => '',
	'Class:WANLink/Attribute:location_id2' => 'Standort #2',
	'Class:WANLink/Attribute:location_id2+' => 'Standort des anderen Ende der Verbindung',
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
	'Class:WANLink/Attribute:networkinterface_id1' => 'Netzwerkschnittstelle #1',
	'Class:WANLink/Attribute:networkinterface_id1+' => 'Netzwerkschnittstelle am Standort #1',
	'Class:WANLink/Attribute:networkinterface_name1' => 'Name der Netzwerkschnittstelle #1',
	'Class:WANLink/Attribute:networkinterface_name1+' => '',
	'Class:WANLink/Attribute:networkinterface_id2' => 'Netzwerkschnittstelle #2',
	'Class:WANLink/Attribute:networkinterface_id2+' => 'Netzwerkschnittstelle am Standort #2',
	'Class:WANLink/Attribute:networkinterface_name2' => 'Name der Netzwerkschnittstelle #2',
	'Class:WANLink/Attribute:networkinterface_name2+' => '',
	'Class:WANLink/Attribute:purchase_date' => 'Kaufdatum',
	'Class:WANLink/Attribute:purchase_date+' => '',
	'Class:WANLink/Attribute:renewal_date' => 'Verlängerungsdatum (Renewal)',
	'Class:WANLink/Attribute:renewal_date+' => '',
	'Class:WANLink/Attribute:decommissioning_date' => 'Stilllegungsdatum (Obsolet)',
	'Class:WANLink/Attribute:decommissioning_date+' => '',
));

//
// Class: WANType
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:WANType' => 'WAN Verbindung Typ',
	'Class:WANType+' => '',
	'Class:WANType/Attribute:description' => 'Beschreibung',
	'Class:WANType/Attribute:description+' => '',
));

//
// Class: ASNumber
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:ASNumber' => 'AS Nummer',
	'Class:ASNumber+' => 'Autonomes System Nummer',
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
	'Class:VRF/Attribute:route_trgt' => 'Routenziel',
	'Class:VRF/Attribute:route_trgt+' => '',
	'Class:VRF/Attribute:subnets_list' => 'Subnetze',
	'Class:VRF/Attribute:subnets_list+' => '',
	'Class:VRF/Attribute:physicalinterfaces_list' => 'Netzwerkschnittstellen',
	'Class:VRF/Attribute:physicalinterfaces_list+' => '',
	'Class:VRF/Attribute:networkdevicevirtualinterfaces_list' => 'virtuelle Netzwerkschnittstellen',
	'Class:VRF/Attribute:networkdevicevirtualinterfaces_list+' => 'Liste aller virtuellen Netzwerkschnittstellen, welche dem VRF zugeordnet sind',
	'Class:VRF/Tab:ipaddresses_list' => 'IP Adressen',
	'Class:VRF/Tab:ipaddresses_list+' => 'Liste aller IP-Adressen aller an das CI angeschlossenen Schnittstellen',
));

//
// Class: lnkPhysicalInterfaceToVRF
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkPhysicalInterfaceToVRF' => 'Verknüpfung PhysicalInterface / VRF',
	'Class:lnkPhysicalInterfaceToVRF+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id' => 'Physische Schnittstelle',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name' => 'Physische Schnittstelle Name',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id' => 'Gerät',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name' => 'Gerät-Name',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_name' => 'VRF Name',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_name+' => '',
));

//
// NetworkDevice
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:NetworkDevice/Attribute:physicalinterface_list' => 'Physische Netzwerkschnittstellen',
	'Class:NetworkDevice/Attribute:physicalinterface_list+' => 'Liste aller physischen Netzwerkschnittstellen, welche dem Netzwerkgerät zugeordnet sind',
	'Class:NetworkDevice/Attribute:networkdevicevirtualinterfaces_list' => 'virtuelle Netzwerkschnittstellen',
	'Class:NetworkDevice/Attribute:networkdevicevirtualinterfaces_list+' => 'Liste aller virtuellen Netzwerkschnittstellen, welche dem Netzwerkgerät zugeordnet sind',
	'Class:NetworkDevice/Tab:ipaddresses_list' => 'Schnittstellen IPs',
	'Class:NetworkDevice/Tab:ipaddresses_list+' => 'Liste aller IP Adressen aller virtuellen und physischen Schnittstellen, welche dem Netzwerkgerät zugeordnet sind',
));

//
// NetworkDeviceVirtualInterface
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:NetworkDeviceVirtualInterface' => 'virtuelle Netzwerkschnittstelle',
	'Class:NetworkDeviceVirtualInterface+' => 'virtuelle Netzwerkschnittstelle eines Netzwerkgerätes',
	'Class:NetworkDeviceVirtualInterface/Attribute:status' => 'Status',
	'Class:NetworkDeviceVirtualInterface/Attribute:status+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:active' => 'Aktiv',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:active+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:inactive' => 'Inaktiv',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:inactive+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:networkdevice_id' => 'Netzwerkgerät',
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
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN' => 'Verknüpfung virtuelle Netzwerkschnittstelle / VLAN',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_id' => 'virtuelle Netzwerkschnittstelle',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_name' => 'virtuelle Netzwerkschnittstelle Name',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_id' => 'Netzwerkgerät',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_name' => 'Netzwerkgerät Name',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_tag' => 'Tag',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_tag+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode' => 'Modus',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode+' => 'Modus tagged oder untagged',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));

//
// Class: lnkNetworkDeviceVirtualInterfaceToVRF
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF' => 'Verknüpfung virtuelle Netzwerkschnittstelle / VRF',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_id' => 'virtuelle Netzwerkschnittstelle',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_name' => 'virtuelle Netzwerkschnittstelle Name',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_id' => 'Netzwerkgerät',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_name' => 'Netzwerkgerät Name',
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
	'Class:VLAN/Attribute:physicalinterface_list+' => 'Liste aller physischen Netzwerkschnittstellen, welche dem VLAN zugeordnet sind',
	'Class:VLAN/Attribute:networkdevicevirtualinterfaces_list' => 'virtuelle Netzwerkschnittstellen',
	'Class:VLAN/Attribute:networkdevicevirtualinterfaces_list+' => 'Liste aller virtuellen Netzwerkschnittstellen, welche dem VLAN zugeordnet sind',
));

//
// Application Menu
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Menu:ConfigManagement:TeemIpNetworking' => 'Netzwerk',
	'Menu:ConfigManagement:TeemIpNetworking:Interfaces' => 'Netzwerkschnittstellen',
	'Menu:ConfigManagement:TeemIpNetworking:Connectivity' => 'Konnektivität',
	'Menu:ConfigManagement:TeemIpNetworking:Naming' => 'Benennung',

//
// Management of Domains
//
	// Creation Management
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'Domain Name existiert bereits!',

	// Update Management
	'UI:IPManagement:Action:ChangeOrg:Domain:HasParentInOtherOrg' => 'Die Organisation kann nicht geändert werden: Die übergeordnete Domain gehört nicht zur neuen Organisation!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasChildren' => 'Die Organisation kann nicht geändert werden: Die Domain hat Subdomains!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasHosts' => 'Die Organisation kann nicht geändert werden: Hosts aus der ursprünglichen Organisation verwenden die Domain!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasZones' => 'Die Organisation kann nicht geändert werden: Zonen zeigen auf diesen Bereich!',

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
	'UI:IPManagement:Action:Delegate:Domain:NoChildOrg' => 'Die Organisation der Domain hat keine untergeordneten Organisationen!',
	'UI:IPManagement:Action:Delegate:Domain:NoOtherOrg' => 'Keine andere Organisation!',
	'UI:IPManagement:Action:Delegate:Domain:IsDelegated' => 'Diese Domain wurde bereits delegiert!',
	'UI:IPManagement:Action:Delegate:Domain:CannotBeDelegated' => 'Die Domain kann nicht delegiert werden: %1$s',
	'UI:IPManagement:Action:Delegate:Domain:NoChangeOfOrganization' => 'Die Organisation, an die die Domain delegiert werden soll, darf nicht mit der bisherigen Organisation identisch sein!',
	'UI:IPManagement:Action:Delegate:Domain:HasHosts' => 'Die Domain hat Hosts!',
	'UI:IPManagement:Action:Delegate:Domain:HasSubDomains' => 'Die Domain hat untergeordnete Domains!',
	'UI:IPManagement:Action:Delegate:Domain:HasZones' => 'Zonen beziehen sich auf die Domain!',
	'UI:IPManagement:Action:Delegate:Domain:Done' => '%1$s %2$s wurde delegiert.',

	// Undelegate action on domains
	'UI:IPManagement:Action:Undelegate:Domain' => 'Delegierung aufheben',
	'UI:IPManagement:Action:Undelegate:Domain:PageTitle_Object_Class' => '%1$s - Delegierung aufheben',
	'UI:IPManagement:Action:Undelegate:Domain:CannotBeUndelegated' => 'Delegierung kann nicht aufgehoben werden: %1$s',
	'UI:IPManagement:Action:Undelegate:Domain:IsNotDelegated' => 'Domain steht zur Delegierung zur Verfügung!',
	'UI:IPManagement:Action:Undelegate:Domain:HasHosts' => 'Die Domain hat Hosts!',
	'UI:IPManagement:Action:Undelegate:Domain:HasSubDomains' => 'Die Domain hat untergeordnete Domains!',
	'UI:IPManagement:Action:Undelegate:Domain:HasZones' => 'Zonen beziehen sich auf die Domain!',
	'UI:IPManagement:Action:Undelegate:Domain:Done' => '%1$s %2$s - Delegierung entfernt.',

	// Look for domain when exploding FQDN
	'UI:IPManagement:Action:ExplodeFQDN:Domain:Error:CannotFindDomain' => 'Kann registrierte Domain im FQDN nicht finden!',
));
