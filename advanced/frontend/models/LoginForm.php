<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/16
 * Time: 22:29
 */

namespace frontend\models;


use yii\base\Model;

class LoginForm extends Model
{
//    定义属性
    public $username;
    public $password;
    public $rememberMe=true;

//    设置规则
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
            'username'=>'用户姓名',
            'password'=>'用户密码',
            'rememberMe'=>'',
        ];
    }
}