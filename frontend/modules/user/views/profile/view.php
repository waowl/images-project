<?php
/**
 * @var $user \frontend\models\User
 * @var $currentUser \frontend\models\User
 */

use yii\helpers\Html;
use yii\helpers\HTMLPurifier;
use yii\helpers\Url;

?>

<div>
    <h4>Привет, <?= Html::encode($user->username) ?></h4>
    <p><?= HTMLPurifier::process($user->about) ?></p>
    <a href="<?= Url::to(['/user/profile/subscribe/', 'id' => $user->getId()]) ?>"
       class="btn btn-success">Подписаться</a>
    <a href="<?= Url::to(['/user/profile/unsubscribe/', 'id' => $user->getId()]) ?>"
       class="btn btn-danger">Отписаться</a>
</div>
<div>
    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Подписки  (<?=$user->getListCount('subscriptions') ?>)</a>
    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Фолловеры  (<?=$user->getListCount('followers') ?>)</a>
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
                <?php foreach ($user->getSubscriptionOrFollowers('subscriptions') as $s): ?>
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
                <?php foreach ($user->getSubscriptionOrFollowers('followers') as $f): ?>
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

<div class="col-md-3">
    <h6 class="text-center">Люди, которых вы можете знать</h6>
    <?php foreach ($currentUser->getMutualSubscriptons($user) as $m): ?>
        <a href="<?= Url::to([
            '/user/profile/view/',
            'nickname' => ($m['nickname'] ? $m['nickname'] : $m['id'])
        ]) ?>"><?= $m['username'] ?> </a>
        <hr>
    <?php endforeach; ?>
</div>

