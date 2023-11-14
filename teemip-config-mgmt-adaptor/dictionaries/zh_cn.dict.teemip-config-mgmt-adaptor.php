<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: ConnectableCI
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:ConnectableCI/Tab:ipaddresses_list' => '接口IP地址',
	'Class:ConnectableCI/Tab:ipaddresses_list+' => '列出与配置项关联的所有物理接口所托管的IP地址',
));

//
// Class: DatacenterDevice
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:DatacenterDevice/Attribute:managementip_id' => '管理IP',
	'Class:DatacenterDevice/Attribute:managementip_id+' => '',
	'Class:DatacenterDevice/Attribute:managementip_name' => '管理IP名称',
	'Class:DatacenterDevice/Attribute:managementip_name+' => '',
));

//
// Class: NetworkInterface
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:NetworkInterface:baseinfo' => '基本信息',
	'Class:NetworkInterface:wiringinfo' => '布线信息',
	'Class:NetworkInterface:moreinfo' => '更多信息',
	'Class:NetworkInterface/Attribute:operational_status' => '运行状态',
	'Class:NetworkInterface/Attribute:operational_status+' => '根据子类状态计算得出',
	'Class:NetworkInterface/Attribute:operational_status/Value:active' => '活动',
	'Class:NetworkInterface/Attribute:operational_status/Value:active+' => '',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive' => '非活动',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive+' => '',
));

//
// Class: IPInterface
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPInterface/Attribute:ip_list' => 'IP地址',
	'Class:IPInterface/Attribute:ip_list+' => '',
));

//
// Class: PhysicalInterface
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:PhysicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:PhysicalInterface/Attribute:vrfs_list+' => '',
	'Class:PhysicalInterface/Attribute:status' => '状态',
	'Class:PhysicalInterface/Attribute:status+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:stock' => '库存',
	'Class:PhysicalInterface/Attribute:status/Value:stock+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:active' => '活动',
	'Class:PhysicalInterface/Attribute:status/Value:active+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:inactive' => '非活动',
	'Class:PhysicalInterface/Attribute:status/Value:inactive+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete' => '已过时',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete+' => '',
));

//
// Class: VLAN
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:VLAN/Tab:ipaddresses_list' => '接口IP地址',
	'Class:VLAN/Tab:ipaddresses_list+' => '列出与配置项关联的所有IP接口所托管的IP地址',
));

//
// Class: lnkPhysicalInterfaceToVLAN
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode' => '模式',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode+' => '标记或未标记的模式',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:tagged' => '标记',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:untagged' => '未标记',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));
