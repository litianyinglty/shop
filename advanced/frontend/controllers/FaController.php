<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/17 0017
 * Time: 18:57
 */

namespace frontend\controllers;


use Mrgoon\AliSms\AliSms;
use yii\web\Controller;

class FaController extends Controller
{

    public function actionSms()
    {
        $config = [
            'access_key' => 'LTAICxQ81Tkh5580',
            'access_secret' => 'THw7BP26rHLx1IU1P18W9LeLkCOrDP',
            'sign_name' => '罗青利',
        ];
        $aliSms=new AliSms();
        $response = $aliSms->sendSms('18716687379','SMS_111550054',['code'=>rand(10000,99999)], $config);
        var_dump($response);exit;

    }

}