<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Configurations $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="configurations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'default_tax_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'default_currency_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'default_language_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'smtp_configuration_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'return_policy_days')->textInput() ?>

    <?= $form->field($model, 'timezone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'enable_notifications')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
