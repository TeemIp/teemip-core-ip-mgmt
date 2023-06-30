<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

class AttributeMacAddress extends AttributeString {
	/**
	 * @inheritdoc
	 */
	public function MakeRealValue($proposedValue, $oHostObj) {
		// Translate input value in canonical format used for storage
		// Input value = hyphens (12-34-56-78-90-ab), dots (1234.5678.90ab) or colons (12:34:56:78:90:ab)
		// Canonical Format = colons
		if ($proposedValue != '') {
			if ($proposedValue[2] == '-') {
				return (strtr($proposedValue, '-', ':'));
			}
			if ($proposedValue[4] == '.') {
				$proposedValue = str_replace('.', '', $proposedValue);
				$sOutputMac = '';
				$j = 0;
				for ($i = 0; $i < 12; $i++) {
					$sOutputMac .= $proposedValue[$i];
					if (($i > 0) && (is_int(($i - 1) / 2)) && ($j < 5)) {
						$j++;
						$sOutputMac .= ':';
					}
				}

				return ($sOutputMac);
			}
		}

		return ($proposedValue);
	}

	/**
	 * @param $sMac
	 * @param $oHostObject
	 *
	 * @return string
	 */
	protected function GetMacAtFormat($sMac, $oHostObject) {
		// Return $sMac at format set by global parameters
		if (($sMac != '') && ($oHostObject != null)) {
			/** @var \IPInterface $oHostObject */
			$sMacAddressOutputFormat = $oHostObject->GetAttributeParams($this->GetCode());
			switch ($sMacAddressOutputFormat) {
				case 'hyphens':
					// Return hyphens format
					return (strtr($sMac, ':', '-'));

				case 'dots':
					// Return dots format
					$aMac = str_replace(':', '', $sMac);
					$sOutputMac = '';
					$j = 0;
					for ($i = 0; $i < 12; $i++)
					{
						$sOutputMac .= $aMac[$i];
						if (($i == 3) || ($i == 7))
						{
							$j++;
							$sOutputMac .= '.';
						}
					}
					return($sOutputMac);

				case 'colons':
				default:
					break;
			}
		}

		// Return default = registered = colons format
		return ($sMac);
	}

	/**
	 * @inheritdoc
	 */
	public function GetAsCSV($sValue, $sSeparator = ',', $sTextQualifier = '"', $oHostObject = null, $bLocalize = true, $bConvertToPlainText = false) {
		$sFrom = array("\r\n", $sTextQualifier);
		$sTo = array("\n", $sTextQualifier.$sTextQualifier);
		$sEscaped = str_replace($sFrom, $sTo, $this->GetMacAtFormat($sValue, $oHostObject));

		return $sTextQualifier.$sEscaped.$sTextQualifier;
	}

	/**
	 * @inheritdoc
	 */
	public function GetAsHTML($sValue, $oHostObject = null, $bLocalize = true) {
		return Str::pure2html($this->GetMacAtFormat($sValue, $oHostObject));
	}

	/**
	 * @inheritdoc
	 */
	public function GetAsXML($sValue, $oHostObject = null, $bLocalize = true) {
		// XML being used by programs, we return canonical value of MAC
		return Str::pure2xml((string)$sValue);
	}

	public function GetEditValue($sValue, $oHostObj = null) {
		return $this->GetMacAtFormat($sValue, $oHostObj);
	}

	public function GetValidationPattern() {
		// By default, all 3 official pattern (colons, hyphens, dots) are accepted as input
		return ('^((\d|([a-f]|[A-F])){2}-){5}(\d|([a-f]|[A-F])){2}$|^((\d|([a-f]|[A-F])){4}.){2}(\d|([a-f]|[A-F])){4}$|^((\d|([a-f]|[A-F])){2}:){5}(\d|([a-f]|[A-F])){2}$');
	}
}
