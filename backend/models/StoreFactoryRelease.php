<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "store_factory_release".
 *
 * @property int $id
 * @property int $store_feature_id
 * @property int $factory_feature_id
 * @property string $status
 * @property int $company_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Companies $company
 * @property CompanyFeatures $factoryFeature
 * @property RawItems[] $rawItems
 * @property StoreFactoryReleaseRawItems[] $storeFactoryReleaseRawItems
 * @property CompanyFeatures $storeFeature
 */
class StoreFactoryRelease extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store_factory_release';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_feature_id', 'factory_feature_id', 'company_id'], 'required'],
            [['store_feature_id', 'factory_feature_id', 'company_id'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
            [['factory_feature_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyFeatures::class, 'targetAttribute' => ['factory_feature_id' => 'id']],
            [['store_feature_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyFeatures::class, 'targetAttribute' => ['store_feature_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_feature_id' => 'Store Feature ID',
            'factory_feature_id' => 'Factory Feature ID',
            'status' => 'Status',
            'company_id' => 'Company ID',
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
     * Gets query for [[FactoryFeature]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFactoryFeature()
    {
        return $this->hasOne(CompanyFeatures::class, ['id' => 'factory_feature_id']);
    }

    /**
     * Gets query for [[RawItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRawItems()
    {
        return $this->hasMany(RawItems::class, ['id' => 'raw_items_id'])->viaTable('store_factory_release_raw_items', ['stock_transfer_id' => 'id']);
    }

    /**
     * Gets query for [[StoreFactoryReleaseRawItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreFactoryReleaseRawItems()
    {
        return $this->hasMany(StoreFactoryReleaseRawItems::class, ['stock_transfer_id' => 'id']);
    }

    /**
     * Gets query for [[StoreFeature]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreFeature()
    {
        return $this->hasOne(CompanyFeatures::class, ['id' => 'store_feature_id']);
    }
}
