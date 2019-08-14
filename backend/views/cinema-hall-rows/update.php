<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CinemaHallRows */

$this->title = 'Update Cinema Hall Rows: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cinema Hall Rows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cinema-hall-rows-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cinemaHall' => $cinemaHall
    ]) ?>

</div>
