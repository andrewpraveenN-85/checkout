<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "currencies".
 *
 * @property int $id
 * @property string $currency_code
 * @property string $currency_name
 * @property string|null $symbol
 * @property string $base_currency_code
 * @property float $exchange_rate
 * @property string|null $effective_date
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Configurations[] $configurations
 */
class Currencies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currencies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['currency_code', 'currency_name'], 'required'],
            [['exchange_rate'], 'number'],
            [['effective_date', 'created_at', 'updated_at'], 'safe'],
            [['currency_code', 'base_currency_code'], 'string', 'max' => 3],
            [['currency_name', 'symbol'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency_code' => 'Currency Code',
            'currency_name' => 'Currency Name',
            'symbol' => 'Symbol',
            'base_currency_code' => 'Base Currency Code',
            'exchange_rate' => 'Exchange Rate',
            'effective_date' => 'Effective Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Configurations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfigurations()
    {
        return $this->hasMany(Configurations::class, ['default_currency_id' => 'id']);
    }
}
