<?php

namespace frontend\controllers;

use backend\models\Goods;
use frontend\models\Cart;
use frontend\models\LoginForm;
use frontend\models\Member;
use Mrgoon\AliSms\AliSms;


class MemberController extends \yii\web\Controller
{
//    关闭csrf
    public $enableCsrfValidation=false;
    public $layout='regist';
    /**
     * 用户列表显示
     * @return string
     */
    public function actionIndex()
    {
        $member=new Member();
        $request=\Yii::$app->request;
        if($request->isPost){
            if($member->load($request->post()) && $member->validate()){
                $password=\Yii::$app->security->generatePasswordHash($member->password);
                $member->password=$password;
                $member->save();
                return $this->redirect(['index']);
            }
        }
        $memberId=\Yii::$app->user->id;
        $member=Member::find()->where($memberId)->one();
        return $this->render('index',compact('member'));
    }

    /**
     * 用户注册
     * @return string
     */
    public function actionReg()
    {
        $member=new Member();
        $request=\Yii::$app->request;
        if($request->isPost){
//            var_dump($request->post());exit;
            if($member->load($request->post())){
//                  密码hash加密
                    $password=\Yii::$app->security->generatePasswordHash($member->password);
//                    生成自动登录令牌
                    $member->token=\Yii::$app->security->generateRandomString();
                    $member->password=$password;
                    $member->save(false);
                    \Yii::$app->session->setFlash('success','注册用户成功');
                    return $this->redirect(['member/index']);
            }
        }
        return $this->render('reg',compact('member'));
    }

    /**
     * 发送短信验证码
     */
    public function actionSms()
    {
//        1、限制同一个手机号一天只能发几条

//        2、同一手机号发送验证码间隔时间不能低于一分钟

//        接收参数
        $tel=\Yii::$app->request->post('tel');
//        1、生成验证码
        $code=rand(10000,99999);
//        2、发送验证码到手机
        $config = [
            'access_key' => 'LTAICxQ81Tkh5580',
            'access_secret' => 'THw7BP26rHLx1IU1P18W9LeLkCOrDP',
            'sign_name' => '罗青利',
        ];
        $aliSms = new AliSms();
        $response = $aliSms->sendSms($tel,'SMS_111550054',['code'=>$code], $config);
//        3、存储验证码  存储时按照tel=>code   tel_13534256743_65745
        \Yii::$app->session->set('tel_'.$tel,$code);
        //return $code;
    }

    /**
     * 用户登录
     */
    public function actionLogin()
    {
        $model=new LoginForm();
        $request=\Yii::$app->request;
        $url=$request->get('backurl')?$request->get('backurl'):['/home/index'];
        if($request->isPost){
//            装载数据
         if( $model->load($request->post())&&$model->validate()){
//            得到存在的用户
            $member=Member::findOne(['username'=>$model->username]);
//            判断用户是否存在
            if($member){
//                判断密码是否正确
                if(\Yii::$app->security->validatePassword($model->password,$member->password)){
//                        判断是否保存登录信息
                    \Yii::$app->user->login($member,$model->rememberMe ? 3600*24*7:0);
                       $getCookie=\Yii::$app->request->cookies;
                       $carts=$getCookie->has('cart')?$getCookie->getValue('cart'):[];
                           foreach ($carts as $goodsId=>$num){
                               $cart=Cart::find()->where(['goods_id'=>$goodsId,'id'=>$member->id])->asArray()->one();
                               if($cart){
                                   $cart->amount+=$num;
                               }else{
                                   $cart=new Cart();
                                   $cart->goods_id=$goodsId;
                                   $cart->amount=$num;
                                   $cart->member_id=$member->id;
                               }
                               $cart->save();
                           }
                        $setCookie=\Yii::$app->response->cookies;
                        $setCookie->remove('cart');
//                        得到用户登录IP
                        $member->last_login_ip=\Yii::$app->request->getUserIP();
//                        保存登录信息
                        $member->save(false);
//                        刷新页面
                        \Yii::$app->session->setFlash('success','登录成功');
                        return $this->redirect($url);
                }else{
                    $model->addError('password','登录密码错误');
                }
            }else{
                $model->addError('username','用户名不存在');
                }
            }
        }
        return $this->render('login',compact('model'));
    }

    /**
     * 退出登录
     */
    public function actionLogout()
    {
        if (\Yii::$app->user->logout()) {
            \Yii::$app->session->setFlash('success','退出成功');
        }
        return $this->redirect(['home/index']);
    }

}
