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
            [['trn_dt', 'total_qty', 'total_amount', 'maker_id', 'maker_time'], 'required'],
            [['trn_dt', 'maker_time'], 'safe'],
            [['total_qty', 'total_amount'], 'number'],
            [['customer_name', 'maker_id'], 'string', 'max' => 200],
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
        return $this->hasMany(TblSalesItem::className(), ['sales_id' => 'id']);
    }
}
