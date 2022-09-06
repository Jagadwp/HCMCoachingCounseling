<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SuperiorWorklist */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'superior_worklists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="superiorworklist-view">

    <h1><?= $model->title ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'superior_id',
            'subordinate_id',
            'cc_category_id',
            'title',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
