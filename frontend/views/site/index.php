<?php
/* @var $this yii\web\View */
/* @var $currentUser frontend\models\User */

/* @var $feedItems [] frontend\models\Feed */

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
                    <?php if ($feedItems): ?>
                        <?php foreach ($feedItems as $feedItem): ?>
                            <?php /* @var $feedItem Feed */ ?>
                            <div class="feed__item">
                                <div class="alert__wrapper">
                                    <div class="alert alert__success">
                                        <div class="alert__body">Your complaint was sent!</div>
                                    </div>
                                </div>
                                <div class="feed__item_top"><a href="<?= Url::to([
                                        '/user/profile/view',
                                        'nickname' => ($feedItem->author_nickname) ? $feedItem->author_nickname : $feedItem->author_id
                                    ]); ?>"><img class="feed__item_author_avatar"
                                                 src="<?= $feedItem->author_picture; ?>"><span
                                                class="feed__item_author"><?= Html::encode($feedItem->author_name); ?> </span></a><a
                                            href="<?= Url::to(['/post/default/view', 'id' => $feedItem->post_id]); ?> ">
                                        <p class="feed__item_title"><?= Html::encode($feedItem->post_description) ?> </p>
                                    </a></div>
                                <div class="feed__item_body"><a href="<?= Url::to([
                                        '/post/default/view',
                                        'id' => $feedItem->post_id
                                    ]); ?>"><img
                                                src="<?= Yii::$app->storage->getFile($feedItem->post_filename); ?>"></a>
                                </div>
                                <div class="feed__item_bottom">
                                    <div class="bottom__activity">
                                        <svg class="icon icon-heart feed__likes_icon">
                                            <use xlink:href="images/symbol/sprite.svg#heart"></use>
                                        </svg>
                                        <span class="likes__count"><?= $feedItem->likesCount(); ?></span>
                                        <svg class="icon icon-bubble feed__comments_icon">
                                            <use xlink:href="images/symbol/sprite.svg#bubble"></use>
                                        </svg>
                                        <span class="comment__count"><?= $feedItem->commentsCount() ?> </span>
                                    </div>
                                    <div class="bottom__date">
                                        <p>Posted:<span
                                                    class="date"><?= Yii::$app->formatter->asDatetime($feedItem->post_created_at); ?></span>
                                        </p>
                                    </div>
                                    <?php if (!$feedItem->isReported($currentUser)): ?>
                                        <div class="bottom__complain"><a class="btn-filled" href="#"
                                                                         data-id="<?= $feedItem->post_id ?>">
                                                Complain</a></div>
                                    <?php else: ?>
                                        <div class="bottom__complain">Post has been reported.</div>
                                        Post has been reported.
                                    <?php endif; ?>

                                </div>
                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>
                        <div class="col-md-12">
                            Nobody posted yet!
                        </div>
                    <?php endif; ?>
                </div>
                <section class="recommended">
                    <div class="recommended__header">
                        <p class="recommended__title">Recommended</p>
                    </div>
                    <div class="recommended__item">
                        <div class="recommended__item_info">
                            <div class="recommended__item_avatar"><img src="images/recommended.jpg"></div>
                            <a class="recommended__item_name" href="user/">Erick Frei
                                <p class="recommended__item_nickname">@supererick</p></a>
                        </div>
                        <a class="btn-invert recommended__follow" href="follow">Follow</a>
                    </div>
                    <div class="recommended__item">
                        <div class="recommended__item_info">
                            <div class="recommended__item_avatar"><img src="images/recommended.jpg"></div>
                            <a class="recommended__item_name" href="user/">Erick Frei
                                <p class="recommended__item_nickname">@supererick</p></a>
                        </div>
                        <a class="btn-invert recommended__follow" href="follow">Follow</a>
                    </div>
                    <div class="recommended__item">
                        <div class="recommended__item_info">
                            <div class="recommended__item_avatar"><img src="images/recommended.jpg"></div>
                            <a class="recommended__item_name" href="user/">Erick Frei
                                <p class="recommended__item_nickname">@supererick</p></a>
                        </div>
                        <a class="btn-invert recommended__follow" href="follow">Follow</a>
                    </div>
                    <div class="recommended__item">
                        <div class="recommended__item_info">
                            <div class="recommended__item_avatar"><img src="images/recommended.jpg"></div>
                            <a class="recommended__item_name" href="user/">Erick Frei
                                <p class="recommended__item_nickname">@supererick</p></a>
                        </div>
                        <a class="btn-invert recommended__follow" href="follow">Follow</a>
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