<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SalesPaymentReferences $model */

$this->title = 'Create Sales Payment References';
$this->params['breadcrumbs'][] = ['label' => 'Sales Payment References', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-payment-references-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
