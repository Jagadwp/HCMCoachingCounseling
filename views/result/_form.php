<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CcResult */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="result-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'condition')->textInput(['maxlength' => true])->input("text", ["placeholder" => "Overall condition of the Event"]) ?>

    <?= $form->field($model, 'problem')->textInput(['maxlength' => true])->input("text", ["placeholder" => "Minor or Major problem during the Event"]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true])->input("text", ["placeholder" => "Important notes from the Event"]) ?>

    <?= $form->field($model, 'result')->textInput(['maxlength' => true])->input("text", ["placeholder" => "Final Result"]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
