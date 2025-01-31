<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "permission".
 *
 * @property int $id
 * @property string $name
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Roles[] $roles
 * @property RolesPermissions[] $rolesPermissions
 */
class Permission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Roles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Roles::class, ['id' => 'role_id'])->viaTable('roles_permissions', ['permission_id' => 'id']);
    }

    /**
     * Gets query for [[RolesPermissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRolesPermissions()
    {
        return $this->hasMany(RolesPermissions::class, ['permission_id' => 'id']);
    }
}
