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
));

