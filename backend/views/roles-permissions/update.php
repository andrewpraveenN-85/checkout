<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\RolesPermissions $model */

$this->title = 'Update Roles Permissions: ' . $model->role_id;
$this->params['breadcrumbs'][] = ['label' => 'Roles Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->role_id, 'url' => ['view', 'role_id' => $model->role_id, 'permission_id' => $model->permission_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="roles-permissions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
