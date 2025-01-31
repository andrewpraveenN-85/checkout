<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Suppliers $model */

$this->title = 'Create Suppliers';
$this->params['breadcrumbs'][] = ['label' => 'Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suppliers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
