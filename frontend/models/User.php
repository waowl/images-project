<?php

namespace frontend\models;

use frontend\models\events\FollowEvent;
use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $about
 * @property integer $type
 * @property string $nickname
 * @property string $picture
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const EVENT_FOLLOW = 'follow';
    const EVENT_UNFOLLOW = 'unfollow';

    const SCENARIO_EDIT = 'edit';

    const DEFAULT_AVATAR = "/img/no-img.jpg";

    public function __construct()
    {
        $this->on(self::EVENT_FOLLOW, [Yii::$app->feedService, 'addNewFollowed']);
        $this->on(self::EVENT_UNFOLLOW, [Yii::$app->feedService, 'removeUnfollowed']);

    }

    public function scenarios()
    {
        return [
            self::SCENARIO_EDIT => ['username', 'nickname', 'about'],
            self::SCENARIO_DEFAULT => ['name', 'email'],

        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return ($this->nickname) ? $this->nickname : $this->id;
    }

    public function follow(User $user)
    {
        if ($this->getId() !== $user->getId()) {
            $k1 = "user:{$this->getId()}:subscriptions";
            $k2 = "user:{$user->getId()}:followers";

            $redis = Yii::$app->redis;
            $redis->sadd($k1, $user->getId());
            $redis->sadd($k2, $this->getId());

            $event =  new FollowEvent();
            $event->userId = $this->getId();
            $event->followedId = $user->getId();
            $this->trigger(self::EVENT_FOLLOW, $event);
        } else {
            throw new Exception('Подписка на самого себя невозможна!');
        }

    }

    public function unFollow(User $user)
    {
        $k1 = "user:{$this->getId()}:subscriptions";
        $k2 = "user:{$user->getId()}:followers";

        $redis = Yii::$app->redis;
        $redis->srem($k1, $user->getId());
        $redis->srem($k2, $this->getId());

        $event =  new FollowEvent();
        $event->userId = $this->getId();
        $event->followedId = $user->getId();
        $this->trigger(self::EVENT_UNFOLLOW, $event);
    }

    /**
     *
     * @return mixed
     */
    public function getFollowers()
    {
        $redis = Yii::$app->redis;
        $key = "user:{$this->getId()}:followers";
        $ids = $redis->smembers($key);
        return User::find()->where(['id' => $ids])->orderBy('username')->all();
    }

    /**
     *
     * @return mixed
     */
    public function getSubscriptions()
    {
        $redis = Yii::$app->redis;
        $key = "user:{$this->getId()}:subscriptions";
        $ids = $redis->smembers($key);
        return User::find()->where(['id' => $ids])->orderBy('username')->all();
    }


    public function getFollowersCount()
    {
        $redis = Yii::$app->redis;
        return $redis->scard("user:{$this->getId()}:followers");
    }

    public function getSubscriptionsCount()
    {
        $redis = Yii::$app->redis;
        return $redis->scard("user:{$this->getId()}:subscriptions");
    }

    public function getMutualSubscriptons(User $user)
    {
        $k1 = "user:{$this->getId()}:subscriptions";
        $k2 = "user:{$user->getId()}:followers";

        $redis = Yii::$app->redis;

        $ids = $redis->sinter($k1, $k2);
        return User::find()->select('id,username, nickname')->where(['id' => $ids])->orderBy('username')->asArray()->all();
    }

    /**
     * @param User $user
     * @return boolean
     */
    public function checkSubscription(User $user)
    {
        $k1 = "user:{$this->getId()}:subscriptions";
        $redis = Yii::$app->redis;
        return $redis->sismember($k1, $user->getId());
    }

    /**
     * get profile picture
     * @return  string
    */
    public function getPicture()
    {
        if ($this->picture)
        {
            return Yii::$app->storage->getFile($this->picture);
        }
        return self::DEFAULT_AVATAR;
    }

    /**
     * delete profile picture
     */
    public function deletePicture()
    {
        if ($this->picture && Yii::$app->storage->deletePicture($this->picture)) {
            $this->picture = null;
            return $this->save(false, ['picture']);
        }

        return false;
    }

    public function getFeed(int $limit)
    {
        $order = ['post_created_at' => SORT_DESC];
        return $this->hasMany(Feed::className(), ['user_id' => 'id'])->orderBy($order)->limit($limit)->all();
    }
    /**
     * Check whether current user likes post with given id
     * @param integer $postId
     * @return boolean
     */
    public function likesPost(int $postId)
    {
        /* @var $redis Connection */
        $redis = Yii::$app->redis;
        return (bool) $redis->sismember("user:{$this->getId()}:likes", $postId);
    }
    /**
     * Get post count
     * @return integer
     */
    public function getPostCount()
    {
        return $this->hasMany(Post::className(), ['user_id' => 'id'])->count();
    }

    /**
     * Get post count
     * @return Post[]
     */
    public function getPosts()
    {
        $order = ['created_at' => SORT_DESC];
        return $this->hasMany(Post::className(), ['user_id' => 'id'])->orderBy($order)->all();
    }
}
