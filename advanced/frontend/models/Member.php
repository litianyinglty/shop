<?php

namespace frontend\models;

use Yii;

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
class Member extends \yii\db\ActiveRecord
{
    public static $statusArr=['1'=>'上线','2'=>'下线'];
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
            [['username','password','tel','email','status'],'required'],
            [['status', 'create_at', 'update_at', 'last_login_time', 'last_login_ip'], 'integer'],
            [['username'], 'string', 'max' => 40],
            [['password'], 'string', 'max' => 64],
            [['tel'], 'string', 'max' => 11],
            [['email'], 'email'],
            [['token'], 'string', 'max' => 32],
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
            'tel' => '用户电话',
            'email' => '用户邮箱',
            'token' => '登录令牌',
            'status' => '状态',
            'create_at' => '添加时间',
            'update_at' => '修改时间',
            'last_login_time' => '最后登录时间',
            'last_login_ip' => '最后登录IP',
        ];
    }
}
