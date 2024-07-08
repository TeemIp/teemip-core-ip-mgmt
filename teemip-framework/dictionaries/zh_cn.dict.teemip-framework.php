<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

/////////////////////////////////////////////////////////////////////
// Classes in Teemip Framework Module'
//////////////////////////////////////////////////////////////////////
//

//
// TeemIp 特定属性
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
    'Core:AttributeIPPercentage' => 'IP百分比',
    'Core:AttributeIPPercentage+' => '用于显示使用百分比的图形',
    'Core:AttributeMacAddress' => 'MAC地址',
    'Core:AttributeMacAddress+' => 'MAC地址字符串',
));

//
// Class：IPApplication
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
    'Class:IPApplication/Name' => '%1$s',
    'Class:IPApplication/Attribute:uuid' => 'UUID',
    'Class:IPApplication/Attribute:uuid+' => '应用程序的通用唯一标识符',
    'Class:IPApplication/Attribute:status' => '状态',
    'Class:IPApplication/Attribute:status+' => '',
    'Class:IPApplication/Attribute:status/Value:obsolete' => '已过时',
    'Class:IPApplication/Attribute:status/Value:production' => '生产',
    'Class:IPApplication/Attribute:status/Value:implementation' => '实施',
    'Class:IPApplication/Attribute:location_id' => '位置',
    'Class:IPApplication/Attribute:location_id+' => '',
    'Class:IPApplication/Attribute:location_name' => '位置名称',
    'Class:IPApplication/Attribute:location_name+' => '',
));

//
// Class：IPConfig
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPConfig' => '全局IP设置',
	'Class:IPConfig+' => '驱动TeemIp扩展行为的一组设置或参数',
	'Class:IPConfig:baseinfo' => '常规信息',
	'Class:IPConfig:blockinfo' => '子网块的默认设置',
	'Class:IPConfig:subnetinfo' => '子网的默认设置',
	'Class:IPConfig:iprangeinfo' => 'IP范围的默认设置',
	'Class:IPConfig:ipinfo' => 'IP的默认设置',
	'Class:IPConfig:domaininfo' => '域设置',
	'Class:IPConfig:otherinfo' => '其他设置',
	'Class:IPConfig/Attribute:org_id' => '组织',
	'Class:IPConfig/Attribute:org_id+' => '全局IP设置所附属的组织。每个组织只能有一个全局IP设置',
	'Class:IPConfig/Attribute:org_name' => '组织名称',
	'Class:IPConfig/Attribute:org_name+' => '',
	'Class:IPConfig/Attribute:name' => '名称',
	'Class:IPConfig/Attribute:name+' => '',
	'Class:IPConfig/Attribute:requestor_id' => '请求者',
	'Class:IPConfig/Attribute:requestor_id+' => '',
	'Class:IPConfig/Attribute:requestor_name' => '请求者名称',
	'Class:IPConfig/Attribute:requestor_name+' => '',
	'Class:IPConfig/Attribute:ipv4_block_min_size' => 'IPv4子网块的最小大小',
	'Class:IPConfig/Attribute:ipv4_block_min_size+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix' => 'IPv6子网块的最小前缀长度',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:48' => '/48',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:48+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:49' => '/49',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:49+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:50' => '/50',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:50+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:51' => '/51',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:51+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:52' => '/52',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:52+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:53' => '/53',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:53+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:54' => '/54',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:54+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:55' => '/55',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:55+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:56' => '/56',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:56+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:57' => '/57',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:57+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:58' => '/58',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:58+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:59' => '/59',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:59+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:60' => '/60',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:60+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:61' => '/61',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:61+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:62' => '/62',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:62+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:63' => '/63',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:63+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:64' => '/64',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix/Value:64+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned' => '将IPv4子网块对齐到CIDR',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no' => '否',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes' => '是',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned' => '将IPv6子网块对齐到CIDR',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no' => '否',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes' => '是',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only' => '仅将块委派给子组织',
	'Class:IPConfig/Attribute:delegate_to_children_only+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_no' => '否',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_no+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_yes' => '是',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_yes+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs' => '在子网创建时保留子网、网关和广播IP',
	'Class:IPConfig/Attribute:reserve_subnet_IPs+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_no' => '否',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_no+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_yes' => '是',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_yes+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format' => 'IPv4网关IP格式',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1' => '子网IP + 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1' => '广播IP - 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup' => '自由分配',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format' => 'IPv6网关IP格式',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1' => '子网IP + 1',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip' => '最后一个子网IP',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup' => '自由分配',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup+' => '',
	'Class:IPConfig/Attribute:subnet_low_watermark' => '子网低水位标记（%）',
	'Class:IPConfig/Attribute:subnet_low_watermark+' => '',
	'Class:IPConfig/Attribute:subnet_high_watermark' => '子网高水位标记（%）',
	'Class:IPConfig/Attribute:subnet_high_watermark+' => '',
	'Class:IPConfig/Attribute:iprange_low_watermark' => 'IP范围低水位标记（%）',
	'Class:IPConfig/Attribute:iprange_low_watermark+' => '',
	'Class:IPConfig/Attribute:iprange_high_watermark' => 'IP范围高水位标记（%）',
	'Class:IPConfig/Attribute:iprange_high_watermark+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name' => '允许重复名称',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_no' => '否',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_yes' => '是',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack' => '双栈',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack+' => '允许在唯一的IPv4和IPv6之间重复',
	'Class:IPConfig/Attribute:mac_address_format' => 'MAC地址输出格式',
	'Class:IPConfig/Attribute:mac_address_format+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:colons' => '01:23:45:67:89:ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:colons+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:hyphens' => '01-23-45-67-89-ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:hyphens+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:dots' => '0123.4567.89ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:dots+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:any' => '任意',
	'Class:IPConfig/Attribute:mac_address_format/Value:any+' => '',
	'Class:IPConfig/Attribute:ping_before_assign' => '分配前Ping IP',
	'Class:IPConfig/Attribute:ping_before_assign+' => '',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_no' => '否',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_no+' => '',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_yes' => '是',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_yes+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname' => '将CI的名称复制到IP的简称',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:no' => '否',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:yes' => '是',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:yes+' => '',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname' => '当简称为空时计算FQDN',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname+' => '',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:no' => '否',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:no+' => '',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:yes' => '是',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete' => '释放变为过时的CI的IP',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:no' => '否',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:yes' => '是',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production' => '分配给生产CI的IP',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:no' => '否',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:yes' => '是',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:yes+' => '',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only' => '仅将域委派给子组织',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only+' => '',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_no' => '否',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_no+' => '',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_yes' => '是',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_yes+' => '',
	'Class:IPConfig/Attribute:ip_symetrical_nat' => '对称IP NAT',
	'Class:IPConfig/Attribute:ip_symetrical_nat+' => '',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:yes' => '是',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:no' => '否',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:no+' => '',
	'Class:IPConfig/Attribute:subnet_symetrical_nat' => '对称子网NAT',
	'Class:IPConfig/Attribute:subnet_symetrical_nat+' => '',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:yes' => '是',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:yes+' => '',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:no' => '否',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release' => '释放被释放的子网的IP',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:yes' => '是',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:no' => '否',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci' => '取消分配未附加到CI的IP',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci+' => '',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:yes' => '是',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:no' => '否',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:no+' => '',
	'Class:IPConfig/Attribute:attach_already_allocated_ips' => '允许附加已分配的IP到CI',
	'Class:IPConfig/Attribute:attach_already_allocated_ips+' => '',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:yes' => '是',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:yes+' => '',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:no' => '否',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:no+' => '',
));

//
// Class: IPUsage
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPUsage' => 'IP地址用途',
	'Class:IPUsage+' => 'IP地址的用途',
	'Class:IPUsage/Attribute:org_id' => '组织',
	'Class:IPUsage/Attribute:org_id+' => '',
	'Class:IPUsage/Attribute:org_name' => '组织名称',
	'Class:IPUsage/Attribute:org_name+' => '',
	'Class:IPUsage/Attribute:name' => '名称',
	'Class:IPUsage/Attribute:name+' => '',
	'Class:IPUsage/Attribute:description' => '描述',
	'Class:IPUsage/Attribute:description+' => '',
	'Class:IPUsage/Attribute:ips_list' => 'IP地址',
	'Class:IPUsage/Attribute:ips_list+' => '具有该用途的IP地址',
));

//
// Class: DashletBadgeFiltered
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'UI:DashletBadgeFiltered:Label' => '带过滤器的徽章',
	'UI:DashletBadgeFiltered:Description' => '通过OQL进行过滤的徽章',
));

//
// Menus
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Menu:IPConfig' => '全局IP设置',
	'Menu:IPConfig+' => 'IP相关对象的全局参数',
));

//
// Management of IP global settings
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'UI:IPManagement:Action:New:IPConfig:AlreadyExists' => '一个组织只能存在一个全局IP设置对象！',
	'UI:IPManagement:Action:Modify:IPConfig:IPv4BlockMinSizeTooSmall' => 'IPv4子网块的最小大小不能小于%1$s！',
	'UI:IPManagement:Action:Modify:IPConfig:IPv6BlockMinSizeTooSmall' => 'IPv6子网块的最小大小不能小于%1$s！',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksPercent' => '水印是百分比，请使用介于0和100之间的数字！',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksOrder' => '低水印必须小于高水印！',
	'UI:IPManagement:Action:Modify:GlobalConfig' => '这些全局IP设置可能会被该操作覆盖。',
	'UI:IPManagement:Action:New:IPUsage:AlreadyExists' => '已存在具有相同名称的IP地址用途！',
));
