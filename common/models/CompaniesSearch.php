<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Companies;

/**
 * CompaniesSearch represents the model behind the search form of `backend\models\Companies`.
 */
class CompaniesSearch extends Companies {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'number_of_employees'], 'integer'],
            [['name', 'registration_number', 'industry', 'address', 'contact_number', 'email', 'website', 'logo', 'established_date', 'status', 'created_at', 'updated_at'], 'safe'],
            [['annual_revenue'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Companies::find();

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
            'established_date' => $this->established_date,
            'number_of_employees' => $this->number_of_employees,
            'annual_revenue' => $this->annual_revenue,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'registration_number', $this->registration_number])
                ->andFilterWhere(['like', 'industry', $this->industry])
                ->andFilterWhere(['like', 'address', $this->address])
                ->andFilterWhere(['like', 'contact_number', $this->contact_number])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'website', $this->website])
                ->andFilterWhere(['like', 'logo', $this->logo])
                ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
