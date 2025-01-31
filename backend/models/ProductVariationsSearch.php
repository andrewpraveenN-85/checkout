<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProductVariations;

/**
 * ProductVariationsSearch represents the model behind the search form of `backend\models\ProductVariations`.
 */
class ProductVariationsSearch extends ProductVariations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id'], 'integer'],
            [['code', 'barcode', 'picture', 'description', 'size', 'color', 'discount_type', 'status', 'created_at', 'updated_at'], 'safe'],
            [['width', 'height', 'length', 'weight', 'discount_amount', 'single_unit_price', 'bulk_unit_price'], 'number'],
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
        $query = ProductVariations::find();

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
            'product_id' => $this->product_id,
            'width' => $this->width,
            'height' => $this->height,
            'length' => $this->length,
            'weight' => $this->weight,
            'discount_amount' => $this->discount_amount,
            'single_unit_price' => $this->single_unit_price,
            'bulk_unit_price' => $this->bulk_unit_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'barcode', $this->barcode])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'size', $this->size])
            ->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'discount_type', $this->discount_type])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
