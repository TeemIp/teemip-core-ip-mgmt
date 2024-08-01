<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Model;

use CMDBObjectSet;
use ContextTag;
use DBObjectSearch;
use DBObjectSet;
use DBSearch;
use Dict;
use IPAddress;
use IPConfig;
use IPv4Subnet;
use MetaModel;

class _IPv4Address extends IPAddress {
    /**
     * Get the subnet mask of the subnet that the IP belongs to, if any.
     *
     * @return float|int|mixed|\ormLinkSet|string|null
     * @throws \ArchivedObjectException
     * @throws \CoreException
     * @throws \CoreUnexpectedValue
     * @throws \MissingQueryArgument
     * @throws \MySQLException
     * @throws \MySQLHasGoneAwayException
     * @throws \OQLException
     */
    function GetSubnetMaskFromIp()
    {
        $sIp = $this->Get('ip');
        $iOrgId = $this->Get('org_id');
        $oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE INET_ATON(s.ip) <= INET_ATON(:ip) AND INET_ATON(:ip) <= INET_ATON(s.broadcastip) AND s.org_id = :org_id"), array(), array(
            'ip' => $sIp,
            'org_id' => $iOrgId,
        ));
        if ($oSubnetSet->Count()!=0) {
            $oSubnet = $oSubnetSet->Fetch();

            return ($oSubnet->Get('mask'));
        }

        return '255.255.255.255';
    }

    /**
     * Get the gateway of the subnet that the IP belongs to, if any.
     *
     * @return float|int|mixed|\ormLinkSet|string|null
     * @throws \ArchivedObjectException
     * @throws \CoreException
     * @throws \CoreUnexpectedValue
     * @throws \MissingQueryArgument
     * @throws \MySQLException
     * @throws \MySQLHasGoneAwayException
     * @throws \OQLException
     */
    function GetSubnetGatewayFromIp()
    {
        $sIp = $this->Get('ip');
        $iOrgId = $this->Get('org_id');
        $oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE INET_ATON(s.ip) <= INET_ATON(:ip) AND INET_ATON(:ip) <= INET_ATON(s.broadcastip) AND s.org_id = :org_id"), array(), array(
            'ip' => $sIp,
            'org_id' => $iOrgId,
        ));
        if ($oSubnetSet->Count()!=0) {
            $oSubnet = $oSubnetSet->Fetch();
            $sGwIp = $oSubnet->Get('gatewayip');

            return ($sGwIp);
        }

        return '0.0.0.0';
    }

    /**
     * @inheritdoc
     */
    public function ComputeValues()
    {
        parent::ComputeValues();

        $iOrgId = $this->Get('org_id');
        $sIp = $this->Get('ip');

        $iSubnetId = $this->Get('subnet_id');
        if ($iSubnetId==0) {
            // No subnet parent set yet. Look for the only one that IP may belong to.
            // If none -> orphean IP
            $oSubnetSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Subnet AS s WHERE INET_ATON(s.ip) <= INET_ATON(:ip) AND INET_ATON(:ip) <= INET_ATON(s.broadcastip) AND s.org_id = :org_id"), array(), array(
                'ip' => $sIp,
                'org_id' => $iOrgId,
            ));
            if ($oSubnetSet->Count()!=0) {
                $oSubnet = $oSubnetSet->Fetch();
                $this->Set('subnet_id', $oSubnet->GetKey());
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function DoCheckToWrite()
    {
        parent::DoCheckToWrite();

        // For new IPs only
        if ($this->IsNew()) {
            $iOrgId = $this->Get('org_id');
            $sIp = $this->Get('ip');

            // Make sure IP doesn't already exist for creation
            $oIpSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Address AS i WHERE i.ip = :ip AND i.org_id = :org_id"), array(), array('ip' => $sIp, 'org_id' => $iOrgId));
            while ($oIp = $oIpSet->Fetch()) {
                // It's a creation -> deny it
                $this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPAddress:IPCollision');

                return;
            }

            // If Subnet is selected, make sure IP belongs to it
            $iSubnetId = $this->Get('subnet_id');
            if ($iSubnetId!=0) {
                /** @var IPv4Subnet $oSubnet */
                $oSubnet = MetaModel::GetObject('IPv4Subnet', $iSubnetId, true /* MustBeFound */);
                if (!$oSubnet->DoCheckIpInSubnet($sIp)) {
                    $this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPAddress:NotInSubnet');

                    return;
                }
            }

            // If IP Range is selected, make sure IP belongs to range
            $iIpRangeId = $this->Get('range_id');
            if ($iIpRangeId!=null) {
                $oIpRange = MetaModel::GetObject('IPv4Range', $iIpRangeId, true /* MustBeFound */);
                if (!$oIpRange->DoCheckIpInRange($sIp)) {
                    $this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:New:IPAddress:NotInRange');

                    return;
                }
            } else {
                // If not look for IP Range that IP may belong to
                $oIpRangeSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT IPv4Range AS r WHERE INET_ATON(r.firstip) <= INET_ATON(:ip) AND INET_ATON(:ip) <= INET_ATON(r.lastip) AND r.org_id = :org_id"), array(), array(
                    'ip' => $sIp,
                    'org_id' => $iOrgId,
                ));
                if ($oIpRangeSet->Count()!=0) {
                    $oIpRange = $oIpRangeSet->Fetch();
                    $this->Set('range_id', $oIpRange->GetKey());
                }
            }

            // If required by global parameters, ping IP before assigning it
            $sPingBeforeAssign = $this->Get('ping_before_assign');
            if ($sPingBeforeAssign=='default') {
                $sPingBeforeAssign = IPConfig::GetFromGlobalIPConfig('ping_before_assign', $iOrgId);
            }
            if ($sPingBeforeAssign=='ping_yes') {
                $aOutput = $this->DoCheckIpPings($this->Get('ip'), TIME_TO_WAIT_FOR_PING_LONG);
                if (!empty($aOutput)) {
                    $sOutput = '<br>'.implode('<br>', $aOutput);
                    $this->m_aCheckIssues[] = Dict::S('UI:IPManagement:Action:New:IPAddress:IPPings').$sOutput;

                    return;
                }
            }
        }
    }

    /**
     * Check if IP pings
     *
     * @param $sIp
     * @param $iTimeToWait
     *
     * @return array|mixed
     */
    static function DoCheckIpPings($sIp, $iTimeToWait)
    {
        // Disable ping if IP is created from a synchro... which may be the result of a discovery operation.
        if (!ContextTag::Check('Synchro')) {
            $sSystemType = strtoupper(php_uname($mode = "s"));
            if (strpos($sSystemType,
                    'WIN')===false) {
                // Unix type - what else?
                $sCommand = "ping -c ".NUMBER_OF_PINGS." -W ".$iTimeToWait." ".$sIp;
            } else {
                // Windows
                $sCommand = "ping -n ".NUMBER_OF_PINGS." -w ".($iTimeToWait * 1000)." ".$sIp;
            }
            exec($sCommand,
                $aOutput,
                $iRes);
            if ($iRes==0) {
                //Command got an answer. Make sure it is a positive one.
                $sOutput = stripos(implode($aOutput),
                    'ttl');
                if ($sOutput!==false) {
                    // ttl string is in the answer => IP pings
                    array_unshift($aOutput,
                        $sCommand);

                    return $aOutput;
                }
            }
        }

        return array();
    }

    /**
     * @inheritdoc
     */
    public function AfterDelete()
    {
        parent::AfterDelete();

        $iOrgId = $this->Get('org_id');

        // Look for subnet where IP belongs to (should be only one)
        //  Generate event if Low Water Mark is crossed
        $iSubnetId = $this->Get('subnet_id');
        $oSubnet = MetaModel::GetObject('IPv4Subnet', $iSubnetId, false /* MustBeFound */);
        if (!is_null($oSubnet)) {
            $sSubnetLowWaterMark = IPConfig::GetFromGlobalIPConfig('subnet_low_watermark', $iOrgId);
            $sSubnetHighWaterMark = IPConfig::GetFromGlobalIPConfig('subnet_high_watermark', $iOrgId);

            $oSubnetOccupancy = $oSubnet->GetOccupancy('IPv4Address');
            $oSubnetAlarm = $oSubnet->Get('alarm_water_mark');
            if ($oSubnetOccupancy < $sSubnetLowWaterMark) {
                // Reset water mark alarm if needed
                if ($oSubnetAlarm!='no_alarm') {
                    $oSubnet->Set('alarm_water_mark', 'no_alarm');
                    $oSubnet->DBUpdate();
                }
            } else {
                if ($oSubnetOccupancy < $sSubnetHighWaterMark) {
                    // Reset water mark alarm if needed
                    if ($oSubnetAlarm!='low_sent') {
                        $oSubnet->Set('alarm_water_mark', 'low_sent');
                        $oSubnet->DBUpdate();
                    }
                }
            }
        }

        // Look for ranges where IP belongs to (should be only one)
        //  Generate event if Low Water Mark is crossed
        $iIpRangeId = $this->Get('range_id');
        if ($iIpRangeId!=null) {
            $oIpRange = MetaModel::GetObject('IPv4Range', $iIpRangeId, true /* MustBeFound */);
            $sIpRangeLowWaterMark = IPConfig::GetFromGlobalIPConfig('iprange_low_watermark', $iOrgId);
            $sIpRangeHighWaterMark = IPConfig::GetFromGlobalIPConfig('iprange_high_watermark', $iOrgId);

            $oIpRangeOccupancy = $oIpRange->GetOccupancy('IPv4Address');
            $oIpRangeAlarm = $oIpRange->Get('alarm_water_mark');
            if ($oIpRangeOccupancy < $sIpRangeLowWaterMark) {
                // Reset water mark alarm if needed
                if ($oIpRangeAlarm!='no_alarm') {
                    $oIpRange->Set('alarm_water_mark', 'no_alarm');
                    $oIpRange->DBUpdate();
                }
            } else {
                if ($oIpRangeOccupancy < $sIpRangeHighWaterMark) {
                    // Reset water mark alarm if needed
                    if ($oIpRangeAlarm!='low_sent') {
                        $oIpRange->Set('alarm_water_mark', 'low_sent');
                        $oIpRange->DBUpdate();
                    }
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
    {
        $sFlagsFromParent = parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);

        switch ($sAttCode) {
            case 'ip':
            case 'subnet_id':
            case 'range_id':
                return (OPT_ATT_READONLY | $sFlagsFromParent);

            default:
                break;
        }

        return $sFlagsFromParent;
    }

    /**
     * Get the previous IP if it exists
     *
     * @param bool $bInSubnet if lookup should be done in IP's subnet only
     *
     * @return null
     */
    public function GetPreviousIp($bInSubnet)
    {
        // Create OQL according to $bInSubnet
        $iSubnet = $this->Get('subnet_id');
        if ($bInSubnet) {
            if ($iSubnet > 0) {
                $sOQL = 'SELECT IPv4Address AS ip WHERE ip.subnet_id = :subnet_id AND INET_ATON(ip.ip) < INET_ATON(:ip)';
            } else {
                return null;
            }
        } else {
            $sOQL = 'SELECT IPv4Address AS ip WHERE ip.org_id = :org_id AND INET_ATON(ip.ip) < INET_ATON(:ip)';
        }
        // Set the ordering criteria ['ip'=> false] and set a limit (1)
        $oIpSet = new DBObjectSet(DBSearch::FromOQL($sOQL), ['ip' => false], ['org_id' => $this->Get('org_id'), 'subnet_id' => $iSubnet, 'ip' => $this->Get('ip')], null, 1);
        $oIpSet->OptimizeColumnLoad(['IPv4Address' => ['id', 'ip']]);
        if ($oPreviousIp = $oIpSet->Fetch()) {
            return $oPreviousIp;
        }

        return null;
    }

    /**
     * Get the next IP if it exists
     *
     * @param $bInSubnet true if lookup should be done in IP's subnet only
     *
     * @return null
     */
    public function GetNextIp($bInSubnet)
    {
        // Create OQL according to $bInSubnet
        $iSubnet = $this->Get('subnet_id');
        if ($bInSubnet) {
            if ($iSubnet > 0) {
                $sOQL = 'SELECT IPv4Address AS ip WHERE ip.subnet_id = :subnet_id AND INET_ATON(ip.ip) > INET_ATON(:ip)';
            } else {
                return null;
            }
        } else {
            $sOQL = 'SELECT IPv4Address AS ip WHERE ip.org_id = :org_id AND INET_ATON(ip.ip) > INET_ATON(:ip)';
        }
        // Set the ordering criteria ['ip'=> false] and set a limit (1)
        $oIpSet = new DBObjectSet(DBSearch::FromOQL($sOQL), ['ip' => true], ['org_id' => $this->Get('org_id'), 'subnet_id' => $iSubnet, 'ip' => $this->Get('ip')], null, 1);
        $oIpSet->OptimizeColumnLoad(['IPv4Address' => ['id', 'ip']]);
        if ($oNextIp = $oIpSet->Fetch()) {
            return $oNextIp;
        }

        return null;
    }

}
