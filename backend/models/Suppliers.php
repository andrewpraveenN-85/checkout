<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "suppliers".
 *
 * @property int $id
 * @property string $name
 * @property string $registration_number
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $postal_code
 * @property string $phone
 * @property string $status
 * @property int $company_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Companies $company
 * @property Purchases[] $purchases
 */
class Suppliers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suppliers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'registration_number', 'address', 'city', 'state', 'country', 'postal_code', 'phone', 'company_id'], 'required'],
            [['address', 'status'], 'string'],
            [['company_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'registration_number', 'city', 'state', 'country', 'postal_code', 'phone'], 'string', 'max' => 255],
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
            'registration_number' => 'Registration Number',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'postal_code' => 'Postal Code',
            'phone' => 'Phone',
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
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchases::class, ['supplier_id' => 'id']);
    }
}
