<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
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
	'Class:VirtualMachine/Tab:ipaddresses_list' => 'IPs-Schnittstellen',
	'Class:VirtualMachine/Tab:ipaddresses_list+' => 'Liste aller IP-Adressen aller an das CI angeschlossenen Logischen Schnittstellen',
));

//
// Class: Hypervisor
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:Hypervisor/Tab:physicalinterfaces_list' => 'Netzwerkschnittstellen',
	'Class:Hypervisor/Tab:physicalinterfaces_list+' => 'Liste der Netzwerkschnittstellen, die vom Server des Hypervisors gehostet werden',
	'Class:Hypervisor/Tab:ipaddresses_list' => 'IP-Adressen',
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
	'Class:VLAN/Attribute:logicalinterfaces_list' => 'Logische Schnittstelle',
	'Class:VLAN/Attribute:logicalinterfaces_list+' => '',
));

//
// Class: VRF
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:VRF/Attribute:logicalinterfaces_list' => 'Logische Schnittstelle',
	'Class:VRF/Attribute:logicalinterfaces_list+' => '',
));

//
// Class: lnkLogicalInterfaceToVLAN
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkLogicalInterfaceToVLAN' => 'Verknüpfung Logische Schnittstelle / VLAN',
	'Class:lnkLogicalInterfaceToVLAN+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id' => 'Logische Schnittstelle',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name' => 'Logische Schnittstelle Name',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id' => 'Gerät',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name' => 'Gerätename',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag' => 'VLAN Tag',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode' => 'Modus',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode+' => 'Modus tagged oder untagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));

//
// Class: lnkLogicalInterfaceToVRF
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkLogicalInterfaceToVRF' => 'Verknüpfung Logische Schnittstelle / VRF',
	'Class:lnkLogicalInterfaceToVRF+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id' => 'Logische Schnittstelle',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name' => 'Logische Schnittstelle Name',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id' => 'Gerät',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name' => 'Gerätname',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name' => 'VRF Name',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name+' => '',
));
