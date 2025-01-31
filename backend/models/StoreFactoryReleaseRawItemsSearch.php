<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StoreFactoryReleaseRawItems;

/**
 * StoreFactoryReleaseRawItemsSearch represents the model behind the search form of `backend\models\StoreFactoryReleaseRawItems`.
 */
class StoreFactoryReleaseRawItemsSearch extends StoreFactoryReleaseRawItems
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stock_transfer_id', 'raw_items_id'], 'integer'],
            [['request_qty', 'receive_qty', 'return_qty'], 'number'],
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
        $query = StoreFactoryReleaseRawItems::find();

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
            'stock_transfer_id' => $this->stock_transfer_id,
            'raw_items_id' => $this->raw_items_id,
            'request_qty' => $this->request_qty,
            'receive_qty' => $this->receive_qty,
            'return_qty' => $this->return_qty,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
