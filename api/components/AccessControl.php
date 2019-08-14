<?php
namespace api\components;

use common\models\User;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl as BaseAccessControl;

class AccessControl extends BaseAccessControl
{
    /**
     * override default smessage in forbidden exception
     * @var string
     */
    public $forbiddenMessage;

    /**
     * @inheritdoc
     */
    protected function denyAccess($user)
    {

        if ($user !== false && $user->getIsGuest()) {
            $user->loginRequired();
        } elseif ($user && User::findOne($user->id)->isActive()) {
          return true;
        } else {
            $forbiddenMessage = $this->forbiddenMessage ?
                $this->forbiddenMessage :
                Yii::t('yii', 'You are not allowed to perform this action.');
            throw new ForbiddenHttpException($forbiddenMessage);
        }
    }
}
