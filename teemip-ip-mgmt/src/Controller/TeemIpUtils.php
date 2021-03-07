<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Controller;

class TeemIpUtils
{
	/**
	 * @param $sIp
	 *
	 * @return int
	 */
	public static function myip2long($sIp)
	{
		//return(($sIp == '255.255.255.255') ? MAX_IPV4_VALUE : ip2long($sIp)); // Doesn't work for IPs > 128.0.0.0
		//return(($sIp == '255.255.255.255') ? MAX_IPV4_VALUE : sprintf("%u", ip2long($sIp))); // OK so far...
		return (ip2long($sIp));
	}

	/**
	 * @param $iIp
	 *
	 * @return string
	 */
	public static function mylong2ip($iIp)
	{
		return (long2ip($iIp));
	}
}
