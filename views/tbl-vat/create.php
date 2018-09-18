<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblVat */

$this->title = 'บันทึกข้อมูลใหม่';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Vats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-vat-create">

    <div class="row">
		<div class="col-lg-12">
    		<h1 class="page-header"><?= Html::encode($this->title) ?></h1>
    	</div>
	</div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
