<?php
namespace common\models\queries;

use common\models\CinemaHallRows;
use yii\db\ActiveQuery;

/**
 * Class CinemaHallRowsQuery
 */
class CinemaHallRowsQuery extends ActiveQuery
{

    /**
     * @param $id
     * @return CinemaHallRowsQuery
     */
    public function byId($id)
    {
        return $this->andWhere([CinemaHallRows::tableName() . '.id' => $id]);
    }
}
