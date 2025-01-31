<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_variations".
 *
 * @property int $id
 * @property int $product_id
 * @property string $code
 * @property string $barcode
 * @property string|null $picture
 * @property string|null $description
 * @property float|null $width
 * @property float|null $height
 * @property float|null $length
 * @property float|null $weight
 * @property string|null $size
 * @property string|null $color
 * @property string $discount_type
 * @property float $discount_amount
 * @property float $single_unit_price
 * @property float|null $bulk_unit_price
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ManufractureTemplates[] $manufractureTemplates
 * @property Products $product
 * @property ProductBatches[] $productBatches
 * @property Sales[] $sales
 * @property SalesProducts[] $salesProducts
 * @property StoreSellingpointRelease[] $storeSellingPoints
 * @property StoreSellingpointReleaseProducts[] $storeSellingpointReleaseProducts
 */
class ProductVariations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_variations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'code', 'barcode', 'single_unit_price'], 'required'],
            [['product_id'], 'integer'],
            [['description', 'discount_type', 'status'], 'string'],
            [['width', 'height', 'length', 'weight', 'discount_amount', 'single_unit_price', 'bulk_unit_price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['code', 'barcode', 'picture', 'size', 'color'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['barcode'], 'unique'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'code' => 'Code',
            'barcode' => 'Barcode',
            'picture' => 'Picture',
            'description' => 'Description',
            'width' => 'Width',
            'height' => 'Height',
            'length' => 'Length',
            'weight' => 'Weight',
            'size' => 'Size',
            'color' => 'Color',
            'discount_type' => 'Discount Type',
            'discount_amount' => 'Discount Amount',
            'single_unit_price' => 'Single Unit Price',
            'bulk_unit_price' => 'Bulk Unit Price',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[ManufractureTemplates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManufractureTemplates()
    {
        return $this->hasMany(ManufractureTemplates::class, ['product_variation_id' => 'id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }

    /**
     * Gets query for [[ProductBatches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductBatches()
    {
        return $this->hasMany(ProductBatches::class, ['product_variation_id' => 'id']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::class, ['id' => 'sales_id'])->viaTable('sales_products', ['product_variation_id' => 'id']);
    }

    /**
     * Gets query for [[SalesProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesProducts()
    {
        return $this->hasMany(SalesProducts::class, ['product_variation_id' => 'id']);
    }

    /**
     * Gets query for [[StoreSellingPoints]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreSellingPoints()
    {
        return $this->hasMany(StoreSellingpointRelease::class, ['id' => 'store_selling_point_id'])->viaTable('store_sellingpoint_release_products', ['product_variation_id' => 'id']);
    }

    /**
     * Gets query for [[StoreSellingpointReleaseProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreSellingpointReleaseProducts()
    {
        return $this->hasMany(StoreSellingpointReleaseProducts::class, ['product_variation_id' => 'id']);
    }
}
