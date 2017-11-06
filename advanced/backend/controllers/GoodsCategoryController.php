<?php

namespace backend\controllers;

use backend\models\GoodsCategory;
use yii\data\ActiveDataProvider;
use yii\widgets\Menu;

class GoodsCategoryController extends \yii\web\Controller
{
    /**
     * 列表显示
     * @return string
     */
    public function actionIndex()
    {
        $goodsCates=GoodsCategory::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $goodsCates,
            'pagination' => false,
        ]);
        return $this->render('index',['dataProvider' => $dataProvider]);
    }

    /**
     * 添加商品分类
     */
    public function actionAdd()
    {
        $model=new GoodsCategory();
        $request=\Yii::$app->request;
        if($request->isPost){
//            数据绑定
            $model->load($request->post());
            if($model->validate()){
//                判断父ID是不是0，是0创建根目录
                if($model->parent_id==0){
//                  创建根目录
                    $model->makeRoot();
                }else{
//                    创建子节点
//                    先找出父节点
                    $cateParent=GoodsCategory::findOne(['id'=>$model->parent_id]);
//                    把当前对象添加到父类对象中
                    $model->prependTo($cateParent);
                }
                \Yii::$app->session->setFlash('success','添加目录成功');
                return $this->redirect(['goods-category/index']);
            }
        }
//        得到所有分类
        $cates=GoodsCategory::find()->asArray()->all();
//        创建顶级分类
        $cates[]=['id'=>0,'parent'=>0,'name'=>'顶级分类'];
//        返回json
        $cates=json_encode($cates);
        return $this->render('add',['model'=>$model,'cates'=>$cates]);
    }

    /**
     * 编辑商品分类
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        //查询该节点下是否有子类
        $cates=GoodsCategory::find()->where(['parent_id'=>$id])->all();
//            var_dump($cates);exit;
        if(!empty($cates)){
            \Yii::$app->session->setFlash('success','该节点下有子类，不能移动');
            return $this->redirect(['goods-category/index']);
        }
//        $model=new GoodsCategory();
        $model=GoodsCategory::findOne($id);
        $request=\Yii::$app->request;
        if($request->isPost){
            $a=$request->post('GoodsCategory');
            //修改到分类的ID
            $cate=$a['parent_id'];
            //通过ID找到深度
            $depth_a=GoodsCategory::findOne($cate)->depth;
            //准备修改数据的深度
            $depth_b=$model->depth;
            if($depth_b<=$depth_a){
               \Yii::$app->session->setFlash('success','不能修改到同类和子类中');
               return $this->redirect(['goods-category/index']);
            }
            GoodsCategory::findOne(['id'=>$request->post()->parent_id]);
//            数据绑定
            $model->load($request->post());
//            var_dump($model);exit;
            if($model->validate()){
                $model->save();
                \Yii::$app->session->setFlash('success','添加目录成功');
                return $this->redirect(['goods-category/index']);
            }
        }
//        得到所有分类
        $cates=GoodsCategory::find()->asArray()->all();
//        创建顶级分类
        $cates[]=['id'=>0,'parent'=>0,'name'=>'顶级分类'];
//        返回json
        $cates=json_encode($cates);
        return $this->render('add',['model'=>$model,'cates'=>$cates]);
    }

    /**
     * 删除商品分类
     */
    public function actionDel($id)
    {
        $cates=GoodsCategory::find()->where(['parent_id'=>$id])->all();
        $model=GoodsCategory::findOne($id);
        if($cates){
            \Yii::$app->session->setFlash('danger','该目录下有子目录');
        }else{
                if($model->parent_id == 0 ){
                    \Yii::$app->session->setFlash('success','该目录为根结点不能被删除');
                }else{
                    $model->delete();
                    \Yii::$app->session->setFlash('danger','删除成功');
                }
//            var_dump($model);die();
        }
        return $this->redirect(['goods-category/index']);

    }


    /**
     * 测试
     */
    public function actionTest()
    {
//        创建对象
        $cate = new GoodsCategory();
//        给对象赋值
        $cate->name='服装';
        $cate->parent_id=0;
//        创建节点
        $cate->makeRoot();
        var_dump($cate->getErrors());
    }

    /**
     * 测试
     */
    public function actionAddChild()
    {
//        创建对象
        $cate = new GoodsCategory();
        $cate->name='安踏';
        $cate->parent_id=1;
//        找出服装分类对象
        $cateParent=GoodsCategory::findOne(['id'=>$cate->parent_id]);
//        把儿子分类加入到当前分类
        $cate->prependTo($cateParent);
        var_dump($cate->getErrors());
    }
}
