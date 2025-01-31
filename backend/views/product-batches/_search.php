<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ProductBatchesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-batches-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'product_variation_id') ?>

    <?= $form->field($model, 'batch_code') ?>

    <?= $form->field($model, 'qty') ?>

    <?= $form->field($model, 'batch_expiry_date') ?>

    <?php // echo $form->field($model, 'total_unit_cost') ?>

    <?php // echo $form->field($model, 'factory_feature_id') ?>

    <?php // echo $form->field($model, 'store_feature_id') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
