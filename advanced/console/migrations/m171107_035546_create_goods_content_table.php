<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_content`.
 */
class m171107_035546_create_goods_content_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_content', [
            'id' => $this->primaryKey(),
            'goods_id'=>$this->smallInteger()->comment('商品ID'),
            'content'=>$this->text()->comment('商品详情'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_content');
    }
}
