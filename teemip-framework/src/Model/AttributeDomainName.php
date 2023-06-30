<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

class AttributeDomainName extends AttributeString
{
	public function GetValidationPattern()
	{
		// By default, pattern matches RFC 1123 plus '_'
		// Factorize old regex and protect against backtracking
		//   Old regex ^(\d|[a-z]|[A-Z]|-|_)+((\.(\d|[a-z]|[A-Z]|-|_)+)*)\.?$
		//   Right regex with atomic grouping: ^(? >\w[\w-]*(\.\w[\w-]*)*\.?)$ (no space between ? and >)
		//   Working regex: ^(?=(\w[\w-]*(\.\w[\w-]*)*\.?))\1$

		$sPattern = '^(\w[\w-]*(\.\w[\w-]*)*\.?)$';
		$sAdditionalPattern = $this->GetOptional('validation_pattern', '');
		if (($sAdditionalPattern != '') && !(@preg_match('/'.$sAdditionalPattern.'/', '') === false)) {
			// $sAdditionalPattern exists and is valid. Include it in validation pattern
			$sPattern = $sAdditionalPattern.'|'.$sPattern;
		}

		return $sPattern;
	}
}
