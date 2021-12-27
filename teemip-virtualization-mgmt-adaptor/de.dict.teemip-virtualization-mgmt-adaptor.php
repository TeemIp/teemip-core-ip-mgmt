<?php
/**
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: VirtualMachine
//
 
Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:VirtualMachine/Attribute:managementip_id' => 'IP',
	'Class:VirtualMachine/Attribute:managementip_id+' => '',
	'Class:VirtualMachine/Attribute:managementip_name' => 'IP Name',
	'Class:VirtualMachine/Attribute:managementip_name+' => '',
	'Class:VirtualMachine/Tab:ipaddresses_list' => 'IPs-Interfaces',
	'Class:VirtualMachine/Tab:ipaddresses_list+' => 'Liste aller IP-Adressen aller an das CI angeschlossenen Logisches Interface',
));

//
// Class: Hypervisor
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:Hypervisor/Tab:physicalinterfaces_list' => 'Netzwerkinterfaces',
	'Class:Hypervisor/Tab:physicalinterfaces_list+' => 'Liste der Netzwerkinterfaces, die vom Server des Hypervisors gehostet werden',
	'Class:Hypervisor/Tab:ipaddresses_list' => 'IPs-Interfaces',
	'Class:Hypervisor/Tab:ipaddresses_list+' => 'Liste aller IP-Adressen aller an das CI angeschlossenen Schnittstellen',
));

//
// Class: LogicalInterface
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:LogicalInterface/Attribute:vlans_list' => 'VLANs',
	'Class:LogicalInterface/Attribute:vlans_list+' => '',
	'Class:LogicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:LogicalInterface/Attribute:vrfs_list+' => '',
	'Class:LogicalInterface/Attribute:status' => 'Status',
	'Class:LogicalInterface/Attribute:status+' => '',
	'Class:LogicalInterface/Attribute:status/Value:active' => 'Aktiv',
	'Class:LogicalInterface/Attribute:status/Value:active+' => '',
	'Class:LogicalInterface/Attribute:status/Value:inactive' => 'Inaktiv',
	'Class:LogicalInterface/Attribute:status/Value:inactive+' => '',
));

//
// Class: VLAN
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:VLAN/Attribute:logicalinterfaces_list' => 'Logisches Interfaces',
	'Class:VLAN/Attribute:logicalinterfaces_list+' => '',
));

//
// Class: VRF
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:VRF/Attribute:logicalinterfaces_list' => 'Logisches Interfaces',
	'Class:VRF/Attribute:logicalinterfaces_list+' => '',
));

//
// Class: lnkLogicalInterfaceToVLAN
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkLogicalInterfaceToVLAN' => 'Verknüpfung Logisches Interface / VLAN',
	'Class:lnkLogicalInterfaceToVLAN+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id' => 'Logisches Interface',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name' => 'Logisches Interface Name',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id' => 'Gerät',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name' => 'Gerätename',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag' => 'VLAN Tag',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag+' => '',
));

