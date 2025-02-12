<?php

use backend\models\Suppliers;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SuppliersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$isUpdate = Yii::$app->request->get('id') ? true : false;
$model = $isUpdate ? Suppliers::findOne(Yii::$app->request->get('id')) : new Suppliers();

$this->title = 'Suppliers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suppliers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#supplier-modal">
            <?= $isUpdate ? 'Update supplier' : 'Create supplier' ?>
        </button>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'registration_number',
            'address:ntext',
            'city',
            //'state',
            //'country',
            //'postal_code',
            //'phone',
            //'status',
            //'company_id',
            //'created_at',
            //'updated_at',
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

    <!-- Modal for Create/Update supplier -->
    <div class="modal fade" id="supplier-modal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <?php
                // The form's action will be "create" or "update" based on the $isUpdate flag.
                $form = ActiveForm::begin([
                    'id' => 'supplier-form',
                    'action' => $isUpdate ? ['update', 'id' => $model->id] : ['create'],
                    'options' => ['enctype' => 'multipart/form-data']
                ]);
                ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="supplierModalLabel">
                        <?= $isUpdate ? 'Update supplier' : 'Create supplier' ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'registration_number')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'postal_code')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => '']) ?>

                    <?= $form->field($model, 'company_id')->textInput(['maxlength' => true]) ?>
                    
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
            $('#supplier-modal').modal('show');
        }
    });
", \yii\web\View::POS_END);
?>
