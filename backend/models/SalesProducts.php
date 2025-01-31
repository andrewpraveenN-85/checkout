<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sales_products".
 *
 * @property int $sales_id
 * @property int $product_variation_id
 * @property float $quantity
 * @property float $price
 * @property float $discount
 * @property float $total
 * @property string|null $created_at
 * @property string $updated_at
 *
 * @property ProductVariations $productVariation
 * @property Sales $sales
 */
class SalesProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sales_id', 'product_variation_id', 'quantity', 'price', 'total'], 'required'],
            [['sales_id', 'product_variation_id'], 'integer'],
            [['quantity', 'price', 'discount', 'total'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['sales_id', 'product_variation_id'], 'unique', 'targetAttribute' => ['sales_id', 'product_variation_id']],
            [['product_variation_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductVariations::class, 'targetAttribute' => ['product_variation_id' => 'id']],
            [['sales_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::class, 'targetAttribute' => ['sales_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sales_id' => 'Sales ID',
            'product_variation_id' => 'Product Variation ID',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'discount' => 'Discount',
            'total' => 'Total',
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
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasOne(Sales::class, ['id' => 'sales_id']);
    }
}
