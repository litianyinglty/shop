<?=\yii\bootstrap\Html::a('返回',['goods/index'],['class'=>'btn btn-info'])?>
<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($good,'name');
echo $form->field($good,'sn');
echo $form->field($good,'logo')->widget('manks\FileInput');
echo $form->field($good, 'images')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
    ],
]);
echo $form->field($good,'category_id')->dropDownList($options);
echo $form->field($good,'brand_id')->dropDownList($brandsAll);
echo $form->field($good,'market_price');
echo $form->field($good,'shop_price');
echo $form->field($good,'stock');
echo $form->field($good,'is_online')->inline()->radioList(\backend\models\Goods::$onlineArr);
echo $form->field($good,'status')->inline()->radioList(\backend\models\Goods::$statusArr);
echo $form->field($good,'sort');
echo $form->field($goodIntro,'content')->widget('kucha\ueditor\UEditor',[]);
//echo \crazydb\ueditor\UEditor::widget([
//    'model' => $goodIntro,
//    'attribute' => 'content',
//    'config' => [
//        'serverUrl' => ['/goods/add'],//确保serverUrl正确指向后端地址
//        'lang' => 'zh-cn',
//        'iframeCssUrl' => Yii::getAlias('@web') . '/static/css/ueditor.css',// 自定义编辑器内显示效果
//    ]
//]);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();