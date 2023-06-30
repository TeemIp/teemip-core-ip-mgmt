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

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:DNSObject' => 'Oggetto DNS',
	'Class:DNSObject+' => '',
	'Class:DNSObject/Attribute:finalclass' => 'Tipo',
	'Class:DNSObject/Attribute:finalclass+' => '',
	'Class:DNSObject/Attribute:org_id' => 'Organizzazione',
	'Class:DNSObject/Attribute:org_id+' => '',
	'Class:DNSObject/Attribute:org_name' => 'Nome dell\'Organizzazione',
	'Class:DNSObject/Attribute:org_name+' => '',
	'Class:DNSObject/Attribute:name' => 'Nome dell\'Oggetto DNS',
	'Class:DNSObject/Attribute:name+' => '',
	'Class:DNSObject/Attribute:comment' => 'Descrizione',
	'Class:DNSObject/Attribute:comment+' => '',
));

//
// Class: Domain
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:Domain' => 'Dominio',
	'Class:Domain+' => 'Dominio DNS',
	'Class:Domain:baseinfo' => 'Informazioni Generali',
	'Class:Domain:admininfo' => 'Informazioni Amministrative',
	'Class:Domain:DelegatedToChild' => '<delegation_highlight>Delegato all\'organizzazione: </delegation_highlight>%1$s',
	'Class:Domain:DelegatedFromParent' => '<delegation_highlight>Delegato dell\'organizzazione: </delegation_highlight>%1$s',
	'Class:Domain/Attribute:name' => 'Nome',
	'Class:Domain/Attribute:name+' => '',
	'Class:Domain/Attribute:parent_org_id' => 'Delegato da',
	'Class:Domain/Attribute:parent_org_id+' => 'Organizzazione da cui il dominio è stato delegato',
	'Class:Domain/Attribute:parent_org_name' => 'Nome dell\'Organizzazione delegante',
	'Class:Domain/Attribute:parent_org_name+' => 'Nome dell\'organizzazione da cio il domainio è stato delegato',
	'Class:Domain/Attribute:parent_id' => 'Genitore',
	'Class:Domain/Attribute:parent_id+' => '',
	'Class:Domain/Attribute:parent_name' => 'Nome del Genitore',
	'Class:Domain/Attribute:parent_name+' => '',
	'Class:Domain/Attribute:requestor_id' => 'Richiedente',
	'Class:Domain/Attribute:requestor_id+' => '',
	'Class:Domain/Attribute:requestor_name' => 'Nome del Richiedente',
	'Class:Domain/Attribute:requestor_name+' => '',
	'Class:Domain/Attribute:release_date' => 'Data di Rilascio',
	'Class:Domain/Attribute:release_date+' => 'Data in cui il dominio Þ stato rilasciato e non Þ pi¨ stato utilizzato.',
	'Class:Domain/Attribute:registrar_id' => 'Registrar Internet',
	'Class:Domain/Attribute:registrar_id+' => 'Organizzazione che si occupa dell\'assegnazione dei nomi di dominio.',
	'Class:Domain/Attribute:registrar_name' => 'Nome Registrar Internet',
	'Class:Domain/Attribute:registrar_name+' => '',
	'Class:Domain/Attribute:validity_start' => 'Data di Inizio',
	'Class:Domain/Attribute:validity_start+' => 'Data dopo quale dominio Þ valido.',
	'Class:Domain/Attribute:validity_end' => 'Data di Fine',
	'Class:Domain/Attribute:validity_end+' => 'Data dopo quale dominio non Þ pi¨ valido.',
	'Class:Domain/Attribute:renewal' => 'Rinnovo',
	'Class:Domain/Attribute:renewal+' => 'Metodo di rinnovo',
	'Class:Domain/Attribute:renewal/Value:na' => 'Non Applicabile',
	'Class:Domain/Attribute:renewal/Value:manual' => 'Manuale',
	'Class:Domain/Attribute:renewal/Value:automatic' => 'Automatico',
));

//
// Class extensions for Domain
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:Domain/Tab:hosts' => 'Hosts',
	'Class:Domain/Tab:hosts+' => 'Hosts che appartengono al dominio',
	'Class:Domain/Tab:hosts/List0' => 'Hosts che appartengono al dominio e ai suoi figli',
	'Class:Domain/Tab:hosts/SelectList0' => 'Visualizza host che appartengono al dominio e ai suoi figli',
	'Class:Domain/Tab:hosts/List1' => 'Host collegati direttamente al dominio',
	'Class:Domain/Tab:hosts/SelectList1' => 'Visualizza host direttamente collegati al dominio',
	'Class:Domain/Tab:hosts/List2' => 'Hosts associati solo a domini figli',
	'Class:Domain/Tab:hosts/SelectList2' => 'Visualizza host collegati direttamente al domini figli',
	'Class:Domain/Tab:hosts/SelectList' => 'Cambia il display',
	'Class:Domain/Tab:child_domain' => 'Domini Figli',
	'Class:Domain/Tab:child_domain+' => 'Domini direttamente collegati',
	'Class:Domain/Tab:zones_list' => 'Zone associate',
	'Class:Domain/Tab:zones_list+' => 'Zone relative al dominio corrente',
));

//
// Class: WANLink
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:WANLink' => 'Collegamento WAN',
	'Class:WANLink+' => 'Collegamento alla rete geografica',
	'Class:WANLink:baseinfo' => 'Informazioni Generali',
	'Class:WANLink:networkinfo' => 'Informazioni di rete',
	'Class:WANLink:admininfo' => 'Informazioni Amministrative',
	'Class:WANLink:locationinfo' => 'LocalitÓ',
	'Class:WANLink:dateinfo' => 'Informazioni sulla data',
	'Class:WANLink/Attribute:type_id' => 'Tipo',
	'Class:WANLink/Attribute:type_id+' => '',
	'Class:WANLink/Attribute:type_name' => 'Nome Tipo',
	'Class:WANLink/Attribute:type_name+' => '',
	'Class:WANLink/Attribute:rate' => 'Rateo',
	'Class:WANLink/Attribute:rate+' => '',
	'Class:WANLink/Attribute:burst_rate' => 'Rateo di combustione',
	'Class:WANLink/Attribute:burst_rate+' => '',
	'Class:WANLink/Attribute:underlying_rate' => 'Tasso Sottostante',
	'Class:WANLink/Attribute:underlying_rate+' => '',
	'Class:WANLink/Attribute:status' => 'Stato',
	'Class:WANLink/Attribute:status+' => '',
	'Class:WANLink/Attribute:status/Value:implementation' => 'Implementazione',
	'Class:WANLink/Attribute:status/Value:implementation+' => '',
	'Class:WANLink/Attribute:status/Value:production' => 'Produzione',
	'Class:WANLink/Attribute:status/Value:production+' => '',
	'Class:WANLink/Attribute:status/Value:obsolete' => 'Obsoleto',
	'Class:WANLink/Attribute:status/Value:obsolete+' => '',
	'Class:WANLink/Attribute:status/Value:stock' => 'Scorta',
	'Class:WANLink/Attribute:status/Value:stock+' => '',
	'Class:WANLink/Attribute:location_id1' => 'LocalitÓ #1',
	'Class:WANLink/Attribute:location_id1+' => 'LocalitÓ a un\'estremitÓ del collegamento',
	'Class:WANLink/Attribute:location_name1' => 'Nome della LocalitÓ #1',
	'Class:WANLink/Attribute:location_name1+' => '',
	'Class:WANLink/Attribute:location_id2' => 'LocalitÓ #2',
	'Class:WANLink/Attribute:location_id2+' => 'LocalitÓ a un\'altra estremitÓ del collegamento',
	'Class:WANLink/Attribute:location_name2' => 'Nome della localitÓ #2',
	'Class:WANLink/Attribute:location_name2+' => '',
	'Class:WANLink/Attribute:carrier_id' => 'Vettore',
	'Class:WANLink/Attribute:carrier_id+' => '',
	'Class:WANLink/Attribute:carrier_name' => 'Nome del Vettore',
	'Class:WANLink/Attribute:carrier_name+' => '',
	'Class:WANLink/Attribute:carrier_reference' => 'Carrier ReferenceRiferimento del vettore',
	'Class:WANLink/Attribute:carrier_reference+' => '',
	'Class:WANLink/Attribute:internal_reference' => 'Riferimento Interno',
	'Class:WANLink/Attribute:internal_reference+' => '',
	'Class:WANLink/Attribute:networkinterface_id1' => 'Interfaccia rete #1',
	'Class:WANLink/Attribute:networkinterface_id1+' => 'Interfaccia rete presso la LocalitÓ #1',
	'Class:WANLink/Attribute:networkinterface_name1' => 'Nome dell\'interfaccia di rete #1',
	'Class:WANLink/Attribute:networkinterface_name1+' => '',
	'Class:WANLink/Attribute:networkinterface_id2' => 'Interfaccia di rete #2',
	'Class:WANLink/Attribute:networkinterface_id2+' => 'Interfaccia rete presso la LocalitÓ location #2',
	'Class:WANLink/Attribute:networkinterface_name2' => 'Nome dell\'interfaccia di rete #2',
	'Class:WANLink/Attribute:networkinterface_name2+' => '',
	'Class:WANLink/Attribute:purchase_date' => 'Data dell\'ordine',
	'Class:WANLink/Attribute:purchase_date+' => '',
	'Class:WANLink/Attribute:renewal_date' => 'Data di rinnovo',
	'Class:WANLink/Attribute:renewal_date+' => '',
	'Class:WANLink/Attribute:decommissioning_date' => 'Data di ritiro',
	'Class:WANLink/Attribute:decommissioning_date+' => '',
));

//
// Class: WANType
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:WANType' => 'Tipo WAN',
	'Class:WANType+' => '',
	'Class:WANType/Attribute:description' => 'Descrizione',
	'Class:WANType/Attribute:description+' => '',
));

//
// Class: ASNumber
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:ASNumber' => 'AS Numero',
	'Class:ASNumber+' => 'Numero di sistema autonomo',
	'Class:ASNumber:baseinfo' => 'Informazioni Generali',
	'Class:ASNumber:admininfo' => 'Informazioni Amministrative',
	'Class:ASNumber/Attribute:number' => 'Numero',
	'Class:ASNumber/Attribute:number+' => '',
	'Class:ASNumber/Attribute:registrar_id' => 'Registrar',
	'Class:ASNumber/Attribute:registrar_id+' => '',
	'Class:ASNumber/Attribute:registrar_name' => 'Nome del Registrar',
	'Class:ASNumber/Attribute:registrar_name+' => '',
	'Class:ASNumber/Attribute:whois' => 'Chi Þ',
	'Class:ASNumber/Attribute:whois+' => 'URL toward registrar whois information',
	'Class:ASNumber/Attribute:move2production' => 'Data di registrazione ',
	'Class:ASNumber/Attribute:move2production+' => 'Data in cui AS Þ stato registrato.',
	'Class:ASNumber/Attribute:validity_end' => 'Data di Fine',
	'Class:ASNumber/Attribute:validity_end+' => 'Data dopo la quale AS non Þ pi¨ valido.',
	'Class:ASNumber/Attribute:renewal_date' => 'Data di rinnovo',
	'Class:ASNumber/Attribute:renewal_date+' => 'Data in cui l\'AS Þ stato rinnovato',
));

//
// Class: VRF
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:VRF' => 'VRF',
	'Class:VRF+' => 'Virtual Routing e Forwarding',
	'Class:VRF:baseinfo' => 'Informazioni Generali',
	'Class:VRF/Attribute:route_dist' => 'Route Distinguisher',
	'Class:VRF/Attribute:route_dist+' => '',
	'Class:VRF/Attribute:route_trgt' => 'Route Target',
	'Class:VRF/Attribute:route_trgt+' => '',
	'Class:VRF/Attribute:subnets_list' => 'Sottoreti',
	'Class:VRF/Attribute:subnets_list+' => '',
	'Class:VRF/Attribute:physicalinterfaces_list' => 'Interfacce di rete fisiche',
	'Class:VRF/Attribute:physicalinterfaces_list+' => '',
	'Class:VRF/Attribute:networkdevicevirtualinterfaces_list' => 'Interfacce virtuali dei dispositivi di rete',
	'Class:VRF/Attribute:networkdevicevirtualinterfaces_list+' => '',
	'Class:VRF/Tab:ipaddresses_list' => 'Interfacce IP',
	'Class:VRF/Tab:ipaddresses_list+' => 'Elenco di tutti gli indirizzi IP ospitati da tutte le interfacce IP collegate all\'elemento della configurazione',
));

//
// Class: lnkPhysicalInterfaceToVRF
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkPhysicalInterfaceToVRF' => 'Link PhysicalInterface / VRF',
	'Class:lnkPhysicalInterfaceToVRF+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id' => 'Interfacce fisiche',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name' => 'Nome delle Interfacce fisiche',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id' => 'Dispositivo',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name' => 'Nomde del Dispositivo',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_name' => 'Nome delle VRF',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_name+' => '',
));

//
// NetworkDevice
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
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

Dict::Add('IT IT', 'Italian', 'Italiano', array(
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

Dict::Add('IT IT', 'Italian', 'Italiano', array(
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
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode' => 'Modalità ',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode+' => 'Mode tagged o untagged',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));

//
// Class: lnkNetworkDeviceVirtualInterfaceToVRF
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
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

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:VLAN/Attribute:physicalinterface_list+' => 'List of all physical network interfaces attached to the VLAN',
	'Class:VLAN/Attribute:networkdevicevirtualinterfaces_list' => 'Network device virtual interfaces',
	'Class:VLAN/Attribute:networkdevicevirtualinterfaces_list+' => 'List of all network device virtual interfaces attached to the VLAN',
));

//
// Application Menu
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Menu:ConfigManagement:TeemIpNetworking' => 'rete',
	'Menu:ConfigManagement:TeemIpNetworking:Interfaces' => 'Interfacce',
	'Menu:ConfigManagement:TeemIpNetworking:Connectivity' => 'Connettività',
	'Menu:ConfigManagement:TeemIpNetworking:Naming' => 'Denominazione',

//
// Management of Domains
//
	// Creation Management	
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'Il nome di dominio esiste giÓ!',

	// Update Management
	'UI:IPManagement:Action:ChangeOrg:Domain:HasParentInOtherOrg' => 'L\'organizzazione non può cambiare: il dominio padre non appartiene alla nuova organizzazione !',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasChildren' => 'L\'organizzazione non può cambiare: il dominio ha sottodomini !',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasHosts' => 'L\'organizzazione non può cambiare: gli host dell\'organizzazione iniziale usano il dominio !',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasZones' => 'L\'organizzazione non può cambiare: le zone puntano su quest\'area !',

	// Display list of domains
	'UI:IPManagement:Action:DisplayList:Domain' => 'Elenco di visualizzazione',
	'UI:IPManagement:Action:DisplayList:Domain+' => '',
	'UI:IPManagement:Action:DisplayList:Domain:PageTitle_Class' => 'Domini DNS',
	'UI:IPManagement:Action:DisplayList:Domain:Title_Class' => 'Domini DNS',

	// Display tree of domains
	'UI:IPManagement:Action:DisplayTree:Domain' => 'Alberto di visualizzazione',
	'UI:IPManagement:Action:DisplayTree:Domain+' => '',
	'UI:IPManagement:Action:DisplayTree:Domain:PageTitle_Class' => 'Domini DNS',
	'UI:IPManagement:Action:DisplayTree:Domain:Title_Class' => 'Domini DNS',
	'UI:IPManagement:Action:DisplayTree:Domain:OrgName' => 'Organizzazione %1$s',

	// Delegate action on domains
	'UI:IPManagement:Action:Delegate:Domain' => 'Delegato',
	'UI:IPManagement:Action:Delegate:Domain:PageTitle_Object_Class' => '%1$s - Delegato',
	'UI:IPManagement:Action:Delegate:Domain:Title_Class_Object' => 'Delegato %1$s %2$s all\'organizzazione',
	'UI:IPManagement:Action:Delegate:Domain:ChildDomain' => 'Organizzazione per delegare il dominio a:',
	'UI:IPManagement:Action:Delegate:Domain:NoChildOrg' => 'L\'organizzazione del domonio non ha figli e, quindi, il domnio non può essere delegato!',
	'UI:IPManagement:Action:Delegate:Domain:NoOtherOrg' => 'Non ci sono altre organizzazioni oltre all\'organizzazione del dominio!',
	'UI:IPManagement:Action:Delegate:Domain:IsDelegated' => 'Il dominio è già delegato!',
	'UI:IPManagement:Action:Delegate:Domain:CannotBeDelegated' => 'Il dominio non può essere delegato: %1$s',
	'UI:IPManagement:Action:Delegate:Domain:NoChangeOfOrganization' => 'L\'organizzazione della delega deve essere diversa da quella del dominio!',
	'UI:IPManagement:Action:Delegate:Domain:HasHosts' => 'Il dominio ha host!',
	'UI:IPManagement:Action:Delegate:Domain:HasSubDomains' => 'Il dominio ha sottodomini!',
	'UI:IPManagement:Action:Delegate:Domain:HasZones' => 'Le zone si riferiscono a quest\'area!',
	'UI:IPManagement:Action:Delegate:Domain:Done' => '%1$s %2$s è stato delegato.',

	// Undelegate action on domains
	'UI:IPManagement:Action:Undelegate:Domain' => 'Non-delegato',
	'UI:IPManagement:Action:Undelegate:Domain:PageTitle_Object_Class' => '%1$s - Non-delegato',
	'UI:IPManagement:Action:Undelegate:Domain:CannotBeUndelegated' => 'La delega non può essere ritirata dal dominio: %1$s',
	'UI:IPManagement:Action:Undelegate:Domain:IsNotDelegated' => 'Il dominio non è delegato!',
	'UI:IPManagement:Action:Undelegate:Domain:HasHosts' => 'Il dominio ha host!',
	'UI:IPManagement:Action:Undelegate:Domain:HasSubDomains' => 'Il dominio ha sottodomini!',
	'UI:IPManagement:Action:Undelegate:Domain:HasZones' => 'Le zone si riferiscono a quest\'area!',
	'UI:IPManagement:Action:Undelegate:Domain:Done' => '%1$s %2$s è stato non-delegato.',

	// Look for domain when exploding FQDN
	'UI:IPManagement:Action:ExplodeFQDN:Domain:Error:CannotFindDomain' => 'Impossibile trovare il dominio registrato in FQDN !',
));
	