<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblTambonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Tambons';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-tambon-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Tambon', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tambon_id',
            'tambon_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
