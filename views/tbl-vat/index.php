<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblVatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'จัดการประเภทภาษี';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-vat-index">

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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'vat_id',
            'vat_name',
            'colormark',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
