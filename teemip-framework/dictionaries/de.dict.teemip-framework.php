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

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Core:AttributeIPPercentage' => 'IP Nutzung',
	'Core:AttributeIPPercentage+' => 'Grafische Ansicht der Ausnutzung',
	'Core:AttributeMacAddress' => 'MAC Adresse',
	'Core:AttributeMacAddress+' => 'Zeichenfolge der MAC Adresse',
));

//
// Class: IPApplication
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPApplication/Name' => '%1$s',
	'Class:IPApplication/Attribute:uuid' => 'UUID',
	'Class:IPApplication/Attribute:uuid+' => '',
	'Class:IPApplication/Attribute:status' => 'Status',
	'Class:IPApplication/Attribute:status+' => '',
	'Class:IPApplication/Attribute:status/Value:obsolete' => 'Veraltet',
	'Class:IPApplication/Attribute:status/Value:production' => 'Produktion',
	'Class:IPApplication/Attribute:status/Value:implementation' => 'Implementation',
	'Class:IPApplication/Attribute:location_id' => 'Standort',
	'Class:IPApplication/Attribute:location_id+' => '',
	'Class:IPApplication/Attribute:location_name' => 'Standort Name',
	'Class:IPApplication/Attribute:location_name+' => '',
));

//
// Class: IPConfig
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPConfig' => 'Globale IP Einstellungen',
	'Class:IPConfig+' => '',
	'Class:IPConfig:baseinfo' => 'Allgemeine Informationen',
	'Class:IPConfig:blockinfo' => 'Voreinstellungen der Subnetzblöcke',
	'Class:IPConfig:subnetinfo' => 'Voreinstellungen der Subnetze',
	'Class:IPConfig:iprangeinfo' => 'Voreinstellungen der IP Bereiche',
	'Class:IPConfig:ipinfo' => 'Voreinstellungen der IPs',
	'Class:IPConfig:domaininfo' => 'Voreinstellungen der Domains',
	'Class:IPConfig:otherinfo' => 'Sonstige Voreinstellungen',
	'Class:IPConfig/Attribute:org_id' => 'Organisation',
	'Class:IPConfig/Attribute:org_id+' => '',
	'Class:IPConfig/Attribute:org_name' => 'Organisationsname',
	'Class:IPConfig/Attribute:org_name+' => '',
	'Class:IPConfig/Attribute:name' => 'Name',
	'Class:IPConfig/Attribute:name+' => '',
	'Class:IPConfig/Attribute:requestor_id' => 'Anforderung durch',
	'Class:IPConfig/Attribute:requestor_id+' => '',
	'Class:IPConfig/Attribute:requestor_name' => 'Name des Anfordernden',
	'Class:IPConfig/Attribute:requestor_name+' => '',
	'Class:IPConfig/Attribute:ipv4_block_min_size' => 'Minimale Größe von IPv4 Subnetzblöcken',
	'Class:IPConfig/Attribute:ipv4_block_min_size+' => '',
	'Class:IPConfig/Attribute:ipv6_block_min_prefix' => 'Minimale Größe von IPv6 Subnetzblöcken',
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
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned' => 'Ausrichten der IPv4 Subnetzblöcke an der CIDR',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no' => 'Nein',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes' => 'Ja',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned' => 'Ausrichten der IPv6 Subnetzblöcke an der CIDR',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no' => 'Nein',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes' => 'Ja',
	'Class:IPConfig/Attribute:ipv6_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only' => 'Delegation nur an untergeordnete Organisation (Kind-Organisationen)',
	'Class:IPConfig/Attribute:delegate_to_children_only+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_no' => 'Nein',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_no+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_yes' => 'Ja',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_yes+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs' => 'Reservieren von Netzmaske, Gateway und Broadcast-IPs bei Erzeugung des Subnetzes',
	'Class:IPConfig/Attribute:reserve_subnet_IPs+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_no' => 'Nein',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_no+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_yes' => 'Ja',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_yes+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format' => 'IPv4 Gateway IP format',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1' => 'Subnetz IP + 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1' => 'Broadcast IP - 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup' => 'Freie Zuweisung',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format' => 'IPv6 Gateway IP format',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1' => 'Subnetz IP + 1',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip' => 'Letzte IP des Subnetzes',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:lastip+' => '',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup' => 'Freie Zuweisung',
	'Class:IPConfig/Attribute:ipv6_gateway_ip_format/Value:free_setup+' => '',
	'Class:IPConfig/Attribute:subnet_low_watermark' => 'Subnetz unterer Schwellenwert (%)',
	'Class:IPConfig/Attribute:subnet_low_watermark+' => '',
	'Class:IPConfig/Attribute:subnet_high_watermark' => 'Subnetz oberer Schwellenwert (%)',
	'Class:IPConfig/Attribute:subnet_high_watermark+' => '',
	'Class:IPConfig/Attribute:iprange_low_watermark' => 'IP Range unterer Schwellenwert (%)',
	'Class:IPConfig/Attribute:iprange_low_watermark+' => '',
	'Class:IPConfig/Attribute:iprange_high_watermark' => 'IP Range oberer Schwellenwert (%)',
	'Class:IPConfig/Attribute:iprange_high_watermark+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name' => 'Duplizierte Namen erlauben',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_no' => 'Nein',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_yes' => 'Ja',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack' => 'Dual stack',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack+' => 'Duplikate sind nur zwischen eindeutigem IPv4 und IPv6 erlaubt',
	'Class:IPConfig/Attribute:mac_address_format' => 'MAC-Adressen Anzeigeformat',
	'Class:IPConfig/Attribute:mac_address_format+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:colons' => '01:23:45:67:89:ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:colons+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:hyphens' => '01-23-45-67-89-ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:hyphens+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:dots' => '0123.4567.89ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:dots+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:any' => 'beliebig',
	'Class:IPConfig/Attribute:mac_address_format/Value:any+' => '',
	'Class:IPConfig/Attribute:ping_before_assign' => 'Ping auf IP vor der Zuweisung?',
	'Class:IPConfig/Attribute:ping_before_assign+' => '',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_no' => 'Nein',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_no+' => '',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_yes' => 'Ja',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_yes+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname' => 'Der Name des CI wird in den Hostname der IP kopiert',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:no' => 'Nein',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:yes' => 'Ja',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:yes+' => '',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname' => 'FQDN berechnen, wenn der Kurzname leer ist',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname+' => '',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:no' => 'Nein',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:no+' => '',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:yes' => 'Ja',
	'Class:IPConfig/Attribute:compute_fqdn_with_empty_shortname/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete' => 'IPs von CIs, die veraltet sind, werden freigegeben',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:no' => 'Nein',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:yes' => 'Ja',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production' => 'IPs von CIs, die produktiv sind, werden reserviert',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:no' => 'Nein',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:yes' => 'Ja',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:yes+' => '',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only' => 'Delegation von Domains nur an untergeordnete Organisation (Kind-Organisationen)',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only+' => '',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_no' => 'Nein',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_no+' => '',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_yes' => 'Ja',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only/Value:dtc_yes+' => '',
	'Class:IPConfig/Attribute:ip_symetrical_nat' => 'Symmetrisches IP NAT',
	'Class:IPConfig/Attribute:ip_symetrical_nat+' => '',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:yes' => 'Ja',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:no' => 'Nein',
	'Class:IPConfig/Attribute:ip_symetrical_nat/Value:no+' => '',
	'Class:IPConfig/Attribute:subnet_symetrical_nat' => 'Symmetrisches Subnetz NAT',
	'Class:IPConfig/Attribute:subnet_symetrical_nat+' => '',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:yes' => 'Ja',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:yes+' => '',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:no' => 'Nein',
	'Class:IPConfig/Attribute:subnet_symetrical_nat/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release' => 'IPs von Subnetzen, die freigegeben sind, werden freigegeben',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:yes' => 'Ja',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:no' => 'Nein',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci' => 'IPs, die nicht an ein CI angehängt sind, werden nicht zugeteilt',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci+' => '',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:yes' => 'Ja',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:no' => 'Nein',
	'Class:IPConfig/Attribute:ip_unassign_on_no_ci/Value:no+' => '',
	'Class:IPConfig/Attribute:attach_already_allocated_ips' => 'Ermöglicht das Anhängen von IPs, die bereits CIs zugewiesen sind',
	'Class:IPConfig/Attribute:attach_already_allocated_ips+' => '',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:yes' => 'Ja',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:yes+' => '',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:no' => 'Nein',
	'Class:IPConfig/Attribute:attach_already_allocated_ips/Value:no+' => '',
    'Class:IPConfig/Attribute:detach_released_ip_from_cis' => 'Freigegebene IPs von CIs trennen',
    'Class:IPConfig/Attribute:detach_released_ip_from_cis+' => 'Trennen Sie IPs, deren Status auf \'Freigegeben\' wechselt, von allen CIs. Dies betrifft nicht Schnittstellen, bei denen die \'Freigegebenen\' IPs immer getrennt sind.',
    'Class:IPConfig/Attribute:detach_released_ip_from_cis/Value:yes' => 'ja',
    'Class:IPConfig/Attribute:detach_released_ip_from_cis/Value:no' => 'Nein',
));

//
// Class: IPUsage
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPUsage' => 'IP Adresse Nutzung',
	'Class:IPUsage+' => 'Wofür eine IP Adresse genutzt wird',
	'Class:IPUsage/Attribute:org_id' => 'Organisation',
	'Class:IPUsage/Attribute:org_id+' => '',
	'Class:IPUsage/Attribute:org_name' => 'Organisationsname',
	'Class:IPUsage/Attribute:org_name+' => '',
	'Class:IPUsage/Attribute:name' => 'Name',
	'Class:IPUsage/Attribute:name+' => '',
	'Class:IPUsage/Attribute:description' => 'Beschreibung',
	'Class:IPUsage/Attribute:description+' => '',
	'Class:IPUsage/Attribute:ips_list' => 'IP Adressen',
	'Class:IPUsage/Attribute:ips_list+' => '',
));

//
// Class: DashletBadgeFiltered
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'UI:DashletBadgeFiltered:Label' => 'Badge mit Filter',
	'UI:DashletBadgeFiltered:Description' => 'Von einem OQL gefiltertes Badge ',
));

//
// Menus
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Menu:IPConfig' => 'Globale IP Einstellungen',
	'Menu:IPConfig+' => 'Globale Parameter für IP Mmgmt bezogene Objekte',
));

//
// Management of IP global settings
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'UI:IPManagement:Action:New:IPConfig:AlreadyExists' => 'Es darf innerhalb einer Organisation nur ein Objekt für die Globalen Einstellungen geben.',
	'UI:IPManagement:Action:Modify:IPConfig:IPv4BlockMinSizeTooSmall' => 'Die Minimalgröße von IPv4 Subnetzblöcken darf nicht kleiner sein als %1$s!',
	'UI:IPManagement:Action:Modify:IPConfig:IPv6BlockMinSizeTooSmall' => 'Die Minimalgröße von IPv6 Subnetzblöcken darf nicht kleiner sein als %1$s!',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksPercent' => 'Schwellwerte sind Prozentwerte, bitte nur Zahlen zwischen 0 und 100 verwenden!',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksOrder' => 'Untere Schwellwerte müssen kleiner sein als obere Schwellwerte!',
	'UI:IPManagement:Action:Modify:GlobalConfig' => 'Diese Globalen Einstellungen können durch diese Aktion überschrieben werden.',
	'UI:IPManagement:Action:New:IPUsage:AlreadyExists' => 'Es existiert bereits eine IP Adresse Nutzung mit demselben Namen!',
));
