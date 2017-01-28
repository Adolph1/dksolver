<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Inventory;

/**
 * InventorySearch represents the model behind the search form about `backend\models\Inventory`.
 */
class InventorySearch extends Inventory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'min_level'], 'integer'],
            [['buying_price', 'selling_price', 'qty'], 'number'],
            [['last_updated', 'maker_id', 'maker_time', 'auth_status', 'checker_id', 'checker_time'], 'safe'],
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
        $query = Inventory::find();

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
            'product_id' => $this->product_id,
            'buying_price' => $this->buying_price,
            'selling_price' => $this->selling_price,
            'qty' => $this->qty,
            'min_level' => $this->min_level,
            'last_updated' => $this->last_updated,
            'maker_time' => $this->maker_time,
            'checker_time' => $this->checker_time,
        ]);

        $query->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'auth_status', $this->auth_status])
            ->andFilterWhere(['like', 'checker_id', $this->checker_id]);

        return $dataProvider;
    }
}
