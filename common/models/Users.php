<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use backend\models\Companies;
use backend\models\Roles;
use backend\models\UsersRoles;
use backend\models\Sales;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $last_name
 * @property string|null $date_of_birth
 * @property string|null $contact_number
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $country
 * @property string|null $postal_code
 * @property string|null $profile_picture
 * @property string $user_type
 * @property int|null $company_id
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Companies $company
 * @property Roles[] $roles
 * @property Sales[] $sales
 * @property Sales[] $sales0
 * @property UsersRoles[] $usersRoles
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface {

    public $picture;
    public $password;
    public $newpassword;
    public $role_name;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['password', 'newpassword', 'date_of_birth', 'password_hash', 'email', 'first_name', 'middle_name', 'last_name', 'contact_number', 'city', 'state', 'country', 'postal_code', 'profile_picture', 'picture', 'company_id', 'role_name'], 'safe'],
            [['user_type', 'status'], 'string'],
            [['company_id'], 'integer'],
            [['address', 'first_name', 'middle_name', 'last_name', 'contact_number', 'city', 'state', 'country', 'postal_code', 'profile_picture', 'email', 'password_hash', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'date_of_birth' => 'Date Of Birth',
            'contact_number' => 'Contact',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'postal_code' => 'Postal Code',
            'profile_picture' => 'Picture',
            'user_type' => 'User Type',
            'company_id' => 'Company',
            'email' => 'Email',
            'password_hash' => 'Password',
            'status' => 'Status',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
            'role_name' => 'Role',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id, 'status' => 'active']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email) {
        return static::findOne(['email' => $email, 'status' => 'active']);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token) {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
                    'password_reset_token' => $token,
                    'status' => 'active',
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
                    'verification_token' => $token,
                    'status' => 'inactive'
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken() {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
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
     * Gets query for [[Roles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoles() {
        return $this->hasMany(Roles::class, ['id' => 'role_id'])->viaTable('users_roles', ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales() {
        return $this->hasMany(Sales::class, ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[Sales0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales0() {
        return $this->hasMany(Sales::class, ['employee_id' => 'id']);
    }

    /**
     * Gets query for [[UsersRoles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsersRoles() {
        return $this->hasMany(UsersRoles::class, ['user_id' => 'id']);
    }

    public function hasAccess($permission_name) {
        $roles = $this->roles; // Get user roles through the relation
        foreach ($roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->name === $permission_name && $permission->status === 'active') {
                    return true; // Permission granted
                }
            }
        }
        return false; // No permission found
    }

    public function getRoleNames() {
        return implode(', ', \yii\helpers\ArrayHelper::getColumn($this->roles, 'name'));
    }

    public function afterFind() {
        parent::afterFind();
        $this->role_name = $this->getRoleNames(); // Assign role name to the public property
    }
}
