<?php
// Copyright (C) 2020 TeemIp
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
 * @copyright   Copyright (C) 2020 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'teemip-ipv6-mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// TeemIp specific attributes
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Core:AttributeIPv6Address' => 'Adresse IPv6',
	'Core:AttributeIPv6Address+' => '',
));

//
// Class: IPv6Block
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPv6Block' => 'Bloc de Sous-réseaux IPv6',
	'Class:IPv6Block+' => '',
	'Class:IPv6Block/Attribute:parent_id' => 'Parent',
	'Class:IPv6Block/Attribute:parent_id+' => '',
	'Class:IPv6Block/Attribute:parent_name' => 'Nom Parent',
	'Class:IPv6Block/Attribute:parent_name+' => '',
	'Class:IPv6Block/Attribute:firstip' => 'Première IP du Bloc',
	'Class:IPv6Block/Attribute:firstip+' => 'Première IP du Bloc de Sous-réseaux',
	'Class:IPv6Block/Attribute:lastip' => 'Dernière IP du Bloc',
	'Class:IPv6Block/Attribute:lastip+' => 'Dernière IP du Bloc de Sous-réseaux',
));
	
//
// Class: IPv6Subnet
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPv6Subnet' => 'Sous-réseau IPv6',
	'Class:IPv6Subnet+' => '',
	'Class:IPv6Subnet/Attribute:block_id' => 'Bloc de Sous-réseaux',
	'Class:IPv6Subnet/Attribute:block_id+' => '',
	'Class:IPv6Subnet/Attribute:block_name' => 'Nom Bloc',
	'Class:IPv6Subnet/Attribute:block_name+' => '',
	'Class:IPv6Subnet/Attribute:ip' => 'IP de Sous-réseau',
	'Class:IPv6Subnet/Attribute:ip+' => '',
	'Class:IPv6Subnet/Attribute:mask' => 'Masque',
	'Class:IPv6Subnet/Attribute:mask+' => '',
	'Class:IPv6Subnet/Attribute:mask/Value:64'  => 'FFFF:FFFF:FFFF:FFFF:: - /64',
	'Class:IPv6Subnet/Attribute:mask/Value:65'  => 'FFFF:FFFF:FFFF:FFFF:8000:: - /65',
	'Class:IPv6Subnet/Attribute:mask/Value:66'  => 'FFFF:FFFF:FFFF:FFFF:C000:: - /66',
	'Class:IPv6Subnet/Attribute:mask/Value:67'  => 'FFFF:FFFF:FFFF:FFFF:E000:: - /67',
	'Class:IPv6Subnet/Attribute:mask/Value:68'  => 'FFFF:FFFF:FFFF:FFFF:F000:: - /68',
	'Class:IPv6Subnet/Attribute:mask/Value:69'  => 'FFFF:FFFF:FFFF:FFFF:F800:: - /69',
	'Class:IPv6Subnet/Attribute:mask/Value:70'  => 'FFFF:FFFF:FFFF:FFFF:FC00:: - /70',
	'Class:IPv6Subnet/Attribute:mask/Value:71'  => 'FFFF:FFFF:FFFF:FFFF:FE00:: - /71',
	'Class:IPv6Subnet/Attribute:mask/Value:72'  => 'FFFF:FFFF:FFFF:FFFF:FF00:: - /72',
	'Class:IPv6Subnet/Attribute:mask/Value:73'  => 'FFFF:FFFF:FFFF:FFFF:FF80:: - /73',
	'Class:IPv6Subnet/Attribute:mask/Value:74'  => 'FFFF:FFFF:FFFF:FFFF:FFC0:: - /74',
	'Class:IPv6Subnet/Attribute:mask/Value:75'  => 'FFFF:FFFF:FFFF:FFFF:FFE0:: - /75',
	'Class:IPv6Subnet/Attribute:mask/Value:76'  => 'FFFF:FFFF:FFFF:FFFF:FFF0:: - /76',
	'Class:IPv6Subnet/Attribute:mask/Value:77'  => 'FFFF:FFFF:FFFF:FFFF:FFF8:: - /77',
	'Class:IPv6Subnet/Attribute:mask/Value:78'  => 'FFFF:FFFF:FFFF:FFFF:FFFC:: - /78',
	'Class:IPv6Subnet/Attribute:mask/Value:79'  => 'FFFF:FFFF:FFFF:FFFF:FFFE:: - /79',
	'Class:IPv6Subnet/Attribute:mask/Value:80'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:: - /80',
	'Class:IPv6Subnet/Attribute:mask/Value:81'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:8000:: - /81',
	'Class:IPv6Subnet/Attribute:mask/Value:82'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:C000:: - /82',
	'Class:IPv6Subnet/Attribute:mask/Value:83'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:E000:: - /83',
	'Class:IPv6Subnet/Attribute:mask/Value:84'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:F000:: - /84',
	'Class:IPv6Subnet/Attribute:mask/Value:85'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:F800:: - /85',
	'Class:IPv6Subnet/Attribute:mask/Value:86'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FC00:: - /86',
	'Class:IPv6Subnet/Attribute:mask/Value:87'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FE00:: - /87',
	'Class:IPv6Subnet/Attribute:mask/Value:88'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FF00:: - /88',
	'Class:IPv6Subnet/Attribute:mask/Value:89'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FF80:: - /89',
	'Class:IPv6Subnet/Attribute:mask/Value:90'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFC0:: - /90',
	'Class:IPv6Subnet/Attribute:mask/Value:91'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFE0:: - /91',
	'Class:IPv6Subnet/Attribute:mask/Value:92'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFF0:: - /92',
	'Class:IPv6Subnet/Attribute:mask/Value:93'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFF8:: - /93',
	'Class:IPv6Subnet/Attribute:mask/Value:94'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFC:: - /94',
	'Class:IPv6Subnet/Attribute:mask/Value:95'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFE:: - /95',
	'Class:IPv6Subnet/Attribute:mask/Value:96'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:: - /96',
	'Class:IPv6Subnet/Attribute:mask/Value:97'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:8000:0 - /97',
	'Class:IPv6Subnet/Attribute:mask/Value:98'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:C000:0 - /98',
	'Class:IPv6Subnet/Attribute:mask/Value:99'  => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:E000:0 - /99',
	'Class:IPv6Subnet/Attribute:mask/Value:100' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:F000:0 - /100',
	'Class:IPv6Subnet/Attribute:mask/Value:101' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:F800:0 - /101',
	'Class:IPv6Subnet/Attribute:mask/Value:102' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FC00:0 - /102',
	'Class:IPv6Subnet/Attribute:mask/Value:103' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FE00:0 - /103',
	'Class:IPv6Subnet/Attribute:mask/Value:104' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FF00:0 - /104',
	'Class:IPv6Subnet/Attribute:mask/Value:105' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FF80:0 - /105',
	'Class:IPv6Subnet/Attribute:mask/Value:106' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFC0:0 - /106',
	'Class:IPv6Subnet/Attribute:mask/Value:107' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFE0:0 - /107',
	'Class:IPv6Subnet/Attribute:mask/Value:108' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFF0:0 - /108',
	'Class:IPv6Subnet/Attribute:mask/Value:109' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFF8:0 - /109',
	'Class:IPv6Subnet/Attribute:mask/Value:110' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFC:0 - /110',
	'Class:IPv6Subnet/Attribute:mask/Value:111' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFE:0 - /111',
	'Class:IPv6Subnet/Attribute:mask/Value:112' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:0 - /112',
	'Class:IPv6Subnet/Attribute:mask/Value:113' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:8000 - /113',
	'Class:IPv6Subnet/Attribute:mask/Value:114' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:C000 - /114',
	'Class:IPv6Subnet/Attribute:mask/Value:115' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:E000 - /115',
	'Class:IPv6Subnet/Attribute:mask/Value:116' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:F000 - /116',
	'Class:IPv6Subnet/Attribute:mask/Value:117' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:F800 - /117',
	'Class:IPv6Subnet/Attribute:mask/Value:118' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FC00 - /118',
	'Class:IPv6Subnet/Attribute:mask/Value:119' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FE00 - /119',
	'Class:IPv6Subnet/Attribute:mask/Value:120' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FF00 - /120',
	'Class:IPv6Subnet/Attribute:mask/Value:121' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FF80 - /121',
	'Class:IPv6Subnet/Attribute:mask/Value:122' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFC0 - /122',
	'Class:IPv6Subnet/Attribute:mask/Value:123' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFE0 - /123',
	'Class:IPv6Subnet/Attribute:mask/Value:124' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFF0 - /124',
	'Class:IPv6Subnet/Attribute:mask/Value:125' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFF8 - /125',
	'Class:IPv6Subnet/Attribute:mask/Value:126' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFC - /126',
	'Class:IPv6Subnet/Attribute:mask/Value:127' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFE - /127',
	'Class:IPv6Subnet/Attribute:mask/Value:128' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF - /128',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:64' => '/64',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:65' => '/65',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:66' => '/66',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:67' => '/67',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:68' => '/68',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:69' => '/69',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:70' => '/70',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:71' => '/71',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:72' => '/72',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:73' => '/73',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:74' => '/74',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:75' => '/75',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:76' => '/76',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:77' => '/77',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:78' => '/78',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:79' => '/79',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:80' => '/80',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:81' => '/81',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:82' => '/82',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:83' => '/83',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:84' => '/84',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:85' => '/85',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:86' => '/86',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:87' => '/87',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:88' => '/88',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:89' => '/89',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:90' => '/90',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:91' => '/91',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:92' => '/92',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:93' => '/93',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:94' => '/94',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:95' => '/95',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:96' => '/96',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:97' => '/97',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:98' => '/98',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:99' => '/99',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:100' => '100/',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:101' => '/101',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:102' => '/102',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:103' => '/103',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:104' => '/104',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:105' => '/105',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:106' => '/106',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:107' => '/107',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:108' => '/108',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:109' => '/109',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:110' => '/110',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:111' => '/111',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:112' => '/112',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:113' => '/113',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:114' => '/114',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:115' => '/115',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:116' => '/116',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:117' => '/117',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:118' => '/118',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:119' => '/119',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:120' => '/120',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:121' => '/121',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:122' => '/122',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:123' => '/123',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:124' => '/124',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:125' => '/125',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:126' => '/126',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:127' => '/127',
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:128' => '/128',
	'Class:IPv6Subnet/Attribute:gatewayip' => 'IP de la passerelle',
	'Class:IPv6Subnet/Attribute:gatewayip+' => '',
	'Class:IPv6Subnet/Attribute:lastip' => 'Dernière IP du sous-réseau',
	'Class:IPv6Subnet/Attribute:lastip+' => '',
));

//
// Class extensions for IPv6Subnet
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPv6Subnet/Tab:ipregistered-count' => '%1$s Réservées, %2$s Allouées, %3$s Libérées et %4$s Non assignées',
));
  
//
// Class: IPv6Range
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPv6Range' => 'Plage d\'Adresses IPv6',
	'Class:IPv6Range+' => '',
	'Class:IPv6Range/Attribute:subnet_id' => 'Sous-réseau',
	'Class:IPv6Range/Attribute:subnet_id+' => '',
	'Class:IPv6Range/Attribute:subnet_ip' => 'IP du Sous-réseau',
	'Class:IPv6Range/Attribute:subnet_ip+' => '',
	'Class:IPv6Range/Attribute:firstip' => 'Première IP de la Plage',
	'Class:IPv6Range/Attribute:firstip+' => '',
	'Class:IPv6Range/Attribute:lastip' => 'Dernière IP de la Plage',
	'Class:IPv6Range/Attribute:lastip+' => '',
));

//
// Class: IPv6Address
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPv6Address' => 'Adresse IPv6',
	'Class:IPv6Address+' => '',
	'Class:IPv6Address/Attribute:subnet_id' => 'Sous-réseau',
	'Class:IPv6Address/Attribute:subnet_id+' => 'Sous-réseau IPv6',
	'Class:IPv6Address/Attribute:range_id' => 'Plage d\'Adresses',
	'Class:IPv6Address/Attribute:range_id+' => 'Plage d\'Adresses IPv6',
	'Class:IPv6Address/Attribute:ip' => 'Adresse',
	'Class:IPv6Address/Attribute:ip+' => 'Adresse IPv6',
));

//
// Class: IPConfig
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPConfig/Attribute:ipv6_block_min_prefix' => 'Taille Minimum des Blocs de Sous-réseaux IPv6',
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
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned' => 'Alignement des Blocs de Sous-réseaux IPv6 sur les blocs CIDR',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no' => 'Non',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes' => 'Oui',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format' => 'IP de la passerelle IPv6',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1' => 'IP de sous-réseau + 1',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip' => 'Dernière IP du sous-réseau',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup' => 'Allocation libre',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup+' => '',
));

//
// Application Menu
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Menu:IPSpace:IPv6Objects' => 'Objets IPv6',
	'Menu:IPSpace:IPv6Objects+' => 'Objets IPv6',
	'Menu:Ipv6ShortCut' => 'Raccourcis IPv6',
	'Menu:Ipv6ShortCut+' => 'Raccourcis IPv6',  
	'Menu:IPv6Block' => 'Blocs de Sous-réseaux',
	'Menu:IPv6Block+' => 'Blocs de Sous-réseaux IPv6',
	'Menu:IPv6Subnet' => 'Sous-réseaux',
	'Menu:IPv6Subnet+' => 'Sous-réseaux IPv6',
	'Menu:IPv6Subnet:Allocated' => 'Sous-réseaux alloués',
	'Menu:IPv6Subnet:Allocated+' => 'Liste des sous-réseaux IPv6 alloués',
	'Menu:IPv6Range' => 'Plages d\'Adresses IP',
	'Menu:IPv6Range+' => 'Plages d\'Adresses IPv6',
	'Menu:IPv6Address' => 'Adresses IP',
	'Menu:IPv6Address+' => 'Adresses IPv6',

//
// Management of Subnet Blocks
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPv6Block:NotIPv6' => 'Ces IPs ne sont pas IPv6',

	// Display details of subnet blocks
	'UI:IPManagement:Action:Details:IPv6Block' => 'Détails',
	'UI:IPManagement:Action:Details:IPv6Block+' => '',
	
	// Display list of subnet blocks
	'UI:IPManagement:Action:DisplayList:IPv6Block' => 'Afficher la Liste',
	'UI:IPManagement:Action:DisplayList:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Block:PageTitle_Class' => 'Blocs de sous-réseaux IPv6',
	'UI:IPManagement:Action:DisplayList:IPv6Block:Title_Class' => 'Blocs de sous-réseaux IPv6',
	                                       
	// Display tree of subnet blocks
	'UI:IPManagement:Action:DisplayTree:IPv6Block' => 'Afficher l\'Arbre',
	'UI:IPManagement:Action:DisplayTree:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:PageTitle_Class' => 'Blocs de sous-réseaux IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:Title_Class' => 'Blocs de sous-réseaux IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:OrgName' => 'Organisation %1$s',
	
	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPv6Block' => 'Réduire',
	'UI:IPManagement:Action:Shrink:IPv6Block+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary' => 'Résumé',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:PageTitle_Object_Class' => 'Réduire %1$s - %2$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:Title_Class_Object' => 'Réduire %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewFirstIP' => 'Nouvelle première IP du Bloc :',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewLastIP' => 'Nouvelle dernière IP du Bloc :',            
	'UI:IPManagement:Action:Shrink:IPv6Block:IsDelegated' => 'Ce bloc est délégué et ne peut donc être réduit !',
	'UI:IPManagement:Action:Shrink:IPv6Block:CannotBeShrunk' =>  'Le bloc ne peut être réduit: %1$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:SmallerThanMinSize' => 'La taille du Bloc ne peut être plus petite que /%1$s !',
	'UI:IPManagement:Action:Shrink:IPv6Block:Done' => '%1$s <span class="hilite">%2$s</span> a été réduit.',
	
	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv6Block' => 'Couper',
	'UI:IPManagement:Action:Split:IPv6Block+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:Summary' => 'Résumé',
	'UI:IPManagement:Action:Split:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:PageTitle_Object_Class' => 'Couper %1$s - %2$s',
	'UI:IPManagement:Action:Split:IPv6Block:Title_Class_Object' => 'Couper %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Split:IPv6Block:At' => 'Première IP du nouveau Bloc de Sous-réseaux :',
	'UI:IPManagement:Action:Split:IPv6Block:NameNewBlock' => 'Nom du nouveau Bloc de Sous-réseaux :',
	'UI:IPManagement:Action:Split:IPv6Block:IsDelegated' => 'Ce bloc est délégué et ne peut donc être coupé !',
	'UI:IPManagement:Action:Split:IPv6Block:CannotBeSplit' =>  'Le Bloc ne peut être coupé: %1$s',
	'UI:IPManagement:Action:Split:IPv6Block:SmallerThanMinSize' => 'La taille du bloc ne peut être inférieure à /%1$s !',
	'UI:IPManagement:Action:Split:IPv6Block:Done' => '%1$s: <span class="hilite">%2$s</span> a été coupé.',	
	
	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv6Block' => 'Etendre',
	'UI:IPManagement:Action:Expand:IPv6Block+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary' => 'Résumé',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:PageTitle_Object_Class' => 'Etendre %1$s - %2$s',
	'UI:IPManagement:Action:Expand:IPv6Block:Title_Class_Object' => 'Etendre %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Expand:IPv6Block:NewFirstIP' => 'Nouvelle première IP du Bloc :',
	'UI:IPManagement:Action:Expand:IPv6Block:NewLastIP' => 'Nouvelle dernière IP du Bloc :',
	'UI:IPManagement:Action:Expand:IPv6Block:IsDelegated' => 'Ce bloc est délégué et ne peut donc être étendu !',
	'UI:IPManagement:Action:Expand:IPv6Block:CannotBeExpanded' =>  'Le bloc ne peut être étendu: %1$s',
	'UI:IPManagement:Action:Expand:IPv6Block:SmallerThanMinSize' => 'La taille du Bloc ne peut être plus petite que %1$s !',
	'UI:IPManagement:Action:Expand:IPv6Block:Done' => '%1$s <span class="hilite">%2$s</span> a été étendu.',

	// List space action on subnet blocks 
	'UI:IPManagement:Action:ListSpace:IPv6Block' => 'Lister l\'espace',                                               
	'UI:IPManagement:Action:ListSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Espace',
	'UI:IPManagement:Action:ListSpace:IPv6Block:Title_Class_Object' => 'Espace dans %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpace' => 'Libre [%1$s - %2$s] - %3$s IPs - %4$.2f %%',
	
	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv6Block' => 'Rechercher de l\'espace',
	'UI:IPManagement:Action:FindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Recherche d\'espace',
	'UI:IPManagement:Action:FindSpace:IPv6Block:Title_Class_Object' => 'Recherche d\'espace IP dans %1$s : <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:FindSpace:IPv6Block:SizeOfSpace' => 'Taille de l\'espace à rechercher :',
	'UI:IPManagement:Action:FindSpace:IPv6Block:MaxNumberOfOffers' => 'Nombre maximum d\'offres :',
	
	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Rechercher de l\'espace',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Title_Class_Object' => 'Espace dans %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Summary' => '%1$s premiers /%2$s dans le bloc',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsBlock' => 'Créer en tant que bloc fils',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsSubnet' => 'Créer en tant que sous-réseau',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv6Block' => 'Déléguer',
	'UI:IPManagement:Action:Delegate:IPv6Block:PageTitle_Object_Class' => '%1$s - Déléguer',
	'UI:IPManagement:Action:Delegate:IPv6Block:Title_Class_Object' => 'Délègue %1$s <span class="hilite">%2$s</span> à l\' organisation fille',
	'UI:IPManagement:Action:Delegate:IPv6Block:ChildBlock' => 'Organisation fille à qui déléguer le bloc :',
	'UI:IPManagement:Action:Delegate:IPv6Block:NoChildOrg' => 'L\'organization dont dépend le bloc n\'a pas de fille. Le bloc ne peut donc être délégué !',
	'UI:IPManagement:Action:Delegate:IPv6Block:CannotBeDelegated' => 'Le bloc ne peut être délégué : %1$s',
	'UI:IPManagement:Action:Delegate:IPv6Block:Done' => '%1$s <span class="hilite">%2$s</span> a été délégué.',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPv6Block' => 'Retirer la délégation',
	'UI:IPManagement:Action:Undelegate:IPv6Block:PageTitle_Object_Class' => '%1$s - Retirer',
	'UI:IPManagement:Action:Undelegate:IPv6Block:Done' => '%1$s <span class="hilite">%2$s</span> a eu sa délégation retirée.',
	
//
// Management of Subnets
//
	// Operations on subnets
	'UI:IPManagement:Action:xxx:IPv6Subnet:OperationNotAllowed' => 'Opération non autorisée sur des sous-réseaux IPv6 !',

	// Display details of subnet
	'UI:IPManagement:Action:Details:IPv6Subnet' => 'Détails',
	'UI:IPManagement:Action:Details:IPv6Subnet+' => '',

	// Display list of subnets
	'UI:IPManagement:Action:DisplayList:IPv6Subnet' => 'Afficher la Liste',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:PageTitle_Class' => 'Sous-réseau IPv6',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:Title_Class' => 'Sous-réseau IPv6',
	
	// Display tree of subnets
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet' => 'Afficher l\'Arbre',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:PageTitle_Class' => 'Sous-réseau IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:Title_Class' => 'Sous-réseau IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:OrgName' => 'Organisation %1$s',
	
	// Find space action on subnets 
	'UI:IPManagement:Action:FindSpace:IPv6Subnet' => 'Recherche d\'Espace',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - Recherche d\'espace',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:Title_Class_Object' => 'Recherche d\'espace IP dans %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeTooSmall' => 'Le Sous-Réseau est trop petit pour y rechercher un espace !',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeOfRange' => 'Taille de l\'espace à rechercher :',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:MaxNumberOfOffers' => 'Nombre maximum d\'offres :',
	
	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - Recherche d\'espace',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Title_Class_Object' => 'Espace dans %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Summary' => '%1$s premières %2$s Plages d\'IPs libres dans le sous-réseau',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:RangeTooBig' => 'L\'espace demandé ne tient pas dans le sous-réseau. Veuillez choisir une taille plus petite.',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:CreateAsRange' => 'Créer en tant que Plage d\'IPs',

	// List IPs action on subnets 
	'UI:IPManagement:Action:ListIps:IPv6Subnet' => 'Lister et allouer IPs',                                               
	'UI:IPManagement:Action:ListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Title_Class_Object' => 'IPs contenues dans le %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Subtitle_ListRange' => 'Le Sous-réseau est trop grand pour lister toutes les IPs en une seule page. Merci de sélectionner une plage à afficher:',                                               
	'UI:IPManagement:Action:ListIps:IPv6Subnet:FirstIP' => 'Première IP de la plage',                                               
	'UI:IPManagement:Action:ListIps:IPv6Subnet:LastIP' => 'Dernière IP de la plage',                                               
	
	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv6Subnet' => 'Lister et allouer IPs',                                               
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:Title_Class_Object' => 'Liste partielle des IPs contenues dans le %1$s: <span class="hilite">%2$s</span>',
 	'UI:IPManagement:Action:DoListIps:IPv6Subnet:CannotBeListed' => 'Les IPs ne peuvent être listées: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIPOutOfSubnet' => 'La première IP est hors du sous-réseau !',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:LastIPOutOfSubnet' => 'La dernière IP est hors du sous-réseau !',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'La première IP de la plage est plus grande que la dernière !',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet' => 'Export CSV des IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s Export CSV des IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Title_Class_Object' => 'Export CSV des IPs pour %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Subtitle_ListRange' => 'Le Sous-réseau est trop grand pour exporter toutes les IPs en une seule page. Merci de sélectionner une plage à exporter:',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:FirstIP' => 'Première IP de la plage',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:LastIP' => 'Dernière IP de la plage',                                               
	
	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet' => 'Export CSV des IPs',                                               
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s Export CSV des IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:Title_Class_Object' => 'Export CSV partiel des IPs pour %1$s: <span class="hilite">%2$s</span>',
 	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:CannotBeListed' => 'Les IPs ne peuvent être listées: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIPOutOfSubnet' => 'La première IP est hors du sous-réseau !',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:LastIPOutOfSubnet' => 'La dernière IP est hors du sous-réseau !',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'La première IP de la plage est plus grande que la dernière !',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv6Subnet' => 'Calculateur de Sous-réseaux',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:PageTitle_Object_Class' => '%2$s Calculateur',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Title_Class_Object' => 'Calculateur pour %1$s',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:IP' => 'Adresse',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Prefix' => 'Préfixe',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet' => 'Calculateur de Sous-réseaux',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PageTitle_Object_Class' => '%2$s Calculateur',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Title_Class_Object' => '%1$s - Résultat du calculateur',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CompressedIP' => 'Adresse IP - Format compressé',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CanonicalIP' => 'Adresse IP - Format canonique',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Prefix' => 'Préfixe',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PrefixMask' => 'Masque Préfixe',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NetworkIP' => 'IP du Sous-réseau',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:LastIP' => 'Dernière IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:IPNumber' => 'Nombre d\'IPs',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet' => 'IP du Sous-réseau précédent',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet:NA' => 'Non Applicable',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet' => 'IP du Sous-réseau suivant',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet:NA' => 'Non Applicable',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CannotRun' => 'Le calculateur de Sous-réseau ne peut tourner: %1$s',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:EnterPrefix' => 'Entrer un préfixe!',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:WrongPrefix' => 'Le préfixe est invalide!',

//
// Management of IP ranges
//
	// Display details of IP Range
	'UI:IPManagement:Action:Details:IPv6Range' => 'Détails',
	'UI:IPManagement:Action:Details:IPv6Range+' => '',

	// List IPs action on IP Ranges 
	'UI:IPManagement:Action:ListIps:IPv6Range' => 'Lister et allouer IPs',                                               
	'UI:IPManagement:Action:ListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv6Range:Title_Class_Object' => 'IPs contenues dans %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListIps:IPv6Range:Subtitle_ListRange' => 'La plage d\'IPs est trop grande pour lister toutes les IPs en une seule page. Merci de sélectionner une sous plage à afficher:',                                               
	'UI:IPManagement:Action:ListIps:IPv6Range:FirstIP' => 'Première IP de la plage',                                               
	'UI:IPManagement:Action:ListIps:IPv6Range:LastIP' => 'Dernière IP de la plage',                                               
	
	// Do list IPs action on IP Ranges 
	'UI:IPManagement:Action:DoListIps:IPv6Range' => 'Lister et allouer IPs',                                               
	'UI:IPManagement:Action:DoListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Range:Title_Class_Object' => 'Liste partielle des IPs contenues dans la %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoListIps:IPv6Range:CannotBeListed' => 'La plage d\'IPs ne peut être listée: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIPOutOfRange' => 'La première IP est hors de la plage !',
	'UI:IPManagement:Action:DoListIps:IPv6Range:LastIPOutOfRange' => 'La dernière IP est hors de la plage !',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIpBiggerThanLastIp' => 'La première IP de la plage est plus grande que la dernière !',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv6Range' => 'Export CSV des IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s export CSV des IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Title_Class_Object' => 'Export CSV des IPs pour %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Subtitle_ListRange' => 'La plage d\'IPs est trop grande pour exporter toutes les IPs en une seule fois. Merci de sélectionner une sous plage à exporter:',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:FirstIP' => 'Première IP de la plage',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:LastIP' => 'Dernière IP de la plage',                                               
	
	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range' => 'Export CSV des IPs',                                               
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s export CSV des IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:Title_Class_Object' => 'Export CSV partiel des IPs pour %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:CannotBeListed' => 'La plage ne peut être exportée: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIPOutOfRange' => 'La première IP est hors de la plage !',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:LastIPOutOfRange' => 'La dernière IP est hors de la plage !',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIpBiggerThanLastIp' => 'La première IP de la plage est plus grande que la dernière !',

//
// Management of IPs
//
	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:Allocate:IPv6Address:PageTitle_Object_Class' => 'Alloue l\'IP',
	'UI:IPManagement:Action:Allocate:IPv6Address:Title_Class_Object' => 'Alloue %1$s <span class="hilite">%2$s</span> au CI',
	'UI:IPManagement:Action:Allocate:IPv6Address:CannotAllocateCI' => 'L\'adresse ne peut pas être allouée au CI: %1$s',
	'UI:IPManagement:Action:Allocate:IPv6Address:Done' => '%1$s <span class="hilite">%2$s</span> a été allouée.',
	'UI:IPManagement:Action:Unallocate:IPv6Address:PageTitle_Object_Class' => 'Désalloue l\'IP',
	'UI:IPManagement:Action:Unallocate:IPv6Address:Done' => '%1$s <span class="hilite">%2$s</span> a été désallouée.',
));
