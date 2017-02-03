<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_price_maintanance".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $price_type
 * @property string $old_price
 * @property string $new_price
 * @property string $reason
 * @property string $maker_id
 * @property string $maker_time
 * @property string $auth_status
 * @property string $checker_id
 * @property string $checker_time
 *
 * @property TblProduct $product
 */
class PriceMaintanance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_price_maintanance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id','old_price', 'new_price', 'reason'], 'required'],
            [['product_id', 'price_type'], 'integer'],
            [['old_price', 'new_price'], 'number'],
            [['maker_time', 'checker_time'], 'safe'],
            [['reason', 'maker_id', 'checker_id'], 'string', 'max' => 200],
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
            'product_id' => Yii::t('app', 'Product name'),
            'price_type' => Yii::t('app', 'Price Type'),
            'old_price' => Yii::t('app', 'Current Price'),
            'new_price' => Yii::t('app', 'New Price'),
            'reason' => Yii::t('app', 'Reason'),
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
