<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_inventory`.
 */
class m170113_160128_create_tbl_inventory_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_inventory', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer()->notNull()->unique(),
            'buying_price'=>$this->decimal()->notNull(),
            'selling_price'=>$this->decimal()->notNull(),
            'qty'=>$this->decimal()->notNull(),
            'min_level'=>$this->integer(),
            'last_updated'=>$this->dateTime(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
            'auth_status'=>$this->char(1),
            'checker_id'=>$this->string(200)->notNull(),
            'checker_time'=>$this->dateTime()->notNull(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-tbl_inventory-product_id',
            'tbl_inventory',
            'product_id'
        );


        $this->addForeignKey(
            'fk-tbl_inventory-product_id',
            'tbl_inventory',
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
            'fk-tbl_inventory-product_id',
            'tbl_inventory'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_inventory-product_id',
            'tbl_inventory'
        );
        $this->dropTable('tbl_inventory');
    }
}
