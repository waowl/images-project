<?php
namespace frontend\modules\post\models\forms;

use frontend\models\Post;
use frontend\models\User;
use Yii;
use yii\base\Model;
use frontend\models\events\PostCreatedEvent;

class PostForm extends Model
{
    const MAX_DESCRIPTION_LENGTH = 1000;
    const EVENT_POST_CREATED = 'post_created';

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
                [['description'], 'string', 'max' => self::MAX_DESCRIPTION_LENGTH]

        ];
    }

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->on(self::EVENT_POST_CREATED, [Yii::$app->feedService, 'addToFeeds']);
    }

    public function save()
    {
            if ($this->validate()) {
                $post = new Post();
                $post->description = $this->description;
                $post->created_at = time();
                $post->filename = Yii::$app->storage->saveUploadedFile($this->filename);
                $post->user_id = $this->user->getId();
                if($post->save(false)) {
                    $event = new PostCreatedEvent();
                    $event->user = $this->user;
                    $event->post = $post;
                    $this->trigger(self::EVENT_POST_CREATED, $event);
                    return true;
                }
            }
            return false;
    }

    private function getMaxSize()
    {
        return Yii::$app->params['maxFileSize'];
    }

}