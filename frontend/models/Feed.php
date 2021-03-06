<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "feed".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $author_id
 * @property string $author_name
 * @property integer $author_nickname
 * @property string $author_picture
 * @property integer $post_id
 * @property string $post_filename
 * @property string $post_description
 * @property integer $post_created_at
 */
class Feed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feed';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'author_id' => 'Author ID',
            'author_name' => 'Author Name',
            'author_nickname' => 'Author Nickname',
            'author_picture' => 'Author Picture',
            'post_id' => 'Post ID',
            'post_filename' => 'Post Filename',
            'post_description' => 'Post Description',
            'post_created_at' => 'Post Created At',
        ];
    }
    /**
     *  get post's likes count
     * @return int
     */
    public function likesCount()
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return $redis->scard("post:{$this->post_id}:likes");
    }

    /**
     *  get post's comments count
     * @return int
     */
    public function commentsCount()
    {
        $post  = Post::findOne($this->post_id);
        return  $post->commentsCount();
    }

    /**
     * check is this post reported
     * @param User $user
     * @return boolean
     */
    public function isReported(User $user)
    {
        $redis = Yii::$app->redis;
        return $redis->sismember("post:$this->post_id:complaints", $user->getId());
    }
}
