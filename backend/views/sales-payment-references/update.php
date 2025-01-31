<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SalesPaymentReferences $model */

$this->title = 'Update Sales Payment References: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Payment References', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-payment-references-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
