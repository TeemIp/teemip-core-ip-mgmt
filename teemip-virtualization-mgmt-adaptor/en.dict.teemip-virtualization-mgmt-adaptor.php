<?php
// Copyright (C) 2020 TeemIp
//
//   This file is part of TeemIp.
//
//   TeemIp is free software; you can redistribute it and/or modify
//   it under the terms of the GNU Affero General Public License as published by
//   the Free Software Foundation, either version 3 of the License, or
//   (at your option) any later version.
//
//   TeemIp is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU Affero General Public License for more details.
//
//   You should have received a copy of the GNU Affero General Public License
//   along with TeemIp. If not, see <http://www.gnu.org/licenses/>

/**
 * @copyright   Copyright (C) 2020 TeemIp
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
));

//
// Class: VLAN
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:VLAN/Attribute:logicalinterfaces_list' => 'Logical network interfaces',
	'Class:VLAN/Attribute:logicalinterfaces_list+' => '',
));

//
// Class: VRF
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:VRF/Attribute:logicalinterfaces_list' => 'Logical network interfaces',
	'Class:VRF/Attribute:logicalinterfaces_list+' => '',
));

//
// Class: lnkLogicalInterfaceToVLAN
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkLogicalInterfaceToVLAN' => 'Link LogicalInterface / VLAN',
	'Class:lnkLogicalInterfaceToVLAN+' => '',
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
));

