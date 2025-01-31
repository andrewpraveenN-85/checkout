<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\ProductBatches $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Batches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-batches-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'product_variation_id',
            'batch_code',
            'qty',
            'batch_expiry_date',
            'total_unit_cost',
            'factory_feature_id',
            'store_feature_id',
            'company_id',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
