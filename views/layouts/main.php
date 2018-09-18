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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRMUD1pVESv_wpOJ4zs1NWnXPthQyYUTc&sensor=false"
  type="text/javascript"></script>
<?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
            <div id="wrapper">
            <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Yii::$app->urlManager->createUrl(['index.php']); ?>">โครงการแผนที่ภาษี v1.0</a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li><a href="<?= Yii::$app->urlManager->createUrl(['tbl-store/index'])?>"><i class="fa fa-gear fa-fw"></i> จัดการข้อมูล</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <?php echo Nav::widget([
                        'options' => ['class' => 'dropdown-menu dropdown-user'],
                        'encodeLabels' => false,
                        'items' => [
                                ['label' => '<i class="fa fa-user fa-fw"></i> Profile' ,'url' => ['/user/profile']],
                                ['label' => '<i class="fa fa-user fa-fw"></i> Account' ,'url' => ['/user/admin']],
                                Yii::$app->user->isGuest ?
                                    ['label' => 'Login', 'url' => ['/user/login']] :
                                    ['label' => '<i class="fa fa-sign-out fa-fw"></i> Logout (' . Yii::$app->user->displayName . ')',
                                'url' => ['/user/logout'],
                                'linkOptions' => ['data-method' => 'post']],
                        ],
                    ]);?>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?= TblStore::getMenu(); ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
           
            <div id="page-wrapper">
                <?= $content ?>
            </div>
        </div>

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
