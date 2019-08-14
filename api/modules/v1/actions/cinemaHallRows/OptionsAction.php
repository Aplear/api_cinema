<?php

namespace api\modules\v1\actions\cinemaHallRows;


use yii\rest\OptionsAction as BaseOptionsAction;

/**
 * Class OptionsAction
 */
class OptionsAction extends BaseOptionsAction
{

    /**
     * @inheritdoc
     */
    public $collectionOptions = ['POST'];

    /**
     * @inheritdoc
     */
    public $resourceOptions = [];
}
