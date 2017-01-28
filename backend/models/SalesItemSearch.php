<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SalesItem;

/**
 * SalesItemSearch represents the model behind the search form about `backend\models\SalesItem`.
 */
class SalesItemSearch extends SalesItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sales_id', 'product_id'], 'integer'],
            [['selling_price', 'qty', 'total'], 'number'],
            [['maker_id', 'maker_time', 'delete_stat'], 'safe'],
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
        $query = SalesItem::find();

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
            'sales_id' => $this->sales_id,
            'product_id' => $this->product_id,
            'selling_price' => $this->selling_price,
            'qty' => $this->qty,
            'total' => $this->total,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'delete_stat', $this->delete_stat]);

        return $dataProvider;
    }
}
