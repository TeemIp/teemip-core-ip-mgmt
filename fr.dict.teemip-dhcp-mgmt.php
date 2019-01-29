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

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:DHCPOption' => 'Option DHCP',
	'Class:DHCPOption+' => '',
	'Class:DHCPOption/Attribute:name' => 'Nom',
	'Class:DHCPOption/Attribute:name+' => '',
	'Class:DHCPOption/Attribute:isc_name' => 'Nom ISC',
	'Class:DHCPOption/Attribute:isc_name+' => '',
	'Class:DHCPOption/Attribute:code' => 'Code',
	'Class:DHCPOption/Attribute:code+' => '',
	'Class:DHCPOption/Attribute:dhcpv4' => 'DHCPv4',
	'Class:DHCPOption/Attribute:dhcpv4+' => '',
	'Class:DHCPOption/Attribute:dhcpv4/Value:yes' => 'Oui',
	'Class:DHCPOption/Attribute:dhcpv4/Value:no' => 'Non',
	'Class:DHCPOption/Attribute:type' => 'Type',
	'Class:DHCPOption/Attribute:type+' => '',
	'Class:DHCPOption/Attribute:description' => 'Description',
	'Class:DHCPOption/Attribute:description+' => '',
	'Class:DHCPOption/Attribute:value' => 'Valeur',
	'Class:DHCPOption/Attribute:value+' => '',
	'Class:DHCPOption/Attribute:org_id' => 'Organisation',
	'Class:DHCPOption/Attribute:org_id+' => '',
	'Class:DHCPOption/Attribute:org_name' => 'Nom organisation',
	'Class:DHCPOption/Attribute:org_name+' => '',
));

//
// Class: DHCPOptionGlobal
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:DHCPOptionGlobal/Name' => '%1$s',
	'Class:DHCPOptionGlobal' => 'Option DHCP Globale',
	'Class:DHCPOptionGlobal+' => 'Option DHCP pour un scope global',
	'DHCPOptionGlobal:General' => 'Attributs DHCP',
	'DHCPOptionGlobal:Scope' => 'Scope',
));

//
// Class: DHCPOptionSharedNetwork
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:DHCPOptionSharedNetwork/Name' => '%1$s',
	'Class:DHCPOptionSharedNetwork' => 'Option DHCP Shared Network',
	'Class:DHCPOptionSharedNetwork+' => 'Option DHCP pour un scope shared network',
	'Class:DHCPOptionSharedNetwork/Attribute:vlan_id' => 'VLAN',
	'Class:DHCPOptionSharedNetwork/Attribute:vlan_id+' => '',
	'Class:DHCPOptionSharedNetwork/Attribute:vlan_tag' => 'VLAN Tag',
	'Class:DHCPOptionSharedNetwork/Attribute:vlan_tag+' => '',
	'DHCPOptionSharedNetwork:General' => 'Attributs DHCP',
	'DHCPOptionSharedNetwork:Scope' => 'Scope',
));

//
// Class: DHCPOptionSubnet
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:DHCPOptionSubnet/Name' => '%1$s',
	'Class:DHCPOptionSubnet' => 'Option DHCP Subnet',
	'Class:DHCPOptionSubnet+' => 'Option DHCP pour un scope subnet',
	'Class:DHCPOptionSubnet/Attribute:ipsubnet_id' => 'Sous-réseau',
	'Class:DHCPOptionSubnet/Attribute:ipsubnet_id+' => '',
	'Class:DHCPOptionSubnet/Attribute:ipsubnet_name' => 'Nom du sous-réseau',
	'Class:DHCPOptionSubnet/Attribute:ipsubnet_name+' => '',
	'DHCPOptionSubnet:General' => 'Attributs DHCP',
	'DHCPOptionSubnet:Scope' => 'Scope',
));

//
// Class: DHCPOptionPool
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:DHCPOptionPool/Name' => '%1$s',
	'Class:DHCPOptionPool' => 'Option DHCP Pool',
	'Class:DHCPOptionPool+' => 'Option DHCP pour un scope pool',
	'Class:DHCPOptionPool/Attribute:iprange_id' => 'Plage d\'adresses',
	'Class:DHCPOptionPool/Attribute:iprange_id+' => '',
	'Class:DHCPOptionPool/Attribute:iprange_name' => 'Nom de la plage d\'adresses',
	'Class:DHCPOptionPool/Attribute:iprange_name+' => '',
	'DHCPOptionPool:General' => 'Attributs DHCP',
	'DHCPOptionPool:Scope' => 'Scope',
));

//
// Class: DHCPOptionClass
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:DHCPOptionClass/Name' => '%1$s',
	'Class:DHCPOptionClass' => 'Option DHCP Class',
	'Class:DHCPOptionClass+' => 'Option DHCP pour un scope class',
	'Class:DHCPOptionClass/Attribute:dhcpclass_id' => 'Classe',
	'Class:DHCPOptionClass/Attribute:dhcpclass_id+' => '',
	'Class:DHCPOptionClass/Attribute:dhcpclass_name' => 'Nom de la classe DHCP',
	'Class:DHCPOptionClass/Attribute:dhcpclass_name+' => '',
	'DHCPOptionClass:General' => 'Attributs DHCP',
	'DHCPOptionClass:Scope' => 'Scope',
));

//
// Class: DHCPOptionSubClass
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:DHCPOptionSubClass/Name' => '%1$s',
	'Class:DHCPOptionSubClass' => 'Option DHCP SubClass',
	'Class:DHCPOptionSubClass+' => 'Option DHCP pour un scope sub-class',
	'Class:DHCPOptionSubClass/Attribute:dhcpclass_id' => 'Classe',
	'Class:DHCPOptionSubClass/Attribute:dhcpclass_id+' => '',
	'Class:DHCPOptionSubClass/Attribute:dhcpclass_name' => 'Nom de la classe DHCP',
	'Class:DHCPOptionSubClass/Attribute:dhcpclass_name+' => '',
	'Class:DHCPOptionSubClass/Attribute:dhcpsubclass_id' => 'Sous-Classe',
	'Class:DHCPOptionSubClass/Attribute:dhcpsubclass_id+' => '',
	'Class:DHCPOptionSubClass/Attribute:dhcpsubclass_name' => 'Nom de la sous-classe DHCP',
	'Class:DHCPOptionSubClass/Attribute:dhcpsubclass_name+' => '',
	'DHCPOptionSubClass:General' => 'Attributs DHCP',
	'DHCPOptionSubClass:Scope' => 'Scope',
));

//
// Class: DHCPOptionHost
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:DHCPOptionHost/Name' => '%1$s',
	'Class:DHCPOptionHost' => 'Option DHCP Host',
	'Class:DHCPOptionHost+' => 'Option DHCP pour un scope host',
	'Class:DHCPOptionHost/Attribute:physicaldevice_id' => 'Host',
	'Class:DHCPOptionHost/Attribute:physicaldevice_id+' => '',
	'Class:DHCPOptionHost/Attribute:physicaldevice_name' => 'Nom du Host',
	'Class:DHCPOptionHost/Attribute:physicaldevice_name+' => '',
	'DHCPOptionHost:General' => 'Attributs DHCP',
	'DHCPOptionHost:Scope' => 'Scope',
));

//
// Class: DHCPClass
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:DHCPClass/Name' => '%1$s',
	'Class:DHCPClass' => 'DHCP Class',
	'Class:DHCPClass+' => 'Scope DHCP de type Class',
));

//
// Class: DHCPSubClass
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:DHCPSubClass/Name' => '%1$s',
	'Class:DHCPSubClass' => 'DHCP SubClass',
	'Class:DHCPSubClass+' => 'Scope DHCP de type SubClass',
	'Class:DHCPSubClass/Attribute:dhcpclass_id' => 'Class',
	'Class:DHCPSubClass/Attribute:dhcpclass_id+' => '',
	'Class:DHCPSubClass/Attribute:dhcpclass_name' => 'Nom du scope Class',
	'Class:DHCPSubClass/Attribute:dhcpclass_name+' => '',
));

//
// Class: PhysicalDevice
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:PhysicalDevice/Attribute:dhcpoptionhosts_list' => 'Options DHCP',
	'Class:PhysicalDevice/Attribute:dhcpoptionhosts_list+' => '',
	'Class:PhysicalDevice/Tab:dhcpoptionhosts_list' => 'Options DHCP',
	'Class:PhysicalDevice/Tab:dhcpoptionhosts_list+' => 'Liste de toutes les options DHCP de scope Host liées à l\'équipement',
));

//
// Management of options
//
Dict::Add('FR FR', 'French', 'Français', array(
	'Menu:DHCPManagement' => 'Gestion du DHCP',
	'Menu:DHCPSpace' => 'Espace DHCP',
	'Menu:NewDHCPOption' => 'Nouvelle option DHCP',
	'Menu:SearchDHCPOption' => 'Recherche d\'options DHCP',
	'Menu:SearchDHCPOption+' => '',
	'Menu:DHCPShortcut' => 'Raccourcis DHCP',
	'Menu:DHCPGlobalOption' => 'Options Globales',
	'Menu:DHCPGlobalOption+' => 'Options DHCP Globales',
	'Menu:DHCPSharedNetworkOption' => 'Options Shared Network',
	'Menu:DHCPSharedNetworkOption+' => 'Options DHCP Shared Network',
	'Menu:DHCPSubnetOption' => 'Options Sous-réseau',
	'Menu:DHCPSubnetOption+' => 'Options DHCP Sous-réseau',
	'Menu:DHCPPoolOption' => 'Options Pool',
	'Menu:DHCPPoolOption+' => 'Options DHCP Pool',
	'Menu:DHCPClassOption' => 'Options Class',
	'Menu:DHCPClassOption+' => 'Options DHCP Class',
	'Menu:DHCPSubClassOption' => 'Options SubClass',
	'Menu:DHCPSubClassOption+' => 'Options DHCP SubClass',
	'Menu:DHCPHostOption' => 'Options Host',
	'Menu:DHCPHostOption+' => 'Options DHCP Host',
));
