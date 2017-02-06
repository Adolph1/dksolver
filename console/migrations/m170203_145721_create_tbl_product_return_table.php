<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_product_return`.
 */
class m170203_145721_create_tbl_product_return_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_product_return', [
            'id' => $this->primaryKey(),
            'trn_dt'=>$this->date()->notNull(),
            'return_type'=>$this->integer()->notNull(),
            'product_id'=>$this->integer()->notNull(),
            'price'=>$this->decimal(),
            'qty'=>$this->decimal(),
            'total'=>$this->decimal(),
            'source_ref_no'=>$this->string(200),
            'description'=>$this->string(200),
            'status'=>$this->char(1),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-tbl_product_return-product_id',
            'tbl_product_return',
            'product_id'
        );


        $this->addForeignKey(
            'fk-tbl_product_return-product_id',
            'tbl_product_return',
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
            'fk-tbl_product_return-product_id',
            'tbl_product_return'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_product_return-product_id',
            'tbl_product_return'
        );

        $this->dropTable('tbl_product_return');
    }
}
