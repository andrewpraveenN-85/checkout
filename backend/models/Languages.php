<?php

namespace backend\models;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Configurations[] $configurations
 */
class Languages extends \yii\db\ActiveRecord {

    public static function tableName() {
        return 'languages';
    }

    public function rules() {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Name',
        ];
    }

    public function getConfigurations() {
        return $this->hasMany(Configurations::class, ['default_language_id' => 'id']);
    }
}
