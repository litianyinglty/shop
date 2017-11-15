<?php

namespace backend\controllers;

use backend\models\GoodsCategory;
use PHPUnit\Runner\Exception;
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
//                    var_dump($cateParent->depth);exit;
//                    找出父节点一级的深度大于2就不再添加
                    if($cateParent->depth > 2){
                        \Yii::$app->session->setFlash('danger','该节点下不能再添加目录');
                        return $this->refresh();
                    }else{
//                  把当前对象添加到父类对象中
                        $model->prependTo($cateParent);
                    }
                }
                \Yii::$app->session->setFlash('success','添加目录成功');
                return $this->refresh();
                //return $this->redirect(['goods-category/index']);
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
//        $model=new GoodsCategory();
        $model=GoodsCategory::findOne($id);
        $request=\Yii::$app->request;
        if($request->isPost){
//          查询该节点下是否有子类
            $cates=GoodsCategory::find()->where(['parent_id'=>$id])->all();
//            var_dump($cates);exit;
            if(!empty($cates)){
                \Yii::$app->session->setFlash('danger','该节点下有子类不能移动');
//                直接刷新页面
                $model->refresh();
//                return $this->redirect(['goods-category/index']);
            }
            $a=$request->post('GoodsCategory');
//            var_dump($a);exit;
            //修改到分类的ID
            $cate=$a['parent_id'];
//            var_dump($cate);exit;
            //通过ID找到深度
            $depth_a=GoodsCategory::findOne($cate)->depth;
            //准备修改数据的深度
            $depth_b=$model->depth;
//            var_dump($depth_b);exit;
            if($depth_b<=$depth_a){
               \Yii::$app->session->setFlash('danger','不能修改到同类和子类中');
               $model->refresh();
//               return $this->redirect(['goods-category/edit','id'=>$id]);
            }
            GoodsCategory::findOne(['id'=>$request->post()->parent_id]);
//            数据绑定
            $model->load($request->post());
//            var_dump($model);exit;
            if($model->validate()){
//                抛出异常
                try{
                    if($model->parent_id==0){
                        $model->save();
                    }else{
//                    创建子节点
//                    先找出父节点
                        $cateParent=GoodsCategory::findOne(['id'=>$model->parent_id]);
//                    把当前对象添加到父类对象中
                        $model->prependTo($cateParent);
                    }
//                    异常捕获
                }catch (\yii\db\Exception $e){
//                    var_dump($e->getMessage());exit;
                    \Yii::$app->session->setFlash('danger',$e->getMessage());
                    return $model->refresh();
                }
            }
            \Yii::$app->session->setFlash('success','编辑目录成功');
//                return $this->refresh();
            return $this->redirect(['goods-category/index']);
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
//        $model->deleteWithChildren();
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
