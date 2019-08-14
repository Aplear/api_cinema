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
     */
    public function run()
    {
        $model = new LoginForm();
        $model->load(Yii::$app->request->bodyParams, '');

        if($token = $model->auth()) {
            return $token;
        } else {
            return [
                'error' => true,
                'message' => 'Incorrect username or password.'
            ];
        }
    }
}
