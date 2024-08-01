<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Model;

use ApplicationContext;
use CMDBObjectSet;
use Combodo\iTop\Application\UI\Base\Component\Field\FieldUIBlockFactory;
//use Combodo\iTop\Application\WebPage\WebPage;
use DBObjectSearch;
use Dict;
use IPConfig;
use IPObject;
use iTopWebPage;
use MetaModel;
use TeemIp\TeemIp\Extension\Framework\Helper\DisplayMessage;
use TeemIp\TeemIp\Extension\Framework\Helper\IPUtils;
use utils;
use WebPage;
class _IPBlock extends IPObject {
	/**
	 * Returns size of block
	 */
	public function GetSize() {
		return 1;
	}

	/**
	 * Return % of occupancy of objects linked to $this
	 *
	 * @param $sObject
	 *
	 * @return int
	 */
	public function GetOccupancy($sObject) {
		return 0;
	}

	/**
	 * Return next operation after current one
	 *
	 * @param $sOperation
	 *
	 * @return string
	 */
	public function GetNextOperation($sOperation) {
		switch ($sOperation) {
			case 'findspace':
				return 'dofindspace';
			case 'dofindspace':
				return 'findspace';

			case 'shrinkblock':
				return 'doshrinkblock';
			case 'doshrinkblock':
				return 'shrinkblock';

			case 'splitblock':
				return 'dosplitblock';
			case 'dosplitblock':
				return 'splitblock';

			case 'expandblock':
				return 'doexpandblock';
			case 'doexpandblock':
				return 'expandblock';

			case 'delegate':
				return 'dodelegate';
			case 'dodelegate':
				return 'delegate';

			default:
				return '';
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
	public function DoCheckOperation($sOperation) {
		switch ($sOperation) {
			case 'shrinkblock':
			case 'splitblock':
			case 'expandblock':
				// If block is delegated, deny operation
				if ($this->Get('parent_org_id') != 0) {
					return ('IsDelegated');
				}
				break;

			case 'delegate':
				// If block is delegated, deny re-delegation
				// If delegation can be done to children orgs only,
				// 		Check if block's org has children
				// If not
				// 		Check if another organisation exists
				if ($this->Get('parent_org_id') != 0) {
					return ('IsDelegated');
				} else {
					$iOrgId = $this->Get('org_id');
					$sDelegateToChildrenOnly = IPConfig::GetFromGlobalIPConfig('delegate_to_children_only', $iOrgId);
					if ($sDelegateToChildrenOnly == 'dtc_yes') {
						$oOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS child JOIN Organization AS parent ON child.parent_id BELOW parent.id WHERE parent.id = $iOrgId AND child.id != $iOrgId"));
						if (!$oOrgSet->CountExceeds(0)) {
							return ('NoChildOrg');
						}
					} else {
						$oOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o WHERE o.id != $iOrgId"));
						if (!$oOrgSet->CountExceeds(0)) {
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
	 * Provides attributes' parameters
	 *
	 * @param $sAttCode
	 *
	 * @return array
	 */
	public function GetAttributeParams($sAttCode) {
		$aParams = array();
		if (($sAttCode == 'occupancy') || ($sAttCode == 'children_occupancy') || ($sAttCode == 'subnet_occupancy')) {
			if ($sAttCode == 'children_occupancy') {
				$Occupancy = $this->GetOccupancy('IPBlock');
			} else {
				if ($sAttCode == 'subnet_occupancy') {
					$Occupancy = $this->GetOccupancy('IPSubnet');
				} else {
					$Occupancy = $this->GetOccupancy('IPBlock') + $this->GetOccupancy('IPSubnet');
				}
			}
			// Note: water marks for blocks are not global parameters that can be modified
			$sLowWaterMark = DEFAULT_BLOCK_LOW_WATER_MARK;
			$sHighWaterMark = DEFAULT_BLOCK_HIGH_WATER_MARK;
			if ($Occupancy >= $sHighWaterMark) {
				$sColor = RED;
			} else {
				if ($Occupancy >= $sLowWaterMark) {
					$sColor = YELLOW;
				} else {
					$sColor = GREEN;
				}
			}
			$aParams ['value'] = round($Occupancy, 0);
			$aParams ['color'] = $sColor;
		} else {
			$aParams ['value'] = 0;
			$aParams ['color'] = GREEN;
		}

		return ($aParams);
	}

	/**
	 * Remind main block attributes to user when performing resizing actions
	 *
	 * @param \iTopWebPage $oP
	 * @param $oColumn
	 *
	 * @throws \ArchivedObjectException
	 * @throws \ConfigException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 * @throws \ReflectionException
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\RuntimeError
	 * @throws \Twig\Error\SyntaxError
	 */
	protected function DisplayMainAttributesForOperationV3(iTopWebPage $oP, $oColumn) {
		$sClass = get_class($this);
		// Parent block
		$val = $this->GetClassFieldForDisplay($sClass, 'parent_id', '');
		$oColumn->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));

		// First IP
		$val = $this->GetClassFieldForDisplay($sClass, 'firstip', '');
		$oColumn->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));

		//  Last IP
		$val = $this->GetClassFieldForDisplay($sClass, 'lastip', '');
		$oColumn->AddSubBlock(FieldUIBlockFactory::MakeFromParams($val));

		parent::DisplayMainAttributesForOperationV3($oP, $oColumn);
	}

	/**
	 * Check if Block is delegated
	 */
	public function IsDelegated() {
		if ($this->Get('parent_org_id') != 0) {
			return true;
		}

		return false;
	}

	/**
	 * Delegate block
	 *
	 * @param $aParam
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	public function DoDelegate($aParam) {
		$iOrgId = $this->Get('org_id');
		$iChildOrgId = $aParam['child_org_id'];

		$this->Set('parent_org_id', $iOrgId);
		$this->Set('org_id', $iChildOrgId);
		$this->DBUpdate();
	}

	/**
	 * Undelegate block
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreCannotSaveObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 */
	public function DoUndelegate() {
		$iParentOrgId = $this->Get('parent_org_id');

		$this->Set('parent_org_id', 0);
		$this->Set('org_id', $iParentOrgId);
		$this->DBUpdate();
	}

	/**
     * @inheritdoc
     */
	public function DisplayBareRelations(WebPage $oPage, $bEditMode = false) {
		// Execute parent function first
		parent::DisplayBareRelations($oPage, $bEditMode);

        if ($this->GetDisplayMode() == static::ENUM_DISPLAY_MODE_VIEW) {
			// Add related style sheet
            if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.2', '<')) {
                $oPage->add_linked_stylesheet(utils::GetAbsoluteUrlModulesRoot().'teemip-ip-mgmt/asset/css/teemip-ip-mgmt.css');
            } else {
                $oPage->LinkStylesheetFromModule('teemip-ip-mgmt/asset/css/teemip-ip-mgmt.css');
            }

			$sClass = get_class($this);
			$iBlockId = $this->GetKey();
			$iOrgId = $this->Get('org_id');

			// Tab for child blocks
			$iChildrenFilter = intval(utils::ReadParam('children_filter', '0'));
			switch ($iChildrenFilter) {
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
			$oChildBlockSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array('block_id' => $iBlockId, 'org_id' => $iOrgId));

			if ($oChildBlockSet->CountExceeds(0)) {
				$sHtml = '<div class="teemip-space-occupation">'.$this->GetAsHTML('children_occupancy').Dict::Format('Class:IPBlock/Tab:childblock-count-percent').'</div>';

				// Then, display form to select list of hosts if domain is not in edition
				$sHtml .= '<br><div style="padding: 15px; background: #f8f9fa;">';
				$sHtml .= '<form>';
				$sHtml .= '<table>';

				$sHtml .= '<tr>';
				if ($iChildrenFilter != 0) {
					$sHtml .= '<td>';
					$sHtml .= "<label><input type=\"radio\" checked name=\"children_filter\" value=\"0\">&nbsp;".Dict::S('Class:IPBlock/Tab:childblock/SelectList0').'</label>';
					$sHtml .= '</td>';
				} else {
					$sHtml .= '<td>';
					$sHtml .= "<label><input type=\"radio\" checked name=\"children_filter\" value=\"1\">&nbsp;".Dict::S('Class:IPBlock/Tab:childblock/SelectList1').'</label>';
					$sHtml .= '</td>';
				}
				$sHtml .= '</tr>';

				$sHtml .= '</table><br>';

				$sHtml .= "<input type=\"hidden\" name=\"class\" value=\"$sClass\">\n";
				$sHtml .= "<input type=\"hidden\" name=\"id\" value=\"$iBlockId\">\n";
				$sHtml .= '<input type="hidden" name="operation" value="details">';
				$sHtml .= '<input type="hidden" name="transaction_id" value=\""'.utils::GetNewTransactionId().'"\">';
				$oAppContext = new ApplicationContext();
				$sHtml .= $oAppContext->GetForForm();
				$sHtml .= "<input type=\"submit\" value=\"".Dict::S('Class:IPBlock/Tab:childblock/SelectList')."\">\n";

				$sHtml .= '</form>';
				$sHtml .= '</div><br>';
			} else {
				$sHtml = '';
			}

			$sName = Dict::Format('Class:IPBlock/Tab:childblock');
			IPUtils::DisplayTabContent($oPage, $sName, 'children_occupancy', $sClass, $sTitle, $sHtml, $oChildBlockSet, false);
		}
	}

	/**
	 * Displays all space (used and non used within block)
	 *
	 * @param \iTopWebPage $oP
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function DisplayAllSpace(iTopWebPage $oP) {
		$this->DisplayBareTab($oP, 'UI:IPManagement:Action:ListSpace:');
		$sHtml = $this->GetAllSpace($oP);
		$oP->add($sHtml);
	}

	/**
	 * Get all space (used and non used within block)
	 *
	 * @param \WebPage $oP
	 *
	 * @return string
	 */
	protected function GetAllSpace(WebPage $oP) {
		return '';
	}

	/**
	 * Check if space can be searched
	 *
	 * @param $aParam
	 *
	 * @return string
	 */
	public function DoCheckToDisplayAvailableSpace($aParam) {
		return '';
	}

	/**
	 * Displays available space
	 *
	 * @param \iTopWebPage $oP
	 * @param $iChangeId
	 * @param $aParameter
	 *
	 * @throws \ApplicationException
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	public function DoDisplayAvailableSpace(iTopWebPage $oP, $iChangeId, $aParameter) {
		list($sMessage, $sHtml) = $this->GetAvailableSpace($oP, $iChangeId, $aParameter);
		if ($sMessage != '') {
			DisplayMessage::Info($oP, $sMessage);
		}
		$this->DisplayBareTab($oP, 'UI:IPManagement:Action:DoFindSpace:');
		$oP->add($sHtml);
	}

	/**
	 * Get available space
	 *
	 * @param \WebPage $oP
	 * @param $iChangeId
	 * @param $aParameter
	 *
	 * @return array
	 */
	public function GetAvailableSpace(WebPage $oP, $iChangeId, $aParameter) {
		return array();
	}

	/**
	 * @inheritdoc
	 */
	public function GetInitialStateAttributeFlags($sAttCode, &$aReasons = array()) {
		$sFlagsFromParent = parent::GetInitialStateAttributeFlags($sAttCode, $aReasons);
		$aHiddenAndReadOnlyAttributes = array('parent_org_id');

		if (in_array($sAttCode, $aHiddenAndReadOnlyAttributes)) {
			if ($this->Get('origin') == 'lir') {
				// If block origin is LIR at creation, it implies that delegation is in progress from a RIR block.
				return (OPT_ATT_NORMAL | $sFlagsFromParent);
			}

			return (OPT_ATT_HIDDEN | OPT_ATT_READONLY | $sFlagsFromParent);
		}

		return $sFlagsFromParent;
	}

	/**
	 * @inheritdoc
	 */
	public function GetAttributeFlags($sAttCode, &$aReasons = array(), $sTargetState = '') {
		$sFlagsFromParent = parent::GetAttributeFlags($sAttCode, $aReasons, $sTargetState);
		$aReadOnlyAttributes = array('org_id', 'parent_org_id', 'parent_id', 'occupancy', 'children;_occupancy', 'subnet_occupancy');

		if (in_array($sAttCode, $aReadOnlyAttributes)) {
			return (OPT_ATT_READONLY | $sFlagsFromParent);
		}

		return $sFlagsFromParent;
	}

	/**
	 * @inheritdoc
	 */
	public static function GetShortcutActions($sFinalClass)
	{
		// Prepend the shortcut actions with the navigation menu
		$aNavigationActions = ['previous_ipblock', 'next_ipblock'];
		$aConfiguredActions = parent::GetShortcutActions($sFinalClass);
		$aShortcutActions = array_merge($aNavigationActions, $aConfiguredActions);

		return $aShortcutActions;
	}

	/**
	 * Get the previous Block if it exists
	 *
	 * @param bool $bInBlock if lookup should be done in parent block onl
	 *
	 * @return null
	 */
	public function GetPreviousBlock($bInBlock)
	{
		return null;
	}

	/**
	 * Get the next Block if it exists
	 *
	 * @param bool $bInBlock if lookup should be done in parent block only
	 *
	 * @return null
	 */
	public function GetNextBlock($bInBlock)
	{
		return null;
	}

}
