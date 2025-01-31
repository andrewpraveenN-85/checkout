<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SalesProducts $model */

$this->title = 'Update Sales Products: ' . $model->sales_id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sales_id, 'url' => ['view', 'sales_id' => $model->sales_id, 'product_variation_id' => $model->product_variation_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
