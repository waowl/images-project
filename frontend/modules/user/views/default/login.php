<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('login', 'Login');
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
                        'placeholder'=> Yii::t('login', 'Enter your email')
                    ]
                ])->textInput()->label(false) ?>

                <?= $form->field($model, 'password',  [
                    'inputOptions'=>[
                        'class'=>'form__field email__field',
                        'placeholder'=> Yii::t('login', 'Enter your password')
                    ]
                ])->passwordInput()->label(false) ?>

                <?= Html::submitButton(Yii::t('login', 'Login'), ['class' => 'btn-filled btn-signin', 'name' => 'login-button']) ?>
                <span><?= Yii::t('login', 'OR')?></span><a class="btn-filled btn-fb" href="/user/default/auth?authclient=facebook"><img src="/images/fb_ico.png"><span><?= Yii::t('login', 'Login with Facebook ')?> </span></a>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="login__bottom"><?= Html::a(Yii::t('login', 'Fogot password?'), ['/user/default/request-password-reset'],  ['class'=> "login__bottom_link"]) ?><span><?= Yii::t('login', 'No account?') ?>  &nbsp;<?= Html::a(Yii::t('login', 'Sign up!'), ['/user/default/signup'], ['class'=> "login__bottom_link"]) ?></span></div>
    </div>
</section>