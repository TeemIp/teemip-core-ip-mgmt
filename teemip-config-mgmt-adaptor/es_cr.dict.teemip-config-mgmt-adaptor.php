<?php
// Copyright (C) 2021 TeemIp
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
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 * @traductor   Miguel Turrubiates <miguel_tf@yahoo.com> 
 * @notas       Utilizar codificación UTF-8 para mostrar acentos y otros caracteres especiales 
 */

//
// Class: ConnectableCI
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:ConnectableCI/Tab:ipaddresses_list' => 'Interfaces\' IPs',
	'Class:ConnectableCI/Tab:ipaddresses_list+' => 'Lista de todas las direcciones IP alojadas en todas las interfaces físicas asignada al EC',
));

//
// Class: DatacenterDevice
//
 
Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:DatacenterDevice/Attribute:managementip_id' => 'Administración de IPs',
	'Class:DatacenterDevice/Attribute:managementip_id+' => '',
	'Class:DatacenterDevice/Attribute:managementip_name' => 'Nombre',
	'Class:DatacenterDevice/Attribute:managementip_name+' => '',
));

//
// Class: NetworkInterface
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:NetworkInterface:baseinfo' => 'General Information',
	'Class:NetworkInterface:moreinfo' => 'More Information',
	'Class:NetworkInterface/Attribute:operational_status' => 'Estatus Operativo',
	'Class:NetworkInterface/Attribute:operational_status+' => 'Calculado a partir del estado de las clases secundarias',
	'Class:NetworkInterface/Attribute:operational_status/Value:active' => 'Activo',
	'Class:NetworkInterface/Attribute:operational_status/Value:active+' => '',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive' => 'Inactivo',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive+' => '',
));

//
// Class: IPInterface
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPInterface/Attribute:ip_list' => 'Dirección IP',
	'Class:IPInterface/Attribute:ip_list+' => '',
));

//
// Class: PhysicalInterface
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:PhysicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:PhysicalInterface/Attribute:vrfs_list+' => '',
	'Class:PhysicalInterface/Attribute:status' => 'Estatus',
	'Class:PhysicalInterface/Attribute:status+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:stock' => 'En Inventario',
	'Class:PhysicalInterface/Attribute:status/Value:stock+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:active' => 'Activo',
	'Class:PhysicalInterface/Attribute:status/Value:active+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:inactive' => 'Inactivo',
	'Class:PhysicalInterface/Attribute:status/Value:inactive+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete' => 'Obsoleto',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete+' => '',
));

//
// Class: VLAN
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:VLAN/Tab:ipaddresses_list' => 'IP de interfaces',
	'Class:VLAN/Tab:ipaddresses_list+' => 'Lista de todas las direcciones IP alojadas por todas las interfaces IP conectadas al CI',
));
