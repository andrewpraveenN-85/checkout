<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RawItems;

/**
 * RawItemsSearch represents the model behind the search form of `backend\models\RawItems`.
 */
class RawItemsSearch extends RawItems
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'raw_items_category_id', 'raw_items_brand_id', 'store_measurement_unit_id', 'release_measurement_unit_id', 'production_measurement_unit', 'company_id'], 'integer'],
            [['name', 'description', 'picture', 'status', 'created_at', 'updated_at'], 'safe'],
            [['store_to_release_measurement_conversion', 'release_to_production_measurement_conversion'], 'number'],
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
        $query = RawItems::find();

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
            'raw_items_category_id' => $this->raw_items_category_id,
            'raw_items_brand_id' => $this->raw_items_brand_id,
            'store_measurement_unit_id' => $this->store_measurement_unit_id,
            'release_measurement_unit_id' => $this->release_measurement_unit_id,
            'store_to_release_measurement_conversion' => $this->store_to_release_measurement_conversion,
            'production_measurement_unit' => $this->production_measurement_unit,
            'release_to_production_measurement_conversion' => $this->release_to_production_measurement_conversion,
            'company_id' => $this->company_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
