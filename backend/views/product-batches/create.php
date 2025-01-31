<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ProductBatches $model */

$this->title = 'Create Product Batches';
$this->params['breadcrumbs'][] = ['label' => 'Product Batches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-batches-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
