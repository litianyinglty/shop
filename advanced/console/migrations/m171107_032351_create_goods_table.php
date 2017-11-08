<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m171107_032351_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(80)->notNull()->defaultValue("")->comment('商品名称'),
            'sn'=>$this->string(40)->comment('商品货号'),
            'logo'=>$this->string(100)->comment('商品图片'),
            'category_id'=>$this->smallInteger()->comment('分类ID'),
            'brand_id'=>$this->smallInteger()->comment('品牌ID'),
            'market_price'=>$this->decimal(10,2)->comment('市场价格'),
            'shop_price'=>$this->decimal(10,2)->comment('本店价格'),
            'stock'=>$this->integer()->comment('库存'),
            'is_online'=>$this->smallInteger(1)->comment('是否上架'),
            'status'=>$this->smallInteger(1)->comment('状态'),
            'intro'=>$this->string()->comment('商品简介'),
            'create_at'=>$this->integer()->comment('创建时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}
