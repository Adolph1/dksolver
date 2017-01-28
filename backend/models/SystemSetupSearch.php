<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\SystemSetup;

/**
 * SystemSetupSearch represents the model behind the search form about `backend\models\SystemSetup`.
 */
class SystemSetupSearch extends SystemSetup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tax', 'discount'], 'number'],
            [['currency', 'shop_name', 'shop_category', 'maker_checker'], 'safe'],
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
        $query = SystemSetup::find();

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
            'tax' => $this->tax,
            'discount' => $this->discount,
        ]);

        $query->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'shop_name', $this->shop_name])
            ->andFilterWhere(['like', 'shop_category', $this->shop_category])
            ->andFilterWhere(['like', 'maker_checker', $this->maker_checker]);

        return $dataProvider;
    }
}
