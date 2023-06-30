<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

class AttributeHostName extends AttributeString {
	const MODULE_CODE = 'teemip-ip-mgmt';
	const FUNCTION_CODE = 'hostname_validation_pattern';

	public function GetValidationPattern() {
		// By default, pattern matches RFC 1123 plus '_'
		// Factorize old regex and protect against backtracking
		//   Old regex: ^(\d|[a-z]|[A-Z]|_)(\d|[a-z]|[A-Z]|-|_)*$
		//   Right regex with atomic grouping: ^(? >\w[\w-]*)$ (no space between ? and >)
		//   Working regex: ^(?=(\w[\w-]*))\1$

		$sPattern = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, '');
		if ($sPattern !== '') {
			return '^'.$sPattern.'$';
		}

		return ('^(?=(\w[\w-]*))\1$');
	}
}
