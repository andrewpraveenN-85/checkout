<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_batches".
 *
 * @property int $id
 * @property int $product_variation_id
 * @property string $batch_code
 * @property float $qty
 * @property string|null $batch_expiry_date
 * @property float $total_unit_cost
 * @property int|null $factory_feature_id
 * @property int|null $store_feature_id
 * @property int $company_id
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Companies $company
 * @property CompanyFeatures $factoryFeature
 * @property ProductVariations $productVariation
 * @property CompanyFeatures $storeFeature
 */
class ProductBatches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_batches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_variation_id', 'batch_code', 'qty', 'total_unit_cost', 'company_id'], 'required'],
            [['product_variation_id', 'factory_feature_id', 'store_feature_id', 'company_id'], 'integer'],
            [['qty', 'total_unit_cost'], 'number'],
            [['batch_expiry_date', 'created_at', 'updated_at'], 'safe'],
            [['status'], 'string'],
            [['batch_code'], 'string', 'max' => 255],
            [['batch_code'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
            [['factory_feature_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyFeatures::class, 'targetAttribute' => ['factory_feature_id' => 'id']],
            [['product_variation_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductVariations::class, 'targetAttribute' => ['product_variation_id' => 'id']],
            [['store_feature_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyFeatures::class, 'targetAttribute' => ['store_feature_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_variation_id' => 'Product Variation ID',
            'batch_code' => 'Batch Code',
            'qty' => 'Qty',
            'batch_expiry_date' => 'Batch Expiry Date',
            'total_unit_cost' => 'Total Unit Cost',
            'factory_feature_id' => 'Factory Feature ID',
            'store_feature_id' => 'Store Feature ID',
            'company_id' => 'Company ID',
            'status' => 'Status',
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
     * Gets query for [[FactoryFeature]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFactoryFeature()
    {
        return $this->hasOne(CompanyFeatures::class, ['id' => 'factory_feature_id']);
    }

    /**
     * Gets query for [[ProductVariation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariation()
    {
        return $this->hasOne(ProductVariations::class, ['id' => 'product_variation_id']);
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
}
