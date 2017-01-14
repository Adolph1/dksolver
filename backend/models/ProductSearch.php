<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form about `backend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category', 'status'], 'integer'],
            [['product_code', 'barcode', 'description', 'maker_id', 'maker_time', 'auth_status', 'checker_id', 'checker_time'], 'safe'],
            [['buying_price', 'selling_price'], 'number'],
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
        $query = Product::find();

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
            'buying_price' => $this->buying_price,
            'selling_price' => $this->selling_price,
            'category' => $this->category,
            'status' => $this->status,
            'maker_time' => $this->maker_time,
            'checker_time' => $this->checker_time,
        ]);

        $query->andFilterWhere(['like', 'product_code', $this->product_code])
            ->andFilterWhere(['like', 'barcode', $this->barcode])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'auth_status', $this->auth_status])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id]);

        return $dataProvider;
    }
}
