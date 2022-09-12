<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cc */

$this->title = 'Create Cc';
$this->params['breadcrumbs'][] = ['label' => 'Cc', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        "categories" => $categories,
        "subordinates" => $subordinates,
        "from_request" => $from_request
    ]) ?>
</div>
