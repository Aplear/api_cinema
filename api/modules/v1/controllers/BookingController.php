<?php

namespace api\modules\v1\controllers;

use api\modules\v1\actions\booking\OptionsAction;
use api\modules\v1\actions\booking\BuyAction;
use api\modules\v1\actions\booking\CreateAction;
use yii\helpers\ArrayHelper;

/**
 *
 */
class BookingController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'access' => [
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['create', 'buy'],
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'create' => [
                'class' => CreateAction::class,
            ],
            'buy' => [
                'class' => BuyAction::class,
            ],
            'options' => [
                'class' => OptionsAction::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'create' => ['POST'],
            'buy' => ['PUT']
        ];
    }
}