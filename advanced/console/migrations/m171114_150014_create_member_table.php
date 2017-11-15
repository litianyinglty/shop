<?php

use yii\db\Migration;

/**
 * Handles the creation of table `member`.
 */
class m171114_150014_create_member_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('member', [
            'id' => $this->primaryKey(),
            'username'=>$this->string(40)->notNull()->defaultValue("")->comment('用户姓名'),
            'password'=>$this->string(64)->comment('用户密码'),
            'tel'=>$this->char(11)->comment('用户电话'),
            'email'=>$this->string(30)->comment('用户邮箱'),
            'token'=>$this->char(32)->comment('登录令牌'),
            'status'=>$this->smallInteger(1)->comment('状态'),
            'create_at'=>$this->integer()->comment('添加时间'),
            'update_at'=>$this->integer()->comment('修改时间'),
            'last_login_time'=>$this->integer()->comment('最后登录时间'),
            'last_login_ip'=>$this->bigInteger()->comment('最后登录IP'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('member');
    }
}
