<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Configurations;

/**
 * ConfigurationsSearch represents the model behind the search form of `backend\models\Configurations`.
 */
class ConfigurationsSearch extends Configurations
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'default_tax_id', 'default_currency_id', 'default_language_id', 'smtp_configuration_id', 'return_policy_days', 'enable_notifications'], 'integer'],
            [['timezone', 'created_at', 'updated_at'], 'safe'],
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
        $query = Configurations::find();

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
            'company_id' => $this->company_id,
            'default_tax_id' => $this->default_tax_id,
            'default_currency_id' => $this->default_currency_id,
            'default_language_id' => $this->default_language_id,
            'smtp_configuration_id' => $this->smtp_configuration_id,
            'return_policy_days' => $this->return_policy_days,
            'enable_notifications' => $this->enable_notifications,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'timezone', $this->timezone]);

        return $dataProvider;
    }
}
