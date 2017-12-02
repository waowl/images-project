<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>


    <section class="notfound">
        <div class="container">
            <div class="notfound__wrapper">
                <div class="notfound__left">
                    <h1 class="notfound__header">Page not Found</h1>
                    <p>Something went wrong.<a class="back__link" href="/">Go back?</a></p>
                    <div class="sign">404</div>
                </div>
                <div class="notfound__right"><img src="/images/404.png"></div>
            </div>
        </div>
    </section>