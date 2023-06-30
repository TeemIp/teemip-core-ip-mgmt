<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: ConnectableCI
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:ConnectableCI/Tab:ipaddresses_list' => 'IPs-Schnittstellen',
	'Class:ConnectableCI/Tab:ipaddresses_list+' => 'Liste aller IP-Adressen aller an das CI angeschlossenen physischen Schnittstellen',
));

//
// Class: DatacenterDevice
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:DatacenterDevice/Attribute:managementip_id' => 'Management IP',
	'Class:DatacenterDevice/Attribute:managementip_id+' => '',
	'Class:DatacenterDevice/Attribute:managementip_name' => 'Management IP Name',
	'Class:DatacenterDevice/Attribute:managementip_name+' => '',
));

//
// Class: NetworkInterface
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:NetworkInterface:baseinfo' => 'Allgemeine Informationen',
	'Class:NetworkInterface:wiringinfo' => 'Verkabelung Informationen',
	'Class:NetworkInterface:moreinfo' => 'Weitere Informationen',
	'Class:NetworkInterface/Attribute:operational_status' => 'Betriebsstatus',
	'Class:NetworkInterface/Attribute:operational_status+' => 'Berechnet aus dem Status der untergeordneten Klassen',
	'Class:NetworkInterface/Attribute:operational_status/Value:active' => 'Aktiv',
	'Class:NetworkInterface/Attribute:operational_status/Value:active+' => '',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive' => 'Inaktiv',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive+' => '',
));

//
// Class: IPInterface
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPInterface/Attribute:ipaddress_id' => 'IP Adresse',
	'Class:IPInterface/Attribute:ipaddress_id+' => '',
));

//
// Class: PhysicalInterface
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:PhysicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:PhysicalInterface/Attribute:vrfs_list+' => '',
	'Class:PhysicalInterface/Attribute:status' => 'Status',
	'Class:PhysicalInterface/Attribute:status+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:stock' => 'Lager',
	'Class:PhysicalInterface/Attribute:status/Value:stock+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:active' => 'Aktiv',
	'Class:PhysicalInterface/Attribute:status/Value:active+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:inactive' => 'Inaktiv',
	'Class:PhysicalInterface/Attribute:status/Value:inactive+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete' => 'Obsolet',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete+' => '',
));

//
// Class: VLAN
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:VLAN/Tab:ipaddresses_list' => 'IPs-Schnittstellen',
	'Class:VLAN/Tab:ipaddresses_list+' => 'Liste aller IP-Adressen aller an das CI angeschlossenen Schnittstellen',
));

//
// Class: lnkPhysicalInterfaceToVLAN
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode' => 'Modus',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode+' => 'Modus tagged oder untagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));
