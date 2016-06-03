<?php

namespace keygenqt\datePicker;

class DatePicker extends yii\jui\DatePicker
{
    private $_baseUrl;

    public function run()
    {
        BowerAssets::register($this->getView());
        return super.run();
    }
}