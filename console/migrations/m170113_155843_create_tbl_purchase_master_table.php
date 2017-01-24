<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_purchase_master`.
 */
class m170113_155843_create_tbl_purchase_master_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_purchase_master', [
            'id' => $this->primaryKey(),
            'description'=>$this->string(200)->notNull(),
            'country'=>$this->string(200)->notNull(),
            'period'=>$this->char(3)->notNull(),
            'financial_year'=>$this->string(200)->notNull(),
            'fcy_rate'=>$this->decimal(),
            'lcy_rate'=>$this->decimal(),
            'maker_id'=>$this->string(200),
            'maker_time'=>$this->dateTime(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_purchase_master');
    }
}
