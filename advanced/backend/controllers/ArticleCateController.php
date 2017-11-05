<?php

namespace backend\controllers;

use backend\models\ArticleCate;

class ArticleCateController extends \yii\web\Controller
{
    /**
     * 分类列表
     * @return string
     */
    public function actionIndex()
    {
        $articleCates=ArticleCate::find()->all();
        return $this->render('index',['articleCates'=>$articleCates]);
    }

    /**
     * 添加分类
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $articleCate=new ArticleCate();
        $request=\Yii::$app->request;
        if($articleCate->load($request->post()) && $articleCate->validate()){
            $articleCate->save();
            \Yii::$app->session->setFlash('success','添加分类成功');
            return $this->redirect(['article-cate/index']);
        }
        $articleCate->is_help=0;
        return $this->render('add',[ 'articleCate' => $articleCate]);
    }

    /**
     * 编辑分类
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
//        $articleCate=new ArticleCate();
        $articleCate=ArticleCate::findOne($id);
        $request=\Yii::$app->request;
        if($articleCate->load($request->post()) && $articleCate->validate()){
            $articleCate->save();
            \Yii::$app->session->setFlash('success','编辑分类成功');
            return $this->redirect(['article-cate/index']);
        }
        return $this->render('add',[ 'articleCate' => $articleCate]);
    }

    /**
     * 删除分类
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        if(ArticleCate::findOne($id)->delete()){
            \Yii::$app->session->setFlash('success','删除分类成功');
            return $this->redirect(['article-cate/index']);
        }
    }
}
