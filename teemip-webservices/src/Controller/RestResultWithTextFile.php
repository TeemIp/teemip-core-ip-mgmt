<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Webservices\Controller;

use DBObject;
use RestResult;
use TeemIp\TeemIp\Extension\Webservices\Model\TeemIpObjectResult;

class RestResultWithTextFile extends RestResult
{
	public $objects;

	/**
	 * Report the given object
	 *
	 * @param $iCode
	 * @param string $sMessage Description of the error if any, an empty string otherwise
	 * @param DBObject $oObject The object being reported
	 * @param $sText
	 *
	 * @return void
	 */
	public function AddObject($iCode, $sMessage, $oObject, $sText) {
		$sClass = get_class($oObject);
		$oObjRes = new TeemIpObjectResult($sClass, $oObject->GetKey());
		$oObjRes->code = $iCode;
		$oObjRes->message = $sMessage;

		$oObjRes->text_file = $sText;

		$sObjKey = get_class($oObject).'::'.$oObject->GetKey();
		$this->objects[$sObjKey] = $oObjRes;
	}
}

