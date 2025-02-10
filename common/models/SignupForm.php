<?php

namespace common\models;

use Yii;
use yii\base\Model;
use common\models\Users;
use backend\models\Companies;
use backend\models\Roles;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $name;
    public $email;
    public $industry;
    public $contact_number;
    public $password;
    public $verifyCode;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'industry', 'contact_number', 'email',], 'safe'],
            [['name', 'industry', 'contact_number', 'email', 'password',], 'required'],
            ['name', 'trim'],
            ['name', 'unique', 'targetClass' => '\backend\models\Companies', 'message' => 'This Company has already been taken.'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Users', 'message' => 'This email address has already been taken.'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Company name',
            'contact_number' => 'Company contact number',
            'email' => 'Company email address',
            'password' => 'Password',
            'industry' => 'Industry',
            'verifyCode' => 'Verification Code',
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
        mkdir(Yii::$app->params['app_host'] . $company->id, 0777, true);
        $role = $this->createRole($company->id);
        if (!$role->save()) {
            return false;
        }
        $user = $this->createUser($company->id, $role->id);
        if ($user->save()) {
            return $this->sendEmail($user);
        }
        return false;
    }

    private function createCompany() {
        $company = new Companies();
        foreach (['name', 'email', 'industry', 'contact_number'] as $attr) {
            $company->$attr = $this->$attr;
        }
        return $company;
    }

    private function createUser($companyId, $roleId) {
        $user = new Users();
        foreach (['name' => 'first_name', 'contact_number', 'email'] as $src => $dest) {
            $user->$dest = is_int($src) ? $this->$dest : $this->$src;
        }
        $user->company_id = $companyId;
        $user->role_id = $roleId;
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
