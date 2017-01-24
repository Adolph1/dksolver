<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_purchase_invoice`.
 */
class m170113_155845_create_tbl_purchase_invoice_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_purchase_invoice', [
            'id' => $this->primaryKey(),
            'invoice_number'=>$this->string(20)->null(),
            'purchase_date'=>$this->date(),
            'supplier_id'=>$this->integer()->notNull(),
            'purchase_master_id'=>$this->integer()->notNull(),
            'total_purchase'=>$this->decimal(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
            'checker_id'=>$this->string(200)->notNull(),
            'checker_time'=>$this->dateTime()->notNull(),
            'status'=>$this->integer(),
            'delete_stat'=>$this->char(1),
        ]);

        // creates index for column `supplier_id`
        $this->createIndex(
            'idx-tbl_purchase_invoice-supplier_id',
            'tbl_purchase_invoice',
            'supplier_id'
        );
        // creates index for column `purchase_master_id`
        $this->createIndex(
            'idx-tbl_purchase_invoice-purchase_master_id',
            'tbl_purchase_invoice',
            'purchase_master_id'
        );


        // add foreign key for table `tbl_purchase_master`
        $this->addForeignKey(
            'fk-tbl_purchase_invoice-purchase_master_id',
            'tbl_purchase_invoice',
            'purchase_master_id',
            'tbl_purchase_master',
            'id',
            'CASCADE'
        );


        // add foreign key for table `tbl_supplier`
        $this->addForeignKey(
            'fk-tbl_purchase_invoice-supplier_id',
            'tbl_purchase_invoice',
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
        // drops foreign key for table `tbl_supplier`
        $this->dropForeignKey(
            'fk-tbl_purchase-supplier_id',
            'tbl_purchase_invoice'
        );

        // drops index for column `supplier_id`
        $this->dropIndex(
            'idx-tbl_purchase-supplier_id',
            'tbl_purchase_invoice'
        );

        // drops foreign key for table `tbl_supplier`
        $this->dropForeignKey(
            'fk-tbl_purchase-purchase_master_id',
            'tbl_purchase_invoice'
        );

        // drops index for column `supplier_id`
        $this->dropIndex(
            'idx-tbl_purchase-purchase_master_id',
            'tbl_purchase_invoice'
        );
        $this->dropTable('tbl_purchase_invoice');
    }
}
