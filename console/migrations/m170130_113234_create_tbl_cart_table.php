<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_cart`.
 */
class m170130_113234_create_tbl_cart_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_cart', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer()->notNull(),
            'price'=>$this->decimal(),
            'qty'=>$this->decimal(),
            'total'=>$this->decimal(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),
        ]);

        $this->createIndex(
            'idx-tbl_cart-product_id',
            'tbl_cart',
            'product_id'
        );


        $this->addForeignKey(
            'fk-tbl_cart-product_id',
            'tbl_cart',
            'product_id',
            'tbl_product',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'fk-tbl_cart-product_id',
            'tbl_cart'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_cart-product_id',
            'tbl_cart'
        );
        $this->dropTable('tbl_cart');
    }
}
