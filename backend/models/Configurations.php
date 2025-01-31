<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "configurations".
 *
 * @property int $id
 * @property int $company_id
 * @property int|null $default_tax_id
 * @property int|null $default_currency_id
 * @property int|null $default_language_id
 * @property int|null $smtp_configuration_id
 * @property int $return_policy_days
 * @property string $timezone
 * @property int $enable_notifications
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Companies $company
 * @property Currencies $defaultCurrency
 * @property Languages $defaultLanguage
 * @property Taxes $defaultTax
 * @property SmtpConfigurations $smtpConfiguration
 */
class Configurations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'configurations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id'], 'required'],
            [['company_id', 'default_tax_id', 'default_currency_id', 'default_language_id', 'smtp_configuration_id', 'return_policy_days', 'enable_notifications'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['timezone'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
            [['default_currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::class, 'targetAttribute' => ['default_currency_id' => 'id']],
            [['default_language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::class, 'targetAttribute' => ['default_language_id' => 'id']],
            [['default_tax_id'], 'exist', 'skipOnError' => true, 'targetClass' => Taxes::class, 'targetAttribute' => ['default_tax_id' => 'id']],
            [['smtp_configuration_id'], 'exist', 'skipOnError' => true, 'targetClass' => SmtpConfigurations::class, 'targetAttribute' => ['smtp_configuration_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'default_tax_id' => 'Default Tax ID',
            'default_currency_id' => 'Default Currency ID',
            'default_language_id' => 'Default Language ID',
            'smtp_configuration_id' => 'Smtp Configuration ID',
            'return_policy_days' => 'Return Policy Days',
            'timezone' => 'Timezone',
            'enable_notifications' => 'Enable Notifications',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::class, ['id' => 'company_id']);
    }

    /**
     * Gets query for [[DefaultCurrency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultCurrency()
    {
        return $this->hasOne(Currencies::class, ['id' => 'default_currency_id']);
    }

    /**
     * Gets query for [[DefaultLanguage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultLanguage()
    {
        return $this->hasOne(Languages::class, ['id' => 'default_language_id']);
    }

    /**
     * Gets query for [[DefaultTax]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultTax()
    {
        return $this->hasOne(Taxes::class, ['id' => 'default_tax_id']);
    }

    /**
     * Gets query for [[SmtpConfiguration]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSmtpConfiguration()
    {
        return $this->hasOne(SmtpConfigurations::class, ['id' => 'smtp_configuration_id']);
    }
}
