<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($member,'username');
echo $form->field($member,'password')->passwordInput();
echo $form->field($member,'tel');
echo $form->field($member,'email');
echo $form->field($member,'status')->inline()->radioList(\frontend\models\Member::$statusArr);
echo \yii\bootstrap\Html::submitButton('注册',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();
