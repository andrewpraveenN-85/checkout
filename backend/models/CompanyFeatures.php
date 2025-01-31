<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company_features".
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property int $isStores
 * @property int $isFactory
 * @property int $isSellingPoint
 * @property int $isHR
 * @property int $isAccount
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Companies $company
 * @property ProductBatches[] $productBatches
 * @property ProductBatches[] $productBatches0
 * @property Purchases[] $purchases
 * @property StoreFactoryRelease[] $storeFactoryReleases
 * @property StoreFactoryRelease[] $storeFactoryReleases0
 * @property StoreSellingpointRelease[] $storeSellingpointReleases
 * @property StoreSellingpointRelease[] $storeSellingpointReleases0
 */
class CompanyFeatures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_features';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'name'], 'required'],
            [['company_id', 'isStores', 'isFactory', 'isSellingPoint', 'isHR', 'isAccount'], 'integer'],
            [['status'], 'string'],
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
            'id' => 'ID',
            'company_id' => 'Company ID',
            'name' => 'Name',
            'isStores' => 'Is Stores',
            'isFactory' => 'Is Factory',
            'isSellingPoint' => 'Is Selling Point',
            'isHR' => 'Is Hr',
            'isAccount' => 'Is Account',
            'status' => 'Status',
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
     * Gets query for [[ProductBatches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductBatches()
    {
        return $this->hasMany(ProductBatches::class, ['factory_feature_id' => 'id']);
    }

    /**
     * Gets query for [[ProductBatches0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductBatches0()
    {
        return $this->hasMany(ProductBatches::class, ['store_feature_id' => 'id']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchases::class, ['store_feature_id' => 'id']);
    }

    /**
     * Gets query for [[StoreFactoryReleases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreFactoryReleases()
    {
        return $this->hasMany(StoreFactoryRelease::class, ['factory_feature_id' => 'id']);
    }

    /**
     * Gets query for [[StoreFactoryReleases0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreFactoryReleases0()
    {
        return $this->hasMany(StoreFactoryRelease::class, ['store_feature_id' => 'id']);
    }

    /**
     * Gets query for [[StoreSellingpointReleases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreSellingpointReleases()
    {
        return $this->hasMany(StoreSellingpointRelease::class, ['sellingpoint_feature_id' => 'id']);
    }

    /**
     * Gets query for [[StoreSellingpointReleases0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreSellingpointReleases0()
    {
        return $this->hasMany(StoreSellingpointRelease::class, ['store_feature_id' => 'id']);
    }
}
