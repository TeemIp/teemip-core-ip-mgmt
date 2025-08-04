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

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Core:AttributeIPv6Address' => 'Endereço IPv6',
	'Core:AttributeIPv6Address+' => '',
));

//
// Class: IPv6Block
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv6Block' => 'Bloco de Sub-rede IPv6',
	'Class:IPv6Block+' => '',
	'Class:IPv6Block/ComplementaryName' => '%1$s - %2$s',
	'Class:IPv6Block/Attribute:parent_id' => 'Bloco pai',
	'Class:IPv6Block/Attribute:parent_id+' => '',
	'Class:IPv6Block/Attribute:parent_name' => 'Nome do bloco pai',
	'Class:IPv6Block/Attribute:parent_name+' => '',
	'Class:IPv6Block/Attribute:parent_origin' => 'Origem do bloco pai',
	'Class:IPv6Block/Attribute:parent_origin+' => '',
	'Class:IPv6Block/Attribute:firstip' => 'Primeiro IP',
	'Class:IPv6Block/Attribute:firstip+' => 'Primeiro Endereço IP do Bloco de Sub-rede',
	'Class:IPv6Block/Attribute:lastip' => 'Último IP',
	'Class:IPv6Block/Attribute:lastip+' => 'Último Endereço IP do Bloco de Sub-rede',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix' => 'Tamanho mínimo dos Blocos de Sub-rede IPv6',
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
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix' => 'Tamanho mínimo',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:default' => 'Alinhado com as configurações globais de IP',
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
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned' => 'Alinhar Blocos de Sub-rede IPv6 ao CIDR',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_no' => 'Não',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_yes' => 'Sim',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned' => 'Alinhar bloco ao CIDR',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:default' => 'Alinhado com as configurações globais de IP',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_no' => 'Não',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_yes' => 'Sim',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_yes+' => '',
));

//
// Class: IPv6Subnet
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv6Subnet' => 'Sub-rede IPv6',
	'Class:IPv6Subnet+' => '',
	'Class:IPv6Subnet/ComplementaryName' => '/%1$s - %2$s - %3$s',
	'Class:IPv6Subnet/Attribute:block_id' => 'Bloco de Sub-rede',
	'Class:IPv6Subnet/Attribute:block_id+' => '',
	'Class:IPv6Subnet/Attribute:block_name' => 'Nome do bloco',
	'Class:IPv6Subnet/Attribute:block_name+' => '',
	'Class:IPv6Subnet/Attribute:ip' => 'IP da Sub-rede',
	'Class:IPv6Subnet/Attribute:ip+' => '',
	'Class:IPv6Subnet/Attribute:mask' => 'Máscara',
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
	'Class:IPv6Subnet/Attribute:mask/Value_cidr:100' => '/100',
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
	'Class:IPv6Subnet/Attribute:gatewayip' => 'IP do Gateway',
	'Class:IPv6Subnet/Attribute:gatewayip+' => '',
	'Class:IPv6Subnet/Attribute:lastip' => 'Último IP da sub-rede',
	'Class:IPv6Subnet/Attribute:lastip+' => '',
	'Class:IPv6Subnet/Attribute:summary' => 'Resumo',
	'Class:IPv6Subnet/Attribute:ipconfig_ipv6_gateway_ip_format' => 'Formato padrão do IP do Gateway',
	'Class:IPv6Subnet/Attribute:ipconfig_ipv6_gateway_ip_format+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format' => 'Formato do IP do Gateway',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:default' => 'Alinhado com as configurações globais de IP',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1' => 'IP da Sub-rede + 1',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:lastip' => 'Último IP da sub-rede',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:lastip+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:free_setup' => 'Alocação livre',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:free_setup+' => '',
));

//
// Class extensions for IPv6Subnet
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv6Subnet/Tab:ipregistered-count' => '%1$s Reservados, %2$s Alocados, %3$s Liberados e %4$s Não atribuídos',
));

//
// Class: IPv6Range
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv6Range' => 'Faixa IPv6',
	'Class:IPv6Range+' => '',
	'Class:IPv6Range/ComplementaryName' => '%1$s - %2$s',
	'Class:IPv6Range/Attribute:subnet_id' => 'Sub-rede',
	'Class:IPv6Range/Attribute:subnet_id+' => 'Sub-rede IPv6',
	'Class:IPv6Range/Attribute:subnet_ip' => 'IP da Sub-rede',
	'Class:IPv6Range/Attribute:subnet_ip+' => '',
	'Class:IPv6Range/Attribute:firstip' => 'Primeiro IP da Faixa',
	'Class:IPv6Range/Attribute:firstip+' => '',
	'Class:IPv6Range/Attribute:lastip' => 'Último IP da Faixa',
	'Class:IPv6Range/Attribute:lastip+' => '',
));

//
// Class: IPv6Address
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv6Address' => 'Endereço IPv6',
	'Class:IPv6Address+' => '',
	'Class:IPv6Address/Attribute:subnet_id' => 'Sub-rede',
	'Class:IPv6Address/Attribute:subnet_id+' => 'Sub-rede IPv6',
	'Class:IPv6Address/Attribute:subnet_ip' => 'IP da Sub-rede',
	'Class:IPv6Address/Attribute:subnet_ip+' => '',
	'Class:IPv6Address/Attribute:range_id' => 'Faixa',
	'Class:IPv6Address/Attribute:range_id+' => 'Faixa IPv6',
	'Class:IPv6Address/Attribute:ip' => 'Endereço',
	'Class:IPv6Address/Attribute:ip+' => 'Endereço IPv6',
));

//
// Application Menu
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Menu:IPSpace:IPv6Objects' => 'Objetos IPv6',
	'Menu:IPSpace:IPv6Objects+' => 'Objetos IPv6',
	'Menu:Ipv6ShortCut' => 'Atalhos IPv6',
	'Menu:Ipv6ShortCut+' => 'Atalho que agrupa objetos IPv6',
	'Menu:IPv6Block' => 'Blocos de Sub-rede',
	'Menu:IPv6Block+' => 'Blocos de Sub-rede IPv6',
	'Menu:IPv6Subnet' => 'Sub-redes',
	'Menu:IPv6Subnet+' => 'Sub-redes IPv6',
	'Menu:IPv6Subnet:Allocated' => 'Sub-redes Alocadas',
	'Menu:IPv6Subnet:Allocated+' => 'Lista de Sub-redes IPv6 alocadas',
	'Menu:IPv6Range' => 'Faixas de IP',
	'Menu:IPv6Range+' => 'Faixas IPv6',
	'Menu:IPv6Address' => 'Endereços IP',
	'Menu:IPv6Address+' => 'Endereços IPv6',

//
// Management of Subnet Blocks
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPv6Block:NotIPv6' => 'Os IPs não são IPs IPv6',

	// Display details of subnet blocks
	'UI:IPManagement:Action:Details:IPv6Block' => 'Detalhes',
	'UI:IPManagement:Action:Details:IPv6Block+' => '',

	// Display list of subnet blocks
	'UI:IPManagement:Action:DisplayList:IPv6Block' => 'Exibir Lista',
	'UI:IPManagement:Action:DisplayList:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Block:PageTitle_Class' => 'Blocos de Sub-rede IPv6',
	'UI:IPManagement:Action:DisplayList:IPv6Block:Title_Class' => 'Blocos de Sub-rede IPv6',

	// Display tree of subnet blocks
	'UI:IPManagement:Action:DisplayTree:IPv6Block' => 'Exibir Árvore',
	'UI:IPManagement:Action:DisplayTree:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:PageTitle_Class' => 'Blocos de Sub-rede IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:Title_Class' => 'Blocos de Sub-rede IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:OrgName' => 'Organização %1$s',

	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPv6Block' => 'Reduzir',
	'UI:IPManagement:Action:Shrink:IPv6Block+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary' => 'Resumo',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:PageTitle_Object_Class' => 'Redução de %1$s - %2$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:Title_Class_Object' => 'Reduzir %1$s: %2$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewFirstIP' => 'Novo Primeiro IP do Bloco :',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewLastIP' => 'Novo Último IP do Bloco :',
	'UI:IPManagement:Action:Shrink:IPv6Block:IsDelegated' => 'Este bloco está delegado e, portanto, não pode ser reduzido!',
	'UI:IPManagement:Action:Shrink:IPv6Block:CannotBeShrunk' => 'O bloco não pode ser reduzido: %1$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:SmallerThanMinSize' => 'O tamanho do bloco não pode ser menor que /%1$s !',
	'UI:IPManagement:Action:Shrink:IPv6Block:Done' => '%1$s %2$s foi reduzido.',

	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv6Block' => 'Dividir',
	'UI:IPManagement:Action:Split:IPv6Block+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:Summary' => 'Resumo',
	'UI:IPManagement:Action:Split:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:PageTitle_Object_Class' => 'Divisão de %1$s - %2$s',
	'UI:IPManagement:Action:Split:IPv6Block:Title_Class_Object' => 'Dividir %1$s: %2$s',
	'UI:IPManagement:Action:Split:IPv6Block:At' => 'Primeiro IP do novo Bloco de Sub-rede :',
	'UI:IPManagement:Action:Split:IPv6Block:NameNewBlock' => 'Nome do novo Bloco de Sub-rede :',
	'UI:IPManagement:Action:Split:IPv6Block:IsDelegated' => 'Este bloco está delegado e, portanto, não pode ser dividido!',
	'UI:IPManagement:Action:Split:IPv6Block:CannotBeSplit' => 'O bloco não pode ser dividido: %1$s',
	'UI:IPManagement:Action:Split:IPv6Block:SmallerThanMinSize' => 'O tamanho do bloco não pode ser menor que /%1$s !',
	'UI:IPManagement:Action:Split:IPv6Block:Done' => '%1$s %2$s foi dividido.',

	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv6Block' => 'Expandir',
	'UI:IPManagement:Action:Expand:IPv6Block+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary' => 'Resumo',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:PageTitle_Object_Class' => 'Expansão de %1$s - %2$s',
	'UI:IPManagement:Action:Expand:IPv6Block:Title_Class_Object' => 'Expandir %1$s: %2$s',
	'UI:IPManagement:Action:Expand:IPv6Block:NewFirstIP' => 'Novo Primeiro IP do Bloco :',
	'UI:IPManagement:Action:Expand:IPv6Block:NewLastIP' => 'Novo Último IP do Bloco :',
	'UI:IPManagement:Action:Expand:IPv6Block:IsDelegated' => 'Este bloco está delegado e, portanto, não pode ser expandido!',
	'UI:IPManagement:Action:Expand:IPv6Block:CannotBeExpanded' => 'O bloco não pode ser expandido: %1$s',
	'UI:IPManagement:Action:Expand:IPv6Block:SmallerThanMinSize' => 'O tamanho do bloco não pode ser menor que /%1$s !',
	'UI:IPManagement:Action:Expand:IPv6Block:Done' => '%1$s %2$s foi expandido.',

	// List space action on subnet blocks 
	'UI:IPManagement:Action:ListSpace:IPv6Block' => 'Listar Espaço',
	'UI:IPManagement:Action:ListSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Espaço',
	'UI:IPManagement:Action:ListSpace:IPv6Block:Title_Class_Object' => 'Espaço encontrado dentro de %1$s: %2$s',
	'UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpace' => 'Livre [%1$s - %2$s] - %3$.2e IPs - %4$.2f %%',
	'UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpaceNoPercent' => 'Livre [%1$s - %2$s] - %3$.2e IPs',

	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv6Block' => 'Encontrar Espaço',
	'UI:IPManagement:Action:FindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Encontrar espaço',
	'UI:IPManagement:Action:FindSpace:IPv6Block:Title_Class_Object' => 'Procurar por espaço dentro de %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv6Block:SizeOfSpace' => 'Tamanho do espaço a ser procurado :',
	'UI:IPManagement:Action:FindSpace:IPv6Block:MaxNumberOfOffers' => 'Número máximo de ofertas :',

	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv6Block' => 'Espaço Encontrado',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Encontrar espaço',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Title_Class_Object' => 'Espaço dentro de %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Summary' => 'Primeiros %1$s /%2$s dentro do bloco',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsBlock' => 'Criar como um bloco filho',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsSubnet' => 'Criar como uma sub-rede',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv6Block' => 'Delegar',
	'UI:IPManagement:Action:Delegate:IPv6Block:PageTitle_Object_Class' => '%1$s - Delegar',
	'UI:IPManagement:Action:Delegate:IPv6Block:Title_Class_Object' => 'Delegar %1$s %2$s para organização filha',
	'UI:IPManagement:Action:Delegate:IPv6Block:ChildBlock' => 'Organização Filha para a qual delegar o Bloco:',
	'UI:IPManagement:Action:Delegate:IPv6Block:NoChildOrg' => 'A organização do bloco não possui filhos e, portanto, o bloco não pode ser delegado!',
	'UI:IPManagement:Action:Delegate:IPv6Block:CannotBeDelegated' => 'O bloco não pode ser delegado: %1$s',
	'UI:IPManagement:Action:Delegate:IPv6Block:Done' => '%1$s %2$s foi delegado.',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPv6Block:CannotBeUndelegated' => 'A delegação do bloco não pode ser removida: %1$s',
	'UI:IPManagement:Action:Undelegate:IPv6Block' => 'Remover delegação',
	'UI:IPManagement:Action:Undelegate:IPv6Block:PageTitle_Object_Class' => '%1$s - Remover delegação',
	'UI:IPManagement:Action:Undelegate:IPv6Block:Done' => 'A delegação de %1$s %2$s foi removida.',

//
// Management of Subnets
//
	// Operations on subnets
	'UI:IPManagement:Action:xxx:IPv6Subnet:OperationNotAllowed' => 'Operação não permitida em sub-redes IPv6!',

	// Display details of subnet
	'UI:IPManagement:Action:Details:IPv6Subnet' => 'Detalhes',
	'UI:IPManagement:Action:Details:IPv6Subnet+' => '',

	// Display list of subnets
	'UI:IPManagement:Action:DisplayList:IPv6Subnet' => 'Exibir Lista',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:PageTitle_Class' => 'Sub-redes IPv6',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:Title_Class' => 'Sub-redes IPv6',

	// Display tree of subnets
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet' => 'Exibir Árvore',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:PageTitle_Class' => 'Sub-redes IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:Title_Class' => 'Sub-redes IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:OrgName' => 'Organização %1$s',

	// Find space action on subnets 
	'UI:IPManagement:Action:FindSpace:IPv6Subnet' => 'Encontrar espaço',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - Encontrar espaço',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:Title_Class_Object' => 'Procurar por espaço IP dentro de %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeTooSmall' => 'A sub-rede é muito pequena para procurar espaço. Por favor, cancele!',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeOfRange' => 'Tamanho do espaço a ser procurado :',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:MaxNumberOfOffers' => 'Número máximo de ofertas :',

	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet' => 'Espaço encontrado',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - Encontrar espaço',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Title_Class_Object' => 'Espaço dentro de %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Summary' => 'Primeiras %1$s faixas de IPs livres de %2$s dentro da sub-rede',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:RangeTooBig' => 'O espaço solicitado não cabe na sub-rede. Por favor, tente um valor menor.',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:CreateAsRange' => 'Criar como uma faixa IPv6',

	// List IPs action on subnets 
	'UI:IPManagement:Action:ListIps:IPv6Subnet' => 'Listar e Selecionar IPs',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Title_Class_Object' => 'Lista de IPs dentro de %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Subtitle_ListRange' => 'A sub-rede é muito grande para listar todos os IPs de uma vez. Por favor, selecione uma faixa para exibir:',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:FirstIP' => 'Primeiro IP da lista',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:LastIP' => 'Último IP da lista',

	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv6Subnet' => 'Listar e Selecionar IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:Title_Class_Object' => 'Lista parcial de IPs dentro de %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:CannotBeListed' => 'Os IPs não podem ser listados: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIPOutOfSubnet' => 'O primeiro IP está fora da sub-rede',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:LastIPOutOfSubnet' => 'O último IP está fora da sub-rede',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'O primeiro IP da faixa é maior que o último IP!',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet' => 'Exportar IPs para CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s exportação de IPs para CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Title_Class_Object' => 'Exportar IPs de %1$s para CSV: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Subtitle_ListRange' => 'A sub-rede é muito grande para exportar todos os IPs de uma vez. Por favor, selecione uma faixa para exibir:',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:FirstIP' => 'Primeiro IP da lista',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:LastIP' => 'Último IP da lista',

	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet' => 'Exportar IPs para CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s exportação de IPs para CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:Title_Class_Object' => 'Exportação parcial de IPs para CSV dentro de %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:CannotBeListed' => 'Os IPs não podem ser listados: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIPOutOfSubnet' => 'O primeiro IP está fora da sub-rede',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:LastIPOutOfSubnet' => 'O último IP está fora da sub-rede',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'O primeiro IP da faixa é maior que o último IP!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv6Subnet' => 'Calculadora de Sub-rede',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:PageTitle_Object_Class' => 'Calculadora de %2$s',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Title_Class_Object' => 'Calculadora para %1$s',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:IP' => 'Endereço IP',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Prefix' => 'Prefixo',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet' => 'Calculadora de Sub-rede',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PageTitle_Object_Class' => 'Calculadora de %2$s',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Title_Class_Object' => '%1$s - Resultado da calculadora',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CompressedIP' => 'Endereço IP - Formato comprimido',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CanonicalIP' => 'Endereço IP - Formato canônico',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Prefix' => 'Prefixo',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PrefixMask' => 'Máscara de Prefixo',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NetworkIP' => 'IP da Sub-rede',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:LastIP' => 'Último IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:IPNumber' => 'Número de IPs',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet' => 'IP da Sub-rede Anterior',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet:NA' => 'Não Aplicável',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet' => 'IP da Próxima Sub-rede',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet:NA' => 'Não Aplicável',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CannotRun' => 'A calculadora de sub-rede não pode ser executada: %1$s',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:EnterPrefix' => 'Insira um prefixo!',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:WrongPrefix' => 'O prefixo é inválido!',

//
// Management of IP ranges
//
	// Display details of IP Range
	'UI:IPManagement:Action:Details:IPv6Range' => 'Detalhes',
	'UI:IPManagement:Action:Details:IPv6Range+' => '',

	// List IPs action on IP Ranges 
	'UI:IPManagement:Action:ListIps:IPv6Range' => 'Listar e Selecionar IPs',
	'UI:IPManagement:Action:ListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv6Range:Title_Class_Object' => 'IPs dentro de %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv6Range:Subtitle_ListRange' => 'A faixa é muito grande para listar todos os IPs de uma vez. Por favor, selecione uma subfaixa para exibir:',
	'UI:IPManagement:Action:ListIps:IPv6Range:FirstIP' => 'Primeiro IP da lista',
	'UI:IPManagement:Action:ListIps:IPv6Range:LastIP' => 'Último IP da lista',

	// Do list IPs action on IP Ranges 
	'UI:IPManagement:Action:DoListIps:IPv6Range' => 'Listar e Selecionar IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Range:Title_Class_Object' => 'Lista parcial de IPs dentro de %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv6Range:CannotBeListed' => 'A faixa não pode ser listada: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIPOutOfRange' => 'O primeiro IP está fora da faixa',
	'UI:IPManagement:Action:DoListIps:IPv6Range:LastIPOutOfRange' => 'O último IP está fora da faixa',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIpBiggerThanLastIp' => 'O primeiro IP da faixa é maior que o último IP!',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv6Range' => 'Exportação de IPs para CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s exportação de IPs para CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Title_Class_Object' => 'Exportar IPs de %1$s para CSV: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Subtitle_ListRange' => 'A faixa é muito grande para exportar todos os IPs de uma vez. Por favor, selecione uma subfaixa para exportar:',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:FirstIP' => 'Primeiro IP da lista',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:LastIP' => 'Último IP da lista',

	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range' => 'Exportar IPs para CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s exportação de IPs para CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:Title_Class_Object' => 'Exportação parcial de IPs de %1$s para CSV: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:CannotBeListed' => 'A faixa não pode ser exportada: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIPOutOfRange' => 'O primeiro IP está fora da faixa',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:LastIPOutOfRange' => 'O último IP está fora da faixa',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIpBiggerThanLastIp' => 'O primeiro IP da faixa é maior que o último IP!',

//
// Management of IPs
//
	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:Allocate:IPv6Address' => 'Alocar endereço para CI',
	'UI:IPManagement:Action:Allocate:IPv6Address:PageTitle_Object_Class' => 'Alocar IP',
	'UI:IPManagement:Action:Allocate:IPv6Address:Title_Class_Object' => 'Alocar %1$s %2$s para CI',
	'UI:IPManagement:Action:Allocate:IPv6Address:CannotAllocateCI' => 'Não é possível alocar o CI ao IP: %1$s',
	'UI:IPManagement:Action:Allocate:IPv6Address:Done' => '%1$s %2$s foi alocado.',
	'UI:IPManagement:Action:Allocate:IPv6Address:IPAlreadyAllocated' => 'O endereço já está alocado!',
	'UI:IPManagement:Action:Unallocate:IPv6Address:PageTitle_Object_Class' => 'Desalocar IP',
	'UI:IPManagement:Action:Unallocate:IPv6Address:Done' => '%1$s %2$s foi desalocado.',
	'UI:IPManagement:Action:UnAllocate:IPv6Address:IPNotAllocated' => 'O endereço não está alocado!',
));
