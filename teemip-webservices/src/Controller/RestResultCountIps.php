<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Webservices\Controller;

use DBObject;
use RestResult;
use TeemIp\TeemIp\Extension\Webservices\Model\TeemIpObjectResult;

class RestResultCountIps extends RestResult
{
	public $objects;

	/**
	 * Report the given object
	 *
	 * @param $iCode
	 * @param string $sMessage Description of the error if any, an empty string otherwise
	 * @param DBObject $oObject The object being reported
	 * @param $sSize
	 * @param array $aNbOfIPs
	 *
	 * @return void
	 */
	public function AddObject($iCode, $sMessage, $oObject, $sSize, $aNbOfIPs = array()) {
		$sClass = get_class($oObject);
		$oObjRes = new TeemIpObjectResult($sClass, $oObject->GetKey());
		$oObjRes->code = $iCode;
		$oObjRes->message = $sMessage;

		$aFields = array('org_name', 'name', 'ip', 'mask');
		foreach ($aFields as $sAttCode) {
			$oObjRes->AddField($oObject, $sAttCode, false);
		}
		$oObjRes->subnet_size = $sSize;
		$oObjRes->nb_of_ips = $aNbOfIPs;

		$sObjKey = get_class($oObject).'::'.$oObject->GetKey();
		$this->objects[$sObjKey] = $oObjRes;
	}
}
