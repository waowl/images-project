<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
?>

<section class="login">
    <div class="login__wrapper">
        <div class="login__logo"><img src="/images/logo.png"></div>
        <div class="login__body">
            <div class="login__form">
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <span>Please choose your new password:</span>
                <?= $form->field($model, 'password', [
                    'inputOptions'=>[
                        'class'=>'form__field email__field',
                        'placeholder'=>'Enter your new password'
                    ]
                ])->textInput(['autofocus' => true])->label(false)  ?>

                <?= Html::submitButton('Send', ['class' => 'btn-filled btn-signup']) ?>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>
