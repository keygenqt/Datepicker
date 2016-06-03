<?php

namespace keygenqt\datePicker;

class DatePicker extends \yii\jui\DatePicker
{
    public function run()
    {
        BowerAssets::register($this->getView());

        $this->getView()->registerJs("
            $('#$this->id').parent().append('<div id=\'yii2-date-picker-$this->id\' class=\'yii2-date-picker\'><span></span></div>');
            $('#$this->id').addClass('form-control').detach().appendTo('#yii2-date-picker-$this->id');
        ");

        return parent::run();
    }
}