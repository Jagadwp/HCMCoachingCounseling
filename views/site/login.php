<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1>Login to your account</h1>

    <p>For the purpose of our regulation, your details are required.</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
        'options' => [
            'style' => 'width: fit-content;'
        ]
    ]); ?>

        <?= $form->field($model, 'username', ["options" => ["class" => "mb-3"]])
                ->textInput(['autofocus' => true, "placeholder" => "Enter email address", "style" => "width: 340px"])
                ->label("Email", ["class" => "ps-0"]) ?>

        <?= $form->field($model, 'password', ["options" => ["class" => "mb-3"]])
                ->passwordInput(["placeholder" => "Enter password", "style" => "width: 340px"])
                ->label("Password", ["class" => "ps-0"]) ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"pl-4 ml-1 col-lg-4 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-12 px-0">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary px-0 w-100', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <!-- <div class="offset-lg-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div> -->
</div>
