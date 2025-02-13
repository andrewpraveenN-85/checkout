<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\bootstrap5\Modal;

/** @var yii\web\View $this */
/** @var backend\models\Companies $model */
$this->title = $model->name;
$this->params['breadcrumbs'][] = 'Settings';
$this->params['breadcrumbs'][] = 'Configurations';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="users-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-3">
            <p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editLogoModal">
                    Update
                </button> 
            </p>
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => '',
                        'format' => ['html'],
                        'value' => Html::img($model->logoURL, ['class' => 'img-fluid', 'style' => 'height:230px;'])
                    ],
                ],
            ])
            ?>
        </div>
        <div class="col-9">
            <p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCompanyModal">
                    Update
                </button>
            </p>
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'industry',
                    'name',
                    'registration_number',
                    'contact_number',
                    'email:email',
                    'website:url',
                    [
                        'label' => 'Address',
                        'format' => ['html'],
                        'value' => $model->address . ', ' . $model->city->name . ', ' . $model->city->state->name . ', ' . $model->city->state->country->name
                    ],
                    'established_date',
                    'number_of_employees',
                    'annual_revenue',
                    'created_at',
                    'updated_at'
                ],
            ])
            ?>
        </div>
    </div>

    <div class="modal fade" id="editLogoModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <?php $formProfilePicture = ActiveForm::begin(['action' => ['company-logo'], 'options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Edit Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 text-center">
                        <div class="position-relative d-inline-block overflow-hidden" style="height: 230px;">
                            <?= Html::img($model->logoURL, ['class' => 'img-fluid', 'style' => 'height:230px;']); ?>
                            <div class="profile-hover-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                                <label for="profile-upload" class="position-absolute text-white d-flex align-items-center justify-content-center"
                                       style="width: 230px; height: 230px; cursor: pointer;">
                                </label>
                                <?= $formProfilePicture->field($model, 'picture')->fileInput(['id' => 'profile-upload', 'class' => 'd-none', 'onchange' => 'this.form.submit();'])->label(false) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php if (!empty($model->logo)): ?>
                        <button type="submit" name="remove_picture" value="1" class="btn btn-danger btn-sm mt-2">Remove</button>
                    <?php endif; ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCompanyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl ">
            <div class="modal-content">
                <?php $form = ActiveForm::begin(['action' => ['update']]); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-4">
                            <?= $form->field($model, 'industry')->dropDownList(Yii::$app->params['industries'], ['prompt' => 'Industry...', 'autofocus' => true,]) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => 255, 'placeholder' => 'Company name',]) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'registration_number')->textInput(['maxlength' => 255, 'placeholder' => 'Company registration number']) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <?= $form->field($model, 'email')->input('email', ['maxlength' => 255, 'placeholder' => 'Email']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'contact_number')->textInput(['maxlength' => 15, 'placeholder' => 'Conact Number', 'pattern' => '^\+?[0-9]*$',]) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'address')->textInput(['maxlength' => 255, 'placeholder' => 'Address']) ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <?= $form->field($model, 'website')->textInput(['maxlength' => 255, 'maxlength' => 255, 'placeholder' => 'Website']) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'number_of_employees')->textInput(['type' => 'number', 'placeholder' => 'Number of employees', 'min' => 5, 'step' => 5]) ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'annual_revenue')->textInput(['type' => 'number', 'placeholder' => 'Annual revenue', 'min' => 1000, 'step' => 1000]) ?>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-4">
                            <?=
                            $form->field($model, 'country')->dropDownList($countries, ['prompt' => 'Country...', 'id' => 'country-dropdown',
                                'onchange' => '$.get("' . Url::to(["get-states"]) . '?country=" + $(this).val(), function(data) {
                                    var response = JSON.parse(data); 
                                    $("#state-dropdown").html(response);
                                    $("#city-dropdown").html("<option value=\'\'>City...</option>");
                                });'
                            ])
                            ?>
                        </div>
                        <div class="col-4">
                            <?=
                            $form->field($model, 'state')->dropDownList($states, ['prompt' => 'State...', 'id' => 'state-dropdown',
                                'onchange' => '$.get("' . Url::to(["get-cities"]) . '?states=" + $(this).val(), function(data) {
                                    var response = JSON.parse(data); 
                                    $("#city-dropdown").html(response);
                                });'
                            ])
                            ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($model, 'city_id')->dropDownList($cities, ['prompt' => 'City...', 'id' => 'city-dropdown']) ?>
                        </div>
                    </div>
                </div>  
                <div class="modal-footer">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>


<?php
$this->registerJs("
    $(document).ready(function() {
        var myModalEl = document.getElementById('editCompanyModal');
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            window.location.href = '/settings/configurations/company'; // Replace '/index' with the actual route to your index page.
        });
        document.getElementById('profile-upload').addEventListener('change', function () {
            let file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    document.querySelector('.profile-img-container img').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
", \yii\web\View::POS_END);
?>