<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap5\Modal;
use yii\web\View;

/** @var yii\web\View $this */
/** @var backend\models\Companies $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">
        <div class="col-3 md"></div>
        <div class="col-6 md"><h1 class="text-primary mb-4"><i class="bi bi-building"></i> Company Details</h1></div>
        <div class="col-3 md"></div>
    </div>
    <div class="row mt-5">

    <!-- Company Logo Section -->
     
    <div class="col-md-3">
        <div class="profile-container position-relative text-center">
            <?php $companyLogo = ActiveForm::begin([
                'action' => ['profile-picture'], // ✅ Fixed: Correct action for logo upload
                'options' => ['enctype' => 'multipart/form-data']
            ]); ?>

            <!-- Profile Picture Container -->
            <div class="position-relative d-inline-block rounded-circle overflow-hidden shadow-lg"
                style="width: 160px; height: 160px; border: 4px solid #ffffff; transition: 0.3s ease-in-out;">

                <!-- Profile Image -->
                <img src="<?= Yii::$app->request->hostInfo . '/' . ($model->logo ?: 'uploads/default-logo.png'); ?>" 
                    class="img-fluid rounded-circle w-100 h-100"
                    style="object-fit: cover; transition: 0.3s ease-in-out;">

                <!-- Hover Overlay -->
                <div class="profile-hover-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center rounded-circle"
                    style="background: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s ease-in-out;">
                    
                    <!-- Camera Icon -->
                    <label for="profile-upload" class="position-absolute text-white d-flex align-items-center justify-content-center rounded-circle shadow"
                        style="width: 45px; height: 45px; background: rgba(255, 255, 255, 0.8); cursor: pointer;">
                        <i class="fas fa-camera text-dark fs-4"></i>
                    </label>
                </div>
            </div>

            <!-- Hidden File Input -->
            <?= $companyLogo->field($model, 'logo')->fileInput([
                'id' => 'profile-upload', 
                'class' => 'd-none', 
                'onchange' => 'this.form.submit();'
            ])->label(false) ?>

            <!-- Remove Image Button -->
            <?php if (!empty($model->logo)): ?>
                <button type="submit" name="remove_logo" value="1" class="btn btn-danger btn-sm mt-2">
                    <i class="fas fa-trash"></i> Remove
                </button>
            <?php endif; ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


        <!-- Company Information Section -->

        <div class="col md-9">

        <div class="companies-index container">
            <div class="card shadow-sm rounded border-0">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Company Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr><th>Company Name</th><td><?= Html::encode($model->name) ?></td></tr>
                            <tr><th>Registration Number</th><td><?= Html::encode($model->registration_number) ?></td></tr>
                            <tr><th>Industry</th><td><?= Html::encode($model->industry) ?></td></tr>
                            <tr><th>Address</th><td><?= Html::encode($model->address) ?></td></tr>
                            <tr><th>City</th><td><?= Html::encode($model->city) ?></td></tr>
                            <tr><th>State</th><td><?= Html::encode($model->state) ?></td></tr>
                            <tr><th>Country</th><td><?= Html::encode($model->country) ?></td></tr>
                            <tr><th>Postal Code</th><td><?= Html::encode($model->postal_code) ?></td></tr>
                            <tr><th>Phone</th><td><?= Html::encode($model->contact_number) ?></td></tr>
                            <tr><th>Email</th><td><?= Html::encode($model->email) ?></td></tr>
                            <tr><th>Website</th><td><?= Html::encode($model->website) ?></td></tr>
                            <tr><th>Established Date</th><td><?= Html::encode($model->established_date) ?></td></tr>
                            <tr><th>Number Of Employees</th><td><?= Html::encode($model->number_of_employees) ?></td></tr>
                            <tr><th>Annual Revenue</th><td><?= Html::encode($model->annual_revenue) ?></td></tr>
                            <tr><th>Status</th><td><span class="badge <?= $model->status === 'active' ? 'bg-success' : 'bg-danger' ?>"><?= Html::encode($model->status) ?></span></td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-end card-footer">
                    <?= Html::button('<i class="bi bi-pencil-square"></i> Edit Details', [
                        'class' => 'btn btn-primary',
                        'id' => 'editCompanyBtn',
                        'data-bs-toggle' => 'modal',
                        'data-bs-target' => '#editCompanyModal'
                    ]) ?>
                </div>
            </div>
        </div>

        <!-- Bootstrap Modal -->
        <?php Modal::begin([
            'id' => 'editCompanyModal',
            'title' => '<h4 class="text-dark fw-bold"><i class="bi bi-pencil-square"></i> Edit Company Details</h4>',
            'size' => 'modal-lg',
            'options' => ['class' => 'fade'],
        ]); ?>

        <div id="modalContent">
            <div class="p-4 border rounded shadow-sm bg-light">
                <?php $form = ActiveForm::begin([
                    'id' => 'company-form',
                    'action' => Url::to(['/settings/configurations/company/update']),
                    'method' => 'post',
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>

                <div class="row g-3">
                    <div class="col-md-6">
                        
                        <?= $form->field($model, 'name', [
                            'inputOptions' => ['class' => 'form-control rounded-pill', 'placeholder' => 'Company Name']
                        ])->label('<i class="bi bi-building"></i> Company Name') ?>

                        <?= $form->field($model, 'registration_number', [
                            'inputOptions' => ['class' => 'form-control rounded-pill', 'placeholder' => 'Registration Number']
                        ])->label('<i class="bi bi-clipboard-check"></i> Registration Number') ?>

                        <?= $form->field($model, 'industry', [
                            'inputOptions' => ['class' => 'form-control rounded-pill', 'placeholder' => 'Industry']
                        ])->label('<i class="bi bi-briefcase"></i> Industry') ?>

                        <?= $form->field($model, 'address')->textarea([
                            'rows' => 2, 'class' => 'form-control rounded-3', 'placeholder' => 'Company Address'
                        ])->label('<i class="bi bi-geo-alt"></i> Address') ?>




                        <!-- Country, State, and City with AJAX Updating -->
                        <?= $form->field($model, 'country')->dropDownList($countries, [
                            'prompt' => 'Select Country...',
                            'id' => 'country-dropdown',
                            'onchange' => '$.get("' . Url::to(["get-states-cities"]) . '?country=" + $(this).val(), function(data) {
                                var response = JSON.parse(data); 
                                $("#state-dropdown").html(response.states); 
                                $("#city-dropdown").html(response.cities);
                            });'
                        ]) ?>

                        <?= $form->field($model, 'state')->dropDownList($states, [
                            'prompt' => 'Select State...',
                            'id' => 'state-dropdown'
                        ]) ?>

                        <?= $form->field($model, 'city')->dropDownList($cities, [
                            'prompt' => 'Select City...',
                            'id' => 'city-dropdown'
                        ]) ?>

                        <!-- End of Country, State, and City with AJAX Updating -->

                        <?= $form->field($model, 'postal_code', [
                            'inputOptions' => ['class' => 'form-control rounded-pill', 'placeholder' => 'Postal Code']
                        ])->label('<i class="bi bi-envelope"></i> Postal Code') ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'contact_number', [
                            'inputOptions' => ['class' => 'form-control rounded-pill', 'placeholder' => 'Phone Number']
                        ])->label('<i class="bi bi-telephone"></i> Contact Number') ?>

                        <?= $form->field($model, 'email', [
                            'inputOptions' => ['class' => 'form-control rounded-pill', 'placeholder' => 'Company Email']
                        ])->label('<i class="bi bi-envelope-at"></i> Email') ?>

                        <?= $form->field($model, 'website', [
                            'inputOptions' => ['class' => 'form-control rounded-pill', 'placeholder' => 'Website']
                        ])->label('<i class="bi bi-globe"></i> Website') ?>

                        <?= $form->field($model, 'number_of_employees', [
                            'inputOptions' => ['type' => 'number', 'class' => 'form-control rounded-pill', 'placeholder' => 'Number of Employees']
                        ])->label('<i class="bi bi-people"></i> Number of Employees') ?>

                        <?= $form->field($model, 'annual_revenue', [
                            'inputOptions' => ['class' => 'form-control rounded-pill', 'placeholder' => 'Annual Revenue']
                        ])->label('<i class="bi bi-cash"></i> Annual Revenue') ?>

                        <?= $form->field($model, 'status')->dropDownList([
                            'Active' => 'Active',
                            'Inactive' => 'Inactive'
                        ], ['class' => 'form-select rounded-pill'])->label('<i class="bi bi-toggle-on"></i> Status') ?>

                        <!-- <div class="mb-3">
                            <label class="form-label"><i class="bi bi-image"></i> Upload Logo</label>
                            <div class="input-group">
                                <input type="file" class="form-control rounded-pill" name="Companies[logo]" id="company-logo">
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="text-end mt-3">
                    <?= Html::submitButton('<i class="bi bi-check-circle"></i> Save Changes', [
                        'class' => 'btn btn-primary rounded-pill px-4',
                        'id' => 'saveCompanyBtn'
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>


        </div>
    </div>
</div>

<?php Modal::end(); ?>

<!-- AJAX Form Submission -->
<?php
$this->registerJs("
// Handle form submission via AJAX
$('#company-form').on('beforeSubmit', function(event) {
    event.preventDefault();
    var form = $(this);
    var formData = new FormData(form[0]);

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response);
            if (response.success) {
                $('#editCompanyModal').modal('hide');
                location.reload();
            } else {
                alert('Error: ' + JSON.stringify(response.errors));
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            alert('An error occurred. Check console for details.');
        }
    });

    return false;
});
");
?>

<!-- Custom Styles -->
<style>
    /* Hover Effect */
    .profile-container:hover .profile-hover-overlay {
        opacity: 1;
    }

    .profile-container:hover img {
        filter: brightness(0.7);
    }
</style>
