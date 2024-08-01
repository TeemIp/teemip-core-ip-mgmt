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

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPObject' => 'Objet IP',
	'Class:IPObject+' => '',
	'IPObject:GlobalParams' => 'Paramètres globaux',
	'IPObject:GlobalParams+' => 'Paramètres globaux définis au niveau de l\'organisation et paramètres réellement utilisés par l\'object',
	'Class:IPObject:GeneralConfigParameters' => 'Paramètres de l\'organisation',
	'Class:IPObject/Attribute:finalclass' => 'Sous-classe',
	'Class:IPObject/Attribute:finalclass+' => 'Nom de la classe instanciable',
	'Class:IPObject/Attribute:org_id' => 'Organisation',
	'Class:IPObject/Attribute:org_id+' => '',
	'Class:IPObject/Attribute:org_name' => 'Nom de l\'organisation',
	'Class:IPObject/Attribute:org_name+' => '',
	'Class:IPObject/Attribute:status' => 'Etat',
	'Class:IPObject/Attribute:status+' => '',
	'Class:IPObject/Attribute:status/Value:reserved' => 'Réservé(e)',
	'Class:IPObject/Attribute:status/Value:reserved+' => '',
	'Class:IPObject/Attribute:status/Value:allocated' => 'Alloué(e)',
	'Class:IPObject/Attribute:status/Value:allocated+' => '',
	'Class:IPObject/Attribute:status/Value:released' => 'Libéré(e)',
	'Class:IPObject/Attribute:status/Value:released+' => '',
	'Class:IPObject/Attribute:status/Value:unassigned' => 'Non assigné(e)',
	'Class:IPObject/Attribute:status/Value:unassigned+' => '',
	'Class:IPObject/Attribute:comment' => 'Note',
	'Class:IPObject/Attribute:comment+' => '',
	'Class:IPObject/Attribute:requestor_id' => 'Demandeur',
	'Class:IPObject/Attribute:requestor_id+' => '',
	'Class:IPObject/Attribute:requestor_name' => 'Nom Demandeur',
	'Class:IPObject/Attribute:requestor_name+' => '',
	'Class:IPObject/Attribute:allocation_date' => 'Date d\'allocation',
	'Class:IPObject/Attribute:allocation_date+' => 'Date à laquelle l\'objet a été alloué.',
	'Class:IPObject/Attribute:release_date' => 'Date de libération',
	'Class:IPObject/Attribute:release_date+' => 'Date à laquelle l\'objet a été libéré et n\'est plus utilisé.',
	'Class:IPObject/Attribute:ipconfig_id' => 'Paramètres globaux IP',
	'Class:IPObject/Attribute:ipconfig_id+' => '',
	'Class:IPObject/Attribute:contact_list' => 'Contacts',
	'Class:IPObject/Attribute:contact_list+' => 'Contacts liés à l\'objet IP',
	'Class:IPObject/Attribute:document_list' => 'Documents',
	'Class:IPObject/Attribute:document_list+' => 'Documents liés à l\'objet IP',
));

//
// Class: lnkContactToIPObject
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkContactToIPObject' => 'Lien Contact / Objet IP',
	'Class:lnkContactToIPObject+' => '',
	'Class:lnkContactToIPObject/Attribute:ipobject_id' => 'Objet IP',
	'Class:lnkContactToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_id' => 'Contact',
	'Class:lnkContactToIPObject/Attribute:contact_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_name' => 'Nom Contact',
	'Class:lnkContactToIPObject/Attribute:contact_name+' => '',
));

//
// Class: lnkDocToIPObject
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkDocToIPObject' => 'Lien Document / Objet IP',
	'Class:lnkDocToIPObject+' => '',
	'Class:lnkDocToIPObject/Attribute:ipobject_id' => 'Objet IP',
	'Class:lnkDocToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_id' => 'Document',
	'Class:lnkDocToIPObject/Attribute:document_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_name' => 'Nom Document',
	'Class:lnkDocToIPObject/Attribute:document_name+' => '',
));

//
// Class: lnkIPObjectToTicket
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkIPObjectToTicket' => 'Lien Objet IP / Ticket',
	'Class:lnkIPObjectToTicket+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id_finalclass_recall' => 'Type d\'objet IP',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id_finalclass_recall+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id' => 'Objet IP',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_id' => 'Ticket',
	'Class:lnkIPObjectToTicket/Attribute:ticket_id+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_ref' => 'Référence',
	'Class:lnkIPObjectToTicket/Attribute:ticket_ref+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_title' => 'Titre',
	'Class:lnkIPObjectToTicket/Attribute:ticket_title+' => '',
));

//
// Class: IPBlock
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPBlock' => 'Bloc de Sous-réseaux',
	'Class:IPBlock+' => '',
	'Class:IPBlock:baseinfo' => 'Informations Générales',
	'Class:IPBlock:automation' => 'Automatisation',
	'Class:IPBlock:delegationinfo' => 'Informations de Délégation',
	'Class:IPBlock:ipinfo' => 'Informations IP',
	'Class:IPBlock:DelegatedToChild' => '<delegation_highlight>Délégué à : </delegation_highlight>%1$s',
	'Class:IPBlock:DelegatedFromParent' => '<delegation_highlight>Délégué de : </delegation_highlight>%1$s',
	'Class:IPBlock:localconfigparameters' => 'Paramètres du bloc',
	'Class:IPBlock/Attribute:name' => 'Nom',
	'Class:IPBlock/Attribute:name+' => '',
	'Class:IPBlock/Attribute:ipblocktype_id' => 'Type',
	'Class:IPBlock/Attribute:ipblocktype_id+' => 'Type du Bloc de Sous-réseaux',
	'Class:IPBlock/Attribute:ipblocktype_name' => 'Nom Type',
	'Class:IPBlock/Attribute:ipblocktype_name+' => '',
	'Class:IPBlock/Attribute:allocation_date' => 'Date d\'allocation',
	'Class:IPBlock/Attribute:allocation_date+' => 'Date à laquelle le Bloc a été alloué.',
	'Class:IPBlock/Attribute:parent_org_id' => 'Délégué de',
	'Class:IPBlock/Attribute:parent_org_id+' => 'Organisation d\'ou a été délégué le bloc de sous-réseaux',
	'Class:IPBlock/Attribute:parent_org_name' => 'Nom organisation délégante',
	'Class:IPBlock/Attribute:parent_org_name+' => 'Nom de l\'organisation ayant délégué le bloc de sous-réseaux',
	'Class:IPBlock/Attribute:occupancy' => 'Espace Utilisé',
	'Class:IPBlock/Attribute:occupancy+' => '',
	'Class:IPBlock/Attribute:children_occupancy' => 'Espace Utilisé par les enfants',
	'Class:IPBlock/Attribute:children_occupancy+' => '',
	'Class:IPBlock/Attribute:subnet_occupancy' => 'Espace Utilisé par les Sous-Réseaux',
	'Class:IPBlock/Attribute:subnet_occupancy+' => '',
	'Class:IPBlock/Attribute:location_list' => 'Lieux',
	'Class:IPBlock/Attribute:location_list+' => 'Lieux ou le bloc de Sous-réseaux s\'étend',
	'Class:IPBlock/Attribute:origin' => 'Origine',
	'Class:IPBlock/Attribute:origin+' => 'Origine du bloc: registre internet régional ou local ou une autre organisation',
	'Class:IPBlock/Attribute:origin/Value:rir' => 'RIR',
	'Class:IPBlock/Attribute:origin/Value:rir+' => 'Registre Internet Régional',
	'Class:IPBlock/Attribute:origin/Value:lir' => 'LIR',
	'Class:IPBlock/Attribute:origin/Value:lir+' => 'Registre Internet Local',
	'Class:IPBlock/Attribute:origin/Value:other' => 'Autre',
	'Class:IPBlock/Attribute:origin/Value:other+' => 'DSI...',
	'Class:IPBlock/Attribute:registrar_id' => 'Registrar',
	'Class:IPBlock/Attribute:registrar_id+' => 'Related regional or local internet registry',
	'Class:IPBlock/Attribute:registrar_name' => 'Registrar name',
	'Class:IPBlock/Attribute:registrar_name+' => '',
));

//
// Class extensions for IPBlock
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPBlock/Tab:globalparam' => 'Paramètres Globaux',
	'Class:IPBlock/Tab:childblock' => 'Blocs enfants',
	'Class:IPBlock/Tab:childblock+' => 'Blocs rattachés à ce bloc',
	'Class:IPBlock/Tab:childblock/SelectList' => 'Changer l\'affichage',
	'Class:IPBlock/Tab:childblock/SelectList0' => 'Afficher les blocs enfant seulement',
	'Class:IPBlock/Tab:childblock/SelectList1' => 'Afficher toute la hiérarchie des blocs enfant',
	'Class:IPBlock/Tab:childblock/List0' => 'Blocs enfant seulement',
	'Class:IPBlock/Tab:childblock/List1' => 'Toute la hiérarchie des blocs enfant',
	'Class:IPBlock/Tab:childblock-count' => 'Blocs enfants : %1$s',
	'Class:IPBlock/Tab:childblock-count-percent' => ' espace utilisé par les Blocs enfants.',
	'Class:IPBlock/Tab:childblock-count-percent-remain' => 'Espace utilisé par les Blocs enfants dans l\'espace restant: %1$.1f %%',
	'Class:IPBlock/Tab:subnet' => 'Sous-réseaux',
	'Class:IPBlock/Tab:subnet+' => 'Sous-réseaux rattachés à ce bloc',
	'Class:IPBlock/Tab:subnet-count' => 'Sous-réseaux: %1$s',
	'Class:IPBlock/Tab:subnet-count-percent' => ' espace utilisé par les Sous-réseaux',
	'Class:IPBlock/Tab:subnet-count-percent-remain' => 'Espace utilisé par les Sous-réseaux dans l\'espace restant: %1$.1f %%',
));

//
// Class: lnkBlockToLocation
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkIPBlockToLocation' => 'Lien Bloc de Sous-réseaux / Lieu',
	'Class:lnkIPBlockToLocation+' => '',
	'Class:lnkIPBlockToLocation/Attribute:block_id' => 'Bloc',
	'Class:lnkIPBlockToLocation/Attribute:block_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:block_name' => 'Nom Bloc',
	'Class:lnkIPBlockToLocation/Attribute:block_name+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_id' => 'Lieu',
	'Class:lnkIPBlockToLocation/Attribute:location_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_name' => 'Nom Lieu',
	'Class:lnkIPBlockToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Block
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPv4Block' => 'Bloc de Sous-réseaux IPv4',
	'Class:IPv4Block+' => '',
	'Class:IPv4Block/Attribute:parent_id' => 'Bloc parent',
	'Class:IPv4Block/Attribute:parent_id+' => '',
	'Class:IPv4Block/Attribute:parent_name' => 'Nom du bloc parent',
	'Class:IPv4Block/Attribute:parent_name+' => '',
	'Class:IPv4Block/Attribute:parent_origin' => 'Origine du bloc parent',
	'Class:IPv4Block/Attribute:parent_origin+' => '',
	'Class:IPv4Block/Attribute:firstip' => 'Première IP du Bloc',
	'Class:IPv4Block/Attribute:firstip+' => 'Première IP du Bloc de Sous-réseaux',
	'Class:IPv4Block/Attribute:lastip' => 'Dernière IP du Bloc',
	'Class:IPv4Block/Attribute:lastip+' => 'Dernière IP du Bloc de Sous-réseaux',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_min_size' => 'Taille Minimum des Blocs IPv4',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_min_size+' => '',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_cidr_aligned' => 'Alignement des Blocs IPv4 sur les blocs CIDR',
	'Class:IPv4Block/Attribute:ipconfig_ipv4_block_cidr_aligned+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_min_size' => 'Taille Minimum',
	'Class:IPv4Block/Attribute:ipv4_block_min_size+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned' => 'Aligne le bloc sur les blocs CIDR',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned+' => '',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:default' => 'Aligné avec les paramètres globaux IP',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:bca_no' => 'Forcé à Non',
	'Class:IPv4Block/Attribute:ipv4_block_cidr_aligned/Value:bca_yes' => 'Forcé à Oui',
));

//
// Class: IPSubnet
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPSubnet' => 'Sous-réseau IP',
	'Class:IPSubnet+' => '',
	'Class:IPSubnet:baseinfo' => 'Informations Générales',
	'Class:IPSubnet:ipinfo' => 'Informations IP',
	'Class:IPSubnet:automation' => 'Automatisation',
	'Class:IPSubnet:localconfigparameters' => 'Paramètres du sous-réseau',
	'Class:IPSubnet/Attribute:name' => 'Nom',
	'Class:IPSubnet/Attribute:name+' => '',
	'Class:IPSubnet/Attribute:type' => 'Type',
	'Class:IPSubnet/Attribute:type+' => '',
	'Class:IPSubnet/Attribute:allocation_date' => 'Date d\'allocation',
	'Class:IPSubnet/Attribute:allocation_date+' => 'Date à laquelle le sous-réseau a été alloué.',
	'Class:IPSubnet/Attribute:release_date' => 'Date de libération',
	'Class:IPSubnet/Attribute:release_date+' => 'Date à laquelle le sous-réseau a été libéré et n\'est plus utilisé.',
	'Class:IPSubnet/Attribute:ip_occupancy' => 'IPs enregistrées',
	'Class:IPSubnet/Attribute:ip_occupancy+' => '',
	'Class:IPSubnet/Attribute:range_occupancy' => 'Plages d\'IPs enregistrées',
	'Class:IPSubnet/Attribute:range_occupancy+' => '',
	'Class:IPSubnet/Attribute:alarm_water_mark' => 'Etat de l\'alarme de seuil',
	'Class:IPSubnet/Attribute:alarm_water_mark+' => '',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:no_alarm' => 'Aucune alarme n\'a été envoyée',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:low_sent' => 'Une alarme de Seuil Bas a été envoyée',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:high_sent' => 'Une alarme de Seuil Haut a été envoyée',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips' => 'Réserve les IPs de Sous-réseau, de passerelle et de Broadcast à la création',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips+' => '',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips/Value:reserve_no' => 'Non',
	'Class:IPSubnet/Attribute:ipconfig_reserve_subnet_ips/Value:reserve_yes' => 'Oui',
	'Class:IPSubnet/Attribute:reserve_subnet_ips' => 'Réserve les IPs de sous-réseau, de passerelle et de broadcast',
	'Class:IPSubnet/Attribute:reserve_subnet_ips+' => 'Défini la politique de réservation des IPs de Sous-réseau, de passerelle et de Broadcast',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:default' => 'Aligné avec les paramètres globaux',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:reserve_no' => 'Non',
	'Class:IPSubnet/Attribute:reserve_subnet_ips/Value:reserve_yes' => 'Oui',
	'Class:IPSubnet/Attribute:subnets_list' => 'Sous-réseaux NATés',
	'Class:IPSubnet/Attribute:subnets_list+' => 'Liste de tous les sous-réseaux NATés',
	'Class:IPSubnet/Attribute:vlans_list' => 'VLANs',
	'Class:IPSubnet/Attribute:vlans_list+' => '',
	'Class:IPSubnet/Attribute:vrfs_list' => 'VRFs',
	'Class:IPSubnet/Attribute:vrfs_list+' => '',
	'Class:IPSubnet/Attribute:location_list' => 'Lieu',
	'Class:IPSubnet/Attribute:location_list+' => 'Lieux ou le sous-réseau s\'étend',
	'Class:IPSubnet/Attribute:summary/cell0' => 'IPs enregistrées, par état',
	'Class:IPSubnet/Attribute:summary/cell0+' => 'Total: %1$s',
));

//
// Class extensions for IPSubnet
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPSubnet/Tab:globalparam' => 'Paramètres Globaux',
	'Class:IPSubnet/Tab:ipregistered' => 'IPs enregistrées',
	'Class:IPSubnet/Tab:ipregistered+' => 'IPs enregistrées dans le Sous-Réseau',
	'Class:IPSubnet/Tab:ipregistered-count' => ' - %1$s Réservées, %2$s Allouées, %3$s Libérées, %4$s Non assignées sur %5$s',
	'Class:IPSubnet/Tab:ipfree-explain' => 'Liste des %1$s premières IPs libres :',
	'Class:IPSubnet/Tab:ipfree-explainbis' => 'Liste de TOUTES les IPs libres :',
	'Class:IPSubnet/Tab:iprange' => 'Plages d\'IPs',
	'Class:IPSubnet/Tab:iprange+' => 'Plages d\'IPs appartenant à un sous-réseau',
	'Class:IPSubnet/Tab:iprange-count-percent' => ' Espace utilisé par les Plages d\'IPs',
	'Class:IPSubnet/Tab:notifications' => 'Notifications',
	'Class:IPSubnet/Tab:notifications+' => 'Notifications associées à ce sous-réseau',
	'Class:IPSubnet/Tab:requests' => 'Demandes IP',
	'Class:IPSubnet/Tab:requests+' => 'Demandes IP liés à ce sous-réseau',
	'Class:IPSubnet/Tab:changes' => 'Changements IP',
	'Class:IPSubnet/Tab:changes+' => 'Changements IP liés à ce sous-réseau',
));

//
// Class: lnkIPSubnetToIPSubnet
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkIPSubnetToIPSubnet' => 'Lien Sous-réseau / Sous réseau NATé',
	'Class:lnkIPSubnetToIPSubnet+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall' => 'Type de sous-réseau',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id' => 'Sous-réseau',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id+' => 'Sous-réseau à translater',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id' => 'Sous-réseau NATé',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id+' => 'Sous-réseau translaté',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name' => 'Nom',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name+' => 'Nom du Sous-réseau',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name' => 'Nom',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name+' => 'Nom du Sous-réseau',
));

//
// Class: lnkIPSubnetToVLAN
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkIPSubnetToVLAN' => 'Lien Sous-réseau / VLAN',
	'Class:lnkIPSubnetToVLAN+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall' => 'Type de Sous-réseau',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id' => 'Sous-réseau',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name' => 'Nom Sous-réseau',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag' => 'VLAN Tag',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag+' => '',
));

//
// Class: lnkIPSubnetToVRF
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkIPSubnetToVRF' => 'Lien Sous-réseau / VRF',
	'Class:lnkIPSubnetToVRF+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall' => 'Type de Sous-réseau',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id' => 'Sous-réseau',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name' => 'Nom Sous-réseau',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id+' => '',
));

//
// Class: lnkIPSubnetToLocation
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkIPSubnetToLocation' => 'Lien Sous-réseau / Lieu',
	'Class:lnkIPSubnetToLocation+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id' => 'Sous-réseau',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name' => 'Nom Sous-réseau',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_id' => 'Lieu',
	'Class:lnkIPSubnetToLocation/Attribute:location_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_name' => 'Nom Lieu',
	'Class:lnkIPSubnetToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Subnet
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPv4Subnet' => 'Sous-réseau IPv4',
	'Class:IPv4Subnet+' => '',
	'Class:IPv4Subnet/Attribute:block_id' => 'Bloc de Sous-réseaux',
	'Class:IPv4Subnet/Attribute:block_id+' => '',
	'Class:IPv4Subnet/Attribute:block_name' => 'Nom Bloc',
	'Class:IPv4Subnet/Attribute:block_name+' => '',
	'Class:IPv4Subnet/Attribute:ip' => 'IP de Sous-réseau',
	'Class:IPv4Subnet/Attribute:ip+' => '',
	'Class:IPv4Subnet/Attribute:mask' => 'Masque',
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
	'Class:IPv4Subnet/Attribute:gatewayip' => 'IP de la passerelle',
	'Class:IPv4Subnet/Attribute:gatewayip+' => '',
	'Class:IPv4Subnet/Attribute:broadcastip' => 'IP de broadcast',
	'Class:IPv4Subnet/Attribute:broadcastip+' => '',
	'Class:IPv4Subnet/Attribute:summary' => 'Résumé',
	'Class:IPv4Subnet/Attribute:ipconfig_ipv4_gateway_ip_format' => 'Format IP de la passerelle par défaut',
	'Class:IPv4Subnet/Attribute:ipconfig_ipv4_gateway_ip_format+' => '',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format' => 'Format IP de la passerelle',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format+' => '',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:default' => 'Aligné avec les paramètres globaux',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1' => 'Forcé à l\'IP de sous-réseau + 1',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1' => 'Forcé à l\'IP de broadcast - 1',
	'Class:IPv4Subnet/Attribute:ipv4_gateway_ip_format/Value:free_setup' => 'Force l\'allocation libre',
));

//
// Class: IPRange
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPRange' => 'Plage d\'Adresses IP',
	'Class:IPRange+' => '',
	'Class:IPRange:baseinfo' => 'Informations Générales',
	'Class:IPRange:ipinfo' => 'Informations IP',
	'Class:IPRange/Attribute:range' => 'Nom',
	'Class:IPRange/Attribute:range+' => '',
	'Class:IPRange/Attribute:usage_id' => 'Utilisation',
	'Class:IPRange/Attribute:usage_id+' => 'Utilisation faite de la Plage',
	'Class:IPRange/Attribute:usage_name' => 'Nom Utilisation',
	'Class:IPRange/Attribute:usage_name+' => '',
	'Class:IPRange/Attribute:allocation_date' => 'Date d\'allocation',
	'Class:IPRange/Attribute:allocation_date+' => 'Date à laquelle la plage a été allouée.',
	'Class:IPRange/Attribute:dhcp' => 'Plage DHCP',
	'Class:IPRange/Attribute:dhcp+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no' => 'Non',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes' => 'Oui',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes+' => '',
	'Class:IPRange/Attribute:occupancy' => 'IPs enregistrées',
	'Class:IPRange/Attribute:occupancy+' => '',
	'Class:IPRange/Attribute:functionalcis_list' => 'Serveurs DHCP',
	'Class:IPRange/Attribute:functionalcis_list+' => 'Liste de tous les serveurs DHCP en charge de cette plage',
));

//
// Class extensions for IPRange
//                                                       

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPRange/Tab:ipregistered' => 'IPs enregistrées',
	'Class:IPRange/Tab:ipregistered+' => 'IPs enregistrées dans la Plage d\'IPs',
	'Class:IPRange/Tab:ipregistered-count' => ' - %1$s Réservées, %2$s Allouées, %3$s Libérées, %4$s Non assignées sur %5$s',
	'Class:IPRange/Tab:ipfree-explain' => 'Liste des %1$s premières IPs libres :',
	'Class:IPRange/Tab:ipfree-explainbis' => 'Liste de TOUTES les IPs libres :',
	'Class:IPRange/Tab:notifications' => 'Notifications',
	'Class:IPRange/Tab:notifications+' => 'Notifications associées à cette plage d\'IPs',
));

//
// Class: lnkFunctionalCIToIPRange
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkFunctionalCIToIPRange' => 'Lien CI Fonctionnel / Plage d\'IPs',
	'Class:lnkFunctionalCIToIPRange+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id_finalclass_recall' => 'Type de plage d\'IPs',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id_finalclass_recall+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id' => 'Plage d\'IPs',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_id+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_name' => 'Nom de la plage d\'IPs',
	'Class:lnkFunctionalCIToIPRange/Attribute:iprange_name+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_id' => 'CI',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_id+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_name' => 'Nom du CI',
	'Class:lnkFunctionalCIToIPRange/Attribute:functionalci_name+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role' => 'Rôle',
	'Class:lnkFunctionalCIToIPRange/Attribute:role+' => 'Rôle du serveur vis à vis de la plage',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:single' => 'Single',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:single+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:split_scope' => 'Split scope',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:split_scope+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:primary' => 'Primaire',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:primary+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:secondary' => 'Secondaire',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:secondary+' => '',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:active' => 'Active',
	'Class:lnkFunctionalCIToIPRange/Attribute:role/Value:active+' => '',
));

//
// Class: IPv4Range
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPv4Range' => 'Plage d\'Adresses IPv4',
	'Class:IPv4Range+' => '',
	'Class:IPv4Range/Attribute:subnet_id' => 'Sous-réseau',
	'Class:IPv4Range/Attribute:subnet_id+' => 'Sous-réseau IPv4',
	'Class:IPv4Range/Attribute:subnet_ip' => 'IP du Sous-réseau',
	'Class:IPv4Range/Attribute:subnet_ip+' => '',
	'Class:IPv4Range/Attribute:firstip' => 'Première IP de la Plage',
	'Class:IPv4Range/Attribute:firstip+' => '',
	'Class:IPv4Range/Attribute:lastip' => 'Dernière IP de la plage',
	'Class:IPv4Range/Attribute:lastip+' => '',
));

//
// Class: IPAddress
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPAddress' => 'Adresse IP',
	'Class:IPAddress+' => '',
	'Class:IPAddress:baseinfo' => 'Informations Générales',
	'Class:IPAddress:dnsinfo' => 'Informations DNS',
	'Class:IPAddress:ipinfo' => 'Informations IP',
	'Class:IPAddress:localconfigparameters' => 'Paramètres de l\'IP',
	'Class:IPAddress/Attribute:short_name' => 'Nom Court',
	'Class:IPAddress/Attribute:short_name+' => 'Nom de gauche du FQDN',
	'Class:IPAddress/Attribute:domain_id' => 'Nom de Domaine',
	'Class:IPAddress/Attribute:domain_id+' => '',
	'Class:IPAddress/Attribute:domain_name' => 'Nom de Domaine',
	'Class:IPAddress/Attribute:domain_name+' => '',
	'Class:IPAddress/Attribute:fqdn' => 'FQDN',
	'Class:IPAddress/Attribute:fqdn+' => 'Fully Qualified Domain Name',
	'Class:IPAddress/Attribute:aliases' => 'Alias',
	'Class:IPAddress/Attribute:aliases+' => 'Liste des alias utilisés pour le FQDN',
	'Class:IPAddress/Attribute:usage_id' => 'Utilisation',
	'Class:IPAddress/Attribute:usage_id+' => '',
	'Class:IPAddress/Attribute:usage_name' => 'Nom Utilisation',
	'Class:IPAddress/Attribute:usage_name+' => '',
	'Class:IPAddress/Attribute:ipinterface_id' => 'Interface IP',
	'Class:IPAddress/Attribute:ipinterface_id+' => '',
	'Class:IPAddress/Attribute:ipinterface_name' => 'Nom Interface IP',
	'Class:IPAddress/Attribute:ipinterface_name+' => '',
	'Class:IPAddress/Attribute:allocation_date' => 'Date d\'allocation',
	'Class:IPAddress/Attribute:allocation_date+' => 'Date à laquelle l\'adresse a été allouée.',
	'Class:IPAddress/Attribute:release_date' => 'Date de libération',
	'Class:IPAddress/Attribute:release_date+' => 'Date à laquelle l\'adresse a été libérée et n\'est plus utilisée.',
	'Class:IPAddress/Attribute:ip_list' => 'IPs NATées',
	'Class:IPAddress/Attribute:ip_list+' => 'Liste des IPs NATées',
	'Class:IPAddress/Attribute:finalclass' => 'Classe',
	'Class:IPAddress/Attribute:finalclass+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name' => 'Autorise les noms dupliqués',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_no' => 'Non',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_yes' => 'Oui',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPAddress/Attribute:ipconfig_:ip_allow_duplicate_name/Value:ipdup_dualstack' => 'Dual stack',
	'Class:IPAddress/Attribute:ipconfig_ip_allow_duplicate_name/Value:ipdup_dualstack+' => 'Les doublons sont autorisés entre 2 uniques IPv4 et IPv6',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name' => 'Autorise les noms dupliqués',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:default' => 'Aligné avec les paramètres globaux IP',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_no' => 'Forcé à Non',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_yes' => 'Forcé à Oui',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack' => 'Dual stack',
	'Class:IPAddress/Attribute:ip_allow_duplicate_name/Value:ipdup_dualstack+' => 'Les doublons sont autorisés entre 2 uniques IPv4 et IPv6',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign' => 'Ping l\'IP avant de l\'assigner',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign+' => '',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_no' => 'Non',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_no+' => '',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_yes' => 'Oui',
	'Class:IPAddress/Attribute:ipconfig_ping_before_assign/Value:ping_yes+' => '',
	'Class:IPAddress/Attribute:ping_before_assign' => 'Ping l\'IP avant de l\'assigner',
	'Class:IPAddress/Attribute:ping_before_assign+' => '',
	'Class:IPAddress/Attribute:ping_before_assign/Value:default' => 'Aligné avec les paramètres globaux IP',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_no' => 'Forcé à Non',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_no+' => '',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_yes' => 'Forcé à Yes',
	'Class:IPAddress/Attribute:ping_before_assign/Value:ping_yes+' => '',
));

//
// Class extensions for IPAddress
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPAddress/Tab:globalparam' => 'Paramètres Globaux',
	'Class:IPAddress/Tab:parents' => 'Parents',
	'Class:IPAddress/Tab:ip_list' => 'IPs NATées',
	'Class:IPAddress/Tab:ip_list+' => 'Liste des IPs NATées',
	'Class:IPAddress/Tab:ci_list' => 'CIs',
	'Class:IPAddress/Tab:ci_list+' => 'Liste des CIs utilisant cette IP:',
	'Class:IPAddress/Tab:ci_list_class' => '%1$ss',
	'Class:IPAddress/Tab:NoCi' => 'Aucun CI',
	'Class:IPAddress/Tab:NoCi+' => 'Aucun CI utilise cette IP',
	'Class:IPAddress/Tab:requests' => 'Demandes IP',
	'Class:IPAddress/Tab:requests+' => 'Demandes IP liés à cette adresse IP',
	'Class:IPAddress/Tab:norequests' => 'Aucune demande IP',
	'Class:IPAddress/Tab:norequests+' => 'Aucune demande liée à cette adresse IP',
	'Class:IPAddress/Tab:changes' => 'Changements IP',
	'Class:IPAddress/Tab:changes+' => 'Changements IP liés à cette adresse IP',
));

//
// Class: lnkIPAdressToIPAddress
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkIPAdressToIPv4Address' => 'IP / IPs NATées',
	'Class:lnkIPAdressToIPv4Address+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall' => 'Type d\'IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall+' => '',
	'Class:lnkIPAdressToIPv4Address/Attribute:ip1_id' => 'Adresse IP',
	'Class:lnkIPAdressToIPv4Address/Attribute:ip1_id+' => 'IP externe ou source',
	'Class:lnkIPAdressToIPv4Address/Attribute:ip2_id' => 'IP NATée',
	'Class:lnkIPAdressToIPv4Address/Attribute:ip2_id+' => 'IP interne ou destination ',
	'Class:lnkIPAdressToIPv4Address/Attribute:ip1_short_name' => 'Nom court de l\'IP',
	'Class:lnkIPAdressToIPv4Address/Attribute:ip1_short_name+' => 'Nom de gauche du FQDN',
	'Class:lnkIPAdressToIPv4Address/Attribute:ip1_domain_name' => 'Nom de Domaine de l\'IP',
	'Class:lnkIPAdressToIPv4Address/Attribute:ip1_domain_name+' => 'Nom du Domaine DNS',
	'Class:lnkIPAdressToIPv4Address/Attribute:ip2_short_name' => 'Nom court de l\'IP NATée',
	'Class:lnkIPAdressToIPv4Address/Attribute:ip2_short_name+' => 'Nom de gauche du FQDN',
	'Class:lnkIPAdressToIPv4Address/Attribute:ip2_domain_name' => 'Nom de Domaine de l\'IP NATée',
	'Class:lnkIPAdressToIPv4Address/Attribute:ip2_domain_name+' => 'Nom du Domaine DNS',
	'Class:lnkIPAdressToIPAddress/Attribute:external_service_port' => 'Port de service externe',
	'Class:lnkIPAdressToIPAddress/Attribute:external_service_port+' => 'Port externe ou source à utiliser si le "port forwarding" est actif',
	'Class:lnkIPAdressToIPAddress/Attribute:map_to_port' => 'Port sur lequel le mapper',
	'Class:lnkIPAdressToIPAddress/Attribute:map_to_port+' => 'Port interne ou de destination à utiliser si le "port forwarding" est actif',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol' => 'Protocole',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol+' => 'Protocole(s) authorisé(s). Ne pas remplir si tous le sont',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:udp' => 'UDP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:tcp' => 'TCP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:both' => 'UDP / TCP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:sctp' => 'SCTP',
	'Class:lnkIPAdressToIPAddress/Attribute:protocol/Value:icmp' => 'ICMP',
));

//
// Class: lnkIPInterfaceToIPAddress
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkIPInterfaceToIPAddress' => 'Lien Interface IP / Adresse IP',
	'Class:lnkIPInterfaceToIPAddress+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall' => 'Type d\'IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id' => 'Interface IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name' => 'Nom Interface IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id' => 'Adresse IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:usage_id' => 'Utilisation de l\'adresse IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:usage_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_org_name' => 'Nom de l\'organisation de l\'adresse IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_org_name+' => '',
));

//
// Class: IPv4Address
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPv4Address' => 'Adresse IPv4',
	'Class:IPv4Address+' => '',
	'Class:IPv4Address/Attribute:subnet_id' => 'Sous-réseau',
	'Class:IPv4Address/Attribute:subnet_id+' => 'Sous-réseau IPv4',
	'Class:IPv4Address/Attribute:subnet_ip' => 'IP du Sous-réseau',
	'Class:IPv4Address/Attribute:subnet_ip+' => '',
	'Class:IPv4Address/Attribute:range_id' => 'Plage d\'Adresses',
	'Class:IPv4Address/Attribute:range_id+' => 'Plage d\'Adresses IPv4',
	'Class:IPv4Address/Attribute:ip' => 'Adresse',
	'Class:IPv4Address/Attribute:ip+' => 'Adresse IPv4',
));

//
// Class: IPRangeUsage
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPRangeUsage' => 'Types d\'utilisation d\'une plage d\'adresses IP',
	'Class:IPRangeUsage+' => 'Ce à quoi une plage d\'adresses IP est utilisée',
	'Class:IPRangeUsage/Attribute:org_id' => 'Organisation',
	'Class:IPRangeUsage/Attribute:org_id+' => '',
	'Class:IPRangeUsage/Attribute:org_name' => 'Nom Organisation',
	'Class:IPRangeUsage/Attribute:org_name+' => '',
	'Class:IPRangeUsage/Attribute:name' => 'Nom',
	'Class:IPRangeUsage/Attribute:name+' => '',
	'Class:IPRangeUsage/Attribute:description' => 'Description',
	'Class:IPRangeUsage/Attribute:description+' => '',
	'Class:IPRangeUsage/Attribute:ipranges_list' => 'Plages d\'IPs',
	'Class:IPRangeUsage/Attribute:ipranges_list+' => '',
));

//
// Class: IPBlockType
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPBlockType' => 'Type de bloc',
	'Class:IPBlockType+' => 'Type of bloc de sous-réseau',
	'Class:IPBlockType/Attribute:name' => 'Nom',
	'Class:IPBlockType/Attribute:name+' => '',
	'Class:IPBlockType/Attribute:description' => 'Description',
	'Class:IPBlockType/Attribute:description+' => '',
	'Class:IPBlockType/Attribute:blocks_list' => 'Blocs',
	'Class:IPBlockType/Attribute:blocks_list+' => 'Blocs de sous-réseau de ce type',
));

//
// Class: IPTriggerOnWaterMark
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPTriggerOnWaterMark' => 'Déclencheur lorsqu\'un seuil d\'IPs est atteint',
	'Class:IPTriggerOnWaterMark+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_id' => 'Organisation',
	'Class:IPTriggerOnWaterMark/Attribute:org_id+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_name' => 'Nom Organisation',
	'Class:IPTriggerOnWaterMark/Attribute:org_name+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:target_class' => 'Classe cible',
	'Class:IPTriggerOnWaterMark/Attribute:target_class+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event' => 'Evènement',
	'Class:IPTriggerOnWaterMark/Attribute:event+' => 'Evènement généré lorsque le déclencheur est activé',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low' => 'Le seuil bas est franchi',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high' => 'Le seuil haut est franchi',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high+' => '',
));

//
// Class: IPObjTemplate
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPObjTemplate' => 'Formulaire IP',
	'Class:IPObjTemplate+' => '',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id' => 'Elément de Service',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id+' => '',
	'Class:IPObjTemplate/Attribute:request_type' => 'Type de requète',
	'Class:IPObjTemplate/Attribute:request_type+' => '',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_create' => 'Création d\'une IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_change' => 'Mise à jour d\'une IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_delete' => 'Libération d\'une IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_create' => 'Creation d\'un Sous-réseau',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_change' => 'Mise à jour d\'un Sous-réseau',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_delete' => 'Libération d\'un Sous-réseau',
));

//
// Application Menu
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Menu:IPManagement' => 'Gestion du parc d\'IPs',
	'Menu:IPManagement+' => 'Gestion du parc d\'IPs',
	'Menu:IPManagement:Overview:Total' => 'Total: %1s',
	'Menu:IPSpace' => 'Espace IP',
	'Menu:IPSpace+' => 'Espace IP',
	'Menu:IPSpace:IPv4Objects' => 'Objets IPv4',
	'Menu:IPSpace:IPv4Objects+' => 'Objets IPv4',
	'Menu:IPSpace:Options' => 'Paramètres',
	'Menu:IPSpace:Options+' => 'Paramètres',
	'Menu:NewIPObject' => 'Nouvel objet IP',
	'Menu:NewIPObject+' => 'Création d\'un nouvel objet IP',
	'Menu:SearchIPObject' => 'Recherche d\'un objet IP',
	'Menu:SearchIPObject+' => 'Recherche d\'un objet IP',
	'Menu:IPv4ShortCut' => 'Raccourcis IPv4',
	'Menu:IPv4ShortCut+' => 'Raccourcis IPv4',
	'Menu:IPv4Block' => 'Blocs de Sous-réseaux',
	'Menu:IPv4Block+' => 'Blocs de Sous-réseaux IPv4',
	'Menu:IPv4Subnet' => 'Sous-réseaux',
	'Menu:IPv4Subnet+' => 'Sous-réseaux IPv4',
	'Menu:IPv4Subnet:Allocated' => 'Sous-réseaux alloués',
	'Menu:IPv4Subnet:Allocated+' => 'Liste des sous-réseaux IPv4 alloués',
	'Menu:IPv4Range' => 'Plages d\'Adresses IP',
	'Menu:IPv4Range+' => 'Plages d\'Adresses IPv4',
	'Menu:IPv4Address' => 'Adresses IP',
	'Menu:IPv4Address+' => 'Adresses IPv4',
	'Menu:IPTools' => 'Outils',
	'Menu:IPTools+' => 'Boîte à outils IP',
	'Menu:FindSpace' => 'Recherche d\'espace',
	'Menu:FindSpace+' => 'Outil pour rechercher et allouer de l\'espace d\'adressage IP',
	'Menu:SubnetCalculator' => 'Calculateur de Sous-réseaux',
	'Menu:SubnetCalculator+' => 'Outil pour calculer les parametres d\'un sous réseau à partir d\'une IP et d\'un masque',
	'Menu:Options' => 'Paramètres',
	'Menu:Options+' => 'Paramètres',
	'Menu:Domain' => 'Domaines',
	'Menu:Domain+' => 'Noms de Domaines',
	'Menu:IPTemplate' => 'Templates IP',
	'Menu:IPTemplate+' => '',
	'Menu:IPMgmt:Typology' => 'Configuration des typologies de l\'espace IP',
	'Menu:IPMgmt:Typology+' => '',

	'UI:IPMgmtWelcomeOverview:Title' => 'Mon tableau de bord',

	// Menu separator in Action menus
	'UI:IPManagement:Action:MenuSeparator' => '<hr class="menu-separator"/>',
	'UI:IPManagement:Action:Error::WrongActionForClass' => 'Cette action ne peut être appliquèe à cette classe d\'objet !',

//
// Management of IPBlocks
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPBlock:Reverted' => 'La première IP du Bloc est plus grande que la dernière !',
	'UI:IPManagement:Action:New:IPBlock:SmallerThanMinSize' => 'La taile d\'un Bloc ne peut être inférieure à %1$s pour l\'organisation %2$s !',
	'UI:IPManagement:Action:New:IPBlock:NotCIDRAligned' => 'Le Bloc n\'est pas aligné CIDR !',
	'UI:IPManagement:Action:New:IPBlock:NotInParent' => 'Le Bloc de Sous-réseaux n\'est pas strictement contenu dans le bloc parent sélectionné !',
	'UI:IPManagement:Action:New:IPBlock:NameExist' => 'Le nom du Bloc de Sous-réseaux existe déjà !',
	'UI:IPManagement:Action:New:IPBlock:Collision0' => 'Le Bloc de Sous-réseaux existe déjà !',
	'UI:IPManagement:Action:New:IPBlock:Collision1' => 'Collision : la première IP appartient à un bloc déjà existant !',
	'UI:IPManagement:Action:New:IPBlock:Collision2' => 'Collision : la dernière IP appartient à un bloc déjà existant !',
	'UI:IPManagement:Action:Modify:IPBlock:ParentIdNull' => 'Les Sous-réseaux du Bloc %1$s ne peuvent être attachés à un parent non existant !',

	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPBlock:Reverted' => 'La nouvelle première IP du Bloc est plus grande que la nouvelle dernière !',
	'UI:IPManagement:Action:Shrink:IPBlock:IPOutOfBlock' => 'Les nouvelles IPs ne sont pas toutes dans le Bloc !',
	'UI:IPManagement:Action:Shrink:IPBlock:NoChange' => 'Aucun changement n\'a été demandé !',
	'UI:IPManagement:Action:Shrink:IPBlock:NotCIDRAligned' => 'Le Bloc n\'est pas aligné CIDR !',
	'UI:IPManagement:Action:Shrink:IPBlock:BlockAccrossBorder' => 'Un bloc fils est à cheval sur les nouvelles limites !',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetAccrossBorder' => 'Un sous-réseau attaché au bloc est à cheval sur les nouvelles limites !',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetBecomesOrhpean' => 'Des Sous-réseaux fils n\'auront plus de parent après la réduction !',
	'UI:IPManagement:Action:Shrink:IPBlock:Done' => '%1$s %2$s a été réduit.',

	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPBlock:IPOutOfBlock' => 'L\'IP de coupure est en dehors du bloc !',
	'UI:IPManagement:Action:Split:IPBlock:SmallerThanMinSize' => 'La taille du bloc ne peut être inférieure à %1$s!',
	'UI:IPManagement:Action:Split:IPBlock:NotCIDRAligned' => 'Les blocs ne sont pas alignés sur des blocs CIDR !',
	'UI:IPManagement:Action:Split:IPBlock:BlockAccrossBorder' => 'Un bloc de sous-réseaux fils est à cheval sur la nouvelle frontière !',
	'UI:IPManagement:Action:Split:IPBlock:SubnetAccrossBorder' => 'Un sous-réseau appartenant au bloc est à cheval sur la nouvelle frontière !',
	'UI:IPManagement:Action:Split:IPBlock:EmptyNewName' => 'Le nom du nouveau Bloc de Sous-réseaux est vide !',
	'UI:IPManagement:Action:Split:IPBlock:NameExist' => 'Le nom du nouveau Bloc de Sous-réseaux existe déjà !',
	'UI:IPManagement:Action:Split:IPBlock:Done' => '%1$s: %2$s a été coupé.',

	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPBlock:Reverted' => 'La nouvelle première IP du Bloc est plus grande que la nouvelle dernière !',
	'UI:IPManagement:Action:Expand:IPBlock:IPOutOfBlock' => 'Les nouvelles IPs ne sont pas toutes en dehors du Bloc !',
	'UI:IPManagement:Action:Expand:IPBlock:NoChange' => 'Aucun changement n\'a été demandé !',
	'UI:IPManagement:Action:Expand:IPBlock:NotCIDRAligned' => 'Le Bloc n\'est pas aligné CIDR !',
	'UI:IPManagement:Action:Expand:IPBlock:BlockBiggerThanParent' => 'Le Bloc ne peut être plus grand que son parent !',
	'UI:IPManagement:Action:Expand:IPBlock:DelegatedBlockAccrossBorder' => 'le bloc ne peut englober un bloc délégué !',
	'UI:IPManagement:Action:Expand:IPBlock:BlockAccrossBorder' => 'Un bloc frère est à cheval sur les nouvelles limites !',
	'UI:IPManagement:Action:Expand:IPBlock:SubnetAccrossBorder' => 'Un sous-réseau attaché au bloc parent est à cheval les nouvelles limites !',
	'UI:IPManagement:Action:Expand:IPBlock:Done' => '%1$s %2$s a été étendu.',

	// Find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPBlock:RequestedSpaceBiggerThanBlockSize' => 'IP address to look space from belongs to subnet block %1$s and the requested space is larger than the size of that block!',
	'UI:IPManagement:Action:DoFindSpace:IPBlock:NoSpaceFound' => 'Il n\'y a pas assez d\'espace libre dans le bloc %1$s pour traiter votre demande !',
	'IPManagement:Action:DoFindSpace:IPBlock:IPToStartFrom' => 'de l\'IP %1$s',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPBlock:NoChildOrg' => 'L\'organisation à laquelle le bloc appartient n\'a pas d\'enfant !',
	'UI:IPManagement:Action:Delegate:IPBlock:NoOtherOrg' => 'Il n\'existe aucune autre organisation que celle à laquelle le bloc appartient !',
	'UI:IPManagement:Action:Delegate:IPBlock:IsDelegated' => 'Le bloc est déjà délégué !',
	'UI:IPManagement:Action:Delegate:IPBlock:WrongLevelOfOrganization' => 'Un changement de délegation doit être effectué à une organisation soeur !',
	'UI:IPManagement:Action:Delegate:IPBlock:NoChangeOfOrganization' => 'Aucun changement n\'a été demandé !',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocks' => 'Le bloc a des blocs fils !',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnets' => 'Le bloc a des subnets fils !',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithDelegatedBlockFromOtherOrg' => 'Cet espace contient déjà des blocs délégués d\'une autre oarganisation !',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfTargetOrg' => 'Le bloc est en conflict avec un bloc de l\'organisation cible !',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfParentOrg' => 'Le bloc est en conflict avec un bloc de l\'organisation parente !',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocksInParent' => 'Le bloc a des blocs fils dans l\'organisation parent !',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnetsInParent' => 'Le bloc a des subnets fils dans l\'organisation parent !',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPBlock:CannotBeUndelegated' => 'La délégation du bloc ne peut être retirée: %1$s',
	'UI:IPManagement:Action:Undelegate:IPBlock:IsNotDelegated' => 'Le block n\'est pas délégué !',
	'UI:IPManagement:Action:Undelegate:IPBlock:HasChildBlocks' => 'Le bloc a des blocs fils !',
	'UI:IPManagement:Action:Undelegate:IPBlock:HasChildSubnets' => 'Le bloc a des subnets fils !',

	// Display pointers to previous and next Blocks
	'UI:IPManagement:Action:DisplayPrevious:IPBlock' => 'Précédent',
	'UI:IPManagement:Action:DisplayNext:IPBlock' => 'Suivant',

//
// Management of IPv4Blocks
//
	// Display details of subnet blocks
	'UI:IPManagement:Action:Details:IPv4Block' => 'Détails',
	'UI:IPManagement:Action:Details:IPv4Block+' => '',

	// Display list of subnet blocks
	'UI:IPManagement:Action:DisplayList:IPv4Block' => 'Afficher la Liste',
	'UI:IPManagement:Action:DisplayList:IPv4Block+' => '',
	'UI:IPManagement:Action:DisplayList:IPv4Block:PageTitle_Class' => 'Blocs de sous-réseaux IPv4',
	'UI:IPManagement:Action:DisplayList:IPv4Block:Title_Class' => 'Blocs de sous-réseaux IPv4',

	// Display tree of subnet blocks
	'UI:IPManagement:Action:DisplayTree:IPv4Block' => 'Afficher l\'Arbre',
	'UI:IPManagement:Action:DisplayTree:IPv4Block+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:PageTitle_Class' => 'Blocs de sous-réseaux IPv4',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:Title_Class' => 'Blocs de sous-réseaux IPv4',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:OrgName' => 'Organisation %1$s',

	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPv4Block' => 'Réduire',
	'UI:IPManagement:Action:Shrink:IPv4Block+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Block:Summary' => 'Résumé',
	'UI:IPManagement:Action:Shrink:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Block:PageTitle_Object_Class' => 'Réduire %1$s - %2$s',
	'UI:IPManagement:Action:Shrink:IPv4Block:Title_Class_Object' => 'Réduire %1$s: %2$s',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewFirstIP' => 'Nouvelle première IP du Bloc :',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewLastIP' => 'Nouvelle dernière IP du Bloc :',
	'UI:IPManagement:Action:Shrink:IPv4Block:IsDelegated' => 'Ce bloc est délégué et ne peut donc être réduit !',
	'UI:IPManagement:Action:Shrink:IPv4Block:CannotBeShrunk' => 'Le bloc ne peut être réduit: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Block:SmallerThanMinSize' => 'La taille du Bloc ne peut être plus petite que %1$s !',
	'UI:IPManagement:Action:Shrink:IPv4Block:Done' => '%1$s %2$s a été réduit.',

	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv4Block' => 'Couper',
	'UI:IPManagement:Action:Split:IPv4Block+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:Summary' => 'Résumé',
	'UI:IPManagement:Action:Split:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:PageTitle_Object_Class' => 'Couper %1$s - %2$s',
	'UI:IPManagement:Action:Split:IPv4Block:Title_Class_Object' => 'Couper %1$s: %2$s',
	'UI:IPManagement:Action:Split:IPv4Block:At' => 'Première IP du nouveau Bloc de Sous-réseaux :',
	'UI:IPManagement:Action:Split:IPv4Block:NameNewBlock' => 'Nom du nouveau Bloc de Sous-réseaux :',
	'UI:IPManagement:Action:Split:IPv4Block:IsDelegated' => 'Ce bloc est délégué et ne peut donc être coupé !',
	'UI:IPManagement:Action:Split:IPv4Block:CannotBeSplit' => 'Le Bloc ne peut être coupé: %1$s',
	'UI:IPManagement:Action:Split:IPv4Block:SmallerThanMinSize' => 'La taille du bloc ne peut être inférieure à %1$s !',
	'UI:IPManagement:Action:Split:IPv4Block:Done' => '%1$s: %2$s a été coupé.',

	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv4Block' => 'Etendre',
	'UI:IPManagement:Action:Expand:IPv4Block+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary' => 'Résumé',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:PageTitle_Object_Class' => 'Etendre %1$s - %2$s',
	'UI:IPManagement:Action:Expand:IPv4Block:Title_Class_Object' => 'Etendre %1$s: %2$s',
	'UI:IPManagement:Action:Expand:IPv4Block:NewFirstIP' => 'Nouvelle première IP du Bloc :',
	'UI:IPManagement:Action:Expand:IPv4Block:NewLastIP' => 'Nouvelle dernière IP du Bloc :',
	'UI:IPManagement:Action:Expand:IPv4Block:IsDelegated' => 'Ce bloc est délégué et ne peut donc être étendu !',
	'UI:IPManagement:Action:Expand:IPv4Block:CannotBeExpanded' => 'Le bloc ne peut être étendu: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Block:SmallerThanMinSize' => 'La taille du Bloc ne peut être plus petite que %1$s !',
	'UI:IPManagement:Action:Expand:IPv4Block:Done' => '%1$s %2$s a été étendu.',

	// List space action on subnet blocks 
	'UI:IPManagement:Action:ListSpace:IPv4Block' => 'Lister l\'espace',
	'UI:IPManagement:Action:ListSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Espace',
	'UI:IPManagement:Action:ListSpace:IPv4Block:Title_Class_Object' => 'Espace dans %1$s: %2$s',
	'UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpace' => 'Libre [%1$s - %2$s] - %3$s IPs - %4$.2f %%',
	'UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpaceNoPercent' => 'Libre [%1$s - %2$s] - %3$s IPs',

	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv4Block' => 'Rechercher de l\'espace',
	'UI:IPManagement:Action:FindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Recherche d\'espace',
	'UI:IPManagement:Action:FindSpace:IPv4Block:Title_Class_Object' => 'Recherche d\'espace IP dans %1$s : %2$s',
	'UI:IPManagement:Action:FindSpace:IPv4Block:SizeOfSpace' => 'Taille de l\'espace à rechercher :',
	'UI:IPManagement:Action:FindSpace:IPv4Block:MaxNumberOfOffers' => 'Nombre maximum d\'offres :',

	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv4Block' => 'Espace trouvé',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Rechercher de l\'espace',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Title_Class_Object' => 'Espace dans %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Summary' => '%1$s premiers /%2$s dans le bloc',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsBlock' => 'Créer en tant que bloc fils',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsSubnet' => 'Créer en tant que sous-réseau',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv4Block' => 'Déléguer',
	'UI:IPManagement:Action:Delegate:IPv4Block:PageTitle_Object_Class' => '%1$s - Déléguer',
	'UI:IPManagement:Action:Delegate:IPv4Block:Title_Class_Object' => 'Délègue %1$s %2$s à une organisation',
	'UI:IPManagement:Action:Delegate:IPv4Block:ChildBlock' => 'Organisation à qui déléguer le bloc :',
	'UI:IPManagement:Action:Delegate:IPv4Block:NoChildOrg' => 'L\'organization dont dépend le bloc n\'a pas de fille. Le bloc ne peut donc être délégué !',
	'UI:IPManagement:Action:Delegate:IPv4Block:NoOtherOrg' => 'Il n\'existe aucune autre organisation que celle à laquelle le bloc appartient !',
	'UI:IPManagement:Action:Delegate:IPv4Block:IsDelegated' => 'Le bloc est déjà délégué !',
	'UI:IPManagement:Action:Delegate:IPv4Block:CannotBeDelegated' => 'Le bloc ne peut être délégué : %1$s',
	'UI:IPManagement:Action:Delegate:IPv4Block:Done' => '%1$s %2$s a été délégué.',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPv4Block:CannotBeUndelegated' => 'La délégation ne peut pas être retirée : %1$s',
	'UI:IPManagement:Action:Undelegate:IPv4Block' => 'Retirer la délégation',
	'UI:IPManagement:Action:Undelegate:IPv4Block:PageTitle_Object_Class' => '%1$s - Retirer',
	'UI:IPManagement:Action:Undelegate:IPv4Block:Done' => '%1$s %2$s a eu sa délégation retirée.',

//
// Management of Subnets
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPSubnet:IpCannotChange' => 'L\'IP du Sous-réseau ne peut être modifiée !',
	'UI:IPManagement:Action:New:IPSubnet:MaskCannotChange' => 'Le masque de Sous-réseau ne peut être modifié !',
	'UI:IPManagement:Action:New:IPSubnet:IpIncorrect' => 'L\'IP du Sous-réseau n\'est pas cohérente avec le masque !',
	'UI:IPManagement:Action:New:IPSubnet:NotInBlock' => 'Le Sous-réseau n\'est pas contenu dans le Bloc de Sous-réseaux !',
	'UI:IPManagement:Action:New:IPSubnet:Collision0' => 'Le Sous-réseau existe déjà !',
	'UI:IPManagement:Action:New:IPSubnet:Collision1' => 'Collision : l\'IP du Sous-réseau appartient à un Sous-réseau existant !',
	'UI:IPManagement:Action:New:IPSubnet:Collision2' => 'Collision : l\'IP de Broadcast appartient à un Sous-réseau existant !',
	'UI:IPManagement:Action:New:IPSubnet:Collision3' => 'Collision : le nouveau Sous-réseau contient un Sous-réseau existant !!',
	'UI:IPManagement:Action:New:IPSubnet:GatewayOutOfSubnet' => 'L\'IP de la passerelle n\'est pas dans les limites du Sous-réseau !',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPSubnet' => 'Calculateur de Sous-réseaux',
	'UI:IPManagement:Action:Calculator:IPSubnet:SelectSubnetType' => 'Sélectionnez le type de Sous-réseaux',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:SelectCreation' => 'Vous pouvez enregistrer ces espaces en tant que blocs de sous-réseaux ou sous-réseaux :',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CreateSubnet' => 'Créer le sous-réseau',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateSubnet:MaskIsToSmall' => 'Le masque est trop petit: le sous-réseau ne peut être créé !',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CreateBlock' => 'Créer le bloc de sous-réseaux',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateBlock:MaskIsToBig' => 'Le masque est trop grand: le bloc de sous-réseaux ne peut être créé !',

	// Display pointers to previous and next Subnets
	'UI:IPManagement:Action:DisplayPrevious:IPSubnet' => 'Précédent',
	'UI:IPManagement:Action:DisplayNext:IPSubnet' => 'Suivant',

//
// Management of IPv4 Subnets
//
	// Display details of subnet
	'UI:IPManagement:Action:Details:IPv4Subnet' => 'Détails',
	'UI:IPManagement:Action:Details:IPv4Subnet+' => '',

	// Display list of subnets
	'UI:IPManagement:Action:DisplayList:IPv4Subnet' => 'Afficher la Liste',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet+' => '',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet:PageTitle_Class' => 'Sous-Réseaux IPv4',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet:Title_Class' => 'Sous-Réseaux IPv4',

	// Display tree of subnets
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet' => 'Afficher l\'Arbre',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:PageTitle_Class' => 'Sous-Réseaux IPv4',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:Title_Class' => 'Sous-Réseaux IPv4',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:OrgName' => 'Organisation %1$s',

	// Find space action on subnets 
	'UI:IPManagement:Action:FindSpace:IPv4Subnet' => 'Recherche d\'Espace',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - Recherche d\'espace',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:Title_Class_Object' => 'Recherche d\'espace IP dans %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeTooSmall' => 'Le Sous-Réseau est trop petit pour y rechercher un espace !',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeOfRange' => 'Taille de l\'espace à rechercher :',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:MaxNumberOfOffers' => 'Nombre maximum d\'offres :',

	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet' => 'Espace trouvé',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - Recherche d\'espace',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Title_Class_Object' => 'Espace dans %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Summary' => '%1$s premières %2$s Plages d\'IPs libres dans le sous-réseau',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeEmpty' => 'L\'espace demandé est vide ! Veuillez spécifier une taille plus grande.',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeTooBig' => 'L\'espace demandé ne tient pas dans le sous-réseau. Veuillez choisir une taille plus petite.',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:CreateAsRange' => 'Créer en tant que Plage d\'IPs',

	// List IPs action on subnets 
	'UI:IPManagement:Action:ListIps:IPv4Subnet' => 'Lister et allouer IPs',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Title_Class_Object' => 'IPs contenues dans le %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Subtitle_ListRange' => 'Le Sous-réseau est trop grand pour lister toutes les IPs en une seule page. Merci de sélectionner une plage à afficher:',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:FirstIP' => 'Première IP de la plage',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:LastIP' => 'Dernière IP de la plage',

	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv4Subnet' => 'Lister et allouer IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:Title_Class_Object' => 'Liste partielle des IPs contenues dans le %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:CannotBeListed' => 'Les IPs ne peuvent être listées: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIPOutOfSubnet' => 'La première IP est hors du sous-réseau !',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:LastIPOutOfSubnet' => 'La dernière IP est hors du sous-réseau !',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'La première IP de la plage est plus grande que la dernière !',

	// Shrink action on subnets
	'UI:IPManagement:Action:Shrink:IPv4Subnet' => 'Réduire',
	'UI:IPManagement:Action:Shrink:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary' => 'Résumé',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:PageTitle_Object_Class' => 'Réduire %1$s - %2$s',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Title_Class_Object' => 'Réduire %1$s: %2$s',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:CannotBeShrunk' => 'Le Sous-réseau ne peut pas être réduit: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmall' => 'Le Sous-réseau est trop petit pour être réduit !',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy' => 'Le Sous-réseau est trop petit pour être réduit par %1$s !',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeInTheMiddle' => 'La Plage d\'Ips : <b>%1$s [%2$s - %3$s]</b> est à cheval sur la frontière du nouveau Sous-réseau. La réduction ne peut avoir lieu !',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeDropped' => 'Erreur: la Plage d\'Ips: <b>%1$s [%2$s - %3$s]</b> sort du Sous-réseau. La réduction ne peut avoir lieu !',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Done' => '%1$s: %2$s a été réduit par %3$s.',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:By' => 'Réduire par :',

	// Split action on subnets
	'UI:IPManagement:Action:Split:IPv4Subnet' => 'Couper',
	'UI:IPManagement:Action:Split:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary' => 'Résumé',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:PageTitle_Object_Class' => 'Couper %1$s - %2$s',
	'UI:IPManagement:Action:Split:IPv4Subnet:Title_Class_Object' => 'Couper %1$s: %2$s',
	'UI:IPManagement:Action:Split:IPv4Subnet:CannotBeSplit' => 'Le Sous-réseau ne peut pas être coupé: %1$s',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmall' => 'Le Sous-réseau est trop petit pour être coupé !',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy' => 'Le Sous-réseau est trop petit pour être coupé en %1$s !',
	'UI:IPManagement:Action:Split:IPv4Subnet:IPRangeInTheMiddle' => 'La Plage d\'Ips : <b>%1$s [%2$s - %3$s]</b> est à cheval sur la frontière des nouveaux Sous-réseaux. La coupure ne peut avoir lieu !',
	'UI:IPManagement:Action:Split:IPv4Subnet:Done' => '%1$s: %2$s a été coupé en %3$s.',
	'UI:IPManagement:Action:Split:IPv4Subnet:In' => 'Couper en :',

	// Expand action on subnets
	'UI:IPManagement:Action:Expand:IPv4Subnet' => 'Etendre',
	'UI:IPManagement:Action:Expand:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary' => 'Résumé',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:PageTitle_Object_Class' => 'Etendre %1$s - %2$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Title_Class_Object' => 'Etendre %1$s: %2$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:CannotBeExpanded' => 'Le Sous-réseau ne peut pas être étendu: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBig' => 'Le Sous-réseau est trop grand pour être étendu !',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy' => 'Le Sous-réseau est trop grand pour être étendu par %1$s !',
	'UI:IPManagement:Action:Expand:IPv4Subnet:NotInIPBlock' => 'Le bloc contenant le sous-réseau est trop petit pour contenir le nouveau sous-réseau étendu !',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Done' => '%1$s: %2$s a été étendu par %3$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:By' => 'Etendre par :',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet' => 'Export CSV des IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s Export CSV des IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Title_Class_Object' => 'Export CSV des IPs pour %1$s: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Subtitle_ListRange' => 'Le Sous-réseau est trop grand pour exporter toutes les IPs en une seule page. Merci de sélectionner une plage à exporter:',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:FirstIP' => 'Première IP de la plage',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:LastIP' => 'Dernière IP de la plage',

	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet' => 'Export CSV des IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s Export CSV des IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:Title_Class_Object' => 'Export CSV partiel des IPs pour %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:CannotBeListed' => 'Les IPs ne peuvent être listées: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIPOutOfSubnet' => 'La première IP est hors du sous-réseau !',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:LastIPOutOfSubnet' => 'La dernière IP est hors du sous-réseau !',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'La première IP de la plage est plus grande que la dernière !',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv4Subnet' => 'Calculateur de Sous-réseaux',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:PageTitle_Object_Class' => '%2$s Calculateur',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Title_Class_Object' => 'Calculateur pour %1$s',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:IP' => 'Adresse IP',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Mask' => 'Masque',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:CIDR' => 'CIDR',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet' => 'Calculateur de Sous-réseaux',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PageTitle_Object_Class' => '%2$s Calculateur',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Title_Class_Object' => '%1$s - Résultat du calculateur',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IP' => 'Adresse IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Mask' => 'Masque',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CIDR' => 'CIDR',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:SubnetIP' => 'IP du Sous-réseau',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Wildcard' => 'Masque Wildcard',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:BroadcastIP' => 'IP de Broadcast',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IPNumber' => 'Nombre d\'IPs',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:UsableHosts' => 'Nombre de Hosts utilisables',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet' => 'IP du Sous-réseau précédent',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet:NA' => 'Non Applicable',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet' => 'IP du Sous-réseau suivant',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet:NA' => 'Non Applicable',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CannotRun' => 'Le calculateur de Sous-réseau ne peut tourner: %1$s',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:EnterMaskOrCIDR' => 'Entrer un masque ou un CIDR!',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongMask' => 'Le masque est invalide !',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongCIDR' => 'Le CIDR est invalide !',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:CannotBeExploded' => 'Le FQDN ne peut être converti en un nom court et un nom de domaine',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:PageTitle_Object_Class' => 'Converti le FQDN',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Subnet:Done' => 'Le FQDN a été converti en %1$s %2$s',

//
// Management of IP ranges
//
	// Creation and Update Management
	'UI:IPManagement:Action:New:IPRange:NameExist' => 'Le nom de la Plage existe déjà dans le Sous-réseau !',
	'UI:IPManagement:Action:New:IPRange:Reverted' => 'La première IP de la Plage est plus grande que la dernière !',
	'UI:IPManagement:Action:New:IPRange:NotInSubnet' => 'La Plage d\'IPs n\'est pas contenue dans le Sous-réseau sélectionné !',
	'UI:IPManagement:Action:New:IPRange:Collision0' => 'La Plage d\'IPs existe déjà !',
	'UI:IPManagement:Action:New:IPRange:Collision1' => 'Collision : la première IP appartient à une plage existante !',
	'UI:IPManagement:Action:New:IPRange:Collision2' => 'Collision : la dernière IP appartient à une plage existante !',
	'UI:IPManagement:Action:New:IPRange:Collision3' => 'Collision : la nouvelle plage inclut une plage existante !',
	'UI:IPManagement:Action:Update:IPRange:NonDHCPRangeWithServers' => 'Seules les plages DHCP pevent être liées à des serveurs DHCP !',
	'UI:IPManagement:Action:New:lnkFunctionalCIToIPRange:WrongCIClass' => 'Un serveur DHCP ne peut être que de classe Serveur ou Machine Virtuelle !',

	// Display pointers to previous and next Ranges
	'UI:IPManagement:Action:DisplayPrevious:IPRange' => 'Précédent',
	'UI:IPManagement:Action:DisplayNext:IPRange' => 'Suivant',

//
// Management of IPv4 ranges
//
	// Display details of IP Range
	'UI:IPManagement:Action:Details:IPv4Range' => 'Détails',
	'UI:IPManagement:Action:Details:IPv4Range+' => '',

	// List IPs action on IP Ranges 
	'UI:IPManagement:Action:ListIps:IPv4Range' => 'Lister et allouer IPs',
	'UI:IPManagement:Action:ListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv4Range:Title_Class_Object' => 'IPs contenues dans %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv4Range:Subtitle_ListRange' => 'La plage d\'IPs est trop grande pour lister toutes les IPs en une seule page. Merci de sélectionner une sous plage à afficher:',
	'UI:IPManagement:Action:ListIps:IPv4Range:FirstIP' => 'Première IP de la plage',
	'UI:IPManagement:Action:ListIps:IPv4Range:LastIP' => 'Dernière IP de la plage',

	// Do list IPs action on IP Ranges 
	'UI:IPManagement:Action:DoListIps:IPv4Range' => 'Lister et allouer IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Range:Title_Class_Object' => 'Liste partielle des IPs contenues dans la %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv4Range:CannotBeListed' => 'La plage d\'IPs ne peut être listée: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIPOutOfRange' => 'La première IP est hors de la plage !',
	'UI:IPManagement:Action:DoListIps:IPv4Range:LastIPOutOfRange' => 'La dernière IP est hors de la plage !',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIpBiggerThanLastIp' => 'La première IP de la plage est plus grande que la dernière !',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv4Range' => 'Export CSV des IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s export CSV des IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Title_Class_Object' => 'Export CSV des IPs pour %1$s: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Subtitle_ListRange' => 'La plage d\'IPs est trop grande pour exporter toutes les IPs en une seule fois. Merci de sélectionner une sous plage à exporter:',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:FirstIP' => 'Première IP de la plage',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:LastIP' => 'Dernière IP de la plage',

	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range' => 'Export CSV des IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s export CSV des IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:Title_Class_Object' => 'Export CSV partiel des IPs pour %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:CannotBeListed' => 'La plage ne peut être exportée: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIPOutOfRange' => 'La première IP est hors de la plage !',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:LastIPOutOfRange' => 'La dernière IP est hors de la plage !',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIpBiggerThanLastIp' => 'La première IP de la plage est plus grande que la dernière !',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:CannotBeExploded' => 'Le FQDN ne peut être converti en un nom court et un nom de domaine',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:PageTitle_Object_Class' => 'Converti FQDN',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Range:Done' => 'Le FQDN a été converti en %1$s %2$s',

//
// Management of IP Addresses
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPAddress:IPNameCollision' => 'le nom court existe déjà dans le domaine !',

	'UI:IPManagement:Action:New:IPAddress:IPCollision' => 'L\'adresse IP existe déjà !',
	'UI:IPManagement:Action:New:IPAddress:NotInRange' => 'L\'adresse IP n\'appartient pas à la plage d\'IPs !',
	'UI:IPManagement:Action:New:IPAddress:NotInSubnet' => 'L\'adresse IP n\'appartient pas au sous-réseau !',
	'UI:IPManagement:Action:New:IPAddress:IPPings' => 'L\'IP répond au ping !',
	'UI:IPManagement:Action:New:IPAddress:NatIPsAretheSame' => 'L\'IP ne peut être NATée avec elle même !',

	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:AllocateIP:IPAddress' => 'Alloue l\'adresse à un CI',
	'UI:IPManagement:Action:UnAllocateIP:IPAddress' => 'Désalloue l\'adresse de tous les CIs',
	'UI:IPManagement:Action:Allocate:IPAddress:Class' => 'Classe cible',
	'UI:IPManagement:Action:Allocate:IPAddress:CI' => 'CI Fonctionnel',
	'UI:IPManagement:Action:Allocate:IPAddress:IPAttribute' => 'Attribut IP',
	'UI:IPManagement:Action:Allocate:IPAddress:NoCI' => 'Il n\'y a pas de CI instancié qui porte des attributs de type Adresse IP dans cette organisation !',
	'UI:IPManagement:Action:Allocate:IPAddress:CannotAllocateCI' => 'L\'adresse ne peut pas être allouée au CI: %1$s',
	'UI:IPManagement:Action:Allocate:IPAddress:CIDoesNotExist' => 'Le CI fonctionnel n\'existe pas !',
	'UI:IPManagement:Action:Allocate:IPAddress:AttributeIsReadOnly' => 'L\'attribut est en lecture seule !',
	'UI:IPManagement:Action:Allocate:IPAddress:AttributeIsSynchronized' => 'L\'attribut est synchronisé depuis une source externe !',
	'UI:IPManagement:Action:Allocate:IPAddress:FQDNIsConflicting' => 'Le nouveau FQDN sera en conflit avec la régle de duplication définie dans la configuration',
	'UI:IPManagement:Action:Allocate:IPAddress:IPAlreadyAllocated' => 'L\'address est déjà allouée !',
	'UI:IPManagement:Action:Unallocate:IPAddress:CannotBeUnallocated' => 'L\'adresse ne peut pas être désallouée: %1$s',
	'UI:IPManagement:Action:UnAllocate:IPAddress:IPNotAllocated' => 'L\'adresse n\'est pas allouée !',
	'UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsReadOnly' => 'L\'adresse est attachée à l\'attribut d\'un CI qui est en lecture seule !',
	'UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsSynchronized' => 'L\'adresse est attachée à l\'attribut d\'un CI qui est esclave d\'une synchronisation !',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPAddress:FQDNAttributeDoesNotExist' => 'L\'attribut %1$s n\'est pas celui d\'une adresse IP !',

	// Display pointers to previous and next IPs
	'UI:IPManagement:Action:DisplayPrevious:IPAddress' => 'Précédente',
	'UI:IPManagement:Action:DisplayNext:IPAddress' => 'Suivante',

//
// Management of IPv4 Addresses
//
	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:Allocate:IPv4Address' => 'Allocate address to CI',
	'UI:IPManagement:Action:Allocate:IPv4Address:PageTitle_Object_Class' => 'Alloue l\'IP',
	'UI:IPManagement:Action:Allocate:IPv4Address:Title_Class_Object' => 'Alloue %1$s %2$s au CI',
	'UI:IPManagement:Action:Allocate:IPv4Address:Done' => '%1$s %2$s a été allouée.',
	'UI:IPManagement:Action:Allocate:IPv4Address:IPAlreadyAllocated' => 'L\'adresse est déjà allouée !',
	'UI:IPManagement:Action:UnAllocate:IPv4Address' => 'Désalloue l\'adresse de tous les CIs',
	'UI:IPManagement:Action:Unallocate:IPv4Address:PageTitle_Object_Class' => 'Désalloue l\'IP',
	'UI:IPManagement:Action:Unallocate:IPv4Address:Done' => '%1$s %2$s a été désallouée.',
	'UI:IPManagement:Action:UnAllocate:IPv4Address:IPNotAllocated' => 'L\'adresse n\'est pas allouée !',

	// Explode FQDN to fill shortname and domain_id attributes
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:CannotBeExploded' => 'Le FQDN ne peut être converti en un nom court et un nom de domaine',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:PageTitle_Object_Class' => 'Converti FQDN',
	'UI:IPManagement:Action:ExplodeFQDN:IPv4Address:Done' => 'Le FQDN a été converti en %1$s %2$s',

//
// Management of Domains
//
	// Creation Management	
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'Le nom de domain existe déjà !',

	// Display list of domains
	'UI:IPManagement:Action:DisplayList:Domain' => 'Afficher la Liste',
	'UI:IPManagement:Action:DisplayList:Domain+' => '',
	'UI:IPManagement:Action:DisplayList:Domain:PageTitle_Class' => 'Domaines DNS',
	'UI:IPManagement:Action:DisplayList:Domain:Title_Class' => 'Domaines DNS',

	// Display tree of domains
	'UI:IPManagement:Action:DisplayTree:Domain' => 'Afficher l\'Arbre',
	'UI:IPManagement:Action:DisplayTree:Domain+' => '',
	'UI:IPManagement:Action:DisplayTree:Domain:PageTitle_Class' => 'Domaines DNS',
	'UI:IPManagement:Action:DisplayTree:Domain:Title_Class' => 'Domaines DNS',
	'UI:IPManagement:Action:DisplayTree:Domain:OrgName' => 'Organisation %1$s',

//
// Generic actions
//
	// Find space action on subnets
	'UI:IPManagement:Action:FindSpace' => 'Rechercher et allouer de l\'espace IP',
	'UI:IPManagement:Action:FindSpace:Organization' => 'Organisation',
	'UI:IPManagement:Action:FindSpace:SpaceType' => 'Type d\'espace',
	'UI:IPManagement:Action:FindSpace:IPv4Space' => 'Espace IPv4',
	'UI:IPManagement:Action:FindSpace:IPv6Space' => 'Espace IPv6',
	'UI:IPManagement:Action:FindIPv4Space' => 'Rechercher et allouer de l\'espace IPv4',
	'UI:IPManagement:Action:FindIPv6Space' => 'Rechercher et allouer de l\'espace IPv6',
	'UI:IPManagement:Action:FindSpace:FirstIP' => 'A partir de l\'adresse IP :',
	'UI:IPManagement:Action:FindSpace:SpaceSize' => 'Taille de l\'espace à rechercher: ',
	'UI:IPManagement:Action:FindSpace:MaxNumberOfOffers' => 'Mombre maximum d\'offres :',

));
