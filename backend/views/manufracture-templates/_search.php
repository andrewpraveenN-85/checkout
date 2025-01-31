<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ManufractureTemplatesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="manufracture-templates-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'product_variation_id') ?>

    <?= $form->field($model, 'raw_item_id') ?>

    <?= $form->field($model, 'usage_qty') ?>

    <?= $form->field($model, 'wastage_qty') ?>

    <?php // echo $form->field($model, 'cost_of_total_raw_item') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
