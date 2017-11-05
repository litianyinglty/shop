<div style="color: purple;text-align: center"><h1>文章列表</h1></div>
<?=\yii\bootstrap\Html::a('添加文章',['article/add'],['class'=>'btn btn-success'])?>
<?=\yii\bootstrap\Html::a('文章分类',['article-cate/index'],['class'=>'btn btn-warning'])?>
<?=\yii\bootstrap\Html::a('回收站',['article/display'],['class'=>'btn btn-info'])?>
<table class="table table-bordered table-hover" style="text-align: center">
    <tr>
        <th style="text-align: center">Id</th>
        <th style="text-align: center">文章名称</th>
        <th style="text-align: center">作者</th>
        <th style="text-align: center">修改作者</th>
        <th style="text-align: center">简介</th>
        <th style="text-align: center">文章分类</th>
        <th style="text-align: center">排序</th>
        <th style="text-align: center">状态</th>
        <th style="text-align: center">添加时间</th>
        <th style="text-align: center">修改时间</th>
        <th style="text-align: center">操作</th>
    </tr>
    <?php foreach ($articles as $article):?>
        <tr>
            <td><?=$article->id?></td>
            <td><?=$article->name?></td>
            <td><?=$article->author?></td>
            <td><?=$article->up_author?></td>
            <td><?=$article->intro?></td>
            <td><?=$article->category->name?></td>
            <td><?=$article->sort?></td>
            <td>
                <?php
                if($article->status==1){
                    echo '<span class="glyphicon glyphicon-ok" style="color: green"></span>';
                }else{
                    echo '<span class="glyphicon glyphicon-remove" style="color: red"></span>';
                }
                ?>
            </td>
            <td><?=date('Y-m-d H:i:s',$article->insert_time)?></td>
            <td><?=date('Y-m-d H:i:s',$article->update_time)?></td>
            <td>
                <?=\yii\bootstrap\Html::a('',['list','id'=>$article->id],['class'=>'btn btn-info btn-xs glyphicon glyphicon-align-justify'])?>
                <?=\yii\bootstrap\Html::a('',['edit','id'=>$article->id],['class'=>'btn btn-success btn-xs glyphicon glyphicon-pencil'])?>
                <?=\yii\bootstrap\Html::a('',['dell','id'=>$article->id],['class'=>'btn btn-warning btn-xs glyphicon glyphicon-list-alt'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<div style="text-align: center">
    <?php echo \yii\widgets\LinkPager::widget(['pagination'=>$page])?>
</div>