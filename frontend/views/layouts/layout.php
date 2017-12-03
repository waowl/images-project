<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/images/favicon.ico">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body>
<div class="wrapper">
    <section class="menu">
        <div class="container">
            <div class="menu__items">
                <?php if (!Yii::$app->user->isGuest):?>

                <div class="menu__item"><a class="menu__item_link" href="/">
                        <svg class="icon icon-news menu__item_icon">
                            <use xlink:href="/images/symbol/sprite.svg#news"></use>
                        </svg></a><a class="menu__item_link" href="<?= Url::to(['/user/profile/view', 'nickname' => Yii::$app->user->identity->getNickname() ? Yii::$app->user->identity->getNickname() : Yii::$app->user->identity->getName()]); ?>">
                        <svg class="icon icon-user menu__item_icon">
                            <use xlink:href="/images/symbol/sprite.svg#user"></use>
                        </svg></a><a class="menu__item_link" href="/post/create">
                        <svg class="icon icon-pen menu__item_icon">
                            <use xlink:href="/images/symbol/sprite.svg#pen"></use>
                        </svg></a>
                </div>
                    <?php else:?>
                    <div class="menu__item"><a class="menu__item_link" href="/user/default/login">
                            <svg class="icon icon-news menu__item_icon">
                                <use xlink:href="/images/symbol/sprite.svg#news"></use>
                            </svg></a><a class="menu__item_link" href="/user/default/login">
                            <svg class="icon icon-user menu__item_icon">
                                <use xlink:href="/images/symbol/sprite.svg#user"></use>
                            </svg></a><a class="menu__item_link" href="/user/default/login">
                            <svg class="icon icon-pen menu__item_icon">
                                <use xlink:href="/images/symbol/sprite.svg#pen"></use>
                            </svg></a>
                    </div>
                <?php endif;?>
                <div class="menu__item"><a href="/"><img class="menu__logo" src="/images/logo.png" alt="logo"></a></div>
                <div class="menu__item"><a class="menu__item_link" href="#search__form">
                        <svg class="icon icon-search menu__item_icon">
                            <use xlink:href="/images/symbol/sprite.svg#search"></use>
                        </svg></a>
                    <div class="search__form" id="search__form">
                        <form method="post" action="/search">
                            <input class="search__field" type="text">
                            <input class="search__btn" type="submit">
                        </form>
                    </div>
                    <a class="menu__item_link menu__item_lang" href="/lang">RU</a>
                    <?php if (!Yii::$app->user->isGuest):?>
                        <span class="menu__item_link menu__item_logout">
                             <?= Html::beginForm(['/user/default/logout'], 'post'); ?>
                             <?= Html::submitButton(
                                 '<svg class="icon icon-lock menu__item_icon">
                            <use xlink:href="/images/symbol/sprite.svg#lock"></use>
                        </svg> <span class="menu__item_username">'.Yii::$app->user->identity->getNickname().'</span>'
                            ,['class'=>'btn__logout'] ) ?>
                             <?= Html::endForm()?>
                        </span>
                   <!-- <a class="menu__item_link menu__item_logout" href="/logout">
                        <svg class="icon icon-lock menu__item_icon">
                            <use xlink:href="/images/symbol/sprite.svg#lock"></use>
                        </svg><span class="menu__item_username"><?/*= Yii::$app->user->identity->getNickname(); */?> </span></a>-->
                    <?php endif;?>

                </div>
            </div>
        </div>
    </section>
    <?= $content ?>
    <section class="footer">
        <div class="footer__title"><span>/images &copy; 2017</span></div>
    </section>
    <div class="overlay">
        <div class="preloader">
            <div class="loader"></div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

