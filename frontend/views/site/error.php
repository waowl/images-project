<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = Yii::t('error', 'Page not found');
?>


    <section class="notfound">
        <div class="container">
            <div class="notfound__wrapper">
                <div class="notfound__left">
                    <h1 class="notfound__header"><?=   Yii::t('error', 'Page not found')?> </h1>
                    <p><?= Yii::t('error', 'Something went wrong.')?> <a class="back__link" href="/"><?= Yii::t('error', 'Go back')?> ?</a></p>
                    <div class="sign">404</div>
                </div>
                <div class="notfound__right"><img src="/images/404.png"></div>
            </div>
        </div>
    </section>