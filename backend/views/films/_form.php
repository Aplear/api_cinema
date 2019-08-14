<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Films */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="films-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            //'class' => 'form-inline',
            'enctype' => 'multipart/form-data'
        ],
    ]); ?>

    <?= $form->field($model, 'cinema_hall_id')->dropDownList(
        ArrayHelper::map(
            $cinemaHall,
            'id',
            'title'
        )
    ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'file')->fileInput()?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'start_at')->widget(DateTimePicker::classname(), [
        'options' => ['placeholder' => 'Начало сеанса'],
        'removeButton' => false,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'dd-m-yyyy hh:ii',
            'startDate' => date('d-n-Y H:i'),
            'todayHighlight' => true
        ]
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getAllStatusArray()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
