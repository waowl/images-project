<?php /**
 * @var $post \frontend\models\Post
 * @var $this \yii\web\View
 * @var $currentUser \yii\web\User
 * @var $commentForm \frontend\modules\post\models\forms\CommentForm
 * @var $comments \frontend\models\Comment
 */

use yii\helpers\Html;

?>
<div class="page-posts no-padding">
    <div class="row">
        <div class="page page-post col-sm-12 col-xs-12 post-82">


            <div class="blog-posts blog-posts-large">

                <div class="row">

                    <!-- feed item -->
                    <article class="post col-sm-12 col-xs-12">
                        <div class="post-meta">
                            <div class="post-title">
                                <img src="<?= $post->user->getPicture() ?>" class="author-image" />
                                <div class="author-name"><a href="#"><?= $post->user->username ?></a></div>
                            </div>
                        </div>
                        <div class="post-type-image">
                            <a href="#">
                                <img src="<?= $post->getImage() ?>" alt="">
                            </a>
                        </div>
                        <div class="post-description">
                            <p><?= Html::encode($post->description) ?></p>
                        </div>
                        <div class="post-bottom">
                            <div class="post-likes ">
                                <i class="fa like <?= ($currentUser->likesPost($post->id)) ? 'red-heart fa-heart': 'fa-heart-o'?>  fa-lg "></i>
                                <span class="likes-count"><?= $post->countLikes(); ?></span>
                                &nbsp;&nbsp;&nbsp;
                                <a href="#" class="btn btn-default button-unlike <?= ($currentUser->likesPost($post->id)) ? "" : "display-none"; ?>" data-id="<?= $post->id; ?>">
                                    Unlike&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-down"></span>
                                </a>
                                <a href="#" class="btn btn-default button-like <?= ($currentUser->likesPost($post->id)) ? "display-none" : ""; ?>" data-id="<?= $post->id; ?>">
                                    Like&nbsp;&nbsp;<span class="glyphicon glyphicon-thumbs-up"></span>
                                </a>
                            </div>
                            <div class="post-comments">
                                <a href="#"><?= $post->commentsCount()?>  comments</a>

                            </div>
                            <div class="post-date">
                                <span><?= Yii::$app->formatter->asDate($post->created_at)?></span>
                            </div>
                            <div class="post-report">
                                <a href="#">Report post</a>
                            </div>
                        </div>
                    </article>
                    <!-- feed item -->


                    <?php if (!empty($comments)): ?>
                    <div class="col-sm-12 col-xs-12">
                        <h4><?= $post->commentsCount()?> comments</h4>
                        <div class="comments-post">

                            <div class="single-item-title"></div>
                            <div class="row">
                                <ul class="comment-list">
                        <?php foreach ($comments as $comment): ?>
                                    <!-- comment item -->
                                    <li class="comment" data-id="<?=$comment->id?>">
                                        <div class="comment-user-image">
                                            <img src="<?= $comment->user->getPicture()?>">
                                        </div>
                                        <div class="comment-info">
                                            <h4 class="author"><a href="#"><?=Html::encode($comment->user->username) ?></a> <span><?= Yii::$app->formatter->asDate($comment->updated_at)?> </span></h4>
                                            <p class="comment-body"> <?= Html::encode($comment->comment) ?></pclasscomment-body></p>
                                        <?php if ($comment->user_id === $currentUser->id):?>
                                            <a href="/comment/delete/<?= $comment->id?>"  class="btn btn-danger">Удалить</a>
                                            <button class="edit btn btn-default">Редактировать</button>
                                        <?php endif;?>
                                        </div>
                                        <hr>
                                    </li>
                        <?php endforeach; ?>

                                </ul>
                            </div>

                        </div>
                        <!-- comments-post -->
                    </div>
                    <?php endif; ?>

                    <div class="col-sm-12 col-xs-12">
                        <div class="comment-respond">
                            <h4>Leave a Reply</h4>
                            <?php $form = \yii\widgets\ActiveForm::begin(['action' => ['/post/default/comment/', 'id' => $post->getId()]]) ?>
                            <?= $form->field($commentForm, 'comment')->textarea(['rows' => '6'])->label('Комментарий') ?>
                            <?= Html::submitButton('Отправить') ?>
                            <?php \yii\widgets\ActiveForm::end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div style="display: none">
    <div class="edit-form">
        <form  method="post" action="/comment/edit/">
            <textarea  name="comment" value=""  class="form-control" rows="5"></textarea>
            <?= Html :: hiddenInput(Yii::$app->getRequest()->csrfParam, Yii::$app->getRequest()->getCsrfToken(), []);
            ?>
            <button type="submit" class="btn btn-success">Подтвердить</button>
        </form>
    </div>
</div>
<br><br><br>
</div>


<?php
$this->registerJsFile('@web/js/likes.js', [
    'depends' => \yii\web\JqueryAsset::className()
]);
$this->registerJsFile('@web/js/comments.js', [
    'depends' => \yii\web\JqueryAsset::className()
])
?>
