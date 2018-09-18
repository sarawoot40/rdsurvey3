<?php
/* @var $this yii\web\View */
$this->title = 'โครงการแผนที่ภาษี';
?>
<style>
@media (max-width: 570px) {                  
  .content-to-hide {
      display: none;
   }
 }
#mapCanvas {
  width: 775px;
  height: 500px;
  margin: 0 auto;
}
#mapLegend {
  position: fixed;
  top: 160px;
  right: 0;
  width: 200px;
  background: #fdfdfd;
  color: #3c4750;
  padding: 0 10px 0 10px;
  margin: 10px;
  font-weight: bold;
  filter: alpha(opacity=80);
  opacity: 0.8;
  /*border: 2px solid #000;*/
}
#mapLegend div {
  height: 35px;
  line-height: 25px;
  font-size: 1em;
}
#mapLegend div img {
  float: left;
  margin-right: 10px;
}
#mapLegend h2 {
  text-align: center
}
</style>
<div id="map-canvas"></div>
  <div id="mapLegend" class="content-to-hide"></div>
   <?php foreach ($legendmark as $value) : ?>
        <script type="text/javascript">
        var legend= document.getElementById('mapLegend'); 
        var name = '<?= $value->vat_name ?>';
        var icon = '<?= $value->colormark ?>';
        var div = document.createElement('div');
        div.innerHTML = '<img src="' + icon + '"> ' + name;
        legend.appendChild(div);
        map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
        </script> 
      <?php endforeach; ?><?=
  '<script type="text/javascript">
    var locations = [
      '.$latlog.'
    ];

    var map = new google.maps.Map(document.getElementById("map-canvas"), {
      zoom: 13,
      center: new google.maps.LatLng(16.44194, 102.83599),
      mapTypeControl: true,
      mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
          position: google.maps.ControlPosition.TOP_RIGHT
      },
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      var pin_url = "";
      if(locations[i][4] == 2){
         pin_url = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
      }else if(locations[i][4] == 3){
         pin_url = "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png";
      }else if(locations[i][4] == 4){
         pin_url = "http://maps.google.com/mapfiles/ms/icons/purple-dot.png";
      }else if(locations[i][4] == 5){
         pin_url = "http://maps.google.com/mapfiles/ms/icons/blue-dot.png";
      }else{
         pin_url = "http://maps.google.com/mapfiles/ms/icons/green-dot.png";
      }

      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        icon: pin_url,
        map: map
      });

      google.maps.event.addListener(marker, "click", (function(marker, i) {
        return function() {
        	var s_id = locations[i][3];
        	infowindow.setContent("<a href=../web/tbl-store/view-detail?id="+s_id+">"+locations[i][0]+"</a>");
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>';
  ?>
