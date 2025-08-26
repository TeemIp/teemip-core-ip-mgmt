<?php
/*
 * @copyright   Copyright (C) 2010-2025 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class: ConnectableCI
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:ConnectableCI/Tab:ipaddresses_list' => 'IPs das Interfaces',
	'Class:ConnectableCI/Tab:ipaddresses_list+' => 'Lista de todos os endereços IP hospedados por todas as interfaces físicas anexadas ao CI',
));

//
// Class: DatacenterDevice
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:DatacenterDevice/Attribute:managementip_id' => 'IP de Gerenciamento',
	'Class:DatacenterDevice/Attribute:managementip_id+' => '',
	'Class:DatacenterDevice/Attribute:managementip_name' => 'Nome do IP de Gerenciamento',
	'Class:DatacenterDevice/Attribute:managementip_name+' => '',
));

//
// Class: NetworkInterface
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:NetworkInterface:baseinfo' => 'Informações Gerais',
	'Class:NetworkInterface:wiringinfo' => 'Informações de Cabeamento',
	'Class:NetworkInterface:moreinfo' => 'Mais Informações',
	'Class:NetworkInterface/Attribute:operational_status' => 'Status operacional',
	'Class:NetworkInterface/Attribute:operational_status+' => 'Calculado a partir do status das classes filhas',
	'Class:NetworkInterface/Attribute:operational_status/Value:active' => 'Ativo',
	'Class:NetworkInterface/Attribute:operational_status/Value:active+' => '',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive' => 'Inativo',
	'Class:NetworkInterface/Attribute:operational_status/Value:inactive+' => '',
));

//
// Class: IPInterface
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:IPInterface/Attribute:ip_list' => 'Endereços IP',
	'Class:IPInterface/Attribute:ip_list+' => '',
));

//
// Class: PhysicalInterface
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:PhysicalInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:PhysicalInterface/Attribute:vrfs_list+' => '',
	'Class:PhysicalInterface/Attribute:status' => 'Status',
	'Class:PhysicalInterface/Attribute:status+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:stock' => 'Em estoque',
	'Class:PhysicalInterface/Attribute:status/Value:stock+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:active' => 'Ativa',
	'Class:PhysicalInterface/Attribute:status/Value:active+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:inactive' => 'Inativa',
	'Class:PhysicalInterface/Attribute:status/Value:inactive+' => '',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete' => 'Obsoleta',
	'Class:PhysicalInterface/Attribute:status/Value:obsolete+' => '',
    'Class:PhysicalInterface/Attribute:org_id' => 'Organização',
    'Class:PhysicalInterface/Attribute:org_id+' => 'Organização do CI conectável ao qual a interface pertence',
    'Class:PhysicalInterface/Attribute:location_id' => 'Localização',
    'Class:PhysicalInterface/Attribute:location_id+' => 'Localização do CI conectável ao qual a interface pertence',
));

//
// Class: VLAN
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:VLAN/Tab:ipaddresses_list' => 'IPs das Interfaces',
	'Class:VLAN/Tab:ipaddresses_list+' => 'Lista de todos os endereços IP hospedados por todas as interfaces IP anexadas ao CI',
));

//
// Class: lnkPhysicalInterfaceToVLAN
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode' => 'Modo',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode+' => 'Modo com tag (tagged) ou sem tag (untagged)',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkPhysicalInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));