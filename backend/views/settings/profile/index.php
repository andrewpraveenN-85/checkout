<?php

use yii\helpers\Html;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Profile';
$this->params['breadcrumbs'][] = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-3">

        </div>
        <div class="col-9">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'date_of_birth')->textInput() ?>

            <?= $form->field($model, 'contact_number')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
