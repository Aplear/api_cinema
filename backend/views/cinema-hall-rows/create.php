<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CinemaHallRows */

$this->title = 'Create Cinema Hall Rows';
$this->params['breadcrumbs'][] = ['label' => 'Cinema Hall Rows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cinema-hall-rows-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cinemaHall' => $cinemaHall
    ]) ?>

</div>
