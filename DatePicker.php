<?php

namespace keygenqt\datePicker;

class DatePicker extends \yii\jui\DatePicker
{
    public function run()
    {
        BowerAssets::register($this->getView());

        $containerID = $this->inline ? $this->containerOptions['id'] : $this->options['id'];

        $this->getView()->registerJs("
            $('#$containerID').parent().append('<div id=\'yii2-date-picker-$containerID\' class=\'yii2-date-picker\'><span></span></div>');
            $('#$containerID').addClass('form-control').detach().appendTo('#yii2-date-picker-$containerID');
        ");

        parent::run();
    }
}