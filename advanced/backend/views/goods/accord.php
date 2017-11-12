<div style="text-align: center;color:indianred"><h1>回收站</h1></div>
<?=\yii\bootstrap\Html::a("商品首页",['goods/index'],['class'=>'btn btn-success'])?>
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
                <?=\yii\bootstrap\Html::a('',['goods/reduction','id'=>$good->id],['class'=>'btn btn-success btn-xs glyphicon glyphicon-share-alt'])?>
                <?=\yii\bootstrap\Html::a('',['goods/del','id'=>$good->id],['class'=>'btn btn-danger btn-xs glyphicon glyphicon-trash'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>