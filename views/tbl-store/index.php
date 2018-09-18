<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblStoreSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการข้อมูล';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-store-index">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p class="pull-right">
        <?= Html::a('เพิ่มใหม่', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['style' => 'width:100%', 'class' => 'table table-striped table-bordered table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'store_id',
            'store_name',
            'owner_name',
//            'tin',
//            'pin',
             // 'address',
            [
                'attribute' => 'tel',
                'options' => ['width' => '130']
             ],
            // 'store_type',
            // 'store_desc',
             [
                'attribute' => 'emp_total',
                'options' => ['width' => '20']
             ],
            // 'vat',
            // 'start_date',
            // 'tax_link',
            // 'img',
            // 'lat',
            // 'long',
            // 'create_date',
            // 'update_date',
            // 'user_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'options' => ['width' => '70']
            ],
        ],
    ]); ?>

</div>
