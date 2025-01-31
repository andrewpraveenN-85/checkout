<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MeasurementUnits $model */

$this->title = 'Update Measurement Units: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Measurement Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="measurement-units-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
