<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "taxes".
 *
 * @property int $id
 * @property string $name
 * @property float $rate
 * @property int $company_id
 * @property string|null $effective_date
 * @property string|null $expiration_date
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
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
            [['name', 'rate', 'company_id', 'status'], 'required'],
            [['rate', 'company_id'], 'number'],
            [['effective_date', 'expiration_date', 'created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['name', 'company_id'], 'unique', 'targetAttribute' => ['name', 'company_id']],
            [['name'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'name' => 'Name',
            'rate' => 'Rate',
            'effective_date' => 'Effective',
            'expiration_date' => 'Expiration',
            'status' => 'Status',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ];
    }

    public function getCompany() {
        return $this->hasOne(Companies::class, ['id' => 'company_id']);
    }

    public function getConfigurations() {
        return $this->hasMany(Configurations::class, ['default_tax_id' => 'id']);
    }
}
