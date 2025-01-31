<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "manufracture_templates".
 *
 * @property int $id
 * @property int $product_variation_id
 * @property int $raw_item_id
 * @property float $usage_qty
 * @property float $wastage_qty
 * @property float $cost_of_total_raw_item
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ProductVariations $productVariation
 * @property RawItems $rawItem
 */
class ManufractureTemplates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manufracture_templates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_variation_id', 'raw_item_id', 'usage_qty', 'wastage_qty', 'cost_of_total_raw_item'], 'required'],
            [['product_variation_id', 'raw_item_id'], 'integer'],
            [['usage_qty', 'wastage_qty', 'cost_of_total_raw_item'], 'number'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_variation_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductVariations::class, 'targetAttribute' => ['product_variation_id' => 'id']],
            [['raw_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => RawItems::class, 'targetAttribute' => ['raw_item_id' => 'id']],
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
            'raw_item_id' => 'Raw Item ID',
            'usage_qty' => 'Usage Qty',
            'wastage_qty' => 'Wastage Qty',
            'cost_of_total_raw_item' => 'Cost Of Total Raw Item',
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
     * Gets query for [[RawItem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawItem()
    {
        return $this->hasOne(RawItems::class, ['id' => 'raw_item_id']);
    }
}
