<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_cashbook`.
 */
class m170113_160236_create_tbl_cashbook_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_cashbook', [
            'id' => $this->primaryKey(),
            'trn_dt'=>$this->date()->notNull(),
            'amount'=>$this->decimal()->notNull(),
            'drcr_ind'=>$this->char(1)->notNull(),
            'description'=>$this->string(200)->notNull(),
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
        $this->dropTable('tbl_cashbook');
    }
}
