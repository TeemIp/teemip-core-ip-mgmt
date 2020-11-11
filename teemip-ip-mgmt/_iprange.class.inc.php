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

class _IPRange extends IPObject
{
	/**
	 * Returns size of range
	 *
	 * @return int
	 */
	public function GetSize()
	{
		return 1;
	}

	/**
	 * Check if operation is feasible on current object
	 *
	 * @param $sOperation
	 *
	 * @return string
	 */
	function DoCheckOperation($sOperation)
	{
		switch ($sOperation)
		{
			case 'listips':
			case 'csvexportips':
				return ('');

			default:
				return ('OperationNotAllowed');
		}
	}

	/**
	 * Return next operation after current one
	 *
	 * @param $sOperation
	 *
	 * @return string
	 */
	function GetNextOperation($sOperation)
	{
		switch ($sOperation)
		{
			case 'listips':
				return 'dolistips';
			case 'dolistips':
				return 'listips';

			case 'csvexportips':
				return 'docsvexportips';
			case 'docsvexportips':
				return 'csvexportips';

			default:
				return '';
		}
	}

	/**
	 * Change flag of attributes that shouldn't be modified beside creation.
	 *
	 * @param $sAttCode
	 * @param array $aReasons
	 * @param string $sTargetState
	 *
	 * @return int
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		if ((!$this->IsNew()) && (($sAttCode == 'org_id') || ($sAttCode == 'occupancy')))
		{
			return OPT_ATT_READONLY;
		}

		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}

	/**
	 * Get parameters used for operation
	 *
	 * @param $sOperation
	 *
	 * @return array
	 */
	function GetPostedParam($sOperation)
	{
		$aParam = array();
		switch ($sOperation)
		{
			case 'dolistips':
				$aParam['first_ip'] = filter_var(utils::ReadPostedParam('attr_firstip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['last_ip'] = filter_var(utils::ReadPostedParam('attr_lastip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['status_ip'] = $this->GetDefaultValueAttribute('status');
				$aParam['short_name'] = '';
				$aParam['domain_id'] = '';
				$aParam['usage_id'] = '';
				$aParam['requestor_id'] = '';
				break;

			case 'docsvexportips':
				$aParam['first_ip'] = filter_var(utils::ReadPostedParam('attr_firstip', '', 'raw_data'), FILTER_VALIDATE_IP);
				$aParam['last_ip'] = filter_var(utils::ReadPostedParam('attr_lastip', '', 'raw_data'), FILTER_VALIDATE_IP);
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
	 * @return array
	 */
	public function GetAttributeParams($sAttCode)
	{
		$aParams = array();
		if ($sAttCode == 'occupancy')
		{
			$Occupancy = $this->GetOccupancy('');
			$sOrgId = $this->Get('org_id');
			if ($sOrgId != null)
			{
				$sLowWaterMark = IPConfig::GetFromGlobalIPConfig('iprange_low_watermark', $sOrgId);
				$sHighWaterMark = IPConfig::GetFromGlobalIPConfig('iprange_high_watermark', $sOrgId);
				if ($Occupancy >= $sHighWaterMark)
				{
					$sColor = RED;
				}
				else
				{
					if ($Occupancy >= $sLowWaterMark)
					{
						$sColor = YELLOW;
					}
					else
					{
						$sColor = GREEN;
					}
				}
				$aParams ['value'] = round($Occupancy, 0);
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
	 * Automatically get a free IP in the range
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
	 * Computes and display specific tabs
	 *
	 * @param \WebPage $oPage
	 * @param bool $bEditMode
	 *
	 */
	public function DisplayBareRelations(WebPage $oPage, $bEditMode = false)
	{
		// Execute parent function first
		parent::DisplayBareRelations($oPage, $bEditMode);

		if ($this->Get('dhcp') == 'dhcp_no')
		{
			$oServersSet = $this->Get('servers_list');
			if ($oServersSet->Count() == 0)
			{
				// Remove tab related to DHCP servers
				//  Two following lines to be reactivated once FindTab is corrected
				//      $sPattern = '/^'.Dict::S('Class:IPRange/Attribute:servers_list').'/';
				//      $sTabName = $oPage->FindTab($sPattern);
				$sTabName = 'Class:'.get_class($this).'/Attribute:servers_list';
				$oPage->RemoveTab($sTabName);
			}
		}
	}

	/**
	 * Check coherency of model before saving object
	 */
	public function DoCheckToWrite()
	{
		parent::DoCheckToWrite();

		// Make sure no server is set in servers_list if range is not a DHCP one
		if ($this->Get('dhcp') == 'dhcp_no')
		{
			$oServersSet = $this->Get('servers_list');
			if ($oServersSet->Count() > 0)
			{
				$this->m_aCheckIssues[] = Dict::Format('UI:IPManagement:Action:Update:IPRange:NonDHCPRangeWithServers');
			}

		}
	}

}