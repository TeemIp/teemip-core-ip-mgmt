<?php
// Copyright (C) 2021 TeemIp
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
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

class FindSpace extends cmdbAbstractObject
{
	/**
	 * Get parameters related to find space operations

	 * @param $sOperation
	 *
	 * @return array
	 */
	static public function GetPostedParam($sOperation)
	{
		$aParam = array();
		switch ($sOperation)
		{
			case 'dofindspace':
				$aParam['block_id'] = utils::ReadPostedParam('block_id', '', 'raw_data');
				$aParam['ip'] = utils::ReadPostedParam('attr_ip', '', 'raw_data');
				$aParam['spacesize'] = utils::ReadPostedParam('spacesize', '', 'raw_data');
				$aParam['maxoffer'] = utils::ReadPostedParam('maxoffer', '', 'raw_data');
				$aParam['status_subnet'] = '';
				$aParam['type'] = '';
				$aParam['location_id'] = 0;
				$aParam['requestor_id'] = 0;

			case 'findspace':
				$aParam['org_id'] = utils::ReadPostedParam('org_id', '', 'raw_data');
				$aParam['spacetype'] = utils::ReadPostedParam('spacetype', '', 'raw_data');
				break;

			default:
				break;
		}
		return $aParam;
	}

	/**
	 * Define parameters that will be used for lookup
	 *  1. Ask to select organization and space type
	 *
	 * @param \WebPage $oP
	 * @param $oAppContext
	 * @param $aDefault
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	static public function DisplayOperationForm(WebPage $oP, $oAppContext, $aDefault)
	{
		if (empty($aDefault['spacetype']))
		{
			FindSpace::FindSpaceProcessStep1($oP, $oAppContext);
		}
		else
		{
			FindSpace::FindSpaceProcessStep2($oP, $oAppContext, $aDefault);
		}
	}

	/**
	 * First step of Find Space process: select organization and space type
	 *
	 * @param \WebPage $oP
	 * @param $oAppContext
	 *
	 * @throws \CoreException
	 */
	static private function FindSpaceProcessStep1(WebPage $oP, $oAppContext)
	{
		// Set page titles
		$sClassIcon = MetaModel::GetClassIcon('IPv4Block');
		$sHeaderTitle = Dict::S('UI:IPManagement:Action:FindSpace');
		$oP->set_title($sHeaderTitle);
		$oP->add(<<<HTML
			<!-- Display title -->
			<div class="page_header teemip_page_header">
				<h1>$sClassIcon $sHeaderTitle</h1>
			</div>
			<!-- Beginning of wizContainer -->
			<div class="wizContainer">
HTML
		);

		// Display form's attributes
		$iFormId = rand();
		$iTransactionId = utils::GetNewTransactionId();
		$oP->SetTransactionId($iTransactionId);
		$sFormAction = utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/ui.teemip-ip-mgmt.php";
		$oP->add("<form action=\"$sFormAction\" id=\"form_{$iFormId}\" enctype=\"multipart/form-data\" method=\"post\" onSubmit=\"return OnSubmit('form_{$iFormId}');\">\n");
		$oP->add_ready_script("$(window).unload(function() { OnUnload('$iTransactionId') } );\n");

		$oP->add("<table>");
		$oP->add('<tr><td style="vertical-align:top">');

		$aDetails = array();

		// Select organization
		$sLabelOfAction = Dict::S('UI:IPManagement:Action:FindSpace:Organization');
		$oContact = UserRights::GetContactObject();
		$iUserOrg = $oContact->Get('org_id');
		$oOrgSet = new CMDBObjectSet(DBObjectSearch::FromOQL("SELECT Organization AS o"));
		$sInputId = $iFormId.'_org_id';
		$sHTMLValue = "<select id=\"$sInputId\" name=\"org_id\">\n";
		while ($oOrg = $oOrgSet->Fetch())
		{
			$iOrgKey = $oOrg->GetKey();
			$sOrgName = $oOrg->GetName();
			if ($iOrgKey == $iUserOrg)
			{
				$sHTMLValue .= "<option selected='' value=\"$iOrgKey\">".$sOrgName."</option>\n";
			}
			else
			{
				$sHTMLValue .= "<option value=\"$iOrgKey\">".$sOrgName."</option>\n";
			}
		}
		$sHTMLValue .= "</select>";
		$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction.'</span>', 'value' => $sHTMLValue);

		// Select IP space type
		$sLabelOfAction = Dict::S('UI:IPManagement:Action:FindSpace:SpaceType');
		$sInputId = $iFormId.'_spacetype';
		$sHTMLValue = '<select id='.$sInputId.' name=spacetype>';
		$sHTMLValue .= '<option value="ipv4space">'.Dict::S('UI:IPManagement:Action:FindSpace:IPv4Space').'</option>';
		$sHTMLValue .= '<option value="ipv6space">'.Dict::S('UI:IPManagement:Action:FindSpace:IPv6Space').'</option>';
		$sHTMLValue .= "</select>";
		$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction.'</span>', 'value' => $sHTMLValue);

		$oP->Details($aDetails);
		$oP->add('</td></tr>');

		// Apply button
		$oP->add("<tr><td><button type=\"submit\" class=\"action\"><span>".Dict::S('UI:Button:Next')."</span></button></td></tr>");
		$oP->add("</table>");

		// Load other parameters to post
		$sNextOperation = 'findspace';
		$oP->add($oAppContext->GetForForm());
		$oP->add("<input type=\"hidden\" name=\"operation\" value=\"$sNextOperation\">\n");
		$oP->add("<input type=\"hidden\" name=\"transaction_id\" value=\"$iTransactionId\">\n");

		$oP->add('</form>');
		$oP->add("</div>\n");

		$oP->add(<<<HTML
	</div><!-- End of wizContainer -->
HTML
		);
	}

	/**
	 * Second step of Find Space process: select IP, size and required number of proposal
	 *
	 * @param \WebPage $oP
	 * @param $oAppContext
	 * @param $aDefault
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \DictExceptionMissingString
	 */
	static private function FindSpaceProcessStep2(WebPage$oP, $oAppContext, $aDefault)
	{
		$sSpaceType = $aDefault['spacetype'];
		$iOrgId = $aDefault['org_id'];
		$iBlockId = (array_key_exists('block_id', $aDefault)) ? $aDefault['block_id'] : 0;
		$sBlockClass = ($sSpaceType == 'ipv4space') ? 'IPv4Block' : 'IPv6Block';
		$sAddressClass = ($sSpaceType == 'ipv4space') ? 'IPv4Address' : 'IPv6Address';

		// Set page titles
		$sClassIcon = MetaModel::GetClassIcon($sBlockClass);
		$sHeaderTitle = ($sSpaceType == 'ipv4space') ? Dict::S('UI:IPManagement:Action:FindIPv4Space') : Dict::S('UI:IPManagement:Action:FindIPv6Space');
		$oP->set_title($sHeaderTitle);
		$oP->add(<<<HTML
			<!-- Display title -->
			<div class="page_header teemip_page_header">
				<h1>$sClassIcon $sHeaderTitle</h1>
			</div>
			<!-- Beginning of wizContainer -->
			<div class="wizContainer">
HTML
		);

		// Display form's attributes
		$iFormId = rand();
		$iTransactionId = utils::GetNewTransactionId();
		$oP->SetTransactionId($iTransactionId);
		$sFormAction = utils::GetAbsoluteUrlModulesRoot()."/teemip-ip-mgmt/ui.teemip-ip-mgmt.php";
		$oP->add("<form action=\"$sFormAction\" id=\"form_{$iFormId}\" enctype=\"multipart/form-data\" method=\"post\" onSubmit=\"return OnSubmit('form_{$iFormId}');\">\n");
		$oP->add_ready_script("$(window).unload(function() { OnUnload('$iTransactionId') } );\n");

		$oP->add("<table>");
		$oP->add('<tr><td style="vertical-align:top">');

		$aDetails = array();

		// Has Block already been identified ?
		if ($iBlockId > 0)
		{
			$oBlock = MetaModel::GetObject($sBlockClass, $iBlockId);
		}

		// First IP
		$sLabelOfAction = Dict::S('UI:IPManagement:Action:FindSpace:FirstIP');
		$sAttCode = 'ip';
		$sInputId = $iFormId.'_ip';
		$oAttDef = MetaModel::GetAttributeDef($sAddressClass, 'ip');
		if (($iBlockId == 0) || is_null($oBlock))
		{
			$sHTMLValue = cmdbAbstractObject::GetFormElementForField($oP, $sAddressClass, $sAttCode, $oAttDef, '', '', $sInputId, '', 0, '');
		}
		else
		{
			$sHTMLValue = $aDefault['ip'];
			$oP->add("<input type=\"hidden\" name=\"attr_ip\" value=\"$sHTMLValue\">\n");
		}
		$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction.'</span>', 'value' => $sHTMLValue);

		// Size
		$sLabelOfAction = Dict::S('UI:IPManagement:Action:FindSpace:SpaceSize');
		$sInputId = $iFormId.'_spacesize';
		$sHTMLValue = '<select id='.$sInputId.' name=spacesize>';
		$i = (($iBlockId == 0) || is_null($oBlock)) ? 1 : $oBlock->GetMinTheoriticalBlockPrefix();
		if ($sSpaceType == 'ipv4space')
		{
			if ($i < 16) { $iDefaultMask = 16; }
			else if ($i < 24) { $iDefaultMask = 24; }
			else { $iDefaultMask = 31; }
			$InputSize = IPv4Subnet::MaskToSize(IPv4Subnet::BitToMask($i)); // Corrects pb with some 64bits OS - Centos...
			while ($i <= 32)
			{
				if ($i == $iDefaultMask)
				{
					$sHTMLValue .= "<option selected='' value=\"$InputSize\">".IPv4Subnet::BitToMask($i)." /$i</option>\n";
				}
				else
				{
					$sHTMLValue .= "<option value=\"$InputSize\">".IPv4Subnet::BitToMask($i)." /$i</option>\n";
				}
				$InputSize /= 2;
				$i++;
			}
		}
		else
		{
			while ($i <= 128)
			{
				if ($i == IPV6_SUBNET_MAX_PREFIX)
				{
					$sHTMLValue .= "<option selected='' value=\"$i\"> /$i</option>\n";
				}
				else
				{
					$sHTMLValue .= "<option value=\"$i\"> /$i</option>\n";
				}
				$i++;
			}
		}
		$sHTMLValue .= "</select>";
		$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction.'</span>', 'value' => $sHTMLValue);

		// Max number of offers
		$sLabelOfAction = Dict::S('UI:IPManagement:Action:FindSpace:MaxNumberOfOffers');
		$sInputId = $iFormId.'_maxoffer';
		$sHTMLValue = '<input id='.$sInputId.' type=text value='.DEFAULT_MAX_FREE_SPACE_OFFERS.' name=maxoffer maxlength=2 size=2>';
		$aDetails[] = array('label' => '<span title="">'.$sLabelOfAction.'</span>', 'value' => $sHTMLValue);

		$oP->Details($aDetails);
		$oP->add('</td></tr>');

		// Apply button
		$oP->add("<tr><td><button type=\"submit\" class=\"action\"><span>".Dict::S('UI:Button:Apply')."</span></button></td></tr>");

		$oP->add("</table>");

		// Load other parameters to post
		$sNextOperation = 'dofindspace';
		$oP->add($oAppContext->GetForForm());
		$oP->add("<input type=\"hidden\" name=\"org_id\" value=\"$iOrgId\">\n");
		$oP->add("<input type=\"hidden\" name=\"spacetype\" value=\"$sSpaceType\">\n");
		$oP->add("<input type=\"hidden\" name=\"operation\" value=\"$sNextOperation\">\n");
		$oP->add("<input type=\"hidden\" name=\"transaction_id\" value=\"$iTransactionId\">\n");

		$oP->add('</form>');
		$oP->add("</div>\n");

		$oP->add(<<<HTML
	</div><!-- End of wizContainer -->
HTML
		);
	}

	/**
	 * Check if space can be searched
	 *
	 * @param $aParameter
	 *
	 * @return array
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	static public function DoCheckToDisplayAvailableSpace($aParameter)
	{
		$sClass = ($aParameter['spacetype'] == 'ipv4space') ? 'IPv4Block' : 'IPv6Block';
		$iOrgId = $aParameter['org_id'];
		$sIp = $aParameter['ip'];

		$sIssueDesc = '';
		if ($sClass == 'IPv4Block')
		{
			$iMinBlockId = IPv4Block::GetSmallerBlockContainingIp($iOrgId,$sIp);
		}
		else
		{
			$iMinBlockId = IPv6Block::GetSmallerBlockContainingIp($iOrgId,$sIp);
		}
		if ($iMinBlockId != 0)
		{
			$oBlock = MetaModel::GetObject($sClass, $iMinBlockId);
			if ($sClass == 'IPv4Block')
			{
				$iBlockSize = $oBlock->GetSize();
				if ($aParameter['spacesize'] >= $iBlockSize)
				{
					// IP belongs to a block which size is smaller than the requested available space
					$sIssueDesc = Dict::Format('UI:IPManagement:Action:DoFindSpace:IPBlock:RequestedSpaceBiggerThanBlockSize', $oBlock->GetName());
				}
			}
			else
			{
				$iBlockPrefix = $oBlock->GetMinTheoriticalBlockPrefix();
				if ($aParameter['spacesize'] <= $iBlockPrefix)
				{
					// IP belongs to a block which size is smaller than the requested available space
					$sIssueDesc = Dict::Format('UI:IPManagement:Action:DoFindSpace:IPBlock:RequestedSpaceBiggerThanBlockSize', $oBlock->GetName());
				}
			}
		}
		return array($sIssueDesc, $iMinBlockId);
	}

	/**
	 * @param \WebPage $oP
	 * @param $aParameter
	 *
	 * @throws \ArchivedObjectException
	 * @throws \CoreException
	 * @throws \CoreUnexpectedValue
	 * @throws \MissingQueryArgument
	 * @throws \MySQLException
	 * @throws \MySQLHasGoneAwayException
	 * @throws \OQLException
	 */
	static public function DoDisplayAvailableSpace(WebPage $oP, $aParameter)
	{
		$sClass = ($aParameter['spacetype'] == 'ipv4space') ? 'IPv4Block' : 'IPv6Block';
		$iOrgId = $aParameter['org_id'];
		$sIp = $aParameter['ip'];

		if ($sClass == 'IPv4Block')
		{
			$iMinBlockId = IPv4Block::GetSmallerBlockContainingIp($iOrgId, $sIp);
		}
		else
		{
			$iMinBlockId = IPv6Block::GetSmallerBlockContainingIp($iOrgId, $sIp);
		}
		if ($iMinBlockId != 0)
		{
			$oBlock = MetaModel::GetObject($sClass,$iMinBlockId);
		}
		else
		{
			$oBlock = MetaModel::NewObject($sClass);
			$oBlock->Set('name', $sIp);
			$oBlock->Set('org_id', $iOrgId);
			$oBlock->Set('firstip', $sIp);
			$sLastIP = ($sClass == 'IPv4Block') ? '255.255.255.255' : 'FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF:FFFF';
			$oBlock->Set('lastip', $sLastIP);
		}

		$oBlock->SetPageTitles($oP, 'UI:IPManagement:Action:DoFindSpace:'.$sClass.':');

		// Dump space
		$oP->add('<table style="width:100%"><tr><td colspan="2">');
		$oP->add('<div style="vertical-align:top;" id="tree">');
		$oBlock->DoDisplayAvailableSpace($oP, 0, $aParameter);
		$oP->add('</div></td></tr></table>');
		$oP->add('</div>');		 // ??
		$oP->add_ready_script("\$('#tree ul').treeview();\n");
		$oP->add("<div id=\"dialog_content\"/>\n");

	}

}
