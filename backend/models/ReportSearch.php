<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Report;

/**
 * ReportSearch represents the model behind the search form about `backend\models\Report`.
 */
class ReportSearch extends Report
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'module', 'status'], 'integer'],
            [['report_name', 'path'], 'safe'],
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
    /*public function search($params)
    {
        $query = Report::find();

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
            'module' => $this->module,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'report_name', $this->report_name])
            ->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }*/

    public function search($id,$from,$to)
    {
        if($id==1) {

            $query = Sales::find();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            $query->andFilterWhere(['between', 'trn_dt', $from, $to]);
            $query->andWhere(['!=','status','D']);
            return $dataProvider;
        }

        elseif($id==2) {

            $query = SalesItem::find();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            $query->andWhere(['delete_stat'=>NULL]);
            $query->andFilterWhere(['between', 'trn_dt', $from, $to]);

            return $dataProvider;
        }
        elseif($id==3) {

            $query = Purchase::find();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            $query->andFilterWhere(['between', 'prchs_dt', $from, $to]);
            $query->andWhere(['delete_stat'=>NULL]);
            return $dataProvider;
        }
        elseif($id==4) {

            $query = SalesItem::find();

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            $query->andWhere(['delete_stat'=>NULL]);
            $query->andFilterWhere(['between', 'trn_dt', $from, $to]);
            return $dataProvider;
        }
    }
}
