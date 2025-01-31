<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StoreSellingpointRelease $model */

$this->title = 'Update Store Sellingpoint Release: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Store Sellingpoint Releases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-sellingpoint-release-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
