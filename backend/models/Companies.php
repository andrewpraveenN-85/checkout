<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "companies".
 *
 * @property int $id
 * @property string $name
 * @property string|null $registration_number
 * @property string|null $industry
 * @property string|null $address
 * @property string|null $city_id
 * @property string|null $contact_number
 * @property string|null $email
 * @property string|null $website
 * @property string|null $logo
 * @property string|null $established_date
 * @property int|null $number_of_employees
 * @property float|null $annual_revenue
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CompanyFeatures[] $companyFeatures
 * @property Configurations[] $configurations
 * @property MeasurementUnits[] $measurementUnits
 * @property ProductBatches[] $productBatches
 * @property Products[] $products
 * @property ProductsBrands[] $productsBrands
 * @property ProductsCategories[] $productsCategories
 * @property Purchases[] $purchases
 * @property RawItems[] $rawItems
 * @property RawItemsBrands[] $rawItemsBrands
 * @property RawItemsCategories[] $rawItemsCategories
 * @property StoreFactoryRelease[] $storeFactoryReleases
 * @property StoreSellingpointRelease[] $storeSellingpointReleases
 * @property Suppliers[] $suppliers
 * @property Transactions[] $transactions
 * @property Users[] $users
 * @property States $city
 */
class Companies extends \yii\db\ActiveRecord {

    public $picture;
    public $state;
    public $country;

    public static function tableName() {
        return 'companies';
    }

    public function rules() {
        return [
            [['name', 'industry', 'contact_number', 'email'], 'required'],
            [['address', 'status'], 'string'],
            [['name', 'registration_number', 'industry', 'city_id', 'state', 'country', 'contact_number', 'email', 'website', 'logo', 'established_date', 'number_of_employees', 'annual_revenue', 'picture'], 'safe'],
            [['number_of_employees'], 'integer'],
            [['annual_revenue'], 'number'],
            [['name', 'registration_number', 'industry', 'city_id', 'state', 'country', 'contact_number', 'email', 'website', 'logo', 'picture'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Name',
            'registration_number' => 'Registration number',
            'industry' => 'Industry',
            'address' => 'Address',
            'city_id' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'contact_number' => 'Contact number',
            'email' => 'Email',
            'website' => 'Website',
            'logo' => 'Logo',
            'picture' => 'Logo',
            'established_date' => 'Established date',
            'number_of_employees' => 'Number of employees',
            'annual_revenue' => 'Annual eevenue',
            'status' => 'Status',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ];
    }

    public function getCompanyFeatures() {
        return $this->hasMany(CompanyFeatures::class, ['company_id' => 'id']);
    }

    public function getConfigurations() {
        return $this->hasMany(Configurations::class, ['company_id' => 'id']);
    }

    public function getMeasurementUnits() {
        return $this->hasMany(MeasurementUnits::class, ['company_id' => 'id']);
    }

    public function getProductBatches() {
        return $this->hasMany(ProductBatches::class, ['company_id' => 'id']);
    }

    public function getProducts() {
        return $this->hasMany(Products::class, ['company_id' => 'id']);
    }

    public function getProductsBrands() {
        return $this->hasMany(ProductsBrands::class, ['company_id' => 'id']);
    }

    public function getProductsCategories() {
        return $this->hasMany(ProductsCategories::class, ['company_id' => 'id']);
    }

    public function getPurchases() {
        return $this->hasMany(Purchases::class, ['company_id' => 'id']);
    }

    public function getRawItems() {
        return $this->hasMany(RawItems::class, ['company_id' => 'id']);
    }

    public function getRawItemsBrands() {
        return $this->hasMany(RawItemsBrands::class, ['company_id' => 'id']);
    }

    public function getRawItemsCategories() {
        return $this->hasMany(RawItemsCategories::class, ['company_id' => 'id']);
    }

    public function getStoreFactoryReleases() {
        return $this->hasMany(StoreFactoryRelease::class, ['company_id' => 'id']);
    }

    public function getStoreSellingpointReleases() {
        return $this->hasMany(StoreSellingpointRelease::class, ['company_id' => 'id']);
    }

    public function getSuppliers() {
        return $this->hasMany(Suppliers::class, ['company_id' => 'id']);
    }

    public function getTransactions() {
        return $this->hasMany(Transactions::class, ['company_id' => 'id']);
    }

    public function getUsers() {
        return $this->hasMany(Users::class, ['company_id' => 'id']);
    }

    public function getCity() {
        return $this->hasOne(Cities::class, ['id' => 'city_id']);
    }

    public function getLogoURL() {
        if ($this->logo != null) {
            return Yii::$app->params['app_host'] . 'storage/' . $this->id . '/' . $this->logo;
        } else {
            return Yii::$app->params['app_host'] . 'storage/default.jpg';
        }
    }
}
