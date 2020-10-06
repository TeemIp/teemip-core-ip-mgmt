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

Dict::Add('FR FR', 'French', 'Français', array(
	'Menu:MACLookup' => 'Recherche d\'adresse MAC',
	'Menu:MACLookup+' => 'Recherche d\'adresse MAC',
	'UI:MACLookup:Action:CI:Lookup' => 'Recherche d\'adresse MAC',
	'UI:MACLookup:Action:CI:Lookup:Title' => '%1$s: <span class="hilite">%2$s</span> - Résultat de la recherche d\'adresse MAC',
	'UI:MACLookup:Action:CI:Details' => 'Détails',
	'UI:MACLookup:Action:Lookup:Title' => 'Recherche d\'adresse MAC',
	'UI:MACLookup:Action:Lookup:SelectMACAddress' => 'Adresse MAC',
	'UI:MacLookup:Action:DoLookup:CannotRun:EmptyMAC' => 'Aucune adresse MAC n\'a été renseignée !',
	'UI:MacLookup:Action:DoLookup:HasError' => 'La recherche d\'adresse MA a échoué: ',
	'UI:MACLookup:Action:DoLookup:Result' => 'Adresse MAC - Résultat de recherche',
	'UI:MACLookup:Action:DoLookup:Result:Attribute' => 'Attribut',
	'UI:MACLookup:Action:DoLookup:Result:MACAddress' => 'Adresse MAC',
	'UI:MACLookup:Action:DoLookup:Result:MACPrefix' => 'Préfixe',
	'UI:MACLookup:Action:DoLookup:Result:Company' => 'Entreprise',
	'UI:MACLookup:Action:DoLookup:Result:Address' => 'Adresse',
	'UI:MACLookup:Action:DoLookup:Result:Country' => 'Pays',
	'UI:MACLookup:Action:DoLookup:Result:BlockStart' => 'Début du bloc',
	'UI:MACLookup:Action:DoLookup:Result:BlockEnd' => 'Fin du bloc',
	'UI:MACLookup:Action:DoLookup:Result:BlockSize' => 'Taille du bloc',
	'UI:MACLookup:Action:DoLookup:Result:BlockType' => 'Type de bloc',
	'UI:MACLookup:Action:DoLookup:Result:Updated' => 'Dernière mise à jour',
	'UI:MACLookup:Action:DoLookup:Result:IsRand' => 'Adresse MAC aléatoire ',
	'UI:MACLookup:Action:DoLookup:Result:IsPrivate' => 'Adresse MAC privée',
	'UI:MACLookup:Action:DoLookup:Result:NoMACAddressFound' => 'Aucune information a été trouvée pour l\'adresse MAC',
	'UI:MACLookup:Action:DoLookup:Result:ErrorLookup' => 'Erreur de recherche',
	'UI:MACLookup:Action:DoLookup:Result:Error' => 'Erreur',
	'UI:MACLookup:Action:DoLookup:Result:ErrorCode' => 'Code d\'erreur',
	'UI:MACLookup:Action:DoLookup:Result:MoreInfo' => 'Plus d\'information peut être trouvée à',
));
