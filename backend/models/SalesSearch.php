<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sales;

/**
 * SalesSearch represents the model behind the search form about `backend\models\Sales`.
 */
class SalesSearch extends Sales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'payment_method'], 'integer'],
            [['trn_dt', 'source_ref_number', 'notes', 'customer_name', 'maker_id', 'maker_time', 'status'], 'safe'],
            [['total_qty', 'total_amount', 'paid_amount'], 'number'],
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
        $query = Sales::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'trn_dt' => $this->trn_dt,
            'total_qty' => $this->total_qty,
            'total_amount' => $this->total_amount,
            'paid_amount' => $this->paid_amount,
            'payment_method' => $this->payment_method,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'source_ref_number', $this->source_ref_number])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

/**
 * Searches today's sales
 */

    public function searchTodaySales()
    {
        $query = Sales::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);



        // grid filtering conditions
        $query->andFilterWhere([
            'trn_dt' => date('Y-m-d'),

        ]);

        return $dataProvider;
    }

}
