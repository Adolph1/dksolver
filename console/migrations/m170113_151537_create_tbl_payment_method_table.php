<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_payment_method`.
 */
class m170113_151537_create_tbl_payment_method_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_payment_method', [
            'id' => $this->primaryKey(),
            'method_name'=>$this->string(200)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_payment_method');
    }
}
