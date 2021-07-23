<?php
/*
 * @copyright   Copyright (C) 2021 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

class AttributeHostName extends AttributeString
{
	public function GetValidationPattern()
	{
		// By default, pattern matches RFC 1123 plus '_'
		// Factorize old regex and protect against backtracking
		//   Old regex: ^(\d|[a-z]|[A-Z]|_)(\d|[a-z]|[A-Z]|-|_)*$
		//   Right regex with atomic grouping: ^(? >\w[\w-]*)$ (no space between ? and >)
		//   Working regex:
		return('^(?=(\w[\w-]*))\1$');
	}
}
