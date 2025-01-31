<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "measurement_units".
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property int $company_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Companies $company
 * @property Products[] $products
 * @property Products[] $products0
 * @property Products[] $products1
 * @property Products[] $products2
 * @property RawItems[] $rawItems
 * @property RawItems[] $rawItems0
 * @property RawItems[] $rawItems1
 */
class MeasurementUnits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'measurement_units';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'company_id'], 'required'],
            [['status'], 'string'],
            [['company_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'company_id' => 'Company ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::class, ['id' => 'company_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::class, ['bulk_selling_measurement_unit' => 'id']);
    }

    /**
     * Gets query for [[Products0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts0()
    {
        return $this->hasMany(Products::class, ['release_measurement_unit_id' => 'id']);
    }

    /**
     * Gets query for [[Products1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts1()
    {
        return $this->hasMany(Products::class, ['single_unit_selling_measurement_unit' => 'id']);
    }

    /**
     * Gets query for [[Products2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts2()
    {
        return $this->hasMany(Products::class, ['store_measurement_unit_id' => 'id']);
    }

    /**
     * Gets query for [[RawItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawItems()
    {
        return $this->hasMany(RawItems::class, ['production_measurement_unit' => 'id']);
    }

    /**
     * Gets query for [[RawItems0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawItems0()
    {
        return $this->hasMany(RawItems::class, ['release_measurement_unit_id' => 'id']);
    }

    /**
     * Gets query for [[RawItems1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawItems1()
    {
        return $this->hasMany(RawItems::class, ['store_measurement_unit_id' => 'id']);
    }
}
