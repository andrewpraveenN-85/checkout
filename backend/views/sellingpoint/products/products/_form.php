<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Products $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_category_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_brand_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'store_measurement_unit_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_measurement_unit_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'store_to_release_measurement_conversion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'single_unit_selling_measurement_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_to_single_unit_selling_measurement_conversion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bulk_selling_measurement_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_to_bulk_selling_measurement_conversion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'company_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
