<?php
/* @var $this yii\web\View */
/* @var $user frontend\models\User */
/* @var $currentUser frontend\models\User */
/* @var $modelPicture frontend\modules\user\models\form\PictureForm
 *
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use dosamigos\fileupload\FileUpload;
use yii\web\JqueryAsset;

$this->title = Yii::t('profile', 'Profile') .' | '. Html::encode($user->username);
?>
<section class="main">
    <div class="container">
        <div class="main__wrapper">
            <div class="main__user">
                <div class="main__user_avatar">
                    <div class="user_avatar__container">
                        <img data-img src="<?= $user->getPicture(); ?>">
                    </div>
                </div>
                <div class="main__user_description">
                    <p><a class="user__name" href="#"><?= $user->username ?></a></p>
                    <p class="user__nickname">@<?= $user->nickname;?></p>
                    <p class="user__descr"><?= $user->about; ?></p>
                    <?php if($user->equals($currentUser)):?>
                    <div class="user__settings"><a href="<?= Url::to(['/user/profile/edit', 'nickname' => ($user->nickname) ? $user->nickname : $user->id]); ?> ">
                            <svg class="icon icon-settings user__settings_icon">
                                <use xlink:href="/images/symbol/sprite.svg#settings"></use>
                            </svg></a></div>
                    <?php endif; ?>
                </div>

                <?php if ($currentUser && !$currentUser->equals($user)): ?>
                <div class="main__user_follow">
                    <?php if (!$currentUser->checkSubscription($user)):?>
                        <a class="btn__follow" href="<?= Url::to(['/user/profile/subscribe', 'id' => $user->getId()]); ?>">Follow</a>
                    <?php else:?>
                        <a class="btn__unfollow" href="<?= Url::to(['/user/profile/unsubscribe', 'id' => $user->getId()]); ?>">Unfollow</a>

                    <?php endif; ?>
                </div>

                <?php endif; ?>


                <div class="main__user_info">
                    <div class="user__posts"><span class="count"><?= $user->getPostCount(); ?></span>
                        <p class="info_title"><?php
                            echo  Yii::t('profile',  '{n, plural, =0{Posts} =1{Posts} other{Posts}}',
                                 ['n' => $user->getPostCount()]);
                            ?></p>
                    </div>
                    <div class="user__followers"><span class="count"><?= $user->getFollowersCount('subscriptions'); ?></span>
                        <p><a class="info_title" href="#followers-modal"><?= Yii::t('profile', 'Followers') ?></a></p>
                    </div>
                    <div class="user__following"><span class="count"><?= $user->getSubscriptionsCount(); ?></span>
                        <p><a class="info_title" href="#following-modal"><?= Yii::t('profile', 'Following') ?></a></p>
                    </div>
                </div>
            </div>



            <div class="main__posts">
                <div class="posts_wrapper">
                    <?php
                        $counter = 0;
                        $postCount = $user->getPostCount();
                    ?>
                    <?php foreach($user->getPosts() as $post): ?>
                            <?php if ($counter % 3  === 0):?>
                                <div class="posts__row">
                            <?php endif;?>

                            <div class="post_item">
                                <a href="<?= Url::to('/post/' . $post->id)?> ">
                                    <img data-img src="<?= $post->getImage(); ?>">
                                    <div class="post__item__overlay">
                                        <div class="overlay__content">
                                            <div class="post_comments">
                                                <svg class="icon icon-bubble overlay_icon">
                                                    <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                                                </svg><span> <?= $post->commentsCount()?> </span>
                                            </div>
                                            <div class="post_likes">
                                                <svg class="icon icon-heart overlay_icon">
                                                    <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                                </svg><span> <?= $post->likesCount()?></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php if(($counter % 3 === 2) || ($counter === ($postCount) - 1) ):?>
                                </div>
                            <?php endif; ?>
                        <?php  $counter++;?>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>


<!--modals-->
<div class="modal" id="followers-modal">
    <div class="modal__wrapper">
        <div class="modal__header">
            <p class="modal__header__title">Followers</p><a class="modal__header__close" href="#">
                <div class="close__bar"></div></a>
        </div>
        <div class="modal__body">
            <?php foreach ($user->getFollowers() as $follower): ?>
                <div class="recommended__item">
                    <div class="recommended__item_info">
                        <div class="recommended__item_avatar">
                            <a href="<?= Url::to([
                                '/user/profile/view',
                                'nickname' => $follower->getNickname()
                            ]); ?>">
                                <img src="<?= $follower->getPicture();?> ">
                            </a>
                        </div>
                        <div class="recommended__item_name"><?= $follower->username?>
                            <p class="recommended__item_nickname">@<?= $follower->nickname?> </p>
                        </div>
                        <?php if ($currentUser->checkSubscription($follower)):?>
                        </div><a class="btn-invert recommended__follow" href="<?= Url::to(['/user/profile/unsubscribe', 'id' => $follower->id]); ?>">Unfollow</a>
                        <?php else:?>
                            </div><a class="btn-invert recommended__follow" href="<?= Url::to(['/user/profile/subscribe', 'id' => $follower->id]); ?>">Follow</a>
                        <?php endif;?>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="modal" id="following-modal">
    <div class="modal__wrapper">
        <div class="modal__header">
            <p class="modal__header__title">Following</p><a class="modal__header__close" href="#">
                <div class="close__bar"></div></a>
        </div>
        <div class="modal__body">
            <?php foreach ($user->getSubscriptions() as $subscription): ?>
                <div class="recommended__item">
                    <div class="recommended__item_info">
                        <div class="recommended__item_avatar">
                            <a href="<?= Url::to([
                                '/user/profile/view',
                                'nickname' => $subscription->getNickname()
                            ]); ?>">
                                <img src="<?= $subscription->getPicture();?>  ">
                            </a>
                        </div>
                        <div class="recommended__item_name"><?= $subscription->username ?>
                            <p class="recommended__item_nickname">@<?= $subscription->nickname?></p>
                        </div>
                    </div>
                    <?php if ($currentUser->equals($user)): ?>
                    <a class="btn-invert recommended__follow unfollow" href="<?= Url::to(['/user/profile/unsubscribe', 'id' => $subscription->id]); ?>" >Unfollow</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
