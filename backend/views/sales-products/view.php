<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\SalesProducts $model */

$this->title = $model->sales_id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sales-products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'sales_id' => $model->sales_id, 'product_variation_id' => $model->product_variation_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'sales_id' => $model->sales_id, 'product_variation_id' => $model->product_variation_id], [
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
            'sales_id',
            'product_variation_id',
            'quantity',
            'price',
            'discount',
            'total',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
