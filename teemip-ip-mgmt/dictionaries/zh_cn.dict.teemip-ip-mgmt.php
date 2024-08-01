<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'Teemip-ip-Mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// Class: IPObject
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPObject' => 'IP对象',
	'Class:IPObject+' => '',
	'IPObject:GlobalParams' => '全局设置',
	'IPObject:GlobalParams+' => '在组织级别设置的默认全局设置和实际用于对象的设置',
	'Class:IPObject:GeneralConfigParameters' => '组织设置',
	'Class:IPObject/Attribute:finalclass' => '子类',
	'Class:IPObject/Attribute:finalclass+' => '最终类的名称',
	'Class:IPObject/Attribute:org_id' => '组织',
	'Class:IPObject/Attribute:org_id+' => '',
	'Class:IPObject/Attribute:org_name' => '组织名称',
	'Class:IPObject/Attribute:org_name+' => '',
	'Class:IPObject/Attribute:status' => '状态',
	'Class:IPObject/Attribute:status+' => '',
	'Class:IPObject/Attribute:status/Value:reserved' => '保留',
	'Class:IPObject/Attribute:status/Value:reserved+' => '',
	'Class:IPObject/Attribute:status/Value:allocated' => '已分配',
	'Class:IPObject/Attribute:status/Value:allocated+' => '',
	'Class:IPObject/Attribute:status/Value:released' => '已释放',
	'Class:IPObject/Attribute:status/Value:released+' => '',
	'Class:IPObject/Attribute:status/Value:unassigned' => '未分配',
	'Class:IPObject/Attribute:status/Value:unassigned+' => '',
	'Class:IPObject/Attribute:comment' => '备注',
	'Class:IPObject/Attribute:comment+' => '',
	'Class:IPObject/Attribute:requestor_id' => '请求者',
	'Class:IPObject/Attribute:requestor_id+' => '',
	'Class:IPObject/Attribute:requestor_name' => '请求者名称',
	'Class:IPObject/Attribute:requestor_name+' => '',
	'Class:IPObject/Attribute:allocation_date' => '分配日期',
	'Class:IPObject/Attribute:allocation_date+' => 'IP对象分配的日期',
	'Class:IPObject/Attribute:release_date' => '释放日期',
	'Class:IPObject/Attribute:release_date+' => 'IP对象被释放且不再使用的日期。',
	'Class:IPObject/Attribute:ipconfig_id' => '全局IP设置',
	'Class:IPObject/Attribute:ipconfig_id+' => '',
	'Class:IPObject/Attribute:contact_list' => '联系人',
	'Class:IPObject/Attribute:contact_list+' => '附加到IP对象的联系人',
	'Class:IPObject/Attribute:document_list' => '文档',
	'Class:IPObject/Attribute:document_list+' => '附加到IP对象的文档',
));

//
// Class: lnkContactToIPObject
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkContactToIPObject' => '联系人/ IP对象链接',
	'Class:lnkContactToIPObject+' => '',
	'Class:lnkContactToIPObject/Name' => '%1$s / %2$s',
	'Class:lnkContactToIPObject/Attribute:ipobject_id' => 'IP对象',
	'Class:lnkContactToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_id' => '联系人',
	'Class:lnkContactToIPObject/Attribute:contact_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_name' => '联系人名称',
	'Class:lnkContactToIPObject/Attribute:contact_name+' => '',
));

//
// Class: lnkDocToIPObject
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkDocToIPObject' => '文档/IP对象链接',
	'Class:lnkDocToIPObject+' => '',
	'Class:lnkDocToIPObject/Name' => '%1$s / %2$s',
	'Class:lnkDocToIPObject/Attribute:ipobject_id' => 'IP对象',
	'Class:lnkDocToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_id' => '文档',
	'Class:lnkDocToIPObject/Attribute:document_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_name' => '文档名称',
	'Class:lnkDocToIPObject/Attribute:document_name+' => '',
));

//
// Class: lnkIPObjectToTicket
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkIPObjectToTicket' => '链接IP对象/工单',
	'Class:lnkIPObjectToTicket+' => '',
	'Class:lnkIPObjectToTicket/Name' => '%1$s / %2$s',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id_finalclass_recall' => 'IP对象类型',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id_finalclass_recall+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id' => 'IP对象',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_id' => '工单',
	'Class:lnkIPObjectToTicket/Attribute:ticket_id+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_ref' => '参考',
	'Class:lnkIPObjectToTicket/Attribute:ticket_ref+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_title' => '标题',
	'Class:lnkIPObjectToTicket/Attribute:ticket_title+' => '',
));

//
// Class: IPBlock
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPBlock' => '子网块',
	'Class:IPBlock+' => '',
	'Class:IPBlock:baseinfo' => '基本信息',
	'Class:IPBlock:automation' => '自动化',
	'Class:IPBlock:delegationinfo' => '委托信息',
	'Class:IPBlock:ipinfo' => 'IP信息',
	'Class:IPBlock:DelegatedToChild' => '<delegation_highlight>委托给组织：</delegation_highlight>%1$s',
	'Class:IPBlock:DelegatedFromParent' => '<delegation_highlight>来自组织的委托：</delegation_highlight>%1$s',
	'Class:IPBlock:localconfigparameters' => '子网块设置',
	'Class:IPBlock/Attribute:name' => '名称',
	'Class:IPBlock/Attribute:name+' => '',
	'Class:IPBlock/Attribute:ipblocktype_id' => '类型',
	'Class:IPBlock/Attribute:ipblocktype_id+' => '子网块的类型',
	'Class:IPBlock/Attribute:ipblocktype_name' => '类型名称',
	'Class:IPBlock/Attribute:ipblocktype_name+' => '',
	'Class:IPBlock/Attribute:allocation_date' => '分配日期',
	'Class:IPBlock/Attribute:allocation_date+' => '子网块被分配的日期',
	'Class:IPBlock/Attribute:parent_org_id' => '委托自',
	'Class:IPBlock/Attribute:parent_org_id+' => '子网块被委托自的组织',
	'Class:IPBlock/Attribute:parent_org_name' => '委托组织名称',
	'Class:IPBlock/Attribute:parent_org_name+' => '子网块被委托自的组织的名称',
	'Class:IPBlock/Attribute:occupancy' => '已使用空间',
	'Class:IPBlock/Attribute:occupancy+' => '',
	'Class:IPBlock/Attribute:children_occupancy' => '子块已使用空间',
	'Class:IPBlock/Attribute:children_occupancy+' => '',
	'Class:IPBlock/Attribute:subnet_occupancy' => '子网已使用空间',
	'Class:IPBlock/Attribute:subnet_occupancy+' => '',
	'Class:IPBlock/Attribute:location_list' => '位置',
	'Class:IPBlock/Attribute:location_list+' => '子网块所涵盖的位置',
	'Class:IPBlock/Attribute:origin' => '来源',
	'Class:IPBlock/Attribute:origin+' => '块的来源：区域或本地互联网注册机构或其他组织',
	'Class:IPBlock/Attribute:origin/Value:rir' => 'RIR',
	'Class:IPBlock/Attribute:origin/Value:rir+' => '区域互联网注册机构',
	'Class:IPBlock/Attribute:origin/Value:lir' => 'LIR',
	'Class:IPBlock/Attribute:origin/Value:lir+' => '本地互联网注册机构',
	'Class:IPBlock/Attribute:origin/Value:other' => '其他',
	'Class:IPBlock/Attribute:origin/Value:other+' => 'IT部门...',
	'Class:IPBlock/Attribute:registrar_id' => '注册机构',
	'Class:IPBlock/Attribute:registrar_id+' => '相关的区域或本地互联网注册机构',
	'Class:IPBlock/Attribute:registrar_name' => '注册机构名称',
	'Class:IPBlock/Attribute:registrar_name+' => '',
));

//
// Class extensions for IPBlock
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPBlock/Tab:globalparam' => '全局设置',
	'Class:IPBlock/Tab:childblock' => '子块',
	'Class:IPBlock/Tab:childblock+' => '附加到此块的子块',
	'Class:IPBlock/Tab:childblock/SelectList' => '更改显示',
	'Class:IPBlock/Tab:childblock/SelectList0' => '仅显示子块',
	'Class:IPBlock/Tab:childblock/SelectList1' => '显示整个子块层次结构',
	'Class:IPBlock/Tab:childblock/List0' => '仅子块',
	'Class:IPBlock/Tab:childblock/List1' => '整个子块层次结构',
	'Class:IPBlock/Tab:childblock-count' => '子块：%1$s',
	'Class:IPBlock/Tab:childblock-count-percent' => ' 子块使用的空间。',
	'Class:IPBlock/Tab:childblock-count-percent-remain' => '剩余空间中子块使用的空间：%1$.1f %%',
	'Class:IPBlock/Tab:subnet' => '子网',
	'Class:IPBlock/Tab:subnet+' => '附加到此块的子网',
	'Class:IPBlock/Tab:subnet-count' => '子网：%1$s',
	'Class:IPBlock/Tab:subnet-count-percent' => ' 子网使用的空间',
	'Class:IPBlock/Tab:subnet-count-percent-remain' => '剩余空间中子网使用的空间：%1$.1f %%',
));

//
// Class: lnkBlockToLocation
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkIPBlockToLocation' => '链接块/位置',
	'Class:lnkIPBlockToLocation+' => '',
	'Class:lnkIPBlockToLocation/Name' => '%1$s / %2$s',
	'Class:lnkIPBlockToLocation/Attribute:block_id' => '块',
	'Class:lnkIPBlockToLocation/Attribute:block_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:block_name' => '块名称',
	'Class:lnkIPBlockToLocation/Attribute:block_name+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_id' => '位置',
	'Class:lnkIPBlockToLocation/Attribute:location_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_name' => '位置名称',
	'Class:lnkIPBlockToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Block
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPv4Block' => 'IPv4子网块',
	'Class:IPv4Block+' => '',
	'Class:IPv4Block/ComplementaryName' => '%1$s - %2$s',
	'Class:IPv4Block/Attribute:parent_id' => '父块',
	'Class:IPv4Block/Attribute:parent_id+' => '',
	'Class:IPv4Block/Attribute:parent_name' => '父块名称',
	'Class:IPv4Block/Attribute:parent_name+' => '',
	'Class:IPv4Block/Attribute:parent_origin' => '父块来源',
	'Class:IPv4Block/Attribute:parent_origin+' => '',
	'Class:IPv4Block/Attribute:firstip' => '第一个IP',
	'Class:IPv4Block/Attribute:firstip+' => '子网块的第一个IP地址',
	'Class:IPv4Block/Attribute:lastip' => '最后一个IP',
	'Class:IPv4Block/Attribute:lastip+' => '子网块的最后一个IP地址',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_min_size' => 'IPv4子网块的最小大小',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_min_size+' => '',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_cidr_aligned' => '将IPv4子网块对齐到CIDR',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_cidr_aligned+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_min_size' => '最小大小',
	'Class:IPv4Block/Attribute:ipv4_block_min_size+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned' => '对齐到CIDR',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:default' => '与全局IP设置对齐',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:bca_no' => '强制为否',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:bca_yes' => '强制为是',
));

//
// Class: IPSubnet
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPSubnet' => '子网',
	'Class:IPSubnet+' => '',
	'Class:IPSubnet:baseinfo' => '基本信息',
	'Class:IPSubnet:ipinfo' => 'IP信息',
	'Class:IPSubnet:automation' => '自动化',
	'Class:IPSubnet:localconfigparameters' => '子网设置',
	'Class:IPSubnet/ComplementaryName' => '%1$s - %2$s',
	'Class:IPSubnet/Attribute:name' => '名称',
	'Class:IPSubnet/Attribute:name+' => '',
	'Class:IPSubnet/Attribute:type' => '类型',
	'Class:IPSubnet/Attribute:type+' => '',
	'Class:IPSubnet/Attribute:allocation_date' => '分配日期',
	'Class:IPSubnet/Attribute:allocation_date+' => '子网被分配的日期',
	'Class:IPSubnet/Attribute:release_date' => '释放日期',
	'Class:IPSubnet/Attribute:release_date+' => '子网被释放且不再使用的日期。',
	'Class:IPSubnet/Attribute:ip_occupancy' => '已注册IP',
	'Class:IPSubnet/Attribute:ip_occupancy+' => '',
	'Class:IPSubnet/Attribute:range_occupancy' => '已注册范围',
	'Class:IPSubnet/Attribute:range_occupancy+' => '',
	'Class:IPSubnet/Attribute:alarm_water_mark' => '水位报警状态',
	'Class:IPSubnet/Attribute:alarm_water_mark+' => '',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:no_alarm' => '尚未发送报警',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:low_sent' => '已发送低水位报警',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:high_sent' => '已发送高水位报警',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips' => '在子网创建时保留子网、网关和广播IP',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips+' => '',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips/Value:reserve_no' => '否',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips/Value:reserve_yes' => '是',
	'Class:IPSubnet/Attribute:reserve_subnet_ips' => '保留子网、网关和广播IP',
	'Class:IPSubnet/Attribute:reserve_subnet_ips+' => '定义子网、网关和广播IP保留的策略',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:default' => '与全局IP设置对齐',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:reserve_no' => '强制为否',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:reserve_yes' => '强制为是',
	'Class:IPSubnet/Attribute:subnets_list' => 'NAT子网',
	'Class:IPSubnet/Attribute:subnets_list+' => 'NAT子网列表',
	'Class:IPSubnet/Attribute:vlans_list' => 'VLAN',
	'Class:IPSubnet/Attribute:vlans_list+' => '子网所属的VLAN列表',
	'Class:IPSubnet/Attribute:vrfs_list' => 'VRF',
	'Class:IPSubnet/Attribute:vrfs_list+' => '子网所属的VRF列表',
	'Class:IPSubnet/Attribute:location_list' => '位置',
	'Class:IPSubnet/Attribute:location_list+' => '子网所涵盖的位置',
	'Class:IPSubnet/Attribute:summary/cell0' => '按状态注册的IP',
	'Class:IPSubnet/Attribute:summary/cell0+' => '总计：%1$s',
));

//
// Class extensions for IPSubnet
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPSubnet/Tab:globalparam' => '全局设置',
	'Class:IPSubnet/Tab:ipregistered' => '已注册的IP',
	'Class:IPSubnet/Tab:ipregistered+' => '子网中已注册的IP',
	'Class:IPSubnet/Tab:ipregistered-count' => ' - %1$s 保留，%2$s 已分配，%3$s 已释放，%4$s 未分配，共 %5$s',
	'Class:IPSubnet/Tab:ipfree-explain' => '前 %1$s 个空闲IP地址列表：',
	'Class:IPSubnet/Tab:ipfree-explainbis' => '所有空闲IP地址列表：',
	'Class:IPSubnet/Tab:iprange' => 'IP范围',
	'Class:IPSubnet/Tab:iprange+' => '子网的IP范围',
	'Class:IPSubnet/Tab:iprange-count-percent' => ' IP范围使用的空间。',
	'Class:IPSubnet/Tab:notifications' => '通知',
	'Class:IPSubnet/Tab:notifications+' => '与此子网相关的通知',
	'Class:IPSubnet/Tab:requests' => 'IP请求',
	'Class:IPSubnet/Tab:requests+' => '与此子网相关的IP请求',
	'Class:IPSubnet/Tab:changes' => 'IP变更',
	'Class:IPSubnet/Tab:changes+' => '与此子网相关的IP变更',
));

//
// Class: lnkIPSubnetToIPSubnet
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkIPSubnetToIPSubnet' => '链接子网/ NAT子网',
	'Class:lnkIPSubnetToIPSubnet+' => '',
	'Class:lnkIPSubnetToIPSubnet/Name' => '%1$s / %2$s',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall' => '子网类型',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id' => '子网',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id+' => '要转换的子网',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id' => 'NAT子网',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id+' => '转换后的子网',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name' => '名称',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name+' => '子网的名称',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name' => '名称',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name+' => '子网的名称',
));

//
// Class: lnkIPSubnetToVLAN
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkIPSubnetToVLAN' => '链接子网/ VLAN',
	'Class:lnkIPSubnetToVLAN+' => '',
	'Class:lnkIPSubnetToVLAN/Name' => '%1$s / %2$s',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall' => '子网类型',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id' => '子网',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name' => '子网名称',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag' => 'VLAN标签',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag+' => '',
));

//
// Class: lnkIPSubnetToVRF
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkIPSubnetToVRF' => '链接子网/ VRF',
	'Class:lnkIPSubnetToVRF+' => '',
	'Class:lnkIPSubnetToVRF/Name' => '%1$s / %2$s',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall' => '子网类型',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id' => '子网',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name' => '子网名称',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id+' => '',
));

//
// Class: lnkIPSubnetToLocation
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkIPSubnetToLocation' => '链接子网/位置',
	'Class:lnkIPSubnetToLocation+' => '',
	'Class:lnkIPSubnetToLocation/Name' => '%1$s / %2$s',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id' => '子网',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name' => '子网名称',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_id' => '位置',
	'Class:lnkIPSubnetToLocation/Attribute:location_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_name' => '位置名称',
	'Class:lnkIPSubnetToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Subnet
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPv4Subnet' => 'IPv4子网',
	'Class:IPv4Subnet+' => '',
	'Class:IPv4Subnet/ComplementaryName' => '%1$s - %2$s - %3$s',
	'Class:IPv4Subnet/Attribute:block_id' => '子网块',
	'Class:IPv4Subnet/Attribute:block_id+' => '',
	'Class:IPv4Subnet/Attribute:block_name' => '块名称',
	'Class:IPv4Subnet/Attribute:block_name+' => '',
	'Class:IPv4Subnet/Attribute:ip' => '子网IP',
	'Class:IPv4Subnet/Attribute:ip+' => '',
	'Class:IPv4Subnet/Attribute:mask' => '掩码',
	'Class:IPv4Subnet/Attribute:mask+' => '',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.0.0' => '255.255.0.0 - /16',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.128.0' => '255.255.128.0 - /17',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.192.0' => '255.255.192.0 - /18',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.224.0' => '255.255.224.0 - /19',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.240.0' => '255.255.240.0 - /20',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.248.0' => '255.255.248.0 - /21',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.252.0' => '255.255.252.0 - /22',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.254.0' => '255.255.254.0 - /23',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.255.0' => '255.255.255.0 - /24',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.255.128' => '255.255.255.128 - /25',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.255.192' => '255.255.255.192 - /26',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.255.224' => '255.255.255.224 - /27',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.255.240' => '255.255.255.240 - /28',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.255.248' => '255.255.255.248 - /29',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.255.252' => '255.255.255.252 - /30',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.255.254' => '255.255.255.254 - /31',
	'Class:IPv4Subnet/Attribute:mask/Value:255.255.255.255' => '255.255.255.255 - /32',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.0.0' => '/16',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.128.0' => '/17',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.192.0' => '/18',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.224.0' => '/19',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.240.0' => '/20',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.248.0' => '/21',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.252.0' => '/22',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.254.0' => '/23',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.255.0' => '/24',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.255.128' => '/25',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.255.192' => '/26',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.255.224' => '/27',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.255.240' => '/28',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.255.248' => '/29',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.255.252' => '/30',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.255.254' => '/31',
	'Class:IPv4Subnet/Attribute:mask/Value_cidr:255.255.255.255' => '/32',
	'Class:IPv4Subnet/Attribute:gatewayip' => '网关IP',
	'Class:IPv4Subnet/Attribute:gatewayip+' => '',
	'Class:IPv4Subnet/Attribute:broadcastip' => '广播IP',
	'Class:IPv4Subnet/Attribute:broadcastip+' => '',
	'Class:IPv4Subnet/Attribute:summary' => '摘要',
	'Class:IPv4Subnet/Attribute:ipconfig_ipv4_gateway_ip_format' => '默认网关IP格式',
	'Class:IPv4Subnet/Attribute:ipconfig_ipv4_gateway_ip_format+' => '',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format' => '网关IP格式',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format+' => '',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:default' => '与全局IP设置对齐',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1' => '强制使用子网IP + 1',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1' => '强制使用广播IP - 1',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:free_setup' => '强制使用自由分配',
));

//
// Class: IPRange
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPRange' => 'IP范围',
	'Class:IPRange+' => '',
	'Class:IPRange:baseinfo' => '基本信息',
	'Class:IPRange:ipinfo' => 'IP信息',
	'Class:IPRange/Attribute:range' => '名称',
	'Class:IPRange/Attribute:range+' => '',
	'Class:IPRange/Attribute:usage_id' => '用途',
	'Class:IPRange/Attribute:usage_id+' => '使用该范围的用途',
	'Class:IPRange/Attribute:usage_name' => '用途名称',
	'Class:IPRange/Attribute:usage_name+' => '',
	'Class:IPRange/Attribute:allocation_date' => '分配日期',
	'Class:IPRange/Attribute:allocation_date+' => '分配IP范围的日期',
	'Class:IPRange/Attribute:dhcp' => 'DHCP范围',
	'Class:IPRange/Attribute:dhcp+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no' => '否',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes' => '是',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes+' => '',
	'Class:IPRange/Attribute:occupancy' => '已注册的IP',
	'Class:IPRange/Attribute:occupancy+' => '',
	'Class:IPRange/Attribute:functionalcis_list' => 'DHCP服务器',
	'Class:IPRange/Attribute:functionalcis_list+' => '负责该DHCP范围的所有DHCP服务器的列表',
));

//
// Class extensions for IPRange
//                                                       

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPRange/Tab:ipregistered' => '已注册的IP',
	'Class:IPRange/Tab:ipregistered+' => '在IP范围内注册的IP',
	'Class:IPRange/Tab:ipregistered-count' => ' - %1$s 保留，%2$s 已分配，%3$s 已释放，%4$s 未分配，共 %5$s',
	'Class:IPRange/Tab:ipfree-explain' => '前 %1$s 个空闲IP地址列表：',
	'Class:IPRange/Tab:ipfree-explainbis' => '所有空闲IP地址列表：',
	'Class:IPRange/Tab:notifications' => '通知',
	'Class:IPRange/Tab:notifications+' => '与该IP范围相关的通知',
));

//
// Class: lnkFunctionalCIToIPRange
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkFunctionalCIToIPRange' => '链接功能CI/IP范围',
	'Class:lnkFunctionalCIToIPRange+' => '',
	'Class:lnkFunctionalCIToIPRange/Name' => '%1$s / %2$s',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id_finalclass_recall' => 'IP范围类型',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id_finalclass_recall+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id' => 'IP范围',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_name' => 'IP范围名称',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_name+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_id' => 'CI',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_id+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_name' => 'CI名称',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_name+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role' => '角色',
	'Class:lnkFunctionalCIToIPRange/Attribute:role+' => '服务器在范围内的角色',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:single' => '独立',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:single+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:split_scope' => '分割范围',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:split_scope+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:primary' => '主要',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:primary+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:secondary' => '次要',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:secondary+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:active' => '活动',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:active+' => '',
));

//
// Class: IPv4Range
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPv4Range' => 'IPv4范围',
	'Class:IPv4Range+' => '',
	'Class:IPv4Range/ComplementaryName' => '%1$s - %2$s',
	'Class:IPv4Range/Attribute:subnet_id' => '子网',
	'Class:IPv4Range/Attribute:subnet_id+' => '',
	'Class:IPv4Range/Attribute:subnet_ip' => '子网IP',
	'Class:IPv4Range/Attribute:subnet_ip+' => '',
	'Class:IPv4Range/Attribute:firstip' => '范围的第一个IP',
	'Class:IPv4Range/Attribute:firstip+' => '',
	'Class:IPv4Range/Attribute:lastip' => '范围的最后一个IP',
	'Class:IPv4Range/Attribute:lastip+' => '',
));

//
// Class: IPAddress
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPAddress' => 'IP地址',
	'Class:IPAddress+' => '',
	'Class:IPAddress:baseinfo' => '基本信息',
	'Class:IPAddress:dnsinfo' => 'DNS信息',
	'Class:IPAddress:ipinfo' => 'IP信息',
	'Class:IPAddress:localconfigparameters' => 'IP设置',
	'Class:IPAddress/ComplementaryName' => '%1$s - %2$s',
	'Class:IPAddress/Attribute:short_name' => '简称',
	'Class:IPAddress/Attribute:short_name+' => 'FQDN的左标签',
	'Class:IPAddress/Attribute:domain_id' => 'DNS域',
	'Class:IPAddress/Attribute:domain_id+' => '',
	'Class:IPAddress/Attribute:domain_name' => '域名',
	'Class:IPAddress/Attribute:domain_name+' => 'DNS域的名称',
	'Class:IPAddress/Attribute:fqdn' => '完全限定域名',
	'Class:IPAddress/Attribute:fqdn+' => '完全限定域名',
	'Class:IPAddress/Attribute:aliases' => '别名',
	'Class:IPAddress/Attribute:aliases+' => '用于FQDN的别名列表',
	'Class:IPAddress/Attribute:usage_id' => '用途',
	'Class:IPAddress/Attribute:usage_id+' => '',
	'Class:IPAddress/Attribute:usage_name' => '用途名称',
	'Class:IPAddress/Attribute:usage_name+' => '',
	'Class:IPAddress/Attribute:ipinterface_id' => 'IP接口',
	'Class:IPAddress/Attribute:ipinterface_id+' => '',
	'Class:IPAddress/Attribute:ipinterface_name' => 'IP接口名称',
	'Class:IPAddress/Attribute:ipinterface_name+' => '',
	'Class:IPAddress/Attribute:allocation_date' => '分配日期',
	'Class:IPAddress/Attribute:allocation_date+' => '分配IP地址的日期',
	'Class:IPAddress/Attribute:release_date' => '释放日期',
	'Class:IPAddress/Attribute:release_date+' => 'IP地址释放的日期，不再使用。',
	'Class:IPAddress/Attribute:ip_list' => 'NAT IP',
	'Class:IPAddress/Attribute:ip_list+' => 'NAT IP列表',
	'Class:IPAddress/Attribute:finalclass' => '类别',
	'Class:IPAddress/Attribute:finalclass+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name' => '允许重复名称',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_no' => '否',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_yes' => '是',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPAddress/Attribute:ipconfig_:ip_allow_duplicate_name/Value:ipdup_dualstack' => '双栈',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_dualstack+' => '允许唯一的IPv4和IPv6之间的重复',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name' => '允许重复名称',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:default' => '与全局IP设置对齐',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_no' => '否',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_yes' => '是',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack' => '双栈',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack+' => '允许唯一的IPv4和IPv6之间的重复',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign' => '分配前Ping IP地址',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign+' => '',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_no' => '否',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_no+' => '',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_yes' => '是',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_yes+' => '',
	'Class:IPAddress/Attribute:ping_before_assign' => '分配前Ping IP地址',
	'Class:IPAddress/Attribute:ping_before_assign+' => '',
	'Class:IPAddress/Attribute:ping_before_assign/Value:default' => '与全局IP设置对齐',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_no' => '否',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_no+' => '',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_yes' => '是',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_yes+' => '',
));

//
// Class extensions for IPAddress
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPRange/Tab:ipregistered' => '已注册的IP',
	'Class:IPRange/Tab:ipregistered+' => '在IP范围内注册的IP',
	'Class:IPRange/Tab:ipregistered-count' => ' - %1$s 保留，%2$s 已分配，%3$s 已释放，%4$s 未分配，共 %5$s',
	'Class:IPRange/Tab:ipfree-explain' => '前 %1$s 个空闲IP地址列表：',
	'Class:IPRange/Tab:ipfree-explainbis' => '所有空闲IP地址列表：',
	'Class:IPRange/Tab:notifications' => '通知',
	'Class:IPRange/Tab:notifications+' => '与该IP范围相关的通知',
));

//
// Class: lnkFunctionalCIToIPRange
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkFunctionalCIToIPRange' => '链接功能CI/IP范围',
	'Class:lnkFunctionalCIToIPRange+' => '',
	'Class:lnkFunctionalCIToIPRange/Name' => '%1$s / %2$s',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id_finalclass_recall' => 'IP范围类型',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id_finalclass_recall+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id' => 'IP范围',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_name' => 'IP范围名称',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_name+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_id' => 'CI',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_id+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_name' => 'CI名称',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_name+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role' => '角色',
	'Class:lnkFunctionalCIToIPRange/Attribute:role+' => '服务器在范围内的角色',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:single' => '独立',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:single+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:split_scope' => '分割范围',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:split_scope+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:primary' => '主要',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:primary+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:secondary' => '次要',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:secondary+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:active' => '活动',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:active+' => '',
));

//
// Class: IPv4Range
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPv4Range' => 'IPv4范围',
	'Class:IPv4Range+' => '',
	'Class:IPv4Range/ComplementaryName' => '%1$s - %2$s',
	'Class:IPv4Range/Attribute:subnet_id' => '子网',
	'Class:IPv4Range/Attribute:subnet_id+' => '',
	'Class:IPv4Range/Attribute:subnet_ip' => '子网IP',
	'Class:IPv4Range/Attribute:subnet_ip+' => '',
	'Class:IPv4Range/Attribute:firstip' => '范围的第一个IP',
	'Class:IPv4Range/Attribute:firstip+' => '',
	'Class:IPv4Range/Attribute:lastip' => '范围的最后一个IP',
	'Class:IPv4Range/Attribute:lastip+' => '',
));

//
// Class: IPAddress
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPAddress' => 'IP地址',
	'Class:IPAddress+' => '',
	'Class:IPAddress:baseinfo' => '基本信息',
	'Class:IPAddress:dnsinfo' => 'DNS信息',
	'Class:IPAddress:ipinfo' => 'IP信息',
	'Class:IPAddress:localconfigparameters' => 'IP设置',
	'Class:IPAddress/ComplementaryName' => '%1$s - %2$s',
	'Class:IPAddress/Attribute:short_name' => '简称',
	'Class:IPAddress/Attribute:short_name+' => 'FQDN的左标签',
	'Class:IPAddress/Attribute:domain_id' => 'DNS域',
	'Class:IPAddress/Attribute:domain_id+' => '',
	'Class:IPAddress/Attribute:domain_name' => '域名',
	'Class:IPAddress/Attribute:domain_name+' => 'DNS域的名称',
	'Class:IPAddress/Attribute:fqdn' => '完全限定域名',
	'Class:IPAddress/Attribute:fqdn+' => '完全限定域名',
	'Class:IPAddress/Attribute:aliases' => '别名',
	'Class:IPAddress/Attribute:aliases+' => '用于FQDN的别名列表',
	'Class:IPAddress/Attribute:usage_id' => '用途',
	'Class:IPAddress/Attribute:usage_id+' => '',
	'Class:IPAddress/Attribute:usage_name' => '用途名称',
	'Class:IPAddress/Attribute:usage_name+' => '',
	'Class:IPAddress/Attribute:ipinterface_id' => 'IP接口',
	'Class:IPAddress/Attribute:ipinterface_id+' => '',
	'Class:IPAddress/Attribute:ipinterface_name' => 'IP接口名称',
	'Class:IPAddress/Attribute:ipinterface_name+' => '',
	'Class:IPAddress/Attribute:allocation_date' => '分配日期',
	'Class:IPAddress/Attribute:allocation_date+' => '分配IP地址的日期',
	'Class:IPAddress/Attribute:release_date' => '释放日期',
	'Class:IPAddress/Attribute:release_date+' => 'IP地址释放的日期，不再使用。',
	'Class:IPAddress/Attribute:ip_list' => 'NAT IP',
	'Class:IPAddress/Attribute:ip_list+' => 'NAT IP列表',
	'Class:IPAddress/Attribute:finalclass' => '类别',
	'Class:IPAddress/Attribute:finalclass+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name' => '允许重复名称',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_no' => '否',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_yes' => '是',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPAddress/Attribute:ipconfig_:ip_allow_duplicate_name/Value:ipdup_dualstack' => '双栈',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_dualstack+' => '允许唯一的IPv4和IPv6之间的重复',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name' => '允许重复名称',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:default' => '与全局IP设置对齐',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_no' => '否',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_yes' => '是',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack' => '双栈',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack+' => '允许唯一的IPv4和IPv6之间的重复',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign' => '分配前Ping IP地址',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign+' => '',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_no' => '否',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_no+' => '',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_yes' => '是',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_yes+' => '',
	'Class:IPAddress/Attribute:ping_before_assign' => '分配前Ping IP地址',
	'Class:IPAddress/Attribute:ping_before_assign+' => '',
	'Class:IPAddress/Attribute:ping_before_assign/Value:default' => '与全局IP设置对齐',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_no' => '否',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_no+' => '',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_yes' => '是',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_yes+' => '',
));

//
// Class: lnkIPAdressToIPAddress
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkIPAdressToIPAddress' => '链接IP / NAT IP',
	'Class:lnkIPAdressToIPAddress+' => '',
	'Class:lnkIPAdressToIPAddress/Name' => '%1$s / %2$s',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall' => 'IP类型',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id' => 'IP地址',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id+' => '待转换的IP地址',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id' => 'NAT IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id+' => '转换后的IP地址',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name' => 'IP简称',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name+' => 'FQDN的左标签',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name' => 'IP域名',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name+' => 'DNS域的名称',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name' => 'NAT IP简称',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name+' => 'FQDN的左标签',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name' => 'NAT IP域名',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name+' => 'DNS域的名称',
	'Class:lnkIPAdressToIPAddress/Attribute:external_service_port' => '外部服务端口',
	'Class:lnkIPAdressToIPAddress/Attribute:external_service_port+' => '用于端口转发的外部或源端口',
	'Class:lnkIPAdressToIPAddress/Attribute:map_to_port' => '映射到端口',
	'Class:lnkIPAdressToIPAddress/Attribute:map_to_port+' => '用于端口转发的内部或目标端口',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol' => '协议',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol+' => '授权的协议。留空表示所有协议',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:udp' => 'UDP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:tcp' => 'TCP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:both' => 'UDP / TCP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:sctp' => 'SCTP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:icmp' => 'ICMP',
));

//
// Class: lnkIPInterfaceToIPAddress
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkIPInterfaceToIPAddress' => '链接IP接口 / IP地址',
	'Class:lnkIPInterfaceToIPAddress+' => '',
	'Class:lnkIPInterfaceToIPAddress/Name' => '%1$s / %2$s',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall' => 'IP类型',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id' => 'IP接口',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name' => 'IP接口名称',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id' => 'IP地址',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:usage_id' => 'IP地址用途',
	'Class:lnkIPInterfaceToIPAddress/Attribute:usage_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_org_name' => 'IP地址组织名称',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_org_name+' => '',
));

//
// Class: IPv4Address
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPv4Address' => 'IPv4地址',
	'Class:IPv4Address+' => '',
	'Class:IPv4Address/Attribute:subnet_id' => '子网',
	'Class:IPv4Address/Attribute:subnet_id+' => 'IPv4子网',
    'Class:IPv4Address/Attribute:subnet_ip' => '子网IP',
    'Class:IPv4Address/Attribute:subnet_ip+' => '',
	'Class:IPv4Address/Attribute:range_id' => '范围',
	'Class:IPv4Address/Attribute:range_id+' => 'IPv4范围',
	'Class:IPv4Address/Attribute:ip' => '地址',
	'Class:IPv4Address/Attribute:ip+' => 'IPv4地址',
));

//
// Class: IPRangeUsage
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPRangeUsage' => 'IP范围使用情况',
	'Class:IPRangeUsage+' => 'IP地址范围的用途',
	'Class:IPRangeUsage/Attribute:org_id' => '组织',
	'Class:IPRangeUsage/Attribute:org_id+' => '',
	'Class:IPRangeUsage/Attribute:org_name' => '组织名称',
	'Class:IPRangeUsage/Attribute:org_name+' => '',
	'Class:IPRangeUsage/Attribute:name' => '名称',
	'Class:IPRangeUsage/Attribute:name+' => '',
	'Class:IPRangeUsage/Attribute:description' => '描述',
	'Class:IPRangeUsage/Attribute:description+' => '',
	'Class:IPRangeUsage/Attribute:ipranges_list' => 'IP范围',
	'Class:IPRangeUsage/Attribute:ipranges_list+' => '与该用途相关的IP范围',
));

//
// Class: IPBlockType
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPBlockType' => 'IP块类型',
	'Class:IPBlockType+' => '块的类型',
	'Class:IPBlockType/Attribute:name' => '名称',
	'Class:IPBlockType/Attribute:name+' => '',
	'Class:IPBlockType/Attribute:description' => '描述',
	'Class:IPBlockType/Attribute:description+' => '',
	'Class:IPBlockType/Attribute:blocks_list' => '块',
	'Class:IPBlockType/Attribute:blocks_list+' => '该类型的子网块',
));

//
// Class: IPTriggerOnWaterMark
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPTriggerOnWaterMark' => '触发器（当达到与IP相关的水印时）',
	'Class:IPTriggerOnWaterMark+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_id' => '组织',
	'Class:IPTriggerOnWaterMark/Attribute:org_id+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_name' => '组织名称',
	'Class:IPTriggerOnWaterMark/Attribute:org_name+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:target_class' => '目标类',
	'Class:IPTriggerOnWaterMark/Attribute:target_class+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event' => '事件',
	'Class:IPTriggerOnWaterMark/Attribute:event+' => '当触发器被激活时生成的事件',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low' => '低水印被越过',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high' => '高水印被越过',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high+' => '',
));

//
// Class: IPObjTemplate
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPObjTemplate' => 'IP模板',
	'Class:IPObjTemplate+' => '',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id' => '子服务类别',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id+' => '',
	'Class:IPObjTemplate/Attribute:request_type' => '请求类型',
	'Class:IPObjTemplate/Attribute:request_type+' => '',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_create' => '创建IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_change' => '更改IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_delete' => '删除IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_create' => '创建子网',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_change' => '更改子网',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_delete' => '删除子网',
));

//
// Application Menu
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Menu:IPManagement' => 'IP管理',
	'Menu:IPManagement+' => 'IP管理',
	'Menu:IPManagement:Overview:Total' => '总计：%1s',
	'Menu:IPSpace' => 'IP空间',
	'Menu:IPSpace+' => 'IP空间',
	'Menu:IPSpace:IPv4Objects' => 'IPv4对象',
	'Menu:IPSpace:IPv4Objects+' => 'IPv4对象',
	'Menu:IPSpace:Options' => '参数',
	'Menu:IPSpace:Options+' => '参数',
	'Menu:NewIPObject' => '新建IP对象',
	'Menu:NewIPObject+' => '创建新的IP对象',
	'Menu:SearchIPObject' => '搜索IP对象',
	'Menu:SearchIPObject+' => '搜索IP对象',
	'Menu:IPv4ShortCut' => 'IPv4快捷方式',
	'Menu:IPv4ShortCut+' => '将IPv4对象分组的快捷方式',
	'Menu:IPv4Block' => '子网块',
	'Menu:IPv4Block+' => 'IPv4子网块',
	'Menu:IPv4Subnet' => '子网',
	'Menu:IPv4Subnet+' => 'IPv4子网',
	'Menu:IPv4Subnet:Allocated' => '已分配的子网',
	'Menu:IPv4Subnet:Allocated+' => '已分配的IPv4子网列表',
	'Menu:IPv4Range' => 'IP范围',
	'Menu:IPv4Range+' => 'IPv4范围',
	'Menu:IPv4Address' => 'IP地址',
	'Menu:IPv4Address+' => 'IPv4地址',
	'Menu:IPTools' => '工具',
	'Menu:IPTools+' => 'IP工具集',
	'Menu:FindSpace' => '查找空间',
	'Menu:FindSpace+' => '查找并分配IP空间的工具',
	'Menu:SubnetCalculator' => '子网计算器',
	'Menu:SubnetCalculator+' => '根据IP和掩码计算子网参数的工具',
	'Menu:Options' => '参数',
	'Menu:Options+' => '参数',
	'Menu:Domain' => '域',
	'Menu:Domain+' => '域名',
	'Menu:IPTemplate' => 'IP模板',
	'Menu:IPTemplate+' => 'IP模板',
	'Menu:IPMgmt:Typology' => 'IP空间拓扑配置',
	'Menu:IPMgmt:Typology+' => '',

	'UI:IPMgmtWelcomeOverview:Title' => '我的仪表板',

	// Action菜单中的分隔符
	'UI:IPManagement:Action:MenuSeparator' => '<hr class="menu-separator"/>',
	'UI:IPManagement:Action:Error::WrongActionForClass' => '无法在该类对象上应用此操作！',

//
// IP块的管理
//
	// 创建管理
	'UI:IPManagement:Action:New:IPBlock:Reverted' => '子网块的第一个IP大于最后一个IP！',
	'UI:IPManagement:Action:New:IPBlock:SmallerThanMinSize' => '对于组织%2$s，块大小不能小于%1$s！',
	'UI:IPManagement:Action:New:IPBlock:NotCIDRAligned' => '块未按CIDR对齐！',
	'UI:IPManagement:Action:New:IPBlock:NotInParent' => '子网块未严格包含在选定的父块内！',
	'UI:IPManagement:Action:New:IPBlock:NameExist' => '子网块的名称已存在！',
	'UI:IPManagement:Action:New:IPBlock:Collision0' => '子网块已存在！',
	'UI:IPManagement:Action:New:IPBlock:Collision1' => '子网块冲突：第一个IP属于现有块！',
	'UI:IPManagement:Action:New:IPBlock:Collision2' => '子网块冲突：最后一个IP属于现有块！',
	'UI:IPManagement:Action:Modify:IPBlock:ParentIdNull' => '块%1$s的子子网不能附加到不存在的父块。',

	// 缩小子网块的操作
	'UI:IPManagement:Action:Shrink:IPBlock:Reverted' => '子网块的新第一个IP大于新最后一个IP！',
	'UI:IPManagement:Action:Shrink:IPBlock:IPOutOfBlock' => '新IP并非全部在块内！',
	'UI:IPManagement:Action:Shrink:IPBlock:NoChange' => '不需要进行任何更改。',
	'UI:IPManagement:Action:Shrink:IPBlock:NotCIDRAligned' => '块未按CIDR对齐！',
	'UI:IPManagement:Action:Shrink:IPBlock:BlockAccrossBorder' => '子网块跨越新的边界！',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetAccrossBorder' => '附加到块的子网跨越新的边界！',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetBecomesOrhpean' => '缩小后，子子网将没有父块！',
	'UI:IPManagement:Action:Shrink:IPBlock:Done' => '%1$s %2$s 已被缩小。',

	// 在子网块上拆分的操作
	'UI:IPManagement:Action:Split:IPBlock:IPOutOfBlock' => '拆分的IP不在块内！',
	'UI:IPManagement:Action:Split:IPBlock:SmallerThanMinSize' => '块大小不能小于%1$s！',
	'UI:IPManagement:Action:Split:IPBlock:NotCIDRAligned' => '块未按CIDR对齐！',
	'UI:IPManagement:Action:Split:IPBlock:BlockAccrossBorder' => '子网块跨越新的边界！',
	'UI:IPManagement:Action:Split:IPBlock:SubnetAccrossBorder' => '附加到块的子网跨越新的边界！',
	'UI:IPManagement:Action:Split:IPBlock:EmptyNewName' => '新子网块的名称为空！',
	'UI:IPManagement:Action:Split:IPBlock:NameExist' => '新子网块的名称已存在！',
	'UI:IPManagement:Action:Split:IPBlock:Done' => '%1$s %2$s 已被拆分。',

	// 扩展子网块的操作
	'UI:IPManagement:Action:Expand:IPBlock:Reverted' => '子网块的新第一个IP大于新最后一个IP！',
	'UI:IPManagement:Action:Expand:IPBlock:IPOutOfBlock' => '新IP并非全部在块外！',
	'UI:IPManagement:Action:Expand:IPBlock:NoChange' => '不需要进行任何更改。',
	'UI:IPManagement:Action:Expand:IPBlock:NotCIDRAligned' => '块未按CIDR对齐！',
	'UI:IPManagement:Action:Expand:IPBlock:BlockBiggerThanParent' => '块不能比其父块更大！',
	'UI:IPManagement:Action:Expand:IPBlock:DelegatedBlockAccrossBorder' => '块不能接管委派的块！',
	'UI:IPManagement:Action:Expand:IPBlock:BlockAccrossBorder' => '兄弟子网块跨越新的边界！',
	'UI:IPManagement:Action:Expand:IPBlock:SubnetAccrossBorder' => '附加到父块的子网跨越新的边界',
	'UI:IPManagement:Action:Expand:IPBlock:Done' => '%1$s %2$s 已被扩展。',

	// 查找子网块上的空间操作
'UI:IPManagement:Action:DoFindSpace:IPBlock:RequestedSpaceBiggerThanBlockSize' => '要查找空间的IP地址属于子网块 %1$s，请求的空间大于该块的大小！',
'UI:IPManagement:Action:DoFindSpace:IPBlock:NoSpaceFound' => '块 %1$s 中没有足够的空闲空间来满足您的请求！',
'IPManagement:Action:DoFindSpace:IPBlock:IPToStartFrom' => '从IP %1$s 开始',

// 在子网块上委派操作
'UI:IPManagement:Action:Delegate:IPBlock:NoChildOrg' => '块的组织没有子组织！',
'UI:IPManagement:Action:Delegate:IPBlock:NoOtherOrg' => '除块的组织外，没有其他组织！',
'UI:IPManagement:Action:Delegate:IPBlock:IsDelegated' => '该块已经被委派！',
'UI:IPManagement:Action:Delegate:IPBlock:WrongLevelOfOrganization' => '委派变更必须在同级组织中完成！',
'UI:IPManagement:Action:Delegate:IPBlock:NoChangeOfOrganization' => '没有要求进行的更改！',
'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocks' => '块有子块！',
'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnets' => '块有子网！',
'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithDelegatedBlockFromOtherOrg' => '该范围已经有一些从其他组织委派来的块！',
'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfTargetOrg' => '块与目标组织的块冲突！',
'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfParentOrg' => '块与父组织的块冲突！',
'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocksInParent' => '块在父组织中有子块！',
'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnetsInParent' => '块在父组织中有子网！',

// 在子网块上取消委派操作
'UI:IPManagement:Action:Undelegate:IPBlock:CannotBeUndelegated' => '块无法取消委派：%1$s',
'UI:IPManagement:Action:Undelegate:IPBlock:IsNotDelegated' => '块未被委派！',
'UI:IPManagement:Action:Undelegate:IPBlock:HasChildBlocks' => '块有子块！',
'UI:IPManagement:Action:Undelegate:IPBlock:HasChildSubnets' => '块有子网！',

'UI:IPManagement:Action:DisplayPrevious:IPBlock' => '上一个',
'UI:IPManagement:Action:DisplayNext:IPBlock' => '下一个',

//
// IPv4块的管理
//
// 显示子网块的详细信息
'UI:IPManagement:Action:Details:IPv4Block' => '详细信息',
'UI:IPManagement:Action:Details:IPv4Block+' => '',

// 显示子网块的列表
'UI:IPManagement:Action:DisplayList:IPv4Block' => '显示列表',
'UI:IPManagement:Action:DisplayList:IPv4Block+' => '',
'UI:IPManagement:Action:DisplayList:IPv4Block:PageTitle_Class' => 'IPv4子网块',
'UI:IPManagement:Action:DisplayList:IPv4Block:Title_Class' => 'IPv4子网块',

// 显示子网块的树形结构
'UI:IPManagement:Action:DisplayTree:IPv4Block' => '显示树形结构',
'UI:IPManagement:Action:DisplayTree:IPv4Block+' => '',
'UI:IPManagement:Action:DisplayTree:IPv4Block:PageTitle_Class' => 'IPv4子网块',
'UI:IPManagement:Action:DisplayTree:IPv4Block:Title_Class' => 'IPv4子网块',
'UI:IPManagement:Action:DisplayTree:IPv4Block:OrgName' => '组织 %1$s',

// 收缩子网块的操作
'UI:IPManagement:Action:Shrink:IPv4Block' => '收缩',
'UI:IPManagement:Action:Shrink:IPv4Block+' => '',
'UI:IPManagement:Action:Shrink:IPv4Block:Summary' => '摘要',
'UI:IPManagement:Action:Shrink:IPv4Block:Summary+' => '',
'UI:IPManagement:Action:Shrink:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s 收缩',
'UI:IPManagement:Action:Shrink:IPv4Block:Title_Class_Object' => '收缩 %1$s：%2$s',
'UI:IPManagement:Action:Shrink:IPv4Block:NewFirstIP' => '块的新起始IP：',
'UI:IPManagement:Action:Shrink:IPv4Block:NewLastIP' => '块的新结束IP：',
'UI:IPManagement:Action:Shrink:IPv4Block:IsDelegated' => '该块已被委派，因此无法收缩！',
'UI:IPManagement:Action:Shrink:IPv4Block:CannotBeShrunk' => '块无法收缩：%1$s',
'UI:IPManagement:Action:Shrink:IPv4Block:SmallerThanMinSize' => '块的大小不能小于 %1$s！',
'UI:IPManagement:Action:Shrink:IPv4Block:Done' => '%1$s %2$s 已被收缩。',


// 分割子网块的操作
'UI:IPManagement:Action:Split:IPv4Block' => '分割',
'UI:IPManagement:Action:Split:IPv4Block+' => '',
'UI:IPManagement:Action:Split:IPv4Block:Summary' => '摘要',
'UI:IPManagement:Action:Split:IPv4Block:Summary+' => '',
'UI:IPManagement:Action:Split:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s 分割',
'UI:IPManagement:Action:Split:IPv4Block:Title_Class_Object' => '分割 %1$s：%2$s',
'UI:IPManagement:Action:Split:IPv4Block:At' => '新子网块的起始IP：',
'UI:IPManagement:Action:Split:IPv4Block:NameNewBlock' => '新子网块的名称：',
'UI:IPManagement:Action:Split:IPv4Block:IsDelegated' => '该块已被委派，因此无法分割！',
'UI:IPManagement:Action:Split:IPv4Block:CannotBeSplit' => '块无法分割：%1$s',
'UI:IPManagement:Action:Split:IPv4Block:SmallerThanMinSize' => '块的大小不能小于 %1$s！',
'UI:IPManagement:Action:Split:IPv4Block:Done' => '%1$s %2$s 已被分割。',

// 扩展子网块的操作
'UI:IPManagement:Action:Expand:IPv4Block' => '扩展',
'UI:IPManagement:Action:Expand:IPv4Block+' => '',
'UI:IPManagement:Action:Expand:IPv4Block:Summary' => '摘要',
'UI:IPManagement:Action:Expand:IPv4Block:Summary+' => '',
'UI:IPManagement:Action:Expand:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s 扩展',
'UI:IPManagement:Action:Expand:IPv4Block:Title_Class_Object' => '扩展 %1$s：%2$s',
'UI:IPManagement:Action:Expand:IPv4Block:NewFirstIP' => '块的新起始IP：',
'UI:IPManagement:Action:Expand:IPv4Block:NewLastIP' => '块的新结束IP：',
'UI:IPManagement:Action:Expand:IPv4Block:IsDelegated' => '该块已被委派，因此无法扩展！',
'UI:IPManagement:Action:Expand:IPv4Block:CannotBeExpanded' => '块无法扩展：%1$s',
'UI:IPManagement:Action:Expand:IPv4Block:SmallerThanMinSize' => '块的大小不能小于 %1$s！',
'UI:IPManagement:Action:Expand:IPv4Block:Done' => '%1$s %2$s 已被扩展。',

// 列出子网块上的空间操作
'UI:IPManagement:Action:ListSpace:IPv4Block' => '列出空间',
'UI:IPManagement:Action:ListSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - 空间',
'UI:IPManagement:Action:ListSpace:IPv4Block:Title_Class_Object' => '%1$s 中的空间：%2$s',
'UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpace' => '空闲 [%1$s - %2$s] - %3$s个IP - %4$.2f%%',
'UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpaceNoPercent' => '空闲 [%1$s - %2$s] - %3$s个IP',

// 查找子网块上的空间操作
'UI:IPManagement:Action:FindSpace:IPv4Block' => '查找空间',
'UI:IPManagement:Action:FindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - 查找空间',
'UI:IPManagement:Action:FindSpace:IPv4Block:Title_Class_Object' => '在 %1$s 中查找空间：%2$s',
'UI:IPManagement:Action:FindSpace:IPv4Block:SizeOfSpace' => '要查找的空间大小：',
'UI:IPManagement:Action:FindSpace:IPv4Block:MaxNumberOfOffers' => '提供的最大数量：',

// 执行查找子网块上的空间操作
'UI:IPManagement:Action:DoFindSpace:IPv4Block' => '找到空间',
'UI:IPManagement:Action:DoFindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - 查找空间',
'UI:IPManagement:Action:DoFindSpace:IPv4Block:Title_Class_Object' => '在 %1$s 中找到的空间：%2$s',
'UI:IPManagement:Action:DoFindSpace:IPv4Block:Summary' => '%1$s 起始 /%2$s 在 ',
'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsBlock' => '创建为子块',
'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsSubnet' => '创建为子网',

// 在子网块上委派操作
'UI:IPManagement:Action:Delegate:IPv4Block' => '委派',
'UI:IPManagement:Action:Delegate:IPv4Block:PageTitle_Object_Class' => '%1$s - 委派',
'UI:IPManagement:Action:Delegate:IPv4Block:Title_Class_Object' => '将 %1$s %2$s 委派给组织',
'UI:IPManagement:Action:Delegate:IPv4Block:ChildBlock' => '要将块委派给的组织：',
'UI:IPManagement:Action:Delegate:IPv4Block:NoChildOrg' => '块的组织没有子组织，因此无法委派块！',
'UI:IPManagement:Action:Delegate:IPv4Block:NoOtherOrg' => '除块的组织外，没有其他组织！',
'UI:IPManagement:Action:Delegate:IPv4Block:IsDelegated' => '该块已经被委派！',
'UI:IPManagement:Action:Delegate:IPv4Block:CannotBeDelegated' => '块无法被委派：%1$s',
'UI:IPManagement:Action:Delegate:IPv4Block:Done' => '%1$s %2$s 已被委派。',

// 在子网块上取消委派操作
'UI:IPManagement:Action:Undelegate:IPv4Block:CannotBeUndelegated' => '块无法取消委派：%1$s',
'UI:IPManagement:Action:Undelegate:IPv4Block' => '取消委派',
'UI:IPManagement:Action:Undelegate:IPv4Block:PageTitle_Object_Class' => '%1$s - 取消委派',
'UI:IPManagement:Action:Undelegate:IPv4Block:Done' => '%1$s %2$s 已取消委派。',


// IPv4子网管理
//
// 显示子网详细信息
'UI:IPManagement:Action:Details:IPv4Subnet' => '详细信息',
'UI:IPManagement:Action:Details:IPv4Subnet+' => '',

// 显示子网列表
'UI:IPManagement:Action:DisplayList:IPv4Subnet' => '显示列表',
'UI:IPManagement:Action:DisplayList:IPv4Subnet+' => '',
'UI:IPManagement:Action:DisplayList:IPv4Subnet:PageTitle_Class' => 'IPv4子网',
'UI:IPManagement:Action:DisplayList:IPv4Subnet:Title_Class' => 'IPv4子网',

// 显示子网树
'UI:IPManagement:Action:DisplayTree:IPv4Subnet' => '显示树',
'UI:IPManagement:Action:DisplayTree:IPv4Subnet+' => '',
'UI:IPManagement:Action:DisplayTree:IPv4Subnet:PageTitle_Class' => 'IPv4子网',
'UI:IPManagement:Action:DisplayTree:IPv4Subnet:Title_Class' => 'IPv4子网',
'UI:IPManagement:Action:DisplayTree:IPv4Subnet:OrgName' => '组织 %1$s',

// 在子网上查找空间操作
'UI:IPManagement:Action:FindSpace:IPv4Subnet' => '查找空间',
'UI:IPManagement:Action:FindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - 查找空间',
'UI:IPManagement:Action:FindSpace:IPv4Subnet:Title_Class_Object' => '在%1$s内查找IP空间：%2$s',
'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeTooSmall' => '子网太小，无法查找空间。请取消！',
'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeOfRange' => '查找空间的大小：',
'UI:IPManagement:Action:FindSpace:IPv4Subnet:MaxNumberOfOffers' => '最大提供数量：',

// 在子网上执行查找空间操作
'UI:IPManagement:Action:DoFindSpace:IPv4Subnet' => '找到空间',
'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - 查找空间',
'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Title_Class_Object' => '%1$s内的空间：%2$s',
'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Summary' => '在子网内找到首个%1$s的空闲%2$s范围',
'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeEmpty' => '请求的空间为空！请尝试更大的值。',
'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeTooBig' => '请求的空间不适应子网！请尝试较低的值。',
'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:CreateAsRange' => '创建为IP范围',

// 在子网上列出IP地址操作
'UI:IPManagement:Action:ListIps:IPv4Subnet' => '列出并选择IP地址',
'UI:IPManagement:Action:ListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IP地址',
'UI:IPManagement:Action:ListIps:IPv4Subnet:Title_Class_Object' => '%1$s内的IP地址列表：%2$s',
'UI:IPManagement:Action:ListIps:IPv4Subnet:Subtitle_ListRange' => '子网太大，无法直接列出所有IP地址。请选择要显示的范围：',
'UI:IPManagement:Action:ListIps:IPv4Subnet:FirstIP' => '列表中的第一个IP地址',
'UI:IPManagement:Action:ListIps:IPv4Subnet:LastIP' => '列表中的最后一个IP地址',

// 在子网上执行列出IP地址操作
'UI:IPManagement:Action:DoListIps:IPv4Subnet' => '列出并选择IP地址',
'UI:IPManagement:Action:DoListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IP地址',
'UI:IPManagement:Action:DoListIps:IPv4Subnet:Title_Class_Object' => '%1$s内的部分IP地址列表：%2$s',
'UI:IPManagement:Action:DoListIps:IPv4Subnet:CannotBeListed' => '无法列出IP地址：%1$s',
'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIPOutOfSubnet' => '第一个IP地址超出子网范围！',
'UI:IPManagement:Action:DoListIps:IPv4Subnet:LastIPOutOfSubnet' => '最后一个IP地址超出子网范围！',
'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIpBiggerThanLastIp' => '范围的第一个IP地址高于最后一个IP地址！',

// 在子网上收缩操作
'UI:IPManagement:Action:Shrink:IPv4Subnet' => '收缩',
'UI:IPManagement:Action:Shrink:IPv4Subnet+' => '',
'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary' => '总结',
'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary+' => '',
'UI:IPManagement:Action:Shrink:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s收缩',
'UI:IPManagement:Action:Shrink:IPv4Subnet:Title_Class_Object' => '收缩%1$s：%2$s',
'UI:IPManagement:Action:Shrink:IPv4Subnet:CannotBeShrunk' => '子网无法收缩：%1$s',
'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmall' => '子网太小，无法收缩！',
'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy' => '子网太小，无法收缩%1$s！',
'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeInTheMiddle' => '范围：<b>%1$s [%2$s - %3$s]</b>位于新子网边界之间。无法执行收缩！',
'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeDropped' => '范围：<b>%1$s [%2$s - %3$s]</b>将从子网中删除。无法执行收缩！',
'UI:IPManagement:Action:Shrink:IPv4Subnet:Done' => '%1$s %2$s已经被%3$s收缩。',
'UI:IPManagement:Action:Shrink:IPv4Subnet:By' => '收缩：%1$s',

// 在子网上执行分割操作
'UI:IPManagement:Action:Split:IPv4Subnet' => '分割',
'UI:IPManagement:Action:Split:IPv4Subnet+' => '',
'UI:IPManagement:Action:Split:IPv4Subnet:Summary' => '总结',
'UI:IPManagement:Action:Split:IPv4Subnet:Summary+' => '',
'UI:IPManagement:Action:Split:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s分割',
'UI:IPManagement:Action:Split:IPv4Subnet:Title_Class_Object' => '分割%1$s：%2$s',
'UI:IPManagement:Action:Split:IPv4Subnet:CannotBeSplit' => '子网无法分割：%1$s',
'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmall' => '子网太小，无法分割！',
'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy' => '子网太小，无法分割%1$s！',
'UI:IPManagement:Action:Split:IPv4Subnet:IPRangeInTheMiddle' => '范围：<b>%1$s [%2$s - %3$s]</b>位于新子网边界之间。无法执行分割！',
'UI:IPManagement:Action:Split:IPv4Subnet:Done' => '%1$s %2$s已经被分割为%3$s。',
'UI:IPManagement:Action:Split:IPv4Subnet:In' => '分割为：%1$s',

// 在子网上执行扩展操作
'UI:IPManagement:Action:Expand:IPv4Subnet' => '扩展',
'UI:IPManagement:Action:Expand:IPv4Subnet+' => '',
'UI:IPManagement:Action:Expand:IPv4Subnet:Summary' => '总结',
'UI:IPManagement:Action:Expand:IPv4Subnet:Summary+' => '',
'UI:IPManagement:Action:Expand:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s扩展',
'UI:IPManagement:Action:Expand:IPv4Subnet:Title_Class_Object' => '扩展%1$s：%2$s',
'UI:IPManagement:Action:Expand:IPv4Subnet:CannotBeExpanded' => '子网无法扩展：%1$s',
'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBig' => '子网太大，无法扩展！',
'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy' => '子网太大，无法扩展%1$s！',
'UI:IPManagement:Action:Expand:IPv4Subnet:NotInIPBlock' => '承载子网的块太小，无法包含新的扩展子网！',
'UI:IPManagement:Action:Expand:IPv4Subnet:Done' => '%1$s %2$s已经被%3$s扩展',
'UI:IPManagement:Action:Expand:IPv4Subnet:By' => '扩展：%1$s',

// 在子网上执行CSV导出IP地址操作
'UI:IPManagement:Action:CsvExportIps:IPv4Subnet' => 'CSV导出IP地址',
'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV导出IP地址',
'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Title_Class_Object' => '%1$s的CSV导出IP地址：%2$s',
'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Subtitle_ListRange' => '子网太大，无法导出所有IP地址。请选择要显示的范围：',
'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:FirstIP' => '列表中的第一个IP地址',
'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:LastIP' => '列表中的最后一个IP地址',

// 在子网上执行CSV导出IP地址操作
'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet' => 'CSV导出IP地址',
'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV导出IP地址',
'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:Title_Class_Object' => '%1$s内的部分CSV导出IP地址：%2$s',
'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:CannotBeListed' => '无法列出IP地址：%1$s',
'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIPOutOfSubnet' => '第一个IP地址超出子网范围！',
'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:LastIPOutOfSubnet' => '最后一个IP地址超出子网范围！',
'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIpBiggerThanLastIp' => '范围的第一个IP地址高于最后一个IP地址！',

// 子网计算器
'UI:IPManagement:Action:Calculator:IPv4Subnet' => '子网计算器',
'UI:IPManagement:Action:Calculator:IPv4Subnet:PageTitle_Object_Class' => '%2$s 计算器',
'UI:IPManagement:Action:Calculator:IPv4Subnet:Title_Class_Object' => '%1$s 的计算器',
'UI:IPManagement:Action:Calculator:IPv4Subnet:IP' => 'IP地址',
'UI:IPManagement:Action:Calculator:IPv4Subnet:Mask' => '掩码',
'UI:IPManagement:Action:Calculator:IPv4Subnet:CIDR' => 'CIDR',

// 在子网上执行子网计算器操作
'UI:IPManagement:Action:DoCalculator:IPv4Subnet' => '子网计算器',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PageTitle_Object_Class' => '%2$s 计算器',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Title_Class_Object' => '%1$s - 计算器输出',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IP' => 'IP地址',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Mask' => '掩码',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CIDR' => 'CIDR',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:SubnetIP' => '子网IP',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Wildcard' => '通配符掩码',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:BroadcastIP' => '广播IP',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IPNumber' => 'IP地址数量',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:UsableHosts' => '可用主机数量',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet' => '前一个子网IP',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet:NA' => '不适用',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet' => '下一个子网IP',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet:NA' => '不适用',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CannotRun' => '子网计算器无法运行：%1$s',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:EnterMaskOrCIDR' => '输入掩码或CIDR！',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongMask' => '掩码无效！',
'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongCIDR' => 'CIDR无效！',

// 将FQDN分解为填充shortname和domain_id属性
'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:CannotBeExploded' => '无法将FQDN分解为short和domain名称',
'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:PageTitle_Object_Class' => '分解FQDN',
'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:Done' => 'FQDN已分解为%1$s %2$s',

//
// IP范围的管理
//
// 创建和更新管理
'UI:IPManagement:Action:New:IPRange:NameExist' => '范围名称已在子网中存在！',
'UI:IPManagement:Action:New:IPRange:Reverted' => '范围的第一个IP高于最后一个IP！',
'UI:IPManagement:Action:New:IPRange:NotInSubnet' => 'IP范围不包含在所选子网中！',
'UI:IPManagement:Action:New:IPRange:Collision0' => 'IP范围已存在！',
'UI:IPManagement:Action:New:IPRange:Collision1' => '范围冲突：第一个IP属于现有范围！',
'UI:IPManagement:Action:New:IPRange:Collision2' => '范围冲突：最后一个IP属于现有范围！',
'UI:IPManagement:Action:New:IPRange:Collision3' => '范围冲突：新范围包含现有范围！',
'UI:IPManagement:Action:Update:IPRange:NonDHCPRangeWithServers' => '只有DHCP范围可以链接到DHCP服务器！',
'UI:IPManagement:Action:New:lnkFunctionalCIToIPRange:WrongCIClass' => 'DHCP服务器只能是Server或Virtual Machine类！',

'UI:IPManagement:Action:DisplayPrevious:IPRange' => '上一个',
'UI:IPManagement:Action:DisplayNext:IPRange' => '下一个',

//
// IPv4范围的管理
//

// 显示IPv4范围的详细信息
'UI:IPManagement:Action:Details:IPv4Range' => '详细信息',
'UI:IPManagement:Action:Details:IPv4Range+' => '',

// IP范围上的列出IP操作
'UI:IPManagement:Action:ListIps:IPv4Range' => '列出并选择IP',
'UI:IPManagement:Action:ListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IPs',
'UI:IPManagement:Action:ListIps:IPv4Range:Title_Class_Object' => '在%1$s范围内的IP列表：%2$s',
'UI:IPManagement:Action:ListIps:IPv4Range:Subtitle_ListRange' => '范围太大，无法以原始形式列出所有IP。请选择子范围以显示：',
'UI:IPManagement:Action:ListIps:IPv4Range:FirstIP' => '列表的第一个IP',
'UI:IPManagement:Action:ListIps:IPv4Range:LastIP' => '列表的最后一个IP',

// 在IP范围上执行列出IP操作
'UI:IPManagement:Action:DoListIps:IPv4Range' => '列出并选择IP',
'UI:IPManagement:Action:DoListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IPs',
'UI:IPManagement:Action:DoListIps:IPv4Range:Title_Class_Object' => '%1$s范围内的部分IP列表：%2$s',
'UI:IPManagement:Action:DoListIps:IPv4Range:CannotBeListed' => '无法列出范围：%1$s',
'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIPOutOfRange' => '第一个IP超出范围！',
'UI:IPManagement:Action:DoListIps:IPv4Range:LastIPOutOfRange' => '最后一个IP超出范围！',
'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIpBiggerThanLastIp' => '范围的第一个IP高于最后一个IP！',

// IP范围上的CSV导出操作
'UI:IPManagement:Action:CsvExportIps:IPv4Range' => 'IP的CSV导出',
'UI:IPManagement:Action:CsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s IP的CSV导出',
'UI:IPManagement:Action:CsvExportIps:IPv4Range:Title_Class_Object' => '%1$s IP的CSV导出：%2$s',
'UI:IPManagement:Action:CsvExportIps:IPv4Range:Subtitle_ListRange' => '范围太大，无法一次导出所有IP。请选择子范围以导出：',
'UI:IPManagement:Action:CsvExportIps:IPv4Range:FirstIP' => '列表的第一个IP',
'UI:IPManagement:Action:CsvExportIps:IPv4Range:LastIP' => '列表的最后一个IP',

// 在IP范围上执行CSV导出IP操作
'UI:IPManagement:Action:DoCsvExportIps:IPv4Range' => 'CSV导出IP',
'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s IP的CSV导出',
'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:Title_Class_Object' => '%1$s范围内的部分CSV导出IP：%2$s',
'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:CannotBeListed' => '无法导出范围：%1$s',
'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIPOutOfRange' => '第一个IP超出范围！',
'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:LastIPOutOfRange' => '最后一个IP超出范围！',
'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIpBiggerThanLastIp' => '范围的第一个IP高于最后一个IP！',

// 将FQDN分解为填充shortname和domain_id属性
'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:CannotBeExploded' => '无法将FQDN分解为short和domain名称',
'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:PageTitle_Object_Class' => '分解FQDN',
'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:Done' => 'FQDN已分解为%1$s %2$s',

//
// IP地址的管理
//
// 创建管理
'UI:IPManagement:Action:New:IPAddress:IPNameCollision' => '短名称已在域中存在！',

'UI:IPManagement:Action:New:IPAddress:IPCollision' => 'IP已存在！',
'UI:IPManagement:Action:New:IPAddress:NotInRange' => 'IP不属于IP范围！',
'UI:IPManagement:Action:New:IPAddress:NotInSubnet' => 'IP不属于子网！',
'UI:IPManagement:Action:New:IPAddress:IPPings' => 'IP已PING！',
'UI:IPManagement:Action:New:IPAddress:NatIPsAretheSame' => 'IP不能NAT到自身！',

// 分配到CI / 从CI取消分配
'UI:IPManagement:Action:AllocateIP:IPAddress' => '将地址分配给CI',
'UI:IPManagement:Action:UnAllocateIP:IPAddress' => '从所有CI中取消分配地址',
'UI:IPManagement:Action:Allocate:IPAddress:Class' => '目标类',
'UI:IPManagement:Action:Allocate:IPAddress:CI' => '功能CI',
'UI:IPManagement:Action:Allocate:IPAddress:IPAttribute' => 'IP属性',
'UI:IPManagement:Action:Allocate:IPAddress:NoCI' => '在此组织中没有使用IP地址属性的实例化CI！',
'UI:IPManagement:Action:Allocate:IPAddress:CannotAllocateCI' => '无法将CI分配给IP：%1$s',
'UI:IPManagement:Action:Allocate:IPAddress:CIDoesNotExist' => '功能CI不存在！',
'UI:IPManagement:Action:Allocate:IPAddress:AttributeIsReadOnly' => 'CI的属性是只读的！',
'UI:IPManagement:Action:Allocate:IPAddress:AttributeIsSynchronized' => 'CI的属性是同步的从属！',
'UI:IPManagement:Action:Allocate:IPAddress:FQDNIsConflicting' => '新的FQDN将与配置中定义的重复规则冲突',
'UI:IPManagement:Action:Allocate:IPAddress:IPAlreadyAllocated' => '地址已分配！',
'UI:IPManagement:Action:Unallocate:IPAddress:CannotBeUnallocated' => '地址无法取消分配：%1$s',
'UI:IPManagement:Action:UnAllocate:IPAddress:IPNotAllocated' => 'IP未分配！',
'UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsReadOnly' => 'IP附加到CI的属性是只读的！',
'UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsSynchronized' => 'IP附加到CI的属性是同步的从属！',

// 列出IP
'UI:IPManagement:Action:ListIPs:IPAddress:Ping' => 'PING',
'UI:IPManagement:Action:ListIPs:IPAddress:Scan' => '扫描',
'UI:IPManagement:Action:ListIPs:IPAddress:Nslookup' => 'NSLOOKUP',

// 将FQDN分解为填充shortname和domain_id属性
'UI:IPManagement:Action:ExplodeFQDN:IPAddress:FQDNAttributeDoesNotExist' => '属性%1$s不是IP地址的属性！',

// 显示指向前一个和后一个IP的指针
'UI:IPManagement:Action:DisplayPrevious:IPAddress' => '上一个',
'UI:IPManagement:Action:DisplayNext:IPAddress' => '下一个',

//
// IPv4地址的管理
//
// 分配到CI / 从CI取消分配
'UI:IPManagement:Action:Allocate:IPv4Address' => '将地址分配给CI',
'UI:IPManagement:Action:Allocate:IPv4Address:PageTitle_Object_Class' => '分配IP',
'UI:IPManagement:Action:Allocate:IPv4Address:Title_Class_Object' => '将%1$s %2$s分配给CI',
'UI:IPManagement:Action:Allocate:IPv4Address:Done' => '%1$s %2$s已分配。',
'UI:IPManagement:Action:Allocate:IPv4Address:IPAlreadyAllocated' => '地址已分配！',
'UI:IPManagement:Action:UnAllocate:IPv4Address' => '从所有CI中取消分配地址',
'UI:IPManagement:Action:Unallocate:IPv4Address:PageTitle_Object_Class' => '取消分配IP',
'UI:IPManagement:Action:Unallocate:IPv4Address:Done' => '%1$s %2$s已取消分配。',
'UI:IPManagement:Action:UnAllocate:IPv4Address:IPNotAllocated' => '地址未分配！',

// 将FQDN分解为填充shortname和domain_id属性
'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:CannotBeExploded' => '无法将FQDN分解为short和domain名称',
'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:PageTitle_Object_Class' => '分解FQDN',
'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:Done' => 'FQDN已分解为%1$s %2$s',

//
// 域的管理
//
// 创建管理
'UI:IPManagement:Action:New:Domain:NameCollision' => '域名已存在！',

// 显示域列表
'UI:IPManagement:Action:DisplayList:Domain' => '显示列表',
'UI:IPManagement:Action:DisplayList:Domain+' => '',
'UI:IPManagement:Action:DisplayList:Domain:PageTitle_Class' => 'DNS域',
'UI:IPManagement:Action:DisplayList:Domain:Title_Class' => 'DNS域',

// 显示域树
'UI:IPManagement:Action:DisplayTree:Domain' => '显示树',
'UI:IPManagement:Action:DisplayTree:Domain+' => '',
'UI:IPManagement:Action:DisplayTree:Domain:PageTitle_Class' => 'DNS域',
'UI:IPManagement:Action:DisplayTree:Domain:Title_Class' => 'DNS域',
'UI:IPManagement:Action:DisplayTree:Domain:OrgName' => '组织%1$s',

//
// 通用操作
//
// 在子网上查找空间操作
'UI:IPManagement:Action:FindSpace' => '查找并分配IP空间',
'UI:IPManagement:Action:FindSpace:Organization' => '组织',
'UI:IPManagement:Action:FindSpace:SpaceType' => '空间类型',
'UI:IPManagement:Action:FindSpace:IPv4Space' => 'IPv4空间',
'UI:IPManagement:Action:FindSpace:IPv6Space' => 'IPv6空间',
'UI:IPManagement:Action:FindIPv4Space' => '查找并分配IPv4空间',
'UI:IPManagement:Action:FindIPv6Space' => '查找并分配IPv6空间',
'UI:IPManagement:Action:FindSpace:FirstIP' => '从IP地址开始：',
'UI:IPManagement:Action:FindSpace:SpaceSize' => '要查找的空间大小：',
'UI:IPManagement:Action:FindSpace:MaxNumberOfOffers' => '最大提供数：',
));

