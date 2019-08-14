<?php

namespace common\models;

use common\models\queries\CinemaHallQuery;
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
class CinemaHall extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cinema_hall';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['cinema_hall_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCinemaHallRows()
    {
        return $this->hasMany(CinemaHallRows::className(), ['cinema_hall_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCinemaHallSeats()
    {
        return $this->hasMany(CinemaHallSeats::className(), ['cinema_hall_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilms()
    {
        return $this->hasMany(Films::className(), ['cinema_hall_id' => 'id']);
    }

    /**
     * @return CinemaHallQuery
     */
    public static function find()
    {
        return new CinemaHallQuery(get_called_class());
    }
}
