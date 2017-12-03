<?php /**
 * @var $post \frontend\models\Post
 * @var $this \yii\web\View
 * @var $currentUser \yii\web\User
 * @var $commentForm \frontend\modules\post\models\forms\CommentForm
 * @var $comments \frontend\models\Comment
 */

use yii\helpers\Html;

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
                <div class="single__info__author"><img class="author_avatar" src="<?= $post->user->getPicture() ?>"><span class="author__nickname"><?=  Html::encode($post->user->nickname ? $post->user->nickname : $post->user->username) ?> </span></div>
                <p class="single__info__title"><?= Html::encode($post->description)?></p>
                <div class="single__info__actvity">
                    <svg class="icon icon-heart feed__likes_icon">
                        <use xlink:href="/images/symbol/sprite.svg#heart"></use>
                    </svg><span><?= $post->likesCount()?> </span>
                    <svg class="icon icon-bubble feed__comments_icon">
                        <use xlink:href="/images/symbol/sprite.svg#bubble"></use>
                    </svg><span><?= $post->commentsCount()?> </span>
                </div>
                <div class="single__info__comments">

                    <?php if (!empty($comments)): ?>
                        <?php foreach ($comments as $comment): ?>
                            <div class="single__info__comment">
                                <p class="comment__author"><?=Html::encode($comment->user->username) ?></p>
                                <p class="comment__body"><?= Html::encode($comment->comment) ?></p>
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
