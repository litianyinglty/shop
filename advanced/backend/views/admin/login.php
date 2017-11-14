<?php
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\LoginForm */
/* @var $form ActiveForm */
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <title>管理员登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <?=\yii\bootstrap\Html::img('/images/321.jpg',['width'=>'100%','height'=>'700'])?>
    <link rel="stylesheet" href="/css/supersized.css">
    <link rel="stylesheet" href="/css/login.css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="/js/html5.js"></script>
    <![endif]-->
    <script src="/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/js/jquery.form.js"></script>
    <script type="text/javascript" src="/js/tooltips.js"></script>
    <script type="text/javascript" src="/js/login.js"></script>
</head>

<body>

<div class="page-container">
    <div class="main_box">
        <div class="login_box">
            <div class="login_logo">
                <div style="font-size: 30px;color: green">管理员登录</div>
            </div>

            <div class="login_form" style="text-align: center">
                    <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

                        <?= $form->field($model,'username')->textInput(['placeholder'=>'请输入用户名']) ?>
                        <?= $form->field($model,'password')->passwordInput(['placeholder'=>'请输入密码']) ?>
                        <?= $form->field($model,'rememberMe')->checkbox() ?>

                        <div>
                            <?= \yii\bootstrap\Html::submitButton('登录', ['class' => 'btn btn-success']) ?>
                        </div>
                    <?php \yii\bootstrap\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Javascript -->
<script src="/js/supersized.3.2.7.min.js"></script>
<script src="/js/supersized-init.js"></script>
<script src="/js/scripts.js"></script>

</body>
</html>



