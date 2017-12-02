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


    <div class="page-posts no-padding">
        <div class="row">
            <div class="page page-post col-sm-12 col-xs-12">
                <div class="blog-posts blog-posts-large">

                    <div class="row">

                        <?php if ($feedItems): ?>
                            <?php foreach ($feedItems as $feedItem): ?>
                                <?php /* @var $feedItem Feed */ ?>


                                <!-- feed item -->
                                <article class="post col-sm-12 col-xs-12">
                                    <div class="post-meta">
                                        <div class="post-title">
                                            <img src="<?= $feedItem->author_picture; ?>" class="author-image" />
                                            <div class="author-name">
                                                <a href="<?= Url::to(['/user/profile/view', 'nickname' => ($feedItem->author_nickname) ? $feedItem->author_nickname : $feedItem->author_id]); ?>">
                                                    <?= Html::encode($feedItem->author_name); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-type-image">
                                        <a href="<?= Url::to(['/post/default/view', 'id' => $feedItem->post_id]); ?>">
                                            <img src="<?= Yii::$app->storage->getFile($feedItem->post_filename); ?>" alt="" />
                                        </a>
                                    </div>
                                    <div class="post-description">
                                        <p><?= HtmlPurifier::process($feedItem->post_description); ?></p>
                                    </div>
                                    <div class="post-bottom">
                                        <div class="post-likes ">
                                            <i class="fa like <?= ($currentUser->likesPost($feedItem->post_id)) ? 'red-heart fa-heart': 'fa-heart-o'?>  fa-lg "></i>
                                            <span class="likes-count"><?= $feedItem->countLikes(); ?></span>
                                            &nbsp;&nbsp;&nbsp;
                                            <a href="#" class="btn btn-default button-unlike <?= ($currentUser->likesPost($feedItem->post_id)) ? "" : "display-none"; ?>" data-id="<?= $feedItem->post_id; ?>">
                                                Unlike&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-down"></span>
                                            </a>
                                            <a href="#" class="btn btn-default button-like <?= ($currentUser->likesPost($feedItem->post_id)) ? "display-none" : ""; ?>" data-id="<?= $feedItem->post_id; ?>">
                                                Like&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>
                                            </a>
                                        </div>
                                        <div class="post-comments">
                                            <a href="#">0 Comments</a>
                                        </div>
                                        <div class="post-date">
                                            <span><?= Yii::$app->formatter->asDatetime($feedItem->post_created_at); ?></span>
                                        </div>
                                        <?php if(!$feedItem->isReported($currentUser)):?>
                                            <div class="post-report">
                                                <a href="#" class="btn btn-default button-complain"
                                                   data-id="<?=  $feedItem->post_id?>">
                                                    Report post <i class="fa fa-cog fa-spin fa-fw icon-preloader" style="display: none"></i>
                                                </a>
                                            </div>
                                        <?php else:?>
                                            Post has been reported.
                                        <?php endif;?>
                                    </div>
                                </article>
                                <!-- feed item -->

                            <?php endforeach; ?>

                        <?php else: ?>
                            <div class="col-md-12">
                                Nobody posted yet!
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>



<?php
$this->registerJsFile('@web/js/likes.js', [
    'depends' => JqueryAsset::className(),
]);

$this->registerJsFile('@web/js/complaints.js', [
    'depends' => JqueryAsset::className(),
]);?>
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
                        <div class="feed__item_top"><a href="<?= Url::to(['/user/profile/view', 'nickname' => ($feedItem->author_nickname) ? $feedItem->author_nickname : $feedItem->author_id]); ?>"><img class="feed__item_author_avatar" src="/images/user_avatar.jpg"><span class="feed__item_author">janedoe</span></a><a href="/single-post.html">
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