<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.12.2017
 * Time: 20:50
 */

use yii\helpers\Url;

/**@var $recommended array*/
?>
<section class="recommended">
    <?php if(!empty($recommended)):?>
    <div class="recommended__header">
        <p class="recommended__title">Recommended</p>
    </div>
        <?php foreach ($recommended as $item):?>
            <div class="recommended__item">
                <div class="recommended__item_info">
                    <div class="recommended__item_avatar"><img src="<?= $item['picture']?> "></div>
                    <a class="recommended__item_name" href="<?= Url::to('/profile/' . $item['id'])?> "><?= $item['username']?>
                        <p class="recommended__item_nickname"><?= $item['nickname']?> </p></a>
                </div>
                <a class="btn-invert recommended__follow" href="<?= Url::to(['/user/profile/subscribe', 'id' => $item['id']]); ?>">Follow</a>
            </div>
        <?php endforeach; ?>
    <?php endif;?>

</section>
