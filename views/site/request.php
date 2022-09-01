<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Request CC';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to request CC:</p>

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

    <!-- <div class="mb-3 required">
        <b>Title</b>
        <?php //= Html::input('text', "title", '', $options = ['class' => 'form-control', 'maxlength' => 100, 'style' => 'width:340px;', "placeholder" => "Input your title"]) ?>
        <div class="col-lg-7 invalid-feedback"></div>
    </div> -->

    <?= $form->field($model, 'title', ["options" => ["class" => "mb-3"]])
                ->textInput(['autofocus' => true, "placeholder" => "Enter title", "style" => "width: 340px"])
                ->label("Title", ["class" => "ps-0"]) ?>

    <?= $form->field($model, "cc_category_id", ["options" => ["class" => "mb-3"]])
            ->dropDownList(
                ["1" => "Regular", "2" => "Learning Plan", "3" => "Career Plan", "5" => "Goal Setting", "6" => "Target Monitoring", "7" => "Achievement" ], 
                ['class' => 'form-control', 'style' => 'width:340px;', 'prompt' => '- Select CC Type -'])
            ->label("CC Type", ["class" => "ps-0"])
    ?>

    <?php // $form->field($model, 'username')->textInput(['autofocus' => true]) 
    ?>
    <?php
    // $form->field($model, 'rememberMe')->checkbox([
    //     'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    // ]) 
    ?>

    <div class="form-group text-right">
        <?= Html::button('Cancel', ['class' => 'btn btn-danger mr-3', 'name' => 'cancel-button']) ?>
        <?= Html::submitButton('Request', ['class' => 'btn btn-success', 'name' => 'request-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <!-- <div class="offset-lg-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div> -->
</div>