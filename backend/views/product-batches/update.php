<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ProductBatches $model */

$this->title = 'Update Product Batches: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Batches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-batches-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
