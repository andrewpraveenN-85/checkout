<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "purchase_items".
 *
 * @property int $purchase_id
 * @property int $raw_items_id
 * @property float $request_qty
 * @property float $recieve_qty
 * @property float $return_qty
 * @property float $unit_price
 * @property string|null $expire_date
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Purchases $purchase
 * @property RawItems $rawItems
 */
class PurchaseItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purchase_id', 'raw_items_id', 'request_qty', 'recieve_qty', 'unit_price'], 'required'],
            [['purchase_id', 'raw_items_id'], 'integer'],
            [['request_qty', 'recieve_qty', 'return_qty', 'unit_price'], 'number'],
            [['expire_date', 'created_at', 'updated_at'], 'safe'],
            [['status'], 'string'],
            [['purchase_id', 'raw_items_id'], 'unique', 'targetAttribute' => ['purchase_id', 'raw_items_id']],
            [['purchase_id'], 'exist', 'skipOnError' => true, 'targetClass' => Purchases::class, 'targetAttribute' => ['purchase_id' => 'id']],
            [['raw_items_id'], 'exist', 'skipOnError' => true, 'targetClass' => RawItems::class, 'targetAttribute' => ['raw_items_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'purchase_id' => 'Purchase ID',
            'raw_items_id' => 'Raw Items ID',
            'request_qty' => 'Request Qty',
            'recieve_qty' => 'Recieve Qty',
            'return_qty' => 'Return Qty',
            'unit_price' => 'Unit Price',
            'expire_date' => 'Expire Date',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Purchase]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchase()
    {
        return $this->hasOne(Purchases::class, ['id' => 'purchase_id']);
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
}
