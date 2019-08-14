<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CinemaHallSeats */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cinema-hall-seats-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'cinema_hall_id')->dropDownList(
        ArrayHelper::map(
            $cinemaHall,
            'id',
            'title'
        ), [
            'prompt' => '-- SET --',
            'data-url-seats' => Url::to(['cinema-hall-rows/get-by-cinema-hall-row-id'])
        ]
    ) ?>

    <?= $form->field($model, 'cinema_hall_row_id')->dropDownList([], ['disabled' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
