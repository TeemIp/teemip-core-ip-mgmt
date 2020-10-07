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
