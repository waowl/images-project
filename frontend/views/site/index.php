<?php
/* @var $this yii\web\View */
/* @var $currentUser frontend\models\User */

/* @var $feedItems [] frontend\models\Feed */

use yii\web\JqueryAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\components\widgets\RecommendedWidget;
$this->title = Yii::t('feed', 'News feed');
?>


    <section class="feed">
        <div class="container">
            <div class="alert__wrapper hidden" >
                <div class="alert alert__success">
                    <div class="alert__body">Your complaint was sent!</div>
                </div>
            </div>
            <div class="feed__wrapper">
                <div class="feed__items">
                    <?php if ($feedItems): ?>
                        <?php foreach ($feedItems as $feedItem): ?>
                            <?php /* @var $feedItem Feed */ ?>
                            <div class="feed__item">

                                <div class="feed__item_top"><a href="<?= Url::to([
                                        '/user/profile/view',
                                        'nickname' => ($feedItem->author_nickname) ? $feedItem->author_nickname : $feedItem->author_id
                                    ]); ?>"><img data-img class="feed__item_author_avatar"
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

                                        <a href="#"  class="<?= ($currentUser->likesPost($feedItem->post_id)) ? 'hidden' : ''?> like" data-token="<?= Yii::$app->request->getCsrfToken()?>" data-id="<?=$feedItem->post_id ?> ">
                                            <svg class="icon icon-heart feed__likes_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                            </svg>
                                        </a>
                                        <a href="#"  class="<?= ($currentUser->likesPost($feedItem->post_id)) ? '': 'hidden'?> unlike"  data-token="<?= Yii::$app->request->getCsrfToken()?> " data-id="<?=$feedItem->post_id ?> ">
                                            <svg class="icon icon-heart feed__likes_icon liked">
                                                <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                            </svg>
                                        </a>

                                        <span class="count"><?= $feedItem->likesCount()?> </span>
                                        <svg class="icon icon-bubble feed__comments_icon">
                                            <use xlink:href="images/symbol/sprite.svg#bubble"></use>
                                        </svg>
                                        <span class="comment__count"><?= $feedItem->commentsCount() ?> </span>`
                                    </div>
                                    <div class="bottom__date">
                                        <p><?= Yii::t('feed', 'Posted')?>:<span
                                                    class="date"><?= Yii::$app->formatter->asDatetime($feedItem->post_created_at); ?></span>
                                        </p>
                                    </div>
                                    <?php if (!$feedItem->isReported($currentUser)): ?>
                                        <div class="bottom__complain"><a class="btn-filled button-complain" href="#"
                                                                         data-id="<?= $feedItem->post_id?>">
                                                <?= Yii::t('feed', 'Complain')?> </a>
                                        </div>

                                    <?php else: ?>
                                        <div class="bottom__complain"><p><?= Yii::t('feed', 'Post has been reported.')?></p></div>
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

                <?= RecommendedWidget::widget(); ?>
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