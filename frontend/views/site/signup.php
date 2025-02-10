<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \frontend\models\SignupForm $model */
use yii\web\JsExpression;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'industry')->dropDownList(Yii::$app->params['industries'], ['prompt' => 'Industry...', 'autofocus' => true,]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => 255, 'placeholder' => 'Company name',]) ?>

            <?= $form->field($model, 'contact_number')->textInput(['maxlength' => 15, 'placeholder' => 'Company contact number', 'pattern' => '^\+?[0-9]*$',]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => 255, 'placeholder' => 'Company email address', 'type' => 'email',]) ?>

            <?=
            $form->field($model, 'password', [
                'template' => '{label}<div class="input-group">{input}<button type="button" class="btn btn-outline-secondary toggle-password"><i class="fa fa-eye"></i></button><button type="button" id="generate-password" class="btn btn-outline-secondary"><i class="fa fa-random"></i></button>{error}</div>'])->passwordInput(['id' => 'signupform-password', 'placeholder' => 'Enter 8+ character password'
            ])
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
        
        document.getElementById('generate-password').addEventListener('click', function() {
            let charset = \"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+\";
            let password = \"\";
            for (let i = 0; i < 12; i++) {
                password += charset.charAt(Math.floor(Math.random() * charset.length));
            }
            document.getElementById('signupform-password').value = password;
        });

        document.querySelectorAll(\".toggle-password\").forEach(button => {
            button.addEventListener(\"click\", function () {
                let input = this.closest(\".input-group\").querySelector(\"input\");
                let icon = this.querySelector(\"i\");
                if (input.type === \"password\") {
                    input.type = \"text\";
                    icon.classList.remove(\"fa-eye\");
                    icon.classList.add(\"fa-eye-slash\");
                } else {
                    input.type = \"password\";
                    icon.classList.remove(\"fa-eye-slash\");
                    icon.classList.add(\"fa-eye\");
                }
            });
       });
    });
"));
?>
