<?php

use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\UsersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">
            Create
        </button>
    </p>
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'format' => ['html'],
                'value' => function ($data) {
                    return Html::img($data->profile_picture, ['class' => 'img-fluid', 'style' => 'height: 50px;']); // options of size there
                },
            ],
            'first_name',
            'contact_number',
            'email:email',
            [
                'attribute' => 'role_name', // Make sure this matches your search model property
                'label' => 'Role',
                'value' => function ($data) {
                    return $data->role_name;
                },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'role_name',
                        $roles, // Fetch roles from DB
                        ['class' => 'form-control', 'prompt' => 'Select']
                ),
            ],
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return ucfirst($data->status);
                },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'status',
                        [
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                        ],
                        ['class' => 'form-control', 'prompt' => 'Select']
                ),
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{custom}',
                'buttons' => [
                    'custom' => function ($url, $data, $key) {
                        if ($data->id !== Yii::$app->user->id) {
                            return Html::a(
                                            'Update',
                                            ['index', 'id' => $data->id],
                                            [
                                                'class' => 'btn btn-primary',
                                                'data' => [
                                                    'pjax' => 0, // Ensure a full page load instead of PJAX.
                                                ],
                                            ]
                                    );
                        }
                    },
                ],
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>


    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <?php if ($model->isNewRecord) { ?>
                    <?php $form = ActiveForm::begin(['action' => ['create'], 'options' => ['enctype' => 'multipart/form-data']]); ?>
                <?php } else { ?>
                    <?php $form = ActiveForm::begin(['action' => ['update', 'id' => $model->id], 'options' => ['enctype' => 'multipart/form-data']]); ?>
                <?php } ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= $model->isNewRecord ? 'Create Emplyee' : 'Update Employee - ' . Html::encode($model->name) ?></h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if ($model->isNewRecord) { ?>
                        <div class="mb-3">
                            <?=
                            $form->field($model, 'first_name')->textInput([
                                'maxlength' => true,
                                'placeholder' => 'Enter your name',])
                            ?>
                        </div>
                        <div class="mb-3">
                            <?=
                            $form->field($model, 'contact_number')->textInput([
                                'maxlength' => 15, // For a standard phone number format
                                'placeholder' => 'Enter your phone number',
                                'pattern' => '^\+?[0-9]*$', // This allows optional '+' at the start and only numbers
                            ])
                            ?>
                        </div>
                        <div class="mb-3">
                            <?=
                            $form->field($model, 'address')->textInput([
                                'maxlength' => true,
                                'placeholder' => 'Enter your address',
                            ])
                            ?>
                        </div>
                        <div class="mb-3">
                            <?=
                            $form->field($model, 'country')->dropDownList($countries, [
                                'prompt' => 'Select...',
                            ])
                            ?>
                        </div>
                        <div class="mb-3">
                            <?=
                            $form->field($model, 'email')->textInput([
                                'maxlength' => true,
                                'placeholder' => 'Enter your email address',
                                'type' => 'email', // Ensures browser validation for email
                            ])
                            ?>
                        </div>
                        <div class="mb-3">
                            <?=
                            $form->field($model, 'password', [
                                'template' => '{label}<div class="input-group">{input}<button type="button" id="generate-password" class="btn btn-outline-secondary"><i class="fa fa-random"></i></button></div>{error}'
                            ])->passwordInput(['id' => 'signupform-password', 'placeholder' => 'Enter 8+ character password'])
                            ?>
                        </div>
                    <?php } else { ?>
                        <div class="mb-3">
                            <?= $form->field($model, 'status')->dropDownList(['active' => 'Active', 'inactive' => 'Inactive',], ['prompt' => '']) ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success w-100']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>

<?php
$this->registerJs("
    $(document).ready(function() {
        if ('" . Yii::$app->request->get('id') . "') {
            $('#modal').modal('show');
        }
        
        var myModalEl = document.getElementById('modal');
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            window.location.href = '/settings/employees'; // Replace '/index' with the actual route to your index page.
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
", \yii\web\View::POS_END); // Add at the end of the page
?>