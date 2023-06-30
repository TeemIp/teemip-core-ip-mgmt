<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: ConnectableCI
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:ConnectableCI/Tab:ipaddresses_list' => 'Interfaces\' IPs',
	'Class:ConnectableCI/Tab:ipaddresses_list+' => 'List of all IP addresses hosted by all physical interfaces attached to the CI',
));

//
// Class: DatacenterDevice
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:DatacenterDevice/Attribute:managementip_id' => 'Management IP',
	'Class:DatacenterDevice/Attribute:managementip_id+' => '',
	'Class:DatacenterDevice/Attribute:managementip_name' => 'Management IP Name',
	'Class:DatacenterDevice/Attribute:managementip_name+' => '',
));

//
// Class: NetworkInterface
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:NetworkInterface:baseinfo' => 'General Information',
	'Class:NetworkInterface:wiringinfo' => 'Wiring Information',
	'Class:NetworkInterface:moreinfo' => 'More Information',
	'Class:NetworkInterface/Attribute:operational_status' => 'Operational status',
	'Class:NetworkInterface/Attribute:operational_status+' => 'Computed from the children classes status',
	'Class:NetworkInterface/Attribute:operational_status/Value:active' => 'Active',
	'Class:NetworkInterface/Attribute:operational_status/Value:active+' => '',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive' => 'Inactive',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive+' => '',
));

//
// Class: IPInterface
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPInterface/Attribute:ip_list' => 'IP Addresses',
	'Class:IPInterface/Attribute:ip_list+' => '',
));

//
// Class: PhysicalInterface
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:PhysicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:PhysicalInterface/Attribute:vrfs_list+' => '',
	'Class:PhysicalInterface/Attribute:status' => 'Status',
	'Class:PhysicalInterface/Attribute:status+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:stock' => 'Stock',
	'Class:PhysicalInterface/Attribute:status/Value:stock+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:active' => 'Active',
	'Class:PhysicalInterface/Attribute:status/Value:active+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:inactive' => 'Inactive',
	'Class:PhysicalInterface/Attribute:status/Value:inactive+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete' => 'Obsolete',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete+' => '',
));

//
// Class: VLAN
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:VLAN/Tab:ipaddresses_list' => 'Interfaces\' IPs',
	'Class:VLAN/Tab:ipaddresses_list+' => 'List of all IP addresses hosted by all IP interfaces attached to the CI',
));

//
// Class: lnkPhysicalInterfaceToVLAN
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode' => 'Mode',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode+' => 'Mode tagged or untagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));
