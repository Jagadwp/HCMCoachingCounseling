<?php

/** @var yii\web\View $this */

use yii\widgets\ListView;

$this->title = 'Worklists (Subordinate)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="jumbotron text-left bg-transparent pl-0 pt-1 pb-2">
        <h1 class="display-5">Welcome, <?= \Yii::$app->user->identity->name ?></h1>
        <p class="">Here are your worklist:</p>
    </div>

    <section class="cc_request mt-4">
        <h2 class="mb-0">Running CC</h2>
        <?=
        ListView::widget([
            "dataProvider" => $dataProviderCC,
            // "filterModel" => $searchModel,
            "itemView" => "_cc_running_item",
            "options" => ["class" => "row"],
            "itemOptions" => ["class" => "col-md-6 col-lg-4"],
            "summaryOptions" => ["class" => "col-12 mb-3"],
            "emptyTextOptions" => ["class" => "col-12 mb-3"]
        ])
        ?>
    </section>

    <section class="cc_request mt-4">
        <h2 class="mb-0">CC with Result</h2>
        <?=
        ListView::widget([
            "dataProvider" => $dataProviderCCResult,
            // "filterModel" => $searchModel,
            "itemView" => "_cc_running_item",
            "options" => ["class" => "row"],
            "itemOptions" => ["class" => "col-md-6 col-lg-4"],
            "summaryOptions" => ["class" => "col-12 mb-3"],
            "emptyTextOptions" => ["class" => "col-12 mb-3"],
            "viewParams" => ["theme" => "warning"]
        ])
        ?>
    </section>

    <!-- <section class="cc_revision mt-4">
        <h2 class="mb-0">Need Revision</h2>
        <div class="row">
            <div class="col-12 mb-3">Showing <b>0-0</b> of <b>0</b> items.</div>
            <div class="col-12">
                - No Items -
            </div>
        </div>
    </section> -->

</div>