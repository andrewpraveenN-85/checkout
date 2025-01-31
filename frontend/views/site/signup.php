<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \frontend\models\SignupForm $model */
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?=
            $form->field($model, 'industry')->dropDownList([
                'Technology' => 'Technology',
                'Retail & E-commerce' => 'Retail & E-commerce',
                'Healthcare & Pharmaceuticals' => 'Healthcare & Pharmaceuticals',
                'Finance & Banking' => 'Finance & Banking',
                'Manufacturing & Industrial' => 'Manufacturing & Industrial',
                'Energy & Utilities' => 'Energy & Utilities',
                'Real Estate & Construction' => 'Real Estate & Construction',
                'Education & Training' => 'Education & Training',
                'Entertainment & Media' => 'Entertainment & Media',
                'Hospitality & Travel' => 'Hospitality & Travel',
                'Food & Beverage' => 'Food & Beverage',
                'Logistics & Transportation' => 'Logistics & Transportation',
                    ], ['prompt' => 'Select...', 'autofocus' => true,])
            ?>

            <?=
            $form->field($model, 'name')->textInput([
                'maxlength' => true,
                'placeholder' => 'Enter your name',
            ])
            ?>

            <?=
            $form->field($model, 'registration_number')->textInput([
                'maxlength' => 20, // Assuming a specific max length for the registration number
                'placeholder' => 'Enter your registration number',
            ])
            ?>

            <?=
            $form->field($model, 'contact_number')->textInput([
                'maxlength' => 15, // For a standard phone number format
                'placeholder' => 'Enter your phone number',
                'pattern' => '^\+?[0-9]*$', // This allows optional '+' at the start and only numbers
            ])
            ?>

            <?=
            $form->field($model, 'email')->textInput([
                'maxlength' => true,
                'placeholder' => 'Enter your email address',
                'type' => 'email', // Ensures browser validation for email
            ])
            ?>

            <?=
            $form->field($model, 'website')->textInput([
                'maxlength' => true,
                'placeholder' => 'Enter your website URL',
                'type' => 'url', // Helps with URL validation
            ])
            ?>

            <?=
            $form->field($model, 'address')->textInput([
                'maxlength' => true,
                'placeholder' => 'Enter your address',
            ])
            ?>

            <?=
            $form->field($model, 'city')->dropDownList([], [
                'prompt' => 'Select...',
                'id' => 'city-dropdown'
            ])
            ?>

            <?=
            $form->field($model, 'state')->dropDownList([], [
                'prompt' => 'Select...',
                'id' => 'state-dropdown'
            ])
            ?>

            <?=
            $form->field($model, 'country')->dropDownList($countries, [
                'prompt' => 'Select...',
                'id' => 'country-dropdown',
                'onchange' => '$.get("' . Url::to(["site/get-states-cities"]) . '?country=" + $(this).val(), function(data) {
                    var response = JSON.parse(data); 
                    $("#state-dropdown").html(response.states); 
                    $("#city-dropdown").html(response.cities);
                });'
            ])
            ?>

            <?=
            $form->field($model, 'postal_code')->textInput([
                'maxlength' => true,
                'id' => 'postal-code',
                'placeholder' => 'Enter Postal Code'
            ])
            ?>

            <?=
            $form->field($model, 'established_date')->textInput([
                'type' => 'date', // Use date picker for better UX
                'placeholder' => 'Select the date of establishment',
                'max' => date('Y-m-d') // Restrict date selection to today or earlier
            ])
            ?>

            <?=
            $form->field($model, 'number_of_employees')->textInput([
                'type' => 'number', // Ensures only numbers can be entered
                'min' => 1, // Prevents entering zero or negative numbers
                'step' => 1,
                'placeholder' => 'Enter the number of employees',
            ])
            ?>

            <?=
            $form->field($model, 'annual_revenue')->textInput([
                'type' => 'number', // Ensures only numbers can be entered
                'maxlength' => true,
                'placeholder' => 'Enter the annual revenue',
                'step' => 1000, // Allows decimal values for precise input
                'step' => 1000
            ])
            ?>

            <?= $form->field($model, 'logo')->fileInput(['placeholder' => 'Upload your logo',]) ?>

            <?=
            $form->field($model, 'password', [
                'template' => '{label}<div class="input-group">{input}<button type="button" id="generate-password" class="btn btn-outline-secondary"><i class="fa fa-random"></i></button></div>{error}'
            ])->passwordInput(['id' => 'signupform-password', 'placeholder' => 'Enter 8+ character password'])
            ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
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
        document.getElementById('signupform-logo').addEventListener('change', function(event) {
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
