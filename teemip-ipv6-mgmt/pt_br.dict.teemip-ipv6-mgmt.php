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
// Classes in 'teemip-ipv6-mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// Class: IPv6Block
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv6Block' => 'IPv6 Subnet Block',
	'Class:IPv6Block+' => '',
	'Class:IPv6Block/Attribute:parent_id' => 'Parent',
	'Class:IPv6Block/Attribute:parent_id+' => '',
	'Class:IPv6Block/Attribute:parent_name' => 'Parent name',
	'Class:IPv6Block/Attribute:parent_name+' => '',
	'Class:IPv6Block/Attribute:firstip' => 'First IP',
	'Class:IPv6Block/Attribute:firstip+' => 'First IP Address of Subnet Block',
	'Class:IPv6Block/Attribute:lastip' => 'Last IP',
	'Class:IPv6Block/Attribute:lastip+' => 'Last IP Address of Subnet Block',
));

//
// Class: IPv6Subnet
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv6Subnet' => 'IPv6 Subnet',
	'Class:IPv6Subnet+' => '',
	'Class:IPv6Subnet/Attribute:block_id' => 'Subnet Block',
	'Class:IPv6Subnet/Attribute:block_id+' => '',
	'Class:IPv6Subnet/Attribute:block_name' => 'Block name',
	'Class:IPv6Subnet/Attribute:block_name+' => '',
	'Class:IPv6Subnet/Attribute:ip' => 'Subnet IP',
	'Class:IPv6Subnet/Attribute:ip+' => '',
	'Class:IPv6Subnet/Attribute:mask' => 'Mask',
	'Class:IPv6Subnet/Attribute:mask+' => '',
	'Class:IPv6Subnet/Attribute:mask/Value:64' => 'FFFF:FFFF:FFFF:FFFF:: - /64',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:64' => '/64',
	'Class:IPv6Subnet/Attribute:gatewayip' => 'Gateway IP',
	'Class:IPv6Subnet/Attribute:gatewayip+' => '',
	'Class:IPv6Subnet/Attribute:lastip' => 'Last subnet IP',
	'Class:IPv6Subnet/Attribute:lastip+' => '',
));

//
// Class extensions for IPv6Subnet
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv6Subnet/Tab:ipregistered-count' => ' %1$s Reserved and %2$s Allocated',
));

//
// Class: IPv6Range
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv6Range' => 'IPv6 Range',
	'Class:IPv6Range+' => '',
	'Class:IPv6Range/Attribute:subnet_id' => 'Subnet',
	'Class:IPv6Range/Attribute:subnet_id+' => '',
	'Class:IPv6Range/Attribute:subnet_ip' => 'Subnet IP',
	'Class:IPv6Range/Attribute:subnet_ip+' => '',
	'Class:IPv6Range/Attribute:firstip' => 'First IP of Range',
	'Class:IPv6Range/Attribute:firstip+' => '',
	'Class:IPv6Range/Attribute:lastip' => 'Last IP of Range',
	'Class:IPv6Range/Attribute:lastip+' => '',
));

//
// Class: IPv6Address
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv6Address' => 'IPv6 Address',
	'Class:IPv6Address+' => '',
	'Class:IPv6Address/Attribute:subnet_id' => 'Subnet',
	'Class:IPv6Address/Attribute:subnet_id+' => 'IPv6 Subnet',
	'Class:IPv6Address/Attribute:range_id' => 'Range',
	'Class:IPv6Address/Attribute:range_id+' => 'IPv6 Range',
	'Class:IPv6Address/Attribute:ip' => 'Address',
	'Class:IPv6Address/Attribute:ip+' => 'IPv6 Address',
));

//
// Class: IPConfig
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPConfig/Attribute:ipv6_block_min_prefix' => 'Minimum size of IPv6 Subnet Blocks',
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
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned' => 'Align IPv6 Subnet Blocks to CIDR',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes' => 'Yes',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format' => 'IPv6 Gateway IP',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1' => 'Subnet IP + 1',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip' => 'Last subnet IP',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup' => 'Free allocation',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup+' => '',
));

//
// Application Menu
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Menu:IPSpace:IPv6Objects' => 'IPv6 Objects',
	'Menu:IPSpace:IPv6Objects+' => 'IPv6 Objects',
	'Menu:Ipv6ShortCut' => 'IPv6 Shortcuts',
	'Menu:Ipv6ShortCut+' => 'IPv6 Shortcuts',  
	'Menu:IPv6Block' => 'Subnet Blocks',
	'Menu:IPv6Block+' => 'IPv6 Subnet Blocks',
	'Menu:IPv6Subnet' => 'Subnets',
	'Menu:IPv6Subnet+' => 'IPv6 Subnets',
	'Menu:IPv6Subnet:Allocated' => 'Allocated Subnets',
	'Menu:IPv6Subnet:Allocated+' => 'List of allocated IPv6 Subnets',
	'Menu:IPv6Range' => 'IP Ranges',
	'Menu:IPv6Range+' => 'IPv6 Ranges',
	'Menu:IPv6Address' => 'IP Addresses',
	'Menu:IPv6Address+' => 'IPv6 Addresses',

//
// Management of Subnet Blocks
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPv6Block:NotIPv6' => 'IPs are not IPv6 IPs',

	// Display details of subnet blocks
	'UI:IPManagement:Action:Details:IPv6Block' => 'Details',
	'UI:IPManagement:Action:Details:IPv6Block+' => '',
	
	// Display list of subnet blocks
	'UI:IPManagement:Action:DisplayList:IPv6Block' => 'Display List',
	'UI:IPManagement:Action:DisplayList:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Block:PageTitle_Class' => 'IPv6 Subnet Blocks',
	'UI:IPManagement:Action:DisplayList:IPv6Block:Title_Class' => 'IPv6 Subnet Blocks',
	                                       
	// Display tree of subnet blocks
	'UI:IPManagement:Action:DisplayTree:IPv6Block' => 'Display Tree',
	'UI:IPManagement:Action:DisplayTree:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:PageTitle_Class' => 'IPv6 Subnet Blocks',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:Title_Class' => 'IPv6 Subnet Blocks',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:OrgName' => 'Organization %1$s',
	
	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPv6Block' => 'Shrink',
	'UI:IPManagement:Action:Shrink:IPv6Block+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s shrink',
	'UI:IPManagement:Action:Shrink:IPv6Block:Title_Class_Object' => 'Shrink %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewFirstIP' => 'New First IP of Block :',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewLastIP' => 'New Last IP of Block :',            
	'UI:IPManagement:Action:Shrink:IPv6Block:IsDelegated' => 'This block is delegated and therefore cannot be shrunk!',
	'UI:IPManagement:Action:Shrink:IPv6Block:CannotBeShrunk' =>  'Block cannot be shrunk: %1$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:SmallerThanMinSize' => 'Block size cannot be smaller than /%1$s !',
	'UI:IPManagement:Action:Shrink:IPv6Block:Done' => '%1$s <span class="hilite">%2$s</span> has been shrunk.',
	
	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv6Block' => 'Split',
	'UI:IPManagement:Action:Split:IPv6Block+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Split:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s split',
	'UI:IPManagement:Action:Split:IPv6Block:Title_Class_Object' => 'Split %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Split:IPv6Block:At' => 'First IP of new Subnet Block :',
	'UI:IPManagement:Action:Split:IPv6Block:NameNewBlock' => 'Name of new Subnet Block :',
	'UI:IPManagement:Action:Split:IPv6Block:IsDelegated' => 'This block is delegated and therefore cannot be split!',
	'UI:IPManagement:Action:Split:IPv6Block:CannotBeSplit' =>  'Block cannot be split: %1$s',
	'UI:IPManagement:Action:Split:IPv6Block:SmallerThanMinSize' => 'Block size cannot be smaller than /%1$s !',
	'UI:IPManagement:Action:Split:IPv6Block:Done' => '%1$s <span class="hilite">%2$s</span> has been split.',
	
	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv6Block' => 'Expand',
	'UI:IPManagement:Action:Expand:IPv6Block+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s expand',
	'UI:IPManagement:Action:Expand:IPv6Block:Title_Class_Object' => 'Expand %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Expand:IPv6Block:NewFirstIP' => 'New First IP of Block :',
	'UI:IPManagement:Action:Expand:IPv6Block:NewLastIP' => 'New Last IP of Block :',
	'UI:IPManagement:Action:Expand:IPv6Block:IsDelegated' => 'This block is delegated and therefore cannot be expanded!',
	'UI:IPManagement:Action:Expand:IPv6Block:CannotBeExpanded' =>  'Block cannot be expanded: %1$s',
	'UI:IPManagement:Action:Expand:IPv6Block:SmallerThanMinSize' => 'Block size cannot be smaller than /%1$s !',
	'UI:IPManagement:Action:Expand:IPv6Block:Done' => '%1$s <span class="hilite">%2$s</span> has been expanded.',

	// List space action on subnet blocks 
	'UI:IPManagement:Action:ListSpace:IPv6Block' => 'List Space',                                               
	'UI:IPManagement:Action:ListSpace:IPv6Block:PageTitle_Object_Class' => 'TeemIp - %1$s - Space',
	'UI:IPManagement:Action:ListSpace:IPv6Block:Title_Class_Object' => 'Space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpace' => 'Free [%1$s - %2$s] - %3$.2e IPs - %4$.2f %%',
	
	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv6Block' => 'Find Space',
	'UI:IPManagement:Action:FindSpace:IPv6Block:PageTitle_Object_Class' => 'TeemIp - %1$s - Find space',
	'UI:IPManagement:Action:FindSpace:IPv6Block:Title_Class_Object' => 'Look for space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:FindSpace:IPv6Block:SizeOfSpace' => 'Size of space to look for :',
	'UI:IPManagement:Action:FindSpace:IPv6Block:MaxNumberOfOffers' => 'Maximum number of offers :',
	
	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:PageTitle_Object_Class' => 'TeemIp - %1$s - Find space',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Title_Class_Object' => 'Space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Summary' => '%1$s first /%2$s within block',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsBlock' => 'Create as a child block',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsSubnet' => 'Create as a subnet',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv6Block' => 'Delegate',
	'UI:IPManagement:Action:Delegate:IPv6Block:PageTitle_Object_Class' => 'TeemIp - %1$s - Delegate',
	'UI:IPManagement:Action:Delegate:IPv6Block:Title_Class_Object' => 'Delegate %1$s <span class="hilite">%2$s</span> to child organization',
	'UI:IPManagement:Action:Delegate:IPv6Block:ChildBlock' => 'Child Organization to delegate the Block to:',
	'UI:IPManagement:Action:Delegate:IPv6Block:NoChildOrg' => 'Block\'s organization doesn\'t have any children and therefore, block cannot be delegated!',
	'UI:IPManagement:Action:Delegate:IPv6Block:CannotBeDelegated' => 'Block cannot be delegated: %1$s',
	'UI:IPManagement:Action:Delegate:IPv6Block:Done' => '%1$s <span class="hilite">%2$s</span> has been delegated.',

//
// Management of Subnets
//
	// Operations on subnets
	'UI:IPManagement:Action:xxx:IPv6Subnet:OperationNotAllowed' => 'Operation not allowed on IPv6 subnets!',

	// Display details of subnet
	'UI:IPManagement:Action:Details:IPv6Subnet' => 'Details',
	'UI:IPManagement:Action:Details:IPv6Subnet+' => '',

	// Display list of subnets
	'UI:IPManagement:Action:DisplayList:IPv6Subnet' => 'Display List',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:PageTitle_Class' => 'IPv6 Subnets',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:Title_Class' => 'IPv6 Subnets',
	
	// Display tree of subnets
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet' => 'Display Tree',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:PageTitle_Class' => 'IPv6 Subnets',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:Title_Class' => 'IPv6 Subnets',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:OrgName' => 'Organization %1$s',
	
	// Find space action on subnets 
	'UI:IPManagement:Action:FindSpace:IPv6Subnet' => 'Find space',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - Find space',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:Title_Class_Object' => 'Look for IP space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeTooSmall' => 'Subnet is too small to look for space. Please, cancel!',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeOfRange' => 'Size of space to look for :',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:MaxNumberOfOffers' => 'Maximum number of offers :',
	
	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - Find space',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Title_Class_Object' => 'Space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Summary' => '%1$s first free %2$s IPs ranges within subnet',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:RangeTooBig' => 'Requested space doesn\'t fit within subnet. Please, try a lower value.',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:CreateAsRange' => 'Create as an IPv6 range',

	// List IPs action on subnets 
	'UI:IPManagement:Action:ListIps:IPv6Subnet' => 'List & Pick IPs',                                               
	'UI:IPManagement:Action:ListIps:IPv6Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Title_Class_Object' => 'List of IPs within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Subtitle_ListRange' => 'Subnet is too big to list all IPs in a raw. Please, select a range to display:',                                               
	'UI:IPManagement:Action:ListIps:IPv6Subnet:FirstIP' => 'First IP of the list',                                               
	'UI:IPManagement:Action:ListIps:IPv6Subnet:LastIP' => 'Last IP of the list',                                               
	
	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv6Subnet' => 'List & Pick IPs',                                               
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:Title_Class_Object' => 'Partial list of IPs within %1$s: <span class="hilite">%2$s</span>',
 	'UI:IPManagement:Action:DoListIps:IPv6Subnet:CannotBeListed' => 'IPs cannot be listed: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIPOutOfSubnet' => 'First IP is out of subnet',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:LastIPOutOfSubnet' => 'Last IP is out of subnet',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet' => 'CSV Export IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s CSV export IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Title_Class_Object' => 'CSV Export IPs of %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Subtitle_ListRange' => 'Subnet is too big to export all IPs in a raw. Please, select a range to display:',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:FirstIP' => 'First IP of the list',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:LastIP' => 'Last IP of the list',                                               
	
	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet' => 'CSV Export IPs',                                               
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s CSV export IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:Title_Class_Object' => 'Partial CSV Export IPs within %1$s: <span class="hilite">%2$s</span>',
 	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:CannotBeListed' => 'IPs cannot be listed: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIPOutOfSubnet' => 'First IP is out of subnet',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:LastIPOutOfSubnet' => 'Last IP is out of subnet',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv6Subnet' => 'Subnet Calculator',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:PageTitle_Object_Class' => 'TeemIp - %2$s Calculator',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Title_Class_Object' => 'Calculator for %1$s',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:IP' => 'IP Address',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Prefix' => 'Prefix',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet' => 'Subnet Calculator',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PageTitle_Object_Class' => 'TeemIp - %2$s Calculator',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Title_Class_Object' => '%1$s - Calculator output',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CompressedIP' => 'IP Address - Compressed format',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CanonicalIP' => 'IP Address - Canonical format',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Prefix' => 'Prefix',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PrefixMask' => 'Prefix Mask',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NetworkIP' => 'Network IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:LastIP' => 'Last IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:IPNumber' => 'Number of IPs',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CannotRun' => 'Subnet calculator cannot run: %1$s',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:EnterPrefix' => 'Enter a prefix!',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:WrongPrefix' => 'Prefix is invalid!',

//
// Management of IP ranges
//
	// Display details of IP Range
	'UI:IPManagement:Action:Details:IPv6Range' => 'Details',
	'UI:IPManagement:Action:Details:IPv6Range+' => '',

	// List IPs action on IP Ranges 
	'UI:IPManagement:Action:ListIps:IPv6Range' => 'List & Pick IPs',                                               
	'UI:IPManagement:Action:ListIps:IPv6Range:PageTitle_Object_Class' => 'TeemIp - %1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv6Range:Title_Class_Object' => 'IPs within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListIps:IPv6Range:Subtitle_ListRange' => 'Range is too big to list all IPs in a raw. Please, select a subrange to display:',                                               
	'UI:IPManagement:Action:ListIps:IPv6Range:FirstIP' => 'First IP of the list',                                               
	'UI:IPManagement:Action:ListIps:IPv6Range:LastIP' => 'Last IP of the list',                                               
	
	// Do list IPs action on IP Ranges 
	'UI:IPManagement:Action:DoListIps:IPv6Range' => 'List & Pick IPs',                                               
	'UI:IPManagement:Action:DoListIps:IPv6Range:PageTitle_Object_Class' => 'TeemIp - %1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Range:Title_Class_Object' => 'Partial list of IPs within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoListIps:IPv6Range:CannotBeListed' => 'Range cannot be listed: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIPOutOfRange' => 'First IP is out of range',
	'UI:IPManagement:Action:DoListIps:IPv6Range:LastIPOutOfRange' => 'Last IP is out of range',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv6Range' => 'CSV Export of IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s CSV export of IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Title_Class_Object' => 'CSV Export IPs of %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Subtitle_ListRange' => 'Range is too big to export all IPs in a raw. Please, select a sub range to export:',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:FirstIP' => 'First IP of the list',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:LastIP' => 'Last IP of the list',                                               
	
	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range' => 'CSV Export IPs',                                               
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:PageTitle_Object_Class' => 'TeemIp - %1$s - %2$s CSV export of IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:Title_Class_Object' => 'Partial CSV Export IPs of %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:CannotBeListed' => 'Range cannot be exported: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIPOutOfRange' => 'First IP is out of range',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:LastIPOutOfRange' => 'Last IP is out of range',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',
	
));
