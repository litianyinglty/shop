<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/18 0018
 * Time: 16:25
 */

namespace frontend\widgets;


use backend\models\GoodsCategory;
use yii\base\Widget;
use yii\helpers\Html;

class GoodsCateWidget extends Widget
{
//    判断是不是index
    public $isIndex=true;
    public function run()
    {
//        1、得到缓存
        $cateId="goodscategory".$this->isIndex;
        $html=\Yii::$app->cache->get($cateId);
        if($html!=false){
            return $html;
        }
//        1、得到所有一级分类
        $cates=GoodsCategory::find()->where(['parent_id'=>0])->all();
//        2、循环取出
        $html="";
        foreach ($cates as $k=>$v){
            $html.='<div class="cat '.($k==0?"item1":"").'">';
            $html.='<h3>'.Html::a($v->name,['index/list'],['id'=>$v->id]).'<b></b></h3>';
            $html.='<div class="cat_detail">';
//        3、循环取出二级分类,childen 是goodscategory模型里得到的
            foreach ($v->children as $k1=>$v1){
                $html.='<dl class="dl_1st">';
                $html.='<dt>'.Html::a($v1->name,['index/list'],['id'=>$v1->id]).'</dt>';
                $html.='<dd>';
//                4、循环第三级分类
                foreach ($v1->children as $k2=>$v2){
                    $html.=Html::a($v2->name,['index/list'],['id'=>$v2->id]);
                }
                $html.='</dd></dl>';
            }
            $html.='</div></div>';
        }
//        根据是不是首页加cat1类
        $cate=$this->isIndex?"":"cat1";
//        根据非首页加none
        $none=$this->isIndex?"":"none";
        $fullHtml=<<<EOF
        <div class="category fl {$cate}"> <!-- 非首页，需要添加cat1类 -->
            <div class="cat_hd">  <!-- 注意，首页在此div上只需要添加cat_hd类，非首页，默认收缩分类时添加上off类，鼠标滑过时展开菜单则将off类换成on类 -->
                <h2>全部商品分类</h2>
                <em></em>
            </div>
                <div class="cat_bd {$none}">
            {$html};
                <!--<div class="cat item1">-->
                    <!--<h3><a href="">图像、音像、数字商品</a> <b></b></h3>-->
                    <!--<div class="cat_detail">-->
                        <!--<dl class="dl_1st">-->
                            <!--<dt><a href="">电子书</a></dt>-->
                            <!--<dd>-->
                                <!--<a href="">免费</a>-->
                                <!--<a href="">小说</a>-->
                                <!--<a href="">励志与成功</a>-->
                                <!--<a href="">婚恋/两性</a>-->
                                <!--<a href="">文学</a>-->
                                <!--<a href="">经管</a>-->
                                <!--<a href="">畅读VIP</a>-->
                            <!--</dd>-->
                        <!--</dl>-->

                        <!--<dl>-->
                            <!--<dt><a href="">数字音乐</a></dt>-->
                            <!--<dd>-->
                                <!--<a href="">通俗流行</a>-->
                                <!--<a href="">古典音乐</a>-->
                                <!--<a href="">摇滚说唱</a>-->
                                <!--<a href="">爵士蓝调</a>-->
                                <!--<a href="">乡村民谣</a>-->
                                <!--<a href="">有声读物</a>-->
                            <!--</dd>-->
                        <!--</dl>-->
                    <!--</div>-->
                <!--</div>-->
            </div>
        </div>
EOF;
//        存储缓存
        \Yii::$app->cache->set($cateId,$fullHtml);
        return $fullHtml;

    }

}