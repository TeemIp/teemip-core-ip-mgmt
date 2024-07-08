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

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPObject' => 'IP Object',
	'Class:IPObject+' => '',
	'IPObject:GlobalParams' => 'Global Settings',
	'IPObject:GlobalParams+' => 'Default Global Settings set at the organization level and settings actually used for the object',
	'Class:IPObject:GeneralConfigParameters' => 'Organization settings',
	'Class:IPObject/Attribute:finalclass' => 'Sub-class',
	'Class:IPObject/Attribute:finalclass+' => 'Name of the final class',
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
	'Class:IPObject/Attribute:allocation_date' => 'Allocation date',
	'Class:IPObject/Attribute:allocation_date+' => 'Date when IP object has been allocated',
	'Class:IPObject/Attribute:release_date' => 'Release date',
	'Class:IPObject/Attribute:release_date+' => 'Date when IP object has been released and is not used anymore.',
	'Class:IPObject/Attribute:ipconfig_id' => 'Global IP settings',
	'Class:IPObject/Attribute:ipconfig_id+' => '',
	'Class:IPObject/Attribute:contact_list' => 'Contacts',
	'Class:IPObject/Attribute:contact_list+' => 'Contacts attached to the IP object',
	'Class:IPObject/Attribute:document_list' => 'Documents',
	'Class:IPObject/Attribute:document_list+' => 'Documents attached to the IP object',
));

//
// Class: lnkContactToIPObject
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkContactToIPObject' => 'Link Contact / IP Object',
	'Class:lnkContactToIPObject+' => '',
	'Class:lnkContactToIPObject/Name' => '%1$s / %2$s',
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

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkDocToIPObject' => 'Link Document / IP Object',
	'Class:lnkDocToIPObject+' => '',
	'Class:lnkDocToIPObject/Name' => '%1$s / %2$s',
	'Class:lnkDocToIPObject/Attribute:ipobject_id' => 'IP Object',
	'Class:lnkDocToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_id' => 'Document',
	'Class:lnkDocToIPObject/Attribute:document_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_name' => 'Document name',
	'Class:lnkDocToIPObject/Attribute:document_name+' => '',
));

//
// Class: lnkIPObjectToTicket
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkIPObjectToTicket' => 'Link IP Object / Ticket',
	'Class:lnkIPObjectToTicket+' => '',
	'Class:lnkIPObjectToTicket/Name' => '%1$s / %2$s',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id_finalclass_recall' => 'IP Object Type',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id_finalclass_recall+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id' => 'IP Object',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_id' => 'Ticket',
	'Class:lnkIPObjectToTicket/Attribute:ticket_id+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_ref' => 'Ref',
	'Class:lnkIPObjectToTicket/Attribute:ticket_ref+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_title' => 'Title',
	'Class:lnkIPObjectToTicket/Attribute:ticket_title+' => '',
));

//
// Class: IPBlock
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPBlock' => 'Subnet Block',
	'Class:IPBlock+' => '',
	'Class:IPBlock:baseinfo' => 'General Information',
	'Class:IPBlock:automation' => 'Automation',
	'Class:IPBlock:delegationinfo' => 'Delegation Information',
	'Class:IPBlock:ipinfo' => 'IP Information',
	'Class:IPBlock:DelegatedToChild' => '<delegation_highlight>Delegated to organization: </delegation_highlight>%1$s',
	'Class:IPBlock:DelegatedFromParent' => '<delegation_highlight>Delegated from organization: </delegation_highlight>%1$s',
	'Class:IPBlock:localconfigparameters' => 'Subnet block settings',
	'Class:IPBlock/Attribute:name' => 'Name',
	'Class:IPBlock/Attribute:name+' => '',
	'Class:IPBlock/Attribute:ipblocktype_id' => 'Type',
	'Class:IPBlock/Attribute:ipblocktype_id+' => 'Type of Subnet Block',
	'Class:IPBlock/Attribute:ipblocktype_name' => 'Type name',
	'Class:IPBlock/Attribute:ipblocktype_name+' => '',
	'Class:IPBlock/Attribute:allocation_date' => 'Allocation date',
	'Class:IPBlock/Attribute:allocation_date+' => 'Date when Subnet Block has been allocated',
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
	'Class:IPBlock/Attribute:origin' => 'Origin',
	'Class:IPBlock/Attribute:origin+' => 'Where the block originates from: regional or local internet registry or another organization',
	'Class:IPBlock/Attribute:origin/Value:rir' => 'RIR',
	'Class:IPBlock/Attribute:origin/Value:rir+' => 'Regional Internet registry',
	'Class:IPBlock/Attribute:origin/Value:lir' => 'LIR',
	'Class:IPBlock/Attribute:origin/Value:lir+' => 'Local Internet registry',
	'Class:IPBlock/Attribute:origin/Value:other' => 'Other',
	'Class:IPBlock/Attribute:origin/Value:other+' => 'IT department...',
	'Class:IPBlock/Attribute:registrar_id' => 'Registrar',
	'Class:IPBlock/Attribute:registrar_id+' => 'Related regional or local internet registry',
	'Class:IPBlock/Attribute:registrar_name' => 'Registrar name',
	'Class:IPBlock/Attribute:registrar_name+' => '',
));

//
// Class extensions for IPBlock
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPBlock/Tab:globalparam' => 'Global Settings',
	'Class:IPBlock/Tab:childblock' => 'Child Blocks',
	'Class:IPBlock/Tab:childblock+' => 'Blocks attached to this block',
	'Class:IPBlock/Tab:childblock/SelectList' => 'Change display',
	'Class:IPBlock/Tab:childblock/SelectList0' => 'Display child blocks only',
	'Class:IPBlock/Tab:childblock/SelectList1' => 'Display the whole child blocks hierarchy',
	'Class:IPBlock/Tab:childblock/List0' => 'Child blocks only',
	'Class:IPBlock/Tab:childblock/List1' => 'Whole child blocks hierarchy',
	'Class:IPBlock/Tab:childblock-count' => 'Child Blocks: %1$s',
	'Class:IPBlock/Tab:childblock-count-percent' => ' Space used by Child Blocks.',
	'Class:IPBlock/Tab:childblock-count-percent-remain' => 'Space used by Child Blocks in remaining space: %1$.1f %%',
	'Class:IPBlock/Tab:subnet' => 'Subnets',
	'Class:IPBlock/Tab:subnet+' => 'Subnets attached to this block',
	'Class:IPBlock/Tab:subnet-count' => 'Subnets: %1$s',
	'Class:IPBlock/Tab:subnet-count-percent' => ' Space used by Subnets',
	'Class:IPBlock/Tab:subnet-count-percent-remain' => 'Space used by Subnets in remaining space: %1$.1f %%',
));

//
// Class: lnkBlockToLocation
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkIPBlockToLocation' => 'Link Block / Location',
	'Class:lnkIPBlockToLocation+' => '',
	'Class:lnkIPBlockToLocation/Name' => '%1$s / %2$s',
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

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPv4Block' => 'IPv4 Subnet Block',
	'Class:IPv4Block+' => '',
	'Class:IPv4Block/ComplementaryName' => '%1$s - %2$s',
	'Class:IPv4Block/Attribute:parent_id' => 'Parent block',
	'Class:IPv4Block/Attribute:parent_id+' => '',
	'Class:IPv4Block/Attribute:parent_name' => 'Parent block name',
	'Class:IPv4Block/Attribute:parent_name+' => '',
	'Class:IPv4Block/Attribute:parent_origin' => 'Parent block origin',
	'Class:IPv4Block/Attribute:parent_origin+' => '',
	'Class:IPv4Block/Attribute:firstip' => 'First IP',
	'Class:IPv4Block/Attribute:firstip+' => 'First IP Address of Subnet Block',
	'Class:IPv4Block/Attribute:lastip' => 'Last IP',
	'Class:IPv4Block/Attribute:lastip+' => 'Last IP Address of Subnet Block',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_min_size' => 'Minimum size of IPv4 Subnet Blocks',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_min_size+' => '',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_cidr_aligned' => 'Align IPv4 Subnet Blocks to CIDR',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_cidr_aligned+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_min_size' => 'Minimum size',
	'Class:IPv4Block/Attribute:ipv4_block_min_size+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned' => 'Align block to CIDR',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:default' => 'Aligned with global IP settings',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:bca_no' => 'Force to No',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:bca_yes' => 'Force to Yes',
));

//
// Class: IPSubnet
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPSubnet' => 'Subnet',
	'Class:IPSubnet+' => '',
	'Class:IPSubnet:baseinfo' => 'General Information',
	'Class:IPSubnet:ipinfo' => 'IP Information',
	'Class:IPSubnet:automation' => 'Automation',
	'Class:IPSubnet:localconfigparameters' => 'Subnet settings',
	'Class:IPSubnet/ComplementaryName' => '%1$s - %2$s',
	'Class:IPSubnet/Attribute:name' => 'Name',
	'Class:IPSubnet/Attribute:name+' => '',
	'Class:IPSubnet/Attribute:type' => 'Type',
	'Class:IPSubnet/Attribute:type+' => '',
	'Class:IPSubnet/Attribute:allocation_date' => 'Allocation date',
	'Class:IPSubnet/Attribute:allocation_date+' => 'Date when Subnet has been allocated',
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
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips' => 'Reserve Subnet, Gateway and Broadcast IPs at Subnet Creation',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips+' => '',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips/Value:reserve_no' => 'No',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips/Value:reserve_yes' => 'Yes',
	'Class:IPSubnet/Attribute:reserve_subnet_ips' => 'Reserve subnet, gateway and broadcast IPs',
	'Class:IPSubnet/Attribute:reserve_subnet_ips+' => 'Define the policy for the subnet, gateway and broadcast IPs reservation',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:default' => 'Aligned with global IP settings',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:reserve_no' => 'Force to no',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:reserve_yes' => 'Force to yes',
	'Class:IPSubnet/Attribute:subnets_list' => 'NAT Subnets',
	'Class:IPSubnet/Attribute:subnets_list+' => 'List of NAT subnets',
	'Class:IPSubnet/Attribute:vlans_list' => 'VLANs',
	'Class:IPSubnet/Attribute:vlans_list+' => 'List of VLANs that the subnet belong to',
	'Class:IPSubnet/Attribute:vrfs_list' => 'VRFs',
	'Class:IPSubnet/Attribute:vrfs_list+' => 'List of VRFs that the subnet belong to',
	'Class:IPSubnet/Attribute:location_list' => 'Locations',
	'Class:IPSubnet/Attribute:location_list+' => 'Locations where the Subnet expands',
	'Class:IPSubnet/Attribute:summary/cell0' => 'Registered IPs by status',
	'Class:IPSubnet/Attribute:summary/cell0+' => 'Total: %1$s',
));

//
// Class extensions for IPSubnet
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPSubnet/Tab:globalparam' => 'Global Settings',
	'Class:IPSubnet/Tab:ipregistered' => 'Registered IPs',
	'Class:IPSubnet/Tab:ipregistered+' => 'IPs registered in the Subnet',
	'Class:IPSubnet/Tab:ipregistered-count' => ' - %1$s Reserved, %2$s Allocated, %3$s Released, %4$s Unassigned out of %5$s',
	'Class:IPSubnet/Tab:ipfree-explain' => 'List of first %1$s free IP addresses:',
	'Class:IPSubnet/Tab:ipfree-explainbis' => 'List of ALL free IP addresses:',
	'Class:IPSubnet/Tab:iprange' => 'IP Ranges',
	'Class:IPSubnet/Tab:iprange+' => 'IP Ranges part of the subnet',
	'Class:IPSubnet/Tab:iprange-count-percent' => ' space used by IP Ranges.',
	'Class:IPSubnet/Tab:notifications' => 'Notifications',
	'Class:IPSubnet/Tab:notifications+' => 'Notifications related to this subnet',
	'Class:IPSubnet/Tab:requests' => 'IP Requests',
	'Class:IPSubnet/Tab:requests+' => 'IP Requests related to this subnet',
	'Class:IPSubnet/Tab:changes' => 'IP Changes',
	'Class:IPSubnet/Tab:changes+' => 'IP Changes related to this subnet',
));

//
// Class: lnkIPSubnetToIPSubnet
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkIPSubnetToIPSubnet' => 'Link Subnet / NAT Subnet',
	'Class:lnkIPSubnetToIPSubnet+' => '',
	'Class:lnkIPSubnetToIPSubnet/Name' => '%1$s / %2$s',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall' => 'Subnet Type',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id' => 'Subnet',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id+' => 'Subnet to be translated',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id' => 'NAT Subnet',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id+' => 'Translated subnet',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name' => 'Name',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name+' => 'Subnet\'s name',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name' => 'Name',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name+' => 'Subnet\'s name',
));

//
// Class: lnkIPSubnetToVLAN
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkIPSubnetToVLAN' => 'Link Subnet / VLAN',
	'Class:lnkIPSubnetToVLAN+' => '',
	'Class:lnkIPSubnetToVLAN/Name' => '%1$s / %2$s',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall' => 'Subnet Type',
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
// Class: lnkIPSubnetToVRF
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkIPSubnetToVRF' => 'Link Subnet / VRF',
	'Class:lnkIPSubnetToVRF+' => '',
	'Class:lnkIPSubnetToVRF/Name' => '%1$s / %2$s',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall' => 'Subnet Type',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id' => 'Subnet',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name' => 'Subnet name',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id+' => '',
));

//
// Class: lnkIPSubnetToLocation
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkIPSubnetToLocation' => 'Link Subnet / Location',
	'Class:lnkIPSubnetToLocation+' => '',
	'Class:lnkIPSubnetToLocation/Name' => '%1$s / %2$s',
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

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPv4Subnet' => 'IPv4 Subnet',
	'Class:IPv4Subnet+' => '',
	'Class:IPv4Subnet/ComplementaryName' => '%1$s - %2$s - %3$s',
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
	'Class:IPv4Subnet/Attribute:gatewayip' => 'Gateway IP',
	'Class:IPv4Subnet/Attribute:gatewayip+' => '',
	'Class:IPv4Subnet/Attribute:broadcastip' => 'Broadcast IP',
	'Class:IPv4Subnet/Attribute:broadcastip+' => '',
	'Class:IPv4Subnet/Attribute:summary' => 'Summary',
	'Class:IPv4Subnet/Attribute:ipconfig_ipv4_gateway_ip_format' => 'Default Gateway IP format',
	'Class:IPv4Subnet/Attribute:ipconfig_ipv4_gateway_ip_format+' => '',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format' => 'Gateway IP format',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format+' => '',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:default' => 'Aligned with global IP settings',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1' => 'Force to subnet IP + 1',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1' => 'Force to broadcast IP - 1',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:free_setup' => 'Force to free allocation',
));

//
// Class: IPRange
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPRange' => 'IP Range',
	'Class:IPRange+' => '',
	'Class:IPRange:baseinfo' => 'General Information',
	'Class:IPRange:ipinfo' => 'IP Information',
	'Class:IPRange/Attribute:range' => 'Name',
	'Class:IPRange/Attribute:range+' => '',
	'Class:IPRange/Attribute:usage_id' => 'Usage',
	'Class:IPRange/Attribute:usage_id+' => 'Usage being made of the range',
	'Class:IPRange/Attribute:usage_name' => 'Usage Name',
	'Class:IPRange/Attribute:usage_name+' => '',
	'Class:IPRange/Attribute:allocation_date' => 'Allocation date',
	'Class:IPRange/Attribute:allocation_date+' => 'Date when IP range has been allocated',
	'Class:IPRange/Attribute:dhcp' => 'DHCP Range',
	'Class:IPRange/Attribute:dhcp+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no' => 'No',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes' => 'Yes',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes+' => '',
	'Class:IPRange/Attribute:occupancy' => 'Registered IPs',
	'Class:IPRange/Attribute:occupancy+' => '',
	'Class:IPRange/Attribute:functionalcis_list' => 'DHCP Servers',
	'Class:IPRange/Attribute:functionalcis_list+' => 'List of all DHCP servers looking after that DHCP range',
));

//
// Class extensions for IPRange
//                                                       

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPRange/Tab:ipregistered' => 'Registered IPs',
	'Class:IPRange/Tab:ipregistered+' => 'IPs registered within the IP Range',
	'Class:IPRange/Tab:ipregistered-count' => ' - %1$s Reserved, %2$s Allocated, %3$s Released, %4$s Unassigned out of %5$s',
	'Class:IPRange/Tab:ipfree-explain' => 'List of first %1$s free IP addresses:',
	'Class:IPRange/Tab:ipfree-explainbis' => 'List of ALL free IP addresses:',
	'Class:IPRange/Tab:notifications' => 'Notifications',
	'Class:IPRange/Tab:notifications+' => 'Notifications related to this IP range',
));

//
// Class: lnkFunctionalCIToIPRange
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkFunctionalCIToIPRange' => 'Link Functional CI / IP Range',
	'Class:lnkFunctionalCIToIPRange+' => '',
	'Class:lnkFunctionalCIToIPRange/Name' => '%1$s / %2$s',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id_finalclass_recall' => 'IP Range Type',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id_finalclass_recall+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id' => 'IP Range',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_name' => 'IP Range name',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_name+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_id' => 'CI',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_id+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_name' => 'CI name',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_name+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role' => 'Role',
	'Class:lnkFunctionalCIToIPRange/Attribute:role+' => 'Role of the server for the range',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:single' => 'Single',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:single+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:split_scope' => 'Split scope',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:split_scope+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:primary' => 'Primary',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:primary+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:secondary' => 'Secundary',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:secondary+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:active' => 'Active',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:active+' => '',
));

//
// Class: IPv4Range
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPv4Range' => 'IPv4 Range',
	'Class:IPv4Range+' => '',
	'Class:IPv4Range/ComplementaryName' => '%1$s - %2$s',
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

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPAddress' => 'IP Address',
	'Class:IPAddress+' => '',
	'Class:IPAddress:baseinfo' => 'General Information',
	'Class:IPAddress:dnsinfo' => 'DNS Information',
	'Class:IPAddress:ipinfo' => 'IP Information',
	'Class:IPAddress:localconfigparameters' => 'IP settings',
	'Class:IPAddress/ComplementaryName' => '%1$s - %2$s',
	'Class:IPAddress/Attribute:short_name' => 'Short Name',
	'Class:IPAddress/Attribute:short_name+' => 'Left label of the FQDN',
	'Class:IPAddress/Attribute:domain_id' => 'DNS Domain',
	'Class:IPAddress/Attribute:domain_id+' => '',
	'Class:IPAddress/Attribute:domain_name' => 'Domain Name',
	'Class:IPAddress/Attribute:domain_name+' => 'Name of the DNS domain',
	'Class:IPAddress/Attribute:fqdn' => 'FQDN',
	'Class:IPAddress/Attribute:fqdn+' => 'Fully Qualified Domain Name',
	'Class:IPAddress/Attribute:aliases' => 'Aliases',
	'Class:IPAddress/Attribute:aliases+' => 'List of aliases used for the FQDN',
	'Class:IPAddress/Attribute:usage_id' => 'Usage',
	'Class:IPAddress/Attribute:usage_id+' => '',
	'Class:IPAddress/Attribute:usage_name' => 'Usage name',
	'Class:IPAddress/Attribute:usage_name+' => '',
	'Class:IPAddress/Attribute:ipinterface_id' => 'IP Interface',
	'Class:IPAddress/Attribute:ipinterface_id+' => '',
	'Class:IPAddress/Attribute:ipinterface_name' => 'IP Interface name',
	'Class:IPAddress/Attribute:ipinterface_name+' => '',
	'Class:IPAddress/Attribute:allocation_date' => 'Allocation date',
	'Class:IPAddress/Attribute:allocation_date+' => 'Date when IP address has been allocated',
	'Class:IPAddress/Attribute:release_date' => 'Release date',
	'Class:IPAddress/Attribute:release_date+' => 'Date when IP address has been released and is not used anymore.',
	'Class:IPAddress/Attribute:ip_list' => 'NAT IPs',
	'Class:IPAddress/Attribute:ip_list+' => 'List of NAT IPs',
	'Class:IPAddress/Attribute:finalclass' => 'Class',
	'Class:IPAddress/Attribute:finalclass+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name' => 'Allow Duplicate Names',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_no' => 'No',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_yes' => 'Yes',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPAddress/Attribute:ipconfig_:ip_allow_duplicate_name/Value:ipdup_dualstack' => 'Dual stack',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_dualstack+' => 'Duplicate are authorized between unique IPv4 and IPv6',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name' => 'Allow Duplicate Names',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:default' => 'Aligned with global IP settings',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_no' => 'No',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_yes' => 'Yes',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack' => 'Dual stack',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack+' => 'Duplicate are authorized between unique IPv4 and IPv6',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign' => 'Ping IP before assigning it',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign+' => '',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_no' => 'No',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_no+' => '',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_yes' => 'Yes',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_yes+' => '',
	'Class:IPAddress/Attribute:ping_before_assign' => 'Ping IP before assigning it',
	'Class:IPAddress/Attribute:ping_before_assign+' => '',
	'Class:IPAddress/Attribute:ping_before_assign/Value:default' => 'Aligned with global IP settings',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_no' => 'No',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_no+' => '',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_yes' => 'Yes',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_yes+' => '',
));

//
// Class extensions for IPAddress
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPAddress/Tab:globalparam' => 'Global Settings',
	'Class:IPAddress/Tab:parents' => 'Parents',
	'Class:IPAddress/Tab:ip_list' => 'NAT IPs',
	'Class:IPAddress/Tab:ip_list+' => 'List of NAT IPs',
	'Class:IPAddress/Tab:ci_list' => 'CIs',
	'Class:IPAddress/Tab:ci_list+' => 'List of CIs pointing to this IP:',
	'Class:IPAddress/Tab:ci_list_class' => '%1$ss',
	'Class:IPAddress/Tab:NoCi' => 'No CI',
	'Class:IPAddress/Tab:NoCi+' => 'No Configuration Item is using this IP',
	'Class:IPAddress/Tab:requests' => 'IP Requests',
	'Class:IPAddress/Tab:requests+' => 'IP requests related to this IP',
	'Class:IPAddress/Tab:norequests' => 'No IP request',
	'Class:IPAddress/Tab:norequests+' => 'No IP requests related to this IP',
	'Class:IPAddress/Tab:changes' => 'IP Changes',
	'Class:IPAddress/Tab:changes+' => 'IP Changes related to this IP',
));

//
// Class: lnkIPAdressToIPAddress
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkIPAdressToIPAddress' => 'Link IP / NAT IPs',
	'Class:lnkIPAdressToIPAddress+' => '',
	'Class:lnkIPAdressToIPAddress/Name' => '%1$s / %2$s',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall' => 'IP Type',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id' => 'IP Address',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id+' => 'IP to be translated',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id' => 'NAT IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id+' => 'Translated IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name' => 'IP Short Name',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name+' => 'Left label of the FQDN',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name' => 'IP Domain Name',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name+' => 'Name of the DNS domain',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name' => 'NAT IP Short Name',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name+' => 'Left label of the FQDN',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name' => 'NAT IP Domain Name',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name+' => 'Name of the DNS domain',
	'Class:lnkIPAdressToIPAddress/Attribute:external_service_port' => 'External service port',
	'Class:lnkIPAdressToIPAddress/Attribute:external_service_port+' => 'External or source port to be used with port forwarding',
	'Class:lnkIPAdressToIPAddress/Attribute:map_to_port' => 'Map to port',
	'Class:lnkIPAdressToIPAddress/Attribute:map_to_port+' => 'Internal or destination port to be used with port forwarding',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol' => 'Protocol',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol+' => 'Authorized protocol(s). Leave empty for all',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:udp' => 'UDP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:tcp' => 'TCP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:both' => 'UDP / TCP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:sctp' => 'SCTP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:icmp' => 'ICMP',
));

//
// Class: lnkIPInterfaceToIPAddress
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkIPInterfaceToIPAddress' => 'Link IP Interface/ IP Address',
	'Class:lnkIPInterfaceToIPAddress+' => '',
	'Class:lnkIPInterfaceToIPAddress/Name' => '%1$s / %2$s',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall' => 'IP Type',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id' => 'IP Interface',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name' => 'IP Interface Name',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id' => 'IP Address',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:usage_id' => 'IP Address usage',
	'Class:lnkIPInterfaceToIPAddress/Attribute:usage_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_org_name' => 'IP Address organization name',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_org_name+' => '',
));

//
// Class: IPv4Address
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPv4Address' => 'IPv4 Address',
	'Class:IPv4Address+' => '',
	'Class:IPv4Address/Attribute:subnet_id' => 'Subnet',
	'Class:IPv4Address/Attribute:subnet_id+' => 'IPv4 Subnet',
    'Class:IPv4Address/Attribute:subnet_ip' => 'Subnet IP',
    'Class:IPv4Address/Attribute:subnet_ip+' => '',
	'Class:IPv4Address/Attribute:range_id' => 'Range',
	'Class:IPv4Address/Attribute:range_id+' => 'IPv4 Range',
	'Class:IPv4Address/Attribute:ip' => 'Address',
	'Class:IPv4Address/Attribute:ip+' => 'IPv4 Address',
));

//
// Class: IPRangeUsage
//

Dict::Add('EN US', 'English', 'English', array(
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
	'Class:IPRangeUsage/Attribute:ipranges_list' => 'IP ranges',
	'Class:IPRangeUsage/Attribute:ipranges_list+' => 'IP ranges with that usage',
));

//
// Class: IPBlockType
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPBlockType' => 'IP Block Type',
	'Class:IPBlockType+' => 'Type of block',
	'Class:IPBlockType/Attribute:name' => 'Name',
	'Class:IPBlockType/Attribute:name+' => '',
	'Class:IPBlockType/Attribute:description' => 'Description',
	'Class:IPBlockType/Attribute:description+' => '',
	'Class:IPBlockType/Attribute:blocks_list' => 'Blocks',
	'Class:IPBlockType/Attribute:blocks_list+' => 'Subnet blocks of that type',
));

//
// Class: IPTriggerOnWaterMark
//

Dict::Add('EN US', 'English', 'English', array(
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

Dict::Add('EN US', 'English', 'English', array(
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

Dict::Add('EN US', 'English', 'English', array(
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
	'Menu:IPv4ShortCut' => 'IPv4 Shortcuts',
	'Menu:IPv4ShortCut+' => 'Shortcut that groups IPv4 objects',
	'Menu:IPv4Block' => 'Subnet Blocks',
	'Menu:IPv4Block+' => 'IPv4 Subnet Blocks',
	'Menu:IPv4Subnet' => 'Subnets',
	'Menu:IPv4Subnet+' => 'IPv4 Subnets',
	'Menu:IPv4Subnet:Allocated' => 'Allocated Subnets',
	'Menu:IPv4Subnet:Allocated+' => 'List of allocated IPv4 Subnets',
	'Menu:IPv4Range' => 'IP Ranges',
	'Menu:IPv4Range+' => 'IPv4 Ranges',
	'Menu:IPv4Address' => 'IP Addresses',
	'Menu:IPv4Address+' => 'IPv4 Addresses',
	'Menu:IPTools' => 'Tools',
	'Menu:IPTools+' => 'Set of IP tools',
	'Menu:FindSpace' => 'Find Space',
	'Menu:FindSpace+' => 'Tool to find and allocate IP space',
	'Menu:SubnetCalculator' => 'Subnet Calculator',
	'Menu:SubnetCalculator+' => 'Tool to calculate subnet parameters from an IP and a mask',
	'Menu:Options' => 'Parameters',
	'Menu:Options+' => 'Parameters',
	'Menu:Domain' => 'Domains',
	'Menu:Domain+' => 'Domain Names',
	'Menu:IPTemplate' => 'Templates IP',
	'Menu:IPTemplate+' => 'Templates IP',
	'Menu:IPMgmt:Typology' => 'IP space typology configuration',
	'Menu:IPMgmt:Typology+' => '',

	'UI:IPMgmtWelcomeOverview:Title' => 'My Dashboard',

	// Menu separator in Action menus
	'UI:IPManagement:Action:MenuSeparator' => '<hr class="menu-separator"/>',
	'UI:IPManagement:Action:Error::WrongActionForClass' => 'This action cannot be applied on that class of object!',

//
// Management of IPBlocks
//
	// Creation Management
	'UI:IPManagement:Action:New:IPBlock:Reverted' => 'First IP of Subnet Block is higher than last IP!',
	'UI:IPManagement:Action:New:IPBlock:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s for organization %2$s!',
	'UI:IPManagement:Action:New:IPBlock:NotCIDRAligned' => 'Block is not CIDR aligned!',
	'UI:IPManagement:Action:New:IPBlock:NotInParent' => 'Subnet Block is not strictly contained within selected parent!',
	'UI:IPManagement:Action:New:IPBlock:NameExist' => 'Name of Subnet Block already exists!',
	'UI:IPManagement:Action:New:IPBlock:Collision0' => 'Subnet Block already exists!',
	'UI:IPManagement:Action:New:IPBlock:Collision1' => 'Subnet Block collision: first IP belongs to an existing block!',
	'UI:IPManagement:Action:New:IPBlock:Collision2' => 'Subnet Block collision: last IP belongs to an existing block!',
	'UI:IPManagement:Action:Modify:IPBlock:ParentIdNull' => 'Child subnets of block %1$s cannot be attached to non existant parent block.',

	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPBlock:Reverted' => 'New first IP of Subnet Block is higher than new last IP!',
	'UI:IPManagement:Action:Shrink:IPBlock:IPOutOfBlock' => 'New IPs are not all within block!',
	'UI:IPManagement:Action:Shrink:IPBlock:NoChange' => 'No change has been required.',
	'UI:IPManagement:Action:Shrink:IPBlock:NotCIDRAligned' => 'Block is not CIDR aligned!',
	'UI:IPManagement:Action:Shrink:IPBlock:BlockAccrossBorder' => 'A child subnet block sits accros new borders!',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetAccrossBorder' => 'A subnet attached to the block sits accros new borders!',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetBecomesOrhpean' => 'Child subnets won\'t have parent block after shrink!',
	'UI:IPManagement:Action:Shrink:IPBlock:Done' => '%1$s %2$s has been shrunk.',

	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPBlock:IPOutOfBlock' => 'Split IP is out of block!',
	'UI:IPManagement:Action:Split:IPBlock:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Split:IPBlock:NotCIDRAligned' => 'Blocks are not CIDR aligned!',
	'UI:IPManagement:Action:Split:IPBlock:BlockAccrossBorder' => 'A child subnet block sits accros new borders!',
	'UI:IPManagement:Action:Split:IPBlock:SubnetAccrossBorder' => 'A subnet attached to the block sits accros new borders!',
	'UI:IPManagement:Action:Split:IPBlock:EmptyNewName' => 'Name of new Subnet Block is empty!',
	'UI:IPManagement:Action:Split:IPBlock:NameExist' => 'Name of new Subnet Block already exists!',
	'UI:IPManagement:Action:Split:IPBlock:Done' => '%1$s %2$s has been split.',

	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPBlock:Reverted' => 'New first IP of Subnet Block is higher than new last IP!',
	'UI:IPManagement:Action:Expand:IPBlock:IPOutOfBlock' => 'New IPs are not all outside of block!',
	'UI:IPManagement:Action:Expand:IPBlock:NoChange' => 'No change has been required.',
	'UI:IPManagement:Action:Expand:IPBlock:NotCIDRAligned' => 'Block is not CIDR aligned!',
	'UI:IPManagement:Action:Expand:IPBlock:BlockBiggerThanParent' => 'The block cannot be bigger than its parent!',
	'UI:IPManagement:Action:Expand:IPBlock:DelegatedBlockAccrossBorder' => 'The block cannot take over a delegated block!',
	'UI:IPManagement:Action:Expand:IPBlock:BlockAccrossBorder' => 'A brother subnet block sits accros new borders!',
	'UI:IPManagement:Action:Expand:IPBlock:SubnetAccrossBorder' => 'A subnet attached to parent block sits accross new borders',
	'UI:IPManagement:Action:Expand:IPBlock:Done' => '%1$s %2$s has been expanded.',

	// Find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPBlock:RequestedSpaceBiggerThanBlockSize' => 'IP address to look space from belongs to subnet block %1$s and the requested space is larger than the size of that block!',
	'UI:IPManagement:Action:DoFindSpace:IPBlock:NoSpaceFound' => 'There is not enough free space within block %1$s to fullfill your request!',
	'IPManagement:Action:DoFindSpace:IPBlock:IPToStartFrom' => 'from IP %1$s',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPBlock:NoChildOrg' => 'Block\'s organization doesn\'t have any children!',
	'UI:IPManagement:Action:Delegate:IPBlock:NoOtherOrg' => 'There is no other organization than block\'s organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:IsDelegated' => 'The block is already delegated!',
	'UI:IPManagement:Action:Delegate:IPBlock:WrongLevelOfOrganization' => 'Delegation change must be done to a sister organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:NoChangeOfOrganization' => 'No change has been required!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocks' => 'Block has children blocks!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnets' => 'Block has children subnets!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithDelegatedBlockFromOtherOrg' => 'There are already some blocks delegated from other organizations in that range!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfTargetOrg' => 'Block conflicts with a block from the target organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfParentOrg' => 'Block conflicts with a block from the parent organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocksInParent' => 'Block has children blocks in parent organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnetsInParent' => 'Block has children subnets in parent organization!',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPBlock:CannotBeUndelegated' => 'Block cannot be undelegated: %1$s',
	'UI:IPManagement:Action:Undelegate:IPBlock:IsNotDelegated' => 'Block is not delegated!',
	'UI:IPManagement:Action:Undelegate:IPBlock:HasChildBlocks' => 'Block has children blocks!',
	'UI:IPManagement:Action:Undelegate:IPBlock:HasChildSubnets' => 'Block has children subnets!',

	// Display pointers to previous and next blocks
	'UI:IPManagement:Action:DisplayPrevious:IPBlock' => 'Previous',
	'UI:IPManagement:Action:DisplayNext:IPBlock' => 'Next',

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
	'UI:IPManagement:Action:Shrink:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s shrink',
	'UI:IPManagement:Action:Shrink:IPv4Block:Title_Class_Object' => 'Shrink %1$s: %2$s',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewFirstIP' => 'New First IP of Block:',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewLastIP' => 'New Last IP of Block:',
	'UI:IPManagement:Action:Shrink:IPv4Block:IsDelegated' => 'This block is delegated and therefore cannot be shrunk!',
	'UI:IPManagement:Action:Shrink:IPv4Block:CannotBeShrunk' => 'Block cannot be shrunk: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Block:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Shrink:IPv4Block:Done' => '%1$s %2$s has been shrunk.',

	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv4Block' => 'Split',
	'UI:IPManagement:Action:Split:IPv4Block+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Split:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s split',
	'UI:IPManagement:Action:Split:IPv4Block:Title_Class_Object' => 'Split %1$s: %2$s',
	'UI:IPManagement:Action:Split:IPv4Block:At' => 'First IP of new Subnet Block:',
	'UI:IPManagement:Action:Split:IPv4Block:NameNewBlock' => 'Name of new Subnet Block:',
	'UI:IPManagement:Action:Split:IPv4Block:IsDelegated' => 'This block is delegated and therefore cannot be split!',
	'UI:IPManagement:Action:Split:IPv4Block:CannotBeSplit' => 'Block cannot be split: %1$s',
	'UI:IPManagement:Action:Split:IPv4Block:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Split:IPv4Block:Done' => '%1$s %2$s has been split.',

	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv4Block' => 'Expand',
	'UI:IPManagement:Action:Expand:IPv4Block+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s expand',
	'UI:IPManagement:Action:Expand:IPv4Block:Title_Class_Object' => 'Expand %1$s: %2$s',
	'UI:IPManagement:Action:Expand:IPv4Block:NewFirstIP' => 'New First IP of Block:',
	'UI:IPManagement:Action:Expand:IPv4Block:NewLastIP' => 'New Last IP of Block:',
	'UI:IPManagement:Action:Expand:IPv4Block:IsDelegated' => 'This block is delegated and therefore cannot be expanded!',
	'UI:IPManagement:Action:Expand:IPv4Block:CannotBeExpanded' => 'Block cannot be expanded: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Block:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Expand:IPv4Block:Done' => '%1$s %2$s has been expanded.',

	// List space action on subnet blocks
	'UI:IPManagement:Action:ListSpace:IPv4Block' => 'List Space',
	'UI:IPManagement:Action:ListSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Space',
	'UI:IPManagement:Action:ListSpace:IPv4Block:Title_Class_Object' => 'Space within %1$s: %2$s',
	'UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpace' => 'Free [%1$s - %2$s] - %3$s IPs - %4$.2f %%',
	'UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpaceNoPercent' => 'Free [%1$s - %2$s] - %3$s IPs',

	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv4Block' => 'Find Space',
	'UI:IPManagement:Action:FindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Find space',
	'UI:IPManagement:Action:FindSpace:IPv4Block:Title_Class_Object' => 'Look for space within %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv4Block:SizeOfSpace' => 'Size of space to look for:',
	'UI:IPManagement:Action:FindSpace:IPv4Block:MaxNumberOfOffers' => 'Maximum number of offers:',

	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv4Block' => 'Found Space',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Find space',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Title_Class_Object' => 'Found space within %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Summary' => '%1$s first /%2$s within ',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsBlock' => 'Create as a child block',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsSubnet' => 'Create as a subnet',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv4Block' => 'Delegate',
	'UI:IPManagement:Action:Delegate:IPv4Block:PageTitle_Object_Class' => '%1$s - Delegate',
	'UI:IPManagement:Action:Delegate:IPv4Block:Title_Class_Object' => 'Delegate %1$s %2$s to organization',
	'UI:IPManagement:Action:Delegate:IPv4Block:ChildBlock' => 'Organization to delegate the Block to:',
	'UI:IPManagement:Action:Delegate:IPv4Block:NoChildOrg' => 'Block\'s organization doesn\'t have any children and therefore, block cannot be delegated!',
	'UI:IPManagement:Action:Delegate:IPv4Block:NoOtherOrg' => 'There is no other organization than block\'s organization!',
	'UI:IPManagement:Action:Delegate:IPv4Block:IsDelegated' => 'The block is already delegated!',
	'UI:IPManagement:Action:Delegate:IPv4Block:CannotBeDelegated' => 'Block cannot be delegated: %1$s',
	'UI:IPManagement:Action:Delegate:IPv4Block:Done' => '%1$s %2$s has been delegated.',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPv4Block:CannotBeUndelegated' => 'Block cannot be undelegated: %1$s',
	'UI:IPManagement:Action:Undelegate:IPv4Block' => 'Un-delegate',
	'UI:IPManagement:Action:Undelegate:IPv4Block:PageTitle_Object_Class' => '%1$s - Un-delegate',
	'UI:IPManagement:Action:Undelegate:IPv4Block:Done' => '%1$s %2$s has been un-delegated.',

//
// Management of Subnets
//
	// Creation Management
	'UI:IPManagement:Action:New:IPSubnet:IpCannotChange' => 'Subnet IP cannot be modified! ',
	'UI:IPManagement:Action:New:IPSubnet:MaskCannotChange' => 'Subnet Mask cannot be modified!',
	'UI:IPManagement:Action:New:IPSubnet:IpIncorrect' => 'Subnet IP is not consistant with Mask!',
	'UI:IPManagement:Action:New:IPSubnet:NotInBlock' => 'Subnet is not contained within selected block!',
	'UI:IPManagement:Action:New:IPSubnet:Collision0' => 'Subnet already exists!',
	'UI:IPManagement:Action:New:IPSubnet:Collision1' => 'Subnet collision: subnet IP belongs to an existing subnet!',
	'UI:IPManagement:Action:New:IPSubnet:Collision2' => 'Subnet collision: broadcast IP belongs to an existing subnet!',
	'UI:IPManagement:Action:New:IPSubnet:Collision3' => 'Subnet collision: new subnet includes an existing one!',
	'UI:IPManagement:Action:New:IPSubnet:GatewayOutOfSubnet' => 'Gateway IP is not within the subnet boundaries!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPSubnet' => 'Subnet Calculator',
	'UI:IPManagement:Action:Calculator:IPSubnet:SelectSubnetType' => 'Select subnet type',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:SelectCreation' => 'You may register the related subnet blocks or subnets:',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CreateSubnet' => 'Create the subnet',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateSubnet:MaskIsToSmall' => 'Mask is too small: subnet cannot be created!',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CreateBlock' => 'Create the subnet block',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateBlock:MaskIsToBig' => 'Mask is too big: subnet block cannot be created!',

	// Display pointers to previous and next Subnets
	'UI:IPManagement:Action:DisplayPrevious:IPSubnet' => 'Previous',
	'UI:IPManagement:Action:DisplayNext:IPSubnet' => 'Next',

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
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - Find space',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:Title_Class_Object' => 'Look for IP space within %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeTooSmall' => 'Subnet is too small to look for space. Please, cancel!',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeOfRange' => 'Size of space to look for:',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:MaxNumberOfOffers' => 'Maximum number of offers:',

	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet' => 'Found Space',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - Find space',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Title_Class_Object' => 'Space within %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Summary' => '%1$s first free %2$s IPs ranges within subnet',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeEmpty' => 'Requested space is null! Please, try a bigger value.',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeTooBig' => 'Requested space doesn\'t fit within subnet! Please, try a lower value.',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:CreateAsRange' => 'Create as an IP range',

	// List IPs action on subnets
	'UI:IPManagement:Action:ListIps:IPv4Subnet' => 'List & Pick IPs',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Title_Class_Object' => 'List of IPs within %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Subtitle_ListRange' => 'Subnet is too big to list all IPs in a raw. Please, select a range to display:',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:FirstIP' => 'First IP of the list',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:LastIP' => 'Last IP of the list',

	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv4Subnet' => 'List & Pick IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:Title_Class_Object' => 'Partial list of IPs within %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:CannotBeListed' => 'IPs cannot be listed: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIPOutOfSubnet' => 'First IP is out of subnet!',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:LastIPOutOfSubnet' => 'Last IP is out of subnet!',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// Shrink action on subnets
	'UI:IPManagement:Action:Shrink:IPv4Subnet' => 'Shrink',
	'UI:IPManagement:Action:Shrink:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary' => 'Summary',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s shrink',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Title_Class_Object' => 'Shrink %1$s: %2$s',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:CannotBeShrunk' => 'Subnet cannot be shrunk: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmall' => 'Subnet is too small to be shrunk!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy' => 'Subnet is too small to be shrunk by %1$s!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeInTheMiddle' => 'Range: <b>%1$s [%2$s - %3$s]</b> sits across new subnet boundaries. Shrink cannot be performed!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeDropped' => 'Range: <b>%1$s [%2$s - %3$s]</b> will be dropped from subnet. Shrink cannot be performed!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Done' => '%1$s %2$s has been shrunk by %3$s.',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:By' => 'Shrink by:',

	// Split action on subnets
	'UI:IPManagement:Action:Split:IPv4Subnet' => 'Split',
	'UI:IPManagement:Action:Split:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary' => 'Summary',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s split',
	'UI:IPManagement:Action:Split:IPv4Subnet:Title_Class_Object' => 'Split %1$s: %2$s',
	'UI:IPManagement:Action:Split:IPv4Subnet:CannotBeSplit' => 'Subnet cannot be split: %1$s',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmall' => 'Subnet is too small to be split!',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy' => 'Subnet is too small to be split by %1$s!',
	'UI:IPManagement:Action:Split:IPv4Subnet:IPRangeInTheMiddle' => 'Range: <b>%1$s [%2$s - %3$s]</b> sits across new subnet boundaries. Split cannot be performed!',
	'UI:IPManagement:Action:Split:IPv4Subnet:Done' => '%1$s %2$s has been split in %3$s.',
	'UI:IPManagement:Action:Split:IPv4Subnet:In' => 'Split in:',

	// Expand action on subnets
	'UI:IPManagement:Action:Expand:IPv4Subnet' => 'Expand',
	'UI:IPManagement:Action:Expand:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary' => 'Summary',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s expand',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Title_Class_Object' => 'Expand %1$s: %2$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:CannotBeExpanded' => 'Subnet cannot be expanded: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBig' => 'Subnet is too big to be expanded!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy' => 'Subnet is too big to be expanded by %1$s!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:NotInIPBlock' => 'The block hosting the subnet is too small to contain the new expanded subnet!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Done' => '%1$s %2$s has been expanded by %3$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:By' => 'Expand by:',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet' => 'CSV Export IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV export IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Title_Class_Object' => 'CSV Export IPs of %1$s: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Subtitle_ListRange' => 'Subnet is too big to export all IPs in a raw. Please, select a range to display:',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:FirstIP' => 'First IP of the list',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:LastIP' => 'Last IP of the list',

	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet' => 'CSV Export IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV export IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:Title_Class_Object' => 'Partial CSV Export IPs within %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:CannotBeListed' => 'IPs cannot be listed: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIPOutOfSubnet' => 'First IP is out of subnet!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:LastIPOutOfSubnet' => 'Last IP is out of subnet!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv4Subnet' => 'Subnet Calculator',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:PageTitle_Object_Class' => '%2$s Calculator',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Title_Class_Object' => 'Calculator for %1$s',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:IP' => 'IP Address',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Mask' => 'Mask',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:CIDR' => 'CIDR',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet' => 'Subnet Calculator',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PageTitle_Object_Class' => '%2$s Calculator',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Title_Class_Object' => '%1$s - Calculator output',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IP' => 'IP Address',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Mask' => 'Mask',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CIDR' => 'CIDR',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:SubnetIP' => 'Subnet IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Wildcard' => 'Wildcard Mask',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:BroadcastIP' => 'Broadcast IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IPNumber' => 'Number of IPs',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:UsableHosts' => 'Number of usable Hosts',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet' => 'Previous Subnet IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet:NA' => 'Not Applicable',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet' => 'Next Subnet IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet:NA' => 'Not Applicable',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CannotRun' => 'Subnet calculator cannot run: %1$s',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:EnterMaskOrCIDR' => 'Enter a mask or a CIDR!',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongMask' => 'Mask is invalid!',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongCIDR' => 'CIDR is invalid!',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:CannotBeExploded' => 'FQDN cannot be exploded into short and domain name',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:PageTitle_Object_Class' => 'Explode FQDN',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:Done' => 'FQDN has been exploded on %1$s %2$s',

//
// Management of IP ranges
//
	// Creation and Update Management
	'UI:IPManagement:Action:New:IPRange:NameExist' => 'Name of Range already exists within subnet!',
	'UI:IPManagement:Action:New:IPRange:Reverted' => 'First IP of Range is higher than last IP!',
	'UI:IPManagement:Action:New:IPRange:NotInSubnet' => 'IP Range is not contained within selected subnet!',
	'UI:IPManagement:Action:New:IPRange:Collision0' => 'IP Range already exists!',
	'UI:IPManagement:Action:New:IPRange:Collision1' => 'Range collision: first IP belongs to an existing range!',
	'UI:IPManagement:Action:New:IPRange:Collision2' => 'Range collision: last IP belongs to an existing range!',
	'UI:IPManagement:Action:New:IPRange:Collision3' => 'Range collision: new range includes an existing one!',
	'UI:IPManagement:Action:Update:IPRange:NonDHCPRangeWithServers' => 'Only DHCP ranges can be linked to DHCP servers!',
	'UI:IPManagement:Action:New:lnkFunctionalCIToIPRange:WrongCIClass' => 'A DHCP server can only be of Server or Virtual Machine class!',

	// Display pointers to previous and next Ranges
	'UI:IPManagement:Action:DisplayPrevious:IPRange' => 'Previous',
	'UI:IPManagement:Action:DisplayNext:IPRange' => 'Next',

//
// Management of IPv4 ranges
//
	// Display details of IP Range
	'UI:IPManagement:Action:Details:IPv4Range' => 'Details',
	'UI:IPManagement:Action:Details:IPv4Range+' => '',

	// List IPs action on IP Ranges
	'UI:IPManagement:Action:ListIps:IPv4Range' => 'List & Pick IPs',
	'UI:IPManagement:Action:ListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv4Range:Title_Class_Object' => 'List of IPs within %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv4Range:Subtitle_ListRange' => 'Range is too big to list all IPs in a raw. Please, select a sub range to display:',
	'UI:IPManagement:Action:ListIps:IPv4Range:FirstIP' => 'First IP of the list',
	'UI:IPManagement:Action:ListIps:IPv4Range:LastIP' => 'Last IP of the list',

	// Do list IPs action on IP Ranges
	'UI:IPManagement:Action:DoListIps:IPv4Range' => 'List & Pick IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Range:Title_Class_Object' => 'Partial list of IPs within %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv4Range:CannotBeListed' => 'Range cannot be listed: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIPOutOfRange' => 'First IP is out of range!',
	'UI:IPManagement:Action:DoListIps:IPv4Range:LastIPOutOfRange' => 'Last IP is out of range!',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv4Range' => 'CSV Export of IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s CSV export of IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Title_Class_Object' => 'CSV Export IPs of %1$s: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Subtitle_ListRange' => 'Range is too big to export all IPs in a raw. Please, select a sub range to export:',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:FirstIP' => 'First IP of the list',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:LastIP' => 'Last IP of the list',

	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range' => 'CSV Export IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s CSV export of IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:Title_Class_Object' => 'Partial CSV Export IPs of %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:CannotBeListed' => 'Range cannot be exported: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIPOutOfRange' => 'First IP is out of range!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:LastIPOutOfRange' => 'Last IP is out of range!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:CannotBeExploded' => 'FQDN cannot be exploded into short and domain name',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:PageTitle_Object_Class' => 'Explode FQDN',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:Done' => 'FQDN has been exploded on %1$s %2$s',

//
// Management of IP Addresses
//
	// Creation Management
	'UI:IPManagement:Action:New:IPAddress:IPNameCollision' => 'Short name already exists within domain!',

	'UI:IPManagement:Action:New:IPAddress:IPCollision' => 'IP already exists!',
	'UI:IPManagement:Action:New:IPAddress:NotInRange' => 'IP does not belong to IP range!',
	'UI:IPManagement:Action:New:IPAddress:NotInSubnet' => 'IP does not belong to subnet!',
	'UI:IPManagement:Action:New:IPAddress:IPPings' => 'IP pings! ',
	'UI:IPManagement:Action:New:IPAddress:NatIPsAretheSame' => 'IP cannot be NATed to itself! ',

	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:AllocateIP:IPAddress' => 'Allocate address to CI',
	'UI:IPManagement:Action:UnAllocateIP:IPAddress' => 'Un-allocate address from all CIs',
	'UI:IPManagement:Action:Allocate:IPAddress:Class' => 'Target class',
	'UI:IPManagement:Action:Allocate:IPAddress:CI' => 'Functional CI',
	'UI:IPManagement:Action:Allocate:IPAddress:IPAttribute' => 'IP attribute',
	'UI:IPManagement:Action:Allocate:IPAddress:NoCI' => 'There are no instanciated CIs with IP Address attributes in this organization!',
	'UI:IPManagement:Action:Allocate:IPAddress:CannotAllocateCI' => 'Cannot allocate CI to IP: %1$s',
	'UI:IPManagement:Action:Allocate:IPAddress:CIDoesNotExist' => 'Functional CI does not exist!',
	'UI:IPManagement:Action:Allocate:IPAddress:AttributeIsReadOnly' => 'CI\'s attribute is R/O!',
	'UI:IPManagement:Action:Allocate:IPAddress:AttributeIsSynchronized' => 'CI\'s attribute is slave of a synchronization!',
	'UI:IPManagement:Action:Allocate:IPAddress:FQDNIsConflicting' => 'New FQDN will conflict with duplicate rules defined in configuration',
	'UI:IPManagement:Action:Allocate:IPAddress:IPAlreadyAllocated' => 'Address is already allocated!',
	'UI:IPManagement:Action:Unallocate:IPAddress:CannotBeUnallocated' => 'Address cannot be un-allocated: %1$s',
	'UI:IPManagement:Action:UnAllocate:IPAddress:IPNotAllocated' => 'IP is not allocated!',
	'UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsReadOnly' => 'IP is attached to a CI\'s attribute that is R/O!',
	'UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsSynchronized' => 'IP is attached to a CI\'s attribute that is slave of a synchronization!',

	// List IPs
	'UI:IPManagement:Action:ListIPs:IPAddress:Ping' => 'PING',
	'UI:IPManagement:Action:ListIPs:IPAddress:Scan' => 'SCAN',
	'UI:IPManagement:Action:ListIPs:IPAddress:Nslookup' => 'NSLOOKUP',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPAddress:FQDNAttributeDoesNotExist' => 'Attribute %1$s is not an attribute of IP address!',

	// Display pointers to previous and next IPs
	'UI:IPManagement:Action:DisplayPrevious:IPAddress' => 'Previous',
	'UI:IPManagement:Action:DisplayNext:IPAddress' => 'Next',

//
// Management of IPv4 Addresses
//
	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:Allocate:IPv4Address' => 'Allocate address to CI',
	'UI:IPManagement:Action:Allocate:IPv4Address:PageTitle_Object_Class' => 'Allocate IP',
	'UI:IPManagement:Action:Allocate:IPv4Address:Title_Class_Object' => 'Allocate %1$s %2$s to CI',
	'UI:IPManagement:Action:Allocate:IPv4Address:Done' => '%1$s %2$s has been allocated.',
	'UI:IPManagement:Action:Allocate:IPv4Address:IPAlreadyAllocated' => 'Address is already allocated!',
	'UI:IPManagement:Action:UnAllocate:IPv4Address' => 'Un-allocate address from all CIs',
	'UI:IPManagement:Action:Unallocate:IPv4Address:PageTitle_Object_Class' => 'Un-allocate IP',
	'UI:IPManagement:Action:Unallocate:IPv4Address:Done' => '%1$s %2$s has been unallocated.',
	'UI:IPManagement:Action:UnAllocate:IPv4Address:IPNotAllocated' => 'Address is not allocated!',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:CannotBeExploded' => 'FQDN cannot be exploded into short and domain name',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:PageTitle_Object_Class' => 'Explode FQDN',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:Done' => 'FQDN has been exploded on %1$s %2$s',

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

//
// Generic actions
//
	// Find space action on subnets
	'UI:IPManagement:Action:FindSpace' => 'Find and allocate IP space',
	'UI:IPManagement:Action:FindSpace:Organization' => 'Organization',
	'UI:IPManagement:Action:FindSpace:SpaceType' => 'Space type',
	'UI:IPManagement:Action:FindSpace:IPv4Space' => 'IPv4 Space',
	'UI:IPManagement:Action:FindSpace:IPv6Space' => 'IPv6 Space',
	'UI:IPManagement:Action:FindIPv4Space' => 'Find and allocate IPv4 space',
	'UI:IPManagement:Action:FindIPv6Space' => 'Find and allocate IPv6 space',
	'UI:IPManagement:Action:FindSpace:FirstIP' => 'From IP address:',
	'UI:IPManagement:Action:FindSpace:SpaceSize' => 'Size of space to look for:',
	'UI:IPManagement:Action:FindSpace:MaxNumberOfOffers' => 'Maximum number of offers:',

));
