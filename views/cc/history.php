<?php

/** @var yii\web\View $this */

use yii\widgets\ListView;

$this->title = 'CC History (Done)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="jumbotron text-left bg-transparent pl-0 pt-1 pb-2">
        <h1 class="display-5">Welcome, <?= \Yii::$app->user->identity->name ?></h1>
        <p class="">Here are your CC history:</p>
    </div>

    <section class="cc_request mt-4">
        <h2 class="mb-0">Completed CC</h2>
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
</div>