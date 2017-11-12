<?php

namespace backend\controllers;

use backend\models\AuthItem;

class PermissionController extends \yii\web\Controller
{
    /**
     * 权限列表显示
     * @return string
     */
    public function actionIndex()
    {
//        实例化RBAC组件
        $auth=\Yii::$app->authManager;
//        得到所有的权限
        $permissions=$auth->getPermissions();
        return $this->render('index',compact('permissions'));
    }

    /**
     * 创建权限
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
//        创建表单模型
        $model=new AuthItem();
//        实例化RBAC组件
        $auth=\Yii::$app->authManager;
//        创建HTTP请求对象
        $request=\Yii::$app->request;
//        装载数据并且验证
        if($model->load($request->post()) && $model->validate()){
//            创建权限
            $permission=$auth->createPermission($model->name);
//                  给权限描述赋值
                    $permission->description=$model->description;
//                  添加权限
                    $auth->add($permission);
//            跳转页面
            \Yii::$app->session->setFlash('success','创建'.$permission->description.'权限成功');
            return $this->refresh();
        }
        return $this->render('add',compact('model'));
    }

    /**
     * 权限编辑
     * @param $name
     * @return string|\yii\web\Response
     */
    public function actionEdit($name)
    {
//        创建表单模型
        //$model=new AuthItem();
        $model=AuthItem::findOne($name);
//        实例化RBAC组件
        $auth=\Yii::$app->authManager;
//        创建HTTP请求对象
        $request=\Yii::$app->request;
//        装载数据并且验证
        if($model->load($request->post()) && $model->validate()){
//            创建权限
//            $permission=$auth->createPermission($model->name);
//            找出当前权限对象
            $permission=$auth->getPermission($model->name);
            if($permission){
//                  给权限描述赋值
                $permission->description=$model->description;
//                  添加权限
                $auth->update($model->name,$permission);
                \Yii::$app->session->setFlash('success','修改'.$permission->description.'成功');
                return $this->redirect(['permission/index']);
            }else{
//            跳转页面
                \Yii::$app->session->setFlash('danger','不能修改权限名称'.$model->name);
                return $this->refresh();
            }
        }
        return $this->render('add',compact('model'));
    }

    /**
     * 删除权限
     * @param $name
     * @return \yii\web\Response
     */
    public function actionDel($name)
    {
//        实例化RBAC组件
        $auth=\Yii::$app->authManager;
//        找到当前权限
        $permission=$auth->getPermission($name);
//        删除权限
        if($auth->remove($permission)){
//        跳转
            \Yii::$app->session->setFlash('success','删除'.$permission->name.'权限成功 ');
            return $this->redirect(['permission/index']);
        }

    }
}
