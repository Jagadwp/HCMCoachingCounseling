<?php

/** @var yii\web\View $this */

use yii\widgets\ListView;

$this->title = 'Worklists (Superior)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="jumbotron text-left bg-transparent pl-0 pt-1 pb-2">
        <h1 class="display-5">Welcome, <?= \Yii::$app->user->identity->name ?></h1>
        <p class="">Here are your worklist:</p>
    </div>

    <section class="cc_request">
        <h2 class="mb-0">CC Request</h2>
        <?=
        ListView::widget([
            "dataProvider" => $dataProvider,
            // "filterModel" => $searchModel,
            "itemView" => "_cc_request_item",
            "options" => ["class" => "row"],
            "itemOptions" => ["class" => "col-md-6 col-lg-4"],
            "summaryOptions" => ["class" => "col-12 mb-3"],
            "emptyTextOptions" => ["class" => "col-12 mb-3"]
        ])
        ?>
    </section>

    <section class="cc_request mt-4">
        <h2 class="mb-0">Upcoming CC</h2>
        <div class="row">
            <div class="col-12 mb-3">Showing <b>0-0</b> of <b>0</b> items.</div>
            <div class="col-12">
                - No Items -
            </div>
        </div>
    </section>
</div>