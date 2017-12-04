<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/23 0023
 * Time: 22:07
 */

namespace console\controllers;


use yii\console\Controller;
use frontend\models\Order;
use frontend\models\OrderDetail;
use yii\helpers\ArrayHelper;
use backend\models\Goods;

class OrderController extends Controller
{
    public function actionFlash()
    {
        while (true){
//        1、找出所有超时的订单
//        首先条件是状态，未付款的
//        超时的    15分钟   time()-15*60>create_dt
            $orders=Order::find()->where(['status'=>1])->andWhere(['<','create_at',time()-900])->all();
//        var_dump($orders);exit;
//        2、修改状态
//        2、1得到订单所有ID
            $ordersIds=ArrayHelper::map($orders,'id','id');
//        var_dump($ordersId);exit;
//        2、2更新所有订单状态为0，已取消
            $ordersSave=Order::updateAll(['status'=>0],['in','id',$ordersIds]);
//        var_dump($orders);exit;
//        查询所有的库存
//        3、把库存给加回去,判断成功执行下面操作
            if($ordersSave){
//            3、1循环订单ID
                foreach ($ordersIds as $ordersId){
//                3、2找出当前订单所有商品信息
                    $orderDetails=OrderDetail::find()->where(['order_info_id'=>$ordersId])->all();
//                3、3循环商品
                    foreach ($orderDetails as $orderDetail){
                        Goods::updateAllCounters(['stock'=>$orderDetail->amount],['id'=>$orderDetail->goods_id]);
                    }
                }
            }
            if($ordersIds){
                echo implode(',',$ordersIds).'order has been completeiy'.PHP_EOL;
            }
            sleep(60);
        }
    }
}