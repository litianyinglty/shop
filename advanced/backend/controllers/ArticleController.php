<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\ArticleCate;
use backend\models\ArticleDetail;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;

class ArticleController extends \yii\web\Controller
{
    /**
     * 富文本编辑器上传图片的方法
     * @return array
     */
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }
    /**
     * 文章列表
     * @return string
     */
    public function actionIndex()
    {
//        分页
//        1、总条数
        $count=Article::find()->where(['!=','status','0'])->count();
//        2、每页显示条数
        $pageSize=4;
        $page=new Pagination([
           'pageSize'=>$pageSize,
            'totalCount'=>$count,
        ]);
        $articles=Article::find()->where(['!=','status','0'])->limit($page->limit)->offset($page->offset)->all();
        return $this->render('index',['articles'=>$articles,'page'=>$page]);
    }

    /**
     * 添加文章
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $article=new Article();
//        找出文章表对象
        $articleDetail=new ArticleDetail();
        $request=\Yii::$app->request;
//        var_dump($request->post('ArticleDetail'));exit;
        if($article->load($request->post())){
            $article->save();
            if($articleDetail->load($request->post())){
                $articleDetail->article_id=$article->id;
                $articleDetail->save();
                \Yii::$app->session->setFlash("success",'添加文章成功');
                return $this->redirect(['article/index']);
            }
        }
        $article->status=1;
        $article->sort=100;
//        得到所有分类
        $cates=ArticleCate::find()->all();
        $options=ArrayHelper::map($cates,'id','name');
        return $this->render('add',['article'=>$article,'options'=>$options,'articleDetail'=>$articleDetail]);
    }

    /**
     * 编辑文章
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
//        $article=new Article();
        $article=Article::findOne($id);
        $articleDetail =ArticleDetail::findOne(['article_id'=>$article->id]);
//        找出文章表对象
//        $articleDetail=new ArticleDetail();
        $request=\Yii::$app->request;
//        var_dump($request->post('ArticleDetail'));exit;
        if($article->load($request->post())){
            $article->save();
            if($articleDetail->load($request->post())){
                $articleDetail->article_id=$article->id;
                $articleDetail->save();
                \Yii::$app->session->setFlash("success",'添加文章成功');
                return $this->redirect(['article/index']);
            }
        }
//        得到所有分类
        $cates=ArticleCate::find()->all();
        $options=ArrayHelper::map($cates,'id','name');
        return $this->render('add',['article'=>$article,'options'=>$options,'articleDetail'=>$articleDetail]);
    }

    /**
     * 删除文章
     * @param $id
     * @return string
     */
    public function actionDel($id)
    {
        if(Article::findOne($id)->delete()){
            if (!ArticleDetail::findOne(["article_id"=>$id])) {
                \Yii::$app->session->setFlash("success","删除文章成功");
                return $this->redirect(['article/index']);
            }
            ArticleDetail::findOne(["article_id"=>$id])->delete();
            \Yii::$app->session->setFlash("success","删除文章成功");
            return $this->redirect(['article/index']);
        }
    }

    /**
     * 列表详情
     * @param $id
     * @return string
     */
    public function actionList($id)
    {
        $article=Article::findOne($id);
        $articleDetail=ArticleDetail::findOne(["article_id"=>$id]);
        return $this->render('list', [ 'article' => $article,'articleDetail'=>$articleDetail]);
    }

    /**
     * 加入回收站
     * @param $id
     */
    public function actionDell($id)
    {
        if(Article::updateAll(['status'=>0],['id'=>$id])){
            \Yii::$app->session->setFlash("success", "加入回收站成功");
            $this->redirect(['article/index']);
        }
    }

    /**
     * 显示回收站
     * @return string
     */
    public function actionDisplay()
    {
        $articles=Article::find()->where(['status'=>'0'])->all();
        return $this->render('recycle', ['articles' => $articles]);
    }

    /**
     * 还原文章
     * @param $id
     * @return \yii\web\Response
     */
    public function actionReduction($id)
    {
        if(Article::updateAll(['status'=>1],['id'=>$id])){
            \Yii::$app->session->setFlash("success", "还原成功");
            return $this->redirect(['article/index']);
        }
    }
}
