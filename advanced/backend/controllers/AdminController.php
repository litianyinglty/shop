<?php

namespace backend\controllers;

use backend\models\Admin;

class AdminController extends \yii\web\Controller
{

    /**
     * @return string
     * 后台列表显示
     */
    public function actionIndex()
    {
        $admins=Admin::find()->all();
        return $this->render('index',['admins'=>$admins]);
    }

    /**
     * 添加用户
     * @return string
     */
    public function actionAdd()
    {
        $admin=new Admin();
        $request=\Yii::$app->request;
        if($request->isPost){
            if($admin->load($request->post())){
                $password=\Yii::$app->security->generatePasswordHash($admin->password);
                if($admin->validate()){
                    $admin->password=$password;
                    $admin->save();
                }
                \Yii::$app->session->setFlash('success','添加用户成功');
                return $this->redirect(['admin/index']);
            }
        }
        return $this->render('add',['admin'=>$admin]);
    }

    /**
     * 编辑用户
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $admin=Admin::findOne($id);
        $request=\Yii::$app->request;
        if($request->isPost){
            if($admin->load($request->post())){
                if($admin->validate()){
                    $password=\Yii::$app->security->generatePasswordHash($admin->password);
                    $admin->password=$password;
                    $admin->save();
                }
                \Yii::$app->session->setFlash('success','添加用户成功');
                return $this->redirect(['admin/index']);
            }
        }
        return $this->render('add',['admin'=>$admin]);
    }

    public function actionDel($id)
    {
        if(Admin::findOne($id)->delete()){
            \Yii::$app->session->setFlash('success','删除用户成功');
            return $this->redirect(['admin/index']);
        }
    }
}
