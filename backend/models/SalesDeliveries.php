<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sales_deliveries".
 *
 * @property int $id
 * @property int $sales_id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string $contact_number
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $postal_code
 * @property string|null $qr_image
 * @property string|null $bar_code_image
 * @property float $delivery_charge_fees
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Sales $sales
 */
class SalesDeliveries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_deliveries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sales_id', 'first_name', 'last_name', 'contact_number', 'address', 'city', 'state', 'country', 'postal_code'], 'required'],
            [['sales_id'], 'integer'],
            [['address'], 'string'],
            [['delivery_charge_fees'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name', 'middle_name', 'last_name', 'contact_number', 'city', 'state', 'country', 'postal_code', 'qr_image', 'bar_code_image', 'status'], 'string', 'max' => 255],
            [['sales_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::class, 'targetAttribute' => ['sales_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sales_id' => 'Sales ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'contact_number' => 'Contact Number',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'postal_code' => 'Postal Code',
            'qr_image' => 'Qr Image',
            'bar_code_image' => 'Bar Code Image',
            'delivery_charge_fees' => 'Delivery Charge Fees',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasOne(Sales::class, ['id' => 'sales_id']);
    }
}
