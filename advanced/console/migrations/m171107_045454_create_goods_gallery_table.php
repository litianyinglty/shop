<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_gallery`.
 */
class m171107_045454_create_goods_gallery_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_gallery', [
            'id' => $this->primaryKey(),
            'goods_id'=>$this->integer()->comment('商品ID'),
            'images'=>$this->string()->comment('商品图片地址'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_gallery');
    }
}