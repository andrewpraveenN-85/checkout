<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\RawItemsBrands $model */

$this->title = 'Create Raw Items Brands';
$this->params['breadcrumbs'][] = ['label' => 'Raw Items Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raw-items-brands-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
