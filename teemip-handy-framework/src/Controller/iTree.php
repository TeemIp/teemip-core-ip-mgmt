<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Framework\Controller;

interface iTree {
	/**
	 * @param $bWithIcon
	 * @param $iTreeOrgId
	 *
	 * @return mixed
	 */
	public function GetAsLeaf($bWithIcon, $iTreeOrgId);

}