<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cc */
/* @var $modelResult app\models\CcResult */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Ccs', 'url' => ['./worklist']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cc-view">

    <h1><?= $model->title ?></h1>

    <?php if(!\Yii::$app->user->can('subordinate')): ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'superior_id',
                'label' => 'Superior',
                'value' => $model->superior->name
            ],
            [
                'attribute' => 'subordinate_id',
                'label' => 'Subordinate',
                'value' => $model->subordinate->name
            ],
            [
                'attribute' => 'cc_category_id',
                'label' => 'CC Category',
                'value' => $model->category->name
            ],
            'title',
            'link',
            'location',
            'date',
            'time',
            'created_at',
            'updated_at',
        ],
    ]) ?>


    <?php if ($modelResult): ?>
    <h3 class="mt-3">Result: </h3>
        <?= DetailView::widget([
            'model' => $modelResult,
            'attributes' => [
                'condition',
                'problem',
                'note',
                'result',
                'created_at',
                'updated_at'
            ],
        ]) ?>

    <?php endif; ?>

    <?php if(\Yii::$app->user->can('subordinate') && $modelResult->status == null): ?>
        <p>
            <?= Html::a('Accept', ['./result/respond', 'id' => $modelResult->cc_id, 'response' => true], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Are you sure you want to accept this result?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Reject', ['./result/respond', 'id' => $modelResult->cc_id, 'response' => false], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to reject this result?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif ?>


</div>
