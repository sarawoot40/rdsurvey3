<?php
#21082018
use yii\helpers\Html;
use yii\widgets\DetailView;
use Da\QrCode\QrCode;
/* @var $this yii\web\View */
/* @var $model app\models\TblStore */

$this->title = $model->store_name;
$this->params['breadcrumbs'][] = ['label' => 'จัดการข้อมูล', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$Qr = 'https://rdsurvey.net/web/tbl-store/view-detail-mobile?_format=json&id='.$model->store_id;

$qrCode = (new QrCode($Qr))
   ->setSize(400)
   ->setMargin(5)
   ->useForegroundColor(000, 000, 000);
?>
<div class="tbl-store-view">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
        <p class="pull-right">
        <button class = "btn btn-warning" onclick = "printContent('divton')">
            <span class="glyphicon glyphicon-print"></span> Print
        </button>
        <?= Html::a('Update', ['update', 'id' => $model->store_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->store_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

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
    ]) ?>
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
<div style="display:none">
            <div id="divton">
                <div class="container-fluid text-center vendorListHeading bg" style="background: #00B6FF;
                        background: linear-gradient(#00B6FF, #d6d6c2) !important;
                        -webkit-print-color-adjust: exact;"><br>
                    <img src="../img/logo_nav02.jpg" alt="ทดสอบ ALT" width="100%" /><br><br>
                    <h1 style="color: #fff !important;-webkit-print-color-adjust: exact; 
                        font-size: 50px;">ร้านนี้เข้าสู่ระบบภาษีแล้ว</h1>
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
                    <h1 style="font-size: 60px">คุณคือความภูมิใจของเรา</h1><br><br><br><br>
                </div>
            </div>
        </div>
<script type="text/javascript">
    function printContent(el){
       var restorepage = document.body.innerHTML;
       var printcontent = document.getElementById(el).innerHTML;
       document.body.innerHTML = printcontent;
       window.print();
       document.body.innerHTML = restorepage;
}
</script>