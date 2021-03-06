<?=\yii\bootstrap\Html::a('返回',['article/index'],['class'=>'btn btn-info']);?>
<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($article,'name');
echo $form->field($article,'author');
echo $form->field($article,'up_author');
echo $form->field($article,'intro')->textarea();
echo $form->field($article,'cate_id')->dropDownList($options);
echo $form->field($article,'sort');
echo $form->field($article,'status')->inline()->radioList(\backend\models\Article::$statusArray);
echo $form->field($articleDetail,'content')->widget('kucha\ueditor\UEditor',[]);
//echo \crazydb\ueditor\UEditor::widget([
//    'model' => $articleDetail,
//    'attribute' => 'content',
//    'config' => [
//        'serverUrl' => ['/article/add'],//确保serverUrl正确指向后端地址
//        'lang' => 'zh-cn',
//        'iframeCssUrl' => Yii::getAlias('@web') . '/static/css/ueditor.css',// 自定义编辑器内显示效果
//    ]
//]);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();