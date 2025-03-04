<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "raw_items_brands".
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property int $company_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Companies $company
 * @property RawItems[] $rawItems
 */
class RawItemsBrands extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'raw_items_brands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'company_id', 'status'], 'required'],
            [['status'], 'string'],
            [['company_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name', 'company_id'], 'unique', 'targetAttribute' => ['name', 'company_id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'name' => 'Name',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany() {
        return $this->hasOne(Companies::class, ['id' => 'company_id']);
    }

    /**
     * Gets query for [[RawItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawItems() {
        return $this->hasMany(RawItems::class, ['raw_items_brand_id' => 'id']);
    }
}
