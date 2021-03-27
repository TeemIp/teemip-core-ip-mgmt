<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Model;

use ApplicationContext;
use CMDBObjectSet;
use DBObjectSearch;
use Dict;
use DisplayBlock;
use IPConfig;
use IPObject;
use MetaModel;
use utils;
use WebPage;

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
	 * Displays the tabs listing the child blocks and the subnets belonging to a block
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
			$sClass = get_class($this);
			$iBlockId = $this->GetKey();
			$iOrgId = $this->Get('org_id');

			$aExtraParams = array();
			$aExtraParams['menu'] = false;

			// Tab for child blocks
			$iChildrenFilter = intval(utils::ReadParam('children_filter', '0'));
			switch ($iChildrenFilter)
			{
				case 1:
					// All children and grand children
					$sOQL = "SELECT $sClass AS b JOIN $sClass AS root ON b.parent_id BELOW STRICT root.id WHERE root.id = :block_id AND (b.org_id = :org_id OR b.parent_org_id = :org_id)";
					$sTitle = Dict::Format('Class:IPBlock/Tab:childblock/List1');
					break;

				case 0:
				default:
					// Direct children only
					$iChildrenFilter = 0;
					$sOQL = "SELECT $sClass AS b WHERE b.parent_id = :block_id AND (b.org_id = :org_id OR b.parent_org_id = :org_id)";
					$sTitle = Dict::Format('Class:IPBlock/Tab:childblock/List0');
					break;
			}
			$oChildBlockSet =  new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('block_id' => $iBlockId, 'org_id' => $iOrgId));
			// Open tab first
			if ($oChildBlockSet->CountExceeds(0))
			{
				$oP->SetCurrentTab(Dict::Format('Class:IPBlock/Tab:childblock').' ('.$oChildBlockSet->Count().')');
				$oP->p(MetaModel::GetClassIcon($sClass).'&nbsp;'.$sTitle);
				$oP->p($this->GetAsHTML('children_occupancy').Dict::Format('Class:IPBlock/Tab:childblock-count-percent'));

				// Then, display form to select list of hosts if domain is not in edition
				$oP->add('<div style="padding: 15px; background: #ddd;">');
				$oP->add("<form>");
				$oP->add("<table border=0>");

				$oP->add("<tr>");
				if ($iChildrenFilter != 0)
				{
					$oP->add("<td>");
					$oP->add("<label><input type=\"radio\" checked name=\"children_filter\" value=\"0\">".Dict::S('Class:IPBlock/Tab:childblock/SelectList0').'</label>');
					$oP->add("</td>");
				}
				else
				{
					$oP->add("<td>");
					$oP->add("<label><input type=\"radio\" checked name=\"children_filter\" value=\"1\">".Dict::S('Class:IPBlock/Tab:childblock/SelectList1').'</label>');
					$oP->add("</td>");
				}
				$oP->add("</tr>\n");

				$oP->add("</table><br>\n");

				$oP->add("<input type=\"hidden\" name=\"class\" value=\"$sClass\">\n");
				$oP->add("<input type=\"hidden\" name=\"id\" value=\"$iBlockId\">\n");
				$oP->add("<input type=\"hidden\" name=\"operation\" value=\"details\">\n");
				$oP->add("<input type=\"hidden\" name=\"transaction_id\" value=\"".utils::GetNewTransactionId()."\">\n");
				$oAppContext = new ApplicationContext();
				$oP->add($oAppContext->GetForForm());
				$oP->add("<input type=\"submit\" value=\"".Dict::S('Class:IPBlock/Tab:childblock/SelectList')."\">\n");

				$oP->add("</form>\n");
				$oP->add('</div>');

				// Display list of hosts if not empty
				$oBlock = new DisplayBlock($oChildBlockSet->GetFilter(), 'list', false);
				$oBlock->Display($oP, 'child_blocks', array('menu' => false));
			}
			else
			{
				$oP->SetCurrentTab(Dict::S('Class:IPBlock/Tab:childblock'));
				$oP->p(MetaModel::GetClassIcon($sClass).'&nbsp;'.Dict::S('UI:NoObjectToDisplay'));
				$oP->p(Dict::S('UI:NoObjectToDisplay'));
			}
		}
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
