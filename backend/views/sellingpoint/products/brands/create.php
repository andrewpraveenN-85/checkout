<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ProductsBrands $model */

$this->title = 'Create Products Brands';
$this->params['breadcrumbs'][] = ['label' => 'Products Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-brands-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
