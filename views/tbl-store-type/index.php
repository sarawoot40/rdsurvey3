<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblStoreTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Store Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-store-type-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Store Type', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'type_id',
            'type_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
