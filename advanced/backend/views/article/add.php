<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($article,'name');
echo $form->field($article,'author');
echo $form->field($article,'up_author');
echo $form->field($article,'intro')->textarea();
echo $form->field($article,'cate_id')->dropDownList($options);
echo $form->field($article,'sort');
echo $form->field($article,'status')->inline()->radioList(\backend\models\Article::$statusArray);
echo $form->field($articleDetail,'content')->textarea();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
echo \yii\bootstrap\Html::a('返回',['article/index'],['class'=>'btn btn-info']);
\yii\bootstrap\ActiveForm::end();