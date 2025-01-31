<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\UsersRoles $model */

$this->title = 'Update Users Roles: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Users Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'role_id' => $model->role_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-roles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
