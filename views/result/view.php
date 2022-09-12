<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SuperiorWorklist */

$this->title = "CC Result";
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="result-view">

    <h1>CC Result</h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cc_id',
            'condition',
            'problem',
            'note',
            'result',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
