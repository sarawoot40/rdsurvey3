<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblStore */

$this->title = $model->store_name;
$this->params['breadcrumbs'][] = ['label' => 'Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-store-view">
    <style>
      html, body, #map-canvas1 {
        height: 300px;
        width: 100%;
         margin-bottom: 10px;
      }
      img {
        vertical-align: middle;
        width: 75px;
      }
      .panel-body {
        padding: 0px;
      }
      .panel-default {
        border-color: #ffffff;
     }
    </style>
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
      </div>
    </div>
    <div class='row'>
        <div class='col-lg-8'>
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
        <div class='col-lg-4'>
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
                
            ],
        ]) ?>
        </div>
    </div>
</div>
