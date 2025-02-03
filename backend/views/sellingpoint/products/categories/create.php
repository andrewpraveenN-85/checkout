<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ProductsCategories $model */

$this->title = 'Create Products Categories';
$this->params['breadcrumbs'][] = ['label' => 'Products Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
