<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\Framework\Helper;

interface iTree {
	/**
	 * Display subnet in the node of a hierarchical tree
	 *
	 * @param $bWithIcon
	 * @param $iTreeOrgId
	 *
	 * @return mixed
	 */
	public function GetAsLeaf($bWithIcon, $iTreeOrgId);

	/**
	 * Returns index to be used within tree computations
	 *
	 * @return mixed
	 */
	public function GetIndexForTree();

}