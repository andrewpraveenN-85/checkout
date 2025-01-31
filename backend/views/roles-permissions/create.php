<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\RolesPermissions $model */

$this->title = 'Create Roles Permissions';
$this->params['breadcrumbs'][] = ['label' => 'Roles Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-permissions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
