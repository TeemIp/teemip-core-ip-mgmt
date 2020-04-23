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

class _Zone extends DNSObject
{
	/**
	 * Check object before storing it
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \OQLException
	 */
	public function DoCheckToWrite()
	{
		parent::DoCheckToWrite();

		$sName = $this->Get('name');
		$sMapping = $this->Get('mapping');
		if ($sMapping == 'ipv4reverse')
		{
			$sPattern ='/^((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.){1,3}in-addr\.arpa\.$/';
			$aMatches = array();
			if (!preg_match($sPattern, $sName, $aMatches))
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:ZoneManagement:Action:New:Zone:V4:WrongFormat');
				return;
			}
		}
		elseif ($sMapping == 'ipv6reverse')
		{
			$sPattern = '/^((\d|[a-f]|[A-F])\.){1,31}ip6\.arpa\.$/';
			$aMatches = array();
			if (!preg_match($sPattern, $sName, $aMatches))
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:ZoneManagement:Action:New:Zone:V6:WrongFormat');
				return;
			}
		}
	}

	/**
	 * Straighten reverse zone name if required
	 *
	 * @param $sMapping
	 * @param $sName
	 *
	 * @return string
	 */
	private function StraightenReverse($sMapping, $sName)
	{
		if ($sMapping == 'ipv4reverse')
		{
			if (substr($sName, -13) != 'in-addr.arpa.')
			{
				if (substr($sName, -8) == 'in-addr.')
				{
					return ($sName.'arpa.');
				}
				elseif (substr($sName, -5) == 'arpa.')
				{
					$sName = substr($sName, 0, - 5);
					return ($sName.'in-addr.arpa.');
				}
				else
				{
					return ($sName.'in-addr.arpa.');
				}
			}
			else
			{
				return ($sName);
			}
		}
		elseif ($sMapping == 'ipv6reverse')
		{
			if (substr($sName, -9) != 'ip6.arpa.')
			{
				if (substr($sName, -4) == 'ip6.')
				{
					return ($sName.'arpa.');
				}
				elseif (substr($sName, -5) == 'arpa.')
				{
					$sName = substr($sName, 0, - 5);
					return ($sName.'ip6.arpa.');
				}
				else
				{
					return ($sName.'ip6.arpa.');
				}
			}
			else
			{
				return ($sName);
			}
		}
		return ($sName);
	}
	
	/**
	 * Perform actions when new object is inserted in DB 
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	protected function OnInsert()
    {
	    parent::OnInsert();

	    // Add '.' at the end of name and sourcedname fields if not already set
	    $sName = strtolower($this->Get('name'));
	    if (substr($sName, - 1) != '.')
	    {
	    	$this->Set('name', $sName.'.');
	    }
	    $sSourceDName = strtolower($this->Get('sourcedname'));
	    if (substr($sSourceDName, - 1) != '.')
	    {
	    	$this->Set('sourcedname', $sSourceDName.'.');
	    }	    
	    
	    // Check if reverse zone ends up with right arpa domain.
	    $sName = $this->StraightenReverse($this->Get('mapping'), $this->Get('name'));
	    $this->Set('name', $sName);
    }
   
	/**
	 * Perform actions when object is updated in DB 
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	protected function OnUpdate()
    {
	    parent::OnUpdate();
			
    	// Add '.' at the end of name and sourcedname fields if not already set
	    $sName = $this->Get('name');
	    if (substr($sName, - 1) != '.')
	    {
	    	$this->Set('name', $sName.'.');         
		}	     
		$sSourceDName = $this->Get('sourcedname');
	    if (substr($sSourceDName, - 1) != '.')
	    {
	    	$this->Set('sourcedname', $sSourceDName.'.');         
		}	     

		// Check if reverse zone ends up with right arpa domain.
		$sName = $this->StraightenReverse($this->Get('mapping'), $this->Get('name'));
		$this->Set('name', $sName);
    }
    
	/**
	 * Display additional tabs to Zone object 
	 *
	 * @param \WebPage $oP
	 * @param bool $bEditMode
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	public function DisplayBareRelations(WebPage $oP, $bEditMode = false)
    {		
		// Execute parent function first 
		parent::DisplayBareRelations($oP, $bEditMode);
		
		if (!$bEditMode)
		{
			// Tab for NS records
			$sOQL = "SELECT NSRecord WHERE zone_id = :zone_id";
			$oNSRecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
			$iNSRecords = $oNSRecordSet->Count();
			if ($iNSRecords > 0)
			{
				$oP->SetCurrentTab(Dict::S('Class:Zone/Tab:nsrecords_list').' ('.$iNSRecords.')');
				$oP->p(MetaModel::GetClassIcon('NSRecord').'&nbsp;'.Dict::S('Class:Zone/Tab:nsrecords_list+'));
				$oBlock = new DisplayBlock($oNSRecordSet->GetFilter(), 'list', false);
				$oBlock->Display($oP, 'ns_records', array('menu' => false));
			}
			else
			{
				$oP->SetCurrentTab(Dict::S('Class:Zone/Tab:nsrecords_list'));
				$oP->p(MetaModel::GetClassIcon('NSRecord').'&nbsp;'.Dict::S('UI:NoObjectToDisplay'));
			}
				
			switch ($this->Get('mapping'))
			{
				case 'direct':
					// Tab for A records
					$sOQL = "SELECT ARecord WHERE zone_id = :zone_id";
					$oARecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
					$iARecords = $oARecordSet->Count();
					if ($iARecords > 0)
					{
						$oP->SetCurrentTab(Dict::S('Class:Zone/Tab:arecords_list').' ('.$iARecords.')');
						$oP->p(MetaModel::GetClassIcon('ARecord').'&nbsp;'.Dict::S('Class:Zone/Tab:arecords_list+'));
						$oBlock = new DisplayBlock($oARecordSet->GetFilter(), 'list', false);
						$oBlock->Display($oP, 'a_records', array('menu' => false));
					}
					else
					{
						$oP->SetCurrentTab(Dict::S('Class:Zone/Tab:arecords_list'));
						$oP->p(MetaModel::GetClassIcon('ARecord').'&nbsp;'.Dict::S('UI:NoObjectToDisplay'));
					}
					
					// Tab for AAAA records
					$sOQL = "SELECT AAAARecord WHERE zone_id = :zone_id";
					$oAAAARecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
					$iAAAARecords = $oAAAARecordSet->Count();
					if ($iAAAARecords > 0)
					{
						$oP->SetCurrentTab(Dict::S('Class:Zone/Tab:aaaarecords_list').' ('.$iAAAARecords.')');
						$oP->p(MetaModel::GetClassIcon('AAAARecord').'&nbsp;'.Dict::S('Class:Zone/Tab:aaaarecords_list+'));
						$oBlock = new DisplayBlock($oAAAARecordSet->GetFilter(), 'list', false);
						$oBlock->Display($oP, 'aaaa_records', array('menu' => false));
					}
					else
					{
						$oP->SetCurrentTab(Dict::S('Class:Zone/Tab:aaaarecords_list'));
						$oP->p(MetaModel::GetClassIcon('AAAARecord').'&nbsp;'.Dict::S('UI:NoObjectToDisplay'));
					}

					// Tab for CNAME records
					$sOQL = "SELECT CNAMERecord WHERE zone_id = :zone_id";
					$oCNAMERecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
					$iCNAMERecords = $oCNAMERecordSet->Count();
					if ($iCNAMERecords > 0)
					{
						$oP->SetCurrentTab(Dict::S('Class:Zone/Tab:cnamerecords_list').' ('.$iCNAMERecords.')');
						$oP->p(MetaModel::GetClassIcon('CNAMERecord').'&nbsp;'.Dict::S('Class:Zone/Tab:cnamerecords_list+'));
						$oBlock = new DisplayBlock($oCNAMERecordSet->GetFilter(), 'list', false);
						$oBlock->Display($oP, 'cname_records', array('menu' => false));
					}
					else
					{
						$oP->SetCurrentTab(Dict::S('Class:Zone/Tab:cnamerecords_list'));
						$oP->p(MetaModel::GetClassIcon('CNAMERecord').'&nbsp;'.Dict::S('UI:NoObjectToDisplay'));
					}
					
					// Tab for Other records
					$sOQL = "SELECT MXRecord WHERE zone_id = :zone_id";
					$oMXRecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
					$iMXRecords = $oMXRecordSet->Count();
					$iOtherRecords = $iMXRecords;
					
					$sOQL = "SELECT SRVRecord WHERE zone_id = :zone_id";
					$oSRVRecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
					$iSRVRecords = $oSRVRecordSet->Count();
					$iOtherRecords += $iSRVRecords;
					
					$sOQL = "SELECT TXTRecord WHERE zone_id = :zone_id";
					$oTXTRecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
					$iTXTRecords = $oTXTRecordSet->Count();
					$iOtherRecords += $iTXTRecords;
					
					if ($iOtherRecords > 0)
					{
						$oP->SetCurrentTab(Dict::S('Class:Zone/Tab:otherrecords_list').' ('.$iOtherRecords.')');
					}
					else
					{
						$oP->SetCurrentTab(Dict::S('Class:Zone/Tab:otherrecords_list'));
					}
					if ($iMXRecords > 0)
					{
						$oP->p(MetaModel::GetClassIcon('MXRecord').'&nbsp;'.Dict::Format('Class:Zone/Tab:mxrecords_list', $iMXRecords));
						$oBlock = new DisplayBlock($oMXRecordSet->GetFilter(), 'list', false);
						$oBlock->Display($oP, 'mx_records', array('menu' => false));
					}
					else
					{
						$oP->p(MetaModel::GetClassIcon('MXRecord').'&nbsp;'.Dict::S('Class:Zone/Tab:mxrecords_list_empty'));
					}
					if ($iSRVRecords > 0)
					{
						$oP->p(MetaModel::GetClassIcon('SRVRecord').'&nbsp;'.Dict::Format('Class:Zone/Tab:srvrecords_list', $iSRVRecords));
						$oBlock = new DisplayBlock($oSRVRecordSet->GetFilter(), 'list', false);
						$oBlock->Display($oP, 'srv_records', array('menu' => false));
					}
					else
					{
						$oP->p(MetaModel::GetClassIcon('SRVRecord').'&nbsp;'.Dict::S('Class:Zone/Tab:srvrecords_list_empty'));
					}
					if ($iTXTRecords > 0)
					{
						$oP->p(MetaModel::GetClassIcon('TXTRecord').'&nbsp;'.Dict::Format('Class:Zone/Tab:txtrecords_list', $iTXTRecords));
						$oBlock = new DisplayBlock($oTXTRecordSet->GetFilter(), 'list', false);
						$oBlock->Display($oP, 'txt_records', array('menu' => false));
					}
					else
					{
						$oP->p(MetaModel::GetClassIcon('TXTRecord').'&nbsp;'.Dict::S('Class:Zone/Tab:txtrecords_list_empty'));
					}
				break;
				
				case 'ipv4reverse':
				case 'ipv6reverse':
					// Tab for PTR records
					$sOQL = "SELECT PTRRecord WHERE zone_id = :zone_id";
					$oPTRRecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
					$iPTRRecords = $oPTRRecordSet->Count();
					if ($iPTRRecords > 0)
					{
						$oP->SetCurrentTab(Dict::S('Class:Zone/Tab:ptrrecords_list').' ('.$iPTRRecords.')');
						$oP->p(MetaModel::GetClassIcon('PTRRecord').'&nbsp;'.Dict::S('Class:Zone/Tab:ptrrecords_list+'));
						$oBlock = new DisplayBlock($oPTRRecordSet->GetFilter(), 'list', false);
						$oBlock->Display($oP, 'ptr_records', array('menu' => false));
					}
					else
					{
						$oP->SetCurrentTab(Dict::S('Class:Zone/Tab:ptrrecords_list'));
						$oP->p(MetaModel::GetClassIcon('PTRRecord').'&nbsp;'.Dict::S('UI:NoObjectToDisplay'));
					}
					
					break;
				
				default:
				break;
			}
		}
    }

    /**
     * Provides zone in BIND format in a text field
     *
	 * @param $sSortOrder
	 *
	 * @return string
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function GetDataFile($sSortOrder)
    {
     	// Default TTL
     	$sHtml = "\$TTL ".$this->Get('ttl')."\n";
     	
     	// SOA Record
        $sMBox = $this->Get('mbox');
	    if (substr($sMBox, - 1) != '.')
	    {
	    	$sMBox .= '.';         
		}	     
      	$sHtml .= "@ IN SOA ".$this->Get('sourcedname')." ".str_replace("@", ".", $sMBox)." (\n";
     	$sHtml .= str_pad("", SPACE_TO_SOA)." ".str_pad($this->Get('serial'), SPACE_SOA_TO_COMMENT)."; Serial\n";
     	$sHtml .= str_pad("", SPACE_TO_SOA)." ".str_pad($this->Get('refresh'), SPACE_SOA_TO_COMMENT)."; Refresh\n";
     	$sHtml .= str_pad("", SPACE_TO_SOA)." ".str_pad($this->Get('retry'), SPACE_SOA_TO_COMMENT)."; Retry\n";
     	$sHtml .= str_pad("", SPACE_TO_SOA)." ".str_pad($this->Get('expire'), SPACE_SOA_TO_COMMENT)."; Expire\n";
     	$sHtml .= str_pad("", SPACE_TO_SOA)." ".str_pad($this->Get('minimum')." )", SPACE_SOA_TO_COMMENT)."; Negative caching\n";
     	
        // NS records section
     	$sHtml .= Dict::S('Class:Zone/DataFile:ns')."\n";
     	$sOQL = "SELECT NSRecord WHERE zone_id = :zone_id";
     	$oNSRecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
     	while ($oNSRecord = $oNSRecordSet->Fetch())
     	{
     		$sHtml .= $oNSRecord->GetDataString();
     	}
     	
     	// Retrieve records
		switch ($this->Get('mapping'))
		{
			case 'direct':
		     	$sOQL = "SELECT ARecord WHERE zone_id = :zone_id";
		     	$oARecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
		     	$sOQL = "SELECT AAAARecord WHERE zone_id = :zone_id";
		     	$oAAAARecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
				$sOQL = "SELECT CNAMERecord WHERE zone_id = :zone_id";
				$oCNAMERecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
				$sOQL = "SELECT MXRecord WHERE zone_id = :zone_id";
				$oMXRecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
				$sOQL = "SELECT SRVRecord WHERE zone_id = :zone_id";
				$oSRVRecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
				$sOQL = "SELECT TXTRecord WHERE zone_id = :zone_id";
				$oTXTRecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));
		
				if ($sSortOrder == 'sort_by_record')
				{
			     	// A records section
		    	 	$sHtml .= Dict::S('Class:Zone/DataFile:ipv4')."\n";
		     		while ($oARecord = $oARecordSet->Fetch())
			     	{
			     		$sHtml .= $oARecord->GetDataString();
			     	}
			     	
			        // AAAA records section
			     	$sHtml .= Dict::S('Class:Zone/DataFile:ipv6')."\n";
			     	while ($oAAAARecord = $oAAAARecordSet->Fetch())
			     	{
			     		$sHtml .= $oAAAARecord->GetDataString();
			     	}
			     	
			     	// CNAMES records section
			     	$sHtml .= Dict::S('Class:Zone/DataFile:cnames')."\n";
			     	while ($oCNAMERecord = $oCNAMERecordSet->Fetch())
			     	{
			     		$sHtml .= $oCNAMERecord->GetDataString();
			     	}
			     	
			        // MX records section
			     	$sHtml .= Dict::S('Class:Zone/DataFile:mx')."\n";
			     	while ($oMXRecord = $oMXRecordSet->Fetch())
			     	{
			     		$sHtml .= $oMXRecord->GetDataString();
			     	}
			     	
			        // SRV records section
			     	$sHtml .= Dict::S('Class:Zone/DataFile:srv')."\n";
			     	while ($oSRVRecord = $oSRVRecordSet->Fetch())
			     	{
			     		$sHtml .= $oSRVRecord->GetDataString();
			     	}
			     	
			        // TXT records section
			     	$sHtml .= Dict::S('Class:Zone/DataFile:txt')."\n";
			     	while ($oTXTRecord = $oTXTRecordSet->Fetch())
			     	{
			     		$sHtml .= $oTXTRecord->GetDataString();
			     	}
				}
				else
				{
					// List zone records in an array
					$aZoneRecords = array();
					while ($oARecord = $oARecordSet->Fetch())
					{
						$aZoneRecord = array();
						$aZoneRecord['name'] = $oARecord->Get('name');
						$aZoneRecord['data-string'] = $oARecord->GetDataString();
						$aZoneRecords[] = $aZoneRecord;
					}
					while ($oAAAARecord = $oAAAARecordSet->Fetch())
					{
						$aZoneRecord = array();
						$aZoneRecord['name'] = $oAAAARecord->Get('name');
						$aZoneRecord['data-string'] = $oAAAARecord->GetDataString();
						$aZoneRecords[] = $aZoneRecord;
					}
					while ($oCNAMERecord = $oCNAMERecordSet->Fetch())
					{
						$aZoneRecord = array();
						$aZoneRecord['name'] = $oCNAMERecord->Get('name');
						$aZoneRecord['data-string'] = $oCNAMERecord->GetDataString();
						$aZoneRecords[] = $aZoneRecord;
					}
					while ($oMXRecord = $oMXRecordSet->Fetch())
					{
						$aZoneRecord = array();
						$aZoneRecord['name'] = $oMXRecord->Get('name');
						$aZoneRecord['data-string'] = $oMXRecord->GetDataString();
						$aZoneRecords[] = $aZoneRecord;
					}
					while ($oSRVRecord = $oSRVRecordSet->Fetch())
					{
						$aZoneRecord = array();
						$aZoneRecord['name'] = $oSRVRecord->Get('name');
						$aZoneRecord['data-string'] = $oSRVRecord->GetDataString();
						$aZoneRecords[] = $aZoneRecord;
					}
					while ($oTXTRecord = $oTXTRecordSet->Fetch())
					{
						$aZoneRecord = array();
						$aZoneRecord['name'] = $oTXTRecord->Get('name');
						$aZoneRecord['data-string'] = $oTXTRecord->GetDataString();
						$aZoneRecords[] = $aZoneRecord;
					}
					
					// Sort array and display it
					asort($aZoneRecords);
					$sHtml .= Dict::S('Class:Zone/DataFile:records_in_alphaorder')."\n";
					foreach ($aZoneRecords as $index => $aRecord)
					{
						$sHtml .= $aRecord['data-string'];
					}
				}
			break;
			
			case 'ipv4reverse':
			case 'ipv6reverse':
				$sOQL = "SELECT PTRRecord WHERE zone_id = :zone_id";
		     	$oPTRRecordSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('zone_id' => $this->GetKey()));

			    // PTR records section
		    	$sHtml .= Dict::S('Class:Zone/DataFile:ptr')."\n";
		     	while ($oPTRRecord = $oPTRRecordSet->Fetch())
			    {
			    	$sHtml .= $oPTRRecord->GetDataString();
			    }
			     	
				break;
				
			default:
			break;
		}
     	return $sHtml;     	
    }
   
    /**
     * Provides the zone that correspond to a FQDN
     *
	 * @param $sFqdn
	 * @param $iView
	 * @param $sMapping
	 * @param $iOrgId
	 *
	 * @return array
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	static function GetZoneFromFqdn($sFqdn, $iView, $sMapping, $iOrgId)
    {
    	$sError = '';
	    if ((strlen($sFqdn) == 0) || ($iOrgId == 0))
 	    {
	    	return array(Dict::Format('UI:ZoneManagement:Action:IPAddress:UpdateRRs:Error:CannotFindZone:'.$sMapping), 0);
	    }
   		$sOQL = "SELECT Zone WHERE org_id = :org_id AND view_id = :view_id AND name = :name";
	    $oZoneSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('org_id' => $iOrgId, 'view_id' => $iView, 'name' => $sFqdn));
	    if ($oZone = $oZoneSet->Fetch())
	    {
	    	$iZoneId = $oZone->GetKey();
	    }
	    else
	    {
		    $i = strpos($sFqdn, '.');
		    $sNextFqdn = substr($sFqdn, $i + 1);
		    list($sError, $iZoneId) = Zone::GetZoneFromFqdn($sNextFqdn, $iView, $sMapping, $iOrgId);
	    }
    	return array($sError, $iZoneId);
    }

    /**
     * Increase serial number
     *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	public function IncreaseSerial()
	{
		$iSerial = $this->Get('serial');
		$this->Set('serial', $iSerial + 1);
	}
}
