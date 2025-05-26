<?php
/*
 * @copyright   Copyright (C) 2010-2025 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Framework\Helper;

use ApplicationContext;
use CMDBObjectSet;
use Combodo\iTop\Application\UI\Base\Component\Html\HtmlFactory;
use Combodo\iTop\Application\UI\Base\Component\Panel\PanelUIBlockFactory;
use DBObjectSearch;
use Dict;
use iTopWebPage;
use MenuBlock;
use MetaModel;
use utils;

/**
 * Displays TeemIp's hierarchical objects in tree mode
 */
class DisplayTree
{

	/**
	 * Display tree
	 *
	 * @param \iTopWebPage $oP
	 * @param $oAppContext
	 * @param $sClass
	 *
	 * @throws \ApplicationException
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \DictExceptionMissingString
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 * @throws \ReflectionException
	 */
	static public function Display($oP, $oAppContext, $sClass, $sDelegatedNodesRendering = 'folded'): void
	{
		// Get number of records
		$iCurrentOrganization = $oAppContext->GetCurrentValue('org_id');
		if ($iCurrentOrganization == '') {
			$oSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT $sClass"));
		} else {
			$oSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT $sClass AS c WHERE c.org_id = :org_id"), array(), array('org_id' => $iCurrentOrganization));
		}
		$iSetCount = $oSet->Count();

		// Display block
		$sHeaderTitle = Dict::Format('UI:IPManagement:Action:DisplayTree:'.$sClass.':PageTitle_Class');
		$oP->SetBreadCrumbEntry($sHeaderTitle, $sHeaderTitle, '', '', 'fas fa-sitemap', iTopWebPage::ENUM_BREADCRUMB_ENTRY_ICON_TYPE_CSS_CLASSES);
		$sTitle = Dict::Format('UI:IPManagement:Action:DisplayTree:'.$sClass.':Title_Class', MetaModel::GetName($sClass));
		$oP->set_title($sHeaderTitle);

		$sListId = 'displaytree_menu';
		$aExtraParams['selection_mode'] = false;
		$oMenuBlock = new MenuBlock($oSet->GetFilter(), 'list');
		$oBlockMenu = $oMenuBlock->GetRenderContent($oP, $aExtraParams, $sListId);

		$oPanel = PanelUIBlockFactory::MakeForClass($sClass, $sTitle);
		$oPanel->SetSubTitle(Dict::Format("UI:Pagination:HeaderNoSelection", $iSetCount));
		$oPanel->AddToolbarBlock($oBlockMenu);
		$oP->AddUiBlock($oPanel);

        // Prepare context to switch display order and display button
        $sUrl = utils::GetAbsoluteUrlModulePage('teemip-ip-mgmt', 'ui.teemip-ip-mgmt.php');
        $sHtml = "<form method=\"post\" action=\"".$sUrl."\">";
        $sHtml .= "<input type=\"hidden\" name=\"class\" value=\"$sClass\">";
        $sHtml .= "<input type=\"hidden\" name=\"operation\" value=\"displaytree\">";
        $sHtml .= "<input type=\"hidden\" name=\"transaction_id\" value=\"".utils::GetNewTransactionId()."\">";
        $sNewDelegatedNodesRendering = ($sDelegatedNodesRendering == 'folded') ? 'unfolded' : 'folded';
        $sHtml .= "<input type=\"hidden\" name=\"delegated_nodes_rendering\" value=\"$sNewDelegatedNodesRendering\">";
        $oAppContext = new ApplicationContext();
        $sHtml .= $oAppContext->GetForForm();
        $sButton = "<button type=\"submit\" class=\"action\"><span>".Dict::S('UI:Action:DisplayTree:DelegatedItems:'.$sNewDelegatedNodesRendering)."</span></button>";
        $sHtml .= $sButton."<br><br>";
        $sHtml .= "</form>";

		$oPanel->AddSubBlock(HtmlFactory::MakeParagraph(''))
            ->AddHtml($sHtml)
			->AddHtml(self::GetTree($sClass, $iCurrentOrganization, $sDelegatedNodesRendering));

		$oP->add_ready_script("\$('#tree ul').treeview();");
        $oP->LinkStylesheetFromModule('teemip-framework/asset/css/teemip-display-tree.css');

	}

	static private function GetTree($sClass, $iOrganization, $sDelegatedNodesRendering): string
	{
		$sHtml = '<table style="width:100%"><tr><td colspan="2">';
		$sHtml .= '<div style="vertical-align:top;" id="tree">';
		if ($iOrganization == '') {
			$oSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization"));
			while ($oOrg = $oSet->Fetch()) {
				$sHtml .= '<h2>'.Dict::Format('UI:IPManagement:Action:DisplayTree:'.$sClass.':OrgName', $oOrg->Get('name')).'</h2>';
				$sHtml .= DisplayTree::DeployTree($oOrg->GetKey(), $sClass, $sDelegatedNodesRendering);
				$sHtml .= '<br>';
			}
		} else {
			$oOrg = MetaModel::GetObject('Organization', $iOrganization, false /* MustBeFound */);
			$sHtml .= '<h2>'.Dict::Format('UI:IPManagement:Action:DisplayTree:'.$sClass.':OrgName', $oOrg->Get('name')).'</h2>';
			$sHtml .= DisplayTree::DeployTree($iOrganization, $sClass, $sDelegatedNodesRendering);
		}
		$sHtml .= '</td></tr></table>';
		$sHtml .= '</div></div>';

		return $sHtml;
	}

	/**
	 * Deploy tree
	 *
	 * @param $iOrgId
	 * @param $sClass
	 *
	 * @return string
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	static private function DeployTree($iOrgId, $sClass, $sDelegatedNodesRendering): string
	{
		switch ($sClass) {
			case 'IPv4Subnet':
				return DisplayTree::GetNode($iOrgId, 'IPv4Block', 0, 'IPv4Subnet', $sDelegatedNodesRendering);

			case 'IPv6Subnet':
				return DisplayTree::GetNode($iOrgId, 'IPv6Block', 0, 'IPv6Subnet', $sDelegatedNodesRendering);

			default:
				return DisplayTree::GetNode($iOrgId, $sClass, 0, '', $sDelegatedNodesRendering);
		}
	}

	/**
	 * Display the node of a hierarchical tree
	 *
	 * @param $iOrgId
	 * @param $sContainerClass
	 * @param $iContainerId
	 * @param $sLeafClass
	 *
	 * @return string
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MySQLException
	 * @throws \OQLException
	 */
	static private function GetNode($iOrgId, $sContainerClass, $iContainerId, $sLeafClass, $sDelegatedNodesRendering): string
	{
		// Get list of Containers contained within current container defined by key $iContainerId
		//    . Blocks that belong to organization
		$sOQL = "SELECT $sContainerClass AS cc WHERE cc.org_id = :org_id AND cc.parent_id = :parent_id";
		//    . Add blocks that are delegated to
		$sOQL .= " UNION ";
        $sOQL .= "SELECT $sContainerClass AS cc WHERE cc.parent_org_id = :org_id AND cc.parent_id = :parent_id";
		//    . Add blocks that are delegated from - this should only work for level 0 where container_id is null
		$sOQL .= " UNION ";
		$sOQL .= "SELECT $sContainerClass AS cc WHERE cc.org_id = :org_id AND cc.parent_org_id != 0 AND :container_id = 0";
		$oChildContainerSet = new CMDBObjectSet(DBObjectSearch::FromOQL($sOQL), array(), array(
			'org_id' => $iOrgId,
			'parent_id' => $iContainerId,
			'container_id' => $iContainerId,
		));

		$aNodes = array();
		while ($oChildContainer = $oChildContainerSet->Fetch()) {
			$iKey = $oChildContainer->GetIndexForTree();
			$aNodes[$iKey] = $oChildContainer;
		}

		// Get list of leaves contained within current container, if any
		if ($sLeafClass != '') {
			$oLeafSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT $sLeafClass AS lc WHERE lc.block_id = :block_id"), array(), array('block_id' => $iContainerId));
			while ($oLeaf = $oLeafSet->Fetch()) {
				$iKey = $oLeaf->GetIndexForTree();
				$aNodes[$iKey] = $oLeaf;
			}
		}

		// Display Node
		ksort($aNodes);
		$bWithIcon = ($sLeafClass != '') ? true : false;
		$sHtml = '<ul>';
		foreach ($aNodes as $oObject) {
			$sHtml .= '<li>';
			/** @var $oObject \TeemIp\TeemIp\Extension\Framework\Helper\iTree */
			/** @var $oObject \cmdbAbstractObject */
			$sHtml .= $oObject->GetAsLeaf($bWithIcon, $iOrgId);
			if (get_class($oObject) == $sContainerClass) {
                if (($sDelegatedNodesRendering == 'unfolded') && ($iOrgId != $oObject->Get('org_id'))) {
                    $iCurrentOrg = $oObject->Get('org_id');
                } else {
                    $iCurrentOrg = $iOrgId;
                }
                $sHtml .= DisplayTree::GetNode($iCurrentOrg, $sContainerClass, $oObject->GetKey(), $sLeafClass, $sDelegatedNodesRendering);
			}
			$sHtml .= '</li>';
		}
		$sHtml .= '</ul>';

		return $sHtml;
	}


}