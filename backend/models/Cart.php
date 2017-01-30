<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_cart".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $price
 * @property string $qty
 * @property string $total
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblProduct $product
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['product_id'], 'integer'],
            [['price', 'qty', 'total'], 'number'],
            [['maker_time'], 'safe'],
            [['maker_id'], 'string', 'max' => 200],
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
            'price' => Yii::t('app', 'Price'),
            'qty' => Yii::t('app', 'Qty'),
            'total' => Yii::t('app', 'Total'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
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
