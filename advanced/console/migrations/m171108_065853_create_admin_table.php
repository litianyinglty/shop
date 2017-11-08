<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171108_065853_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username'=>$this->string(50)->notNull()->defaultValue('')->comment('用户姓名'),
            'password'=>$this->string(80)->comment('用户密码'),
            'salt'=>$this->char()->comment('盐'),
            'email'=>$this->string(30)->comment('用户邮箱'),
            'token'=>$this->char()->comment('自动登录令牌'),
            'token_create_time'=>$this->integer()->comment('令牌创建时间'),
            'add_time'=>$this->integer()->comment('注册时间'),
            'last_login_time'=>$this->integer()->comment('最后登录时间'),
            'last_login_ip'=>$this->char(15)->comment('最后登录IP'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}
