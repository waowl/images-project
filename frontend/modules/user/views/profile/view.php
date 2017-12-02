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

$this->title = Html::encode($user->username);
?>


<section class="main">
    <div class="container">
        <div class="main__wrapper">
            <div class="main__user">
                <div class="main__user_avatar"><img src="/images/user_avatar.jpg"></div>
                <div class="main__user_description">
                    <p><a class="user__name" href="#">Jane Doe</a></p>
                    <p class="user__nickname">@janedoe</p>
                    <p class="user__descr">Lorem ipsum dolor sit aLorem ipsum dolor sit</p>
                    <div class="user__settings"><a href="user/edit">
                            <svg class="icon icon-settings user__settings_icon">
                                <use xlink:href="/images/symbol/sprite.svg#settings"></use>
                            </svg></a></div>
                </div>
                <div class="main__user_follow"><a class="btn__follow" href="/follow">Follow</a></div>
                <div class="main__user_info">
                    <div class="user__posts"><span class="count">34</span>
                        <p class="info_title">Posts</p>
                    </div>
                    <div class="user__followers"><span class="count">256</span>
                        <p><a class="info_title" href="#followers-modal">Followers</a></p>
                    </div>
                    <div class="user__following"><span class="count">123</span>
                        <p><a class="info_title" href="#following-modal">Following</a></p>
                    </div>
                </div>
            </div>
            <div class="main__posts">
                <div class="posts_wrapper">
                    <div class="posts__row">
                        <div class="post_item"><a href="post"><img src="/images/post1.png">
                                <div class="post__item__overlay">
                                    <div class="overlay__content">
                                        <div class="post_comments">
                                            <svg class="icon icon-bubble overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                                            </svg><span>   44</span>
                                        </div>
                                        <div class="post_likes">
                                            <svg class="icon icon-heart overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                            </svg><span> 31</span>
                                        </div>
                                    </div>
                                </div></a></div>
                        <div class="post_item"><a href="post"><img src="/images/post2.png"></a>
                            <div class="post__item__overlay">
                                <div class="overlay__content">
                                    <div class="post_comments">
                                        <svg class="icon icon-bubble overlay_icon">
                                            <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                                        </svg><span>   44</span>
                                    </div>
                                    <div class="post_likes">
                                        <svg class="icon icon-heart overlay_icon">
                                            <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                        </svg><span> 31</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post_item"><a href="post"><img src="/images/post3.png">
                                <div class="post__item__overlay">
                                    <div class="overlay__content">
                                        <div class="post_comments">
                                            <svg class="icon icon-bubble overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                                            </svg><span>   44</span>
                                        </div>
                                        <div class="post_likes">
                                            <svg class="icon icon-heart overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                            </svg><span> 31</span>
                                        </div>
                                    </div>
                                </div></a></div>
                    </div>
                    <div class="posts__row">
                        <div class="post_item"><a href="post"><img src="/images/post1.png">
                                <div class="post__item__overlay">
                                    <div class="overlay__content">
                                        <div class="post_comments">
                                            <svg class="icon icon-bubble overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                                            </svg><span>   44</span>
                                        </div>
                                        <div class="post_likes">
                                            <svg class="icon icon-heart overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                            </svg><span> 31</span>
                                        </div>
                                    </div>
                                </div></a></div>
                        <div class="post_item"><a href="post"><img src="/images/post2.png"></a>
                            <div class="post__item__overlay">
                                <div class="overlay__content">
                                    <div class="post_comments">
                                        <svg class="icon icon-bubble overlay_icon">
                                            <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                                        </svg><span>   44</span>
                                    </div>
                                    <div class="post_likes">
                                        <svg class="icon icon-heart overlay_icon">
                                            <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                        </svg><span> 31</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post_item"><a href="post"><img src="/images/post3.png">
                                <div class="post__item__overlay">
                                    <div class="overlay__content">
                                        <div class="post_comments">
                                            <svg class="icon icon-bubble overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                                            </svg><span>   44</span>
                                        </div>
                                        <div class="post_likes">
                                            <svg class="icon icon-heart overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                            </svg><span> 31</span>
                                        </div>
                                    </div>
                                </div></a></div>
                    </div>
                    <div class="posts__row">
                        <div class="post_item"><a href="post"><img src="/images/post1.png">
                                <div class="post__item__overlay">
                                    <div class="overlay__content">
                                        <div class="post_comments">
                                            <svg class="icon icon-bubble overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                                            </svg><span>   44</span>
                                        </div>
                                        <div class="post_likes">
                                            <svg class="icon icon-heart overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                            </svg><span> 31</span>
                                        </div>
                                    </div>
                                </div></a></div>
                        <div class="post_item"><a href="post"><img src="/images/post2.png"></a>
                            <div class="post__item__overlay">
                                <div class="overlay__content">
                                    <div class="post_comments">
                                        <svg class="icon icon-bubble overlay_icon">
                                            <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                                        </svg><span>   44</span>
                                    </div>
                                    <div class="post_likes">
                                        <svg class="icon icon-heart overlay_icon">
                                            <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                        </svg><span> 31</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post_item"><a href="post"><img src="/images/post3.png">
                                <div class="post__item__overlay">
                                    <div class="overlay__content">
                                        <div class="post_comments">
                                            <svg class="icon icon-bubble overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                                            </svg><span>   44</span>
                                        </div>
                                        <div class="post_likes">
                                            <svg class="icon icon-heart overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                            </svg><span> 31</span>
                                        </div>
                                    </div>
                                </div></a></div>
                    </div>
                    <div class="posts__row">
                        <div class="post_item"><a href="post"><img src="/images/post1.png">
                                <div class="post__item__overlay">
                                    <div class="overlay__content">
                                        <div class="post_comments">
                                            <svg class="icon icon-bubble overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                                            </svg><span>   44</span>
                                        </div>
                                        <div class="post_likes">
                                            <svg class="icon icon-heart overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                            </svg><span> 31</span>
                                        </div>
                                    </div>
                                </div></a></div>
                        <div class="post_item"><a href="post"><img src="/images/post2.png"></a>
                            <div class="post__item__overlay">
                                <div class="overlay__content">
                                    <div class="post_comments">
                                        <svg class="icon icon-bubble overlay_icon">
                                            <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                                        </svg><span>   44</span>
                                    </div>
                                    <div class="post_likes">
                                        <svg class="icon icon-heart overlay_icon">
                                            <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                        </svg><span> 31</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="post_item"><a href="post"><img src="/images/post3.png">
                                <div class="post__item__overlay">
                                    <div class="overlay__content">
                                        <div class="post_comments">
                                            <svg class="icon icon-bubble overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                                            </svg><span>   44</span>
                                        </div>
                                        <div class="post_likes">
                                            <svg class="icon icon-heart overlay_icon">
                                                <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                                            </svg><span> 31</span>
                                        </div>
                                    </div>
                                </div></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal" id="followers-modal">
    <div class="modal__wrapper">
        <div class="modal__header">
            <p class="modal__header__title">Followers</p><a class="modal__header__close" href="#">
                <div class="close__bar"></div></a>
        </div>
        <div class="modal__body">
            <div class="recommended__item">
                <div class="recommended__item_info">
                    <div class="recommended__item_avatar"><img src="/images/recommended.jpg"></div>
                    <div class="recommended__item_name">Erick Frei
                        <p class="recommended__item_nickname">@supererick</p>
                    </div>
                </div><a class="btn-invert recommended__follow" href="follow">Follow</a>
            </div>
            <div class="recommended__item">
                <div class="recommended__item_info">
                    <div class="recommended__item_avatar"><img src="/images/recommended.jpg"></div>
                    <div class="recommended__item_name">Erick Frei
                        <p class="recommended__item_nickname">@supererick</p>
                    </div>
                </div><a class="btn-invert recommended__follow" href="follow">Follow</a>
            </div>
            <div class="recommended__item">
                <div class="recommended__item_info">
                    <div class="recommended__item_avatar"><img src="/images/recommended.jpg"></div>
                    <div class="recommended__item_name">Erick Frei
                        <p class="recommended__item_nickname">@supererick</p>
                    </div>
                </div><a class="btn-invert recommended__follow" href="follow">Follow</a>
            </div>
            <div class="recommended__item">
                <div class="recommended__item_info">
                    <div class="recommended__item_avatar"><img src="/images/recommended.jpg"></div>
                    <div class="recommended__item_name">Erick Frei
                        <p class="recommended__item_nickname">@supererick</p>
                    </div>
                </div><a class="btn-invert recommended__follow" href="follow">Follow</a>
            </div>
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
            <div class="recommended__item">
                <div class="recommended__item_info">
                    <div class="recommended__item_avatar"><img src="/images/recommended.jpg"></div>
                    <div class="recommended__item_name">Erick Frei
                        <p class="recommended__item_nickname">@supererick</p>
                    </div>
                </div><a class="btn-invert recommended__follow" href="follow">Unfollow</a>
            </div>
            <div class="recommended__item">
                <div class="recommended__item_info">
                    <div class="recommended__item_avatar"><img src="/images/recommended.jpg"></div>
                    <div class="recommended__item_name">Erick Frei
                        <p class="recommended__item_nickname">@supererick</p>
                    </div>
                </div><a class="btn-invert recommended__follow" href="follow">Unfollow</a>
            </div>
            <div class="recommended__item">
                <div class="recommended__item_info">
                    <div class="recommended__item_avatar"><img src="/images/recommended.jpg"></div>
                    <div class="recommended__item_name">Erick Frei
                        <p class="recommended__item_nickname">@supererick</p>
                    </div>
                </div><a class="btn-invert recommended__follow" href="follow">Unfollow</a>
            </div>
            <div class="recommended__item">
                <div class="recommended__item_info">
                    <div class="recommended__item_avatar"><img src="/images/recommended.jpg"></div>
                    <div class="recommended__item_name">Erick Frei
                        <p class="recommended__item_nickname">@supererick</p>
                    </div>
                </div><a class="btn-invert recommended__follow" href="follow">Unfollow</a>
            </div>
        </div>
    </div>
</div>
<div class="page-posts no-padding">
    <div class="row">
        <div class="page page-post col-sm-12 col-xs-12 post-82">


            <div class="blog-posts blog-posts-large">

                <div class="row">

                    <!-- profile -->
                    <article class="profile col-sm-12 col-xs-12">
                        <div class="profile-title">
                            <img src="<?= $user->getPicture(); ?>" id="profile-picture"  class="author-image" />

                            <div class="author-name"><?= Html::encode($user->username); ?></div>

                            <?php if ($currentUser && $currentUser->equals($user)): ?>

                                <?=
                                FileUpload::widget([
                                    'model' => $modelPicture,
                                    'attribute' => 'picture',
                                    'url' => ['/user/profile/upload-picture'], // your url, this is just for demo purposes,
                                    'options' => ['accept' => 'image/*'],
                                    'clientEvents' => [
                                        'fileuploaddone' => 'function(e, data) {
                                            if (data.result.success) {
                                                $("#profile-image-success").removeClass("hidden");
                                                $("#profile-image-fail").addClass("hidden");
                                                $("#profile-picture").attr("src", data.result.pictureUrl);
                                            } else {
                                                $("#profile-image-fail").html(data.result.errors.picture).removeClass("hidden");
                                                $("#profile-image-success").addClass("hidden");
                                            }
                                        }',
                                    ],
                                ]);
                                ?>
                                <a href="#" class="btn btn-default">Edit profile</a>

                            <?php endif; ?>

                            <!--                            <a href="#" class="btn btn-default">Upload profile image</a>-->

                            <br/>
                            <br/>

                            <div class="alert alert-success alert-dismissible hidden" id="profile-image-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Profile image updated</div>
                            <div class="alert alert-danger alert-dismissible  hidden" id="profile-image-fail">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>

                        <?php if ($currentUser && !$currentUser->equals($user)): ?>
                            <?php if (!$currentUser->checkSubscription($user)):?>
                            <a href="<?= Url::to(['/user/profile/subscribe', 'id' => $user->getId()]); ?>" class="btn btn-info">Subscribe</a>
                                <?php else:?>
                                <a href="<?= Url::to(['/user/profile/unsubscribe', 'id' => $user->getId()]); ?>" class="btn btn-info">Unsubscribe</a>
                            <?php endif; ?>
                            <hr>
                            <h5>Friends, who are also following <?= Html::encode($user->username); ?>: </h5>
                            <div class="row">
                                <?php foreach ($currentUser->getMutualSubscriptons($user) as $item): ?>
                                    <div class="col-md-12">
                                        <a href="<?= Url::to(['/user/profile/view', 'nickname' => ($item['nickname']) ? $item['nickname'] : $item['id']]); ?>">
                                            <?= Html::encode($item['username']); ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <hr>
                        <?php endif; ?>

                        <?php if ($user->description): ?>
                            <div class="profile-description">
                                <p><?= HtmlPurifier::process($user->description); ?></p>
                            </div>
                        <?php endif; ?>

                        <div class="profile-bottom">
                            <div class="profile-post-count">
                                <span><?= $user->getPostCount(); ?> posts</span>
                            </div>
                            <div class="profile-followers">
                                <a href="#" data-toggle="modal" data-target="#myModal2"><?= $user->getListCount('followers'); ?> followers</a>
                            </div>
                            <div class="profile-following">
                                <a href="#" data-toggle="modal" data-target="#myModal1"><?= $user->getListCount('subscriptions'); ?> following</a>
                            </div>
                        </div>

                    </article>

                    <div class="col-sm-12 col-xs-12">
                        <div class="row profile-posts">
                            <?php foreach($user->getPosts() as $post): ?>
                                <div class="col-md-4 profile-post">
                                    <a href="<?= Url::to(['/post/default/view', 'id' => $post->getId()]); ?>">
                                        <img src="<?= Yii::$app->storage->getFile($post->filename); ?>" class="author-image" />
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>


                </div>

            </div>
        </div>

    </div>
</div>

<!-- Modal subscriptions -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Subscriptions</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php foreach ($user->getSubscriptions() as $subscription): ?>
                        <div class="col-md-12">
                            <a href="<?= Url::to(['/user/profile/view', 'nickname' => ($subscription['nickname']) ? $subscription['nickname'] : $subscription['id']]); ?>">
                                <?= Html::encode($subscription['username']); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal subscriptions -->

<!-- Modal followers -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Followers</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php foreach ($user->getFollowers() as $follower): ?>
                        <div class="col-md-12">
                            <a href="<?= Url::to(['/user/profile/view', 'nickname' => ($follower['nickname']) ? $follower['nickname'] : $follower['id']]); ?>">
                                <?= Html::encode($follower['username']); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal followers -->
