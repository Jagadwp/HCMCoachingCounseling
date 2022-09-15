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

    <?php if (isset($from_request) && $from_request) : ?>
        <div class="form-group field-cc-subordinate_id_readonly">
            <label class="control-label" for="cc-subordinate_id_readonly">Subordinate</label>
            <input type="text" id="cc-subordinate_id_readonly" class="form-control" name="cc-subordinate_id_readonly" value="<?= $model->subordinate->name ?>" disabled>
        </div>

        <div class="form-group field-cc-cc_category_id_readonly">
            <label class="control-label" for="cc-cc_category_id_readonly">CC Category</label>
            <input type="text" id="cc-cc_category_id_readonly" class="form-control" name="cc-cc_category_id_readonly" value="<?= $model->category->name ?>" disabled>
        </div>

        <?= $form->field($model, 'subordinate_id')->textInput()->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'cc_category_id')->textInput()->hiddenInput()->label(false) ?>

    <?php else : ?>

        <?= $form->field($model, 'subordinate_id')->dropDownList(ArrayHelper::map($subordinates, "id", "name"), ["prompt" => "- Select Subordinate -"])->label("Subordinate") ?>

        <?= $form->field($model, 'cc_category_id')->dropDownList(ArrayHelper::map($categories, "id", "name"), ['prompt' => '- Select Type -'])->label("Cc Category") ?>

    <?php endif; ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->input("text", ["placeholder" => "Enter CC title"]) ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true])->input("text", ["placeholder" => "Enter CC link"]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true])->input("text", ["placeholder" => "Enter CC Location (Regular only)"]) ?>

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
                "format" => "yyyy-mm-dd"
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
        const toggleCcLocation = () => {
            const cc_location = document.getElementById("cc-location")
            if (document.getElementById("cc-cc_category_id").value === "6") { // 6 = regular
                cc_location.disabled = false
            } else {
                cc_location.disabled = true
                cc_location.value = ""
            }
        }
        window.addEventListener('load', (event) => {
            const cc_title = document.getElementById("cc-title")
            if(cc_title.value === " ") cc_title.value = ""

            toggleCcLocation()
            document.getElementById("cc-cc_category_id").addEventListener("change", (e) => {
                toggleCcLocation()
            })
        });
    </script>
</div>