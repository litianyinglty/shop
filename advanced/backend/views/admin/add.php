<?=\yii\bootstrap\Html::a('返回首页',['admin/index'],['class'=>'btn btn-info'])?>
<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($admin,'username');
echo $form->field($admin,'password')->passwordInput();
echo $form->field($admin,'email');
echo $form->field($admin,'roles')->inline()->checkboxList($roles);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();