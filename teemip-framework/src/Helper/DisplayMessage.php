<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
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
		$oPanel = PanelUIBlockFactory::MakeForSuccess('')
			->AddHtml($sMessage);
		$oP->AddUiBlock($oPanel);
	}

	/**
	 * @param \iTopWebPage $oP
	 * @param $sMessage
	 */
	public static function Info(iTopWebPage $oP, $sMessage) {
		$oPanel = PanelUIBlockFactory::MakeForInformation('')
			->AddHtml($sMessage);
		$oP->AddUiBlock($oPanel);
	}

	/**
	 * @param \iTopWebPage $oP
	 * @param $sMessage
	 */
	public static function Warning(iTopWebPage $oP, $sMessage) {
		$oPanel = PanelUIBlockFactory::MakeForWarning('')
			->AddHtml($sMessage);
		$oP->AddUiBlock($oPanel);
	}
}