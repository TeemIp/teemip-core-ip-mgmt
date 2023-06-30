<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPv6Management\Model;

use Exception;
use TeemIp\TeemIp\Extension\IPManagement\Model\ormIP;

/********************************************************************************
 * Class for handling IPv6 addresses and storing them in an AttributeIPv6Address
 */
class ormIPv6 extends ormIP {
    // String representation of the address, stored in canonical IPv6 format
    protected $sIPv6;
    // String representation of the address, stored in compressed IPv6 format
    protected $sCompressed;
    // High order 64 bits of the address, stored as string in hexadecimal (without the 0x prefix)
    protected $sHigh;
    // Low order 64 bits of the address, stored as string in hexadecimal (without the 0x prefix)
    protected $sLow;
    // Array containing the 8 nibbles of the address in decimal format, in reverted order
    protected $aNibbles;

    /**
     * ormIPv6 constructor.
     *
     * @param string $sIPv6
     */
    public function __construct($sIPv6 = '0000:0000:0000:0000:0000:0000:0000:0000')
    {
        $this->sIPv6 = strtolower($this->Canonicalize($sIPv6));
        $this->sCompressed = $this->CanToComp($this->sIPv6);
        $this->ComputeHighPart();
        $this->ComputeLowPart();
        $this->ComputeNibbles();
    }

    /**
     * Magic method called when casting to a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->ToString();
    }

    /**
     * @return string
     */
    public function ToString()
    {
        return $this->sCompressed;
    }

    /**
     * @return mixed
     */
    public function GetHighULong()
    {
        return $this->sHigh;
    }

    /**
     * @return mixed
     */
    public function GetLowULong()
    {
        return $this->sLow;
    }

    /**
     * @return mixed
     */
    public function GetNibbles()
    {
        return $this->aNibbles;
    }

    /**
     * Computes the "High" part of the address from the canonicalized representation
     */
    protected function ComputeHighPart()
    {
        // Just remove the colons and extract the 16 first characters
        $sHexa = str_replace(':', '', $this->sIPv6);
        $this->sHigh = strtolower(substr($sHexa, 0, 16));
    }

    /**
     * Computes the "Low" part of the address from the canonicalized representation
     */
    protected function ComputeLowPart()
    {
        // Just remove the colons and extract the 16 last characters
        $sHexa = str_replace(':', '', $this->sIPv6);
        $this->sLow = strtolower(substr($sHexa, 16, 16));
    }

    /**
     * Chop IPv6 in 16 bits chunks - 8 nibbles of 4 char in reverted order
     * Store in array with low order bits first
     */
    protected function ComputeNibbles()
    {
        $aHexa = explode(':', $this->sIPv6);
        $aHexa = array_reverse($aHexa);
        $this->aNibbles = array();
        foreach ($aHexa as $sHexNumber) {
            $this->aNibbles[] = hexdec($sHexNumber);
        }
    }

    /**
     * @return string
     */
    public function GetAsCannonical()
    {
        return $this->sIPv6;
    }

    /**
     * @return string
     */
    public function GetAsNonLeadingZeros()
    {
        return $this->CanToNlz($this->sIPv6);
    }

    /**
     * @return string|string[]|null
     */
    public function GetAsCompressed()
    {
        return $this->sCompressed;
    }

    /**
     * @param $sIPv6
     *
     * @return string|string[]
     */
    protected function Canonicalize($sIPv6)
    {
        return $this->CompToCan($sIPv6);
    }

    /**
     * Trim each of the 8 IPv6 fields of leading 0s
     *
     * @param $sIPv6
     *
     * @return string
     */
    public function CanToNlz($sIPv6)
    {
        $aIPv6 = explode(':', $sIPv6);
        $sNlzIp = '';
        $i = 1;
        foreach ($aIPv6 as $Field) {
            $Field = ltrim($Field, '0');
            if ($Field=='') {
                $sNlzIp .= '0';
            } else {
                $sNlzIp .= $Field;
            }
            if ($i++ < 8) {
                $sNlzIp .= ':';
            }
        }
        return $sNlzIp;
    }

    /**
     * @param $sIPv6
     *
     * @return string|string[]|null
     */
    public function CanToComp($sIPv6)
    {
        $sIPv6 = $this->CanToNlz($sIPv6);
        $sIPv6 = $this->NlzToComp($sIPv6);
        return $sIPv6;
    }

    /**
     * Add required 0s to each of the 8 IPv6 fields
     * @param $sIPv6
     *
     * @return string
     */
    public function NlzToCan($sIPv6)
    {
        if (strlen($sIPv6) < IPV6_MAX_CHAR) {
            $aIPv6 = explode(':', $sIPv6);
            $sCanIp = '';
            $i = 1;
            foreach ($aIPv6 as $field) {
                $j = IPV6_NIBBLE_MAX_CHAR - strlen($field);
                if ($j > 0) {
                    $field = str_repeat("0", $j).$field;
                }
                $sCanIp .= $field;
                if ($i++ < IPV6_NIBBLE_NUMBER) {
                    $sCanIp .= ':';
                }
            }
            $sIPv6 = $sCanIp;
        }
        return $sIPv6;
    }

    /**
     * @param $sIPv6
     *
     * @return string|string[]|null
     */
    public function NlzToComp($sIPv6)
    {
        // Check IP is not already compressed
        if (strpos($sIPv6, '::')!==false) {
            return $sIPv6;
        }

        $sWorkIp = ':'.$sIPv6.':';
        preg_match_all("/(:0)(:0)+/", $sWorkIp, $sZeros);
        if (count($sZeros[0]) > 0) {
            $sBestMatch = '';
            foreach ($sZeros[0] as $sZeros) {
                if (strlen($sZeros) > strlen($sBestMatch)) {
                    $sBestMatch = $sZeros;
                }
            }
            $sWorkIp = preg_replace('/'.$sBestMatch.'/', ':', $sWorkIp, 1);
        }
        $sIPv6 = preg_replace('/((^:)|(:$))/', '', $sWorkIp);
        $sIPv6 = preg_replace('/((^:)|(:$))/', '::', $sIPv6);
        if ($sIPv6=='') {
            $sIPv6 = '::';
        }

        return $sIPv6;
    }

    /**
     * @param $sIPv6
     *
     * @return string|string[]
     */
    public function CompToCan($sIPv6)
    {
        $sIPv6 = $this->CompToNlz($sIPv6);
        $sIPv6 = $this->NlzToCan($sIPv6);
        return $sIPv6;
    }

    /**
     * @param $sIPv6
     *
     * @return string|string[]
     */
    public function CompToNlz($sIPv6)
    {
        if (strpos($sIPv6, '::')!==false) {
            $sIPv6 = str_replace('::', str_repeat(':0', 8 - substr_count($sIPv6, ':')).':', $sIPv6);
        }
        if (strpos($sIPv6, ':')===0) {
            $sIPv6 = '0'.$sIPv6;
        }
        return $sIPv6;
    }

    /**
     * Convert a binary string IPv6 into a nlz format - to be debug !!
     *
     * @param $binIp
     *
     * @return string
     */
    public function BinToNlz($binIp)
    {
        $sIp = "";
        if (strlen($binIp) < 128) {
            $binIp = str_pad($binIp, 128, '0', STR_PAD_LEFT);
        }
        $binIp = str_split($binIp, "16");
        $i = 1;
        foreach ($binIp as $ifield) {
            $sField = base_convert($ifield, 2, 16);
            $sIp .= $sField;
            if ($i++ < 8) {
                $sIp .= ':';
            }
        }
        return $sIp;
    }

    /**
     * Convert a compressed IPv6 into a binary string - to be debug !!
     *
     * @param $sIp
     *
     * @return string
     */
    public function CompToBin($sIp)
    {
        $binIp = '';
        $sIp = $this->CompToNlz($sIp);
        $sIp = explode(':', $sIp);
        foreach ($sIp as $sField) {
            $iField = base_convert($sField, 16, 2);
            $binIp .= str_pad($iField, 16, '0', STR_PAD_LEFT);
        }
        return $binIp;
    }

    /**
     * @param \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP $oIp
     *
     * @return bool
     * @throws \Exception
     */
    public function IsBiggerOrEqual(ormIP $oIp)
    {
        if (get_class($this)!=get_class($oIp)) {
            throw new Exception('Cannot compare IPs of different sizes');
        }
        for ($i = (IPV6_NIBBLE_NUMBER - 1); $i >= 0; $i--) {
            if ($this->aNibbles[$i] > $oIp->GetNibbles()[$i]) {
                return true;
            } else if ($this->aNibbles[$i] < $oIp->GetNibbles()[$i]) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP $oIp
     *
     * @return bool
     * @throws \Exception
     */
    public function IsBiggerStrict(ormIP $oIp)
    {
        if (get_class($this)!=get_class($oIp)) {
            throw new Exception('Cannot compare IPs of different sizes');
        }
        for ($i = (IPV6_NIBBLE_NUMBER - 1); $i >= 0; $i--) {
            if ($this->aNibbles[$i] > $oIp->GetNibbles()[$i]) {
                return true;
            } else if ($this->aNibbles[$i] < $oIp->GetNibbles()[$i]) {
                return false;
            }
        }
        return false;
    }

    /**
     * @param \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP $oIp
     *
     * @return bool
     * @throws \Exception
     */
    public function IsSmallerOrEqual(ormIP $oIp)
    {
        if (get_class($this)!=get_class($oIp)) {
            throw new Exception('Cannot compare IPs of different sizes');
        }
        for ($i = (IPV6_NIBBLE_NUMBER - 1); $i >= 0; $i--) {
            if ($this->aNibbles[$i] < $oIp->GetNibbles()[$i]) {
                return true;
            } else if ($this->aNibbles[$i] > $oIp->GetNibbles()[$i]) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP $oIp
     *
     * @return bool
     * @throws \Exception
     */
    public function IsSmallerStrict(ormIP $oIp)
    {
        if (get_class($this)!=get_class($oIp)) {
            throw new Exception('Cannot compare IPs of different sizes');
        }
        for ($i = (IPV6_NIBBLE_NUMBER - 1); $i >= 0; $i--) {
            if ($this->aNibbles[$i] < $oIp->GetNibbles()[$i]) {
                return true;
            } else if ($this->aNibbles[$i] > $oIp->GetNibbles()[$i]) {
                return false;
            }
        }
        return false;
    }

    /**
     * @param \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP $oIp
     *
     * @return bool
     * @throws \Exception
     */
    public function IsEqual(ormIP $oIp)
    {
        if (get_class($this)!=get_class($oIp)) {
            throw new Exception('Cannot compare IPs of different sizes');
        }
        for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++) {
            if ($oIp->GetNibbles()[$i]!=$this->aNibbles[$i]) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP $oIp
     *
     * @return bool
     * @throws \Exception
     */
    public function Equals(ormIP $oIp)
    {
        return $this->IsEqual($oIp);
    }

    /**
     * @param \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP $oIp
     *
     * @return \TeemIp\TeemIp\Extension\IPv6Management\Model\ormIPv6
     * @throws \Exception
     */
    public function BitwiseAnd(ormIP $oIp)
    {
        if (get_class($this)!=get_class($oIp)) {
            throw new Exception('Cannot apply bitwise operator to IPs of different sizes');
        }
        $aHexa = array();
        for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++) {
            $aHexa[$i] = dechex($this->aNibbles[$i] & $oIp->GetNibbles()[$i]);
        }
        $aHexa = array_reverse($aHexa);
        $sIPv6 = implode(":", $aHexa);
        return new ormIPv6($sIPv6);
    }

    /**
     * @param \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP $oIp
     *
     * @return \TeemIp\TeemIp\Extension\IPv6Management\Model\ormIPv6
     * @throws \Exception
     */
    public function BitwiseOr(ormIP $oIp)
    {
        if (get_class($this)!=get_class($oIp)) {
            throw new Exception('Cannot apply bitwise operator to IPs of different sizes');
        }
        $aHexa = array();
        for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++) {
            $aHexa[$i] = dechex($this->aNibbles[$i] | $oIp->GetNibbles()[$i]);
        }
        $aHexa = array_reverse($aHexa);
        $sIPv6 = implode(":", $aHexa);
        return new ormIPv6($sIPv6);
    }

    /**
     * @return \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP
     */
    public function BitwiseNot()
    {
        $aHexa = array();
        for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++) {
            $sHexa = dechex(~$this->aNibbles[$i]);
            $aHexa[$i] = substr($sHexa, -4, 4);
        }
        $aHexa = array_reverse($aHexa);
        $sIPv6 = implode(":", $aHexa);
        return new ormIPv6($sIPv6);
    }

    /**
     * @return \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP
     */
    public function LeftShift()
    {
        $aNibbles = array();
        for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++) {
            $aNibbles[$i] = $this->aNibbles[$i] * 2;
        }
        for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++) {
            if ($aNibbles[$i] >= IPV6_NIBBLE_MAX_VALUE) {
                $aNibbles[$i] -= IPV6_NIBBLE_MAX_VALUE;
                if ($i < IPV6_NIBBLE_NUMBER - 1) {
                    $aNibbles[$i + 1] += 1;
                }
            }
        }
        $aHexa = array();
        for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++) {
            $aHexa[$i] = dechex($aNibbles[$i]);
        }
        $aHexa = array_reverse($aHexa);
        $sIPv6 = implode(":", $aHexa);
        return new ormIPv6($sIPv6);
    }

    /**
     * @return float|int
     */
    public function IP2dec()
    {
        $iFirstHigh = hexdec($this->sHigh);
        $iFirstLow = hexdec($this->sLow);

        return ($iFirstHigh * IPV6_MAX_INTERFACES) + $iFirstLow + 1;
    }

    /**
     * @param \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP $oIp
     *
     * @return \TeemIp\TeemIp\Extension\IPv6Management\Model\ormIPv6
     * @throws \Exception
     */
    public function Add(ormIP $oIp)
    {
        if (get_class($this)!=get_class($oIp)) {
            throw new Exception('Cannot add 2 IPs of different classes');
        }
        $aAddNibbles = array();
        $iCarry = 0;
        for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++) {
            $aAddNibbles[$i] = $this->aNibbles[$i] + $oIp->GetNibbles()[$i] + $iCarry;
            if ($aAddNibbles[$i] >= IPV6_NIBBLE_MAX_VALUE) {
                $aAddNibbles[$i] -= IPV6_NIBBLE_MAX_VALUE;
                $iCarry = 1;
            } else {
                $iCarry = 0;
            }
            $aAddNibbles[$i] = dechex($aAddNibbles[$i]);
        }
        $aAddNibbles = array_reverse($aAddNibbles);
        $sIPv6 = implode(":", $aAddNibbles);

        return new ormIPv6($sIPv6);
    }

    /**
     * @return \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP
     */
    public function GetNextIp()
    {
        $aNextNibbles = $this->aNibbles;
        $aNextNibbles[0] += 1;
        $i = 0;
        $bCarryToPropagate = true;
        while ($bCarryToPropagate && ($i < IPV6_NIBBLE_NUMBER)) {
            if ($aNextNibbles[$i] >= IPV6_NIBBLE_MAX_VALUE) {
                $aNextNibbles[$i] = 0;
                if (++$i < IPV6_NIBBLE_NUMBER) {
                    $aNextNibbles[$i] += 1;
                }
            } else {
                $bCarryToPropagate = false;
            }
        }
        $aHexa = array();
        for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++) {
            $aHexa[$i] = dechex($aNextNibbles[$i]);
        }
        $aHexa = array_reverse($aHexa);
        $sIPv6 = implode(":", $aHexa);
        return new ormIPv6($sIPv6);
    }


    /**
     * @return \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP
     */
    public function GetPreviousIp()
    {
        $aPreviousNibbles = $this->aNibbles;
        $aPreviousNibbles[0] -= 1;
        $i = 0;
        $bCarryToPropagate = true;
        while ($bCarryToPropagate && ($i < IPV6_NIBBLE_NUMBER)) {
            if ($aPreviousNibbles[$i] < 0) {
                $aPreviousNibbles[$i] = IPV6_NIBBLE_MAX_VALUE - 1;
                if (++$i < IPV6_NIBBLE_NUMBER) {
                    $aPreviousNibbles[$i] -= 1;
                }
            } else {
                $bCarryToPropagate = false;
            }
        }
        $aHexa = array();
        for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++) {
            $aHexa[$i] = dechex($aPreviousNibbles[$i]);
        }
        $aHexa = array_reverse($aHexa);
        $sIPv6 = implode(":", $aHexa);
        return new ormIPv6($sIPv6);
    }

    /**
     * @param \TeemIp\TeemIp\Extension\IPManagement\Model\ormIP $oIp
     *
     * @return float|int
     * @throws \Exception
     */
    public function GetSizeInterval(ormIP $oIp)
    {
        if (get_class($this)!=get_class($oIp)) {
            throw new Exception('Cannot apply bitwise operator to IPs of different sizes');
        }
        if ($this->IsSmallerOrEqual($oIp)) {
            $oIpHigh = $oIp;
            $oIpLow = $this;
        } else {
            $oIpHigh = $this;
            $oIpLow = $oIp;
        }
        $aHexa = array();
        $iCarry = 0;
        for ($i = 0; $i < IPV6_NIBBLE_NUMBER; $i++) {
            $aHexa[$i] = $oIpHigh->aNibbles[$i] - $oIpLow->aNibbles[$i] - $iCarry;
            if ($aHexa[$i] < 0) {
                $aHexa[$i] += IPV6_NIBBLE_MAX_VALUE + 1;
                $iCarry = 1;
            } else {
                $iCarry = 0;
            }
            $aHexa[$i] = dechex($aHexa[$i]);
        }
        $aHexa = array_reverse($aHexa);
        $sIPv6 = implode(":", $aHexa);
        $oIPv6 = new ormIPv6($sIPv6);

        return hexdec($oIPv6->GetHighULong()) * IPV6_MAX_INTERFACES + hexdec($oIPv6->GetLowULong()) + 1;
    }
}
