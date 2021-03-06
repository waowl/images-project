<?php /**
 * @var $post \frontend\models\Post
 * @var $this \yii\web\View
 * @var $currentUser \yii\web\User
 * @var $commentForm \frontend\modules\post\models\forms\CommentForm
 * @var $comments \frontend\models\Comment
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<section class="single">
    <div class="container">
        <div class="single__wrapper">
            <div class="single__content">
                <div class="single__picture"><img src="<?= $post->getImage() ?>"></div>
                <div class="single__comment_form">
                    <?php $form = \yii\widgets\ActiveForm::begin(['action' => ['/post/default/comment/', 'id' => $post->getId()], 'options' => [
                        'id' => 'comment_form'
                    ]]) ?>
                    <?= $form->field($commentForm, 'comment',  [
                        'inputOptions'=>[
                            'class'=>'leave__comment',
                            'placeholder'=>'Leave your comment here ...'
                        ]
                    ])->textInput()->label(false); ?>
                    <?= Html::submitButton('',['class' => 'send__comment']) ?>
                    <?php \yii\widgets\ActiveForm::end() ?>
                </div>
            </div>
            <div class="single__info">
                <?php if ($currentUser->getId() === $post->user_id):?>
                    <div class="single__delete">
                        <a href="<?= Url::to('/post/delete/' . $post->id)?>" class="btn-filled btn-delete">Delete post</a>
                    </div>
                <?php endif;?>
                <div class="single__info__author"><img class="author_avatar" src="<?= $post->user->getPicture() ?>"><span class="author__nickname"><?=  Html::encode($post->user->nickname ? $post->user->nickname : $post->user->username) ?> </span></div>
                <p class="single__info__title"><?= Html::encode($post->description)?></p>
                <div class="single__info__actvity">
                    <a href="#"  class="<?= ($currentUser->likesPost($post->id)) ? 'hidden' : ''?> like"  data-id="<?=$post->id ?> ">
                        <svg class="icon icon-heart feed__likes_icon">
                            <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                        </svg>
                    </a>
                    <a href="#"  class="<?= ($currentUser->likesPost($post->id)) ? '': 'hidden'?> unlike"  data-id="<?=$post->id ?> ">
                        <svg class="icon icon-heart feed__likes_icon liked">
                            <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                        </svg>
                    </a>

                   <span class="count"><?= $post->likesCount()?> </span>
                    <svg class="icon icon-bubble feed__comments_icon">
                        <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                    </svg><span><?= $post->commentsCount()?> </span>
                </div>
                <div class="single__info__comments">

                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $comment): ?>
                            <div class="single__info__comment">
                                <div class="comment__author">
                                    <?=Html::encode($comment->user->username) ?>
                                </div>

                                <p class="comment__body"><?= Html::encode($comment->comment) ?></p>


                                <?php if ($currentUser->equals($comment->user) ||  ($currentUser->getId() === $post->user_id)):?>
                                        <div class="comment__actions">
                                            <a href="<?= Url::to('/comment/delete/'. $comment->id )?> " class="comment__action action__delete">Удалить</a>
                                            <a href="" data-id = "<?= $comment->id  ?> "class="comment__action action__edit">Изменить</a>
                                        </div>
                                    <?php endif;?>
                            </div>
                    <?php endforeach;?>
                        <?php else:?>
                        <div class="single__info__comment no__comments">
                            <p class="comment__body ">There is no  any comments yet</p>
                        </div>
                    <?php endif;?>

                </div>
            </div>
        </div>
    </div>
</section>

<?php
$this->registerJsFile('@web/js/likes.js', [
    'depends' => \yii\web\JqueryAsset::className()
]);
$this->registerJsFile('@web/js/comments.js', [
    'depends' => \yii\web\JqueryAsset::className()
])
?>
