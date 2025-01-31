<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Products $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

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
            'name',
            'product_category_id',
            'product_brand_id',
            'description:ntext',
            'store_measurement_unit_id',
            'release_measurement_unit_id',
            'store_to_release_measurement_conversion',
            'single_unit_selling_measurement_unit',
            'release_to_single_unit_selling_measurement_conversion',
            'bulk_selling_measurement_unit',
            'release_to_bulk_selling_measurement_conversion',
            'status',
            'company_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
