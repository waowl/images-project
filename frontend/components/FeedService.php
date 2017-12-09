<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.10.2017
 * Time: 12:13
 */

namespace frontend\components;


use frontend\models\Feed;
use frontend\models\Post;
use yii\base\Event;

class FeedService
{
    public function addToFeeds(Event $event)
    {
        $user = $event->getUser();
        $post = $event->getPost();

        $followers = $user->getFollowers();
        foreach ($followers as $follower) {
            $feed = new Feed();
            $feed->user_id = $follower->id;
            $feed->author_id = $user->id;
            $feed->author_name = $user->username;
            $feed->author_nickname = $user->getNickname();
            $feed->author_picture = $user->getPicture();
            $feed->post_id = $post->id;
            $feed->post_filename = $post->filename;
            $feed->post_description = $post->description;
            $feed->post_created_at = $post->created_at;
            $feed->save();
        }
    }

    public function  addNewFollowed(Event $event)
    {
        $userId  = $event->getUserId();
        $posts = Post::find()->where(['user_id' => $event->getFollowedId()])->with('user')->all();

        foreach ($posts as $post) {
            $feed = new Feed();
            $feed->user_id = $userId;
            $feed->author_id = $post->user_id;
            $feed->author_name = $post->user->username;
            $feed->author_nickname = $post->user->getNickname();
            $feed->author_picture = $post->user->getPicture();
            $feed->post_id = $post->id;
            $feed->post_filename = $post->filename;
            $feed->post_description = $post->description;
            $feed->post_created_at = $post->created_at;
            $feed->save();
        }

    }

    public function removeUnfollowed(Event $event)
    {
        $userId  = $event->getUserId();
        $ufollowedId = $event->getFollowedId();

        Feed::deleteAll(['AND', 'user_id' => $userId, 'author_id' => $ufollowedId]);

    }
}