<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tbl_product}}".
 *
 * @property integer $id
 * @property string $product_code
 * @property string $barcode
 * @property string $description
 * @property string $buying_price
 * @property string $selling_price
 * @property integer $category
 * @property integer $status
 * @property string $maker_id
 * @property string $maker_time
 * @property string $auth_status
 * @property string $checker_id
 * @property string $checker_time
 *
 * @property TblInventory[] $tblInventories
 * @property TblPriceMaintanance[] $tblPriceMaintanances
 * @property TblCategory $category0
 * @property TblProductAttribute[] $tblProductAttributes
 * @property TblPurchase[] $tblPurchases
 * @property TblSales[] $tblSales
 * @property TblStockAdjustment[] $tblStockAdjustments
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_code', 'barcode', 'description', 'buying_price', 'selling_price', 'category', 'status', 'maker_id', 'maker_time', 'checker_id', 'checker_time'], 'required'],
            [['buying_price', 'selling_price'], 'number'],
            [['category', 'status'], 'integer'],
            [['maker_time', 'checker_time'], 'safe'],
            [['product_code', 'barcode'], 'string', 'max' => 50],
            [['description', 'maker_id', 'checker_id'], 'string', 'max' => 200],
            [['auth_status'], 'string', 'max' => 1],
            [['product_code'], 'unique'],
            [['barcode'], 'unique'],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_code' => Yii::t('app', 'Product Code'),
            'barcode' => Yii::t('app', 'Barcode'),
            'description' => Yii::t('app', 'Description'),
            'buying_price' => Yii::t('app', 'Buying Price'),
            'selling_price' => Yii::t('app', 'Selling Price'),
            'category' => Yii::t('app', 'Category'),
            'status' => Yii::t('app', 'Status'),
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
    public function getTblInventories()
    {
        return $this->hasMany(Inventory::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblPriceMaintanances()
    {
        return $this->hasMany(PriceMaintanance::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblProductAttributes()
    {
        return $this->hasMany(ProductAttribute::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblPurchases()
    {
        return $this->hasMany(Purchase::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblSales()
    {
        return $this->hasMany(Sales::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblStockAdjustments()
    {
        return $this->hasMany(StockAdjustment::className(), ['product_id' => 'id']);
    }
}
