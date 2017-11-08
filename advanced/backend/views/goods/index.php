<?php
/* @var $this yii\web\View */
?>
<div style="text-align: center;color: #0000aa" xmlns="http://www.w3.org/1999/html"><h1>商品列表</h1></div>



<div>
    <div class="col-md-4">
        <?=\yii\bootstrap\Html::a("添加商品",['goods/add'],['class'=>'btn btn-success'])?>
        <?=\yii\bootstrap\Html::a("回收站",['goods/reductions'],['class'=>'btn btn-info'])?>
    </div>
    <div class="col-md-8">
        <form class="form-inline pull-right">
<!--                <input type="text" class="form-control" name="status" id="minprice" size="10" placeholder="商品状态">-->
                <input type="text" class="form-control" name="minprice" id="minprice" size="10" placeholder="最低价">
                --
                <input type="text" class="form-control" name="maxprice" id="maxprice" size="10"  placeholder="最高价">
                <input type="text" class="form-control" name="keyword" id="keyword" placeholder="请输入商品名称和货号">
            <button type="submit" class="btn btn-success">搜索</button>
        </form>
    </div>
</div>




<table class="table table-bordered table-hover" style="text-align: center">
    <tr>
        <th style="text-align: center">ID</th>
        <th style="text-align: center">商品名称</th>
        <th style="text-align: center">商品货号</th>
        <th style="text-align: center">图片</th>
        <th style="text-align: center">商品分类</th>
        <th style="text-align: center">商品品牌</th>
        <th style="text-align: center">市场价格</th>
        <th style="text-align: center">本店价格</th>
        <th style="text-align: center">库存</th>
        <th style="text-align: center">上架</th>
        <th style="text-align: center">状态</th>
        <th style="text-align: center">排序</th>
        <th style="text-align: center">创建时间</th>
        <th style="text-align: center">操作</th>
    </tr>
    <?php foreach ($goods as $good):?>
        <tr>
            <td><?=$good->id?></td>
            <td><?=$good->name?></td>
            <td><?=$good->sn?></td>
            <td><?=\yii\bootstrap\Html::img($good->image,['width'=>'30','height'=>'30','class'=>'img-circle'])?></td>
            <td><?=$good->cate->name?></td>
            <td><?=$good->brand->name?></td>
            <td><?=$good->market_price?></td>
            <td><?=$good->shop_price?></td>
            <td><?=$good->stock?></td>
            <td>
                <?php
                if($good->is_online==1){
                    echo '<span class="glyphicon glyphicon-ok" style="color: green"></span>';
                }else{
                    echo '<span class="glyphicon glyphicon-remove" style="color: red"></span>';
                }
                ?>
            </td>
            <td>
                <?php
                if($good->status==1){
                    echo '<span class="glyphicon glyphicon-ok" style="color: green"></span>';
                }else{
                    echo '<span class="glyphicon glyphicon-remove" style="color: red"></span>';
                }
                ?>
            </td>
            <td><?=$good->sort?></td>
            <td><?=date('Y-m-d H:i:s',$good->create_at)?></td>
            <td>
                <?=\yii\bootstrap\Html::a('',['goods/edit','id'=>$good->id],['class'=>'btn btn-success btn-xs glyphicon glyphicon-pencil'])?>
                <?=\yii\bootstrap\Html::a('',['goods/recycle','id'=>$good->id],['class'=>'btn btn-info btn-xs glyphicon glyphicon-minus'])?>
                <?=\yii\bootstrap\Html::a('',['goods/list','id'=>$good->id],['class'=>'btn btn-warning btn-xs glyphicon glyphicon-th-list'])?>
                <?=\yii\bootstrap\Html::a('',['goods/del','id'=>$good->id],['class'=>'btn btn-danger btn-xs glyphicon glyphicon-trash'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>

<div style="text-align: center">
    <?=\yii\widgets\LinkPager::widget(['pagination'=>$page])?>
</div>