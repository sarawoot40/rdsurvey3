<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblStoreSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-store-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'store_id') ?>

    <?= $form->field($model, 'store_name') ?>

    <?= $form->field($model, 'owner_name') ?>

    <?= $form->field($model, 'tin') ?>

    <?= $form->field($model, 'pin') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'store_type') ?>

    <?php // echo $form->field($model, 'store_desc') ?>

    <?php // echo $form->field($model, 'emp_total') ?>

    <?php // echo $form->field($model, 'vat') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'tax_link') ?>

    <?php // echo $form->field($model, 'img') ?>

    <?php // echo $form->field($model, 'lat') ?>

    <?php // echo $form->field($model, 'long') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
