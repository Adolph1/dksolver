<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_sales`.
 */
class m170113_160151_create_tbl_sales_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_sales', [
            'id' => $this->primaryKey(),
            'trn_dt'=>$this->date()->notNull(),
            'order_number'=>$this->string(16)->notNull(),
            'product_id'=>$this->integer()->notNull(),
            'qty'=>$this->decimal()->notNull(),
            'amount'=>$this->decimal()->notNull(),
            'total'=>$this->decimal()->notNull(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
            'auth_status'=>$this->char(1),
            'checker_id'=>$this->string(200)->notNull(),
            'checker_time'=>$this->dateTime()->notNull(),


        ]);


        // creates index for column `product_id`
        $this->createIndex(
            'idx-tbl_sales-product_id',
            'tbl_sales',
            'product_id'
        );


        $this->addForeignKey(
            'fk-tbl_sales-product_id',
            'tbl_sales',
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

        // drops foreign key for table `tbl_product`
        $this->dropForeignKey(
            'fk-tbl_sales-product_id',
            'tbl_sales'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_sales-product_id',
            'tbl_sales'
        );
        $this->dropTable('tbl_sales');
    }
}
