<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SmtpConfigurations $model */

$this->title = 'Update Smtp Configurations: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Smtp Configurations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="smtp-configurations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
