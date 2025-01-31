<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sales_payment_references".
 *
 * @property int $id
 * @property int $sales_id
 * @property string $payment_type
 * @property string $reference_number
 * @property string|null $reference_image
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Sales $sales
 */
class SalesPaymentReferences extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_payment_references';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sales_id', 'payment_type', 'reference_number'], 'required'],
            [['sales_id'], 'integer'],
            [['payment_type', 'status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['reference_number', 'reference_image'], 'string', 'max' => 255],
            [['sales_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::class, 'targetAttribute' => ['sales_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sales_id' => 'Sales ID',
            'payment_type' => 'Payment Type',
            'reference_number' => 'Reference Number',
            'reference_image' => 'Reference Image',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
