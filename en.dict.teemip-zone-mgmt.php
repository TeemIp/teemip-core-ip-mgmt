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
 * @copyright   Copyright (C) 2020 TeemIP
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

//
// Class extensions for IPConfig
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPConfig/Attribute:ip_update_dns_records' => 'Automatically update DNS records',
	'Class:IPConfig/Attribute:ip_update_dns_records+' => 'Automatically create, modify or delete DNS records linked to an IP address',
	'Class:IPConfig/Attribute:ip_update_dns_records/Value:yes' => 'Yes',
	'Class:IPConfig/Attribute:ip_update_dns_records/Value:no' => 'No',
));

//
// Class extensions for IPAddress
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:IPAddress/Attribute:view_id' => 'DNS View',
	'Class:IPAddress/Attribute:view_id+' => '',
	'Class:IPAddress/Attribute:view_name' => 'View name',
	'Class:IPAddress/Attribute:view_name+' => '',
	'Class:IPAddress/Tab:rrecords_list' => 'DNS Records',
	'Class:IPAddress/Tab:rrecords_list+' => 'List of all DNS Resource Records associated to the IP address.',
	'Class:IPAddress/Tab:ptrrecords_list' => 'PTR records:',
	'Class:IPAddress/Tab:ptrrecords_list_empty' => 'There are no PTR records linked to this IP',
	'Class:IPAddress/Tab:arecords_list' => 'A records:',
	'Class:IPAddress/Tab:arecords_list_empty' => 'There are no A records linked to this IP',
	'Class:IPAddress/Tab:aaaarecords_list' => 'AAAA records:',
	'Class:IPAddress/Tab:aaaarecords_list_empty' => 'There are no AAAA records linked to this IP',
	'Class:IPAddress/Tab:cnamerecords_list' => 'CNAME records:',
	'Class:IPAddress/Tab:cnamerecords_list_empty' => 'There are no CNAME records linked to this IP',
));

//
// Class: View
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:View' => 'View',
	'Class:View+' => 'DNS View',
	'Class:View/Attribute:org_id' => 'Organization',
	'Class:View/Attribute:org_id+' => '',
	'Class:View/Attribute:org_name' => 'Organization name',
	'Class:View/Attribute:org_name+' => '',
	'Class:View/Attribute:name' => 'Name',
	'Class:View/Attribute:name+' => '',
	'Class:View/Attribute:description' => 'Description',
	'Class:View/Attribute:description+' => '',
	'Class:View/Attribute:zones_list' => 'Zones',
	'Class:View/Attribute:zones_list+' => 'All the zones in the view',
));

//
// Class: Zone
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:Zone' => 'Zone',
	'Class:Zone+' => '',
	'Class:Zone/Name' => '%1$s',
	'Class:Zone:baseinfo' => 'General Information',
	'Class:Zone:soainfo' => 'Start Of Authority',
	'Class:Zone/Attribute:view_id' => 'View',
	'Class:Zone/Attribute:view_id+' => '',
	'Class:Zone/Attribute:mapping' => 'Mapping type',
	'Class:Zone/Attribute:mapping+' => '',
	'Class:Zone/Attribute:mapping/Value:direct' => 'Forward',
	'Class:Zone/Attribute:mapping/Value:direct+' => 'Forward mapping',
	'Class:Zone/Attribute:mapping/Value:ipv4reverse' => 'IPv4 Reverse',
	'Class:Zone/Attribute:mapping/Value:ipv4reverse+' => 'Reverse mapping for IPv4 addresses: IPv4 to name',
	'Class:Zone/Attribute:mapping/Value:ipv6reverse' => 'IPv6 Reverse',
	'Class:Zone/Attribute:mapping/Value:ipv6reverse+' => 'Reverse mapping for IPv6 addresses: IPv6 to name',
	'Class:Zone/Attribute:name' => 'Zone Name',
	'Class:Zone/Attribute:name+' => '',
	'Class:Zone/Attribute:comment' => 'Comment',
	'Class:Zone/Attribute:comment+' => '',
	'Class:Zone/Attribute:requestor_id' => 'Requestor',
	'Class:Zone/Attribute:requestor_id+' => '',
	'Class:Zone/Attribute:requestor_name' => 'Requestor name',
	'Class:Zone/Attribute:requestor_name+' => '',
	'Class:Zone/Attribute:ttl' => 'TTL',
	'Class:Zone/Attribute:ttl+' => '',
	'Class:Zone/Attribute:sourcedname' => 'Master server',
	'Class:Zone/Attribute:sourcedname+' => '',
	'Class:Zone/Attribute:mbox' => 'Hostmaster mailbox',
	'Class:Zone/Attribute:mbox+' => '',
	'Class:Zone/Attribute:serial' => 'Serial',
	'Class:Zone/Attribute:serial+' => '',
	'Class:Zone/Attribute:refresh' => 'Refresh',
	'Class:Zone/Attribute:refresh+' => '',
	'Class:Zone/Attribute:retry' => 'Retry',
	'Class:Zone/Attribute:retry+' => '',
	'Class:Zone/Attribute:expire' => 'Expire',
	'Class:Zone/Attribute:expire+' => '',
	'Class:Zone/Attribute:minimum' => 'Minimum',
	'Class:Zone/Attribute:minimum+' => '',
	'Class:Zone/Attribute:servers_list' => 'Authoritative servers',
	'Class:Zone/Attribute:servers_list+' => 'Authoritative servers looking after the zone',
	'Class:Zone/Tab:nsrecords_list' => 'NS records',
	'Class:Zone/Tab:nsrecords_list+' => 'List of all NS records of the zone',
	'Class:Zone/Tab:arecords_list' => 'A Records',
	'Class:Zone/Tab:arecords_list+' => 'List of all A Records of the zone',
	'Class:Zone/Tab:aaaarecords_list' => 'AAAA Records',
	'Class:Zone/Tab:aaaarecords_list+' => 'List of all AAAA Records of the zone',
	'Class:Zone/Tab:cnamerecords_list' => 'CNAME Records',
	'Class:Zone/Tab:cnamerecords_list+' => 'List of all CNAME Records of the zone',
	'Class:Zone/Tab:ptrrecords_list' => 'PTR records',
	'Class:Zone/Tab:ptrrecords_list+' => 'List of all PTR records of the zone',
	'Class:Zone/Tab:otherrecords_list' => 'Other Records',
	'Class:Zone/Tab:mxrecords_list' => 'List of all %1$s MX records of the zone',
	'Class:Zone/Tab:mxrecords_list_empty' => 'There are no MX records in the zone',
	'Class:Zone/Tab:srvrecords_list' => 'List of all %1$s SRV records of the zone',
	'Class:Zone/Tab:srvrecords_list_empty' => 'There are no SRV records in the zone',
	'Class:Zone/Tab:txtrecords_list' => 'List of all %1$s TXT records of the zone',
	'Class:Zone/Tab:txtrecords_list_empty' => 'There are no TXT records in the zone',
	'Class:Zone/DataFile:ns' => '
;
; Name servers
;',
	'Class:Zone/DataFile:ipv4' => '
;
; IPv4 addresses for the canonical names
;',
	'Class:Zone/DataFile:ipv6' => '
;
; IPv6 addresses for the canonical names
;',
	'Class:Zone/DataFile:cnames' => '
;
; Aliases
;',
	'Class:Zone/DataFile:mx' => '
;
; Mail exchangers
;',
	'Class:Zone/DataFile:ptr' => '
;
; Addresses point to canonical names
;',
'Class:Zone/DataFile:srv' => '
;
; Locate services
;',
	'Class:Zone/DataFile:txt' => '
;
; Text
;',
	'Class:Zone/DataFile:records_in_alphaorder' => '
;
; Other records in alphabetical order
;',
));

//
// Class: lnkServerToZone
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:lnkServerToZone' => 'Link Server / Zone',
	'Class:lnkServerToZone+' => '',
	'Class:lnkServerToZone/Attribute:server_id' => 'Server',
	'Class:lnkServerToZone/Attribute:server_id+' => '',
	'Class:lnkServerToZone/Attribute:server_name' => 'Server name',
	'Class:lnkServerToZone/Attribute:server_name+' => '',
	'Class:lnkServerToZone/Attribute:zone_id' => 'Zone',
	'Class:lnkServerToZone/Attribute:zone_id+' => '',
	'Class:lnkServerToZone/Attribute:zone_name' => 'Zone name',
	'Class:lnkServerToZone/Attribute:zone_name+' => '',
	'Class:lnkServerToZone/Attribute:authority' => 'Authority',
	'Class:lnkServerToZone/Attribute:authority+' => '',
	'Class:lnkServerToZone/Attribute:authority/Value:master' => 'Master',
	'Class:lnkServerToZone/Attribute:authority/Value:master+' => '',
	'Class:lnkServerToZone/Attribute:authority/Value:slave' => 'Slave',
	'Class:lnkServerToZone/Attribute:authority/Value:slave+' => '',
	'Class:lnkServerToZone/Attribute:authority/Value:hidden_master' => 'Hidden master',
	'Class:lnkServerToZone/Attribute:authority/Value:hidden_mastermaster+' => '',
	'Class:lnkServerToZone/Attribute:authority/Value:hidden_slave' => 'Hidden slave',
	'Class:lnkServerToZone/Attribute:authority/Value:hidden_slave+' => '',
));

//
// Class: ResourceRecord
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:ResourceRecord' => 'Resource Record',
	'Class:ResourceRecord+' => 'DNS Resource Record',
	'Class:ResourceRecord/Attribute:finalclass' => 'Type',
	'Class:ResourceRecord/Attribute:finalclass+' => '',
	'Class:ResourceRecord/Attribute:org_id' => 'Organization',
	'Class:ResourceRecord/Attribute:org_id+' => '',
	'Class:ResourceRecord/Attribute:org_name' => 'Organization name',
	'Class:ResourceRecord/Attribute:org_name+' => '',
	'Class:ResourceRecord/Attribute:name' => 'RR Name',
	'Class:ResourceRecord/Attribute:name+' => '',
	'Class:ResourceRecord/Attribute:comment' => 'Comment',
	'Class:ResourceRecord/Attribute:comment+' => '',
	'Class:ResourceRecord/Attribute:zone_id' => 'Zone',
	'Class:ResourceRecord/Attribute:zone_id+' => '',
	'Class:ResourceRecord/Attribute:zone_name' => 'Zone name',
	'Class:ResourceRecord/Attribute:zone_name+' => '',
	'Class:ResourceRecord/Attribute:overwrite_zone_ttl' => 'Overwrite zone TTL',
	'Class:ResourceRecord/Attribute:overwrite_zone_ttl+' => '',
	'Class:ResourceRecord/Attribute:overwrite_zone_ttl/Value:no' => 'No',
	'Class:ResourceRecord/Attribute:overwrite_zone_ttl/Value:no+' => '',
	'Class:ResourceRecord/Attribute:overwrite_zone_ttl/Value:yes' => 'Yes',
	'Class:ResourceRecord/Attribute:overwrite_zone_ttl/Value:yes+' => '',
	'Class:ResourceRecord/Attribute:ttl' => 'TTL',
	'Class:ResourceRecord/Attribute:ttl+' => '',
	'ResourceRecord:Zone' => 'Zone',
	'ResourceRecord:Record' => 'RRs attributes',
));

//
// Class: ARecord
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:ARecord' => 'A',
	'Class:ARecord+' => '',
	'Class:ARecord/Attribute:ip_id' => 'IPv4 Address',
	'Class:ARecord/Attribute:ip_id+' => '',
	'Class:ARecord/Attribute:ip_fqdn' => 'IPv4 Address FQDN',
	'Class:ARecord/Attribute:ip_fqdn+' => '',
	));

//
// Class: AAAARecord
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:AAAARecord' => 'AAAA',
	'Class:AAAARecord+' => '',
	'Class:AAAARecord/Attribute:ip_id' => 'IPv6 Address',
	'Class:AAAARecord/Attribute:ip_id+' => '',
	'Class:AAAARecord/Attribute:ip_fqdn' => 'IPv6 Address FQDN',
	'Class:AAAARecord/Attribute:ip_fqdn+' => '',
));

//
// Class: CNAMERecord
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:CNAMERecord' => 'CNAME',
	'Class:CNAMERecord+' => '',
	'Class:CNAMERecord/Attribute:cname' => 'Canonical Name',
	'Class:CNAMERecord/Attribute:cname+' => '',
));

//
// Class: MXRecord
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:MXRecord' => 'MX',
	'Class:MXRecord+' => '',
	'Class:MXRecord/Attribute:preference' => 'Preference',
	'Class:MXRecord/Attribute:preference+' => '',
	'Class:MXRecord/Attribute:exchange' => 'Mail exchange server',
	'Class:MXRecord/Attribute:exchange+' => '',
));

//
// Class: NSRecord
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:NSRecord' => 'NS',
	'Class:NSRecord+' => '',
	'Class:NSRecord/Attribute:nsname' => 'Name server',
	'Class:NSRecord/Attribute:nsname+' => '',
));

//
// Class: PTRRecord
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:PTRRecord' => 'PTR',
	'Class:PTRRecord+' => '',
	'Class:PTRRecord/Attribute:hostname' => 'Hostname',
	'Class:PTRRecord/Attribute:hostname+' => '',
));

//
// Class: SOARecord
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:SOARecord' => 'SOA',
	'Class:SOARecord+' => '',
	'Class:SOARecord/Attribute:sourcedname' => 'Master server',
	'Class:SOARecord/Attribute:sourcedname+' => '',
	'Class:SOARecord/Attribute:mbox' => 'Hostmaster mailbox',
	'Class:SOARecord/Attribute:mbox+' => '',
	'Class:SOARecord/Attribute:serial' => 'Serial',
	'Class:SOARecord/Attribute:serial+' => '',
	'Class:SOARecord/Attribute:refresh' => 'Refresh',
	'Class:SOARecord/Attribute:refresh+' => '',
	'Class:SOARecord/Attribute:retry' => 'Retry',
	'Class:SOARecord/Attribute:retry+' => '',
	'Class:SOARecord/Attribute:expire' => 'Expire',
	'Class:SOARecord/Attribute:expire+' => '',
	'Class:SOARecord/Attribute:minimum' => 'Minimum',
	'Class:SOARecord/Attribute:minimum+' => '',
));

//
// Class: TXTRecord
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:TXTRecord' => 'TXT',
	'Class:TXTRecord+' => '',
	'Class:TXTRecord/Attribute:txt' => 'Text',
	'Class:TXTRecord/Attribute:txt+' => '',
));

//
// Class: SRVRecord
//

Dict::Add('EN US', 'English', 'English', array(
	'Class:SRVRecord' => 'SRV',
	'Class:SRVRecord+' => '',
	'Class:SRVRecord/Attribute:priority' => 'Priority',
	'Class:SRVRecord/Attribute:priority+' => '',
	'Class:SRVRecord/Attribute:weight' => 'Weight',
	'Class:SRVRecord/Attribute:weight+' => '',
	'Class:SRVRecord/Attribute:port' => 'Port',
	'Class:SRVRecord/Attribute:port+' => '',
	'Class:SRVRecord/Attribute:target' => 'Target',
	'Class:SRVRecord/Attribute:target+' => '',
));

//
// Management of zones
//
Dict::Add('EN US', 'English', 'English', array(
	'UI:ZoneManagement:Action:New:Zone:V4:WrongFormat' => 'Wrong format: IPv4 reverse zone format is x.[y.][z.]in-addr.arpa. !',
	'UI:ZoneManagement:Action:New:Zone:V6:WrongFormat' => 'Wrong format: IPv6 reverse zone format is x1.[x2.]...[xi.]ip6.arpa. !',
));

//
// Management of data files
//
Dict::Add('EN US', 'English', 'English', array(
	'UI:ZoneManagement:Action:Zone:DataFileDisplay' => 'Display data file',
	'UI:ZoneManagement:Action:Zone:Details' => 'Details',
	'UI:ZoneManagement:Action:Zone:DataFileDisplay:PageTitle_Object_Class' => '%1$s - %2$s data file',
	'UI:ZoneManagement:Action:Zone:DataFileDisplay:Title_Class_Object' => 'Data file of %1$s: <span class="hilite">%2$s</span>',
	'UI:ZoneManagement:Action:DataFileDisplay:sort_by_record' => 'Display data file sorted by records',
	'UI:ZoneManagement:Action:DataFileDisplay:sort_by_char' => 'Display data file sorted by alphabetical order',
));
	
//
// Management of records
//
Dict::Add('EN US', 'English', 'English', array(
	'UI:ZoneManagement:Action:New:PTRRecord:V4:WrongNumberOfDigit' => 'Wrong format: IPv4 PTR records are made of 4 numbers - x.y.z.t.in-addr.arpa. !',
	'UI:ZoneManagement:Action:New:PTRRecord:V4:IpNotInRange' => 'Wrong format: IPv4 numbers are contained within 0 - 255 range!',
	'UI:ZoneManagement:Action:New:PTRRecord:V4:WrongFormat' => 'Wrong format: IPv4 PTR records format is x.y.z.t.in-addr.arpa. !',
	'UI:ZoneManagement:Action:New:PTRRecord:V6:WrongNumberOfDigit' => 'Wrong format: IPv6 PTR records are made of 32 numbers - x1.x2....x32.ip6.arpa. !',
	'UI:ZoneManagement:Action:New:PTRRecord:V6:IpNotInRange' => 'Wrong format: IPv6 numbers are contained within 0 - F range, in hexa!',
	'UI:ZoneManagement:Action:New:PTRRecord:V6:WrongFormat' => 'Wrong format: IPv6 PTR records format is x1.x2....x32.ip6.arpa. !',

	'UI:ZoneManagement:Action:IPObject:UpdateRR' => 'Create / Update DNS RRs',
	'UI:ZoneManagement:Action:IPObject:DeleteRR' => 'Delete DNS RRs',

	'UI:ZoneManagement:Action:IPAddress:UpdateRR' => 'Create / Update DNS RRs',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:Error:NoShortName' => 'IP address has no short name!',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:Error:NoDomainName' => 'IP address has no domain name!',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:Error:CannotFindZone:direct' => 'Cannot find forward zone for given domain and view!',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:Error:CannotFindZone:ipv4reverse' => 'Cannot find reverse zone!',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:Error:CannotFindZone:ipv6reverse' => 'Cannot find reverse zone!',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:HasNotRun' => 'No resource record has been created from address: %1$s',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:HasErrors' => 'Some errors have been found: %1$s',
	'UI:ZoneManagement:Action:IPAddress:UpdateRRs:HasRun' => 'Resource records associated to IP address have been created or updated.',
	'UI:ZoneManagement:Action:IPAddress:CleanRRs:HasRun' => 'Resource records associated to IP address have been purged.',
	'UI:ZoneManagement:Action:IPAddress:DeleteRR' => 'Delete DNS RRs',

	'UI:ZoneManagement:Action:IPSubnet:UpdateRRs:HasNotRun' => 'No resource record has been created from subnet: %1$s',
	'UI:ZoneManagement:Action:IPSubnet:UpdateRRs:HasRun' => 'Resource records associated to subnet\'s IP addresses have been created or updated.',
	'UI:ZoneManagement:Action:IPSubnet:CleanRRs:HasRun' => 'Resource records associated to subnet\'s IP addresses have been purged.',
));

//
// Application Menu
//

Dict::Add('EN US', 'English', 'English', array(
	'Menu:DNSManagement' => 'DNS Management',
	'Menu:DNSManagement+' => '',
	'Menu:NameSpace' => 'Name Space',
	'Menu:NameSpace+' => '',
	'Menu:DNSSpace:MainObjects' => 'DNS Main Objects',
	'Menu:DNSSpace:ResourceRecords' => 'Resource Records',
	'Menu:View' => 'Views',
	'Menu:View+' => 'DNS Views',
	'Menu:Domain' => 'Domains',
	'Menu:Domain+' => 'DNS Domains',
	'Menu:Zone' => 'Zones',
	'Menu:Zone+' => 'DNS Zones',
	'Menu:ZoneManagement:ResourceRecords' => 'Resource Records',
	'Menu:ZoneManagement:ResourceRecords+' => 'DNS Resource Records',
	'Menu:NewResourceRecord' => 'New RR',
	'Menu:NewResourceRecord+' => 'New DNS Resource Record',
	'Menu:SearchResourceRecord' => 'Search for RRs',
	'Menu:SearchResourceRecord+' => 'Search for DNS Resource Records',
	'Menu:ARecord' => 'A',
	'Menu:ARecord+' => 'A Records',
	'Menu:AAAARecord' => 'AAAA',
	'Menu:AAAARecord+' => 'AAAA Records',
	'Menu:CNAMERecord' => 'CNAME',
	'Menu:CNAMERecord+' => 'CNAME Records',
	'Menu:MXRecord' => 'MX',
	'Menu:MXRecord+' => 'MX Records',
	'Menu:NSRecord' => 'NS',
	'Menu:NSRecord+' => 'NS Records',
	'Menu:PTRRecord' => 'PTR',
	'Menu:PTRRecord+' => 'PTR Records',
	'Menu:SOARecord' => 'SOA',
	'Menu:SOARecord+' => 'SOA Records',
	'Menu:TXTRecord' => 'TXT',
	'Menu:TXTRecord+' => 'TXT Records',
	'Menu:SRVRecord' => 'SRV',
	'Menu:SRVRecord+' => 'SRV Records',
));
