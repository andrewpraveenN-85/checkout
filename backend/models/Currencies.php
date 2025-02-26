<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "currencies".
 *
 * @property int $id
 * @property string $name
 * @property string|null $symbol
 * @property int $base_currency
 * @property float $exchange_rate
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Configurations[] $configurations
 */
class Currencies extends \yii\db\ActiveRecord {

    public static function tableName() {
        return 'currencies';
    }

    public function rules() {
        return [
            [['name'], 'required'],
            [['exchange_rate'], 'number'],
            [['base_currency'], 'integer'],
            [['name', 'symbol'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Name',
        ];
    }

    public function getConfigurations() {
        return $this->hasMany(Configurations::class, ['default_currency_id' => 'id']);
    }
}
