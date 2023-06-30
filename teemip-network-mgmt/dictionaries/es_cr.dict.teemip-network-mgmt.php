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

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:DNSObject' => 'Objeto DNS',
	'Class:DNSObject+' => '',
	'Class:DNSObject/Attribute:finalclass' => 'Clase',
	'Class:DNSObject/Attribute:finalclass+' => '',
	'Class:DNSObject/Attribute:org_id' => 'Organización',
	'Class:DNSObject/Attribute:org_id+' => '',
	'Class:DNSObject/Attribute:org_name' => 'Nombre Organización',
	'Class:DNSObject/Attribute:org_name+' => '',
	'Class:DNSObject/Attribute:name' => 'Nombre Objeto DNS',
	'Class:DNSObject/Attribute:name+' => '',
	'Class:DNSObject/Attribute:comment' => 'Descripción',
	'Class:DNSObject/Attribute:comment+' => '',
));

//
// Class: Domain
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:Domain' => 'Dominio',
	'Class:Domain+' => 'Dominio DNS',
	'Class:Domain:baseinfo' => 'Información General',
	'Class:Domain:admininfo' => 'Información Administrativa',
	'Class:Domain:DelegatedToChild' => '<delegation_highlight>Delegado a organización : </delegation_highlight>%1$s',
	'Class:Domain:DelegatedFromParent' => '<delegation_highlight>Delegado de organización : </delegation_highlight>1$s',
	'Class:Domain/Attribute:name' => 'Nombre',
	'Class:Domain/Attribute:name+' => '',
	'Class:Domain/Attribute:parent_org_id' => 'Delegado de',
	'Class:Domain/Attribute:parent_org_id+' => 'Organización donde se ha delegado el dominio',
	'Class:Domain/Attribute:parent_org_name' => 'Nombre de Organización Delegante',
	'Class:Domain/Attribute:parent_org_name+' => 'Nombre de la organización donde se ha delegado el dominio',
	'Class:Domain/Attribute:parent_id' => 'Padre',
	'Class:Domain/Attribute:parent_id+' => '',
	'Class:Domain/Attribute:parent_name' => 'Nombre Padre',
	'Class:Domain/Attribute:parent_name+' => '',
	'Class:Domain/Attribute:requestor_id' => 'Solicitante',
	'Class:Domain/Attribute:requestor_id+' => '',
	'Class:Domain/Attribute:requestor_name' => 'Nombre Solicitante',
	'Class:Domain/Attribute:requestor_name+' => '',
	'Class:Domain/Attribute:release_date' => 'Fecha Liberación',
	'Class:Domain/Attribute:release_date+' => 'Date when domain has been released and has not been used anymore.',
	'Class:Domain/Attribute:registrar_id' => 'Registrante de Internet',
	'Class:Domain/Attribute:registrar_id+' => 'Organization looking after the allocation of domain names.',
	'Class:Domain/Attribute:registrar_name' => 'Nombre Registrante de Internet',
	'Class:Domain/Attribute:registrar_name+' => '',
	'Class:Domain/Attribute:validity_start' => 'Fecha de Inicio ',
	'Class:Domain/Attribute:validity_start+' => 'Date after which domain is valid.',
	'Class:Domain/Attribute:validity_end' => 'Fecha de Termino',
	'Class:Domain/Attribute:validity_end+' => 'Date after which domain is not valid anymore.',
	'Class:Domain/Attribute:renewal' => 'Renovación',
	'Class:Domain/Attribute:renewal+' => 'Renewal method',
	'Class:Domain/Attribute:renewal/Value:na' => 'No Aplica',
	'Class:Domain/Attribute:renewal/Value:manual' => 'Manual',
	'Class:Domain/Attribute:renewal/Value:automatic' => 'Automática',
));

//
// Class extensions for Domain
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:Domain/Tab:hosts' => 'Hosts',
	'Class:Domain/Tab:hosts+' => 'Hosts that belong to the domain',
	'Class:Domain/Tab:hosts/List0' => 'Hosts que pertenecen al dominio y sus hijos',
	'Class:Domain/Tab:hosts/SelectList0' => 'Mostrar hosts que pertenecen al dominio y sus hijos',
	'Class:Domain/Tab:hosts/List1' => 'Hosts conectados directamente al dominio solamente',
	'Class:Domain/Tab:hosts/SelectList1' => 'Mostrar hosts conectados directamente al dominio solamente',
	'Class:Domain/Tab:hosts/List2' => 'Hosts solo conectados a dominios hijos',
	'Class:Domain/Tab:hosts/SelectList2' => 'Mostrar hosts solo conectados a dominios hijos',
	'Class:Domain/Tab:hosts/SelectList' => 'Cambiar vista',
	'Class:Domain/Tab:child_domain' => 'Dominios Hijos',
	'Class:Domain/Tab:child_domain+' => 'Dominios que se adjuntan directamente',
	'Class:Domain/Tab:zones_list' => 'Zonas relacionadas',
	'Class:Domain/Tab:zones_list+' => 'Zonas relacionadas con el dominio actual.',
));

//
// Class: WANLink
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:WANLink' => 'Enlace WAN',
	'Class:WANLink+' => 'Wide Area Network Link',
	'Class:WANLink:baseinfo' => 'Información General',
	'Class:WANLink:networkinfo' => 'Network Information',
	'Class:WANLink:admininfo' => 'Información Administrativa',
	'Class:WANLink:locationinfo' => 'Localidad',
	'Class:WANLink:dateinfo' => 'Date Información',
	'Class:WANLink/Attribute:type_id' => 'Tipo',
	'Class:WANLink/Attribute:type_id+' => '',
	'Class:WANLink/Attribute:type_name' => 'Nombre de Tipo',
	'Class:WANLink/Attribute:type_name+' => '',
	'Class:WANLink/Attribute:rate' => 'Tasa',
	'Class:WANLink/Attribute:rate+' => '',
	'Class:WANLink/Attribute:burst_rate' => 'Tasa Rendimiento',
	'Class:WANLink/Attribute:burst_rate+' => '',
	'Class:WANLink/Attribute:underlying_rate' => 'Tasa Subyacente',
	'Class:WANLink/Attribute:underlying_rate+' => '',
	'Class:WANLink/Attribute:status' => 'Estatus',
	'Class:WANLink/Attribute:status+' => '',
	'Class:WANLink/Attribute:status/Value:implementation' => 'Implementación',
	'Class:WANLink/Attribute:status/Value:implementation+' => '',
	'Class:WANLink/Attribute:status/Value:production' => 'Producción',
	'Class:WANLink/Attribute:status/Value:production+' => '',
	'Class:WANLink/Attribute:status/Value:obsolete' => 'Obsoleto',
	'Class:WANLink/Attribute:status/Value:obsolete+' => '',
	'Class:WANLink/Attribute:status/Value:stock' => 'Reserva',
	'Class:WANLink/Attribute:status/Value:stock+' => '',
	'Class:WANLink/Attribute:location_id1' => 'Localidad #1',
	'Class:WANLink/Attribute:location_id1+' => 'Location at one end of the link',
	'Class:WANLink/Attribute:location_name1' => 'Nombre Localidad #1',
	'Class:WANLink/Attribute:location_name1+' => '',
	'Class:WANLink/Attribute:location_id2' => 'Localidad #2',
	'Class:WANLink/Attribute:location_id2+' => 'Location at the other end of the link',
	'Class:WANLink/Attribute:location_name2' => 'Nombre Localidad #2',
	'Class:WANLink/Attribute:location_name2+' => '',
	'Class:WANLink/Attribute:carrier_id' => 'Operador Telecom',
	'Class:WANLink/Attribute:carrier_id+' => '',
	'Class:WANLink/Attribute:carrier_name' => 'Nombre Operador',
	'Class:WANLink/Attribute:carrier_name+' => '',
	'Class:WANLink/Attribute:carrier_reference' => 'Referencia Operador',
	'Class:WANLink/Attribute:carrier_reference+' => '',
	'Class:WANLink/Attribute:internal_reference' => 'Referencia Interna',
	'Class:WANLink/Attribute:internal_reference+' => '',
	'Class:WANLink/Attribute:networkinterface_id1' => 'Interfaz de Red #1',
	'Class:WANLink/Attribute:networkinterface_id1+' => 'Network interface at location #1',
	'Class:WANLink/Attribute:networkinterface_name1' => 'Nombre de Interfaz de Red #1',
	'Class:WANLink/Attribute:networkinterface_name1+' => '',
	'Class:WANLink/Attribute:networkinterface_id2' => 'Interfaz de Red #2',
	'Class:WANLink/Attribute:networkinterface_id2+' => 'Network interface at location #2',
	'Class:WANLink/Attribute:networkinterface_name2' => 'Nombre de Interfaz de Red #2',
	'Class:WANLink/Attribute:networkinterface_name2+' => '',
	'Class:WANLink/Attribute:purchase_date' => 'Fecha de Orden',
	'Class:WANLink/Attribute:purchase_date+' => '',
	'Class:WANLink/Attribute:renewal_date' => 'Fecha de Renovación',
	'Class:WANLink/Attribute:renewal_date+' => '',
	'Class:WANLink/Attribute:decommissioning_date' => 'Fecha de Retiro',
	'Class:WANLink/Attribute:decommissioning_date+' => '',
));

//
// Class: WANType
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:WANType' => 'Tipo WAN',
	'Class:WANType+' => '',
	'Class:WANType/Attribute:description' => 'Descripción',
	'Class:WANType/Attribute:description+' => '',
));

//
// Class: ASNumber
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:ASNumber' => 'Número AS',
	'Class:ASNumber+' => 'Autonomous System Number',
	'Class:ASNumber:baseinfo' => 'Información General',
	'Class:ASNumber:admininfo' => 'Información Administrativa',
	'Class:ASNumber/Attribute:number' => 'Número',
	'Class:ASNumber/Attribute:number+' => '',
	'Class:ASNumber/Attribute:registrar_id' => 'Registrante',
	'Class:ASNumber/Attribute:registrar_id+' => '',
	'Class:ASNumber/Attribute:registrar_name' => 'Nombre Registrante',
	'Class:ASNumber/Attribute:registrar_name+' => '',
	'Class:ASNumber/Attribute:whois' => 'Whois',
	'Class:ASNumber/Attribute:whois+' => 'URL hacia información whois del registrante',
	'Class:ASNumber/Attribute:move2production' => 'Fecha Registro ',
	'Class:ASNumber/Attribute:move2production+' => 'Date when AS has been registered.',
	'Class:ASNumber/Attribute:validity_end' => 'Fecha Termino',
	'Class:ASNumber/Attribute:validity_end+' => 'Date after which AS is not valid anymore.',
	'Class:ASNumber/Attribute:renewal_date' => 'Fecha Renovación',
	'Class:ASNumber/Attribute:renewal_date+' => 'Date when the AS has been renewed',
));

//
// Class: VRF
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:VRF' => 'VRF',
	'Class:VRF+' => 'Virtual Routing and Forwarding',
	'Class:VRF:baseinfo' => 'Información General',
	'Class:VRF/Attribute:route_dist' => 'Distintivo de Ruta',
	'Class:VRF/Attribute:route_dist+' => '',
	'Class:VRF/Attribute:route_trgt' => 'Destino de Ruta',
	'Class:VRF/Attribute:route_trgt+' => '',
	'Class:VRF/Attribute:subnets_list' => 'Subredes',
	'Class:VRF/Attribute:subnets_list+' => '',
	'Class:VRF/Attribute:physicalinterfaces_list' => 'Interfaces físicas de red',
	'Class:VRF/Attribute:physicalinterfaces_list+' => '',
	'Class:VRF/Attribute:networkdevicevirtualinterfaces_list' => 'Interfaces virtuales de dispositivos de red ',
	'Class:VRF/Attribute:networkdevicevirtualinterfaces_list+' => '',
	'Class:VRF/Tab:ipaddresses_list' => 'IP de interfaces',
	'Class:VRF/Tab:ipaddresses_list+' => 'Lista de todas las direcciones IP alojadas por todas las interfaces IP conectadas al CI',
));

//
// Class: lnkPhysicalInterfaceToVRF
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:lnkPhysicalInterfaceToVRF' => 'Relación Interfaz Física / VRF',
	'Class:lnkPhysicalInterfaceToVRF+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id' => 'Interfaz Física',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name' => 'Nombre de Interfaz Física',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id' => 'Dispositivo',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name' => 'Nombre Dispositivo',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_name' => 'Nombre de VRF',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_name+' => '',
));

//
// NetworkDevice
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
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

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
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

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
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
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode' => 'Modo',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode+' => 'Modo tagged o untagged',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));

//
// Class: lnkNetworkDeviceVirtualInterfaceToVRF
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
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

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:VLAN/Attribute:physicalinterface_list+' => 'List of all physical network interfaces attached to the VLAN',
	'Class:VLAN/Attribute:networkdevicevirtualinterfaces_list' => 'Network device virtual interfaces',
	'Class:VLAN/Attribute:networkdevicevirtualinterfaces_list+' => 'List of all network device virtual interfaces attached to the VLAN',
));

//
// Application Menu
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Menu:ConfigManagement:TeemIpNetworking' => 'Red',
	'Menu:ConfigManagement:TeemIpNetworking:Interfaces' => 'Interfaces',
	'Menu:ConfigManagement:TeemIpNetworking:Connectivity' => 'Conectividad',
	'Menu:ConfigManagement:TeemIpNetworking:Naming' => 'Denominación',

//
// Management of Domains
//
	// Creation Management	
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'Nombre de Dominio ya existe!',

	// Update Management
	'UI:IPManagement:Action:ChangeOrg:Domain:HasParentInOtherOrg' => 'La organización no puede cambiar: el dominio principal no pertenece a la nueva organización!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasChildren' => 'La organización no puede cambiar: el dominio tiene hijos!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasHosts' => 'La organización no puede cambiar: hosts de la organización original estan usando el dominio!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasZones' => 'La organización no puede cambiar: zonas se basan en el dominio!',

	// Display list of domains
	'UI:IPManagement:Action:DisplayList:Domain' => 'Desplegar Lista',
	'UI:IPManagement:Action:DisplayList:Domain+' => '',
	'UI:IPManagement:Action:DisplayList:Domain:PageTitle_Class' => 'Dominios DNS',
	'UI:IPManagement:Action:DisplayList:Domain:Title_Class' => 'Dominios DNS',

	// Display tree of domains
	'UI:IPManagement:Action:DisplayTree:Domain' => 'Desplegar Árbol',
	'UI:IPManagement:Action:DisplayTree:Domain+' => '',
	'UI:IPManagement:Action:DisplayTree:Domain:PageTitle_Class' => 'Dominios DNS',
	'UI:IPManagement:Action:DisplayTree:Domain:Title_Class' => 'Dominios DNS',
	'UI:IPManagement:Action:DisplayTree:Domain:OrgName' => 'Organización %1$s',

	// Delegate action on domains
	'UI:IPManagement:Action:Delegate:Domain' => 'Delegar',
	'UI:IPManagement:Action:Delegate:Domain:PageTitle_Object_Class' => '%1$s - Delegar',
	'UI:IPManagement:Action:Delegate:Domain:Title_Class_Object' => 'Delegar %1$s %2$s a una organizacion',
	'UI:IPManagement:Action:Delegate:Domain:ChildDomain' => 'Organización para delegar el dominio a:',
	'UI:IPManagement:Action:Delegate:Domain:NoChildOrg' => 'La organización de la que depende el patrimonio no tiene una hija. El dominio no puede ser delegado!',
	'UI:IPManagement:Action:Delegate:Domain:NoOtherOrg' => 'No hay otra organización a la que pertenece el dominio!',
	'UI:IPManagement:Action:Delegate:Domain:IsDelegated' => 'El dominio ya está delegado!',
	'UI:IPManagement:Action:Delegate:Domain:CannotBeDelegated' => 'El dominio no puede ser delegado: %1$s',
	'UI:IPManagement:Action:Delegate:Domain:NoChangeOfOrganization' => 'La organización de la delegación debe ser diferente de la del dominio!',
	'UI:IPManagement:Action:Delegate:Domain:HasHosts' => 'El dominio tiene hosts!',
	'UI:IPManagement:Action:Delegate:Domain:HasSubDomains' => 'El dominio tiene subdominios!',
	'UI:IPManagement:Action:Delegate:Domain:HasZones' => 'Las zonas se refieren a esta área!',
	'UI:IPManagement:Action:Delegate:Domain:Done' => '%1$s %2$s ha sido delegado.',

	// Undelegate action on domains
	'UI:IPManagement:Action:Undelegate:Domain' => 'Retirar la delegación',
	'UI:IPManagement:Action:Undelegate:Domain:PageTitle_Object_Class' => '%1$s - Retirar la delegación',
	'UI:IPManagement:Action:Undelegate:Domain:CannotBeUndelegated' => 'La delegación no puede ser retirada del dominio.: %1$s',
	'UI:IPManagement:Action:Undelegate:Domain:IsNotDelegated' => 'El dominio no está delegado',
	'UI:IPManagement:Action:Undelegate:Domain:HasHosts' => 'El dominio tiene hosts!',
	'UI:IPManagement:Action:Undelegate:Domain:HasSubDomains' => 'El dominio tiene subdominios!',
	'UI:IPManagement:Action:Undelegate:Domain:HasZones' => 'Las zonas se refieren a esta área!',
	'UI:IPManagement:Action:Undelegate:Domain:Done' => '%1$s %2$s tenía su delegación retirada.',

	// Look for domain when exploding FQDN
	'UI:IPManagement:Action:ExplodeFQDN:Domain:Error:CannotFindDomain' => 'No se puede encontrar el dominio registrado en FQDN!',
));
	