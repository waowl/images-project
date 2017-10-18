<?php
namespace frontend\modules\post\models\forms;

use frontend\models\Post;
use frontend\models\User;
use Yii;
use yii\base\Model;

class PostForm extends Model
{
    const MAX_DESCRIPTION_LENGHT = 1000;
    public $filename;
    public $description;
    private $user;

    public function rules()
    {
        return [
            [
                ['filename'], 'file',
                'skipOnEmpty' => true,
                'extensions' => ['jpg', 'png'],
                'checkExtensionByMimeType' => true,
                'maxSize' => $this->getMaxSize()],
                [['description'], 'string', 'max' => self::MAX_DESCRIPTION_LENGHT]

        ];
    }

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function save()
    {
            if ($this->validate()) {
                $post = new Post();
                $post->description = $this->description;
                $post->created_at = time();
                $post->filename = Yii::$app->storage->saveUploadedFile($this->filename);
                $post->user_id = $this->user->getId();
                return $post->save(false);
            }
    }

    private function getMaxSize()
    {
        return Yii::$app->params['maxFileSize'];
    }

}