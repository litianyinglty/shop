<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>京西商城</title>
    <link rel="stylesheet" href="<?=Yii::getAlias("@web/")?>style/base.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias("@web/")?>style/global.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias("@web/")?>style/header.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias("@web/")?>style/index.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias("@web/")?>style/bottomnav.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias("@web/")?>style/footer.css" type="text/css">

    <script type="text/javascript" src="<?=Yii::getAlias("@web/")?>js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias("@web/")?>js/header.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias("@web/")?>js/index.js"></script>
</head>
<body>

<?php include_once Yii::getAlias("@app/views/commont/head.php")?>


<?=$content?>


<div style="clear:both;"></div>

<!-- 底部导航 start -->
<?=\frontend\widgets\HelpWidget::widget()?>
<!-- 底部导航 end -->

<div style="clear:both;"></div>
<!-- 底部版权 start -->
<?=\frontend\widgets\FootWidget::widget()?>
<!-- 底部版权 end -->

</body>
</html>