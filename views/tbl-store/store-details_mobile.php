<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use Da\QrCode\QrCode;

$app = "&app=";
$Qr = 'https://rdsurvey.net/web/tbl-store/view-detail-mobile?_format=json&id='.$model->store_id.$app;

$qrCode = (new QrCode($Qr))
   ->setSize(400)
   ->setMargin(5)
   ->useForegroundColor(000, 000, 000);/* @var $this yii\web\View */
/* @var $model app\models\TblStore */

$this->title = $model->store_name;
$this->params['breadcrumbs'][] = ['label' => 'Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$key = substr($url, -3);
?>
<style>
  @media (min-width: 767px) {                  
  .content-to-hide {
      display: none;
   }
 }
  .custom{
  background-color: #5B97B1;
  }
  .custom a{
    margin-left: 5px;
    color: #fff;
    line-height: normal;
 }
 .logo-img{
  margin-top: 5px;
  margin-bottom: 5px;
 }
</style>
<?php if($key == 'app'){ ?>
 <style type="text/css">#hide{
  display:none;
</style>
<?php }?>
  <nav class="navbar custom content-to-hide" id="hide">
      <table width="100%">
        <tr>
          <td h3 align = 'left'>
          <a href="https://play.google.com/store/apps/details?id=net.toonoo.rdsurvey"><img src="../img/rd_app_icon.png" class="logo-img" style="width:60px"></a>
          </td>
          <td>
             <a href="https://play.google.com/store/apps/details?id=net.toonoo.rdsurvey" style="font-size:20px">RD Survey</a><br><a style="font-size:13px; text-decoration:none">เรามี App ด้วยนะ ลองใช้ App เพื่อข้อมูลที่ครบถ้วน</a>
          </td>
        </tr>
      </table>
    </div>
  </nav>

<div class="tbl-store-view">
    <style>
      html, body, #map-canvas1 {
        height: 300px;
        width: 100%;
         margin-bottom: 10px;
      }
      /*img {
        vertical-align: middle;
        width: 75px;
      }*/
      .panel-body {
        padding: 0px;
      }
      .panel-default {
        border-color: #ffffff;
     }
    </style>
        <div class='row'>
            <div id="map-canvas1"></div>
            
            <script>
                function initialize() {
                  var myLatlng = new google.maps.LatLng(<?= $model['lat'] ?>, <?= $model['long'] ?>);
                  var mapOptions = {
                    zoom: 17,
                    center: myLatlng
                  }
                  var map = new google.maps.Map(document.getElementById('map-canvas1'), mapOptions);

                  var marker = new google.maps.Marker({
                      position: myLatlng,
                      map: map,
                      title: 'Hello World!'
                  });
                }

                google.maps.event.addDomListener(window, 'load', initialize);

            </script>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
            <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
        <div class='row'>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                  <div class="panel-body">
                     <?= dosamigos\gallery\Gallery::widget(['items' => $model->getThumbnails($model->ref,$model->store_name)]);?>
                  </div>
                </div>
            </div>
        </div>
        <div class='row'>
        <div class='col-lg-12'>
        <?= DetailView::widget([
            'model' => $model,
            'template' => '<tr><th class="col-lg-3">{label}</th><td class="col-lg-11">{value}</td></tr>',
            'attributes' => [
             //'store_id',
             'pin',
             'store_name',
             'owner_name',
             //'tin',
             'type.type_name',
             //'vat',
             'tax.vat_name',
             'tel',
             'lat',
             'long',
             'address',
             // 'start_date',
             // 'open_time',
             // 'num_table',
             // 'emp_total',
             // 'store_desc',
             //'tax_link',
            'img',
            'create_date',
            'update_date',
            'user_id',
            ],
        ]); ?>
            <div class="row" align="center">
                        <?php
                        $qrCodeShow = (new QrCode($Qr))
                           ->setSize(350)
                           ->setMargin(0)
                           ->useForegroundColor(000, 000, 000);
                           // or even as data:uri url
                           echo '<img src="' . $qrCodeShow->writeDataUri() . '">';
                        ?>
            </div>
        </div>
    </div>
</div>
