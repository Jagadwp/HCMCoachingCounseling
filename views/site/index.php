<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

<!-- display error message -->
<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissable">
         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
         <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php endif; ?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Welcome to Telkomsel CC!</h1>

    <?php if(\Yii::$app->user->isGuest): ?>
        <p class="lead">To access this application, please log in to your account.</p>
        <p><a class="btn btn-lg btn-success" href="<?= Url::to(["/site/login"]) ?>">Login</a></p>
    <?php else: ?>
        <p class="lead">To see your to-do list, please go to the worklist menu.</p>
        <p><a class="btn btn-lg btn-success" href="<?= Url::to(["/worklist/index"]) ?>">See Worklist</a></p>
    <?php endif; ?>

    </div>

</div>
