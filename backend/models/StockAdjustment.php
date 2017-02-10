<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_stock_adjustment".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $adjust_type
 * @property string $qty
 * @property string $amount
 * @property integer $total_amount
 * @property string $description
 * @property string $maker_id
 * @property string $maker_time
 * @property string $auth_status
 * @property string $checker_id
 * @property string $checker_time
 *
 * @property TblProduct $product
 */
class StockAdjustment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const INCREASE=1;
    const DECREASE=0;

    public static function tableName()
    {
        return 'tbl_stock_adjustment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'adjust_type', 'qty','description'], 'required'],
            [['product_id', 'adjust_type', 'total_amount'], 'integer'],
            [['qty', 'amount','stock_change'], 'number'],
            [['maker_time', 'checker_time'], 'safe'],
            [['description', 'maker_id', 'checker_id'], 'string', 'max' => 200],
            [['auth_status'], 'string', 'max' => 1],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product Name'),
            'adjust_type' => Yii::t('app', 'Adjust Type'),
            'qty' => Yii::t('app', 'Current Stock'),
            'stock_change' => Yii::t('app', 'Stock to change'),
            'amount' => Yii::t('app', 'Selling Price'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'description' => Yii::t('app', 'Description'),
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
}
