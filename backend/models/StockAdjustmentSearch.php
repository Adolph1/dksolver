<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StockAdjustment;

/**
 * StockAdjustmentSearch represents the model behind the search form about `backend\models\StockAdjustment`.
 */
class StockAdjustmentSearch extends StockAdjustment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'adjust_type', 'total_amount'], 'integer'],
            [['qty', 'amount'], 'number'],
            [['description', 'maker_id', 'maker_time', 'auth_status', 'checker_id', 'checker_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = StockAdjustment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        // grid filtering conditions
        $query->andWhere([

            'delete_status'=>'',
        ]);


        return $dataProvider;
    }
}
