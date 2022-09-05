<?php

/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */

use yii\widgets\ActiveForm;
use yii\bootstrap5\Html;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use yii\helpers\ArrayHelper;

$this->title = 'Request CC';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="superior-worklist-form form-group">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to request CC:</p>

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'title', ["options" => ["class" => "mb-3"]])
        ->textInput(['autofocus' => true, "placeholder" => "Enter title"])
        ->label("Title", ["class" => "ps-0"]) ?>

    <?= $form->field($model, 'superior_id')->dropDownList(ArrayHelper::map($superior, "id", "name"), ['prompt' => '- Select Type -'])->label("Choose Superior", ["class" => "ps-0"]) ?>

    <?= $form->field($model, 'cc_category_id')->dropDownList(ArrayHelper::map($categories, "id", "name"), ['prompt' => '- Select Type -'])->label("Cc Category", ["class" => "ps-0"]) ?>

    <div class="form-group text-right">
        <?= Html::button('Cancel', ['class' => 'btn btn-danger mr-3', 'name' => 'cancel-button']) ?>
        <?= Html::submitButton('Request', ['class' => 'btn btn-success', 'name' => 'request-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>