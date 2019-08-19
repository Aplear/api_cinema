<?php

use api\modules\v1\V1Module;
use common\models\User;
use yii\base\ErrorHandler;
use yii\log\FileTarget;
use yii\rest\UrlRule;
use yii\web\JsonParser;
use yii\web\Response;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'controllerNamespace' => 'api\modules\v1\controllers',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'class' => V1Module::class
        ]
    ],
    'components' => [
        'user' => [
            'identityClass' => User::class,
            'enableSession' => false,
            'enableAutoLogin' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'response' => [
            'format' => Response::FORMAT_JSON,
            'charset' => 'UTF-8',
            'acceptParams' => ['version' => 'v1']
        ],
        'request' => [
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
        ],
        'urlManagerBackend' => [
            // here is your Front-end URL rules
            'class' => 'yii\web\urlManager',
            'baseUrl' => '//admin.kino.com',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => UrlRule::class,
                    'controller' => [
                        'v1/film' => 'v1/film'
                    ],
                    'extraPatterns' => [
                        'GET <id:\d+>' => 'view',
                        'OPTIONS <id:\d+>' => 'options',
                    ],
                    'pluralize' => false,
                ],
                [
                    'class' => UrlRule::class,
                    'controller' => [
                        'v1/booking' => 'v1/booking'
                    ],
                    'extraPatterns' => [
                        'POST create' => 'create',
                        'OPTIONS create' => 'options',
                        'PUT <id:\d+>/buy' => 'buy',
                        'OPTIONS <id:\d+>/buy' => 'options',
                    ],
                    'pluralize' => false,
                ],
                [
                    'class' => UrlRule::class,
                    'controller' => [
                        'v1/auth' => 'v1/auth'
                    ],
                    'extraPatterns' => [
                        'POST login' => 'create',
                        'OPTIONS login' => 'options',
                    ],
                ],
            ],
        ]
    ],
    'params' => $params,
];