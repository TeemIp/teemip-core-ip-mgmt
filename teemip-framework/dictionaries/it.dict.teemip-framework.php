<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

/////////////////////////////////////////////////////////////////////
// Classes in Teemip Framework Module'
//////////////////////////////////////////////////////////////////////
//

//
// TeemIp specific attributes
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Core:AttributeIPPercentage' => 'Percentuale IP',
	'Core:AttributeIPPercentage+' => 'Display Grafico della percentuale d\'uso',
	'Core:AttributeMacAddress' => 'MAC address',
	'Core:AttributeMacAddress+' => 'Stringa MAC adress',
));

//
// Class: IPApplication
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPApplication/Name' => '%1$s',
	'Class:IPApplication/Attribute:uuid' => 'UUID',
	'Class:IPApplication/Attribute:uuid+' => '',
	'Class:IPApplication/Attribute:status' => 'Stato',
	'Class:IPApplication/Attribute:status+' => '',
	'Class:IPApplication/Attribute:status/Value:obsolete' => 'Obsoleto',
	'Class:IPApplication/Attribute:status/Value:production' => 'Produzione',
	'Class:IPApplication/Attribute:status/Value:implementation' => 'Implementazione',
	'Class:IPApplication/Attribute:location_id' => 'Località',
	'Class:IPApplication/Attribute:location_id+' => '',
	'Class:IPApplication/Attribute:location_name' => 'Nome della Località',
	'Class:IPApplication/Attribute:location_name+' => '',
));

//
// Class: IPConfig
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPConfig' => 'Settaggi Globali IP',
	'Class:IPConfig+' => '',
	'Class:IPConfig:baseinfo' => 'Informazioni Generali',
	'Class:IPConfig:blockinfo' => 'Settaggi di Default per il Blocco delle Sottorete',
	'Class:IPConfig:subnetinfo' => 'Settaggi di Default per le Sottorete',
	'Class:IPConfig:iprangeinfo' => 'Settaggi di Default per l\'intervallo IP',
	'Class:IPConfig:ipinfo' => 'Settaggi di Default per l\'IP',
	'Class:IPConfig:domaininfo' => 'Settaggi di Default per le Dominio',
	'Class:IPConfig:otherinfo' => 'Altre Settaggi di Default',
	'Class:IPConfig/Attribute:org_id' => 'Organizzazione',
	'Class:IPConfig/Attribute:org_id+' => '',
	'Class:IPConfig/Attribute:org_name' => 'Nome dell\'Organizzazione',
	'Class:IPConfig/Attribute:org_name+' => '',
	'Class:IPConfig/Attribute:name' => 'Nome',
	'Class:IPConfig/Attribute:name+' => '',
	'Class:IPConfig/Attribute:requestor_id' => 'Richiedente',
	'Class:IPConfig/Attribute:requestor_id+' => '',
	'Class:IPConfig/Attribute:requestor_name' => 'Nome del Richiedente',
	'Class:IPConfig/Attribute:requestor_name+' => '',
	'Class:IPConfig/Attribute:ipv4_block_min_size' => 'dimensione Minima del Blocco Sottorete IPv4',
	'Class:IPConfig/Attribute:ipv4_block_min_size+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix' => 'Dimensione minima del blocco della sottorete IPv6',
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
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned' => 'Allineamento Blocco Sottorete IPv4 al CIDR',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes' => 'Si',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned' => 'Allineamento del blocco della sottorete IPv6 al CIDR',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes' => 'si',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only' => 'Blocco delegato alle sole organizzazioni figlie',
	'Class:IPConfig/Attribute:delegate_to_children_only+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_no' => 'No',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_no+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_yes' => 'Si',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_yes+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs' => 'Sottorete Riservata, Gateway e IP di Broadcast IPs per la creazione della Sottorete',
	'Class:IPConfig/Attribute:reserve_subnet_IPs+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_no' => 'No',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_no+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_yes' => 'Si',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_yes+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format' => 'IPv4 Gateway IP format~~',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1' => 'Sottorete IP + 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1' => 'Broadcast IP - 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup' => 'Allocazione Libera',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format' => 'IPv6 Gateway IP format~~',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1' => 'Sottorete IP + 1',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip' => 'Ultimo IP della sottorete',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup' => 'Allocazione libera',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup+' => '',
	'Class:IPConfig/Attribute:subnet_low_watermark' => 'Basso livello per Sottorete(%)',
	'Class:IPConfig/Attribute:subnet_low_watermark+' => '',
	'Class:IPConfig/Attribute:subnet_high_watermark' => 'Alto livello per Sottorete(%)',
	'Class:IPConfig/Attribute:subnet_high_watermark+' => '',
	'Class:IPConfig/Attribute:iprange_low_watermark' => 'Intervallo IP basso livello(%)',
	'Class:IPConfig/Attribute:iprange_low_watermark+' => '',
	'Class:IPConfig/Attribute:iprange_high_watermark' => 'Intervallo IP alto livello(%)',
	'Class:IPConfig/Attribute:iprange_high_watermark+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name' => 'Permetti la duplicazione dei nomi',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_no' => 'No',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_yes' => 'Si',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack' => 'Dual stack',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack+' => 'I duplicati sono autorizzati tra IPv4 univoco e IPv6',
	'Class:IPConfig/Attribute:mac_address_format' => 'Formato di Output per MAC Address',
	'Class:IPConfig/Attribute:mac_address_format+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:colons' => '01:23:45:67:89:ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:colons+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:hyphens' => '01-23-45-67-89-ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:hyphens+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:dots' => '0123.4567.89ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:dots+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:any' => 'Ogni',
	'Class:IPConfig/Attribute:mac_address_format/Value:any+' => '',
	'Class:IPConfig/Attribute:ping_before_assign' => 'Pingare l\'IP prima di assegnarlo?',
	'Class:IPConfig/Attribute:ping_before_assign+' => '',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_no' => 'No',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_no+' => '',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_yes' => 'Si',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_yes+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname' => 'Il nome dell\'CI viene copiato nel nome breve dell\'IP',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:no' => 'No',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:yes' => 'Si',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:yes+' => '',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname' => 'Calcola FQDN quando il nome breve è vuoto',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname+' => '',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:no' => 'No',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:no+' => '',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:yes' => 'Si',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete' => 'Rilasciare gli IP degli elementi della configurazione che diventano obsoleti',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:no' => 'No',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:yes' => 'Si',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production' => 'Allocare gli IP collegati agli CI di produzione',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:no' => 'No',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:yes' => 'Si',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:yes+' => '',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only' => 'Dominio delegato alle sole organizzazioni figlie',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only+' => '',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_no' => 'No',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_no+' => '',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_yes' => 'Si',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_yes+' => '',
	'Class:IPConfig/Attribute:ip_symetrical_nat' => 'Symetrical IP NAT',
	'Class:IPConfig/Attribute:ip_symetrical_nat+' => '',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:yes' => 'Si',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:no' => 'No',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:no+' => '',
	'Class:IPConfig/Attribute:subnet_symetrical_nat' => 'Symetrical Subnet NAT',
	'Class:IPConfig/Attribute:subnet_symetrical_nat+' => '',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:yes' => 'Si',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:yes+' => '',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:no' => 'No',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release' => 'Rilasciare gli IP dalle sottoreti rilasciate',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:yes' => 'Si',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:no' => 'No',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci' => 'Annullare l\'allocazione di IP che non sono collegati a un CI ',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci+' => '',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:yes' => 'Si',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:no' => 'No',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:no+' => '',
	'Class:IPConfig/Attribute:attach_already_allocated_ips' => 'Consenti l\'allegato di IP già assegnati a CIs',
	'Class:IPConfig/Attribute:attach_already_allocated_ips+' => '',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:yes' => 'Si',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:yes+' => '',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:no' => 'No',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:no+' => '',
    'Class:IPConfig/Attribute:detach_released_ip_from_cis' => 'Scollega gli IP rilasciati dai CIs',
    'Class:IPConfig/Attribute:detach_released_ip_from_cis+' => 'Scollega gli IP il cui stato è cambiato in \'Rilasciato\' da tutti gli elementi del CIs. Questo non riguarda le interfacce per le quali gli IP \'Rilasciati\' vengono sempre scollegi.',
    'Class:IPConfig/Attribute:detach_released_ip_from_cis/Value:yes' => 'Si',
    'Class:IPConfig/Attribute:detach_released_ip_from_cis/Value:no' => 'No',
));

//
// Class: IPUsage
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPUsage' => 'Uso Indirizzo IP',
	'Class:IPUsage+' => 'Per cosa è usato l\'indirizzo IP',
	'Class:IPUsage/Attribute:org_id' => 'Organizzazione',
	'Class:IPUsage/Attribute:org_id+' => '',
	'Class:IPUsage/Attribute:org_name' => 'Nome dell\'Organizzazione',
	'Class:IPUsage/Attribute:org_name+' => '',
	'Class:IPUsage/Attribute:name' => 'Nome',
	'Class:IPUsage/Attribute:name+' => '',
	'Class:IPUsage/Attribute:description' => 'Descrizione',
	'Class:IPUsage/Attribute:description+' => '',
	'Class:IPUsage/Attribute:ips_list' => 'IPs',
	'Class:IPUsage/Attribute:ips_list+' => '',
));

//
// Class: DashletBadgeFiltered
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'UI:DashletBadgeFiltered:Label' => 'Badge con filtro',
	'UI:DashletBadgeFiltered:Description' => 'Badge filtrato da un OQL',
));

//
// Menus
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Menu:IPConfig' => 'Settaggi GLobali IP',
	'Menu:IPConfig+' => 'Parametri globali per gli oggetti relativi all\'IP',
));

//
// Management of IP global settings
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'UI:IPManagement:Action:New:IPConfig:AlreadyExists' => 'Solo un settaggio globale può esistere all\'interno di una organizzazione.',
	'UI:IPManagement:Action:Modify:IPConfig:IPv4BlockMinSizeTooSmall' => 'dimensione minima di un blocco sottorete IPv4, non può essere piu piccoli di %1$s!',
	'UI:IPManagement:Action:Modify:IPConfig:IPv6BlockMinSizeTooSmall' => 'dimensione minima di un blocco Sottorete IPv6 , non può essere piu piccoli di  %1$s!',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksPercent' => 'I livelli sono percentuali,per favore, usa numeri tra 0 e 100!',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksOrder' => 'Il livello basso deve essere più piccolo del livello alto!',
	'UI:IPManagement:Action:Modify:GlobalConfig' => 'Qusti settaggi globali dei IP possono essere sovrascritti per questa azione.',
	'UI:IPManagement:Action:New:IPUsage:AlreadyExists' => 'Esiste già un uso indirizzo IP con lo stesso nome!',
));
