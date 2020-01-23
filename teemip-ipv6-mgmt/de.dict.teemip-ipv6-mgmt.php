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
 * @copyright   Copyright (C) 2014 ITOMIG GmbH (deutsche Übersetzung)
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'teemip-ipv6-mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// TeemIp specific attributes
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Core:AttributeIPv6Address' => 'IPv6 Adresse',
	'Core:AttributeIPv6Address+' => '',
));

//
// Class: IPv6Block
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPv6Block' => 'IPv6 Subnetz Block',
	'Class:IPv6Block+' => '',
	'Class:IPv6Block/Attribute:parent_id' => 'Parent Block',
	'Class:IPv6Block/Attribute:parent_id+' => '',
	'Class:IPv6Block/Attribute:parent_name' => 'Parent Name',
	'Class:IPv6Block/Attribute:parent_name+' => '',
	'Class:IPv6Block/Attribute:firstip' => 'Erste IP',
	'Class:IPv6Block/Attribute:firstip+' => 'Erste IP Adresse des Subnetz Blocks',
	'Class:IPv6Block/Attribute:lastip' => 'Letzte IP',
	'Class:IPv6Block/Attribute:lastip+' => 'Letzte IP Adresse des Subnetz Blocks',
));

//
// Class: IPv6Subnet
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
    'Class:IPv6Subnet' => 'IPv6 Subnetz',
	'Class:IPv6Subnet+' => '',
	'Class:IPv6Subnet/Attribute:block_id' => 'Subnetz Block',
	'Class:IPv6Subnet/Attribute:block_id+' => '',
	'Class:IPv6Subnet/Attribute:block_name' => 'Block Name',
	'Class:IPv6Subnet/Attribute:block_name+' => '',
	'Class:IPv6Subnet/Attribute:ip' => 'Subnetz IP',
	'Class:IPv6Subnet/Attribute:ip+' => '',
	'Class:IPv6Subnet/Attribute:mask' => 'Maske',
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
	'Class:IPv6Subnet/Attribute:gatewayip' => 'Gateway IP',
	'Class:IPv6Subnet/Attribute:gatewayip+' => '',
	'Class:IPv6Subnet/Attribute:lastip' => 'Letzte IP des Subnetzes',
	'Class:IPv6Subnet/Attribute:lastip+' => '',
));

//
// Class extensions for IPv6Subnet
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPv6Subnet/Tab:ipregistered-count' => ' %1$s Reserviert und %2$s Allokiert',
));

//
// Class: IPv6Range
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPv6Range' => 'IPv6 Bereich',
	'Class:IPv6Range+' => '',
	'Class:IPv6Range/Attribute:subnet_id' => 'Subnetz',
	'Class:IPv6Range/Attribute:subnet_id+' => '',
	'Class:IPv6Range/Attribute:subnet_ip' => 'Subnetz IP',
	'Class:IPv6Range/Attribute:subnet_ip+' => '',
	'Class:IPv6Range/Attribute:firstip' => 'Erste IP des Bereichs',
	'Class:IPv6Range/Attribute:firstip+' => '',
	'Class:IPv6Range/Attribute:lastip' => 'Letze IP des Bereichs',
	'Class:IPv6Range/Attribute:lastip+' => '',
));

//
// Class: IPv6Address
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPv6Address' => 'IPv6 Adresse',
	'Class:IPv6Address+' => '',
	'Class:IPv6Address/Attribute:subnet_id' => 'Subnetz',
	'Class:IPv6Address/Attribute:subnet_id+' => 'IPv6 Subnetz',
	'Class:IPv6Address/Attribute:range_id' => 'Bereich',
	'Class:IPv6Address/Attribute:range_id+' => 'IPv6 Bereich',
	'Class:IPv6Address/Attribute:ip' => 'Adresse',
	'Class:IPv6Address/Attribute:ip+' => 'IPv6 Adresse',
));

//
// Class: IPConfig
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPConfig/Attribute:ipv6_block_min_prefix' => 'Minimale Größe von IPv6 Subnetz Blocks',
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
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned' => 'IPv6 Subnetz Blocks an CIDR ausrichten',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no' => 'Ja',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes' => 'Nein',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format' => 'IPv6 Gateway IP',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1' => 'Subnetz IP + 1',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip' => 'Letzte IP des Subnetzes',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup' => 'Unbelegte Allokierung',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup+' => '',
));

//
// Application Menu
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Menu:IPSpace:IPv6Objects' => 'IPv6 Objekte',
	'Menu:IPSpace:IPv6Objects+' => 'IPv6 Objekte',
	'Menu:Ipv6ShortCut' => 'IPv6 Shortcuts',
	'Menu:Ipv6ShortCut+' => 'IPv6 Shortcuts',  
	'Menu:IPv6Block' => 'Subnetz Blöcke',
	'Menu:IPv6Block+' => 'IPv6 Subnetz Blöcke',
	'Menu:IPv6Subnet' => 'Subnetze',
	'Menu:IPv6Subnet+' => 'IPv6 Subnetz',
	'Menu:IPv6Subnet:Allocated' => 'Allokierte Subnetze',
	'Menu:IPv6Subnet:Allocated+' => 'List der allokierten IPv6 Subnetze',
	'Menu:IPv6Range' => 'IP Bereiche',
	'Menu:IPv6Range+' => 'IPv6 Bereiche',
	'Menu:IPv6Address' => 'IP Adressen',
	'Menu:IPv6Address+' => 'IPv6 Adressen',

//
// Management of Subnet Blocks
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPv6Block:NotIPv6' => 'IPs sind keine IPv6 IPs',

	// Display details of subnet blocks
	'UI:IPManagement:Action:Details:IPv6Block' => 'Details',
	'UI:IPManagement:Action:Details:IPv6Block+' => '',
	
	// Display list of subnet blocks
	'UI:IPManagement:Action:DisplayList:IPv6Block' => 'Liste anzeigen',
	'UI:IPManagement:Action:DisplayList:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Block:PageTitle_Class' => 'IPv6 Subnetz Blöcke',
	'UI:IPManagement:Action:DisplayList:IPv6Block:Title_Class' => 'IPv6 Subnetz Blöcke',
	                                       
	// Display tree of subnet blocks
	'UI:IPManagement:Action:DisplayTree:IPv6Block' => 'Baumstruktur anzeigen',
	'UI:IPManagement:Action:DisplayTree:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:PageTitle_Class' => 'IPv6 Subnetz Blöcke',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:Title_Class' => 'IPv6 Subnetz Blöcke',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:OrgName' => 'Organisation %1$s',
	
	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPv6Block' => 'Verkleinern',
	'UI:IPManagement:Action:Shrink:IPv6Block+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary' => 'Zusammenfassung',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s verkleinern',
	'UI:IPManagement:Action:Shrink:IPv6Block:Title_Class_Object' => 'Shrink %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewFirstIP' => 'Neue erste IP des Blocks:',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewLastIP' => 'Neue Letzte IP des Blocks:',            
	'UI:IPManagement:Action:Shrink:IPv6Block:IsDelegated' => 'Dieser Block wurde delegiert und kann daher nicht verkleinert werden!',
    'UI:IPManagement:Action:Shrink:IPv6Block:CannotBeShrunk' =>  'Block kann nicht verkleinert werden: %1$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:SmallerThanMinSize' => 'Die Blockgröße kann nicht kleiner sein als %1$s!',
	'UI:IPManagement:Action:Shrink:IPv6Block:Done' => '%1$s <span class="hilite">%2$s</span> wurde verkleinert.',
	
	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv6Block' => 'Block teilen',
	'UI:IPManagement:Action:Split:IPv6Block+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:Summary' => 'Zusammenfassung',
	'UI:IPManagement:Action:Split:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s split',
	'UI:IPManagement:Action:Split:IPv6Block:Title_Class_Object' => '%1$s teilen: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Split:IPv6Block:At' => 'Erste IP des neuen Subnetz Blocks:',
	'UI:IPManagement:Action:Split:IPv6Block:NameNewBlock' => 'Name des neuen Subnetz Blocks:',
	'UI:IPManagement:Action:Split:IPv6Block:IsDelegated' => 'Dieser Block wurde delegiert und kann daher nicht geteilt werden!',
	'UI:IPManagement:Action:Split:IPv6Block:CannotBeSplit' =>  'Block kann nicht geteilt werden: %1$s',
	'UI:IPManagement:Action:Split:IPv6Block:SmallerThanMinSize' => 'Blockgröße kann nicht kleiner als %1$s sein!',
	'UI:IPManagement:Action:Split:IPv6Block:Done' => '%1$s <span class="hilite">%2$s</span> wurde geteilt.',
	
	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv6Block' => 'Vergrößern',
	'UI:IPManagement:Action:Expand:IPv6Block+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary' => 'Zusammenfassung',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s vergrößern',
	'UI:IPManagement:Action:Expand:IPv6Block:Title_Class_Object' => '%1$s vergrößern: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Expand:IPv6Block:NewFirstIP' => 'Neue erste IP des Blocks:',
	'UI:IPManagement:Action:Expand:IPv6Block:NewLastIP' => 'Neue letzte IP des Blocks:',
	'UI:IPManagement:Action:Expand:IPv6Block:IsDelegated' => 'Dieser Block wurde delegiert und kann daher nicht vergrößert werden!',	
'UI:IPManagement:Action:Expand:IPv6Block:CannotBeExpanded' =>  'Block kann nicht vergrößert werden: %1$s',
	'UI:IPManagement:Action:Expand:IPv6Block:SmallerThanMinSize' => 'Blockgröße kann nicht kleiner als %1$s sein!',
	'UI:IPManagement:Action:Expand:IPv6Block:Done' => '%1$s <span class="hilite">%2$s</span> wurde vergrößert.',

	// List space action on subnet blocks 
	'UI:IPManagement:Action:ListSpace:IPv6Block' => 'IP Raum auflisten',                                               
	'UI:IPManagement:Action:ListSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - IP Raum',
	'UI:IPManagement:Action:ListSpace:IPv6Block:Title_Class_Object' => 'IP Raum in %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpace' => 'Frei [%1$s - %2$s] - %3$s IPs - %4$.2f %%',
	
	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv6Block' => 'IP Raum finden',
	'UI:IPManagement:Action:FindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - IP Raum finden',
	'UI:IPManagement:Action:FindSpace:IPv6Block:Title_Class_Object' => 'IP Raum suchen in %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:FindSpace:IPv6Block:SizeOfSpace' => 'Größe des benötigten IP Raums:',
	'UI:IPManagement:Action:FindSpace:IPv6Block:MaxNumberOfOffers' => 'Maximal mögliche Anzahl :',
	
	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - IP Raum finden',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Title_Class_Object' => 'IP Raum in den %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Summary' => '%1$s ersten /%2$s im Block',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsBlock' => 'Als Child Block erzeugen',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsSubnet' => 'Als Subnetz erzeugen',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv6Block' => 'Delegieren',
	'UI:IPManagement:Action:Delegate:IPv6Block:PageTitle_Object_Class' => '%1$s - Delegieren',
	'UI:IPManagement:Action:Delegate:IPv6Block:Title_Class_Object' => '%1$s <span class="hilite">%2$s</span> an Child Organisation delegieren',
	'UI:IPManagement:Action:Delegate:IPv6Block:ChildBlock' => 'Child Organisation, an die der Block delegiert werden soll:',
	'UI:IPManagement:Action:Delegate:IPv6Block:NoChildOrg' => 'Die Organisation des Blocks hat keine Children, daher kann der Block nicht delegiert werden!',
	'UI:IPManagement:Action:Delegate:IPv6Block:CannotBeDelegated' => 'Block kann nicht delegiert werden: %1$s',
	'UI:IPManagement:Action:Delegate:IPv6Block:Done' => '%1$s <span class="hilite">%2$s</span> wurde delegiert.',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPv6Block' => 'Delegierung aufheben',
	'UI:IPManagement:Action:Undelegate:IPv6Block:PageTitle_Object_Class' => '%1$s - Delegierung aufheben',
	'UI:IPManagement:Action:Undelegate:IPv6Block:Done' => '%1$s <span class="hilite">%2$s</span> - Delegierung entfernt.',
	
//
// Management of Subnets
//
	// Operations on subnets
	'UI:IPManagement:Action:xxx:IPv6Subnet:OperationNotAllowed' => 'Ausführung nicht auf IPv6 Subnetzen erlaubt!',

	// Display details of subnet
	'UI:IPManagement:Action:Details:IPv6Subnet' => 'Details',
	'UI:IPManagement:Action:Details:IPv6Subnet+' => '',

	// Display list of subnets
	'UI:IPManagement:Action:DisplayList:IPv6Subnet' => 'Liste anzeigen',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:PageTitle_Class' => 'IPv6 Subnetze',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:Title_Class' => 'IPv6 Subnetze',
	
	// Display tree of subnets
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet' => 'Baumstruktur anzeigen',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:PageTitle_Class' => 'IPv6 Subnetze',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:Title_Class' => 'IPv6 Subnetze',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:OrgName' => 'Organisation %1$s',
	
	// Find space action on subnets 
	'UI:IPManagement:Action:FindSpace:IPv6Subnet' => 'IP Raum finden',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IP Raum finden',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:Title_Class_Object' => 'Nach IP Raum suchen in : <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeTooSmall' => 'Subnetz ist zu klein für Raum Suche. Bitte abbrechen.',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeOfRange' => 'Größe des gesuchten IP Raums :',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:MaxNumberOfOffers' => 'Maximal mögliche Anzahl :',
	
	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IP Raum finden',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Title_Class_Object' => 'nach IP Raum suchen in %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Summary' => '%1$s die ersten freien %2$s IPs Räume im Subnetz',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:RangeTooBig' => 'Die angeforderte Raumgröße passt nicht in das Subnetz. Bitte erneut mit einem kleineren Wert versuchen.',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:CreateAsRange' => 'Als IP Bereich erzeugen',

	// List IPs action on subnets 
	'UI:IPManagement:Action:ListIps:IPv6Subnet' => 'IPs auflisten und auswählen',                                               
	'UI:IPManagement:Action:ListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Title_Class_Object' => 'Liste von IPs in %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Subtitle_ListRange' => 'Subnetz ist zu groß, um alle IPs aufzulisten. Bitte ein anzuzeigendes Intervall auswählen:',                                               
	'UI:IPManagement:Action:ListIps:IPv6Subnet:FirstIP' => 'Erste IP in der Liste',                                               
	'UI:IPManagement:Action:ListIps:IPv6Subnet:LastIP' => 'Letzte IP in der Liste',                                              
	
	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv6Subnet' => 'IPs auflisten und auswählen',                                               
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:Title_Class_Object' => 'Teilliste von IPs in %1$s: <span class="hilite">%2$s</span>',
 	'UI:IPManagement:Action:DoListIps:IPv6Subnet:CannotBeListed' => 'IPs können nicht angezeigt werden in der Liste: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIPOutOfSubnet' => 'Erste IP ist außerhalb vom Subnetz!',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:LastIPOutOfSubnet' => 'Letzte IP ist außerhalb vom Subnetz!',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'Die erste IP ist höher als die letzte IP!',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet' => 'CSV Export IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV Export von IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Title_Class_Object' => 'CSV Export IPs von %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Subtitle_ListRange' => 'Subnetz ist zu groß, um alle IPs auf einmal zu exportieren. Bitte einen Unterbereich auswählen:',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:FirstIP' => 'Erste IP der Liste',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:LastIP' => 'Letzte IP der Liste',                                               
	
	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet' => 'CSV Export IPs',                                               
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV Export von IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:Title_Class_Object' => 'Partieller CSV Export von IPs in %1$s: <span class="hilite">%2$s</span>',
 	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:CannotBeListed' => 'IPs können nicht gelistet werden: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIPOutOfSubnet' => 'Die erste IP ist ausserhalb des Subnetzes!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:LastIPOutOfSubnet' => 'Die letzte IP ist ausserhalb des Subnetzes!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'Die erste IP des Bereichs ist größer als die letzte IP!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv6Subnet' => 'Subnetz Rechner',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:PageTitle_Object_Class' => '%2$s Rechner',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Title_Class_Object' => 'Rechner für %1$s',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:IP' => 'IP Adresse',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Prefix' => 'Prefix',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet' => 'Subnetz Rechner',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PageTitle_Object_Class' => '%2$s Rechner',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Title_Class_Object' => '%1$s - Rechner Ausgabe',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CompressedIP' => 'IP Address - Komprimiertes Format',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CanonicalIP' => 'IP Address - Kanonisches Format',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Prefix' => 'Prefix',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PrefixMask' => 'Prefix Maske',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NetworkIP' => 'Netzwerk IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:LastIP' => 'Letzte IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:IPNumber' => 'Anzahl von IPs',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet' => 'Zurück Subnetz IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet:NA' => 'Nicht anwendbar',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet' => 'Weiter Subnetz IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet:NA' => 'Nicht anwendbar',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CannotRun' => 'Subnetz Rechner kann nicht arbeiten: %1$s',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:EnterPrefix' => 'Geben Sie ein Prefix ein!',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:WrongPrefix' => 'Prefix ist nicht gültig!',

//
// Management of IP ranges
//
	// Display details of IP Range
	'UI:IPManagement:Action:Details:IPv6Range' => 'Details',
	'UI:IPManagement:Action:Details:IPv6Range+' => '',

	// List IPs action on IP Ranges 
	'UI:IPManagement:Action:ListIps:IPv6Range' => 'IPs auflisten und auswählen',                                               
	'UI:IPManagement:Action:ListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv6Range:Title_Class_Object' => 'Liste von IPs in %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListIps:IPv6Range:Subtitle_ListRange' => 'Bereich ist zu groß, um alle IPs aufzulisten. Bitte kleineren Bereich auswählen:',                                               
	'UI:IPManagement:Action:ListIps:IPv6Range:FirstIP' => 'Erste IP der Liste',                                               
	'UI:IPManagement:Action:ListIps:IPv6Range:LastIP' => 'Letzte IP der Liste',                                              
	
	// Do list IPs action on IP Ranges 
	'UI:IPManagement:Action:DoListIps:IPv6Range' => 'IPs auflisten und auswählen',                                              
	'UI:IPManagement:Action:DoListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Range:Title_Class_Object' => 'Partielle Liste der IPs in %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoListIps:IPv6Range:CannotBeListed' => 'Bereich kann nicht aufgelistet werden: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIPOutOfRange' => 'Erste IP ausserhalb des Bereichs!',
	'UI:IPManagement:Action:DoListIps:IPv6Range:LastIPOutOfRange' => 'Letzte IP ausserhalb des Bereichs!',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIpBiggerThanLastIp' => 'erste IP des Bereichs ist größer als die letzte IP!',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv6Range' => 'CSV Export von IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s CSV Export von IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Title_Class_Object' => 'CSV Export der IPs von %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Subtitle_ListRange' => 'Bereich ist zum groß, um alle IPs gleichzeitig zu exportieren. Btte einen Unterbereich auswählen:',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:FirstIP' => 'Erste IP der Liste',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:LastIP' => 'Letzte IP der Liste',                                               
	
	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range' => 'CSV Export von IPs',                                               
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s CSV Export von IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:Title_Class_Object' => 'Teilweiser CSV Export von IPs %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:CannotBeListed' => 'Bereich kann nicht exportiert werden: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIPOutOfRange' => 'Erste IP ausserhalb des Bereichs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:LastIPOutOfRange' => 'Letzte IP ausserhalb des Bereichs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIpBiggerThanLastIp' => 'Erste IP des Bereichs ist größer als die letzte IP!',

//
// Management of IPs
//
	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:Allocate:IPv6Address:PageTitle_Object_Class' => 'Allocate IP',
	'UI:IPManagement:Action:Allocate:IPv6Address:Title_Class_Object' => 'Allocate %1$s <span class="hilite">%2$s</span> to CI',
	'UI:IPManagement:Action:Allocate:IPv6Address:CannotAllocateCI' => 'Cannot allocate CI to IP: %1$s',
	'UI:IPManagement:Action:Allocate:IPv6Address:Done' => '%1$s <span class="hilite">%2$s</span> has been allocated.',
	'UI:IPManagement:Action:Unallocate:IPv6Address:PageTitle_Object_Class' => 'Un-allocate IP',
	'UI:IPManagement:Action:Unallocate:IPv6Address:Done' => '%1$s <span class="hilite">%2$s</span> has been unallocated.',
));
