<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Purchases $model */

$this->title = 'Create Purchases';
$this->params['breadcrumbs'][] = ['label' => 'Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchases-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
