<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StoreFactoryReleaseRawItems $model */

$this->title = 'Create Store Factory Release Raw Items';
$this->params['breadcrumbs'][] = ['label' => 'Store Factory Release Raw Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-factory-release-raw-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
