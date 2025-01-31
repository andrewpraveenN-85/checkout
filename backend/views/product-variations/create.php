<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ProductVariations $model */

$this->title = 'Create Product Variations';
$this->params['breadcrumbs'][] = ['label' => 'Product Variations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-variations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
