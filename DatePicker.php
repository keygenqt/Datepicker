<?php
/*
 * Copyright 2020 Vitaliy Zarubin
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace keygenqt\datePicker;

use yii\helpers\ArrayHelper;
use yii\helpers\FormatConverter;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\jui\DatePickerLanguageAsset;
use yii\jui\JuiAsset;
use yii\web\View;

class DatePicker extends \yii\jui\DatePicker
{
    public $placeholder = '';
    public $icon = true;
    public $selectDay = true;
    public $disabled = false;

    public function run()
    {
        BowerAssets::register($this->getView());
        FontAwesomeAssets::register($this->getView());

        $containerID = $this->inline ? $this->containerOptions['id'] : $this->options['id'];

        $this->getView()->registerJs("
            Yii2Datepicker = {_updates: new Array(), update: function() {
                Yii2Datepicker._updates.forEach(function(item, i, arr) {
                    item();
                });
            }};
        ");

        $this->getView()->registerJs("
            Yii2Datepicker._updates.push(function() {
        ", View::POS_READY, $containerID . 'f-1');

        if ($this->icon) {
            $this->getView()->registerJs("
                $('#$containerID').attr('placeholder', '{$this->placeholder}');
                if (!$('#$containerID').parent().hasClass('yii2-date-picker')) {
                    $('#$containerID').parent().append('<div id=\'yii2-date-picker-$containerID\' class=\'yii2-date-picker\'><i class=\"fas fa-calendar-week\"></i></div>');
                    $('#$containerID').addClass('form-control').detach().appendTo('#yii2-date-picker-$containerID');
                }
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

        if ($this->disabled) {
            $this->clientOptions =  ArrayHelper::merge($this->clientOptions, [
                'beforeShow' => new \yii\web\JsExpression("function(dateText, inst) { 
                    $('input.hasDatepicker').attr('disabled', 'disabled');
                 }"),
                'onClose' => new \yii\web\JsExpression("function(dateText, inst) { 
                    $('input.hasDatepicker').attr('disabled', null);
                 }")
            ]);
        }

        parent::run();

        $this->getView()->registerJs("
            });
        ", View::POS_READY, $containerID . 'f-2');

        $this->getView()->registerJs("Yii2Datepicker.update();", View::POS_LOAD);
    }
}