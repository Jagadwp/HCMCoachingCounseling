<?php

use yii\helpers\Url;

?>

<div class="small-box bg-<?= isset($theme) ? $theme : "success" ?>">
    <div class="inner">
        <span class="badge" style="background: rgba(0,0,0,0.10) !important; text-transform: capitalize;">
            • <?= $model->category->name ?>
        </span>
        <h5 class="mb-0"> <strong><?= $model->title ?></strong></h5>
        <p style="font-size: 14px;" class="mb-2"><?= $model->created_at === null ? "-" : $model->created_at ?></p>
        <?php if (\Yii::$app->user->can('subordinate')) : ?>
            <u>
                Superior:
                <i style="font-size: 14px; text-transform: capitalize;">
                    <?= $model->superior->name  ?>
                </i>
            </u>
        <?php else : ?>
            <u>
                Subordinate:
                <i style="font-size: 14px; text-transform: capitalize;">
                    <?= $model->subordinate->name  ?>
                </i>
            </u>
        <?php endif; ?>
    </div>
    <div class="icon">
        <i class="fa fa-pager"></i>
    </div>
    <?php if (\Yii::$app->user->can('subordinate')) : ?>
        <a href="<?= Url::to(["/cc/view", "id" => $model->id]) ?>" class="small-box-footer">
            See CC Detail <i class="fa fa-arrow-circle-right"></i>
        </a>
    <?php else : ?>
        <?php if(isset($action) && $action === "add_result") : ?>
            <a href="<?= Url::to(["/result/create", "id" => $model->id]) ?>" class="small-box-footer">
                Add Result for this CC <i class="fa fa-arrow-circle-right"></i>
            </a>
        <?php elseif(isset($action) && $action === "update_result") : ?>
            <a href="<?= Url::to(["#"]) ?>" class="small-box-footer">
                Update result for this CC <i class="fa fa-arrow-circle-right"></i>
            </a>
        <?php else: ?>
            <a href="<?= Url::to(["/cc/view", "id" => $model->id]) ?>" class="small-box-footer">
                See CC Detail <i class="fa fa-arrow-circle-right"></i>
            </a>
        <?php endif; ?>
    <?php endif; ?>
</div>