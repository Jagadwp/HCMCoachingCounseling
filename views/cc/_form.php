<?php

use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subordinate_id')->dropDownList(ArrayHelper::map($subordinates, "id", "name"), ["prompt" => "- Select Subordinate -"])->label("Subordinate") ?>

    <?= $form->field($model, 'cc_category_id')->dropDownList(ArrayHelper::map($categories, "id", "name"), ['prompt' => '- Select Type -'])->label("Cc Category") ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true])->input("text", ["placeholder" => "Enter CC link"]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true])->input("text", ["placeholder" => "Enter CC Location (Regular only)"]) ?>

    <!-- <?= $form->field($model, 'date')->textInput() ?> -->

    <div class="mb-3 form-group field-cc_date">
        <?php
        echo '<label class="form-label">Date</label>';
        echo DatePicker::widget([
            'model' => $model,
            'attribute' => 'date',
            'options' => ['placeholder' => 'Enter CC date', "id" => "cc-date"],
            'pluginOptions' => [
                'autoclose' => true,
                'todayHighlight' => true,
                'todayBtn' => true,
                "format" => "dd, M yyyy"
            ]
        ]);
        ?>
    </div>

    <div class="mb-3 form-group field-cc_time">
        <?php
        echo '<label class="control-label">Time</label>';
        echo TimePicker::widget([
            'model' => $model,
            'attribute' => 'time',
            'options' => ['placeholder' => 'Enter CC date'],
            'pluginOptions' => [
                'showMeridian' => false,
                'minuteStep' => 5,
            ]
        ]);
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <script>
        window.addEventListener('load', (event) => {
            document.getElementById("cc-cc_category_id").addEventListener("change", (e) => {
                const cc_location = document.getElementById("cc-location")
                if (e.target.value === "6") { // 6 = regular
                    cc_location.disabled = false
                } else {
                    cc_location.disabled = true
                    cc_location.value = ""
                }
            })
        });
    </script>
</div>