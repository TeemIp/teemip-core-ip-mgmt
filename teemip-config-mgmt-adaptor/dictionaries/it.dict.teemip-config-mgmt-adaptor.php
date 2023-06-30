<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: ConnectableCI
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:ConnectableCI/Tab:ipaddresses_list' => 'Interfacce IP',
	'Class:ConnectableCI/Tab:ipaddresses_list+' => 'Lista di tutti gli indirizzi appartenenti alle interfacce fisiche collegate ai CI',
));

//
// Class: DatacenterDevice
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:DatacenterDevice/Attribute:managementip_id' => 'Management IP',
	'Class:DatacenterDevice/Attribute:managementip_id+' => '',
	'Class:DatacenterDevice/Attribute:managementip_name' => 'Management IP Name',
	'Class:DatacenterDevice/Attribute:managementip_name+' => '',
));

//
// Class: NetworkInterface
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:NetworkInterface:baseinfo' => 'Infomazioni Generali',
	'Class:NetworkInterface:wiringinfo' => 'Cablaggio Informaz',
	'Class:NetworkInterface:moreinfo' => 'Più informazioni',
	'Class:NetworkInterface/Attribute:operational_status' => 'Stato operativo',
	'Class:NetworkInterface/Attribute:operational_status+' => 'Calcolato dallo stato delle classi figlio',
	'Class:NetworkInterface/Attribute:operational_status/Value:active' => 'Attivo',
	'Class:NetworkInterface/Attribute:operational_status/Value:active+' => '',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive' => 'Inattivo',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive+' => '',
));

//
// Class: IPInterface
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPInterface/Attribute:ip_list' => 'Indirizzi IP',
	'Class:IPInterface/Attribute:ip_list+' => '',
));

//
// Class: PhysicalInterface
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:PhysicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:PhysicalInterface/Attribute:vrfs_list+' => '',
	'Class:PhysicalInterface/Attribute:status' => 'Stato',
	'Class:PhysicalInterface/Attribute:status+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:stock' => 'Stock',
	'Class:PhysicalInterface/Attribute:status/Value:stock+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:active' => 'Attivo',
	'Class:PhysicalInterface/Attribute:status/Value:active+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:inactive' => 'Inattivo',
	'Class:PhysicalInterface/Attribute:status/Value:inactive+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete' => 'Obsoleto',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete+' => '',
));

//
// Class: VLAN
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:VLAN/Tab:ipaddresses_list' => 'Interfacce IP',
	'Class:VLAN/Tab:ipaddresses_list+' => 'Elenco di tutti gli indirizzi IP ospitati da tutte le interfacce IP collegate all\'elemento della configurazione',
));

//
// Class: lnkPhysicalInterfaceToVLAN
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode' => 'Modalità ',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode+' => 'Mode tagged o untagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));
