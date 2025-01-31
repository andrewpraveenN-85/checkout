<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ManufractureTemplates;

/**
 * ManufractureTemplatesSearch represents the model behind the search form of `backend\models\ManufractureTemplates`.
 */
class ManufractureTemplatesSearch extends ManufractureTemplates
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_variation_id', 'raw_item_id'], 'integer'],
            [['usage_qty', 'wastage_qty', 'cost_of_total_raw_item'], 'number'],
            [['status', 'created_at', 'updated_at'], 'safe'],
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
        $query = ManufractureTemplates::find();

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
            'product_variation_id' => $this->product_variation_id,
            'raw_item_id' => $this->raw_item_id,
            'usage_qty' => $this->usage_qty,
            'wastage_qty' => $this->wastage_qty,
            'cost_of_total_raw_item' => $this->cost_of_total_raw_item,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
