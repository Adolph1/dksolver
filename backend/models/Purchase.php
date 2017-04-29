<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_purchase".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $price
 * @property string $qty
 * @property string $total
 * @property integer $purchase_invoice_id
 * @property string $maker_id
 * @property string $maker_time
 * @property string $auth_status
 * @property string $checker_id
 * @property string $checker_time
 *
 * @property TblProduct $product
 * @property TblPurchaseInvoice $purchaseInvoice
 */
class Purchase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    const UPDATED=1;
    const PENDING=0;

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
            [['product_id', 'price', 'qty'], 'required'],
            [['product_id', 'purchase_invoice_id'], 'integer'],
            [['price', 'qty', 'total','selling_price','balance','previous_balance'], 'number'],
            [['maker_time', 'checker_time'], 'safe'],
            [['maker_id', 'checker_id'], 'string', 'max' => 200],
            [['auth_status'], 'string', 'max' => 1],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['purchase_invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseInvoice::className(), 'targetAttribute' => ['purchase_invoice_id' => 'id']],
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
            'prchs_dt' => Yii::t('app', 'Purchase Date'),
            'price' => Yii::t('app', 'Price'),
            'qty' => Yii::t('app', 'Qty'),
            'selling_price'=>Yii::t('app', 'Selling Price'),
            'previous_balance'=>Yii::t('app', 'Previous balance'),
            'balance'=>Yii::t('app', 'Balance'),
            'total' => Yii::t('app', 'Total'),
            'purchase_invoice_id' => Yii::t('app', 'Invoice Number'),
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
    public function getPurchaseInvoice()
    {
        return $this->hasOne(PurchaseInvoice::className(), ['id' => 'purchase_invoice_id']);
    }

    /**
     * gets total amount of the invoice
     */

    public static function getInvoiceTotal($id)
    {
        return Purchase::find()->where(['purchase_invoice_id'=>$id])->sum('total');
    }

    /**
     * gets all un-authorised purchases
     */

    public static function getUnauthorised($id)
    {
        $count= Purchase::find()->where(['auth_status'=>'U','purchase_invoice_id'=>$id])->count();
        if($count!=null){
            return $count;
        }
        else{
            return;
        }
    }


    public static function getTotalPurchases()
    {
        $fmt = Yii::$app->formatter;
        $sum=Purchase::find()->where(['delete_stat'=>NULL])->sum('total');
        return $fmt->asDecimal($sum,2);
    }
}
