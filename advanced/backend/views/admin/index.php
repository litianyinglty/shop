<?php
/* @var $this yii\web\View */
?>
<div style="text-align: center;color: #00a2d4"><h1>后台列表</h1></div>
<?=\yii\bootstrap\Html::a('添加用户',['admin/add'],['class'=>'btn btn-info'])?>
<table class="table table-bordered table-hover" style="text-align: center">
    <tr>
        <th style="text-align: center">Id</th>
        <th style="text-align: center">用户名</th>
        <th style="text-align: center">盐</th>
        <th style="text-align: center">邮箱</th>
        <th style="text-align: center">令牌创建时间</th>
        <th style="text-align: center">注册时间</th>
        <th style="text-align: center">操作</th>
    </tr>
    <?php foreach ($admins as $admin):?>
        <tr>
            <td><?=$admin->id?></td>
            <td><?=$admin->username?></td>
            <td><?=$admin->salt?></td>
            <td><?=$admin->email?></td>
            <td><?=date('Y-m-d H:i:s',$admin->token_create_time)?></td>
            <td><?=date('Y-m-d H:i:s',$admin->add_time)?></td>
            <td>
                <?=\yii\bootstrap\Html::a('',['admin/eait','id'=>$admin->id],['class'=>'btn btn-success btn-xs glyphicon glyphicon-pencil'])?>
                <?=\yii\bootstrap\Html::a('',['admin/del','id'=>$admin->id],['class'=>'btn btn-danger btn-xs glyphicon glyphicon-trash'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>