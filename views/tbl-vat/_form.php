<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblVat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-vat-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
	<div class="col-lg-6">
	    <?= $form->field($model, 'vat_name')->textInput(['maxlength' => true]) ?>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
	    <?= $form->field($model, 'colormark')->textInput(['maxlength' => true]) ?>
	</div>
</div>
<div class="row">
    <div class="form-group col-lg-6">
    	<div class="pull-right">
    		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
