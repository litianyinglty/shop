<?=\yii\bootstrap\Html::a('返回',['role/index'],['class'=>'btn btn-info'])?>
<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'description')->textInput();
echo $form->field($model,'permissions')->inline()->checkboxList($permissions);
echo \yii\bootstrap\Html::submitButton('添加',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();