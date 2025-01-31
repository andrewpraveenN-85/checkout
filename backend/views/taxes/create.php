<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Taxes $model */

$this->title = 'Create Taxes';
$this->params['breadcrumbs'][] = ['label' => 'Taxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
