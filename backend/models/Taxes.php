<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taxes".
 *
 * @property int $id
 * @property string $tax_name
 * @property float $tax_rate
 * @property string|null $country
 * @property string|null $effective_date
 * @property string|null $expiration_date
 * @property string|null $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 * @property int $company_id
 *
 * @property Companies $company
 * @property Configurations[] $configurations
 * @property Companies $company
 */
class Taxes extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'taxes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['tax_name', 'tax_rate'], 'required'],
            [['tax_rate'], 'number'],
            [['effective_date', 'expiration_date', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['tax_name', 'country'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'tax_name' => 'Tax Name',
            'tax_rate' => 'Tax Rate',
            'country' => 'Country',
            'effective_date' => 'Effective Date',
            'expiration_date' => 'Expiration Date',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCompany() {
        return $this->hasOne(Companies::class, ['id' => 'company_id']);
    }

    public function getConfigurations() {
        return $this->hasMany(Configurations::class, ['default_tax_id' => 'id']);
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
}