<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Webservices\Controller;

use ObjectResult;
use RestResult;

class RestResultCountIps extends RestResult
{
	public $objects;

	/**
	 * Report the given object
	 *
	 * @param int An error code (RestResult::OK is no issue has been found)
	 * @param string $sMessage Description of the error if any, an empty string otherwise
	 * @param DBObject $oObject The object being reported
	 * @param array $aFieldSpec An array of class => attribute codes (Cf. RestUtils::GetFieldList). List of the attributes to be reported.
	 * @param boolean $bExtendedOutput Output all of the link set attributes ?
	 * @return void
	 */
	public function AddObject($iCode, $sMessage, $oObject, $sSize, $aNbOfIPs = array())
	{
		$sClass = get_class($oObject);
		$oObjRes = new ObjectResult($sClass, $oObject->GetKey());
		$oObjRes->code = $iCode;
		$oObjRes->message = $sMessage;

		$aFields = array('org_name', 'name', 'ip', 'mask');
		foreach ($aFields as $sAttCode)
		{
			$oObjRes->AddField($oObject, $sAttCode, false);
		}
		$oObjRes->subnet_size = $sSize;
		$oObjRes->nb_of_ips = $aNbOfIPs;

		$sObjKey = get_class($oObject).'::'.$oObject->GetKey();
		$this->objects[$sObjKey] = $oObjRes;
	}
}
