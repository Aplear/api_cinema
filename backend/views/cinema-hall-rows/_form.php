<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\CinemaHallRows */
/* @var $form yii\widgets\ActiveForm */
/* @var $cinemaHall \common\models\CinemaHall */
?>

<div class="cinema-hall-rows-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'cinema_hall_id')->dropDownList(
        ArrayHelper::map(
            $cinemaHall,
            'id',
            'title'
        )
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
