<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblVat */

$this->title = 'Update Tbl Vat: ' . $model->vat_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Vats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->vat_id, 'url' => ['view', 'id' => $model->vat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-vat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
