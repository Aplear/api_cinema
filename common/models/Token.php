<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "token".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $expired_at
 * @property string $token
 */
class Token extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%token}}';
    }

    /**
     * @param $expire
     */
    public function generateToken($expire)
    {
        $this->expired_at = $expire;
        $this->token = \Yii::$app->security->generateRandomString();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'token' => 'token',
            'expired' => function() {
                return date(DATE_RFC3339, $this->expired_at);
            }
        ];
    }
}