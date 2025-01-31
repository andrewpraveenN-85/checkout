<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\CurrenciesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="currencies-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'currency_code') ?>

    <?= $form->field($model, 'currency_name') ?>

    <?= $form->field($model, 'symbol') ?>

    <?= $form->field($model, 'base_currency_code') ?>

    <?php // echo $form->field($model, 'exchange_rate') ?>

    <?php // echo $form->field($model, 'effective_date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
