<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\StoreSellingpointReleaseProductsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="store-sellingpoint-release-products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'store_selling_point_id') ?>

    <?= $form->field($model, 'product_variation_id') ?>

    <?= $form->field($model, 'request_qty') ?>

    <?= $form->field($model, 'recieve_qty') ?>

    <?= $form->field($model, 'return_qty') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
