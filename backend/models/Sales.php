<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_sales".
 *
 * @property integer $id
 * @property string $trn_dt
 * @property string $total_qty
 * @property string $total_amount
 * @property string $paid_amount
 * @property integer $payment_method
 * @property string $source_ref_number
 * @property string $notes
 * @property string $customer_name
 * @property string $maker_id
 * @property string $maker_time
 * @property string $status
 *
 * @property TblSalesItem[] $tblSalesItems
 */
class Sales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $product_name;
    public static function tableName()
    {
        return 'tbl_sales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trn_dt', 'total_qty', 'total_amount', 'paid_amount', 'payment_method', 'maker_id', 'maker_time'], 'required'],
            [['trn_dt', 'maker_time'], 'safe'],
            [['total_qty', 'total_amount', 'paid_amount'], 'number'],
            [['payment_method'], 'integer'],
            [['source_ref_number', 'notes', 'customer_name', 'maker_id'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_dt' => Yii::t('app', 'Trn Dt'),
            'total_qty' => Yii::t('app', 'Total Qty'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'paid_amount' => Yii::t('app', 'Paid Amount'),
            'payment_method' => Yii::t('app', 'Payment Method'),
            'source_ref_number' => Yii::t('app', 'Source Ref Number'),
            'notes' => Yii::t('app', 'Notes'),
            'customer_name' => Yii::t('app', 'Customer Name'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblSalesItems()
    {
        return $this->hasMany(SalesItem::className(), ['sales_id' => 'id']);
    }
}
