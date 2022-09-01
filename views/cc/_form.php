<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cc-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'subordinate_id')->textInput() ?>

    <?= $form->field($model, 'cc_category_id')->textInput() ?>

    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
