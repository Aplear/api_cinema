<?php

namespace api\modules\v1\models;

use Yii;

class CinemaHallRows extends \common\models\CinemaHallRows
{
    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id',
            'number'
        ];
    }

    /**
     * @return array
     */
    public function extraFields(): array
    {
        return [
            'cinemaHallSeats'
        ];
    }
}
