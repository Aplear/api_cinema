<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CinemaHallSeats */

$this->title = 'Update Cinema Hall Seats: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cinema Hall Seats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cinema-hall-seats-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cinemaHall' => $cinemaHall
    ]) ?>

</div>
