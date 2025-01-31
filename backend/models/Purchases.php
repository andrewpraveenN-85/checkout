<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "purchases".
 *
 * @property int $id
 * @property int $supplier_id
 * @property float $discount_amount
 * @property float $tax_amount
 * @property string $invoice_no
 * @property string $status
 * @property int $company_id
 * @property int|null $store_feature_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Companies $company
 * @property PurchaseItems[] $purchaseItems
 * @property RawItems[] $rawItems
 * @property CompanyFeatures $storeFeature
 * @property Suppliers $supplier
 */
class Purchases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['supplier_id', 'invoice_no', 'company_id'], 'required'],
            [['supplier_id', 'company_id', 'store_feature_id'], 'integer'],
            [['discount_amount', 'tax_amount'], 'number'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['invoice_no'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
            [['store_feature_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyFeatures::class, 'targetAttribute' => ['store_feature_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::class, 'targetAttribute' => ['supplier_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'supplier_id' => 'Supplier ID',
            'discount_amount' => 'Discount Amount',
            'tax_amount' => 'Tax Amount',
            'invoice_no' => 'Invoice No',
            'status' => 'Status',
            'company_id' => 'Company ID',
            'store_feature_id' => 'Store Feature ID',
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
     * Gets query for [[PurchaseItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseItems()
    {
        return $this->hasMany(PurchaseItems::class, ['purchase_id' => 'id']);
    }

    /**
     * Gets query for [[RawItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawItems()
    {
        return $this->hasMany(RawItems::class, ['id' => 'raw_items_id'])->viaTable('purchase_items', ['purchase_id' => 'id']);
    }

    /**
     * Gets query for [[StoreFeature]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreFeature()
    {
        return $this->hasOne(CompanyFeatures::class, ['id' => 'store_feature_id']);
    }

    /**
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Suppliers::class, ['id' => 'supplier_id']);
    }
}
