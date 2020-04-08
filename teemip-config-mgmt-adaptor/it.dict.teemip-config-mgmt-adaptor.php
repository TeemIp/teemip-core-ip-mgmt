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

//
// Class: ConnectableCI
//
 
Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:ConnectableCI/Tab:ipaddresses_list' => 'Interfacce IP',
	'Class:ConnectableCI/Tab:ipaddresses_list+' => 'Lista di tutti gli indirizzi appartenenti alle interfacce fisiche collegate ai CI',
));

//
// Class: DatacenterDevice
//
 
Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:DatacenterDevice/Attribute:managementip_id' => 'Management IP',
	'Class:DatacenterDevice/Attribute:managementip_id+' => '',
	'Class:DatacenterDevice/Attribute:managementip_name' => 'Management IP Name',
	'Class:DatacenterDevice/Attribute:managementip_name+' => '',
));

//
// Class: IPInterface
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPInterface/Attribute:ip_list' => 'Indirizzi IP',
	'Class:IPInterface/Attribute:ip_list+' => '',
));

//
// Class: PhysicalInterface
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:PhysicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:PhysicalInterface/Attribute:vrfs_list+' => '',
));

//
// Class: VLAN
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:VLAN/Tab:ipaddresses_list' => 'Interfacce IP',
	'Class:VLAN/Tab:ipaddresses_list+' => 'Elenco di tutti gli indirizzi IP ospitati da tutte le interfacce IP collegate all\'elemento della configurazione',
));
