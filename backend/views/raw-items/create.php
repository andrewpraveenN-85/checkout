<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\RawItems $model */

$this->title = 'Create Raw Items';
$this->params['breadcrumbs'][] = ['label' => 'Raw Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raw-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
