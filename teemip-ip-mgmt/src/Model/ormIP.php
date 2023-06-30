<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

namespace TeemIp\TeemIp\Extension\IPManagement\Model;

abstract class ormIP {
	abstract public function IsBiggerOrEqual(ormIP $oIp);

	abstract public function IsBiggerStrict(ormIP $oIp);

	abstract public function IsSmallerOrEqual(ormIP $oIp);

	abstract public function IsSmallerStrict(ormIP $oIp);

	abstract public function IsEqual(ormIP $oIp);

	abstract public function Equals(ormIP $oIp);

	abstract public function BitwiseAnd(ormIP $oIp);

	abstract public function BitwiseOr(ormIP $oIp);

	abstract public function BitwiseNot();

	abstract public function LeftShift();

	abstract public function IP2dec();

	abstract public function Add(ormIP $oIp);

	abstract public function GetNextIp();

	abstract public function GetPreviousIp();

	abstract public function GetSizeInterval(ormIP $oIp);
}
