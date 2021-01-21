<?php
// Copyright (C) 2020 TeemIp
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
 * @copyright   Copyright (C) 2020 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'Teemip-ip-Mgmt Module'
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
// Class: IPObject
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPObject' => 'Oggetto IP',
	'Class:IPObject+' => '',
	'Class:IPObject/Attribute:org_id' => 'Organizzazione',
	'Class:IPObject/Attribute:org_id+' => '',
	'Class:IPObject/Attribute:org_name' => 'Nome dell\'Organizzazione',
	'Class:IPObject/Attribute:org_name+' => '',
	'Class:IPObject/Attribute:status' => 'Stato',
	'Class:IPObject/Attribute:status+' => '',
	'Class:IPObject/Attribute:status/Value:reserved' => 'Riservato',
	'Class:IPObject/Attribute:status/Value:reserved+' => '',
	'Class:IPObject/Attribute:status/Value:allocated' => 'Allocato',
	'Class:IPObject/Attribute:status/Value:allocated+' => '',
	'Class:IPObject/Attribute:status/Value:released' => 'Rilasciato',
	'Class:IPObject/Attribute:status/Value:released+' => '',
	'Class:IPObject/Attribute:status/Value:unassigned' => 'Non assegnato',
	'Class:IPObject/Attribute:status/Value:unassigned+' => '',
	'Class:IPObject/Attribute:comment' => 'Note',
	'Class:IPObject/Attribute:comment+' => '',
	'Class:IPObject/Attribute:requestor_id' => 'Richiedente',
	'Class:IPObject/Attribute:requestor_id+' => '',
	'Class:IPObject/Attribute:requestor_name' => 'Nome del richiedente',
	'Class:IPObject/Attribute:requestor_name+' => '',
	'Class:IPObject/Attribute:allocation_date' => 'Data di Allocazione',
	'Class:IPObject/Attribute:allocation_date+' => 'Data di quanto lindirizzo IP è stato allocato',
	'Class:IPObject/Attribute:release_date' => 'Data di Rilascio',
	'Class:IPObject/Attribute:release_date+' => 'Data di quando l\'indirizzo IP è stato rilasciato e non è piu usato.',
	'Class:IPObject/Attribute:contact_list' => 'Contatti',
	'Class:IPObject/Attribute:contact_list+' => 'Contatti collegati all\'oggetto IP',
	'Class:IPObject/Attribute:document_list' => 'Documenti',
	'Class:IPObject/Attribute:document_list+' => 'Documenti collegati all\'oggetto IP',
));

//
// Class: lnkContactToIPObject
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkContactToIPObject' => 'Link Contatti / Oggetto IP',
	'Class:lnkContactToIPObject+' => '',
	'Class:lnkContactToIPObject/Attribute:ipobject_id' => 'Oggetto IP',
	'Class:lnkContactToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_id' => 'Contatto',
	'Class:lnkContactToIPObject/Attribute:contact_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_name' => 'Nome del Contatto',
	'Class:lnkContactToIPObject/Attribute:contact_name+' => '',
));

//
// Class: lnkDocToIPObject
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkDocToIPObject' => 'Link Documento / Oggetto IP',
	'Class:lnkDocToIPObject+' => '',
	'Class:lnkDocToIPObject/Attribute:ipobject_id' => 'IP Oggetto',
	'Class:lnkDocToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_id' => 'Documento',
	'Class:lnkDocToIPObject/Attribute:document_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_name' => 'Nome Documento',
	'Class:lnkDocToIPObject/Attribute:document_name+' => '',
));

//
// Class: lnkIPObjectToTicket
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkIPObjectToTicket' => 'Link Oggetto IP / Ticket',
	'Class:lnkIPObjectToTicket+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id_finalclass_recall' => 'Tipo Oggetto IP',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id_finalclass_recall+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id' => 'Oggetto IP',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_id' => 'Ticket',
	'Class:lnkIPObjectToTicket/Attribute:ticket_id+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_ref' => 'Ref',
	'Class:lnkIPObjectToTicket/Attribute:ticket_ref+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ticket_title' => 'Title',
	'Class:lnkIPObjectToTicket/Attribute:ticket_title+' => '',
));

//
// Class: IPBlock
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPBlock' => 'Blocco Sottorete',
	'Class:IPBlock+' => '',
	'Class:IPBlock:baseinfo' => 'Informazioni Generali',
	'Class:IPBlock:ipinfo' => 'Informazioni IP',
	'Class:IPBlock:DelegatedToChild' => '<font color=#ff0000>Delegato all\'organizzazione: </font>%1$s',
	'Class:IPBlock:DelegatedFromParent' => '<font color=#ff0000>Delegato dell\'organizzazione: </font>%1$s',
	'Class:IPBlock/Attribute:name' => 'Nome',
	'Class:IPBlock/Attribute:name+' => '',
	'Class:IPBlock/Attribute:type' => 'Tipo',
	'Class:IPBlock/Attribute:type+' => 'Tipo di Blocco Sunbet',
	'Class:IPBlock/Attribute:allocation_date' => 'Data di allocazione',
	'Class:IPBlock/Attribute:allocation_date+' => 'Data dell\'allocazione del Blocco Sottorete',
	'Class:IPBlock/Attribute:parent_org_id' => 'Delegato da',
	'Class:IPBlock/Attribute:parent_org_id+' => 'organizzazione da cui il Blocco Sunbet è stato delegato',
	'Class:IPBlock/Attribute:parent_org_name' => 'Nome dell\'Organizzazione delegante',
	'Class:IPBlock/Attribute:parent_org_name+' => 'Nome dell\'organizzazione da cio il Blocco Sottorete è stato delegato',
	'Class:IPBlock/Attribute:occupancy' => 'Spazio usato',
	'Class:IPBlock/Attribute:occupancy+' => '',
	'Class:IPBlock/Attribute:children_occupancy' => 'Spazio usato dai figli',
	'Class:IPBlock/Attribute:children_occupancy+' => '',
	'Class:IPBlock/Attribute:subnet_occupancy' => 'Spazio usato delle Sottorete',
	'Class:IPBlock/Attribute:subnet_occupancy+' => '',
	'Class:IPBlock/Attribute:location_list' => 'Località',
	'Class:IPBlock/Attribute:location_list+' => 'Località in cui il Blocco Sottorete si espande ',
));

//
// Class extensions for IPBlock
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPBlock/Tab:globalparam' => 'Settaggi Globali',
	'Class:IPBlock/Tab:childblock' => 'Blocchi Figlio',
	'Class:IPBlock/Tab:childblock+' => 'Blocchi collegati a questo blocco',
	'Class:IPBlock/Tab:childblock-count' => 'Blocchi Figli: %1$s',
	'Class:IPBlock/Tab:childblock-count-percent' => ' Spazio usato dai Blocchi figli.',
	'Class:IPBlock/Tab:childblock-count-percent-remain' => 'Spazio usato dai Blocchi figli dello spazio rimamente: %1$.1f %%',
	'Class:IPBlock/Tab:subnet' => 'Sottorete',
	'Class:IPBlock/Tab:subnet+' => 'Sottorete collegate a questo blocco',
	'Class:IPBlock/Tab:subnet-count' => 'Sottorete : %1$s',
	'Class:IPBlock/Tab:subnet-count-percent' => ' Spazio usato dalle Sottorete',
	'Class:IPBlock/Tab:subnet-count-percent-remain' => 'Spazio usato dalle Sottorete nello spazio rimanente : %1$.1f %%',
));

//
// Class: lnkBlockToLocation
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkIPBlockToLocation' => 'Link Blocco / Località',
	'Class:lnkIPBlockToLocation+' => '',
	'Class:lnkIPBlockToLocation/Attribute:block_id' => 'Blocco',
	'Class:lnkIPBlockToLocation/Attribute:block_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:block_name' => 'Nome del Blocco',
	'Class:lnkIPBlockToLocation/Attribute:block_name+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_id' => 'Località',
	'Class:lnkIPBlockToLocation/Attribute:location_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_name' => 'Nome della Località',
	'Class:lnkIPBlockToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Block
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPv4Block' => 'Blocco Sunbet IPv4',
	'Class:IPv4Block+' => '',
	'Class:IPv4Block/Attribute:parent_id' => 'Genitore',
	'Class:IPv4Block/Attribute:parent_id+' => '',
	'Class:IPv4Block/Attribute:parent_name' => 'Nome del genitore',
	'Class:IPv4Block/Attribute:parent_name+' => '',
	'Class:IPv4Block/Attribute:firstip' => 'Primo IP',
	'Class:IPv4Block/Attribute:firstip+' => 'Primo Indirizzo IP del Blocco Sunbet',
	'Class:IPv4Block/Attribute:lastip' => 'Ultimo IP',
	'Class:IPv4Block/Attribute:lastip+' => 'Ultimo Indirizzo IP del Blocco Sottorete',
));

//
// Class: IPSubnet
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPSubnet' => 'Sottorete',
	'Class:IPSubnet+' => '',
	'Class:IPSubnet:baseinfo' => 'Informazioni Generali',
	'Class:IPSubnet:ipinfo' => 'Informazioni IP',
	'Class:IPSubnet:automation' => 'Automazione',
	'Class:IPSubnet/Attribute:name' => 'Nome',
	'Class:IPSubnet/Attribute:name+' => '',
	'Class:IPSubnet/Attribute:type' => 'Tipo',
	'Class:IPSubnet/Attribute:type+' => '',
	'Class:IPSubnet/Attribute:allocation_date' => 'Data di allocazione',
	'Class:IPSubnet/Attribute:allocation_date+' => 'Data di quando la Sottorete è stata allocata',
	'Class:IPSubnet/Attribute:release_date' => 'Data di Rilascio',
	'Class:IPSubnet/Attribute:release_date+' => 'Data di quando la Sottorete è stata rilasciata e non è più e.',
	'Class:IPSubnet/Attribute:ip_occupancy' => 'IP Registrati',
	'Class:IPSubnet/Attribute:ip_occupancy+' => '',
	'Class:IPSubnet/Attribute:range_occupancy' => 'Intervallo registrato',
	'Class:IPSubnet/Attribute:range_occupancy+' => '',                         
	'Class:IPSubnet/Attribute:alarm_water_mark' => 'Stato dell\'allarme di livello',
	'Class:IPSubnet/Attribute:alarm_water_mark+' => '',                              
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:no_alarm' => 'Nessun allerme è stato ancora inviato',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:low_sent' => 'Allarme sul livello basso è stato inviato',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:high_sent' => 'Allarme sul livello alto è stato inviato',
	'Class:IPSubnet/Attribute:subnets_list' => 'NAT Sottorete',
	'Class:IPSubnet/Attribute:subnets_list+' => 'Lista degli Sottorete di NAT',
	'Class:IPSubnet/Attribute:vlans_list' => 'VLANs',
	'Class:IPSubnet/Attribute:vlans_list+' => '',
	'Class:IPSubnet/Attribute:vrfs_list' => 'VRFs',
	'Class:IPSubnet/Attribute:vrfs_list+' => '',
	'Class:IPSubnet/Attribute:location_list' => 'Località',
	'Class:IPSubnet/Attribute:location_list+' => 'Località in cui le Sottorete si espandono',
	'Class:IPSubnet/Attribute:summary/cell0' => 'IP registrati per stato',
	'Class:IPSubnet/Attribute:summary/cell0+' => 'Total: %1$s',
));

//
// Class extensions for IPSubnet
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPSubnet/Tab:globalparam' => 'Settaggi Globali',
	'Class:IPSubnet/Tab:ipregistered' => 'IP Registrati',
	'Class:IPSubnet/Tab:ipregistered+' => 'IP registrati nella Sottorete',
	'Class:IPSubnet/Tab:ipregistered-count' => ' - %1$s Riservato, %2$s Allocato, %3$s Rilasciato, %4$s Non assegnato fuori di %5$s',
	'Class:IPSubnet/Tab:ipfree-explain' => 'Lista dei primi %1$s indirizzi IP liberi:',
	'Class:IPSubnet/Tab:ipfree-explainbis' => 'Lista di tutti gli indirizzi IP liberi:',
	'Class:IPSubnet/Tab:iprange' => 'Intervallo IP',
	'Class:IPSubnet/Tab:iprange+' => 'Intervallo IP parte della sunbet',
	'Class:IPSubnet/Tab:iprange-count-percent' => ' spazio usato dall\'intervallo IP.',
	'Class:IPSubnet/Tab:notifications' => 'Notifiche',
	'Class:IPSubnet/Tab:notifications+' => 'Notifiche relative a questa Sottorete',
	'Class:IPSubnet/Tab:requests' => 'IP Richiesti',
	'Class:IPSubnet/Tab:requests+' => 'IP Richiesti relativi a questa Sottorete',
	'Class:IPSubnet/Tab:changes' => 'Cambi IP',
	'Class:IPSubnet/Tab:changes+' => 'Cambi IP retivi a questa Sottorete',
));

//
// Class: lnkIPSubnetToIPSubnet
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkIPSubnetToIPSubnet' => 'Link Sottorete / NAT Sottorete',
	'Class:lnkIPSubnetToIPSubnet+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall' => 'Tipo Sottorete',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id' => 'Sottorete',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id' => 'NAT Sottorete',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name' => 'Nome',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name+' => 'Sottorete nome',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name' => 'Nome',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name+' => 'Sottorete nome',
));

//
// Class: lnkIPSubnetToVLAN
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkIPSubnetToVLAN' => 'Link Sottorete / VLAN',
	'Class:lnkIPSubnetToVLAN+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall' => 'Tipo Sottorete',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id' => 'Sottorete',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name' => 'Sottorete nome',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag' => 'VLAN Tag',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag+' => '',
));

//
// Class: lnkIPSubnetToVRF
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkIPSubnetToVRF' => 'Link Sottorete / VRF',
	'Class:lnkIPSubnetToVRF+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall' => 'Tipo Sottorete',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id' => 'Sottorete',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name' => 'Nome della Sottorete',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id+' => '',
));

//
// Class: lnkIPSubnetToLocation
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkIPSubnetToLocation' => 'Link Sottorete / Località',
	'Class:lnkIPSubnetToLocation+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id' => 'Sottorete',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name' => 'Nome della Sottorete',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_id' => 'Località',
	'Class:lnkIPSubnetToLocation/Attribute:location_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_name' => 'Nome della Località',
	'Class:lnkIPSubnetToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Subnet
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPv4Subnet' => 'IPv4 Sottorete',
	'Class:IPv4Subnet+' => '',
	'Class:IPv4Subnet/Attribute:block_id' => 'Blocco Sottorete',
	'Class:IPv4Subnet/Attribute:block_id+' => '',
	'Class:IPv4Subnet/Attribute:block_name' => 'Nome del Block',
	'Class:IPv4Subnet/Attribute:block_name+' => '',
	'Class:IPv4Subnet/Attribute:ip' => 'Sottorete IP',
	'Class:IPv4Subnet/Attribute:ip+' => '',
	'Class:IPv4Subnet/Attribute:mask' => 'Mask',
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
	'Class:IPv4Subnet/Attribute:summary' => 'Sommario',
));

//
// Class: IPRange
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPRange' => 'IP Range',
	'Class:IPRange+' => '',
	'Class:IPRange:baseinfo' => 'Informazioni Generali',
	'Class:IPRange:ipinfo' => 'Informazioni sull\'IP',
	'Class:IPRange/Attribute:range' => 'Nome',
	'Class:IPRange/Attribute:range+' => '',
	'Class:IPRange/Attribute:usage_id' => 'Uso',
	'Class:IPRange/Attribute:usage_id+' => 'Uso fatto dell\'intervallo',
	'Class:IPRange/Attribute:usage_name' => 'Nome dell\'Uso',
	'Class:IPRange/Attribute:usage_name+' => '',
	'Class:IPRange/Attribute:allocation_date' => 'Data di Allocazione',
	'Class:IPRange/Attribute:allocation_date+' => 'Data di quando l\'indirizzo IP è stato allocato',
	'Class:IPRange/Attribute:dhcp' => 'Intervallo DHCP',
	'Class:IPRange/Attribute:dhcp+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no' => 'No',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes' => 'Si',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes+' => '',
	'Class:IPRange/Attribute:occupancy' => 'IP Registrati',
	'Class:IPRange/Attribute:occupancy+' => '',
));

//
// Class extensions for IPRange
//                                                       

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPRange/Tab:ipregistered' => 'IP registrati',
	'Class:IPRange/Tab:ipregistered+' => 'IP registrati all\'interno dell\'intervallo',
	'Class:IPRange/Tab:ipregistered-count' => ' - %1$s Riservato, %2$s Allocato, %3$s Rilasciato, %4$s Non assegnato fuori di %5$s',
	'Class:IPRange/Tab:ipfree-explain' => 'Lista dei primi %1$s indirizzi IP liberi:',
	'Class:IPRange/Tab:ipfree-explainbis' => 'Lista di tutti %1$s indirizzi IP:',
	'Class:IPRange/Tab:notifications' => 'Notifiche',
	'Class:IPRange/Tab:notifications+' => 'Notifiche relative all\'intervallo di indirizzi IP',
));

//
// Class: lnkIPRangeToServer
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkIPRangeToServer' => 'Link IP Range / Server',
	'Class:lnkIPRangeToServer+' => '',
	'Class:lnkIPRangeToServer/Attribute:iprange_id_finalclass_recall' => 'Tipo di IP range',
	'Class:lnkIPRangeToServer/Attribute:iprange_id_finalclass_recall+' => '',
	'Class:lnkIPRangeToServer/Attribute:iprange_id' => 'IP Range',
	'Class:lnkIPRangeToServer/Attribute:iprange_id+' => '',
	'Class:lnkIPRangeToServer/Attribute:iprange_name' => 'Nome IP Range',
	'Class:lnkIPRangeToServer/Attribute:iprange_name+' => '',
	'Class:lnkIPRangeToServer/Attribute:server_id' => 'Server',
	'Class:lnkIPRangeToServer/Attribute:server_id+' => '',
	'Class:lnkIPRangeToServer/Attribute:server_name' => 'Nome Server',
	'Class:lnkIPRangeToServer/Attribute:server_name+' => '',
	'Class:lnkIPRangeToServer/Attribute:role' => 'Ruolo',
	'Class:lnkIPRangeToServer/Attribute:role+' => 'Ruolo del server per l\'IP range',
	'Class:lnkIPRangeToServer/Attribute:role/Value:single' => 'Single',
	'Class:lnkIPRangeToServer/Attribute:role/Value:single+' => '',
	'Class:lnkIPRangeToServer/Attribute:role/Value:split_scope' => 'Split scope',
	'Class:lnkIPRangeToServer/Attribute:role/Value:split_scope+' => '',
	'Class:lnkIPRangeToServer/Attribute:role/Value:primary' => 'Primary',
	'Class:lnkIPRangeToServer/Attribute:role/Value:primary+' => '',
	'Class:lnkIPRangeToServer/Attribute:role/Value:secondary' => 'Secundary',
	'Class:lnkIPRangeToServer/Attribute:role/Value:secondary+' => '',
	'Class:lnkIPRangeToServer/Attribute:role/Value:active' => 'Active',
	'Class:lnkIPRangeToServer/Attribute:role/Value:active+' => '',
));

//
// Class: IPv4Range
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPv4Range' => 'IPv4 Range',
	'Class:IPv4Range+' => '',
	'Class:IPv4Range/Attribute:subnet_id' => 'Sottorete',
	'Class:IPv4Range/Attribute:subnet_id+' => '',
	'Class:IPv4Range/Attribute:subnet_ip' => 'Sottorete IP',
	'Class:IPv4Range/Attribute:subnet_ip+' => '',
	'Class:IPv4Range/Attribute:firstip' => 'Primo IP dell\'intervallo',
	'Class:IPv4Range/Attribute:firstip+' => '',
	'Class:IPv4Range/Attribute:lastip' => 'Ultimo IP dell\'intervallo',
	'Class:IPv4Range/Attribute:lastip+' => '',
));

//
// Class: IPAddress
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPAddress' => 'Indirzzo IP',
	'Class:IPAddress+' => '',
	'Class:IPAddress:baseinfo' => 'Informazioni Generali',
	'Class:IPAddress:dnsinfo' => 'Informazioni sul DNS',
	'Class:IPAddress:ipinfo' => 'Informazioni sull\'IP',
	'Class:IPAddress/Attribute:short_name' => 'Nome Breve',
	'Class:IPAddress/Attribute:short_name+' => 'Etichetta di sinistra di FQDN',
	'Class:IPAddress/Attribute:domain_id' => 'Dominio DNS',
	'Class:IPAddress/Attribute:domain_id+' => '',
	'Class:IPAddress/Attribute:domain_name' => 'Nome del Dominio',
	'Class:IPAddress/Attribute:domain_name+' => 'Nome del dominio del DNS',
	'Class:IPAddress/Attribute:fqdn' => 'FQDN',
	'Class:IPAddress/Attribute:fqdn+' => 'Fully Qualified Domain Name',
	'Class:IPAddress/Attribute:aliases' => 'Aliases',
	'Class:IPAddress/Attribute:aliases+' => 'Lista delle aliases usati per FQDN',
	'Class:IPAddress/Attribute:usage_id' => 'Uso',
	'Class:IPAddress/Attribute:usage_id+' => '',
	'Class:IPAddress/Attribute:usage_name' => 'Nome dell\'Uso',
	'Class:IPAddress/Attribute:usage_name+' => '',
	'Class:IPAddress/Attribute:ipinterface_id' => 'Interfaccia IP',
	'Class:IPAddress/Attribute:ipinterface_id+' => '',
	'Class:IPAddress/Attribute:ipinterface_name' => 'Nome dell\'interfaccia IP',
	'Class:IPAddress/Attribute:ipinterface_name+' => '',
	'Class:IPAddress/Attribute:allocation_date' => 'Data di Allocazione',
	'Class:IPAddress/Attribute:allocation_date+' => 'Data di quando l\'indirizzo IP è stato allocato',
	'Class:IPAddress/Attribute:release_date' => 'Data di rilascio',
	'Class:IPAddress/Attribute:release_date+' => 'Data di quando l\'indirizzo IP è stato rilasciato e non è più usato.',
	'Class:IPAddress/Attribute:ip_list' => 'NAT IPs',
	'Class:IPAddress/Attribute:ip_list+' => 'Lista degli IP di NAT',
	'Class:IPAddress/Attribute:finalclass' => 'Classe',
	'Class:IPAddress/Attribute:finalclass+' => '',
));

//
// Class extensions for IPAddress
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPAddress/Tab:globalparam' => 'Settaggi Globali',
	'Class:IPAddress/Tab:parents' => 'Genitori',
	'Class:IPAddress/Tab:ip_list' => 'IP del NAT',
	'Class:IPAddress/Tab:ip_list+' => 'Lista degli IP del NAT',
	'Class:IPAddress/Tab:ci_list' => 'CI',
	'Class:IPAddress/Tab:ci_list+' => 'Lista dei CI che punta a questo IP:',
	'Class:IPAddress/Tab:ci_list_class' => '%1$ss',
	'Class:IPAddress/Tab:NoCi' => 'No CI',
	'Class:IPAddress/Tab:NoCi+' => 'Nessun Configuration Item sta usando questo IP',
	'Class:IPAddress/Tab:requests' => 'IP Richiesti',
	'Class:IPAddress/Tab:requests+' => 'IP richiesti relativo a questo IP',
	'Class:IPAddress/Tab:norequests' => 'No IP richiesti',
	'Class:IPAddress/Tab:norequests+' => 'No IP richiesti relativo a questo IP',
	'Class:IPAddress/Tab:changes' => 'Cambi IP',
	'Class:IPAddress/Tab:changes+' => 'Cambi IP realtivo a questo IP',
));

//
// Class: lnkIPAdressToIPAddress
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkIPAdressToIPAddress' => 'Link IP / NAT IPs',
	'Class:lnkIPAdressToIPAddress+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall' => 'IP Type',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id' => 'Indirizzo IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id' => 'NAT IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name' => 'Nome Breve',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name+' => 'Etichetta sinistra di FQDN',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name' => 'Nome del dominio',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name+' => 'Nome del dominio DNS',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name' => 'Nome Breve',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name+' => 'Etichetta sinistra di FQDN',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name' => 'Nome del dominio',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name+' => 'Nome del dominio DNS',
));

//
// Class: lnkIPInterfaceToIPAddress
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:lnkIPInterfaceToIPAddress' => 'Link Intraccia IP/ Indirizzo IP',
	'Class:lnkIPInterfaceToIPAddress+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall' => 'Tipo IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id' => 'Interfaccia IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name' => 'Nome dell\'Interfaccia IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id' => 'Indirizzo IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id+' => '',
));

//
// Class: IPv4Address
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPv4Address' => 'Indirizzo IPv4',
	'Class:IPv4Address+' => '',
	'Class:IPv4Address/Attribute:subnet_id' => 'Sottorete',
	'Class:IPv4Address/Attribute:subnet_id+' => 'Sunet IPv4',
	'Class:IPv4Address/Attribute:range_id' => 'Intervallo',
	'Class:IPv4Address/Attribute:range_id+' => 'Intervallo IPv4',
	'Class:IPv4Address/Attribute:ip' => 'Indirizzo',
	'Class:IPv4Address/Attribute:ip+' => 'Indirizzo IPv4',
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
	'Class:IPConfig:otherinfo' => 'Altre Informationi',
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
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned' => 'Allineamento Blocco Sottorete IPv4 al CIDR',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes' => 'Si',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes+' => '',
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
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format' => 'IPv4 Gateway IP',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1' => 'Sottorete IP + 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1' => 'Broadcast IP - 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup' => 'Allocazione Libera',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup+' => '',
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
));

//
// Class: IPRangeUsage
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPRangeUsage' => 'Uso Intervallo IP',
	'Class:IPRangeUsage+' => 'Quale intervallo IP è usato per',
	'Class:IPRangeUsage/Attribute:org_id' => 'Organizzazione',
	'Class:IPRangeUsage/Attribute:org_id+' => '',
	'Class:IPRangeUsage/Attribute:org_name' => 'Nome dell\'Organizzazione',
	'Class:IPRangeUsage/Attribute:org_name+' => '',
	'Class:IPRangeUsage/Attribute:name' => 'Nome',
	'Class:IPRangeUsage/Attribute:name+' => '',
	'Class:IPRangeUsage/Attribute:description' => 'Descrizione',
	'Class:IPRangeUsage/Attribute:description+' => '',
	'Class:IPRangeUsage/Attribute:ipranges_list' => 'Intervallo IP',
	'Class:IPRangeUsage/Attribute:ipranges_list+' => '',
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
// Class: IPTriggerOnWaterMark
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPTriggerOnWaterMark' => 'Trigger (quando raggiungi un determinato livello per gli IP )',
	'Class:IPTriggerOnWaterMark+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_id' => 'Organizzazione',
	'Class:IPTriggerOnWaterMark/Attribute:org_id+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_name' => 'Nome dell\'Organizzazione',
	'Class:IPTriggerOnWaterMark/Attribute:org_name+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:target_class' => 'Classe Bersaglio',
	'Class:IPTriggerOnWaterMark/Attribute:target_class+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event' => 'Evento',
	'Class:IPTriggerOnWaterMark/Attribute:event+' => 'Evento generato quando il trigger è attivato',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low' => 'Livello basso attraversato',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high' => 'Livello alto attraversato',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high+' => '',
));

//
// Class: IPObjTemplate
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPObjTemplate' => 'IP Modello',
	'Class:IPObjTemplate+' => '',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id' => 'Sottocategoria di Servizio',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id+' => '',
	'Class:IPObjTemplate/Attribute:request_type' => 'Tipo Richiesto',
	'Class:IPObjTemplate/Attribute:request_type+' => '',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_create' => 'Creazione IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_change' => 'Cambio IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_delete' => 'Cancellazione IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_create' => 'Creazione Sottorete',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_change' => 'Cambio Sottorete',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_delete' => 'Cancellazione Sottorete',
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
// Application Menu
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Menu:IPManagement' => 'IP Management',
	'Menu:IPManagement+' => 'IP Management',
	'Menu:IPManagement:Overview:Total' => 'Totale: %1s',
	'Menu:IPSpace' => 'Spazio IP',
	'Menu:IPSpace+' => 'Spazio IP',
	'Menu:IPSpace:IPv4Objects' => 'Oggetti IPv4',
	'Menu:IPSpace:IPv4Objects+' => 'Oggetti IPv4',
	'Menu:IPSpace:Options' => 'Parametri',
	'Menu:IPSpace:Options+' => 'Parametri',  
	'Menu:NewIPObject' => 'Nuovo Oggetto IP',
	'Menu:NewIPObject+' => 'Creazione di un nuovo oggetto IP',
	'Menu:SearchIPObject' => 'Ricerca di un oggetto IP',
	'Menu:SearchIPObject+' => 'Ricerca di un oggetto IP',
	'Menu:IPv4ShortCut' => 'Scorciatoia IPv4',
	'Menu:IPv4ShortCut+' => 'Scorciatoia IPv4',
	'Menu:IPv4Block' => 'Blocco Sottorete',
	'Menu:IPv4Block+' => 'Blocco Sottorete IPv4',
	'Menu:IPv4Subnet' => 'Sottorete',
	'Menu:IPv4Subnet+' => 'Sottorete IPv4',
	'Menu:IPv4Subnet:Allocated' => 'Sottorete Allocate',
	'Menu:IPv4Subnet:Allocated+' => 'Lista delle Sottorete IPv4 allocate',
	'Menu:IPv4Range' => 'Intervalli IP',
	'Menu:IPv4Range+' => 'Intervalli IPv4',
	'Menu:IPv4Address' => 'Indirizzi IP',
	'Menu:IPv4Address+' => 'Indirizzi IPv4',
	'Menu:IPTools' => 'Utensili',
	'Menu:IPTools+' => '',
	'Menu:SubnetCalculator' => 'Calcolatrice Sottorete',
	'Menu:SubnetCalculator+' => '',
	'Menu:Options' => 'Parametri',
	'Menu:Options+' => 'Parametri',  
	'Menu:IPConfig' => 'Settaggi GLobali IP',
	'Menu:IPConfig+' => 'Parametri globali per gli oggetti relativi all\'IP',
	'Menu:IPRangeUsage' => 'Tipo di intervalli IP',
	'Menu:IPRangeUsage+' => 'Tipo di uso di Intervallo IP',
	'Menu:IPUsage' => 'Tipi IP',
	'Menu:IPUsage+' => 'Uso di Tipi di IP',
	'Menu:Domain' => 'Dominio',
	'Menu:Domain+' => 'Nome Dominio',
	'Menu:IPTemplate' => 'IP Modello',
	'Menu:IPTemplate+' => 'IP Modello',
	
	'UI:IPMgmtWelcomeOverview:Title' => 'Il Mio Cruscotto',
	
	// Menu separator in Action menus
	'UI:IPManagement:Action:MenuSeparator' => '<hr class="menu-separator"/>',	
	'UI:IPManagement:Action:Error::WrongActionForClass' => 'Questa azione non può essere applicata su questa classe di oggetti!',
//
// Management of IP global settings
//
	'UI:IPManagement:Action:New:IPConfig:AlreadyExists' => 'Solo un settaggio globale può esistere all\'interno di una organizzazione.',
	'UI:IPManagement:Action:Modify:IPConfig:IPv4BlockMinSizeTooSmall' => 'dimensione minima di un blocco sottorete IPv4, non può essere piu piccoli di %1$s!',
	'UI:IPManagement:Action:Modify:IPConfig:IPv6BlockMinSizeTooSmall' => 'dimensione minima di un blocco Sottorete IPv6 , non può essere piu piccoli di  %1$s!',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksPercent' => 'I livelli sono percentuali,per favore, usa numeri tra 0 e 100!',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksOrder' => 'Il livello basso deve essere più piccolo del livello alto!',	
	'UI:IPManagement:Action:Modify:GlobalConfig' => 'Qusti settaggi globali dei IP possono essere sovrascritti per questa azione.',	

//
// Management of IPBlocks
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPBlock:Reverted' => 'Il primo IP del blocco Sottorete è pù alto dell\'ultimo IP!',
	'UI:IPManagement:Action:New:IPBlock:SmallerThanMinSize' => 'La dimensione del blocco non può essere più piccola di%1$s per l\'organizzazione %2$s !',
	'UI:IPManagement:Action:New:IPBlock:NotCIDRAligned' => 'Il Blocco non è allineato CIDR!',	
	'UI:IPManagement:Action:New:IPBlock:NotInParent' => 'Il Blocco Sottorete non è strattamente contenuto all\'itnerno del genitore selezionato!',
	'UI:IPManagement:Action:New:IPBlock:NameExist' => 'Il nome del blocco Sottorete esiste già!',	
	'UI:IPManagement:Action:New:IPBlock:Collision0' => 'Il blocco Sottorete esiste già!',	
	'UI:IPManagement:Action:New:IPBlock:Collision1' => 'Collisione Blocco Sottorete: il primo IP appartine ad un blocco esistente!',	
	'UI:IPManagement:Action:New:IPBlock:Collision2' => 'Collisione Blocco Sottorete: l\'ultimo IP appartiene ad un blocco esistente!',
	'UI:IPManagement:Action:Modify:IPBlock:ParentIdNull' => 'Blocco Sottorete figlio %1$s non può essere attaccato a un blocco genitore non esistente.',	
	
	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPBlock:Reverted' =>  'Nuovo Primo IP del Blocco Sottorete è più alto dell\'ultimo nuovo IP!',
	'UI:IPManagement:Action:Shrink:IPBlock:IPOutOfBlock' => 'I nuovi IP non sono all\'interno del Blocco!',
	'UI:IPManagement:Action:Shrink:IPBlock:NoChange' => 'Nessun cambio è stato richiesto.',
	'UI:IPManagement:Action:Shrink:IPBlock:NotCIDRAligned' => 'Il Blocco non è allineato al CIDR!',
	'UI:IPManagement:Action:Shrink:IPBlock:BlockAccrossBorder' => 'Un blocco di sottorete figlio si trova tra i nuovi bordi!',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetAccrossBorder' => 'Una sottorete collegata al blocco si trova tra i nuovi bordi!',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetBecomesOrhpean' => 'Una sottorete figlio non avrà un genitore dopo il restringimento!',	
	'UI:IPManagement:Action:Shrink:IPBlock:Done' => '%1$s <span class="hilite">%2$s</span> è stato ridotto.',
	
	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPBlock:IPOutOfBlock' => 'Split IP è fuori blocco!',
	'UI:IPManagement:Action:Split:IPBlock:SmallerThanMinSize' => 'La dimensione del blocco non può essere oiù piccola di %1$s!',
	'UI:IPManagement:Action:Split:IPBlock:NotCIDRAligned' => 'Il Blocco non è allineato al CIDR!',	
	'UI:IPManagement:Action:Split:IPBlock:BlockAccrossBorder' => 'Un blocco di sottorete figlio si trova tra i nuovi bordi!',
	'UI:IPManagement:Action:Split:IPBlock:SubnetAccrossBorder' => 'Una sottorete collegata al blocco si trova accros nuovi bordi!',
	'UI:IPManagement:Action:Split:IPBlock:EmptyNewName' => 'Il nome del nuovo blocco di sottorete è vuoto!',
	'UI:IPManagement:Action:Split:IPBlock:NameExist' => 'Il nome del nuovo blocco di sottorete esiste già!',
	'UI:IPManagement:Action:Split:IPBlock:Done' => '%1$s <span class="hilite">%2$s</span> è stato diviso.',
	
	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPBlock:Reverted' =>  'Il nuovo primo IP del blocco della sottorete è superiore al nuovo ultimo IP!',
	'UI:IPManagement:Action:Expand:IPBlock:IPOutOfBlock' => 'I nuovi IP non sono tutti fuori dal blocco!',
	'UI:IPManagement:Action:Expand:IPBlock:NoChange' => 'Nessun cambio è stato richiesto.',
	'UI:IPManagement:Action:Expand:IPBlock:NotCIDRAligned' => 'Il Blocco non è allineato al CIDR!',
	'UI:IPManagement:Action:Expand:IPBlock:BlockBiggerThanParent' => 'Il blocco non può essere più grande del suo genitore!',
	'UI:IPManagement:Action:Expand:IPBlock:DelegatedBlockAccrossBorder' => 'Il blocco non può sostituire un blocco delegato!',
	'UI:IPManagement:Action:Expand:IPBlock:BlockAccrossBorder' => 'Un blocco di sottorete fratello si trova oltre i nuovi bordi!',
	'UI:IPManagement:Action:Expand:IPBlock:SubnetAccrossBorder' => 'Una Sottorete collegata al blocco genitore si trova tra i nuovi bordi',
	'UI:IPManagement:Action:Expand:IPBlock:Done' => '%1$s <span class="hilite">%2$s</span> è stato espanso.',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPBlock:NoChildOrg' => 'Il Blocco dell\'organizzazione non ha figli!',
	'UI:IPManagement:Action:Delegate:IPBlock:NoOtherOrg' => 'Non c\'è altra organizzazione oltre all\'organizzazione del blocco!',
	'UI:IPManagement:Action:Delegate:IPBlock:IsDelegated' => 'Il blocco è già delegato!',
	'UI:IPManagement:Action:Delegate:IPBlock:WrongLevelOfOrganization' => 'Il cambio della delegazione deve essere fatto a un\'organizzazione sorella!',
	'UI:IPManagement:Action:Delegate:IPBlock:NoChangeOfOrganization' => 'Nessun cambio è stato richiesto!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocks' => 'Il blocco ha blocchi figli!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnets' => 'Block has children subnets!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfTargetOrg' => 'Il blocco è in conflitto con un blocco dell\'organizzazione di destinazione!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfParentOrg' => 'Il blocco è in conflitto con un blocco dell\'organizzazione genitore!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocksInParent' => 'Il Blocco ha blocchi figli nell\'organizzazione genitore!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnetsInParent' => 'Il blocco ha sottoreti figli nell\'organizzazione genitore!',
	
	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPBlock:CannotBeUndelegated' => 'Il blocco non può essere annullato: %1$s',
	'UI:IPManagement:Action:Undelegate:IPBlock:IsNotDelegated' => 'Il blocco non è delegato!',
	'UI:IPManagement:Action:Undelegate:IPBlock:HasChildBlocks' => 'Il block ha blocchi figli!',
	'UI:IPManagement:Action:Undelegate:IPBlock:HasChildSubnets' => 'Il blocco ha sottoreti di bambini!',
	
//
// Management of IPv4Blocks
//
	// Display details of subnet blocks
	'UI:IPManagement:Action:Details:IPv4Block' => 'Dettagli',
	'UI:IPManagement:Action:Details:IPv4Block+' => '',
	
	// Display list of subnet blocks
	'UI:IPManagement:Action:DisplayList:IPv4Block' => 'Mostra Lista',
	'UI:IPManagement:Action:DisplayList:IPv4Block+' => '',
	'UI:IPManagement:Action:DisplayList:IPv4Block:PageTitle_Class' => 'Blocchi di sottorete IPv4',
	'UI:IPManagement:Action:DisplayList:IPv4Block:Title_Class' => 'Blocchi di sottorete IPv4',
	
	// Display tree of subnet blocks
	'UI:IPManagement:Action:DisplayTree:IPv4Block' => 'Mostra Alberto',
	'UI:IPManagement:Action:DisplayTree:IPv4Block+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:PageTitle_Class' => 'Blocchi di sottorete IPv4',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:Title_Class' => 'Blocchi di sottorete IPv4',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:OrgName' => 'Organizzazione %1$s',
	
	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPv4Block' => 'Riduzione',
	'UI:IPManagement:Action:Shrink:IPv4Block+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Block:Summary' => 'Sommario',
	'UI:IPManagement:Action:Shrink:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s Riduzione',
	'UI:IPManagement:Action:Shrink:IPv4Block:Title_Class_Object' => 'Riduzione %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewFirstIP' => 'Nuovo Primo IP del Blocco :',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewLastIP' => 'Nuovo Ultimo IP del Blocco :',            
	'UI:IPManagement:Action:Shrink:IPv4Block:IsDelegated' => 'Questo blocco è delegato e quindi non può essere ridotto!',
	'UI:IPManagement:Action:Shrink:IPv4Block:CannotBeShrunk' => 'Il blocco non può essere ridotto: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Block:SmallerThanMinSize' => 'La dimensione del blocco non può essere piu piccola di %1$s!',
	'UI:IPManagement:Action:Shrink:IPv4Block:Fatto' => '%1$s <span class="hilite">%2$s</span> è stato ridotto.',
	
	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv4Block' => 'Diviso',
	'UI:IPManagement:Action:Split:IPv4Block+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:Summary' => 'Somamrio',
	'UI:IPManagement:Action:Split:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s diviso',
	'UI:IPManagement:Action:Split:IPv4Block:Title_Class_Object' => 'Split %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Split:IPv4Block:At' => 'Primo Ip del nuovo blocco della sottorete :',
	'UI:IPManagement:Action:Split:IPv4Block:NameNewBlock' => 'Nome del nuovo blocco sottorete:',
	'UI:IPManagement:Action:Split:IPv4Block:IsDelegated' => 'Questo blocco è delegatopertanto non può essere diviso!',
	'UI:IPManagement:Action:Split:IPv4Block:CannotBeSplit' => 'Il blocco non può essere diviso: %1$s',
	'UI:IPManagement:Action:Split:IPv4Block:SmallerThanMinSize' => 'La dimensione del blocco non puo essere più piccola di%1$s!',
	'UI:IPManagement:Action:Split:IPv4Block:Done' => '%1$s <span class="hilite">%2$s</span> è stato diviso.',
	
	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv4Block' => 'Espanso',
	'UI:IPManagement:Action:Expand:IPv4Block+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary' => 'Sommario',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s espanso',
	'UI:IPManagement:Action:Expand:IPv4Block:Title_Class_Object' => 'Expand %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Expand:IPv4Block:NewFirstIP' => 'Nuovo Primo IP del blocco :',
	'UI:IPManagement:Action:Expand:IPv4Block:NewLastIP' => 'Nuovo ultimp IP del blocco :',
	'UI:IPManagement:Action:Expand:IPv4Block:IsDelegated' => 'Questo blocco è delegato pertanto non può essere espanso!',
	'UI:IPManagement:Action:Expand:IPv4Block:CannotBeExpanded' => 'Il blocco non può essere espanso: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Block:SmallerThanMinSize' => 'La dimensione del blocco non può essere piu piccola di %1$s!',
	'UI:IPManagement:Action:Expand:IPv4Block:Done' => '%1$s <span class="hilite">%2$s</span> è stato espanso.',

	// List space action on subnet blocks 
	'UI:IPManagement:Action:ListSpace:IPv4Block' => 'Lista dello spazio',                                               
	'UI:IPManagement:Action:ListSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Spazio',
	'UI:IPManagement:Action:ListSpace:IPv4Block:Title_Class_Object' => 'Spazio entro%1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpace' => 'Libero [%1$s - %2$s] - %3$s IP - %4$.2f %%',
	
	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv4Block' => 'Trova lo spazio',
	'UI:IPManagement:Action:FindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Trova lo spazio',
	'UI:IPManagement:Action:FindSpace:IPv4Block:Title_Class_Object' => 'Cerca lo spazio all\'interno %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:FindSpace:IPv4Block:SizeOfSpace' => 'Dimensione dello spazio da cercare:',
	'UI:IPManagement:Action:FindSpace:IPv4Block:MaxNumberOfOffers' => 'Massimo numero di offerte:',
	
	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Trova spazio',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Title_Class_Object' => 'Spazio entro%1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Summary' => '%1$s primo /%2$s entro il blocco',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsBlock' => 'Crea come blocco figlio',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsSubnet' => 'Crea come sottorete',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv4Block' => 'Delegato',
	'UI:IPManagement:Action:Delegate:IPv4Block:PageTitle_Object_Class' => '%1$s - Delegato',
	'UI:IPManagement:Action:Delegate:IPv4Block:Title_Class_Object' => 'Delegato %1$s <span class="hilite">%2$s</span> all\'organizzazione',
	'UI:IPManagement:Action:Delegate:IPv4Block:ChildBlock' => 'Organizzazione per delegare il blocco a:',
	'UI:IPManagement:Action:Delegate:IPv4Block:NoChildOrg' => 'L\'organizzazione del Blocco non ha figli e, quindi, il blocco non può essere delegato!',
	'UI:IPManagement:Action:Delegate:IPv4Block:NoOtherOrg' => 'Non ci sono altre organizzazioni oltre all\'organizzazione del blocco!',
	'UI:IPManagement:Action:Delegate:IPv4Block:IsDelegated' => 'Il blocco è già delegato!',
	'UI:IPManagement:Action:Delegate:IPv4Block:CannotBeDelegated' => 'Il blocco non può essere delegato: %1$s',
	'UI:IPManagement:Action:Delegate:IPv4Block:Done' => '%1$s <span class="hilite">%2$s</span> è stato delegato.',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPv4Block:CannotBeUndelegated' => 'La delega non può essere annullata: %1$s',
	'UI:IPManagement:Action:Undelegate:IPv4Block' => 'Non-delegato',
	'UI:IPManagement:Action:Undelegate:IPv4Block:PageTitle_Object_Class' => '%1$s - Non-delegato',
	'UI:IPManagement:Action:Undelegate:IPv4Block:Done' => '%1$s <span class="hilite">%2$s</span> è stato non-delegato.',
	
//
// Management of Subnets
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPSubnet:IpCannotChange' => 'IP della sottore non può essere modificato! ',	
	'UI:IPManagement:Action:New:IPSubnet:MaskCannotChange' => 'La maschera della sottorete non può essere modificata!',	
	'UI:IPManagement:Action:New:IPSubnet:IpIncorrect' => 'L\'IP della sottorete non è consistente con la maschera!',
	'UI:IPManagement:Action:New:IPSubnet:NotInBlock' => 'La sottorete non è contenuto anel blocco!',	
	'UI:IPManagement:Action:New:IPSubnet:Collision0' => 'La sottorete esiste gia!',	
	'UI:IPManagement:Action:New:IPSubnet:Collision1' => 'Collisione della sottorete: l\'IP della sottorete appartiene a una sottorete esistente!',
	'UI:IPManagement:Action:New:IPSubnet:Collision2' => 'Collisione della sottorete: broadcast IP appartiene a una subnet esistente!',	
	'UI:IPManagement:Action:New:IPSubnet:Collision3' => 'Collisione della sottorete: la nuova sottorete ne include una già esistente!',	
	'UI:IPManagement:Action:New:IPSubnet:GatewayOutOfSubnet' => 'L\'IP del Gateway non è nei limiti della sottorete!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPSubnet' => 'Calcolatrice Sottorete',
	'UI:IPManagement:Action:Calculator:IPSubnet:SelectSubnetType' => 'Seleziona il tipo di sottoreti',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:SelectCreation' => 'È possibile registrare i relativi blocchi sottorete o sottorete :',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CreateSubnet' => 'Crea sottorete',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateSubnet:MaskIsToSmall' => 'Mask è troppo piccola: non è possibile creare la sottorete !',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CreateBlock' => 'Crea blocco sottorete',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateBlock:MaskIsToBig' => 'Mask è troppo grande: non è possibile creare il blocco sottorete !',

//
// Management of IPv4 Subnets
//
	// Display details of subnet
	'UI:IPManagement:Action:Details:IPv4Subnet' => 'Dettagli',
	'UI:IPManagement:Action:Details:IPv4Subnet+' => '',

	// Display list of subnets
	'UI:IPManagement:Action:DisplayList:IPv4Subnet' => 'Mostra lista',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet+' => '',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet:PageTitle_Class' => 'Sottoreti IPv4',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet:Title_Class' => 'Sottoreti IPv4',
	
	// Display tree of subnets
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet' => 'Mostra albero',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:PageTitle_Class' => 'Sottoreti IPv4',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:Title_Class' => 'Sottoreti IPv4',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:OrgName' => 'Organizzazione %1$s',
	
	// Find space action on subnets 
	'UI:IPManagement:Action:FindSpace:IPv4Subnet' => 'Trova spazio',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - Trova spazio',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:Title_Class_Object' => 'Cerca lo spazio IP all\'interno %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeTooSmall' => 'La sottorete è troppo piccola per lo spazio. Per favore cancella!',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeOfRange' => 'Dimensione dello spazio da cercare:',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:MaxNumberOfOffers' => 'Massimo numero di offerte:',
	
	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - Trova spazio',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Title_Class_Object' => 'Spazio entro %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Summary' => '%1$s Primo libero%2$s intervallo IP entro la sottorete',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeTooBig' => 'Lo spazio richiesto non si adatta alla sottorete. Per favore, prova un valore più basso.',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:CreateAsRange' => 'Crea come in intervallo IP',

	// List IPs action on subnets 
	'UI:IPManagement:Action:ListIps:IPv4Subnet' => 'Elena & Prendi IP',                                               
	'UI:IPManagement:Action:ListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IP',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Title_Class_Object' => 'Elenco degli IP entro %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Subtitle_ListRange' => 'La sottorete è troppo grande per elencare tutti gli IP. Per favore, seleziona un intervallo da visualizzare:',                                               
	'UI:IPManagement:Action:ListIps:IPv4Subnet:FirstIP' => 'Primo IP della lista',                                               
	'UI:IPManagement:Action:ListIps:IPv4Subnet:LastIP' => 'Last Ultimo IP della lista',                                               
	
	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv4Subnet' => 'Elenca & Prendi IPs',                                               
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IP',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:Title_Class_Object' => 'Lista parziale degli IP entro %1$s: <span class="hilite">%2$s</span>',
 	'UI:IPManagement:Action:DoListIps:IPv4Subnet:CannotBeListed' => 'Gli IP non possono essere elencati: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIPOutOfSubnet' => 'Primo IP fuori dalla sottorete!',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:LastIPOutOfSubnet' => 'Ultimo IP fuori dalla sottorete!',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'Il primo IP dell\'intervallo è più grande dell\'ultimo IP!',

	// Shrink action on subnets
	'UI:IPManagement:Action:Shrink:IPv4Subnet' => 'Dividi',
	'UI:IPManagement:Action:Shrink:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary' => 'Sommario',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s diviso',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Title_Class_Object' => 'Shrink %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:CannotBeShrunk' =>  'La sottorete non può essere divisa: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmall' => 'La sottorete è troppo piccola per essere divisa!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy' => 'La sottorete è troppo piccola per essere divisa in %1$s!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeInTheMiddle' => 'Intervallo: <b>%1$s [%2$s - %3$s]</b> si trova tra nuovi limiti di sottorete. La divisione non può essere eseguita!',	
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeDropped' => 'Intervallo: <b>%1$s [%2$s - %3$s]</b> verrà eliminato dalla sottorete. La divisione non potrà essere eseguita!',	
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Done' => '%1$s <span class="hilite">%2$s</span> è stato diviso da%3$s.',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:By' => 'Diviso da :',
	
	// Split action on subnets
	'UI:IPManagement:Action:Split:IPv4Subnet' => 'Diviso',
	'UI:IPManagement:Action:Split:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary' => 'Sommario',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s diviso',
	'UI:IPManagement:Action:Split:IPv4Subnet:Title_Class_Object' => 'Split %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Split:IPv4Subnet:CannotBeSplit' =>  'La sottorete non può essere divisa: %1$s',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmall' => 'La sottorete è troppo piccola per essere divisa!',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy' => 'La sottorete è troppo piccola per essere divisa da %1$s!',
	'UI:IPManagement:Action:Split:IPv4Subnet:IPRangeInTheMiddle' => 'L\'intervallo: <b>%1$s [%2$s - %3$s]</b> si trova tra nuovi limiti di sottorete. La divisione non può essere eseguita!',
	'UI:IPManagement:Action:Split:IPv4Subnet:Done' => '%1$s <span class="hilite">%2$s</span> è stata divisa in %3$s.',
	'UI:IPManagement:Action:Split:IPv4Subnet:In' => 'Divisa in :',
	
	// Expand action on subnets
	'UI:IPManagement:Action:Expand:IPv4Subnet' => 'Espanso',
	'UI:IPManagement:Action:Expand:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary' => 'Sommario',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s espanso',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Title_Class_Object' => 'Expand %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Expand:IPv4Subnet:CannotBeExpanded' =>  'La sottorete non può essere espansa: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBig' => 'La sottorete è troppo grande per essere espansa!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy' => 'La sottorete è troppo grande per essere espansa in %1$s!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:NotInIPBlock' => 'Il blocco che ospita la sottorete è troppo piccolo per contenere la nuova sottorete allargata!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Done' => '%1$s <span class="hilite">%2$s</span> è stata allargata da %3$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:By' => 'Esapnsa da :',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet' => 'Esporta IP in CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s IP in CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Title_Class_Object' => 'IP in CSV di %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Subtitle_ListRange' => 'La sottorete è troppo grande per esportare tutti gli IP. Per favore selezione un intervallo:',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:FirstIP' => 'Primo IP della lista',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:LastIP' => 'Ultimo IP della lista',                                               
	
	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet' => 'Esporta IP in CSV',                                               
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s Esporta IP in CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:Title_Class_Object' => 'Esportazione parziole degli IP %1$s: <span class="hilite">%2$s</span>',
 	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:CannotBeListed' => 'Gli IP non possono essere elencati: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIPOutOfSubnet' => 'Primo IP fuori dalla sottorete!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:LastIPOutOfSubnet' => 'Ultimo IP fuori dalla sottorete!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'Il Primo IP è piu alto dell\'ultimo IP!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv4Subnet' => 'Calcolatrice Sottorete',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:PageTitle_Object_Class' => '%2$s Calcolatrice',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Title_Class_Object' => 'Colcatrice per %1$s',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:IP' => 'Indirizzo IP',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Mask' => 'Maschera',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:CIDR' => 'CIDR',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet' => 'Calcolatrice Sottorete',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PageTitle_Object_Class' => '%2$s Calcolatrice',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Title_Class_Object' => '%1$s - Risultato Calcolatrice',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IP' => 'Indirizzo IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Mask' => 'Maschera',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CIDR' => 'CIDR',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:SubnetIP' => 'Sottorete IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Wildcard' => 'Maschera Wildcard',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:BroadcastIP' => 'Broadcast IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IPNumber' => 'Numeri di IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:UsableHosts' => 'Numeri di Hosts utilizzabili',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet' => 'Sottorete precedente IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet:NA' => 'Non applicabile',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet' => 'Successiva sottorete IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet:NA' => 'Non applicabile',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CannotRun' => 'La calcolatrice di sottorete non può essere eseguita: %1$s',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:EnterMaskOrCIDR' => 'Inserisci una maschera o CIDR!',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongMask' => 'La Maschera non è valida!',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongCIDR' => 'CIDR non è valido',

//
// Management of IP ranges
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPRange:NameExist' => 'Il nome dell\'intervallo esiste già nella sottorete!',
	'UI:IPManagement:Action:New:IPRange:Reverted' => 'Il primo IP dell\'intervallo è piu grande dell\'ultimo IP!',
	'UI:IPManagement:Action:New:IPRange:NotInSubnet' => 'L\'intervallo IP non è contenuto all\'interno della sottorete selezionata!',
	'UI:IPManagement:Action:New:IPRange:Collision0' => 'L\'intervallo IP esiste già!',
	'UI:IPManagement:Action:New:IPRange:Collision1' => 'Collisione di intervallo: il primo IP appartiene a un intervallo esistente!',	
	'UI:IPManagement:Action:New:IPRange:Collision2' => 'Collisione di intervallo: l\'ultimo IP appartiene a un intervallo esistente !',
	'UI:IPManagement:Action:New:IPRange:Collision3' => 'Collisione di intevallo: il nuovo intervallo ne include uno esistente!',	

//
// Management of IPv4 ranges
//
	// Display details of IP Range
	'UI:IPManagement:Action:Details:IPv4Range' => 'Dettagli',
	'UI:IPManagement:Action:Details:IPv4Range+' => '',

	// List IPs action on IP Ranges 
	'UI:IPManagement:Action:ListIps:IPv4Range' => 'Elenca & Prendi IP',                                               
	'UI:IPManagement:Action:ListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IP',
	'UI:IPManagement:Action:ListIps:IPv4Range:Title_Class_Object' => 'Elnco di IP entro %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListIps:IPv4Range:Subtitle_ListRange' => 'L\'intervallo è troppo grande per elencare tutti gli IP. Per favore, seleziona un sotto intervallo da visualizzare:',
	'UI:IPManagement:Action:ListIps:IPv4Range:FirstIP' => 'Primo IP della lista',                                               
	'UI:IPManagement:Action:ListIps:IPv4Range:LastIP' => 'Ultimo IP della lista',                                               
		
	// Do list IPs action on IP Ranges 
	'UI:IPManagement:Action:DoListIps:IPv4Range' => 'Elenca & Prendi IPs',                                               
	'UI:IPManagement:Action:DoListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Range:Title_Class_Object' => 'Elenco parziale di IP all\'interno %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoListIps:IPv4Range:CannotBeListed' => 'Range cannot be listed: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIPOutOfRange' => 'L\'intervallo non può essere elencato!',
	'UI:IPManagement:Action:DoListIps:IPv4Range:LastIPOutOfRange' => 'L\'ultimo IP è fuori dall\'intervallo!',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIpBiggerThanLastIp' => 'Il primo IP dell\'intervallo è più alto dell\'ultimo IP!',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv4Range' => 'Esporta IP in CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s Esporta IP in CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Title_Class_Object' => 'Esporta IP in CSV %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Subtitle_ListRange' => 'L\'intervallo è troppo grande per esportare tutti gli IP. Per favore, seleziona un sotto intervallo da esportare:',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:FirstIP' => 'Primo IP della lista',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:LastIP' => 'Ultimo IP della lista',                                               
	
	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range' => 'Esporta IP in CSV',                                               
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s Esporta IP in CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:Title_Class_Object' => 'Esportazione parziale degli IP %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:CannotBeListed' => 'L\'intervallo non può essere esportato: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIPOutOfRange' => 'Primo IP fuori dall\'intervallo!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:LastIPOutOfRange' => 'Ultimo IP fuori dall\'intervallo!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIpBiggerThanLastIp' => 'Il primo IP dell\'intervallo è più alto dell\'ultimo IP!',

//
// Management of IP Addresses
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPAddress:IPNameCollision' => 'Il nome breve esiste già nel dominio!',	

	'UI:IPManagement:Action:New:IPAddress:IPCollision' => 'IP esiste già!',	
	'UI:IPManagement:Action:New:IPAddress:NotInRange' => 'IP non appartiene all\'intervallo!',
	'UI:IPManagement:Action:New:IPAddress:NotInSubnet' => 'IP non appartiene alla sottorete!',	
	'UI:IPManagement:Action:New:IPAddress:IPPings' => 'IP pings! ',	
	'UI:IPManagement:Action:New:IPAddress:NatIPsAretheSame' => 'IP non può essere NATtato con se stesso! ',

	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:AllocateIP:IPAddress' => 'Allocate address to CI',
	'UI:IPManagement:Action:UnAllocateIP:IPAddress' => 'Un-allocate address from all CIs',
	'UI:IPManagement:Action:Allocate:IPAddress:Class' => 'Target class',
	'UI:IPManagement:Action:Allocate:IPAddress:CI' => 'Functional CI',
	'UI:IPManagement:Action:Allocate:IPAddress:IPAttribute' => 'IP attribut',
	'UI:IPManagement:Action:Allocate:IPAddress:NoCI' => 'There are no instanciated CIs with IP Address attributes in this organization!',
	'UI:IPManagement:Action:Allocate:IPAddress:CannotAllocateCI' => 'Cannot allocate CI to IP: %1$s',
	'UI:IPManagement:Action:Allocate:IPAddress:CIDoesNotExist' => 'Functional CI does not exist!',
	'UI:IPManagement:Action:Allocate:IPAddress:AttributeIsReadOnly' => 'CI\'s attribute is R/O!',
	'UI:IPManagement:Action:Allocate:IPAddress:AttributeIsSynchronized' => 'CI\'s attribute is slave of a synchronization!',
	'UI:IPManagement:Action:Unallocate:IPAddress:CannotBeUnallocated' => 'Address cannot be un-allocated: %1$s',
	'UI:IPManagement:Action:UnAllocate:IPAddress:IPNotAllocated' => 'IP is not allocated!',
	'UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsReadOnly' => 'IP is attached to a CI\'s attribute that is R/O!',
	'UI:IPManagement:Action:UnAllocate:IPAddress:AttributeIsSynchronized' => 'IP is attached to a CI\'s attribute that is slave of a synchronization!',

//
// Management of IPv4 Addresses
//
	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:Allocate:IPv4Address:PageTitle_Object_Class' => 'Allocate IP',
	'UI:IPManagement:Action:Allocate:IPv4Address:Title_Class_Object' => 'Allocate %1$s <span class="hilite">%2$s</span> to CI',
	'UI:IPManagement:Action:Allocate:IPv4Address:Done' => '%1$s <span class="hilite">%2$s</span> has been allocated.',
	'UI:IPManagement:Action:Unallocate:IPv4Address:PageTitle_Object_Class' => 'Un-allocate IP',
	'UI:IPManagement:Action:Unallocate:IPv4Address:Done' => '%1$s <span class="hilite">%2$s</span> has been unallocated.',

//
// Management of Domains
//
	// Creation Management	
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'Il nome del dominio esiste già!',
		
	// Display list of domains
	'UI:IPManagement:Action:DisplayList:Domain' => 'Mostra l\'elenco',
	'UI:IPManagement:Action:DisplayList:Domain+' => '',
	'UI:IPManagement:Action:DisplayList:Domain:PageTitle_Class' => 'Domini DNS',
	'UI:IPManagement:Action:DisplayList:Domain:Title_Class' => 'Domini DNS',
	
	// Display tree of domains
	'UI:IPManagement:Action:DisplayTree:Domain' => 'Mostra l\'albero',
	'UI:IPManagement:Action:DisplayTree:Domain+' => '',
	'UI:IPManagement:Action:DisplayTree:Domain:PageTitle_Class' => 'Domini DNS',
	'UI:IPManagement:Action:DisplayTree:Domain:Title_Class' => 'Domini DNS',
	'UI:IPManagement:Action:DisplayTree:Domain:OrgName' => 'Organizzazione %1$s',
	
));
	
