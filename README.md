yii2-datepicker
===================

Yii2 DatePicker jquery ui with style bootstrap.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either add

```
"require": {
    "keygenqt/yii2-datepicker": "*"
},
```

of your `composer.json` file.

## Latest Release

The latest version of the module is v0.5.0 `BETA`.

## Usage

View:

```php
use keygenqt\datePicker\DatePicker;

<?= DatePicker::widget([
        'model' => $model,
        'attribute' => 'updated',
        'language' => 'en-US',
        'dateFormat' => 'php:d-M-Y',
        'clientOptions' => [
            'showOtherMonths' => true,
            'selectOtherMonths' => true,
            'dayNamesMin' => array('S', 'M', 'T', 'W', 'T', 'F', 'S')
        ]
]) ?>

```

View:

```php
use keygenqt\datePicker\DatePicker;

<?= $form->field($model, 'date')->widget(DatePicker::className(), [
    'placeholder' => 'Date',
    'icon' => false,
    'selectDay' => false,
    'dateFormat' => 'php:F, Y'
]); ?>

```

## Screenshot

![Alt text](https://raw.githubusercontent.com/keygenqt/yii2-datepicker/master/screenshot/example.png?raw=true "Empty")
![Alt text](https://raw.githubusercontent.com/keygenqt/yii2-datepicker/master/screenshot/example3.png?raw=true "Empty")

## License

**yii2-datepicker** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.


