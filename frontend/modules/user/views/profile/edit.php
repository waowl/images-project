<?php
/**@var  $user  \frontend\models\User */
/**@var  $modelPicture  \frontend\modules\user\models\form\PictureForm */
/**@var  $currentUser  \yii\web\IdentityInterface */

use dosamigos\fileupload\FileUpload;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


?>
<h2>edit</h2>

<section class="edit">
    <div class="container">
        <div class="edit__wrapper wrapper__left">
            <div class="edit__header">
                <div class="avatar__container">
                    <img id="profile-picture" src="<?= $user->getPicture(); ?> ">
                </div>
                <?php if ($currentUser && $currentUser->equals($user)): ?>
                    <div class="btn-edit__group">
                        <label for="pictureform-picture" class="label-relative btn-edit"> Change Image
                            <div id="hide">
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
                            </div>

                        </label>
                        <a class="btn-edit" href="/user/profile/delete-picture">Delete Image</a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="edit__body">
                <div class="edit__form__wrapper">
                    <?php $form = ActiveForm::begin()?>
                    <div class="edit__field">
                        <label for="namefield">Name</label><br>
                        <?= $form->field($user, 'username', [
                            'inputOptions'=>[
                                'class'=>'',
                            ]
                        ])->label(false)?>
                    </div>
                    <div class="edit__field">
                        <label for="namefield">Nickname</label><br>
                        <?= $form->field($user, 'nickname',[
                            'inputOptions'=>[
                                'class'=>'',
                            ]
                        ])->label(false)?>
                    </div>

                    <div class="edit__field">
                        <label for="namefield">About</label><br>
                        <?= $form->field($user, 'about', [
                            'inputOptions'=>[
                                'class'=>'',
                            ]
                        ])->label(false)?>
                    </div>
                    <?= Html::submitButton('Save Changes', ['class' => 'btn-filled btn-save', 'name' => 'signup-button']) ?>
                    <?php ActiveForm::end()?>

                </div>
            </div>
        </div>
    </div>
</section>