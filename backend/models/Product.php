<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%tbl_product}}".
 *
 * @property integer $id
 * @property string $product_code
 * @property string $barcode
 * @property string $product_name
 * @property string $description
 * @property integer $category
 * @property string $image
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
            [['product_name', 'category', 'status'], 'required'],
            [['description'], 'string'],
            [['category', 'status'], 'integer'],
            [['maker_time', 'checker_time'], 'safe'],
            [['product_code', 'barcode'], 'string', 'max' => 50],
            [['product_name', 'image', 'maker_id', 'checker_id'], 'string', 'max' => 200],
            [['auth_status'], 'string', 'max' => 1],
            [['product_code'], 'unique'],
            [['barcode'], 'unique'],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */

    //gets all categories

    public static function getAll()
    {
        return ArrayHelper::map(Product::find()->all(),'id','product_name');
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_code' => Yii::t('app', 'UPC/EAN/ISBN'),
            'barcode' => Yii::t('app', 'Barcode'),
            'product_name' => Yii::t('app', 'Product Name'),
            'description' => Yii::t('app', 'Description'),
            'category' => Yii::t('app', 'Category'),
            'image' => Yii::t('app', 'Image'),
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
        return $this->hasMany(TblInventory::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblPriceMaintanances()
    {
        return $this->hasMany(TblPriceMaintanance::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(TblCategory::className(), ['id' => 'category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblProductAttributes()
    {
        return $this->hasMany(TblProductAttribute::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblPurchases()
    {
        return $this->hasMany(TblPurchase::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblSales()
    {
        return $this->hasMany(TblSales::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblStockAdjustments()
    {
        return $this->hasMany(TblStockAdjustment::className(), ['product_id' => 'id']);
    }
}
