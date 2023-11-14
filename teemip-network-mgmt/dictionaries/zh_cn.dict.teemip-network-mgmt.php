<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'Teemip-Network-Mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// 类：DNSObject
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:DNSObject' => 'DNS 对象',
	'Class:DNSObject+' => '',
	'Class:DNSObject/Attribute:finalclass' => '子类',
	'Class:DNSObject/Attribute:finalclass+' => '最终类的名称',
	'Class:DNSObject/Attribute:org_id' => '组织',
	'Class:DNSObject/Attribute:org_id+' => '',
	'Class:DNSObject/Attribute:org_name' => '组织名称',
	'Class:DNSObject/Attribute:org_name+' => '',
	'Class:DNSObject/Attribute:name' => 'DNS 对象名称',
	'Class:DNSObject/Attribute:name+' => '',
	'Class:DNSObject/Attribute:comment' => '描述',
	'Class:DNSObject/Attribute:comment+' => '',
));

//
// 类：Domain
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:Domain' => '域',
	'Class:Domain+' => 'DNS 域',
	'Class:Domain:baseinfo' => '常规信息',
	'Class:Domain:admininfo' => '管理信息',
	'Class:Domain:DelegatedToChild' => '<delegation_highlight>已委托给组织：</delegation_highlight>%1$s',
	'Class:Domain:DelegatedFromParent' => '<delegation_highlight>委托自组织：</delegation_highlight>%1$s',
	'Class:Domain/Attribute:name' => '名称',
	'Class:Domain/Attribute:name+' => '',
	'Class:Domain/Attribute:parent_org_id' => '委托自',
	'Class:Domain/Attribute:parent_org_id+' => '域从中委托的组织',
	'Class:Domain/Attribute:parent_org_name' => '委托组织名称',
	'Class:Domain/Attribute:parent_org_name+' => '域从中委托的组织名称',
	'Class:Domain/Attribute:parent_id' => '父域',
	'Class:Domain/Attribute:parent_id+' => '',
	'Class:Domain/Attribute:parent_name' => '父域名称',
	'Class:Domain/Attribute:parent_name+' => '',
	'Class:Domain/Attribute:requestor_id' => '请求者',
	'Class:Domain/Attribute:requestor_id+' => '',
	'Class:Domain/Attribute:requestor_name' => '请求者名称',
	'Class:Domain/Attribute:requestor_name+' => '',
	'Class:Domain/Attribute:release_date' => '释放日期',
	'Class:Domain/Attribute:release_date+' => '域不再使用的日期。',
	'Class:Domain/Attribute:registrar_id' => '互联网注册机构',
	'Class:Domain/Attribute:registrar_id+' => '负责域名分配的组织。',
	'Class:Domain/Attribute:registrar_name' => '互联网注册机构名称',
	'Class:Domain/Attribute:registrar_name+' => '',
	'Class:Domain/Attribute:validity_start' => '开始日期',
	'Class:Domain/Attribute:validity_start+' => '域有效的日期后。',
	'Class:Domain/Attribute:validity_end' => '结束日期',
	'Class:Domain/Attribute:validity_end+' => '域不再有效的日期。',
	'Class:Domain/Attribute:renewal' => '续约',
	'Class:Domain/Attribute:renewal+' => '续约方法',
	'Class:Domain/Attribute:renewal/Value:na' => '不适用',
	'Class:Domain/Attribute:renewal/Value:manual' => '手动',
	'Class:Domain/Attribute:renewal/Value:automatic' => '自动',
));

//
// 类扩展为 Domain
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:Domain/Tab:hosts' => '主机',
	'Class:Domain/Tab:hosts+' => '属于该域的主机',
	'Class:Domain/Tab:hosts/List0' => '属于该域及其子域的主机',
	'Class:Domain/Tab:hosts/SelectList0' => '仅显示属于该域及其子域的主机',
	'Class:Domain/Tab:hosts/List1' => '仅显示直接连接到该域的主机',
	'Class:Domain/Tab:hosts/SelectList1' => '仅显示直接连接到该域的主机',
	'Class:Domain/Tab:hosts/List2' => '仅显示连接到子域的主机',
	'Class:Domain/Tab:hosts/SelectList2' => '仅显示连接到子域的主机',
	'Class:Domain/Tab:hosts/SelectList' => '更改显示',
	'Class:Domain/Tab:child_domain' => '子域',
	'Class:Domain/Tab:child_domain+' => '直接或间接连接的域',
	'Class:Domain/Tab:zones_list' => '相关区域',
	'Class:Domain/Tab:zones_list+' => '与当前域相关的区域',
));

//
// 类：WANLink
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:WANLink' => '广域网链接',
	'Class:WANLink+' => '广域网链接',
	'Class:WANLink:baseinfo' => '常规信息',
	'Class:WANLink:networkinfo' => '网络信息',
	'Class:WANLink:admininfo' => '管理信息',
	'Class:WANLink:locationinfo' => '位置',
	'Class:WANLink:dateinfo' => '日期信息',
	'Class:WANLink/Attribute:type_id' => '类型',
	'Class:WANLink/Attribute:type_id+' => '',
	'Class:WANLink/Attribute:type_name' => '类型名称',
	'Class:WANLink/Attribute:type_name+' => '',
	'Class:WANLink/Attribute:rate' => '速率',
	'Class:WANLink/Attribute:rate+' => '',
	'Class:WANLink/Attribute:burst_rate' => '突发速率',
	'Class:WANLink/Attribute:burst_rate+' => '',
	'Class:WANLink/Attribute:underlying_rate' => '底层速率',
	'Class:WANLink/Attribute:underlying_rate+' => '',
	'Class:WANLink/Attribute:status' => '状态',
	'Class:WANLink/Attribute:status+' => '',
	'Class:WANLink/Attribute:status/Value:implementation' => '实施',
	'Class:WANLink/Attribute:status/Value:implementation+' => '',
	'Class:WANLink/Attribute:status/Value:production' => '生产',
	'Class:WANLink/Attribute:status/Value:production+' => '',
	'Class:WANLink/Attribute:status/Value:obsolete' => '过时',
	'Class:WANLink/Attribute:status/Value:obsolete+' => '',
	'Class:WANLink/Attribute:status/Value:stock' => '库存',
	'Class:WANLink/Attribute:status/Value:stock+' => '',
	'Class:WANLink/Attribute:location_id1' => '位置 #1',
	'Class:WANLink/Attribute:location_id1+' => '链接一端的位置',
	'Class:WANLink/Attribute:location_name1' => '位置 #1 名称',
	'Class:WANLink/Attribute:location_name1+' => '',
	'Class:WANLink/Attribute:location_id2' => '位置 #2',
	'Class:WANLink/Attribute:location_id2+' => '链接的另一端的位置',
	'Class:WANLink/Attribute:location_name2' => '位置 #2 名称',
	'Class:WANLink/Attribute:location_name2+' => '',
	'Class:WANLink/Attribute:carrier_id' => '载体',
	'Class:WANLink/Attribute:carrier_id+' => '',
	'Class:WANLink/Attribute:carrier_name' => '载体名称',
	'Class:WANLink/Attribute:carrier_name+' => '',
	'Class:WANLink/Attribute:carrier_reference' => '载体参考',
	'Class:WANLink/Attribute:carrier_reference+' => '',
	'Class:WANLink/Attribute:internal_reference' => '内部参考',
	'Class:WANLink/Attribute:internal_reference+' => '',
	'Class:WANLink/Attribute:networkinterface_id1' => '网络接口 #1',
	'Class:WANLink/Attribute:networkinterface_id1+' => '位置 #1 的网络接口',
	'Class:WANLink/Attribute:networkinterface_name1' => '网络接口 #1 名称',
	'Class:WANLink/Attribute:networkinterface_name1+' => '',
	'Class:WANLink/Attribute:networkinterface_id2' => '网络接口 #2',
	'Class:WANLink/Attribute:networkinterface_id2+' => '位置 #2 的网络接口',
	'Class:WANLink/Attribute:networkinterface_name2' => '网络接口 #2 名称',
	'Class:WANLink/Attribute:networkinterface_name2+' => '',
	'Class:WANLink/Attribute:purchase_date' => '订购日期',
	'Class:WANLink/Attribute:purchase_date+' => '',
	'Class:WANLink/Attribute:renewal_date' => '续订日期',
	'Class:WANLink/Attribute:renewal_date+' => '',
	'Class:WANLink/Attribute:decommissioning_date' => '停用日期',
	'Class:WANLink/Attribute:decommissioning_date+' => '',
));

//
// 类：WANType
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:WANType' => 'WAN类型',
	'Class:WANType+' => '',
	'Class:WANType/Attribute:description' => '描述',
	'Class:WANType/Attribute:description+' => '',
));

//
// Class: ASNumber
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:ASNumber' => 'AS编号',
	'Class:ASNumber+' => '自治系统编号',
	'Class:ASNumber:baseinfo' => '基本信息',
	'Class:ASNumber:admininfo' => '管理信息',
	'Class:ASNumber/Attribute:number' => '编号',
	'Class:ASNumber/Attribute:number+' => '',
	'Class:ASNumber/Attribute:registrar_id' => '注册商',
	'Class:ASNumber/Attribute:registrar_id+' => '',
	'Class:ASNumber/Attribute:registrar_name' => '注册商名称',
	'Class:ASNumber/Attribute:registrar_name+' => '',
	'Class:ASNumber/Attribute:whois' => 'Whois',
	'Class:ASNumber/Attribute:whois+' => '指向注册商Whois信息的URL',
	'Class:ASNumber/Attribute:move2production' => '注册日期',
	'Class:ASNumber/Attribute:move2production+' => 'AS注册的日期',
	'Class:ASNumber/Attribute:validity_end' => '结束日期',
	'Class:ASNumber/Attribute:validity_end+' => 'AS不再有效的日期',
	'Class:ASNumber/Attribute:renewal_date' => '更新日期',
	'Class:ASNumber/Attribute:renewal_date+' => 'AS已更新的日期',
));

//
// Class: VRF
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:VRF' => 'VRF',
	'Class:VRF+' => '虚拟路由和转发',
	'Class:VRF:baseinfo' => '基本信息',
	'Class:VRF/Attribute:route_dist' => '路由区分器',
	'Class:VRF/Attribute:route_dist+' => '',
	'Class:VRF/Attribute:route_trgt' => '路由目标',
	'Class:VRF/Attribute:route_trgt+' => '',
	'Class:VRF/Attribute:subnets_list' => '子网',
	'Class:VRF/Attribute:subnets_list+' => '',
	'Class:VRF/Attribute:physicalinterfaces_list' => '物理网络接口',
	'Class:VRF/Attribute:physicalinterfaces_list+' => '附加到VRF的所有物理网络接口的列表',
	'Class:VRF/Attribute:networkdevicevirtualinterfaces_list' => '网络设备虚拟接口',
	'Class:VRF/Attribute:networkdevicevirtualinterfaces_list+' => '附加到VRF的所有网络设备虚拟接口的列表',
	'Class:VRF/Tab:ipaddresses_list' => '接口的IP地址',
	'Class:VRF/Tab:ipaddresses_list+' => '由附加到CI的所有IP接口托管的所有IP地址的列表',
));

//
// Class: lnkPhysicalInterfaceToVRF
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkPhysicalInterfaceToVRF' => '连接物理接口 / VRF',
	'Class:lnkPhysicalInterfaceToVRF+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Name' => '%1$s / %2$s',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id' => '物理接口',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name' => '物理接口名称',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id' => '设备',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name' => '设备名称',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_name' => 'VRF名称',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_name+' => '',
));

//
// NetworkDevice
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:NetworkDevice/Attribute:physicalinterface_list' => '物理网络接口',
	'Class:NetworkDevice/Attribute:physicalinterface_list+' => '附加到网络设备的所有物理网络接口的列表',
	'Class:NetworkDevice/Attribute:networkdevicevirtualinterfaces_list' => '虚拟网络接口',
	'Class:NetworkDevice/Attribute:networkdevicevirtualinterfaces_list+' => '附加到网络设备的所有虚拟网络接口的列表',
	'Class:NetworkDevice/Tab:ipaddresses_list' => '接口的IP地址',
	'Class:NetworkDevice/Tab:ipaddresses_list+' => '由网络设备附加的所有物理和虚拟接口托管的所有IP地址的列表',
));

//
// NetworkDeviceVirtualInterface
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:NetworkDeviceVirtualInterface' => '网络设备虚拟接口',
	'Class:NetworkDeviceVirtualInterface+' => '附加到网络设备的虚拟接口',
	'Class:NetworkDeviceVirtualInterface/Attribute:status' => '状态',
	'Class:NetworkDeviceVirtualInterface/Attribute:status+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:active' => '活动',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:active+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:inactive' => '非活动',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:inactive+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:networkdevice_id' => '网络设备',
	'Class:NetworkDeviceVirtualInterface/Attribute:networkdevice_id+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:vlans_list' => 'VLANs',
	'Class:NetworkDeviceVirtualInterface/Attribute:vlans_list+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:NetworkDeviceVirtualInterface/Attribute:vrfs_list+' => '',
));

//
// Class: lnkNetworkDeviceVirtualInterfaceToVLAN
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN' => '连接网络设备虚拟接口 / VLAN',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Name' => '%1$s / %2$s',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_id' => '网络设备虚拟接口',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_name' => '网络设备虚拟接口名称',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_id' => '网络设备',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_name' => '网络设备名称',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_tag' => '标签',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_tag+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode' => '模式',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode+' => '标记或未标记的模式',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:tagged' => '已标记',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:untagged' => '未标记',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));

//
// Class: lnkNetworkDeviceVirtualInterfaceToVRF
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF' => '连接网络设备虚拟接口 / VRF',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Name' => '%1$s / %2$s',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_id' => '网络设备虚拟接口',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_name' => '网络设备虚拟接口名称',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_id' => '网络设备',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_name' => '网络设备名称',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:vrf_name' => 'VRF名称',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:vrf_name+' => '',
));


//
// VLAN
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:VLAN/Attribute:physicalinterface_list+' => '附加到VLAN的所有物理网络接口的列表',
	'Class:VLAN/Attribute:networkdevicevirtualinterfaces_list' => '网络设备虚拟接口',
	'Class:VLAN/Attribute:networkdevicevirtualinterfaces_list+' => '附加到VLAN的所有网络设备虚拟接口的列表',
));

//
// Application Menu
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Menu:ConfigManagement:TeemIpNetworking' => '网络',
	'Menu:ConfigManagement:TeemIpNetworking:Interfaces' => '接口',
	'Menu:ConfigManagement:TeemIpNetworking:Connectivity' => '连接',
	'Menu:ConfigManagement:TeemIpNetworking:Naming' => '命名',

	//
	// Management of Domains
	//
	// Creation Management
	'UI:IPManagement:Action:New:Domain:NameCollision' => '域名已存在！',

	// Update Management
	'UI:IPManagement:Action:ChangeOrg:Domain:HasParentInOtherOrg' => '无法更改组织：父域不属于新组织！',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasChildren' => '无法更改组织：域有子域！',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasHosts' => '无法更改组织：原始组织的主机正在使用该域！',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasZones' => '无法更改组织：区域以域为基础！',

	// Display list of domains
	'UI:IPManagement:Action:DisplayList:Domain' => '显示列表',
	'UI:IPManagement:Action:DisplayList:Domain+' => '',
	'UI:IPManagement:Action:DisplayList:Domain:PageTitle_Class' => 'DNS域',
	'UI:IPManagement:Action:DisplayList:Domain:Title_Class' => 'DNS域',

	// Display tree of domains
	'UI:IPManagement:Action:DisplayTree:Domain' => '显示树',
	'UI:IPManagement:Action:DisplayTree:Domain+' => '',
	'UI:IPManagement:Action:DisplayTree:Domain:PageTitle_Class' => 'DNS域',
	'UI:IPManagement:Action:DisplayTree:Domain:Title_Class' => 'DNS域',
	'UI:IPManagement:Action:DisplayTree:Domain:OrgName' => '组织 %1$s',

	// Delegate action on domains
	'UI:IPManagement:Action:Delegate:Domain' => '委托',
	'UI:IPManagement:Action:Delegate:Domain:PageTitle_Object_Class' => '%1$s - 委托',
	'UI:IPManagement:Action:Delegate:Domain:Title_Class_Object' => '委托 %1$s %2$s 到组织',
	'UI:IPManagement:Action:Delegate:Domain:ChildDomain' => '要委托域的组织：',
	'UI:IPManagement:Action:Delegate:Domain:NoChildOrg' => '域的组织没有任何子组织，因此无法委托域！',
	'UI:IPManagement:Action:Delegate:Domain:NoOtherOrg' => '除了域的组织外，没有其他组织！',
	'UI:IPManagement:Action:Delegate:Domain:IsDelegated' => '该域已经被委托！',
	'UI:IPManagement:Action:Delegate:Domain:CannotBeDelegated' => '域无法被委托：%1$s',
	'UI:IPManagement:Action:Delegate:Domain:NoChangeOfOrganization' => '无法将域委托给与域相同的组织！',
	'UI:IPManagement:Action:Delegate:Domain:HasHosts' => '域有主机！',
	'UI:IPManagement:Action:Delegate:Domain:HasSubDomains' => '域有子域！',
	'UI:IPManagement:Action:Delegate:Domain:HasZones' => '区域引用了该域！',
	'UI:IPManagement:Action:Delegate:Domain:Done' => '%1$s %2$s 已经被委托。',

	// Undelegate action on domains
	'UI:IPManagement:Action:Undelegate:Domain' => '取消委托',
	'UI:IPManagement:Action:Undelegate:Domain:PageTitle_Object_Class' => '%1$s - 取消委托',
	'UI:IPManagement:Action:Undelegate:Domain:CannotBeUndelegated' => '域无法被取消委托：%1$s',
	'UI:IPManagement:Action:Undelegate:Domain:IsNotDelegated' => '域未被委托',
	'UI:IPManagement:Action:Undelegate:Domain:HasHosts' => '域有主机！',
	'UI:IPManagement:Action:Undelegate:Domain:HasSubDomains' => '域有子域！',
	'UI:IPManagement:Action:Undelegate:Domain:HasZones' => '区域引用了该域！',
	'UI:IPManagement:Action:Undelegate:Domain:Done' => '%1$s %2$s 已经被取消委托。',
	// Look for domain when exploding FQDN
	'UI:IPManagement:Action:ExplodeFQDN:Domain:Error:CannotFindDomain' => '无法在FQDN中找到注册的域！',
));

