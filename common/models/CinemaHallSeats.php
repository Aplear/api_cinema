<?php

namespace common\models;

/**
 * This is the model class for table "cinema_hall_seats".
 *
 * @property int $id
 * @property int $number
 * @property int $cinema_hall_id
 * @property int $cinema_hall_row_id
 *
 * @property Booking[] $bookings
 * @property CinemaHall $cinemaHall
 * @property CinemaHallRows $cinemaHallRow
 */
class CinemaHallSeats extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cinema_hall_seats';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'cinema_hall_id', 'cinema_hall_row_id'], 'integer'],
            [
                ['cinema_hall_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => CinemaHall::class,
                'targetAttribute' => ['cinema_hall_id' => 'id']
            ],
            [
                ['cinema_hall_row_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => CinemaHallRows::class,
                'targetAttribute' => ['cinema_hall_row_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'cinema_hall_id' => 'Cinema Hall',
            'cinema_hall_row_id' => 'Cinema Hall Row',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['cinema_hall_seat_id' => 'id']);
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
}
