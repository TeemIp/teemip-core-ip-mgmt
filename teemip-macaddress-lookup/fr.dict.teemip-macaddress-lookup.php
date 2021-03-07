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

Dict::Add('FR FR', 'French', 'Français', array(
	'Menu:MACLookup' => 'Recherche d\'adresse MAC',
	'Menu:MACLookup+' => 'Recherche d\'adresse MAC',
	'UI:MACLookup:Action:CI:Lookup' => 'Recherche d\'adresse MAC',
	'UI:MACLookup:Action:CI:Lookup:Title' => '%1$s: <span class="hilite">%2$s</span> - Résultat de la recherche d\'adresse MAC',
	'UI:MACLookup:Action:CI:Details' => 'Détails',
	'UI:MACLookup:Action:Lookup:Title' => 'Recherche d\'adresse MAC',
	'UI:MACLookup:Action:Lookup:SelectMACAddress' => 'Adresse MAC',
	'UI:MACLookup:Action:Lookup:SelectMACPrefix' => 'Préfixe',
	'UI:MacLookup:Action:DoLookup:CannotRun:EmptyMAC' => 'Aucune adresse MAC ni préfixe n\'ont été renseignés !',
	'UI:MacLookup:Action:DoLookup:HasError' => 'La recherche d\'adresse MAC a échoué: ',
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
	'UI:MACLookup:Action:DoLookup:Result:NoMACAddressFound' => 'Aucune information n\'a été trouvée pour l\'adresse MAC',
	'UI:MACLookup:Action:DoLookup:Result:ErrorLookup' => 'Erreur de recherche',
	'UI:MACLookup:Action:DoLookup:Result:Error' => 'Erreur',
	'UI:MACLookup:Action:DoLookup:Result:ErrorCode' => 'Code d\'erreur',
	'UI:MACLookup:Action:DoLookup:Result:MoreInfo' => 'Plus d\'information peut être trouvée à',
));
