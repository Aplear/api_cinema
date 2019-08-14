<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "cinema_hall".
 *
 * @property int $id
 * @property string $title
 *
 * @property Booking[] $bookings
 * @property CinemaHallRows[] $cinemaHallRows
 * @property CinemaHallSeats[] $cinemaHallSeats
 * @property Films[] $films
 */
class CinemaHall extends \common\models\CinemaHall
{
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id',
            'title'
        ];
    }

    /**
     * @return array
     */
    public function extraFields()
    {
        return [
            'cinemaHallRows'
        ];
    }
}
