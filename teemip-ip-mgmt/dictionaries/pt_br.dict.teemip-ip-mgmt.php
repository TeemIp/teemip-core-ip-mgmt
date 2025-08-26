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

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPObject' => 'Objeto IP',
	'Class:IPObject+' => '',
	'IPObject:GlobalParams' => 'Configurações Globais',
	'IPObject:GlobalParams+' => 'Configurações Globais Padrão definidas no nível da organização e configurações realmente usadas para o objeto',
	'Class:IPObject:GeneralConfigParameters' => 'Configurações da organização',
	'Class:IPObject/Attribute:finalclass' => 'Subclasse',
	'Class:IPObject/Attribute:finalclass+' => 'Nome da classe final',
	'Class:IPObject/Attribute:org_id' => 'Organização',
	'Class:IPObject/Attribute:org_id+' => '',
	'Class:IPObject/Attribute:org_name' => 'Nome da Organização',
	'Class:IPObject/Attribute:org_name+' => '',
	'Class:IPObject/Attribute:status' => 'Status',
	'Class:IPObject/Attribute:status+' => '',
	'Class:IPObject/Attribute:status/Value:reserved' => 'Reservado',
	'Class:IPObject/Attribute:status/Value:reserved+' => '',
	'Class:IPObject/Attribute:status/Value:allocated' => 'Alocado',
	'Class:IPObject/Attribute:status/Value:allocated+' => '',
	'Class:IPObject/Attribute:status/Value:released' => 'Liberado',
	'Class:IPObject/Attribute:status/Value:released+' => '',
	'Class:IPObject/Attribute:status/Value:unassigned' => 'Não atribuído',
	'Class:IPObject/Attribute:status/Value:unassigned+' => '',
	'Class:IPObject/Attribute:comment' => 'Observação',
	'Class:IPObject/Attribute:comment+' => '',
	'Class:IPObject/Attribute:requestor_id' => 'Solicitante',
	'Class:IPObject/Attribute:requestor_id+' => '',
	'Class:IPObject/Attribute:requestor_name' => 'Nome do Solicitante',
	'Class:IPObject/Attribute:requestor_name+' => '',
	'Class:IPObject/Attribute:allocation_date' => 'Data de alocação',
	'Class:IPObject/Attribute:allocation_date+' => 'Data em que o objeto IP foi alocado',
	'Class:IPObject/Attribute:release_date' => 'Data de liberação',
	'Class:IPObject/Attribute:release_date+' => 'Data em que o objeto IP foi liberado e não é mais usado.',
	'Class:IPObject/Attribute:ipconfig_id' => 'Configurações globais de IP',
	'Class:IPObject/Attribute:ipconfig_id+' => '',
	'Class:IPObject/Attribute:contact_list' => 'Contatos',
	'Class:IPObject/Attribute:contact_list+' => 'Contatos anexados ao objeto IP',
	'Class:IPObject/Attribute:document_list' => 'Documentos',
	'Class:IPObject/Attribute:document_list+' => 'Documentos anexados ao objeto IP',
));

//
// Class: lnkContactToIPObject
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkContactToIPObject' => 'Vincular Contato / Objeto IP',
	'Class:lnkContactToIPObject+' => '',
	'Class:lnkContactToIPObject/Name' => '%1$s / %2$s',
	'Class:lnkContactToIPObject/Attribute:ipobject_id' => 'Objeto IP',
	'Class:lnkContactToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_id' => 'Contato',
	'Class:lnkContactToIPObject/Attribute:contact_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_name' => 'Nome do contato',
	'Class:lnkContactToIPObject/Attribute:contact_name+' => '',
));

//
// Class: lnkDocToIPObject
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkDocToIPObject' => 'Vincular Documento / Objeto IP',
	'Class:lnkDocToIPObject+' => '',
	'Class:lnkDocToIPObject/Name' => '%1$s / %2$s',
	'Class:lnkDocToIPObject/Attribute:ipobject_id' => 'Objeto IP',
	'Class:lnkDocToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_id' => 'Documento',
	'Class:lnkDocToIPObject/Attribute:document_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_name' => 'Nome do documento',
	'Class:lnkDocToIPObject/Attribute:document_name+' => '',
));

//
// Class: lnkIPObjectToTicket
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkIPObjectToTicket' => 'Vincular Objeto IP / Ticket',
	'Class:lnkIPObjectToTicket+' => '',
	'Class:lnkIPObjectToTicket/Name' => '%1$s / %2$s',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id_finalclass_recall' => 'Tipo de Objeto IP',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id_finalclass_recall+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id' => 'Objeto IP',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_id' => 'Ticket',
	'Class:lnkIPObjectToTicket/Attribute:ticket_id+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_ref' => 'Ref',
	'Class:lnkIPObjectToTicket/Attribute:ticket_ref+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_title' => 'Título',
	'Class:lnkIPObjectToTicket/Attribute:ticket_title+' => '',
));

//
// Class: IPBlock
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPBlock' => 'Bloco de Sub-rede',
	'Class:IPBlock+' => '',
	'Class:IPBlock:baseinfo' => 'Informações Gerais',
	'Class:IPBlock:automation' => 'Automação',
	'Class:IPBlock:delegationinfo' => 'Informações de Delegação',
	'Class:IPBlock:ipinfo' => 'Informações de IP',
	'Class:IPBlock:DelegatedToChild' => '<delegation_highlight>Delegado para a organização: </delegation_highlight>%1$s',
	'Class:IPBlock:DelegatedFromParent' => '<delegation_highlight>Delegado da organização: </delegation_highlight>%1$s',
	'Class:IPBlock:localconfigparameters' => 'Configurações do bloco de sub-rede',
	'Class:IPBlock/Attribute:name' => 'Nome',
	'Class:IPBlock/Attribute:name+' => '',
	'Class:IPBlock/Attribute:ipblocktype_id' => 'Tipo',
	'Class:IPBlock/Attribute:ipblocktype_id+' => 'Tipo de Bloco de Sub-rede',
	'Class:IPBlock/Attribute:ipblocktype_name' => 'Nome do tipo',
	'Class:IPBlock/Attribute:ipblocktype_name+' => '',
	'Class:IPBlock/Attribute:allocation_date' => 'Data de alocação',
	'Class:IPBlock/Attribute:allocation_date+' => 'Data em que o Bloco de Sub-rede foi alocado',
	'Class:IPBlock/Attribute:parent_org_id' => 'Delegado de',
	'Class:IPBlock/Attribute:parent_org_id+' => 'Organização da qual o Bloco de Sub-rede foi delegado',
	'Class:IPBlock/Attribute:parent_org_name' => 'Nome da organização delegadora',
	'Class:IPBlock/Attribute:parent_org_name+' => 'Nome da organização da qual o Bloco de Sub-rede foi delegado',
	'Class:IPBlock/Attribute:occupancy' => 'Espaço Utilizado',
	'Class:IPBlock/Attribute:occupancy+' => '',
	'Class:IPBlock/Attribute:children_occupancy' => 'Espaço Utilizado por Filhos',
	'Class:IPBlock/Attribute:children_occupancy+' => '',
	'Class:IPBlock/Attribute:subnet_occupancy' => 'Espaço Utilizado por Sub-redes',
	'Class:IPBlock/Attribute:subnet_occupancy+' => '',
	'Class:IPBlock/Attribute:location_list' => 'Localizações',
	'Class:IPBlock/Attribute:location_list+' => 'Localizações onde o Bloco de Sub-rede se expande',
	'Class:IPBlock/Attribute:origin' => 'Origem',
	'Class:IPBlock/Attribute:origin+' => 'De onde o bloco se origina: registro de internet regional ou local ou outra organização',
	'Class:IPBlock/Attribute:origin/Value:rir' => 'RIR',
	'Class:IPBlock/Attribute:origin/Value:rir+' => 'Registro Regional de Internet',
	'Class:IPBlock/Attribute:origin/Value:lir' => 'LIR',
	'Class:IPBlock/Attribute:origin/Value:lir+' => 'Registro Local de Internet',
	'Class:IPBlock/Attribute:origin/Value:other' => 'Outro',
	'Class:IPBlock/Attribute:origin/Value:other+' => 'Departamento de TI...',
	'Class:IPBlock/Attribute:registrar_id' => 'Registrador',
	'Class:IPBlock/Attribute:registrar_id+' => 'Registro de internet regional ou local relacionado',
	'Class:IPBlock/Attribute:registrar_name' => 'Nome do registrador',
	'Class:IPBlock/Attribute:registrar_name+' => '',
));

//
// Class extensions for IPBlock
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPBlock/Tab:globalparam' => 'Configurações Globais',
	'Class:IPBlock/Tab:childblock' => 'Blocos Filhos',
	'Class:IPBlock/Tab:childblock+' => 'Blocos anexados a este bloco',
	'Class:IPBlock/Tab:childblock/SelectList' => 'Mudar exibição',
	'Class:IPBlock/Tab:childblock/SelectList0' => 'Exibir apenas blocos filhos',
	'Class:IPBlock/Tab:childblock/SelectList1' => 'Exibir toda a hierarquia de blocos filhos',
	'Class:IPBlock/Tab:childblock/List0' => 'Apenas blocos filhos',
	'Class:IPBlock/Tab:childblock/List1' => 'Toda a hierarquia de blocos filhos',
	'Class:IPBlock/Tab:childblock-count' => 'Blocos Filhos: %1$s',
	'Class:IPBlock/Tab:childblock-count-percent' => ' Espaço utilizado por Blocos Filhos.',
	'Class:IPBlock/Tab:childblock-count-percent-remain' => 'Espaço utilizado por Blocos Filhos no espaço restante: %1$.1f %%',
	'Class:IPBlock/Tab:subnet' => 'Sub-redes',
	'Class:IPBlock/Tab:subnet+' => 'Sub-redes anexadas a este bloco',
	'Class:IPBlock/Tab:subnet-count' => 'Sub-redes: %1$s',
	'Class:IPBlock/Tab:subnet-count-percent' => ' Espaço utilizado por Sub-redes.',
	'Class:IPBlock/Tab:subnet-count-percent-remain' => 'Espaço utilizado por Sub-redes no espaço restante: %1$.1f %%',
));

//
// Class: lnkBlockToLocation
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkIPBlockToLocation' => 'Vincular Bloco / Localização',
	'Class:lnkIPBlockToLocation+' => '',
	'Class:lnkIPBlockToLocation/Name' => '%1$s / %2$s',
	'Class:lnkIPBlockToLocation/Attribute:block_id' => 'Bloco',
	'Class:lnkIPBlockToLocation/Attribute:block_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:block_name' => 'Nome do Bloco',
	'Class:lnkIPBlockToLocation/Attribute:block_name+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_id' => 'Localização',
	'Class:lnkIPBlockToLocation/Attribute:location_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_name' => 'Nome da localização',
	'Class:lnkIPBlockToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Block
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv4Block' => 'Bloco de Sub-rede IPv4',
	'Class:IPv4Block+' => '',
	'Class:IPv4Block/ComplementaryName' => '%1$s - %2$s',
	'Class:IPv4Block/Attribute:parent_id' => 'Bloco pai',
	'Class:IPv4Block/Attribute:parent_id+' => '',
	'Class:IPv4Block/Attribute:parent_name' => 'Nome do bloco pai',
	'Class:IPv4Block/Attribute:parent_name+' => '',
	'Class:IPv4Block/Attribute:parent_origin' => 'Origem do bloco pai',
	'Class:IPv4Block/Attribute:parent_origin+' => '',
	'Class:IPv4Block/Attribute:firstip' => 'Primeiro IP',
	'Class:IPv4Block/Attribute:firstip+' => 'Primeiro Endereço IP do Bloco de Sub-rede',
	'Class:IPv4Block/Attribute:lastip' => 'Último IP',
	'Class:IPv4Block/Attribute:lastip+' => 'Último Endereço IP do Bloco de Sub-rede',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_min_size' => 'Tamanho mínimo dos Blocos de Sub-rede IPv4',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_min_size+' => '',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_cidr_aligned' => 'Alinhar Blocos de Sub-rede IPv4 ao CIDR',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_cidr_aligned+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_min_size' => 'Tamanho mínimo',
	'Class:IPv4Block/Attribute:ipv4_block_min_size+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned' => 'Alinhar bloco ao CIDR',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:default' => 'Alinhado com as configurações globais de IP',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:bca_no' => 'Forçar para Não',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:bca_yes' => 'Forçar para Sim',
));

//
// Class: IPSubnet
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPSubnet' => 'Sub-rede',
	'Class:IPSubnet+' => '',
	'Class:IPSubnet:baseinfo' => 'Informações Gerais',
	'Class:IPSubnet:ipinfo' => 'Informações de IP',
	'Class:IPSubnet:automation' => 'Automação',
	'Class:IPSubnet:localconfigparameters' => 'Configurações da sub-rede',
	'Class:IPSubnet/ComplementaryName' => '%1$s - %2$s',
	'Class:IPSubnet/Attribute:name' => 'Nome',
	'Class:IPSubnet/Attribute:name+' => '',
	'Class:IPSubnet/Attribute:type' => 'Tipo',
	'Class:IPSubnet/Attribute:type+' => '',
	'Class:IPSubnet/Attribute:allocation_date' => 'Data de alocação',
	'Class:IPSubnet/Attribute:allocation_date+' => 'Data em que a Sub-rede foi alocada',
	'Class:IPSubnet/Attribute:release_date' => 'Data de liberação',
	'Class:IPSubnet/Attribute:release_date+' => 'Data em que a sub-rede foi liberada e não é mais usada.',
	'Class:IPSubnet/Attribute:ip_occupancy' => 'IPs registrados',
	'Class:IPSubnet/Attribute:ip_occupancy+' => '',
	'Class:IPSubnet/Attribute:range_occupancy' => 'Faixas registradas',
	'Class:IPSubnet/Attribute:range_occupancy+' => '',
	'Class:IPSubnet/Attribute:alarm_water_mark' => 'Status do alarme de marca d\'água',
	'Class:IPSubnet/Attribute:alarm_water_mark+' => '',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:no_alarm' => 'Nenhum alarme foi enviado ainda',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:low_sent' => 'Alarme de marca d\'água baixa foi enviado',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:high_sent' => 'Alarme de marca d\'água alta foi enviado',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips' => 'Reservar IPs de Sub-rede, Gateway e Broadcast na Criação da Sub-rede',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips+' => '',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips/Value:reserve_no' => 'Não',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips/Value:reserve_yes' => 'Sim',
	'Class:IPSubnet/Attribute:reserve_subnet_ips' => 'Reservar IPs de sub-rede, gateway e broadcast',
	'Class:IPSubnet/Attribute:reserve_subnet_ips+' => 'Definir a política para a reserva de IPs de sub-rede, gateway e broadcast',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:default' => 'Alinhado com as configurações globais de IP',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:reserve_no' => 'Forçar para não',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:reserve_yes' => 'Forçar para sim',
	'Class:IPSubnet/Attribute:subnets_list' => 'Sub-redes NAT',
	'Class:IPSubnet/Attribute:subnets_list+' => 'Lista de sub-redes NAT',
	'Class:IPSubnet/Attribute:vlans_list' => 'VLANs',
	'Class:IPSubnet/Attribute:vlans_list+' => 'Lista de VLANs às quais a sub-rede pertence',
	'Class:IPSubnet/Attribute:vrfs_list' => 'VRFs',
	'Class:IPSubnet/Attribute:vrfs_list+' => 'Lista de VRFs às quais a sub-rede pertence',
	'Class:IPSubnet/Attribute:location_list' => 'Localizações',
	'Class:IPSubnet/Attribute:location_list+' => 'Localizações onde a Sub-rede se expande',
	'Class:IPSubnet/Attribute:summary/cell0' => 'IPs registrados por status',
	'Class:IPSubnet/Attribute:summary/cell0+' => 'Total: %1$s',
));

//
// Class extensions for IPSubnet
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPSubnet/Tab:globalparam' => 'Configurações Globais',
	'Class:IPSubnet/Tab:ipregistered' => 'IPs Registrados',
	'Class:IPSubnet/Tab:ipregistered+' => 'IPs registrados na Sub-rede',
	'Class:IPSubnet/Tab:ipregistered-count' => ' - %1$s Reservados, %2$s Alocados, %3$s Liberados, %4$s Não atribuídos de %5$s',
	'Class:IPSubnet/Tab:ipfree-explain' => 'Lista dos primeiros %1$s endereços IP livres:',
	'Class:IPSubnet/Tab:ipfree-explainbis' => 'Lista de TODOS os endereços IP livres:',
	'Class:IPSubnet/Tab:iprange' => 'Faixas de IP',
	'Class:IPSubnet/Tab:iprange+' => 'Faixas de IP que fazem parte da sub-rede',
	'Class:IPSubnet/Tab:iprange-count-percent' => ' espaço utilizado por Faixas de IP.',
	'Class:IPSubnet/Tab:notifications' => 'Notificações',
	'Class:IPSubnet/Tab:notifications+' => 'Notificações relacionadas a esta sub-rede',
	'Class:IPSubnet/Tab:requests' => 'Requisições de IP',
	'Class:IPSubnet/Tab:requests+' => 'Requisições de IP relacionadas a esta sub-rede',
	'Class:IPSubnet/Tab:changes' => 'Alterações de IP',
	'Class:IPSubnet/Tab:changes+' => 'Alterações de IP relacionadas a esta sub-rede',
));

//
// Class: lnkIPSubnetToIPSubnet
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkIPSubnetToIPSubnet' => 'Vincular Sub-rede / Sub-rede NAT',
	'Class:lnkIPSubnetToIPSubnet+' => '',
	'Class:lnkIPSubnetToIPSubnet/Name' => '%1$s / %2$s',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall' => 'Tipo de Sub-rede',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id' => 'Sub-rede',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id+' => 'Sub-rede a ser traduzida',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id' => 'Sub-rede NAT',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id+' => 'Sub-rede traduzida',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name' => 'Nome',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name+' => 'Nome da sub-rede',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name' => 'Nome',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name+' => 'Nome da sub-rede',
));

//
// Class: lnkIPSubnetToVLAN
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkIPSubnetToVLAN' => 'Vincular Sub-rede / VLAN',
	'Class:lnkIPSubnetToVLAN+' => '',
	'Class:lnkIPSubnetToVLAN/Name' => '%1$s / %2$s',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall' => 'Tipo de Sub-rede',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id' => 'Sub-rede',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name' => 'Nome da sub-rede',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag' => 'Tag da VLAN',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag+' => '',
));

//
// Class: lnkIPSubnetToVRF
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkIPSubnetToVRF' => 'Vincular Sub-rede / VRF',
	'Class:lnkIPSubnetToVRF+' => '',
	'Class:lnkIPSubnetToVRF/Name' => '%1$s / %2$s',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall' => 'Tipo de Sub-rede',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id' => 'Sub-rede',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name' => 'Nome da sub-rede',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id+' => '',
));

//
// Class: lnkIPSubnetToLocation
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkIPSubnetToLocation' => 'Vincular Sub-rede / Localização',
	'Class:lnkIPSubnetToLocation+' => '',
	'Class:lnkIPSubnetToLocation/Name' => '%1$s / %2$s',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id' => 'Sub-rede',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name' => 'Nome da sub-rede',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_id' => 'Localização',
	'Class:lnkIPSubnetToLocation/Attribute:location_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_name' => 'Nome da localização',
	'Class:lnkIPSubnetToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Subnet
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv4Subnet' => 'Sub-rede IPv4',
	'Class:IPv4Subnet+' => '',
	'Class:IPv4Subnet/ComplementaryName' => '%1$s - %2$s - %3$s',
	'Class:IPv4Subnet/Attribute:block_id' => 'Bloco de Sub-rede',
	'Class:IPv4Subnet/Attribute:block_id+' => '',
	'Class:IPv4Subnet/Attribute:block_name' => 'Nome do bloco',
	'Class:IPv4Subnet/Attribute:block_name+' => '',
	'Class:IPv4Subnet/Attribute:ip' => 'IP da Sub-rede',
	'Class:IPv4Subnet/Attribute:ip+' => '',
	'Class:IPv4Subnet/Attribute:mask' => 'Máscara',
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
	'Class:IPv4Subnet/Attribute:gatewayip' => 'IP do Gateway',
	'Class:IPv4Subnet/Attribute:gatewayip+' => '',
	'Class:IPv4Subnet/Attribute:broadcastip' => 'IP de Broadcast',
	'Class:IPv4Subnet/Attribute:broadcastip+' => '',
	'Class:IPv4Subnet/Attribute:summary' => 'Resumo',
	'Class:IPv4Subnet/Attribute:ipconfig_ipv4_gateway_ip_format' => 'Formato padrão do IP do Gateway',
	'Class:IPv4Subnet/Attribute:ipconfig_ipv4_gateway_ip_format+' => '',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format' => 'Formato do IP do Gateway',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format+' => '',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:default' => 'Alinhado com as configurações globais de IP',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1' => 'Forçar para IP da sub-rede + 1',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1' => 'Forçar para IP de broadcast - 1',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:free_setup' => 'Forçar para alocação livre',
));

//
// Class: IPRange
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPRange' => 'Faixa de IP',
	'Class:IPRange+' => '',
	'Class:IPRange:baseinfo' => 'Informações Gerais',
	'Class:IPRange:ipinfo' => 'Informações de IP',
	'Class:IPRange/Attribute:range' => 'Nome',
	'Class:IPRange/Attribute:range+' => '',
	'Class:IPRange/Attribute:usage_id' => 'Uso',
	'Class:IPRange/Attribute:usage_id+' => 'Uso que está sendo feito da faixa',
	'Class:IPRange/Attribute:usage_name' => 'Nome de Uso',
	'Class:IPRange/Attribute:usage_name+' => '',
	'Class:IPRange/Attribute:allocation_date' => 'Data de alocação',
	'Class:IPRange/Attribute:allocation_date+' => 'Data em que a faixa de IP foi alocada',
	'Class:IPRange/Attribute:dhcp' => 'Faixa DHCP',
	'Class:IPRange/Attribute:dhcp+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no' => 'Não',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes' => 'Sim',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes+' => '',
	'Class:IPRange/Attribute:occupancy' => 'IPs registrados',
	'Class:IPRange/Attribute:occupancy+' => '',
	'Class:IPRange/Attribute:functionalcis_list' => 'Servidores DHCP',
	'Class:IPRange/Attribute:functionalcis_list+' => 'Lista de todos os servidores DHCP responsáveis por esta faixa DHCP',
));

//
// Class extensions for IPRange
//                                                       

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPRange/Tab:ipregistered' => 'IPs Registrados',
	'Class:IPRange/Tab:ipregistered+' => 'IPs registrados dentro da Faixa de IP',
	'Class:IPRange/Tab:ipregistered-count' => ' - %1$s Reservados, %2$s Alocados, %3$s Liberados, %4$s Não atribuídos de %5$s',
	'Class:IPRange/Tab:ipfree-explain' => 'Lista dos primeiros %1$s endereços IP livres:',
	'Class:IPRange/Tab:ipfree-explainbis' => 'Lista de TODOS os endereços IP livres:',
	'Class:IPRange/Tab:notifications' => 'Notificações',
	'Class:IPRange/Tab:notifications+' => 'Notificações relacionadas a esta faixa de IP',
));

//
// Class: lnkFunctionalCIToIPRange
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkFunctionalCIToIPRange' => 'Vincular CI Funcional / Faixa de IP',
	'Class:lnkFunctionalCIToIPRange+' => '',
	'Class:lnkFunctionalCIToIPRange/Name' => '%1$s / %2$s',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id_finalclass_recall' => 'Tipo de Faixa de IP',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id_finalclass_recall+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id' => 'Faixa de IP',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_name' => 'Nome da Faixa de IP',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_name+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_id' => 'CI',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_id+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_name' => 'Nome do CI',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_name+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role' => 'Função',
	'Class:lnkFunctionalCIToIPRange/Attribute:role+' => 'Função do servidor para a faixa',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:single' => 'Único',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:single+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:split_scope' => 'Escopo dividido',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:split_scope+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:primary' => 'Primário',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:primary+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:secondary' => 'Secundário',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:secondary+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:active' => 'Ativo',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:active+' => '',
));

//
// Class: IPv4Range
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv4Range' => 'Faixa IPv4',
	'Class:IPv4Range+' => '',
	'Class:IPv4Range/ComplementaryName' => '%1$s - %2$s',
	'Class:IPv4Range/Attribute:subnet_id' => 'Sub-rede',
	'Class:IPv4Range/Attribute:subnet_id+' => '',
	'Class:IPv4Range/Attribute:subnet_ip' => 'IP da Sub-rede',
	'Class:IPv4Range/Attribute:subnet_ip+' => '',
	'Class:IPv4Range/Attribute:firstip' => 'Primeiro IP da Faixa',
	'Class:IPv4Range/Attribute:firstip+' => '',
	'Class:IPv4Range/Attribute:lastip' => 'Último IP da Faixa',
	'Class:IPv4Range/Attribute:lastip+' => '',
));

//
// Class: IPAddress
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPAddress' => 'Endereço IP',
	'Class:IPAddress+' => '',
	'Class:IPAddress:baseinfo' => 'Informações Gerais',
	'Class:IPAddress:dnsinfo' => 'Informações de DNS',
	'Class:IPAddress:ipinfo' => 'Informações de IP',
	'Class:IPAddress:localconfigparameters' => 'Configurações de IP',
	'Class:IPAddress/ComplementaryName' => '%1$s - %2$s',
	'Class:IPAddress/Attribute:short_name' => 'Nome Curto',
	'Class:IPAddress/Attribute:short_name+' => 'Rótulo esquerdo do FQDN',
	'Class:IPAddress/Attribute:domain_id' => 'Domínio DNS',
	'Class:IPAddress/Attribute:domain_id+' => '',
	'Class:IPAddress/Attribute:domain_name' => 'Nome do Domínio',
	'Class:IPAddress/Attribute:domain_name+' => 'Nome do domínio DNS',
	'Class:IPAddress/Attribute:fqdn' => 'FQDN',
	'Class:IPAddress/Attribute:fqdn+' => 'Nome de Domínio Totalmente Qualificado',
	'Class:IPAddress/Attribute:aliases' => 'Apelidos',
	'Class:IPAddress/Attribute:aliases+' => 'Lista de apelidos usados para o FQDN',
	'Class:IPAddress/Attribute:usage_id' => 'Uso',
	'Class:IPAddress/Attribute:usage_id+' => '',
	'Class:IPAddress/Attribute:usage_name' => 'Nome de uso',
	'Class:IPAddress/Attribute:usage_name+' => '',
	'Class:IPAddress/Attribute:ipinterface_id' => 'Interface IP',
	'Class:IPAddress/Attribute:ipinterface_id+' => '',
	'Class:IPAddress/Attribute:ipinterface_name' => 'Nome da Interface IP',
	'Class:IPAddress/Attribute:ipinterface_name+' => '',
	'Class:IPAddress/Attribute:allocation_date' => 'Data de alocação',
	'Class:IPAddress/Attribute:allocation_date+' => 'Data em que o endereço IP foi alocado',
	'Class:IPAddress/Attribute:release_date' => 'Data de liberação',
	'Class:IPAddress/Attribute:release_date+' => 'Data em que o endereço IP foi liberado e não é mais usado.',
	'Class:IPAddress/Attribute:ip_list' => 'IPs NAT',
	'Class:IPAddress/Attribute:ip_list+' => 'Lista de IPs NAT',
	'Class:IPAddress/Attribute:finalclass' => 'Classe',
	'Class:IPAddress/Attribute:finalclass+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name' => 'Permitir Nomes Duplicados',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_no' => 'Não',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_yes' => 'Sim',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPAddress/Attribute:ipconfig_:ip_allow_duplicate_name/Value:ipdup_dualstack' => 'Dual stack',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_dualstack+' => 'Duplicados são autorizados entre IPv4 e IPv6 únicos',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name' => 'Permitir Nomes Duplicados',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:default' => 'Alinhado com as configurações globais de IP',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_no' => 'Não',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_yes' => 'Sim',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack' => 'Dual stack',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack+' => 'Duplicados são autorizados entre IPv4 e IPv6 únicos',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign' => 'Fazer ping no IP antes de atribuí-lo',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign+' => '',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_no' => 'Não',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_no+' => '',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_yes' => 'Sim',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_yes+' => '',
	'Class:IPAddress/Attribute:ping_before_assign' => 'Fazer ping no IP antes de atribuí-lo',
	'Class:IPAddress/Attribute:ping_before_assign+' => '',
	'Class:IPAddress/Attribute:ping_before_assign/Value:default' => 'Alinhado com as configurações globais de IP',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_no' => 'Não',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_no+' => '',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_yes' => 'Sim',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_yes+' => '',
));

//
// Class extensions for IPAddress
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPAddress/Tab:globalparam' => 'Configurações Globais',
	'Class:IPAddress/Tab:parents' => 'Pais',
	'Class:IPAddress/Tab:ip_list' => 'IPs NAT',
	'Class:IPAddress/Tab:ip_list+' => 'Lista de IPs NAT',
	'Class:IPAddress/Tab:ci_list' => 'CIs',
	'Class:IPAddress/Tab:ci_list+' => 'Lista de CIs apontando para este IP:',
	'Class:IPAddress/Tab:ci_list_class' => '%1$ss',
	'Class:IPAddress/Tab:NoCi' => 'Nenhum CI',
	'Class:IPAddress/Tab:NoCi+' => 'Nenhum Item de Configuração está usando este IP',
	'Class:IPAddress/Tab:requests' => 'Requisições de IP',
	'Class:IPAddress/Tab:requests+' => 'Requisições de IP relacionadas a este IP',
	'Class:IPAddress/Tab:norequests' => 'Nenhuma requisição de IP',
	'Class:IPAddress/Tab:norequests+' => 'Nenhuma requisição de IP relacionada a este IP',
	'Class:IPAddress/Tab:changes' => 'Alterações de IP',
	'Class:IPAddress/Tab:changes+' => 'Alterações de IP relacionadas a este IP',
));

//
// Class: lnkIPAdressToIPAddress
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkIPAdressToIPAddress' => 'Vincular IP / IPs NAT',
	'Class:lnkIPAdressToIPAddress+' => '',
	'Class:lnkIPAdressToIPAddress/Name' => '%1$s / %2$s',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall' => 'Tipo de IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id' => 'Endereço IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id+' => 'IP a ser traduzido',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id' => 'IP NAT',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id+' => 'IP traduzido',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name' => 'Nome Curto do IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name+' => 'Rótulo esquerdo do FQDN',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name' => 'Nome de Domínio do IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name+' => 'Nome do domínio DNS',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name' => 'Nome Curto do IP NAT',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name+' => 'Rótulo esquerdo do FQDN',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name' => 'Nome de Domínio do IP NAT',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name+' => 'Nome do domínio DNS',
	'Class:lnkIPAdressToIPAddress/Attribute:external_service_port' => 'Porta de serviço externa',
	'Class:lnkIPAdressToIPAddress/Attribute:external_service_port+' => 'Porta externa ou de origem a ser usada com encaminhamento de porta',
	'Class:lnkIPAdressToIPAddress/Attribute:map_to_port' => 'Mapear para a porta',
	'Class:lnkIPAdressToIPAddress/Attribute:map_to_port+' => 'Porta interna ou de destino a ser usada com encaminhamento de porta',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol' => 'Protocolo',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol+' => 'Protocolo(s) autorizado(s). Deixe em branco para todos',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:udp' => 'UDP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:tcp' => 'TCP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:both' => 'UDP / TCP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:sctp' => 'SCTP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:icmp' => 'ICMP',
));

//
// Class: lnkIPInterfaceToIPAddress
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkIPInterfaceToIPAddress' => 'Vincular Interface IP / Endereço IP',
	'Class:lnkIPInterfaceToIPAddress+' => '',
	'Class:lnkIPInterfaceToIPAddress/Name' => '%1$s / %2$s',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall' => 'Tipo de IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id' => 'Interface IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name' => 'Nome da Interface IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id' => 'Endereço IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:usage_id' => 'Uso do Endereço IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:usage_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_org_name' => 'Nome da organização do Endereço IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_org_name+' => '',
));

//
// Class: IPv4Address
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPv4Address' => 'Endereço IPv4',
	'Class:IPv4Address+' => '',
	'Class:IPv4Address/Attribute:subnet_id' => 'Sub-rede',
	'Class:IPv4Address/Attribute:subnet_id+' => 'Sub-rede IPv4',
    'Class:IPv4Address/Attribute:subnet_ip' => 'IP da Sub-rede',
    'Class:IPv4Address/Attribute:subnet_ip+' => '',
	'Class:IPv4Address/Attribute:range_id' => 'Faixa',
	'Class:IPv4Address/Attribute:range_id+' => 'Faixa IPv4',
	'Class:IPv4Address/Attribute:ip' => 'Endereço',
	'Class:IPv4Address/Attribute:ip+' => 'Endereço IPv4',
));

//
// Class: IPRangeUsage
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPRangeUsage' => 'Uso de Faixa de IP',
	'Class:IPRangeUsage+' => 'Para que uma Faixa de endereços IP é usada',
	'Class:IPRangeUsage/Attribute:org_id' => 'Organização',
	'Class:IPRangeUsage/Attribute:org_id+' => '',
	'Class:IPRangeUsage/Attribute:org_name' => 'Nome da Organização',
	'Class:IPRangeUsage/Attribute:org_name+' => '',
	'Class:IPRangeUsage/Attribute:name' => 'Nome',
	'Class:IPRangeUsage/Attribute:name+' => '',
	'Class:IPRangeUsage/Attribute:description' => 'Descrição',
	'Class:IPRangeUsage/Attribute:description+' => '',
	'Class:IPRangeUsage/Attribute:ipranges_list' => 'Faixas de IP',
	'Class:IPRangeUsage/Attribute:ipranges_list+' => 'Faixas de IP com esse uso',
));

//
// Class: IPBlockType
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPBlockType' => 'Tipo de Bloco de IP',
	'Class:IPBlockType+' => 'Tipo de bloco',
	'Class:IPBlockType/Attribute:name' => 'Nome',
	'Class:IPBlockType/Attribute:name+' => '',
	'Class:IPBlockType/Attribute:description' => 'Descrição',
	'Class:IPBlockType/Attribute:description+' => '',
	'Class:IPBlockType/Attribute:blocks_list' => 'Blocos',
	'Class:IPBlockType/Attribute:blocks_list+' => 'Blocos de sub-rede desse tipo',
));

//
// Class: IPTriggerOnWaterMark
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPTriggerOnWaterMark' => 'Gatilho (ao atingir uma marca d\'água relacionada a IP)',
	'Class:IPTriggerOnWaterMark+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_id' => 'Organização',
	'Class:IPTriggerOnWaterMark/Attribute:org_id+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_name' => 'Nome da Organização',
	'Class:IPTriggerOnWaterMark/Attribute:org_name+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:target_class' => 'Classe Alvo',
	'Class:IPTriggerOnWaterMark/Attribute:target_class+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event' => 'Evento',
	'Class:IPTriggerOnWaterMark/Attribute:event+' => 'Evento gerado quando o gatilho é ativado',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low' => 'Marca d\'água baixa foi cruzada',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high' => 'Marca d\'água alta foi cruzada',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high+' => '',
));

//
// Class: IPObjTemplate
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPObjTemplate' => 'Modelo de IP',
	'Class:IPObjTemplate+' => '',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id' => 'Subcategoria de Serviço',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id+' => '',
	'Class:IPObjTemplate/Attribute:request_type' => 'Tipo de Requisição',
	'Class:IPObjTemplate/Attribute:request_type+' => '',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_create' => 'Criação de IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_change' => 'Alteração de IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_delete' => 'Exclusão de IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_create' => 'Criação de Sub-rede',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_change' => 'Alteração de Sub-rede',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_delete' => 'Exclusão de Sub-rede',
));

//
// Application Menu
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Menu:IPManagement' => 'Gerenciamento de IP',
	'Menu:IPManagement+' => 'Gerenciamento de IP',
	'Menu:IPManagement:Overview:Total' => 'Total: %1s',
	'Menu:IPSpace' => 'Espaço IP',
	'Menu:IPSpace+' => 'Espaço IP',
	'Menu:IPSpace:IPv4Objects' => 'Objetos IPv4',
	'Menu:IPSpace:IPv4Objects+' => 'Objetos IPv4',
	'Menu:IPSpace:Options' => 'Parâmetros',
	'Menu:IPSpace:Options+' => 'Parâmetros',
	'Menu:NewIPObject' => 'Novo objeto IP',
	'Menu:NewIPObject+' => 'Criação de um novo objeto IP',
	'Menu:SearchIPObject' => 'Buscar objeto IP',
	'Menu:SearchIPObject+' => 'Buscar por um objeto IP',
	'Menu:IPv4ShortCut' => 'Atalhos IPv4',
	'Menu:IPv4ShortCut+' => 'Atalho que agrupa objetos IPv4',
	'Menu:IPv4Block' => 'Blocos de Sub-rede',
	'Menu:IPv4Block+' => 'Blocos de Sub-rede IPv4',
	'Menu:IPv4Subnet' => 'Sub-redes',
	'Menu:IPv4Subnet+' => 'Sub-redes IPv4',
	'Menu:IPv4Subnet:Allocated' => 'Sub-redes Alocadas',
	'Menu:IPv4Subnet:Allocated+' => 'Lista de Sub-redes IPv4 alocadas',
	'Menu:IPv4Range' => 'Faixas de IP',
	'Menu:IPv4Range+' => 'Faixas IPv4',
	'Menu:IPv4Address' => 'Endereços IP',
	'Menu:IPv4Address+' => 'Endereços IPv4',
	'Menu:IPTools' => 'Ferramentas',
	'Menu:IPTools+' => 'Conjunto de ferramentas de IP',
	'Menu:FindSpace' => 'Encontrar Espaço',
	'Menu:FindSpace+' => 'Ferramenta para encontrar e alocar espaço IP',
	'Menu:SubnetCalculator' => 'Calculadora de Sub-rede',
	'Menu:SubnetCalculator+' => 'Ferramenta para calcular parâmetros de sub-rede a partir de um IP e uma máscara',
	'Menu:Options' => 'Parâmetros',
	'Menu:Options+' => 'Parâmetros',
	'Menu:Domain' => 'Domínios',
	'Menu:Domain+' => 'Nomes de Domínio',
	'Menu:IPTemplate' => 'Modelos de IP',
	'Menu:IPTemplate+' => 'Modelos de IP',
	'Menu:IPMgmt:Typology' => 'Configuração da tipologia do espaço IP',
	'Menu:IPMgmt:Typology+' => '',

	'UI:IPMgmtWelcomeOverview:Title' => 'Meu Painel',

	// Menu separator in Action menus
	'UI:IPManagement:Action:MenuSeparator' => '<hr class="menu-separator"/>',
	'UI:IPManagement:Action:Error::WrongActionForClass' => 'Esta ação não pode ser aplicada a essa classe de objeto!',

//
// Management of IPBlocks
//
	// Creation Management
	'UI:IPManagement:Action:New:IPBlock:Reverted' => 'O primeiro IP do Bloco de Sub-rede é maior que o último IP!',
	'UI:IPManagement:Action:New:IPBlock:SmallerThanMinSize' => 'O tamanho do bloco não pode ser menor que %1$s para a organização %2$s!',
	'UI:IPManagement:Action:New:IPBlock:NotCIDRAligned' => 'O bloco não está alinhado ao CIDR!',
	'UI:IPManagement:Action:New:IPBlock:NotInParent' => 'O Bloco de Sub-rede não está estritamente contido no pai selecionado!',
	'UI:IPManagement:Action:New:IPBlock:NameExist' => 'O nome do Bloco de Sub-rede já existe!',
	'UI:IPManagement:Action:New:IPBlock:Collision0' => 'O Bloco de Sub-rede já existe!',
	'UI:IPManagement:Action:New:IPBlock:Collision1' => 'Colisão de Bloco de Sub-rede: o primeiro IP pertence a um bloco existente!',
	'UI:IPManagement:Action:New:IPBlock:Collision2' => 'Colisão de Bloco de Sub-rede: o último IP pertence a um bloco existente!',
	'UI:IPManagement:Action:Modify:IPBlock:ParentIdNull' => 'As sub-redes filhas do bloco %1$s não podem ser anexadas a um bloco pai inexistente.',

	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPBlock:Reverted' => 'O novo primeiro IP do Bloco de Sub-rede é maior que o novo último IP!',
	'UI:IPManagement:Action:Shrink:IPBlock:IPOutOfBlock' => 'Os novos IPs não estão todos dentro do bloco!',
	'UI:IPManagement:Action:Shrink:IPBlock:NoChange' => 'Nenhuma alteração foi solicitada.',
	'UI:IPManagement:Action:Shrink:IPBlock:NotCIDRAligned' => 'O bloco não está alinhado ao CIDR!',
	'UI:IPManagement:Action:Shrink:IPBlock:BlockAccrossBorder' => 'Um bloco de sub-rede filho atravessa as novas fronteiras!',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetAccrossBorder' => 'Uma sub-rede anexada ao bloco atravessa as novas fronteiras!',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetBecomesOrhpean' => 'As sub-redes filhas não terão bloco pai após a redução!',
	'UI:IPManagement:Action:Shrink:IPBlock:Done' => '%1$s %2$s foi reduzido.',

	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPBlock:IPOutOfBlock' => 'O IP de divisão está fora do bloco!',
	'UI:IPManagement:Action:Split:IPBlock:SmallerThanMinSize' => 'O tamanho do bloco não pode ser menor que %1$s!',
	'UI:IPManagement:Action:Split:IPBlock:NotCIDRAligned' => 'Os blocos não estão alinhados ao CIDR!',
	'UI:IPManagement:Action:Split:IPBlock:BlockAccrossBorder' => 'Um bloco de sub-rede filho atravessa as novas fronteiras!',
	'UI:IPManagement:Action:Split:IPBlock:SubnetAccrossBorder' => 'Uma sub-rede anexada ao bloco atravessa as novas fronteiras!',
	'UI:IPManagement:Action:Split:IPBlock:EmptyNewName' => 'O nome do novo Bloco de Sub-rede está vazio!',
	'UI:IPManagement:Action:Split:IPBlock:NameExist' => 'O nome do novo Bloco de Sub-rede já existe!',
	'UI:IPManagement:Action:Split:IPBlock:Done' => '%1$s %2$s foi dividido.',

	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPBlock:Reverted' => 'O novo primeiro IP do Bloco de Sub-rede é maior que o novo último IP!',
	'UI:IPManagement:Action:Expand:IPBlock:IPOutOfBlock' => 'Os novos IPs não estão todos fora do bloco!',
	'UI:IPManagement:Action:Expand:IPBlock:NoChange' => 'Nenhuma alteração foi solicitada.',
	'UI:IPManagement:Action:Expand:IPBlock:NotCIDRAligned' => 'O bloco não está alinhado ao CIDR!',
	'UI:IPManagement:Action:Expand:IPBlock:BlockBiggerThanParent' => 'O bloco não pode ser maior que seu pai!',
	'UI:IPManagement:Action:Expand:IPBlock:DelegatedBlockAccrossBorder' => 'O bloco não pode sobrepor um bloco delegado!',
	'UI:IPManagement:Action:Expand:IPBlock:BlockAccrossBorder' => 'Um bloco de sub-rede irmão atravessa as novas fronteiras!',
	'UI:IPManagement:Action:Expand:IPBlock:SubnetAccrossBorder' => 'Uma sub-rede anexada ao bloco pai atravessa as novas fronteiras!',
	'UI:IPManagement:Action:Expand:IPBlock:Done' => '%1$s %2$s foi expandido.',

	// Find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPBlock:RequestedSpaceBiggerThanBlockSize' => 'O endereço IP a partir do qual procurar espaço pertence ao bloco de sub-rede %1$s e o espaço solicitado é maior que o tamanho desse bloco!',
	'UI:IPManagement:Action:DoFindSpace:IPBlock:NoSpaceFound' => 'Não há espaço livre suficiente no bloco %1$s para atender à sua solicitação!',
	'IPManagement:Action:DoFindSpace:IPBlock:IPToStartFrom' => 'a partir do IP %1$s',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPBlock:NoChildOrg' => 'A organização do bloco não tem filhos!',
	'UI:IPManagement:Action:Delegate:IPBlock:NoOtherOrg' => 'Não há outra organização além da organização do bloco!',
	'UI:IPManagement:Action:Delegate:IPBlock:IsDelegated' => 'O bloco já está delegado!',
	'UI:IPManagement:Action:Delegate:IPBlock:WrongLevelOfOrganization' => 'A alteração de delegação deve ser feita para uma organização irmã!',
	'UI:IPManagement:Action:Delegate:IPBlock:NoChangeOfOrganization' => 'Nenhuma alteração foi solicitada!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocks' => 'O bloco tem blocos filhos!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnets' => 'O bloco tem sub-redes filhas!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithDelegatedBlockFromOtherOrg' => 'Já existem alguns blocos delegados de outras organizações nesta faixa!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfTargetOrg' => 'O bloco conflita com um bloco da organização de destino!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfParentOrg' => 'O bloco conflita com um bloco da organização pai!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocksInParent' => 'O bloco tem blocos filhos na organização pai!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnetsInParent' => 'O bloco tem sub-redes filhas na organização pai!',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPBlock:CannotBeUndelegated' => 'O bloco não pode ter a delegação removida: %1$s',
	'UI:IPManagement:Action:Undelegate:IPBlock:IsNotDelegated' => 'O bloco não está delegado!',
	'UI:IPManagement:Action:Undelegate:IPBlock:HasChildBlocks' => 'O bloco tem blocos filhos!',
	'UI:IPManagement:Action:Undelegate:IPBlock:HasChildSubnets' => 'O bloco tem sub-redes filhas!',

	// Display pointers to previous and next blocks
	'UI:IPManagement:Action:DisplayPrevious:IPBlock' => 'Anterior',
	'UI:IPManagement:Action:DisplayNext:IPBlock' => 'Próximo',

//
// Management of IPv4Blocks
//
	// Display details of subnet blocks
	'UI:IPManagement:Action:Details:IPv4Block' => 'Detalhes',
	'UI:IPManagement:Action:Details:IPv4Block+' => '',

	// Display list of subnet blocks
	'UI:IPManagement:Action:DisplayList:IPv4Block' => 'Exibir Lista',
	'UI:IPManagement:Action:DisplayList:IPv4Block+' => '',
	'UI:IPManagement:Action:DisplayList:IPv4Block:PageTitle_Class' => 'Blocos de Sub-rede IPv4',
	'UI:IPManagement:Action:DisplayList:IPv4Block:Title_Class' => 'Blocos de Sub-rede IPv4',

	// Display tree of subnet blocks
	'UI:IPManagement:Action:DisplayTree:IPv4Block' => 'Exibir Árvore',
	'UI:IPManagement:Action:DisplayTree:IPv4Block+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:PageTitle_Class' => 'Blocos de Sub-rede IPv4',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:Title_Class' => 'Blocos de Sub-rede IPv4',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:OrgName' => 'Organização %1$s',

	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPv4Block' => 'Reduzir',
	'UI:IPManagement:Action:Shrink:IPv4Block+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Block:Summary' => 'Resumo',
	'UI:IPManagement:Action:Shrink:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Block:PageTitle_Object_Class' => 'Redução de %1$s - %2$s',
	'UI:IPManagement:Action:Shrink:IPv4Block:Title_Class_Object' => 'Reduzir %1$s: %2$s',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewFirstIP' => 'Novo Primeiro IP do Bloco:',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewLastIP' => 'Novo Último IP do Bloco:',
	'UI:IPManagement:Action:Shrink:IPv4Block:IsDelegated' => 'Este bloco está delegado e, portanto, não pode ser reduzido!',
	'UI:IPManagement:Action:Shrink:IPv4Block:CannotBeShrunk' => 'O bloco não pode ser reduzido: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Block:SmallerThanMinSize' => 'O tamanho do bloco não pode ser menor que %1$s!',
	'UI:IPManagement:Action:Shrink:IPv4Block:Done' => '%1$s %2$s foi reduzido.',

	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv4Block' => 'Dividir',
	'UI:IPManagement:Action:Split:IPv4Block+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:Summary' => 'Resumo',
	'UI:IPManagement:Action:Split:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:PageTitle_Object_Class' => 'Divisão de %1$s - %2$s',
	'UI:IPManagement:Action:Split:IPv4Block:Title_Class_Object' => 'Dividir %1$s: %2$s',
	'UI:IPManagement:Action:Split:IPv4Block:At' => 'Primeiro IP do novo Bloco de Sub-rede:',
	'UI:IPManagement:Action:Split:IPv4Block:NameNewBlock' => 'Nome do novo Bloco de Sub-rede:',
	'UI:IPManagement:Action:Split:IPv4Block:IsDelegated' => 'Este bloco está delegado e, portanto, não pode ser dividido!',
	'UI:IPManagement:Action:Split:IPv4Block:CannotBeSplit' => 'O bloco não pode ser dividido: %1$s',
	'UI:IPManagement:Action:Split:IPv4Block:SmallerThanMinSize' => 'O tamanho do bloco não pode ser menor que %1$s!',
	'UI:IPManagement:Action:Split:IPv4Block:Done' => '%1$s %2$s foi dividido.',

	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv4Block' => 'Expandir',
	'UI:IPManagement:Action:Expand:IPv4Block+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary' => 'Resumo',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:PageTitle_Object_Class' => 'Expansão de %1$s - %2$s',
	'UI:IPManagement:Action:Expand:IPv4Block:Title_Class_Object' => 'Expandir %1$s: %2$s',
	'UI:IPManagement:Action:Expand:IPv4Block:NewFirstIP' => 'Novo Primeiro IP do Bloco:',
	'UI:IPManagement:Action:Expand:IPv4Block:NewLastIP' => 'Novo Último IP do Bloco:',
	'UI:IPManagement:Action:Expand:IPv4Block:IsDelegated' => 'Este bloco está delegado e, portanto, não pode ser expandido!',
	'UI:IPManagement:Action:Expand:IPv4Block:CannotBeExpanded' => 'O bloco não pode ser expandido: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Block:SmallerThanMinSize' => 'O tamanho do bloco não pode ser menor que %1$s!',
	'UI:IPManagement:Action:Expand:IPv4Block:Done' => '%1$s %2$s foi expandido.',

	// List space action on subnet blocks
	'UI:IPManagement:Action:ListSpace:IPv4Block' => 'Listar Espaço',
	'UI:IPManagement:Action:ListSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Espaço',
	'UI:IPManagement:Action:ListSpace:IPv4Block:Title_Class_Object' => 'Espaço dentro de %1$s: %2$s',
	'UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpace' => 'Livre [%1$s - %2$s] - %3$s IPs - %4$.2f %%',
	'UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpaceNoPercent' => 'Livre [%1$s - %2$s] - %3$s IPs',

	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv4Block' => 'Encontrar Espaço',
	'UI:IPManagement:Action:FindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Encontrar espaço',
	'UI:IPManagement:Action:FindSpace:IPv4Block:Title_Class_Object' => 'Procurar por espaço dentro de %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv4Block:SizeOfSpace' => 'Tamanho do espaço a ser procurado:',
	'UI:IPManagement:Action:FindSpace:IPv4Block:MaxNumberOfOffers' => 'Número máximo de ofertas:',

	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv4Block' => 'Espaço Encontrado',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Encontrar espaço',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Title_Class_Object' => 'Espaço encontrado dentro de %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Summary' => 'Primeiros %1$s /%2$s dentro de ',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsBlock' => 'Criar como um bloco filho',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsSubnet' => 'Criar como uma sub-rede',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv4Block' => 'Delegar',
	'UI:IPManagement:Action:Delegate:IPv4Block:PageTitle_Object_Class' => '%1$s - Delegar',
	'UI:IPManagement:Action:Delegate:IPv4Block:Title_Class_Object' => 'Delegar %1$s %2$s para organização',
	'UI:IPManagement:Action:Delegate:IPv4Block:ChildBlock' => 'Organização para a qual delegar o Bloco:',
	'UI:IPManagement:Action:Delegate:IPv4Block:NoChildOrg' => 'A organização do bloco não possui filhos e, portanto, o bloco não pode ser delegado!',
	'UI:IPManagement:Action:Delegate:IPv4Block:NoOtherOrg' => 'Não há outra organização além da organização do bloco!',
	'UI:IPManagement:Action:Delegate:IPv4Block:IsDelegated' => 'O bloco já está delegado!',
	'UI:IPManagement:Action:Delegate:IPv4Block:CannotBeDelegated' => 'O bloco não pode ser delegado: %1$s',
	'UI:IPManagement:Action:Delegate:IPv4Block:Done' => '%1$s %2$s foi delegado.',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPv4Block:CannotBeUndelegated' => 'A delegação do bloco não pode ser removida: %1$s',
	'UI:IPManagement:Action:Undelegate:IPv4Block' => 'Remover delegação',
	'UI:IPManagement:Action:Undelegate:IPv4Block:PageTitle_Object_Class' => '%1$s - Remover delegação',
	'UI:IPManagement:Action:Undelegate:IPv4Block:Done' => 'A delegação de %1$s %2$s foi removida.',

//
// Management of Subnets
//
	// Creation Management
	'UI:IPManagement:Action:New:IPSubnet:IpCannotChange' => 'O IP da sub-rede não pode ser modificado! ',
	'UI:IPManagement:Action:New:IPSubnet:MaskCannotChange' => 'A Máscara da sub-rede não pode ser modificada!',
	'UI:IPManagement:Action:New:IPSubnet:IpIncorrect' => 'O IP da sub-rede não é consistente com a Máscara!',
	'UI:IPManagement:Action:New:IPSubnet:NotInBlock' => 'A sub-rede não está contida no bloco selecionado!',
	'UI:IPManagement:Action:New:IPSubnet:Collision0' => 'A sub-rede já existe!',
	'UI:IPManagement:Action:New:IPSubnet:Collision1' => 'Colisão de sub-rede: o IP da sub-rede pertence a uma sub-rede existente!',
	'UI:IPManagement:Action:New:IPSubnet:Collision2' => 'Colisão de sub-rede: o IP de broadcast pertence a uma sub-rede existente!',
	'UI:IPManagement:Action:New:IPSubnet:Collision3' => 'Colisão de sub-rede: a nova sub-rede inclui uma existente!',
	'UI:IPManagement:Action:New:IPSubnet:GatewayOutOfSubnet' => 'O IP do Gateway não está dentro dos limites da sub-rede!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPSubnet' => 'Calculadora de Sub-rede',
	'UI:IPManagement:Action:Calculator:IPSubnet:SelectSubnetType' => 'Selecione o tipo de sub-rede',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:SelectCreation' => 'Você pode registrar os blocos de sub-rede ou sub-redes relacionados:',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CreateSubnet' => 'Criar a sub-rede',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateSubnet:MaskIsToSmall' => 'A máscara é muito pequena: a sub-rede não pode ser criada!',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CreateBlock' => 'Criar o bloco de sub-rede',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateBlock:MaskIsToBig' => 'A máscara é muito grande: o bloco de sub-rede não pode ser criado!',

	// Display pointers to previous and next Subnets
	'UI:IPManagement:Action:DisplayPrevious:IPSubnet' => 'Anterior',
	'UI:IPManagement:Action:DisplayNext:IPSubnet' => 'Próximo',

//
// Management of IPv4 Subnets
//
	// Display details of subnet
	'UI:IPManagement:Action:Details:IPv4Subnet' => 'Detalhes',
	'UI:IPManagement:Action:Details:IPv4Subnet+' => '',

	// Display list of subnets
	'UI:IPManagement:Action:DisplayList:IPv4Subnet' => 'Exibir Lista',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet+' => '',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet:PageTitle_Class' => 'Sub-redes IPv4',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet:Title_Class' => 'Sub-redes IPv4',

	// Display tree of subnets
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet' => 'Exibir Árvore',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:PageTitle_Class' => 'Sub-redes IPv4',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:Title_Class' => 'Sub-redes IPv4',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:OrgName' => 'Organização %1$s',

	// Find space action on subnets
	'UI:IPManagement:Action:FindSpace:IPv4Subnet' => 'Encontrar espaço',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - Encontrar espaço',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:Title_Class_Object' => 'Procurar por espaço IP dentro de %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeTooSmall' => 'A sub-rede é muito pequena para procurar espaço. Por favor, cancele!',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeOfRange' => 'Tamanho do espaço a ser procurado:',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:MaxNumberOfOffers' => 'Número máximo de ofertas:',

	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet' => 'Espaço Encontrado',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - Encontrar espaço',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Title_Class_Object' => 'Espaço dentro de %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Summary' => 'Primeiras %1$s faixas de IPs livres de %2$s dentro da sub-rede',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeEmpty' => 'O espaço solicitado é nulo! Por favor, tente um valor maior.',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeTooBig' => 'O espaço solicitado não cabe na sub-rede! Por favor, tente um valor menor.',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:CreateAsRange' => 'Criar como uma faixa de IP',

	// List IPs action on subnets
	'UI:IPManagement:Action:ListIps:IPv4Subnet' => 'Listar e Selecionar IPs',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Title_Class_Object' => 'Lista de IPs dentro de %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Subtitle_ListRange' => 'A sub-rede é muito grande para listar todos os IPs de uma vez. Por favor, selecione uma faixa para exibir:',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:FirstIP' => 'Primeiro IP da lista',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:LastIP' => 'Último IP da lista',

	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv4Subnet' => 'Listar e Selecionar IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:Title_Class_Object' => 'Lista parcial de IPs dentro de %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:CannotBeListed' => 'Os IPs não podem ser listados: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIPOutOfSubnet' => 'O primeiro IP está fora da sub-rede!',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:LastIPOutOfSubnet' => 'O último IP está fora da sub-rede!',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'O primeiro IP da faixa é maior que o último IP!',

	// Shrink action on subnets
	'UI:IPManagement:Action:Shrink:IPv4Subnet' => 'Reduzir',
	'UI:IPManagement:Action:Shrink:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary' => 'Resumo',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:PageTitle_Object_Class' => 'Redução de %1$s - %2$s',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Title_Class_Object' => 'Reduzir %1$s: %2$s',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:CannotBeShrunk' => 'A sub-rede não pode ser reduzida: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmall' => 'A sub-rede é muito pequena para ser reduzida!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy' => 'A sub-rede é muito pequena para ser reduzida em %1$s!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeInTheMiddle' => 'A faixa: <b>%1$s [%2$s - %3$s]</b> atravessa os novos limites da sub-rede. A redução não pode ser realizada!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeDropped' => 'A faixa: <b>%1$s [%2$s - %3$s]</b> será removida da sub-rede. A redução não pode ser realizada!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Done' => '%1$s %2$s foi reduzida em %3$s.',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:By' => 'Reduzir em:',

	// Split action on subnets
	'UI:IPManagement:Action:Split:IPv4Subnet' => 'Dividir',
	'UI:IPManagement:Action:Split:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary' => 'Resumo',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:PageTitle_Object_Class' => 'Divisão de %1$s - %2$s',
	'UI:IPManagement:Action:Split:IPv4Subnet:Title_Class_Object' => 'Dividir %1$s: %2$s',
	'UI:IPManagement:Action:Split:IPv4Subnet:CannotBeSplit' => 'A sub-rede não pode ser dividida: %1$s',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmall' => 'A sub-rede é muito pequena para ser dividida!',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy' => 'A sub-rede é muito pequena para ser dividida em %1$s!',
	'UI:IPManagement:Action:Split:IPv4Subnet:IPRangeInTheMiddle' => 'A faixa: <b>%1$s [%2$s - %3$s]</b> atravessa os novos limites da sub-rede. A divisão não pode ser realizada!',
	'UI:IPManagement:Action:Split:IPv4Subnet:Done' => '%1$s %2$s foi dividida em %3$s.',
	'UI:IPManagement:Action:Split:IPv4Subnet:In' => 'Dividir em:',

	// Expand action on subnets
	'UI:IPManagement:Action:Expand:IPv4Subnet' => 'Expandir',
	'UI:IPManagement:Action:Expand:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary' => 'Resumo',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:PageTitle_Object_Class' => 'Expansão de %1$s - %2$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Title_Class_Object' => 'Expandir %1$s: %2$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:CannotBeExpanded' => 'A sub-rede não pode ser expandida: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBig' => 'A sub-rede é muito grande para ser expandida!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy' => 'A sub-rede é muito grande para ser expandida em %1$s!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:NotInIPBlock' => 'O bloco que hospeda a sub-rede é muito pequeno para conter a nova sub-rede expandida!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Done' => '%1$s %2$s foi expandida em %3$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:By' => 'Expandir em:',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet' => 'Exportar IPs para CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s exportação de IPs para CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Title_Class_Object' => 'Exportar IPs de %1$s para CSV: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Subtitle_ListRange' => 'A sub-rede é muito grande para exportar todos os IPs de uma vez. Por favor, selecione uma faixa para exibir:',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:FirstIP' => 'Primeiro IP da lista',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:LastIP' => 'Último IP da lista',

	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet' => 'Exportar IPs para CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s exportação de IPs para CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:Title_Class_Object' => 'Exportação parcial de IPs para CSV dentro de %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:CannotBeListed' => 'Os IPs não podem ser listados: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIPOutOfSubnet' => 'O primeiro IP está fora da sub-rede!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:LastIPOutOfSubnet' => 'O último IP está fora da sub-rede!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'O primeiro IP da faixa é maior que o último IP!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv4Subnet' => 'Calculadora de Sub-rede',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:PageTitle_Object_Class' => 'Calculadora de %2$s',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Title_Class_Object' => 'Calculadora para %1$s',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:IP' => 'Endereço IP',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Mask' => 'Máscara',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:CIDR' => 'CIDR',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet' => 'Calculadora de Sub-rede',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PageTitle_Object_Class' => 'Calculadora de %2$s',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Title_Class_Object' => '%1$s - Resultado da calculadora',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IP' => 'Endereço IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Mask' => 'Máscara',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CIDR' => 'CIDR',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:SubnetIP' => 'IP da Sub-rede',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Wildcard' => 'Máscara Curinga',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:BroadcastIP' => 'IP de Broadcast',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IPNumber' => 'Número de IPs',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:UsableHosts' => 'Número de Hosts utilizáveis',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet' => 'IP da Sub-rede Anterior',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet:NA' => 'Não Aplicável',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet' => 'IP da Próxima Sub-rede',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet:NA' => 'Não Aplicável',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CannotRun' => 'A calculadora de sub-rede não pode ser executada: %1$s',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:EnterMaskOrCIDR' => 'Insira uma máscara ou um CIDR!',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongMask' => 'A máscara é inválida!',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongCIDR' => 'O CIDR é inválido!',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:CannotBeExploded' => 'O FQDN não pode ser desmembrado em nome curto e nome de domínio',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:PageTitle_Object_Class' => 'Desmembrar FQDN',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:Done' => 'O FQDN foi desmembrado em %1$s %2$s',

//
// Management of IP ranges
//
	// Creation and Update Management
	'UI:IPManagement:Action:New:IPRange:NameExist' => 'O nome da Faixa já existe na sub-rede!',
	'UI:IPManagement:Action:New:IPRange:Reverted' => 'O primeiro IP da Faixa é maior que o último IP!',
	'UI:IPManagement:Action:New:IPRange:NotInSubnet' => 'A Faixa de IP não está contida na sub-rede selecionada!',
	'UI:IPManagement:Action:New:IPRange:Collision0' => 'A Faixa de IP já existe!',
	'UI:IPManagement:Action:New:IPRange:Collision1' => 'Colisão de faixa: o primeiro IP pertence a uma faixa existente!',
	'UI:IPManagement:Action:New:IPRange:Collision2' => 'Colisão de faixa: o último IP pertence a uma faixa existente!',
	'UI:IPManagement:Action:New:IPRange:Collision3' => 'Colisão de faixa: a nova faixa inclui uma existente!',
	'UI:IPManagement:Action:Update:IPRange:NonDHCPRangeWithServers' => 'Apenas faixas DHCP podem ser vinculadas a servidores DHCP!',
	'UI:IPManagement:Action:New:lnkFunctionalCIToIPRange:WrongCIClass' => 'Um servidor DHCP só pode ser da classe Servidor ou Máquina Virtual!',

	// Display pointers to previous and next Ranges
	'UI:IPManagement:Action:DisplayPrevious:IPRange' => 'Anterior',
	'UI:IPManagement:Action:DisplayNext:IPRange' => 'Próximo',

//
// Management of IPv4 ranges
//
	// Display details of IP Range
	'UI:IPManagement:Action:Details:IPv4Range' => 'Detalhes',
	'UI:IPManagement:Action:Details:IPv4Range+' => '',

	// List IPs action on IP Ranges
	'UI:IPManagement:Action:ListIps:IPv4Range' => 'Listar e Selecionar IPs',
	'UI:IPManagement:Action:ListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv4Range:Title_Class_Object' => 'Lista de IPs dentro de %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv4Range:Subtitle_ListRange' => 'A faixa é muito grande para listar todos os IPs de uma vez. Por favor, selecione uma subfaixa para exibir:',
	'UI:IPManagement:Action:ListIps:IPv4Range:FirstIP' => 'Primeiro IP da lista',
	'UI:IPManagement:Action:ListIps:IPv4Range:LastIP' => 'Último IP da lista',

	// Do list IPs action on IP Ranges
	'UI:IPManagement:Action:DoListIps:IPv4Range' => 'Listar e Selecionar IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Range:Title_Class_Object' => 'Lista parcial de IPs dentro de %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv4Range:CannotBeListed' => 'A faixa não pode ser listada: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIPOutOfRange' => 'O primeiro IP está fora da faixa!',
	'UI:IPManagement:Action:DoListIps:IPv4Range:LastIPOutOfRange' => 'O último IP está fora da faixa!',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIpBiggerThanLastIp' => 'O primeiro IP da faixa é maior que o último IP!',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv4Range' => 'Exportação de IPs para CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s exportação de IPs para CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Title_Class_Object' => 'Exportar IPs de %1$s para CSV: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Subtitle_ListRange' => 'A faixa é muito grande para exportar todos os IPs de uma vez. Por favor, selecione uma subfaixa para exportar:',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:FirstIP' => 'Primeiro IP da lista',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:LastIP' => 'Último IP da lista',

	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range' => 'Exportar IPs para CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s exportação de IPs para CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:Title_Class_Object' => 'Exportação parcial de IPs de %1$s para CSV: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:CannotBeListed' => 'A faixa não pode ser exportada: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIPOutOfRange' => 'O primeiro IP está fora da faixa!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:LastIPOutOfRange' => 'O último IP está fora da faixa!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIpBiggerThanLastIp' => 'O primeiro IP da faixa é maior que o último IP!',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:CannotBeExploded' => 'O FQDN não pode ser desmembrado em nome curto e nome de domínio',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:PageTitle_Object_Class' => 'Desmembrar FQDN',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:Done' => 'O FQDN foi desmembrado em %1$s %2$s',

//
// Management of IP Addresses
//
	// Creation Management
	'UI:IPManagement:Action:New:IPAddress:IPNameCollision' => 'O nome curto já existe no domínio!',

	'UI:IPManagement:Action:New:IPAddress:IPCollision' => 'O IP já existe!',
	'UI:IPManagement:Action:New:IPAddress:NotInRange' => 'O IP não pertence à faixa de IP!',
	'UI:IPManagement:Action:New:IPAddress:NotInSubnet' => 'O IP não pertence à sub-rede!',
	'UI:IPManagement:Action:New:IPAddress:IPPings' => 'O IP responde ao ping! ',
	'UI:IPManagement:Action:New:IPAddress:NatIPsAretheSame' => 'O IP não pode ser traduzido (NAT) para si mesmo! ',

	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:AllocateIP:IPAddress' => 'Alocar endereço para CI',
	'UI:IPManagement:Action:UnAllocateIP:IPAddress' => 'Desalocar endereço de todos os CIs',
	'UI:IPManagement:Action:Allocate:IPAddress:Class' => 'Classe alvo',
	'UI:IPManagement:Action:Allocate:IPAddress:CI' => 'CI Funcional',
	'UI:IPManagement:Action:Allocate:IPAddress:IPAttribute' => 'Atributo de IP',
	'UI:IPManagement:Action:Allocate:IPAddress:NoCI' => 'Não há CIs instanciados com atributos de Endereço IP nesta organização!',
	'UI:IPManagement:Action:Allocate:IPAddress:CannotAllocateCI' => 'Não é possível alocar o CI ao IP: %1$s',
	'UI:IPManagement:Action:Allocate:IPAddress:CIDoesNotExist' => 'O CI Funcional não existe!',
	'UI:IPManagement:Action:Allocate:IPAddress:AttributeIsReadOnly' => 'O atributo do CI é Somente Leitura!',
	'UI:IPManagement:Action:Allocate:IPAddress:AttributeIsSynchronized' => 'O atributo do CI é escravo de uma sincronização!',
	'UI:IPManagement:Action:Allocate:IPAddress:FQDNIsConflicting' => 'O novo FQDN entrará em conflito com as regras de duplicação definidas na configuração',
	'UI:IPManagement:Action:Allocate:IPAddress:IPAlreadyAllocated' => 'O endereço já está alocado!',
	'UI:IPManagement:Action:Unallocate:IPAddress:CannotBeUnallocated' => 'O endereço não pode ser desalocado: %1$s',
	'UI:IPManagement:Action:UnAllocate:IPAddress:IPNotAllocated' => 'O IP não está alocado!',
	'UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsReadOnly' => 'O IP está anexado a um atributo de CI que é Somente Leitura!',
	'UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsSynchronized' => 'O IP está anexado a um atributo de CI que é escravo de uma sincronização!',

	// List IPs
	'UI:IPManagement:Action:ListIPs:IPAddress:Ping' => 'PING',
	'UI:IPManagement:Action:ListIPs:IPAddress:Scan' => 'SCAN',
	'UI:IPManagement:Action:ListIPs:IPAddress:Nslookup' => 'NSLOOKUP',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPAddress:FQDNAttributeDoesNotExist' => 'O atributo %1$s não é um atributo do endereço IP!',

	// Display pointers to previous and next IPs
	'UI:IPManagement:Action:DisplayPrevious:IPAddress' => 'Anterior',
	'UI:IPManagement:Action:DisplayNext:IPAddress' => 'Próximo',

//
// Management of IPv4 Addresses
//
	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:Allocate:IPv4Address' => 'Alocar endereço para CI',
	'UI:IPManagement:Action:Allocate:IPv4Address:PageTitle_Object_Class' => 'Alocar IP',
	'UI:IPManagement:Action:Allocate:IPv4Address:Title_Class_Object' => 'Alocar %1$s %2$s para CI',
	'UI:IPManagement:Action:Allocate:IPv4Address:Done' => '%1$s %2$s foi alocado.',
	'UI:IPManagement:Action:Allocate:IPv4Address:IPAlreadyAllocated' => 'O endereço já está alocado!',
	'UI:IPManagement:Action:UnAllocate:IPv4Address' => 'Desalocar endereço de todos os CIs',
	'UI:IPManagement:Action:Unallocate:IPv4Address:PageTitle_Object_Class' => 'Desalocar IP',
	'UI:IPManagement:Action:Unallocate:IPv4Address:Done' => '%1$s %2$s foi desalocado.',
	'UI:IPManagement:Action:UnAllocate:IPv4Address:IPNotAllocated' => 'O endereço não está alocado!',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:CannotBeExploded' => 'O FQDN não pode ser desmembrado em nome curto e nome de domínio',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:PageTitle_Object_Class' => 'Desmembrar FQDN',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:Done' => 'O FQDN foi desmembrado em %1$s %2$s',

//
// Management of Domains
//
	// Creation Management
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'O nome do domínio já existe!',

	// Display list of domains
	'UI:IPManagement:Action:DisplayList:Domain' => 'Exibir Lista',
	'UI:IPManagement:Action:DisplayList:Domain+' => '',
	'UI:IPManagement:Action:DisplayList:Domain:PageTitle_Class' => 'Domínios DNS',
	'UI:IPManagement:Action:DisplayList:Domain:Title_Class' => 'Domínios DNS',

	// Display tree of domains
	'UI:IPManagement:Action:DisplayTree:Domain' => 'Exibir Árvore',
	'UI:IPManagement:Action:DisplayTree:Domain+' => '',
	'UI:IPManagement:Action:DisplayTree:Domain:PageTitle_Class' => 'Domínios DNS',
	'UI:IPManagement:Action:DisplayTree:Domain:Title_Class' => 'Domínios DNS',
	'UI:IPManagement:Action:DisplayTree:Domain:OrgName' => 'Organização %1$s',

//
// Generic actions
//
	// Find space action on subnets
	'UI:IPManagement:Action:FindSpace' => 'Encontrar e alocar espaço IP',
	'UI:IPManagement:Action:FindSpace:Organization' => 'Organização',
	'UI:IPManagement:Action:FindSpace:SpaceType' => 'Tipo de espaço',
	'UI:IPManagement:Action:FindSpace:IPv4Space' => 'Espaço IPv4',
	'UI:IPManagement:Action:FindSpace:IPv6Space' => 'Espaço IPv6',
	'UI:IPManagement:Action:FindIPv4Space' => 'Encontrar e alocar espaço IPv4',
	'UI:IPManagement:Action:FindIPv6Space' => 'Encontrar e alocar espaço IPv6',
	'UI:IPManagement:Action:FindSpace:FirstIP' => 'A partir do endereço IP:',
	'UI:IPManagement:Action:FindSpace:SpaceSize' => 'Tamanho do espaço a ser procurado:',
	'UI:IPManagement:Action:FindSpace:MaxNumberOfOffers' => 'Número máximo de ofertas:',

));
