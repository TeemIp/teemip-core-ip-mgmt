<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: VirtualMachine
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:VirtualMachine/Attribute:managementip_id' => 'IP',
	'Class:VirtualMachine/Attribute:managementip_id+' => '',
	'Class:VirtualMachine/Attribute:managementip_name' => 'IP Name',
	'Class:VirtualMachine/Attribute:managementip_name+' => '',
	'Class:VirtualMachine/Tab:ipaddresses_list' => 'Interfaces\' IPs',
	'Class:VirtualMachine/Tab:ipaddresses_list+' => 'List of all IP addresses hosted by all logical interfaces attached to the CI',
));

//
// Class: Hypervisor
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:Hypervisor/Tab:physicalinterfaces_list' => 'Network interfaces',
	'Class:Hypervisor/Tab:physicalinterfaces_list+' => 'List of the physical network interfaces hosted by the hypervisor\'s server',
	'Class:Hypervisor/Tab:ipaddresses_list' => 'Interfaces\' IPs',
	'Class:Hypervisor/Tab:ipaddresses_list+' => 'List of all IP addresses hosted by all IP interfaces attached to the CI',
));

//
// Class: LogicalInterface
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:LogicalInterface/Attribute:vlans_list' => 'VLANs',
	'Class:LogicalInterface/Attribute:vlans_list+' => '',
	'Class:LogicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:LogicalInterface/Attribute:vrfs_list+' => '',
	'Class:LogicalInterface/Attribute:status' => 'Status',
	'Class:LogicalInterface/Attribute:status+' => '',
	'Class:LogicalInterface/Attribute:status/Value:active' => 'Active',
	'Class:LogicalInterface/Attribute:status/Value:active+' => '',
	'Class:LogicalInterface/Attribute:status/Value:inactive' => 'Inactive',
	'Class:LogicalInterface/Attribute:status/Value:inactive+' => '',
));

//
// Class: VLAN
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:VLAN/Attribute:logicalinterfaces_list' => 'Logical network interfaces',
	'Class:VLAN/Attribute:logicalinterfaces_list+' => 'List of all logical network interfaces attached to the VLAN',
));

//
// Class: VRF
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:VRF/Attribute:logicalinterfaces_list' => 'Logical network interfaces',
	'Class:VRF/Attribute:logicalinterfaces_list+' => 'List of all logical network interfaces attached to the VRF',
));

//
// Class: lnkLogicalInterfaceToVLAN
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkLogicalInterfaceToVLAN' => 'Link LogicalInterface / VLAN',
	'Class:lnkLogicalInterfaceToVLAN+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Name' => '%1$s / %2$s',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id' => 'Logical Interface',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name' => 'Logical Interface Name',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id' => 'Device',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name' => 'Device name',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag' => 'VLAN Tag',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode' => 'Mode',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode+' => 'Mode tagged or untagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));

//
// Class: lnkLogicalInterfaceToVRF
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkLogicalInterfaceToVRF' => 'Link LogicalInterface / VRF',
	'Class:lnkLogicalInterfaceToVRF+' => '',
	'Class:lnkLogicalInterfaceToVRF/Name' => '%1$s / %2$s',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id' => 'Logical Interface',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name' => 'Logical Interface Name',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id' => 'Device',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name' => 'Device name',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name' => 'VRF Name',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name+' => '',
));

