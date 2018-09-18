<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\TblStore */
/* @var $form yii\widgets\ActiveForm */

use app\models\TblStoreType;
use app\models\TblTambon;
use app\models\TblVat;
?>

<div class="tbl-store-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="col-lg-6">
        <?= $form->field($model, 'store_type_id')->dropDownList(
                                ArrayHelper::map(TblStoreType::find()->all(), 'type_id', 'type_name'),
                                ['prompt'=>'Select...']); ?>    
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'tambon_id')->dropDownList(
                                ArrayHelper::map(TblTambon::find()->all(), 'tambon_id', 'tambon_name'),
                                ['prompt'=>'Select...']); ?>
    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'store_name')->textInput(['maxlength' => true]) ?>        
    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'owner_name')->textInput(['maxlength' => true]) ?>        
    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'pin')->textInput(['maxlength' => true]) ?>        
    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>        
    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>        
    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'store_desc')->textInput(['maxlength' => true]) ?>        
    </div>   
    <div class="col-lg-6">
        <?= $form->field($model, 'vat')->dropDownList(
                                ArrayHelper::map(TblVat::find()->all(), 'vat_id', 'vat_name'),
                                ['prompt'=>'Select...']); ?>
    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'start_date')->widget(
         DatePicker::className(), [
             'language' => 'th',
              'options' => ['placeholder' => 'Select issue date ...'],
             'pluginOptions' => [
                 'format' => 'yyyy-mm-dd',
                 'todayHighlight' => true
             ]
     ]);?>
    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>        
    </div>
    <div class="col-lg-6">
    <?= $form->field($model, 'long')->textInput(['maxlength' => true]) ?>        
    </div>
    <?= $form->field($model, 'ref')->hiddenInput(['maxlength' => 50])->label(false); ?>
    <div class="col-lg-12">
    <div class="form-group field-upload_files">
      <label class="control-label" for="upload_files[]"> ภาพถ่าย </label>
        <div>
        <?= FileInput::widget([
                       'name' => 'upload_ajax[]',
                       'options' => ['multiple' => true,'accept' => 'image/*'], //'accept' => 'image/*' หากต้องเฉพาะ image
                        'pluginOptions' => [
                            'overwriteInitial'=>false,
                            'initialPreviewShowDelete'=>true,
                            'initialPreview'=> $initialPreview,
                            'initialPreviewConfig'=> $initialPreviewConfig,
                            'uploadUrl' => Url::to(['/tbl-store/upload-ajax']),
                            'uploadExtraData' => [
                                'ref' => $model->ref,
                            ],
                            'maxFileCount' => 100
                        ]
                    ]);
        ?>
        </div>
    </div>
    </div>
    <div class="form-group">
        <?php //Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary').' btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
