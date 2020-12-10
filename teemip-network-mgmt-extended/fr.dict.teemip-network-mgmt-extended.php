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
// Classes in 'teemip-network-mgmt-extended Module'
//////////////////////////////////////////////////////////////////////
//

//
// Class: InterfaceConnector
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:InterfaceConnector' => 'Connecteur d\'interface',
	'Class:InterfaceConnector+' => 'Connecteur utilisé sur les interfaces réseau',
	'Class:InterfaceConnector/Attribute:description' => 'Description',
	'Class:InterfaceConnector/Attribute:description+' => '',
	'Class:InterfaceConnector/Attribute:physicalinterfaces_list' => 'Interfaces physiques',
	'Class:InterfaceConnector/Attribute:physicalinterfaces_list+' => '',
));

//
// Class: Layer2Protocol
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:Layer2Protocol' => 'Protocole de niveau 2',
	'Class:Layer2Protocol+' => 'Protocole de niveau 2 utilisé sur les interfaces réseau',
	'Class:Layer2Protocol/Attribute:description' => 'Description',
	'Class:Layer2Protocol/Attribute:description+' => '',
	'Class:Layer2Protocol/Attribute:ipinterfaces_list' => 'Interfaces réseau',
	'Class:Layer2Protocol/Attribute:ipinterfaces_list+' => '',
));

//
// Class: InterfaceSpeed
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:InterfaceSpeed' => 'Vitesse de l\'Interface',
	'Class:InterfaceSpeed+' => 'Vitesse utilisée sur les interfaces réseau',
	'Class:InterfaceSpeed/Attribute:description' => 'Description',
	'Class:InterfaceSpeed/Attribute:description+' => '',
	'Class:InterfaceSpeed/Attribute:ipinterfaces_list' => 'Interfaces réseau',
	'Class:InterfaceSpeed/Attribute:ipinterfaces_list+' => '',
));

//
// Class: IPInterface
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:IPInterface/Attribute:interfacespeed_id' => 'Vitesse',
	'Class:IPInterface/Attribute:interfacespeed_id+' => '',
	'Class:IPInterface/Attribute:layer2protocol_id' => 'Protocole',
	'Class:IPInterface/Attribute:layer2protocol_id+' => 'Protocole de niveau 2',
));

//
// Class: ClusterNetwork
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:ClusterNetwork' => 'Cluster Réseau',
	'Class:ClusterNetwork+' => 'Cluster d\'équipements réseau',
	'Class:ClusterNetwork:baseinfo' => 'Informations Générales',
	'Class:ClusterNetwork:moreinfo' => 'Informations Complémentaires',
	'Class:ClusterNetwork:Date' => 'Dates',
	'Class:ClusterNetwork:otherinfo' => 'Autres Informations',
	'Class:ClusterNetwork/Attribute:type' => 'Type',
	'Class:ClusterNetwork/Attribute:type+' => '',
	'Class:ClusterNetwork/Attribute:type/Value:loadbalancing' => 'Répartition de charge',
	'Class:ClusterNetwork/Attribute:type/Value:loadbalancing+' => '',
	'Class:ClusterNetwork/Attribute:type/Value:highavailability' => 'Haute disponibilité',
	'Class:ClusterNetwork/Attribute:type/Value:highavailability+' => '',
	'Class:ClusterNetwork/Attribute:type/Value:highperformance' => 'Haute performance',
	'Class:ClusterNetwork/Attribute:type/Value:highperformance+' => '',
	'Class:ClusterNetwork/Attribute:mode' => 'Mode',
	'Class:ClusterNetwork/Attribute:mode+' => '',
	'Class:ClusterNetwork/Attribute:mode/Value:active_standby' => 'Actif / Standby',
	'Class:ClusterNetwork/Attribute:mode/Value:active_standby+' => '',
	'Class:ClusterNetwork/Attribute:mode/Value:active_passive' => 'Actif / Passif',
	'Class:ClusterNetwork/Attribute:mode/Value:active_passive+' => '',
	'Class:ClusterNetwork/Attribute:mode/Value:active_active' => 'Actif / Actif',
	'Class:ClusterNetwork/Attribute:mode/Value:active_active+' => '',
	'Class:ClusterNetwork/Attribute:status' => 'Statut',
	'Class:ClusterNetwork/Attribute:status+' => '',
	'Class:ClusterNetwork/Attribute:status/Value:production' => 'Production',
	'Class:ClusterNetwork/Attribute:status/Value:production+' => '',
	'Class:ClusterNetwork/Attribute:status/Value:implementation' => 'Implémentation',
	'Class:ClusterNetwork/Attribute:status/Value:implementation+' => '',
	'Class:ClusterNetwork/Attribute:networkdevices_list' => 'Nœuds',
	'Class:ClusterNetwork/Attribute:networkdevices_list+' => 'Liste de tous les équipements réseau du cluster',
	'Class:ClusterNetwork/Attribute:ips_list' => 'Adresses IP',
	'Class:ClusterNetwork/Attribute:ips_list+' => 'Liste de toutes les adresses IP utilisées par le cluster',
	'Class:ClusterNetwork/Attribute:redundancy' => 'Haute disponibilité',
	'Class:ClusterNetwork/Attribute:redundancy/disabled' => 'Le Cluster est opérationnel si tous les équipements réseau qui le composent sont opérationnels',
	'Class:ClusterNetwork/Attribute:redundancy/count' => 'Nombre minimal d\'équipements réseau pour que le Cluster soit opérationnel : %1$s',
	'Class:ClusterNetwork/Attribute:redundancy/percent' => 'Pourcentage minimal d\'équipements réseau pour que le Cluster soit opérationnel : %1$s %%',
	'Class:ClusterNetwork/Tab:connectablecis_list' => 'Equipements',
	'Class:ClusterNetwork/Tab:connectablecis_list+' => 'Liste de tous les matériels connectés au cluster',
));

//
// Class: lnkClusterNetworkToIPAddress
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:lnkClusterNetworkToIPAddress' => 'Lien Cluster Réseau / Adresse IP',
	'Class:lnkClusterNetworkToIPAddress+' => '',
	'Class:lnkClusterNetworkToIPAddress/Attribute:clusternetwork_id' => 'Cluster réseau',
	'Class:lnkClusterNetworkToIPAddress/Attribute:clusternetwork_id+' => '',
	'Class:lnkClusterNetworkToIPAddress/Attribute:clusternetwork_name' => 'Nom du cluster réseau',
	'Class:lnkClusterNetworkToIPAddress/Attribute:clusternetwork_name+' => '',
	'Class:lnkClusterNetworkToIPAddress/Attribute:ipaddress_id' => 'Adresse IP',
	'Class:lnkClusterNetworkToIPAddress/Attribute:ipaddress_id+' => '',
	'Class:lnkClusterNetworkToIPAddress/Attribute:usage_id' => 'Utilisation',
	'Class:lnkClusterNetworkToIPAddress/Attribute:usage_id+' => '',
));

//
// Class: NetworkDeviceComponent
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:NetworkDeviceComponent' => 'Composant d\'Equipement Réseau',
	'Class:NetworkDeviceComponent+' => 'Composant matériel pour les équipements réseau',
	'Class:NetworkDeviceComponent:baseinfo' => 'Informations Générales',
	'Class:NetworkDeviceComponent:moreinfo' => 'Informations Complémentaires',
	'Class:NetworkDeviceComponent:Date' => 'Dates',
	'Class:NetworkDeviceComponent:otherinfo' => 'Autres Informations',
	'Class:NetworkDeviceComponent/Attribute:networkdevice_id' => 'Equipement Réseau',
	'Class:NetworkDeviceComponent/Attribute:networkdevice_id+' => 'Equipement réseau qui héberge le composant',
	'Class:NetworkDeviceComponent/Attribute:networkdevice_name' => 'Nom de l\'équipement réseau',
	'Class:NetworkDeviceComponent/Attribute:networkdevice_name+' => '',
));

//
// Class: NetworkDevice
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:NetworkDevice/Attribute:clusternetwork_id' => 'Cluster réseau',
	'Class:NetworkDevice/Attribute:clusternetwork_id+' => 'Cluster réseau auquel appartient l\'équipement réseau',
	'Class:NetworkDevice/Attribute:clusternetwork_role' => 'Rôle cluster',
	'Class:NetworkDevice/Attribute:clusternetwork_role+' => 'Rôle de l\'équipement au sein du cluster',
	'Class:NetworkDevice/Attribute:clusternetwork_role/Value:active' => 'Actif',
	'Class:NetworkDevice/Attribute:clusternetwork_role/Value:active+' => '',
	'Class:NetworkDevice/Attribute:clusternetwork_role/Value:standby' => 'Standby',
	'Class:NetworkDevice/Attribute:clusternetwork_role/Value:standby+' => '',
	'Class:NetworkDevice/Attribute:networkdevicecomponents_list' => 'Composants',
	'Class:NetworkDevice/Attribute:networkdevicecomponents_list+' => 'Liste de tous les composants réseau attachés à cet équipement',
	'Class:NetworkDevice/Attribute:aggregatelinks_list' => 'Agrégats de Liens',
	'Class:NetworkDevice/Attribute:aggregatelinks_list+' => 'Liste de tous les agrégats de liens attachés à cet équipement',
));

//
// Class: Model
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:Model/Attribute:type/Value:NetworkDeviceComponent' => 'Composant d\'Equipement Réseau',
	'Class:Model/Attribute:type/Value:NetworkDeviceComponent+' => '',
));

//
// Class: AggregateLink
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:AggregateLink' => 'Agrégat de Liens',
	'Class:AggregateLink+' => 'Combine plusieurs connexions réseau en parallèle',
	'Class:AggregateLink:baseinfo' => 'Informations Générales',
	'Class:AggregateLink/Attribute:macaddress' => 'Adresse MAC',
	'Class:AggregateLink/Attribute:macaddress+' => '',
	'Class:AggregateLink/Attribute:layer2protocol_id' => 'Protocole',
	'Class:AggregateLink/Attribute:layer2protocol_id+' => 'Protocole de niveau 2',
	'Class:AggregateLink/Attribute:status' => 'Statut',
	'Class:AggregateLink/Attribute:status+' => '',
	'Class:AggregateLink/Attribute:status/Value:active' => 'Actif',
	'Class:AggregateLink/Attribute:status/Value:active+' => '',
	'Class:AggregateLink/Attribute:status/Value:inactive' => 'Inactif',
	'Class:AggregateLink/Attribute:status/Value:inactive+' => '',
	'Class:AggregateLink/Attribute:connectableci_id' => 'Equipement',
	'Class:AggregateLink/Attribute:connectableci_id+' => 'Equipement qui héberge l\'agrégat de liens',
	'Class:AggregateLink/Attribute:connectableci_name' => 'Nom de l\'équipement',
	'Class:AggregateLink/Attribute:connectableci_name+' => '',
	'Class:AggregateLink/Attribute:peer_id' => 'Agrégat pair',
	'Class:AggregateLink/Attribute:peer_id+' => 'Agrégat de liens de l\'équipement connecté à cet agrégat',
	'Class:AggregateLink/Attribute:description' => 'Description',
	'Class:AggregateLink/Attribute:description+' => '',
	'Class:AggregateLink/Attribute:physicalinterfaces_list' => 'Interfaces physiques',
	'Class:AggregateLink/Attribute:physicalinterfaces_list+' => '',
));

//
// Class: PhysicalInterface
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:PhysicalInterface/Attribute:interfaceconnector_id' => 'Connecteur',
	'Class:PhysicalInterface/Attribute:interfaceconnector_id+' => '',
	'Class:PhysicalInterface/Attribute:interfaceconnector_name' => 'Nom du connecteur',
	'Class:PhysicalInterface/Attribute:interfaceconnector_name+' => '',
	'Class:PhysicalInterface/Attribute:aggregatelink_id' => 'Agrégat de Liens',
	'Class:PhysicalInterface/Attribute:aggregatelink_id+' => '',
	'Class:PhysicalInterface/Attribute:aggregatelink_name' => 'Nom de l\'agrégat de liens',
	'Class:PhysicalInterface/Attribute:aggregatelink_name+' => '',
));

//
// Application Menu
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Menu:NetworkMgmtExtended:Typology' => 'Configuration des typologies réseau',
));


