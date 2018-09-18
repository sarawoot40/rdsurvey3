<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblTambon */

$this->title = 'Update Tbl Tambon: ' . ' ' . $model->tambon_id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Tambons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tambon_id, 'url' => ['view', 'id' => $model->tambon_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-tambon-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
