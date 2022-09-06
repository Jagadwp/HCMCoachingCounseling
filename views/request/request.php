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


    <label class="ps-0" for="shown-value">Superior</label>
    <input class="form-control" type="text" id="shown-value" value="<?= $superior->name ?>" disabled>

    <?= $form->field($model, 'superior_id')->textInput(['maxlength' => true, 'readonly' => true, 'value' => $superior->id, 'hidden' => true])->label(false) ?>

    <?= $form->field($model, 'cc_category_id')->dropDownList(ArrayHelper::map($categories, "id", "name"), ['prompt' => '- Select Type -'])->label("Cc Category", ["class" => "ps-0"]) ?>

    <div class="form-group text-right">
        <?= Html::button('Cancel', ['class' => 'btn btn-danger mr-3', 'name' => 'cancel-button']) ?>
        <?= Html::submitButton('Request', ['class' => 'btn btn-success', 'name' => 'request-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>