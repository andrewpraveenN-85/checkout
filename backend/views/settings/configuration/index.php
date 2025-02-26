<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\ConfigurationsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Configuration';
$this->params['breadcrumbs'][] = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configurations-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-6">
            <p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editGModal">
                    Update
                </button>
            </p>
            <?php Pjax::begin(); ?>
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => 'Currency',
                        'format' => ['html'],
                        'value' => $model->defaultCurrency->name
                    ],
                    [
                        'label' => 'Language',
                        'format' => ['html'],
                        'value' => $model->defaultLanguage->name
                    ],
                    'return_policy_days',
                    'timezone',
                    [
                        'label' => 'Notification',
                        'format' => ['html'],
                        'value' => $model->enable_notifications == 0 ? 'Disabled' : 'Enabled'
                    ],
                    'created_at',
                    'updated_at',
                ],
            ])
            ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="col-6">
            <p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editEModal">
                    Update
                </button>
            </p>
            <?php Pjax::begin(); ?>
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'smtp_transport',
                    'smtp_host',
                    'smtp_port',
                    'smtp_encryption',
                    'smtp_username',
                    'smtp_timeout',
                    'smtp_auth_mode',
                ],
            ])
            ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

    <div class="modal fade" id="editGModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <?php $form = ActiveForm::begin(['action' => ['update']]); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Edit Configuration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <?= $form->field($model, 'default_language_id')->dropDownList($languages, ['prompt' => 'Language...']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'default_currency_id')->dropDownList($currencies, ['prompt' => 'Currency...']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'return_policy_days')->textInput(['type'=>'number', 'min'=>1, 'max'=>14, 'step'=>1, 'placeholder'=>'Enter return policy days']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'timezone')->dropDownList($timezones, ['prompt' => 'Timezone...']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'enable_notifications')->checkbox(['class'=>'']) ?>
                    </div>
                </div>  
                <div class="modal-footer">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="editEModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <?php $form = ActiveForm::begin(['action' => ['update']]); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Edit Configuration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <?= $form->field($model, 'smtp_transport')->textInput(['placeholder' => 'Enter SMTP transport']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'smtp_host')->textInput(['placeholder' => 'Enter SMTP host']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'smtp_port')->textInput(['type'=>'number', 'min'=>1, 'max'=>10000, 'step'=>1, 'placeholder'=>'Enter SMTP Port']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'smtp_encryption')->textInput(['placeholder' => 'Enter SMTP encryption']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'smtp_username')->textInput(['placeholder' => 'Enter SMTP username']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'smtp_password')->textInput(['placeholder' => 'Enter SMTP password']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'smtp_timeout')->textInput(['type'=>'number', 'min'=>1, 'max'=>10000, 'step'=>1, 'placeholder'=>'Enter SMTP connection timeout']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'smtp_auth_mode')->textInput(['placeholder' => 'Enter SMTP authendication mode']) ?>
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
