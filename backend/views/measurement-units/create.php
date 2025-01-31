<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MeasurementUnits $model */

$this->title = 'Create Measurement Units';
$this->params['breadcrumbs'][] = ['label' => 'Measurement Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="measurement-units-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
