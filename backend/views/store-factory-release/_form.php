<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\StoreFactoryRelease $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="store-factory-release-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'store_feature_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'factory_feature_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'new' => 'New', 'pending' => 'Pending', 'completed' => 'Completed', 'cancelled' => 'Cancelled', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'company_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
