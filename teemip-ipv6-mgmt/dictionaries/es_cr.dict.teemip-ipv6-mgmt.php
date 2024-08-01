<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes in 'teemip-ipv6-mgmt Module'
//////////////////////////////////////////////////////////////////////
//

//
// TeemIp specific attributes
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Core:AttributeIPv6Address' => 'Dirección IPv6',
	'Core:AttributeIPv6Address+' => '',
));

//
// Class: IPv6Block
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPv6Block' => 'Bloque Subred IPv6',
	'Class:IPv6Block+' => '',
	'Class:IPv6Block/Attribute:parent_id' => 'Padre',
	'Class:IPv6Block/Attribute:parent_id+' => '',
	'Class:IPv6Block/Attribute:parent_name' => 'Nombre Padre',
	'Class:IPv6Block/Attribute:parent_name+' => '',
	'Class:IPv6Block/Attribute:parent_origin' => 'Origen del bloque padre',
	'Class:IPv6Block/Attribute:parent_origin+' => '',
	'Class:IPv6Block/Attribute:firstip' => 'Primer IP',
	'Class:IPv6Block/Attribute:firstip+' => 'Primer dirección IP de Bloque de Subred',
	'Class:IPv6Block/Attribute:lastip' => 'Última IP',
	'Class:IPv6Block/Attribute:lastip+' => 'Última dirección IP de Bloque de Subred',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix' => 'Tamaño mínimo de los bloques de subred IPv6',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix' => 'Talla minima',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:default' => 'Alineado con la configuración de IP global ',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned' => 'Alinear bloques de subred IPv6 con CIDR',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_yes' => 'Si',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned' => 'Alinear bloques de subred con CIDR',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:default' => 'Alineado con la configuración de IP global',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_yes' => 'Si',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_yes+' => '',
));

//
// Class: IPv6Subnet
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPv6Subnet' => 'Subred IPv6',
	'Class:IPv6Subnet+' => '',
	'Class:IPv6Subnet/Attribute:block_id' => 'Bloque Subred',
	'Class:IPv6Subnet/Attribute:block_id+' => '',
	'Class:IPv6Subnet/Attribute:block_name' => 'Nombre Bloque',
	'Class:IPv6Subnet/Attribute:block_name+' => '',
	'Class:IPv6Subnet/Attribute:ip' => 'IP Subred',
	'Class:IPv6Subnet/Attribute:ip+' => '',
	'Class:IPv6Subnet/Attribute:mask' => 'Máscara',
	'Class:IPv6Subnet/Attribute:mask+' => '',
	'Class:IPv6Subnet/Attribute:gatewayip' => 'Gateway IP',
	'Class:IPv6Subnet/Attribute:gatewayip+' => '',
	'Class:IPv6Subnet/Attribute:lastip' => 'Última IP de Subred',
	'Class:IPv6Subnet/Attribute:lastip+' => '',
	'Class:IPv6Subnet/Attribute:summary' => 'Resumen',
	'Class:IPv6Subnet/Attribute:ipconfig_ipv6_gateway_ip_format' => 'Default Gateway IP format~~',
	'Class:IPv6Subnet/Attribute:ipconfig_ipv6_gateway_ip_format+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format' => 'Gateway IP format~~',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:default' => 'Alineado con la configuración de IP global',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1' => 'Subnet IP + 1',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:lastip' => 'Última IP de subred',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:lastip+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:free_setup' => 'Asignación libra',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:free_setup+' => '',
));

//
// Class extensions for IPv6Subnet
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPv6Subnet/Tab:ipregistered-count' => '%1$s reservadas, %2$s asignadas, %3$s Liberado y %4$s No Asignado',
));

//
// Class: IPv6Range
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPv6Range' => 'Rango IPv6',
	'Class:IPv6Range+' => '',
	'Class:IPv6Range/Attribute:subnet_id' => 'Subred',
	'Class:IPv6Range/Attribute:subnet_id+' => '',
	'Class:IPv6Range/Attribute:subnet_ip' => 'IP Subred',
	'Class:IPv6Range/Attribute:subnet_ip+' => '',
	'Class:IPv6Range/Attribute:firstip' => 'Primer IP del Rango',
	'Class:IPv6Range/Attribute:firstip+' => '',
	'Class:IPv6Range/Attribute:lastip' => 'Última IP del Rango',
	'Class:IPv6Range/Attribute:lastip+' => '',
));

//
// Class: IPv6Address
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Class:IPv6Address' => 'Dirección IPv6',
	'Class:IPv6Address+' => '',
	'Class:IPv6Address/Attribute:subnet_id' => 'Subred',
	'Class:IPv6Address/Attribute:subnet_id+' => 'Subred IPv6',
	'Class:IPv6Address/Attribute:range_id' => 'Rango',
	'Class:IPv6Address/Attribute:range_id+' => 'Rango IPv6',
	'Class:IPv6Address/Attribute:ip' => 'Dirección',
	'Class:IPv6Address/Attribute:ip+' => 'Dirección IPv6',
));

//
// Application Menu
//

Dict::Add('ES CR', 'Spanish', 'Español, Castellano', array(
	'Menu:IPSpace:IPv6Objects' => 'Objetos IPv6',
	'Menu:IPSpace:IPv6Objects+' => 'Objetos IPv6',
	'Menu:Ipv6ShortCut' => 'Atajos IPv6',
	'Menu:Ipv6ShortCut+' => 'Atajos IPv6',
	'Menu:IPv6Block' => 'Bloques de Subred',
	'Menu:IPv6Block+' => 'Bloques de Subred IPv6',
	'Menu:IPv6Subnet' => 'Subredes',
	'Menu:IPv6Subnet+' => 'Subredes IPv6',
	'Menu:IPv6Subnet:Allocated' => 'Subredes Asiganadas',
	'Menu:IPv6Subnet:Allocated+' => 'Lista de subredes IPv6 asignadas',
	'Menu:IPv6Range' => 'Rangos IP',
	'Menu:IPv6Range+' => 'Rangos IPv6',
	'Menu:IPv6Address' => 'Direccines IP',
	'Menu:IPv6Address+' => 'Direcciones IPv6',

//
// Management of Subnet Blocks
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPv6Block:NotIPv6' => 'IPs are not IPv6 IPs',

	// Display details of subnet blocks
	'UI:IPManagement:Action:Details:IPv6Block' => 'Detalles',
	'UI:IPManagement:Action:Details:IPv6Block+' => '',

	// Display list of subnet blocks
	'UI:IPManagement:Action:DisplayList:IPv6Block' => 'Desplegar Lista',
	'UI:IPManagement:Action:DisplayList:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Block:PageTitle_Class' => 'Bloques Subred IPv6',
	'UI:IPManagement:Action:DisplayList:IPv6Block:Title_Class' => 'Bloques Subred IPv6',

	// Display tree of subnet blocks
	'UI:IPManagement:Action:DisplayTree:IPv6Block' => 'Desplegar Árbol',
	'UI:IPManagement:Action:DisplayTree:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:PageTitle_Class' => 'Bloques Subred IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:Title_Class' => 'Bloques Subred IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:OrgName' => 'Organización %1$s',

	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPv6Block' => 'Compresión',
	'UI:IPManagement:Action:Shrink:IPv6Block+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary' => 'Resumen',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s comprimir',
	'UI:IPManagement:Action:Shrink:IPv6Block:Title_Class_Object' => 'Comprimir %1$s: %2$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewFirstIP' => 'Nueva primer IP del Bloque :',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewLastIP' => 'Nueva última IP del Bloque :',
	'UI:IPManagement:Action:Shrink:IPv6Block:IsDelegated' => 'Este bloque está delegado y por lo tanto no puede comprimirse!',
	'UI:IPManagement:Action:Shrink:IPv6Block:CannotBeShrunk' => 'Bloque no puede ser comprimido: %1$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:SmallerThanMinSize' => 'Tamaño de Bloque no puede ser menor a /%1$s !',
	'UI:IPManagement:Action:Shrink:IPv6Block:Done' => '%1$s %2$s ha sido comprimido.',

	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv6Block' => 'División',
	'UI:IPManagement:Action:Split:IPv6Block+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:Summary' => 'Resumen',
	'UI:IPManagement:Action:Split:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s dividir',
	'UI:IPManagement:Action:Split:IPv6Block:Title_Class_Object' => 'Dividir %1$s: %2$s',
	'UI:IPManagement:Action:Split:IPv6Block:At' => 'Primer IP del nuevo Bloque de Subred :',
	'UI:IPManagement:Action:Split:IPv6Block:NameNewBlock' => 'Nombre de nuevo Bloque de Subred :',
	'UI:IPManagement:Action:Split:IPv6Block:IsDelegated' => 'Este bloque está delegado y por lotanto no puede dividirse!',
	'UI:IPManagement:Action:Split:IPv6Block:CannotBeSplit' => 'Bloque no puede ser dividido: %1$s',
	'UI:IPManagement:Action:Split:IPv6Block:SmallerThanMinSize' => 'Tamaño de Bloque no puede ser menor a /%1$s !',
	'UI:IPManagement:Action:Split:IPv6Block:Done' => '%1$s %2$s ha sido dividido.',

	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv6Block' => 'Expandir',
	'UI:IPManagement:Action:Expand:IPv6Block+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary' => 'Resumen',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s expandir',
	'UI:IPManagement:Action:Expand:IPv6Block:Title_Class_Object' => 'Expandir %1$s: %2$s',
	'UI:IPManagement:Action:Expand:IPv6Block:NewFirstIP' => 'Nueva primer IP del Bloque :',
	'UI:IPManagement:Action:Expand:IPv6Block:NewLastIP' => 'Nueva última IP del Bloque :',
	'UI:IPManagement:Action:Expand:IPv6Block:IsDelegated' => 'Este bloque está delegado y por lotanto no puede expandirse!',
	'UI:IPManagement:Action:Expand:IPv6Block:CannotBeExpanded' => 'Bloque no puede ser expandido: %1$s',
	'UI:IPManagement:Action:Expand:IPv6Block:SmallerThanMinSize' => 'Tamaño de Bloque no puede ser menor a /%1$s !',
	'UI:IPManagement:Action:Expand:IPv6Block:Done' => '%1$s %2$s ha sido expandido.',

	// List space action on subnet blocks 
	'UI:IPManagement:Action:ListSpace:IPv6Block' => 'Listar Espacio',
	'UI:IPManagement:Action:ListSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Espacio',
	'UI:IPManagement:Action:ListSpace:IPv6Block:Title_Class_Object' => 'Espacio contenido %1$s: %2$s',
	'UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpace' => 'Libre [%1$s - %2$s] - %3$.2e IPs - %4$.2f %%',

	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv6Block' => 'Encontrar Espacio',
	'UI:IPManagement:Action:FindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Encontrar espacio',
	'UI:IPManagement:Action:FindSpace:IPv6Block:Title_Class_Object' => 'Ver espacio contenido en %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv6Block:SizeOfSpace' => 'Tamaño de espacio a ver por :',
	'UI:IPManagement:Action:FindSpace:IPv6Block:MaxNumberOfOffers' => 'Máximo número de oferentes :',

	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Encontrar Espacio',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Title_Class_Object' => 'Espacio contenido en %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Summary' => '%1$s primer /%2$s dentro de bloque',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsBlock' => 'Crear como bloque hijo',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsSubnet' => 'Crear como subred',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv6Block' => 'Delegar',
	'UI:IPManagement:Action:Delegate:IPv6Block:PageTitle_Object_Class' => '%1$s - Delegar',
	'UI:IPManagement:Action:Delegate:IPv6Block:Title_Class_Object' => 'Delegar %1$s %2$s a Organización dependiente',
	'UI:IPManagement:Action:Delegate:IPv6Block:ChildBlock' => 'Organización Dependiente a delegar Bloque:',
	'UI:IPManagement:Action:Delegate:IPv6Block:NoChildOrg' => 'Organización del Bloque no tiene dependientes, por lo que el bloque no puede ser delegado!',
	'UI:IPManagement:Action:Delegate:IPv6Block:CannotBeDelegated' => 'Bloque no puede ser delegado: %1$s',
	'UI:IPManagement:Action:Delegate:IPv6Block:Done' => '%1$s %2$s ha sido delegado.',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPv6Block:CannotBeUndelegated' => 'Bloque no se puede anular la delegación : %1$s',
	'UI:IPManagement:Action:Undelegate:IPv6Block' => 'Eliminar Delegación',
	'UI:IPManagement:Action:Undelegate:IPv6Block:PageTitle_Object_Class' => '%1$s - eliminar delegación',
	'UI:IPManagement:Action:Undelegate:IPv6Block:Done' => '%1$s %2$s se ha eliminado delegación.',

//
// Management of Subnets
//
	// Operations on subnets
	'UI:IPManagement:Action:xxx:IPv6Subnet:OperationNotAllowed' => 'Operación no permitida en subredes IPv6!',

	// Display details of subnet
	'UI:IPManagement:Action:Details:IPv6Subnet' => 'Detalles',
	'UI:IPManagement:Action:Details:IPv6Subnet+' => '',

	// Display list of subnets
	'UI:IPManagement:Action:DisplayList:IPv6Subnet' => 'Desplegar Lista',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:PageTitle_Class' => 'Subredes IPv6',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:Title_Class' => 'Subredes IPv6',

	// Display tree of subnets
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet' => 'Desplegar Árbol',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:PageTitle_Class' => 'Subredes IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:Title_Class' => 'Subredes IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:OrgName' => 'Organización %1$s',

	// Find space action on subnets 
	'UI:IPManagement:Action:FindSpace:IPv6Subnet' => 'Encontrar Espacio',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - Encontrar Espacio',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:Title_Class_Object' => 'Buscar espacio contenido en %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeTooSmall' => 'Subred es demasiado pequeña para buscar por espacio, por favor cancelar!',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeOfRange' => 'Tamaño de espacio para buscar :',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:MaxNumberOfOffers' => 'Máximo número de oferentes :',

	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - Encontrar Espacio',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Title_Class_Object' => 'Espacio contenido en %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Summary' => '%1$s primer rango IP %2$s libre dentro de la subred',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:RangeTooBig' => 'Espacio solicitado no cabe en la subred. Por favor intentar un valor menor.',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:CreateAsRange' => 'Crear como rango IPv6',

	// List IPs action on subnets 
	'UI:IPManagement:Action:ListIps:IPv6Subnet' => 'Listar & Seleccionar IPs',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Title_Class_Object' => 'Lista de IPs contenidas en %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Subtitle_ListRange' => 'Subred es demasiado grande para listar todas las IPs. Por favor seleccione un rango para desplegar:',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:FirstIP' => 'Primer IP de la lista',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:LastIP' => 'Última IP de la lista',

	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv6Subnet' => 'Listar & Seleccionar IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:Title_Class_Object' => 'Lista parcial de IPs contenidas en %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:CannotBeListed' => 'IPs no pueden ser listadas: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIPOutOfSubnet' => 'Primer IP está fuera de la subred',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:LastIPOutOfSubnet' => 'Última IP está fuera de la subred',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'First IP of range is higher than last IP!',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet' => 'Exportar IPs a CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV exportar IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Title_Class_Object' => 'Exportación CSV IPs de %1$s: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Subtitle_ListRange' => 'Subred es demasidao grande para exportar todas las IPs. Por favor seeccione un rango a desplegar:',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:FirstIP' => 'Primer IP de la lista',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:LastIP' => 'Última IP de la lista',

	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet' => 'Exportar IPs a CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s CSV exportar IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:Title_Class_Object' => 'Exportación CSV parcial de IPs contenidas en %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:CannotBeListed' => 'IPs no pueden ser listadas: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIPOutOfSubnet' => 'Primer IP está fuera de la subred',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:LastIPOutOfSubnet' => 'Última IP está fuera de la subred',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'Primer IP del rango es mayor a última IP!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv6Subnet' => 'Calculadora de Subred',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:PageTitle_Object_Class' => '%2$s Calculadora',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Title_Class_Object' => 'Calculadora para %1$s',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:IP' => 'Dirección IP',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Prefix' => 'Prefijo',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet' => 'Calculadora de Subred',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PageTitle_Object_Class' => '%2$s Calculadora',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Title_Class_Object' => '%1$s - resultado de Calculadora',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CompressedIP' => 'IP Address - Formato comprimido',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CanonicalIP' => 'IP Address - Formato Canónico',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Prefix' => 'Prefijo',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PrefixMask' => 'Máscara de Prefijo',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NetworkIP' => 'Subred IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:LastIP' => 'Última IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:IPNumber' => 'Número de IPs',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet' => 'Subred IP previa',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet:NA' => 'No Aplica',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet' => 'Siguiente Subred IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet:NA' => 'No Aplica',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CannotRun' => 'Calculadora de Subred no puede ejecutar: %1$s',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:EnterPrefix' => 'Ingrese un Prefijo!',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:WrongPrefix' => 'Prefijo es inválido!',

//
// Management of IP ranges
//
	// Display details of IP Range
	'UI:IPManagement:Action:Details:IPv6Range' => 'Detalles',
	'UI:IPManagement:Action:Details:IPv6Range+' => '',

	// List IPs action on IP Ranges 
	'UI:IPManagement:Action:ListIps:IPv6Range' => 'Listar & Seleccionar IPs',
	'UI:IPManagement:Action:ListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:ListIps:IPv6Range:Title_Class_Object' => 'IPs contenidas en %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv6Range:Subtitle_ListRange' => 'Rango demasiado grande para listar todas las IPs. Por favor, seleccione un subrango para deplegar:',
	'UI:IPManagement:Action:ListIps:IPv6Range:FirstIP' => 'Primer IP de la lista',
	'UI:IPManagement:Action:ListIps:IPv6Range:LastIP' => 'Última IP de la lista',

	// Do list IPs action on IP Ranges 
	'UI:IPManagement:Action:DoListIps:IPv6Range' => 'Listar & Seleccionar IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IPs',
	'UI:IPManagement:Action:DoListIps:IPv6Range:Title_Class_Object' => 'Lista Parcial de IPs contenidas en %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv6Range:CannotBeListed' => 'Rango no puede ser listado: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIPOutOfRange' => 'Primer IP está fuera de rango',
	'UI:IPManagement:Action:DoListIps:IPv6Range:LastIPOutOfRange' => 'Última IP está fuera de rango',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIpBiggerThanLastIp' => 'Primer IP del rango is magor que la última IP!',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv6Range' => 'Exportación CSV de IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s exportación CSV de IPs',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Title_Class_Object' => 'Exportación CSV de IPs de %1$s: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Subtitle_ListRange' => 'Rango demasiado grande para exportar todas las IPs. Por favor, seleccione un subrango para exportar:',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:FirstIP' => 'First IP of the list',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:LastIP' => 'Last IP of the list',

	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range' => 'Exportación CSV de IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s exportación CSV de IPs',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:Title_Class_Object' => 'Exportación CSV Parcial de IPs de %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:CannotBeListed' => 'Rango no puede ser exportado: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIPOutOfRange' => 'Primer IP está fuera de rango',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:LastIPOutOfRange' => 'Última IP está fuera de rango',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIpBiggerThanLastIp' => 'Primer IP del rango es mayor que última IP!',

//
// Management of IPs
//
	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:Allocate:IPv6Address' => 'Asignar dirección a CI',
	'UI:IPManagement:Action:Allocate:IPv6Address:PageTitle_Object_Class' => 'Asignar IP',
	'UI:IPManagement:Action:Allocate:IPv6Address:Title_Class_Object' => 'Asignar %1$s %2$s al EC',
	'UI:IPManagement:Action:Allocate:IPv6Address:Done' => '%1$s %2$s ha sido asignada.',
	'UI:IPManagement:Action:Allocate:IPv6Address:IPAlreadyAllocated' => 'La dirección ya está asignada !',
	'UI:IPManagement:Action:UnAllocate:IPv6Address' => 'Desasignar la dirección de todos los CI ',
	'UI:IPManagement:Action:Unallocate:IPv6Address:PageTitle_Object_Class' => 'Desasignar IP',
	'UI:IPManagement:Action:Unallocate:IPv6Address:Done' => '%1$s %2$s ha sido desasignada.',
	'UI:IPManagement:Action:UnAllocate:IPv6Address:IPNotAllocated' => 'La dirección no está asignada !',
));
