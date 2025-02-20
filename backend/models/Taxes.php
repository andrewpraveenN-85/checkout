<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taxes".
 *
 * @property int $id
 * @property string $name
 * @property float $rate
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
            [['name', 'rate'], 'required'],
            [['rate'], 'number'],
            [['effective_date', 'expiration_date', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['name', 'country'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'name' => 'Name',
            'rate' => 'Rate',
            'effective_date' => 'Effective Date',
            'expiration_date' => 'Expiration Date',
            'description' => 'Description',
            'created_at' => 'Created',
            'updated_at' => 'Updated ',
        ];
    }

    public function getCompany() {
        return $this->hasOne(Companies::class, ['id' => 'company_id']);
    }

    public function getConfigurations() {
        return $this->hasMany(Configurations::class, ['default_id' => 'id']);
    }
}