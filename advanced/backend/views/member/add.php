<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Member */
/* @var $form ActiveForm */
?>
<div class="member-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'create_at') ?>
        <?= $form->field($model, 'update_at') ?>
        <?= $form->field($model, 'last_login_time') ?>
        <?= $form->field($model, 'last_login_ip') ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password') ?>
        <?= $form->field($model, 'tel') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'token') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- member-add -->
