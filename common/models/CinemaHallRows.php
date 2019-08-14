<?php

namespace common\models;

use common\models\queries\CinemaHallRowsQuery;
use Yii;

/**
 * This is the model class for table "cinema_hall_rows".
 *
 * @property int $id
 * @property int $number
 * @property int $cinema_hall_id
 *
 * @property Booking[] $bookings
 * @property CinemaHall $cinemaHall
 * @property CinemaHallSeats[] $cinemaHallSeats
 */
class CinemaHallRows extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cinema_hall_rows';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'cinema_hall_id'], 'integer'],
            [['cinema_hall_id'], 'exist', 'skipOnError' => true, 'targetClass' => CinemaHall::className(), 'targetAttribute' => ['cinema_hall_id' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['cinema_hall_row_id' => 'id']);
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
    public function getCinemaHallSeats()
    {
        return $this->hasMany(CinemaHallSeats::className(), ['cinema_hall_row_id' => 'id']);
    }

    /**
     * @return CinemaHallRowsQuery
     */
    public static function find()
    {
        return new CinemaHallRowsQuery(get_called_class());
    }
}
