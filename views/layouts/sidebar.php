<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Telkomsel CC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="height: 100vh">
        <!-- Sidebar user panel (optional) -->
        <?php if(!Yii::$app->user->isGuest) : ?>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= \Yii::$app->user->identity->name ?> <br> (<?= \Yii::$app->user->identity->role ?>)</a>
            </div>
        </div>

        <?php if(Yii::$app->user->identity->role === "superior") : ?>
        
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <a class="btn btn-success w-100 text-light" role="button" href="<?= Url::to(["/cc/create"]) ?>">
                <i class="nav-icon fas fa-edit"></i> Create CC
            </a>
        </div>
        <?php else: ?>

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <a class="btn btn-success w-100 text-light" role="button" href="<?= Url::to(["/request/create"]) ?>">
                <i class="nav-icon fas fa-edit"></i> Request CC
            </a>
        </div>
        <?php endif; ?>
        
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    // [
                    //     'label' => 'Starter Pages',
                    //     'icon' => 'tachometer-alt',
                    //     'badge' => '<span class="right badge badge-info">2</span>',
                    //     'items' => [
                    //         ['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
                    //         ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                    //     ]
                    // ],
                    ['label' => 'Worklists',  'icon' => 'table', 'url' => ["/worklist"], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Requested', 'icon' => 'book', 'url' => ['#'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'CC', 'icon' => 'book', 'url' => ['/cc/index'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'History', 'icon' => 'clock', 'url' => ['/cc/history'], 'visible' => !Yii::$app->user->isGuest],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Logout','url' => ['/site/logout'],  'visible' => !Yii::$app->user->isGuest, 
                    'template'=>'<a href="{url}" class="nav-link" data-method="post"> <i class="nav-icon fas fa-sign-out-alt"></i> {label}</a>'],
                ],
            ]);
            ?>
        </nav>
    </div>
</aside>