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

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Core:AttributeIPPercentage' => 'Porcentaje IP',
	'Core:AttributeIPPercentage+' => 'Despliegue Gráfico de porcentaje de uso',
	'Core:AttributeMacAddress' => 'Dirección MAC',
	'Core:AttributeMacAddress+' => 'Cadena de Dirección MAC',
));

//
// Class: IPObject
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPObject' => 'Objeto IP',
	'Class:IPObject+' => '',
	'Class:IPObject/Attribute:org_id' => 'Organización',
	'Class:IPObject/Attribute:org_id+' => '',
	'Class:IPObject/Attribute:org_name' => 'Nombre',
	'Class:IPObject/Attribute:org_name+' => '',
	'Class:IPObject/Attribute:status' => 'Estatus',
	'Class:IPObject/Attribute:status+' => '',
	'Class:IPObject/Attribute:status/Value:reserved' => 'Reservado',
	'Class:IPObject/Attribute:status/Value:reserved+' => '',
	'Class:IPObject/Attribute:status/Value:allocated' => 'Asignado',
	'Class:IPObject/Attribute:status/Value:allocated+' => '',
	'Class:IPObject/Attribute:status/Value:released' => 'Liberado',
	'Class:IPObject/Attribute:status/Value:released+' => '',
	'Class:IPObject/Attribute:status/Value:unassigned' => 'No Asignado',
	'Class:IPObject/Attribute:status/Value:unassigned+' => '',
	'Class:IPObject/Attribute:comment' => 'Nota',
	'Class:IPObject/Attribute:comment+' => '',
	'Class:IPObject/Attribute:requestor_id' => 'Solicitante',
	'Class:IPObject/Attribute:requestor_id+' => '',
	'Class:IPObject/Attribute:requestor_name' => 'Nombre',
	'Class:IPObject/Attribute:requestor_name+' => '',
	'Class:IPObject/Attribute:allocation_date' => 'Fecha de Asignación',
	'Class:IPObject/Attribute:allocation_date+' => 'Date when IP object has been allocated',
	'Class:IPObject/Attribute:release_date' => 'Fecha Liberación',
	'Class:IPObject/Attribute:release_date+' => 'Date when IP object has been released and is not used anymore.',
	'Class:IPObject/Attribute:contact_list' => 'Contactos',
	'Class:IPObject/Attribute:contact_list+' => 'Contacts attached to the IP object',
	'Class:IPObject/Attribute:document_list' => 'Documentos',
	'Class:IPObject/Attribute:document_list+' => 'Documents attached to the IP object',
));

//
// Class: lnkContactToIPObject
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:lnkContactToIPObject' => 'Relación Contacto / Objeto IP',
	'Class:lnkContactToIPObject+' => '',
	'Class:lnkContactToIPObject/Attribute:ipobject_id' => 'Objeto IP',
	'Class:lnkContactToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_id' => 'Contacto',
	'Class:lnkContactToIPObject/Attribute:contact_id+' => '',
	'Class:lnkContactToIPObject/Attribute:contact_name' => 'Nombre',
	'Class:lnkContactToIPObject/Attribute:contact_name+' => '',
));

//
// Class: lnkDocToIPObject
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:lnkDocToIPObject' => 'Relación Documento / Objeto IP',
	'Class:lnkDocToIPObject+' => '',
	'Class:lnkDocToIPObject/Attribute:ipobject_id' => 'Objeto IP',
	'Class:lnkDocToIPObject/Attribute:ipobject_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_id' => 'Documento',
	'Class:lnkDocToIPObject/Attribute:document_id+' => '',
	'Class:lnkDocToIPObject/Attribute:document_name' => 'Nombre',
	'Class:lnkDocToIPObject/Attribute:document_name+' => '',
));

//
// Class: lnkIPObjectToTicket
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:lnkIPObjectToTicket' => 'Relación Objeto IP / Ticket',
	'Class:lnkIPObjectToTicket+' => '',
	'Class:lnkIPObjectToTicket/Attribute:ipobject_id_finalclass_recall' => 'Tipo Objeto IP',
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

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPBlock' => 'Bloque de Subred',
	'Class:IPBlock+' => '',
	'Class:IPBlock:baseinfo' => 'Información General',
	'Class:IPBlock:ipinfo' => 'Información IP',
	'Class:IPBlock:DelegatedToChild' => '<font color=#ff0000>Delegado a organización : </font>%1$s',
	'Class:IPBlock:DelegatedFromParent' => '<font color=#ff0000>Delegado de organización : </font>%1$s',
	'Class:IPBlock/Attribute:name' => 'Nombre',
	'Class:IPBlock/Attribute:name+' => '',
	'Class:IPBlock/Attribute:type' => 'Tipo',
	'Class:IPBlock/Attribute:type+' => 'Type of Subnet Block',
	'Class:IPBlock/Attribute:allocation_date' => 'Fecha de Asignación',
	'Class:IPBlock/Attribute:allocation_date+' => 'Date when Subnet Block has been allocated',
	'Class:IPBlock/Attribute:parent_org_id' => 'Delegado de ',
	'Class:IPBlock/Attribute:parent_org_id+' => 'Organization where the Subnet Block has been delegated from',
	'Class:IPBlock/Attribute:parent_org_name' => 'Nombre de Organización DeleganteDele',
	'Class:IPBlock/Attribute:parent_org_name+' => 'Name of the organization where the Subnet Block has been delegated from',
	'Class:IPBlock/Attribute:occupancy' => 'Espacio Usado',
	'Class:IPBlock/Attribute:occupancy+' => '',
	'Class:IPBlock/Attribute:children_occupancy' => 'Espacio usado por hijos',
	'Class:IPBlock/Attribute:children_occupancy+' => '',
	'Class:IPBlock/Attribute:subnet_occupancy' => 'Espacio usado por subredes',
	'Class:IPBlock/Attribute:subnet_occupancy+' => '',
	'Class:IPBlock/Attribute:location_list' => 'Localidades',
	'Class:IPBlock/Attribute:location_list+' => 'Locations where the Subnet Block expands',
));

//
// Class extensions for IPBlock
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPBlock/Tab:globalparam' => 'Configuraciones Globales',
	'Class:IPBlock/Tab:childblock' => 'Bloques Hijos',
	'Class:IPBlock/Tab:childblock+' => 'Bloques unidos a este bloque',
	'Class:IPBlock/Tab:childblock-count' => 'Bloques Hijos : %1$s',
	'Class:IPBlock/Tab:childblock-count-percent' => ' Espacio usado por Bloques Hijos.',
	'Class:IPBlock/Tab:childblock-count-percent-remain' => 'Espacio usado por Bloques Hijos en espacio restante: %1$.1f %%',
	'Class:IPBlock/Tab:subnet' => 'Subredes',
	'Class:IPBlock/Tab:subnet+' => 'Subredes unidas a este bloque',
	'Class:IPBlock/Tab:subnet-count' => 'Subredes : %1$s',
	'Class:IPBlock/Tab:subnet-count-percent' => ' espacio usado por Subredes',
	'Class:IPBlock/Tab:subnet-count-percent-remain' => 'Espacio usado por Subredes en espacio restante : %1$.1f %%',
));

//
// Class: lnkBlockToLocation
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:lnkIPBlockToLocation' => 'Relación Bloque / Localidad',
	'Class:lnkIPBlockToLocation+' => '',
	'Class:lnkIPBlockToLocation/Attribute:block_id' => 'Bloque',
	'Class:lnkIPBlockToLocation/Attribute:block_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:block_name' => 'Nombre Bloque',
	'Class:lnkIPBlockToLocation/Attribute:block_name+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_id' => 'Localidades',
	'Class:lnkIPBlockToLocation/Attribute:location_id+' => '',
	'Class:lnkIPBlockToLocation/Attribute:location_name' => 'Nombre localidad',
	'Class:lnkIPBlockToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Block
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPv4Block' => 'Bloque Subred IPv4',
	'Class:IPv4Block+' => '',
	'Class:IPv4Block/Attribute:parent_id' => 'Padre',
	'Class:IPv4Block/Attribute:parent_id+' => '',
	'Class:IPv4Block/Attribute:parent_name' => 'Nombre Padre',
	'Class:IPv4Block/Attribute:parent_name+' => '',
	'Class:IPv4Block/Attribute:firstip' => 'Primera IP',
	'Class:IPv4Block/Attribute:firstip+' => 'First IP Address of Subnet Block',
	'Class:IPv4Block/Attribute:lastip' => 'Última IP',
	'Class:IPv4Block/Attribute:lastip+' => 'Last IP Address of Subnet Block',
));

//
// Class: IPSubnet
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPSubnet' => 'Subred',
	'Class:IPSubnet+' => '',
	'Class:IPSubnet:baseinfo' => 'Información General',
	'Class:IPSubnet:ipinfo' => 'IP Información',
	'Class:IPSubnet/Attribute:name' => 'Nombre',
	'Class:IPSubnet/Attribute:name+' => '',
	'Class:IPSubnet/Attribute:type' => 'Tipo',
	'Class:IPSubnet/Attribute:type+' => '',
	'Class:IPSubnet/Attribute:allocation_date' => 'Fecha Asignación',
	'Class:IPSubnet/Attribute:allocation_date+' => 'Date when Subnet has been allocated',
	'Class:IPSubnet/Attribute:release_date' => 'Fecha Liberación',
	'Class:IPSubnet/Attribute:release_date+' => 'Date when subnet has been released and is not used anymore.',
	'Class:IPSubnet/Attribute:ip_occupancy' => 'IPs Registradas',
	'Class:IPSubnet/Attribute:ip_occupancy+' => '',
	'Class:IPSubnet/Attribute:range_occupancy' => 'Registered Ranges',
	'Class:IPSubnet/Attribute:range_occupancy+' => '',                         
	'Class:IPSubnet/Attribute:alarm_water_mark' => 'Estatus de alarmas de marcas de agua',
	'Class:IPSubnet/Attribute:alarm_water_mark+' => '',                              
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:no_alarm' => 'No se han enviado alertamientos',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:low_sent' => 'Alertamiento de baja marca de agua ha sido enviado',
	'Class:IPSubnet/Attribute:alarm_water_mark/Value:high_sent' => 'Alertamiento de alta marca de agua ha sido enviado',
	'Class:IPSubnet/Attribute:subnets_list' => 'Subreds con NAT',
	'Class:IPSubnet/Attribute:subnets_list+' => 'List de subreds con NAT',
	'Class:IPSubnet/Attribute:vlans_list' => 'VLANs',
	'Class:IPSubnet/Attribute:vlans_list+' => '',
	'Class:IPSubnet/Attribute:vrfs_list' => 'VRFs',
	'Class:IPSubnet/Attribute:vrfs_list+' => '',
	'Class:IPSubnet/Attribute:location_list' => 'Localidades',
	'Class:IPSubnet/Attribute:location_list+' => 'Locations where the Subnet expands',
	'Class:IPSubnet/Attribute:summary/cell0' => 'IP registrados por estatus',
	'Class:IPSubnet/Attribute:summary/cell0+' => 'Total: %1$s',
));

//
// Class extensions for IPSubnet
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPSubnet/Tab:globalparam' => 'Configuraciones Globales',
	'Class:IPSubnet/Tab:ipregistered' => 'IPs Registradas',
	'Class:IPSubnet/Tab:ipregistered+' => 'IPs registradas en la Subred',
	'Class:IPSubnet/Tab:ipregistered-count' => ' - %1$s reservadas, %2$s asignadas, %3$s Liberado, %4$s No Asignado de %5$s',
	'Class:IPSubnet/Tab:ipfree-explain' => 'Lista de primeras %1$s direcciones IP libres:',
	'Class:IPSubnet/Tab:ipfree-explainbis' => 'Lista de TODAS las direcciones IP libres:',
	'Class:IPSubnet/Tab:iprange' => 'Rangos de IP',
	'Class:IPSubnet/Tab:iprange+' => 'IP Ranges part of the subnet',
	'Class:IPSubnet/Tab:iprange-count-percent' => ' espacio usado por rang de IPs.',
	'Class:IPSubnet/Tab:notifications' => 'Notificaciones',
	'Class:IPSubnet/Tab:notifications+' => 'Notificaciones relacionadas con esta subred',
	'Class:IPSubnet/Tab:requests' => 'Requerimientos de IP',
	'Class:IPSubnet/Tab:requests+' => 'IP Requests related to this subnet',
	'Class:IPSubnet/Tab:changes' => 'Cambios de IP',
	'Class:IPSubnet/Tab:changes+' => 'IP Changes related to this subnet',
));

//
// Class: lnkIPSubnetToIPSubnet
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:lnkIPSubnetToIPSubnet' => 'Relación Subred / NAT Subred',
	'Class:lnkIPSubnetToIPSubnet+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall' => 'Tipo de Subred',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id' => 'Subred',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_id+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id' => 'NAT Subred',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_id+' => '',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name' => 'Nombre',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet1_name+' => 'Nombre Subred',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name' => 'Nombre',
	'Class:lnkIPSubnetToIPSubnet/Attribute:ipsubnet2_name+' => 'Nombre Subred',
));

//
// Class: lnkIPSubnetToVLAN
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:lnkIPSubnetToVLAN' => 'Relación Subred / VLAN',
	'Class:lnkIPSubnetToVLAN+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall' => 'Tipo de Subred',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id' => 'Subred',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name' => 'Nombre Subred',
	'Class:lnkIPSubnetToVLAN/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag' => 'VLAN Tag',
	'Class:lnkIPSubnetToVLAN/Attribute:vlan_tag+' => '',
));

//
// Class: lnkIPSubnetToVRF
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:lnkIPSubnetToVRF' => 'Relación Subred / VRF',
	'Class:lnkIPSubnetToVRF+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall' => 'Tipo de Subred',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id_finalclass_recall+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id' => 'Subred',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name' => 'Nombre Subred',
	'Class:lnkIPSubnetToVRF/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkIPSubnetToVRF/Attribute:vrf_id+' => '',
));

//
// Class: lnkIPSubnetToLocation
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:lnkIPSubnetToLocation' => 'Relación Subnet / Localidad',
	'Class:lnkIPSubnetToLocation+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id' => 'Subred',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name' => 'Nombre Subred',
	'Class:lnkIPSubnetToLocation/Attribute:ipsubnet_name+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_id' => 'Localidad',
	'Class:lnkIPSubnetToLocation/Attribute:location_id+' => '',
	'Class:lnkIPSubnetToLocation/Attribute:location_name' => 'Nombre Localidad',
	'Class:lnkIPSubnetToLocation/Attribute:location_name+' => '',
));

//
// Class: IPv4Subnet
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPv4Subnet' => 'Subred IPv4',
	'Class:IPv4Subnet+' => '',
	'Class:IPv4Subnet/Attribute:block_id' => 'Bloque de Subred',
	'Class:IPv4Subnet/Attribute:block_id+' => '',
	'Class:IPv4Subnet/Attribute:block_name' => 'Nombre de Bloque',
	'Class:IPv4Subnet/Attribute:block_name+' => '',
	'Class:IPv4Subnet/Attribute:ip' => 'IP de Subred',
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
	'Class:IPv4Subnet/Attribute:gatewayip' => 'Gateway IP',
	'Class:IPv4Subnet/Attribute:gatewayip+' => '',
	'Class:IPv4Subnet/Attribute:broadcastip' => 'Broadcast IP',
	'Class:IPv4Subnet/Attribute:broadcastip+' => '',
	'Class:IPv4Subnet/Attribute:summary' => 'Resumen',
));

//
// Class: IPRange
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPRange' => 'Rango de IP',
	'Class:IPRange+' => '',
	'Class:IPRange:baseinfo' => 'Información General',
	'Class:IPRange:ipinfo' => 'Información IP',
	'Class:IPRange/Attribute:range' => 'Nombre',
	'Class:IPRange/Attribute:range+' => '',
	'Class:IPRange/Attribute:usage_id' => 'Uso',
	'Class:IPRange/Attribute:usage_id+' => 'Usage being made of the range',
	'Class:IPRange/Attribute:usage_name' => 'Nombre de Uso',
	'Class:IPRange/Attribute:usage_name+' => '',
	'Class:IPRange/Attribute:allocation_date' => 'Fecha de Asignación',
	'Class:IPRange/Attribute:allocation_date+' => 'Date when IP range has been allocated',
	'Class:IPRange/Attribute:dhcp' => 'Rango DHCP',
	'Class:IPRange/Attribute:dhcp+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no' => 'No',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_no+' => '',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes' => 'Si',
	'Class:IPRange/Attribute:dhcp/Value:dhcp_yes+' => '',
	'Class:IPRange/Attribute:occupancy' => 'IPs Registradas',
	'Class:IPRange/Attribute:occupancy+' => '',
));

//
// Class extensions for IPRange
//                                                       

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPRange/Tab:ipregistered' => 'IPs Registradas',
	'Class:IPRange/Tab:ipregistered+' => 'IPs registradas en el Rango de IPs',
	'Class:IPRange/Tab:ipregistered-count' => ' - %1$s reservadas, %2$s asignadas, %3$s Liberado, %4$s No Asignado de %5$s',
	'Class:IPRange/Tab:ipfree-explain' => 'Lista de primeras %1$s direcciones IP libres:',
	'Class:IPRange/Tab:ipfree-explainbis' => 'Lista de TODAS las direcciones IP libres:',
	'Class:IPRange/Tab:notifications' => 'Notificaciones',
	'Class:IPRange/Tab:notifications+' => 'Notificaciones relacionadas con este rango de IPs',
));

//
// Class: IPv4Range
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPv4Range' => 'Rango IPv4',
	'Class:IPv4Range+' => '',
	'Class:IPv4Range/Attribute:subnet_id' => 'Subred',
	'Class:IPv4Range/Attribute:subnet_id+' => '',
	'Class:IPv4Range/Attribute:subnet_ip' => 'IP Subred',
	'Class:IPv4Range/Attribute:subnet_ip+' => '',
	'Class:IPv4Range/Attribute:firstip' => 'Primer Rango de IPs',
	'Class:IPv4Range/Attribute:firstip+' => '',
	'Class:IPv4Range/Attribute:lastip' => 'Último Rango de IP',
	'Class:IPv4Range/Attribute:lastip+' => '',
));

//
// Class: IPAddress
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPAddress' => 'Dirección IP',
	'Class:IPAddress+' => '',
	'Class:IPAddress:baseinfo' => 'Información General',
	'Class:IPAddress:dnsinfo' => 'Información DNS',
	'Class:IPAddress:ipinfo' => 'Información IP',
	'Class:IPAddress/Attribute:short_name' => 'Nombre Corto',
	'Class:IPAddress/Attribute:short_name+' => 'Etiqueta Izquierda del FQDN',
	'Class:IPAddress/Attribute:domain_id' => 'Dominio DNS',
	'Class:IPAddress/Attribute:domain_id+' => '',
	'Class:IPAddress/Attribute:domain_name' => 'Nombre de Dominio',
	'Class:IPAddress/Attribute:domain_name+' => 'Name of the DNS domain',
	'Class:IPAddress/Attribute:fqdn' => 'FQDN',
	'Class:IPAddress/Attribute:fqdn+' => 'Fully Qualified Domain Name',
	'Class:IPAddress/Attribute:aliases' => 'Alias',
	'Class:IPAddress/Attribute:aliases+' => 'List of aliases used for the FQDN',
	'Class:IPAddress/Attribute:usage_id' => 'Uso',
	'Class:IPAddress/Attribute:usage_id+' => '',
	'Class:IPAddress/Attribute:usage_name' => 'Nombre de Uso',
	'Class:IPAddress/Attribute:usage_name+' => '',
	'Class:IPAddress/Attribute:ipinterface_id' => 'Inferfaz IP',
	'Class:IPAddress/Attribute:ipinterface_id+' => '',
	'Class:IPAddress/Attribute:ipinterface_name' => 'Nombre Interfaz IP',
	'Class:IPAddress/Attribute:ipinterface_name+' => '',
	'Class:IPAddress/Attribute:allocation_date' => 'Fecha de Asignación',
	'Class:IPAddress/Attribute:allocation_date+' => 'Date when IP address has been allocated',
	'Class:IPAddress/Attribute:release_date' => 'Fecha Liberación',
	'Class:IPAddress/Attribute:release_date+' => 'Date when IP address has been released and is not used anymore.',
	'Class:IPAddress/Attribute:ip_list' => 'IPs con NAT',
	'Class:IPAddress/Attribute:ip_list+' => 'List de IPs con NAT',
	'Class:IPAddress/Attribute:finalclass' => 'Clase',
	'Class:IPAddress/Attribute:finalclass+' => '',
));

//
// Class extensions for IPAddress
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPAddress/Tab:globalparam' => 'Configuraciones Globales',
	'Class:IPAddress/Tab:parents' => 'Padres',
	'Class:IPAddress/Tab:ip_list' => 'IPs con NAT',
	'Class:IPAddress/Tab:ip_list+' => 'List of NAT IPs',
	'Class:IPAddress/Tab:ci_list' => 'ECs',
	'Class:IPAddress/Tab:ci_list+' => 'List of CIs pointing to this IP:',
	'Class:IPAddress/Tab:ci_list_class' => '%1$ss',
	'Class:IPAddress/Tab:NoCi' => 'No EC',
	'Class:IPAddress/Tab:NoCi+' => 'No Configuration Item is using this IP',
	'Class:IPAddress/Tab:requests' => 'Requerimientos IP',
	'Class:IPAddress/Tab:requests+' => 'IP requests related to this IP',
	'Class:IPAddress/Tab:changes' => 'Cambios IP',
	'Class:IPAddress/Tab:changes+' => 'IP Changes related to this IP',
));

//
// Class: lnkIPAdressToIPAddress
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:lnkIPAdressToIPAddress' => 'Relación IP / IPs NAT',
	'Class:lnkIPAdressToIPAddress+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall' => 'Tipo IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id_finalclass_recall+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id' => 'Dirección IP',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_id+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id' => 'IP NAT',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_id+' => '',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name' => 'Nombre Corto',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_short_name+' => 'Left label of the FQDN',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name' => 'Nombre de Dominio',
	'Class:lnkIPAdressToIPAddress/Attribute:ip1_domain_name+' => 'Name of the DNS domain',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name' => 'Nombre Corto',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_short_name+' => 'Left label of the FQDN',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name' => 'Nombre de Dominio',
	'Class:lnkIPAdressToIPAddress/Attribute:ip2_domain_name+' => 'Name of the DNS domain',
));

//
// Class: lnkIPInterfaceToIPAddress
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:lnkIPInterfaceToIPAddress' => 'Relación Interfaz IP/ Dirección IP',
	'Class:lnkIPInterfaceToIPAddress+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall' => 'Tipo IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id_finalclass_recall+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id' => 'Interfaz IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_id+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name' => 'Nombre Interfaz IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipinterface_name+' => '',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id' => 'Dirección IP',
	'Class:lnkIPInterfaceToIPAddress/Attribute:ipaddress_id+' => '',
));

//
// Class: IPv4Address
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPv4Address' => 'Dirección IPv4',
	'Class:IPv4Address+' => '',
	'Class:IPv4Address/Attribute:subnet_id' => 'Subred',
	'Class:IPv4Address/Attribute:subnet_id+' => 'Subred IPv4',
	'Class:IPv4Address/Attribute:range_id' => 'Rango',
	'Class:IPv4Address/Attribute:range_id+' => 'Rango IPv4',
	'Class:IPv4Address/Attribute:ip' => 'Dirección',
	'Class:IPv4Address/Attribute:ip+' => 'IPv4 Address',
));

//
// Class: IPConfig
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPConfig' => 'Configuración IP Global',
	'Class:IPConfig+' => '',
	'Class:IPConfig:baseinfo' => 'Información General',
	'Class:IPConfig:blockinfo' => 'Configuraciones por Omisión para Bloques de Subred',
	'Class:IPConfig:subnetinfo' => 'Configuracioens por Omisión para Subredes',
	'Class:IPConfig:iprangeinfo' => 'Configuraciones por Omisión para Rangos de IPs',
	'Class:IPConfig:ipinfo' => 'Configuraciones por Omisión para IPs',
	'Class:IPConfig:domaininfo' => 'Dominio Información',
	'Class:IPConfig:otherinfo' => 'Otra Información',
	'Class:IPConfig/Attribute:org_id' => 'Organización',
	'Class:IPConfig/Attribute:org_id+' => '',
	'Class:IPConfig/Attribute:org_name' => 'Nombre Organización',
	'Class:IPConfig/Attribute:org_name+' => '',
	'Class:IPConfig/Attribute:name' => 'Nombre',
	'Class:IPConfig/Attribute:name+' => '',
	'Class:IPConfig/Attribute:requestor_id' => 'Solicitante',
	'Class:IPConfig/Attribute:requestor_id+' => '',
	'Class:IPConfig/Attribute:requestor_name' => 'Nombre Solicitante',
	'Class:IPConfig/Attribute:requestor_name+' => '',
	'Class:IPConfig/Attribute:ipv4_block_min_size' => 'Tamaño Minimo de Bloques de Subred IPv4',
	'Class:IPConfig/Attribute:ipv4_block_min_size+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned' => 'Alinear Bloques de Subred IPv4 a CIDR',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes' => 'Si',
	'Class:IPConfig/Attribute:ipv4_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only' => 'Delegar bloques a Organizaciones hijos solamente',
	'Class:IPConfig/Attribute:delegate_to_children_only+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_no' => 'No',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_no+' => '',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_yes' => 'Si',
	'Class:IPConfig/Attribute:delegate_to_children_only/Value:dtc_yes+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs' => 'Reservar Subred, Gateway and Broadcast IPs a la creación de Subred',
	'Class:IPConfig/Attribute:reserve_subnet_IPs+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_no' => 'No',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_no+' => '',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_yes' => 'Si',
	'Class:IPConfig/Attribute:reserve_subnet_IPs/Value:reserve_yes+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format' => ' Gateway IP IPv4',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1' => 'Subred IP + 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1' => 'Broadcast IP - 1',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:broadcastip_minus_1+' => '',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup' => 'Asignación Libre',
	'Class:IPConfig/Attribute:ipv4_gateway_ip_format/Value:free_setup+' => '',
	'Class:IPConfig/Attribute:subnet_low_watermark' => 'Marca de Agua Baja Subred (%)',
	'Class:IPConfig/Attribute:subnet_low_watermark+' => '',
	'Class:IPConfig/Attribute:subnet_high_watermark' => 'Marca de Agua Alta Subred (%)',
	'Class:IPConfig/Attribute:subnet_high_watermark+' => '',
	'Class:IPConfig/Attribute:iprange_low_watermark' => 'Marca de Agua Baja Rango IPs (%)',
	'Class:IPConfig/Attribute:iprange_low_watermark+' => '',
	'Class:IPConfig/Attribute:iprange_high_watermark' => 'Marca de Agua Alta Rango IPs (%)',
	'Class:IPConfig/Attribute:iprange_high_watermark+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name' => 'Permitir Nombres Duplicados',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_no' => 'No',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_no+' => '',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_yes' => 'Si',
	'Class:IPConfig/Attribute:ip_allow_duplicate_name/Value:ipdup_yes+' => '',
	'Class:IPConfig/Attribute:mac_address_format' => 'Formato de Salida Dirección MAC',
	'Class:IPConfig/Attribute:mac_address_format+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:colons' => '01:23:45:67:89:ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:colons+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:hyphens' => '01-23-45-67-89-ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:hyphens+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:dots' => '0123.4567.89ab',
	'Class:IPConfig/Attribute:mac_address_format/Value:dots+' => '',
	'Class:IPConfig/Attribute:mac_address_format/Value:any' => 'Cualquiera',
	'Class:IPConfig/Attribute:mac_address_format/Value:any+' => '',                                 
	'Class:IPConfig/Attribute:ping_before_assign' => 'Hacer Ping a IP antes de asignarla?',
	'Class:IPConfig/Attribute:ping_before_assign+' => '',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_no' => 'No',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_no+' => '',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_yes' => 'Si',
	'Class:IPConfig/Attribute:ping_before_assign/Value:ping_yes+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname' => 'El nombre de la IC se copia en el nombre corto de la IP',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:no' => 'No',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:yes' => 'Si',
	'Class:IPConfig/Attribute:ip_copy_ci_name_to_shortname/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete' => 'Liberar IPs de ICs que se vuelven obsoletas.',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:no' => 'No',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:yes' => 'Si',
	'Class:IPConfig/Attribute:ip_release_on_ci_obsolete/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production' => 'Asignar IP adjuntas a CI de producción',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:no' => 'No',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:no+' => '',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:yes' => 'Si',
	'Class:IPConfig/Attribute:ip_allocate_on_ci_production/Value:yes+' => '',
	'Class:IPConfig/Attribute:delegate_domain_to_children_only' => 'Delegar dominios a Organizaciones hijos solamente',
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
	'Class:IPConfig/Attribute:ip_release_on_subnet_release' => 'Liberar IP de subredes que se liberan',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:yes' => 'Si',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:yes+' => '',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:no' => 'No',
	'Class:IPConfig/Attribute:ip_release_on_subnet_release/Value:no+' => '',
));

//
// Class: IPRangeUsage
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPRangeUsage' => 'Uso de Rangos IP',
	'Class:IPRangeUsage+' => 'What a Range of IP addresses is used for',
	'Class:IPRangeUsage/Attribute:org_id' => 'Organización',
	'Class:IPRangeUsage/Attribute:org_id+' => '',
	'Class:IPRangeUsage/Attribute:org_name' => 'Nombre de Organización',
	'Class:IPRangeUsage/Attribute:org_name+' => '',
	'Class:IPRangeUsage/Attribute:name' => 'Nombre',
	'Class:IPRangeUsage/Attribute:name+' => '',
	'Class:IPRangeUsage/Attribute:description' => 'Descripción',
	'Class:IPRangeUsage/Attribute:description+' => '',
	'Class:IPRangeUsage/Attribute:ipranges_list' => 'Rangos IPs',
	'Class:IPRangeUsage/Attribute:ipranges_list+' => '',
));

//
// Class: IPUsage
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPUsage' => 'Uso de Direcciones IP',
	'Class:IPUsage+' => 'What an IP address is used for',
	'Class:IPUsage/Attribute:org_id' => 'Organización',
	'Class:IPUsage/Attribute:org_id+' => '',
	'Class:IPUsage/Attribute:org_name' => 'Nombre Organización',
	'Class:IPUsage/Attribute:org_name+' => '',
	'Class:IPUsage/Attribute:name' => 'Nombre',
	'Class:IPUsage/Attribute:name+' => '',
	'Class:IPUsage/Attribute:description' => 'Descripción',
	'Class:IPUsage/Attribute:description+' => '',
	'Class:IPUsage/Attribute:ips_list' => 'IPs',
	'Class:IPUsage/Attribute:ips_list+' => '',
));

//
// Class: IPTriggerOnWaterMark
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPTriggerOnWaterMark' => 'Disparador (cuando se alcance una marca de agua relacionada con IP)',
	'Class:IPTriggerOnWaterMark+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_id' => 'Organización',
	'Class:IPTriggerOnWaterMark/Attribute:org_id+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:org_name' => 'Nombre Organización',
	'Class:IPTriggerOnWaterMark/Attribute:org_name+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:target_class' => 'Clase Objetivo',
	'Class:IPTriggerOnWaterMark/Attribute:target_class+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event' => 'Evento',
	'Class:IPTriggerOnWaterMark/Attribute:event+' => 'Evento generado cuando disparador es activado',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low' => 'Cruzó Marca de Agua Baja',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_low+' => '',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high' => 'Cruzó Marca de Agua Alta',
	'Class:IPTriggerOnWaterMark/Attribute:event/Value:cross_high+' => '',
));

//
// Class: IPObjTemplate
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPObjTemplate' => 'Plantilla IP',
	'Class:IPObjTemplate+' => '',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id' => 'Subcategoría de Servicio',
	'Class:IPObjTemplate/Attribute:servicesubcategory_id+' => '',
	'Class:IPObjTemplate/Attribute:request_type' => 'Tipo de Requerimiento',
	'Class:IPObjTemplate/Attribute:request_type+' => '',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_create' => 'Creación IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_change' => 'Cambio IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:ip_delete' => 'Borrado IP',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_create' => 'Creación Subred',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_change' => 'Cambio Subred',
	'Class:IPObjTemplate/Attribute:request_type/Value:subnet_delete' => 'Borrado Subred',
));

//
// Class: IPApplication
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPApplication/Name' => '%1$s',
	'Class:IPApplication/Attribute:uuid' => 'UUID',
	'Class:IPApplication/Attribute:uuid+' => '',
	'Class:IPApplication/Attribute:status' => 'Estatus',
	'Class:IPApplication/Attribute:status+' => '',
	'Class:IPApplication/Attribute:status/Value:obsolete' => 'Obsoleto',
	'Class:IPApplication/Attribute:status/Value:production' => 'Produción',
	'Class:IPApplication/Attribute:status/Value:implementation' => 'Implementación',
	'Class:IPApplication/Attribute:location_id' => 'Localidad',
	'Class:IPApplication/Attribute:location_id+' => '',
	'Class:IPApplication/Attribute:location_name' => 'Nombre Localidad',
	'Class:IPApplication/Attribute:location_name+' => '',
));

//
// Application Menu
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Menu:IPManagement' => 'Administración IP',
	'Menu:IPManagement+' => 'Adminsitración IP',
	'Menu:IPManagement:Overview:Total' => 'Total: %1s',
	'Menu:IPSpace' => 'Espacio IP',
	'Menu:IPSpace+' => 'Espacio IP',
	'Menu:IPSpace:IPv4Objects' => 'Objetos IPv4',
	'Menu:IPSpace:IPv4Objects+' => 'Objetos IPv4',
	'Menu:IPSpace:Options' => 'Parámetros',
	'Menu:IPSpace:Options+' => 'Parámetros',  
	'Menu:NewIPObject' => 'Nuevo objeto IP',
	'Menu:NewIPObject+' => 'Creation of a new IP object',
	'Menu:SearchIPObject' => 'Búsqueda de objeto IP',
	'Menu:SearchIPObject+' => 'Search for an IP object',
	'Menu:IPv4ShortCut' => 'Acceso Rápido IPv4',
	'Menu:IPv4ShortCut+' => 'IPv4 Shortcuts',
	'Menu:IPv4Block' => 'Bloques de Subred',
	'Menu:IPv4Block+' => 'IPv4 Subnet Blocks',
	'Menu:IPv4Subnet' => 'Subredes',
	'Menu:IPv4Subnet+' => 'Subredes IPv4',
	'Menu:IPv4Subnet:Allocated' => 'Subredes Asignadas',
	'Menu:IPv4Subnet:Allocated+' => 'Lista de todas las Subredes IPv4 asignadas',
	'Menu:IPv4Range' => 'Rangos IP',
	'Menu:IPv4Range+' => 'Rangos IPv4',
	'Menu:IPv4Address' => 'Direcciones IP',
	'Menu:IPv4Address+' => 'Direcciones IPv4',
	'Menu:IPTools' => 'Herramientas',
	'Menu:IPTools+' => '',
	'Menu:SubnetCalculator' => 'Calculadora de subred',
	'Menu:SubnetCalculator+' => '',
	'Menu:Options' => 'Parámetros',
	'Menu:Options+' => 'Parámetros',  
	'Menu:IPConfig' => 'Configuraciones Globales IP',
	'Menu:IPConfig+' => 'Parámetros Globales para objetos relacionados con IP',
	'Menu:IPRangeUsage' => 'Tipos de Rango IP',
	'Menu:IPRangeUsage+' => 'Tipos de uso de Rangos IP',
	'Menu:IPUsage' => 'Tipos IP',
	'Menu:IPUsage+' => 'Tipos de uso de IP',
	'Menu:Domain' => 'Dominios',
	'Menu:Domain+' => 'Nombre de Dominios',
	'Menu:IPTemplate' => 'Plantilla IP',
	'Menu:IPTemplate+' => 'Plantillas IP',
	
	'UI:IPMgmtWelcomeOverview:Title' => 'Mi Dashboard',
	
	// Menu separator in Action menus
	'UI:IPManagement:Action:MenuSeparator' => '<hr class="menu-separator"/>',	
	'UI:IPManagement:Action:Error::WrongActionForClass' => 'Esta acción no puede se aplicada a esa clase de objeto!',
//
// Management of IP global settings
//
	'UI:IPManagement:Action:New:IPConfig:AlreadyExists' => 'Solo una Configuración Global de IP puede existir para una Organización.',	
	'UI:IPManagement:Action:Modify:IPConfig:IPv4BlockMinSizeTooSmall' => 'El tamaño mínimo de Bloques de Subred IPv4 no pueden ser menores a %1$s!',
	'UI:IPManagement:Action:Modify:IPConfig:IPv6BlockMinSizeTooSmall' => 'El tamaño mínimo de Bloques de Subred IPv6 no pueden ser menores a %1$s!',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksPercent' => 'Umbral es un porcentaje, por favor, utilice números entre el 0 y 100!',
	'UI:IPManagement:Action:Modify:IPConfig:WaterMarksOrder' => 'Umbral Bajo debe ser menor a Umbral Alto!',	
	'UI:IPManagement:Action:Modify:GlobalConfig' => 'Estas Configuraciones IP Globales pueder ser sobre escritas por esta acción.',	

//
// Management of IPBlocks
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPBlock:Reverted' => 'Primer IP del Bloque de Subred es mas grande que la última IP!',
	'UI:IPManagement:Action:New:IPBlock:SmallerThanMinSize' => 'El tamaño del Bloque no puede ser menor que %1$s!',	
	'UI:IPManagement:Action:New:IPBlock:NotCIDRAligned' => 'Bloque no está alineado con CIDR!',	
	'UI:IPManagement:Action:New:IPBlock:NotInParent' => 'El Bloque de Subred no está estrictamente contenido dentro del padre seleccionado',	
	'UI:IPManagement:Action:New:IPBlock:NameExist' => 'Ya existe Nombre de Bloque de Subred!',	
	'UI:IPManagement:Action:New:IPBlock:Collision0' => 'Bloque de Subred ya existe!',	
	'UI:IPManagement:Action:New:IPBlock:Collision1' => 'Colisión de Bloque de Subred : Primer IP pertenece a bloque existente!',	
	'UI:IPManagement:Action:New:IPBlock:Collision2' => 'Colisión de Bloque de Subred : Última IP partenece a bloque existente!',	
	'UI:IPManagement:Action:Modify:IPBlock:ParentIdNull' => 'Bloque de subredes hijo %1$s no puede unirse aun bloque padre inexistente.',	
	
	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPBlock:Reverted' =>  'Nueva primer IP del bloque de subred es mayor que nueva última IP!',
	'UI:IPManagement:Action:Shrink:IPBlock:IPOutOfBlock' => 'Nuevas IPs no están todas dentro del bloque!',
	'UI:IPManagement:Action:Shrink:IPBlock:NoChange' => 'Ningún cambio ha sido requerido.',
	'UI:IPManagement:Action:Shrink:IPBlock:NotCIDRAligned' => 'Bloque no está alineado con CIDR!',
	'UI:IPManagement:Action:Shrink:IPBlock:BlockAccrossBorder' => 'Un bloque de subred dependiente está a traves de nuevo límite!',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetAccrossBorder' => 'Una subred unida al bloque está a traves de nuevo límites!',
	'UI:IPManagement:Action:Shrink:IPBlock:SubnetBecomesOrhpean' => 'Bloques dependientes no tienen bloque padre despues de la compresión!',	
	'UI:IPManagement:Action:Shrink:IPBlock:Done' => '%1$s <span class="hilite">%2$s</span> ha sido comprimido.',
	
	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPBlock:IPOutOfBlock' => 'Split IP is out of block!',
	'UI:IPManagement:Action:Split:IPBlock:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Split:IPBlock:NotCIDRAligned' => 'Blocks are not CIDR aligned!',	
	'UI:IPManagement:Action:Split:IPBlock:BlockAccrossBorder' => 'A child subnet block sits accros new borders!',
	'UI:IPManagement:Action:Split:IPBlock:SubnetAccrossBorder' => 'A subnet attached to the block sits accros new borders!',
	'UI:IPManagement:Action:Split:IPBlock:EmptyNewName' => 'Name of new Subnet Block is empty!',
	'UI:IPManagement:Action:Split:IPBlock:NameExist' => 'Name of new Subnet Block already exists!',
	'UI:IPManagement:Action:Split:IPBlock:Done' => '%1$s <span class="hilite">%2$s</span> has been split.',
	
	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPBlock:Reverted' =>  'New first IP of Subnet Block is higher than new last IP!',
	'UI:IPManagement:Action:Expand:IPBlock:IPOutOfBlock' => 'New IPs are not all outside of block!',
	'UI:IPManagement:Action:Expand:IPBlock:NoChange' => 'No change has been required.',
	'UI:IPManagement:Action:Expand:IPBlock:NotCIDRAligned' => 'Block is not CIDR aligned!',
	'UI:IPManagement:Action:Expand:IPBlock:BlockBiggerThanParent' => 'The block cannot be bigger than its parent!',
	'UI:IPManagement:Action:Expand:IPBlock:DelegatedBlockAccrossBorder' => 'The block cannot take over a delegated block!',
	'UI:IPManagement:Action:Expand:IPBlock:BlockAccrossBorder' => 'A brother subnet block sits accros new borders!',
	'UI:IPManagement:Action:Expand:IPBlock:SubnetAccrossBorder' => 'A subnet attached to parent block sits accross new borders',
	'UI:IPManagement:Action:Expand:IPBlock:Done' => '%1$s <span class="hilite">%2$s</span> has been expanded.',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPBlock:NoChildOrg' => 'Block\'s organization doesn\'t have any children!',
	'UI:IPManagement:Action:Delegate:IPBlock:NoOtherOrg' => 'There is no other organization than block\'s organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:IsDelegated' => 'The block is already delegated!',
	'UI:IPManagement:Action:Delegate:IPBlock:WrongLevelOfOrganization' => 'Delegation change must be done to a sister organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:NoChangeOfOrganization' => 'No change has been required!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocks' => 'Block has children blocks!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnets' => 'Block has children subnets!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfTargetOrg' => 'Block conflicts with a block from the target organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:ConflictWithBlocksOfParentOrg' => 'Block conflicts with a block from the parent organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildBlocksInParent' => 'Block has children blocks in parent organization!',
	'UI:IPManagement:Action:Delegate:IPBlock:HasChildSubnetsInParent' => 'Block has children subnets in parent organization!',
	
	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPBlock:CannotBeUndelegated' => 'Block cannot be undelegated: %1$s',
	'UI:IPManagement:Action:Undelegate:IPBlock:IsNotDelegated' => 'Block is not delegated!',
	'UI:IPManagement:Action:Undelegate:IPBlock:HasChildBlocks' => 'Block has children blocks!',
	'UI:IPManagement:Action:Undelegate:IPBlock:HasChildSubnets' => 'Block has children subnets!',
	
//
// Management of IPv4Blocks
//
	// Display details of subnet blocks
	'UI:IPManagement:Action:Details:IPv4Block' => 'Details',
	'UI:IPManagement:Action:Details:IPv4Block+' => '',
	
	// Display list of subnet blocks
	'UI:IPManagement:Action:DisplayList:IPv4Block' => 'Display List',
	'UI:IPManagement:Action:DisplayList:IPv4Block+' => '',
	'UI:IPManagement:Action:DisplayList:IPv4Block:PageTitle_Class' => 'IPv4 Subnet Blocks',
	'UI:IPManagement:Action:DisplayList:IPv4Block:Title_Class' => 'IPv4 Subnet Blocks',
	
	// Display tree of subnet blocks
	'UI:IPManagement:Action:DisplayTree:IPv4Block' => 'Display Tree',
	'UI:IPManagement:Action:DisplayTree:IPv4Block+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:PageTitle_Class' => 'IPv4 Subnet Blocks',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:Title_Class' => 'IPv4 Subnet Blocks',
	'UI:IPManagement:Action:DisplayTree:IPv4Block:OrgName' => 'Organization %1$s',
	
	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPv4Block' => 'Shrink',
	'UI:IPManagement:Action:Shrink:IPv4Block+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Shrink:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s shrink',
	'UI:IPManagement:Action:Shrink:IPv4Block:Title_Class_Object' => 'Shrink %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewFirstIP' => 'New First IP of Block :',
	'UI:IPManagement:Action:Shrink:IPv4Block:NewLastIP' => 'New Last IP of Block :',            
	'UI:IPManagement:Action:Shrink:IPv4Block:IsDelegated' => 'This block is delegated and therefore cannot be shrunk!',
	'UI:IPManagement:Action:Shrink:IPv4Block:CannotBeShrunk' => 'Block cannot be shrunk: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Block:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Shrink:IPv4Block:Done' => '%1$s <span class="hilite">%2$s</span> has been shrunk.',
	
	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv4Block' => 'Split',
	'UI:IPManagement:Action:Split:IPv4Block+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Split:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s split',
	'UI:IPManagement:Action:Split:IPv4Block:Title_Class_Object' => 'Split %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Split:IPv4Block:At' => 'First IP of new Subnet Block :',
	'UI:IPManagement:Action:Split:IPv4Block:NameNewBlock' => 'Name of new Subnet Block :',
	'UI:IPManagement:Action:Split:IPv4Block:IsDelegated' => 'This block is delegated and therefore cannot be split!',
	'UI:IPManagement:Action:Split:IPv4Block:CannotBeSplit' => 'Block cannot be split: %1$s',
	'UI:IPManagement:Action:Split:IPv4Block:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Split:IPv4Block:Done' => '%1$s <span class="hilite">%2$s</span> has been split.',
	
	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv4Block' => 'Expand',
	'UI:IPManagement:Action:Expand:IPv4Block+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Expand:IPv4Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Block:PageTitle_Object_Class' => '%1$s - %2$s expand',
	'UI:IPManagement:Action:Expand:IPv4Block:Title_Class_Object' => 'Expand %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Expand:IPv4Block:NewFirstIP' => 'New First IP of Block :',
	'UI:IPManagement:Action:Expand:IPv4Block:NewLastIP' => 'New Last IP of Block :',
	'UI:IPManagement:Action:Expand:IPv4Block:IsDelegated' => 'This block is delegated and therefore cannot be expanded!',
	'UI:IPManagement:Action:Expand:IPv4Block:CannotBeExpanded' => 'Block cannot be expanded: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Block:SmallerThanMinSize' => 'Block size cannot be smaller than %1$s!',
	'UI:IPManagement:Action:Expand:IPv4Block:Done' => '%1$s <span class="hilite">%2$s</span> has been expanded.',

	// List space action on subnet blocks 
	'UI:IPManagement:Action:ListSpace:IPv4Block' => 'List Space',                                               
	'UI:IPManagement:Action:ListSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Space',
	'UI:IPManagement:Action:ListSpace:IPv4Block:Title_Class_Object' => 'Space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListSpace:IPv4Block:FreeSpace' => 'Free [%1$s - %2$s] - %3$s IPs - %4$.2f %%',
	
	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv4Block' => 'Find Space',
	'UI:IPManagement:Action:FindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Find space',
	'UI:IPManagement:Action:FindSpace:IPv4Block:Title_Class_Object' => 'Look for space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:FindSpace:IPv4Block:SizeOfSpace' => 'Size of space to look for :',
	'UI:IPManagement:Action:FindSpace:IPv4Block:MaxNumberOfOffers' => 'Maximum number of offers:',
	
	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:PageTitle_Object_Class' => '%1$s - Find space',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Title_Class_Object' => 'Space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:Summary' => '%1$s first /%2$s within block',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsBlock' => 'Create as a child block',
	'UI:IPManagement:Action:DoFindSpace:IPv4Block:CreateAsSubnet' => 'Create as a subnet',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv4Block' => 'Delegate',
	'UI:IPManagement:Action:Delegate:IPv4Block:PageTitle_Object_Class' => '%1$s - Delegate',
	'UI:IPManagement:Action:Delegate:IPv4Block:Title_Class_Object' => 'Delegate %1$s <span class="hilite">%2$s</span> to organization',
	'UI:IPManagement:Action:Delegate:IPv4Block:ChildBlock' => 'Organization to delegate the Block to:',
	'UI:IPManagement:Action:Delegate:IPv4Block:NoChildOrg' => 'Block\'s organization doesn\'t have any children and therefore, block cannot be delegated!',
	'UI:IPManagement:Action:Delegate:IPv4Block:NoOtherOrg' => 'There is no other organization than block\'s organization!',
	'UI:IPManagement:Action:Delegate:IPv4Block:IsDelegated' => 'The block is already delegated!',
	'UI:IPManagement:Action:Delegate:IPv4Block:CannotBeDelegated' => 'Block cannot be delegated: %1$s',
	'UI:IPManagement:Action:Delegate:IPv4Block:Done' => '%1$s <span class="hilite">%2$s</span> has been delegated.',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPv4Block' => 'Un-delegate',
	'UI:IPManagement:Action:Undelegate:IPv4Block:PageTitle_Object_Class' => '%1$s - Un-delegate',
	'UI:IPManagement:Action:Undelegate:IPv4Block:Done' => '%1$s <span class="hilite">%2$s</span> has been un-delegated.',
	
//
// Management of Subnets
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPSubnet:IpCannotChange' => 'Subnet IP cannot be modified! ',	
	'UI:IPManagement:Action:New:IPSubnet:MaskCannotChange' => 'Subnet Mask cannot be modified!',	
	'UI:IPManagement:Action:New:IPSubnet:IpIncorrect' => 'Subnet IP is not consistant with Mask!',	
	'UI:IPManagement:Action:New:IPSubnet:NotInBlock' => 'Subnet is not contained within selected block!',	
	'UI:IPManagement:Action:New:IPSubnet:Collision0' => 'Subnet already exists!',	
	'UI:IPManagement:Action:New:IPSubnet:Collision1' => 'Subnet collision : subnet IP belongs to an existing subnet!',	
	'UI:IPManagement:Action:New:IPSubnet:Collision2' => 'Subnet collision : broadcast IP belongs to an existing subnet!',	
	'UI:IPManagement:Action:New:IPSubnet:Collision3' => 'Subnet collision : new subnet includes an existing one!',	
	'UI:IPManagement:Action:New:IPSubnet:GatewayOutOfSubnet' => 'Gateway IP is not within the subnet boundaries!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPSubnet' => 'Subnet Calculator',
	'UI:IPManagement:Action:Calculator:IPSubnet:SelectSubnetType' => 'Select subnet type',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:SelectCreation' => 'You may register the related subnet blocks or subnets:',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CreateSubnet' => 'Create the subnet',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateSubnet:MaskIsToSmall' => 'Mask is too small: subnet cannot be created!',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CreateBlock' => 'Create the subnet block',
	'UI:IPManagement:Action:DoCalculator:IPSubnet:CannotCreateBlock:MaskIsToBig' => 'Mask is too big: subnet block cannot be created!',

//
// Management of IPv4 Subnets
//
	// Display details of subnet
	'UI:IPManagement:Action:Details:IPv4Subnet' => 'Details',
	'UI:IPManagement:Action:Details:IPv4Subnet+' => '',

	// Display list of subnets
	'UI:IPManagement:Action:DisplayList:IPv4Subnet' => 'Display List',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet+' => '',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet:PageTitle_Class' => 'IPv4 Subnets',
	'UI:IPManagement:Action:DisplayList:IPv4Subnet:Title_Class' => 'IPv4 Subnets',
	
	// Display tree of subnets
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet' => 'Display Tree',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:PageTitle_Class' => 'IPv4 Subnets',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:Title_Class' => 'IPv4 Subnets',
	'UI:IPManagement:Action:DisplayTree:IPv4Subnet:OrgName' => 'Organization %1$s',
	
	// Find space action on subnets 
	'UI:IPManagement:Action:FindSpace:IPv4Subnet' => 'Find space',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - Find space',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:Title_Class_Object' => 'Look for IP space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeTooSmall' => 'Subnet is too small to look for space. Please, cancel!',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:SizeOfRange' => 'Size of space to look for :',
	'UI:IPManagement:Action:FindSpace:IPv4Subnet:MaxNumberOfOffers' => 'Maximum number of offers :',
	
	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:PageTitle_Object_Class' => '%1$s - Find space',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Title_Class_Object' => 'Space within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:Summary' => '%1$s first free %2$s IPs ranges within subnet',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:RangeTooBig' => 'Requested space doesn\'t fit within subnet. Please, try a lower value.',
	'UI:IPManagement:Action:DoFindSpace:IPv4Subnet:CreateAsRange' => 'Create as an IP range',

	// List IPs action on subnets 
	'UI:IPManagement:Action:ListIps:IPv4Subnet' => 'List & Pick IPs',                                               
	'UI:IPManagement:Action:ListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Title_Class_Object' => 'List of IPs within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListIps:IPv4Subnet:Subtitle_ListRange' => 'Subnet is too big to list all IPs in a raw. Please, select a range to display:',                                               
	'UI:IPManagement:Action:ListIps:IPv4Subnet:FirstIP' => 'First IP of the list',                                               
	'UI:IPManagement:Action:ListIps:IPv4Subnet:LastIP' => 'Last IP of the list',                                               
	
	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv4Subnet' => 'List & Pick IPs',                                               
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:Title_Class_Object' => 'Partial list of IPs within %1$s: <span class="hilite">%2$s</span>',
 	'UI:IPManagement:Action:DoListIps:IPv4Subnet:CannotBeListed' => 'IPs cannot be listed: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIPOutOfSubnet' => 'First IP is out of subnet!',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:LastIPOutOfSubnet' => 'Last IP is out of subnet!',
	'UI:IPManagement:Action:DoListIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// Shrink action on subnets
	'UI:IPManagement:Action:Shrink:IPv4Subnet' => 'Shrink',
	'UI:IPManagement:Action:Shrink:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary' => 'Summary',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s shrink',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Title_Class_Object' => 'Shrink %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:CannotBeShrunk' =>  'Subnet cannot be shrunk: %1$s',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmall' => 'Subnet is too small to be shrunk!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:SizeTooSmallBy' => 'Subnet is too small to be shrunk by %1$s!',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeInTheMiddle' => 'Range: <b>%1$s [%2$s - %3$s]</b> sits across new subnet boundaries. Shrink cannot be performed!',	
	'UI:IPManagement:Action:Shrink:IPv4Subnet:IPRangeDropped' => 'Range: <b>%1$s [%2$s - %3$s]</b> will be dropped from subnet. Shrink cannot be performed!',	
	'UI:IPManagement:Action:Shrink:IPv4Subnet:Done' => '%1$s <span class="hilite">%2$s</span> has been shrunk by %3$s.',
	'UI:IPManagement:Action:Shrink:IPv4Subnet:By' => 'Shrink by :',
	
	// Split action on subnets
	'UI:IPManagement:Action:Split:IPv4Subnet' => 'Split',
	'UI:IPManagement:Action:Split:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary' => 'Summary',
	'UI:IPManagement:Action:Split:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s split',
	'UI:IPManagement:Action:Split:IPv4Subnet:Title_Class_Object' => 'Split %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Split:IPv4Subnet:CannotBeSplit' =>  'Subnet cannot be split: %1$s',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmall' => 'Subnet is too small to be split!',
	'UI:IPManagement:Action:Split:IPv4Subnet:SizeTooSmallBy' => 'Subnet is too small to be split by %1$s!',
	'UI:IPManagement:Action:Split:IPv4Subnet:IPRangeInTheMiddle' => 'Range: <b>%1$s [%2$s - %3$s]</b> sits across new subnet boundaries. Split cannot be performed!',	
	'UI:IPManagement:Action:Split:IPv4Subnet:Done' => '%1$s <span class="hilite">%2$s</span> has been split in %3$s.',
	'UI:IPManagement:Action:Split:IPv4Subnet:In' => 'Split in :',
	
	// Expand action on subnets
	'UI:IPManagement:Action:Expand:IPv4Subnet' => 'Expand',
	'UI:IPManagement:Action:Expand:IPv4Subnet+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary' => 'Summary',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s expand',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Title_Class_Object' => 'Expand %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:Expand:IPv4Subnet:CannotBeExpanded' =>  'Subnet cannot be expanded: %1$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBig' => 'Subnet is too big to be expanded!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:SizeTooBigBy' => 'Subnet is too big to be expanded by %1$s!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:NotInIPBlock' => 'The block hosting the subnet is too small to contain the new expanded subnet!',
	'UI:IPManagement:Action:Expand:IPv4Subnet:Done' => '%1$s <span class="hilite">%2$s</span> has been expanded by %3$s',
	'UI:IPManagement:Action:Expand:IPv4Subnet:By' => 'Expand by :',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet' => 'CSV Export IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV export IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Title_Class_Object' => 'CSV Export IPs of %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:Subtitle_ListRange' => 'Subnet is too big to export all IPs in a raw. Please, select a range to display:',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:FirstIP' => 'First IP of the list',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv4Subnet:LastIP' => 'Last IP of the list',                                               
	
	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet' => 'CSV Export IPs',                                               
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV export IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:Title_Class_Object' => 'Partial CSV Export IPs within %1$s: <span class="hilite">%2$s</span>',
 	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:CannotBeListed' => 'IPs cannot be listed: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIPOutOfSubnet' => 'First IP is out of subnet!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:LastIPOutOfSubnet' => 'Last IP is out of subnet!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Subnet:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv4Subnet' => 'Subnet Calculator',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:PageTitle_Object_Class' => '%2$s Calculator',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Title_Class_Object' => 'Calculator for %1$s',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:IP' => 'IP Address',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:Mask' => 'Mask',
	'UI:IPManagement:Action:Calculator:IPv4Subnet:CIDR' => 'CIDR',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet' => 'Subnet Calculator',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PageTitle_Object_Class' => '%2$s Calculator',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Title_Class_Object' => '%1$s - Calculator output',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IP' => 'IP Address',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Mask' => 'Mask',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CIDR' => 'CIDR',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:SubnetIP' => 'Subnet IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:Wildcard' => 'Wildcard Mask',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:BroadcastIP' => 'Broadcast IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:IPNumber' => 'Number of IPs',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:UsableHosts' => 'Number of usable Hosts',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet' => 'Previous Subnet IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:PreviousSubnet:NA' => 'Not Applicable',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet' => 'Next Subnet IP',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:NextSubnet:NA' => 'Not Applicable',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:CannotRun' => 'Subnet calculator cannot run: %1$s',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:EnterMaskOrCIDR' => 'Enter a mask or a CIDR!',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongMask' => 'Mask is invalid!',
	'UI:IPManagement:Action:DoCalculator:IPv4Subnet:WrongCIDR' => 'CIDR is invalid!',

//
// Management of IP ranges
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPRange:NameExist' => 'Name of Range already exists within subnet!',	
	'UI:IPManagement:Action:New:IPRange:Reverted' => 'First IP of Range is higher than last IP!',	
	'UI:IPManagement:Action:New:IPRange:NotInSubnet' => 'IP Range is not contained within selected subnet!',	
	'UI:IPManagement:Action:New:IPRange:Collision0' => 'IP Range already exists!',	
	'UI:IPManagement:Action:New:IPRange:Collision1' => 'Range collision : first IP belongs to an existing range!',	
	'UI:IPManagement:Action:New:IPRange:Collision2' => 'Range collision : last IP belongs to an existing range!',	
	'UI:IPManagement:Action:New:IPRange:Collision3' => 'Range collision : new range includes an existing one!',	

//
// Management of IPv4 ranges
//
	// Display details of IP Range
	'UI:IPManagement:Action:Details:IPv4Range' => 'Details',
	'UI:IPManagement:Action:Details:IPv4Range+' => '',

	// List IPs action on IP Ranges 
	'UI:IPManagement:Action:ListIps:IPv4Range' => 'List & Pick IPs',                                               
	'UI:IPManagement:Action:ListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv4Range:Title_Class_Object' => 'List of IPs within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:ListIps:IPv4Range:Subtitle_ListRange' => 'Range is too big to list all IPs in a raw. Please, select a sub range to display:',                                               
	'UI:IPManagement:Action:ListIps:IPv4Range:FirstIP' => 'First IP of the list',                                               
	'UI:IPManagement:Action:ListIps:IPv4Range:LastIP' => 'Last IP of the list',                                               
		
	// Do list IPs action on IP Ranges 
	'UI:IPManagement:Action:DoListIps:IPv4Range' => 'List & Pick IPs',                                               
	'UI:IPManagement:Action:DoListIps:IPv4Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv4Range:Title_Class_Object' => 'Partial list of IPs within %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoListIps:IPv4Range:CannotBeListed' => 'Range cannot be listed: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIPOutOfRange' => 'First IP is out of range!',
	'UI:IPManagement:Action:DoListIps:IPv4Range:LastIPOutOfRange' => 'Last IP is out of range!',
	'UI:IPManagement:Action:DoListIps:IPv4Range:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv4Range' => 'CSV Export of IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s CSV export of IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Title_Class_Object' => 'CSV Export IPs of %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:Subtitle_ListRange' => 'Range is too big to export all IPs in a raw. Please, select a sub range to export:',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:FirstIP' => 'First IP of the list',                                               
	'UI:IPManagement:Action:CsvExportIps:IPv4Range:LastIP' => 'Last IP of the list',                                               
	
	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range' => 'CSV Export IPs',                                               
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:PageTitle_Object_Class' => '%1$s - %2$s CSV export of IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:Title_Class_Object' => 'Partial CSV Export IPs of %1$s: <span class="hilite">%2$s</span>',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:CannotBeListed' => 'Range cannot be exported: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIPOutOfRange' => 'First IP is out of range!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:LastIPOutOfRange' => 'Last IP is out of range!',
	'UI:IPManagement:Action:DoCsvExportIps:IPv4Range:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

//
// Management of IP Addresses
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPAddress:IPNameCollision' => 'Short name already exists within domain!',	

	'UI:IPManagement:Action:New:IPAddress:IPCollision' => 'IP already exists!',	
	'UI:IPManagement:Action:New:IPAddress:NotInRange' => 'IP does not belong to IP range!',	
	'UI:IPManagement:Action:New:IPAddress:NotInSubnet' => 'IP does not belong to subnet!',	
	'UI:IPManagement:Action:New:IPAddress:IPPings' => 'IP pings! ',	
	'UI:IPManagement:Action:New:IPAddress:NatIPsAretheSame' => 'IP cannot be NATed to itself! ',

	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:AllocateIP:IPAddress' => 'Allocate address to CI',
	'UI:IPManagement:Action:UnAllocateIP:IPAddress' => 'Un-allocate address from all CIs',
	'UI:IPManagement:Action:Allocate:IPAddress:Class' => 'Target class',
	'UI:IPManagement:Action:Allocate:IPAddress:CI' => 'Functional CI',
	'UI:IPManagement:Action:Allocate:IPAddress:IPAttribute' => 'IP attribute',
	'UI:IPManagement:Action:Allocate:IPAddress:NoCI' => 'There are no instanciated CIs with IP Address attributes in this organization!',
	'UI:IPManagement:Action:Allocate:IPAddress:CIDoesNotExist' => 'Functional CI does not exist!',
	'UI:IPManagement:Action:Allocate:IPAddress:AttributeIsSynchronized' => 'Attribute cannot be stored because it is synchronized from an external source!',
	'UI:IPManagement:Action:UnAllocate:IPAddress:IPNotAllocated' => 'IP is not allocated !',
	'UI:IPManagement:Action:Unallocate:IPAddress:CannotBeUnallocated' => 'Address cannot be un-allocated: %1$s',

//
// Management of IPv4 Addresses
//
	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:Allocate:IPv4Address:PageTitle_Object_Class' => 'Allocate IP',
	'UI:IPManagement:Action:Allocate:IPv4Address:Title_Class_Object' => 'Allocate %1$s <span class="hilite">%2$s</span> to CI',
	'UI:IPManagement:Action:Allocate:IPv4Address:CannotAllocateCI' => 'Cannot allocate CI to IP: %1$s',
	'UI:IPManagement:Action:Allocate:IPv4Address:Done' => '%1$s <span class="hilite">%2$s</span> has been allocated.',
	'UI:IPManagement:Action:Unallocate:IPv4Address:PageTitle_Object_Class' => 'Un-allocate IP',
	'UI:IPManagement:Action:Unallocate:IPv4Address:Done' => '%1$s <span class="hilite">%2$s</span> has been unallocated.',

//
// Management of Domains
//
	// Creation Management	
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'Domain name already exists!',
		
	// Display list of domains
	'UI:IPManagement:Action:DisplayList:Domain' => 'Display List',
	'UI:IPManagement:Action:DisplayList:Domain+' => '',
	'UI:IPManagement:Action:DisplayList:Domain:PageTitle_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayList:Domain:Title_Class' => 'DNS Domains',
	
	// Display tree of domains
	'UI:IPManagement:Action:DisplayTree:Domain' => 'Display Tree',
	'UI:IPManagement:Action:DisplayTree:Domain+' => '',
	'UI:IPManagement:Action:DisplayTree:Domain:PageTitle_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayTree:Domain:Title_Class' => 'DNS Domains',
	'UI:IPManagement:Action:DisplayTree:Domain:OrgName' => 'Organization %1$s',
	
));
	