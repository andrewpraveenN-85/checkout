<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\RawItemsBrands $model */

$this->title = 'Update Raw Items Brands: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Raw Items Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="raw-items-brands-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
