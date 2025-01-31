<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Currencies;

/**
 * CurrenciesSearch represents the model behind the search form of `backend\models\Currencies`.
 */
class CurrenciesSearch extends Currencies
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['currency_code', 'currency_name', 'symbol', 'base_currency_code', 'effective_date', 'created_at', 'updated_at'], 'safe'],
            [['exchange_rate'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Currencies::find();

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
            'exchange_rate' => $this->exchange_rate,
            'effective_date' => $this->effective_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'currency_code', $this->currency_code])
            ->andFilterWhere(['like', 'currency_name', $this->currency_name])
            ->andFilterWhere(['like', 'symbol', $this->symbol])
            ->andFilterWhere(['like', 'base_currency_code', $this->base_currency_code]);

        return $dataProvider;
    }
}
