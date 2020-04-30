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

/**
 * Class _IPSubnet
 */
class _IPSubnet extends IPObject
{
	/*
	 * Returns size of subnet
	 *
	 * @return int
	 */
	public function GetSize()
	{
		return 1;
	}
	
	/**
	 * Return % of occupancy of objects linked to $this
	 *
	 * @param $sObject
	 *
	 * @return int
	 */
	public function GetOccupancy($sObject)
	{
		return 0;
	}
	
	/**
	 * Return next operation after current one
	 *
	 * @param $sOperation
	 *
	 * @return string
	 */
	public function GetNextOperation($sOperation)
	{
		switch ($sOperation)
		{
			case 'findspace': return 'dofindspace';
			case 'dofindspace': return 'findspace';
				
			case 'listips': return 'dolistips';
			case 'dolistips': return 'listips';
				
			case 'shrinksubnet': return 'doshrinksubnet';
			case 'doshrinksubnet': return 'shrinksubnet';
				
			case 'splitsubnet': return 'dosplitsubnet';
			case 'dosplitsubnet': return 'splitsubnet';
				
			case 'expandsubnet': return 'doexpandsubnet';
			case 'doexpandsubnet': return 'expandsubnet';
			
			case 'csvexportips': return 'docsvexportips';
			case 'docsvexportips': return 'csvexportips';
	
			case 'calculator': return 'docalculator';
			case 'docalculator': return 'calculator';
	
			default: return '';
		}
	}
	
	/**
	 * Get parameters used for operation
	 *
	 * @param $sOperation
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function GetPostedParam($sOperation)
	{
		$aParam = array();
		switch ($sOperation)
		{
			case 'dofindspace':
				$aParam['rangesize'] = utils::ReadPostedParam('rangesize', '', 'raw_data');
				$aParam['maxoffer'] = utils::ReadPostedParam('maxoffer', 'DEFAULT_MAX_FREE_SPACE_OFFERS', 'raw_data');
				$aParam['status_subnet'] = '';
				$aParam['type'] = '';
				$aParam['location_id'] = '';
				$aParam['requestor_id'] = '';
			break;
					
			case 'dolistips':
				$aParam['first_ip'] = filter_var(utils::ReadPostedParam('attr_firstip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['last_ip'] = filter_var(utils::ReadPostedParam('attr_lastip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['status_ip'] = $this->GetDefaultValueAttribute('status');
				$aParam['short_name'] = '';
				$aParam['domain_id'] = '';
				$aParam['usage_id'] = '';
				$aParam['requestor_id'] = '';
			break;
			
			case 'doshrinksubnet':
			case 'dosplitsubnet':
			case 'doexpandsubnet':
				$aParam['scale_id'] = utils::ReadPostedParam('scale_id', '', 'raw_data');
				$aParam['requestor_id'] = utils::ReadPostedParam('attr_requestor_id', null);
			break;

			case 'docsvexportips':
				$aParam['first_ip'] = filter_var(utils::ReadPostedParam('attr_firstip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['last_ip'] = filter_var(utils::ReadPostedParam('attr_lastip', '', 'raw_data'), FILTER_VALIDATE_IP);
			break;
			
			case 'docalculator':
				$aParam['ip'] = filter_var(utils::ReadPostedParam('attr_ip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['mask'] = filter_var(utils::ReadPostedParam('attr_gatewayip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['cidr'] = filter_var(utils::ReadPostedParam('cidr', '', 'raw_data'), FILTER_VALIDATE_INT);
			break;
			
			default:
				break;
		}
		return $aParam;
	}

	/**
	 * Provides attributes' parameters
	 *
	 * @param $sAttCode
	 *
	 * @return array|void
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 */
	public function GetAttributeParams($sAttCode)
	{
		$aParams = array();
		if (($sAttCode == 'ip_occupancy') || ($sAttCode == 'range_occupancy'))
		{
			if ($sAttCode == 'ip_occupancy')
			{
				$Occupancy = $this->GetOccupancy('IPAddress');
			}
			else
			{
				$Occupancy = $this->GetOccupancy('IPRange');
			}
			$sOrgId = $this->Get('org_id');
			if ($sOrgId != null)
			{
				$sLowWaterMark = IPConfig::GetFromGlobalIPConfig('subnet_low_watermark', $sOrgId);
				$sHighWaterMark = IPConfig::GetFromGlobalIPConfig('subnet_high_watermark', $sOrgId);
				if ($Occupancy >= $sHighWaterMark)
				{
					$sColor = RED;
				}
				else if ($Occupancy >= $sLowWaterMark)
				{
					$sColor = YELLOW;
				}
				else
				{
					$sColor = GREEN;
				}
				$aParams ['value'] = round ($Occupancy, 0);
				$aParams ['color'] = $sColor;
			}
			else
			{
				$aParams ['value'] = 0;
				$aParams ['color'] = GREEN;
			}
		}
		else
		{
			$aParams ['value'] = 0;
			$aParams ['color'] = GREEN;
		}
		return ($aParams);
	}

	/**
	 * Count number of IPs in subnet, in given status
	 *
	 * @param $sStatus
	 *
	 * @return int
	 */
	public function IPCount($sStatus)
	{
		return 0;
	}

	/**
	 * Automatically get a free IP in the subnet
	 *
	 * @param $iCreationOffset
	 *
	 * @return string
	 */
	public function GetFreeIP($iCreationOffset)
	{
		return '';
	}

	/**
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	public function OnInsert()
	{
		if (class_exists('IPDiscovery'))
		{
			if ($this->Get('ipdiscovery_ping_enabled') == 'no')
			{
				$this->Set('ping_enabled', 'no');
			}
			if ($this->Get('ipdiscovery_iplookup_enabled') == 'no')
			{
				$this->Set('iplookup_enabled', 'no');
			}
			if ($this->Get('ipdiscovery_scan_enabled') == 'no')
			{
				$this->Set('scan_enabled', 'no');
			}
		}
	}

	/**
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	public function OnUpdate()
	{
		if (class_exists('IPDiscovery'))
		{
			if ($this->Get('ipdiscovery_ping_enabled') == 'no')
			{
				$this->Set('ping_enabled', 'no');
			}
			if ($this->Get('ipdiscovery_iplookup_enabled') == 'no')
			{
				$this->Set('iplookup_enabled', 'no');
			}
			if ($this->Get('ipdiscovery_scan_enabled') == 'no')
			{
				$this->Set('scan_enabled', 'no');
			}
		}
	}

	/**
	 * Change flag of attributes that shouldn't be modified beside creation.
	 *
	 * @param string $sAttCode
	 * @param array $aReasons
	 * @param string $sTargetState
	 *
	 * @return int
	 * @throws \CoreException
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		switch ($sAttCode)
		{
			case 'last_discovery_date':
			case 'ping_duration':
			case 'iplookup_duration':
			case 'scan_duration':
				return OPT_ATT_READONLY;

			default:
				break;
		}
		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}

	/**
	 * Change flag of attributes that shouldn't be modified at creation.
	 *
	 * @param string $sAttCode
	 * @param array $aReasons
	 *
	 * @return int
	 * @throws \CoreException
	 */
	public function GetInitialStateAttributeFlags($sAttCode, &$aReasons = array())
	{
		switch ($sAttCode)
		{
			case 'last_discovery_date':
			case 'ping_duration':
			case 'iplookup_duration':
			case 'scan_duration':
				return OPT_ATT_READONLY;

			default:
				break;
		}
		return parent::GetInitialStateAttributeFlags($sAttCode, $aReasons);
	}

}
