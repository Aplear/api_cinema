<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CinemaHallSeats */

$this->title = 'Create Cinema Hall Seats';
$this->params['breadcrumbs'][] = ['label' => 'Cinema Hall Seats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cinema-hall-seats-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cinemaHall' => $cinemaHall
    ]) ?>

</div>
