<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\StoreFactoryReleaseRawItemsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="store-factory-release-raw-items-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'stock_transfer_id') ?>

    <?= $form->field($model, 'raw_items_id') ?>

    <?= $form->field($model, 'request_qty') ?>

    <?= $form->field($model, 'receive_qty') ?>

    <?= $form->field($model, 'return_qty') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
