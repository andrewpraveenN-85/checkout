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
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $company_id
 * 
 * @property Companies $company
 * @property Configurations[] $configurations
 */
class SmtpConfigurations extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'smtp_configurations';
    }

    public function rules() {
        return [
            [['host', 'port', 'username', 'encryption', 'password', 'company_id', 'status'], 'required'],
            [['port'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['host', 'encryption', 'username', 'password', 'status'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'host' => 'Host',
            'port' => 'Port',
            'encryption' => 'Encryption',
            'username' => 'Username',
            'password' => 'Password',
            'status' => 'Status',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ];
    }

    public function getCompany() {
        return $this->hasOne(Companies::class, ['id' => 'company_id']);
    }

    public function getConfigurations() {
        return $this->hasMany(Configurations::class, ['smtp_configuration_id' => 'id']);
    }
}
