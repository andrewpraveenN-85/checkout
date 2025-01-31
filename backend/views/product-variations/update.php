<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ProductVariations $model */

$this->title = 'Update Product Variations: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Variations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-variations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
