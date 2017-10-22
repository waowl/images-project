<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 18.10.2017
 * Time: 12:26
 */

namespace frontend\modules\post\models\forms;


use frontend\models\User;
use frontend\models\Comment;
use yii\base\Model;
use yii\db\ActiveRecord;

class CommentForm extends Model
{

    const MAX_LENGTH = 256;

    public $comment;
    private $user;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['comment', 'string', 'max' => self::MAX_LENGTH],
            ['comment', 'required']
        ];
    }

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function save($id)
    {
        if ($this->validate()) {
            $comment = new Comment();
            $comment->comment = $this->comment;
            $comment->post_id = $id;
            $comment->user_id = $this->user->id;

            return $comment->save(false);
        }
    }

    public function update($id)
    {
        $comment = Comment::findOne($id);
        $comment->comment = $this->comment;

        return $comment->save(false);
    }
}