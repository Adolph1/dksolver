<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_language".
 *
 * @property integer $id
 * @property string $title
 * @property string $langugae_code
 * @property string $status
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 100],
            [['langugae_code'], 'string', 'max' => 5],
            [['status'], 'string', 'max' => 20],
            [['title'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'langugae_code' => Yii::t('app', 'Language Code'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets default language
     */

    public static function getDefaultLang()
    {
        $lang=Language::find()->where(['status'=>'default'])->one();
        return $lang->langugae_code;
    }

    /**
     *
     */
    public static function getDefaultLangID()
    {
        $lang=Language::find()->where(['status'=>'default'])->one();
        return $lang->id;
    }


    /**
     * Gets default language
     */

    public static function getAll()
    {
        $lang=Language::find()->where(['status'=>'active'])->all();
        return $lang;
    }

}
