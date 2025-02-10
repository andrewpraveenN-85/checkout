<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "states".
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Cities[] $cities
 * @property Countries $country
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'states';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'country_id'], 'required'],
            [['country_id'], 'integer'],
            [['status'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::class, 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'country_id' => 'Country',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(Cities::class, ['state_id' => 'id']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::class, ['id' => 'country_id']);
    }
}
