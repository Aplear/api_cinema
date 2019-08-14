<?php

namespace api\modules\v1\models;

class CinemaHallSeats extends \common\models\CinemaHallSeats
{
    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id',
            'number'
        ];
    }
}
