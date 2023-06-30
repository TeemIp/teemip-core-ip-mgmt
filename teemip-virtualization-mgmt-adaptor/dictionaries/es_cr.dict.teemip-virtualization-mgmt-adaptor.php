<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: VirtualMachine
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:VirtualMachine/Attribute:managementip_id' => 'IP',
	'Class:VirtualMachine/Attribute:managementip_id+' => '',
	'Class:VirtualMachine/Attribute:managementip_name' => 'Nombre IP',
	'Class:VirtualMachine/Attribute:managementip_name+' => '',
	'Class:VirtualMachine/Tab:ipaddresses_list' => 'IP de interfaces',
	'Class:VirtualMachine/Tab:ipaddresses_list+' => 'Lista de todas las direcciones IP alojadas por todas las interfaces lógicas adjuntas al CI',
));

//
// Class: Hypervisor
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:Hypervisor/Tab:physicalinterfaces_list' => 'Interfaces físicas de red',
	'Class:Hypervisor/Tab:physicalinterfaces_list+' => 'Lista de las interfaces de red físicas alojadas por el servidor del hipervisor',
	'Class:Hypervisor/Tab:ipaddresses_list' => 'IP de interfaces',
	'Class:Hypervisor/Tab:ipaddresses_list+' => 'Lista de todas las direcciones IP alojadas por todas las interfaces IP conectadas al CI',
));

//
// Class: LogicalInterface
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:LogicalInterface/Attribute:vlans_list' => 'VLANs',
	'Class:LogicalInterface/Attribute:vlans_list+' => '',
	'Class:LogicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:LogicalInterface/Attribute:vrfs_list+' => '',
	'Class:LogicalInterface/Attribute:status' => 'Estatus',
	'Class:LogicalInterface/Attribute:status+' => '',
	'Class:LogicalInterface/Attribute:status/Value:active' => 'Activo',
	'Class:LogicalInterface/Attribute:status/Value:active+' => '',
	'Class:LogicalInterface/Attribute:status/Value:inactive' => 'Inactivo',
	'Class:LogicalInterface/Attribute:status/Value:inactive+' => '',
));

//
// Class: VLAN
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:VLAN/Attribute:logicalinterfaces_list' => 'interfaces Logicas de Red',
	'Class:VLAN/Attribute:logicalinterfaces_list+' => '',
));

//
// Class: VRF
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:VRF/Attribute:logicalinterfaces_list' => 'interfaces Logicas de Red',
	'Class:VRF/Attribute:logicalinterfaces_list+' => '',
));

//
// Class: lnkLogicalInterfaceToVLAN
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellaño', array(
	'Class:lnkLogicalInterfaceToVLAN' => 'Relación Interfaz Logica / VLAN',
	'Class:lnkLogicalInterfaceToVLAN+' => 'Relación Interfaz Logica / VLAN',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id' => 'Interfaz Logica',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id+' => 'Interfaz Logica',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name' => 'Nombre Interfaz Logica',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name+' => 'Nombre Interfaz Logica',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id' => 'Dispositivo',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id+' => 'Dispositivo',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name' => 'Nombre de Dispositivo',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name+' => 'Nombre de Dispositivo',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id' => 'vLAN',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id+' => 'vLAN',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag' => 'Etiqueta VLAN',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag+' => 'Etiqueta VLAN',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode' => 'Modo',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode+' => 'Modo tagged o untagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));

//
// Class: lnkLogicalInterfaceToVRF
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellaño', array(
	'Class:lnkLogicalInterfaceToVRF' => 'Relación Interfaz Logica / VRF',
	'Class:lnkLogicalInterfaceToVRF+' => '',
	'Class:lnkLogicalInterfaceToVRF/Name' => '%1$s / %2$s',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id' => 'Interfaz Logica',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name' => 'Nombre Interfaz Logica',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id' => 'Dispositivo',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name' => 'Nombre de Dispositivo',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name' => 'Nombre de VRF',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name+' => '',
));
