<?php

use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SmtpConfigurationsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'SMTP';
$this->params['breadcrumbs'][] = 'Settings';
$this->params['breadcrumbs'][] = 'Configurations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="smtp-configurations-index">

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
            'host',
            'port',
            [
                'attribute' => 'encryption',
                'value' => function ($data) {
                    return strtoupper($data->encryption);
                },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'encryption',
                        [
                            'ssl' => 'SSL',
                            'tls' => 'TLS',
                            'none' => 'None',
                        ],
                        ['class' => 'form-control', 'prompt' => 'Select']
                ),
            ],
            'username',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return ucfirst($data->status);
                },
                'filter' => Html::activeDropDownList(
                        $searchModel,
                        'status',
                        [
                            'default' => 'Default',
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
                    },
                ],
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>


    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <?php if ($model->isNewRecord) { ?>
                    <?php $form = ActiveForm::begin(['action' => ['create'], 'options' => ['enctype' => 'multipart/form-data']]); ?>
                <?php } else { ?>
                    <?php $form = ActiveForm::begin(['action' => ['update', 'id' => $model->id], 'options' => ['enctype' => 'multipart/form-data']]); ?>
                <?php } ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?= $model->isNewRecord ? 'Create Tax' : 'Update Tax - ' . Html::encode($model->name) ?></h5>
                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <?= $form->field($model, 'host')->textInput(['maxlength' => 200, 'placeholder' => 'Tax name']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'port')->textInput(['type' => 'number', 'min' => 0.00, 'step' => 0.01, 'max' => 100.00, 'placeholder' => 'Tax rate']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'encryption')->textInput(['type' => 'number', 'min' => 0.00, 'step' => 0.01, 'max' => 100.00, 'placeholder' => 'Tax rate']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'username')->textInput(['type' => 'date', 'placeholder' => 'Effective date']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'password')->textInput(['type' => 'date', 'placeholder' => 'Expiration date']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'status')->dropDownList(['default' => 'Default', 'active' => 'Active', 'inactive' => 'Inactive'], ['prompt' => 'Status...']) ?>
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
