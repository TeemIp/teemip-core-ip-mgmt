<?php
/// Copyright (C) 2014 TeemIp
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
 * @copyright   Copyright (C) 2014 TeemIp
 * @copyright   Copyright (C) 2014 ITOMIG GmbH (deutsche Übersetzung)
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: ConnectableCI
//
 
Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:ConnectableCI/Tab:ipaddresses_list' => 'IPs-Interfaces',
	'Class:ConnectableCI/Tab:ipaddresses_list+' => 'Liste aller IP-Adressen aller an das CI angeschlossenen Physisches Interface',
));

//
// Class: DatacenterDevice
//
 
Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:DatacenterDevice/Attribute:managementip_id' => 'Management IP',
	'Class:DatacenterDevice/Attribute:managementip_id+' => '',
	'Class:DatacenterDevice/Attribute:managementip_name' => 'Management IP Name',
	'Class:DatacenterDevice/Attribute:managementip_name+' => '',
));

//
// Class: IPInterface
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:IPInterface/Attribute:ipaddress_id' => 'IP Adresse',
	'Class:IPInterface/Attribute:ipaddress_id+' => '',
));
			   
//
// Class: PhysicalInterface
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:PhysicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:PhysicalInterface/Attribute:vrfs_list+' => '',
));
