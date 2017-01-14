<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_price_maintanance`.
 */
class m170113_160317_create_tbl_price_maintanance_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_price_maintanance', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer()->notNull(),
            'price_type'=>$this->integer()->notNull(),
            'old_price'=>$this->decimal()->notNull(),
            'new_price'=>$this->decimal()->notNull(),
            'reason'=>$this->string(200)->notNull(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
            'auth_status'=>$this->char(1),
            'checker_id'=>$this->string(200)->notNull(),
            'checker_time'=>$this->dateTime()->notNull(),
        ]);


        // creates index for column `product_id`
        $this->createIndex(
            'idx-tbl_price_maintanance-product_id',
            'tbl_price_maintanance',
            'product_id'
        );


        $this->addForeignKey(
            'fk-tbl_price_maintanance-product_id',
            'tbl_price_maintanance',
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
            'fk-tbl_price_maintanance-product_id',
            'tbl_price_maintanance'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_price_maintanance-product_id',
            'tbl_price_maintanance'
        );
        $this->dropTable('tbl_price_maintanance');
    }
}
