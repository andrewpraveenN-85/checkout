<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "raw_items_categories".
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
class RawItemsCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'raw_items_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'company_id'], 'required'],
            [['status'], 'string'],
            [['company_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            // 'company_id' => 'Company ID',
            // 'created_at' => 'Created At',
            // 'updated_at' => 'Updated At',
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
     * Gets query for [[RawItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawItems()
    {
        return $this->hasMany(RawItems::class, ['raw_items_category_id' => 'id']);
    }
}
