<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_payment_method".
 *
 * @property integer $id
 * @property string $method_name
 */
class PaymentMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_payment_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['method_name'], 'required'],
            [['method_name'], 'string', 'max' => 200],
        ];
    }
    //gets all Methods

    public static function getAll()
    {
        return ArrayHelper::map(PaymentMethod::find()->all(),'id','method_name');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'method_name' => Yii::t('app', 'Method Name'),
        ];
    }
}
