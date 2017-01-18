<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_purchase".
 *
 * @property integer $id
 * @property string $invoice_number
 * @property string $purchase_date
 * @property integer $product_id
 * @property string $price
 * @property string $qty
 * @property string $total
 * @property integer $supplier_id
 * @property integer $purchase_master_id
 * @property string $maker_id
 * @property string $maker_time
 * @property string $auth_status
 * @property string $checker_id
 * @property string $checker_time
 *
 * @property TblProduct $product
 * @property TblSupplier $supplier
 */
class Purchase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_purchase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_date', 'maker_time', 'checker_time'], 'safe'],
            [['product_id', 'price', 'qty', 'total', 'supplier_id'], 'required'],
            [['product_id', 'supplier_id', 'purchase_master_id'], 'integer'],
            [['price', 'qty', 'total'], 'number'],
            [['invoice_number'], 'string', 'max' => 20],
            [['maker_id', 'checker_id'], 'string', 'max' => 200],
            [['auth_status'], 'string', 'max' => 1],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
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
            'product_id' => Yii::t('app', 'Product Name'),
            'price' => Yii::t('app', 'Price'),
            'qty' => Yii::t('app', 'Qty'),
            'total' => Yii::t('app', 'Total'),
            'supplier_id' => Yii::t('app', 'Supplier'),
            'purchase_master_id' => Yii::t('app', 'Purchase Batch'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'auth_status' => Yii::t('app', 'Auth Status'),
            'checker_id' => Yii::t('app', 'Checker ID'),
            'checker_time' => Yii::t('app', 'Checker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }
}
