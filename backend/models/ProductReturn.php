<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_product_return".
 *
 * @property integer $id
 * @property string $trn_dt
 * @property integer $return_type
 * @property integer $product_id
 * @property string $price
 * @property string $qty
 * @property string $total
 * @property string $source_ref_no
 * @property string $description
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblProduct $product
 */
class ProductReturn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const SALES_RETURN=1;
    const PURCHASE_RETURN=0;
    public $product_name;

    public static function tableName()
    {
        return 'tbl_product_return';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['return_type', 'product_id','qty'], 'required'],
            [['trn_dt', 'maker_time'], 'safe'],
            [['return_type', 'product_id'], 'integer'],
            [['price', 'qty', 'total'], 'number'],
            [['source_ref_no', 'description', 'maker_id'], 'string', 'max' => 200],
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
            'trn_dt' => Yii::t('app', 'Date'),
            'return_type' => Yii::t('app', 'Return Type'),
            'product_id' => Yii::t('app', 'Product Name'),
            'price' => Yii::t('app', 'Price'),
            'qty' => Yii::t('app', 'Qty'),
            'total' => Yii::t('app', 'Total'),
            'source_ref_no' => Yii::t('app', 'Source Ref No'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
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
