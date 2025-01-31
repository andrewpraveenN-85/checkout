<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Taxes;

/**
 * TaxesSearch represents the model behind the search form of `backend\models\Taxes`.
 */
class TaxesSearch extends Taxes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tax_name', 'country', 'effective_date', 'expiration_date', 'description', 'created_at', 'updated_at'], 'safe'],
            [['tax_rate'], 'number'],
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
        $query = Taxes::find();

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
            'tax_rate' => $this->tax_rate,
            'effective_date' => $this->effective_date,
            'expiration_date' => $this->expiration_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'tax_name', $this->tax_name])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
