<?php
namespace common\models\queries;

use common\models\CinemaHall;
use yii\db\ActiveQuery;

/**
 * Class CinemaHallQuery
 */
class CinemaHallQuery extends ActiveQuery
{

    /**
     * @param $id
     * @return CinemaHallQuery
     */
    public function byId($id)
    {
        return $this->andWhere([CinemaHall::tableName() . '.id' => $id]);
    }
}
