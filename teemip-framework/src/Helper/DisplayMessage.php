<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Framework\Helper;

use Combodo\iTop\Application\UI\Base\Component\Alert\AlertUIBlockFactory;
use iTopWebPage;

class DisplayMessage {
	/**
	 * @param \iTopWebPage $oP
	 * @param $sMessage
	 */
	public static function Success(iTopWebPage $oP, $sMessage) {
		$oMessage = AlertUIBlockFactory::MakeForSuccess('', $sMessage);
		$oP->AddUiBlock($oMessage);
	}

	/**
	 * @param \iTopWebPage $oP
	 * @param $sMessage
	 */
	public static function Info(iTopWebPage $oP, $sMessage) {
		$oMessage = AlertUIBlockFactory::MakeForInformation('', $sMessage);
		$oP->AddUiBlock($oMessage);
	}

	/**
	 * @param \iTopWebPage $oP
	 * @param $sMessage
	 */
	public static function Warning(iTopWebPage $oP, $sMessage) {
		$oMessage = AlertUIBlockFactory::MakeForWarning('', $sMessage);
		$oP->AddUiBlock($oMessage);
	}
}