<div style="text-align: center;color: #00AA88"><h1>用户列表</h1></div>
<?=\yii\bootstrap\Html::a('添加用户',['member/add'],['class'=>'btn btn-success'])?>
<table class="table table-bordered table-hover" style="text-align: center">
    <tr>
        <th style="text-align: center">Id</th>
        <th style="text-align: center">用户姓名</th>
        <th style="text-align: center">用户密码</th>
        <th style="text-align: center">用户电话</th>
        <th style="text-align: center">用户邮箱</th>
        <th style="text-align: center">登录令牌</th>
        <th style="text-align: center">状态</th>
        <th style="text-align: center">添加时间</th>
        <th style="text-align: center">修改时间</th>
        <th style="text-align: center">最后登录时间</th>
        <th style="text-align: center">最后登录IP</th>
        <th style="text-align: center">操作</th>
    </tr>
    <?php foreach ($members as $member):?>
        <tr>
            <td><?=$member->id?></td>
            <td><?=$member->username?></td>
            <td><?=$member->tel?></td>
            <td><?=$member->email?></td>
            <td><?=$member->token?></td>
            <td><?=$member->status?></td>
            <td><?=$member->create_at?></td>
            <td><?=$member->update_at?></td>
            <td><?=$member->last_login_time?></td>
            <td><?=$member->last_login_ip?></td>
            <td>
                <?=\yii\bootstrap\Html::a('',['member/edit','id'=>$member->id],['class'=>'btn btn-info glyphicon glyphicon-pencil'])?>
                <?=\yii\bootstrap\Html::a('',['member/del','id'=>$member->id],['class'=>'btn btn-danger glyphicon glyphicon-trash'])?>
            </td>
        </tr>
    <?php endforeach;?>
</table>