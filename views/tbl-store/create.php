<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblStore */

$this->title = 'บันทึกข้อมูลใหม่';
$this->params['breadcrumbs'][] = ['label' => 'จัดการข้อมูล', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-store-create">

	<div class="row">
		<div class="col-lg-12">
    		<h1 class="page-header"><?= Html::encode($this->title) ?></h1>
    	</div>
	</div>
    <?= $this->render('_form', [
        'model' => $model,
        'initialPreview'=>[],
        'initialPreviewConfig'=>[]
    ]) ?>

</div>
