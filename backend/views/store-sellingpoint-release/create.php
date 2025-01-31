<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StoreSellingpointRelease $model */

$this->title = 'Create Store Sellingpoint Release';
$this->params['breadcrumbs'][] = ['label' => 'Store Sellingpoint Releases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-sellingpoint-release-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
