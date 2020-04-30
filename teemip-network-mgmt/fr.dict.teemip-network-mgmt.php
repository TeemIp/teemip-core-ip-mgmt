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
// Classes in 'Teemip-Network-Mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// Class: DNSObject
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:DNSObject' => 'Object DNS',
	'Class:DNSObject+' => '',
	'Class:DNSObject/Attribute:org_id' => 'Organisation',
	'Class:DNSObject/Attribute:org_id+' => '',
	'Class:DNSObject/Attribute:org_name' => 'Nom Organisation',
	'Class:DNSObject/Attribute:org_name+' => '',
	'Class:DNSObject/Attribute:name' => 'Nom Object DNS',
	'Class:DNSObject/Attribute:name+' => '',
	'Class:DNSObject/Attribute:comment' => 'Description',
	'Class:DNSObject/Attribute:comment+' => '',
));

//
// Class: Domain
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:Domain' => 'Domaine',
	'Class:Domain+' => 'Domaine DNS',
	'Class:Domain:baseinfo' => 'Informations Générales',
	'Class:Domain:admininfo' => 'Informations Administratives',
	'Class:Domain:DelegatedToChild' => '<font color=#ff0000>Délégué à l\'organisation : </font>%1$s',
	'Class:Domain:DelegatedFromParent' => '<font color=#ff0000>Délégué de l\'organisation : </font>%1$s',
	'Class:Domain/Attribute:name' => 'Nom',
	'Class:Domain/Attribute:name+' => '',
	'Class:Domain/Attribute:parent_org_id' => 'Délégué de',
	'Class:Domain/Attribute:parent_org_id+' => 'Organisation d\'ou a été délégué le domaine',
	'Class:Domain/Attribute:parent_org_name' => 'Nom organisation délégante',
	'Class:Domain/Attribute:parent_org_name+' => 'Nom de l\'organisation ayant délégué le domaine',
	'Class:Domain/Attribute:parent_id' => 'Parent',
	'Class:Domain/Attribute:parent_id+' => '',
	'Class:Domain/Attribute:parent_name' => 'Nom Parent',
	'Class:Domain/Attribute:parent_name+' => '',
	'Class:Domain/Attribute:requestor_id' => 'Demandeur',
	'Class:Domain/Attribute:requestor_id+' => '',
	'Class:Domain/Attribute:requestor_name' => 'Nom Demandeur',
	'Class:Domain/Attribute:requestor_name+' => '',
	'Class:Domain/Attribute:release_date' => 'Date de libération',
	'Class:Domain/Attribute:release_date+' => 'Date à laquelle le domaine a été libéré et n\'est plus utilisé.',
	'Class:Domain/Attribute:registrar_id' => 'Registre Internet',
	'Class:Domain/Attribute:registrar_id+' => 'Organisation en charge de l\'allocation des noms de domaines.',
	'Class:Domain/Attribute:registrar_name' => 'Nom Registre Internet',
	'Class:Domain/Attribute:registrar_name+' => '',
	'Class:Domain/Attribute:validity_start' => 'Date de début de validité',
	'Class:Domain/Attribute:validity_start+' => 'Date après laquelle le domaine est valide.',
	'Class:Domain/Attribute:validity_end' => 'Date de fin de validité',
	'Class:Domain/Attribute:validity_end+' => 'Date après laquelle le domaine n\'est plus valide.',
	'Class:Domain/Attribute:renewal' => 'Renouvellement',
	'Class:Domain/Attribute:renewal+' => 'Méthode de renouvellement',
	'Class:Domain/Attribute:renewal/Value:na' => 'Non Applicable',
	'Class:Domain/Attribute:renewal/Value:manual' => 'Manuelle',
	'Class:Domain/Attribute:renewal/Value:automatic' => 'Automatique',
));

//
// Class extensions for Domain
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:Domain/Tab:hosts' => 'Hosts',
	'Class:Domain/Tab:hosts+' => 'Hosts appartenant au domaine',
	'Class:Domain/Tab:hosts/List0' => 'Hosts appartenant au domaine et à ses enfants',
	'Class:Domain/Tab:hosts/SelectList0' => 'Afficher les  hosts appartenant au domaine et à ses enfants',
	'Class:Domain/Tab:hosts/List1' => 'Hosts attachés directement au domaine seulement',
	'Class:Domain/Tab:hosts/SelectList1' => 'Afficher les hosts attachés directement au domaine seulement',
	'Class:Domain/Tab:hosts/List2' => 'Hosts attachés aux domaines enfants seulement',
	'Class:Domain/Tab:hosts/SelectList2' => 'Afficher les hosts attachés aux domaines enfants seulement',
	'Class:Domain/Tab:hosts/SelectList' => 'Changer l\'affichage',
	'Class:Domain/Tab:child_domain' => 'Domaines enfants',
	'Class:Domain/Tab:child_domain+' => 'Domaines directement attachés',
	'Class:Domain/Tab:zones_list' => 'Zones associées',
	'Class:Domain/Tab:zones_list+' => 'Zones associées au domaine',
));

//
// Class: WANLink
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:WANLink' => 'Lien WAN',
	'Class:WANLink+' => '',
	'Class:WANLink:baseinfo' => 'Informations Générales',
	'Class:WANLink:networkinfo' => 'Informations Réseau',
	'Class:WANLink:admininfo' => 'Informations Administratives',
	'Class:WANLink:locationinfo' => 'Sites',
	'Class:WANLink:dateinfo' => 'Dates',
	'Class:WANLink/Attribute:type_id' => 'Type',
	'Class:WANLink/Attribute:type_id+' => '',
	'Class:WANLink/Attribute:type_name' => 'Nom Type',
	'Class:WANLink/Attribute:type_name+' => '',
	'Class:WANLink/Attribute:rate' => 'Débit',
	'Class:WANLink/Attribute:rate+' => '',
	'Class:WANLink/Attribute:burst_rate' => 'Débit de débordement',
	'Class:WANLink/Attribute:burst_rate+' => '',
	'Class:WANLink/Attribute:underlying_rate' => 'Débit réel',
	'Class:WANLink/Attribute:underlying_rate+' => '',
	'Class:WANLink/Attribute:status' => 'Etat',
	'Class:WANLink/Attribute:status+' => '',
	'Class:WANLink/Attribute:status/Value:implementation' => 'Implémentation',
	'Class:WANLink/Attribute:status/Value:implementation+' => '',
	'Class:WANLink/Attribute:status/Value:production' => 'Production',
	'Class:WANLink/Attribute:status/Value:production+' => '',
	'Class:WANLink/Attribute:status/Value:obsolete' => 'Obsolète',
	'Class:WANLink/Attribute:status/Value:obsolete+' => '',
	'Class:WANLink/Attribute:status/Value:stock' => 'En stock',
	'Class:WANLink/Attribute:status/Value:stock+' => '',
	'Class:WANLink/Attribute:location_id1' => 'Site #1',
	'Class:WANLink/Attribute:location_id1+' => 'Site à un bout du lien',
	'Class:WANLink/Attribute:location_name1' => 'Nom du site #1',
	'Class:WANLink/Attribute:location_name1+' => '',
	'Class:WANLink/Attribute:location_id2' => 'Site #2',
	'Class:WANLink/Attribute:location_id2+' => 'Site à l\'autre bout',
	'Class:WANLink/Attribute:location_name2' => 'Nom du site #2',
	'Class:WANLink/Attribute:location_name2+' => '',
	'Class:WANLink/Attribute:carrier_id' => 'Opérateur',
	'Class:WANLink/Attribute:carrier_id+' => '',
	'Class:WANLink/Attribute:carrier_name' => 'Nom opérateur',
	'Class:WANLink/Attribute:carrier_name+' => '',
	'Class:WANLink/Attribute:carrier_reference' => 'Référence Opérateur',
	'Class:WANLink/Attribute:carrier_reference+' => '',
	'Class:WANLink/Attribute:internal_reference' => 'Référence Interne',
	'Class:WANLink/Attribute:internal_reference+' => '',
	'Class:WANLink/Attribute:networkinterface_id1' => 'Interface réseau #1',
	'Class:WANLink/Attribute:networkinterface_id1+' => 'Interface réseau au site #1',
	'Class:WANLink/Attribute:networkinterface_name1' => 'Nom de l\'interface réseau #1',
	'Class:WANLink/Attribute:networkinterface_name1+' => '',
	'Class:WANLink/Attribute:networkinterface_id2' => 'Interface réseau #2',
	'Class:WANLink/Attribute:networkinterface_id2+' => 'Interface réseau au site #2',
	'Class:WANLink/Attribute:networkinterface_name2' => 'Nom de l\'interface réseau #2',
	'Class:WANLink/Attribute:networkinterface_name2+' => '',
	'Class:WANLink/Attribute:purchase_date' => 'Date de commande',
	'Class:WANLink/Attribute:purchase_date+' => '',
	'Class:WANLink/Attribute:renewal_date' => 'Date de renouvellement',
	'Class:WANLink/Attribute:renewal_date+' => '',
	'Class:WANLink/Attribute:decommissioning_date' => 'Date de désaffectation',
	'Class:WANLink/Attribute:decommissioning_date+' => '',
));

//
// Class: WANType
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:WANType' => 'Type du lien WAN',
	'Class:WANType+' => '',
	'Class:WANType/Attribute:description' => 'Description',
	'Class:WANType/Attribute:description+' => '',
));

//
// Class: ASNumber
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Class:ASNumber' => 'Numéro d\'AS',
	'Class:ASNumber+' => 'Numéro de Système Autonome',
	'Class:ASNumber:baseinfo' => 'Information Générale',
	'Class:ASNumber:admininfo' => 'Information Administrative',
	'Class:ASNumber/Attribute:number' => 'Numéro',
	'Class:ASNumber/Attribute:number+' => '',
	'Class:ASNumber/Attribute:registrar_id' => 'Registre Internet',
	'Class:ASNumber/Attribute:registrar_id+' => '',
	'Class:ASNumber/Attribute:registrar_name' => 'Registrar Name',
	'Class:ASNumber/Attribute:registrar_name+' => '',
	'Class:ASNumber/Attribute:whois' => 'Whois',
	'Class:ASNumber/Attribute:whois+' => 'URL vers le whois du registre',
	'Class:ASNumber/Attribute:move2production' => 'Date d\'enregistrement',
	'Class:ASNumber/Attribute:move2production+' => 'Date à laquelle l\'AS a été enregistré.',
	'Class:ASNumber/Attribute:validity_end' => 'Date de fin de validité',
	'Class:ASNumber/Attribute:validity_end+' => 'Date après laquelle l\'AS n\'est plus valide.',
	'Class:ASNumber/Attribute:renewal_date' => 'Date de renouvellement',
	'Class:ASNumber/Attribute:renewal_date+' => 'Date à laquelle l\'AS a été renouvelé.',
));

//
// Class: VRF
//

Dict::Add('FR FR', 'English', 'English', array(
	'Class:VRF' => 'VRF',
	'Class:VRF+' => 'Virtual Routing and Forwarding',
	'Class:VRF:baseinfo' => 'Information Générale',
	'Class:VRF/Attribute:route_dist' => 'Route Distinguisher',
	'Class:VRF/Attribute:route_dist+' => '',
	'Class:VRF/Attribute:route_trgt' => 'Route Target',
	'Class:VRF/Attribute:route_trgt+' => '',
	'Class:VRF/Attribute:subnets_list' => 'Sous-réseaux',
	'Class:VRF/Attribute:subnets_list+' => '',
	'Class:VRF/Attribute:physicalinterfaces_list' => 'Interfaces réseaux physiques',
	'Class:VRF/Attribute:physicalinterfaces_list+' => '',
));

//
// Class extensions for VRF
//

Dict::Add('FR FR', 'English', 'English', array(
	'Class:VRF/Tab:ipaddresses_list' => 'IPs des Interfaces',
	'Class:VRF/Tab:ipaddresses_list+' => 'Liste de toutes les adresses IP de toutes les interfaces attachées au CI',
));

//
// Class: lnkPhysicalInterfaceToVRF
//

Dict::Add('FR FR', 'English', 'English', array(
	'Class:lnkPhysicalInterfaceToVRF' => 'Lien Interface réseau / VRF',
	'Class:lnkPhysicalInterfaceToVRF+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id' => 'Interface réseau',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name' => 'Nom interface réseau',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id' => 'Equipement',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name' => 'Nom équipement',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:name' => 'Nom',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:name+' => '',
));

//
// Application Menu
//

Dict::Add('FR FR', 'French', 'Français', array(
	'Menu:ConfigManagement:Network' => 'Réseau',
	'Menu:ConfigManagement:Network+' => '',

//
// Management of Domains
//
	// Creation Management	
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'Le nom de domain existe déjà !',

	// Update Management
	'UI:IPManagement:Action:ChangeOrg:Domain:HasParentInOtherOrg' => 'L\'organisation ne peut changer : le domaine parent n\'appartient pas à la nouvelle organisation !',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasChildren' => 'L\'organisation ne peut changer : le domaine a des sous-domaines !',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasHosts' => 'L\'organisation ne peut changer : des hosts de l\'organisation initiale utilisent le domaine !',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasZones' => 'L\'organisation ne peut changer : des zones pointent vers ce domaine !',

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

	// Delegate action on domains
	'UI:IPManagement:Action:Delegate:Domain' => 'Déléguer',
	'UI:IPManagement:Action:Delegate:Domain:PageTitle_Object_Class' => '%1$s - Déléguer',
	'UI:IPManagement:Action:Delegate:Domain:Title_Class_Object' => 'Délègue %1$s <span class="hilite">%2$s</span> à l\' organisation',
	'UI:IPManagement:Action:Delegate:Domain:ChildDomain' => 'Organisation à qui déléguer le domaine :',
	'UI:IPManagement:Action:Delegate:Domain:NoChildOrg' => 'L\'organisation dont dépend le domaine n\'a pas de fille. Le domaine ne peut donc être délégué !',
	'UI:IPManagement:Action:Delegate:Domain:NoOtherOrg' => 'Il n\'existe aucune autre organisation que celle à laquelle le domaine appartient !',
	'UI:IPManagement:Action:Delegate:Domain:IsDelegated' => 'Le domaine est déjà délégué !',
	'UI:IPManagement:Action:Delegate:Domain:CannotBeDelegated' => 'Le domaine ne peut être délégué : %1$s',
	'UI:IPManagement:Action:Delegate:Domain:NoChangeOfOrganization' => 'L\'organisation de délégation doit être différente de celle du domaine !',
	'UI:IPManagement:Action:Delegate:Domain:HasHosts' => 'Le domaine a des hosts !',
	'UI:IPManagement:Action:Delegate:Domain:HasSubDomains' => 'Le domaine a des sous-domaines !',
	'UI:IPManagement:Action:Delegate:Domain:HasZones' => 'Des zones font référence à ce domaine !',
	'UI:IPManagement:Action:Delegate:Domain:Done' => '%1$s <span class="hilite">%2$s</span> a été délégué.',

	// Undelegate action on domains
	'UI:IPManagement:Action:Undelegate:Domain' => 'Retirer la délégation',
	'UI:IPManagement:Action:Undelegate:Domain:PageTitle_Object_Class' => '%1$s - Retirer',
	'UI:IPManagement:Action:Undelegate:Domain:CannotBeUndelegated' => 'La délégation ne peut être retirée au domaine: %1$s',
	'UI:IPManagement:Action:Undelegate:Domain:IsNotDelegated' => 'Le domaine n\'est pas délégué !',
	'UI:IPManagement:Action:Undelegate:Domain:HasHosts' => 'Le domaine a des hosts !',
	'UI:IPManagement:Action:Undelegate:Domain:HasSubDomains' => 'Le domaine a des sous-domaines !',
	'UI:IPManagement:Action:Undelegate:Domain:HasZones' => 'Des zones font référence à ce domaine !',
	'UI:IPManagement:Action:Undelegate:Domain:Done' => '%1$s <span class="hilite">%2$s</span> a eu sa délégation retirée.',

));
