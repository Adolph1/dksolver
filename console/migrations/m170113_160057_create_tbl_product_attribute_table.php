<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_product_attribute`.
 */
class m170113_160057_create_tbl_product_attribute_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_product_attribute', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer()->notNull(),
            'attribute_name'=>$this->string(20)->notNull(),
            'quantity'=>$this->decimal()->notNull()
        ]);


        // creates index for column `product_id`
        $this->createIndex(
            'idx-tbl_product_attribute-product_id',
            'tbl_product_attribute',
            'product_id'
        );


        $this->addForeignKey(
            'fk-tbl_product_attribute-product_id',
            'tbl_product_attribute',
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
            'fk-tbl_product_attribute-product_id',
            'tbl_product_attribute'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-tbl_product_attribute-product_id',
            'tbl_product_attribute'
        );

        $this->dropTable('tbl_product_attribute');
    }
}
