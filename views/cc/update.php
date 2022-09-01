<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cc */

$this->title = 'Update Cc: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ccs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
