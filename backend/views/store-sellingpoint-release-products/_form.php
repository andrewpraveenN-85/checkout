<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\StoreSellingpointReleaseProducts $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="store-sellingpoint-release-products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'store_selling_point_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_variation_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recieve_qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'return_qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'new' => 'New', 'pending' => 'Pending', 'completed' => 'Completed', 'cancelled' => 'Cancelled', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
