<?php
/* @var $this yii\web\View */
/* @var $currentUser frontend\models\User */
/* @var $feedItems[] frontend\models\Feed */

use yii\web\JqueryAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

$this->title = 'Newsfeed';
?>
    <section class="feed">
        <div class="container">
            <div class="feed__wrapper">
                <div class="feed__items">
                    <div class="feed__item">
                        <div class="alert__wrapper">
                            <div class="alert alert__success">
                                <div class="alert__body">Your complaint was sent!</div>
                            </div>
                        </div>
                        <div class="feed__item_top"><a href="/profile/"><img class="feed__item_author_avatar" src="/images/user_avatar.jpg"><span class="feed__item_author">janedoe</span></a><a href="/single-post.html">
                                <p class="feed__item_title">This is a beautiful spot</p></a></div>
                        <div class="feed__item_body"><a href="/single-post.html"><img src="images/post.jpg"></a></div>
                        <div class="feed__item_bottom">
                            <div class="bottom__activity">
                                <svg class="icon icon-heart feed__likes_icon">
                                    <use xlink:href="images/symbol/sprite.svg#heart"></use>
                                </svg><span class="likes__count">217</span>
                                <svg class="icon icon-bubble feed__comments_icon">
                                    <use xlink:href="images/symbol/sprite.svg#bubble"></use>
                                </svg><span class="comment__count">34</span>
                            </div>
                            <div class="bottom__date">
                                <p>Posted:<span class="date">2017-02-14 22:04</span></p>
                            </div>
                            <div class="bottom__complain"><a class="btn-filled" href="/complain"> Complain</a></div>
                        </div>
                    </div>
                    <div class="feed__item">
                        <div class="alert__wrapper">
                            <div class="alert alert__success">
                                <div class="alert__body">Your complaint was sent!</div>
                            </div>
                        </div>
                        <div class="feed__item_top"><a href="/author"><img class="feed__item_author_avatar" src="images/user_avatar.jpg"><span class="feed__item_author">janedoe</span></a><a href="/single-post.html">
                                <p class="feed__item_title">This is a beautiful spot</p></a></div>
                        <div class="feed__item_body"><a href="/single-post.html"><img src="images/post.jpg"></a></div>
                        <div class="feed__item_bottom">
                            <div class="bottom__activity">
                                <svg class="icon icon-heart feed__likes_icon">
                                    <use xlink:href="images/symbol/sprite.svg#heart"></use>
                                </svg><span class="likes__count">217</span>
                                <svg class="icon icon-bubble feed__comments_icon">
                                    <use xlink:href="images/symbol/sprite.svg#bubble"></use>
                                </svg><span class="comment__count">34</span>
                            </div>
                            <div class="bottom__date">
                                <p>Posted:<span class="date">2017-02-14 22:04</span></p>
                            </div>
                            <div class="bottom__complain"><a class="btn-filled" href="/complain"> Complain</a></div>
                        </div>
                    </div>
                    <div class="feed__item">
                        <div class="alert__wrapper">
                            <div class="alert alert__success">
                                <div class="alert__body">Your complaint was sent!</div>
                            </div>
                        </div>
                        <div class="feed__item_top"><a href="/author"><img class="feed__item_author_avatar" src="images/user_avatar.jpg"><span class="feed__item_author">janedoe</span></a><a href="/single-post.html">
                                <p class="feed__item_title">This is a beautiful spot</p></a></div>
                        <div class="feed__item_body"><a href="/single-post.html"><img src="images/post.jpg"></a></div>
                        <div class="feed__item_bottom">
                            <div class="bottom__activity">
                                <svg class="icon icon-heart feed__likes_icon">
                                    <use xlink:href="images/symbol/sprite.svg#heart"></use>
                                </svg><span class="likes__count">217</span>
                                <svg class="icon icon-bubble feed__comments_icon">
                                    <use xlink:href="images/symbol/sprite.svg#bubble"></use>
                                </svg><span class="comment__count">34</span>
                            </div>
                            <div class="bottom__date">
                                <p>Posted:<span class="date">2017-02-14 22:04</span></p>
                            </div>
                            <div class="bottom__complain"><a class="btn-filled" href="/complain"> Complain</a></div>
                        </div>
                    </div>
                    <div class="feed__item">
                        <div class="alert__wrapper">
                            <div class="alert alert__success">
                                <div class="alert__body">Your complaint was sent!</div>
                            </div>
                        </div>
                        <div class="feed__item_top"><a href="/author"><img class="feed__item_author_avatar" src="images/user_avatar.jpg"><span class="feed__item_author">janedoe</span></a><a href="/single-post.html">
                                <p class="feed__item_title">This is a beautiful spot</p></a></div>
                        <div class="feed__item_body"><a href="/single-post.html"><img src="images/post.jpg"></a></div>
                        <div class="feed__item_bottom">
                            <div class="bottom__activity">
                                <svg class="icon icon-heart feed__likes_icon">
                                    <use xlink:href="images/symbol/sprite.svg#heart"></use>
                                </svg><span class="likes__count">217</span>
                                <svg class="icon icon-bubble feed__comments_icon">
                                    <use xlink:href="images/symbol/sprite.svg#bubble"></use>
                                </svg><span class="comment__count">34</span>
                            </div>
                            <div class="bottom__date">
                                <p>Posted:<span class="date">2017-02-14 22:04</span></p>
                            </div>
                            <div class="bottom__complain"><a class="btn-filled" href="/complain"> Complain</a></div>
                        </div>
                    </div>
                </div>
                <section class="recommended">
                    <div class="recommended__header">
                        <p class="recommended__title">Recommended</p>
                    </div>
                    <div class="recommended__item">
                        <div class="recommended__item_info">
                            <div class="recommended__item_avatar"><img src="images/recommended.jpg"></div><a class="recommended__item_name" href="user/">Erick Frei
                                <p class="recommended__item_nickname">@supererick</p></a>
                        </div><a class="btn-invert recommended__follow" href="follow">Follow</a>
                    </div>
                    <div class="recommended__item">
                        <div class="recommended__item_info">
                            <div class="recommended__item_avatar"><img src="images/recommended.jpg"></div><a class="recommended__item_name" href="user/">Erick Frei
                                <p class="recommended__item_nickname">@supererick</p></a>
                        </div><a class="btn-invert recommended__follow" href="follow">Follow</a>
                    </div>
                    <div class="recommended__item">
                        <div class="recommended__item_info">
                            <div class="recommended__item_avatar"><img src="images/recommended.jpg"></div><a class="recommended__item_name" href="user/">Erick Frei
                                <p class="recommended__item_nickname">@supererick</p></a>
                        </div><a class="btn-invert recommended__follow" href="follow">Follow</a>
                    </div>
                    <div class="recommended__item">
                        <div class="recommended__item_info">
                            <div class="recommended__item_avatar"><img src="images/recommended.jpg"></div><a class="recommended__item_name" href="user/">Erick Frei
                                <p class="recommended__item_nickname">@supererick</p></a>
                        </div><a class="btn-invert recommended__follow" href="follow">Follow</a>
                    </div>
                </section>
            </div>
        </div>
    </section>


<?php
$this->registerJsFile('@web/js/likes.js', [
    'depends' => JqueryAsset::className(),
]);

$this->registerJsFile('@web/js/complaints.js', [
    'depends' => JqueryAsset::className(),
]);