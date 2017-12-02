<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="login">
    <div class="login__wrapper">
        <div class="login__logo"><img src="/images/logo.png"></div>
        <div class="login__body">
            <div class="login__form">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'email',  [
                    'inputOptions'=>[
                        'class'=>'form__field email__field',
                        'placeholder'=>'Enter your email'
                    ]
                ])->textInput()->label(false) ?>

                <?= $form->field($model, 'password',  [
                    'inputOptions'=>[
                        'class'=>'form__field email__field',
                        'placeholder'=>'Enter your password'
                    ]
                ])->passwordInput()->label(false) ?>

                <?= Html::submitButton('Login', ['class' => 'btn-filled btn-signin', 'name' => 'login-button']) ?>
                <span>OR</span><a class="btn-filled btn-fb" href="/user/default/auth?authclient=facebook"><img src="/images/fb_ico.png"><span>Login with Facebook</span></a>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="login__bottom"><?= Html::a('Forgot password?', ['/user/default/request-password-reset'],  ['class'=> "login__bottom_link"]) ?><span>No account? &nbsp;<?= Html::a('Sign Up!', ['/user/default/signup'], ['class'=> "login__bottom_link"]) ?></span></div>
    </div>
</section>