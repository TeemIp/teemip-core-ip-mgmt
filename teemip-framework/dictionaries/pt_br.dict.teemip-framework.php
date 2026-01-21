<?php
/*
 * @copyright   Copyright (C) 2010-2026 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

/////////////////////////////////////////////////////////////////////
// Classes in Teemip Framework Module'
//////////////////////////////////////////////////////////////////////
//

//
// TeemIp specific attributes
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Core:AttributeIPPercentage' => 'Porcentagem de IP',
	'Core:AttributeIPPercentage+' => 'Exibição gráfica para porcentagem de uso',
	'Core:AttributeMacAddress' => 'Endereço MAC',
	'Core:AttributeMacAddress+' => 'String de endereço MAC',
));

//
// Class: IPApplication
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPApplication/Name' => '%1$s',
	'Class:IPApplication/Attribute:uuid' => 'UUID',
	'Class:IPApplication/Attribute:uuid+' => 'Identificador Único Universal da aplicação',
	'Class:IPApplication/Attribute:status' => 'Status',
	'Class:IPApplication/Attribute:status+' => '',
	'Class:IPApplication/Attribute:status/Value:obsolete' => 'Obsoleto',
	'Class:IPApplication/Attribute:status/Value:production' => 'Produção',
	'Class:IPApplication/Attribute:status/Value:implementation' => 'Implementação',
	'Class:IPApplication/Attribute:location_id' => 'Localização',
	'Class:IPApplication/Attribute:location_id+' => '',
	'Class:IPApplication/Attribute:location_name' => 'Nome da localização',
	'Class:IPApplication/Attribute:location_name+' => '',
));

//
// Class: IPConfig
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPConfig' => 'Configuração Global de IP',
	'Class:IPConfig+' => 'Conjunto de configurações ou parâmetros que direcionam o comportamento das extensões do TeemIp',
	'Class:IPConfig:baseinfo' => 'Informações Gerais',
	'Class:IPConfig:blockinfo' => 'Configurações Padrão para Blocos de Sub-rede',
	'Class:IPConfig:subnetinfo' => 'Configurações Padrão para Sub-redes',
	'Class:IPConfig:iprangeinfo' => 'Configurações Padrão para Faixas de IP',
	'Class:IPConfig:ipinfo' => 'Configurações Padrão para IPs',
	'Class:IPConfig:domaininfo' => 'Configurações de Domínio',
	'Class:IPConfig:otherinfo' => 'Outras Configurações',
	'Class:IPConfig/Attribute:org_id' => 'Organização',
	'Class:IPConfig/Attribute:org_id+' => 'Organização à qual a configuração global de IP está anexada. Uma determinada organização só pode ter uma configuração global de IP.',
	'Class:IPConfig/Attribute:org_name' => 'Nome da Organização',
	'Class:IPConfig/Attribute:org_name+' => '',
	'Class:IPConfig/Attribute:name' => 'Nome',
	'Class:IPConfig/Attribute:name+' => '',
	'Class:IPConfig/Attribute:requestor_id' => 'Solicitante',
	'Class:IPConfig/Attribute:requestor_id+' => '',
	'Class:IPConfig/Attribute:requestor_name' => 'Nome do Solicitante',
	'Class:IPConfig/Attribute:requestor_name+' => '',
	'Class:IPConfig/Attribute:ipv4_block_min_size' => 'Tamanho mínimo dos Blocos de Sub-rede IPv4',
	'Class:IPConfig/Attribute:ipv4_block_min_size+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix' => 'Tamanho mínimo dos Blocos de Sub-rede IPv6',
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
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned' => 'Alinhar Blocos de Sub-rede IPv4 ao CIDR',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no' => 'Não',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes' => 'Sim',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned' => 'Alinhar Blocos de Sub-rede IPv6 ao CIDR',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no' => 'Não',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes' => 'Sim',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only' => 'Delegar blocos apenas para organizações filhas',
	'Class:IPConfig/Attribute:delegate_to_children_only+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_no' => 'Não',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_no+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_yes' => 'Sim',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_yes+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs' => 'Reservar IPs de Sub-rede, Gateway e Broadcast na Criação da Sub-rede',
	'Class:IPConfig/Attribute:reserve_subnet_IPs+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_no' => 'Não',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_no+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_yes' => 'Sim',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_yes+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format' => 'Formato do IP de Gateway IPv4',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1' => 'IP da Sub-rede + 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1' => 'IP de Broadcast - 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup' => 'Alocação livre',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format' => 'Formato do IP de Gateway IPv6',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1' => 'IP da Sub-rede + 1',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip' => 'Último IP da sub-rede',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup' => 'Alocação livre',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup+' => '',
	'Class:IPConfig/Attribute:subnet_low_watermark' => 'Marca d\'água baixa da Sub-rede (%)',
	'Class:IPConfig/Attribute:subnet_low_watermark+' => '',
	'Class:IPConfig/Attribute:subnet_high_watermark' => 'Marca d\'água alta da Sub-rede (%)',
	'Class:IPConfig/Attribute:subnet_high_watermark+' => '',
	'Class:IPConfig/Attribute:iprange_low_watermark' => 'Marca d\'água baixa da Faixa de IP (%)',
	'Class:IPConfig/Attribute:iprange_low_watermark+' => '',
	'Class:IPConfig/Attribute:iprange_high_watermark' => 'Marca d\'água alta da Faixa de IP (%)',
	'Class:IPConfig/Attribute:iprange_high_watermark+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name' => 'Permitir Nomes Duplicados',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_no' => 'Não',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_yes' => 'Sim',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack' => 'Dual stack',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack+' => 'Duplicados são autorizados entre IPv4 e IPv6 únicos',
	'Class:IPConfig/Attribute:mac_address_format' => 'Formato de Saída do Endereço MAC',
	'Class:IPConfig/Attribute:mac_address_format+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:colons' => '01:23:45:67:89:ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:colons+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:hyphens' => '01-23-45-67-89-ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:hyphens+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:dots' => '0123.4567.89ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:dots+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:any' => 'Qualquer',
	'Class:IPConfig/Attribute:mac_address_format/Value:any+' => '',
	'Class:IPConfig/Attribute:ping_before_assign' => 'Fazer ping no IP antes de atribuí-lo',
	'Class:IPConfig/Attribute:ping_before_assign+' => '',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_no' => 'Não',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_no+' => '',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_yes' => 'Sim',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_yes+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname' => 'Copiar nome do CI\'s para o nome curto do IP\'s',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:no' => 'Não',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:yes' => 'Sim',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:yes+' => '',
    'Class:IPConfig/Attribute:ip_reset_shortname_on_detachment' => 'Redefinir o nome curto do IP\'s quando removido de um CI',
    'Class:IPConfig/Attribute:ip_reset_shortname_on_detachment+' => '',
    'Class:IPConfig/Attribute:ip_reset_shortname_on_detachment/Value:no' => 'No',
    'Class:IPConfig/Attribute:ip_reset_shortname_on_detachment/Value:no+' => '',
    'Class:IPConfig/Attribute:ip_reset_shortname_on_detachment/Value:yes' => 'Yes',
    'Class:IPConfig/Attribute:ip_reset_shortname_on_detachment/Value:yes+' => '',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname' => 'Calcular FQDN quando o nome curto estiver vazio',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname+' => '',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:no' => 'Não',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:no+' => '',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:yes' => 'Sim',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete' => 'Liberar IPs de CI\'s que se tornam obsoletos',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:no' => 'Não',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:yes' => 'Sim',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production' => 'Alocar IPs anexados a CI\'s de produção',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:no' => 'Não',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:yes' => 'Sim',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:yes+' => '',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only' => 'Delegar domínios apenas para organizações filhas',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only+' => '',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_no' => 'Não',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_no+' => '',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_yes' => 'Sim',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_yes+' => '',
	'Class:IPConfig/Attribute:ip_symetrical_nat' => 'NAT de IP Simétrico',
	'Class:IPConfig/Attribute:ip_symetrical_nat+' => '',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:yes' => 'Sim',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:no' => 'Não',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:no+' => '',
	'Class:IPConfig/Attribute:subnet_symetrical_nat' => 'NAT de Sub-rede Simétrico',
	'Class:IPConfig/Attribute:subnet_symetrical_nat+' => '',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:yes' => 'Sim',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:yes+' => '',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:no' => 'Não',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release' => 'Liberar IPs de sub-redes que são liberadas',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:yes' => 'Sim',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:no' => 'Não',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci' => 'Desalocar IPs que não estão anexados a um CI',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci+' => '',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:yes' => 'Sim',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:no' => 'Não',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:no+' => '',
	'Class:IPConfig/Attribute:attach_already_allocated_ips' => 'Permitir anexar IPs já alocados a CI\'s',
	'Class:IPConfig/Attribute:attach_already_allocated_ips+' => '',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:yes' => 'Sim',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:yes+' => '',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:no' => 'Não',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:no+' => '',
    'Class:IPConfig/Attribute:detach_released_ip_from_cis' => 'Desanexar IPs liberados de CI\'s',
    'Class:IPConfig/Attribute:detach_released_ip_from_cis+' => 'Desanexa IPs cujo status muda para \'Liberado\' de todos os CI\'s. Isso não inclui interfaces para as quais os IPs liberados são sempre desanexados.',
    'Class:IPConfig/Attribute:detach_released_ip_from_cis/Value:yes' => 'Sim',
    'Class:IPConfig/Attribute:detach_released_ip_from_cis/Value:no' => 'Não',
));

//
// Class: IPUsage
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPUsage' => 'Uso do Endereço IP',
	'Class:IPUsage+' => 'Para que um endereço IP é usado',
	'Class:IPUsage/Attribute:org_id' => 'Organização',
	'Class:IPUsage/Attribute:org_id+' => '',
	'Class:IPUsage/Attribute:org_name' => 'Nome da Organização',
	'Class:IPUsage/Attribute:org_name+' => '',
	'Class:IPUsage/Attribute:name' => 'Nome',
	'Class:IPUsage/Attribute:name+' => '',
	'Class:IPUsage/Attribute:description' => 'Descrição',
	'Class:IPUsage/Attribute:description+' => '',
	'Class:IPUsage/Attribute:ips_list' => 'IPs',
	'Class:IPUsage/Attribute:ips_list+' => 'IPs com esse uso',
));

//
// Class: DashletBadgeFiltered
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'UI:DashletBadgeFiltered:Label' => 'Badge com filtro',
	'UI:DashletBadgeFiltered:Description' => 'Badge filtrado por um OQL',
));

//
// Menus
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Menu:IPConfig' => 'Configurações Globais de IP',
	'Menu:IPConfig+' => 'Parâmetros globais para objetos relacionados a IP',
));

//
// Management of IP global settings
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'UI:IPManagement:Action:New:IPConfig:AlreadyExists' => 'Apenas um objeto de Configurações Globais de IP pode existir dentro de uma organização!',
	'UI:IPManagement:Action:Modify:IPConfig:IPv4BlockMinSizeTooSmall' => 'O tamanho mínimo dos Blocos de Sub-rede IPv4 não pode ser menor que %1$s!',
	'UI:IPManagement:Action:Modify:IPConfig:IPv6BlockMinSizeTooSmall' => 'O tamanho mínimo dos Blocos de Sub-rede IPv6 não pode ser menor que %1$s!',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksPercent' => 'As Marcas d\'água são percentagens, por favor, use números entre 0 e 100!',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksOrder' => 'A Marca d\'água baixa deve ser menor que a alta!',
	'UI:IPManagement:Action:Modify:GlobalConfig' => 'Estas Configurações Globais de IP podem ser sobrescritas para essa ação.',
	'UI:IPManagement:Action:New:IPUsage:AlreadyExists' => 'Um Uso de Endereço IP já existe com o mesmo nome!',
));

//
// Display Tree
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
    'UI:Action:DisplayTree:DelegatedItems:folded' => 'Recolher nós delegados',
    'UI:Action:DisplayTree:DelegatedItems:unfolded' => 'Expandir nós delegados',
));