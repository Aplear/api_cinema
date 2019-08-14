<?php

namespace common\models;

use common\models\queries\BookingQuery;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property int $user_id
 * @property int $film_id
 * @property int $cinema_hall_id
 * @property int $cinema_hall_row_id
 * @property int $cinema_hall_seat_id
 * @property double $price
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property CinemaHall $cinemaHall
 * @property CinemaHallRows $cinemaHallRow
 * @property CinemaHallSeats $cinemaHallSeat
 * @property User $user
 */
class Booking extends \yii\db\ActiveRecord
{
    const STATUS_BOOKED = 1;
    const STATUS_BUYED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'film_id', 'cinema_hall_id', 'cinema_hall_row_id', 'cinema_hall_seat_id', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            ['status', 'in', 'range' => [static::STATUS_BOOKED, static::STATUS_BUYED]],
            [['cinema_hall_id'], 'exist', 'skipOnError' => true, 'targetClass' => CinemaHall::className(), 'targetAttribute' => ['cinema_hall_id' => 'id']],
            [['cinema_hall_row_id'], 'exist', 'skipOnError' => true, 'targetClass' => CinemaHallRows::className(), 'targetAttribute' => ['cinema_hall_row_id' => 'id']],
            [['cinema_hall_seat_id'], 'exist', 'skipOnError' => true, 'targetClass' => CinemaHallSeats::className(), 'targetAttribute' => ['cinema_hall_seat_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User',
            'film_id' => 'Film',
            'cinema_hall_id' => 'Cinema Hall',
            'cinema_hall_row_id' => 'Cinema Hall Row',
            'cinema_hall_seat_id' => 'Cinema Hall Seat',
            'price' => 'Price',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCinemaHall()
    {
        return $this->hasOne(CinemaHall::className(), ['id' => 'cinema_hall_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCinemaHallRow()
    {
        return $this->hasOne(CinemaHallRows::className(), ['id' => 'cinema_hall_row_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCinemaHallSeat()
    {
        return $this->hasOne(CinemaHallSeats::className(), ['id' => 'cinema_hall_seat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return BookingQuery
     */
    public static function find()
    {
        return new BookingQuery(get_called_class());
    }

}
