<?php
/**
 * @var $user \frontend\models\User
 * @var $currentUser \frontend\models\User
 * @var $picture \frontend\modules\user\models\form\PictureForm
 */

use yii\helpers\Html;
use yii\helpers\HTMLPurifier;
use yii\helpers\Url;
use dosamigos\fileupload\FileUpload;

?>

<div>
    <h4>Привет, <?= Html::encode($user->username) ?></h4>
    <p><?= HTMLPurifier::process($user->about) ?></p>
    <hr>
    <div>
        <img class="avatar" style="width: 150px; height: auto; border-radius: 50%" src="<?= $user->getPicture() ?>" alt="">
    </div>
    <div class="alert alert-success alert-dismissable hidden" id="avatar-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Фото обновлено</div>
    <div class="alert alert-danger alert-dismissable hidden" id="avatar-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>
    <?php if ($currentUser->getId() === $user->getId()): ?>
    <?= FileUpload::widget([
        'model' => $picture,
        'attribute' => 'picture',
        'url' => ['/user/profile/upload-picture'], // your url, this is just for demo purposes,
        'options' => ['accept' => 'image/*'],
        'clientOptions' => [
            'maxFileSize' => 2000000
        ],
        // Also, you can specify jQuery-File-Upload events
        // see: https://github.com/blueimp/jQuery-File-Upload/wiki/Options#processing-callback-options
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
            console.log(data.result.success)
                               if (data.result.success) {
                                    $("#avatar-danger").addClass("hidden")
                                    $("#avatar-success").removeClass("hidden");
                                    $(".avatar").attr("src", data.result.picture)
                               }else {
                                    $("#avatar-success").addClass("hidden");
                                     $("#avatar-danger").html( data.result.errors.picture)
                                    $("#avatar-danger").removeClass("hidden")
                               }
                            }',
            'fileuploadfail' => 'function(e, data) {
                            }',
        ],
    ]); ?>
    <a href="<?= Url::to('/user/profile/delete-picture')?> " class="btn btn-danger">Удалить картинку</a>
    <?php endif;?>
    <?php if ($currentUser->getId() !== $user->getId()): ?>
        <?php if (!$currentUser->checkSubscription($user)): ?>
            <a href="<?= Url::to(['/user/profile/subscribe/', 'id' => $user->getId()]) ?>"
               class="btn btn-success">Подписаться</a>
           
        <?php endif; ?>
        <a href="<?= Url::to(['/user/profile/unsubscribe/', 'id' => $user->getId()]) ?>"
           class="btn btn-danger">Отписаться</a>
    <?php endif; ?>
</div>
<div>
    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Подписки
        (<?= $user->getListCount('subscriptions') ?>)</a>
    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Фолловеры
        (<?= $user->getListCount('followers') ?>)</a>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Подписки</h4>
            </div>
            <div class="modal-body">
                <?php foreach ($user->getSubscriptions() as $s): ?>
                    <a href="<?= Url::to([
                        '/user/profile/view/',
                        'nickname' => ($s['nickname'] ? $s['nickname'] : $s['id'])
                    ]) ?>"><?= $s['username'] ?> </a>
                    <hr>
                <?php endforeach; ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="myModal2" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Подписки</h4>
            </div>
            <div class="modal-body">
                <?php foreach ($user->getFollowers() as $f): ?>
                    <a href="<?= Url::to([
                        '/user/profile/view/',
                        'nickname' => ($f['nickname'] ? $f['nickname'] : $f['id'])
                    ]) ?>"><?= $f['username'] ?> </a>
                    <hr>
                <?php endforeach; ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php if (!Yii::$app->user->isGuest && ($mutuals = $currentUser->getMutualSubscriptons($user))): ?>
    <div class="col-md-3">
        <h6 class="text-center">Люди, которых вы можете знать</h6>
        <?php foreach ($mutuals as $mutual): ?>
            <a href="<?= Url::to([
                '/user/profile/view/',
                'nickname' => ($mutual['nickname'] ? $mutual['nickname'] : $mutual['id'])
            ]) ?>"><?= Html::encode($mutual['username']) ?> </a>
            <hr>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
