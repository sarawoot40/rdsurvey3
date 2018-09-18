<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var amnah\yii2\user\models\forms\LoginForm $model
 */
$this->title = Yii::t('user', 'Login');
?>
<div class="login-page">
    <div class="form">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'login-form'],
        ]); ?>

            <?= $form->field($model, 'email')->textInput(['style' => 'height:50px','placeholder' => 'username'])->label(false); ?>
            <?= $form->field($model, 'password')->passwordInput(['style' => 'height:50px','placeholder'=>'password'])->label(false); ?>
            <?= Html::submitButton(Yii::t('user', 'Login')) ?>
            <p class="message">Not registered? contact mapmaung</p>
        <?php ActiveForm::end(); ?>

        <?php if (Yii::$app->get("authClientCollection", false)): ?>
            <div class="col-lg-offset-2 col-lg-10">
                <?= yii\authclient\widgets\AuthChoice::widget([
                    'baseAuthUrl' => ['/user/auth/login']
                ]) ?>
            </div>
        <?php endif; ?>
        </div>
</div>
