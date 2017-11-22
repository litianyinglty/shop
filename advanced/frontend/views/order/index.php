<?php
/* @var $this yii\web\View */
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
      xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>填写核对订单信息</title>
    <link rel="stylesheet" href="/style/base.css" type="text/css">
    <link rel="stylesheet" href="/style/global.css" type="text/css">
    <link rel="stylesheet" href="/style/header.css" type="text/css">
    <link rel="stylesheet" href="/style/fillin.css" type="text/css">
    <link rel="stylesheet" href="/style/footer.css" type="text/css">

    <script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/js/cart2.js"></script>

</head>
<body>
<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w990 bc">
        <div class="topnav_left">

        </div>
        <div class="topnav_right fr">
            <ul>
                <li><?php
                    if(Yii::$app->user->isGuest){
                        echo '您好，欢迎来到京西！';
                        echo '<li>'.\yii\helpers\Html::a("登录",['member/login']).'</li>';
                        echo '<li class="line">|</li>';
                        echo '<li>'.\yii\helpers\Html::a("免费注册",['member/reg']).'</li>';
                    }else{
                        echo '您好，欢迎来到京西！';
                        echo '欢迎--'.\yii\helpers\Html::a(Yii::$app->user->identity->username,['member/index']).'--登录';
                    }
                    ?>
                </li>
                <li class="line">|</li>
                <li><?=\yii\helpers\Html::a("我的订单",['order/index'])?></li>
                <li class="line">|</li>
                <li><?=\yii\helpers\Html::a("退出登录",['member/logout'])?></li>

            </ul>
        </div>
    </div>
</div>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 页面头部 start -->
<div class="header w990 bc mt15">
    <div class="logo w990">
        <h2 class="fl"><a href="index.html"><img src="/images/logo.png" alt="京西商城"></a></h2>
        <div class="flow fr flow2">
            <ul>
                <li>1.我的购物车</li>
                <li class="cur">2.填写核对订单信息</li>
                <li>3.成功提交订单</li>
            </ul>
        </div>
    </div>
</div>
<!-- 页面头部 end -->

<div style="clear:both;"></div>

<!-- 主体部分 start -->
<div class="fillin w990 bc mt15">
    <div class="fillin_hd">
        <h2>填写并核对订单信息</h2>
    </div>
<form action="" method="post">
    <input type="hidden" name="_csrf-frontend" value="<?=Yii::$app->request->csrfToken?>"/>
    <div class="fillin_bd">
        <!-- 收货人信息  start-->
        <div class="address">
            <h3>收货人信息 <a href="javascript:;" id="address_modify"></a></h3>
            <div class="address_info">
                <?php foreach ($addresss as $k=>$v):?>
                <p> <input type="radio" value="<?=$v->id?>" name="address_id" <?=$v->status==1?'checked':""?>/><?=$v->name?>  <?=$v->tel?>  <?=$v->province?> <?=$v->city?> <?=$v->county?> <?=$v->address?> </p>
                <?php endforeach;?>
            </div>

            <div class="address_select none">
                <ul>
                    <?php foreach ($addresss as $k=>$v):?>
                    <li class="cur">
                        <input type="radio" name="address"  /><?=$v->name?> 北京市 昌平区 建材城西路金燕龙办公楼一层 13555555555
                        <a href="">设为默认地址</a>
                        <a href="">编辑</a>
                        <a href="">删除</a>
                    </li>
                    <?php endforeach;?>
                    <li>
                        <input type="radio" name="address"  />王超平 湖北省 武汉市  武昌 关山光谷软件园1号201 13333333333
                        <a href="">设为默认地址</a>
                        <a href="">编辑</a>
                        <a href="">删除</a>
                    </li>
                    <li><input type="radio" name="address" class="new_address"  />使用新地址</li>
                </ul>
<!--            </div>-->
        </div>
        <!-- 收货人信息  end-->

        <!-- 配送方式 start -->
        <div class="delivery">
            <h3>送货方式 <a href="javascript:;" id="delivery_modify"></a></h3>
            <div class="delivery_info">
                <div class="delivery_select">
                    <table>
                        <tr>
                            <th class="col1">送货方式</th>
                            <th class="col2">运费</th>
                            <th class="col3">运费标准</th>
                        </tr>
                        <?php foreach (Yii::$app->params['delivers'] as $k=>$v):?>
                        <tr <?=$k==0?'class="cur"':""?>>

                            <td>
                                <input type="radio" data_price="<?=$v['price']?>" name="delivery_id" <?=$k==0?"checked":""?> value="<?=$v['id']?>"/><?=$v['name']?>
                            </td>
                            <td>￥<?=$v['price'].'.00'?></td>
                            <td><?=$v['info']?></td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                </div>
            </div>


        </div>
        <!-- 配送方式 end -->

        <!-- 支付方式  start-->
        <div class="pay">
            <h3>支付方式 <a href="javascript:;" id="pay_modify"></a></h3>
            <div class="pay_info">
                <div class="pay_select">
                    <table>
                        <?php foreach (Yii::$app->params['payType'] as $k1=>$v1):?>
                        <tr <?=$k1==0?'class="cur"':""?>>
                            <td class="col1"><input type="radio" name="pay_id" <?=$k1==0?"checked":""?> value="<?=$v1['id']?>"/><?=$v1['name']?></td>
                            <td class="col2"><?=$v1['info']?></td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                </div>
            </div>
        </div>
        <!-- 支付方式  end-->

        <!-- 商品清单 start -->
        <div class="goods">
            <h3>商品清单</h3>
            <table>
                <thead>
                <tr>
                    <th class="col1">商品</th>
                    <th class="col3">价格</th>
                    <th class="col4">数量</th>
                    <th class="col5">小计</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0; $num=0;?>
                <?php foreach ($goods as $good):?>
                <tr>
                    <td class="col1"><?=\yii\helpers\Html::a(\yii\helpers\Html::img($good['logo']),['cart','id'=>$good->id])?>  <strong><?=\yii\helpers\Html::a($good['name'],['cart','id'=>$good->id])?></strong></td>
                    <td class="col3"><?=$good['shop_price']?></td>
                    <td class="col4"> <?=$good['num']?></td>
                    <td class="col5"><span><?=$good['shop_price']*$good['num'].'.00'?></span></td>
                    <?php $i+=$good['num']?>
                    <?php $num+=$good['shop_price']*$good['num']?>
                </tr>
                <?php endforeach;?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5">
                        <ul>

                            <li>
                                <span><?=$i?>件商品，总商品金额：</span>
                                <em>￥<span id="goods_price"><?=$totalPrice.'.00'?></span></em>
                            </li>
                            <li>
                                <span>运费：</span>
                                <em id="deliver_price">￥<?=Yii::$app->params['delivers'][0]['price'].'.00'?></em>
                            </li>
                            <li>
                                <span>应付总额：</span>
                                <em class="total_price">￥<?=$totalPrice+Yii::$app->params['delivers'][0]['price']?>.00</em>
                            </li>
                        </ul>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- 商品清单 end -->

    </div>

    <div class="fillin_ft">
<!--        <a href=""><span>提交订单</span></a>-->
        <input type="submit" value="" style="
            float: right;
            display: inline;
            width: 135px;
            height: 36px;
            background: url(/images/order_btn.jpg) 0 0 no-repeat;
            vertical-align: middle;
            margin: 7px 10px 0;
        " />
        <p>应付总额：<strong class="total_price"><?=$totalPrice+Yii::$app->params['delivers'][0]['price']?>.00</strong></p>

    </div>
</form>
</div>
<!-- 主体部分 end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<?php include_once Yii::getAlias("@app/views/commont/foot.php")?>
<!-- 底部版权 end -->
    <script type="text/javascript">
        $(function () {
           $("[name='delivery_id']").change(function () {
               console.log(111);
//              alert($(this).attr("data_price"));
//               计算运费
              var price=$(this).attr("data_price")-0;
              $("#deliver_price").text('￥'+price);
//              计算总价
               $(".total_price").text('￥'+($("#goods_price").text()-0+price)+'.00');
           });
        });
    </script>
</body>
</html>
