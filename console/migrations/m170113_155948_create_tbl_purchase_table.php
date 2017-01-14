<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_purchase`.
 */
class m170113_155948_create_tbl_purchase_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_purchase', [
            'id' => $this->primaryKey(),
            'invoice_number'=>$this->string(20)->null(),
            'purchase_date'=>$this->date(),
            'product_id'=>$this->integer()->notNull(),
            'price'=>$this->decimal()->notNull(),
            'qty'=>$this->decimal()->notNull(),
            'total'=>$this->decimal()->notNull(),
            'supplier_id'=>$this->integer()->notNull(),
            'period'=>$this->string(3)->notNull(),
            'financial_year'=>$this->string(10),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
            'auth_status'=>$this->char(1),
            'checker_id'=>$this->string(200)->notNull(),
            'checker_time'=>$this->dateTime()->notNull(),

        ]);


        // creates index for column `product_id`
        $this->createIndex(
            'idx-tbl_purchase-product_id',
            'tbl_purchase',
            'product_id'
        );


        // creates index for column `supplier_id`
        $this->createIndex(
            'idx-tbl_purchase-supplier_id',
            'tbl_purchase',
            'supplier_id'
        );

        // add foreign key for table `tbl_product`
        $this->addForeignKey(
            'fk-tbl_purchase-product_id',
            'tbl_purchase',
            'product_id',
            'tbl_product',
            'id',
            'CASCADE'
        );



        // add foreign key for table `tbl_supplier`
        $this->addForeignKey(
            'fk-tbl_purchase-supplier_id',
            'tbl_purchase',
            'supplier_id',
            'tbl_supplier',
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
            'fk-tbl_purchase-product_id',
            'tbl_purchase'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_purchase-product_id',
            'tbl_purchase'
        );

        // drops foreign key for table `tbl_supplier`
        $this->dropForeignKey(
            'fk-tbl_purchase-supplier_id',
            'tbl_purchase'
        );

        // drops index for column `supplier_id`
        $this->dropIndex(
            'idx-tbl_purchase-supplier_id',
            'tbl_purchase'
        );

        $this->dropTable('tbl_purchase');
    }
}
