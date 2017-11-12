<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/9
 * Time: 10:58
 */

namespace backend\models;


use yii\base\Model;

class LoginForm extends Model
{
//    设置属性
    public $username;
    public $password;
    public $rememberMe = true;

//    设置验证规则
    public function rules()
    {
        return [
            [['username','password'],'required'],
            [['rememberMe'],'safe'],
        ];
    }

//    设置lable
    public function attributeLabels()
    {
        return [
            'username'=>'用户名',
            'password'=>'用户密码',
        ];
    }
}