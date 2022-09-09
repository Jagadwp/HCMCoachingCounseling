<?php

use yii\helpers\Url;

?>

<div class="small-box bg-info">
    <div class="inner">
        <span class="badge" style="background: rgba(0,0,0,0.10) !important; text-transform: capitalize;">
            • <?= $model->category->name ?>
        </span>
        <h5 class="mb-0"> <strong><?= $model->title ?></strong></h5>
        <p style="font-size: 14px;" class="mb-2"><?= $model->created_at === null ? "-" : $model->created_at ?></p>
        <u>
            Requested by: 
            <i style="font-size: 14px; text-transform: capitalize;">
                <?= $model->subordinate->name  ?>
            </i>
        </u>
    </div>
    <div class="icon">
        <i class="fa fa-pager"></i>
    </div>
    <a href="<?= Url::to(["/cc/create", "id" => $model->id]) ?>" class="small-box-footer">
        Create CC for this request <i class="fa fa-arrow-circle-right"></i>
    </a>
</div>