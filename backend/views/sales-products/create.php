<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SalesProducts $model */

$this->title = 'Create Sales Products';
$this->params['breadcrumbs'][] = ['label' => 'Sales Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-products-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
