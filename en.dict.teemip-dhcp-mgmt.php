<?php
// Copyright (C) 2017 TeemIp
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
 * @copyright   Copyright (C) 2019 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: DHCPOption
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:DHCPOption' => 'DHCP Option',
	'Class:DHCPOption+' => '',
	'Class:DHCPOption/Attribute:name' => 'Name',
	'Class:DHCPOption/Attribute:name+' => '',
	'Class:DHCPOption/Attribute:isc_name' => 'ISC name',
	'Class:DHCPOption/Attribute:isc_name+' => '',
	'Class:DHCPOption/Attribute:code' => 'Code',
	'Class:DHCPOption/Attribute:code+' => '',
	'Class:DHCPOption/Attribute:dhcpv4' => 'DHCPv4',
	'Class:DHCPOption/Attribute:dhcpv4+' => '',
	'Class:DHCPOption/Attribute:dhcpv4/Value:yes' => 'Yes',
	'Class:DHCPOption/Attribute:dhcpv4/Value:no' => 'No',
	'Class:DHCPOption/Attribute:type' => 'Type',
	'Class:DHCPOption/Attribute:type+' => '',
	'Class:DHCPOption/Attribute:description' => 'Description',
	'Class:DHCPOption/Attribute:description+' => '',
	'Class:DHCPOption/Attribute:value' => 'Value',
	'Class:DHCPOption/Attribute:value+' => '',
	'Class:DHCPOption/Attribute:org_id' => 'Organization',
	'Class:DHCPOption/Attribute:org_id+' => '',
	'Class:DHCPOption/Attribute:org_name' => 'Organization name',
	'Class:DHCPOption/Attribute:org_name+' => '',
));

//
// Class: DHCPOptionGlobal
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:DHCPOptionGlobal/Name' => '%1$s',
	'Class:DHCPOptionGlobal' => 'Global DHCP Option',
	'Class:DHCPOptionGlobal+' => 'DHCP option for global scope',
	'DHCPOptionGlobal:General' => 'DHCP Attributes',
	'DHCPOptionGlobal:Scope' => 'Scope',
));

//
// Class: DHCPOptionSharedNetwork
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:DHCPOptionSharedNetwork/Name' => '%1$s',
	'Class:DHCPOptionSharedNetwork' => 'Shared Network DHCP Option',
	'Class:DHCPOptionSharedNetwork+' => 'DHCP option for shared network scope',
	'Class:DHCPOptionSharedNetwork/Attribute:vlan_id' => 'VLAN',
	'Class:DHCPOptionSharedNetwork/Attribute:vlan_id+' => '',
	'Class:DHCPOptionSharedNetwork/Attribute:vlan_tag' => 'VLAN Tag',
	'Class:DHCPOptionSharedNetwork/Attribute:vlan_tag+' => '',
	'DHCPOptionSharedNetwork:General' => 'DHCP Attributes',
	'DHCPOptionSharedNetwork:Scope' => 'Scope',
));

//
// Class: DHCPOptionSubnet
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:DHCPOptionSubnet/Name' => '%1$s',
	'Class:DHCPOptionSubnet' => 'Subnet DHCP Option',
	'Class:DHCPOptionSubnet+' => 'DHCP option for subnet scope',
	'Class:DHCPOptionSubnet/Attribute:ipsubnet_id' => 'Subnet',
	'Class:DHCPOptionSubnet/Attribute:ipsubnet_id+' => '',
	'Class:DHCPOptionSubnet/Attribute:ipsubnet_name' => 'Subnet name',
	'Class:DHCPOptionSubnet/Attribute:ipsubnet_name+' => '',
	'DHCPOptionSubnet:General' => 'DHCP Attributes',
	'DHCPOptionSubnet:Scope' => 'Scope',
));

//
// Class: DHCPOptionPool
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:DHCPOptionPool/Name' => '%1$s',
	'Class:DHCPOptionPool' => 'Pool DHCP Option',
	'Class:DHCPOptionPool+' => 'DHCP option for pool scope',
	'Class:DHCPOptionPool/Attribute:iprange_id' => 'IP Range',
	'Class:DHCPOptionPool/Attribute:iprange_id+' => '',
	'Class:DHCPOptionPool/Attribute:iprange_name' => 'IP Range name',
	'Class:DHCPOptionPool/Attribute:iprange_name+' => '',
	'DHCPOptionPool:General' => 'DHCP Attributes',
	'DHCPOptionPool:Scope' => 'Scope',
));

//
// Class: DHCPOptionClass
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:DHCPOptionClass/Name' => '%1$s',
	'Class:DHCPOptionClass' => 'Class DHCP Option',
	'Class:DHCPOptionClass+' => 'DHCP option for class scope',
	'Class:DHCPOptionClass/Attribute:dhcpclass_id' => 'Class',
	'Class:DHCPOptionClass/Attribute:dhcpclass_id+' => '',
	'Class:DHCPOptionClass/Attribute:dhcpclass_name' => 'DHCP Class name',
	'Class:DHCPOptionClass/Attribute:dhcpclass_name+' => '',
	'DHCPOptionClass:General' => 'DHCP Attributes',
	'DHCPOptionClass:Scope' => 'Scope',
));

//
// Class: DHCPOptionSubClass
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:DHCPOptionSubClass/Name' => '%1$s',
	'Class:DHCPOptionSubClass' => 'SubClass DHCP Option',
	'Class:DHCPOptionSubClass+' => 'DHCP option for sub-class scope',
	'Class:DHCPOptionSubClass/Attribute:dhcpclass_id' => 'Class',
	'Class:DHCPOptionSubClass/Attribute:dhcpclass_id+' => '',
	'Class:DHCPOptionSubClass/Attribute:dhcpclass_name' => 'DHCP Class name',
	'Class:DHCPOptionSubClass/Attribute:dhcpclass_name+' => '',
	'Class:DHCPOptionSubClass/Attribute:dhcpsubclass_id' => 'SubClass',
	'Class:DHCPOptionSubClass/Attribute:dhcpsubclass_id+' => '',
	'Class:DHCPOptionSubClass/Attribute:dhcpsubclass_name' => 'DHCP SubClass name',
	'Class:DHCPOptionSubClass/Attribute:dhcpsubclass_name+' => '',
	'DHCPOptionSubClass:General' => 'Attributs DHCP',
	'DHCPOptionSubClass:Scope' => 'Scope',
));

//
// Class: DHCPOptionHost
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:DHCPOptionHost/Name' => '%1$s',
	'Class:DHCPOptionHost' => 'Host DHCP Option',
	'Class:DHCPOptionHost+' => 'DHCP option for host scope',
	'Class:DHCPOptionHost/Attribute:physicaldevice_id' => 'Host',
	'Class:DHCPOptionHost/Attribute:physicaldevice_id+' => '',
	'Class:DHCPOptionHost/Attribute:physicaldevice_name' => 'Host name',
	'Class:DHCPOptionHost/Attribute:physicaldevice_name+' => '',
	'DHCPOptionHost:General' => 'DHCP Attributes',
	'DHCPOptionHost:Scope' => 'Scope',
));

//
// Class: DHCPClass
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:DHCPClass/Name' => '%1$s',
	'Class:DHCPClass' => 'DHCP Class',
	'Class:DHCPClass+' => '',
));

//
// Class: DHCPSubClass
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:DHCPSubClass/Name' => '%1$s',
	'Class:DHCPSubClass' => 'DHCP SubClass',
	'Class:DHCPSubClass+' => '',
	'Class:DHCPSubClass/Attribute:dhcpclass_id' => 'DHCP Class',
	'Class:DHCPSubClass/Attribute:dhcpclass_id+' => '',
	'Class:DHCPSubClass/Attribute:dhcpclass_name' => 'DHCP Class name',
	'Class:DHCPSubClass/Attribute:dhcpclass_name+' => '',
));

//
// Class: PhysicalDevice
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:PhysicalDevice/Attribute:dhcpoptionhosts_list' => 'DHCP Options',
	'Class:PhysicalDevice/Attribute:dhcpoptionhosts_list+' => '',
	'Class:PhysicalDevice/Tab:dhcpoptionhosts_list' => 'DHCP Options',
	'Class:PhysicalDevice/Tab:dhcpoptionhosts_list+' => 'List of all DHCP options attached to the Physical Device',
));

//
// Management of options
//
Dict::Add('EN US', 'English', 'English', array(
	'Menu:DHCPManagement' => 'DHCP Management',
	'Menu:DHCPSpace' => 'DHCP Space',
	'Menu:NewDHCPOption' => 'New DHCP Option',
	'Menu:SearchDHCPOption' => 'Search for DHCP Options',
	'Menu:SearchDHCPOption+' => 'Search for DHCP options',
	'Menu:DHCPShortcut' => 'DHCP Shortcuts',
	'Menu:DHCPGlobalOption' => 'Global Options',
	'Menu:DHCPGlobalOption+' => 'DHCP Global options',
	'Menu:DHCPSharedNetworkOption' => 'Shared Network Options',
	'Menu:DHCPSharedNetworkOption+' => 'DHCP Shared Network options',
	'Menu:DHCPSubnetOption' => 'Subnet Options',
	'Menu:DHCPSubnetOption+' => 'DHCP Subnet options',
	'Menu:DHCPPoolOption' => 'Pool Options',
	'Menu:DHCPPoolOption+' => 'DHCP Pool options',
	'Menu:DHCPClassOption' => 'Class Options',
	'Menu:DHCPClassOption+' => 'DHCP Class options',
	'Menu:DHCPSubClassOption' => 'SubClass Options',
	'Menu:DHCPSubClassOption+' => 'DHCP SubClass options',
	'Menu:DHCPHostOption' => 'Host Options',
	'Menu:DHCPHostOption+' => 'DHCP Host options',
));
