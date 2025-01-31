<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\ManufractureTemplates $model */

$this->title = 'Create Manufracture Templates';
$this->params['breadcrumbs'][] = ['label' => 'Manufracture Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufracture-templates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
