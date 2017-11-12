<?php

namespace backend\controllers;

use backend\models\AuthItem;
use yii\helpers\ArrayHelper;

class RoleController extends \yii\web\Controller
{
    /**
     * 角色列表显示
     * @return string
     */
    public function actionIndex()
    {
//        实例化RBAC组件
        $auth=\Yii::$app->authManager;
//        得到所有权限
//        $permissions=$auth->getPermissionsByRole();
//        得到所有角色，显示视图
        $roles=$auth->getRoles();
        return $this->render('index',compact('roles'));
    }

    /**
     * 创建角色
     * @return string
     */
    public function actionAdd()
    {
//        创建模型对象
        $model=new AuthItem();
//        实例化RBAC组件
        $auth=\Yii::$app->authManager;
//        得到所有权限
        $permissions=$auth->getPermissions();
        $permissions=ArrayHelper::map($permissions,'name','description');
//        var_dump($permissions);exit;
        $request=\Yii::$app->request;
//        装载数据
        if($model->load($request->post()) && $model->validate()){
//            var_dump($model);exit;
//            创建角色
            $role=$auth->createRole($model->name);
//            添加描述
            $role->description=$model->description;
//            角色添加成功，给角色添加权限
            if($auth->add($role)){
//                判断是否有权限传过来
                if($model->permissions){
//                    循环
                    foreach ($model->permissions as $permission){
//                        循环将权限添加到角色中
                        $auth->addChild($role,$auth->getPermission($permission));
                    }
                }
            }
            \Yii::$app->session->setFlash('success','添加'.$model->description.'角色成功');
            return $this->redirect(['role/index']);
        }else{
//            var_dump($model->getErrors());exit;
        }
//        显示视图
        return $this->render('add',compact('model','permissions'));
    }

    /**
     * 修改角色
     * @param $name
     * @return string|\yii\web\Response
     */
    public function actionEdit($name)
    {
//        创建模型对象
//        $model=new AuthItem();
//        实例化RBAC组件
        $auth=\Yii::$app->authManager;
//        得到当前角色
        $model=AuthItem::findOne($name);
//        得到所有权限
        $rolePermissions=$auth->getPermissionsByRole($name);
//        取出所有的键
        $model->permissions=array_keys($rolePermissions);
        $request=\Yii::$app->request;
//        装载数据
        if($model->load($request->post()) && $model->validate()){
//            var_dump($model);exit;
//            找出当前角色对象
            $role=$auth->getRole($model->name);
            if($role){
//                添加描述
                $role->description=$model->description;
//                修改角色名称
                if($auth->update($model->name,$role)){
//                    删除当前角色所有权限
                    $auth->removeChildren($role);
//                    判断权限是否存在
                    if($model->permissions){
//                        循环添加
                        foreach ($model->permissions as $permission){
                            $auth->addChild($role,$auth->getPermission($permission));
                        }
                    }
                }
                \Yii::$app->session->setFlash('success','修改'.$model->description.'角色成功');
                return $this->redirect(['role/index']);
            }else{
                \Yii::$app->session->setFlash('danger','不能修改角色名称'.$model->description);
                return $this->refresh();
            }
        }
        $permissions=$auth->getPermissions();
        $permissions=ArrayHelper::map($permissions,'name','description');
//        显示视图
        return $this->render('add',compact('model','permissions'));
    }

    /**
     * 删除角色
     * @param $name
     * @return \yii\web\Response
     */
    public function actionDel($name)
    {
//        实例化RBAC组件
        $auth=\Yii::$app->authManager;
//        找出当前角色
        $role=$auth->getRole($name);
        $auth->removeChildren($role);
        if($auth->remove($role)){
            \Yii::$app->session->setFlash('success','删除'.$role->name.'角色成功');
            return $this->redirect(['role/index']);
        }
    }
}
