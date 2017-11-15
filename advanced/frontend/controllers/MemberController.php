<?php

namespace frontend\controllers;

use frontend\models\Member;

class MemberController extends \yii\web\Controller
{

    /**
     * 用户列表显示
     * @return string
     */
    public function actionIndex()
    {
        $members=Member::find()->all();
        return $this->render('index',compact('members'));
    }

    /**
     * 用户祖册
     * @return string
     */
    public function actionAdd()
    {
        $member=new Member();
        $request=\Yii::$app->request;
        if($request->isPost){

        }
        $member->status=1;
        return $this->render('add',compact('member'));
    }
}
