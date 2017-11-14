<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsDayCount;
use backend\models\GoodsGallery;
use backend\models\GoodsIntro;
use backend\models\SearchForm;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use flyok666\qiniu\Qiniu;
use common\components\Upload;
use yii\helpers\Json;


class GoodsController extends \yii\web\Controller
{

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }
    /**
     * 列表显示
     * @return string
     */
    public function actionIndex()
    {
//        关键字搜索
//        首先构造查询对象
        $query=Goods::find()->where(['status'=>1]);
        $request=\Yii::$app->request;
//        原生HTML表单接收值
        $keyword=$request->get('keyword');
        $minPrice=$request->get('minPrice');
        $maxPrice=$request->get('maxPrice');
//        $status=$request->get('status');
//      表单生成接收变量值
//        $requests=$request->get("SearchForm");
//        $keyword=$requests["keyword"];
//        $minPrice=$requests['minPrice'];
//        $maxPrice=$requests['maxPrice'];
//        判断最低价是否大于0，表示输了值
        if($minPrice>0){
//            拼接条件
            $query->andWhere("shop_price >= {$minPrice}");
        }
//        判断最高价是否大于0
        if($maxPrice>0){
//            拼接条件
            $query->andWhere("shop_price <= {$maxPrice}");
        }
//        判断关键字
        if(!empty($keyword)){
//            拼接条件
            $query->andWhere("name like '%{$keyword}%' or sn like '%{$keyword}%'");
        }
//        if($status==='1' && $status==='0'){
//            $query->andWhere("status = {$status}");
//        }
//        分页总条数
        $count=$query->count();
//        每页显示条数
        $pageSize=2;
        $page=new Pagination([
            'pageSize'=>$pageSize,
            'totalCount'=>$count,
        ]);
        $goods=$query->limit($page->limit)->offset($page->offset)->all();
        return $this->render('index',['goods'=>$goods,'page'=>$page]);
    }

    /**
     * 添加商品
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $good=new Goods();
        $goodIntro=new GoodsIntro();
        $goodGallery=new GoodsGallery();
        $request=\Yii::$app->request;
        if($request->isPost){
                $time=date('Ymd',time());
//            找到今日商品数
                $count=GoodsDayCount::findOne(['day'=>$time]);
//                var_dump($one);exit;
//            判断今日商品数是否为空
                if(empty($count)){
                    $goodDayCount=new GoodsDayCount();
                    $goodDayCount->day=$time;
                    $goodDayCount->count=1;
                    $goodDayCount->save();
                    $sn=$time.'00001';
                }else{
//                    0填充
//                    $sn=sprintf("%05d",1);
//                    给今日商品加1
//                    GoodsDayCount::updateAllCounters(['count'=>1,'day'=>$time]);
                    $sn=$count->count+1;
                    $sn=$time.substr("0000".$sn,-5);
                    $count->count=$count->count+1;
                    $count->save();
                }
            if($good->load($request->post()) && $good->validate()){
                    $good->sn=$sn;
                    $good->save();
            }
            if($goodIntro->load($request->post()) && $goodIntro->validate()){
                $goodIntro->goods_id=$good->id;
                $goodIntro->save();
            }
            $images=$request->post()['Goods']['images'];
//            var_dump($goodGallery);exit;
            foreach ($images as $img){
                $goodGallery=new GoodsGallery();
                $goodGallery->goods_id=$good->id;
                $goodGallery->path=$img;
                $goodGallery->save();
            }
            \Yii::$app->session->setFlash('success','添加商品成功');
            return $this->redirect(['goods/index']);
        }

        $good->is_online=1;
        $good->status=1;
//        得到所有商品分类
        $cates=GoodsCategory::find()->orderBy('tree,lft')->all();
//        $cates=json_encode($cates);
        $options=ArrayHelper::map($cates,'id','nameText');
//        得到所有品牌
        $brands=Brand::find()->all();
        $brandsAll=ArrayHelper::map($brands,'id','name');
        return $this->render('add',['good'=>$good,'options'=>$options,'brandsAll'=>$brandsAll,'goodIntro'=>$goodIntro,'goodGallery'=>$goodGallery]);
    }

    /**
     * 七牛云上传图片
     */
    public function actionQiNiu()
    {
//        var_dump($_FILES['file']['tmp_name']);exit;
        $config = [
            'accessKey'=>'Hy-VyRINX9t6kU2TNURfGP1TYs6Xc0E_eg2lh81F',
            'secretKey'=>'kUU1g3oltnhBSR_knK7sDhrRUyYZWZ9gmP3GPhRd',
            'domain'=>'http://oyvirytup.bkt.clouddn.com/',
            'bucket'=>'yii2shop',
            'area'=>Qiniu::AREA_HUANAN
        ];
        $qiniu = new Qiniu($config);
        $key = microtime(true);
        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
        $url = $qiniu->getLink($key);
        $info=[
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url,
            ];
        exit(json_encode($info));
    }

    /**
     * 编辑商品
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $good=Goods::findOne($id);
        $goodIntro=GoodsIntro::findOne(['goods_id'=>$id]);
        $goodGallery=GoodsGallery::find()->where(['goods_id'=>$id])->all();
        foreach ($goodGallery as $goodCallery){
            $good->images[]=$goodCallery->path;
        }
        $request=\Yii::$app->request;
        if($request->isPost){
            if($good->load($request->post()) && $good->validate()){
                $good->save();
            }
            if($goodIntro->load($request->post()) && $goodIntro->validate()){
                $goodIntro->goods_id=$good->id;
                $goodIntro->save();
            }
//            删除数据库所有相册图片
            GoodsGallery::deleteAll(['goods_id'=>$good->id]);
            $goodGallery=$request->post()['Goods']['images'];
//            var_dump($goodGallery);exit;
            foreach ($goodGallery as $img){
                $goodGallery=new GoodsGallery();
                $goodGallery->goods_id=$good->id;
                $goodGallery->path=$img;
                $goodGallery->save();
            }
            \Yii::$app->session->setFlash('success','编辑商品成功');
            return $this->redirect(['goods/index']);
        }
//        得到所有商品分类
        $cates=GoodsCategory::find()->orderBy('tree,lft')->all();
        $options=ArrayHelper::map($cates,'id','nameText');
//        $cates=GoodsCategory::find()->asArray()->all();
//        $cates=json_encode($cates);
//        得到所有品牌
        $brands=Brand::find()->all();
        $brandsAll=ArrayHelper::map($brands,'id','name');
        return $this->render('add',['good'=>$good,'options'=>$options,'brandsAll'=>$brandsAll,'goodIntro'=>$goodIntro,'goodGallery'=>$goodGallery]);
    }

    /**
     * 列表详情
     * @param $id
     * @return string
     */
    public function actionList($id)
    {
        $good=Goods::findOne($id);
        $goodIntro=GoodsIntro::findOne(['goods_id'=>$id]);
        $callerys=GoodsGallery::find()->where(['goods_id'=>$id])->all();
        return $this->render('list',['good'=>$good,'goodIntro'=>$goodIntro,'callerys'=>$callerys]);
    }

    /**
     * 加入回收站
     * @param $id
     */
    public function actionRecycle($id)
    {
        if(Goods::updateAll(['status'=>0,'is_online'=>0],['id'=>$id])){
            \Yii::$app->session->setFlash('success','加入回收站成功');
            return $this->redirect(['goods/index']);
        }
    }

    /**
     * 回收站还原
     * @param $id
     * @return \yii\web\Response
     */
    public function actionReduction($id)
    {
        if(Goods::updateAll(['status'=>1,'is_online'=>1],['id'=>$id])){
            \Yii::$app->session->setFlash('success','还原成功');
            return $this->redirect(['goods/reductions','id'=>$id]);
        }
    }

    /**
     * 显示回收站
     */
    public function actionReductions()
    {
        $goods=Goods::find()->where(['status'=>0])->all();
        return $this->render('accord',['goods'=>$goods]);
    }

    /**
     * 删除商品及七牛云图片信息
     * @param $id
     */
    public function actionDel($id)
    {
        $good=Goods::findOne($id);
        $goodIntro=GoodsIntro::findOne(['goods_id'=>$id]);
        $goodsDayCount=GoodsDayCount::findOne(['day'=>substr($good->sn,0,8)]);
//        var_dump($goodsDayCount->count);exit;
        $goodsGallerys=GoodsGallery::find()->where(['goods_id'=>$id])->all();
        foreach ($goodsGallerys as $goodsGallery) {
        $config = [
            'accessKey' => 'Hy-VyRINX9t6kU2TNURfGP1TYs6Xc0E_eg2lh81F',
            'secretKey' => 'kUU1g3oltnhBSR_knK7sDhrRUyYZWZ9gmP3GPhRd',
            'domain' => 'http://oyvirytup.bkt.clouddn.com/',
            'bucket' => 'yii2shop',
            'area' => Qiniu::AREA_HUANAN
        ];
        $key = substr($goodsGallery->path, -10);
        $qiNiu = new Qiniu($config);
        $qiNiu->delete($key);
        }
            $config = [
                'accessKey' => 'Hy-VyRINX9t6kU2TNURfGP1TYs6Xc0E_eg2lh81F',
                'secretKey' => 'kUU1g3oltnhBSR_knK7sDhrRUyYZWZ9gmP3GPhRd',
                'domain' => 'http://oyvirytup.bkt.clouddn.com/',
                'bucket' => 'yii2shop',
                'area' => Qiniu::AREA_HUANAN
            ];
            $key = substr($good->logo, -10);
            $qiNiu = new Qiniu($config);
            $qiNiu->delete($key);
            $goodIntro->delete();
            foreach ($goodsGallerys as $goodsGallery){
                $goodsGallery->delete();
            }
            $goodsDayCount->count=$goodsDayCount->count-1;
            if($goodsDayCount->count==0){
                $goodsDayCount->delete();
            }else{
                $goodsDayCount->save();
            }
            $good->delete();
        \Yii::$app->session->setFlash('success','删除信息成功');
        return $this->redirect(['goods/index']);
    }

    /**
     * 图片上传
     */
//    public function actionUpload()
//    {
//        try {
//            $model = new Upload();
//            $info = $model->upImage();
//            $info && is_array($info) ?
//                exit(Json::htmlEncode($info)) :
//                exit(Json::htmlEncode([
//                    'code' => 1,
//                    'msg' => 'error'
//                ]));
//        } catch (\Exception $e) {
//            exit(Json::htmlEncode([
//                'code' => 1,
//                'msg' => $e->getMessage()
//            ]));
//        }
//    }
}
