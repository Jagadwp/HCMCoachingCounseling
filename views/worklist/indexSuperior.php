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
            "dataProvider" => $dataProviderRequest,
            // "filterModel" => $searchModel,
            "itemView" => "_cc_request_item",
            "options" => ["class" => "row"],
            "itemOptions" => ["class" => "col-md-6 col-lg-4"],
            "summaryOptions" => ["class" => "col-12 mb-3"],
            "emptyTextOptions" => ["class" => "col-12 mb-3"]
        ])
        ?>
    </section>

    <section class="cc_result mt-4">
        <h2 class="mb-0">Running CC</h2>
        <?=
        ListView::widget([
            "dataProvider" => $dataProviderCC,
            // "filterModel" => $searchModel,
            "itemView" => "_cc_running_item",
            "options" => ["class" => "row"],
            "itemOptions" => ["class" => "col-md-6 col-lg-4"],
            "summaryOptions" => ["class" => "col-12 mb-3"],
            "emptyTextOptions" => ["class" => "col-12 mb-3"],
            "viewParams" => [
                "action" => "add_result"
            ]
        ])
        ?>
    </section>

    <section class="cc_revision mt-4">
        <h2 class="mb-0">Need  Revision</h2>
        <?=
        ListView::widget([
            "dataProvider" => $dataProviderCCRevision,
            // "filterModel" => $searchModel,
            "itemView" => "_cc_running_item",
            "options" => ["class" => "row"],
            "itemOptions" => ["class" => "col-md-6 col-lg-4"],
            "summaryOptions" => ["class" => "col-12 mb-3"],
            "emptyTextOptions" => ["class" => "col-12 mb-3"],
            "viewParams" => [
                "theme" => "danger", 
                "action" => "update_result"
            ]
        ])
        ?>
    </section>
</div>