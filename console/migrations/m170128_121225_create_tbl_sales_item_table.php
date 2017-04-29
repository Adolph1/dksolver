<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sales_item`.
 */
class m170128_121225_create_tbl_sales_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_sales_item', [
            'id' => $this->primaryKey(),
            'trn_dt'=>$this->date()->notNull(),
            'sales_id'=>$this->integer()->notNull(),
            'product_id'=>$this->integer()->notNull(),
            'selling_price'=>$this->decimal(),
            'qty'=>$this->decimal(),
            'total'=>$this->decimal(),
            'previous_balance'=>$this->decimal(),
            'balance'=>$this->decimal(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
            'delete_stat'=>$this->char(1),


        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-tbl_sales_item-product_id',
            'tbl_sales_item',
            'product_id'
        );


        $this->addForeignKey(
            'fk-tbl_sales_item-product_id',
            'tbl_sales_item',
            'product_id',
            'tbl_product',
            'id',
            'CASCADE'
        );


        // creates index for column `product_id`
        $this->createIndex(
            'idx-tbl_sales_item-sales_id',
            'tbl_sales_item',
            'sales_id'
        );


        $this->addForeignKey(
            'fk-tbl_sales_item-sales_id',
            'tbl_sales_item',
            'sales_id',
            'tbl_sales',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `tbl_product`
        $this->dropForeignKey(
            'fk-tbl_sales_item-product_id',
            'tbl_sales_item'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_sales_item-product_id',
            'tbl_sales_item'
        );

        $this->dropForeignKey(
            'fk-tbl_sales_item-sales_id',
            'tbl_sales_item'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_sales_item-sales_id',
            'tbl_sales_item'
        );
        $this->dropTable('tbl_sales_item');
    }
}
