<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StoreSellingpointReleaseProducts $model */

$this->title = 'Update Store Sellingpoint Release Products: ' . $model->store_selling_point_id;
$this->params['breadcrumbs'][] = ['label' => 'Store Sellingpoint Release Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->store_selling_point_id, 'url' => ['view', 'store_selling_point_id' => $model->store_selling_point_id, 'product_variation_id' => $model->product_variation_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="store-sellingpoint-release-products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
