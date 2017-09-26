<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

/* @var $users \frontend\models\User */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php foreach ($users as $user): ?>
        <p>
            <a href="<?= Url::to(['/user/profile/view', 'id' => $user->id]) ?>"><?= $user->username ?></a>
        </p>
    <?php endforeach ?>
</div>
