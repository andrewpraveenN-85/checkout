<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StoreFactoryRelease $model */

$this->title = 'Create Store Factory Release';
$this->params['breadcrumbs'][] = ['label' => 'Store Factory Releases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-factory-release-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
