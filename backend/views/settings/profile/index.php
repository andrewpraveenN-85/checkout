<?php

use yii\web\JsExpression;
use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Profile';
$this->params['breadcrumbs'][] = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="users-index">
    <div class="row mt-5 mb-5">
        <div class="col-3 text-center"></div>
        <div class="col-6 text-center">
            
            <div class="card shadow bg-white rounded"> 
                <div class="card-title p-4"><h3>Profile</h3></div>
            </div>

        </div>  
        <div class="col-3 text-center"></div>
    </div>
</div>

<div class="users-index">
    <div class="row">
        <div class="col-4 text-center">
            <div class="profile-container position-relative">
                <?php $formProfilePicture = ActiveForm::begin(['action' => ['profile-picture'], 'options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="profile-img-container">
                    <img src="<?= Yii::$app->request->hostInfo . '/' . $model->profile_picture; ?>" class="rounded-circle img-fluid shadow" style="width: 150px; height: 150px; object-fit: cover;">
                    <label for="profile-upload" class="edit-icon">
                        <i class="fas fa-camera"></i>
                    </label>
                    <?= $formProfilePicture->field($model, 'picture')->fileInput(['id' => 'profile-upload', 'class' => 'd-none'])->label(false) ?>
                </div>
                <div class="mt-2">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="col-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Profile Details</h5><br>
                    <p><strong>Name:</strong> <?= $model->first_name . ' ' . $model->middle_name . ' ' . $model->last_name; ?></p>
                    <p><strong>Email:</strong> <?= $model->email; ?></p>
                    <p><strong>Phone:</strong> <?= $model->contact_number; ?></p>
                    <p><strong>Address:</strong> <?= $model->address . ', ' . $model->city . ', ' . $model->state . ', ' . $model->country; ?></p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        Edit Profile
                    </button>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                        Change Password
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Profile Edit Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <?php $formProfile = ActiveForm::begin(['action' => ['profile']]); ?>
                <?= $formProfile->field($model, 'first_name')->textInput(['placeholder' => 'First Name']) ?>
                <?= $formProfile->field($model, 'middle_name')->textInput(['placeholder' => 'Middle Name']) ?>
                <?= $formProfile->field($model, 'last_name')->textInput(['placeholder' => 'Last Name']) ?>
                <?= $formProfile->field($model, 'email')->input('email', ['placeholder' => 'Email']) ?>
                <?= $formProfile->field($model, 'contact_number')->textInput(['placeholder' => 'Phone Number']) ?>
                <?= $formProfile->field($model, 'address')->textInput(['placeholder' => 'Address']) ?>

                <!-- Country, State, and City with AJAX Updating -->
                <?= $formProfile->field($model, 'country')->dropDownList($countries, [
                    'prompt' => 'Select Country...',
                    'id' => 'country-dropdown',
                    'onchange' => '$.get("' . Url::to(["get-states-cities"]) . '?country=" + $(this).val(), function(data) {
                        var response = JSON.parse(data); 
                        $("#state-dropdown").html(response.states); 
                        $("#city-dropdown").html(response.cities);
                    });'
                ]) ?>

                <?= $formProfile->field($model, 'state')->dropDownList($states, [
                    'prompt' => 'Select State...',
                    'id' => 'state-dropdown'
                ]) ?>

                <?= $formProfile->field($model, 'city')->dropDownList($cities, [
                    'prompt' => 'Select City...',
                    'id' => 'city-dropdown'
                ]) ?>

                <?= $formProfile->field($model, 'postal_code')->textInput(['placeholder' => 'Postal Code']) ?>

                <div class="modal-footer">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1">


    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>


    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>


            <div class="modal-body">
                <?php $formPassword = ActiveForm::begin(['action' => ['password']]); ?>

                <!-- Current Password Field -->
                <?= $formPassword->field($model, 'password', [
                    'template' => '{label}
                        <div class="input-group">
                            {input}
                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>{error}',
                ])->passwordInput(['placeholder' => 'Current Password', 'id' => 'current-password']) ?>

                <!-- New Password Field -->
                <?= $formPassword->field($model, 'newpassword', [
                    'template' => '{label}
                        <div class="input-group">
                            {input}
                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary generate-password">
                                <i class="fa fa-key"></i>
                            </button>
                        </div>{error}',
                ])->passwordInput(['placeholder' => 'New Password', 'id' => 'new-password']) ?>

                <div class="modal-footer">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>


        </div>
    </div>
</div>


<style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    .profile-container {
        text-align: center;
    }

    .profile-img-container {
        position: relative;
        display: inline-block;
    }

    .profile-img-container img {
        border: 4px solid #ddd;
        transition: all 0.3s ease;
    }

    .profile-img-container:hover img {
        border-color: #007bff;
    }

    .edit-icon {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 5px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 14px;
    }

    .edit-icon:hover {
        background: #007bff;
    }

    .card {
        border-radius: 12px;
    }

    .card-title {
        font-weight: bold;
    }

    .btn {
        border-radius: 6px;
    }
</style>

<script>
    document.getElementById('profile-upload').addEventListener('change', function() {
        let file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                document.querySelector('.profile-img-container img').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Toggle Password Visibility
        document.querySelectorAll(".toggle-password").forEach(button => {
            button.addEventListener("click", function() {
                let input = this.closest(".input-group").querySelector("input");
                let icon = this.querySelector("i");

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            });
        });

        // Generate Random Password
        document.querySelectorAll(".generate-password").forEach(button => {
            button.addEventListener("click", function() {
                let input = this.closest(".input-group").querySelector("input");
                input.value = generateRandomPassword(12); // Generate a 12-character password
            });
        });

        function generateRandomPassword(length) {
            const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*";
            let password = "";
            for (let i = 0; i < length; i++) {
                password += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return password;
        }
    });
</script>

