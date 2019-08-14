<?php
namespace common\models\queries;

use common\models\Films;
use yii\db\ActiveQuery;

/**
 * Class FilmsQuery
 */
class FilmsQuery extends ActiveQuery
{
    /**
     * @return FilmsQuery
     */
    public function active()
    {
        return $this->andWhere([
            'AND',
            [Films::tableName() . '.status' => Films::STATUS_ACTIVE],
            ['>', 'start_at', time()]
        ]);
    }

    /**
     * @param $id
     * @return FilmsQuery
     */
    public function byId($id)
    {
        return $this->andWhere([Films::tableName() . '.id' => $id]);
    }
}
