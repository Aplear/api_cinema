<?php
namespace common\models\queries;

use common\models\Booking;
use yii\db\ActiveQuery;

/**
 * Class FilmsQuery
 */
class BookingQuery extends ActiveQuery
{
    /**
     * @return BookingQuery
     */
    public function isBookedSeat($film_id, $cinema_hall_seat_id)
    {
        return $this->andWhere([
            'AND',
            [Booking::tableName() . '.film_id' => $film_id],
            [Booking::tableName() . '.cinema_hall_seat_id' => $cinema_hall_seat_id],
        ]);
    }

    /**
     * @return $this
     */
    public function isBooked()
    {
        return $this->andWhere([Booking::tableName() . '.status' => Booking::STATUS_BOOKED]);
    }

    /**
     * @return $this
     */
    public function currentUser()
    {
        return $this->andWhere([Booking::tableName() . '.user_id' => \Yii::$app->user->id]);
    }

    /**
     * @param $id
     * @return BookingQuery
     */
    public function byId($id)
    {
        return $this->andWhere([Booking::tableName() . '.id' => $id]);
    }
}
