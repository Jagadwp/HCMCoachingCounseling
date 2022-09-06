<?php

/** @var yii\web\View $this */

use hail812\adminlte\widgets\SmallBox;

$this->title = 'Worklists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="jumbotron text-left bg-transparent pl-0 py-2">
        <h1 class="display-5">Welcome, Moh. Abdul Ghafur</h1>
        <h3 class="">Here are your worklist:</h3>
    </div>

    <div class="row">
        <?php foreach ($worklists as $worklist) { ?>
            <div class="col-md-4">
                <div class="small-box bg-<?= $worklist['theme'] ?>">
                    <div class="inner">
                        <span class="badge" style="background: rgba(0,0,0,0.10) !important; text-transform: capitalize;">
                            • <?= $worklist["type"] ?>
                        </span>
                        <h5 class="mb-0"> <strong><?= $worklist["title"] ?></strong></h5>
                        <p style="font-size: 14px;" class="mb-2"><?= $worklist["date"] ?> <?= $worklist["time"] ?></p>
                        <u><i style="font-size: 12px; text-transform: capitalize;"><?= $worklist["status"] ?></i></u>
                    </div>
                    <div class="icon">
                        <i class="fa fa-pager"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More detail <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>



</div>