<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_inventory".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $buying_price
 * @property string $selling_price
 * @property string $qty
 * @property integer $min_level
 * @property string $last_updated
 * @property string $maker_id
 * @property string $maker_time
 * @property string $auth_status
 * @property string $checker_id
 * @property string $checker_time
 *
 * @property TblProduct $product
 */
class Inventory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_inventory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'min_level'], 'integer'],
            [['buying_price', 'selling_price', 'qty'], 'number'],
            [['last_updated', 'maker_time', 'checker_time'], 'safe'],
            [['maker_id', 'checker_id'], 'string', 'max' => 200],
            [['auth_status'], 'string', 'max' => 1],
            [['product_id'], 'unique'],
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
            'buying_price' => Yii::t('app', 'Buying Price'),
            'selling_price' => Yii::t('app', 'Selling Price'),
            'qty' => Yii::t('app', 'Qty'),
            'min_level' => Yii::t('app', 'Min Level'),
            'last_updated' => Yii::t('app', 'Last Updated'),
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
     * gets inventory quantity
     */
    public static function getQty($pid)
    {
        $product=Inventory::find()->where(['product_id'=>$pid])->one();
        if($product!=null){
            return $product->qty;
        }
        else{
            return;
        }
    }

    /**
     * gets inventory selling price
     */
    public static function getPrice($pid)
    {
        $product=Inventory::find()->where(['product_id'=>$pid])->one();
        if($product!=null){
            return $product->selling_price;
        }
        else{
            return;
        }

    }

    /**
     * gets minimal level products count
     */
    public static function getMinLevelCounts()
    {
        $products = Inventory::find()->all();
        if($products !=null) {
            $i = 0;

            foreach ($products as $product) {
                $count = Inventory::find()->where(['>', 'min_level', $product->qty])->one();
                if($count!=null) {
                    $i = $i + 1;
                }
            }
            return $i;
        }
    }

    /**
     * gets minimal level products
     */
    public static function getMinLevelProducts()
    {
        $products = Inventory::find()->all();
        if($products !=null) {


            return $products;
        }
    }
}
