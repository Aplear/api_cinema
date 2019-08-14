<?php

namespace api\modules\v1\actions\booking;

use api\modules\v1\models\Booking;
use api\modules\v1\models\CinemaHall;
use api\modules\v1\models\Films;
use Yii;
use yii\base\Action;
use yii\base\ErrorException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;


/**
 * Class CreateAction
 */
class CreateAction extends Action
{

    /**
     * @var $currentFilm Films|null
     */
    public $currentFilm;

    /**
     * Create booking
     *
     */
    public function run()
    {
        $booking = new Booking();

        if ($post = Yii::$app->request->post()) {
            if (!isset($post['film_id'])) {
               throw new NotFoundHttpException('Film id has been not found.');
            }
            if (!isset($post['cinema_hall_row_id'])) {
                throw new NotFoundHttpException('Cinema hall row id has been not found.');
            }
            if (!isset($post['cinema_hall_seat_id'])) {
                throw new NotFoundHttpException('Cinema hall seat id has been not found.');
            }

            $booking->film_id = $post['film_id'];
            $booking->cinema_hall_row_id = $post['cinema_hall_row_id'];
            $booking->cinema_hall_seat_id = $post['cinema_hall_seat_id'];

            //Check current film
            $this->currentFilm = Films::find()
                ->byId($booking->film_id)
                ->active()
                ->one();

            if (is_null($this->currentFilm)) {
                throw new BadRequestHttpException('Current film is not active already');
            }

            if (!$this->checkCinemaHallRow($booking)) {
                throw new BadRequestHttpException('Current seat is already booked');
            }

            //Check current seat
            $isCurrentSeatBooked = $booking->find()
                ->isBookedSeat($booking->film_id, $booking->cinema_hall_seat_id)
                ->one();

            if (!is_null($isCurrentSeatBooked)) {
                throw new BadRequestHttpException('Current seat is already booked');
            }

            $booking->cinema_hall_id = $this->currentFilm->cinema_hall_id;
            $booking->price = $this->currentFilm->price;
            $booking->status = Booking::STATUS_BOOKED;
            $booking->user_id = \Yii::$app->user->id;
            if (!$booking->save()) {
                throw new ErrorException('Cannot save model');
            }
            Yii::$app->response->setStatusCode(201);
            return $booking;
        }
    }

    /**
     * @param Booking $booking
     * @return bool
     */
    public function checkCinemaHallRow(Booking $booking)
    {
        $isCinemaHallSeatExist = CinemaHall::find()
            ->innerJoinWith('cinemaHallRows', true)
            ->byId($this->currentFilm->cinema_hall_id)
            ->one();

        $checkRow = false;
        $checkSeat = false;

        $cinemaHallRows = $isCinemaHallSeatExist->cinemaHallRows;
        if ($cinemaHallRows) {

            foreach ($cinemaHallRows as $row)
            {
                //Check is row of this hall is correct
                if($row->id == $booking->cinema_hall_row_id) {
                    $checkRow = true;
                    //each seat of this row
                    foreach ($row->cinemaHallSeats as $seat)
                    {
                        //Check is seat of this hall is correct
                        if($seat->id == $booking->cinema_hall_seat_id) {
                            $checkSeat = true;
                            break;
                        }
                    }
                    break;
                }
            }
        }

        return $checkRow == true && $checkSeat == true;
    }
}
