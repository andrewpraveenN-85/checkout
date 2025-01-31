<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StoreSellingpointReleaseProducts $model */

$this->title = 'Create Store Sellingpoint Release Products';
$this->params['breadcrumbs'][] = ['label' => 'Store Sellingpoint Release Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-sellingpoint-release-products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
