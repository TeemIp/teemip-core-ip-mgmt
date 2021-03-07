<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//////////////////////////////////////////////////////////////////////
// Classes and menus defined in teemip-macaddress-lookup extension
//////////////////////////////////////////////////////////////////////
//

//
// MC Lookup attributes
//

Dict::Add('EN US', 'English', 'English', array(
	'Menu:MACLookup' => 'MAC Lookup',
	'Menu:MACLookup+' => 'MAC address lookup',
	'UI:MACLookup:Action:CI:Lookup' => 'MAC Address Lookup',
	'UI:MACLookup:Action:CI:Lookup:Title' => '%1$s: <span class="hilite">%2$s</span> - MAC address lookup output',
	'UI:MACLookup:Action:CI:Details' => 'Details',
	'UI:MACLookup:Action:Lookup:Title' => 'MAC Address Lookup',
	'UI:MACLookup:Action:Lookup:SelectMACAddress' => 'MAC address',
	'UI:MACLookup:Action:Lookup:SelectMACPrefix' => 'MAC Prefix',
	'UI:MacLookup:Action:DoLookup:CannotRun:EmptyMAC' => 'No MAC address nor prefix has been entered!',
	'UI:MacLookup:Action:DoLookup:HasError' => 'MAC lookup failed: ',
	'UI:MACLookup:Action:DoLookup:Result' => 'MAC Address - Lookup output',
	'UI:MACLookup:Action:DoLookup:Result:Attribute' => 'Attribute',
	'UI:MACLookup:Action:DoLookup:Result:MACAddress' => 'MAC address',
	'UI:MACLookup:Action:DoLookup:Result:MACPrefix' => 'Prefix',
	'UI:MACLookup:Action:DoLookup:Result:Company' => 'Company',
	'UI:MACLookup:Action:DoLookup:Result:Address' => 'Address',
	'UI:MACLookup:Action:DoLookup:Result:Country' => 'Country',
	'UI:MACLookup:Action:DoLookup:Result:BlockStart' => 'Block start',
	'UI:MACLookup:Action:DoLookup:Result:BlockEnd' => 'Block end',
	'UI:MACLookup:Action:DoLookup:Result:BlockSize' => 'Block size',
	'UI:MACLookup:Action:DoLookup:Result:BlockType' => 'Block type',
	'UI:MACLookup:Action:DoLookup:Result:Updated' => 'Last update',
	'UI:MACLookup:Action:DoLookup:Result:IsRand' => 'Random MAC',
	'UI:MACLookup:Action:DoLookup:Result:IsPrivate' => 'Private MAC',
	'UI:MACLookup:Action:DoLookup:Result:NoMACAddressFound' => 'No information has been found for MAC address',
	'UI:MACLookup:Action:DoLookup:Result:ErrorLookup' => 'Lookup error',
	'UI:MACLookup:Action:DoLookup:Result:Error' => 'Error',
	'UI:MACLookup:Action:DoLookup:Result:ErrorCode' => 'Error code',
	'UI:MACLookup:Action:DoLookup:Result:MoreInfo' => 'More information can be found at',
));
