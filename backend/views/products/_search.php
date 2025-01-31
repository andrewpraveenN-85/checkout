<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ProductsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'product_category_id') ?>

    <?= $form->field($model, 'product_brand_id') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'store_measurement_unit_id') ?>

    <?php // echo $form->field($model, 'release_measurement_unit_id') ?>

    <?php // echo $form->field($model, 'store_to_release_measurement_conversion') ?>

    <?php // echo $form->field($model, 'single_unit_selling_measurement_unit') ?>

    <?php // echo $form->field($model, 'release_to_single_unit_selling_measurement_conversion') ?>

    <?php // echo $form->field($model, 'bulk_selling_measurement_unit') ?>

    <?php // echo $form->field($model, 'release_to_bulk_selling_measurement_conversion') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
