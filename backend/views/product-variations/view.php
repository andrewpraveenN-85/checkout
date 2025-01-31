<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\ProductVariations $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Variations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-variations-view">

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
            'product_id',
            'code',
            'barcode',
            'picture',
            'description:ntext',
            'width',
            'height',
            'length',
            'weight',
            'size',
            'color',
            'discount_type',
            'discount_amount',
            'single_unit_price',
            'bulk_unit_price',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
