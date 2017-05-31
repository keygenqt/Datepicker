<?php

namespace keygenqt\datePicker;

use \yii\web\AssetBundle;

class FontAwesomeAssets extends AssetBundle
{
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $sourcePath = '@bower/font-awesome';

    public $css = [
        'css/font-awesome.css'
    ];
}
