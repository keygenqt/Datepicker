<?php

namespace keygenqt\datePicker;

use \yii\web\AssetBundle;

/**
 * @author KeyGen <keygenqt@gmail.com>
 */
class BowerAssets extends AssetBundle
{
	public $sourcePath = '@bower/yii2-datepicker/assets/css/';

	public $js = [
		'yii2-date-picker.css'
	];
}
