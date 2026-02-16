<?php
/*
 * @copyright   Copyright (C) 2010-2026 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'Teemip-Network-Mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// Class: DNSObject
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:DNSObject' => 'Objeto DNS',
	'Class:DNSObject+' => '',
	'Class:DNSObject/Attribute:finalclass' => 'Subclasse',
	'Class:DNSObject/Attribute:finalclass+' => 'Nome da classe final',
	'Class:DNSObject/Attribute:org_id' => 'Organização',
	'Class:DNSObject/Attribute:org_id+' => '',
	'Class:DNSObject/Attribute:org_name' => 'Nome da Organização',
	'Class:DNSObject/Attribute:org_name+' => '',
	'Class:DNSObject/Attribute:name' => 'Nome do objeto DNS',
	'Class:DNSObject/Attribute:name+' => '',
	'Class:DNSObject/Attribute:comment' => 'Descrição',
	'Class:DNSObject/Attribute:comment+' => '',
));

//
// Class: Domain
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:Domain' => 'Domínio',
	'Class:Domain+' => 'Domínio DNS',
	'Class:Domain:baseinfo' => 'Informações Gerais',
	'Class:Domain:admininfo' => 'Informações Administrativas',
	'Class:Domain:DelegatedToChild' => '<delegation_highlight>Delegado para a organização: </delegation_highlight>%1$s',
	'Class:Domain:DelegatedFromParent' => '<delegation_highlight>Delegado da organização: </delegation_highlight>%1$s',
	'Class:Domain/Attribute:name' => 'Nome',
	'Class:Domain/Attribute:name+' => '',
	'Class:Domain/Attribute:parent_org_id' => 'Delegado de',
	'Class:Domain/Attribute:parent_org_id+' => 'Organização da qual o Domínio foi delegado',
	'Class:Domain/Attribute:parent_org_name' => 'Nome da organização delegadora',
	'Class:Domain/Attribute:parent_org_name+' => 'Nome da organização da qual o Domínio foi delegado',
	'Class:Domain/Attribute:parent_id' => 'Pai',
	'Class:Domain/Attribute:parent_id+' => '',
	'Class:Domain/Attribute:parent_name' => 'Nome do pai',
	'Class:Domain/Attribute:parent_name+' => '',
	'Class:Domain/Attribute:requestor_id' => 'Solicitante',
	'Class:Domain/Attribute:requestor_id+' => '',
	'Class:Domain/Attribute:requestor_name' => 'Nome do solicitante',
	'Class:Domain/Attribute:requestor_name+' => '',
	'Class:Domain/Attribute:release_date' => 'Data de liberação',
	'Class:Domain/Attribute:release_date+' => 'Data em que o domínio foi liberado e não é mais usado.',
	'Class:Domain/Attribute:registrar_id' => 'Registrador de Internet',
	'Class:Domain/Attribute:registrar_id+' => 'Organização responsável pela alocação de nomes de domínio.',
	'Class:Domain/Attribute:registrar_name' => 'Nome do Registrador de Internet',
	'Class:Domain/Attribute:registrar_name+' => '',
	'Class:Domain/Attribute:validity_start' => 'Data de início ',
	'Class:Domain/Attribute:validity_start+' => 'Data a partir da qual o domínio é válido.',
	'Class:Domain/Attribute:validity_end' => 'Data de término',
	'Class:Domain/Attribute:validity_end+' => 'Data a partir da qual o domínio não é mais válido.',
	'Class:Domain/Attribute:renewal' => 'Renovação',
	'Class:Domain/Attribute:renewal+' => 'Método de renovação',
	'Class:Domain/Attribute:renewal/Value:na' => 'Não Aplicável',
	'Class:Domain/Attribute:renewal/Value:manual' => 'Manual',
	'Class:Domain/Attribute:renewal/Value:automatic' => 'Automática',
));

//
// Class extensions for Domain
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:Domain/Tab:hosts' => 'Hosts',
	'Class:Domain/Tab:hosts+' => 'Hosts que pertencem ao domínio',
	'Class:Domain/Tab:hosts/List0' => 'Hosts que pertencem ao domínio e seus filhos',
	'Class:Domain/Tab:hosts/SelectList0' => 'Exibir hosts que pertencem ao domínio e seus filhos',
	'Class:Domain/Tab:hosts/List1' => 'Apenas hosts diretamente anexados ao domínio',
	'Class:Domain/Tab:hosts/SelectList1' => 'Exibir apenas hosts diretamente anexados ao domínio',
	'Class:Domain/Tab:hosts/List2' => 'Apenas hosts anexados a domínios filhos',
	'Class:Domain/Tab:hosts/SelectList2' => 'Exibir apenas hosts anexados a domínios filhos',
	'Class:Domain/Tab:hosts/SelectList' => 'Alterar exibição',
	'Class:Domain/Tab:child_domain' => 'Domínios Filhos',
	'Class:Domain/Tab:child_domain+' => 'Domínios que estão direta ou indiretamente anexados',
	'Class:Domain/Tab:zones_list' => 'Zonas Relacionadas',
	'Class:Domain/Tab:zones_list+' => 'Zonas relacionadas ao domínio atual',
));

//
// Class: WANLink
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:WANLink' => 'Link WAN',
	'Class:WANLink+' => 'Link de Rede de Longa Distância',
	'Class:WANLink:baseinfo' => 'Informações Gerais',
	'Class:WANLink:networkinfo' => 'Informações de Rede',
	'Class:WANLink:admininfo' => 'Informações Administrativas',
	'Class:WANLink:locationinfo' => 'Localizações',
	'Class:WANLink:dateinfo' => 'Informações de Data',
	'Class:WANLink/Attribute:type_id' => 'Tipo',
	'Class:WANLink/Attribute:type_id+' => '',
	'Class:WANLink/Attribute:type_name' => 'Nome do Tipo',
	'Class:WANLink/Attribute:type_name+' => '',
	'Class:WANLink/Attribute:rate' => 'Velocidade',
	'Class:WANLink/Attribute:rate+' => '',
	'Class:WANLink/Attribute:burst_rate' => 'Velocidade de Pico',
	'Class:WANLink/Attribute:burst_rate+' => '',
	'Class:WANLink/Attribute:underlying_rate' => 'Velocidade Subjacente',
	'Class:WANLink/Attribute:underlying_rate+' => '',
	'Class:WANLink/Attribute:status' => 'Status',
	'Class:WANLink/Attribute:status+' => '',
	'Class:WANLink/Attribute:status/Value:implementation' => 'Implementação',
	'Class:WANLink/Attribute:status/Value:implementation+' => '',
	'Class:WANLink/Attribute:status/Value:production' => 'Produção',
	'Class:WANLink/Attribute:status/Value:production+' => '',
	'Class:WANLink/Attribute:status/Value:obsolete' => 'Obsoleto',
	'Class:WANLink/Attribute:status/Value:obsolete+' => '',
	'Class:WANLink/Attribute:status/Value:stock' => 'Em estoque',
	'Class:WANLink/Attribute:status/Value:stock+' => '',
	'Class:WANLink/Attribute:location_id1' => 'Localização #1',
	'Class:WANLink/Attribute:location_id1+' => 'Localização em uma extremidade do link',
	'Class:WANLink/Attribute:location_name1' => 'Nome da localização #1',
	'Class:WANLink/Attribute:location_name1+' => '',
	'Class:WANLink/Attribute:location_id2' => 'Localização #2',
	'Class:WANLink/Attribute:location_id2+' => 'Localização na outra extremidade do link',
	'Class:WANLink/Attribute:location_name2' => 'Nome da localização #2',
	'Class:WANLink/Attribute:location_name2+' => '',
	'Class:WANLink/Attribute:carrier_id' => 'Operadora',
	'Class:WANLink/Attribute:carrier_id+' => '',
	'Class:WANLink/Attribute:carrier_name' => 'Nome da Operadora',
	'Class:WANLink/Attribute:carrier_name+' => '',
	'Class:WANLink/Attribute:carrier_reference' => 'Referência da Operadora',
	'Class:WANLink/Attribute:carrier_reference+' => '',
	'Class:WANLink/Attribute:internal_reference' => 'Referência Interna',
	'Class:WANLink/Attribute:internal_reference+' => '',
	'Class:WANLink/Attribute:networkinterface_id1' => 'Interface de rede #1',
	'Class:WANLink/Attribute:networkinterface_id1+' => 'Interface de rede na localização #1',
	'Class:WANLink/Attribute:networkinterface_name1' => 'Nome da interface de rede #1',
	'Class:WANLink/Attribute:networkinterface_name1+' => '',
	'Class:WANLink/Attribute:networkinterface_id2' => 'Interface de rede #2',
	'Class:WANLink/Attribute:networkinterface_id2+' => 'Interface de rede na localização #2',
	'Class:WANLink/Attribute:networkinterface_name2' => 'Nome da interface de rede #2',
	'Class:WANLink/Attribute:networkinterface_name2+' => '',
	'Class:WANLink/Attribute:purchase_date' => 'Data do pedido',
	'Class:WANLink/Attribute:purchase_date+' => '',
	'Class:WANLink/Attribute:renewal_date' => 'Data de renovação',
	'Class:WANLink/Attribute:renewal_date+' => '',
	'Class:WANLink/Attribute:decommissioning_date' => 'Data de desativação',
	'Class:WANLink/Attribute:decommissioning_date+' => '',
));

//
// Class: WANType
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:WANType' => 'Tipo de WAN',
	'Class:WANType+' => '',
	'Class:WANType/Attribute:description' => 'Descrição',
	'Class:WANType/Attribute:description+' => '',
));

//
// Class: ASNumber
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:ASNumber' => 'Número AS',
	'Class:ASNumber+' => 'Número de Sistema Autônomo',
	'Class:ASNumber:baseinfo' => 'Informações Gerais',
	'Class:ASNumber:admininfo' => 'Informações Administrativas',
    'Class:ASNumber/Attribute:asnumberrange_id' => 'Faixa',
    'Class:ASNumber/Attribute:asnumberrange_id+' => 'Faixa de Número AS à qual o número pertence',
	'Class:ASNumber/Attribute:number' => 'Número',
	'Class:ASNumber/Attribute:number+' => '',
    'Class:ASNumber/Attribute:org_id+' => 'A entidade à qual o número foi atribuído',
	'Class:ASNumber/Attribute:registrar_id' => 'Registrador',
	'Class:ASNumber/Attribute:registrar_id+' => 'A autoridade responsável pela alocação deste Número AS',
	'Class:ASNumber/Attribute:registrar_name' => 'Nome do Registrador',
	'Class:ASNumber/Attribute:registrar_name+' => '',
	'Class:ASNumber/Attribute:whois' => 'Whois',
	'Class:ASNumber/Attribute:whois+' => 'URL para as informações de whois do registrador',
	'Class:ASNumber/Attribute:move2production' => 'Data de registro ',
	'Class:ASNumber/Attribute:move2production+' => 'Data em que o AS foi registrado.',
	'Class:ASNumber/Attribute:validity_end' => 'Data de término',
	'Class:ASNumber/Attribute:validity_end+' => 'Data a partir da qual o AS não é mais válido.',
	'Class:ASNumber/Attribute:renewal_date' => 'Data de renovação',
	'Class:ASNumber/Attribute:renewal_date+' => 'Data em que o AS foi renovado',
    'Class:ASNumber/Attribute:locations_list' => 'Localizações',
    'Class:ASNumber/Attribute:locations_list+' => 'Localizações onde o número AS foi implantado',
));

//
// Class: lnkASNumberToLocation
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
    'Class:lnkASNumberToLocation' => 'Vincular Número AS / Localização',
    'Class:lnkASNumberToLocation+' => '',
    'Class:lnkASNumberToLocation/Name' => '%1$s / %2$s',
    'Class:lnkASNumberToLocation/Attribute:asnumber_id' => 'Número AS',
    'Class:lnkASNumberToLocation/Attribute:asnumber_id+' => '',
    'Class:lnkASNumberToLocation/Attribute:asnumber_name' => 'Nome do Número AS',
    'Class:lnkASNumberToLocation/Attribute:asnumber_name+' => '',
    'Class:lnkASNumberToLocation/Attribute:asnumber_number' => 'Número AS',
    'Class:lnkASNumberToLocation/Attribute:asnumber_number+' => '',
    'Class:lnkASNumberToLocation/Attribute:location_id' => 'Localização',
    'Class:lnkASNumberToLocation/Attribute:location_id+' => '',
    'Class:lnkASNumberToLocation/Attribute:location_name' => 'Nome da Localização',
    'Class:lnkASNumberToLocation/Attribute:locqtion_name+' => '',
));

//
// Class: ASNumberRange
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
    'Class:ASNumberRange' => 'Faixa de Número AS',
    'Class:ASNumberRange+' => 'Faixa de Números de Sistema Autônomo',
    'Class:ASNumberRange:baseinfo' => 'Informações Gerais',
    'Class:ASNumberRange:admininfo' => 'Informações Administrativas',
    'Class:ASNumberRange/Attribute:first_number' => 'Primeiro número',
    'Class:ASNumberRange/Attribute:first_number+' => '',
    'Class:ASNumberRange/Attribute:last_number' => 'Último número',
    'Class:ASNumberRange/Attribute:last_number+' => '',
    'Class:ASNumberRange/Attribute:org_id+' => 'A entidade à qual a faixa foi atribuída',
    'Class:ASNumberRange/Attribute:registrar_id' => 'Registrador',
    'Class:ASNumberRange/Attribute:registrar_id+' => 'A autoridade responsável pelas alocações nesta faixa',
    'Class:ASNumberRange/Attribute:registrar_name' => 'Nome do Registrador',
    'Class:ASNumberRange/Attribute:registrar_name+' => '',
    'Class:ASNumberRange/Attribute:asnumbers_list' => 'Números AS',
    'Class:ASNumberRange/Attribute:asnumbers_list+' => 'Números AS que fazem parte da faixa',
));

//
// Class: VRF
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:VRF' => 'VRF',
	'Class:VRF+' => 'Roteamento e Encaminhamento Virtual',
	'Class:VRF:baseinfo' => 'Informações Gerais',
	'Class:VRF/Attribute:route_dist' => 'Route Distinguisher',
	'Class:VRF/Attribute:route_dist+' => '',
	'Class:VRF/Attribute:route_trgt' => 'Route Target',
	'Class:VRF/Attribute:route_trgt+' => '',
	'Class:VRF/Attribute:subnets_list' => 'Sub-redes',
	'Class:VRF/Attribute:subnets_list+' => '',
	'Class:VRF/Attribute:physicalinterfaces_list' => 'Interfaces de rede físicas',
	'Class:VRF/Attribute:physicalinterfaces_list+' => 'Lista de todas as interfaces de rede físicas anexadas à VRF',
	'Class:VRF/Attribute:networkdevicevirtualinterfaces_list' => 'Interfaces virtuais de dispositivo de rede',
	'Class:VRF/Attribute:networkdevicevirtualinterfaces_list+' => 'Lista de todas as interfaces virtuais de dispositivo de rede anexadas à VRF',
	'Class:VRF/Tab:ipaddresses_list' => 'IPs das Interfaces',
	'Class:VRF/Tab:ipaddresses_list+' => 'Lista de todos os endereços IP hospedados por todas as interfaces IP anexadas ao CI',
));

//
// Class: lnkPhysicalInterfaceToVRF
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkPhysicalInterfaceToVRF' => 'Vincular Interface Física / VRF',
	'Class:lnkPhysicalInterfaceToVRF+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Name' => '%1$s / %2$s',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id' => 'Interface Física',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name' => 'Nome da Interface Física',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id' => 'Dispositivo',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name' => 'Nome do dispositivo',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:physicalinterface_device_name+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_name' => 'Nome da VRF',
	'Class:lnkPhysicalInterfaceToVRF/Attribute:vrf_name+' => '',
));

//
// NetworkDevice
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:NetworkDevice/Attribute:physicalinterface_list' => 'Interfaces de rede físicas',
	'Class:NetworkDevice/Attribute:physicalinterface_list+' => 'Lista de todas as interfaces de rede físicas anexadas ao dispositivo de rede',
	'Class:NetworkDevice/Attribute:networkdevicevirtualinterfaces_list' => 'Interfaces de rede virtuais',
	'Class:NetworkDevice/Attribute:networkdevicevirtualinterfaces_list+' => 'Lista de todas as interfaces de rede virtuais anexadas ao dispositivo de rede',
	'Class:NetworkDevice/Tab:ipaddresses_list' => 'IPs das Interfaces',
	'Class:NetworkDevice/Tab:ipaddresses_list+' => 'Lista de todos os endereços IP hospedados por todas as interfaces físicas e virtuais anexadas ao dispositivo de rede',
));

//
// NetworkDeviceVirtualInterface
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:NetworkDeviceVirtualInterface' => 'Interface Virtual de Dispositivo de Rede',
	'Class:NetworkDeviceVirtualInterface+' => 'Interface virtual anexada a um dispositivo de rede',
	'Class:NetworkDeviceVirtualInterface/Attribute:status' => 'Status',
	'Class:NetworkDeviceVirtualInterface/Attribute:status+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:active' => 'Ativa',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:active+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:inactive' => 'Inativa',
	'Class:NetworkDeviceVirtualInterface/Attribute:status/Value:inactive+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:networkdevice_id' => 'Dispositivo de rede',
	'Class:NetworkDeviceVirtualInterface/Attribute:networkdevice_id+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:vlans_list' => 'VLANs',
	'Class:NetworkDeviceVirtualInterface/Attribute:vlans_list+' => '',
	'Class:NetworkDeviceVirtualInterface/Attribute:vrfs_list' => 'VRFs',
	'Class:NetworkDeviceVirtualInterface/Attribute:vrfs_list+' => '',
));

//
// Class: lnkNetworkDeviceVirtualInterfaceToVLAN
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN' => 'Vincular Interface Virtual de Dispositivo de Rede / VLAN',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Name' => '%1$s / %2$s',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_id' => 'Interface virtual de dispositivo de rede',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_name' => 'Nome da interface virtual de dispositivo de rede',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_id' => 'Dispositivo de rede',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_name' => 'Nome do dispositivo de rede',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:networkdevicevirtualinterface_device_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_id' => 'VLAN',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_tag' => 'Tag',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:vlan_tag+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode' => 'Modo',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode+' => 'Modo com tag (tagged) ou sem tag (untagged)',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:tagged' => 'Tagged',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:tagged+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:untagged' => 'Untagged',
	'Class:lnkNetworkDeviceVirtualInterfaceToVLAN/Attribute:mode/Value:untagged+' => '',
));

//
// Class: lnkNetworkDeviceVirtualInterfaceToVRF
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF' => 'Vincular Interface Virtual de Dispositivo de Rede / VRF',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Name' => '%1$s / %2$s',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_id' => 'Interface virtual de dispositivo de rede',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_name' => 'Nome da interface virtual de dispositivo de rede',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_id' => 'Dispositivo de rede',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_name' => 'Nome do dispositivo de rede',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:networkdevicevirtualinterface_device_name+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:vrf_id' => 'VRF',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:vrf_id+' => '',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:vrf_name' => 'Nome da VRF',
	'Class:lnkNetworkDeviceVirtualInterfaceToVRF/Attribute:vrf_name+' => '',
));

//
// VLAN
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Class:VLAN/Attribute:physicalinterface_list+' => 'Lista de todas as interfaces de rede físicas anexadas à VLAN',
	'Class:VLAN/Attribute:networkdevicevirtualinterfaces_list' => 'Interfaces virtuais de dispositivo de rede',
	'Class:VLAN/Attribute:networkdevicevirtualinterfaces_list+' => 'Lista de todas as interfaces virtuais de dispositivo de rede anexadas à VLAN',
    'Class:VLAN/Attribute:interfaces_list' => 'Interfaces de rede',
    'Class:VLAN/Attribute:interfaces_list+' => 'Lista de todas as interfaces de rede anexadas à VLAN',
));

//
// Application Menu
//

Dict::Add('PT BR', 'Brazilian', 'Brazilian', array(
	'Menu:ConfigManagement:TeemIpNetworking' => 'Rede',
	'Menu:ConfigManagement:TeemIpNetworking:Interfaces' => 'Interfaces',
	'Menu:ConfigManagement:TeemIpNetworking:Connectivity' => 'Conectividade',
	'Menu:ConfigManagement:TeemIpNetworking:Naming' => 'Nomenclatura',
    'Menu:NetworkMgmt:Typology' => 'Configuração da Tipologia de Rede',

//
// Management of AS Numbers
//
    // Creation Management
    'UI:IPManagement:Action:New:ASNumberRange:WrongNumberOrder' => 'O primeiro número é maior ou igual ao último número',
    'UI:IPManagement:Action:New:ASNumber:NotInRange' => 'O Número AS não está na Faixa de Número AS especificada',

//
// Management of Domains
//
	// Creation Management	
	'UI:IPManagement:Action:New:Domain:NameCollision' => 'O nome de domínio já existe!',

	// Update Management
	'UI:IPManagement:Action:ChangeOrg:Domain:HasParentInOtherOrg' => 'A organização não pode ser alterada: o domínio pai não pertence à nova organização!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasChildren' => 'A organização não pode ser alterada: o domínio tem filhos!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasHosts' => 'A organização não pode ser alterada: hosts da organização original estão usando o domínio!',
	'UI:IPManagement:Action:ChangeOrg:Domain:HasZones' => 'A organização não pode ser alterada: as zonas são baseadas no domínio!',

	// Display list of domains
	'UI:IPManagement:Action:DisplayList:Domain' => 'Exibir Lista',
	'UI:IPManagement:Action:DisplayList:Domain+' => '',
	'UI:IPManagement:Action:DisplayList:Domain:PageTitle_Class' => 'Domínios DNS',
	'UI:IPManagement:Action:DisplayList:Domain:Title_Class' => 'Domínios DNS',

	// Display tree of domains
	'UI:IPManagement:Action:DisplayTree:Domain' => 'Exibir Árvore',
	'UI:IPManagement:Action:DisplayTree:Domain+' => '',
	'UI:IPManagement:Action:DisplayTree:Domain:PageTitle_Class' => 'Domínios DNS',
	'UI:IPManagement:Action:DisplayTree:Domain:Title_Class' => 'Domínios DNS',
	'UI:IPManagement:Action:DisplayTree:Domain:OrgName' => 'Organização %1$s',

	// Delegate action on domains
	'UI:IPManagement:Action:Delegate:Domain' => 'Delegar',
	'UI:IPManagement:Action:Delegate:Domain:PageTitle_Object_Class' => '%1$s - Delegar',
	'UI:IPManagement:Action:Delegate:Domain:Title_Class_Object' => 'Delegar %1$s %2$s para organização',
	'UI:IPManagement:Action:Delegate:Domain:ChildDomain' => 'Organização para a qual delegar o Domínio:',
	'UI:IPManagement:Action:Delegate:Domain:NoChildOrg' => 'A organização do domínio não possui filhos e, portanto, o domínio não pode ser delegado!',
	'UI:IPManagement:Action:Delegate:Domain:NoOtherOrg' => 'Não há outra organização além da organização do domínio!',
	'UI:IPManagement:Action:Delegate:Domain:IsDelegated' => 'O domínio já está delegado!',
	'UI:IPManagement:Action:Delegate:Domain:CannotBeDelegated' => 'O domínio não pode ser delegado: %1$s',
	'UI:IPManagement:Action:Delegate:Domain:NoChangeOfOrganization' => 'A organização para a qual delegar o domínio não pode ser a mesma do domínio!',
	'UI:IPManagement:Action:Delegate:Domain:HasHosts' => 'O domínio tem hosts!',
	'UI:IPManagement:Action:Delegate:Domain:HasSubDomains' => 'O domínio tem subdomínios!',
	'UI:IPManagement:Action:Delegate:Domain:HasZones' => 'As zonas estão se referindo ao domínio!',
	'UI:IPManagement:Action:Delegate:Domain:Done' => '%1$s %2$s foi delegado.',

	// Undelegate action on domains
	'UI:IPManagement:Action:Undelegate:Domain' => 'Remover delegação',
	'UI:IPManagement:Action:Undelegate:Domain:PageTitle_Object_Class' => '%1$s - Remover delegação',
	'UI:IPManagement:Action:Undelegate:Domain:CannotBeUndelegated' => 'A delegação do domínio não pode ser removida: %1$s',
	'UI:IPManagement:Action:Undelegate:Domain:IsNotDelegated' => 'O domínio não está delegado',
	'UI:IPManagement:Action:Undelegate:Domain:HasHosts' => 'O domínio tem hosts!',
	'UI:IPManagement:Action:Undelegate:Domain:HasSubDomains' => 'O domínio tem subdomínios!',
	'UI:IPManagement:Action:Undelegate:Domain:HasZones' => 'As zonas estão se referindo ao domínio!',
	'UI:IPManagement:Action:Undelegate:Domain:Done' => 'A delegação de %1$s %2$s foi removida.',

	// Look for domain when exploding FQDN
	'UI:IPManagement:Action:ExplodeFQDN:Domain:Error:CannotFindDomain' => 'Não foi possível encontrar o domínio registrado no FQDN!',
));
