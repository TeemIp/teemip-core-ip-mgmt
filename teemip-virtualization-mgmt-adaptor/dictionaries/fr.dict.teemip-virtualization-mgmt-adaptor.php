<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: VirtualMachine
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:VirtualMachine/Attribute:managementip_id' => 'IP',
	'Class:VirtualMachine/Attribute:managementip_id+' => '',
	'Class:VirtualMachine/Attribute:managementip_name' => 'Nom IP',
	'Class:VirtualMachine/Attribute:managementip_name+' => '',
	'Class:VirtualMachine/Tab:ipaddresses_list' => 'IPs des interfaces',
	'Class:VirtualMachine/Tab:ipaddresses_list+' => 'Liste de toutes les adresses IP de toutes les interfaces logiques attachées au CI',
));

//
// Class: Hypervisor
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:Hypervisor/Tab:physicalinterfaces_list' => 'Interfaces réseaux',
	'Class:Hypervisor/Tab:physicalinterfaces_list+' => 'Liste des interfaces réseaux physiques du serveur hébergeant l\'hyperviseur',
	'Class:Hypervisor/Tab:ipaddresses_list' => 'IPs des Interfaces',
	'Class:Hypervisor/Tab:ipaddresses_list+' => 'Liste de toutes les adresses IP de toutes les interfaces attachées au CI',
));

//
// Class: LogicalInterface
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:LogicalInterface/Attribute:vlans_list' => 'VLANs',
	'Class:LogicalInterface/Attribute:vlans_list+' => '',
	'Class:LogicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:LogicalInterface/Attribute:vrfs_list+' => '',
	'Class:LogicalInterface/Attribute:status' => 'Statut',
	'Class:LogicalInterface/Attribute:status+' => '',
	'Class:LogicalInterface/Attribute:status/Value:active' => 'Active',
	'Class:LogicalInterface/Attribute:status/Value:active+' => '',
	'Class:LogicalInterface/Attribute:status/Value:inactive' => 'Inactive',
	'Class:LogicalInterface/Attribute:status/Value:inactive+' => '',
));

//
// Class: VLAN
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:VLAN/Attribute:logicalinterfaces_list' => 'Interfaces réseaux logiques',
	'Class:VLAN/Attribute:logicalinterfaces_list+' => '',
));

//
// Class: VRF
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:VRF/Attribute:logicalinterfaces_list' => 'Interfaces réseaux logiques',
	'Class:VRF/Attribute:logicalinterfaces_list+' => '',
));

//
// Class: lnkLogicalInterfaceToVLAN
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkLogicalInterfaceToVLAN' => 'Lien Interface réseau / VLAN',
	'Class:lnkLogicalInterfaceToVLAN+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id' => 'Interface réseau',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name' => 'Nom interface réseau',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id' => 'Equipement',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name' => 'Nom équipement',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag' => 'VLAN Tag',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode' => 'Mode',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode+' => 'Mode tagged ou untagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
));


//
// Class: lnkLogicalInterfaceToVRF
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkLogicalInterfaceToVRF' => 'Lien Interface réseau / VRF',
	'Class:lnkLogicalInterfaceToVRF+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id' => 'Interface réseau',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name' => 'Nom interface réseau',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id' => 'Equipement',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name' => 'Nom équipement',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name' => 'Nom de la VRF',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name+' => '',
));
