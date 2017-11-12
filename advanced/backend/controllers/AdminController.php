<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\LoginForm;
use yii\helpers\ArrayHelper;

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
//        实例化RBAC组件
        $auth=\Yii::$app->authManager;
//        得到所有角色
        $roles=$auth->getRoles();
        $roles=ArrayHelper::map($roles,'name','description');
        $request=\Yii::$app->request;
        if($request->isPost){
            if($admin->load($request->post())){
                $password=\Yii::$app->security->generatePasswordHash($admin->password);
                if($admin->validate()){
                    $admin->password=$password;
                    $admin->token=\Yii::$app->security->generateRandomString();
                    $admin->save();
//                    得到角色
                    if($admin->roles){
                        foreach ($admin->roles as $role){
//                            var_dump($role);exit;
//                            得到角色
                            $role=$auth->getRole($role);
                            $auth->assign($role,$admin->id);
                        }
                    }
                }
                \Yii::$app->session->setFlash('success','添加用户成功');
                return $this->redirect(['admin/index']);
            }
        }
        $admin->roles='member';
        return $this->render('add',['admin'=>$admin,'roles'=>$roles]);
    }

    /**
     * 编辑用户
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $admin=Admin::findOne($id);
//        实例化RBAC组件
        $auth=\Yii::$app->authManager;
//        得到所有角色
        $roles=$auth->getRoles();
        $roles=ArrayHelper::map($roles,'name','description');
//        得到当前用户的角色
        $rolesAdmin=$auth->getRolesByUser($id);
//        var_dump($rolesAdmin);exit;
        $admin->roles=array_keys($rolesAdmin);
        $request=\Yii::$app->request;
        if($request->isPost){
//            判断修改密码是否与原密码相等，不相等则进行了修改，不再加密
//            if($request->post()['Admin']['password']==$admin->password){
//                if($admin->load($request->post())){
//                    if($admin->validate()){
//                        $admin->save();
//                    }
//            }else{
                    if($admin->load($request->post())){
                        if($admin->validate()){
                            $password=\Yii::$app->security->generatePasswordHash($admin->password);
                            $admin->password=$password;
                            $admin->save();
//                            取消当前用户所有角色
                            $auth->revokeAll($id);
//                            判断是否有角色传过来
                            if($admin->roles){
//                                循环添加
                                foreach ($admin->roles as $role){
//                                    得到所有角色
                                    $role=$auth->getRole($role);
//                                    给用户添加角色
                                    $auth->assign($role,$admin->id);
                                }
                            }
                        }
                    }
//                }
//            }
            \Yii::$app->session->setFlash('success','编辑用户成功');
            return $this->redirect(['admin/index']);
        }
        $admin->password='';
        return $this->render('add',['admin'=>$admin,'roles'=>$roles]);
    }

    /**
     * 删除用户
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
//        实例化RBAC组件
        $auth=\Yii::$app->authManager;
//        撤销当前用户角色
        $auth->revokeAll($id);
        if(Admin::findOne($id)->delete()){
            \Yii::$app->session->setFlash('success','删除用户成功');
            return $this->redirect(['admin/index']);
        }
    }

    /**
     * 用户登录
     * @return \yii\web\Response
     */
    public function actionLogin()
    {
        if(!\Yii::$app->user->isGuest){
            return $this->goHome();
        }
        $model = new LoginForm();
        $request = \Yii::$app->request;
//            判断是不是post提交
        if ($request->isPost) {
//            装载数据
            $model->load($request->post());
//            判断用户是否存在
            $admin = Admin::findOne(['username' => $model->username]);
            if ($admin) {
//                判断密码是否正确
                if (\Yii::$app->security->validatePassword($model->password, $admin->password)) {
                    if ($model->validate()) {
//                    登录成功，判断是否记住密码，保存信息
                        \Yii::$app->user->login($admin, $model->rememberMe ? 3600 * 24 * 7 : 0);
//                    得到用户登录IP
//                    $admin->last_login_ip=$_SERVER["REMOTE_ADDR"];
                        $admin->last_login_ip = \Yii::$app->request->getUserIP();
                        $admin->save();
                        \Yii::$app->session->setFlash('success','登录成功');
                        return $this->redirect(['admin/index']);
                    }
                } else {
                    $model->addError('password', '密码错误');
                }
            } else {
                $model->addError('username', '用户名不存在');
            }
        }
        return $this->render('login',['model'=>$model]);
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->redirect(['admin/login']);
    }
}
