<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_language`.
 */
class m170117_073342_create_tbl_language_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_language', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(100)->unique(),
            'langugae_code'=>$this->char(5),
            'status'=>$this->string(20)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_language');
    }
}
