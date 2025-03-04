<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CompanyFeatures $model */

$this->title = 'Update Company Features: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Company Features', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-features-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
