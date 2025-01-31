<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProductBatches;

/**
 * ProductBatchesSearch represents the model behind the search form of `backend\models\ProductBatches`.
 */
class ProductBatchesSearch extends ProductBatches
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_variation_id', 'factory_feature_id', 'store_feature_id', 'company_id'], 'integer'],
            [['batch_code', 'batch_expiry_date', 'status', 'created_at', 'updated_at'], 'safe'],
            [['qty', 'total_unit_cost'], 'number'],
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
        $query = ProductBatches::find();

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
            'qty' => $this->qty,
            'batch_expiry_date' => $this->batch_expiry_date,
            'total_unit_cost' => $this->total_unit_cost,
            'factory_feature_id' => $this->factory_feature_id,
            'store_feature_id' => $this->store_feature_id,
            'company_id' => $this->company_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'batch_code', $this->batch_code])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
