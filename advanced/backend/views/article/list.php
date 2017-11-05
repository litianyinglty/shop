<div style="color: purple;text-align: center"><h3>文章详情</h3></div>
<table class="table table-bordered table-hover" style="text-align: center">
    <tr>
        <th style="text-align: center">文章名称</th>
        <th style="text-align: center">作者</th>
        <th style="text-align: center">文章内容</th>
        <th style="text-align: center">操作</th>
    </tr>
        <tr>
            <td><?=$article->name?></td>
            <td><?=$article->author?></td>
            <td><?=$articleDetail->content?></td>
            <td>
                <?=\yii\bootstrap\Html::a('返回列表',['article/index','id'=>$article->id],['class'=>'btn btn-success btn-xs'])?>
            </td>
        </tr>
</table>
