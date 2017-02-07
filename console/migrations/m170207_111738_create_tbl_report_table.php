<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_report`.
 */
class m170207_111738_create_tbl_report_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_report', [
            'id' => $this->primaryKey(),
            'report_name'=>$this->string(200)->notNull(),
            'module'=>$this->integer(),
            'path'=>$this->string(200),
            'status'=>$this->integer(),
        ]);

        // creates index for column `module`
        $this->createIndex(
            'idx-tbl_report-module',
            'tbl_report',
            'module'
        );


        // add foreign key for table `tbl_purchase_master`
        $this->addForeignKey(
            'fk-tbl_purchase_cost-module',
            'tbl_report',
            'module',
            'tbl_system_module',
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
            'fk-tbl_system_module-module',
            'tbl_system_module'
        );

        // drops index for column `supplier_id`
        $this->dropIndex(
            'idx-tbl_system_module-module',
            'tbl_system_module'
        );
        $this->dropTable('tbl_report');
    }
}
