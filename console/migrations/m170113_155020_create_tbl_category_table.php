<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_category`.
 */
class m170113_155020_create_tbl_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_category', [
            'id' => $this->primaryKey(),
            'parent'=>$this->integer(),
            'title'=>$this->string(200),
            'description'=>$this->string(200),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_category');
    }
}
