<?php

namespace api\modules\v1\actions\booking;

use api\modules\v1\models\Booking;
use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;


/**
 * Class CreateAction
 */
class BuyAction extends Action
{

    /**
     * Buy booking
     *
     */
    public function run()
    {
        if (Yii::$app->request->isPut) {
            $bookingId = Yii::$app->request->get('id');
            $booking = Booking::find()
                ->isBooked()
                ->byId($bookingId)
                ->one();

            if (is_null($booking)) {
                throw new NotFoundHttpException('Bad booking.');
            }

            $booking->status = Booking::STATUS_BUYED;
            if ($booking->save()) {
                return [
                    'status' => true,
                    'message' => 'You successfully paid for booking'
                ];
            }

            return $booking->getErrors();
        }
    }
}
