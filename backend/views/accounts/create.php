<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Accounts $model */

$this->title = 'Create Accounts';
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accounts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
