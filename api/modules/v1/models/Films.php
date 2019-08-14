<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "films".
 *
 * @property int $id
 * @property int $cinema_hall_id
 * @property string $title
 * @property string $image
 * @property double $price
 * @property int $start_at
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CinemaHall $cinemaHall
 */
class Films extends \common\models\Films
{
    public function fields()
    {
        return [
            'id',
            'cinema_hall_id',
            'title',
            'image' => function () {
                return Yii::$app->urlManagerBackend->baseUrl . $this->image;
            },
            'price',
            'start_at' => function () {
                return date('Y-m-d h:i', $this->start_at);
            },
            'status'
        ];
    }

    public function extraFields()
    {
        return [
            'cinemaHall'
        ];
    }
}
