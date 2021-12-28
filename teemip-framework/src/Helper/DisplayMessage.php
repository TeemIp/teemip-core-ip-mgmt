<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Framework\Helper;

use Combodo\iTop\Application\UI\Base\Component\Panel\PanelUIBlockFactory;
use iTopWebPage;

class DisplayMessage {
	/**
	 * @param \iTopWebPage $oP
	 * @param $sMessage
	 */
	public static function Success(iTopWebPage $oP, $sMessage) {
		if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.0', '<')) {
			$sMessageContainer = "<div class=\"header_message message_ok teemip_message_status\">".$sMessage."</div>";
			$oP->add($sMessageContainer);
		} else {
			$oPanel = PanelUIBlockFactory::MakeForSuccess('')
				->AddHtml($sMessage);
			$oP->AddUiBlock($oPanel);
		}
	}

	/**
	 * @param \iTopWebPage $oP
	 * @param $sMessage
	 */
	public static function Info(iTopWebPage $oP, $sMessage) {
		if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.0', '<')) {
			$sMessageContainer = "<div class=\"header_message message_info teemip_message_status\">".$sMessage."</div>";
			$oP->add($sMessageContainer);
		} else {
			$oPanel = PanelUIBlockFactory::MakeForInformation('')
				->AddHtml($sMessage);
			$oP->AddUiBlock($oPanel);
		}
	}

	/**
	 * @param \iTopWebPage $oP
	 * @param $sMessage
	 */
	public static function Warning(iTopWebPage $oP, $sMessage) {
		if (version_compare(ITOP_DESIGN_LATEST_VERSION, '3.0', '<')) {
			$sMessageContainer = "<div class=\"header_message message_error teemip_message_status\">".$sMessage."</div>";
			$oP->add($sMessageContainer);
		} else {
			$oPanel = PanelUIBlockFactory::MakeForWarning('')
				->AddHtml($sMessage);
			$oP->AddUiBlock($oPanel);
		}
	}
}