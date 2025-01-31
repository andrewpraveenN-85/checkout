<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \backend\models\LoginForm $model */
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = "Login";
?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="width: 24rem;">
        <h4 class="text-center mb-3">Log in</h4>
        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="mb-3">
            <label for="username" class="form-label">Email</label>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Email'])->label(false) ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password'])->label(false) ?>
        </div>
        <div class="form-check mb-3">
            <?= $form->field($model, 'rememberMe')->checkbox()->label("Remember me") ?>
        </div>
        <?= Html::submitButton('Log in', ['class' => 'btn btn-primary w-100', 'name' => 'login-button']) ?>
        <div class="text-end mt-2">
            <?= Html::a('Forgot Password?', ['site/request-password-reset'], ['class' => 'text-decoration-none']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>