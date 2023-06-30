<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPv6Management\Model;

/**
 * This class is used *just* to fool CMDBSource::Quote so that is_string returns false
 * on the 64 bit value. The goal is to be able to generate an SQL query as the following:
 * INSERT INTO myTable (ip_address_text, ip_adress_high, ip_address_low) VALUES ('FFC0:0412:58EF:48DC:0804:5790:CA31:DE22', 0xFFC0041258EF48DC, 0x08045790CA31DE22)
 * instead of
 * INSERT INTO myTable (ip_address_text, ip_adress_high, ip_address_low) VALUES ('FFC0:0412:58EF:48DC:0804:5790:CA31:DE22', '0xFFC0041258EF48DC', '0x08045790CA31DE22')
 * 
 * Note: whenever you want to pass a literal 64-bit value to the ORM, encapsulate it into an orm64bit object to prevent
 * its transformation into a string
 *
 */
 
class orm64bit
{
	protected $sHexValue;
	
	/*
	 * Create an orm64bit object from a text string
	 *
	 * @param $sHexValue
	 */
	public function __construct($sHexValue)
	{
		$this->sHexValue = $sHexValue;
	}
	
	/**
	 * Return the hexadecimal representation of the value
	 * (prefixed with 0x) suitable to be inserted in MySQL
	 */
	public function __toString()
	{
		return '0x'.$this->sHexValue;
	}
}
