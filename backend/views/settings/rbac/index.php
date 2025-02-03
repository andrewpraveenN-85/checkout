<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\RolesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Roles Base Access';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-index">

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
            'name',
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
                        if ($data->name !== 'Company') {
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

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <?php if ($model->isNewRecord) { ?>
                    <?php $form = ActiveForm::begin(['action' => ['create'], 'options' => ['enctype' => 'multipart/form-data']]); ?>
                <?php } else { ?>
                    <?php $form = ActiveForm::begin(['action' => ['update', 'id' => $model->id], 'options' => ['enctype' => 'multipart/form-data']]); ?>
                <?php } ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= $model->isNewRecord ? 'Create Role' : 'Update Role - ' . Html::encode($model->name) ?></h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-6"><?= $form->field($model, 'name')->textInput(['maxlength' => 200, 'class' => 'form-control mb-2', 'Enter the role name']) ?></div>
                        <div class="col-6"><?= $form->field($model, 'status')->dropDownList(['inactive' => 'Inactive', 'active' => 'Active'], ['class' => 'form-control mb-2', 'prompt' => 'Select',]) ?></div>
                    </div>
                    <div class="mb-3">
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProviderPermission,
                            'columns' => [
                                [
                                    'class' => 'yii\grid\CheckboxColumn',
                                    'name' => 'permission', // The name of the checkbox
                                    'checkboxOptions' => function ($model) {
                                        return [
                                    'value' => $model->id, // Value that will be submitted when checkbox is selected
                                    'class' => 'permission-checkbox', // Add a class to select checkboxes via JS
                                        ];
                                    }
                                ],
                                'name',
                            ],
                            'pager' => [
                                'class' => 'yii\widgets\LinkPager',
                                'disabledPageCssClass' => 'hidden',
                                'options' => ['class' => 'pagination'], // Disable pagination styling
                            ],
                            'layout' => "{items}",
                            'options' => [
                                'class' => 'scrollable-gridview',
                                'style' => 'height: 500px; overflow-y: auto;', // Set fixed height and enable vertical scroll
                            ],
                        ]);
                        ?>
                        <?= $form->field($model, 'permissionList')->textInput(['type' => 'hidden', 'id' => 'permission-list'])->label(false) ?>
                    </div>
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
            setTimeout(function() {
                // Get the permission-list values from the hidden input
                var selectedPermissions = $('#permission-list').val().split(',');
                // Loop through each checkbox and check if its value is in the selectedPermissions array
                $('.permission-checkbox').each(function() {
                    if (selectedPermissions.includes($(this).val())) {
                        $(this).prop('checked', true); // Check the checkbox if its value is in the list
                    }
                });
                // Update the hidden input if needed (in case the page is refreshed)
                updatePermissionList();
            }, 500);
            $('#modal').modal('show');
        }
        var myModalEl = document.getElementById('modal');
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            window.location.href = '/settings/rbac'; // Replace '/index' with the actual route to your index page.
        });
        $('body').on('change', '.permission-checkbox', function() {
            updatePermissionList();
        });
        function updatePermissionList() {
            var selectedPermissions = [];
            // Get all checked checkboxes and add their values to the array
            $('.permission-checkbox:checked').each(function() {
                selectedPermissions.push($(this).val());
            });
            // Set the selected permission IDs as a comma-separated string in the hidden input
            $('#permission-list').val(selectedPermissions.join(','));
        }
    });
", \yii\web\View::POS_END); // Add at the end of the page
?>