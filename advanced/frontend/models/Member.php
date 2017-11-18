<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $tel
 * @property string $email
 * @property string $token
 * @property integer $status
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $last_login_time
 * @property string $last_login_ip
 */
class Member extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $smsCode;
    public $rePassword;
    public $captcha;
    public $checked;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','password','rePassword','tel','email','smsCode','checked'],'required'],
            [['create_at', 'update_at', 'last_login_time'],'integer'],
            [['last_login_ip'],'string'],
            [['username'], 'unique'],
            ['rePassword','compare','compareAttribute'=>'password','message'=>'与用户密码不一致'],
            [['tel'],'match','pattern'=>'/^(13|14|15|17|18)[0-9]{9}$/','message'=>'手机号错误'],
            [['email'], 'match','pattern'=>'/\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/','message'=>'邮箱格式不正确'],
            [['token'], 'string', 'max' => 32],
            ['smsCode','validateCode'],
            [['captcha'],'captcha']
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
            'rePassword'=>'确认密码',
            'tel' => '用户电话',
            'email' => '用户邮箱',
            'token' => '登录令牌',
            'create_at' => '添加时间',
            'update_at' => '修改时间',
            'last_login_time' => '最后登录时间',
            'last_login_ip' => '最后登录IP',
            'smsCode'=>'验证码',
            'checked'=>'',
        ];
    }

    public function validateCode($attribute, $params)
    {
//        if (!$this->hasErrors()) {
//            把存在session中的验证码取出来，和当前的对比
            $code=Yii::$app->session->get('tel_'.$this->tel);
            if($this->smsCode!=$code){
                $this->addError($attribute, '验证码错误');
            }
//            $user = $this->getUser();
//            if (!$user || !$user->validatePassword($this->password)) {
//                $this->addError($attribute, 'Incorrect username or password.');
//            }
//        }
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
                    self::EVENT_BEFORE_INSERT=>['create_at','update_at'],
                    self::EVENT_BEFORE_UPDATE=>['update_at'],
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
    //通过id找到一个用户的实例
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
