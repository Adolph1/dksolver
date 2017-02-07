<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_purchase_cost`.
 */
class m170207_044510_create_tbl_purchase_cost_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_purchase_cost', [
            'id' => $this->primaryKey(),
            'purchase_master_id'=>$this->integer()->notNull(),
            'amount'=>$this->decimal()->notNull(),
            'description'=>$this->string(200)->notNull(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
        ]);
        // creates index for column `purchase_master_id`
        $this->createIndex(
            'idx-tbl_purchase_cost-purchase_master_id',
            'tbl_purchase_cost',
            'purchase_master_id'
        );


        // add foreign key for table `tbl_purchase_master`
        $this->addForeignKey(
            'fk-tbl_purchase_cost-purchase_master_id',
            'tbl_purchase_cost',
            'purchase_master_id',
            'tbl_purchase_master',
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
            'fk-tbl_purchase_cost-purchase_master_id',
            'tbl_purchase_cost'
        );

        // drops index for column `supplier_id`
        $this->dropIndex(
            'idx-tbl_purchase_cost-purchase_master_id',
            'tbl_purchase_cost'
        );
        $this->dropTable('tbl_purchase_cost');
    }
}
