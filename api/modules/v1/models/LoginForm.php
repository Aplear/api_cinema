<?php

namespace api\modules\v1\models;

use common\models\Token;

/**
 * Login Class Model
 */
class LoginForm extends \common\models\LoginForm
{

    /**
     * @return Token|mixed|null
     */
    public function auth()
    {
        if($this->validate()) {
            $user = $this->getUser();
            $currentToken = $user->token;
            if(!is_null($currentToken)) {
                return $currentToken;
            }

            $token = new Token();
            $token->user_id = $user->id;
            $token->generateToken(time()+(3600*48));

            return $token->save() ? $token : null;
        } else {
            return null;
        }
    }

}