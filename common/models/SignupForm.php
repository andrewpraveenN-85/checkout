<?php

namespace common\models;

use Yii;
use yii\base\Model;
use common\models\Users;
use backend\models\Companies;
use backend\models\Roles;
use backend\models\UsersRoles;
use backend\models\RolesPermissions;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $name;
    public $email;
    public $registration_number;
    public $industry;
    public $address;
    public $city;
    public $state;
    public $country;
    public $postal_code;
    public $contact_number;
    public $website;
    public $established_date;
    public $number_of_employees;
    public $annual_revenue;
    public $password;
    public $logo;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'registration_number', 'industry', 'address', 'city', 'state', 'country', 'postal_code', 'contact_number', 'email', 'website', 'established_date', 'number_of_employees', 'annual_revenue', 'logo'], 'safe'],
            [['name', 'registration_number', 'industry', 'address', 'country', 'postal_code', 'email', 'established_date', 'number_of_employees', 'annual_revenue'], 'required'],
            ['name', 'trim'],
            ['name', 'unique', 'targetClass' => '\backend\models\Companies', 'message' => 'This username has already been taken.'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Users', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }
        $company = $this->createCompany();
        if (!$company->save()) {
            return false;
        }
        $user = $this->createUser($company->id);
        $role = $this->createRole($company->id);
        if ($user->save() && $role->save()) {
            return $this->assignRole($user->id, $role->id) && $this->createLogo($user->id) && $this->sendEmail($user);
        }
        return false;
    }

    private function createLogo($userId) {
        $user = Users::findOne(['id' => $userId]);
        if (!$user) {
            return false; // User not found
        }
        $company = Companies::findOne(['id' => $user->company_id]);
        if (!$company) {
            return false; // Company not found
        }
        $companyDir = Yii::$app->params['uploadPathIMG'] . $company->name;
        if (!file_exists($companyDir)) {
            mkdir($companyDir, 0777, true); // true for recursive directory creation
        }
        $name = $user->company_id . "_logo";
        $image = UploadedFile::getInstance($this, 'logo');
        if (!empty($image)) {
            $uploadPath = $companyDir . '/' . $name . '.' . $image->getExtension();
            if ($image->saveAs($uploadPath)) {
                $company->logo = 'storage/' . $company->name . '/' . $name . '.' . $image->getExtension();
                $user->profile_picture = 'storage/' . $company->name . '/' . $name . '.' . $image->getExtension();
                return $company->save() && $user->save(false);
            }
        }
        return false; // Return false if image is not uploaded
    }

    private function createCompany() {
        $company = new Companies();
        foreach (['name', 'email', 'registration_number', 'industry', 'address', 'city', 'state', 'country', 'postal_code', 'contact_number', 'website', 'established_date', 'number_of_employees', 'annual_revenue'] as $attr) {
            $company->$attr = $this->$attr;
        }
        return $company;
    }

    private function createUser($companyId) {
        $user = new Users();
        foreach (['name' => 'first_name', 'contact_number', 'address', 'city', 'state', 'country', 'postal_code', 'email'] as $src => $dest) {
            $user->$dest = is_int($src) ? $this->$dest : $this->$src;
        }
        $user->company_id = $companyId;
        $user->user_type = 'employee';
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user;
    }

    private function createRole($companyId) {
        $role = new Roles();
        $role->name = 'Company';
        $role->company_id = $companyId;
        return $role;
    }

    private function assignRole($userId, $roleId) {
        $userRole = new UsersRoles(['user_id' => $userId, 'role_id' => $roleId]);
        $rolePermission = new RolesPermissions(['role_id' => $roleId, 'permission_id' => 1]);
        return $userRole->save() && $rolePermission->save();
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user) {
        return Yii::$app
                        ->mailer
                        ->compose(
                                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                                ['user' => $user]
                        )
                        ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                        ->setTo($this->email)
                        ->setSubject('Account registration at ' . Yii::$app->name)
                        ->send();
    }
}
