<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_system_module`.
 */
class m170113_160533_create_tbl_system_module_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_system_module', [
            'id' => $this->primaryKey(),
            'module_name'=>$this->string(200)->notNull(),
            'description'=>$this->string(200),
            'status'=>$this->char(1)->notNull(),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
            'auth_status'=>$this->char(1),
            'checker_id'=>$this->string(200)->notNull(),
            'checker_time'=>$this->dateTime()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_system_module');
    }
}
