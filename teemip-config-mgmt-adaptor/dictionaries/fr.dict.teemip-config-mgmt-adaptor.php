<?php
/*
 * @copyright   Copyright (C) 2010-2026 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: ConnectableCI
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:ConnectableCI/Tab:ipaddresses_list' => 'IPs des interfaces',
	'Class:ConnectableCI/Tab:ipaddresses_list+' => 'Liste de toutes les adresses IP de toutes les interfaces physiques attachées au CI',
));

//
// Class: DatacenterDevice
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:DatacenterDevice/Attribute:managementip_id' => 'IP de gestion',
	'Class:DatacenterDevice/Attribute:managementip_id+' => '',
	'Class:DatacenterDevice/Attribute:managementip_name' => 'Nom de l\'IP de gestion',
	'Class:DatacenterDevice/Attribute:managementip_name+' => '',
));

//
// Class: NetworkInterface
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:NetworkInterface:baseinfo' => 'Informations générales',
	'Class:NetworkInterface:wiringinfo' => 'Informations de câblage',
	'Class:NetworkInterface:moreinfo' => 'Informations complémentaires',
	'Class:NetworkInterface/Attribute:operational_status' => 'Statut opérationnel',
	'Class:NetworkInterface/Attribute:operational_status+' => 'Calculé à partir du statut des classes filles',
	'Class:NetworkInterface/Attribute:operational_status/Value:active' => 'Active',
	'Class:NetworkInterface/Attribute:operational_status/Value:active+' => '',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive' => 'Inactive',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive+' => '',
));

//
// Class: IPInterface
//

Dict::Add('FR FR', 'French', 'Français', array(
    'Class:IPInterface:l1info' => 'Informations de niveau 1',
    'Class:IPInterface:l2info' => 'Informations de niveau 2',
    'Class:IPInterface:l3info' => 'Informations de niveau 3',
	'Class:IPInterface/Attribute:ipaddress_id' => 'Adresse IP',
	'Class:IPInterface/Attribute:ipaddress_id+' => '',
));

//
// Class: PhysicalInterface
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:PhysicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:PhysicalInterface/Attribute:vrfs_list+' => '',
	'Class:PhysicalInterface/Attribute:status' => 'Statut',
	'Class:PhysicalInterface/Attribute:status+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:stock' => 'Stock',
	'Class:PhysicalInterface/Attribute:status/Value:stock+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:active' => 'Active',
	'Class:PhysicalInterface/Attribute:status/Value:active+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:inactive' => 'Inactive',
	'Class:PhysicalInterface/Attribute:status/Value:inactive+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete' => 'Obsolete',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete+' => '',
    'Class:PhysicalInterface/Attribute:org_id' => 'Organisation',
    'Class:PhysicalInterface/Attribute:org_id+' => 'Organisation du CI auquel l\'interface appartient',
    'Class:PhysicalInterface/Attribute:location_id' => 'Lieu',
    'Class:PhysicalInterface/Attribute:location_id+' => 'Lieu du CI auquel l\'interface appartient',
));

//
// Class: VLAN
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:VLAN/Tab:ipaddresses_list' => 'IPs des Interfaces',
	'Class:VLAN/Tab:ipaddresses_list+' => 'Liste de toutes les adresses IP de toutes les interfaces attachées au CI',
));

//
// Class: lnkPhysicalInterfaceToVLAN
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode' => 'Mode',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode+' => 'Mode tagged ou untagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));
