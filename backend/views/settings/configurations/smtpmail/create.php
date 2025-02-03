<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SmtpConfigurations $model */

$this->title = 'Create Smtp Configurations';
$this->params['breadcrumbs'][] = ['label' => 'Smtp Configurations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smtp-configurations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
