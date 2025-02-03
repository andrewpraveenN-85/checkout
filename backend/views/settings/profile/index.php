<?php

use yii\web\JsExpression;
use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Profile';
$this->params['breadcrumbs'][] = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <div class="row">
        <div class="col-3">
            <?php $formProfilePicture = ActiveForm::begin(['action' => ['profile-picture'], 'options' => ['enctype' => 'multipart/form-data']]); ?>
            <picture>
                <img src="<?= Yii::$app->request->hostInfo . '/' . $model->profile_picture; ?>" class="img-fluid img-thumbnail">
            </picture>
            <?= $formProfilePicture->field($model, 'picture')->fileInput(['placeholder' => 'Upload your logo',])->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-5">
            <?php $formProfile = ActiveForm::begin(['action' => ['profile']]); ?>

            <?=
            $formProfile->field($model, 'first_name')->textInput([
                'maxlength' => true,
                'placeholder' => 'Enter your name',])
            ?>

            <?=
            $formProfile->field($model, 'middle_name')->textInput([
                'maxlength' => true,
                'placeholder' => 'Enter your name',])
            ?>

            <?=
            $formProfile->field($model, 'last_name')->textInput([
                'maxlength' => true,
                'placeholder' => 'Enter your name',])
            ?>

            <?=
            $formProfile->field($model, 'date_of_birth')->textInput([
                'type' => 'date', // Use date picker for better UX
                'placeholder' => 'Select the date of establishment',
                'max' => date('Y-m-d') // Restrict date selection to today or earlier
            ])
            ?>

            <?=
            $formProfile->field($model, 'contact_number')->textInput([
                'maxlength' => 15, // For a standard phone number format
                'placeholder' => 'Enter your phone number',
                'pattern' => '^\+?[0-9]*$', // This allows optional '+' at the start and only numbers
            ])
            ?>

            <?=
            $formProfile->field($model, 'email')->textInput([
                'maxlength' => true,
                'placeholder' => 'Enter your email address',
                'type' => 'email', // Ensures browser validation for email
            ])
            ?>

            <?=
            $formProfile->field($model, 'address')->textInput([
                'maxlength' => true,
                'placeholder' => 'Enter your address',
            ])
            ?>

            <?=
            $formProfile->field($model, 'city')->dropDownList($cities, [
                'prompt' => 'Select...',
                'id' => 'city-dropdown'
            ])
            ?>

            <?=
            $formProfile->field($model, 'state')->dropDownList($states, [
                'prompt' => 'Select...',
                'id' => 'state-dropdown'
            ])
            ?>

            <?=
            $formProfile->field($model, 'country')->dropDownList($countries, [
                'prompt' => 'Select...',
                'id' => 'country-dropdown',
                'onchange' => '$.get("' . Url::to(["get-states-cities"]) . '?country=" + $(this).val(), function(data) {
                    var response = JSON.parse(data); 
                    $("#state-dropdown").html(response.states); 
                    $("#city-dropdown").html(response.cities);
                    alert();
                });'
            ])
            ?>

            <?=
            $formProfile->field($model, 'postal_code')->textInput([
                'maxlength' => true,
                'id' => 'postal-code',
                'placeholder' => 'Enter Postal Code'
            ])
            ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-4">
            <?php $formPassword = ActiveForm::begin(['action' => ['password']]); ?>

            <?= $formPassword->field($model, 'password')->passwordInput() ?>

            <?=
            $formPassword->field($model, 'newpassword', [
                'template' => '{label}<div class="input-group">{input}<button type="button" id="generate-password" class="btn btn-outline-secondary"><i class="fa fa-random"></i></button></div>{error}'
            ])->passwordInput(['id' => 'signupform-password', 'placeholder' => 'Enter 8+ character password'])
            ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
<!-- Include JavaScript for Postal Code Validation -->
<?php
$this->registerJs(new JsExpression("
    $(document).ready(function() {
        var isFormValid = true; // Flag to track form validity

        // Logo Validation
        document.getElementById('users-picture').addEventListener('change', function(event) {
            var formGroup = event.target.closest('.form-group');
            var helpBlock = formGroup.querySelector('.help-block');
            var input = event.target;
            var file = event.target.files[0];
            var allowedExtensions = ['jpg', 'jpeg', 'png'];
            var maxSize = 1024 * 1024; // 1 MB
            var minWidth = 100;
            var maxWidth = 2000;
            var minHeight = 100;
            var maxHeight = 2000;

            // Reset error state
            formGroup.removeClass('has-error');
            formGroup.addClass('has-success');
            helpBlock.textContent = '';

            if (file) {
                // Check file extension
                var fileExtension = file.name.split('.').pop().toLowerCase();
                if (!allowedExtensions.includes(fileExtension)) {
                    helpBlock.textContent = 'Invalid file type. Only JPG, JPEG, and PNG are allowed.';
                    formGroup.removeClass('has-success').addClass('has-error');
                    isFormValid = false; // Set form invalid
                    return;
                }

                // Check file size
                if (file.size < 1024 || file.size > maxSize) {
                    helpBlock.textContent = 'File size must be between 1 KB and 1 MB.';
                    formGroup.removeClass('has-success').addClass('has-error');
                    isFormValid = false; // Set form invalid
                    return;
                }

                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = new Image();
                    img.onload = function() {
                        var width = img.width;
                        var height = img.height;

                        // Check image dimensions
                        if (width < minWidth || width > maxWidth || height < minHeight || height > maxHeight) {
                            helpBlock.textContent = 'Image dimensions must be between ' + minWidth + 'x' + minHeight + ' and ' + maxWidth + 'x' + maxHeight + ' pixels.';
                            formGroup.removeClass('has-success').addClass('has-error');
                            isFormValid = false; // Set form invalid
                            return;
                        }

                        // Check if width and height are equal
                        if (width !== height) {
                            helpBlock.textContent = 'The image width must be equal to the height.';
                            formGroup.removeClass('has-success').addClass('has-error');
                            isFormValid = false; // Set form invalid
                            return;
                        }

                        // If all validations passed
                        helpBlock.textContent = ''; // Clear error message
                        formGroup.removeClass('has-error').addClass('has-success');
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Prevent form submission if any validation fails
        $('#form-signup').on('beforeSubmit', function(e) {
            if (!isFormValid) {
                e.preventDefault(); // Prevent form submission if there are errors
                return false;
            }
        });
        
        document.getElementById('generate-password').addEventListener('click', function() {
            let charset = \"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+\";
            let password = \"\";
            for (let i = 0; i < 12; i++) {
                password += charset.charAt(Math.floor(Math.random() * charset.length));
            }
            document.getElementById('signupform-password').value = password;
        });

    });
"));
?>
