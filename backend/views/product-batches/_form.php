<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ProductBatches $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-batches-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_variation_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'batch_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'batch_expiry_date')->textInput() ?>

    <?= $form->field($model, 'total_unit_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'factory_feature_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'store_feature_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
