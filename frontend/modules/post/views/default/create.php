<?php
/**
 * @var  $model \frontend\modules\post\models\forms\PostForm
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<h1>Create Post</h1>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'filename')->fileInput() ?>
<?= $form->field($model, 'description') ?>
<?= Html::submitButton('Сохранить')?>
<?php ActiveForm::end(); ?>
