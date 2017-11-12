<?=\yii\bootstrap\Html::a('返回',['brand/index'],['class'=>'btn btn-info']);?>
<?php
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($brand,'name');
echo $form->field($brand,'intro')->textarea();
echo $form->field($brand,'logo')->widget('manks\FileInput',[]);
echo $form->field($brand,'sort');
echo $form->field($brand,'status')->inline()->radioList(\backend\models\Brand::$statusArray);
echo \yii\bootstrap\Html::submitButton('提交',['class'=>'btn btn-success']);
\yii\bootstrap\ActiveForm::end();