<table class="table table-bordered table-hover" style="text-align: center">
    <tr>
        <th style="text-align: center">商品名称</th>
        <th style="text-align: center">市场价格</th>
        <th style="text-align: center">本店价格</th>
        <th style="text-align: center">图片</th>
        <th style="text-align: center">缩略图</th>
        <th style="text-align: center">库存</th>
        <th style="text-align: center">详情</th>
        <th style="text-align: center">操作</th>
    </tr>
        <tr>

            <td><?=$good->name?></td>
            <td><?=$good->market_price?></td>
            <td><?=$good->shop_price?></td>
            <td><?=\yii\bootstrap\Html::img($good->image,['width'=>'30','height'=>'30','class'=>'img-circle'])?></td>
            <td>
                <?php
                foreach ($callerys as $callery){
                echo \yii\bootstrap\Html::img($callery->path,['width'=>'30','height'=>'30','class'=>'img-circle']);
                }
                ?>
            </td>
            <td><?=$good->stock?></td>
            <td><?=$goodIntro->content?></td>
            <td>
                <?=\yii\bootstrap\Html::a('返回列表页',['goods/index'],['class'=>'btn btn-success btn-xs'])?>
            </td>
        </tr>
</table>