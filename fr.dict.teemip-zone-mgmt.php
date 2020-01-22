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
 * @copyright   Copyright (C) 2020 TeemIP
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class extensions for IPConfig
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPConfig/Attribute:ip_update_dns_records' => 'Mets à jour automatiquement les enregistrements DNS',
	'Class:IPConfig/Attribute:ip_update_dns_records+' => 'Crée, modifie ou supprime automatiquement les enregistrements DNS liés à une adresse IP',
	'Class:IPConfig/Attribute:ip_update_dns_records/Value:yes' => 'Oui',
	'Class:IPConfig/Attribute:ip_update_dns_records/Value:no' => 'Non',
));

//
// Class extensions for IPAddress
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPAddress/Attribute:view_id' => 'Vue DNS',
	'Class:IPAddress/Attribute:view_id+' => '',
	'Class:IPAddress/Attribute:view_name' => 'Nom de la Vue',
	'Class:IPAddress/Attribute:view_name+' => '',
	'Class:IPAddress/Tab:rrecords_list' => 'Enregistrements DNS',
	'Class:IPAddress/Tab:rrecords_list+' => 'Liste de tous les enregistrements DNS associés à l\'addesse IP.',
	'Class:IPAddress/Tab:ptrrecords_list' => 'Enregistrements PTR:',
	'Class:IPAddress/Tab:ptrrecords_list_empty' => 'Il n\'y a pas d\'enregistrements PTR liés à cette IP',
	'Class:IPAddress/Tab:arecords_list' => 'Enregistrements A:',
	'Class:IPAddress/Tab:arecords_list_empty' => 'Il n\'y a pas d\'enregistrements A liés à cette IPP',
	'Class:IPAddress/Tab:aaaarecords_list' => 'Enregistrements AAAA:',
	'Class:IPAddress/Tab:aaaarecords_list_empty' => 'Il n\'y a pas d\'enregistrements AAAA liés à cette IP',
	'Class:IPAddress/Tab:cnamerecords_list' => 'Enregistrements CNAME:',
	'Class:IPAddress/Tab:cnamerecords_list_empty' => 'Il n\'y a pas d\'enregistrements CNAME liés à cette IP',
));

//
// Class: View
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:View' => 'Vue',
	'Class:View+' => 'Vue DNS',
	'Class:View/Attribute:org_id' => 'Organisation',
	'Class:View/Attribute:org_id+' => '',
	'Class:View/Attribute:org_name' => 'Nom de l\'organisation',
	'Class:View/Attribute:org_name+' => '',
	'Class:View/Attribute:name' => 'Nom',
	'Class:View/Attribute:name+' => '',
	'Class:View/Attribute:description' => 'Description',
	'Class:View/Attribute:description+' => '',
	'Class:View/Attribute:zones_list' => 'Zones',
	'Class:View/Attribute:zones_list+' => 'Toutes les zones de la vue',
));

//
// Class: Zone
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:Zone' => 'Zone',
	'Class:Zone+' => '',
	'Class:Zone/Name' => '%1$s',
	'Class:Zone:baseinfo' => 'Information Générale',
	'Class:Zone:soainfo' => 'Start Of Authority',
	'Class:Zone/Attribute:view_id' => 'Vue',
	'Class:Zone/Attribute:view_id+' => '',
	'Class:Zone/Attribute:mapping' => 'Type de Mapping',
	'Class:Zone/Attribute:mapping+' => '',
	'Class:Zone/Attribute:mapping/Value:direct' => 'Forward',
	'Class:Zone/Attribute:mapping/Value:direct+' => 'Forward mapping',
	'Class:Zone/Attribute:mapping/Value:ipv4reverse' => 'IPv4 Inverse',
	'Class:Zone/Attribute:mapping/Value:ipv4reverse+' => 'Mapping inverse pour les adresses IPv4: IPv4 vers nom',
	'Class:Zone/Attribute:mapping/Value:ipv6reverse' => 'IPv6 Inverse',
	'Class:Zone/Attribute:mapping/Value:ipv6reverse+' => 'Mapping inverse pour les adresses IPv6: IPv6 vers nom',
	'Class:Zone/Attribute:name' => 'Nom',
	'Class:Zone/Attribute:name+' => '',
	'Class:Zone/Attribute:comment' => 'Commentaire',
	'Class:Zone/Attribute:comment+' => '',
	'Class:Zone/Attribute:requestor_id' => 'Demandeur',
	'Class:Zone/Attribute:requestor_id+' => '',
	'Class:Zone/Attribute:requestor_name' => 'Nom du demandeur',
	'Class:Zone/Attribute:requestor_name+' => '',
	'Class:Zone/Attribute:ttl' => 'TTL',
	'Class:Zone/Attribute:ttl+' => '',
	'Class:Zone/Attribute:sourcedname' => 'Master server',
	'Class:Zone/Attribute:sourcedname+' => '',
	'Class:Zone/Attribute:mbox' => 'Hostmaster mailbox',
	'Class:Zone/Attribute:mbox+' => '',
	'Class:Zone/Attribute:serial' => 'Serial',
	'Class:Zone/Attribute:serial+' => '',
	'Class:Zone/Attribute:refresh' => 'Refresh',
	'Class:Zone/Attribute:refresh+' => '',
	'Class:Zone/Attribute:retry' => 'Retry',
	'Class:Zone/Attribute:retry+' => '',
	'Class:Zone/Attribute:expire' => 'Expire',
	'Class:Zone/Attribute:expire+' => '',
	'Class:Zone/Attribute:minimum' => 'Minimum',
	'Class:Zone/Attribute:minimum+' => '',
	'Class:Zone/Attribute:servers_list' => 'Serveurs autoritaires',
	'Class:Zone/Attribute:servers_list+' => 'Serveurs autoritaires en charge de la zone',
	'Class:Zone/Tab:nsrecords_list' => 'Enregistrements NS',
	'Class:Zone/Tab:nsrecords_list+' => 'Liste de tous les enregistrements NS de la zone',
	'Class:Zone/Tab:arecords_list' => 'Enregistrements A',
	'Class:Zone/Tab:arecords_list+' => 'Liste de tous les enregistrements A de la zone',
	'Class:Zone/Tab:aaaarecords_list' => 'Enregistrements AAAA',
	'Class:Zone/Tab:aaaarecords_list+' => 'Liste de tous les enregistrements AAAA de la zone',
	'Class:Zone/Tab:cnamerecords_list' => 'Enregistrements CNAME',
	'Class:Zone/Tab:cnamerecords_list+' => 'Liste de tous les enregistrements CNAME de la zone',
	'Class:Zone/Tab:ptrrecords_list' => 'Enregistrements PTR',
	'Class:Zone/Tab:ptrrecords_list+' => 'Liste de tous les enregistrements PTR de la zone',
	'Class:Zone/Tab:otherrecords_list' => 'Autres enregistrements',
	'Class:Zone/Tab:mxrecords_list' => 'Liste des %1$s enregistrements MX de la zone',
	'Class:Zone/Tab:mxrecords_list_empty' => 'Il n\'y a pas d\enregistrement MX dans la zone',
	'Class:Zone/Tab:srvrecords_list' => 'Liste des %1$s enregistrements SRV de la zone',
	'Class:Zone/Tab:srvrecords_list_empty' => 'Il n\'y a pas d\enregistrement SRV dans la zone',
	'Class:Zone/Tab:txtrecords_list' => 'Liste des %1$s enregistrements TXT de la zone',
	'Class:Zone/Tab:txtrecords_list_empty' => 'Il n\'y a pas d\enregistrement TXT dans la zone',
	'Class:Zone/DataFile:ns' => '
;
; Serveurs de Noms
;',
	'Class:Zone/DataFile:ipv4' => '
;
; Adresses IPv4 pour les noms canoniques
;',
	'Class:Zone/DataFile:ipv6' => '
;
; Adresses IPv6 pour les noms canoniques
;',
	'Class:Zone/DataFile:cnames' => '
;
; Alias
;',
	'Class:Zone/DataFile:mx' => '
;
; Mail exchangers
;',
	'Class:Zone/DataFile:ptr' => '
;
; Adresses pointant vers des noms canoniques
;',
'Class:Zone/DataFile:srv' => '
;
; Localisation des services
;',
	'Class:Zone/DataFile:txt' => '
;
; Texte
;',
	'Class:Zone/DataFile:records_in_alphaorder' => '
;
; Autres enregistrements triés par ordre alphabetique
;',
));

//
// Class: lnkServerToZone
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkServerToZone' => 'Lien Serveur / Zone',
	'Class:lnkServerToZone+' => '',
	'Class:lnkServerToZone/Attribute:server_id' => 'Serveur',
	'Class:lnkServerToZone/Attribute:server_id+' => '',
	'Class:lnkServerToZone/Attribute:server_name' => 'Nom du serveur',
	'Class:lnkServerToZone/Attribute:server_name+' => '',
	'Class:lnkServerToZone/Attribute:zone_id' => 'Zone',
	'Class:lnkServerToZone/Attribute:zone_id+' => '',
	'Class:lnkServerToZone/Attribute:zone_name' => 'Nom de la zone',
	'Class:lnkServerToZone/Attribute:zone_name+' => '',
	'Class:lnkServerToZone/Attribute:authority' => 'Relation d\'autorité',
	'Class:lnkServerToZone/Attribute:authority+' => '',
	'Class:lnkServerToZone/Attribute:authority/Value:master' => 'Maître',
	'Class:lnkServerToZone/Attribute:authority/Value:master+' => '',
	'Class:lnkServerToZone/Attribute:authority/Value:slave' => 'Esclave',
	'Class:lnkServerToZone/Attribute:authority/Value:slave+' => '',
	'Class:lnkServerToZone/Attribute:authority/Value:hidden_master' => 'Maître caché',
	'Class:lnkServerToZone/Attribute:authority/Value:hidden_mastermaster+' => '',
	'Class:lnkServerToZone/Attribute:authority/Value:hidden_slave' => 'Esclave caché',
	'Class:lnkServerToZone/Attribute:authority/Value:hidden_slave+' => '',
));

//
// Class: ResourceRecord
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:ResourceRecord' => 'Enregistrement',
	'Class:ResourceRecord+' => 'Enregistrement DNS',
	'Class:ResourceRecord/Attribute:finalclass' => 'Type',
	'Class:ResourceRecord/Attribute:finalclass+' => '',
	'Class:ResourceRecord/Attribute:org_id' => 'Organisation',
	'Class:ResourceRecord/Attribute:org_id+' => '',
	'Class:ResourceRecord/Attribute:org_name' => 'Nom de l\'organisation',
	'Class:ResourceRecord/Attribute:org_name+' => '',
	'Class:ResourceRecord/Attribute:zone_id' => 'Zone',
	'Class:ResourceRecord/Attribute:zone_id+' => '',
	'Class:ResourceRecord/Attribute:zone_name' => 'Nom de la zone',
	'Class:ResourceRecord/Attribute:zone_name+' => '',
	'Class:ResourceRecord/Attribute:name' => 'Nom du RR',
	'Class:ResourceRecord/Attribute:name+' => '',
	'Class:ResourceRecord/Attribute:overwrite_zone_ttl' => 'Surcharge du TTL de la zone',
	'Class:ResourceRecord/Attribute:overwrite_zone_ttl+' => '',
	'Class:ResourceRecord/Attribute:overwrite_zone_ttl/Value:no' => 'Non',
	'Class:ResourceRecord/Attribute:overwrite_zone_ttl/Value:no+' => '',
	'Class:ResourceRecord/Attribute:overwrite_zone_ttl/Value:yes' => 'Oui',
	'Class:ResourceRecord/Attribute:overwrite_zone_ttl/Value:yes+' => '',
	'Class:ResourceRecord/Attribute:ttl' => 'TTL',
	'Class:ResourceRecord/Attribute:ttl+' => '',
	'Class:ResourceRecord/Attribute:comment' => 'Commentaire',
	'Class:ResourceRecord/Attribute:comment+' => '',
	'ResourceRecord:Zone' => 'Zone',
	'ResourceRecord:Record' => 'Attributs de l\'enregistrement',
));

//
// Class: ARecord
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:ARecord' => 'A',
	'Class:ARecord+' => '',
	'Class:ARecord/Attribute:ip_id' => 'Adresse IPv4',
	'Class:ARecord/Attribute:ip_id+' => '',
	'Class:ARecord/Attribute:ip_fqdn' => 'FQDN de l\'adresse IPv4',
	'Class:ARecord/Attribute:ip_fqdn+' => '',
	));

//
// Class: AAAARecord
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:AAAARecord' => 'AAAA',
	'Class:AAAARecord+' => '',
	'Class:AAAARecord/Attribute:ip_id' => 'Adresse IPv6',
	'Class:AAAARecord/Attribute:ip_id+' => '',
	'Class:AAAARecord/Attribute:ip_fqdn' => 'FQDN de l\'adresse IPv6',
	'Class:AAAARecord/Attribute:ip_fqdn+' => '',
));

//
// Class: CNAMERecord
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:CNAMERecord' => 'CNAME',
	'Class:CNAMERecord+' => '',
	'Class:CNAMERecord/Attribute:cname' => 'CNAME',
	'Class:CNAMERecord/Attribute:cname+' => 'Nom canonique',
));

//
// Class: MXRecord
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:MXRecord' => 'MX',
	'Class:MXRecord+' => '',
	'Class:MXRecord/Attribute:preference' => 'Préférence',
	'Class:MXRecord/Attribute:preference+' => '',
	'Class:MXRecord/Attribute:exchange' => 'Serveur de courrier',
	'Class:MXRecord/Attribute:exchange+' => '',
));

//
// Class: NSRecord
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:NSRecord' => 'NS',
	'Class:NSRecord+' => '',
	'Class:NSRecord/Attribute:nsname' => 'Serveur de nom',
	'Class:NSRecord/Attribute:nsname+' => '',
));

//
// Class: PTRRecord
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:PTRRecord' => 'PTR',
	'Class:PTRRecord+' => '',
	'Class:PTRRecord/Attribute:hostname' => 'Nom du host',
	'Class:PTRRecord/Attribute:hostname+' => '',
));

//
// Class: SOARecord
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:SOARecord' => 'SOA',
	'Class:SOARecord+' => '',
	'Class:SOARecord/Attribute:sourcedname' => 'Serveur Maître',
	'Class:SOARecord/Attribute:sourcedname+' => '',
	'Class:SOARecord/Attribute:mbox' => 'Adresse mail',
	'Class:SOARecord/Attribute:mbox+' => '',
	'Class:SOARecord/Attribute:serial' => 'Numéro de série',
	'Class:SOARecord/Attribute:serial+' => '',
	'Class:SOARecord/Attribute:refresh' => 'Refresh',
	'Class:SOARecord/Attribute:refresh+' => '',
	'Class:SOARecord/Attribute:retry' => 'Retry',
	'Class:SOARecord/Attribute:retry+' => '',
	'Class:SOARecord/Attribute:expire' => 'Expire',
	'Class:SOARecord/Attribute:expire+' => '',
	'Class:SOARecord/Attribute:minimum' => 'Minimum',
	'Class:SOARecord/Attribute:minimum+' => '',
));

//
// Class: TXTRecord
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:TXTRecord' => 'TXT',
	'Class:TXTRecord+' => '',
	'Class:TXTRecord/Attribute:txt' => 'Text',
	'Class:TXTRecord/Attribute:txt+' => '',
));

//
// Class: SRVRecord
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:SRVRecord' => 'SRV',
	'Class:SRVRecord+' => '',
	'Class:SRVRecord/Attribute:priority' => 'Priorité',
	'Class:SRVRecord/Attribute:priority+' => '',
	'Class:SRVRecord/Attribute:weight' => 'Poids',
	'Class:SRVRecord/Attribute:weight+' => '',
	'Class:SRVRecord/Attribute:port' => 'Port',
	'Class:SRVRecord/Attribute:port+' => '',
	'Class:SRVRecord/Attribute:target' => 'Cible',
	'Class:SRVRecord/Attribute:target+' => '',
));

//
// Management of zones
//
Dict::Add('FR FR', 'French', 'Français', array(
	'UI:ZoneManagement:Action:New:Zone:V4:WrongFormat' => 'Mauvais format: le format d\'une zone reverse IPv4 est x.[y.][z.]in-addr.arpa. !',
	'UI:ZoneManagement:Action:New:Zone:V6:WrongFormat' => 'Mauvais format: le format d\'une zone reverse IPv6 est x1.[x2.]...[x31.]ip6.arpa. !',
));

//
// Management of data files
//
Dict::Add('FR FR', 'French', 'Français', array(
	'UI:ZoneManagement:Action:Zone:DataFileDisplay' => 'Affiche le fichier de données',
	'UI:ZoneManagement:Action:Zone:Details' => 'Détails',
	'UI:ZoneManagement:Action:Zone:DataFileDisplay:PageTitle_Object_Class' => '%1$s - %2$s fichier de données',
	'UI:ZoneManagement:Action:Zone:DataFileDisplay:Title_Class_Object' => 'Fichier de données de %1$s: <span class="hilite">%2$s</span>',
	'UI:ZoneManagement:Action:DataFileDisplay:sort_by_record' => 'Affiche le fichier de données trié par enregistrements',
	'UI:ZoneManagement:Action:DataFileDisplay:sort_by_char' => 'Affiche le fichier de données trié par ordre alphabétique',
));

//
// Management of records
//
Dict::Add('FR FR', 'French', 'Français', array(
	'UI:ZoneManagement:Action:New:PTRRecord:V4:WrongNumberOfDigit' => 'Mauvais format: les enregistrements PTR IPv4 sont constitués de 4 nombres - x.y.z.t.in-addr.arpa. !',
	'UI:ZoneManagement:Action:New:PTRRecord:V4:IpNotInRange' => 'Mauvais format: les nombres IPv4 sont contenus dans l\'interval 0 - 255 !',
	'UI:ZoneManagement:Action:New:PTRRecord:V4:WrongFormat' => 'Mauvais format: le format des enregistrements PTR IPv4 est x.y.z.t.in-addr.arpa. !',
	'UI:ZoneManagement:Action:New:PTRRecord:V6:WrongNumberOfDigit' => 'Mauvais format: les enregistrements PTR IPv6 PTR sont constitués de 32 nombres - x1.x2....x32.ip6.arpa. !',
	'UI:ZoneManagement:Action:New:PTRRecord:V6:IpNotInRange' => 'Mauvais format: les nombres IPv6 sont contenus dans l\'interval 0 - F range, en hexa !',
	'UI:ZoneManagement:Action:New:PTRRecord:V6:WrongFormat' => 'Mauvais format: le format des enregistrements PTR IPv6 est x1.x2....x32.ip6.arpa. !',

	'UI:ZoneManagement:Action:IPObject:UpdateRR' => 'Créer / Modifier DNS RRs',
	'UI:ZoneManagement:Action:IPObject:DeleteRR' => 'Supprimer DNS RRs',

	'UI:ZoneManagement:Action:IPAddress:UpdateRR' => 'Créer / Modifier DNS RRs',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:Error:NoShortName' => 'L\'addresse IP n\'a pas de nom court !',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:Error:NoDomainName' => 'L\'addresse IP n\'a pas de nom de domaine !',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:Error:CannotFindZone:direct' => 'Aucune zone forward n\'a été trouvée pour le domaine et la vue !',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:Error:CannotFindZone:ipv4reverse' => 'Aucune zone reverse n\'a été trouvée !',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:Error:CannotFindZone:ipv6reverse' => 'Aucune zone reverse n\'a été trouvée !',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:HasNotRun' => 'Aucun enregistrement n\'a été créé pour l\'addresse: %1$s',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:HasErrors' => 'Des  erreurs on tété trouvées: %1$s',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:HasRun' => 'Les enregistrements associés à l\'addresse IP ont été créés ou mis à jour.',
	'UI:ZoneManagement:Action:IPAddress:CleanRRs:HasRun' => 'Les enregistrements associés à l\'adresse IP ont été supprimés.',
	'UI:ZoneManagement:Action:IPAddress:DeleteRR' => 'Supprimer DNS RRs',

	'UI:ZoneManagement:Action:IPSubnet:UpdateRRs:HasNotRun' => 'Aucun enregistrement n\'a été créé pour le sous-réseau: %1$s',
	'UI:ZoneManagement:Action:IPSubnet:UpdateRRs:HasRun' => 'Les enregistrements associés aux adresses contenues dans le sous-réseau ont été créés ou mis à jour.',
	'UI:ZoneManagement:Action:IPSubnet:CleanRRs:HasRun' => 'Les enregistrements associés aux adresses contenues dans le sous-réseau ont été supprimés.',
));

//
// Application Menu
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Menu:DNSManagement' => 'Gestion du DNS',
	'Menu:DNSManagement+' => '',
	'Menu:NameSpace' => 'Espace de Nomage',
	'Menu:NameSpace+' => '',
	'Menu:DNSSpace:MainObjects' => 'Principaux objets DNS',
	'Menu:DNSSpace:ResourceRecords' => 'Enregistrements',
	'Menu:View' => 'Vues',
	'Menu:View+' => 'Vues DNS',
	'Menu:Domain' => 'Domaines',
	'Menu:Domain+' => 'Domaines DNS',
	'Menu:Zone' => 'Zones',
	'Menu:Zone+' => 'Zones DNS',
	'Menu:DNSManagement:ResourceRecords' => 'Enregistrements',
	'Menu:DNSManagement:ResourceRecords+' => 'Enregistrements DNS',
	'Menu:NewResourceRecord' => 'Nouveau RR',
	'Menu:NewResourceRecord+' => 'Nouvel Enregistrement DNS',
	'Menu:SearchResourceRecord' => 'Recherche de RRs',
	'Menu:SearchResourceRecord+' => 'Recherche d\'enregistrements DNS',
	'Menu:ARecord' => 'A',
	'Menu:ARecord+' => 'Enregistrements A',
	'Menu:AAAARecord' => 'AAAA',
	'Menu:AAAARecord+' => 'Enregistrements AAAA',
	'Menu:CNAMERecord' => 'CNAME',
	'Menu:CNAMERecord+' => 'Enregistrements CNAME',
	'Menu:MXRecord' => 'MX',
	'Menu:MXRecord+' => 'Enregistrements MX',
	'Menu:NSRecord' => 'NS',
	'Menu:NSRecord+' => 'Enregistrements NS',
	'Menu:PTRRecord' => 'PTR',
	'Menu:PTRRecord+' => 'Enregistrements PTR',
	'Menu:SOARecord' => 'SOA',
	'Menu:SOARecord+' => 'Enregistrements SOA',
	'Menu:TXTRecord' => 'TXT',
	'Menu:TXTRecord+' => 'Enregistrements TXT',
	'Menu:SRVRecord' => 'SRV',
	'Menu:SRVRecord+' => 'Enregistrements SRV',
));
