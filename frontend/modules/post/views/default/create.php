<?php
/**
 * @var  $model \frontend\modules\post\models\forms\PostForm
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = Yii::t('post-create', 'Create post')
?>
<section class="create">
    <div class="container">
        <div class="create__wrapper wrapper__left">
            <?php $form = ActiveForm::begin(); ?>
            <div class="form__field">
                <p class="file__field__label"><?=  Yii::t('post-create', 'Select an image')?> </p>
                <label class="file__input"><?=  Yii::t('post-create', 'Select') ?>
                    <?= $form->field($model, 'filename')->fileInput()->label(false) ?>
                </label>
            </div>

            <div class="form__field">
                <label for="description"> <?=  Yii::t('post-create', 'Description')?> </label><br>
                <?= $form->field($model, 'description',  [
                    'inputOptions'=>[
                        'id' => 'description',
                        'class' => 'description__input'
                    ]
                ])->label(false) ?>
            </div>
            <?= Html::submitButton( Yii::t('post-create', 'Create'), ['class' => 'btn-create btn-filled '])?>
            <?php ActiveForm::end(); ?>
            
        </div>
    </div>
</section>