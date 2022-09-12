<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cc List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cc-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Cc', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'superior_id',
                'label' => 'Superior',
                'value' => 'superior.name'
            ],
            [
                'attribute' => 'subordinate_id',
                'label' => 'Subordinate',
                'value' => 'subordinate.name'
            ],
            [
                'attribute' => 'cc_category_id',
                'label' => 'CC Category',
                'value' => 'category.name'
            ],
            'title',
            'link',
            'location',
            'date',
            'time',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>