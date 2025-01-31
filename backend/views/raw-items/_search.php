<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\RawItemsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="raw-items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'picture') ?>

    <?= $form->field($model, 'raw_items_category_id') ?>

    <?php // echo $form->field($model, 'raw_items_brand_id') ?>

    <?php // echo $form->field($model, 'store_measurement_unit_id') ?>

    <?php // echo $form->field($model, 'release_measurement_unit_id') ?>

    <?php // echo $form->field($model, 'store_to_release_measurement_conversion') ?>

    <?php // echo $form->field($model, 'production_measurement_unit') ?>

    <?php // echo $form->field($model, 'release_to_production_measurement_conversion') ?>

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
