<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "smtp_configurations".
 *
 * @property int $id
 * @property string $host
 * @property int $port
 * @property string|null $encryption
 * @property string $username
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Configurations[] $configurations
 */
class SmtpConfigurations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'smtp_configurations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['host', 'port', 'username', 'password'], 'required'],
            [['port'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['host', 'encryption', 'username', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'host' => 'Host',
            'port' => 'Port',
            'encryption' => 'Encryption',
            'username' => 'Username',
            'password' => 'Password',
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
        return $this->hasMany(Configurations::class, ['smtp_configuration_id' => 'id']);
    }
}
