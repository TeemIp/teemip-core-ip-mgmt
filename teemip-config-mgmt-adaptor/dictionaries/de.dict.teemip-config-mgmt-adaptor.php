<?php
/*
 * @copyright   Copyright (C) 2010-2026 TeemIp
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
    'Class:IPInterface:l1info' => 'Schicht 1 Informationen',
    'Class:IPInterface:l2info' => 'Schicht 2 Informationen',
    'Class:IPInterface:l3info' => 'Schicht 3 Informationen',
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
    'Class:PhysicalInterface/Attribute:org_id' => 'Organisation',
    'Class:PhysicalInterface/Attribute:org_id+' => 'Organisation des CIs zu dem die Schnittstelle gehört',
    'Class:PhysicalInterface/Attribute:location_id' => 'Standort',
    'Class:PhysicalInterface/Attribute:location_id+' => 'Standort des CIs zu dem die Schnittstelle gehört',
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
