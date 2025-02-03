<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property int $company_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Permission[] $permissions
 * @property RolesPermissions[] $rolesPermissions
 * @property Users[] $users
 * @property UsersRoles[] $usersRoles
 */
class Roles extends \yii\db\ActiveRecord {

    public $permissionList;
    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name', 'company_id', 'permissionList'], 'required'],
            [['status'], 'string'],
            [['company_id'], 'integer'],
            [['name', 'company_id', 'status'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name', 'company_id'], 'unique', 'targetAttribute' => ['name', 'company_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'name' => 'Name',
            'status' => 'Status',
            'company_id' => 'Company',
            'created_at' => 'Created',
            'updated_at' => 'Updated',
        ];
    }

    /**
     * Gets query for [[Permissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions() {
        return $this->hasMany(Permission::class, ['id' => 'permission_id'])->viaTable('roles_permissions', ['role_id' => 'id']);
    }

    /**
     * Gets query for [[RolesPermissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRolesPermissions() {
        return $this->hasMany(RolesPermissions::class, ['role_id' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers() {
        return $this->hasMany(Users::class, ['id' => 'user_id'])->viaTable('users_roles', ['role_id' => 'id']);
    }

    /**
     * Gets query for [[UsersRoles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsersRoles() {
        return $this->hasMany(UsersRoles::class, ['role_id' => 'id']);
    }
}
