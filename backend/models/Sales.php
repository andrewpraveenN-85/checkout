<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sales".
 *
 * @property int $id
 * @property string $invoice_number
 * @property int|null $customer_id
 * @property int|null $employee_id
 * @property string $discount_type
 * @property float $discount_amount
 * @property float $tax_amount
 * @property string $sales_type
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Users $customer
 * @property Users $employee
 * @property ProductVariations[] $productVariations
 * @property SalesDeliveries[] $salesDeliveries
 * @property SalesPaymentReferences[] $salesPaymentReferences
 * @property SalesProducts[] $salesProducts
 */
class Sales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['invoice_number'], 'required'],
            [['customer_id', 'employee_id'], 'integer'],
            [['discount_type', 'sales_type'], 'string'],
            [['discount_amount', 'tax_amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['invoice_number'], 'string', 'max' => 255],
            [['invoice_number'], 'unique'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['customer_id' => 'id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['employee_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_number' => 'Invoice Number',
            'customer_id' => 'Customer ID',
            'employee_id' => 'Employee ID',
            'discount_type' => 'Discount Type',
            'discount_amount' => 'Discount Amount',
            'tax_amount' => 'Tax Amount',
            'sales_type' => 'Sales Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Users::class, ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Users::class, ['id' => 'employee_id']);
    }

    /**
     * Gets query for [[ProductVariations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariations()
    {
        return $this->hasMany(ProductVariations::class, ['id' => 'product_variation_id'])->viaTable('sales_products', ['sales_id' => 'id']);
    }

    /**
     * Gets query for [[SalesDeliveries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesDeliveries()
    {
        return $this->hasMany(SalesDeliveries::class, ['sales_id' => 'id']);
    }

    /**
     * Gets query for [[SalesPaymentReferences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesPaymentReferences()
    {
        return $this->hasMany(SalesPaymentReferences::class, ['sales_id' => 'id']);
    }

    /**
     * Gets query for [[SalesProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesProducts()
    {
        return $this->hasMany(SalesProducts::class, ['sales_id' => 'id']);
    }
}
