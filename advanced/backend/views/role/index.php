<?php
/* @var $this yii\web\View */
?>
<div style="text-align: center;color: #00AA88"><h1>角色列表</h1></div>
<?=\yii\bootstrap\Html::a('添加角色',['role/add'],['class'=>'btn btn-success'])?>
<table class="table table-hover table-bordered" style="text-align: center">
    <tr>
        <th style="text-align: center">角色名称</th>
        <th style="text-align: center">角色描述</th>
        <th style="text-align: center">拥有权限</th>
        <th style="text-align: center">操作</th>
    </tr>
    <?php foreach ($roles as $role):?>
        <tr>
            <td><?=$role->name?></td>
            <td><?=$role->description?></td>
            <td>
                <?php
//                实例化RBAC组件
                $auth=Yii::$app->authManager;
//                得到角色对应的权限
                $permissions=$auth->getPermissionsByRole($role->name);
//                定义一个空字符串
                $arr='';
//                循环
                foreach ($permissions as $permission){
                    $arr.=$permission->description.'//';
                }
                echo rtrim($arr,'//');
                ?>
            </td>
            <td>
                <?=\yii\bootstrap\Html::a('',['role/edit','name'=>$role->name],['class'=>'btn btn-info btn-xs glyphicon glyphicon-pencil'])?>
                <?=\yii\bootstrap\Html::a('',['role/del','name'=>$role->name],['class'=>'btn btn-danger btn-xs glyphicon glyphicon-trash'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
