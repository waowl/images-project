<?php /**
 * @var $post \frontend\models\Post
 * @var $this \yii\web\View
 * @var $currentUser \yii\web\User
 * @var $commentForm \frontend\modules\post\models\forms\CommentForm
 * @var $comments \frontend\models\Comment
 */

use yii\helpers\Html;

?>

    <h1>Пост</h1>
    <div class="row">
        <div class="col-md-12">
            <img src="<?= $post->getImage() ?>">
            <?php if ($post->user): ?>
                <p><?= $post->user->username ?></p>
            <?php endif; ?>
            <p></p>
        </div>
        <div class="col-md-12">
            <h6><?= Html::encode($post->description) ?> </h6>
            <p>
                <a href="" class="btn btn-success button-like"
                   style="display: <?= ($currentUser && $post->isLikedBy($currentUser)) ? "none" : "" ?>"
                   data-id="<?= $post->id ?>">Like</a>
                <a href="" class="btn btn-danger button-unlike"
                   style="display: <?= ($currentUser && $post->isLikedBy($currentUser)) ? "" : "none" ?> "
                   data-id="<?= $post->id ?>">UnLike</a>
            </p>
            <?php ?>
            <p>Понравилось: <span class="likes-count"><?= $post->countLikes() ?></span></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h6>Комментарии</h6>
            <?php $form = \yii\widgets\ActiveForm::begin(['action' => ['/post/default/comment/', 'id' => $post->id]]) ?>
            <?= $form->field($commentForm, 'comment')->textarea()->label('Комментарий') ?>
            <?= Html::submitButton('Отправить') ?>
            <?php \yii\widgets\ActiveForm::end() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($comments)): ?>
                <h6>Комментарии</h6>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment" data-id="<?=$comment->id?>">
                        <strong><?=Html::encode($comment->user->nickname) ?>:</strong>
                        <p class="comment-body"> <?= Html::encode($comment->comment) ?></p>
                        <p><?= date('Y-i-d H:m:s', $comment->updated_at);?> </p>
                        <?php if ($comment->user_id === $currentUser->id):?>
                        <a href="/comment/delete/<?= $comment->id?>"  class="btn btn-danger">Удалить</a>
                        <button class="edit" class="btn btn-primary">Редактировать</button>
                        <?php endif;?>
                        <hr>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
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
<?php
$this->registerJsFile('@web/js/likes.js', [
    'depends' => \yii\web\JqueryAsset::className()
]);
$this->registerJsFile('@web/js/comments.js', [
    'depends' => \yii\web\JqueryAsset::className()
])
?>