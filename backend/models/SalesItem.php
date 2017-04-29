<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_sales_item".
 *
 * @property integer $id
 * @property integer $sales_id
 * @property integer $product_id
 * @property string $selling_price
 * @property string $qty
 * @property string $total
 * @property string $maker_id
 * @property string $maker_time
 * @property string $delete_stat
 *
 * @property TblProduct $product
 * @property TblSales $sales
 */
class SalesItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sales_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sales_id', 'product_id'], 'integer'],
            [['selling_price', 'qty', 'total'], 'number'],
            [['maker_time','trn_dt'], 'safe'],
            [['maker_id'], 'string', 'max' => 200],
            [['delete_stat'], 'string', 'max' => 1],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['sales_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::className(), 'targetAttribute' => ['sales_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_dt'=>Yii::t('app', 'Date'),
            'sales_id' => Yii::t('app', 'Sales No'),
            'product_id' => Yii::t('app', 'Product Name'),
            'selling_price' => Yii::t('app', 'Selling Price'),
            'qty' => Yii::t('app', 'Qty'),
            'total' => Yii::t('app', 'Total'),
            'previous_balance'=>Yii::t('app', 'Previous Balance'),
            'balance'=>Yii::t('app', 'Balance'),
            'maker_id' => Yii::t('app', 'Salesperson'),
            'maker_time' => Yii::t('app', 'Selling time'),
            'delete_stat' => Yii::t('app', 'Delete Stat'),
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
    public function getSales()
    {
        return $this->hasOne(Sales::className(), ['id' => 'sales_id']);
    }

    public static function getAll($id)
    {
       return SalesItem::find()->where(['sales_id'=>$id])->all();
    }

    public static function getAllActive($id)
    {
        return SalesItem::find()->where(['sales_id'=>$id,'delete_stat'=>null])->all();
    }

    public static function getTotalSales()
    {
        $fmt = Yii::$app->formatter;
        $totalsales=SalesItem::find()->where(['delete_stat'=>NULL])->sum('total');
        return $fmt->asDecimal($totalsales,2);
    }
}
