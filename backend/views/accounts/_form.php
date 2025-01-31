<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Accounts $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="accounts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'account_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_type')->dropDownList([ 'Asset' => 'Asset', 'Liability' => 'Liability', 'Equity' => 'Equity', 'Revenue' => 'Revenue', 'Expense' => 'Expense', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
