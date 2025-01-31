<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "store_sellingpoint_release".
 *
 * @property int $id
 * @property int $store_feature_id
 * @property int $sellingpoint_feature_id
 * @property string $status
 * @property int $company_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Companies $company
 * @property ProductVariations[] $productVariations
 * @property CompanyFeatures $sellingpointFeature
 * @property CompanyFeatures $storeFeature
 * @property StoreSellingpointReleaseProducts[] $storeSellingpointReleaseProducts
 */
class StoreSellingpointRelease extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_sellingpoint_release';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_feature_id', 'sellingpoint_feature_id', 'company_id'], 'required'],
            [['store_feature_id', 'sellingpoint_feature_id', 'company_id'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
            [['sellingpoint_feature_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyFeatures::class, 'targetAttribute' => ['sellingpoint_feature_id' => 'id']],
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
            'store_feature_id' => 'Store Feature ID',
            'sellingpoint_feature_id' => 'Sellingpoint Feature ID',
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
     * Gets query for [[ProductVariations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariations()
    {
        return $this->hasMany(ProductVariations::class, ['id' => 'product_variation_id'])->viaTable('store_sellingpoint_release_products', ['store_selling_point_id' => 'id']);
    }

    /**
     * Gets query for [[SellingpointFeature]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSellingpointFeature()
    {
        return $this->hasOne(CompanyFeatures::class, ['id' => 'sellingpoint_feature_id']);
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
     * Gets query for [[StoreSellingpointReleaseProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreSellingpointReleaseProducts()
    {
        return $this->hasMany(StoreSellingpointReleaseProducts::class, ['store_selling_point_id' => 'id']);
    }
}
