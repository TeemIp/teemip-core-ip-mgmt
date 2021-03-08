<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'teemip-discovery Module'
//////////////////////////////////////////////////////////////////////
//

//
// Class: IPDiscovery
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPDiscovery' => 'Application de découverte IPs',
	'Class:IPDiscovery+' => '',
	'Class:IPDiscovery/Name' => '%1$s',
	'Class:IPDiscovery/Attribute:last_discovery_date' => 'Date de dernière découverte',
	'Class:IPDiscovery/Attribute:last_discovery_date+' => 'Date à laquelle la découverte a été efectuée pour la dernière fois',
	'Class:IPDiscovery/Attribute:duration' => 'Durée',
	'Class:IPDiscovery/Attribute:duration+' => 'Temps qu\'il a fallu pour la découverte',
	'Class:IPDiscovery/Attribute:ping_enabled' => 'Ping activé',
	'Class:IPDiscovery/Attribute:ping_enabled+' => '',
	'Class:IPDiscovery/Attribute:ping_enabled/Value:yes' => 'Oui',
	'Class:IPDiscovery/Attribute:ping_enabled/Value:no' => 'Non',
	'Class:IPDiscovery/Attribute:ping_timeout' => 'Ping timeout (s)',
	'Class:IPDiscovery/Attribute:ping_timeout+' => '',
	'Class:IPDiscovery/Attribute:iplookup_enabled' => 'IP lookup activé',
	'Class:IPDiscovery/Attribute:iplookup_enabled/Value:yes' => 'Oui',
	'Class:IPDiscovery/Attribute:iplookup_enabled/Value:no' => 'Non',
	'Class:IPDiscovery/Attribute:dns1' => 'Serveur DNS #1',
	'Class:IPDiscovery/Attribute:dns1+' => '',
	'Class:IPDiscovery/Attribute:dns2' => 'Serveur DNS #2',
	'Class:IPDiscovery/Attribute:dns2+' => '',
	'Class:IPDiscovery/Attribute:scan_enabled' => 'Scan activé',
	'Class:IPDiscovery/Attribute:scan_enabled+' => '',
	'Class:IPDiscovery/Attribute:scan_enabled/Value:yes' => 'Oui',
	'Class:IPDiscovery/Attribute:scan_enabled/Value:no' => 'Non',
	'Class:IPDiscovery/Attribute:port_number' => 'Numéro de port',
	'Class:IPDiscovery/Attribute:port_number+' => '',
	'Class:IPDiscovery/Attribute:protocol' => 'Protocole',
	'Class:IPDiscovery/Attribute:protocol+' => '',
	'Class:IPDiscovery/Attribute:protocol/Value:udp' => 'UDP',
	'Class:IPDiscovery/Attribute:protocol/Value:tcp' => 'TCP',
	'Class:IPDiscovery/Attribute:protocol/Value:both' => 'Les deux',
	'Class:IPDiscovery/Attribute:scan_timeout' => 'Scan timeout (s)',
	'Class:IPDiscovery/Attribute:scan_timeout+' => '',
	'Class:IPDiscovery/Attribute:scan_cnx_refused_enabled' => 'Considère les "connexion refusée" comme valides',
	'Class:IPDiscovery/Attribute:scan_cnx_refused_enabled+' => '',
	'Class:IPDiscovery/Attribute:scan_cnx_refused_enabled/Value:yes' => 'Oui',
	'Class:IPDiscovery/Attribute:scan_cnx_refused_enabled/Value:no' => 'Non',
	'Class:IPDiscovery/Attribute:ipv4subnets_list' => 'Sous-réseaux IPv4 gérés',
	'Class:IPDiscovery/Attribute:ipv4subnets_list+' => '',
	'Class:IPDiscovery:baseinfo' => 'Information Générale',
	'Class:IPDiscovery:operation' => 'Opérations',
	'Class:IPDiscovery:pinginfo' => 'Fonction Ping',
	'Class:IPDiscovery:iplookupinfo' => 'Fonction IP lookup',
	'Class:IPDiscovery:scaninfo' => 'Fonction Scan',
));

//
// Class: IPSubnet
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPSubnet/Attribute:ipdiscovery_id' => 'Application de découverte IPs',
	'Class:IPSubnet/Attribute:ipdiscovery_id+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_name' => 'Nom de l\'application de découverte IPs',
	'Class:IPSubnet/Attribute:ipdiscovery_name+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_enabled' => 'Découverte activée',
	'Class:IPSubnet/Attribute:ipdiscovery_enabled+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_enabled/Value:yes' => 'Oui',
	'Class:IPSubnet/Attribute:ipdiscovery_enabled/Value:no' => 'Non',
	'Class:IPSubnet/Attribute:last_discovery_date' => 'Date de dernière découverte',
	'Class:IPSubnet/Attribute:last_discovery_date+' => 'Date à laquelle le subnet a été découvert pour la dernière fois',
	'Class:IPSubnet/Attribute:ipdiscovery_ping_enabled' => 'Ping activé par l\'application',
	'Class:IPSubnet/Attribute:ipdiscovery_ping_enabled+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_iplookup_enabled' => 'IP lookup activé par l\'application',
	'Class:IPSubnet/Attribute:ipdiscovery_iplookup_enabled+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_enabled' => 'Scan activé par l\'application',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_enabled+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_cnx_refused_enabled' => 'L\'application considère les scan "connexion refusée" comme valides',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_cnx_refused_enabled+' => '',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_cnx_refused_enabled/Value:yes' => 'Oui',
	'Class:IPSubnet/Attribute:ipdiscovery_scan_cnx_refused_enabled/Value:no' => 'Non',
	'Class:IPSubnet/Attribute:ping_enabled' => 'Ping activé pour le sous-réseau',
	'Class:IPSubnet/Attribute:ping_enabled+' => '',
	'Class:IPSubnet/Attribute:ping_enabled/Value:yes' => 'Oui',
	'Class:IPSubnet/Attribute:ping_enabled/Value:no' => 'Non',
	'Class:IPSubnet/Attribute:iplookup_enabled' => 'IP lookup activé pour le sous-réseau',
	'Class:IPSubnet/Attribute:iplookup_enabled+' => '',
	'Class:IPSubnet/Attribute:iplookup_enabled/Value:yes' => 'Oui',
	'Class:IPSubnet/Attribute:iplookup_enabled/Value:no' => 'Non',
	'Class:IPSubnet/Attribute:scan_enabled' => 'Scan activé pour le sous-réseau',
	'Class:IPSubnet/Attribute:scan_enabled+' => '',
	'Class:IPSubnet/Attribute:scan_enabled/Value:yes' => 'Oui',
	'Class:IPSubnet/Attribute:scan_enabled/Value:no' => 'Non',
	'Class:IPSubnet/Attribute:ping_duration' => 'Durée du ping',
	'Class:IPSubnet/Attribute:ping_duration+' => 'Temps qu\'il a fallu pour \'pinger\' toutes les IPs du sous-réseau',
	'Class:IPSubnet/Attribute:iplookup_duration' => 'Durée de l\'IP lookup',
	'Class:IPSubnet/Attribute:iplookup_duration+' => 'Temps qu\'il a fallu pour faire un IP Lookup sur toutes les IPs du sous-réseau',
	'Class:IPSubnet/Attribute:scan_duration' => 'Durée du scan',
	'Class:IPSubnet/Attribute:scan_duration+' => 'Temps qu\'il a fallu pour \'scaner\' toutes les IPs du sous-réseau',
	'Class:IPSubnet/Attribute:ping_discovered' => 'Ping #',
	'Class:IPSubnet/Attribute:ping_discovered+' => 'Nombre d\'IPs découvertes par ping',
	'Class:IPSubnet/Attribute:iplookup_discovered' => 'IP lookup #',
	'Class:IPSubnet/Attribute:iplookup_discovered+' => 'Nombre d\'IPs découvertes par IP lookup',
	'Class:IPSubnet/Attribute:scan_discovered' => 'Scan #',
	'Class:IPSubnet/Attribute:scan_discovered+' => 'Nombre d\'IPs découvertes par scan',
	'Class:IPSubnet/Attribute:scan_cnx_refused_enabled' => 'Considère les scan "connexion refusée" comme valides',
	'Class:IPSubnet/Attribute:scan_cnx_refused_enabled+' => '',
	'Class:IPSubnet/Attribute:scan_cnx_refused_enabled/Value:yes' => 'Oui',
	'Class:IPSubnet/Attribute:scan_cnx_refused_enabled/Value:no' => 'Non',
	'Class:IPSubnet:discoveryapp' => 'Découverte: paramètres de l\'application',
	'Class:IPSubnet:discoverysubnet' => 'Découverte: paramètres du sous-réseau',
	'Class:IPSubnet:discoverystats' => 'Découverte: statistiques',
));

//
// Class: IPAddress
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPAddress/Attribute:last_discovery_date' => 'Date de dernière découverte',
	'Class:IPAddress/Attribute:last_discovery_date+' => 'Date à laquelle l\'adresse a été découverte pour la dernière fois',
	'Class:IPAddress/Attribute:responds_to_ping' => 'Répond au ping',
	'Class:IPAddress/Attribute:responds_to_ping+' => '',
	'Class:IPAddress/Attribute:responds_to_ping/Value:yes' => 'Oui',
	'Class:IPAddress/Attribute:responds_to_ping/Value:no' => 'Non',
	'Class:IPAddress/Attribute:responds_to_ping/Value:na' => 'N/A',
	'Class:IPAddress/Attribute:responds_to_iplookup' => 'Répond à l\'IP lookup',
	'Class:IPAddress/Attribute:responds_to_iplookup+' => '',
	'Class:IPAddress/Attribute:responds_to_iplookup/Value:yes' => 'Oui',
	'Class:IPAddress/Attribute:responds_to_iplookup/Value:no' => 'Non',
	'Class:IPAddress/Attribute:responds_to_iplookup/Value:na' => 'N/A',
	'Class:IPAddress/Attribute:fqdn_from_iplookup' => 'FQDN vu par l\'IP lookup',
	'Class:IPAddress/Attribute:fqdn_from_iplookup+' => '',
	'Class:IPAddress/Attribute:responds_to_scan' => 'Répond au scan',
	'Class:IPAddress/Attribute:responds_to_scan+' => '',
	'Class:IPAddress/Attribute:responds_to_scan/Value:yes' => 'Oui',
	'Class:IPAddress/Attribute:responds_to_scan/Value:no' => 'Non',
	'Class:IPAddress/Attribute:responds_to_scan/Value:cnx_refused' => 'Connexion refusée',
	'Class:IPAddress/Attribute:responds_to_scan/Value:na' => 'N/A',
	'Class:IPAddress:discoveryinfo' => 'Informations de découverte',
));

//
// Application Menu
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Menu:IPDiscovery' => 'Découverte IP',
	'Menu:IPDiscoveryApplication' => 'Applications de découverte IPs',
	'Menu:IPDiscoveryApplication+' => 'Toutes les applications de découverte IPs',
	'Menu:IPDiscovery:IPv4Statistics' => 'Statistiques IPv4',
	'Menu:IPDiscovery:IPv6Statistics' => 'Statistiques IPv6',
	'Menu:IPDiscovery:IPv4Status' => 'Adresses IPv4 par status',
	'Menu:IPDiscovery:IPv4Ping' => 'Adresses IPv4 qui \'ping\'',
	'Menu:IPDiscovery:IPv4Scan' => 'Adresses IPv4 qui répondent au scan',
	'Menu:IPDiscovery:IPv4Lookup' => 'Adresses IPv4 avec une entrée DNS',
	'Menu:IPDiscovery:IPv6Status' => 'Adresses IPv6 par status',
	'Menu:IPDiscovery:IPv6Ping' => 'Adresses IPv6 qui \'ping\'',
	'Menu:IPDiscovery:IPv6Scan' => 'Adresses IPv6 qui répondent au scan',
	'Menu:IPDiscovery:IPv6Lookup' => 'Addresses IPv6 avec une entrée DNS',
	'Menu:IPDiscovery:IPv4DiscoveredSubnets' => 'Sous-réseaux IPv4 liés à un application de découverte IPs',
	'Menu:IPDiscovery:IPv6DiscoveredSubnets' => 'Sous-réseaux IPv6 liés à un application de découverte IPs',
	
	'UI:IPDiscovery:Action:New:UUIDCollision' => 'L\'attribut UUIDs doit être unique !',
	'UI:IPDiscovery:Action:New:ScanWithNoPort' => 'Un numéro de port doit être spécifié quand la fonction de Scan est mise en oeuvre !'
));
