<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_system_module".
 *
 * @property integer $id
 * @property string $module_name
 * @property string $description
 * @property string $status
 * @property string $maker_id
 * @property string $maker_time
 * @property string $auth_status
 * @property string $checker_id
 * @property string $checker_time
 */
class SystemModule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_system_module';
    }

    //gets all Modules

    public static function getAll()
    {
        return ArrayHelper::map(SystemModule::find()->all(),'id','module_name');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_name', 'status'], 'required'],
            [['maker_time', 'checker_time'], 'safe'],
            [['module_name', 'description', 'maker_id', 'checker_id'], 'string', 'max' => 200],
            [['status', 'auth_status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'module_name' => Yii::t('app', 'Module Name'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'auth_status' => Yii::t('app', 'Auth Status'),
            'checker_id' => Yii::t('app', 'Checker ID'),
            'checker_time' => Yii::t('app', 'Checker Time'),
        ];
    }
}
