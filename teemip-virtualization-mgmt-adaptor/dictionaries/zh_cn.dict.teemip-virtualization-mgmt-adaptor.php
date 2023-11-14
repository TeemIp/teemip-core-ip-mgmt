<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: VirtualMachine
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:VirtualMachine/Attribute:managementip_id' => '管理IP',
	'Class:VirtualMachine/Attribute:managementip_id+' => '',
	'Class:VirtualMachine/Attribute:managementip_name' => 'IP名称',
	'Class:VirtualMachine/Attribute:managementip_name+' => '',
	'Class:VirtualMachine/Tab:ipaddresses_list' => '接口的IP地址',
	'Class:VirtualMachine/Tab:ipaddresses_list+' => '列出连接到CI的所有逻辑接口托管的所有IP地址',
));

//
// Class: Hypervisor
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:Hypervisor/Tab:physicalinterfaces_list' => '网络接口',
	'Class:Hypervisor/Tab:physicalinterfaces_list+' => '列出托管在虚拟化主机服务器上的物理网络接口',
	'Class:Hypervisor/Tab:ipaddresses_list' => '接口的IP地址',
	'Class:Hypervisor/Tab:ipaddresses_list+' => '列出连接到CI的所有IP接口托管的所有IP地址',
));

//
// Class: LogicalInterface
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:LogicalInterface/Attribute:vlans_list' => 'VLAN',
	'Class:LogicalInterface/Attribute:vlans_list+' => '',
	'Class:LogicalInterface/Attribute:vrfs_list' => 'VRF',
	'Class:LogicalInterface/Attribute:vrfs_list+' => '',
	'Class:LogicalInterface/Attribute:status' => '状态',
	'Class:LogicalInterface/Attribute:status+' => '',
	'Class:LogicalInterface/Attribute:status/Value:active' => '活动',
	'Class:LogicalInterface/Attribute:status/Value:active+' => '',
	'Class:LogicalInterface/Attribute:status/Value:inactive' => '不活动',
	'Class:LogicalInterface/Attribute:status/Value:inactive+' => '',
));

//
// Class: VLAN
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:VLAN/Attribute:logicalinterfaces_list' => '逻辑网络接口',
	'Class:VLAN/Attribute:logicalinterfaces_list+' => '列出连接到VLAN的所有逻辑网络接口',
));

//
// Class: VRF
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:VRF/Attribute:logicalinterfaces_list' => '逻辑网络接口',
	'Class:VRF/Attribute:logicalinterfaces_list+' => '列出连接到VRF的所有逻辑网络接口',
));

//
// Class: lnkLogicalInterfaceToVLAN
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkLogicalInterfaceToVLAN' => '链接逻辑接口 / VLAN',
	'Class:lnkLogicalInterfaceToVLAN+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Name' => '%1$s / %2$s',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id' => '逻辑接口',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name' => '逻辑接口名称',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id' => '设备',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name' => '设备名称',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag' => 'VLAN标签',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:vlan_tag+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode' => '模式',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode+' => '标记或未标记的模式',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged' => '标记',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:untagged' => '未标记',
	'Class:lnkLogicalInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));

//
// Class: lnkLogicalInterfaceToVRF
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkLogicalInterfaceToVRF' => '链接逻辑接口 / VRF',
	'Class:lnkLogicalInterfaceToVRF+' => '',
	'Class:lnkLogicalInterfaceToVRF/Name' => '%1$s / %2$s',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id' => '逻辑接口',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name' => '逻辑接口名称',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id' => '设备',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name' => '设备名称',
	'Class:lnkLogicalInterfaceToVRF/Attribute:logicalinterface_device_name+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name' => 'VRF名称',
	'Class:lnkLogicalInterfaceToVRF/Attribute:vrf_name+' => '',
));

