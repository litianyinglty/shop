<?php

namespace backend\controllers;

use backend\models\Brand;
use flyok666\qiniu\Qiniu;
use yii\data\Pagination;
use yii\web\UploadedFile;

class BrandController extends \yii\web\Controller
{
    /**
     * 商品列表
     * @return string
     */
    public function actionIndex()
    {
        //分页
//        1、总页数
        $count=Brand::find()->where(['!=','status','-1'])->count();
//        2、每页显示条数
        $pageSize=5;
//        3、创建分页对象
        $page=new Pagination([
            'pageSize'=>$pageSize,
            'totalCount'=>$count,
        ]);
        $brands=Brand::find()->where(['!=','status','-1'])->limit($page->limit)->offset($page->offset)->all();
        return $this->render('index',['brands'=>$brands,'page'=>$page]);
    }

    /**
     * 添加品牌
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $brand=new Brand();
        $request=\Yii::$app->request;
        if($brand->load($request->post())){
            if($brand->validate()){
//                赋值给数据表的字段
                $brand->save();
                \Yii::$app->session->setFlash("success",'添加商品成功');
                return $this->redirect(['brand/index']);
            }
        }
        $brand->status=1;
        $brand->sort=100;
        return $this->render("add",['brand'=>$brand]);
    }

    /**
     * 编辑品牌
     * @return string|\yii\web\Response
     */
    public function actionEdit($id)
    {
        $brand=Brand::findOne($id);
        $img=$brand->logo;
        if($brand->status=="1") {
            $request = \Yii::$app->request;
            if ($brand->load($request->post())) {
                if ($brand->validate()) {
//                赋值给数据表的字段
                    $brand->save();
                    \Yii::$app->session->setFlash("success", '编辑商品成功');
                    return $this->redirect(['brand/index']);
                }
            }
        }
        return $this->render("add",['brand'=>$brand]);
    }

    /**
     * 删除品牌
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDel($id)
    {
        $brand=Brand::findOne($id);
        if(substr($brand->logo,0,7)=="http://"){
            $qiNiu=new Qiniu($config = [
                'accessKey'=>'Hy-VyRINX9t6kU2TNURfGP1TYs6Xc0E_eg2lh81F',                      'secretKey'=>'kUU1g3oltnhBSR_knK7sDhrRUyYZWZ9gmP3GPhRd',
                'domain'=>'http://oyvirytup.bkt.clouddn.com/',
                'bucket'=>'yii2shop',
                'area'=>Qiniu::AREA_HUANAN
            ]);
            $key=substr($brand->logo,-10);
            $qiNiu->delete($key,'yii2shop');
            $brand->delete();
        }else{
            $brand->delete();
        }
        \Yii::$app->session->setFlash("success","删除成功");
        return $this->redirect(['brand/index']);
    }

    /**
     * 加入回收站
     * @param $id
     * @return \yii\web\Response
     */
    public function actionReclaim($id)
    {
        if (Brand::updateAll(['status' => -1],['id' => $id])) {
            \Yii::$app->session->setFlash("success", "加入回收站成功");
            return $this->redirect(['brand/index']);
        }
    }

    /**
     * 显示回收站
     * @return string
     */
    public function actionRecycle()
    {
        $brands=Brand::find()->where(['status'=>"-1"])->all();
        return $this->render('recycle',['brands'=>$brands]);
    }

    /**
     * 还原品牌
     * @param $id
     * @return \yii\web\Response
     */
    public function actionReduction($id)
    {
        if (Brand::updateAll(['status' => 1], ['id' => $id])) {
            \Yii::$app->session->setFlash("success", "还原成功");
            return $this->redirect(['brand/recycle']);
        }
    }

    /**
     * 上传图片到七牛云
     */
    public function actionUpload()
    {
        //var_dump($_FILES['file']['tmp_name']);exit;
//        配置
        $config = [
            'accessKey'=>'Hy-VyRINX9t6kU2TNURfGP1TYs6Xc0E_eg2lh81F',                      'secretKey'=>'kUU1g3oltnhBSR_knK7sDhrRUyYZWZ9gmP3GPhRd',
            'domain'=>'http://oyvirytup.bkt.clouddn.com/',
            'bucket'=>'yii2shop',
            'area'=>Qiniu::AREA_HUANAN
        ];
//        实例化对象
        $qiniu = new Qiniu($config);
        $key = time();
//        调用上传方法
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
     * 删除七牛云图片
     */
//    public function actionDelQi()
//    {
//        $qiNiu=new Qiniu($config = [
//            'accessKey'=>'Hy-VyRINX9t6kU2TNURfGP1TYs6Xc0E_eg2lh81F',                      'secretKey'=>'kUU1g3oltnhBSR_knK7sDhrRUyYZWZ9gmP3GPhRd',
//            'domain'=>'http://oyvirytup.bkt.clouddn.com/',
//            'bucket'=>'yii2shop',
//            'area'=>Qiniu::AREA_HUANAN
//        ]);
//        $qiNiu->delete('','yii2shop');
//    }
}
