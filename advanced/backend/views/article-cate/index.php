<?php
/* @var $this yii\web\View */
?>
<div style="text-align: center;color: green"><h1>文章分类表</h1></div>
<?=\yii\bootstrap\Html::a("文章列表",['article/index'],['class'=>'btn btn-success'])?>
<?=\yii\bootstrap\Html::a("添加分类",['article-cate/add'],['class'=>'btn btn-info'])?>
<table class="table table-bordered table-hover" style="text-align: center">
    <tr>
        <th style="text-align: center">Id</th>
        <th style="text-align: center">分类名称</th>
        <th style="text-align: center">简介</th>
        <th style="text-align: center">排序</th>
        <th style="text-align: center">所有文章</th>
        <th style="text-align: center">帮助</th>
        <th style="text-align: center">创建时间</th>
        <th style="text-align: center">操作</th>
    </tr>
    <?php foreach ($articleCates as $articleCate):?>
    <tr>
        <td><?=$articleCate->id?></td>
        <td><?=$articleCate->name?></td>
        <td><?=$articleCate->intro?></td>
        <td><?=$articleCate->sort?></td>
        <td>
            <?php
                $arr="";
                foreach ($articleCate->article as $v){
                    $arr.= $v->name.' && ';
                }
                echo rtrim($arr,' && ');
            ?>
            </td>
        <td><?=\backend\models\ArticleCate::$is_helpArr[$articleCate->is_help]?></td>
        <td><?=date('Y-m-d H:i:s',$articleCate->create_time)?></td>
        <td>
            <?=\yii\bootstrap\Html::a("",['article-cate/edit','id'=>$articleCate->id],['class'=>'btn btn-success btn-xs glyphicon glyphicon-pencil'])?>
            <?=\yii\bootstrap\Html::a("",['article-cate/del','id'=>$articleCate->id],['class'=>'btn btn-danger btn-xs glyphicon glyphicon-trash'])?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
