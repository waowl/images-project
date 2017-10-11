<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.10.2017
 * Time: 11:51
 */

namespace frontend\modules\user\models\form;

use yii\base\Model;

class PictureForm extends Model
{
    public  $picture;

    public function rules()
    {
        return [
            [['picture'], 'file',
                'extensions' => ['jpg'],
                'checkExtensionByMimeType' => true
                ]

        ];
    }

    public function save()
    {
        return 1;
    }

}