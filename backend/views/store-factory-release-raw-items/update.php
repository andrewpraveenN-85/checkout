<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StoreFactoryReleaseRawItems $model */

$this->title = 'Update Store Factory Release Raw Items: ' . $model->stock_transfer_id;
$this->params['breadcrumbs'][] = ['label' => 'Store Factory Release Raw Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->stock_transfer_id, 'url' => ['view', 'stock_transfer_id' => $model->stock_transfer_id, 'raw_items_id' => $model->raw_items_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-factory-release-raw-items-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
