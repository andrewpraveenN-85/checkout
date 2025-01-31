<?php

use backend\models\RolesPermissions;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\RolesPermissionsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Roles Permissions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-permissions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Roles Permissions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'role_id',
            'permission_id',
            'created_at',
            'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RolesPermissions $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'role_id' => $model->role_id, 'permission_id' => $model->permission_id]);
                 }
            ],
        ],
    ]); ?>


</div>
