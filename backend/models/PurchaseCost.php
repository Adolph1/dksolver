<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_purchase_cost".
 *
 * @property integer $id
 * @property integer $purchase_master_id
 * @property string $amount
 * @property string $description
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblPurchaseMaster $purchaseMaster
 */
class PurchaseCost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_purchase_cost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['purchase_master_id', 'amount', 'description'], 'required'],
            [['purchase_master_id'], 'integer'],
            [['amount'], 'number'],
            [['maker_time'], 'safe'],
            [['description', 'maker_id'], 'string', 'max' => 200],
            [['purchase_master_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseMaster::className(), 'targetAttribute' => ['purchase_master_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'purchase_master_id' => Yii::t('app', 'Purchase Master'),
            'amount' => Yii::t('app', 'Amount'),
            'description' => Yii::t('app', 'Description'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseMaster()
    {
        return $this->hasOne(PurchaseMaster::className(), ['id' => 'purchase_master_id']);
    }


    public static function getTotal($id)
    {

                $sum = PurchaseCost::find()->where(['purchase_master_id' => $id])->sum('amount');
                if($sum!=null){
                    return $sum;
                }
                else{
                    return;
                }

    }
}
