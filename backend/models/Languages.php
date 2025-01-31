<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string $language_code
 * @property string $language_name
 * @property string|null $native_name
 * @property int $is_rtl
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Configurations[] $configurations
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language_code', 'language_name'], 'required'],
            [['is_rtl'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['language_code'], 'string', 'max' => 2],
            [['language_name', 'native_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'language_code' => 'Language Code',
            'language_name' => 'Language Name',
            'native_name' => 'Native Name',
            'is_rtl' => 'Is Rtl',
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
        return $this->hasMany(Configurations::class, ['default_language_id' => 'id']);
    }
}
