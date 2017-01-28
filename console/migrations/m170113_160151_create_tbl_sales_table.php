<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tbl_sales`.
 */
class m170113_160151_create_tbl_sales_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tbl_sales', [
            'id' => $this->primaryKey(),
            'trn_dt'=>$this->date()->notNull(),
            'total_qty'=>$this->decimal()->notNull(),
            'total_amount'=>$this->decimal()->notNull(),
            'paid_amount'=>$this->decimal()->notNull(),
            'payment_method'=>$this->integer()->notNull(),
            'source_ref_number'=>$this->string(200),
            'notes'=>$this->string(200),
            'customer_name'=>$this->string(200),
            'maker_id'=>$this->string(200)->notNull(),
            'maker_time'=>$this->dateTime()->notNull(),
            'status'=>$this->char(1),


        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('tbl_sales');
    }
}
