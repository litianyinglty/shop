<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/18 0018
 * Time: 18:17
 */

namespace frontend\widgets;


use backend\models\Goods;
use yii\base\Widget;
use yii\helpers\Html;

class GoodsWidget extends Widget
{
    public function run()
    {
//        得到所有商品
        $goods=Goods::find()->all();
        $html="";
//        循环取出
//        $html.='';
        foreach ($goods as $good){
//            var_dump($good);exit;
            $html.='<ul><li><dl>';
            $html.='<dt>'.Html::img($good->image).'</dt>';
            $html.='<dd>'.Html::a($good->name,['index/goods','id'=>$good->id]).'</dt>';
            $html.='<dd><strong>'.'￥'.$good->shop_price.'</strong></dt>';
            $html.='</dl></li></ul>';
        }
//        $html.='';
        return <<<EOF
<div class="goodslist mt10">
        {$html};
            <!--<ul>-->
                <!--<li>-->
                    <!--<dl>-->
                        <!--<dt><a href=""><img src="<?=Yii::getAlias("@web/")?>images/goods1.jpg" alt="" /></a></dt>-->
                        <!--<dd><a href="">清华同方精锐X2 台式电脑（双核E3500 2G 500G DVD 键鼠）带20英寸显示器</a></dt>-->
                        <!--<dd><strong>￥2399.00</strong></dt>-->
                        <!--<dd><a href=""><em>已有10人评价</em></a></dt>-->
                    <!--</dl>-->
                <!--</li>-->

                <!--<li>-->
                    <!--<dl>-->
                        <!--<dt><a href=""><img src="<?=Yii::getAlias("@web/")?>images/goods2.jpg" alt="" /></a></dt>-->
                        <!--<dd><a href="">富士通LH531 14.1英寸笔记本电脑（i3-2350M 2G 320G 第二代核芯显卡 D刻</a></dd>-->
                        <!--<dd><strong>￥2999.00</strong></dd>-->
                        <!--<dd><a href=""><em>已有5人评价</em></a></dd>-->
                    <!--</dl>-->
                <!--</li>-->

                <!--<li>-->
                    <!--<dl>-->
                        <!--<dt><a href=""><img src="<?=Yii::getAlias("@web/")?>images/goods3.jpg" alt="" /></a></dt>-->
                        <!--<dd><a href="">三星Galaxy Tab P6800 7.7英寸 3G手机版 蓝牙3.0 魔丽屏 金属银</a></dd>-->
                        <!--<dd><strong>￥4699.00</strong></dd>-->
                        <!--<dd><a href=""><em>已有34人评价</em></a></dd>-->
                    <!--</dl>-->
                <!--</li>-->

                <!--<li>-->
                    <!--<dl>-->
                        <!--<dt><a href=""><img src="<?=Yii::getAlias("@web/")?>images/goods4.jpg" alt="" /></a></dt>-->
                        <!--<dd><a href="">宏碁AS4739-382G32Mnkk 14英寸笔记本电脑（i3-380M 2G 320G D刻 LED背</a></dd>-->
                        <!--<dd><strong>￥2799.00</strong></dd>-->
                        <!--<dd><a href=""><em>已有17人评价</em></a></dd>-->
                    <!--</dl>-->
                <!--</li>-->

                <!--<li>-->
                    <!--<dl>-->
                        <!--<dt><a href=""><img src="<?=Yii::getAlias("@web/")?>images/goods5.jpg" alt="" /></a></dt>-->
                        <!--<dd><a href="">ThinkPad E42014英寸笔记本电脑（i5-2450M 2G 320G 蓝牙 摄像头）</a></dd>-->
                        <!--<dd><strong>￥4199.00</strong></dd>-->
                        <!--<dd><a href=""><em>已有8人评价</em></a></dd>-->
                    <!--</dl>-->
                <!--</li>-->

                <!--<li>-->
                    <!--<dl>-->
                        <!--<dt><a href=""><img src="<?=Yii::getAlias("@web/")?>images/goods6.jpg" alt="" /></a></dt>-->
                        <!--<dd><a href="">惠普G4-1332TX 14英寸笔记本电脑 （i5-2450M 2G 500G 7450M 1G独显 D刻</a></dd>-->
                        <!--<dd><strong>￥2999.00</strong></dd>-->
                        <!--<dd><a href=""><em>已有22人评价</em></a></dd>-->
                    <!--</dl>-->
                <!--</li>-->
            <!--</ul>-->
        </div>
EOF;

    }

}