<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ManufractureTemplates $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="manufracture-templates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_variation_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'raw_item_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usage_qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wastage_qty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cost_of_total_raw_item')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
