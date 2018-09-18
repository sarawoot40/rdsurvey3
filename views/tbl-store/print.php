<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use Da\QrCode\QrCode;

$Qr = 'https://rdsurvey.net/web/tbl-store/view-detail-mobile?_format=json&id='.$model->store_id;

$qrCode = (new QrCode($Qr))
   ->setSize(400)
   ->setMargin(5)
   ->useForegroundColor(000, 000, 000);

$this->title = $model->store_name;
?>
<style>
	.bg{
		background: #00B6FF;
	    background: linear-gradient(#00B6FF, #d6d6c2) !important;
        -webkit-print-color-adjust: exact; 
		}

	.tx1{
		color: #fff !important;
        -webkit-print-color-adjust: exact; 
		font-size: 50px;
		}
	.tx2{
		font-size: 65px;
		}
</style>

	<div class="container-fluid text-center vendorListHeading bg"><br>
			<img src="../img/logo_nav02.jpg" alt="ทดสอบ ALT" width="100%" /><br><br>
			<h1 class="tx1">ร้านนี้เข้าสู่ระบบภาษีแล้ว</h1>
			<div class="row"><br>
	            <?php
	               // or even as data:uri url
	               echo '<img src="' . $qrCode->writeDataUri() . '">';
	            ?>
	        </div>
	        <br><br>
	        <img src="../img/mc01.png" alt="ทดสอบ ALT" width="200px" height="220px" />
			<img src="../img/mc02.png" alt="ทดสอบ ALT" width="200px" height="220px" />
			<img src="../img/mc03.png" alt="ทดสอบ ALT" width="200px" height="220px" /><br><br>
			<h1 class="tx2">คุณคือความภูมิใจของเรา</h1><br><br><br><br><br><br>
    </div>
	