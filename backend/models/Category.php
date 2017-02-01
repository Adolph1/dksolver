<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%tbl_category}}".
 *
 * @property integer $id
 * @property integer $parent
 * @property string $title
 * @property string $description
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property TblProduct[] $tblProducts
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tbl_category}}';
    }

    //gets all categories

    public static function getAll()
    {
       return ArrayHelper::map(Category::find()->all(),'id','title');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent'], 'integer'],
            [['title'], 'required'],
            [['maker_time'], 'safe'],
            [['title', 'description', 'maker_id'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent' => Yii::t('app', 'Parent'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblProducts()
    {
        return $this->hasMany(Product::className(), ['category' => 'id']);
    }
    public static function getParent($id)
    {

        $parent=Category::find()->where(['id'=>$id])->one();
        if($parent==null)
        {
            return ' ';
        }
        else {
            return $parent->title;
        }
    }


    /**
     * gets Category name
     */
    public static function getName($id){

        $cate=Category::findOne($id);
        return $cate->title;
    }
}
