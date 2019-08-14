<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CinemaHall */

$this->title = 'Update Cinema Hall: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Cinema Halls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cinema-hall-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
