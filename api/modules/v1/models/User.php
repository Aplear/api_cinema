<?php

namespace api\models;

use Yii;
use common\models\{User as CommonUser, Token};

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $phone
 * @property integer $first_name
 * @property integer $last_name
 * @property integer $position
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @var bool
     */
    public $enableSession = false;

    /**
     * @var $password null|string
     */
    public $password = null;

    /**
     * @var $secret_key string
     */
    public $secret_key;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'common\models\User', 'message' => 'This username has already been taken.', 'when'=>function($model){
                return ($this->username !== $this->getOldAttribute('username'));
            }],
            [['username', 'phone', 'phone_eu', 'first_name', 'last_name', 'telegram', 'position'], 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['role', 'string'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => 'common\models\User', 'message' => 'This email address has already been taken.', 'when'=>function($model){
                return ($this->email !== $this->getOldAttribute('email'));
            }],
            ['password', 'required', 'on' => 'create'],
            ['password', 'string', 'min' => 6],
            ['status', 'default', 'value' => CommonUser::STATUS_ACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' =>[
                CommonUser::STATUS_NOT_ACTIVE,
                CommonUser::STATUS_ACTIVE
            ]],
            ['status', 'default', 'value' => CommonUser::STATUS_NOT_ACTIVE, 'on' => 'emailActivation'],
            ['secret_key', 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Create user.
     *
     * @return CommonUser|null
     */
    public function createUser($password = false)
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new CommonUser();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->status;

        if($password !== false) {
            $this->password = $password;
        }
        if(isset($this->password)) {
            $user->setPassword($this->password);
        }
        $user->generateAuthKey();
        if($this->scenario === 'emailActivation') {
            $user->generateSecretKey();
        }

        if($user->save()) {
            // add the role for new user
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole($this->role);
            $auth->assign($authorRole, $user->getId());

            return $user;
        }
        return null;
    }

    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @internal param $username
     */
    public static function findById($id)
    {
        return self::find()
            ->select([
                'username',
                'email',
                'phone',
                'phone_eu',
                'telegram'
            ])
            ->where(['id' => $id])
            ->andWhere(['status' => CommonUser::STATUS_ACTIVE])
            ->one();
    }

    /**
     * @param $username
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function findByUsername($username)
    {
        return self::find()
            ->where(['username' => $username])
            ->andWhere(['status' => CommonUser::STATUS_ACTIVE])
            ->one();
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToken()
    {
        return $this->hasOne(Token::className(),['user_id' => 'id'])->andWhere(['>=','expired_at',time()]);
    }
}
