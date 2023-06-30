<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

class AttributeAliasList extends AttributeText {
	const MODULE_CODE = 'teemip-ip-mgmt';
	const FUNCTION_CODE = 'aliaslist_validation_pattern';

	public function GetValidationPattern() {
		// By default, pattern matches a domain name per line
		//   Right regex with atomic grouping: ^(? >(\w[\w-]*(\.\w[\w-]*)*\.?)+(((\R|\n)\w[\w-]*(\.\w[\w-]*)*\.?))*))$ (no space between ? and >)
		//   \R works for PHP preg_match while \n works for javascript
		//   Working regex:^(?=((\w[\w-]*(\.\w[\w-]*)*\.?)+(((\R|\n)(\w[\w-]*(\.\w[\w-]*)*\.?))*)))\1$

		$sPattern = MetaModel::GetModuleSetting(static::MODULE_CODE, static::FUNCTION_CODE, '');
		if ($sPattern !== '') {
			return '^'.$sPattern.'$';
		}

		return ('^(?=((\w[\w-]*(\.\w[\w-]*)*\.?)+(((\R|\n)(\w[\w-]*(\.\w[\w-]*)*\.?))*)))\1$');
	}
}
