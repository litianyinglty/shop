<?php

namespace frontend\controllers;

use backend\models\Goods;
use frontend\models\Address;
use frontend\models\Cart;
use frontend\models\Order;
use frontend\models\OrderDetail;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use EasyWeChat\Foundation\Application;

class OrderController extends \yii\web\Controller
{
    /**
     * 提交订单
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
//        结算时未登录跳登录页面
        if(\Yii::$app->user->isGuest){
            return $this->redirect(['member/login','backurl'=>Url::to(['/home/cart'])]);
        }
        $memberId=\Yii::$app->user->id;
        $addresss=Address::find()->where(['member_id'=>$memberId])->all();
        $carts=Cart::find()->where(['member_id'=>$memberId])->all();
        $goods=[];
//        总价
        $totalPrice=0;
        foreach ($carts as $cart){
            $good=Goods::find()->where(['id'=>$cart->goods_id])->asArray()->one();
            $good['num']=$cart->amount;
            $totalPrice+=$good['shop_price']*$good['num'];
            $goods[]=$good;
        }
        $request=\Yii::$app->request;
        if($request->isPost){
            $db = \Yii::$app->db;
//            开启事务
            $transaction = $db->beginTransaction();
            try {
//            事务执行语句
                $deliveryId=$request->post('delivery_id');
                $payId=$request->post("pay_id");
//            得到配送方式名字
                $deliveryName=ArrayHelper::map(\Yii::$app->params['delivers'],'id','name');
//            得到费送运费
                $deliveryPrice=ArrayHelper::map(\Yii::$app->params['delivers'],'id','price');
//            得到支付方式名字
                $payName=ArrayHelper::map(\Yii::$app->params['payType'],'id','name');
//            查出地址
                $address=Address::findOne($request->post("address_id"));
//            添加order表
                $order=new Order();
                $order->member_id=$memberId;
                $order->name=$address->name;
                $order->province=$address->province;
                $order->city=$address->city;
                $order->district=$address->county;
                $order->address=$address->address;
                $order->tel=$address->tel;
                $order->delivery_id=$deliveryId;
                $order->delivery_name=$deliveryName[$deliveryId];
                $order->pay_type_id=$payId;
                $order->pay_name=$payName[$payId];
                $order->delivery_price=$deliveryPrice[$deliveryId];
                $order->price=$totalPrice+$order->delivery_price;
                $order->status=1;
                $order->trade_no=date("YmdHis").rand(1000,9999);
                $order->save();
//              添加order_detail表
                foreach ($goods as $good){
                    $goodsModel=Goods::findOne($good['id']);
//                    判断库存是否足够
                    if($good['num']>$goodsModel->stock){
//                        抛出异常
                        throw new Exception("库存不足，请重新下单");
                    }
                    $orderDetail=new OrderDetail();
//                  订单ID
                    $orderDetail->order_info_id=$order->id;
                    $orderDetail->goods_id=$good['id'];
                    $orderDetail->goods_name=$good['name'];
                    $orderDetail->logo=$good['logo'];
                    $orderDetail->price=$good['shop_price'];
                    $orderDetail->amount=$good['num'];
                    $orderDetail->total_price=$good['shop_price']*$good['num'];
                    $orderDetail->save();
//                    减商品库存
                    $goodsModel->stock-=$good['num'];
                    $goodsModel->save();
                }
//              清空购物车
                Cart::deleteAll(['member_id'=>$memberId]);
                // ... executing other SQL statements ...
//              提交事务
                $transaction->commit();
                switch ($payId){
                    case '1':
                        break;
                    case '2':
                        return $this->redirect(['flow','orderId'=>$order->id]);
                        break;
                    case '3':
                        break;
                }
//              捕获异常
            } catch(Exception $e) {
//              事务回滚
                $transaction->rollBack();
                echo "<script>alert('".$e->getMessage()."')</script>";
//                throw $e;
            }
        }
        return $this->renderPartial('index',compact('addresss','goods','totalPrice'));
    }

    /**
     * 支付及生成二维码
     * @param $orderId
     * @return string|void
     */
    public function actionPay($orderId)
    {
//        查询当前订单
        $orderModel = Order::findOne($orderId);
        $orderDetails = OrderDetail::find()->where(['order_info_id' => $orderId])->all();
//        var_dump($orderDetails);exit;
        $orderDetails = array_column($orderDetails, 'goods_name');
//        var_dump($orderDetails[0]);exit;
        $app = new Application(\Yii::$app->params['wechatOption']);
        $payment = $app->payment;
        $attributes = [
            'trade_type' => 'NATIVE', // JSAPI，NATIVE，APP...
            'body' => '商城订单',  //商品描述
            'detail' => $orderDetails[0].'...',  //商品详情
            'out_trade_no' => $orderModel->trade_no, //订单号
            'total_fee' => 1, // 单位：分$orderModel->price * 100
            'notify_url' => Url::to(['success'], true), // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            //'openid' => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
        ];
//        生成订单
        $order = new \EasyWeChat\Payment\Order($attributes);
//        调用微信接口统一下单
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            $prepayId = $result->prepay_id;
            header('Content-Type: image/png');
//            var_dump($result);exit;
            \dosamigos\qrcode\QrCode::png($result->code_url,false,3,6);
        }
    }

    /**
     * 订单成功页面
     * @param $orderId
     * @return string
     */
    public function actionFlow($orderId)
    {
        return $this->renderPartial('flow',['orderId'=>$orderId]);
    }

    /**
     * 支付处理
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function actionSuccess()
    {
        $app = new Application(\Yii::$app->params['wechatOption']);
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
//            $order = 查询订单($notify->out_trade_no);
//            查询当前订单是否存在
            $order=Order::find()->where(['trade_no'=>$notify->out_trade_no])->one();
            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->paid_at) { // 假设订单字段“支付时间”不为空代表已经支付,如果不是代付款说明已经操作了
                return true; // 已经支付成功了就不再更新了
            }
            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                //$order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 2; //支付成功状态
            } else { // 用户支付失败
                $order->status = 'paid_fail';
            }
            $order->save(); // 保存订单
            return true; // 返回处理完成
        });
        return $response;
    }
}
