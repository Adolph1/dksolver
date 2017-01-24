<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_purchase_invoice".
 *
 * @property integer $id
 * @property string $invoice_number
 * @property string $purchase_date
 * @property integer $supplier_id
 * @property integer $purchase_master_id
 * @property string $maker_id
 * @property string $maker_time
 * @property string $checker_id
 * @property string $checker_time
 *
 * @property TblPurchaseMaster $purchaseMaster
 * @property TblSupplier $supplier
 */
class PurchaseInvoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_purchase_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_date', 'maker_time', 'checker_time'], 'safe'],
            [['supplier_id', 'purchase_master_id'], 'required'],
            [['supplier_id', 'purchase_master_id'], 'integer'],
            [['invoice_number'], 'string', 'max' => 20],
            [['maker_id', 'checker_id'], 'string', 'max' => 200],
            [['purchase_master_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseMaster::className(), 'targetAttribute' => ['purchase_master_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'invoice_number' => Yii::t('app', 'Invoice Number'),
            'purchase_date' => Yii::t('app', 'Purchase Date'),
            'supplier_id' => Yii::t('app', 'Supplier ID'),
            'purchase_master_id' => Yii::t('app', 'Purchase Master ID'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'checker_id' => Yii::t('app', 'Checker ID'),
            'checker_time' => Yii::t('app', 'Checker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseMaster()
    {
        return $this->hasOne(PurchaseMaster::className(), ['id' => 'purchase_master_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }

    public function getPurchases()
    {
        return $this->hasMany(Purchase::className(), ['purchase_invoice_id' => 'id']);
    }
}
