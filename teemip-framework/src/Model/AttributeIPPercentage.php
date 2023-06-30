<?php
/*
 * @copyright   Copyright (C) 2010-2023 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

class AttributeIPPercentage extends AttributeInteger {
	/**
	 * @inheritdoc
	 */
	public function GetAsHTML($sValue, $oHostObject = null, $bLocalize = true) {
		// Display attribute as bar graph. Value & colors are provided by object holding attribute.
		$iWidth = 5; // Total width of the percentage bar graph, in em...
		if ($oHostObject != null) {
			$aParams = $oHostObject->GetAttributeParams($this->GetCode());
			$sValue = $aParams ['value'];
			$sColor = $aParams ['color'];
		} else {
			$sValue = 0;
			$sColor = GREEN;
		}
		$iValue = (int)$sValue;
		$iPercentWidth = ($iWidth * $iValue) / 100;

		return "<div style=\"width:{$iWidth}em;-moz-border-radius: 3px;-webkit-border-radius: 3px;border-radius: 3px;display:inline-block;border: 1px #ccc solid;\"><div style=\"width:{$iPercentWidth}em; display:inline-block;background-color:$sColor;\">&nbsp;</div></div>&nbsp;$sValue %";
	}

	/**
	 * @inheritdoc
	 */
	public function GetAsCSV($sValue, $sSeparator = ',', $sTextQualifier = '"', $oHostObject = null, $bLocalize = true, $bConvertToPlainText = false) {
		if ($oHostObject != null) {
			$aParams = $oHostObject->GetAttributeParams($this->GetCode());
			$sValue = $aParams ['value'];
		} else {
			$sValue = 0;
		}
		$sEscaped = (string)$sValue;
		return $sTextQualifier.$sEscaped.$sTextQualifier;
	}
}
