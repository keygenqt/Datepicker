<?php

namespace keygenqt\datePicker;

use yii\helpers\ArrayHelper;

class DatePicker extends \yii\jui\DatePicker
{
    public $placeholder = '';
    public $icon = true;
    public $selectDay = true;

    public function run()
    {
        BowerAssets::register($this->getView());

        $containerID = $this->inline ? $this->containerOptions['id'] : $this->options['id'];

        if ($this->icon) {
            $this->getView()->registerJs("
                $('#$containerID').attr('placeholder', '{$this->placeholder}');
                $('#$containerID').parent().append('<div id=\'yii2-date-picker-$containerID\' class=\'yii2-date-picker\'><span></span></div>');
                $('#$containerID').addClass('form-control').detach().appendTo('#yii2-date-picker-$containerID');
            ");
        } else {
            $this->getView()->registerJs("
                $('#$containerID').attr('placeholder', '{$this->placeholder}');
            ");
        }
        if (!$this->selectDay) {
            $this->getView()->registerCss("
                .ui-datepicker-$containerID {
                    width: 237px !important;
                }
                .ui-datepicker-$containerID .ui-datepicker-buttonpane {
                    width: 100% !important;
                }
                .ui-datepicker-$containerID .ui-datepicker-calendar {
                    display: none;
                }
            ");
            $this->getView()->registerJs("
                var dataPickerInst = null;
                $('body').on('click', '.ui-datepicker-$containerID .ui-datepicker-close', function() {
                    setTimeout(function() {                     
                        $('#$containerID').datepicker('setDate', new Date(dataPickerInst.selectedYear, dataPickerInst.selectedMonth, 1));
                    }, 100);
                });
            ");
            $this->clientOptions =  ArrayHelper::merge($this->clientOptions, [
                'changeMonth' => true,
                'changeYear' => true,
                'showButtonPanel' => true,
                'beforeShow' => new \yii\web\JsExpression("function(dateText, inst) { 
                    $('.ui-datepicker').addClass('ui-datepicker-$containerID');
                 }"),
                'onClose' => new \yii\web\JsExpression("function(dateText, inst) { 
                    dataPickerInst = inst;
                    setTimeout(function() { $('.ui-datepicker').removeClass('ui-datepicker-$containerID'); }, 500);
                 }")
            ]);
        }
        parent::run();
    }
}