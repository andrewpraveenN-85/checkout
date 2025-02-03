<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\RawItemsCategories $model */

$this->title = 'Create Raw Items Categories';
$this->params['breadcrumbs'][] = ['label' => 'Raw Items Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raw-items-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
