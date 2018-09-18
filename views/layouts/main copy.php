<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

use app\models\TblStore;
use kartik\widgets\SideNav;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
          <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
            <div id="wrapper">
            <?php
            NavBar::begin([
                'brandLabel' => 'โครงการแผนที่ภาษี',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'my-navbar navbar-fixed-top',
                ],
            ]);?>
               <?php echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Home', 'url' => ['/site']],
                        ['label' => 'จัดการข้อมูล', 'url' => ['/tbl-store/index']],
                        Yii::$app->user->isGuest ?
                                ['label' => 'Login', 'url' => ['/user/login']] :
                                ['label' => 'Logout (' . Yii::$app->user->displayName . ')',
                            'url' => ['/user/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                    ],
                ]);?>
            <?php NavBar::end();?>
            <div class="side-menu">
                <nav class="navbar navbar-default" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
<!--                    <div class="navbar-header">
                        <div class="brand-wrapper">
                             Hamburger 
                            <button type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                             Brand 
                            <div class="brand-name-wrapper">
                                <a class="navbar-brand" href="#">
                                    Brand
                                </a>
                            </div>

                             Search 
                            <a data-toggle="collapse" href="#search" class="btn btn-default" id="search-trigger">
                                <span class="glyphicon glyphicon-search"></span>
                            </a>

                             Search body 
                            <div id="search" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <form class="navbar-form" role="search">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Search">
                                        </div>
                                        <button type="submit" class="btn btn-default "><span class="glyphicon glyphicon-ok"></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>-->

                    <!-- Main Menu -->
                    <div class="side-menu-container">
                        <ul class="navbar-nav nav" style="width: 299px">
                            <li><a href="<?=Yii::$app->homeUrl.'site'?>"><span class="glyphicon glyphicon-home"></span> Home</a></li>                            
                            <li class="panel panel-default" id="dropdown">
                                <?= TblStore::getMenu(); ?>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="container-fluid">
                <div class="side-body">
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    <?= $content ?>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
