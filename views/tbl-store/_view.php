<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use Da\QrCode\QrCode;
/* @var $this yii\web\View */
/* @var $model app\models\TblStore */

$this->title = $model->store_name;
$this->params['breadcrumbs'][] = ['label' => 'จัดการข้อมูล', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-store-view">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <p class="pull-right">
        <?= Html::a('Print', ['print', 'id' => $model->store_id], ['class' => 'btn btn-warning','onclick'=>'window.open(this.href).print(); return false;']) ?>
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
            'store_id',
            'store_name',
            'owner_name',
            'tin',
            'pin',
            'address',
            'tel',
            'store_type_id',
            'vat',
            'start_date',
            'store_desc',
            'open_time',
            'num_table',
            'emp_total',
            'lat',
            'long',
            'tax_link',
            'img',
            'create_date',
            'update_date',
            'user_id',
            
        ],
    ]) ?>
</div>
