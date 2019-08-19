<?php

namespace api\modules\v1\actions\auth;

use api\modules\v1\models\LoginForm;
use Yii;
use yii\base\Action;


/**
 * Class CreateAction
 */
class CreateAction extends Action
{

    /**
     * Create access token
     *
     * @api {post} /auth/login
     * @apiParam {String} username  User username field.
     * @apiParam {String} password  User password field.
     */
    public function run()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');

        if($token = $model->auth()) {
            Yii::$app->response->setStatusCode(201);
            return $token;
        } else {
            return [
                'error' => true,
                'message' => 'Incorrect username or password.'
            ];
        }
    }
}
