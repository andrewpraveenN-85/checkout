<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\RolesPermissions $model */

$this->title = $model->role_id;
$this->params['breadcrumbs'][] = ['label' => 'Roles Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="roles-permissions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'role_id' => $model->role_id, 'permission_id' => $model->permission_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'role_id' => $model->role_id, 'permission_id' => $model->permission_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'role_id',
            'permission_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
