<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\StoreSellingpointReleaseProducts $model */

$this->title = $model->store_selling_point_id;
$this->params['breadcrumbs'][] = ['label' => 'Store Sellingpoint Release Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="store-sellingpoint-release-products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'store_selling_point_id' => $model->store_selling_point_id, 'product_variation_id' => $model->product_variation_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'store_selling_point_id' => $model->store_selling_point_id, 'product_variation_id' => $model->product_variation_id], [
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
            'store_selling_point_id',
            'product_variation_id',
            'request_qty',
            'recieve_qty',
            'return_qty',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
