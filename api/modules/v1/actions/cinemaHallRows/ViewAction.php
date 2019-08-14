<?php

namespace api\modules\v1\actions\cinemaHallRows;

use api\modules\v1\models\CinemaHallRows;
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
        return CinemaHallRows::find()->byId($id)->one();
    }
}
