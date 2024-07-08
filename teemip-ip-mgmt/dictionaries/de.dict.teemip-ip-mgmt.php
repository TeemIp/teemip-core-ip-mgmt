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

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPObject' => 'IP Objekt',
	'Class:IPObject+' => '',
	'IPObject:GlobalParams' => 'Globale Einstellungen',
	'IPObject:GlobalParams+' => 'Auf Organisationsebene festgelegte globale Einstellungen und tatsächlich für das Objekt verwendete Einstellungen',
	'Class:IPObject:GeneralConfigParameters' => 'Organisationseinstellungen',
	'Class:IPObject/Attribute:finalclass' => 'Typ',
	'Class:IPObject/Attribute:finalclass+' => '',
	'Class:IPObject/Attribute:org_id' => 'Organisation',
	'Class:IPObject/Attribute:org_id+' => '',
	'Class:IPObject/Attribute:org_name' => 'Organisationsname',
	'Class:IPObject/Attribute:org_name+' => '',
	'Class:IPObject/Attribute:status' => 'Status',
	'Class:IPObject/Attribute:status+' => '',
	'Class:IPObject/Attribute:status/Value:reserved' => 'Reserviert',
	'Class:IPObject/Attribute:status/Value:reserved+' => '',
	'Class:IPObject/Attribute:status/Value:allocated' => 'Zugewiesen',
	'Class:IPObject/Attribute:status/Value:allocated+' => '',
	'Class:IPObject/Attribute:status/Value:released' => 'Freigegeben',
	'Class:IPObject/Attribute:status/Value:released+' => '',
	'Class:IPObject/Attribute:status/Value:unassigned' => 'Nicht zugeordnet',
	'Class:IPObject/Attribute:status/Value:unassigned+' => '',
	'Class:IPObject/Attribute:comment' => 'Kommentar',
	'Class:IPObject/Attribute:comment+' => '',
	'Class:IPObject/Attribute:requestor_id' => 'Anforderung durch',
	'Class:IPObject/Attribute:requestor_id+' => '',
	'Class:IPObject/Attribute:requestor_name' => 'Name des Anfordernden',
	'Class:IPObject/Attribute:requestor_name+' => '',
	'Class:IPObject/Attribute:allocation_date' => 'Datum der Zuweisung',
	'Class:IPObject/Attribute:allocation_date+' => 'Datum, an dem das IP Objekt zugewiesen wurde.',
	'Class:IPObject/Attribute:release_date' => 'Datum der Freigabe',
	'Class:IPObject/Attribute:release_date+' => 'Datum, an dem das IP Objekt wieder freigegeben und nicht mehr benutzt wurde.',
	'Class:IPObject/Attribute:ipconfig_id' => 'Globale IP Einstellungen',
	'Class:IPObject/Attribute:ipconfig_id+' => '',
	'Class:IPObject/Attribute:contact_list' => 'Kontakte',
	'Class:IPObject/Attribute:contact_list+' => 'Kontakte, die mit dem IP Objekt verknüpft sind.',
	'Class:IPObject/Attribute:document_list' => 'Dokumente',
	'Class:IPObject/Attribute:document_list+' => 'Dokumente, die mit dem IP Objekt verknüpft sind.',
));

//
// Class: lnkContactToIPObject
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkContactToIPObject' => 'Verknüpfung Kontakt / IP Objekt',
	'Class:lnkContactToIPObject+' => '',
	'Class:lnkContactToIPObject/Attribute:ipobject_id' => 'IP Objekt',
	'Class:lnkContactToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_id' => 'Kontakt',
	'Class:lnkContactToIPObject/Attribute:contact_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_name' => 'Kontakt Name',
	'Class:lnkContactToIPObject/Attribute:contact_name+' => '',
));

//
// Class: lnkDocToIPObject
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkDocToIPObject' => 'Verknüpfung Dokument / IP Objekt',
	'Class:lnkDocToIPObject+' => '',
	'Class:lnkDocToIPObject/Attribute:ipobject_id' => 'IP Objekt',
	'Class:lnkDocToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_id' => 'Dokument',
	'Class:lnkDocToIPObject/Attribute:document_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_name' => 'Dokumentname',
	'Class:lnkDocToIPObject/Attribute:document_name+' => '',
));

//
// Class: lnkIPObjectToTicket
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkIPObjectToTicket' => 'Verknüpfung IP Objekt / Ticket',
	'Class:lnkIPObjectToTicket+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id_finalclass_recall' => 'Typ des IP Objektes',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id_finalclass_recall+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id' => 'IP Objekt',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_id' => 'Ticket',
	'Class:lnkIPObjectToTicket/Attribute:ticket_id+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_ref' => 'Ref',
	'Class:lnkIPObjectToTicket/Attribute:ticket_ref+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_title' => 'Titel',
	'Class:lnkIPObjectToTicket/Attribute:ticket_title+' => '',
));

//
// Class: IPBlock
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPBlock' => 'Subnetzblock',
	'Class:IPBlock+' => '',
	'Class:IPBlock:baseinfo' => 'Allgemeine Information',
	'Class:IPBlock:automation' => 'Automatisierung',
	'Class:IPBlock:delegationinfo' => 'Übertragungsinformation',
	'Class:IPBlock:ipinfo' => 'IP Information',
	'Class:IPBlock:DelegatedToChild' => '<delegation_highlight>Übertragen an die Organisation : </delegation_highlight>%1$s',
	'Class:IPBlock:DelegatedFromParent' => '<delegation_highlight>Übertragen von der Organisation : </delegation_highlight>%1$s',
	'Class:IPBlock:localconfigparameters' => 'Einstellungen der Subnetzblocks',
	'Class:IPBlock/Attribute:name' => 'Name',
	'Class:IPBlock/Attribute:name+' => '',
	'Class:IPBlock/Attribute:ipblocktype_id' => 'Typ',
	'Class:IPBlock/Attribute:ipblocktype_id+' => 'Typ des Subnetzblocks',
	'Class:IPBlock/Attribute:ipblocktype_name' => 'Typ Name',
	'Class:IPBlock/Attribute:ipblocktype_name+' => '',
	'Class:IPBlock/Attribute:allocation_date' => 'Datum der Zuweisung',
	'Class:IPBlock/Attribute:allocation_date+' => 'Datum, an dem der Subnetzblock zugewiesen wurde.',
	'Class:IPBlock/Attribute:parent_org_id' => 'Delegiert von',
	'Class:IPBlock/Attribute:parent_org_id+' => 'Organisation, von der der Subnetzblock delegiert wurde',
	'Class:IPBlock/Attribute:parent_org_name' => 'Name der delegierenden Organisation',
	'Class:IPBlock/Attribute:parent_org_name+' => 'Name der Organisation, von der der Subnetzblock delegiert wurde',
	'Class:IPBlock/Attribute:occupancy' => 'belegter Bereich',
	'Class:IPBlock/Attribute:occupancy+' => '',
	'Class:IPBlock/Attribute:children_occupancy' => 'Durch untergeordnete Elemente belegter Bereich',
	'Class:IPBlock/Attribute:children_occupancy+' => '',
	'Class:IPBlock/Attribute:subnet_occupancy' => 'Durch Subnetze belegter Bereich',
	'Class:IPBlock/Attribute:subnet_occupancy+' => '',
	'Class:IPBlock/Attribute:location_list' => 'Standorte',
	'Class:IPBlock/Attribute:location_list+' => 'Standorte, in die der Subnetz Block reicht',
	'Class:IPBlock/Attribute:origin' => 'Ursprung',
	'Class:IPBlock/Attribute:origin+' => 'Woher der Block stammt: regionale oder lokale Internet Registrar oder eine andere Organisation',
	'Class:IPBlock/Attribute:origin/Value:rir' => 'RIR',
	'Class:IPBlock/Attribute:origin/Value:rir+' => 'regionaler Internet Registrar',
	'Class:IPBlock/Attribute:origin/Value:lir' => 'LIR',
	'Class:IPBlock/Attribute:origin/Value:lir+' => 'lokaler Internet Registrar',
	'Class:IPBlock/Attribute:origin/Value:other' => 'Andere',
	'Class:IPBlock/Attribute:origin/Value:other+' => 'IT Abteilung...',
	'Class:IPBlock/Attribute:registrar_id' => 'Registrar',
	'Class:IPBlock/Attribute:registrar_id+' => 'verwendete regionale oder lokale Internet Registrare',
	'Class:IPBlock/Attribute:registrar_name' => 'Registrar Name',
	'Class:IPBlock/Attribute:registrar_name+' => '',
));

//
// Class extensions for IPBlock
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPBlock/Tab:globalparam' => 'Globale Einstellungen',
	'Class:IPBlock/Tab:childblock' => 'untergeordnete Blöcke',
	'Class:IPBlock/Tab:childblock+' => 'Blöcke, die mit diesem Block verbunden sind',
	'Class:IPBlock/Tab:childblock/SelectList' => 'Anzeige ändern',
	'Class:IPBlock/Tab:childblock/SelectList0' => 'Nur untergeordnete Blöcke anzeigen',
	'Class:IPBlock/Tab:childblock/SelectList1' => 'Die gesamte Hierarchie der untergeordneten Blöcke anzeigen',
	'Class:IPBlock/Tab:childblock/List0' => 'Nur untergeordnete Blöcke',
	'Class:IPBlock/Tab:childblock/List1' => 'Gesamte Hierarchie der untergeordneten Blöcke',
	'Class:IPBlock/Tab:childblock-count' => 'untergeordnete Blöcke : %1$s',
	'Class:IPBlock/Tab:childblock-count-percent' => ' durch untergeordnete Blöcke belegt.',
	'Class:IPBlock/Tab:childblock-count-percent-remain' => 'Durch untergeordnete Blöcke im verbleibenden Raum belegt: %1$.1f %%',
	'Class:IPBlock/Tab:subnet' => 'Subnetz',
	'Class:IPBlock/Tab:subnet+' => 'mit diesem Block verbundene Subnetze',
	'Class:IPBlock/Tab:subnet-count' => 'Subnetze : %1$s',
	'Class:IPBlock/Tab:subnet-count-percent' => ' durch Subnetze belegt',
	'Class:IPBlock/Tab:subnet-count-percent-remain' => 'Durch verbundene Subnetze im verbleibenden Raum belegt: %1$.1f %%',
));

//
// Class: lnkBlockToLocation
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkIPBlockToLocation' => 'Verknüpfung Block / Standort',
	'Class:lnkIPBlockToLocation+' => '',
	'Class:lnkIPBlockToLocation/Attribute:block_id' => 'Block',
	'Class:lnkIPBlockToLocation/Attribute:block_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:block_name' => 'Block name',
	'Class:lnkIPBlockToLocation/Attribute:block_name+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_id' => 'Standort',
	'Class:lnkIPBlockToLocation/Attribute:location_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_name' => 'Standort Name',
	'Class:lnkIPBlockToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Block
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPv4Block' => 'IPv4 Subnetzblock',
	'Class:IPv4Block+' => '',
	'Class:IPv4Block/Attribute:parent_id' => 'übergeordneter Block',
	'Class:IPv4Block/Attribute:parent_id+' => '',
	'Class:IPv4Block/Attribute:parent_name' => 'übergeordneter Block Name',
	'Class:IPv4Block/Attribute:parent_name+' => '',
	'Class:IPv4Block/Attribute:parent_origin' => 'übergeordneter Block Ursprung',
	'Class:IPv4Block/Attribute:parent_origin+' => '',
	'Class:IPv4Block/Attribute:firstip' => 'Erste IP',
	'Class:IPv4Block/Attribute:firstip+' => 'Erste IP Adresse des Subnetzblocks',
	'Class:IPv4Block/Attribute:lastip' => 'Letzte IP',
	'Class:IPv4Block/Attribute:lastip+' => 'letzte IP Adresse des Subnetzblocks',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_min_size' => 'Minimale Größe von IPv4 Subnetzblöcken',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_min_size+' => '',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_cidr_aligned' => 'Ausrichten der IPv4 Subnetzblöcke an der CIDR',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_cidr_aligned+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_min_size' => 'Minimale Größe',
	'Class:IPv4Block/Attribute:ipv4_block_min_size+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned' => 'Ausrichten der Blöcke an der CIDR',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:default' => 'Abgestimmt auf globale IP-Einstellungen',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:bca_no' => 'Nein',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:bca_yes' => 'Ja',
));

//
// Class: IPSubnet
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPSubnet' => 'Subnetz',
	'Class:IPSubnet+' => '',
	'Class:IPSubnet:baseinfo' => 'Allgemeine Informationen',
	'Class:IPSubnet:ipinfo' => 'IP Informationen',
	'Class:IPSubnet:automation' => 'Automatisierung',
	'Class:IPSubnet:localconfigparameters' => 'Einstellungen der Subnetz',
	'Class:IPSubnet/Attribute:name' => 'Name',
	'Class:IPSubnet/Attribute:name+' => '',
	'Class:IPSubnet/Attribute:type' => 'Type',
	'Class:IPSubnet/Attribute:type+' => '',
	'Class:IPSubnet/Attribute:allocation_date' => 'Datum der Zuweisung',
	'Class:IPSubnet/Attribute:allocation_date+' => 'Datum, an dem das Subnetz zugewiesen wurde.',
	'Class:IPSubnet/Attribute:release_date' => 'Datum der Freigabe',
	'Class:IPSubnet/Attribute:release_date+' => 'Datum, an dem das Subnetz freigegeben und nicht mehr benutzt wurde.',
	'Class:IPSubnet/Attribute:ip_occupancy' => 'Registrierte IPs',
	'Class:IPSubnet/Attribute:ip_occupancy+' => '',
	'Class:IPSubnet/Attribute:range_occupancy' => 'Registrierte Bereiche',
	'Class:IPSubnet/Attribute:range_occupancy+' => '',
	'Class:IPSubnet/Attribute:alarm_water_mark' => 'Status des Alarm Schwellenwerts',
	'Class:IPSubnet/Attribute:alarm_water_mark+' => '',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:no_alarm' => 'Es wurde noch kein Alarm gesendet',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:low_sent' => 'Unterer Alarm gesendet',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:high_sent' => 'Oberer Alarm gesendet',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips' => 'Reservieren von Subnetz, Gateway und Broadcast IPs bei Subnetz Erzeugung',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips+' => '',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips/Value:reserve_no' => 'Nein',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips/Value:reserve_yes' => 'Ja',
	'Class:IPSubnet/Attribute:reserve_subnet_ips' => 'Reservieren von Subnetz, Gateway und Broadcast IPs',
	'Class:IPSubnet/Attribute:reserve_subnet_ips+' => 'Definierte die Richtlinie zum Reservieren von Subnetz-, Gateway- und Broadcast-IPs bei der Erstellung',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:default' => 'An globalen IP-Einstellungen ausgerichtet',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:reserve_no' => 'Nein',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:reserve_yes' => 'Ja',
	'Class:IPSubnet/Attribute:subnets_list' => 'NAT Subnetze',
	'Class:IPSubnet/Attribute:subnets_list+' => 'Liste der NAT Subnetze',
	'Class:IPSubnet/Attribute:vlans_list' => 'VLANs',
	'Class:IPSubnet/Attribute:vlans_list+' => '',
	'Class:IPSubnet/Attribute:vrfs_list' => 'VRFs',
	'Class:IPSubnet/Attribute:vrfs_list+' => '',
	'Class:IPSubnet/Attribute:location_list' => 'Standorte',
	'Class:IPSubnet/Attribute:location_list+' => 'Standorte, in die das Subnetz sich erstreckt',
	'Class:IPSubnet/Attribute:summary/cell0' => 'Registrierte IPs nach Status',
	'Class:IPSubnet/Attribute:summary/cell0+' => 'Total: %1$s',
));

//
// Class extensions for IPSubnet
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPSubnet/Tab:globalparam' => 'Globale Einstellungen',
	'Class:IPSubnet/Tab:ipregistered' => 'Registrierte IPs',
	'Class:IPSubnet/Tab:ipregistered+' => 'IPs, die im Subnetz registriert sind',
	'Class:IPSubnet/Tab:ipregistered-count' => ' - %1$s reserviert, %2$s zugewwiesen, %3$s freigegeben, %4$s nicht zugeordnet von insgesamt %5$s',
	'Class:IPSubnet/Tab:ipfree-explain' => 'Liste der ersten %1$s freien IP Adressen:',
	'Class:IPSubnet/Tab:ipfree-explainbis' => 'Liste ALLER freien IP Adressen:',
	'Class:IPSubnet/Tab:iprange' => 'IP Bereiche',
	'Class:IPSubnet/Tab:iprange+' => 'IP Bereiche, die Teil des Subnetzes sind',
	'Class:IPSubnet/Tab:iprange-count-percent' => 'durch die IP Bereiche verbrauchter Platz.',
	'Class:IPSubnet/Tab:notifications' => 'Benachrichtigungen',
	'Class:IPSubnet/Tab:notifications+' => 'Benachrichtigungen in Verbindung mit diesem Subnetz',
	'Class:IPSubnet/Tab:requests' => 'IP Anforderungen',
	'Class:IPSubnet/Tab:requests+' => 'IP Anforderung in Verbindung mit diesem Subnetz',
	'Class:IPSubnet/Tab:changes' => 'IP Änderungen',
	'Class:IPSubnet/Tab:changes+' => 'IP Änderungen in Verbindung mit diesem Subnetz',
));

//
// Class: lnkIPSubnetToIPSubnet
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkIPSubnetToIPSubnet' => 'Verknüpfung Subnetz / NAT Subnetz',
	'Class:lnkIPSubnetToIPSubnet+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall' => 'Subnetztyp',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id' => 'Subnetz',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id' => 'NAT Subnetz',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name' => 'Name',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name+' => 'Subnetz Name',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name' => 'Name',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name+' => 'Subnetz Name',
));

//
// Class: lnkIPSubnetToVLAN
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkIPSubnetToVLAN' => 'Verknüpfung Subnetz / VLAN',
	'Class:lnkIPSubnetToVLAN+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall' => 'Subnetztyp',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id' => 'Subnetz',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name' => 'Subnetz Name',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag' => 'VLAN Tag',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag+' => '',
));

//
// Class: lnkIPSubnetToVRF
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkIPSubnetToVRF' => 'Verknüpfung Subnetz / VRF',
	'Class:lnkIPSubnetToVRF+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall' => 'Subnetztyp',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id' => 'Subnetz',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name' => 'Subnetz Name',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id+' => '',
));

//
// Class: lnkIPSubnetToLocation
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkIPSubnetToLocation' => 'Verknüpfung Subnetz / Standort',
	'Class:lnkIPSubnetToLocation+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id' => 'Subnetz',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name' => 'Subnetz Name',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_id' => 'Standort',
	'Class:lnkIPSubnetToLocation/Attribute:location_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_name' => 'Standort Name',
	'Class:lnkIPSubnetToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Subnet
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPv4Subnet' => 'IPv4 Subnetz',
	'Class:IPv4Subnet+' => '',
	'Class:IPv4Subnet/Attribute:block_id' => 'Subnetzblock',
	'Class:IPv4Subnet/Attribute:block_id+' => '',
	'Class:IPv4Subnet/Attribute:block_name' => 'Block Name',
	'Class:IPv4Subnet/Attribute:block_name+' => '',
	'Class:IPv4Subnet/Attribute:ip' => 'Subnetz IP',
	'Class:IPv4Subnet/Attribute:ip+' => '',
	'Class:IPv4Subnet/Attribute:mask' => 'Maske',
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
	'Class:IPv4Subnet/Attribute:gatewayip' => 'Gateway IP',
	'Class:IPv4Subnet/Attribute:gatewayip+' => '',
	'Class:IPv4Subnet/Attribute:broadcastip' => 'Broadcast IP',
	'Class:IPv4Subnet/Attribute:broadcastip+' => '',
	'Class:IPv4Subnet/Attribute:summary' => 'Zusammenfassung',
	'Class:IPv4Subnet/Attribute:ipconfig_ipv4_gateway_ip_format' => 'Standard Gateway IP format',
	'Class:IPv4Subnet/Attribute:ipconfig_ipv4_gateway_ip_format+' => '',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format' => 'Gateway IP format',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format+' => '',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:default' => 'Abgestimmt auf globale IP-Einstellungen',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1' => 'Auf Subnetz-IP + 1 erzwingen',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1' => 'Auf Broadcast IP - 1 erzwingen',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:free_setup' => 'Freie Zuweisung erzwingen',
));

//
// Class: IPRange
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPRange' => 'IP Bereich',
	'Class:IPRange+' => '',
	'Class:IPRange:baseinfo' => 'Allgemeine Informationen',
	'Class:IPRange:ipinfo' => 'IP Informationen',
	'Class:IPRange/Attribute:range' => 'Name',
	'Class:IPRange/Attribute:range+' => '',
	'Class:IPRange/Attribute:usage_id' => 'Verwendungszweck',    //usage
	'Class:IPRange/Attribute:usage_id+' => 'Verwendungszweck des Bereichs',
	'Class:IPRange/Attribute:usage_name' => 'Verwendungszweck Name',
	'Class:IPRange/Attribute:usage_name+' => '',
	'Class:IPRange/Attribute:allocation_date' => 'Datum der Zuweisung',
	'Class:IPRange/Attribute:allocation_date+' => 'Datum, an dem das IP Bereich zugewiesen wurde.',
	'Class:IPRange/Attribute:dhcp' => 'DHCP Bereich',
	'Class:IPRange/Attribute:dhcp+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no' => 'Nein',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes' => 'Ja',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes+' => '',
	'Class:IPRange/Attribute:occupancy' => 'Registrierte IPs',
	'Class:IPRange/Attribute:occupancy+' => '',
	'Class:IPRange/Attribute:functionalcis_list' => 'DHCP Server',
	'Class:IPRange/Attribute:functionalcis_list+' => 'Liste aller DHCP Server, die diesen DHCP Bereich verwalten',
));

//
// Class extensions for IPRange
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPRange/Tab:ipregistered' => 'Registrierte IPs',
	'Class:IPRange/Tab:ipregistered+' => 'IPs, die in diesem IP Bereich registriert sind',
	'Class:IPRange/Tab:ipregistered-count' => ' - %1$s reserviert, %2$s zugewiesen, %3$s freigegeben, %4$s nicht zugeordnet von insgesamt %5$s',
	'Class:IPRange/Tab:ipfree-explain' => 'Liste der ersten %1$s freien IP Adressen:',
	'Class:IPRange/Tab:ipfree-explainbis' => 'Liste ALLER freien IP Adressen:',
	'Class:IPRange/Tab:notifications' => 'Benachrichtigungen',
	'Class:IPRange/Tab:notifications+' => 'Benachrichtigungen in Verbindung mit diesem IP Bereich',
));

//
// Class: lnkFunctionalCIToIPRange
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkFunctionalCIToIPRange' => 'Verknüpfung Funktionales CI / IP Bereich',
	'Class:lnkFunctionalCIToIPRange+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id_finalclass_recall' => 'IP Bereich Typ',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id_finalclass_recall+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id' => 'IP Bereich',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_name' => 'IP Bereich Name',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_name+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_id' => 'CI',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_id+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_name' => 'CI Name',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_name+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role' => 'Rolle',
	'Class:lnkFunctionalCIToIPRange/Attribute:role+' => 'Rolle des CI für den Bereich',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:single' => 'Single',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:single+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:split_scope' => 'Split scope',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:split_scope+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:primary' => 'Primär',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:primary+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:secondary' => 'Sekundär',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:secondary+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:active' => 'Aktiv',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:active+' => '',
));

//
// Class: IPv4Range
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPv4Range' => 'IPv4 Bereich',
	'Class:IPv4Range+' => '',
	'Class:IPv4Range/Attribute:subnet_id' => 'Subnetz',
	'Class:IPv4Range/Attribute:subnet_id+' => 'IPv4 Subnetz',
	'Class:IPv4Range/Attribute:subnet_ip' => 'Subnetz IP',
	'Class:IPv4Range/Attribute:subnet_ip+' => '',
	'Class:IPv4Range/Attribute:firstip' => 'Erste IP des Bereichs',
	'Class:IPv4Range/Attribute:firstip+' => '',
	'Class:IPv4Range/Attribute:lastip' => 'Letzte IP des Bereichs',
	'Class:IPv4Range/Attribute:lastip+' => '',
));

//
// Class: IPAddress
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPAddress' => 'IP Adresse',
	'Class:IPAddress+' => '',
	'Class:IPAddress:baseinfo' => 'Allgemeine Informationen',
	'Class:IPAddress:dnsinfo' => 'DNS Informationen',
	'Class:IPAddress:ipinfo' => 'IP Informationen',
	'Class:IPSubnet:localconfigparameters' => 'Einstellungen der IP',
	'Class:IPAddress/Attribute:short_name' => 'Hostname',
	'Class:IPAddress/Attribute:short_name+' => 'Hostnamenteil der FQDN, zum Bsp. "host" bei host.example.com',
	'Class:IPAddress/Attribute:domain_id' => 'DNS Domain',
	'Class:IPAddress/Attribute:domain_id+' => '',
	'Class:IPAddress/Attribute:domain_name' => 'Domainname',
	'Class:IPAddress/Attribute:domain_name+' => 'Name der DNS Domain',
	'Class:IPAddress/Attribute:fqdn' => 'FQDN',
	'Class:IPAddress/Attribute:fqdn+' => 'vollqualifizierter Domänenname',
	'Class:IPAddress/Attribute:aliases' => 'Aliase',
	'Class:IPAddress/Attribute:aliases+' => 'Liste der Aliase der FQDN',
	'Class:IPAddress/Attribute:usage_id' => 'Verwendungszweck',
	'Class:IPAddress/Attribute:usage_id+' => '',
	'Class:IPAddress/Attribute:usage_name' => 'Verwendungszweck',
	'Class:IPAddress/Attribute:usage_name+' => '',
	'Class:IPAddress/Attribute:ipinterface_id' => 'IP Schnittstelle',
	'Class:IPAddress/Attribute:ipinterface_id+' => '',
	'Class:IPAddress/Attribute:ipinterface_name' => 'IP Schnittstelle Name',
	'Class:IPAddress/Attribute:ipinterface_name+' => '',
	'Class:IPAddress/Attribute:allocation_date' => 'Datum der Zuweisung',
	'Class:IPAddress/Attribute:allocation_date+' => 'Datum, an dem die IP Adresse zugewiesen wurde.',
	'Class:IPAddress/Attribute:release_date' => 'Datum der Freigabe',
	'Class:IPAddress/Attribute:release_date+' => 'Datum, an dem die IP Adresse wieder freigegeben und nicht mehr benutzt wurde.',
	'Class:IPAddress/Attribute:ip_list' => 'NAT IPs',
	'Class:IPAddress/Attribute:ip_list+' => 'Liste der NAT IPs',
	'Class:IPAddress/Attribute:finalclass' => 'CI Klasse',
	'Class:IPAddress/Attribute:finalclass+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name' => 'Duplizierte Namen erlauben',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_no' => 'Nein',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_yes' => 'Ja',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPAddress/Attribute:ipconfig_:ip_allow_duplicate_name/Value:ipdup_dualstack' => 'Dual stack',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_dualstack+' => 'Duplikate werden zwischen eindeutigem IPv4 und IPv6 autorisiert',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name' => 'Duplizierte Namen erlauben',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:default' => 'Abgestimmt auf globale IP-Einstellungen',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_no' => 'Nein',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_yes' => 'Ja',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack' => 'Dual stack',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack+' => 'Duplikate werden zwischen eindeutigem IPv4 und IPv6 autorisiert',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign' => 'Ping auf IP vor der Zuweisung',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign+' => '',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_no' => 'Nein',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_no+' => '',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_yes' => 'Ja',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_yes+' => '',
	'Class:IPAddress/Attribute:ping_before_assign' => 'Ping auf IP vor der Zuweisung',
	'Class:IPAddress/Attribute:ping_before_assign+' => '',
	'Class:IPAddress/Attribute:ping_before_assign/Value:default' => 'Abgestimmt auf globale IP-Einstellungen',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_no' => 'Nein',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_no+' => '',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_yes' => 'Ja',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_yes+' => '',
));

//
// Class extensions for IPAddress
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPAddress/Tab:globalparam' => 'Globale Einstellungen',
	'Class:IPAddress/Tab:parents' => 'Parents',
	'Class:IPAddress/Tab:ip_list' => 'NAT IPs',
	'Class:IPAddress/Tab:ip_list+' => 'Liste der NAT IPs',
	'Class:IPAddress/Tab:ci_list' => 'CIs',
    'Class:IPAddress/Tab:ci_list+' => 'Liste der CIs, die auf diese IP zeigen:',
	'Class:IPAddress/Tab:ci_list_class' => '%1$ss',
	'Class:IPAddress/Tab:NoCi' => 'Keine CIs',
	'Class:IPAddress/Tab:NoCi+' => 'Keine CIs zeigen auf diese IP',
    'Class:IPAddress/Tab:requests' => 'IP Anforderungen',
	'Class:IPAddress/Tab:requests+' => 'IP Anforderungen, die mit IP Adresse verknüpft sind',
	'Class:IPAddress/Tab:norequests' => 'Keine IP Anforderungen',
	'Class:IPAddress/Tab:norequests+' => 'Keine IP Anforderungen sind mit IP Adresse verknüpft',
	'Class:IPAddress/Tab:changes' => 'IP Änderungen',
	'Class:IPAddress/Tab:changes+' => 'IP Änderungen, die mit IP Adresse verknüpft sind',
));

//
// Class: lnkIPAdressToIPAddress
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkIPAdressToIPAddress' => 'Verknüpfung IP / NAT IPs',
	'Class:lnkIPAdressToIPAddress+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall' => 'IP Type',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id' => 'IP Adresse',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id' => 'NAT IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name' => 'Hostname',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name+' => 'Hostnamenteil der FQDN, zum Bsp. "host" bei host.example.com',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name' => 'Domainname',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name+' => 'Name der DNS Domain',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name' => 'Hostname',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name+' => 'Hostnamenteil der FQDN, zum Bsp. "host" bei host.example.com',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name' => 'Domainname',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name+' => 'Name der DNS Domain',
	'Class:lnkIPAdressToIPAddress/Attribute:external_service_port' => 'Externer Service Port',
	'Class:lnkIPAdressToIPAddress/Attribute:external_service_port+' => 'Wird benutzt wenn Portweiterleitung AKTIVIERT ist.',
	'Class:lnkIPAdressToIPAddress/Attribute:map_to_port' => 'Interner Port',
	'Class:lnkIPAdressToIPAddress/Attribute:map_to_port+' => 'Wird benutzt wenn Portweiterleitung AKTIVIERT ist.',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol' => 'Protokoll',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol+' => 'Leer lassen für alle',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:udp' => 'UDP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:tcp' => 'TCP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:both' => 'UDP / TCP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:sctp' => 'SCTP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:icmp' => 'ICMP',
));

//
// Class: lnkIPInterfaceToIPAddress
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkIPInterfaceToIPAddress' => 'Verknüpfung IP Schnittstelle/ IP Adresse',
	'Class:lnkIPInterfaceToIPAddress+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall' => 'IP Type',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id' => 'IP Schnittstelle',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name' => 'IP Schnittstelle Name',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id' => 'IP Adresse',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:usage_id' => 'IP Adresse Verwendungszweck',
	'Class:lnkIPInterfaceToIPAddress/Attribute:usage_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_org_name' => 'IP Adresse Organisationsname',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_org_name+' => '',
));

//
// Class: IPv4Address
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPv4Address' => 'IPv4 Adresse',
	'Class:IPv4Address+' => '',
	'Class:IPv4Address/Attribute:subnet_id' => 'Subnetz',
	'Class:IPv4Address/Attribute:subnet_id+' => 'IPv4 Subnetz',
	'Class:IPv4Address/Attribute:subnet_ip' => 'Subnetz IP',
	'Class:IPv4Address/Attribute:subnet_ip+' => '',
	'Class:IPv4Address/Attribute:range_id' => 'Adressbereich',
	'Class:IPv4Address/Attribute:range_id+' => 'IPv4 Adressbereich',
	'Class:IPv4Address/Attribute:ip' => 'Adresse',
	'Class:IPv4Address/Attribute:ip+' => 'IPv4 Adresse',
));

//
// Class: IPRangeUsage
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPRangeUsage' => 'IP-Adressbereich Nutzung',
	'Class:IPRangeUsage+' => 'Wofür ein IP-Adressbereich genutzt wird',
	'Class:IPRangeUsage/Attribute:org_id' => 'Organisation',
	'Class:IPRangeUsage/Attribute:org_id+' => '',
	'Class:IPRangeUsage/Attribute:org_name' => 'Organisationsname',
	'Class:IPRangeUsage/Attribute:org_name+' => '',
	'Class:IPRangeUsage/Attribute:name' => 'Name',
	'Class:IPRangeUsage/Attribute:name+' => '',
	'Class:IPRangeUsage/Attribute:description' => 'Beschreibung',
	'Class:IPRangeUsage/Attribute:description+' => '',
	'Class:IPRangeUsage/Attribute:ipranges_list' => 'IP Bereiche',
	'Class:IPRangeUsage/Attribute:ipranges_list+' => '',
));

//
// Class: IPBlockType
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPBlockType' => 'IP-Blocktyp',
	'Class:IPBlockType+' => '',
	'Class:IPBlockType/Attribute:name' => 'Name',
	'Class:IPBlockType/Attribute:name+' => '',
	'Class:IPBlockType/Attribute:description' => 'Beschreibung',
	'Class:IPBlockType/Attribute:description+' => '',
	'Class:IPBlockType/Attribute:blocks_list' => 'Blöcke',
	'Class:IPBlockType/Attribute:blocks_list+' => 'Subnetzblöcke dieses Typs',
));

//
// Class: IPTriggerOnWaterMark
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPTriggerOnWaterMark' => 'Trigger (wenn ein IP-bezogener Schwellenwert erreicht wird)',
	'Class:IPTriggerOnWaterMark+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_id' => 'Organisation',
	'Class:IPTriggerOnWaterMark/Attribute:org_id+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_name' => 'Organisationsname',
	'Class:IPTriggerOnWaterMark/Attribute:org_name+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:target_class' => 'Zielklasse',
	'Class:IPTriggerOnWaterMark/Attribute:target_class+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event' => 'Event',
	'Class:IPTriggerOnWaterMark/Attribute:event+' => 'Event, der generiert wird, wenn der Trigger aktiviert wird',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low' => 'Unterer Schwellenwert wird erreicht',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high' => 'Oberer Schwellenwert wird erreicht',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high+' => '',
));

//
// Class: IPObjTemplate
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPObjTemplate' => 'IP Template',
	'Class:IPObjTemplate+' => '',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id' => 'Service Unterkategorie',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id+' => '',
	'Class:IPObjTemplate/Attribute:request_type' => 'Anfrage Type',
	'Class:IPObjTemplate/Attribute:request_type+' => '',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_create' => 'Neue IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_change' => 'IP Änderung',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_delete' => 'IP Löschung',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_create' => 'Neues Subnetz',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_change' => 'Subnetz Änderung',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_delete' => 'Subnetz Löschung',
));

//
// Application Menu
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Menu:IPManagement' => 'IP Management',
	'Menu:IPManagement+' => 'IP Management',
	'Menu:IPManagement:Overview:Total' => 'Überblick, insgesamt: %1s',
	'Menu:IPSpace' => 'IP-Raum',
	'Menu:IPSpace+' => 'IP-Raum',
	'Menu:IPSpace:IPv4Objects' => 'IPv4 Objekte',
	'Menu:IPSpace:IPv4Objects+' => 'IPv4 Objekte',
	'Menu:IPSpace:Options' => 'Parameter',
	'Menu:IPSpace:Options+' => 'Parameter',
	'Menu:NewIPObject' => 'Neues IP Objekt',
	'Menu:NewIPObject+' => 'Erzeugen eines neuen IP Objekts',
	'Menu:SearchIPObject' => 'Suche nach einem IP Objekt',
	'Menu:SearchIPObject+' => 'Suche nach einem IP Objekt',
	'Menu:IPv4ShortCut' => 'IPv4 Shortcuts',
	'Menu:IPv4ShortCut+' => 'IPv4 Shortcuts',
	'Menu:IPv4Block' => 'Subnetzblöcke',
	'Menu:IPv4Block+' => 'IPv4 Subnetzblöcke',
	'Menu:IPv4Subnet' => 'Subnetze',
	'Menu:IPv4Subnet+' => 'IPv4 Subnetze',
	'Menu:IPv4Subnet:Allocated' => 'zugewiesene Subnetze',
	'Menu:IPv4Subnet:Allocated+' => 'Liste aller zugewiesenen IPv4 Subnetze',
	'Menu:IPv4Range' => 'IP Bereiche',
	'Menu:IPv4Range+' => 'IPv4 Bereiche',
	'Menu:IPv4Address' => 'IP Adressen',
	'Menu:IPv4Address+' => 'IPv4 Adressen',
	'Menu:IPTools' => 'Werkzeuge',
	'Menu:IPTools+' => '',
	'Menu:FindSpace' => 'IP-Raum finden',
	'Menu:FindSpace+' => 'Werkzeug zum suchen und zuweisen von IP-Räumen',
	'Menu:SubnetCalculator' => 'Subnetz Rechner',
	'Menu:SubnetCalculator+' => '',
	'Menu:Options' => 'Parameter',
	'Menu:Options+' => 'Parameter',
	'Menu:Domain' => 'Domains',
	'Menu:Domain+' => 'Domainnamen',
	'Menu:IPTemplate' => 'IP Vorlagen',
	'Menu:IPTemplate+' => 'IP Voralgen',
	'Menu:IPMgmt:Typology' => ' IP-Raumtypologie-Konfiguration',
	'Menu:IPMgmt:Typology+' => '',

	'UI:IPMgmtWelcomeOverview:Title' => 'Mein Dashboard',

	// Menu separator in Action menus
	'UI:IPManagement:Action:MenuSeparator' => '<hr class="menu-separator"/>',
	'UI:IPManagement:Action:Error::WrongActionForClass' => 'Diese Aktion kann auf ein Objekt dieser Klasse nicht angewendet werden!',

//
// Management of IPBlocks
//
	// Creation Management
	'UI:IPManagement:Action:New:IPBlock:Reverted' => 'Die erste IP des Subnetz Blocks ist höher als die letzte IP!',
	'UI:IPManagement:Action:New:IPBlock:SmallerThanMinSize' => 'Die Blockgröße darf nicht kleiner sein als %1$s für dir Organisation %2$s!',
	'UI:IPManagement:Action:New:IPBlock:NotCIDRAligned' => 'Der Block ist nicht an der CIDR ausgerichtet!',
	'UI:IPManagement:Action:New:IPBlock:NotInParent' => 'Der Subnetzblock ist nicht strikt im ausgewählten übergeordneten Block enthalten.',
	'UI:IPManagement:Action:New:IPBlock:NameExist' => 'Der Name des Subnetzblocks existiert bereits!',
	'UI:IPManagement:Action:New:IPBlock:Collision0' => 'Subnetzblock existiert bereits!',
	'UI:IPManagement:Action:New:IPBlock:Collision1' => 'Subnetzblock Kollision: die erste IP gehört zu einem existierenden Block!',
	'UI:IPManagement:Action:New:IPBlock:Collision2' => 'Subnetzblock Kollision : die letzte IP gehört zu einem existierenden Block!',
	'UI:IPManagement:Action:Modify:IPBlock:ParentIdNull' => 'untergeordnete Subnetze von Block %1$s können nur an existierende übergeordnete Blöcke gehängt werden.',

	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPBlock:Reverted' => 'Die erste neue IP eines Subnetz Blocks ist höher als die letzte neue IP!',
	'UI:IPManagement:Action:Shrink:IPBlock:IPOutOfBlock' => 'Die neuen IPs sind nicht alle innerhalb eines Blocks!',
	'UI:IPManagement:Action:Shrink:IPBlock:NoChange' => 'Keine Änderung angefordert.',
	'UI:IPManagement:Action:Shrink:IPBlock:NotCIDRAligned' => 'Der Block ist nicht an der CIDR ausgerichtet!',
	'UI:IPManagement:Action:Shrink:IPBlock:BlockAccrossBorder' => 'Ein untergeordnetes Subnetz sitzt zwischen den neuen Grenzen!',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetAccrossBorder' => 'Ein Subnetz, das an den Block angehängt ist, sitzt zwischen den neuen Grenzen!',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetBecomesOrhpean' => 'Nach dem Verkleinern hätte das untergeordnete Subnetz keinen übergeordneten Block mehr!',
	'UI:IPManagement:Action:Shrink:IPBlock:Done' => '%1$s %2$s wurde verkleinert.',

	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPBlock:IPOutOfBlock' => 'Gesplittete IPs sind außerhalb des Blocks!',
	'UI:IPManagement:Action:Split:IPBlock:SmallerThanMinSize' => 'Die Blockgröße darf nicht kleiner sein als %1$s!',
	'UI:IPManagement:Action:Split:IPBlock:NotCIDRAligned' => 'Die Blöcke sind nicht an der CIDR ausgerichtet!',
	'UI:IPManagement:Action:Split:IPBlock:BlockAccrossBorder' => 'Ein untergeordnetes Subnetz sitzt zwischen den neuen Grenzen!',
	'UI:IPManagement:Action:Split:IPBlock:SubnetAccrossBorder' => 'Ein Subnetz, das an den Block angehängt ist, sitzt zwischen den neuen Grenzen!',
	'UI:IPManagement:Action:Split:IPBlock:EmptyNewName' => 'Name des neuen Subnetzblocks ist leer!',
	'UI:IPManagement:Action:Split:IPBlock:NameExist' => 'Name des neuen Subnetzblocks existiert bereits!',
	'UI:IPManagement:Action:Split:IPBlock:Done' => '%1$s %2$s wurde geteilt.',

	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPBlock:Reverted' => 'Die erste neue IP eines Subnetzblocks ist höher als die letzte neue IP!',
	'UI:IPManagement:Action:Expand:IPBlock:IPOutOfBlock' => 'Die neuen IPs sind nicht alle außerhalb eines Blocks!',
	'UI:IPManagement:Action:Expand:IPBlock:NoChange' => 'Keine Änderung angefordert.',
	'UI:IPManagement:Action:Expand:IPBlock:NotCIDRAligned' => 'Der Block ist nicht an der CIDR ausgerichtet!',
	'UI:IPManagement:Action:Expand:IPBlock:BlockBigerThanParent' => 'Der Block darf nicht größer sein als sein übergeordneter Block!',
	'UI:IPManagement:Action:Expand:IPBlock:DelegatedBlockAccrossBorder' => 'Der Block darf einen delegierten Block nicht übernehmen!',
	'UI:IPManagement:Action:Expand:IPBlock:BlockAccrossBorder' => 'Ein Geschwister-Subnetzblock sitzt zwischen den neuen Grenzen!',
	'UI:IPManagement:Action:Expand:IPBlock:SubnetAccrossBorder' => 'Ein Subnetz, das an den übergeordneten Block angehängt ist, sitzt zwischen den neuen Grenzen!',
	'UI:IPManagement:Action:Expand:IPBlock:Done' => '%1$s %2$s wurde vergrößert.',

	// Find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPBlock:RequestedSpaceBiggerThanBlockSize' => 'Die IP Adresse, von der aus der IP Bereich durchsucht werden soll, gehört zum Subnetzblock %1$s, und der angeforderte IP Bereich ist größer als die Größe dieses Blocks!',
	'UI:IPManagement:Actilon:DoFindSpace:IPBlock:NoSpaceFound' => 'Innerhalb von Block %1$s ist nicht genügend freier Platz vorhanden, um Ihre Anfrage zu erfüllen!',
	'IPManagement:Action:DoFindSpace:IPBlock:IPToStartFrom' => 'von IP %1$s',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPBlock:NoChildOrg' => 'Die Organisation des Blocks hat keine untergeordneten Elemente!',
	'UI:IPManagement:Action:Delegate:IPBlock:NoOtherOrg' => 'Keine andere Organisation!',
	'UI:IPManagement:Action:Delegate:IPBlock:IsDelegated' => 'Dieser Block wurde bereits delegiert!',
	'UI:IPManagement:Action:Delegate:IPBlock:WrongLevelOfOrganization' => 'Der Delegation Change muss für eine Geschwister-Organisation gemacht werden!',
	'UI:IPManagement:Action:Delegate:IPBlock:NoChangeOfOrganization' => 'Keine Änderung notwendig!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocks' => 'Der Block hat untergeordnete Blöcke!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnets' => 'Der Block hat untergeordnete Subnetze!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithDelegatedBlockFromOtherOrg' => 'Es gibt bereits einige Blöcke, die von anderen Organisationen in diesem Block delegiert wurden!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfTargetOrg' => 'Block in Konflikt mit einem Block der Zielorganisation!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfParentOrg' => 'Block in Konflikt mit einem Block der übergeordneten Organisation!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocksInParent' => 'Der Block hat untergeordnete Elemente in der übergeordneten Organisation!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnetsInParent' => 'Der Block hat untergeordnete Subnetze in der übergeordneten Organisation!',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPBlock:CannotBeUndelegated' => 'Delegierung für Block kann nicht aufgehoben werden: %1$s',
	'UI:IPManagement:Action:Undelegate:IPBlock:IsNotDelegated' => 'Block steht zur Delegierung zur Verfügung!',
	'UI:IPManagement:Action:Undelegate:IPBlock:HasChildBlocks' => 'Block hat Subblöcke!',
	'UI:IPManagement:Action:Undelegate:IPBlock:HasChildSubnets' => 'Block hat Subnetze!',

	// Display pointers to previous and next Blocks
	'UI:IPManagement:Action:DisplayPrevious:IPBlock' => 'Vorherige',
	'UI:IPManagement:Action:DisplayNext:IPBlock' => 'Nächste',

//
// Management of IPv4Blocks
//
	// Display details of subnet blocks
	'UI:IPManagement:Action:Details:IPv4Block' => 'Details',
	'UI:IPManagement:Action:Details:IPv4Block+' => '',

	// Display list of subnet blocks
	'UI:IPManagement:Action:DisplayList:IPv4Block' => 'Liste anzeigen',
	'UI:IPManagement:Action:DisplayList:IPv4Block+' => '',
	'UI:IPManagement:Action:DisplayList:IPv4Block:PageTitle_Class' => 'IPv4 Subnetzblöcke',
	'UI:IPManagement:Action:DisplayList:IPv4Block:Title_Class' => 'IPv4 Subnetzblöcke',

	// Display tree of subnet blocks
	'UI:IPManagement:Action:DisplayTree:IPv4Block' => 'Baumstruktur anzeigen',
	'UI:IPManagement:Action:DisplayTree:IPv4Block+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:PageTitle_Class' => 'IPv4 Subnetzblöcke',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:Title_Class' => 'IPv4 Subnetzblöcke',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:OrgName' => 'Organisation %1$s',

	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPv4Block' => 'Verkleinern',
	'UI:IPManagement:Action:Shrink:IPv4Block+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Block:Summary' => 'Zusammenfassung',
	'UI:IPManagement:Action:Shrink:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s verkleinern',
	'UI:IPManagement:Action:Shrink:IPv4Block:Title_Class_Object' => 'Verkleinere %1$s: %2$s',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewFirstIP' => 'Neue erste IP des Blocks:',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewLastIP' => 'Neue Letzte IP des Blocks:',
	'UI:IPManagement:Action:Shrink:IPv4Block:IsDelegated' => 'Dieser Block wurde delegiert und kann daher nicht verkleinert werden!',
	'UI:IPManagement:Action:Shrink:IPv4Block:CannotBeShrunk' => 'Block kann nicht verkleinert werden: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Block:SmallerThanMinSize' => 'Die Blockgröße kann nicht kleiner sein als %1$s!',
	'UI:IPManagement:Action:Shrink:IPv4Block:Done' => '%1$s %2$s wurde verkleinert.',

	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv4Block' => 'Teilen',
	'UI:IPManagement:Action:Split:IPv4Block+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:Summary' => 'Zusammenfassung',
	'UI:IPManagement:Action:Split:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s teilen',
	'UI:IPManagement:Action:Split:IPv4Block:Title_Class_Object' => 'Teilen %1$s: %2$s',
	'UI:IPManagement:Action:Split:IPv4Block:At' => 'Erste IP des neuen Subnetz Blocks:',
	'UI:IPManagement:Action:Split:IPv4Block:NameNewBlock' => 'Name des neuen Subnetz Blocks:',
	'UI:IPManagement:Action:Split:IPv4Block:IsDelegated' => 'Dieser Block wurde delegiert und kann daher nicht aufgeteilt werden!',
	'UI:IPManagement:Action:Split:IPv4Block:CannotBeSplit' => 'Block kann nict geteilt werden: %1$s',
	'UI:IPManagement:Action:Split:IPv4Block:SmallerThanMinSize' => 'Blockgröße kann nicht kleiner als %1$s sein!',
	'UI:IPManagement:Action:Split:IPv4Block:Done' => '%1$s %2$s wurde geteilt.',

	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv4Block' => 'Vergrößern',
	'UI:IPManagement:Action:Expand:IPv4Block+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary' => 'Zusammenfassung',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s vergrößern',
	'UI:IPManagement:Action:Expand:IPv4Block:Title_Class_Object' => 'Vergrößere %1$s: %2$s',
	'UI:IPManagement:Action:Expand:IPv4Block:NewFirstIP' => 'Neue erste IP des Blocks:',
	'UI:IPManagement:Action:Expand:IPv4Block:NewLastIP' => 'Neue letzte IP des Blocks:',
	'UI:IPManagement:Action:Expand:IPv4Block:IsDelegated' => 'Dieser Block wurde delegiert und kann daher nicht vergrößert werden!',
	'UI:IPManagement:Action:Expand:IPv4Block:CannotBeExpanded' => 'Block kann nicht vergrößert werden: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Block:SmallerThanMinSize' => 'Blockgröße kann nicht kleiner als %1$s sein!',
	'UI:IPManagement:Action:Expand:IPv4Block:Done' => '%1$s %2$s wurde vergrößert.',

	// List space action on subnet blocks
	'UI:IPManagement:Action:ListSpace:IPv4Block' => 'IP-Raum auflisten',
	'UI:IPManagement:Action:ListSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - IP-Raum',
	'UI:IPManagement:Action:ListSpace:IPv4Block:Title_Class_Object' => 'IP-Raum in %1$s: %2$s',
	'UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpace' => 'Frei [%1$s - %2$s] - %3$s IPs - %4$.2f %%',
	'UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpaceNoPercent' => 'Frei [%1$s - %2$s] - %3$s IPs',

	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv4Block' => 'IP-Raum finden',
	'UI:IPManagement:Action:FindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - IP-Raum finden',
	'UI:IPManagement:Action:FindSpace:IPv4Block:Title_Class_Object' => 'IP-Raum suchen in %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv4Block:SizeOfSpace' => 'Größe des benötigten IP-Raums:',
	'UI:IPManagement:Action:FindSpace:IPv4Block:MaxNumberOfOffers' => 'Maximal mögliche Anzahl :',

	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv4Block' => 'IP-Raum gefunden',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - IP-Raum finden',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Title_Class_Object' => 'IP-Raum in %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Summary' => '%1$s ersten /%2$s im Block',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsBlock' => 'Als untergeordneter Block erzeugen',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsSubnet' => 'Als Subnetz erzeugen',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv4Block' => 'Delegieren',
	'UI:IPManagement:Action:Delegate:IPv4Block:PageTitle_Object_Class' => '%1$s - Delegieren',
	'UI:IPManagement:Action:Delegate:IPv4Block:Title_Class_Object' => '%1$s %2$s an Organisation delegieren',
	'UI:IPManagement:Action:Delegate:IPv4Block:ChildBlock' => 'Organisation, an die der Block delegiert werden soll:',
	'UI:IPManagement:Action:Delegate:IPv4Block:NoChildOrg' => 'Block Organisation hast keine Kinder und kann nicht delegiert werden!',
	'UI:IPManagement:Action:Delegate:IPv4Block:NoOtherOrg' => 'Keine andere Organisation!',
	'UI:IPManagement:Action:Delegate:IPv4Block:IsDelegated' => 'Dieser Block wurde bereits delegiert!',
	'UI:IPManagement:Action:Delegate:IPv4Block:CannotBeDelegated' => 'Block kann nicht delegiert werden: %1$s',
	'UI:IPManagement:Action:Delegate:IPv4Block:Done' => '%1$s %2$s wurde delegiert.',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPv4Block:CannotBeUndelegated' => 'Delegierung kann nicht entfernt werden: %1$s',
	'UI:IPManagement:Action:Undelegate:IPv4Block' => 'Delegierung aufheben',
	'UI:IPManagement:Action:Undelegate:IPv4Block:PageTitle_Object_Class' => '%1$s - Delegierung aufheben',
	'UI:IPManagement:Action:Undelegate:IPv4Block:Done' => '%1$s %2$s - Delegierung entfernt.',

//
// Management of Subnets
//
	// Creation Management
	'UI:IPManagement:Action:New:IPSubnet:IpCannotChange' => 'Subnetz IP kann nicht modifiziert werden!',
	'UI:IPManagement:Action:New:IPSubnet:MaskCannotChange' => 'Subnetz Maske kann nicht modifiziert werden!',
	'UI:IPManagement:Action:New:IPSubnet:IpIncorrect' => 'Subnetz IP ist nicht mit der Maske konsistent!',
	'UI:IPManagement:Action:New:IPSubnet:NotInBlock' => 'Subnetz ist nicht Teil des selektierten Blocks!',
	'UI:IPManagement:Action:New:IPSubnet:Collision0' => 'Subnetz existiert bereits!',
	'UI:IPManagement:Action:New:IPSubnet:Collision1' => 'Subnetz Kollision: Subnetz IP gehört zu einem existierenden Subnetz!',
	'UI:IPManagement:Action:New:IPSubnet:Collision2' => 'Subnetz Kollision: Broadcast IP gehört zu einem existierenden Subnetz!',
	'UI:IPManagement:Action:New:IPSubnet:Collision3' => 'Subnetz Kollision: neues Subnetz schliesst ein existierendes ein!',
	'UI:IPManagement:Action:New:IPSubnet:GatewayOutOfSubnet' => 'Gateway IP ist nicht in den Subnetz Grenzen.!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPSubnet' => 'Subnetz Rechner',
	'UI:IPManagement:Action:Calculator:IPSubnet:SelectSubnetType' => 'Wählen Sie den Typ der Subnetze',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:SelectCreation' => 'Sie können die verwandten Subnetzblöcke oder Subnetze registrieren:',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CreateSubnet' => 'Subnetz erstellen',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateSubnet:MaskIsToSmall' => 'Maske ist zu klein: Subnetz kann nicht erstellt werden!',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CreateBlock' => 'Subnetzblöcke erstellen',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateBlock:MaskIsToBig' => 'Maske ist zu groß: Subnetz Block kann nicht erstellt werden!',

	// Display pointers to previous and next Subnets
	'UI:IPManagement:Action:DisplayPrevious:IPSubnet' => 'Vorherige',
	'UI:IPManagement:Action:DisplayNext:IPSubnet' => 'Nächste',

//
// Management of IPv4 Subnets
//
	// Display details of subnet
	'UI:IPManagement:Action:Details:IPv4Subnet' => 'Details',
	'UI:IPManagement:Action:Details:IPv4Subnet+' => '',

	// Display list of subnets
	'UI:IPManagement:Action:DisplayList:IPv4Subnet' => 'Liste anzeigen',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet+' => '',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet:PageTitle_Class' => 'IPv4 Subnetze',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet:Title_Class' => 'IPv4 Subnetze',

	// Display tree of subnets
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet' => 'Baumstruktur anzeigen',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:PageTitle_Class' => 'IPv4 Subnetze',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:Title_Class' => 'IPv4 Subnetze',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:OrgName' => 'Organisation %1$s',

	// Find space action on subnets
	'UI:IPManagement:Action:FindSpace:IPv4Subnet' => 'IP-Raum finden',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IP-Raum finden',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:Title_Class_Object' => 'Nach IP-Raum suchen in : %2$s',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeTooSmall' => 'Subnetz ist zu klein für Raum Suche. Bitte abbrechen.',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeOfRange' => 'Größe des gesuchten IP-Raums :',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:MaxNumberOfOffers' => 'Maximal mögliche Anzahl :',

	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet' => 'IP-Raum gefunden',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IP-Raum finden',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Title_Class_Object' => 'IP-Raum in %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Summary' => '%1$s die ersten freien %2$s IP-Räume im Subnetz',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeEmpty' => 'Die angeforderte Raumgröße ist 0! Bitte versuchen Sie es mit einem höheren Wert.',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeTooBig' => 'Die angeforderte Raumgröße passt nicht in das Subnetz. Bitte erneut mit einem kleineren Wert versuchen.',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:CreateAsRange' => 'Als IP Bereich erzeugen',

	// List IPs action on subnets
	'UI:IPManagement:Action:ListIps:IPv4Subnet' => 'IPs auflisten und auswählen',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Title_Class_Object' => 'Liste von IPs in %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Subtitle_ListRange' => 'Subnetz ist zu groß, um alle IPs aufzulisten. Bitte ein anzuzeigendes Intervall auswählen:',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:FirstIP' => 'Erste IP in der Liste',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:LastIP' => 'Letzte IP in der Liste',

	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv4Subnet' => 'IPs auflisten und auswählen',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:Title_Class_Object' => 'Teilliste von IPs in %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:CannotBeListed' => 'IPs können nicht angezeigt werden in der Liste: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIPOutOfSubnet' => 'Erste IP ist außerhalb vom Subnetz!',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:LastIPOutOfSubnet' => 'Letzte IP ist außerhalb vom Subnetz!',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'Die erste IP ist höher als die letzte IP!',

	// Shrink action on subnets
	'UI:IPManagement:Action:Shrink:IPv4Subnet' => 'Verkleinern',
	'UI:IPManagement:Action:Shrink:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary' => 'Zusammenfassung',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s verkleinern',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Title_Class_Object' => 'Verkleinern %1$s: %2$s',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:CannotBeShrunk' => 'Subnetz kann nicht verkleinert werden: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmall' => 'Subnetz ist zu klein zum Verkleinern!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy' => 'Subnetz ist zu klein zum Verkleinern um %1$s!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeInTheMiddle' => 'Der Bereich: <b>%1$s [%2$s - %3$s]</b> ragt über neue Subnetzgrenzen hinaus. Verkleinern kann nicht durchgeführt werden!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeDropped' => 'Der Bereich: <b>%1$s [%2$s - %3$s]</b> wird aus dem Subnetz gelöscht. Verkleinern kann nicht durchgeführt werden!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Done' => '%1$s %2$s wurde um %3$s verkleinert.',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:By' => 'Verkleinern um :',

	// Split action on subnets
	'UI:IPManagement:Action:Split:IPv4Subnet' => 'Teilen',
	'UI:IPManagement:Action:Split:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary' => 'Zusammenfassung',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s Teilen',
	'UI:IPManagement:Action:Split:IPv4Subnet:Title_Class_Object' => 'Teilen %1$s: %2$s',
	'UI:IPManagement:Action:Split:IPv4Subnet:CannotBeSplit' => 'Subnetz kann nicht geteilt werden: %1$s',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmall' => 'Subnetz ist zu klein zum Teilen!',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy' => 'Subnetz ist zu klein zum Teilen um %1$s!',
	'UI:IPManagement:Action:Split:IPv4Subnet:IPRangeInTheMiddle' => 'Der Bereich: <b>%1$s [%2$s - %3$s]</b> ragt über neue Subnetzgrenzen hinaus. Teilen kann nicht durchgeführt werden!',
	'UI:IPManagement:Action:Split:IPv4Subnet:Done' => '%1$s %2$s wurde in %3$s geteilt .',
	'UI:IPManagement:Action:Split:IPv4Subnet:In' => 'Teilen in :',

	// Expand action on subnets
	'UI:IPManagement:Action:Expand:IPv4Subnet' => 'Vergrößern',
	'UI:IPManagement:Action:Expand:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary' => 'Zusammenfassung',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s Vergrößern',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Title_Class_Object' => 'Vergrößern %1$s: %2$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:CannotBeExpanded' => 'Subnetz kann nicht vergrößert werden: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBig' => 'Subnetz ist zu groß zum Vergrößern!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy' => 'Subnetz ist zu groß, um es um %1$s zu vergrößern!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:NotInIPBlock' => 'Der Block, in dem das Subnetz enthalten ist, ist zu klein, um das neue, vergrößerte Subnetz enthalten zu können!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Done' => '%1$s %2$s wurde vergrößert um %3$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:By' => 'Vergrößern um:',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet' => 'CSV Export IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV Export von IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Title_Class_Object' => 'CSV Export IPs von %1$s: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Subtitle_ListRange' => 'Subnetz ist zu groß, um alle IPs auf einmal zu exportieren. Bitte einen Unterbereich auswählen:',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:FirstIP' => 'Erste IP der Liste',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:LastIP' => 'Letzte IP der Liste',

	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet' => 'CSV Export IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV Export von IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:Title_Class_Object' => 'Partieller CSV Export von IPs in %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:CannotBeListed' => 'IPs können nicht gelistet werden: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIPOutOfSubnet' => 'Die erste IP ist außerhalb des Subnetzes!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:LastIPOutOfSubnet' => 'Die letzte IP ist außerhalb des Subnetzes!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'Die erste IP des Bereichs ist größer als die letzte IP!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv4Subnet' => 'Subnetz Rechner',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:PageTitle_Object_Class' => '%2$s Rechner',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Title_Class_Object' => 'Rechner für %1$s',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:IP' => 'IP Adresse',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Mask' => 'Maske',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:CIDR' => 'CIDR',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet' => 'Subnetz Rechner',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PageTitle_Object_Class' => '%2$s Rechner',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Title_Class_Object' => '%1$s - Ergebnis des Rechners',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IP' => 'IP Adresse',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Mask' => 'Maske',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CIDR' => 'CIDR',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:SubnetIP' => 'Subnetz IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Wildcard' => 'Wildcard Maske',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:BroadcastIP' => 'Broadcast IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IPNumber' => 'Anzahl von IPs',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:UsableHosts' => 'Anzahl benutzbarer Hosts',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet' => 'Vorherige Subnetz IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet:NA' => 'Nicht anwendbar',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet' => 'Nächste Subnetz IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet:NA' => 'Nicht anwendbar',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CannotRun' => 'Subnetz Rechner kann nicht rechnen: %1$s',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:EnterMaskOrCIDR' => 'Eine Maske oder einen CIDR eingeben!',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongMask' => 'Maske ist ungültig!',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongCIDR' => 'CIDR ist ungültig!',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:CannotBeExploded' => 'FQDN kann nicht in Kurz- und Domainname aufgeteilt werden',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:PageTitle_Object_Class' => 'FQDN aufteilen',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:Done' => 'FQDN wurde aufgeteilt am %1$s %2$s',

//
// Management of IP ranges
//
	// Creation Management
	'UI:IPManagement:Action:New:IPRange:NameExist' => 'Der Name des Bereichs existiert bereits innerhalb des Subnetzes!',
	'UI:IPManagement:Action:New:IPRange:Reverted' => 'Die erste IP des Bereichs ist höher als die letzte IP!',
	'UI:IPManagement:Action:New:IPRange:NotInSubnet' => 'Der IP Bereich gehört nicht zum ausgewählten Subnetz!',
	'UI:IPManagement:Action:New:IPRange:Collision0' => 'IP Bereich existiert bereits!',
	'UI:IPManagement:Action:New:IPRange:Collision1' => 'Bereichskollision: die erste IP gehört zu einem schon existierenden Bereich!',
	'UI:IPManagement:Action:New:IPRange:Collision2' => 'Bereichskollision: die letzte IP gehört zu einem schon existierenden Bereich!',
	'UI:IPManagement:Action:New:IPRange:Collision3' => 'Bereichskollision: der Bereich umfasst einen schon bestehenden!',
	'UI:IPManagement:Action:Update:IPRange:NonDHCPRangeWithServers' => 'Nur DHCP-Bereiche können mit DHCP-Servern verknüpft werden!',
	'UI:IPManagement:Action:New:lnkFunctionalCIToIPRange:WrongCIClass' => 'Ein DHCP-Server kann nur der Klasse Server oder virtuelle Maschine angehören!',

	// Display pointers to previous and next Ranges
	'UI:IPManagement:Action:DisplayPrevious:IPRange' => 'Vorherige',
	'UI:IPManagement:Action:DisplayNext:IPRange' => 'Nächste',

//
// Management of IPv4 ranges
//
	// Display details of IP Range
	'UI:IPManagement:Action:Details:IPv4Range' => 'Details',
	'UI:IPManagement:Action:Details:IPv4Range+' => '',

	// List IPs action on IP Ranges
	'UI:IPManagement:Action:ListIps:IPv4Range' => 'IPs auflisten und auswählen',
	'UI:IPManagement:Action:ListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv4Range:Title_Class_Object' => 'Liste von IPs in %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv4Range:Subtitle_ListRange' => 'Bereich ist zu groß, um alle IPs aufzulisten. Bitte kleineren Bereich auswählen:',
	'UI:IPManagement:Action:ListIps:IPv4Range:FirstIP' => 'Erste IP der Liste',
	'UI:IPManagement:Action:ListIps:IPv4Range:LastIP' => 'Letzte IP der Liste',

	// Do list IPs action on IP Ranges
	'UI:IPManagement:Action:DoListIps:IPv4Range' => 'IPs auflisten und auswählen',
	'UI:IPManagement:Action:DoListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Range:Title_Class_Object' => 'Partielle Liste der IPs in %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv4Range:CannotBeListed' => 'Bereich kann nicht aufgelistet werden: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIPOutOfRange' => 'Erste IP außerhalb des Bereichs!',
	'UI:IPManagement:Action:DoListIps:IPv4Range:LastIPOutOfRange' => 'Letzte IP außerhalb des Bereichs!',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIpBiggerThanLastIp' => 'erste IP des Bereichs ist größer als die letzte IP!',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv4Range' => 'CSV Export von IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s CSV Export von IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Title_Class_Object' => 'CSV Export der IPs von %1$s: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Subtitle_ListRange' => 'Bereich ist zu groß, um alle IPs gleichzeitig zu exportieren. Bitte einen Unterbereich auswählen:',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:FirstIP' => 'Erste IP der Liste',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:LastIP' => 'Letzte IP der Liste',

	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range' => 'CSV Export von IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s CSV Export von IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:Title_Class_Object' => 'Partieller CSV Export der IPs von %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:CannotBeListed' => 'Bereich kann nicht exportiert werden: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIPOutOfRange' => 'Erste IP außerhalb des Bereichs!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:LastIPOutOfRange' => 'Letzte IP außerhalb des Bereichs!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIpBiggerThanLastIp' => 'Erste IP des Bereichs ist größer als die letzte IP!',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:CannotBeExploded' => 'FQDN kann nicht in Kurz- und Domainname aufgeteilt werden',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:PageTitle_Object_Class' => 'FQDN aufteilen',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:Done' => 'FQDN wurde aufgeteilt am %1$s %2$s',

//
// Management of IP Addresses
//
	// Creation Management
	'UI:IPManagement:Action:New:IPAddress:IPNameCollision' => 'Hostname (kurzer Name) existiert bereits in der Domain!',

	'UI:IPManagement:Action:New:IPAddress:IPCollision' => 'Die IP existiert bereits!',
	'UI:IPManagement:Action:New:IPAddress:NotInRange' => 'Die IP gehört nicht zum IP Bereich!',
	'UI:IPManagement:Action:New:IPAddress:NotInSubnet' => 'Die IP gehört nicht zum Subnetz!',
	'UI:IPManagement:Action:New:IPAddress:IPPings' => 'IP ist erreichbar!',
	'UI:IPManagement:Action:New:IPAddress:NatIPsAretheSame' => 'IP kann nicht auf sich selber ge-NAT-tet werden!',

	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:AllocateIP:IPAddress' => 'Zuweisen zu einem CI',
	'UI:IPManagement:Action:UnAllocateIP:IPAddress' => 'Freigeben von allen CIs',
	'UI:IPManagement:Action:Allocate:IPAddress:Class' => 'Zielklasse',
	'UI:IPManagement:Action:Allocate:IPAddress:CI' => 'Funktionales CI',
	'UI:IPManagement:Action:Allocate:IPAddress:IPAttribute' => 'Attribute der Adresse',
	'UI:IPManagement:Action:Allocate:IPAddress:NoCI' => 'In dieser Organisation gibt es keine instanziierten CIs mit IP-Adressattributen!',
	'UI:IPManagement:Action:Allocate:IPAddress:CannotAllocateCI' => 'Die Adresse kann nicht zum CI zugewiesen werden : %1$s',
	'UI:IPManagement:Action:Allocate:IPAddress:CIDoesNotExist' => 'Funktionales CI existiert nicht!',
	'UI:IPManagement:Action:Allocate:IPAddress:AttributeIsReadOnly' => 'Das Attribut ist schreibgeschützt!',
	'UI:IPManagement:Action:Allocate:IPAddress:AttributeIsSynchronized' => 'Das Attribut kann nicht gespeichert werden, da es von einer externen Quelle synchronisiert wird!',
	'UI:IPManagement:Action:Allocate:IPAddress:FQDNIsConflicting' => 'Neuer FQDN kollidiert mit Duplikatsregeln, die in der Konfiguration definiert sind!',
	'UI:IPManagement:Action:Allocate:IPAddress:IPAlreadyAllocated' => 'Adresse ist bereits vergeben!',
	'UI:IPManagement:Action:Unallocate:IPAddress:CannotBeUnallocated' => 'Die Adresse kann nicht freigegeben werden: %1$s',
	'UI:IPManagement:Action:UnAllocate:IPAddress:IPNotAllocated' => 'Die Adresse ist nicht zugewiesen!',
	'UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsReadOnly' => 'Die Adresse wird an das Attribut eines CI angehängt, das schreibgeschützt ist!',
	'UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsSynchronized' => 'Die Adresse wird an das Attribut eines CI angehängt, das ein Slave einer Synchronisation ist!',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPAddress:FQDNAttributeDoesNotExist' => 'Attribut %1$s ist kein Attribut der IP-Adresse!',

	// Display pointers to previous and next IPs
	'UI:IPManagement:Action:DisplayPrevious:IPAddress' => 'Vorherige',
	'UI:IPManagement:Action:DisplayNext:IPAddress' => 'Nächste',

//
// Management of IPv4 Addresses
//
	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:Allocate:IPv4Address' => 'Adresse zum CI zuweisen',
	'UI:IPManagement:Action:Allocate:IPv4Address:PageTitle_Object_Class' => 'Zuweisen einer IP',
	'UI:IPManagement:Action:Allocate:IPv4Address:Title_Class_Object' => 'Zuweisen von %1$s %2$s zum CI',
	'UI:IPManagement:Action:Allocate:IPv4Address:Done' => '%1$s %2$s wurde zugewiesen.',
	'UI:IPManagement:Action:Allocate:IPv4Address:IPAlreadyAllocated' => 'Adresse ist bereits zugewiesen!',
	'UI:IPManagement:Action:UnAllocate:IPv4Address' => 'Adresse von allen CIs freigeben',
	'UI:IPManagement:Action:Unallocate:IPv4Address:PageTitle_Object_Class' => 'Freigeben der IP',
	'UI:IPManagement:Action:Unallocate:IPv4Address:Done' => '%1$s %2$s wurde freigegeben.',
	'UI:IPManagement:Action:UnAllocate:IPv4Address:IPNotAllocated' => 'Adresse ist nicht zugewiesen!',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:CannotBeExploded' => 'FQDN kann nicht in Kurz- und Domainname aufgeteilt werden',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:PageTitle_Object_Class' => 'FQDN aufteilen',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:Done' => 'FQDN wurde aufgeteilt am %1$s %2$s',

//
// Management of Domains
//
	// Creation Management
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'Domainname existiert bereits!',

	// Display list of domains
	'UI:IPManagement:Action:DisplayList:Domain' => 'Liste anzeigen',
	'UI:IPManagement:Action:DisplayList:Domain+' => '',
	'UI:IPManagement:Action:DisplayList:Domain:PageTitle_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayList:Domain:Title_Class' => 'DNS Domains',

	// Display tree of domains
	'UI:IPManagement:Action:DisplayTree:Domain' => 'Baumstruktur anzeigen',
	'UI:IPManagement:Action:DisplayTree:Domain+' => '',
	'UI:IPManagement:Action:DisplayTree:Domain:PageTitle_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayTree:Domain:Title_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayTree:Domain:OrgName' => 'Organisation %1$s',

//
// Generic actions
//
	// Find space action on subnets
	'UI:IPManagement:Action:FindSpace' => 'Suchen und Zuweisen von IP-Raum',
	'UI:IPManagement:Action:FindSpace:Organization' => 'Organisation',
	'UI:IPManagement:Action:FindSpace:SpaceType' => 'Raumtyp',
	'UI:IPManagement:Action:FindSpace:IPv4Space' => 'IPv4 Raumtyp',
	'UI:IPManagement:Action:FindSpace:IPv6Space' => 'IPv6 Raumtyp',
	'UI:IPManagement:Action:FindIPv4Space' => 'Suchen und Zuweisen von IPv4 Raum',
	'UI:IPManagement:Action:FindIPv6Space' => 'Suchen und Zuweisen von IPv6 Raum',
	'UI:IPManagement:Action:FindSpace:FirstIP' => 'Von IP Adresse:',
	'UI:IPManagement:Action:FindSpace:SpaceSize' => 'Größe des zu suchenden Raums:',
	'UI:IPManagement:Action:FindSpace:MaxNumberOfOffers' => 'Maximale Anzahl von Angeboten:',

));
