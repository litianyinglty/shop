<?php

namespace backend\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $token
 * @property integer $token_create_time
 * @property integer $add_time
 * @property integer $last_login_time
 * @property string $last_login_ip
 */


//继承自动登录接口
class Admin extends ActiveRecord implements IdentityInterface
{
    public $roles=[];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','password','email'],'required'],
            [['token_create_time', 'add_time', 'last_login_time'], 'integer'],
            [['username'], 'string', 'max' => 50],
            [['token'], 'string', 'max' => 32],
            [['email'],'email'],
            [['last_login_ip'], 'string', 'max' => 20],
            [['roles'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户姓名',
            'password' => '用户密码',
            'salt' => '盐',
            'email' => '用户邮箱',
            'roles'=>'角色名称',
            'token' => '自动登录令牌',
            'token_create_time' => '令牌创建时间',
            'add_time' => '添加时间',
            'last_login_time' => '最后登录时间',
            'last_login_ip' => '最后登录IP',
        ];
    }

    /**
     * 设置系统生成时间
     * @return array
     */
    public function behaviors()
    {
        return [
            ['class'=>TimestampBehavior::className(),
                'attributes'=>[
                    self::EVENT_BEFORE_INSERT=>['token_create_time','add_time'],
                ]
            ],
        ];
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->token;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->token===$authKey;
    }
}
