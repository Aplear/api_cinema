<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CinemaHallRowsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cinema Hall Rows';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cinema-hall-rows-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cinema Hall Rows', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'number',
            'cinema_hall_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
