<?php

namespace frontend\controllers;

use frontend\models\Address;

class AddressController extends \yii\web\Controller
{
    public $layout='public';
    public $enableCsrfValidation=false;
    public function actionAdd()
    {
        $address=new Address();
        $request=\Yii::$app->request;
        if($request->isPost){
            if($address->load($request->post())){
//                var_dump($address);exit;
                if ($address->validate()){
                    $address->member_id=\Yii::$app->user->id;
                    $address->save();
                    return $this->refresh();
                }
            }
        }
        return $this->render('add',compact('address'));
    }
}
