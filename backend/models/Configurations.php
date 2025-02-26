<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "configurations".
 *
 * @property int $id
 * @property int $company_id
 * @property int|null $default_currency_id
 * @property int|null $default_language_id
 * @property int $return_policy_days
 * @property string $timezone
  * @property string $smtp_transport
 * @property string $smtp_host
 * @property int|null $smtp_port
 * @property string $smtp_encryption
 * @property string $smtp_username
 * @property string $smtp_password
 * @property string $smtp_timeout
 * @property string $smtp_auth_mode
 * @property int $enable_notifications
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Companies $company
 * @property Currencies $defaultCurrency
 * @property Languages $defaultLanguage
 */
class Configurations extends \yii\db\ActiveRecord {

    public static function tableName() {
        return 'configurations';
    }

    public function rules() {
        return [
            [['company_id'], 'required'],
            [['company_id', 'smtp_port', 'default_currency_id', 'default_language_id', 'return_policy_days', 'enable_notifications'], 'integer'],
            [['default_currency_id', 'default_language_id', 'return_policy_days', 'enable_notifications', 'timezone', 'smtp_transport', 'smtp_host','smtp_port', 'smtp_encryption', 'smtp_username', 'smtp_password', 'smtp_timeout', 'smtp_auth_mode'], 'safe'],
            [['timezone', 'smtp_transport', 'smtp_host', 'smtp_encryption', 'smtp_username', 'smtp_password', 'smtp_timeout', 'smtp_auth_mode'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
            [['default_currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::class, 'targetAttribute' => ['default_currency_id' => 'id']],
            [['default_language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::class, 'targetAttribute' => ['default_language_id' => 'id']],
        ];
    }

    public function attributeLabels() {
        return [
            'company_id' => 'Company',
            'default_currency_id' => ' Currency',
            'default_language_id' => 'Language',
            'return_policy_days' => 'Return Policy Days',
            'timezone' => 'Timezone',
            'enable_notifications' => 'Enable Notifications',
            'smtp_transport' => 'Transport', 
            'smtp_host' => 'Host',
            'smtp_port' => 'Port', 
            'smtp_encryption' => 'Encryption', 
            'smtp_username' => 'Username', 
            'smtp_password' => 'Password', 
            'smtp_timeout' => 'Time Out', 
            'smtp_auth_mode' => 'Authendication Mode',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ];
    }

    public function getCompany() {
        return $this->hasOne(Companies::class, ['id' => 'company_id']);
    }

    public function getDefaultCurrency() {
        return $this->hasOne(Currencies::class, ['id' => 'default_currency_id']);
    }

    public function getDefaultLanguage() {
        return $this->hasOne(Languages::class, ['id' => 'default_language_id']);
    }
}
