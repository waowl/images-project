<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.10.2017
 * Time: 11:51
 */

namespace frontend\modules\user\models\form;

use Yii;
use yii\base\Model;
use Intervention\Image\ImageManager;
class PictureForm extends Model
{
    public  $picture;

    public function __construct() {
        $this->on(self::EVENT_BEFORE_VALIDATE, [$this, 'resizePicture']);
    }

    /**
     * resize picture before save
     */
    public function resizePicture()
    {
        $width = Yii::$app->params['picture']['width'];
        $height = Yii::$app->params['picture']['height'];

        $manager = new ImageManager(['driver' => 'imagick']);

        $image = $manager->make($this->picture->tempName);
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save();
    }

    public function rules()
    {
        return [
            [['picture'], 'file',
                'extensions' => ['jpg'],
                'checkExtensionByMimeType' => true,
                'maxSize' => Yii::$app->params['maxFileSize']
            ],
        ];
    }

    public function save()
    {
        return 1;
    }

}