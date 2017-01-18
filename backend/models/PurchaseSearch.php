<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Purchase;

/**
 * PurchaseSearch represents the model behind the search form about `backend\models\Purchase`.
 */
class PurchaseSearch extends Purchase
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'supplier_id', 'purchase_master_id'], 'integer'],
            [['invoice_number', 'purchase_date', 'maker_id', 'maker_time', 'auth_status', 'checker_id', 'checker_time'], 'safe'],
            [['price', 'qty', 'total'], 'number'],
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
        $query = Purchase::find();

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
            'purchase_date' => $this->purchase_date,
            'product_id' => $this->product_id,
            'price' => $this->price,
            'qty' => $this->qty,
            'total' => $this->total,
            'supplier_id' => $this->supplier_id,
            'purchase_master_id' => $this->purchase_master_id,
            'maker_time' => $this->maker_time,
            'checker_time' => $this->checker_time,
        ]);

        $query->andFilterWhere(['like', 'invoice_number', $this->invoice_number])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'auth_status', $this->auth_status])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id]);

        return $dataProvider;
    }
}
