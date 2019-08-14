<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CinemaHall */

$this->title = 'Create Cinema Hall';
$this->params['breadcrumbs'][] = ['label' => 'Cinema Halls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cinema-hall-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
