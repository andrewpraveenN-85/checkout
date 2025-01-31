<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\CompanyFeatures $model */

$this->title = 'Create Company Features';
$this->params['breadcrumbs'][] = ['label' => 'Company Features', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-features-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
