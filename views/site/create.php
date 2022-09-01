<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Create Worklist';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to create worklist:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
        'options' => [
            'style' => 'width: fit-content;'
        ]
    ]); ?>

    <div class="mb-3 required">
        <label class="form-label">Title</label>
        <?= Html::input('text', "title", '', $options = ['class' => 'form-control', 'maxlength' => 10, 'style' => 'width:340px', "placeholder" => "Input CC title"]) ?>
        <div class="col-lg-7 invalid-feedback"></div>
    </div>

    <div class="mb-3 required">
        <?php
        echo '<label class="form-label">Date</label>';
        echo DatePicker::widget([
            'name' => "date",
            'options' => ['placeholder' => 'Enter CC date'],
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]);
        ?>
    </div>

    <div class="mb-3 required">
        <label class="form-label">Time</label>
        <?php
        echo TimePicker::widget([
            'name' => 'time',
            'options' => ['placeholder' => 'Enter CC date'],
            'pluginOptions' => [
                'showSeconds' => true,
                'showMeridian' => false,
                'minuteStep' => 1,
                'secondStep' => 5,
            ]
        ]);
        ?>
    </div>

    <div class="mb-3 required">
        <label class="form-label">Subordinate</label>
        <?= Html::dropDownList(
            "type",
            "",
            ["1" => "Jagad", "2" => "Sena", "3" => "Reihan", "4" => "Najim"],
            ['class' => 'form-control', 'style' => 'width:340px', 'prompt' => '- Select Subordinate -']
        ) ?>
    </div>

    <div class="mb-3 required">
        <label class="form-label">Type</label>
        <?= Html::dropDownList(
            "type",
            "",
            ["regular" => "Regular",  "learning_plan" => "Learning Plan", "career_plan" => "Career Plan", "goal setting" => "Goal Setting", "target_monitoring" => "Target Monitoring", "achievement" => "Achievement"],
            ['class' => 'form-control', "id" => "cc_type", 'style' => 'width:340px', 'prompt' => '- Select Type -']
        ) ?>
    </div>

    <div class="mb-3 required">
        <label class="form-label">Location</label>
        <?= Html::input(
            'text',
            "location",
            '',
            ['class' => 'form-control', "id" => "cc_location",  'maxlength' => 10, 'style' => 'width:340px', "placeholder" => "Input CC location"]
        ) ?>
        <div class="col-lg-7 invalid-feedback"></div>
    </div>


    <?php // $form->field($model, 'username')->textInput(['autofocus' => true]) 
    ?>
    <?php
    // $form->field($model, 'rememberMe')->checkbox([
    //     'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
    // ]) 
    ?>

    <div class="form-group text-right">
        <?= Html::button('Cancel', ['class' => 'btn btn-danger mr-3', 'name' => 'cancel-button']) ?>
        <?= Html::submitButton('Create', ['class' => 'btn btn-success', 'name' => 'request-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>


    <script>
        window.addEventListener('load', (event) => {
            document.getElementById("cc_type").addEventListener("change", (e) => {
                const cc_location = document.getElementById("cc_location")
                if (e.target.value === "regular") {
                    cc_location.disabled = false
                } else {
                    cc_location.disabled = true
                    cc_location.value = ""
                }
            })
        });
    </script>
</div>