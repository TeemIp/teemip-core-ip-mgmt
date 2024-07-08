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

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Core:AttributeIPv6Address' => 'IPv6 地址',
	'Core:AttributeIPv6Address+' => '',
));

//
// Class: IPv6Block
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPv6Block' => 'IPv6 子网块',
	'Class:IPv6Block+' => '',
	'Class:IPv6Block/ComplementaryName' => '%1$s - %2$s',
	'Class:IPv6Block/Attribute:parent_id' => '父块',
	'Class:IPv6Block/Attribute:parent_id+' => '',
	'Class:IPv6Block/Attribute:parent_name' => '父块名称',
	'Class:IPv6Block/Attribute:parent_name+' => '',
	'Class:IPv6Block/Attribute:parent_origin' => '父块来源',
	'Class:IPv6Block/Attribute:parent_origin+' => '',
	'Class:IPv6Block/Attribute:firstip' => '首个IP',
	'Class:IPv6Block/Attribute:firstip+' => '子网块的首个IP地址',
	'Class:IPv6Block/Attribute:lastip' => '末尾IP',
	'Class:IPv6Block/Attribute:lastip+' => '子网块的末尾IP地址',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix' => 'IPv6 子网块的最小尺寸',
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
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix' => '最小尺寸',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:default' => '与全局IP设置对齐',
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
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned' => '将IPv6子网块对齐到CIDR',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_yes' => 'Yes',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned' => '对齐块到CIDR',
 	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:default' => '与全局IP设置对齐',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_yes' => 'Yes',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_yes+' => '',
));

//
// Class: IPv6Subnet
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPv6Subnet' => 'IPv6 子网',
	'Class:IPv6Subnet+' => '',
	'Class:IPv6Subnet/ComplementaryName' => '/%1$s - %2$s - %3$s',
	'Class:IPv6Subnet/Attribute:block_id' => '子网块',
	'Class:IPv6Subnet/Attribute:block_id+' => '',
	'Class:IPv6Subnet/Attribute:block_name' => '块名称',
	'Class:IPv6Subnet/Attribute:block_name+' => '',
	'Class:IPv6Subnet/Attribute:ip' => '子网IP',
	'Class:IPv6Subnet/Attribute:ip+' => '',
	'Class:IPv6Subnet/Attribute:mask' => '掩码',
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
	'Class:IPv6Subnet/Attribute:gatewayip' => '网关IP',
	'Class:IPv6Subnet/Attribute:gatewayip+' => '',
	'Class:IPv6Subnet/Attribute:lastip' => '最后一个子网IP',
	'Class:IPv6Subnet/Attribute:lastip+' => '',
	'Class:IPv6Subnet/Attribute:summary' => '摘要',
	'Class:IPv6Subnet/Attribute:ipconfig_ipv6_gateway_ip_format' => '默认网关IP格式',
	'Class:IPv6Subnet/Attribute:ipconfig_ipv6_gateway_ip_format+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format' => '网关IP格式',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:default' => '与全局IP设置对齐',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1' => '子网IP + 1',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:lastip' => '最后一个子网IP',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:lastip+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:free_setup' => '自由分配',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:free_setup+' => '',
));


//
// IPv6Subnet的类扩展
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPv6Subnet/Tab:ipregistered-count' => '%1$s 保留，%2$s 分配，%3$s 释放和 %4$s 未分配',
));

//
// Class: IPv6Range
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPv6Range' => 'IPv6 范围',
	'Class:IPv6Range+' => '',
	'Class:IPv6Range/ComplementaryName' => '%1$s - %2$s',
	'Class:IPv6Range/Attribute:subnet_id' => '子网',
	'Class:IPv6Range/Attribute:subnet_id+' => 'IPv6 子网',
	'Class:IPv6Range/Attribute:subnet_ip' => '子网IP',
	'Class:IPv6Range/Attribute:subnet_ip+' => '',
	'Class:IPv6Range/Attribute:firstip' => '范围的第一个IP',
	'Class:IPv6Range/Attribute:firstip+' => '',
	'Class:IPv6Range/Attribute:lastip' => '范围的最后一个IP',
	'Class:IPv6Range/Attribute:lastip+' => '',
));

//
// Class: IPv6Address
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Class:IPv6Address' => 'IPv6 地址',
	'Class:IPv6Address+' => '',
	'Class:IPv6Address/Attribute:subnet_id' => '子网',
	'Class:IPv6Address/Attribute:subnet_id+' => 'IPv6 子网',
	'Class:IPv6Address/Attribute:subnet_ip' => '子网IP',
	'Class:IPv6Address/Attribute:subnet_ip+' => '',
	'Class:IPv6Address/Attribute:range_id' => '范围',
	'Class:IPv6Address/Attribute:range_id+' => 'IPv6 范围',
	'Class:IPv6Address/Attribute:ip' => '地址',
	'Class:IPv6Address/Attribute:ip+' => 'IPv6 地址',
));

//
// Application Menu
//

Dict::Add('ZH CN', 'Chinese', '简体中文', array(
	'Menu:IPSpace:IPv6Objects' => 'IPv6 对象',
	'Menu:IPSpace:IPv6Objects+' => 'IPv6 对象',
	'Menu:Ipv6ShortCut' => 'IPv6 快捷方式',
	'Menu:Ipv6ShortCut+' => '将IPv6对象分组的快捷方式',
	'Menu:IPv6Block' => '子网块',
	'Menu:IPv6Block+' => 'IPv6 子网块',
	'Menu:IPv6Subnet' => '子网',
	'Menu:IPv6Subnet+' => 'IPv6 子网',
	'Menu:IPv6Subnet:Allocated' => '已分配的子网',
	'Menu:IPv6Subnet:Allocated+' => '已分配的IPv6子网列表',
	'Menu:IPv6Range' => 'IP 范围',
	'Menu:IPv6Range+' => 'IPv6 范围',
	'Menu:IPv6Address' => 'IP 地址',
	'Menu:IPv6Address+' => 'IPv6 地址',

//
// 子网块管理
//
	// 创建管理	
	'UI:IPManagement:Action:New:IPv6Block:NotIPv6' => 'IP地址不是IPv6地址',

	// 显示子网块详情
	'UI:IPManagement:Action:Details:IPv6Block' => '详情',
	'UI:IPManagement:Action:Details:IPv6Block+' => '',

	// 显示子网块列表
	'UI:IPManagement:Action:DisplayList:IPv6Block' => '显示列表',
	'UI:IPManagement:Action:DisplayList:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Block:PageTitle_Class' => 'IPv6子网块',
	'UI:IPManagement:Action:DisplayList:IPv6Block:Title_Class' => 'IPv6子网块',

	// 显示子网块树
	'UI:IPManagement:Action:DisplayTree:IPv6Block' => '显示树',
	'UI:IPManagement:Action:DisplayTree:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:PageTitle_Class' => 'IPv6子网块',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:Title_Class' => 'IPv6子网块',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:OrgName' => '组织 %1$s',

	// 收缩子网块操作
	'UI:IPManagement:Action:Shrink:IPv6Block' => '收缩',
	'UI:IPManagement:Action:Shrink:IPv6Block+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary' => '摘要',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s 收缩',
	'UI:IPManagement:Action:Shrink:IPv6Block:Title_Class_Object' => '收缩 %1$s: %2$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewFirstIP' => '块的新首个IP：',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewLastIP' => '块的新末尾IP：',
	'UI:IPManagement:Action:Shrink:IPv6Block:IsDelegated' => '此块已委派，因此无法收缩！',
	'UI:IPManagement:Action:Shrink:IPv6Block:CannotBeShrunk' => '块无法收缩：%1$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:SmallerThanMinSize' => '块大小不能小于 /%1$s！',
	'UI:IPManagement:Action:Shrink:IPv6Block:Done' => '%1$s %2$s 已被收缩。',

	// 分割子网块操作
	'UI:IPManagement:Action:Split:IPv6Block' => '分割',
	'UI:IPManagement:Action:Split:IPv6Block+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:Summary' => '摘要',
	'UI:IPManagement:Action:Split:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s 分割',
	'UI:IPManagement:Action:Split:IPv6Block:Title_Class_Object' => '分割 %1$s: %2$s',
	'UI:IPManagement:Action:Split:IPv6Block:At' => '新子网块的首个IP：',
	'UI:IPManagement:Action:Split:IPv6Block:NameNewBlock' => '新子网块的名称：',
	'UI:IPManagement:Action:Split:IPv6Block:IsDelegated' => '此块已委派，因此无法分割！',
	'UI:IPManagement:Action:Split:IPv6Block:CannotBeSplit' => '块无法分割：%1$s',
	'UI:IPManagement:Action:Split:IPv6Block:SmallerThanMinSize' => '块大小不能小于 /%1$s！',
	'UI:IPManagement:Action:Split:IPv6Block:Done' => '%1$s %2$s 已被分割。',

	// 扩展子网块操作
	'UI:IPManagement:Action:Expand:IPv6Block' => '扩展',
	'UI:IPManagement:Action:Expand:IPv6Block+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary' => '摘要',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s 扩展',
	'UI:IPManagement:Action:Expand:IPv6Block:Title_Class_Object' => '扩展 %1$s: %2$s',
	'UI:IPManagement:Action:Expand:IPv6Block:NewFirstIP' => '块的新首个IP：',
	'UI:IPManagement:Action:Expand:IPv6Block:NewLastIP' => '块的新末尾IP：',
	'UI:IPManagement:Action:Expand:IPv6Block:IsDelegated' => '此块已委派，因此无法扩展！',
	'UI:IPManagement:Action:Expand:IPv6Block:CannotBeExpanded' => '块无法扩展：%1$s',
	'UI:IPManagement:Action:Expand:IPv6Block:SmallerThanMinSize' => '块大小不能小于 /%1$s！',
	'UI:IPManagement:Action:Expand:IPv6Block:Done' => '%1$s %2$s 已被扩展。',

	// 列出子网块中的空间操作
	'UI:IPManagement:Action:ListSpace:IPv6Block' => '列出空间',
	'UI:IPManagement:Action:ListSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - 空间',
	'UI:IPManagement:Action:ListSpace:IPv6Block:Title_Class_Object' => '在 %1$s 中找到的空间：%2$s',
	'UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpace' => '空闲 [%1$s - %2$s] - %3$.2e 个IP - %4$.2f%%',
	'UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpaceNoPercent' => '空闲 [%1$s - %2$s] - %3$.2e 个IP',

	// 在子网块中查找空间操作
	'UI:IPManagement:Action:FindSpace:IPv6Block' => '查找空间',
	'UI:IPManagement:Action:FindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - 查找空间',
	'UI:IPManagement:Action:FindSpace:IPv6Block:Title_Class_Object' => '在 %1$s 中查找空间：%2$s',
	'UI:IPManagement:Action:FindSpace:IPv6Block:SizeOfSpace' => '要查找的空间大小：',
	'UI:IPManagement:Action:FindSpace:IPv6Block:MaxNumberOfOffers' => '提供的最大数量：',

	// 执行在子网块中查找空间操作
	'UI:IPManagement:Action:DoFindSpace:IPv6Block' => '找到空间',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - 查找空间',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Title_Class_Object' => '%1$s 中的空间：%2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Summary' => '在块内找到的第一个 /%2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsBlock' => '创建为子块',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsSubnet' => '创建为子网',

	// 委派子网块操作
	'UI:IPManagement:Action:Delegate:IPv6Block' => '委派',
	'UI:IPManagement:Action:Delegate:IPv6Block:PageTitle_Object_Class' => '%1$s - 委派',
	'UI:IPManagement:Action:Delegate:IPv6Block:Title_Class_Object' => '将 %1$s %2$s 委派给子组织',
	'UI:IPManagement:Action:Delegate:IPv6Block:ChildBlock' => '要委派块的子组织：',
	'UI:IPManagement:Action:Delegate:IPv6Block:NoChildOrg' => '块的组织没有任何子组织，因此无法委派块！',
	'UI:IPManagement:Action:Delegate:IPv6Block:CannotBeDelegated' => '块无法被委派：%1$s',
	'UI:IPManagement:Action:Delegate:IPv6Block:Done' => '%1$s %2$s 已被委派。',

	// 撤销委派子网块操作
	'UI:IPManagement:Action:Undelegate:IPv6Block:CannotBeUndelegated' => '块无法被撤销委派：%1$s',
	'UI:IPManagement:Action:Undelegate:IPv6Block' => '取消委派',
	'UI:IPManagement:Action:Undelegate:IPv6Block:PageTitle_Object_Class' => '%1$s - 取消委派',
	'UI:IPManagement:Action:Undelegate:IPv6Block:Done' => '%1$s %2$s 已被取消委派。',

//
// 子网管理
//
	// 在子网上执行的操作
	'UI:IPManagement:Action:xxx:IPv6Subnet:OperationNotAllowed' => '在IPv6子网上不允许执行此操作！',

	// 显示子网详情
	'UI:IPManagement:Action:Details:IPv6Subnet' => '详情',
	'UI:IPManagement:Action:Details:IPv6Subnet+' => '',

	// 显示子网列表
	'UI:IPManagement:Action:DisplayList:IPv6Subnet' => '显示列表',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:PageTitle_Class' => 'IPv6子网',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:Title_Class' => 'IPv6子网',

	// 显示子网树
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet' => '显示树',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:PageTitle_Class' => 'IPv6子网',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:Title_Class' => 'IPv6子网',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:OrgName' => '组织 %1$s',

	// 在子网上查找空间操作
	'UI:IPManagement:Action:FindSpace:IPv6Subnet' => '查找空间',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - 查找空间',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:Title_Class_Object' => '在 %1$s 中查找IP空间：%2$s',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeTooSmall' => '子网太小，无法查找空间。请取消！',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeOfRange' => '要查找的空间大小：',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:MaxNumberOfOffers' => '提供的最大数量：',

	// 执行在子网上查找空间操作
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet' => '找到空间',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - 查找空间',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Title_Class_Object' => '%1$s 中的空间：%2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Summary' => '在子网内找到 %2$s 第一个空闲的 %1$s IP 范围',
        'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:RangeTooBig' => '请求的空间不适合在子网内。请尝试一个较低的值。',
        'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:CreateAsRange' => '创建为IPv6范围',

// 在子网上列出IP的操作
'UI:IPManagement:Action:ListIps:IPv6Subnet' => '列出和选择IP',
'UI:IPManagement:Action:ListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IPs',
'UI:IPManagement:Action:ListIps:IPv6Subnet:Title_Class_Object' => '在 %1$s 中的IP列表：%2$s',
'UI:IPManagement:Action:ListIps:IPv6Subnet:Subtitle_ListRange' => '子网太大，无法一次列出所有IP。请选择要显示的范围：',
'UI:IPManagement:Action:ListIps:IPv6Subnet:FirstIP' => '列表中的第一个IP',
'UI:IPManagement:Action:ListIps:IPv6Subnet:LastIP' => '列表中的最后一个IP',

// 执行在子网上列出IP的操作
'UI:IPManagement:Action:DoListIps:IPv6Subnet' => '列出和选择IP',
'UI:IPManagement:Action:DoListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IPs',
'UI:IPManagement:Action:DoListIps:IPv6Subnet:Title_Class_Object' => '在 %1$s 中的部分IP列表：%2$s',
'UI:IPManagement:Action:DoListIps:IPv6Subnet:CannotBeListed' => '无法列出IP：%1$s',
'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIPOutOfSubnet' => '第一个IP超出子网',
'UI:IPManagement:Action:DoListIps:IPv6Subnet:LastIPOutOfSubnet' => '最后一个IP超出子网',
'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIpBiggerThanLastIp' => '范围的第一个IP高于最后一个IP！',

// 子网上的CSV导出操作
'UI:IPManagement:Action:CsvExportIps:IPv6Subnet' => 'CSV导出IPs',
'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV导出IPs',
'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Title_Class_Object' => '%1$s 的CSV导出IPs：%2$s',
'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Subtitle_ListRange' => '子网太大，无法一次导出所有IP。请选择要显示的范围：',
'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:FirstIP' => '列表中的第一个IP',
'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:LastIP' => '列表中的最后一个IP',

// 执行在子网上CSV导出IP的操作
'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet' => 'CSV导出IPs',
'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV导出IPs',
'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:Title_Class_Object' => '%1$s 的部分CSV导出IPs：%2$s',
'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:CannotBeListed' => '无法列出IP：%1$s',
'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIPOutOfSubnet' => '第一个IP超出子网',
'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:LastIPOutOfSubnet' => '最后一个IP超出子网',
'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIpBiggerThanLastIp' => '范围的第一个IP高于最后一个IP！',

// 子网计算器
'UI:IPManagement:Action:Calculator:IPv6Subnet' => '子网计算器',
'UI:IPManagement:Action:Calculator:IPv6Subnet:PageTitle_Object_Class' => '%2$s 计算器',
'UI:IPManagement:Action:Calculator:IPv6Subnet:Title_Class_Object' => '%1$s 的计算器',
'UI:IPManagement:Action:Calculator:IPv6Subnet:IP' => 'IP地址',
'UI:IPManagement:Action:Calculator:IPv6Subnet:Prefix' => '前缀',

// 执行子网计算器
'UI:IPManagement:Action:DoCalculator:IPv6Subnet' => '子网计算器',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PageTitle_Object_Class' => '%2$s 计算器',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Title_Class_Object' => '%1$s - 计算器输出',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CompressedIP' => 'IP地址 - 压缩格式',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CanonicalIP' => 'IP地址 - 规范格式',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Prefix' => '前缀',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PrefixMask' => '前缀掩码',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NetworkIP' => '子网IP',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:LastIP' => '最后一个IP',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:IPNumber' => 'IP数量',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet' => '上一个子网IP',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet:NA' => '不适用',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet' => '下一个子网IP',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet:NA' => '不适用',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CannotRun' => '子网计算器无法运行：%1$s',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:EnterPrefix' => '请输入前缀！',
'UI:IPManagement:Action:DoCalculator:IPv6Subnet:WrongPrefix' => '前缀无效！',

//
// IP范围的管理
//
// 显示IPv6范围的详细信息
'UI:IPManagement:Action:Details:IPv6Range' => '详细信息',
'UI:IPManagement:Action:Details:IPv6Range+' => '',

// 在IP范围上列出IP的操作
'UI:IPManagement:Action:ListIps:IPv6Range' => '列出和选择IP',
'UI:IPManagement:Action:ListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IPs',
'UI:IPManagement:Action:ListIps:IPv6Range:Title_Class_Object' => '%1$s 中的IP列表：%2$s',
'UI:IPManagement:Action:ListIps:IPv6Range:Subtitle_ListRange' => '范围太大，无法一次列出所有IP。请选择要显示的子范围：',
'UI:IPManagement:Action:ListIps:IPv6Range:FirstIP' => '列表中的第一个IP',
'UI:IPManagement:Action:ListIps:IPv6Range:LastIP' => '列表中的最后一个IP',

// 在IP范围上执行列出IP的操作
'UI:IPManagement:Action:DoListIps:IPv6Range' => '列出和选择IP',
'UI:IPManagement:Action:DoListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IPs',
'UI:IPManagement:Action:DoListIps:IPv6Range:Title_Class_Object' => '%1$s 中的部分IP列表：%2$s',
'UI:IPManagement:Action:DoListIps:IPv6Range:CannotBeListed' => '范围无法列出：%1$s',
'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIPOutOfRange' => '第一个IP超出范围',
'UI:IPManagement:Action:DoListIps:IPv6Range:LastIPOutOfRange' => '最后一个IP超出范围',
'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIpBiggerThanLastIp' => '范围的第一个IP高于最后一个IP！',

// 在IP范围上的CSV导出操作
'UI:IPManagement:Action:CsvExportIps:IPv6Range' => 'CSV导出IPs',
'UI:IPManagement:Action:CsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s CSV导出IPs',
'UI:IPManagement:Action:CsvExportIps:IPv6Range:Title_Class_Object' => '%1$s 的CSV导出IPs：%2$s',
'UI:IPManagement:Action:CsvExportIps:IPv6Range:Subtitle_ListRange' => '范围太大，无法一次导出所有IP。请选择要导出的子范围：',
'UI:IPManagement:Action:CsvExportIps:IPv6Range:FirstIP' => '列表中的第一个IP',
'UI:IPManagement:Action:CsvExportIps:IPv6Range:LastIP' => '列表中的最后一个IP',

// 在IP范围上执行CSV导出IP的操作
'UI:IPManagement:Action:DoCsvExportIps:IPv6Range' => 'CSV导出IPs',
'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s CSV导出IPs',
'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:Title_Class_Object' => '%1$s 的部分CSV导出IPs：%2$s',
'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:CannotBeListed' => '范围无法导出：%1$s',
'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIPOutOfRange' => '第一个IP超出范围',
'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:LastIPOutOfRange' => '最后一个IP超出范围',
'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIpBiggerThanLastIp' => '范围的第一个IP高于最后一个IP！',

//
// IP的管理
//
// 分配到CI / 从CI取消分配
'UI:IPManagement:Action:Allocate:IPv6Address' => '将地址分配给CI',
'UI:IPManagement:Action:Allocate:IPv6Address:PageTitle_Object_Class' => '分配IP',
'UI:IPManagement:Action:Allocate:IPv6Address:Title_Class_Object' => '将 %1$s %2$s 分配给CI',
'UI:IPManagement:Action:Allocate:IPv6Address:CannotAllocateCI' => '无法将CI分配给IP：%1$s',
'UI:IPManagement:Action:Allocate:IPv6Address:Done' => '%1$s %2$s 已被分配。',
'UI:IPManagement:Action:Allocate:IPv6Address:IPAlreadyAllocated' => '地址已经被分配！',
'UI:IPManagement:Action:Unallocate:IPv6Address:PageTitle_Object_Class' => '取消分配IP',
'UI:IPManagement:Action:Unallocate:IPv6Address:Done' => '%1$s %2$s 已被取消分配。',
'UI:IPManagement:Action:UnAllocate:IPv6Address:IPNotAllocated' => '地址未被分配！',
));

