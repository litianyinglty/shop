<?php
use leandrogehlen\treegrid\TreeGrid;
?>
<div style="text-align: center;color: green"><h1>商品分类列表</h1></div>
<?=\yii\bootstrap\Html::a('添加分类',['goods-category/add'],['class'=>'btn btn-info'])?>
<?= TreeGrid::widget([
            'dataProvider' => $dataProvider,
            'keyColumnName' => 'id',
            'parentColumnName' => 'parent_id',
            'parentRootValue' => '0', //first parentId value
            'pluginOptions' => [
                'initialState' => 'collapsed',
            ],
            'columns' => [
                'id',
                'name',
                'parent_id',
                'intro',
                ['class' => 'backend\components\TreeColumn']
//                ['class' => '\yii\grid\ActionColumn']
            ]
]); ?>