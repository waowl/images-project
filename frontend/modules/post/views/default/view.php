<?php /**
 * @var $post \frontend\models\Post
 * @var $this \yii\web\View
 * @var $currentUser \yii\web\User
 *
 *
 */

use yii\helpers\Html;
?>

<h1>Пост</h1>
<div class="row">
    <div class="col-md-12">
        <img src="<?= $post->getImage()?>">
        <?php if ($post->user):?>
            <p><?= $post->user->username?></p>
        <?php endif;?>
        <p></p>
    </div>
    <div class="col-md-12">
        <h6><?=Html::encode($post->description) ?> </h6>
        <p>
            <a href="" class="btn btn-success button-like" style="display: <?=  ($currentUser && $post->isLikedBy($currentUser)) ? "none" : "" ?>" data-id="<?=$post->id ?>">Like</a>
            <a href="" class="btn btn-danger button-unlike" style="display: <?=  ($currentUser && $post->isLikedBy($currentUser)) ?  "" : "none" ?> " data-id="<?=$post->id ?>">UnLike</a>
        </p>
        <?php ?>
        <p>Понравилось: <span class="likes-count"><?= $post->countLikes()?></span></p>
    </div>
</div>
<?php
    $this->registerJsFile('@web/js/likes.js', [
        'depends' => \yii\web\JqueryAsset::className()
    ])
?>