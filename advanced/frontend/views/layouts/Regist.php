<?php
/* @var $this \yii\web\View */
/* @var $content string */
use frontend\assets\RegistAsset;
RegistAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>用户注册</title>
<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- 顶部导航 start -->
<?php include_once Yii::getAlias("@app/views/commont/head.php")?>
<!-- 顶部导航 end -->

<!-- 登录主体部分start -->
<?= $content ?>
<!-- 登录主体部分end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<div class="footer w1210 bc mt15">
    <p class="links">
        <a href="">关于我们</a> |
        <a href="">联系我们</a> |
        <a href="">人才招聘</a> |
        <a href="">商家入驻</a> |
        <a href="">千寻网</a> |
        <a href="">奢侈品网</a> |
        <a href="">广告服务</a> |
        <a href="">移动终端</a> |
        <a href="">友情链接</a> |
        <a href="">销售联盟</a> |
        <a href="">京西论坛</a>
    </p>
    <p class="copyright">
        © 2005-2013 京东网上商城 版权所有，并保留所有权利。  ICP备案证书号:京ICP证070359号
    </p>
    <p class="auth">
        <a href=""><img src="<?=Yii::getAlias('@web/')?>images/xin.png" alt="" /></a>
        <a href=""><img src="<?=Yii::getAlias('@web/')?>images/kexin.jpg" alt="" /></a>
        <a href=""><img src="<?=Yii::getAlias('@web/')?>images/police.jpg" alt="" /></a>
        <a href=""><img src="<?=Yii::getAlias('@web/')?>images/beian.gif" alt="" /></a>
    </p>
</div>
<!-- 底部版权 end -->
<!--<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>-->
<script type="text/javascript">
    function bindPhoneNum(){
        //启用输入框
        $('#captcha').prop('disabled',false);

        var time=30;
        var interval = setInterval(function(){
            time--;
            if(time <= 0){
                clearInterval(interval);
                var html = '获取验证码';
                $('#get_captcha').prop('disabled',false);
            } else{
                var html = time + ' 秒后再次获取';
                $('#get_captcha').prop('disabled',true);
            }

            $('#get_captcha').val(html);
        },1000);
    }
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>