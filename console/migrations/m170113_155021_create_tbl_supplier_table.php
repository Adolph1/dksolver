<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_supplier`.
 */
class m170113_155021_create_tbl_supplier_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_supplier', [
            'id' => $this->primaryKey(),
            'supplier_name'=>$this->string(200)->notNull(),
            'email'=>$this->string(200),
            'phone_number'=>$this->string(13)->notNull(),
            'location'=>$this->string(200)->notNull(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_supplier');
    }
}
