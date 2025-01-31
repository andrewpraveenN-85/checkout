<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "raw_items".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $picture
 * @property int $raw_items_category_id
 * @property int $raw_items_brand_id
 * @property int $store_measurement_unit_id
 * @property int $release_measurement_unit_id
 * @property float $store_to_release_measurement_conversion
 * @property int $production_measurement_unit
 * @property float $release_to_production_measurement_conversion
 * @property string $status
 * @property int $company_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Companies $company
 * @property ManufractureTemplates[] $manufractureTemplates
 * @property MeasurementUnits $productionMeasurementUnit
 * @property PurchaseItems[] $purchaseItems
 * @property Purchases[] $purchases
 * @property RawItemsBrands $rawItemsBrand
 * @property RawItemsCategories $rawItemsCategory
 * @property MeasurementUnits $releaseMeasurementUnit
 * @property StoreFactoryRelease[] $stockTransfers
 * @property StoreFactoryReleaseRawItems[] $storeFactoryReleaseRawItems
 * @property MeasurementUnits $storeMeasurementUnit
 */
class RawItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'raw_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'raw_items_category_id', 'raw_items_brand_id', 'store_measurement_unit_id', 'release_measurement_unit_id', 'store_to_release_measurement_conversion', 'production_measurement_unit', 'release_to_production_measurement_conversion', 'company_id'], 'required'],
            [['description', 'status'], 'string'],
            [['raw_items_category_id', 'raw_items_brand_id', 'store_measurement_unit_id', 'release_measurement_unit_id', 'production_measurement_unit', 'company_id'], 'integer'],
            [['store_to_release_measurement_conversion', 'release_to_production_measurement_conversion'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'picture'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
            [['production_measurement_unit'], 'exist', 'skipOnError' => true, 'targetClass' => MeasurementUnits::class, 'targetAttribute' => ['production_measurement_unit' => 'id']],
            [['raw_items_brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => RawItemsBrands::class, 'targetAttribute' => ['raw_items_brand_id' => 'id']],
            [['raw_items_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => RawItemsCategories::class, 'targetAttribute' => ['raw_items_category_id' => 'id']],
            [['release_measurement_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeasurementUnits::class, 'targetAttribute' => ['release_measurement_unit_id' => 'id']],
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
            'description' => 'Description',
            'picture' => 'Picture',
            'raw_items_category_id' => 'Raw Items Category ID',
            'raw_items_brand_id' => 'Raw Items Brand ID',
            'store_measurement_unit_id' => 'Store Measurement Unit ID',
            'release_measurement_unit_id' => 'Release Measurement Unit ID',
            'store_to_release_measurement_conversion' => 'Store To Release Measurement Conversion',
            'production_measurement_unit' => 'Production Measurement Unit',
            'release_to_production_measurement_conversion' => 'Release To Production Measurement Conversion',
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
     * Gets query for [[ManufractureTemplates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManufractureTemplates()
    {
        return $this->hasMany(ManufractureTemplates::class, ['raw_item_id' => 'id']);
    }

    /**
     * Gets query for [[ProductionMeasurementUnit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductionMeasurementUnit()
    {
        return $this->hasOne(MeasurementUnits::class, ['id' => 'production_measurement_unit']);
    }

    /**
     * Gets query for [[PurchaseItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseItems()
    {
        return $this->hasMany(PurchaseItems::class, ['raw_items_id' => 'id']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchases::class, ['id' => 'purchase_id'])->viaTable('purchase_items', ['raw_items_id' => 'id']);
    }

    /**
     * Gets query for [[RawItemsBrand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawItemsBrand()
    {
        return $this->hasOne(RawItemsBrands::class, ['id' => 'raw_items_brand_id']);
    }

    /**
     * Gets query for [[RawItemsCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawItemsCategory()
    {
        return $this->hasOne(RawItemsCategories::class, ['id' => 'raw_items_category_id']);
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
     * Gets query for [[StockTransfers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStockTransfers()
    {
        return $this->hasMany(StoreFactoryRelease::class, ['id' => 'stock_transfer_id'])->viaTable('store_factory_release_raw_items', ['raw_items_id' => 'id']);
    }

    /**
     * Gets query for [[StoreFactoryReleaseRawItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreFactoryReleaseRawItems()
    {
        return $this->hasMany(StoreFactoryReleaseRawItems::class, ['raw_items_id' => 'id']);
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
