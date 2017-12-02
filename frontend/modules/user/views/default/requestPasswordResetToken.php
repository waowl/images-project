<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="login">
    <div class="login__wrapper">
        <div class="login__logo"><img src="/images/logo.png"></div>
        <div class="login__body">
            <div class="login__form">
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <span>Please fill out your email. A link to reset password will be sent there.</span>
                <?= $form->field($model, 'email', [
                'inputOptions'=>[
                    'class'=>'form__field email__field',
                    'placeholder'=>'Enter your email'
                ]
                ])->textInput(['autofocus' => true])->label(false)  ?>

                <?= Html::submitButton('Send', ['class' => 'btn-filled btn-signup']) ?>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</section>