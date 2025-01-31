<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "store_factory_release_raw_items".
 *
 * @property int $stock_transfer_id
 * @property int $raw_items_id
 * @property float $request_qty
 * @property float $receive_qty
 * @property float $return_qty
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property RawItems $rawItems
 * @property StoreFactoryRelease $stockTransfer
 */
class StoreFactoryReleaseRawItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_factory_release_raw_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stock_transfer_id', 'raw_items_id'], 'required'],
            [['stock_transfer_id', 'raw_items_id'], 'integer'],
            [['request_qty', 'receive_qty', 'return_qty'], 'number'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['stock_transfer_id', 'raw_items_id'], 'unique', 'targetAttribute' => ['stock_transfer_id', 'raw_items_id']],
            [['raw_items_id'], 'exist', 'skipOnError' => true, 'targetClass' => RawItems::class, 'targetAttribute' => ['raw_items_id' => 'id']],
            [['stock_transfer_id'], 'exist', 'skipOnError' => true, 'targetClass' => StoreFactoryRelease::class, 'targetAttribute' => ['stock_transfer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'stock_transfer_id' => 'Stock Transfer ID',
            'raw_items_id' => 'Raw Items ID',
            'request_qty' => 'Request Qty',
            'receive_qty' => 'Receive Qty',
            'return_qty' => 'Return Qty',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[RawItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawItems()
    {
        return $this->hasOne(RawItems::class, ['id' => 'raw_items_id']);
    }

    /**
     * Gets query for [[StockTransfer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStockTransfer()
    {
        return $this->hasOne(StoreFactoryRelease::class, ['id' => 'stock_transfer_id']);
    }
}
