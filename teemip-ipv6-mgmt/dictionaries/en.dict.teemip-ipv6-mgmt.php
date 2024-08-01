<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'teemip-ipv6-mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// TeemIp specific attributes
//

Dict::Add('EN US', 'English', 'English', array(
	'Core:AttributeIPv6Address' => 'IPv6 address',
	'Core:AttributeIPv6Address+' => '',
));

//
// Class: IPv6Block
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPv6Block' => 'IPv6 Subnet Block',
	'Class:IPv6Block+' => '',
	'Class:IPv6Block/ComplementaryName' => '%1$s - %2$s',
	'Class:IPv6Block/Attribute:parent_id' => 'Parent block',
	'Class:IPv6Block/Attribute:parent_id+' => '',
	'Class:IPv6Block/Attribute:parent_name' => 'Parent block name',
	'Class:IPv6Block/Attribute:parent_name+' => '',
	'Class:IPv6Block/Attribute:parent_origin' => 'Parent block origin',
	'Class:IPv6Block/Attribute:parent_origin+' => '',
	'Class:IPv6Block/Attribute:firstip' => 'First IP',
	'Class:IPv6Block/Attribute:firstip+' => 'First IP Address of Subnet Block',
	'Class:IPv6Block/Attribute:lastip' => 'Last IP',
	'Class:IPv6Block/Attribute:lastip+' => 'Last IP Address of Subnet Block',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix' => 'Minimum size of IPv6 Subnet Blocks',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:48' => '/48',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:48+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:49' => '/49',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:49+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:50' => '/50',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:50+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:51' => '/51',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:51+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:52' => '/52',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:52+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:53' => '/53',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:53+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:54' => '/54',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:54+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:55' => '/55',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:55+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:56' => '/56',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:56+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:57' => '/57',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:57+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:58' => '/58',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:58+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:59' => '/59',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:59+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:60' => '/60',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:60+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:61' => '/61',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:61+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:62' => '/62',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:62+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:63' => '/63',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:63+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:64' => '/64',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix/Value:64+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix' => 'Minimum size',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:default' => 'Aligned with global IP settings',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:48' => '/48',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:48+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:49' => '/49',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:49+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:50' => '/50',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:50+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:51' => '/51',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:51+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:52' => '/52',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:52+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:53' => '/53',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:53+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:54' => '/54',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:54+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:55' => '/55',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:55+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:56' => '/56',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:56+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:57' => '/57',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:57+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:58' => '/58',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:58+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:59' => '/59',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:59+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:60' => '/60',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:60+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:61' => '/61',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:61+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:62' => '/62',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:62+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:63' => '/63',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:63+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:64' => '/64',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:64+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned' => 'Align IPv6 Subnet Blocks to CIDR',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_yes' => 'Yes',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned' => 'Align block to CIDR',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:default' => 'Aligned with global IP settings',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_yes' => 'Yes',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_yes+' => '',
));

//
// Class: IPv6Subnet
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPv6Subnet' => 'IPv6 Subnet',
	'Class:IPv6Subnet+' => '',
	'Class:IPv6Subnet/ComplementaryName' => '/%1$s - %2$s - %3$s',
	'Class:IPv6Subnet/Attribute:block_id' => 'Subnet Block',
	'Class:IPv6Subnet/Attribute:block_id+' => '',
	'Class:IPv6Subnet/Attribute:block_name' => 'Block name',
	'Class:IPv6Subnet/Attribute:block_name+' => '',
	'Class:IPv6Subnet/Attribute:ip' => 'Subnet IP',
	'Class:IPv6Subnet/Attribute:ip+' => '',
	'Class:IPv6Subnet/Attribute:mask' => 'Mask',
	'Class:IPv6Subnet/Attribute:mask+' => '',
	'Class:IPv6Subnet/Attribute:mask/Value:64' => 'FFFF:FFFF:FFFF:FFFF:: - /64',
	'Class:IPv6Subnet/Attribute:mask/Value:65' => 'FFFF:FFFF:FFFF:FFFF:8000:: - /65',
	'Class:IPv6Subnet/Attribute:mask/Value:66' => 'FFFF:FFFF:FFFF:FFFF:C000:: - /66',
	'Class:IPv6Subnet/Attribute:mask/Value:67' => 'FFFF:FFFF:FFFF:FFFF:E000:: - /67',
	'Class:IPv6Subnet/Attribute:mask/Value:68' => 'FFFF:FFFF:FFFF:FFFF:F000:: - /68',
	'Class:IPv6Subnet/Attribute:mask/Value:69' => 'FFFF:FFFF:FFFF:FFFF:F800:: - /69',
	'Class:IPv6Subnet/Attribute:mask/Value:70' => 'FFFF:FFFF:FFFF:FFFF:FC00:: - /70',
	'Class:IPv6Subnet/Attribute:mask/Value:71' => 'FFFF:FFFF:FFFF:FFFF:FE00:: - /71',
	'Class:IPv6Subnet/Attribute:mask/Value:72' => 'FFFF:FFFF:FFFF:FFFF:FF00:: - /72',
	'Class:IPv6Subnet/Attribute:mask/Value:73' => 'FFFF:FFFF:FFFF:FFFF:FF80:: - /73',
	'Class:IPv6Subnet/Attribute:mask/Value:74' => 'FFFF:FFFF:FFFF:FFFF:FFC0:: - /74',
	'Class:IPv6Subnet/Attribute:mask/Value:75' => 'FFFF:FFFF:FFFF:FFFF:FFE0:: - /75',
	'Class:IPv6Subnet/Attribute:mask/Value:76' => 'FFFF:FFFF:FFFF:FFFF:FFF0:: - /76',
	'Class:IPv6Subnet/Attribute:mask/Value:77' => 'FFFF:FFFF:FFFF:FFFF:FFF8:: - /77',
	'Class:IPv6Subnet/Attribute:mask/Value:78' => 'FFFF:FFFF:FFFF:FFFF:FFFC:: - /78',
	'Class:IPv6Subnet/Attribute:mask/Value:79' => 'FFFF:FFFF:FFFF:FFFF:FFFE:: - /79',
	'Class:IPv6Subnet/Attribute:mask/Value:80' => 'FFFF:FFFF:FFFF:FFFF:FFFF:: - /80',
	'Class:IPv6Subnet/Attribute:mask/Value:81' => 'FFFF:FFFF:FFFF:FFFF:FFFF:8000:: - /81',
	'Class:IPv6Subnet/Attribute:mask/Value:82' => 'FFFF:FFFF:FFFF:FFFF:FFFF:C000:: - /82',
	'Class:IPv6Subnet/Attribute:mask/Value:83' => 'FFFF:FFFF:FFFF:FFFF:FFFF:E000:: - /83',
	'Class:IPv6Subnet/Attribute:mask/Value:84' => 'FFFF:FFFF:FFFF:FFFF:FFFF:F000:: - /84',
	'Class:IPv6Subnet/Attribute:mask/Value:85' => 'FFFF:FFFF:FFFF:FFFF:FFFF:F800:: - /85',
	'Class:IPv6Subnet/Attribute:mask/Value:86' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FC00:: - /86',
	'Class:IPv6Subnet/Attribute:mask/Value:87' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FE00:: - /87',
	'Class:IPv6Subnet/Attribute:mask/Value:88' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FF00:: - /88',
	'Class:IPv6Subnet/Attribute:mask/Value:89' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FF80:: - /89',
	'Class:IPv6Subnet/Attribute:mask/Value:90' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFC0:: - /90',
	'Class:IPv6Subnet/Attribute:mask/Value:91' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFE0:: - /91',
	'Class:IPv6Subnet/Attribute:mask/Value:92' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFF0:: - /92',
	'Class:IPv6Subnet/Attribute:mask/Value:93' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFF8:: - /93',
	'Class:IPv6Subnet/Attribute:mask/Value:94' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFC:: - /94',
	'Class:IPv6Subnet/Attribute:mask/Value:95' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFE:: - /95',
	'Class:IPv6Subnet/Attribute:mask/Value:96' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:: - /96',
	'Class:IPv6Subnet/Attribute:mask/Value:97' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:8000:0 - /97',
	'Class:IPv6Subnet/Attribute:mask/Value:98' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:C000:0 - /98',
	'Class:IPv6Subnet/Attribute:mask/Value:99' => 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:E000:0 - /99',
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
	'Class:IPv6Subnet/Attribute:lastip' => 'Last subnet IP',
	'Class:IPv6Subnet/Attribute:lastip+' => '',
	'Class:IPv6Subnet/Attribute:summary' => 'Summary',
	'Class:IPv6Subnet/Attribute:ipconfig_ipv6_gateway_ip_format' => 'Default Gateway IP format',
	'Class:IPv6Subnet/Attribute:ipconfig_ipv6_gateway_ip_format+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format' => 'Gateway IP format',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:default' => 'Aligned with global IP settings',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1' => 'Subnet IP + 1',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:lastip' => 'Last subnet IP',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:lastip+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:free_setup' => 'Free allocation',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:free_setup+' => '',
));

//
// Class extensions for IPv6Subnet
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPv6Subnet/Tab:ipregistered-count' => '%1$s Reserved, %2$s Allocated, %3$s Released and %4$s Unassigned',
));

//
// Class: IPv6Range
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPv6Range' => 'IPv6 Range',
	'Class:IPv6Range+' => '',
	'Class:IPv6Range/ComplementaryName' => '%1$s - %2$s',
	'Class:IPv6Range/Attribute:subnet_id' => 'Subnet',
	'Class:IPv6Range/Attribute:subnet_id+' => 'IPv6 Subnet',
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

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPv6Address' => 'IPv6 Address',
	'Class:IPv6Address+' => '',
	'Class:IPv6Address/Attribute:subnet_id' => 'Subnet',
	'Class:IPv6Address/Attribute:subnet_id+' => 'IPv6 Subnet',
	'Class:IPv6Address/Attribute:subnet_ip' => 'Subnet IP',
	'Class:IPv6Address/Attribute:subnet_ip+' => '',
	'Class:IPv6Address/Attribute:range_id' => 'Range',
	'Class:IPv6Address/Attribute:range_id+' => 'IPv6 Range',
	'Class:IPv6Address/Attribute:ip' => 'Address',
	'Class:IPv6Address/Attribute:ip+' => 'IPv6 Address',
));

//
// Application Menu
//

Dict::Add('EN US', 'English', 'English', array(
	'Menu:IPSpace:IPv6Objects' => 'IPv6 Objects',
	'Menu:IPSpace:IPv6Objects+' => 'IPv6 Objects',
	'Menu:Ipv6ShortCut' => 'IPv6 Shortcuts',
	'Menu:Ipv6ShortCut+' => 'Shortcut that groups IPv6 objects',
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
	'UI:IPManagement:Action:Shrink:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s shrink',
	'UI:IPManagement:Action:Shrink:IPv6Block:Title_Class_Object' => 'Shrink %1$s: %2$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewFirstIP' => 'New First IP of Block :',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewLastIP' => 'New Last IP of Block :',
	'UI:IPManagement:Action:Shrink:IPv6Block:IsDelegated' => 'This block is delegated and therefore cannot be shrunk!',
	'UI:IPManagement:Action:Shrink:IPv6Block:CannotBeShrunk' => 'Block cannot be shrunk: %1$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:SmallerThanMinSize' => 'Block size cannot be smaller than /%1$s !',
	'UI:IPManagement:Action:Shrink:IPv6Block:Done' => '%1$s %2$s has been shrunk.',

	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv6Block' => 'Split',
	'UI:IPManagement:Action:Split:IPv6Block+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Split:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s split',
	'UI:IPManagement:Action:Split:IPv6Block:Title_Class_Object' => 'Split %1$s: %2$s',
	'UI:IPManagement:Action:Split:IPv6Block:At' => 'First IP of new Subnet Block :',
	'UI:IPManagement:Action:Split:IPv6Block:NameNewBlock' => 'Name of new Subnet Block :',
	'UI:IPManagement:Action:Split:IPv6Block:IsDelegated' => 'This block is delegated and therefore cannot be split!',
	'UI:IPManagement:Action:Split:IPv6Block:CannotBeSplit' => 'Block cannot be split: %1$s',
	'UI:IPManagement:Action:Split:IPv6Block:SmallerThanMinSize' => 'Block size cannot be smaller than /%1$s !',
	'UI:IPManagement:Action:Split:IPv6Block:Done' => '%1$s %2$s has been split.',

	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv6Block' => 'Expand',
	'UI:IPManagement:Action:Expand:IPv6Block+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s expand',
	'UI:IPManagement:Action:Expand:IPv6Block:Title_Class_Object' => 'Expand %1$s: %2$s',
	'UI:IPManagement:Action:Expand:IPv6Block:NewFirstIP' => 'New First IP of Block :',
	'UI:IPManagement:Action:Expand:IPv6Block:NewLastIP' => 'New Last IP of Block :',
	'UI:IPManagement:Action:Expand:IPv6Block:IsDelegated' => 'This block is delegated and therefore cannot be expanded!',
	'UI:IPManagement:Action:Expand:IPv6Block:CannotBeExpanded' => 'Block cannot be expanded: %1$s',
	'UI:IPManagement:Action:Expand:IPv6Block:SmallerThanMinSize' => 'Block size cannot be smaller than /%1$s !',
	'UI:IPManagement:Action:Expand:IPv6Block:Done' => '%1$s %2$s has been expanded.',

	// List space action on subnet blocks 
	'UI:IPManagement:Action:ListSpace:IPv6Block' => 'List Space',
	'UI:IPManagement:Action:ListSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Space',
	'UI:IPManagement:Action:ListSpace:IPv6Block:Title_Class_Object' => 'Found space within %1$s: %2$s',
	'UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpace' => 'Free [%1$s - %2$s] - %3$.2e IPs - %4$.2f %%',
	'UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpaceNoPercent' => 'Free [%1$s - %2$s] - %3$.2e IPs',

	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv6Block' => 'Find Space',
	'UI:IPManagement:Action:FindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Find space',
	'UI:IPManagement:Action:FindSpace:IPv6Block:Title_Class_Object' => 'Look for space within %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv6Block:SizeOfSpace' => 'Size of space to look for :',
	'UI:IPManagement:Action:FindSpace:IPv6Block:MaxNumberOfOffers' => 'Maximum number of offers :',

	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv6Block' => 'Found Space',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Find space',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Title_Class_Object' => 'Space within %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Summary' => '%1$s first /%2$s within block',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsBlock' => 'Create as a child block',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsSubnet' => 'Create as a subnet',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv6Block' => 'Delegate',
	'UI:IPManagement:Action:Delegate:IPv6Block:PageTitle_Object_Class' => '%1$s - Delegate',
	'UI:IPManagement:Action:Delegate:IPv6Block:Title_Class_Object' => 'Delegate %1$s %2$s to child organization',
	'UI:IPManagement:Action:Delegate:IPv6Block:ChildBlock' => 'Child Organization to delegate the Block to:',
	'UI:IPManagement:Action:Delegate:IPv6Block:NoChildOrg' => 'Block\'s organization doesn\'t have any children and therefore, block cannot be delegated!',
	'UI:IPManagement:Action:Delegate:IPv6Block:CannotBeDelegated' => 'Block cannot be delegated: %1$s',
	'UI:IPManagement:Action:Delegate:IPv6Block:Done' => '%1$s %2$s has been delegated.',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPv6Block:CannotBeUndelegated' => 'Block cannot be undelegated: %1$s',
	'UI:IPManagement:Action:Undelegate:IPv6Block' => 'Un-delegate',
	'UI:IPManagement:Action:Undelegate:IPv6Block:PageTitle_Object_Class' => '%1$s - Un-delegate',
	'UI:IPManagement:Action:Undelegate:IPv6Block:Done' => '%1$s %2$s has been un-delegated.',

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
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - Find space',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:Title_Class_Object' => 'Look for IP space within %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeTooSmall' => 'Subnet is too small to look for space. Please, cancel!',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeOfRange' => 'Size of space to look for :',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:MaxNumberOfOffers' => 'Maximum number of offers :',

	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet' => 'Found space',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - Find space',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Title_Class_Object' => 'Space within %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Summary' => '%1$s first free %2$s IPs ranges within subnet',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:RangeTooBig' => 'Requested space doesn\'t fit within subnet. Please, try a lower value.',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:CreateAsRange' => 'Create as an IPv6 range',

	// List IPs action on subnets 
	'UI:IPManagement:Action:ListIps:IPv6Subnet' => 'List & Pick IPs',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Title_Class_Object' => 'List of IPs within %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Subtitle_ListRange' => 'Subnet is too big to list all IPs in a raw. Please, select a range to display:',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:FirstIP' => 'First IP of the list',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:LastIP' => 'Last IP of the list',

	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv6Subnet' => 'List & Pick IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:Title_Class_Object' => 'Partial list of IPs within %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:CannotBeListed' => 'IPs cannot be listed: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIPOutOfSubnet' => 'First IP is out of subnet',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:LastIPOutOfSubnet' => 'Last IP is out of subnet',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet' => 'CSV Export IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV export IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Title_Class_Object' => 'CSV Export IPs of %1$s: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Subtitle_ListRange' => 'Subnet is too big to export all IPs in a raw. Please, select a range to display:',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:FirstIP' => 'First IP of the list',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:LastIP' => 'Last IP of the list',

	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet' => 'CSV Export IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV export IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:Title_Class_Object' => 'Partial CSV Export IPs within %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:CannotBeListed' => 'IPs cannot be listed: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIPOutOfSubnet' => 'First IP is out of subnet',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:LastIPOutOfSubnet' => 'Last IP is out of subnet',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv6Subnet' => 'Subnet Calculator',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:PageTitle_Object_Class' => '%2$s Calculator',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Title_Class_Object' => 'Calculator for %1$s',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:IP' => 'IP Address',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Prefix' => 'Prefix',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet' => 'Subnet Calculator',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PageTitle_Object_Class' => '%2$s Calculator',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Title_Class_Object' => '%1$s - Calculator output',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CompressedIP' => 'IP Address - Compressed format',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CanonicalIP' => 'IP Address - Canonical format',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Prefix' => 'Prefix',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PrefixMask' => 'Prefix Mask',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NetworkIP' => 'Subnet IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:LastIP' => 'Last IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:IPNumber' => 'Number of IPs',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet' => 'Previous Subnet IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet:NA' => 'Not Applicable',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet' => 'Next Subnet IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet:NA' => 'Not Applicable',
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
	'UI:IPManagement:Action:ListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv6Range:Title_Class_Object' => 'IPs within %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv6Range:Subtitle_ListRange' => 'Range is too big to list all IPs in a raw. Please, select a subrange to display:',
	'UI:IPManagement:Action:ListIps:IPv6Range:FirstIP' => 'First IP of the list',
	'UI:IPManagement:Action:ListIps:IPv6Range:LastIP' => 'Last IP of the list',

	// Do list IPs action on IP Ranges 
	'UI:IPManagement:Action:DoListIps:IPv6Range' => 'List & Pick IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Range:Title_Class_Object' => 'Partial list of IPs within %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv6Range:CannotBeListed' => 'Range cannot be listed: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIPOutOfRange' => 'First IP is out of range',
	'UI:IPManagement:Action:DoListIps:IPv6Range:LastIPOutOfRange' => 'Last IP is out of range',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv6Range' => 'CSV Export of IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s CSV export of IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Title_Class_Object' => 'CSV Export IPs of %1$s: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Subtitle_ListRange' => 'Range is too big to export all IPs in a raw. Please, select a sub range to export:',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:FirstIP' => 'First IP of the list',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:LastIP' => 'Last IP of the list',

	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range' => 'CSV Export IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s CSV export of IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:Title_Class_Object' => 'Partial CSV Export IPs of %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:CannotBeListed' => 'Range cannot be exported: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIPOutOfRange' => 'First IP is out of range',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:LastIPOutOfRange' => 'Last IP is out of range',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

//
// Management of IPs
//
	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:Allocate:IPv6Address' => 'Allocate address to CI',
	'UI:IPManagement:Action:Allocate:IPv6Address:PageTitle_Object_Class' => 'Allocate IP',
	'UI:IPManagement:Action:Allocate:IPv6Address:Title_Class_Object' => 'Allocate %1$s %2$s to CI',
	'UI:IPManagement:Action:Allocate:IPv6Address:CannotAllocateCI' => 'Cannot allocate CI to IP: %1$s',
	'UI:IPManagement:Action:Allocate:IPv6Address:Done' => '%1$s %2$s has been allocated.',
	'UI:IPManagement:Action:Allocate:IPv6Address:IPAlreadyAllocated' => 'Address is already allocated!',
	'UI:IPManagement:Action:Unallocate:IPv6Address:PageTitle_Object_Class' => 'Un-allocate IP',
	'UI:IPManagement:Action:Unallocate:IPv6Address:Done' => '%1$s %2$s has been unallocated.',
	'UI:IPManagement:Action:UnAllocate:IPv6Address:IPNotAllocated' => 'Address is not allocated!',
));
