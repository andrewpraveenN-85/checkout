<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Currencies $model */

$this->title = 'Create Currencies';
$this->params['breadcrumbs'][] = ['label' => 'Currencies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currencies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
