<?php
/* @var $this yii\web\View */
?>
<div style="text-align: center;color: red"><h1>权限列表</h1></div>
<?=\yii\bootstrap\Html::a('创建权限',['permission/add'],['class'=>'btn btn-success'])?>
<table class="table table-bordered table-hover" style="text-align: center">
    <tr>
        <th style="text-align: center">权限名称</th>
        <th style="text-align: center">权限描述</th>
        <th style="text-align: center">操作</th>
    </tr>
    <?php foreach ($permissions as $permission):?>
        <tr>
            <td><?=$permission->name?></td>
            <td><?=$permission->description?></td>
            <td>
                <?=\yii\bootstrap\Html::a('',['permission/edit','name'=>$permission->name],['class'=>'btn btn-info btn-xs glyphicon glyphicon-pencil'])?>
                <?=\yii\bootstrap\Html::a('',['permission/del','name'=>$permission->name],['class'=>'btn btn-danger btn-xs glyphicon glyphicon-trash'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
