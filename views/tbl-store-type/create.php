<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblStoreType */

$this->title = 'Create Tbl Store Type';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Store Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-store-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
