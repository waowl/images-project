<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('signup', 'Sign Up');
?>
<section class="login">
    <div class="login__wrapper">
        <div class="login__logo"><img src="/images/logo.png"></div>
        <div class="login__body">
            <div class="login__form">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username',  [
                    'inputOptions'=>[
                        'class'=>'form__field email__field',
                        'placeholder'=>Yii::t('signup', 'Enter your username')
                    ]
                ])->textInput(['autofocus' => true])->label(false)  ?>

                <?= $form->field($model, 'email',  [
                    'inputOptions'=>[
                        'class'=>'form__field email__field',
                        'placeholder'=> Yii::t('signup', 'Enter your email')
                    ]
                ])->label(false)  ?>

                <?= $form->field($model, 'password',  [
                    'inputOptions'=>[
                        'class'=>'form__field password__field',
                        'placeholder'=>Yii::t('signup', 'Enter your password')
                    ]
                ])->passwordInput()->label(false)  ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('signup', 'Sign Up'), ['class' => 'btn-filled btn-signup', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>

