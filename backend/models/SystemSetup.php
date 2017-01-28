<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_system_setup".
 *
 * @property integer $id
 * @property string $tax
 * @property string $discount
 * @property string $currency
 * @property string $shop_name
 * @property string $shop_category
 * @property string $maker_checker
 */
class SystemSetup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const ALLOW_MAKERCHECKER='Y';
    const DISALLOW_MAKERCHECKER='N';

    public static function tableName()
    {
        return 'tbl_system_setup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tax', 'discount'], 'number'],
            [['maker_checker'], 'required'],
            [['currency'], 'string', 'max' => 20],
            [['shop_name', 'shop_category'], 'string', 'max' => 200],
            [['maker_checker'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tax' => Yii::t('app', 'Tax'),
            'discount' => Yii::t('app', 'Discount'),
            'currency' => Yii::t('app', 'Currency'),
            'shop_name' => Yii::t('app', 'Shop Name'),
            'shop_category' => Yii::t('app', 'Shop Category'),
            'maker_checker' => Yii::t('app', 'Maker Checker'),
        ];
    }

    /**
     * gets checker maker status
     */

    public static function getMakerChecker()
    {
        $status=SystemSetup::find()->one();

       return $status->maker_checker;
    }
}
