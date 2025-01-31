<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\StoreFactoryReleaseRawItems $model */

$this->title = $model->stock_transfer_id;
$this->params['breadcrumbs'][] = ['label' => 'Store Factory Release Raw Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="store-factory-release-raw-items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'stock_transfer_id' => $model->stock_transfer_id, 'raw_items_id' => $model->raw_items_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'stock_transfer_id' => $model->stock_transfer_id, 'raw_items_id' => $model->raw_items_id], [
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
            'stock_transfer_id',
            'raw_items_id',
            'request_qty',
            'receive_qty',
            'return_qty',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
