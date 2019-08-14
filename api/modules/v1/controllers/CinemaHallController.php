<?php

namespace api\modules\v1\controllers;

use api\modules\v1\actions\cinemaHall\OptionsAction;
use api\modules\v1\actions\cinemaHall\ViewAction;
use yii\helpers\ArrayHelper;

/**
 *
 */
class CinemaHallController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'authenticator' => [
                    'except' => ['options'],
                ],
                'access' => [
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['view'],
                            'roles' => ['cinema-hall'],
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
            'view' => [
                'class' => ViewAction::class,
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
            'view' => ['GET'],
            'options' => ['OPTIONS'],
        ];
    }
}