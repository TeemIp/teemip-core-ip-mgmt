<?php
/*
 * @copyright   Copyright (C) 2010-2024 TeemIp
 * @license     http://opensource.org/licenses/AGPL-3.0
 */

class AttributeIPPercentage extends AttributeInteger {
    public const ATTRIBUTE_WIDTH = 5;   // Total width of the percentage bar graph, in em...

	/**
	 * @inheritdoc
	 */
	public function GetAsHTML($sValue, $oHostObject = null, $bLocalize = true): string
    {
		// Display attribute as bar graph. Value & watermarks are provided by object holding attribute.
		if ($oHostObject != null) {
			$aParams = $oHostObject->GetAttributeParams($this->GetCode());
            return static::RenderAttribute($aParams ['value'], $aParams ['low_water_mark'], $aParams ['high_water_mark']);
		}
        return static::RenderAttribute(0, 0,0);
	}

	/**
	 * @inheritdoc
	 */
	public function GetAsCSV($sValue, $sSeparator = ',', $sTextQualifier = '"', $oHostObject = null, $bLocalize = true, $bConvertToPlainText = false): string
    {
		if ($oHostObject != null) {
			$aParams = $oHostObject->GetAttributeParams($this->GetCode());
			$sValue = $aParams ['value'];
		} else {
			$sValue = 0;
		}
		$sEscaped = (string)$sValue;
		return $sTextQualifier.$sEscaped.$sTextQualifier;
	}

    /**
     * Provides the HTML code to display a percentage in the same way as the AttributeIPPercentage
     * @param $iPercent
     * @param $sLowWaterMark
     * @param $sHighWaterMark
     * @return string
     */
    static public function RenderAttribute($iPercent, $sLowWaterMark, $sHighWaterMark): string
    {
        $iWidth = static::ATTRIBUTE_WIDTH;
        $iPercentWidth = ($iWidth * $iPercent) / 100;

        if ($iPercent >= $sHighWaterMark) {
            $sColor = RED;
        } elseif ($iPercent >= $sLowWaterMark) {
            $sColor = YELLOW;
        } else {
            $sColor = GREEN;
        }

		return "<div style=\"width:{$iWidth}em;-moz-border-radius: 3px;-webkit-border-radius: 3px;border-radius: 3px;display:inline-block;border: 1px #ccc solid;\"><div style=\"width:{$iPercentWidth}em; display:inline-block;background-color:$sColor;\">&nbsp;</div></div>&nbsp;$iPercent %";
    }
}
