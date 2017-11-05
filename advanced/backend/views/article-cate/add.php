<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($articleCate,'name')->textInput();
echo $form->field($articleCate,'intro')->textInput();
echo $form->field($articleCate,'sort')->textInput();
echo $form->field($articleCate,'is_help')->inline()->radioList(\backend\models\ArticleCate::$is_helpArr);
echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();