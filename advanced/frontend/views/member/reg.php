<div class="login w990 bc mt10 regist">
    <div class="login_hd">
        <h2>用户注册</h2>
        <b></b>
    </div>
    <div class="login_bd">
        <div class="login_form fl">
<?php
$form=\yii\widgets\ActiveForm::begin([
    'fieldConfig'=>[
            'options'=>[
                    'tag'=>'li',
            ],
        'errorOptions'=>[
            'tag'=>'p',
        ]
    ],
]);
echo '<ul>';
echo $form->field($member,'username')->textInput(['class'=>'txt'])->label("用户姓名：");
echo $form->field($member,'password')->passwordInput(['class'=>'txt'])->label("用户密码：");
echo $form->field($member,'rePassword')->passwordInput(['class'=>'txt'])->label("确认密码：");
echo $form->field($member,'email')->textInput(['class'=>'txt'])->label("用户邮箱：");
echo $form->field($member,'tel')->textInput(['class'=>'txt'])->label("手机号码：");
$button='<input type="button" id="get_captcha" value="获取验证码" style="height:25px;padding: 0px 8px;margin-left: 13px"/>';
echo $form->field($member,'smsCode',['template'=>"获取验证码：\n{input}$button\n{hint}\n{error}"])->textInput(['class'=>'txt','style'=>'width:150px']);
//echo $form->field($member,'captcha')->textInput(['class'=>'txt','width'=>'20'])->label("验证码：");
echo $form->field($member,'checked')->hint("我已阅读并同意《用户注册协议》")->checkbox(['class'=>'chb']);
echo '</ul>';
echo \yii\bootstrap\Html::submitButton('',['class'=>'login_btn']);
\yii\widgets\ActiveForm::end();


//得到url地址
$url=\yii\helpers\Url::to(['member/sms']);
$js=<<<EOF
    $(function(){
        $('#get_captcha').click(function(){
        //得到电话号码
        var tel=$('#member-tel').val();
        if(!tel){
        alert('手机号必须填写');
        return;
        }
        //1、发送ajax请求
        $.post("{$url}",{'tel':tel},function(data){
        console.log(data);
        });
        console.log(111);
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
        });
    });
EOF;
//注册js代码
$this->registerJs($js);
?>

        </div>

        <div class="mobile fl">
            <h3>手机快速注册</h3>
            <p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
            <p><strong>1069099988</strong></p>
        </div>

    </div>
</div>
