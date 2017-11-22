<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m171120_094448_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'member_id'=>$this->integer()->comment("用户ID"),
            'name'=>$this->string(30)->comment("收货人"),
            'province'=>$this->string(20)->comment("省份"),
            'city'=>$this->string(20)->comment("城市"),
            'district'=>$this->string(20)->comment("区县"),
            'address'=>$this->string(50)->comment("详细地址"),
            'tel'=>$this->string(12)->comment("手机号"),
            'delivery_id'=>$this->integer(2)->comment("送货方式ID"),
            'delivery_name'=>$this->string(20)->comment("配送方式名字"),
            'pay_type'=>$this->smallInteger(1)->comment("支付方式"),
            'pay_name'=>$this->char()->comment("支付方式名字"),
            'price'=>$this->decimal(10,2)->comment("商品金额"),
            'status'=>$this->smallInteger(2)->comment("订单状态"),
            'create_at'=>$this->integer()->comment("创建时间"),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order');
    }
}
