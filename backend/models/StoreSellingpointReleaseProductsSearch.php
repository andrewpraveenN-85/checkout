<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StoreSellingpointReleaseProducts;

/**
 * StoreSellingpointReleaseProductsSearch represents the model behind the search form of `backend\models\StoreSellingpointReleaseProducts`.
 */
class StoreSellingpointReleaseProductsSearch extends StoreSellingpointReleaseProducts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_selling_point_id', 'product_variation_id'], 'integer'],
            [['request_qty', 'recieve_qty', 'return_qty'], 'number'],
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
        $query = StoreSellingpointReleaseProducts::find();

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
            'store_selling_point_id' => $this->store_selling_point_id,
            'product_variation_id' => $this->product_variation_id,
            'request_qty' => $this->request_qty,
            'recieve_qty' => $this->recieve_qty,
            'return_qty' => $this->return_qty,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
