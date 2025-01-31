<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SalesPaymentReferences $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sales-payment-references-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sales_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_type')->dropDownList([ 'cash_deposit' => 'Cash deposit', 'cheque' => 'Cheque', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'reference_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reference_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'pending' => 'Pending', 'approved' => 'Approved', 'failed' => 'Failed', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
