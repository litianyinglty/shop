<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\LoginForm */
/* @var $form ActiveForm */
?>

<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    <title>login</title>-->
<!--    <link rel="stylesheet" type="text/css" href="/css/normalize.css">-->
<!--    <link rel="stylesheet" type="text/css" href="/css/demo.css">-->
<!--    <!--必要样式-->
<!--    <link rel="stylesheet" type="text/css" href="/css/component.css">-->
<!--    <!--[if IE]>-->
<!--    <script src="/js/html5.js"></script>-->
<!--    <![endif]-->
<!--</head>-->
<!--<body>-->
<!--<div class="container demo-1">-->
<!--    <div class="content">-->
<!--        <div id="large-header" class="large-header">-->
<!--            <canvas id="demo-canvas" width="679" height="609"></canvas>-->
<!--            <div class="logo_box">-->
<!--                <h3>欢迎你</h3>-->
<!--                <form action="#" name="f" method="post">-->
<!--                    <div class="input_outer">-->
<!--                        <span class="u_user"></span>-->
<!--                        <input name="logname" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入账户">-->
<!--                    </div>-->
<!--                    <div class="input_outer">-->
<!--                        <span class="us_uer"></span>-->
<!--                        <input name="logpass" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;" value="" type="password" placeholder="请输入密码">-->
<!--                    </div>-->
<!--                    <div class="mb2"><a class="act-but submit" href="javascript:;" style="color: #FFFFFF">登录</a></div>-->
<!--                </form>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div><!-- /container -->
<!--<script src="/js/TweenLite.min.js"></script>-->
<!--<script src="/js/EasePack.min.js"></script>-->
<!--<script src="/js/rAF.js"></script>-->
<!--<script src="/js/demo-1.js"></script>-->
<!--<script type="text/javascript" src="/idm-su.baidu.com/su.js"></script>-->
<!---->
<!--</body>-->





<div class="admin-login col-lg-6" >
    <div class="row">
         <div class="col-lg-6">
    <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

        <?= $form->field($model,'username')->textInput() ?>
        <?= $form->field($model,'password')->passwordInput() ?>
        <?= $form->field($model,'rememberMe')->checkbox() ?>

        <div>
            <?= \yii\bootstrap\Html::submitButton('登录', ['class' => 'btn btn-success']) ?>
        </div>
    <?php \yii\bootstrap\ActiveForm::end(); ?>
        </div>
    </div>
</div>
