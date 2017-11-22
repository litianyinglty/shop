<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/19 0019
 * Time: 16:08
 */

namespace frontend\controllers;


use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsGallery;
use frontend\models\Cart;
use yii\web\Cookie;

class HomeController extends BaseController
{
    /**
     * 首页
     * @return string
     */
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

    /**
     * 显示列表页
     * @param $id
     * @return string
     */
    public function actionList($id)
    {
//        当前分类
            $cate=GoodsCategory::findOne($id);
//        1、得到包括当前分类及所有子分类 所有的子分类的左值比当前分类的左值大，右值小
            $cates=GoodsCategory::find()->where(['tree'=>$cate->tree])->andWhere(['>=','lft',$cate->lft])->andWhere(['<=','rgt',$cate->rgt])->asArray()->all();
//        2、把这些分类的ID提取出来
            $catesId=array_column($cates,'id');
//        3、查询商品的分类ID在上面查询出来的ID对应的商品
            $goods=Goods::find()->where(['in','category_id',$catesId])->all();
        return $this->renderPartial('list',compact('goods'));
    }

    /**
     * 商品详情
     * @param $id
     * @return string
     */
    public function actionDetail($id)
    {
        $good=Goods::findOne($id);
        $brand=Brand::findOne(['id'=>$good->brand_id]);
        $category=GoodsCategory::findOne(['id'=>$good->category_id]);
        $gallerys=GoodsGallery::find()->where(['goods_id'=>$good->id])->all();
        return $this->renderPartial('detail',compact('good','brand','category','gallerys'));
    }

    /**
     * 保存购物车商品
     * @param $goodsId
     * @param $num
     * @return string
     */
    public function actionAddCart($goodsId,$num)
    {
//        判断商品是否存在
        if(Goods::findOne($goodsId)===null){
            return $this->redirect(['home/index']);
        }
//        1、判断有没有登陆
        if(\Yii::$app->user->isGuest){
//            未登录保存到cookie 数据按$cate=[$goodsId=>$num]格式进行存取
//            2、获得购物车数据
            $getCookie=\Yii::$app->request->cookies;
//            三元判断，开始是否有cookie存在，没有设置为[]
            $cartOld=$getCookie->has('cart')?$getCookie->getValue('cart'):[];
//            判断goodsId是否存在
//            isset($cartOld[$goodsId])
            if(key_exists($goodsId,$cartOld)){
//                如果有，执行加操作
                $cartOld[$goodsId]+=$num;
            }else{
//                如果没有，执行追加操作
                $cartOld[$goodsId]=$num;
            }
//            1.2、设置cookie
            $setCookie=\Yii::$app->response->cookies;
//            1.3、生成cookie对象
            $cartCookie=new Cookie([
                'name'=>'cart',
                'value'=>$cartOld,
                'expire'=>time()+3600*24*7,
            ]);
//            1.4、把cookie对象添加到cookie里
            $setCookie->add($cartCookie);
        } else {
//              已登录 数据库
            $memberId=\Yii::$app->user->id;
//              通过用户ID和商品ID查出购物车数据
            $cart=Cart::find()->where(['goods_id'=>$goodsId,'member_id'=>$memberId])->one();
//            var_dump($cart);exit;
//              判断不存在
            if ($cart===null){
                //执行添加操作
                $cart=new Cart();
                $cart->goods_id=$goodsId;
                $cart->member_id=$memberId;
                $cart->amount=$num;
            }else{
                $cart->amount+=$num;
            }
            //保存
            $cart->save();
        }
        return $this->redirect(['cart']);
    }

    /**
     * 显示购物车商品
     * @return string
     */
    public function actionCart()
    {
//        判断是否登陆
        if(\Yii::$app->user->isGuest){
//            1、没有登陆，在cookie中取得
//            操作cookie
            $getCookie=\Yii::$app->request->cookies;
//            2、得到购物车数据
            $carts=$getCookie->has('cart')?$getCookie->getValue('cart'):[];
//            判断得到的商品存在才循环
//                  定义一个空数组
                    $goods=[];
//                  循环购物车所有商品
                    foreach ($carts as $goodsId=>$num){
                        $good=Goods::find()->where(['id'=>$goodsId])->asArray()->one();
                        $good['num']=$num;
//                      将一维数组转换成二维数组
                        $goods[]=$good;
                    }
            }else{
//                得到当前用户
            $memberId=\Yii::$app->user->id;
            $carts=Cart::find()->where(['member_id'=>$memberId])->all();
//            var_dump($carts);exit;
            $goods=[];
//            循环得到商品信息
            foreach ($carts as $k=>$v){
//                var_dump($v['amount']);exit;
                $good=Goods::find()->where(['id'=>$v['goods_id']])->asArray()->one();
//                var_dump($good);exit;
                $good['num']=$v['amount'];
                $goods[]=$good;
            }
        }
        return $this->renderPartial('cart',compact('goods'));
    }

    /**
     * 专门用来处理ajax
     */
    public function actionAjax($type)
    {
        switch ($type){
            case "changeCart":
                $request=\Yii::$app->request;
//              接受参数
                $id=$request->post('id');
                $num=$request->post('num');
//                var_dump($id,$num);exit;
//              如果没有登陆
                if(\Yii::$app->user->isGuest){
                    $getCookie=\Yii::$app->request->cookies;
//              取出cookie
                    $cart=$getCookie->getValue('cart');
                    $cart[$id]=$num;
                    $setCookie=\Yii::$app->response->cookies;
                    $cartCookie=new Cookie([
                        'name'=>'cart',
                        'value'=>$cart,
                        'expire'=>time()+3600*24*7,
                    ]);
                    $setCookie->add($cartCookie);
                }else{
                    $memberId=\Yii::$app->user->id;
                    $num=$request->post('num');
                    $cart=Cart::find()->where(['goods_id'=>$id,'member_id'=>$memberId])->one();
                    $cart->amount=$num;
                    $cart->save();
                }
                break;
//                如果是删除，执行删除操作
            case "del":
//              接收参数
                $request=\Yii::$app->request;
//              接受参数
                $id=$request->post('id');
//                判断是否登录,未登录
                if(\Yii::$app->user->isGuest){
                    (new \frontend\components\Cart())->del($id)->save();
                }else{
                    $memberId=\Yii::$app->user->id;
//                    已登录
                    $cart=Cart::find()->where(['goods_id'=>$id,'member_id'=>$memberId])->one();
//                    var_dump($cart);exit;
                    $cart->delete();
                }
                return "success";
                break;
        }
    }

    public function actionText()
    {
        $getCookie=\Yii::$app->request->cookies;
        var_dump($getCookie->getValue('cart'));exit();
    }
}