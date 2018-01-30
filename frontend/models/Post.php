<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $filename
 * @property string $description
 * @property integer $created_at
 * @property integer $complaints
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * delete related data before deleting post.
     */
    public function beforeDelete()
    {
        Yii::$app->storage->deletePicture($this->filename);
        Comment::deleteAll(['post_id' => $this->getId()]);
        Feed::findOne(['post_id'=> $this->getId()]);
        return parent::beforeDelete();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'filename' => 'Filename',
            'description' => 'Description',
            'created_at' => 'Created At',
        ];
    }

    /**
     * get post image
     * @return string
     */
    public function getImage()
    {
        return Yii::$app->storage->getFile($this->filename);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }


    /**
     * get post's comments  count
     * @return int
     */
    public function commentsCount() {
        return $this->hasMany(Comment::className(), ['post_id' => 'id'])->count();
    }

    /**
     * like this post
     * @param User $user
     */
    public function like(User $user)
    {
        $redis = Yii::$app->redis;
        $redis->sadd("post:{$this->getId()}:likes", $user->getId());
        $redis->sadd("user:{$user->getId()}:likes", $this->getId());
    }

    /**
     * unlike this post
     * @param User $user
     */
    public function unLike(User $user)
    {
        $redis = Yii::$app->redis;
        $redis->srem("post:{$this->getId()}:likes", $user->getId());
        $redis->srem("user:{$user->getId()}:likes", $this->getId());
    }

    /**
     * get this post id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *  get post's likes  count
     * @return mixed
     */
    public function likesCount()
    {
        $redis = Yii::$app->redis;
        return $redis->scard("post:{$this->getId()}:likes");
    }


    /**
     *  check is this post liked by user
     * @param User $user
     * @return bool
     */
    public function isLikedBy(User $user)
    {
        $redis = Yii::$app->redis;
        return $redis->sismember("post:{$this->getId()}:likes", $user->getId());
    }


    /**
     * complain about post
     * @param User $user
     * @return bool
     */
    public function complain(User $user)
    {
        $redis = Yii::$app->redis;
        $key = "post:{$this->getId()}:complaints";

        if (!$redis->sismember($key, $user->getId())) {
            $redis->sadd($key, $user->getId());
            $this->complaints++;
            return $this->save(false, ['complaints']);
        }
    }
}
