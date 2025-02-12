<?php

use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use backend\models\Taxes;

/** @var yii\web\View $this */
/** @var backend\models\TaxesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

// Check if an 'id' parameter exists for update
$isUpdate = Yii::$app->request->get('id') ? true : false;
$model = $isUpdate ? Taxes::findOne(Yii::$app->request->get('id')) : new Taxes();

$this->title = 'Taxes';
$this->params['breadcrumbs'][] = 'Settings';
$this->params['breadcrumbs'][] = 'Configurations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taxes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!-- Button to trigger the modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#taxes-modal">
            <?= $isUpdate ? 'Update Taxes' : 'Create Taxes' ?>
        </button>
    </p>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'tax_name',
            'tax_rate',
            'effective_date',
            'expiration_date',
            'status',
            [
                'class' => ActionColumn::className(),
                'template' => '{custom}',
                'buttons' => [
                    'custom' => function ($url, $data, $key) {
                        // This update button reloads the page with an id parameter
                        return Html::a(
                            'Update',
                            ['index', 'id' => $data->id],
                            [
                                'class' => 'btn btn-primary',
                                'data' => ['pjax' => 0],
                            ]
                        );
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

    <!-- Modal for Create/Update Taxes -->
    <div class="modal fade" id="taxes-modal" tabindex="-1" aria-labelledby="taxesModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <?php
                // The form's action will be "create" or "update" based on the $isUpdate flag.
                $form = ActiveForm::begin([
                    'id' => 'taxes-form',
                    'action' => $isUpdate ? ['update', 'id' => $model->id] : ['create'],
                    'options' => ['enctype' => 'multipart/form-data']
                ]);
                ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="taxesModalLabel">
                        <?= $isUpdate ? 'Update Taxes' : 'Create Taxes' ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $form->field($model, 'tax_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'tax_rate')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'effective_date')->input('date') ?>
                    <?= $form->field($model, 'expiration_date')->input('date') ?>
                    <?= $form->field($model, 'status')->dropDownList(['default' => 'Default', 'active' => 'Active', 'inactive' => 'Inactive']) ?>
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
// This JavaScript checks if an 'id' parameter is present when the page loads.
// If yes, it automatically shows the modal so that the update form is visible.
$this->registerJs("
    $(document).ready(function(){
        var id = '" . Yii::$app->request->get('id') . "';
        if (id) {
            $('#taxes-modal').modal('show');
        }
    });
", \yii\web\View::POS_END);
?>