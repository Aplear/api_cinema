<?php

namespace api\modules\v1\actions\cinemaHall;

use api\modules\v1\models\CinemaHall;
use api\modules\v1\models\Films;
use yii\base\Action;


/**
 * Class ViewAction
 */
class ViewAction extends Action
{

    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     */
    public function run($id)
    {
        return CinemaHall::find()->byId($id)->one();
    }
}
