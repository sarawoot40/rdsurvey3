<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblTambon */

$this->title = 'Create Tbl Tambon';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Tambons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-tambon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
