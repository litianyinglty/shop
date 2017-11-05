<div style="color: purple;text-align: center"><h1>回收站</h1></div>
<?=\yii\bootstrap\Html::a('返回',['brand/index'],['class'=>'btn btn-success'])?>
<table class="table table-bordered table-hover" style="text-align: center">
    <tr>
        <th style="text-align: center">Id</th>
        <th style="text-align: center">品牌名称</th>
        <th style="text-align: center">简介</th>
        <th style="text-align: center">图片</th>
        <th style="text-align: center">排序</th>
        <th style="text-align: center">状态</th>
        <th style="text-align: center">操作</th>
    </tr>
    <?php foreach ($brands as $brand):?>
        <tr>
            <td><?=$brand->id?></td>
            <td><?=$brand->name?></td>
            <td><?=$brand->intro?></td>
            <td><?=\yii\bootstrap\Html::img($brand->logo,['width'=>'30','height'=>'30','class'=>"img-circle"])?></td>
            <td><?=$brand->sort?></td>
            <td>
                <?php
                if($brand->status==1){
                    echo '<span class="glyphicon glyphicon-ok" style="color: green"></span>';
                }else{
                    echo '<span class="glyphicon glyphicon-remove" style="color: red"></span>';
                }
                ?>
            </td>
            <td>
                <?=\yii\bootstrap\Html::a('',['brand/reduction','id'=>$brand->id],['class'=>'btn btn-success glyphicon glyphicon-pencil btn-xs'])?>
                <?=\yii\bootstrap\Html::a('',['brand/del','id'=>$brand->id],['class'=>'btn btn-danger glyphicon glyphicon-trash btn-xs'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>