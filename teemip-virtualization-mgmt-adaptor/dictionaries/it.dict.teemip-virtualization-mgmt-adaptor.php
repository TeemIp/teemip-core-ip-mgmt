<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: VirtualMachine
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:VirtualMachine/Attribute:managementip_id' => 'IP',
	'Class:VirtualMachine/Attribute:managementip_id+' => '',
	'Class:VirtualMachine/Attribute:managementip_name' => 'IP Name',
	'Class:VirtualMachine/Attribute:managementip_name+' => '',
	'Class:VirtualMachine/Tab:ipaddresses_list' => 'Interfacce IP',
	'Class:VirtualMachine/Tab:ipaddresses_list+' => 'Elenco di tutti gli indirizzi IP ospitati da tutte le interfacce logiche collegate al CI',
));

//
// Class: Hypervisor
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:Hypervisor/Tab:physicalinterfaces_list' => 'Interfacce di rete fisiche',
	'Class:Hypervisor/Tab:physicalinterfaces_list+' => 'Elenco delle interfacce di rete fisiche ospitate dal server dell\'hypervisor',
	'Class:Hypervisor/Tab:ipaddresses_list' => 'Interfacce IP',
	'Class:Hypervisor/Tab:ipaddresses_list+' => 'Elenco di tutti gli indirizzi IP ospitati da tutte le interfacce IP collegate all\'elemento della configurazione',
));

//
// Class: LogicalInterface
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:LogicalInterface/Attribute:vlans_list' => 'VLANs',
	'Class:LogicalInterface/Attribute:vlans_list+' => '',
	'Class:LogicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:LogicalInterface/Attribute:vrfs_list+' => '',
	'Class:LogicalInterface/Attribute:status' => 'Stato',
	'Class:LogicalInterface/Attribute:status+' => '',
	'Class:LogicalInterface/Attribute:status/Value:active' => 'Attivo',
	'Class:LogicalInterface/Attribute:status/Value:active+' => '',
	'Class:LogicalInterface/Attribute:status/Value:inactive' => 'Inattivo',
	'Class:LogicalInterface/Attribute:status/Value:inactive+' => '',
));

//
// Class: VLAN
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:VLAN/Attribute:logicalinterfaces_list' => 'Interfacce di rete logiche',
	'Class:VLAN/Attribute:logicalinterfaces_list+' => '',
));

//
// Class: VRF
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:VRF/Attribute:logicalinterfaces_list' => 'Interfacce di rete logiche',
	'Class:VRF/Attribute:logicalinterfaces_list+' => '',
));

//
// Class: lnkLogicalInterfaceToVLAN
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkLogicalInterfaceToVLAN' => 'Link Interfaccia logica / VLAN',
	'Class:lnkLogicalInterfaceToVLAN+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id' => 'Interfaccia logica',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name' => 'Nome dell\'interfaccia logica',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id' => 'Dispositivo',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name' => 'Nome del dispositivo',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag' => 'VLAN Tag',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode' => 'Modalità ',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode+' => 'Mode tagged o untagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));

//
// Class: lnkLogicalInterfaceToVRF
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkLogicalInterfaceToVRF' => 'Link Interfaccia logica / VRF',
	'Class:lnkLogicalInterfaceToVRF+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id' => 'Interfaccia logica',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name' => 'Nome dell\'interfaccia logica',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id' => 'Dispositivo',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name' => 'Nome del dispositivo',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name' => 'Nom del VRF',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name+' => '',
));
