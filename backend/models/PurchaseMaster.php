<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%purchase_master}}".
 *
 * @property integer $id
 * @property string $description
 * @property string $country
 * @property string $period
 * @property string $financial_year
 * @property string $fcy_rate
 * @property string $lcy_rate
 * @property string $maker_id
 * @property string $maker_time
 */
class PurchaseMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_purchase_master}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'country', 'period', 'financial_year'], 'required'],
            [['fcy_rate', 'lcy_rate'], 'number'],
            [['maker_time'], 'safe'],
            [['description', 'country', 'financial_year', 'maker_id'], 'string', 'max' => 200],
            [['period'], 'string', 'max' => 3],
        ];
    }

    //gets all batches

    public static function getAll()
    {
        return ArrayHelper::map(PurchaseMaster::find()->all(),'id','description');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'description' => Yii::t('app', 'Description'),
            'country' => Yii::t('app', 'Country'),
            'period' => Yii::t('app', 'Period'),
            'financial_year' => Yii::t('app', 'Financial Year'),
            'fcy_rate' => Yii::t('app', 'Fcy Rate'),
            'lcy_rate' => Yii::t('app', 'Lcy Rate'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }
}
