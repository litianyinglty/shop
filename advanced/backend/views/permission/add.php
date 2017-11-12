<?=\yii\bootstrap\Html::a('返回',['permission/index'],['class'=>'btn btn-info'])?>
<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'description')->textInput();
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();