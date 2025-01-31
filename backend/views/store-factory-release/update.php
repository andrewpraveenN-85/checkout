<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StoreFactoryRelease $model */

$this->title = 'Update Store Factory Release: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Store Factory Releases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-factory-release-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
