<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property int $product_category_id
 * @property int $product_brand_id
 * @property string|null $description
 * @property int $store_measurement_unit_id
 * @property int $release_measurement_unit_id
 * @property float $store_to_release_measurement_conversion
 * @property int $single_unit_selling_measurement_unit
 * @property float $release_to_single_unit_selling_measurement_conversion
 * @property int $bulk_selling_measurement_unit
 * @property float $release_to_bulk_selling_measurement_conversion
 * @property string $status
 * @property int $company_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MeasurementUnits $bulkSellingMeasurementUnit
 * @property Companies $company
 * @property ProductsBrands $productBrand
 * @property ProductsCategories $productCategory
 * @property ProductVariations[] $productVariations
 * @property MeasurementUnits $releaseMeasurementUnit
 * @property MeasurementUnits $singleUnitSellingMeasurementUnit
 * @property MeasurementUnits $storeMeasurementUnit
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'product_category_id', 'product_brand_id', 'store_measurement_unit_id', 'release_measurement_unit_id', 'store_to_release_measurement_conversion', 'single_unit_selling_measurement_unit', 'release_to_single_unit_selling_measurement_conversion', 'bulk_selling_measurement_unit', 'release_to_bulk_selling_measurement_conversion', 'company_id'], 'required'],
            [['product_category_id', 'product_brand_id', 'store_measurement_unit_id', 'release_measurement_unit_id', 'single_unit_selling_measurement_unit', 'bulk_selling_measurement_unit', 'company_id'], 'integer'],
            [['description', 'status'], 'string'],
            [['store_to_release_measurement_conversion', 'release_to_single_unit_selling_measurement_conversion', 'release_to_bulk_selling_measurement_conversion'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['bulk_selling_measurement_unit'], 'exist', 'skipOnError' => true, 'targetClass' => MeasurementUnits::class, 'targetAttribute' => ['bulk_selling_measurement_unit' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
            [['product_brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsBrands::class, 'targetAttribute' => ['product_brand_id' => 'id']],
            [['product_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsCategories::class, 'targetAttribute' => ['product_category_id' => 'id']],
            [['release_measurement_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeasurementUnits::class, 'targetAttribute' => ['release_measurement_unit_id' => 'id']],
            [['single_unit_selling_measurement_unit'], 'exist', 'skipOnError' => true, 'targetClass' => MeasurementUnits::class, 'targetAttribute' => ['single_unit_selling_measurement_unit' => 'id']],
            [['store_measurement_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeasurementUnits::class, 'targetAttribute' => ['store_measurement_unit_id' => 'id']],
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
            'product_category_id' => 'Product Category ID',
            'product_brand_id' => 'Product Brand ID',
            'description' => 'Description',
            'store_measurement_unit_id' => 'Store Measurement Unit ID',
            'release_measurement_unit_id' => 'Release Measurement Unit ID',
            'store_to_release_measurement_conversion' => 'Store To Release Measurement Conversion',
            'single_unit_selling_measurement_unit' => 'Single Unit Selling Measurement Unit',
            'release_to_single_unit_selling_measurement_conversion' => 'Release To Single Unit Selling Measurement Conversion',
            'bulk_selling_measurement_unit' => 'Bulk Selling Measurement Unit',
            'release_to_bulk_selling_measurement_conversion' => 'Release To Bulk Selling Measurement Conversion',
            'status' => 'Status',
            'company_id' => 'Company ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[BulkSellingMeasurementUnit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBulkSellingMeasurementUnit()
    {
        return $this->hasOne(MeasurementUnits::class, ['id' => 'bulk_selling_measurement_unit']);
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
     * Gets query for [[ProductBrand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductBrand()
    {
        return $this->hasOne(ProductsBrands::class, ['id' => 'product_brand_id']);
    }

    /**
     * Gets query for [[ProductCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductCategory()
    {
        return $this->hasOne(ProductsCategories::class, ['id' => 'product_category_id']);
    }

    /**
     * Gets query for [[ProductVariations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariations()
    {
        return $this->hasMany(ProductVariations::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ReleaseMeasurementUnit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReleaseMeasurementUnit()
    {
        return $this->hasOne(MeasurementUnits::class, ['id' => 'release_measurement_unit_id']);
    }

    /**
     * Gets query for [[SingleUnitSellingMeasurementUnit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSingleUnitSellingMeasurementUnit()
    {
        return $this->hasOne(MeasurementUnits::class, ['id' => 'single_unit_selling_measurement_unit']);
    }

    /**
     * Gets query for [[StoreMeasurementUnit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreMeasurementUnit()
    {
        return $this->hasOne(MeasurementUnits::class, ['id' => 'store_measurement_unit_id']);
    }
}
