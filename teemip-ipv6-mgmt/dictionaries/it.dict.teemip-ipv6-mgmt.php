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

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Core:AttributeIPv6Address' => 'Indirizzo IPv6',
	'Core:AttributeIPv6Address+' => '',
));

//
// Class: IPv6Block
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPv6Block' => 'Blocco sottorete IPv6',
	'Class:IPv6Block+' => '',
	'Class:IPv6Block/Attribute:parent_id' => 'Genitore',
	'Class:IPv6Block/Attribute:parent_id+' => '',
	'Class:IPv6Block/Attribute:parent_name' => 'Nome del genitore',
	'Class:IPv6Block/Attribute:parent_name+' => '',
	'Class:IPv6Block/Attribute:parent_origin' => 'Origine del blocco padre',
	'Class:IPv6Block/Attribute:parent_origin+' => '',
	'Class:IPv6Block/Attribute:firstip' => 'Primo IP',
	'Class:IPv6Block/Attribute:firstip+' => 'Primo IP del blocco della sottorete',
	'Class:IPv6Block/Attribute:lastip' => 'Ultimo IP',
	'Class:IPv6Block/Attribute:lastip+' => 'Ultimo IP del blocco della sottorete',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix' => 'Dimensione minima del blocco',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_min_prefix+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix' => 'Dimensione minima',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_min_prefix/Value:default' => 'Allineato con le impostazioni globali',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned' => 'Allinea i blocchi di sottorete IPv6 a CIDR',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_yes' => 'Si',
	'Class:IPv6Block/Attribute:ipconfig_ipv6_block_cidr_aligned/Value:bca_yes+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned' => 'Allinea il blocco a un CIDR',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:default' => 'Allineato con le impostazioni globali',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_no' => 'No',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_no+' => '',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_yes' => 'Si',
	'Class:IPv6Block/Attribute:ipv6_block_cidr_aligned/Value:bca_yes+' => '',
));

//
// Class: IPv6Subnet
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPv6Subnet' => 'IPv6 Subnet',
	'Class:IPv6Subnet+' => '',
	'Class:IPv6Subnet/Attribute:block_id' => 'Blocco di sottorete',
	'Class:IPv6Subnet/Attribute:block_id+' => '',
	'Class:IPv6Subnet/Attribute:block_name' => 'Nome del Blocco',
	'Class:IPv6Subnet/Attribute:block_name+' => '',
	'Class:IPv6Subnet/Attribute:ip' => 'IP sottorete',
	'Class:IPv6Subnet/Attribute:ip+' => '',
	'Class:IPv6Subnet/Attribute:mask' => 'Maschera',
	'Class:IPv6Subnet/Attribute:mask+' => '',
	'Class:IPv6Subnet/Attribute:gatewayip' => 'Gateway IP',
	'Class:IPv6Subnet/Attribute:gatewayip+' => '',
	'Class:IPv6Subnet/Attribute:lastip' => 'Ultimo IP della sottorete',
	'Class:IPv6Subnet/Attribute:lastip+' => '',
	'Class:IPv6Subnet/Attribute:summary' => 'Sommario',
	'Class:IPv6Subnet/Attribute:ipconfig_ipv6_gateway_ip_format' => 'Default Gateway IP format~~',
	'Class:IPv6Subnet/Attribute:ipconfig_ipv6_gateway_ip_format+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format' => 'Gateway IP format~~',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:default' => 'Allineato con le impostazioni globali',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1' => 'Sottorete IP + 1',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:subnetip_plus_1+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:lastip' => 'Ultimo IP della sottorete',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:lastip+' => '',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:free_setup' => 'Allocazione libera',
	'Class:IPv6Subnet/Attribute:ipv6_gateway_ip_format/Value:free_setup+' => '',
));

//
// Class extensions for IPv6Subnet
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPv6Subnet/Tab:ipregistered-count' => '%1$s Riservato, %2$s Allocato, %3$s Rilasciato e %4$s Non assegnato',
));

//
// Class: IPv6Range
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPv6Range' => 'Intrvallo IPv6',
	'Class:IPv6Range+' => '',
	'Class:IPv6Range/Attribute:subnet_id' => 'Sottorete',
	'Class:IPv6Range/Attribute:subnet_id+' => '',
	'Class:IPv6Range/Attribute:subnet_ip' => 'IP sottorete',
	'Class:IPv6Range/Attribute:subnet_ip+' => '',
	'Class:IPv6Range/Attribute:firstip' => 'Primo IP dell\'intervallo',
	'Class:IPv6Range/Attribute:firstip+' => '',
	'Class:IPv6Range/Attribute:lastip' => 'Ultimo IP dell\'intervallo',
	'Class:IPv6Range/Attribute:lastip+' => '',
));

//
// Class: IPv6Address
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Class:IPv6Address' => 'Indirizzo IPv6',
	'Class:IPv6Address+' => '',
	'Class:IPv6Address/Attribute:subnet_id' => 'Sottorete',
	'Class:IPv6Address/Attribute:subnet_id+' => 'Sottorete IPv6',
	'Class:IPv6Address/Attribute:range_id' => 'Interevallo',
	'Class:IPv6Address/Attribute:range_id+' => 'Intervallo IPv6',
	'Class:IPv6Address/Attribute:ip' => 'Indirizzo',
	'Class:IPv6Address/Attribute:ip+' => 'IPv6 Indirizzo',
));

//
// Application Menu
//

Dict::Add('IT IT', 'Italian', 'Italiano', array(
	'Menu:IPSpace:IPv6Objects' => 'Oggetto IPv6',
	'Menu:IPSpace:IPv6Objects+' => 'Oggetto IPv6',
	'Menu:Ipv6ShortCut' => 'Scorciatoia IPv6',
	'Menu:Ipv6ShortCut+' => 'Scorciatoia IPv6',
	'Menu:IPv6Block' => 'Blocco di sottorete',
	'Menu:IPv6Block+' => 'Blocco di sottorete IPv6',
	'Menu:IPv6Subnet' => 'Sottoreti',
	'Menu:IPv6Subnet+' => 'Sottoreti IPv6',
	'Menu:IPv6Subnet:Allocated' => 'Sottoreti allocate',
	'Menu:IPv6Subnet:Allocated+' => 'Lista delle sottoreti IPv6 allocate',
	'Menu:IPv6Range' => 'Intervallo IP',
	'Menu:IPv6Range+' => 'Intervallo IPv6',
	'Menu:IPv6Address' => 'Indirizzi IP',
	'Menu:IPv6Address+' => 'Indirizzi IPv6',

//
// Management of Subnet Blocks
//
	// Creation Management	
	'UI:IPManagement:Action:New:IPv6Block:NotIPv6' => 'Gli IP non sono IP IPv6',

	// Display details of subnet blocks
	'UI:IPManagement:Action:Details:IPv6Block' => 'Dettagli',
	'UI:IPManagement:Action:Details:IPv6Block+' => '',

	// Display list of subnet blocks
	'UI:IPManagement:Action:DisplayList:IPv6Block' => 'Mostra elenco',
	'UI:IPManagement:Action:DisplayList:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Block:PageTitle_Class' => 'Blocco sottoreti IPv6',
	'UI:IPManagement:Action:DisplayList:IPv6Block:Title_Class' => 'Blocco sottoreti IPv6',

	// Display tree of subnet blocks
	'UI:IPManagement:Action:DisplayTree:IPv6Block' => 'Mostra alberto',
	'UI:IPManagement:Action:DisplayTree:IPv6Block+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:PageTitle_Class' => 'Blocco sottorete IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:Title_Class' => 'Blocco sottorete IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Block:OrgName' => 'Organizzazione %1$s',

	// Shrink action on subnet blocks
	'UI:IPManagement:Action:Shrink:IPv6Block' => 'Riduzione',
	'UI:IPManagement:Action:Shrink:IPv6Block+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary' => 'Sommario',
	'UI:IPManagement:Action:Shrink:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Shrink:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s divisione',
	'UI:IPManagement:Action:Shrink:IPv6Block:Title_Class_Object' => 'Shrink %1$s: %2$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewFirstIP' => 'Nuovo primo IP del blocco :',
	'UI:IPManagement:Action:Shrink:IPv6Block:NewLastIP' => 'Nuovo ultimo IP del blocco :',
	'UI:IPManagement:Action:Shrink:IPv6Block:IsDelegated' => 'Questo blocco è delegato quindi non può essere diviso!',
	'UI:IPManagement:Action:Shrink:IPv6Block:CannotBeShrunk' => 'Il blocco non può essere ridotto: %1$s',
	'UI:IPManagement:Action:Shrink:IPv6Block:SmallerThanMinSize' => 'La dimensione del blocco non può essere piu piccola di /%1$s !',
	'UI:IPManagement:Action:Shrink:IPv6Block:Done' => '%1$s %2$s è stato diviso.',

	// Split action on subnet blocks
	'UI:IPManagement:Action:Split:IPv6Block' => 'Diviso',
	'UI:IPManagement:Action:Split:IPv6Block+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:Summary' => 'Summary',
	'UI:IPManagement:Action:Split:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Split:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s diviso',
	'UI:IPManagement:Action:Split:IPv6Block:Title_Class_Object' => 'Split %1$s: %2$s',
	'UI:IPManagement:Action:Split:IPv6Block:At' => 'Primo IP del nuovo blocco della sottorete :',
	'UI:IPManagement:Action:Split:IPv6Block:NameNewBlock' => 'Nome del nuovo blocco di sottorete:',
	'UI:IPManagement:Action:Split:IPv6Block:IsDelegated' => 'Questo blocco è delegato e non può essere diviso!',
	'UI:IPManagement:Action:Split:IPv6Block:CannotBeSplit' => 'Il blocco no può essere diviso: %1$s',
	'UI:IPManagement:Action:Split:IPv6Block:SmallerThanMinSize' => 'La dimensione del blocco non può essere piu piccola di/%1$s !',
	'UI:IPManagement:Action:Split:IPv6Block:Done' => '%1$s %2$s è stato diviso.',

	// Expand action on subnet blocks
	'UI:IPManagement:Action:Expand:IPv6Block' => 'Espandi',
	'UI:IPManagement:Action:Expand:IPv6Block+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary' => 'Sommario',
	'UI:IPManagement:Action:Expand:IPv6Block:Summary+' => '',
	'UI:IPManagement:Action:Expand:IPv6Block:PageTitle_Object_Class' => '%1$s - %2$s espandi',
	'UI:IPManagement:Action:Expand:IPv6Block:Title_Class_Object' => 'Expand %1$s: %2$s',
	'UI:IPManagement:Action:Expand:IPv6Block:NewFirstIP' => 'Nuovo Primo IP del blocco :',
	'UI:IPManagement:Action:Expand:IPv6Block:NewLastIP' => 'New Nuovo Ultimo IP del blocco :',
	'UI:IPManagement:Action:Expand:IPv6Block:IsDelegated' => 'Questo blocco è delegato quindi non può essere espanso!',
	'UI:IPManagement:Action:Expand:IPv6Block:CannotBeExpanded' => 'Il blocco non può essere espanso: %1$s',
	'UI:IPManagement:Action:Expand:IPv6Block:SmallerThanMinSize' => 'La dimensionde del blocco non può essere piu piccola di/%1$s !',
	'UI:IPManagement:Action:Expand:IPv6Block:Done' => '%1$s %2$s è stato espanso.',

	// List space action on subnet blocks 
	'UI:IPManagement:Action:ListSpace:IPv6Block' => 'Lista dello spazio',
	'UI:IPManagement:Action:ListSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Spazio',
	'UI:IPManagement:Action:ListSpace:IPv6Block:Title_Class_Object' => 'Spazio entro %1$s: %2$s',
	'UI:IPManagement:Action:ListSpace:IPv6Block:FreeSpace' => 'Free [%1$s - %2$s] - %3$.2e IPs - %4$.2f %%',

	// Find Space action on subnet blocks
	'UI:IPManagement:Action:FindSpace:IPv6Block' => 'Trova Spazio',
	'UI:IPManagement:Action:FindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Trova spazio',
	'UI:IPManagement:Action:FindSpace:IPv6Block:Title_Class_Object' => 'Cerca lo spazio entro %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv6Block:SizeOfSpace' => 'Dimensione dello spazio da cercare:',
	'UI:IPManagement:Action:FindSpace:IPv6Block:MaxNumberOfOffers' => 'Numero massimo di offerte:',

	// Do find Space action on subnet blocks
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:PageTitle_Object_Class' => '%1$s - Trova spazio',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Title_Class_Object' => 'Spazio entro %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:Summary' => '%1$s primo /%2$s entro il blocco',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsBlock' => 'Crea come un blocco figlio',
	'UI:IPManagement:Action:DoFindSpace:IPv6Block:CreateAsSubnet' => 'Crea come una subnet',

	// Delegate action on subnet blocks
	'UI:IPManagement:Action:Delegate:IPv6Block' => 'Delegate',
	'UI:IPManagement:Action:Delegate:IPv6Block:PageTitle_Object_Class' => '%1$s - Delegato',
	'UI:IPManagement:Action:Delegate:IPv6Block:Title_Class_Object' => 'Delegato %1$s %2$s all\'organizzazione figlio',
	'UI:IPManagement:Action:Delegate:IPv6Block:ChildBlock' => 'Oganizzazione figlio per delegare il blocco a:',
	'UI:IPManagement:Action:Delegate:IPv6Block:NoChildOrg' => 'Il blocco dell\'organizzazione non ha figli e quindi il blocco non può essere delegato!',
	'UI:IPManagement:Action:Delegate:IPv6Block:CannotBeDelegated' => 'Il blocco non può essere delegato: %1$s',
	'UI:IPManagement:Action:Delegate:IPv6Block:Done' => '%1$s %2$s è stato delegato.',

	// Undelegate action on subnet blocks
	'UI:IPManagement:Action:Undelegate:IPv6Block:CannotBeUndelegated' => 'La delega non può essere ritirato : %1$s',
	'UI:IPManagement:Action:Undelegate:IPv6Block' => 'Non-delegato',
	'UI:IPManagement:Action:Undelegate:IPv6Block:PageTitle_Object_Class' => '%1$s - Non-delegato',
	'UI:IPManagement:Action:Undelegate:IPv6Block:Done' => '%1$s %2$s è stato non-delegato.',

//
// Management of Subnets
//
	// Operations on subnets
	'UI:IPManagement:Action:xxx:IPv6Subnet:OperationNotAllowed' => 'Operation not allowed on IPv6 subnets!',

	// Display details of subnet
	'UI:IPManagement:Action:Details:IPv6Subnet' => 'Dettagli',
	'UI:IPManagement:Action:Details:IPv6Subnet+' => '',

	// Display list of subnets
	'UI:IPManagement:Action:DisplayList:IPv6Subnet' => 'Elenco dettegli',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:PageTitle_Class' => 'Sottoreti IPv6',
	'UI:IPManagement:Action:DisplayList:IPv6Subnet:Title_Class' => 'Sottoreti IPv6',

	// Display tree of subnets
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet' => 'Mostra albero',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet+' => '',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:PageTitle_Class' => 'Sottoreti IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:Title_Class' => 'Sottoreti IPv6',
	'UI:IPManagement:Action:DisplayTree:IPv6Subnet:OrgName' => 'Organizzazione %1$s',

	// Find space action on subnets 
	'UI:IPManagement:Action:FindSpace:IPv6Subnet' => 'Trova spazio',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - Trova spazio',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:Title_Class_Object' => 'Cerca spazio IP entro %1$s: %2$s',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeTooSmall' => 'La sottorete è troppo piccola per cercare spazio. Per favore cancella!',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:SizeOfRange' => 'Dimensione dello spazio da cercare:',
	'UI:IPManagement:Action:FindSpace:IPv6Subnet:MaxNumberOfOffers' => 'Numero massimo di offerte:',

	// Do find Space action on subnet
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:PageTitle_Object_Class' => '%1$s - Trova spazio',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Title_Class_Object' => 'Space within %1$s: %2$s',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:Summary' => '%1$s primo libero %2$s intervallo IP nella sottorete',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:RangeTooBig' => 'Lo spazio richiesto non rientra nella sottorete. Per favore, prova un valore più basso.',
	'UI:IPManagement:Action:DoFindSpace:IPv6Subnet:CreateAsRange' => 'Crea come un intervallo IPv6',

	// List IPs action on subnets 
	'UI:IPManagement:Action:ListIps:IPv6Subnet' => 'Elenca e prendi gli IP',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IP',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Title_Class_Object' => 'List of IPs within %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:Subtitle_ListRange' => 'Subnet è troppo grande per elencare tutti gli IP in una volta. Per favore, seleziona un intervallo da visualizzare:',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:FirstIP' => 'Primo IP dell\'elenco',
	'UI:IPManagement:Action:ListIps:IPv6Subnet:LastIP' => 'Ultimo IP dell\'elenco',

	// Do list IPs action on subnet
	'UI:IPManagement:Action:DoListIps:IPv6Subnet' => 'Elenca e prendi gli IP',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - IP',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:Title_Class_Object' => 'Elenco parziale di IP all\'interno %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:CannotBeListed' => 'Gli IP non possono essere elencati: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIPOutOfSubnet' => 'Il primo IP è fuori dalla sottorete',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:LastIPOutOfSubnet' => 'L\'ultimo IP è fuori dalla sottorete',
	'UI:IPManagement:Action:DoListIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'Il primo IP dell\'intervallo è più alto dell\'ultimo IP!',

	// CSV Export action on subnets
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet' => 'Esporta IP in CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s Esporta IP in CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Title_Class_Object' => 'Esporta IP in CSV di %1$s: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:Subtitle_ListRange' => 'La sottorete è troppo grande per esportare tutti gli IP in una volta. Per favore, seleziona un intervallo da visualizzare:',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:FirstIP' => 'Primo IP dell\'elenco',
	'UI:IPManagement:Action:CsvExportIps:IPv6Subnet:LastIP' => 'Ultimo IP dell\'elenco',

	// Do CSV export IPs action on subnet
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet' => 'Esporta IP in CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:PageTitle_Object_Class' => '%1$s - %2$s Esporta IP in CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:Title_Class_Object' => 'IP di esportazione CSV parziale all\'interno %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:CannotBeListed' => 'Gli IP non possono essere elencati: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIPOutOfSubnet' => 'Il primo IP è fuori dalla sottorete',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:LastIPOutOfSubnet' => 'L\'ultimoIP è fuori dalla sottorete',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Subnet:FirstIpBiggerThanLastIp' => 'Il primo IP dell\'intervallo è più alto dell\'ultimo IP!',

	// Subnet calculator
	'UI:IPManagement:Action:Calculator:IPv6Subnet' => 'Calcolatrice di sottoreti',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:PageTitle_Object_Class' => '%2$s Calcolatrice',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Title_Class_Object' => 'Calcolatrice %1$s',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:IP' => 'Indirizzo IP',
	'UI:IPManagement:Action:Calculator:IPv6Subnet:Prefix' => 'Prefisso',

	// Do Subnet calculator
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet' => 'Calcolatrice di sottoreti',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PageTitle_Object_Class' => '%2$s Calcolatrice',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Title_Class_Object' => '%1$s - Risultato della calcolatrice',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CompressedIP' => 'Indirizzo IP - Formato compresso',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CanonicalIP' => 'Indirizzo IP - Formato canonico',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:Prefix' => 'Prefisso',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PrefixMask' => 'Maschera prefisso',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NetworkIP' => 'IP Sottorete',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:LastIP' => 'IP Ultimo',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:IPNumber' => 'Numero di IP',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet' => 'Sottorete IP precedente',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:PreviousSubnet:NA' => 'Non applicabile',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet' => 'Sottorete IP successiva',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:NextSubnet:NA' => 'Non applicabile',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:CannotRun' => 'La calcolatrice di sottorete non può essere eseguita: %1$s',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:EnterPrefix' => 'Inserisci un prefisso!',
	'UI:IPManagement:Action:DoCalculator:IPv6Subnet:WrongPrefix' => 'Il prefisso non è valido!',

//
// Management of IP ranges
//
	// Display details of IP Range
	'UI:IPManagement:Action:Details:IPv6Range' => 'Dettagli',
	'UI:IPManagement:Action:Details:IPv6Range+' => '',

	// List IPs action on IP Ranges 
	'UI:IPManagement:Action:ListIps:IPv6Range' => 'Elenca & Prendi IP',
	'UI:IPManagement:Action:ListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IP',
	'UI:IPManagement:Action:ListIps:IPv6Range:Title_Class_Object' => 'IP entro %1$s: %2$s',
	'UI:IPManagement:Action:ListIps:IPv6Range:Subtitle_ListRange' => 'L\'intervallo è troppo grande per elencare tutti gli IP in una volta. Per favore, seleziona un subrange da visualizzare:',
	'UI:IPManagement:Action:ListIps:IPv6Range:FirstIP' => 'Primo IP dell\'elenco',
	'UI:IPManagement:Action:ListIps:IPv6Range:LastIP' => 'Ultimo IP dell\'elenco',

	// Do list IPs action on IP Ranges 
	'UI:IPManagement:Action:DoListIps:IPv6Range' => 'Elenca & Prendi IP',
	'UI:IPManagement:Action:DoListIps:IPv6Range:PageTitle_Object_Class' => '%1$s - IP',
	'UI:IPManagement:Action:DoListIps:IPv6Range:Title_Class_Object' => 'Elenco parziale di IP all\'interno %1$s: %2$s',
	'UI:IPManagement:Action:DoListIps:IPv6Range:CannotBeListed' => 'L\'intervallo non può essere elencato: %1$s',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIPOutOfRange' => 'Il primo IP è fuori dall\'intervallo',
	'UI:IPManagement:Action:DoListIps:IPv6Range:LastIPOutOfRange' => 'Il primo IP è fuori dall\'intervallo',
	'UI:IPManagement:Action:DoListIps:IPv6Range:FirstIpBiggerThanLastIp' => 'Il primo IP dell\'intervallo è più alto dell\'ultimo IP!',

	// CSV Export action on IP Ranges
	'UI:IPManagement:Action:CsvExportIps:IPv6Range' => 'Esporta IP in CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s Esporta IP in CSV',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Title_Class_Object' => 'Esporta IP in CSV %1$s: %2$s',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:Subtitle_ListRange' => 'L\'intervallo è troppo grande per esportare tutti gli IP in una volta. Per favore, seleziona un sotto intervallo da esportare:',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:FirstIP' => 'Primo IP dell\'elenco',
	'UI:IPManagement:Action:CsvExportIps:IPv6Range:LastIP' => 'Ultimo IP dell\'elenco',

	// Do CSV Export IPs action on IP Ranges
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range' => 'Esporta IP in CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:PageTitle_Object_Class' => '%1$s - %2$s Esporta IP in CSV',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:Title_Class_Object' => 'Parziale esportazione in CSV di IP %1$s: %2$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:CannotBeListed' => 'L\'intervallo non può essere esportato: %1$s',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIPOutOfRange' => 'Il primo IP è fuori dall\'intervallo',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:LastIPOutOfRange' => 'L\'ultimo IP è fuori dell\'intervallo',
	'UI:IPManagement:Action:DoCsvExportIps:IPv6Range:FirstIpBiggerThanLastIp' => 'Il primo IP dell\'intervallo è più alto dell\'ultimo IP!',

//
// Management of IPs
//
	// Allocation to CI / Unallocation from CI
	'UI:IPManagement:Action:Allocate:IPv6Address' => 'Allocate address to CI',
	'UI:IPManagement:Action:Allocate:IPv6Address:PageTitle_Object_Class' => 'Allocate IP',
	'UI:IPManagement:Action:Allocate:IPv6Address:Title_Class_Object' => 'Allocate %1$s %2$s to CI',
	'UI:IPManagement:Action:Allocate:IPv6Address:CannotAllocateCI' => 'Cannot allocate CI to IP: %1$s',
	'UI:IPManagement:Action:Allocate:IPv6Address:Done' => '%1$s %2$s has been allocated.',
	'UI:IPManagement:Action:Allocate:IPv6Address:IPAlreadyAllocated' => 'L\'indirizzo è già assegnato !',
	'UI:IPManagement:Action:Unallocate:IPv6Address:PageTitle_Object_Class' => 'Un-allocate IP',
	'UI:IPManagement:Action:Unallocate:IPv6Address:Done' => '%1$s %2$s has been unallocated.',
	'UI:IPManagement:Action:UnAllocate:IPv6Address:IPNotAllocated' => 'L\'indirizzo non è assegnato !',
));
