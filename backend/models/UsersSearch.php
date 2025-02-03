<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Users;

/**
 * UsersSearch represents the model behind the search form of `backend\models\Users`.
 */
class UsersSearch extends Users {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['id', 'company_id'], 'integer'],
            [['first_name', 'contact_number', 'user_type', 'email', 'status', 'role_name'], 'safe'],
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
        $query = Users::find()->alias('u')->joinWith('roles'); // Define alias 'u' for users table
        // Add conditions that should always apply
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Enable sorting for role name
        $dataProvider->sort->attributes['role_name'] = [
            'asc' => ['roles.name' => SORT_ASC],
            'desc' => ['roles.name' => SORT_DESC],
        ];

        // Enable sorting for status using FIELD function
        $dataProvider->sort->attributes['status'] = [
            'asc' => [new \yii\db\Expression("FIELD(u.status, 'active', 'inactive')")],
            'desc' => [new \yii\db\Expression("FIELD(u.status, 'inactive', 'active')")],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // Grid filtering conditions
        $query->andFilterWhere([
            'u.id' => $this->id,
            'u.company_id' => $this->company_id, // Now works because 'u' alias is set
        ]);

        $query->andFilterWhere(['like', 'u.first_name', $this->first_name])
                ->andFilterWhere(['like', 'u.contact_number', $this->contact_number])
                ->andFilterWhere(['like', 'u.email', $this->email])
                ->andFilterWhere(['like', 'u.status', $this->status])
                ->andFilterWhere(['roles.id' => $this->role_name]); // Filtering by role name

        return $dataProvider;
    }
}
