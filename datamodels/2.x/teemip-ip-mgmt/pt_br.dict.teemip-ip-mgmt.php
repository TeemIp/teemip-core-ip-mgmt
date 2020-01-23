<?php
// Copyright (C) 2014 TeemIp
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
 * @copyright   Copyright (C) 2014 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'Teemip-ip-Mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// Class: IPObject
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPObject' => 'IP Object',
	'Class:IPObject+' => '',
	'Class:IPObject/Attribute:org_id' => 'Organization',
	'Class:IPObject/Attribute:org_id+' => '',
	'Class:IPObject/Attribute:org_name' => 'Organization name',
	'Class:IPObject/Attribute:org_name+' => '',
	'Class:IPObject/Attribute:status' => 'Status',
	'Class:IPObject/Attribute:status+' => '',
	'Class:IPObject/Attribute:status/Value:reserved' => 'Reserved',
	'Class:IPObject/Attribute:status/Value:reserved+' => '',
	'Class:IPObject/Attribute:status/Value:allocated' => 'Allocated',
	'Class:IPObject/Attribute:status/Value:allocated+' => '',
	'Class:IPObject/Attribute:status/Value:released' => 'Released',
	'Class:IPObject/Attribute:status/Value:released+' => '',
	'Class:IPObject/Attribute:status/Value:unassigned' => 'Unassigned',
	'Class:IPObject/Attribute:status/Value:unassigned+' => '',
	'Class:IPObject/Attribute:comment' => 'Note',
	'Class:IPObject/Attribute:comment+' => '',
	'Class:IPObject/Attribute:requestor_id' => 'Requestor',
	'Class:IPObject/Attribute:requestor_id+' => '',
	'Class:IPObject/Attribute:requestor_name' => 'Requestor name',
	'Class:IPObject/Attribute:requestor_name+' => '',
	'Class:IPObject/Attribute:contact_list' => 'Contacts',
	'Class:IPObject/Attribute:contact_list+' => 'Contacts attached to the IP object',
	'Class:IPObject/Attribute:document_list' => 'Documents',
	'Class:IPObject/Attribute:document_list+' => 'Documents attached to the IP object',
));

//
// Class: lnkContactToIPObject
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkContactToIPObject' => 'Link Contact / IP Object',
	'Class:lnkContactToIPObject+' => '',
	'Class:lnkContactToIPObject/Attribute:ipobject_id' => 'IP Object',
	'Class:lnkContactToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_id' => 'Contact',
	'Class:lnkContactToIPObject/Attribute:contact_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_name' => 'Contact name',
	'Class:lnkContactToIPObject/Attribute:contact_name+' => '',
));

//
// Class: lnkDocToIPObject
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkDocToIPObject' => 'Link Document / IP Object',
	'Class:lnkDocToIPObject+' => '',
	'Class:lnkDocToIPObject/Attribute:ipobject_id' => 'IP Object',
	'Class:lnkDocToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_id' => 'Document',
	'Class:lnkDocToIPObject/Attribute:document_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_name' => 'Document name',
	'Class:lnkDocToIPObject/Attribute:document_name+' => '',
));

//
// Class: IPBlock
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPBlock' => 'Subnet Block',
	'Class:IPBlock+' => '',
	'Class:IPBlock:baseinfo' => 'General Information',
	'Class:IPBlock:ipinfo' => 'IP Information',
	'Class:IPBlock:DelegatedToChild' => '<font color=#ff0000>Delegated to child organization : </font>%1$s',
	'Class:IPBlock:DelegatedFromParent' => '<font color=#ff0000>Delegated from parent organization : </font>%1$s',
	'Class:IPBlock/Attribute:name' => 'Name',
	'Class:IPBlock/Attribute:name+' => '',
	'Class:IPBlock/Attribute:type' => 'Type',
	'Class:IPBlock/Attribute:type+' => 'Type of Subnet Block',
	'Class:IPBlock/Attribute:parent_org_id' => 'Delegated from',
	'Class:IPBlock/Attribute:parent_org_id+' => 'Organization where the Subnet Block has been delegated from',
	'Class:IPBlock/Attribute:parent_org_name' => 'Delegating organization name',
	'Class:IPBlock/Attribute:parent_org_name+' => 'Name of the organization where the Subnet Block has been delegated from',
	'Class:IPBlock/Attribute:occupancy' => 'Space Used',
	'Class:IPBlock/Attribute:occupancy+' => '',
	'Class:IPBlock/Attribute:children_occupancy' => 'Space Used by Children',
	'Class:IPBlock/Attribute:children_occupancy+' => '',
	'Class:IPBlock/Attribute:subnet_occupancy' => 'Space Used by Subnets',
	'Class:IPBlock/Attribute:subnet_occupancy+' => '',
	'Class:IPBlock/Attribute:location_list' => 'Locations',
	'Class:IPBlock/Attribute:location_list+' => 'Locations where the Subnet Block expands',
));

//
// Class extensions for IPBlock
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPBlock/Tab:globalparam' => 'Global Settings',
	'Class:IPBlock/Tab:childblock' => 'Child Blocks (%1$s)',
	'Class:IPBlock/Tab:childblock+' => 'Blocks attached to this block',
	'Class:IPBlock/Tab:childblock-count' => 'Child Blocks : %1$s',
	'Class:IPBlock/Tab:childblock-count-percent' => ' space used by Child Blocks.',
	'Class:IPBlock/Tab:childblock-count-percent-remain' => 'Space used by Child Blocks in remaining space: %1$.1f %%',
	'Class:IPBlock/Tab:subnet' => 'Subnets (%1$s)',
	'Class:IPBlock/Tab:subnet+' => 'Subnets attached to this block',
	'Class:IPBlock/Tab:subnet-count' => 'Subnets : %1$s',
	'Class:IPBlock/Tab:subnet-count-percent' => ' space used by Subnets',
	'Class:IPBlock/Tab:subnet-count-percent-remain' => 'Space used by Subnets in remaining space : %1$.1f %%',
));

//
// Class: lnkBlockToLocation
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkIPBlockToLocation' => 'Link Block / Location',
	'Class:lnkIPBlockToLocation+' => '',
	'Class:lnkIPBlockToLocation/Attribute:block_id' => 'Block',
	'Class:lnkIPBlockToLocation/Attribute:block_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:block_name' => 'Block name',
	'Class:lnkIPBlockToLocation/Attribute:block_name+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_id' => 'Location',
	'Class:lnkIPBlockToLocation/Attribute:location_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_name' => 'Location name',
	'Class:lnkIPBlockToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Block
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv4Block' => 'IPv4 Subnet Block',
	'Class:IPv4Block+' => '',
	'Class:IPv4Block/Attribute:parent_id' => 'Parent',
	'Class:IPv4Block/Attribute:parent_id+' => '',
	'Class:IPv4Block/Attribute:parent_name' => 'Parent name',
	'Class:IPv4Block/Attribute:parent_name+' => '',
	'Class:IPv4Block/Attribute:firstip' => 'First IP',
	'Class:IPv4Block/Attribute:firstip+' => 'First IP Address of Subnet Block',
	'Class:IPv4Block/Attribute:lastip' => 'Last IP',
	'Class:IPv4Block/Attribute:lastip+' => 'Last IP Address of Subnet Block',
));

//
// Class: IPSubnet
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPSubnet' => 'Subnet',
	'Class:IPSubnet+' => '',
	'Class:IPSubnet:baseinfo' => 'General Information',
	'Class:IPSubnet:ipinfo' => 'IP Information',
	'Class:IPSubnet/Attribute:name' => 'Name',
	'Class:IPSubnet/Attribute:name+' => '',
	'Class:IPSubnet/Attribute:type' => 'Type',
	'Class:IPSubnet/Attribute:type+' => '',
	'Class:IPSubnet/Attribute:release_date' => 'Release date',
	'Class:IPSubnet/Attribute:release_date+' => 'Date when subnet has been released and is not used anymore.',
	'Class:IPSubnet/Attribute:ip_occupancy' => 'Registered IPs',
	'Class:IPSubnet/Attribute:ip_occupancy+' => '',
	'Class:IPSubnet/Attribute:range_occupancy' => 'Registered Ranges',
	'Class:IPSubnet/Attribute:range_occupancy+' => '',                         
	'Class:IPSubnet/Attribute:alarm_water_mark' => 'Status of water mark alarm',
	'Class:IPSubnet/Attribute:alarm_water_mark+' => '',                              
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:no_alarm' => 'No alarm has been sent yet',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:low_sent' => 'Low water mark alarm has been sent',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:high_sent' => 'High water mark alarm has been sent',
	'Class:IPSubnet/Attribute:vlans_list' => 'VLANs',
	'Class:IPSubnet/Attribute:vlans_list+' => '',
	'Class:IPSubnet/Attribute:location_list' => 'Locations',
	'Class:IPSubnet/Attribute:location_list+' => 'Locations where the Subnet expands',
));

//
// Class extensions for IPSubnet
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPSubnet/Tab:globalparam' => 'Global Settings',
	'Class:IPSubnet/Tab:ipregistered' => 'Registered IPs (%1$s)',
	'Class:IPSubnet/Tab:ipregistered+' => 'IPs registered in the Subnet',
	'Class:IPSubnet/Tab:ipregistered-count' => ' - %1$s Reserved and %2$s Allocated out of %3$s',
	'Class:IPSubnet/Tab:ipfree-explain' => 'List of first %1$s free IP addresses:',
	'Class:IPSubnet/Tab:ipfree-explainbis' => 'List of ALL free IP addresses:',
	'Class:IPSubnet/Tab:iprange' => 'IP Ranges (%1$s)',
	'Class:IPSubnet/Tab:iprange+' => 'IP Ranges part of the subnet',
	'Class:IPSubnet/Tab:iprange-count-percent' => ' space used by IP Ranges.',
	'Class:IPSubnet/Tab:notifications' => 'Notifications (%1$s)',
	'Class:IPSubnet/Tab:notifications+' => 'Notifications related to this subnet',
	'Class:IPSubnet/Tab:requests' => 'IP Requests (%1$s)',
	'Class:IPSubnet/Tab:requests+' => 'IP Requests related to this subnet',
	'Class:IPSubnet/Tab:changes' => 'IP Changes(%1$s)',
	'Class:IPSubnet/Tab:changes+' => 'IP Changes related to this subnet',
));

//
// Class: lnkIPSubnetToVLAN
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkIPSubnetToVLAN' => 'Link Subnet / VLAN',
	'Class:lnkIPSubnetToVLAN+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall' => 'Subnet type',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id' => 'Subnet',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name' => 'Subnet name',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag' => 'VLAN Tag',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag+' => '',
));

//
// Class: lnkIPSubnetToLocation
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkIPSubnetToLocation' => 'Link Subnet / Location',
	'Class:lnkIPSubnetToLocation+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id' => 'Subnet',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name' => 'Subnet name',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_id' => 'Location',
	'Class:lnkIPSubnetToLocation/Attribute:location_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_name' => 'Location name',
	'Class:lnkIPSubnetToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Subnet
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv4Subnet' => 'IPv4 Subnet',
	'Class:IPv4Subnet+' => '',
	'Class:IPv4Subnet/Attribute:block_id' => 'Subnet Block',
	'Class:IPv4Subnet/Attribute:block_id+' => '',
	'Class:IPv4Subnet/Attribute:block_name' => 'Block name',
	'Class:IPv4Subnet/Attribute:block_name+' => '',
	'Class:IPv4Subnet/Attribute:ip' => 'Subnet IP',
	'Class:IPv4Subnet/Attribute:ip+' => '',
	'Class:IPv4Subnet/Attribute:mask' => 'Mask',
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
	'Class:IPv4Subnet/Attribute:gatewayip' => 'Gateway IP',
	'Class:IPv4Subnet/Attribute:gatewayip+' => '',
	'Class:IPv4Subnet/Attribute:broadcastip' => 'Broadcast IP',
	'Class:IPv4Subnet/Attribute:broadcastip+' => '',
));

//
// Class: IPRange
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPRange' => 'IP Range',
	'Class:IPRange+' => '',
	'Class:IPRange/Attribute:range' => 'Name',
	'Class:IPRange/Attribute:range+' => '',
	'Class:IPRange/Attribute:usage_id' => 'Usage',
	'Class:IPRange/Attribute:usage_id+' => 'Usage being made of the range',
	'Class:IPRange/Attribute:usage_name' => 'Usage Name',
	'Class:IPRange/Attribute:usage_name+' => '',
	'Class:IPRange/Attribute:dhcp' => 'DHCP Range',
	'Class:IPRange/Attribute:dhcp+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no' => 'No',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes' => 'Yes',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes+' => '',
	'Class:IPv4Range/Attribute:occupancy' => 'Registered IPs',
	'Class:IPv4Range/Attribute:occupancy+' => '',
));

//
// Class extensions for IPRange
//                                                       

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPRange/Tab:ipregistered' => 'Registered IPs (%1$s)',
	'Class:IPRange/Tab:ipregistered+' => 'IPs registered within the IP Range',
	'Class:IPRange/Tab:ipregistered-count' => ' - %1$s Reserved and %2$s Allocated out of %3$s',
	'Class:IPRange/Tab:ipfree-explain' => 'List of first %1$s free IP addresses:',
	'Class:IPRange/Tab:ipfree-explainbis' => 'List of ALL free IP addresses:',
	'Class:IPRange/Tab:notifications' => 'Notifications (%1$s)',
	'Class:IPRange/Tab:notifications+' => 'Notifications related to this IP range',
));

//
// Class: IPv4Range
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv4Range' => 'IPv4 Range',
	'Class:IPv4Range+' => '',
	'Class:IPv4Range/Attribute:subnet_id' => 'Subnet',
	'Class:IPv4Range/Attribute:subnet_id+' => '',
	'Class:IPv4Range/Attribute:subnet_ip' => 'Subnet IP',
	'Class:IPv4Range/Attribute:subnet_ip+' => '',
	'Class:IPv4Range/Attribute:firstip' => 'First IP of Range',
	'Class:IPv4Range/Attribute:firstip+' => '',
	'Class:IPv4Range/Attribute:lastip' => 'Last IP of Range',
	'Class:IPv4Range/Attribute:lastip+' => '',
));

//
// Class: IPAddress
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPAddress' => 'IP Address',
	'Class:IPAddress+' => '',
	'Class:IPAddress:baseinfo' => 'General Information',
	'Class:IPAddress:ipinfo' => 'IP Information',
	'Class:IPAddress/Attribute:short_name' => 'Short Name',
	'Class:IPAddress/Attribute:short_name+' => 'Left label of the FQDN',
	'Class:IPAddress/Attribute:domain_id' => 'DNS Domain',
	'Class:IPAddress/Attribute:domain_id+' => '',
	'Class:IPAddress/Attribute:domain_name' => 'Domain Name',
	'Class:IPAddress/Attribute:domain_name+' => 'Name of the DNS domain',
	'Class:IPAddress/Attribute:fqdn' => 'FQDN',
	'Class:IPAddress/Attribute:fqdn+' => 'Fully Qualified Domain Name',
	'Class:IPAddress/Attribute:usage_id' => 'Usage',
	'Class:IPAddress/Attribute:usage_id+' => '',
	'Class:IPAddress/Attribute:usage_name' => 'Usage name',
	'Class:IPAddress/Attribute:usage_name+' => '',
	'Class:IPAddress/Attribute:ipinterface_id' => 'IP Interface',
	'Class:IPAddress/Attribute:ipinterface_id+' => '',
	'Class:IPAddress/Attribute:ipinterface_name' => 'IP Interface name',
	'Class:IPAddress/Attribute:ipinterface_name+' => '',
	'Class:IPAddress/Attribute:release_date' => 'Release date',
	'Class:IPAddress/Attribute:release_date+' => 'Date when IP address has been released and is not used anymore.',
	'Class:IPAddress/Attribute:ip_list' => 'NAT IPs',
	'Class:IPAddress/Attribute:finalclass' => 'Class',
	'Class:IPAddress/Attribute:finalclass+' => '',
));

//
// Class extensions for IPAddress
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPAddress/Tab:globalparam' => 'Global Settings',
	'Class:IPAddress/Tab:parents' => 'Parents',
	'Class:IPAddress/Tab:ip_list' => 'NAT IPs (%1$s)',
	'Class:IPAddress/Tab:ip_list+' => 'List of NAT IPs',
	'Class:IPAddress/Tab:ci_list' => 'CIs (%1$s)',
	'Class:IPAddress/Tab:ci_list+' => 'List of CIs pointing to this IP',
	'Class:IPAddress/Tab:DatacenterDevice' => 'Datacenter Devices (%1$s)',
	'Class:IPAddress/Tab:DatacenterDevice+' => 'Datacenter Devices using this IP as their management IP: %1$s',
	'Class:IPAddress/Tab:VirtualMachine' => 'Virtual Machines (%1$s)',
	'Class:IPAddress/Tab:VirtualMachine+' => 'Virtual Machines using this IP as their management IP: %1$s',
	'Class:IPAddress/Tab:IPInterface' => 'IP Interfaces (%1$s)',
	'Class:IPAddress/Tab:IPInterface+' => 'IP Interfaces hosting this IP: %1$s',
	'Class:IPAddress/Tab:NoCi' => 'No CI',
	'Class:IPAddress/Tab:NoCi+' => 'No Configuration Item is using this IP',
	'Class:IPAddress/Tab:requests' => 'IP Requests (%1$s)',
	'Class:IPAddress/Tab:requests+' => 'IP requests related to this IP address',
	'Class:IPAddress/Tab:changes' => 'IP Changes(%1$s)',
	'Class:IPAddress/Tab:changes+' => 'IP Changes related to this IP address',
));

//
// Class: lnkIPAdressToIPAddress
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkIPAdressToIPAddress' => 'Link IP / NAT IPs',
	'Class:lnkIPAdressToIPAddress+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id' => 'IP Address',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id' => 'NAT IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name' => 'Short Name',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name+' => 'Left label of the FQDN',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name' => 'Domain Name',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name+' => 'Name of the DNS domain',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name' => 'Short Name',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name+' => 'Left label of the FQDN',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name' => 'Domain Name',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name+' => 'Name of the DNS domain',
));

//
// Class: lnkIPInterfaceToIPAddress
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkIPInterfaceToIPAddress' => 'Link IP interface/ IP Address',
	'Class:lnkIPInterfaceToIPAddress+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall' => 'IP Type',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id' => 'IP Interface',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name' => 'IP Interface Name',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id' => 'IP Address',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id+' => '',
));

//
// Class: IPv4Address
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv4Address' => 'IPv4 Address',
	'Class:IPv4Address+' => '',
	'Class:IPv4Address/Attribute:subnet_id' => 'Subnet',
	'Class:IPv4Address/Attribute:subnet_id+' => 'IPv4 Subnet',
	'Class:IPv4Address/Attribute:range_id' => 'Range',
	'Class:IPv4Address/Attribute:range_id+' => 'IPv4 Range',
	'Class:IPv4Address/Attribute:ip' => 'Address',
	'Class:IPv4Address/Attribute:ip+' => 'IPv4 Address',
));

//
// Class: IPConfig
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPConfig' => 'Global IP Setting',
	'Class:IPConfig+' => '',
	'Class:IPConfig:baseinfo' => 'General Information',
	'Class:IPConfig:blockinfo' => 'Default Settings for Subnet Blocks',
	'Class:IPConfig:subnetinfo' => 'Default Settings for Subnets',
	'Class:IPConfig:iprangeinfo' => 'Default Settings for IP Ranges',
	'Class:IPConfig:ipinfo' => 'Default Settings for IPs',
	'Class:IPConfig/Attribute:org_id' => 'Organization',
	'Class:IPConfig/Attribute:org_id+' => '',
	'Class:IPConfig/Attribute:org_name' => 'Organization name',
	'Class:IPConfig/Attribute:org_name+' => '',
	'Class:IPConfig/Attribute:name' => 'Name',
	'Class:IPConfig/Attribute:name+' => '',
	'Class:IPConfig/Attribute:requestor_id' => 'Requestor',
	'Class:IPConfig/Attribute:requestor_id+' => '',
	'Class:IPConfig/Attribute:requestor_name' => 'Requestor name',
	'Class:IPConfig/Attribute:requestor_name+' => '',
	'Class:IPConfig/Attribute:ipv4_block_min_size' => 'Minimum size of IPv4 Subnet Blocks',
	'Class:IPConfig/Attribute:ipv4_block_min_size+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned' => 'Align IPv4 Subnet Blocks to CIDR',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes' => 'Yes',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs' => 'Reserve Subnet, Gateway and Broadcast IPs at Subnet Creation',
	'Class:IPConfig/Attribute:reserve_subnet_IPs+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_no' => 'No',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_no+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_yes' => 'Yes',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_yes+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format' => 'IPv4 Gateway IP',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1' => 'Subnet IP + 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1' => 'Broadcast IP - 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup' => 'Free allocation',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup+' => '',
	'Class:IPConfig/Attribute:subnet_low_watermark' => 'Subnet Low Water Mark (%)',
	'Class:IPConfig/Attribute:subnet_low_watermark+' => '',
	'Class:IPConfig/Attribute:subnet_high_watermark' => 'Subnet High Water Mark (%)',
	'Class:IPConfig/Attribute:subnet_high_watermark+' => '',
	'Class:IPConfig/Attribute:iprange_low_watermark' => 'IP Range Low Water Mark (%)',
	'Class:IPConfig/Attribute:iprange_low_watermark+' => '',
	'Class:IPConfig/Attribute:iprange_high_watermark' => 'IP Range High Water Mark (%)',
	'Class:IPConfig/Attribute:iprange_high_watermark+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name' => 'Allow Duplicate Names',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_no' => 'No',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_yes' => 'Yes',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPConfig/Attribute:mac_address_format' => 'MAC Address Output Format',
	'Class:IPConfig/Attribute:mac_address_format+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:colons' => '01:23:45:67:89:ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:colons+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:hyphens' => '01-23-45-67-89-ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:hyphens+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:dots' => '0123.4567.89ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:dots+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:any' => 'Any',
	'Class:IPConfig/Attribute:mac_address_format/Value:any+' => '',                                 
	'Class:IPConfig/Attribute:ping_before_assign' => 'Ping IP before assigning it ?',
	'Class:IPConfig/Attribute:ping_before_assign+' => '',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_no' => 'No',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_no+' => '',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_yes' => 'Yes',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_yes+' => '',
));

//
// Class: IPRangeUsage
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPRangeUsage' => 'IP Range Usage',
	'Class:IPRangeUsage+' => 'What a Range of IP addresses is used for',
	'Class:IPRangeUsage/Attribute:org_id' => 'Organization',
	'Class:IPRangeUsage/Attribute:org_id+' => '',
	'Class:IPRangeUsage/Attribute:org_name' => 'Organization name',
	'Class:IPRangeUsage/Attribute:org_name+' => '',
	'Class:IPRangeUsage/Attribute:name' => 'Name',
	'Class:IPRangeUsage/Attribute:name+' => '',
	'Class:IPRangeUsage/Attribute:description' => 'Description',
	'Class:IPRangeUsage/Attribute:description+' => '',
));

//
// Class: IPUsage
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPUsage' => 'IP Address Usage',
	'Class:IPUsage+' => 'What an IP address is used for',
	'Class:IPUsage/Attribute:org_id' => 'Organization',
	'Class:IPUsage/Attribute:org_id+' => '',
	'Class:IPUsage/Attribute:org_name' => 'Organization name',
	'Class:IPUsage/Attribute:org_name+' => '',
	'Class:IPUsage/Attribute:name' => 'Name',
	'Class:IPUsage/Attribute:name+' => '',
	'Class:IPUsage/Attribute:description' => 'Description',
	'Class:IPUsage/Attribute:description+' => '',
));

//
// Class: IPTriggerOnWaterMark
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPTriggerOnWaterMark' => 'Trigger (when reaching an IP related water mark)',
	'Class:IPTriggerOnWaterMark+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_id' => 'Organization',
	'Class:IPTriggerOnWaterMark/Attribute:org_id+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_name' => 'Organization name',
	'Class:IPTriggerOnWaterMark/Attribute:org_name+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:target_class' => 'Target Class',
	'Class:IPTriggerOnWaterMark/Attribute:target_class+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event' => 'Event',
	'Class:IPTriggerOnWaterMark/Attribute:event+' => 'Event generated when trigger is activated',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low' => 'Low water mark is crossed',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high' => 'High water mark is crossed',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high+' => '',
));

//
// Class: IPObjTemplate
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPObjTemplate' => 'Template IP',
	'Class:IPObjTemplate+' => '',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id' => 'Subcategory Service',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id+' => '',
	'Class:IPObjTemplate/Attribute:request_type' => 'Request Type',
	'Class:IPObjTemplate/Attribute:request_type+' => '',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_create' => 'IP Creation',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_change' => 'IP Change',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_delete' => 'IP Deletion',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_create' => 'Subnet Creation',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_change' => 'Subnet Change',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_delete' => 'Subnet Deletion',
));

//
// Application Menu
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Menu:IPManagement' => 'IP Management',
	'Menu:IPManagement+' => 'IP Management',
	'Menu:IPManagement:Overview:Total' => 'Total: %1s',
	'Menu:IPSpace' => 'IP Space',
	'Menu:IPSpace+' => 'IP Space',
	'Menu:IPSpace:IPv4Objects' => 'IPv4 Objects',
	'Menu:IPSpace:IPv4Objects+' => 'IPv4 Objects',
	'Menu:IPSpace:Options' => 'Parameters',
	'Menu:IPSpace:Options+' => 'Parameters',  
	'Menu:NewIPObject' => 'New IP object',
	'Menu:NewIPObject+' => 'Creation of a new IP object',
	'Menu:SearchIPObject' => 'Search for IP object',
	'Menu:SearchIPObject+' => 'Search for an IP object',
	'Menu:Ipv4ShortCut' => 'IPv4 Shortcuts',
	'Menu:Ipv4ShortCut+' => 'IPv4 Shortcuts',  
	'Menu:IPv4Block' => 'Subnet Blocks',
	'Menu:IPv4Block+' => 'IPv4 Subnet Blocks',
	'Menu:IPv4Subnet' => 'Subnets',
	'Menu:IPv4Subnet+' => 'IPv4 Subnets',
	'Menu:IPv4Subnet:Allocated' => 'Allocated Subnets',
	'Menu:IPv4Subnet:Allocated+' => 'List of allocated IPv4 Subnets',
	'Menu:IPv4Range' => 'IP Ranges',
	'Menu:IPv4Range+' => 'IP Ranges',
	'Menu:IPv4Address' => 'IP Addresses',
	'Menu:IPv4Address+' => 'IP Addresses',
	'Menu:Options' => 'Parameters',
	'Menu:Options+' => 'Parameters',  
	'Menu:IPConfig' => 'Global IP Settings',
	'Menu:IPConfig+' => 'Global parameters for the IP related objects',
	'Menu:IPRangeUsage' => 'IP Range Types',
	'Menu:IPRangeUsage+' => 'IP Range Usage Types',
	'Menu:IPUsage' => 'IP Types',
	'Menu:IPUsage+' => 'IP Usage Types',
	'Menu:Domain' => 'Domains',
	'Menu:Domain+' => 'Domain Names',
	'Menu:IPTemplate' => 'Templates IP',
	'Menu:IPTemplate+' => 'Templates IP',
	
	'UI:IPMgmtWelcomeOverview:Title' => 'My Dashboard',
	
	// Menu separator in Action menus
	'UI:IPManagement:Action:MenuSeparator' => '<hr class="menu-separator"/>',	
	'UI:IPManagement:Action:Error::WrongActionForClass' => 'This action cannot be applied on that class of object!',
//
// Management of IP global settings
//
	'UI:IPManagement:Action:New:IPConfig:AlreadyExists' => 'Only one Global IP Settings object can exist within an organization.',	
	'UI:IPManagement:Action:Modify:IPConfig:IPv4BlockMinSizeTooSmall' => 'Minimum size of IPv4 Subnet Blocks cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Modify:IPConfig:IPv6BlockMinSizeTooSmall' => 'Minimum size of IPv6 Subnet Blocks cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksPercent' => 'Water Marks are percentage, please, use numbers between 0 and 100!',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksOrder' => 'Low Water Mark must be smaller than High one!',	
	'UI:IPManagement:Action:Modify:GlobalConfig' => 'These Global IP Settings may be over written for that action.',	

//
// Management of IPBlocks
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPBlock:Reverted' => 'First IP of Subnet Block is higher than last IP!',
	'UI:IPManagement:Action:New:IPBlock:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s!',	
	'UI:IPManagement:Action:New:IPBlock:NotCIDRAligned' => 'Block is not CIDR aligned!',	
	'UI:IPManagement:Action:New:IPBlock:NotInParent' => 'Subnet Block is not strictly contained within selected parent!',	
	'UI:IPManagement:Action:New:IPBlock:NameExist' => 'Name of Subnet Block already exists!',	
	'UI:IPManagement:Action:New:IPBlock:Collision0' => 'Subnet Block already exists!',	
	'UI:IPManagement:Action:New:IPBlock:Collision1' => 'Subnet Block collision : first IP belongs to an existing block!',	
	'UI:IPManagement:Action:New:IPBlock:Collision2' => 'Subnet Block collision : last IP belongs to an existing block!',	
	'UI:IPManagement:Action:Modify:IPBlock:ParentIdNull' => 'Child subnets of block %1$s cannot be attached to non existant parent block.',	
	
	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPBlock:Reverted' =>  'New first IP of Subnet Block is higher than new last IP!',
	'UI:IPManagement:Action:Shrink:IPBlock:IPOutOfBlock' => 'New IPs are not all within block!',
	'UI:IPManagement:Action:Shrink:IPBlock:NoChange' => 'No change has been required.',
	'UI:IPManagement:Action:Shrink:IPBlock:NotCIDRAligned' => 'Block is not CIDR aligned!',
	'UI:IPManagement:Action:Shrink:IPBlock:BlockAccrossBorder' => 'A child subnet block sits accros new borders!',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetAccrossBorder' => 'A subnet attached to the block sits accros new borders!',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetBecomesOrhpean' => 'Child subnets won\'t have parent block after shrink!',	
	'UI:IPManagement:Action:Shrink:IPBlock:Done' => '%1$s <span class="hilite">%2$s</span> has been shrunk.',
	
	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPBlock:IPOutOfBlock' => 'Split IP is out of block!',
	'UI:IPManagement:Action:Split:IPBlock:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Split:IPBlock:NotCIDRAligned' => 'Blocks are not CIDR aligned!',	
	'UI:IPManagement:Action:Split:IPBlock:BlockAccrossBorder' => 'A child subnet block sits accros new borders!',
	'UI:IPManagement:Action:Split:IPBlock:SubnetAccrossBorder' => 'A subnet attached to the block sits accros new borders!',
	'UI:IPManagement:Action:Split:IPBlock:EmptyNewName' => 'Name of new Subnet Block is empty!',
	'UI:IPManagement:Action:Split:IPBlock:NameExist' => 'Name of new Subnet Block already exists!',
	'UI:IPManagement:Action:Split:IPBlock:Done' => '%1$s <span class="hilite">%2$s</span> has been split.',
	
	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPBlock:Reverted' =>  'New first IP of Subnet Block is higher than new last IP!',
	'UI:IPManagement:Action:Expand:IPBlock:IPOutOfBlock' => 'New IPs are not all outside of block!',
	'UI:IPManagement:Action:Expand:IPBlock:NoChange' => 'No change has been required.',
	'UI:IPManagement:Action:Expand:IPBlock:NotCIDRAligned' => 'Block is not CIDR aligned!',
	'UI:IPManagement:Action:Expand:IPBlock:BlockBiggerThanParent' => 'The block cannot be bigger than its parent!',
	'UI:IPManagement:Action:Expand:IPBlock:DelegatedBlockAccrossBorder' => 'The block cannot take over a delegated block!',
	'UI:IPManagement:Action:Expand:IPBlock:BlockAccrossBorder' => 'A brother subnet block sits accros new borders!',
	'UI:IPManagement:Action:Expand:IPBlock:SubnetAccrossBorder' => 'A subnet attached to parent block sits accross new borders',
	'UI:IPManagement:Action:Expand:IPBlock:Done' => '%1$s <span class="hilite">%2$s</span> has been expanded.',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPBlock:NoChildOrg' => 'Block\'s organization doesn\'t have any children!',
	'UI:IPManagement:Action:Delegate:IPBlock:WrongLevelOfOrganization' => 'Delegation change must be done to a sister organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:NoChangeOfOrganization' => 'No change has been required!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocks' => 'Block has children blocks!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnets' => 'Block has children subnets!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfTargetOrg' => 'Block conflicts with a block from the target organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfParentOrg' => 'Block conflicts with a block from the parent organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocksInParent' => 'Block has children blocks in parent organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnetsInParent' => 'Block has children subnets in parent organization!',
	
//
// Management of IPv4Blocks
//
	// Display details of subnet blocks
	'UI:IPManagement:Action:Details:IPv4Block' => 'Details',
	'UI:IPManagement:Action:Details:IPv4Block+' => '',
	
	// Display list of subnet blocks
	'UI:IPManagement:Action:DisplayList:IPv4Block' => 'Display List',
	'UI:IPManagement:Action:DisplayList:IPv4Block+' => '',
	'UI:IPManagement:Action:DisplayList:IPv4Block:PageTitle_Class' => 'IPv4 Subnet Blocks',
	'UI:IPManagement:Action:DisplayList:IPv4Block:Title_Class' => 'IPv4 Subnet Blocks',
	
	// Display tree of subnet blocks
	'UI:IPManagement:Action:DisplayTree:IPv4Block' => 'Display Tree',
	'UI:IPManagement:Action:DisplayTree:IPv4Block+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:PageTitle_Class' => 'IPv4 Subnet Blocks',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:Title_Class' => 'IPv4 Subnet Blocks',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:OrgName' => 'Organization %1$s',
	
	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPv4Block' => 'Shrink',
	'UI:IPManagement:Action:Shrink:IPv4Block+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Shrink:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Block:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s shrink',
	'UI:IPManagement:Action:Shrink:IPv4Block:Title_Class_Object' => 'Shrink %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewFirstIP' => 'New First IP of Block :',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewLastIP' => 'New Last IP of Block :',            
	'UI:IPManagement:Action:Shrink:IPv4Block:IsDelegated' => 'This block is delegated and therefore cannot be shrunk!',
	'UI:IPManagement:Action:Shrink:IPv4Block:CannotBeShrunk' =>  'Block cannot be shrunk: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Block:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Shrink:IPv4Block:Done' => '%1$s <span class="hilite">%2$s</span> has been shrunk.',
	
	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv4Block' => 'Split',
	'UI:IPManagement:Action:Split:IPv4Block+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Split:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s split',
	'UI:IPManagement:Action:Split:IPv4Block:Title_Class_Object' => 'Split %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Split:IPv4Block:At' => 'First IP of new Subnet Block :',
	'UI:IPManagement:Action:Split:IPv4Block:NameNewBlock' => 'Name of new Subnet Block :',
	'UI:IPManagement:Action:Split:IPv4Block:IsDelegated' => 'This block is delegated and therefore cannot be split!',
	'UI:IPManagement:Action:Split:IPv4Block:CannotBeSplit' =>  'Block cannot be split: %1$s',
	'UI:IPManagement:Action:Split:IPv4Block:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Split:IPv4Block:Done' => '%1$s <span class="hilite">%2$s</span> has been split.',
	
	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv4Block' => 'Expand',
	'UI:IPManagement:Action:Expand:IPv4Block+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s expand',
	'UI:IPManagement:Action:Expand:IPv4Block:Title_Class_Object' => 'Expand %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Expand:IPv4Block:NewFirstIP' => 'New First IP of Block :',
	'UI:IPManagement:Action:Expand:IPv4Block:NewLastIP' => 'New Last IP of Block :',
	'UI:IPManagement:Action:Expand:IPv4Block:IsDelegated' => 'This block is delegated and therefore cannot be expanded!',
	'UI:IPManagement:Action:Expand:IPv4Block:CannotBeExpanded' => 'Block cannot be expanded: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Block:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Expand:IPv4Block:Done' => '%1$s <span class="hilite">%2$s</span> has been expanded.',

	// List space action on subnet blocks 
	'UI:IPManagement:Action:ListSpace:IPv4Block' => 'List Space',                                               
	'UI:IPManagement:Action:ListSpace:IPv4Block:PageTitle_Object_Class' => 'TeemIp - %1$s - Space',
	'UI:IPManagement:Action:ListSpace:IPv4Block:Title_Class_Object' => 'Space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpace' => 'Free [%1$s - %2$s] - %3$s IPs - %4$.2f %%',
	
	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv4Block' => 'Find Space',
	'UI:IPManagement:Action:FindSpace:IPv4Block:PageTitle_Object_Class' => 'TeemIp - %1$s - Find space',
	'UI:IPManagement:Action:FindSpace:IPv4Block:Title_Class_Object' => 'Look for space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:FindSpace:IPv4Block:SizeOfSpace' => 'Size of space to look for :',
	'UI:IPManagement:Action:FindSpace:IPv4Block:MaxNumberOfOffers' => 'Maximum number of offers:',
	
	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:PageTitle_Object_Class' => 'TeemIp - %1$s - Find space',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Title_Class_Object' => 'Space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Summary' => '%1$s first /%2$s within block',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsBlock' => 'Create as a child block',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsSubnet' => 'Create as a subnet',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv4Block' => 'Delegate',
	'UI:IPManagement:Action:Delegate:IPv4Block:PageTitle_Object_Class' => 'TeemIp - %1$s - Delegate',
	'UI:IPManagement:Action:Delegate:IPv4Block:Title_Class_Object' => 'Delegate %1$s <span class="hilite">%2$s</span> to child organization',
	'UI:IPManagement:Action:Delegate:IPv4Block:ChildBlock' => 'Child Organization to delegate the Block to:',
	'UI:IPManagement:Action:Delegate:IPv4Block:NoChildOrg' => 'Block\'s organization doesn\'t have any children and therefore, block cannot be delegated!',
	'UI:IPManagement:Action:Delegate:IPv4Block:CannotBeDelegated' => 'Block cannot be delegated: %1$s',
	'UI:IPManagement:Action:Delegate:IPv4Block:Done' => '%1$s <span class="hilite">%2$s</span> has been delegated.',

//
// Management of Subnets
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPSubnet:IpCannotChange' => 'Subnet IP cannot be modified! ',	
	'UI:IPManagement:Action:New:IPSubnet:MaskCannotChange' => 'Subnet Mask cannot be modified!',	
	'UI:IPManagement:Action:New:IPSubnet:IpIncorrect' => 'Subnet IP is not consistant with Mask!',	
	'UI:IPManagement:Action:New:IPSubnet:NotInBlock' => 'Subnet is not contained within selected block!',	
	'UI:IPManagement:Action:New:IPSubnet:Collision0' => 'Subnet already exists!',	
	'UI:IPManagement:Action:New:IPSubnet:Collision1' => 'Subnet collision : subnet IP belongs to an existing subnet!',	
	'UI:IPManagement:Action:New:IPSubnet:Collision2' => 'Subnet collision : broadcast IP belongs to an existing subnet!',	
	'UI:IPManagement:Action:New:IPSubnet:Collision3' => 'Subnet collision : new subnet includes an existing one!',	
	'UI:IPManagement:Action:New:IPSubnet:GatewayOutOfSubnet' => 'Gateway IP is not within the subnet boundaries!',

//
// Management of IPv4 Subnets
//
	// Display details of subnet
	'UI:IPManagement:Action:Details:IPv4Subnet' => 'Details',
	'UI:IPManagement:Action:Details:IPv4Subnet+' => '',

	// Display list of subnets
	'UI:IPManagement:Action:DisplayList:IPv4Subnet' => 'Display List',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet+' => '',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet:PageTitle_Class' => 'IPv4 Subnets',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet:Title_Class' => 'IPv4 Subnets',
	
	// Display tree of subnets
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet' => 'Display Tree',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:PageTitle_Class' => 'IPv4 Subnets',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:Title_Class' => 'IPv4 Subnets',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:OrgName' => 'Organization %1$s',
	
	// Find space action on subnets 
	'UI:IPManagement:Action:FindSpace:IPv4Subnet' => 'Find space',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - Find space',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:Title_Class_Object' => 'Look for IP space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeTooSmall' => 'Subnet is too small to look for space. Please, cancel!',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeOfRange' => 'Size of space to look for :',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:MaxNumberOfOffers' => 'Maximum number of offers :',
	
	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - Find space',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Title_Class_Object' => 'Space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Summary' => '%1$s first free %2$s IPs ranges within subnet',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeTooBig' => 'Requested space doesn\'t fit within subnet. Please, try a lower value.',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:CreateAsRange' => 'Create as an IP range',

	// List IPs action on subnets 
	'UI:IPManagement:Action:ListIps:IPv4Subnet' => 'List & Pick IPs',                                               
	'UI:IPManagement:Action:ListIps:IPv4Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Title_Class_Object' => 'List of IPs within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Subtitle_ListRange' => 'Subnet is too big to list all IPs in a raw. Please, select a range to display:',                                               
	'UI:IPManagement:Action:ListIps:IPv4Subnet:FirstIP' => 'First IP of the list',                                               
	'UI:IPManagement:Action:ListIps:IPv4Subnet:LastIP' => 'Last IP of the list',                                               
	
	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv4Subnet' => 'List & Pick IPs',                                               
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:Title_Class_Object' => 'Partial list of IPs within %1$s: <span class="hilite">%2$s</span>',
 	'UI:IPManagement:Action:DoListIps:IPv4Subnet:CannotBeListed' => 'IPs cannot be listed: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIPOutOfSubnet' => 'First IP is out of subnet!',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:LastIPOutOfSubnet' => 'Last IP is out of subnet!',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// Shrink action on subnets
	'UI:IPManagement:Action:Shrink:IPv4Subnet' => 'Shrink',
	'UI:IPManagement:Action:Shrink:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary' => 'Summary',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s shrink',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Title_Class_Object' => 'Shrink %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:CannotBeShrunk' =>  'Subnet cannot be shrunk: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmall' => 'Subnet is too small to be shrunk!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy' => 'Subnet is too small to be shrunk by %1$s!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeInTheMiddle' => 'Range: <b>%1$s [%2$s - %3$s]</b> sits across new subnet boundaries. Shrink cannot be performed!',	
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeDropped' => 'Range: <b>%1$s [%2$s - %3$s]</b> will be dropped from subnet. Shrink cannot be performed!',	
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Done' => '%1$s <span class="hilite">%2$s</span> has been shrunk by %3$s.',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:By' => 'Shrink by :',
	
	// Split action on subnets
	'UI:IPManagement:Action:Split:IPv4Subnet' => 'Split',
	'UI:IPManagement:Action:Split:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary' => 'Summary',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s split',
	'UI:IPManagement:Action:Split:IPv4Subnet:Title_Class_Object' => 'Split %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Split:IPv4Subnet:CannotBeSplit' =>  'Subnet cannot be split: %1$s',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmall' => 'Subnet is too small to be split!',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy' => 'Subnet is too small to be split by %1$s!',
	'UI:IPManagement:Action:Split:IPv4Subnet:IPRangeInTheMiddle' => 'Range: <b>%1$s [%2$s - %3$s]</b> sits across new subnet boundaries. Split cannot be performed!',	
	'UI:IPManagement:Action:Split:IPv4Subnet:Done' => '%1$s <span class="hilite">%2$s</span> has been split in %3$s.',
	'UI:IPManagement:Action:Split:IPv4Subnet:In' => 'Split in :',
	
	// Expand action on subnets
	'UI:IPManagement:Action:Expand:IPv4Subnet' => 'Expand',
	'UI:IPManagement:Action:Expand:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary' => 'Summary',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s expand',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Title_Class_Object' => 'Expand %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Expand:IPv4Subnet:CannotBeExpanded' =>  'Subnet cannot be expanded: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBig' => 'Subnet is too big to be expanded!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy' => 'Subnet is too big to be expanded by %1$s!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:NotInIPBlock' => 'The block hosting the subnet is too small to contain the new expanded subnet!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Done' => '%1$s <span class="hilite">%2$s</span> has been expanded by %3$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:By' => 'Expand by :',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet' => 'CSV Export IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s CSV export IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Title_Class_Object' => 'CSV Export IPs of %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Subtitle_ListRange' => 'Subnet is too big to export all IPs in a raw. Please, select a range to display:',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:FirstIP' => 'First IP of the list',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:LastIP' => 'Last IP of the list',                                               
	
	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet' => 'CSV Export IPs',                                               
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s CSV export IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:Title_Class_Object' => 'Partial CSV Export IPs within %1$s: <span class="hilite">%2$s</span>',
 	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:CannotBeListed' => 'IPs cannot be listed: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIPOutOfSubnet' => 'First IP is out of subnet!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:LastIPOutOfSubnet' => 'Last IP is out of subnet!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv4Subnet' => 'Subnet Calculator',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:PageTitle_Object_Class' => 'TeemIp - %2$s Calculator',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Title_Class_Object' => 'Calculator for %1$s',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:IP' => 'IP Address',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Mask' => 'Mask',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:CIDR' => 'CIDR',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet' => 'Subnet Calculator',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PageTitle_Object_Class' => 'TeemIp - %2$s Calculator',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Title_Class_Object' => '%1$s - Calculator output',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IP' => 'IP Address',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Mask' => 'Mask',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CIDR' => 'CIDR',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:SubnetIP' => 'Subnet IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Wildcard' => 'Wildcard Mask',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:BroadcastIP' => 'Broadcast IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IPNumber' => 'Number of IPs',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:UsableHosts' => 'Number of usable Hosts',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CannotRun' => 'Subnet calculator cannot run: %1$s',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:EnterMaskOrCIDR' => 'Enter a mask or a CIDR!',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongMask' => 'Mask is invalid!',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongCIDR' => 'CIDR is invalid!',

//
// Management of IP ranges
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPRange:NameExist' => 'Name of Range already exists within subnet!',	
	'UI:IPManagement:Action:New:IPRange:Reverted' => 'First IP of Range is higher than last IP!',	
	'UI:IPManagement:Action:New:IPRange:NotInSubnet' => 'IP Range is not contained within selected subnet!',	
	'UI:IPManagement:Action:New:IPRange:Collision0' => 'IP Range already exists!',	
	'UI:IPManagement:Action:New:IPRange:Collision1' => 'Range collision : first IP belongs to an existing range!',	
	'UI:IPManagement:Action:New:IPRange:Collision2' => 'Range collision : last IP belongs to an existing range!',	
	'UI:IPManagement:Action:New:IPRange:Collision3' => 'Range collision : new range includes an existing one!',	

//
// Management of IPv4 ranges
//
	// Display details of IP Range
	'UI:IPManagement:Action:Details:IPv4Range' => 'Details',
	'UI:IPManagement:Action:Details:IPv4Range+' => '',

	// List IPs action on IP Ranges 
	'UI:IPManagement:Action:ListIps:IPv4Range' => 'List & Pick IPs',                                               
	'UI:IPManagement:Action:ListIps:IPv4Range:PageTitle_Object_Class' => 'TeemIp - %1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv4Range:Title_Class_Object' => 'List of IPs within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListIps:IPv4Range:Subtitle_ListRange' => 'Range is too big to list all IPs in a raw. Please, select a sub range to display:',                                               
	'UI:IPManagement:Action:ListIps:IPv4Range:FirstIP' => 'First IP of the list',                                               
	'UI:IPManagement:Action:ListIps:IPv4Range:LastIP' => 'Last IP of the list',                                               
		
	// Do list IPs action on IP Ranges 
	'UI:IPManagement:Action:DoListIps:IPv4Range' => 'List & Pick IPs',                                               
	'UI:IPManagement:Action:DoListIps:IPv4Range:PageTitle_Object_Class' => 'TeemIp - %1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Range:Title_Class_Object' => 'Partial list of IPs within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoListIps:IPv4Range:CannotBeListed' => 'Range cannot be listed: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIPOutOfRange' => 'First IP is out of range!',
	'UI:IPManagement:Action:DoListIps:IPv4Range:LastIPOutOfRange' => 'Last IP is out of range!',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv4Range' => 'CSV Export of IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s CSV export of IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Title_Class_Object' => 'CSV Export IPs of %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Subtitle_ListRange' => 'Range is too big to export all IPs in a raw. Please, select a sub range to export:',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:FirstIP' => 'First IP of the list',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:LastIP' => 'Last IP of the list',                                               
	
	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range' => 'CSV Export IPs',                                               
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s CSV export of IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:Title_Class_Object' => 'Partial CSV Export IPs of %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:CannotBeListed' => 'Range cannot be exported: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIPOutOfRange' => 'First IP is out of range!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:LastIPOutOfRange' => 'Last IP is out of range!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

//
// Management of IPs
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPAddress:IPNameCollision' => 'Short name already exists within domain!',	

	'UI:IPManagement:Action:New:IPAddress:IPCollision' => 'IP already exists!',	
	'UI:IPManagement:Action:New:IPAddress:NotInRange' => 'IP does not belong to IP range!',	
	'UI:IPManagement:Action:New:IPAddress:NotInSubnet' => 'IP does not belong to subnet!',	
	'UI:IPManagement:Action:New:IPAddress:IPPings' => 'IP pings! ',	
	'UI:IPManagement:Action:New:IPAddress:NatIPsAretheSame' => 'IP cannot be NATed to itself! ',
	
//
// Management of Domains
//
	// Creation Management	
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'Domain name already exists!',
		
	// Display list of domains
	'UI:IPManagement:Action:DisplayList:Domain' => 'Display List',
	'UI:IPManagement:Action:DisplayList:Domain+' => '',
	'UI:IPManagement:Action:DisplayList:Domain:PageTitle_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayList:Domain:Title_Class' => 'DNS Domains',
	
	// Display tree of domains
	'UI:IPManagement:Action:DisplayTree:Domain' => 'Display Tree',
	'UI:IPManagement:Action:DisplayTree:Domain+' => '',
	'UI:IPManagement:Action:DisplayTree:Domain:PageTitle_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayTree:Domain:Title_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayTree:Domain:OrgName' => 'Organization %1$s',
	
));
	