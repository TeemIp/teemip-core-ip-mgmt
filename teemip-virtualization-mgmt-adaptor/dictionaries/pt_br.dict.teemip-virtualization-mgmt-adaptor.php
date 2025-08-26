<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: VirtualMachine
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:VirtualMachine/Attribute:managementip_id' => 'IP',
	'Class:VirtualMachine/Attribute:managementip_id+' => '',
	'Class:VirtualMachine/Attribute:managementip_name' => 'Nome do IP',
	'Class:VirtualMachine/Attribute:managementip_name+' => '',
	'Class:VirtualMachine/Tab:ipaddresses_list' => 'IPs das Interfaces',
	'Class:VirtualMachine/Tab:ipaddresses_list+' => 'Lista de todos os endereços IP hospedados por todas as interfaces lógicas anexadas ao CI',
));

//
// Class: Hypervisor
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:Hypervisor/Tab:physicalinterfaces_list' => 'Interfaces de rede',
	'Class:Hypervisor/Tab:physicalinterfaces_list+' => 'Lista das interfaces de rede físicas hospedadas pelo servidor do hypervisor',
	'Class:Hypervisor/Tab:ipaddresses_list' => 'IPs das Interfaces',
	'Class:Hypervisor/Tab:ipaddresses_list+' => 'Lista de todos os endereços IP hospedados por todas as interfaces IP anexadas ao CI',
));

//
// Class: LogicalInterface
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:LogicalInterface/Attribute:vlans_list' => 'VLANs',
	'Class:LogicalInterface/Attribute:vlans_list+' => '',
	'Class:LogicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:LogicalInterface/Attribute:vrfs_list+' => '',
	'Class:LogicalInterface/Attribute:status' => 'Status',
	'Class:LogicalInterface/Attribute:status+' => '',
	'Class:LogicalInterface/Attribute:status/Value:active' => 'Ativa',
	'Class:LogicalInterface/Attribute:status/Value:active+' => '',
	'Class:LogicalInterface/Attribute:status/Value:inactive' => 'Inativa',
	'Class:LogicalInterface/Attribute:status/Value:inactive+' => '',
));

//
// Class: VLAN
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:VLAN/Attribute:logicalinterfaces_list' => 'Interfaces de rede lógicas',
	'Class:VLAN/Attribute:logicalinterfaces_list+' => 'Lista de todas as interfaces de rede lógicas anexadas à VLAN',
));

//
// Class: VRF
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:VRF/Attribute:logicalinterfaces_list' => 'Interfaces de rede lógicas',
	'Class:VRF/Attribute:logicalinterfaces_list+' => 'Lista de todas as interfaces de rede lógicas anexadas à VRF',
));

//
// Class: lnkLogicalInterfaceToVLAN
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkLogicalInterfaceToVLAN' => 'Vincular Interface Lógica / VLAN',
	'Class:lnkLogicalInterfaceToVLAN+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Name' => '%1$s / %2$s',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id' => 'Interface Lógica',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name' => 'Nome da Interface Lógica',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id' => 'Dispositivo',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name' => 'Nome do dispositivo',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag' => 'Tag da VLAN',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode' => 'Modo',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode+' => 'Modo com tag (tagged) ou sem tag (untagged)',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));

//
// Class: lnkLogicalInterfaceToVRF
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkLogicalInterfaceToVRF' => 'Vincular Interface Lógica / VRF',
	'Class:lnkLogicalInterfaceToVRF+' => '',
	'Class:lnkLogicalInterfaceToVRF/Name' => '%1$s / %2$s',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id' => 'Interface Lógica',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name' => 'Nome da Interface Lógica',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id' => 'Dispositivo',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name' => 'Nome do dispositivo',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name' => 'Nome da VRF',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name+' => '',
));

