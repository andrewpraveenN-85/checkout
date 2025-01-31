<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "store_sellingpoint_release_products".
 *
 * @property int $store_selling_point_id
 * @property int $product_variation_id
 * @property float $request_qty
 * @property float $recieve_qty
 * @property float $return_qty
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ProductVariations $productVariation
 * @property StoreSellingpointRelease $storeSellingPoint
 */
class StoreSellingpointReleaseProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_sellingpoint_release_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_selling_point_id', 'product_variation_id', 'request_qty', 'recieve_qty'], 'required'],
            [['store_selling_point_id', 'product_variation_id'], 'integer'],
            [['request_qty', 'recieve_qty', 'return_qty'], 'number'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['store_selling_point_id', 'product_variation_id'], 'unique', 'targetAttribute' => ['store_selling_point_id', 'product_variation_id']],
            [['product_variation_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductVariations::class, 'targetAttribute' => ['product_variation_id' => 'id']],
            [['store_selling_point_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreSellingpointRelease::class, 'targetAttribute' => ['store_selling_point_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'store_selling_point_id' => 'Store Selling Point ID',
            'product_variation_id' => 'Product Variation ID',
            'request_qty' => 'Request Qty',
            'recieve_qty' => 'Recieve Qty',
            'return_qty' => 'Return Qty',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * Gets query for [[StoreSellingPoint]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreSellingPoint()
    {
        return $this->hasOne(StoreSellingpointRelease::class, ['id' => 'store_selling_point_id']);
    }
}
