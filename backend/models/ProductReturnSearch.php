<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProductReturn;

/**
 * ProductReturnSearch represents the model behind the search form about `backend\models\ProductReturn`.
 */
class ProductReturnSearch extends ProductReturn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'return_type', 'product_id'], 'integer'],
            [['trn_dt', 'source_ref_no', 'description', 'maker_id', 'maker_time'], 'safe'],
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
        $query = ProductReturn::find();

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
            '!=','status','D'
        ]);


        return $dataProvider;
    }
}
