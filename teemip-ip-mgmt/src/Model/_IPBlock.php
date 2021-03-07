<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Model;

use CMDBObjectSet;
use DBObjectSearch;
use IPConfig;
use IPObject;

class _IPBlock extends IPObject
{
	/**
	 * Returns size of block
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
	function GetNextOperation($sOperation)
	{
		switch ($sOperation)
		{
			case 'findspace': return 'dofindspace';
			case 'dofindspace': return 'findspace';
			
			case 'shrinkblock': return 'doshrinkblock';
			case 'doshrinkblock': return 'shrinkblock';
				
			case 'splitblock': return 'dosplitblock';
			case 'dosplitblock': return 'splitblock';
				
			case 'expandblock': return 'doexpandblock';
			case 'doexpandblock': return 'expandblock';
			
			case 'delegate': return 'dodelegate';
			case 'dodelegate': return 'delegate';
			
			default: return '';
		}
	}

	/**
	 * Check if operation is feasible on current object
	 *
	 * @param $sOperation
	 *
	 * @return string
	 * @throws \CoreException
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	function DoCheckOperation($sOperation)
	{
		switch($sOperation)
		{
			case 'shrinkblock':
			case 'splitblock':
			case 'expandblock':
				// If block is delegated, deny operation
				if ($this->Get('parent_org_id') != 0)
				{
					return ('IsDelegated');
				} 
				break;

			case 'delegate':
				// If block is delegated, deny re-delegation
				// If delegation can be done to children orgs only,
				// 		Check if block's org has children
				// If not
				// 		Check if another organisation exists
				if ($this->Get('parent_org_id') != 0)
				{
					return ('IsDelegated');
				}
				else
				{
					$iOrgId = $this->Get('org_id');
					$sDelegateToChildrenOnly = IPConfig::GetFromGlobalIPConfig('delegate_to_children_only', $iOrgId);
					if ($sDelegateToChildrenOnly == 'dtc_yes')
					{
						$oOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS child JOIN Organization AS parent ON child.parent_id BELOW parent.id WHERE parent.id = $iOrgId AND child.id != $iOrgId"));
						if (!$oOrgSet->CountExceeds(0))
						{
							return ('NoChildOrg');
						}
					}
					else
					{
						$oOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o WHERE o.id != $iOrgId"));
						if (!$oOrgSet->CountExceeds(0))
						{
							return ('NoOtherOrg');
						}
					}
				}					
				break;

			case 'undelegate':
			case 'listspace':
			case 'findspace':
				break;

			default:
				return ('OperationNotAllowed');
		}
		return '';
	}
	
	/**
	 * Define scale / limit of operation that can be applied to a block
	 */
	function GetScaleOfOperation()
	{
		return 0;
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
		if (($sAttCode == 'occupancy') || ($sAttCode == 'children_occupancy') || ($sAttCode == 'subnet_occupancy')) 
		{
			if ($sAttCode == 'children_occupancy')
			{
				$Occupancy = $this->GetOccupancy('IPBlock');
			}
			else if ($sAttCode == 'subnet_occupancy')
			{
				$Occupancy = $this->GetOccupancy('IPSubnet');
			}
			else
			{
				$Occupancy = $this->GetOccupancy('IPBlock') + $this->GetOccupancy('IPSubnet');
			}
			// Note: water marks for blocks are not global parameters that can be modified
			$sLowWaterMark = DEFAULT_BLOCK_LOW_WATER_MARK;
			$sHighWaterMark = DEFAULT_BLOCK_HIGH_WATER_MARK;
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
		return ($aParams);
	}

	/**
	 * Check if Block is delegated
	 */		 
	public function IsDelegated()
	{
		if ($this->Get('parent_org_id') != 0)
		{
			return true;
		}
		return false;
	}

	/**
	 * Delegate block
	 *
	 * @param $aParam
	 */
	public function DoDelegate($aParam)
	{
		$iOrgId = $this->Get('org_id');
		$iChildOrgId = $aParam['child_org_id'];

		$this->Set('parent_org_id', $iOrgId);
		$this->Set('org_id', $iChildOrgId);
		$this->DBUpdate();
	}

	/*
	 * Undelegate block
	 *
	 * @param $aParam
	 */
	public function DoUndelegate()
	{
		$iParentOrgId = $this->Get('parent_org_id');

		$this->Set('parent_org_id', 0);
		$this->Set('org_id', $iParentOrgId);
		$this->DBUpdate();
	}

	/**
	 * Change default flag of attribute at creation
	 *
	 * @param $sAttCode
	 * @param array $aReasons
	 *
	 * @return bool
	 */
	public function GetInitialStateAttributeFlags($sAttCode, &$aReasons = array())
	{
		$aHiddenAndReadOnlyAttributes = array('parent_org_id');
		if (in_array($sAttCode, $aHiddenAndReadOnlyAttributes))
		{
			if ($this->Get('origin') == 'lir')
			{
				// If block origin is LIR at creation, it implies that delegation is in progress from a RIR block.
				return OPT_ATT_NORMAL;
			}
			return OPT_ATT_HIDDEN || OPT_ATT_READONLY;
		}
		return parent::GetInitialStateAttributeFlags($sAttCode, $aReasons);
	}

	/**
	 * Change default flag of attribute
	 *
	 * @param $sAttCode
	 * @param array $aReasons
	 * @param string $sTargetState
	 *
	 * @return int
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '')
	{
		$aReadOnlyAttributes = array('org_id', 'parent_org_id', 'parent_id', 'occupancy', 'children_occupancy', 'subnet_occupancy');
		if (in_array($sAttCode, $aReadOnlyAttributes))
		{
			return OPT_ATT_READONLY;
		}
		return parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
	}

}
