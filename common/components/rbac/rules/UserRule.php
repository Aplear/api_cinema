<?php
namespace common\components\rbac\rules;

use common\models\User;
use yii\rbac\Rule;

/**
 * Class UserRule
 */
class UserRule extends Rule
{
    /**
     * @inheritdoc
     */
    public $name = 'user';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        if ($user === null) {
            return false;
        }

        $user = User::findIdentity((int) $user);
        return $user->isActive();
    }
}
